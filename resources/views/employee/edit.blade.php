@extends('layouts.dashboard')

@section('title', 'Edit Employee - HR Management System')

@section('content')
<div class="app-page-head d-flex flex-wrap gap-3 align-items-center justify-content-between">
  <div class="clearfix">
    <h1 class="app-page-title">Edit Employee</h1>
    <span>Update employee information</span>
  </div>
  <a href="{{ route('employees.index') }}" class="btn btn-outline-primary waves-effect waves-light">
    <i class="fi fi-rr-arrow-left me-1"></i> Back to Employees
  </a>
</div>

<form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  {{-- Section 1: Basic Information --}}
  <div class="card mb-4">
    <div class="card-header bg-primary text-white">
      <h5 class="mb-0"><i class="fi fi-rr-user me-2"></i>Basic Information</h5>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-4 mb-3">
          <label for="employee_id" class="form-label">Employee ID</label>
          <input type="text" class="form-control" id="employee_id" 
                 value="{{ $employee->employee_id ?? 'Auto Generated' }}" readonly disabled>
          <small class="text-muted">Auto-generated unique ID</small>
        </div>

        <div class="col-md-4 mb-3">
          <label for="name" class="form-label">Full Name *</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" 
                 id="name" name="name" value="{{ old('name', $employee->name) }}" required>
          @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-4 mb-3">
          <label for="email" class="form-label">Email *</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror" 
                 id="email" name="email" value="{{ old('email', $employee->email) }}" required>
          @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 mb-3">
          <label for="phone" class="form-label">Phone</label>
          <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                 id="phone" name="phone" value="{{ old('phone', $employee->phone) }}">
          @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-4 mb-3">
          <label for="date_of_birth" class="form-label">Date of Birth</label>
          <input type="date" class="form-control flatpickr-date @error('date_of_birth') is-invalid @enderror" 
                 id="date_of_birth" name="date_of_birth" 
                 value="{{ old('date_of_birth', $employee->date_of_birth?->format('Y-m-d')) }}">
          @error('date_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-4 mb-3">
          <label for="gender" class="form-label">Gender</label>
          <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender">
            <option value="">Select Gender</option>
            <option value="male" {{ old('gender', $employee->gender) == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('gender', $employee->gender) == 'female' ? 'selected' : '' }}>Female</option>
            <option value="other" {{ old('gender', $employee->gender) == 'other' ? 'selected' : '' }}>Other</option>
          </select>
          @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 mb-3">
          <label for="blood_group" class="form-label">Blood Group</label>
          <select class="form-select @error('blood_group') is-invalid @enderror" id="blood_group" name="blood_group">
            <option value="">Select Blood Group</option>
            <option value="A+" {{ old('blood_group', $employee->blood_group) == 'A+' ? 'selected' : '' }}>A+</option>
            <option value="A-" {{ old('blood_group', $employee->blood_group) == 'A-' ? 'selected' : '' }}>A-</option>
            <option value="B+" {{ old('blood_group', $employee->blood_group) == 'B+' ? 'selected' : '' }}>B+</option>
            <option value="B-" {{ old('blood_group', $employee->blood_group) == 'B-' ? 'selected' : '' }}>B-</option>
            <option value="AB+" {{ old('blood_group', $employee->blood_group) == 'AB+' ? 'selected' : '' }}>AB+</option>
            <option value="AB-" {{ old('blood_group', $employee->blood_group) == 'AB-' ? 'selected' : '' }}>AB-</option>
            <option value="O+" {{ old('blood_group', $employee->blood_group) == 'O+' ? 'selected' : '' }}>O+</option>
            <option value="O-" {{ old('blood_group', $employee->blood_group) == 'O-' ? 'selected' : '' }}>O-</option>
          </select>
          @error('blood_group')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-4 mb-3">
          <label for="emergency_contact_name" class="form-label">Emergency Contact Name</label>
          <input type="text" class="form-control @error('emergency_contact_name') is-invalid @enderror" 
                 id="emergency_contact_name" name="emergency_contact_name" 
                 value="{{ old('emergency_contact_name', $employee->emergency_contact_name) }}">
          @error('emergency_contact_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-4 mb-3">
          <label for="emergency_contact_phone" class="form-label">Emergency Contact Phone</label>
          <input type="text" class="form-control @error('emergency_contact_phone') is-invalid @enderror" 
                 id="emergency_contact_phone" name="emergency_contact_phone" 
                 value="{{ old('emergency_contact_phone', $employee->emergency_contact_phone) }}">
          @error('emergency_contact_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 mb-3">
          <label for="photo" class="form-label">Photo</label>
          @if($employee->photo)
            <div class="mb-2">
              <img src="{{ asset('storage/' . $employee->photo) }}" alt="Employee Photo" 
                   class="img-thumbnail" style="max-width: 100px;">
            </div>
          @endif
          <input type="file" class="form-control @error('photo') is-invalid @enderror" 
                 id="photo" name="photo" accept="image/*">
          @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
          <small class="text-muted">Supported: JPG, PNG, GIF (Max 2MB)</small>
        </div>
      </div>
    </div>
  </div>

  {{-- Section 2: Job Information --}}
  <div class="card mb-4">
    <div class="card-header bg-success text-white">
      <h5 class="mb-0"><i class="fi fi-rr-briefcase me-2"></i>Job Information</h5>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-4 mb-3">
          <label for="department" class="form-label">Department *</label>
          <input type="text" class="form-control @error('department') is-invalid @enderror" 
                 id="department" name="department" value="{{ old('department', $employee->department) }}" required>
          @error('department')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-4 mb-3">
          <label for="position" class="form-label">Designation *</label>
          <input type="text" class="form-control @error('position') is-invalid @enderror" 
                 id="position" name="position" value="{{ old('position', $employee->position) }}" required>
          @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-4 mb-3">
          <label for="employment_type" class="form-label">Employment Type *</label>
          <select class="form-select @error('employment_type') is-invalid @enderror" 
                  id="employment_type" name="employment_type" required>
            <option value="full-time" {{ old('employment_type', $employee->employment_type) == 'full-time' ? 'selected' : '' }}>Full-Time</option>
            <option value="part-time" {{ old('employment_type', $employee->employment_type) == 'part-time' ? 'selected' : '' }}>Part-Time</option>
            <option value="contract" {{ old('employment_type', $employee->employment_type) == 'contract' ? 'selected' : '' }}>Contract</option>
            <option value="intern" {{ old('employment_type', $employee->employment_type) == 'intern' ? 'selected' : '' }}>Intern</option>
          </select>
          @error('employment_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 mb-3">
          <label for="work_shift" class="form-label">Work Shift *</label>
          <select class="form-select @error('work_shift') is-invalid @enderror" 
                  id="work_shift" name="work_shift" required>
            <option value="morning" {{ old('work_shift', $employee->work_shift) == 'morning' ? 'selected' : '' }}>Morning</option>
            <option value="evening" {{ old('work_shift', $employee->work_shift) == 'evening' ? 'selected' : '' }}>Evening</option>
            <option value="night" {{ old('work_shift', $employee->work_shift) == 'night' ? 'selected' : '' }}>Night</option>
          </select>
          @error('work_shift')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-4 mb-3">
          <label for="hire_date" class="form-label">Joining Date *</label>
          <input type="date" class="form-control flatpickr-date @error('hire_date') is-invalid @enderror" 
                 id="hire_date" name="hire_date" 
                 value="{{ old('hire_date', $employee->hire_date?->format('Y-m-d')) }}" required>
          @error('hire_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-4 mb-3">
          <label for="confirmation_date" class="form-label">Confirmation Date</label>
          <input type="date" class="form-control flatpickr-date @error('confirmation_date') is-invalid @enderror" 
                 id="confirmation_date" name="confirmation_date" 
                 value="{{ old('confirmation_date', $employee->confirmation_date?->format('Y-m-d')) }}">
          @error('confirmation_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
          <small class="text-muted">After probation period ends</small>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 mb-3">
          <label for="salary" class="form-label">Basic Salary</label>
          <input type="number" class="form-control @error('salary') is-invalid @enderror" 
                 id="salary" name="salary" value="{{ old('salary', $employee->salary) }}" step="0.01">
          @error('salary')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-4 mb-3">
          <label for="salary_type" class="form-label">Salary Type</label>
          <select class="form-select @error('salary_type') is-invalid @enderror" 
                  id="salary_type" name="salary_type">
            <option value="monthly" {{ old('salary_type', $employee->salary_type) == 'monthly' ? 'selected' : '' }}>Monthly</option>
            <option value="hourly" {{ old('salary_type', $employee->salary_type) == 'hourly' ? 'selected' : '' }}>Hourly</option>
          </select>
          @error('salary_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-4 mb-3">
          <label for="status" class="form-label">Status *</label>
          <select class="form-select @error('status') is-invalid @enderror" 
                  id="status" name="status" required>
            <option value="active" {{ old('status', $employee->status) == 'active' ? 'selected' : '' }}>Active</option>
            <option value="on_leave" {{ old('status', $employee->status) == 'on_leave' ? 'selected' : '' }}>On Leave</option>
            <option value="inactive" {{ old('status', $employee->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
          </select>
          @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 mb-3">
          <label for="reporting_manager_id" class="form-label">Reporting Manager</label>
          <select class="form-select @error('reporting_manager_id') is-invalid @enderror" 
                  id="reporting_manager_id" name="reporting_manager_id">
            <option value="">Select Manager</option>
            @foreach($managers as $manager)
              @if($manager->id != $employee->id)
                <option value="{{ $manager->id }}" 
                  {{ old('reporting_manager_id', $employee->reporting_manager_id) == $manager->id ? 'selected' : '' }}>
                  {{ $manager->name }} ({{ $manager->position }})
                </option>
              @endif
            @endforeach
          </select>
          @error('reporting_manager_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-4 mb-3">
          <label for="work_location" class="form-label">Work Location</label>
          <input type="text" class="form-control @error('work_location') is-invalid @enderror" 
                 id="work_location" name="work_location" 
                 value="{{ old('work_location', $employee->work_location) }}"
                 placeholder="e.g., Head Office, Branch Name">
          @error('work_location')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
      </div>
    </div>
  </div>

  {{-- Section 3: Present Address --}}
  <div class="card mb-4">
    <div class="card-header bg-info text-white">
      <h5 class="mb-0"><i class="fi fi-rr-marker me-2"></i>Present Address</h5>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12 mb-3">
          <label for="address" class="form-label">Address</label>
          <textarea class="form-control @error('address') is-invalid @enderror" 
                    id="address" name="address" rows="2">{{ old('address', $employee->address) }}</textarea>
          @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md-3 mb-3">
          <label for="city" class="form-label">City</label>
          <input type="text" class="form-control @error('city') is-invalid @enderror" 
                 id="city" name="city" value="{{ old('city', $employee->city) }}">
          @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-3 mb-3">
          <label for="state" class="form-label">State / Division</label>
          <input type="text" class="form-control @error('state') is-invalid @enderror" 
                 id="state" name="state" value="{{ old('state', $employee->state) }}">
          @error('state')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-3 mb-3">
          <label for="zip_code" class="form-label">Zip / Postal Code</label>
          <input type="text" class="form-control @error('zip_code') is-invalid @enderror" 
                 id="zip_code" name="zip_code" value="{{ old('zip_code', $employee->zip_code) }}">
          @error('zip_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-3 mb-3">
          <label for="country" class="form-label">Country</label>
          <select class="form-select @error('country') is-invalid @enderror" id="country" name="country">
            <option value="">Select Country</option>
            <option value="Bangladesh" {{ old('country', $employee->country) == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
            <option value="India" {{ old('country', $employee->country) == 'India' ? 'selected' : '' }}>India</option>
            <option value="Pakistan" {{ old('country', $employee->country) == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
            <option value="Nepal" {{ old('country', $employee->country) == 'Nepal' ? 'selected' : '' }}>Nepal</option>
            <option value="Sri Lanka" {{ old('country', $employee->country) == 'Sri Lanka' ? 'selected' : '' }}>Sri Lanka</option>
            <option value="United States" {{ old('country', $employee->country) == 'United States' ? 'selected' : '' }}>United States</option>
            <option value="United Kingdom" {{ old('country', $employee->country) == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
            <option value="Canada" {{ old('country', $employee->country) == 'Canada' ? 'selected' : '' }}>Canada</option>
            <option value="Australia" {{ old('country', $employee->country) == 'Australia' ? 'selected' : '' }}>Australia</option>
            <option value="Germany" {{ old('country', $employee->country) == 'Germany' ? 'selected' : '' }}>Germany</option>
            <option value="France" {{ old('country', $employee->country) == 'France' ? 'selected' : '' }}>France</option>
            <option value="United Arab Emirates" {{ old('country', $employee->country) == 'United Arab Emirates' ? 'selected' : '' }}>United Arab Emirates</option>
            <option value="Saudi Arabia" {{ old('country', $employee->country) == 'Saudi Arabia' ? 'selected' : '' }}>Saudi Arabia</option>
            <option value="Malaysia" {{ old('country', $employee->country) == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
            <option value="Singapore" {{ old('country', $employee->country) == 'Singapore' ? 'selected' : '' }}>Singapore</option>
            <option value="Other" {{ old('country', $employee->country) == 'Other' ? 'selected' : '' }}>Other</option>
          </select>
          @error('country')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
      </div>
    </div>
  </div>

  {{-- Section 4: Permanent Address --}}
  <div class="card mb-4">
    <div class="card-header bg-secondary text-white">
      <h5 class="mb-0">
        <i class="fi fi-rr-home me-2"></i>Permanent Address
        <div class="form-check form-switch d-inline-block ms-3">
          <input class="form-check-input" type="checkbox" id="same_as_present" 
                 onchange="togglePermanentAddress()">
          <label class="form-check-label small" for="same_as_present">Same as Present Address</label>
        </div>
      </h5>
    </div>
    <div class="card-body" id="permanent_address_section">
      <div class="row">
        <div class="col-md-12 mb-3">
          <label for="permanent_address" class="form-label">Address</label>
          <textarea class="form-control @error('permanent_address') is-invalid @enderror" 
                    id="permanent_address" name="permanent_address" rows="2">{{ old('permanent_address', $employee->permanent_address) }}</textarea>
          @error('permanent_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md-3 mb-3">
          <label for="permanent_city" class="form-label">City</label>
          <input type="text" class="form-control @error('permanent_city') is-invalid @enderror" 
                 id="permanent_city" name="permanent_city" 
                 value="{{ old('permanent_city', $employee->permanent_city) }}">
          @error('permanent_city')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-3 mb-3">
          <label for="permanent_state" class="form-label">State / Division</label>
          <input type="text" class="form-control @error('permanent_state') is-invalid @enderror" 
                 id="permanent_state" name="permanent_state" 
                 value="{{ old('permanent_state', $employee->permanent_state) }}">
          @error('permanent_state')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-3 mb-3">
          <label for="permanent_zip_code" class="form-label">Zip / Postal Code</label>
          <input type="text" class="form-control @error('permanent_zip_code') is-invalid @enderror" 
                 id="permanent_zip_code" name="permanent_zip_code" 
                 value="{{ old('permanent_zip_code', $employee->permanent_zip_code) }}">
          @error('permanent_zip_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-3 mb-3">
          <label for="permanent_country" class="form-label">Country</label>
          <select class="form-select @error('permanent_country') is-invalid @enderror" 
                  id="permanent_country" name="permanent_country">
            <option value="">Select Country</option>
            <option value="Bangladesh" {{ old('permanent_country', $employee->permanent_country) == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
            <option value="India" {{ old('permanent_country', $employee->permanent_country) == 'India' ? 'selected' : '' }}>India</option>
            <option value="Pakistan" {{ old('permanent_country', $employee->permanent_country) == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
            <option value="Nepal" {{ old('permanent_country', $employee->permanent_country) == 'Nepal' ? 'selected' : '' }}>Nepal</option>
            <option value="Sri Lanka" {{ old('permanent_country', $employee->permanent_country) == 'Sri Lanka' ? 'selected' : '' }}>Sri Lanka</option>
            <option value="United States" {{ old('permanent_country', $employee->permanent_country) == 'United States' ? 'selected' : '' }}>United States</option>
            <option value="United Kingdom" {{ old('permanent_country', $employee->permanent_country) == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
            <option value="Canada" {{ old('permanent_country', $employee->permanent_country) == 'Canada' ? 'selected' : '' }}>Canada</option>
            <option value="Australia" {{ old('permanent_country', $employee->permanent_country) == 'Australia' ? 'selected' : '' }}>Australia</option>
            <option value="Germany" {{ old('permanent_country', $employee->permanent_country) == 'Germany' ? 'selected' : '' }}>Germany</option>
            <option value="France" {{ old('permanent_country', $employee->permanent_country) == 'France' ? 'selected' : '' }}>France</option>
            <option value="United Arab Emirates" {{ old('permanent_country', $employee->permanent_country) == 'United Arab Emirates' ? 'selected' : '' }}>United Arab Emirates</option>
            <option value="Saudi Arabia" {{ old('permanent_country', $employee->permanent_country) == 'Saudi Arabia' ? 'selected' : '' }}>Saudi Arabia</option>
            <option value="Malaysia" {{ old('permanent_country', $employee->permanent_country) == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
            <option value="Singapore" {{ old('permanent_country', $employee->permanent_country) == 'Singapore' ? 'selected' : '' }}>Singapore</option>
            <option value="Other" {{ old('permanent_country', $employee->permanent_country) == 'Other' ? 'selected' : '' }}>Other</option>
          </select>
          @error('permanent_country')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
      </div>
    </div>
  </div>

  {{-- Section 5: System & Login Information --}}
  @if($employee->user)
  <div class="card mb-4">
    <div class="card-header bg-warning text-dark">
      <h5 class="mb-0"><i class="fi fi-rr-lock me-2"></i>System & Login Information</h5>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-4 mb-3">
          <label for="role_display" class="form-label">Role</label>
          <input type="text" class="form-control" id="role_display" 
                 value="{{ $employee->user->role->name ?? 'N/A' }}" readonly disabled>
        </div>

        <div class="col-md-4 mb-3">
          <label for="login_email" class="form-label">Login Email</label>
          <input type="email" class="form-control" id="login_email" 
                 value="{{ $employee->user->email }}" readonly disabled>
        </div>

        <div class="col-md-4 mb-3">
          <label for="account_status" class="form-label">Account Status</label>
          <input type="text" class="form-control" id="account_status" 
                 value="{{ $employee->user->is_approved ? 'Approved' : 'Pending' }}" readonly disabled>
        </div>
      </div>
      <small class="text-muted">
        <i class="fi fi-rr-info me-1"></i>
        To change login credentials or role, please go to User Management section.
      </small>
    </div>
  </div>
  @endif

  {{-- Section 6: Document Uploads --}}
  <div class="card mb-4">
    <div class="card-header bg-dark text-white">
      <h5 class="mb-0"><i class="fi fi-rr-folder me-2"></i>Document Uploads</h5>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="cv_file" class="form-label">CV / Resume</label>
          @if($employee->cv_file)
            <div class="mb-2">
              <a href="{{ asset('storage/' . $employee->cv_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                <i class="fi fi-rr-eye me-1"></i>View Current CV
              </a>
            </div>
          @endif
          <input type="file" class="form-control @error('cv_file') is-invalid @enderror" 
                 id="cv_file" name="cv_file" accept=".pdf,.doc,.docx">
          @error('cv_file')<div class="invalid-feedback">{{ $message }}</div>@enderror
          <small class="text-muted">PDF, DOC, DOCX (Max 5MB)</small>
        </div>

        <div class="col-md-6 mb-3">
          <label for="nid_file" class="form-label">NID Copy</label>
          @if($employee->nid_file)
            <div class="mb-2">
              <a href="{{ asset('storage/' . $employee->nid_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                <i class="fi fi-rr-eye me-1"></i>View Current NID
              </a>
            </div>
          @endif
          <input type="file" class="form-control @error('nid_file') is-invalid @enderror" 
                 id="nid_file" name="nid_file" accept=".pdf,.jpg,.jpeg,.png">
          @error('nid_file')<div class="invalid-feedback">{{ $message }}</div>@enderror
          <small class="text-muted">PDF, JPG, PNG (Max 5MB)</small>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="appointment_letter_file" class="form-label">Appointment Letter</label>
          @if($employee->appointment_letter_file)
            <div class="mb-2">
              <a href="{{ asset('storage/' . $employee->appointment_letter_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                <i class="fi fi-rr-eye me-1"></i>View Current
              </a>
            </div>
          @endif
          <input type="file" class="form-control @error('appointment_letter_file') is-invalid @enderror" 
                 id="appointment_letter_file" name="appointment_letter_file" accept=".pdf,.doc,.docx">
          @error('appointment_letter_file')<div class="invalid-feedback">{{ $message }}</div>@enderror
          <small class="text-muted">PDF, DOC, DOCX (Max 5MB)</small>
        </div>

        <div class="col-md-6 mb-3">
          <label for="offer_letter_file" class="form-label">Offer Letter</label>
          @if($employee->offer_letter_file)
            <div class="mb-2">
              <a href="{{ asset('storage/' . $employee->offer_letter_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                <i class="fi fi-rr-eye me-1"></i>View Current
              </a>
            </div>
          @endif
          <input type="file" class="form-control @error('offer_letter_file') is-invalid @enderror" 
                 id="offer_letter_file" name="offer_letter_file" accept=".pdf,.doc,.docx">
          @error('offer_letter_file')<div class="invalid-feedback">{{ $message }}</div>@enderror
          <small class="text-muted">PDF, DOC, DOCX (Max 5MB)</small>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="academic_certificate_file" class="form-label">Academic Certificate</label>
          @if($employee->academic_certificate_file)
            <div class="mb-2">
              <a href="{{ asset('storage/' . $employee->academic_certificate_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                <i class="fi fi-rr-eye me-1"></i>View Current
              </a>
            </div>
          @endif
          <input type="file" class="form-control @error('academic_certificate_file') is-invalid @enderror" 
                 id="academic_certificate_file" name="academic_certificate_file" accept=".pdf,.jpg,.jpeg,.png">
          @error('academic_certificate_file')<div class="invalid-feedback">{{ $message }}</div>@enderror
          <small class="text-muted">PDF, JPG, PNG (Max 5MB)</small>
        </div>
      </div>
    </div>
  </div>

  {{-- Submit Buttons --}}
  <div class="card">
    <div class="card-body d-flex gap-2">
      <button type="submit" class="btn btn-primary waves-effect waves-light">
        <i class="fi fi-rr-save me-1"></i> Update Employee
      </button>
      <a href="{{ route('employees.index') }}" class="btn btn-secondary waves-effect waves-light">Cancel</a>
    </div>
  </div>
</form>

@endsection

@push('scripts')
<script>
function togglePermanentAddress() {
  const checkbox = document.getElementById('same_as_present');
  const section = document.getElementById('permanent_address_section');
  const inputs = section.querySelectorAll('input, textarea, select');
  
  if (checkbox.checked) {
    // Copy present address values to permanent address
    document.getElementById('permanent_address').value = document.getElementById('address').value;
    document.getElementById('permanent_city').value = document.getElementById('city').value;
    document.getElementById('permanent_state').value = document.getElementById('state').value;
    document.getElementById('permanent_zip_code').value = document.getElementById('zip_code').value;
    document.getElementById('permanent_country').value = document.getElementById('country').value;
    
    // Disable inputs
    inputs.forEach(input => input.disabled = true);
  } else {
    // Enable inputs
    inputs.forEach(input => input.disabled = false);
  }
}

// Sync address when present address changes and checkbox is checked
['address', 'city', 'state', 'zip_code', 'country'].forEach(field => {
  document.getElementById(field)?.addEventListener('input', function() {
    if (document.getElementById('same_as_present').checked) {
      document.getElementById('permanent_' + field).value = this.value;
    }
  });
});
</script>
@endpush
