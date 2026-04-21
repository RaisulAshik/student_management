<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use Illuminate\Support\Carbon;
use Carbon\CarbonPeriod;
// use App\StudentPayment;
// use App\StudentPaymentInstallment;
use DB;
use PDF;
use Auth;

class ReportController extends Controller
{
    public function expenseReport()
    {
        return view('admin.report.balanceReport');
    }

    public function expenseSearch(Request $request)
    {
        $request_start_date=$request->start_date;
        $request_end_date=$request->end_date;
        
        $start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $end_date = Carbon::parse($request->end_date)->format('Y-m-d');

        $period = CarbonPeriod::create($start_date, $end_date);

        // all date found from date range input
        $dateArray = $period->toArray();
        $total_days = count($dateArray);

        // creating an array for all data in the date range
        $data = [];

        // variable for hold all income and expense in this date range
        $all_income = 0;
        $all_expense = 0;
        
        $admin = Auth::guard('admin')->user();

        $allowedClassIds = $admin->allowedClassIds();

        // getting data for all date in the date range
        foreach ($dateArray as $singleDate) {
            
            // get date only from carbon date and formati in d-m-Y format
            $date = $singleDate->toDateString();
            $formattedDate = Carbon::createFromFormat('Y-m-d', $date)->format('d-m-Y');

            // create an array for putting all individual income from different batch
            $income_array = [];

            // create an array for putting all individual expense for different date
            $expense_array = [];

            // get offline income for a single date
            $offline_income = DB::table('student_payment_installments as i')
                                ->join('student_payments as p', 'p.id', '=', 'i.student_payment_id')
                                ->join('batches as b', 'b.id', '=', 'p.batch_id')
                                ->where('i.payment_date', $date)
                                ->whereIn('p.class_id', $allowedClassIds)
                                ->get();
            $offline_income_without_teacher = DB::table('student_payment_installments as i')
                                ->join('student_payments as p', 'p.id', '=', 'i.student_payment_id')
                                ->join('batches as b', 'b.id', '=', 'p.batch_id')
                                ->join('class_names as c', 'c.id', '=', 'p.class_id')
                                ->join('subjects as s', 's.class_id', '=', 'c.id')
                                ->join('admin_subjects as as', 'as.subject_id', '=', 's.id')
                                ->join('admins as a', 'a.id', '=', 'as.admin_id')
                                ->where('i.payment_date', $date)
                                ->whereIn('p.class_id', $allowedClassIds)
                                ->select(
                                    'i.id as installment_id',
                                    'i.amount as installment_amount',
                                    'i.payment_date',
                                    'p.id as payment_id',
                                    'p.student_id',
                                    'p.total_amount',
                                    'p.paid_amount',
                                    'p.due_amount',
                                    'b.id as batch_id',
                                    'b.name as batch_name',
                                    'c.id as class_id',
                                    'c.name as class_name',
                                    's.id as subject_id',
                                    's.name as subject_name',
                                    'a.id as teacher_id',
                                    'a.name as teacher_name'
                                )
                                ->groupBy('p.id')
                                ->get();

                                // dd(($offline_income_without_teacher));
                                // dd($offline_income);

            // formatting offline income data
            if (count($offline_income) > 0|| count($offline_income_without_teacher) > 0) {
                if(count($offline_income_without_teacher) > 0){
                    foreach ($offline_income_without_teacher as $oi) {
                        if (!array_key_exists($oi->batch_name, $income_array)) {
                            $income_array[$oi->batch_name] = 0;
                        }
                    }
        
                    // getting data from offline income for a unique batch
                    foreach ($offline_income_without_teacher as $ob) {
                        if (!isset($income_array[$ob->batch_name])) {
                            $income_array[$ob->batch_name] = 0;
                        }
                        $income_array[$ob->batch_name] =($income_array[$ob->batch_name]??0)+ ($ob->paid_amount*0.4);
                    }
                }else{
                    foreach ($offline_income as $oi) {
                        if (!array_key_exists($oi->name, $income_array)) {
                            $income_array[$oi->name] = 0;
                        }
                    }
        
                    // getting data from offline income for a unique batch
                    foreach ($offline_income as $ob) {
                        $income_array[$ob->name] += $ob->amount;
                    }
                }
                
                
                // getting unique offline batch id
                // $offline_batch = [];
                // foreach ($offline_income as $oi) {
                //     if (!in_array($oi->name, $offline_batch)) {
                //         array_push($offline_batch, $oi->name);
                //     }
                // }
    
                // // getting data from offline income for a unique batch
                // foreach ($offline_batch as $ob) {
                //     $income_array[$ob] = 0;
                //     foreach ($offline_income as $fi) {
                //         if ($ob === $fi->name) {
                //             $income_array[$ob] += $fi->amount;
                //         }
                //     }
                // }
            }

            // get online income for a single date
            $online_income = DB::table('student_payments as p')
                               ->join('batches as b', 'b.id', '=', 'p.batch_id')
                               ->where('p.student_type', '=', 1)
                               ->where('payment_date', $date)
                               ->orderBy('p.id', 'DESC')
                               ->get();

            // formatting offline income data
            if (count($online_income) > 0) {
                // getting unique online batch id
                $online_batch = [];
                foreach ($online_income as $ni) {
                    if (!in_array($ni->name, $online_batch)) {
                        array_push($online_batch, $ni->name);
                    }
                }

                // getting data from online income for a unique batch
                foreach ($online_batch as $nb) {
                    $income_array[$nb] = 0;
                    foreach ($online_income as $income) {
                        if ($nb === $income->name) {
                            $income_array[$nb] += $income->paid_amount;
                        }
                    }
                }
            }

            // calculating total income for a fixed date
            $total_income = 0;
            foreach ($income_array as $batch => $batch_income) {
                $total_income += $batch_income;
            }

            // get expense for a single date
            $expense = Expense::where('date', $date)
                              ->orderBy('id', 'DESC')
                              ->get();
            if($admin->role_id == 2){
            // formatting expense data
                if (count($expense) > 0) {
                    // getting unique expense name
                    $expense_name_list = [];
                    foreach ($expense as $e) {
                        if (!in_array($e->name, $expense_name_list)) {
                            array_push($expense_name_list, $e->name);
                        }
                    }
    
                    // getting data from expense for a unique expense name
                    foreach ($expense_name_list as $en) {
                        $expense_array[$en] = 0;
                        foreach ($expense as $ed) {
                            if ($en === $ed->name) {
                                $expense_array[$en] += $ed->amount;
                            }
                        }
                    }
                }
            }

            // calculating total expense for a fixed date
            $total_expense = 0;
            if($admin->role_id == 2){
                foreach ($expense_array as $item => $item_expense) {
                    $total_expense += $item_expense;
                }
            }

            // calculating net income for a fixed date
            $net_income = $total_income - $total_expense;

            $data[$formattedDate] = [
                "income" => $income_array,
                "expense" => $expense_array,
                'total_income' => $total_income,
                'total_expense' => $total_expense,
                'net_income' => $net_income,
            ];

            $all_income += $total_income;
            $all_expense += $total_expense;
        }
        
        
        $offline_batch_income = DB::table('student_payment_installments as i')
                                ->join('student_payments as p', 'p.id', '=', 'i.student_payment_id')
                                ->join('batches as b', 'b.id', '=', 'p.batch_id')
                                ->whereIn('p.class_id', $allowedClassIds)
                                ->whereBetween('i.payment_date', [$start_date,$end_date])
                                ->get();

        $offline_batch_income_without_teacher = DB::table('student_payment_installments as i')
                                ->join('student_payments as p', 'p.id', '=', 'i.student_payment_id')
                                ->join('batches as b', 'b.id', '=', 'p.batch_id')
                                ->join('class_names as c', 'c.id', '=', 'p.class_id')
                                ->join('subjects as s', 's.class_id', '=', 'c.id')
                                ->join('admin_subjects as as', 'as.subject_id', '=', 's.id')
                                ->join('admins as a', 'a.id', '=', 'as.admin_id')
                                ->whereBetween('i.payment_date', [$start_date,$end_date])
                                ->whereIn('p.class_id', $allowedClassIds)
                                ->select(
                                    'i.id as installment_id',
                                    'i.amount as installment_amount',
                                    'i.payment_date',
                                    'p.id as payment_id',
                                    'p.student_id',
                                    'p.total_amount',
                                    'p.paid_amount',
                                    'p.due_amount',
                                    'b.id as batch_id',
                                    'b.name as batch_name',
                                    'c.id as class_id',
                                    'c.name as class_name',
                                    's.id as subject_id',
                                    's.name as subject_name',
                                    'a.id as teacher_id',
                                    'a.name as teacher_name'
                                )
                                ->groupBy('p.id')
                                ->get();
        // formatting offline income data
        $income = [];
        if(count($offline_batch_income_without_teacher) > 0){
            // foreach ($offline_batch_income_without_teacher as $oi) {
            //     if (!in_array($oi->batch_name, $income)) {
            //         $income[$oi->batch_name] = 0;
            //     }
            // }
    
            // getting data from offline income for a unique batch
            foreach ($offline_batch_income_without_teacher as $obi) {
                if (!isset($obi->batch_name, $income)) {
                    $income[$obi->batch_name] = 0;
                }
                $income[$obi->batch_name] = ($income[$obi->batch_name]??0)+($obi->paid_amount*0.4);
            }
        }else{
            foreach ($offline_batch_income as $oi) {
                if (!array_key_exists($oi->name, $income)) {
                    $income[$oi->name] = 0;
                }
            }
    
            // getting data from offline income for a unique batch
            foreach ($offline_batch_income as $obi) {
                $income[$obi->name] += $obi->amount;
            }
        }

        // getting unique offline batch id
        

        // $offline_batchs = [];
        // foreach ($offline_batch_income as $oi) {
        //     if (!in_array($oi->name, $offline_batchs)) {
        //         array_push($offline_batchs, $oi->name);
        //     }
        // }

        // // getting data from offline income for a unique batch
        // foreach ($offline_batchs as $obs) {
        //     $income[$obs] = 0;
        //     foreach ($offline_batch_income as $obi) {
        //         if ($obs === $obi->name) {
        //             $income[$obs] += $obi->amount;
        //         }
        //     }
        // }
    

        // dd($data);

        // creating an array for summary of the all data
        $summary = [];
        $summary['batch_per_income'] = $income;
        $summary['total_days'] = $total_days;
        $summary['all_income'] = $all_income;
        $summary['all_expense'] = $all_expense;
        $summary['all_net_income'] = $all_income - $all_expense;

        

        // return $data;

        $pdf = PDF::loadView('admin.report.balancePdf', compact('data', 'start_date', 'end_date', 'summary'));
        return $pdf->stream('Balance.pdf');
    }
}
