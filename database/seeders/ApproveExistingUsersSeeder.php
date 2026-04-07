<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class ApproveExistingUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Approve all existing Employee users
        User::whereHas('role', function($query) {
            $query->where('name', 'Employee');
        })->update(['is_approved' => true]);

        // Also approve existing Admin/HR/Superadmin users
        User::whereHas('role', function($query) {
            $query->whereIn('name', ['Admin', 'HR', 'Superadmin']);
        })->update(['is_approved' => true]);

        $this->command->info('All existing users have been approved.');
    }
}
