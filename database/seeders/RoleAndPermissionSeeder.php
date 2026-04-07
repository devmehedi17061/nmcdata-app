<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Permissions
        $permissions = [
            // Dashboard
            ['name' => 'view_dashboard', 'description' => 'View Dashboard', 'module' => 'dashboard'],
            
            // Employee
            ['name' => 'view_employees', 'description' => 'View Employees', 'module' => 'employee'],
            ['name' => 'create_employee', 'description' => 'Create Employee', 'module' => 'employee'],
            ['name' => 'edit_employee', 'description' => 'Edit Employee', 'module' => 'employee'],
            ['name' => 'delete_employee', 'description' => 'Delete Employee', 'module' => 'employee'],
            
            // Role
            ['name' => 'view_roles', 'description' => 'View Roles', 'module' => 'role'],
            ['name' => 'create_role', 'description' => 'Create Role', 'module' => 'role'],
            ['name' => 'edit_role', 'description' => 'Edit Role', 'module' => 'role'],
            ['name' => 'delete_role', 'description' => 'Delete Role', 'module' => 'role'],
            ['name' => 'assign_permissions', 'description' => 'Assign Permissions', 'module' => 'role'],
            
            // Permission
            ['name' => 'view_permissions', 'description' => 'View Permissions', 'module' => 'permission'],
            ['name' => 'create_permission', 'description' => 'Create Permission', 'module' => 'permission'],
            ['name' => 'edit_permission', 'description' => 'Edit Permission', 'module' => 'permission'],
            ['name' => 'delete_permission', 'description' => 'Delete Permission', 'module' => 'permission'],

            // User Approval
            ['name' => 'view_pending_users', 'description' => 'View Pending Users', 'module' => 'approval'],
            ['name' => 'approve_users', 'description' => 'Approve Users', 'module' => 'approval'],
            ['name' => 'reject_users', 'description' => 'Reject Users', 'module' => 'approval'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission['name']], $permission);
        }

        // Create Roles and assign permissions
        $superadminRole = Role::firstOrCreate(
            ['name' => 'Superadmin'],
            ['description' => 'Super Administrator with full access including user approval']
        );

        $adminRole = Role::firstOrCreate(
            ['name' => 'Admin'],
            ['description' => 'Administrator with full access']
        );

        $hrRole = Role::firstOrCreate(
            ['name' => 'HR'],
            ['description' => 'HR Manager']
        );

        $employeeRole = Role::firstOrCreate(
            ['name' => 'Employee'],
            ['description' => 'Regular Employee']
        );

        // Assign all permissions to Superadmin
        $allPermissions = Permission::all()->pluck('id')->toArray();
        $superadminRole->permissions()->sync($allPermissions);

        // Assign all permissions to Admin (except approval)
        $adminPermissions = Permission::whereNotIn('name', [
            'approve_users',
            'reject_users',
            'view_pending_users',
        ])->pluck('id')->toArray();
        $adminRole->permissions()->sync($adminPermissions);

        // Assign HR permissions
        $hrPermissions = Permission::whereIn('name', [
            'view_dashboard',
            'view_employees',
            'create_employee',
            'edit_employee',
            'view_roles',
            'assign_permissions',
            'view_permissions',
        ])->pluck('id')->toArray();
        $hrRole->permissions()->sync($hrPermissions);

        // Assign Employee permissions
        $employeePermissions = Permission::whereIn('name', [
            'view_dashboard',
        ])->pluck('id')->toArray();
        $employeeRole->permissions()->sync($employeePermissions);
    }
}
