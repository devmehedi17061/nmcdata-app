<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get employee statistics
        $totalEmployees = Employee::count();
        $activeEmployees = Employee::where('status', 'active')->count();
        $employeesOnLeave = Employee::where('status', 'on_leave')->count();
        $inactiveEmployees = $totalEmployees - $activeEmployees - $employeesOnLeave;
        
        // Get new employees (created in the last 30 days)
        $newEmployees = Employee::where('created_at', '>=', now()->subDays(30))->count();
        
        // Get recent employees
        $employees = Employee::latest()->limit(5)->get();
        
        // Calculate percentage changes (you can adjust the calculation logic as needed)
        $employeeGrowthPercentage = $totalEmployees > 0 ? 5 : 0; // Example percentage
        $newEmployeePercentage = $newEmployees > 0 ? 3.2 : 0; // Example percentage
        $leavePercentage = $employeesOnLeave > 0 ? 2 : 0; // Example percentage

        return view('dashboard.index', [
            'totalEmployees' => $totalEmployees,
            'activeEmployees' => $activeEmployees,
            'employeesOnLeave' => $employeesOnLeave,
            'inactiveEmployees' => $inactiveEmployees,
            'newEmployees' => $newEmployees,
            'recentEmployees' => $employees,
            'employeeGrowthPercentage' => $employeeGrowthPercentage,
            'newEmployeePercentage' => $newEmployeePercentage,
            'leavePercentage' => $leavePercentage,
        ]);
    }
}
