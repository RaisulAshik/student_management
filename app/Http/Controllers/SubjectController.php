<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\ClassName;
use App\Branch;
use App\Admin;
use Session;
use DB;


class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects=Subject::all();
        $admins = Admin::where('role_id', 4)->get();
        return view('admin.subject.subjectList',compact('subjects', 'admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = ClassName::all();
        $branches = Branch::all();
        $admins = Admin::where('role_id', 4)->get();
        return view('admin.subject.addSubject', compact('classes', 'branches', 'admins'));
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
            'class_id'=>'required',
            'branch_id'=>'required',
            'amount'=>'required',
            'student_type'=>'required'
        ]);

        // Subject::create($request->all());
        $subject = Subject::create($request->all());
        // attach subject to all role=4 admins
        $admin = Admin::find($request->admin_id);
        if ($admin && $admin->role_id == 4) {
            $admin->subjects()->syncWithoutDetaching([$subject->id]);
        }


        $request->session()->flash('success', 'Subject Added Successfully');
        return redirect('admin/subjects/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $subject=Subject::find($id);
       $branches=Branch::all();
       $admins   = Admin::where('role_id', 4)->get();
       return view('admin.subject.editSubject',compact('subject', 'branches','admins')); 
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
            'name' => 'required',
            'class_id'=>'required',
            'branch_id'=>'required',
            'amount'=>'required',
            'student_type'=>'required',
            'admin_id' => 'required'
        ]);

        $subject=Subject::find($id);
        $subject->name=$request->name;
        $subject->class_id=$request->class_id;
        $subject->branch_id=$request->branch_id;
        $subject->amount=$request->amount;
        $subject->student_type=$request->student_type;

        $subject->save();
        $admin_id = $request->admin_id;
        $subject->admins()->sync([$admin_id]);

        $request->session()->flash('success', 'Subject Updated Successfully'); 
        return redirect('admin/subjects/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject=Subject::find($id);
        $subject->delete();

        Session::flash('success', 'Subject Deleted Successfully');
        return redirect('admin/subjects/');
    }
}
