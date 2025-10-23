<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\User;
use App\StudentPaymentInstallment;
use App\StudentSubject;
use App\TeacherPayment;
use Carbon\Carbon;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Admin::with('subjects')->where('role_id', 4)->get();

        foreach ($teachers as $teacher) {
            $teacherExpected = 0;
            $teacherAfterDiscount = 0;
            $teacherPaid = 0;
            $teacherDue = 0;

            foreach ($teacher->subjects as $subject) {
                // Students enrolled in this subject
                $students = User::join('student_subjects', 'users.id', '=', 'student_subjects.student_id')
                    ->where('student_subjects.subject_id', $subject->id)
                    ->select('users.*')
                    ->distinct()
                    ->get();

                foreach ($students as $student) {
                    // Get all subjects for this student
                    $studentSubjects = StudentSubject::where('student_id', $student->id)->with('subject')->get();

                    // Total expected for this student
                    $totalStudentExpected = $studentSubjects->sum(fn($s) => $s->subject->amount);

                    if ($totalStudentExpected == 0) continue; // safety check

                    // Total actually paid by this student
                    $studentPaid = $student->payments()->sum('paid_amount');

                    // // Proportional allocation for THIS subject
                    // $allocatedToSubject = round(($studentPaid * $subject->amount) / $totalStudentExpected, 2);

                    // // Expected (raw fee)
                    // $teacherExpected += $subject->amount;

                    // // After discount (this is what student "should" pay for this subject)
                    // $teacherAfterDiscount += $allocatedToSubject;

                    // // Paid (what was allocated here)
                    // $teacherPaid += $allocatedToSubject;
                    // Proportional allocation to this subject 
                    $proportion = $studentPaid / $totalStudentExpected; 
                    // fraction of payment made 
                    $subjectAfterDiscount = round($subject->amount * min($proportion, 1), 2); 
                    // Paid amount cannot exceed what student actually paid 
                     $subjectPaid = min($subjectAfterDiscount, $studentPaid); 
                    // Expected without discount 
                     $teacherExpected += $subject->amount; 
                     // After discount 
                     $teacherAfterDiscount += $subjectAfterDiscount; 
                     // Paid 
                     $teacherPaid += $subjectPaid;
                    // Due = expected - allocated
                    $teacherDue += $subject->amount - $subjectPaid;
                }
            }

            // Teacher payments already given (manual installments etc.)
            $teacherPayment = TeacherPayment::where('admin_id', $teacher->id)->sum('amount');

            // Assign back to teacher object
            $teacher->expectedAmount = $teacherExpected;
            $teacher->afterDiscountAmount = $teacherAfterDiscount * 0.60; // Teacher gets 60%
            $teacher->totalPaid = $teacherPayment;
            $teacher->dueAmount = $teacher->afterDiscountAmount - $teacher->totalPaid;
        }
        return view('admin.teacher.teacherList',compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teacher.addTeacher');
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
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',

            
        ]);

        $teacher=new Admin;
        $teacher->name=$request->name;
        $teacher->email=$request->email;
        $teacher->role_id=4;
        $teacher->password=bcrypt($request->password);
        $teacher->save();

        return redirect('admin/teachers/');
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
        $teacher=Admin::find($id);
        return view('admin.teacher.editTeacher',compact('teacher'));
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
            'email' => 'required|email',

        ]);

        $teacher=Admin::find($id);
        $teacher->name=$request->name;
        $teacher->email=$request->email;
        $teacher->save();

        return redirect('admin/teachers/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher=Admin::find($id);
        $teacher->delete();
        return redirect('admin/teachers/');
    }

    public function paymentInstallmentList($teacherId)
    {
        $teacher = Admin::findOrFail($teacherId);
   
        $installments = TeacherPayment::where('admin_id', $teacherId)->orderBy('payment_date', 'desc')->get();
        return view('admin.teacher.teacherPaymentList', compact('teacher', 'installments'));
    }

    public function addTeacherPaymentInstallment($teacherId)
    {
        $teacher = Admin::with('subjects')->findOrFail($teacherId);

        $teacherExpected = 0;
        $teacherAfterDiscount = 0;
        $teacherPaid = 0;
        $teacherDue = 0;

        foreach ($teacher->subjects as $subject) {
            $students = User::join('student_subjects', 'users.id', '=', 'student_subjects.student_id')
                ->where('student_subjects.subject_id', $subject->id)
                ->select('users.*')
                ->distinct()
                ->get();

            foreach ($students as $student) {
                $studentSubjects = StudentSubject::where('student_id', $student->id)->get();
                $totalStudentExpected = $studentSubjects->sum(fn($s) => $s->subject->amount);
                $studentPaid = $student->payments()->sum('paid_amount');

                // $subjectAfterDiscount = round(($studentPaid * $subject->amount) / $totalStudentExpected, 2);
                // $teacherExpected += $subject->amount;
                // $teacherAfterDiscount += $subjectAfterDiscount;
                // $teacherPaid += $subjectAfterDiscount;
                // $teacherDue += $subject->amount - $subjectAfterDiscount;

                $proportion = $studentPaid / $totalStudentExpected; 
                // fraction of payment made 
                $subjectAfterDiscount = round($subject->amount * min($proportion, 1), 2); 
                // Paid amount cannot exceed what student actually paid 
                $subjectPaid = min($subjectAfterDiscount, $studentPaid); 
                // Expected without discount 
                $teacherExpected += $subject->amount; 
                // After discount 
                $teacherAfterDiscount += $subjectAfterDiscount; 
                // Paid 
                $teacherPaid += $subjectPaid;
                // Due = expected - allocated
                $teacherDue += $subject->amount - $subjectPaid;
            }
        }

        $teacher->expectedAmount = $teacherExpected;
        $teacher->afterDiscountAmount = $teacherAfterDiscount * 0.60; // 60% to teacher
        $teacher->totalPaid = TeacherPayment::where('admin_id', $teacher->id)->sum('amount')??0;
        $teacher->dueAmount = $teacher->afterDiscountAmount - $teacher->totalPaid;
        return view('admin.teacher.addTeacherPaymentInstallment', compact('teacher'));
    }

    public function createTeacherPaymentInstallment(Request $request, $teacherId)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
        ]);

        $teacher = Admin::with('subjects')->findOrFail($teacherId);

        // Calculate teacher-wise payment based on student payments
        $teacherPaymentAmount = 0;
        $teacherExpected = 0;   
        $teacherAfterDiscount = 0;
        $teacherPaid = 0;
        $teacherDue = 0;
        foreach ($teacher->subjects as $subject) {

            // Get students enrolled in this subject
            $students = User::join('student_subjects', 'users.id', '=', 'student_subjects.student_id')
                            ->where('student_subjects.subject_id', $subject->id)
                            ->select('users.*')
                            ->distinct()
                            ->get();

            foreach ($students as $student) {
                $studentSubjects = StudentSubject::where('student_id', $student->id)->get();
                $totalStudentExpected = $studentSubjects->sum(fn($s) => $s->subject->amount);
                $studentPaid = $student->payments()->sum('paid_amount');

                // $subjectAfterDiscount = round(($studentPaid * $subject->amount) / $totalStudentExpected, 2);

                // $teacherPaymentAmount += $subjectAfterDiscount;

                $proportion = $studentPaid / $totalStudentExpected; 
                // fraction of payment made 
                $subjectAfterDiscount = round($subject->amount * min($proportion, 1), 2); 
                // Paid amount cannot exceed what student actually paid 
                $subjectPaid = min($subjectAfterDiscount, $studentPaid);
                // After discount 
                $teacherAfterDiscount += $subjectAfterDiscount; 
            }
        }

        // Optional: you can also limit to the amount entered manually
        // $payAmount = min($request->amount, $teacherPaymentAmount);
        $payAmount = min($request->amount, $teacherAfterDiscount);

        // Record payment
        TeacherPayment::create([
            'admin_id' => $teacher->id,
            'amount' => $payAmount,
            'payment_date' => Carbon::parse($request->payment_date),
            'note' => $request->note ?? null,
        ]);

        return redirect("/admin/teachers")->with('success', 'Teacher payment recorded successfully.');
    }
}
