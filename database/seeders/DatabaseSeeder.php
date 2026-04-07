<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles and permissions first
        $this->call(RoleAndPermissionSeeder::class);

        // Get roles
        $adminRole = \App\Models\Role::where('name', 'Admin')->first();
        $hrRole = \App\Models\Role::where('name', 'HR')->first();
        $employeeRole = \App\Models\Role::where('name', 'Employee')->first();

        // Create test users with different roles
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role_id' => $adminRole->id,
        ]);

        User::create([
            'name' => 'HR Manager',
            'email' => 'hr@example.com',
            'password' => bcrypt('password'),
            'role_id' => $hrRole->id,
        ]);

        User::factory(5)->create([
            'role_id' => $employeeRole->id,
        ]);
    }
}
