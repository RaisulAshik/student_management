<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Admin;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions for admin guard
        $adminPermissions = [
            'view-dashboard',
            'view-students',
            'create-students',
            'edit-students',
            'delete-students',
            'view-student-payments',
            'view-online-students',
            'create-online-students',
            'edit-online-students',
            'delete-online-students',
            'view-offline-students',
            'create-offline-students',
            'edit-offline-students',
            'delete-offline-students',
            'manage-classes',
            'manage-subjects',
            'manage-branches',
            'manage-batches',
            'manage-mcq-exams',
            'view-mcq-results',
            'manage-cq-exams',
            'view-cq-results',
            'evaluate-cq-exams',
            'evaluate-homework',
            'view-homework',
            'manage-zoom-classes',
            'view-attendance',
            'submit-attendance',
            'manage-contents',
            'manage-lecture-sheets',
            'view-teachers',
            'create-teachers',
            'edit-teachers',
            'delete-teachers',
            'manage-teacher-payments',
            'view-admins',
            'create-admins',
            'edit-admins',
            'delete-admins',
            'view-payments',
            'approve-online-payments',
            'manage-offline-payments',
            'view-expenses',
            'create-expenses',
            'edit-expenses',
            'delete-expenses',
            'manage-expense-heads',
            'manage-expense-categories',
            'send-messages',
            'send-sms',
            'send-due-sms',
            'view-expense-reports',
            'manage-roles',
            'manage-company-details',
            'manage-zoom-api',
            'manage-instructions',
        ];

        echo "Creating permissions...\n";
        foreach ($adminPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'admin'
            ]);
            echo "✓ {$permission}\n";
        }

        echo "\nCreating roles...\n";
        
        // Create Super Admin role with all permissions
        $superAdmin = Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'admin'
        ]);
        $superAdmin->syncPermissions(Permission::where('guard_name', 'admin')->get());
        echo "✓ Super Admin role created\n";

        // Create Admin role with limited permissions
        $admin = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'admin'
        ]);
        $admin->syncPermissions([
            'view-dashboard',
            'view-students',
            'view-online-students',
            'view-offline-students',
            'view-student-payments',
            'manage-classes',
            'manage-subjects',
            'manage-branches',
            'manage-batches',
            'view-homework',
            'evaluate-homework',
            'view-mcq-results',
            'view-cq-results',
        ]);
        echo "✓ Admin role created\n";

        // Create Accountant role
        $accountant = Role::firstOrCreate([
            'name' => 'Accountant',
            'guard_name' => 'admin'
        ]);
        $accountant->syncPermissions([
            'view-dashboard',
            'view-students',
            'view-student-payments',
            'view-payments',
            'approve-online-payments',
            'manage-offline-payments',
            'view-expenses',
            'create-expenses',
            'edit-expenses',
            'view-expense-reports',
        ]);
        
        // Assign Super Admin role to all existing admins
        $admins = Admin::all();
        foreach ($admins as $adminUser) {
            // Remove old roles first
            $adminUser->roles()->detach();
            
            // Assign Super Admin role
            $adminUser->assignRole('Super Admin');
            echo "✓ Assigned Super Admin to: {$adminUser->name} ({$adminUser->email})\n";
        }
    }
}