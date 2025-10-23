<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exam;
use PDF;
use App\ExamEnroll;
use Session;
use App\Imports\ExamEnrollsImport;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use DB;


class AdminExamController extends Controller
{
    public function exam_list()
    {
        $exams=Exam::all();

        return view('admin.exam.examList',compact('exams'));
    }

    public function add_exam(){

        return view('admin.exam.examAdd');
    }

    public function create_exam(Request $request){

        $request->validate([
            
            'name' => 'required',
            // 'code'=>'required',
            // 'branch_id' => 'required',
            // 'class_id' => 'required',
            // 'batch_id' => 'required',
            // 'subject_id' => 'required',
            // 'student_type' => 'required',
            
            'total_marks' => 'required',
            'height_marks' => 'required',
            'satisfactory_mark' => 'required',

            'file' =>'required|mimes:xls,xlsx,csv,txt'

            
        ]);

        $exam=Exam::create($request->all());

        Excel::import(new ExamEnrollsImport($exam->id), $request->file('file'));
        
        $request->session()->flash('success', 'Exam Result Uploaded Successfully');
        return redirect('admin/exams/');
    
    }

    public function exam_result($id)
    {
        $students=DB::table('exam_enrolls')
                    ->join('users','exam_enrolls.student_id','=','users.id')
                    ->join('exams','exam_enrolls.exam_id','=','exams.id')
                    ->where('exam_enrolls.exam_id',$id)
                    ->get();
                   
        
        return view('admin.exam.studentList',compact('students'));
    }

    
    // individual student exam result
    public function individual_std_exam_result($id)
    {
        $results=DB::table('exam_enrolls')
                    ->select('exams.name As exam_name',
                    'exam_enrolls.height_marks As height_marks',
                    'exam_enrolls.obtained_marks As obtained_marks',
                    'exam_enrolls.total_marks As total_marks',
                    'exam_enrolls.satisfactory_mark As satisfactory_mark',
                    'users.registration_id As registration_id',
                    'users.last_name As last_name',
                    'users.first_name As first_name',
                    'exam_enrolls.merit_position As merit_position',
                    )     
                    ->join('users','exam_enrolls.student_id','=','users.id')
                    ->join('exams','exam_enrolls.exam_id','=','exams.id')
                    ->where('exam_enrolls.student_id',$id)
                    ->orderBy('exams.id', 'desc')
                    ->first();
                   
                    return response()->json($results);
        
    }
    // individual student exam result list
    public function individual_std_exam_result_list($id)
    {
        $results=DB::table('exam_enrolls')
                    ->select('exams.name As exam_name',
                    'exam_enrolls.height_marks As height_marks',
                    'exam_enrolls.obtained_marks As obtained_marks',
                    'exam_enrolls.total_marks As total_marks',
                    'exam_enrolls.satisfactory_mark As satisfactory_mark',
                    'users.registration_id As registration_id',
                    'users.last_name As last_name',
                    'users.first_name As first_name',
                    'exam_enrolls.merit_position As merit_position',
                    )     
                    ->join('users','exam_enrolls.student_id','=','users.id')
                    ->join('exams','exam_enrolls.exam_id','=','exams.id')
                    ->where('users.registration_id',$id)
                    ->orderBy('exams.id', 'desc')
                    ->get();
        
        return view('admin.exam.studentResultList',compact('results'));
    }

    // individual student exam result search
    public function individual_std_exam_result_search(Request $request,$id)
    {
        // dd($request);

        $request_start_date=$request->start_date;
        $request_end_date=$request->end_date;
        
        $start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $end_date = Carbon::parse($request->end_date)->format('Y-m-d');
        $results=DB::table('exam_enrolls')
                    ->select('exams.name As exam_name',
                    'exam_enrolls.height_marks As height_marks',
                    'exam_enrolls.obtained_marks As obtained_marks',
                    'exam_enrolls.total_marks As total_marks',
                    'exam_enrolls.satisfactory_mark As satisfactory_mark',
                    'users.registration_id As registration_id',
                    'users.last_name As last_name',
                    'users.first_name As first_name',
                    'exam_enrolls.merit_position As merit_position',
                    )     
                    ->join('users','exam_enrolls.student_id','=','users.id')
                    ->join('exams','exam_enrolls.exam_id','=','exams.id')
                    ->where('users.registration_id',$id)
                    ->whereBetween('exam_enrolls.created_at', [$start_date,$end_date])
                    // ->orderBy('exams.id', 'desc')
                    ->orderBy('exam_enrolls.created_at', 'desc')
                    ->get();
        
        return view('admin.exam.studentResultSearch',compact('results','request_start_date', 'request_end_date'));
    }

    // individual student exam result search pdf
    public function individual_std_exam_result_search_pdf(Request $request,$id)
    {
        // dd($request);
      
        $request_start_date=$request->request_start_date;
        $request_end_date=$request->request_end_date;
        
        $start_date = Carbon::parse($request->request_start_date)->format('Y-m-d');
        $end_date = Carbon::parse($request->request_end_date)->format('Y-m-d');
        $results=DB::table('exam_enrolls')
                    ->select('exams.name As exam_name',
                    'exam_enrolls.height_marks As height_marks',
                    'exam_enrolls.obtained_marks As obtained_marks',
                    'exam_enrolls.total_marks As total_marks',
                    'exam_enrolls.satisfactory_mark As satisfactory_mark',
                    'users.registration_id As registration_id',
                    'users.last_name As last_name',
                    'users.first_name As first_name',
                    'exam_enrolls.merit_position As merit_position',
                    'exam_enrolls.created_at As creation_date',
                    )     
                    ->join('users','exam_enrolls.student_id','=','users.id')
                    ->join('exams','exam_enrolls.exam_id','=','exams.id')
                    ->where('users.registration_id',$id)
                    ->whereBetween('exam_enrolls.created_at', [$start_date,$end_date])
                    ->orderBy('exam_enrolls.created_at', 'desc')
                    ->get();

        $pdf = PDF::loadView('admin.exam.studentResultPdf', compact('results','start_date','end_date'));
        return $pdf->stream('result.pdf');
    }


}
