<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Employee;

class ProfileController extends Controller
{
    /**
     * Show the user's profile
     */
    public function show()
    {
        $user = Auth::user();
        $employee = $user->employee;
        
        return view('profile.show', compact('user', 'employee'));
    }

    /**
     * Show the edit profile form
     */
    public function edit()
    {
        $user = Auth::user();
        $employee = $user->employee;
        
        return view('profile.edit', compact('user', 'employee'));
    }

    /**
     * Update the user's profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $employee = $user->employee;

        // Validate user fields
        $userRules = [
            'name' => 'required|string|max:255',
        ];

        // Validate employee fields if employee exists
        $employeeRules = [];
        if ($employee) {
            $employeeRules = [
                'phone' => 'nullable|string|max:20',
                'date_of_birth' => 'nullable|date',
                'gender' => 'nullable|in:male,female,other',
                'blood_group' => 'nullable|string|max:5',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'emergency_contact_name' => 'nullable|string|max:255',
                'emergency_contact_phone' => 'nullable|string|max:20',
                
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
            ];
        }

        $validated = $request->validate(array_merge($userRules, $employeeRules));

        // Update user name
        $user->name = $validated['name'];
        $user->save();

        // Update employee data if exists
        if ($employee) {
            // Handle photo upload
            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($employee->photo) {
                    Storage::disk('public')->delete($employee->photo);
                }
                $validated['photo'] = $request->file('photo')->store('employees/photo', 'public');
            }
            
            // Also update employee name
            $validated['name'] = $validated['name'];
            
            $employee->update($validated);
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }
}
