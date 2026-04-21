<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Role;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $roles=Role::all();
       return view('admin.role.roleList',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.addRole');
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
        ]);

        Role::create($request->all());
        $request->session()->flash('success', 'Role Added Successfully');
        return redirect('admin/roles');
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
        $role=Role::find($id);
        return view('admin.role.editRole',compact('role'));
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
        ]);

        $role=Role::find($id);
        $role->name=$request->name;
        $role->save();
        
        $request->session()->flash('success', 'Role Updated Successfully');
        return redirect('admin/roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role=Role::find($id);
        $role->delete();
        Session::flash('success', 'Role Deleted Successfully');
        return redirect('admin/roles');
    }

    public function managePermissions($id)
    {
        $role = Role::findOrFail($id);
        $spatieRole = SpatieRole::where('name', $role->name)->where('guard_name', 'admin')->first();

        $rolePermissions = $spatieRole
            ? $spatieRole->permissions()->where('guard_name', 'admin')->pluck('name')->toArray()
            : [];

        $permissionGroups = [
            'Dashboard'       => ['view-dashboard'],
            'Students'        => ['view-students','create-students','edit-students','delete-students'],
            'Online Students' => ['view-online-students','create-online-students','edit-online-students','delete-online-students'],
            'Offline Students'=> ['view-offline-students','create-offline-students','edit-offline-students','delete-offline-students'],
            'Academic'        => ['manage-classes','manage-subjects','manage-branches','manage-batches'],
            'MCQ Exams'       => ['manage-mcq-exams','view-mcq-results'],
            'CQ Exams'        => ['manage-cq-exams','view-cq-results','evaluate-cq-exams'],
            'Homework'        => ['view-homework','evaluate-homework'],
            'Live Class'      => ['manage-zoom-classes','view-attendance','submit-attendance'],
            'Content'         => ['manage-contents','manage-lecture-sheets'],
            'Teachers'        => ['view-teachers','create-teachers','edit-teachers','delete-teachers','manage-teacher-payments'],
            'Admins'          => ['view-admins','create-admins','edit-admins','delete-admins'],
            'Payments'        => ['view-payments','view-student-payments','approve-online-payments','manage-offline-payments'],
            'Expenses'        => ['view-expenses','create-expenses','edit-expenses','delete-expenses','manage-expense-heads','manage-expense-categories','view-expense-reports'],
            'Communication'   => ['send-messages','send-sms','send-due-sms'],
            'System'          => ['manage-roles','manage-company-details','manage-zoom-api','manage-instructions'],
        ];

        return view('admin.role.managePermissions', compact('role', 'permissionGroups', 'rolePermissions'));
    }

    public function updatePermissions(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        if ($role->name === 'Super Admin') {
            Session::flash('error', 'Super Admin permissions cannot be modified.');
            return redirect('admin/roles');
        }

        $spatieRole = SpatieRole::where('name', $role->name)->where('guard_name', 'admin')->firstOrFail();

        $permissionObjects = Permission::where('guard_name', 'admin')
            ->whereIn('name', $request->input('permissions', []))
            ->get();

        $spatieRole->syncPermissions($permissionObjects);

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Session::flash('success', 'Permissions updated for ' . $role->name);
        return redirect('admin/roles');
    }
}
