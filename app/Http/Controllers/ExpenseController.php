<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\ExpenseHead;
use App\Expense;
use App\ExpenseCategory;
use Auth;
use PDF;
use Illuminate\Support\Carbon;
use App\Branch;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $admin=Auth::guard('admin')->user(); 
        // $expenses = $admin->expenses;->pluck('id')->toArray();
        $expenses = $admin->expenses()->get();
        // $expenses=Expense::all();
        return view('admin.expense.expenseList', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $branches=Branch::all();
        $expense_category=ExpenseCategory::all();
        return view('admin.expense.addExpense', compact('expense_category','branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            
            
            'name' => 'required',
            'branch_id'=>'required',
            'expense_category_id'=>'required',
            'date' => 'required|date',
            'amount' => 'required'
            
        ]);

        $admin=Auth::guard('admin')->user();

        $expense=new Expense;

        $expense->branch_id=$request->branch_id;
        $expense->expense_category_id=$request->expense_category_id;
        $expense->name=$request->name;
        $expense->date=$request->date;
        $expense->amount=$request->amount;
        $expense->save();

        $request->session()->flash('success', 'Expense Added Successfully');
        return redirect('admin/expenses/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branches=Branch::all();
        $expense=Expense::find($id);
        $expense_category=ExpenseCategory::all();
        $expense_heads=ExpenseHead::all();
        return view('admin.expense.editExpense', compact('expense', 'expense_heads','branches','expense_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            
            // 'expense_head_id' => 'required',
            'name' => 'required',
            'branch_id'=>'required',
            'date' => 'required|date',
            'expense_category_id'=>'required',
            'amount' => 'required'
            
        ]);

        $expense=Expense::find($id);

        $expense->branch_id=$request->branch_id;
        $expense->expense_category_id=$request->expense_category_id;
        $expense->name=$request->name;
        $expense->date=$request->date;
        $expense->amount=$request->amount;
        $expense->save();

        $request->session()->flash('success', 'Expense Updated Successfully');
        return redirect('admin/expenses/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense=Expense::find($id);
        $expense->delete();
        Session::flash('success', 'Expense Deleted Successfully');
        return redirect('admin/expenses/');
    }

    public function expensePdf()
    {
        $expenses=Expense::all();
        $expense_category=ExpenseCategory::all();

        $total_expense=0;
        foreach ($expenses as $expense) {
            
            $total_expense=$total_expense+$expense->amount;

        }


        

        $pdf = PDF::loadView('admin.expense.expensePdf', compact('expenses','total_expense'));
        return $pdf->stream('Expense.pdf');
    }

    public function expenseSearch(Request $request)
    {
        $request_start_date=$request->start_date;
        $request_end_date=$request->end_date;
        
        $start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $end_date = Carbon::parse($request->end_date)->format('Y-m-d');

        $expenses= Expense::whereBetween('date', [$start_date,$end_date])
                    ->orderBy('id', 'DESC')
                    ->get() ;


        return view('admin.expense.expenseSearch', compact('expenses', 'request_start_date', 'request_end_date'));
    }

    public function expensePdfSearch(Request $request)
    {
        $start_date = Carbon::parse($request->request_start_date)->format('Y-m-d');
        $end_date = Carbon::parse($request->request_end_date)->format('Y-m-d');

        // return $request->all();

        $expenses= Expense::whereBetween('date', [$start_date,$end_date])
                    ->orderBy('id', 'DESC')
                    ->get() ;

        $total_expense=0;
        foreach ($expenses as $expense) {
            
            $total_expense=$total_expense+$expense->amount;

        }            
        

       
        // foreach ($dateArray as $singleDate) {
            // get expense for a single date
            $expense = Expense::whereBetween('date', [$start_date,$end_date])
                              ->orderBy('id', 'DESC')
                              ->get();

            // formatting expense data
            if (count($expense) > 0) {
                // getting unique expense name
                $expense_group_list = [];
                foreach ($expense as $e) {
                    if (!in_array($e->expense_category_id, $expense_group_list)) {
                        array_push($expense_group_list, $e->expense_category_id);
                    }
                }

                // getting data from expense for a unique expense name
                foreach ($expense_group_list as $en) {
                    $expenseCategoryName=ExpenseCategory::find($en)->name??'';
                    $expense_array[$expenseCategoryName] = 0;
                    foreach ($expense as $ed) {
                        if ($en === $ed->expense_category_id) {
                            $expense_array[$expenseCategoryName] += $ed->amount;
                        }
                    }
                }
            }
        // }
        

        $pdf = PDF::loadView('admin.expense.expensePdf', compact('expenses','start_date','end_date','total_expense','expense_array'));
       
        return $pdf->stream('Expense.pdf');
    }
}
