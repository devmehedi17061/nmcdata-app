<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::paginate(10);
        return view('employee.index', ['employees' => $employees]);
    }

    public function create()
    {
        $managers = Employee::where('status', 'active')->get();
        return view('employee.create', ['managers' => $managers]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Login Credentials
            'password' => 'required|string|min:8|confirmed',
            
            // Basic Information
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'blood_group' => 'nullable|string|max:5',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            
            // Job Information
            'position' => 'required|string',
            'department' => 'required|string',
            'employment_type' => 'required|in:full-time,part-time,contract,intern',
            'work_shift' => 'required|in:morning,evening,night',
            'hire_date' => 'required|date',
            'confirmation_date' => 'nullable|date',
            'salary' => 'nullable|numeric',
            'salary_type' => 'nullable|in:monthly,hourly',
            'reporting_manager_id' => 'nullable|exists:employees,id',
            'work_location' => 'nullable|string|max:255',
            'status' => 'nullable|in:active,inactive,on_leave',
            
            // Present Address
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'zip_code' => 'nullable|string',
            'country' => 'nullable|string',
            
            // Permanent Address
            'permanent_address' => 'nullable|string',
            'permanent_city' => 'nullable|string',
            'permanent_state' => 'nullable|string',
            'permanent_zip_code' => 'nullable|string',
            'permanent_country' => 'nullable|string',
            
            // Document Uploads
            'cv_file' => 'nullable|mimes:pdf,doc,docx|max:5120',
            'nid_file' => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120',
            'appointment_letter_file' => 'nullable|mimes:pdf,doc,docx|max:5120',
            'offer_letter_file' => 'nullable|mimes:pdf,doc,docx|max:5120',
            'academic_certificate_file' => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // Handle file uploads
        $fileFields = ['photo', 'cv_file', 'nid_file', 'appointment_letter_file', 'offer_letter_file', 'academic_certificate_file'];
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store('employees/' . $field, 'public');
            }
        }

        // Use transaction to ensure both User and Employee are created
        DB::transaction(function () use ($validated) {
            // Get the Employee role
            $employeeRole = Role::where('name', 'Employee')->first();
            
            // Create User account for the employee
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role_id' => $employeeRole ? $employeeRole->id : null,
                'is_approved' => true, // Auto-approve employees
            ]);
            
            // Remove password from validated data as it's not an employee field
            unset($validated['password']);
            
            // Add user_id to link employee with user
            $validated['user_id'] = $user->id;
            
            // Create employee
            Employee::create($validated);
        });
        
        return redirect('/employees')->with('success', 'Employee created successfully');
    }

    public function show(Employee $employee)
    {
        return view('employee.show', ['employee' => $employee]);
    }

    public function edit(Employee $employee)
    {
        $managers = Employee::where('status', 'active')->get();
        return view('employee.edit', [
            'employee' => $employee,
            'managers' => $managers
        ]);
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            // Basic Information
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'blood_group' => 'nullable|string|max:5',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            
            // Job Information
            'position' => 'required|string',
            'department' => 'required|string',
            'employment_type' => 'required|in:full-time,part-time,contract,intern',
            'work_shift' => 'required|in:morning,evening,night',
            'hire_date' => 'required|date',
            'confirmation_date' => 'nullable|date',
            'salary' => 'nullable|numeric',
            'salary_type' => 'nullable|in:monthly,hourly',
            'reporting_manager_id' => 'nullable|exists:employees,id',
            'work_location' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive,on_leave',
            
            // Present Address
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'zip_code' => 'nullable|string',
            'country' => 'nullable|string',
            
            // Permanent Address
            'permanent_address' => 'nullable|string',
            'permanent_city' => 'nullable|string',
            'permanent_state' => 'nullable|string',
            'permanent_zip_code' => 'nullable|string',
            'permanent_country' => 'nullable|string',
            
            // Document Uploads
            'cv_file' => 'nullable|mimes:pdf,doc,docx|max:5120',
            'nid_file' => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120',
            'appointment_letter_file' => 'nullable|mimes:pdf,doc,docx|max:5120',
            'offer_letter_file' => 'nullable|mimes:pdf,doc,docx|max:5120',
            'academic_certificate_file' => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // Handle file uploads
        $fileFields = ['photo', 'cv_file', 'nid_file', 'appointment_letter_file', 'offer_letter_file', 'academic_certificate_file'];
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                // Delete old file if exists
                if ($employee->$field) {
                    Storage::disk('public')->delete($employee->$field);
                }
                $validated[$field] = $request->file($field)->store('employees/' . $field, 'public');
            }
        }

        $employee->update($validated);

        // Sync the linked user's name and email if they changed
        if ($employee->user) {
            $employee->user->update([
                'name'  => $validated['name'],
                'email' => $validated['email'],
            ]);
        }

        return redirect()->route('employees.show', $employee->id)
            ->with('success', 'Employee updated successfully');
    }

    public function destroy(Employee $employee)
    {
        // Delete associated files
        $fileFields = ['photo', 'cv_file', 'nid_file', 'appointment_letter_file', 'offer_letter_file', 'academic_certificate_file'];
        foreach ($fileFields as $field) {
            if ($employee->$field) {
                Storage::disk('public')->delete($employee->$field);
            }
        }
        
        $employee->delete();
        return redirect('/employees')->with('success', 'Employee deleted successfully');
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $employees = Employee::where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->orWhere('position', 'LIKE', "%{$query}%")
            ->orWhere('employee_id', 'LIKE', "%{$query}%")
            ->paginate(10);

        return view('employee.index', ['employees' => $employees]);
    }
}
