@extends('layouts.dashboard')

@section('title', 'Employee Details - HR Management System')

@section('content')
{{-- Page Breadcrumb --}}
<div class="app-page-head d-flex flex-wrap gap-3 align-items-center justify-content-between mb-3">
  <div class="clearfix">
    <h1 class="app-page-title">Employee Details</h1>
    <span class="text-muted">View complete employee information</span>
  </div>
  <div class="d-flex gap-2">
    @if(Auth::user()->isSuperAdmin() || Auth::user()->isAdmin() || Auth::user()->isHR())
      <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning waves-effect waves-light">
        <i class="fi fi-rr-pencil me-1"></i> Edit
      </a>
    @endif
    <a href="{{ route('employees.index') }}" class="btn btn-outline-primary waves-effect waves-light">
      <i class="fi fi-rr-arrow-left me-1"></i> Back
    </a>
  </div>
</div>

{{-- ===== PROFILE HEADER BLOCK ===== --}}
<div class="card mb-4">
  <div class="card-body p-4">
    <div class="d-flex flex-wrap gap-4 align-items-center">

      {{-- Photo --}}
      <div class="flex-shrink-0 text-center">
        @if($employee->photo)
          <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->name }}"
               class="rounded-circle"
               style="width:120px;height:120px;object-fit:cover;border:4px solid #e9ecef;">
        @else
          <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center"
               style="width:120px;height:120px;font-size:42px;color:white;">
            {{ strtoupper(substr($employee->name, 0, 1)) }}
          </div>
        @endif
        <span class="badge bg-{{ $employee->status === 'active' ? 'success' : ($employee->status === 'on_leave' ? 'warning' : 'danger') }} mt-2 px-3 py-1 d-block">
          {{ ucfirst(str_replace('_', ' ', $employee->status)) }}
        </span>
      </div>

      {{-- Core Info --}}
      <div class="flex-grow-1">
        <h3 class="mb-0 fw-bold">{{ $employee->name }}</h3>
        <p class="text-primary fw-semibold mb-2">
          <i class="fi fi-rr-briefcase me-1"></i>{{ $employee->position }}
          <span class="text-muted fw-normal mx-1">|</span>
          <i class="fi fi-rr-building me-1"></i>{{ $employee->department }}
        </p>

        <div class="row g-2 mt-1">
          <div class="col-auto">
            <span class="badge bg-light text-dark border px-3 py-2">
              <i class="fi fi-rr-id-badge me-1"></i>
              {{ $employee->employee_id ?? 'EMP-' . str_pad($employee->id, 4, '0', STR_PAD_LEFT) }}
            </span>
          </div>
          @if($employee->hire_date)
            <div class="col-auto">
              <span class="badge bg-light text-dark border px-3 py-2">
                <i class="fi fi-rr-calendar me-1"></i>
                Joined {{ $employee->hire_date->format('M d, Y') }}
                <span class="text-muted ms-1">({{ now()->diffInYears($employee->hire_date) }}y)</span>
              </span>
            </div>
          @endif
          @if($employee->gender)
            <div class="col-auto">
              <span class="badge bg-light text-dark border px-3 py-2">
                <i class="fi fi-rr-venus-mars me-1"></i>{{ ucfirst($employee->gender) }}
              </span>
            </div>
          @endif
          @if($employee->blood_group)
            <div class="col-auto">
              <span class="badge bg-danger bg-opacity-10 text-danger border px-3 py-2">
                <i class="fi fi-rr-heart me-1"></i>{{ $employee->blood_group }}
              </span>
            </div>
          @endif
        </div>
      </div>

      {{-- Quick Contact --}}
      <div class="border-start ps-4 flex-shrink-0">
        <p class="mb-2">
          <i class="fi fi-rr-envelope me-2 text-muted"></i>
          <span class="fw-medium">{{ $employee->email }}</span>
        </p>
        <p class="mb-2">
          <i class="fi fi-rr-phone-call me-2 text-muted"></i>
          <span class="fw-medium">{{ $employee->phone ?? 'Not provided' }}</span>
        </p>
        @if(Auth::user()->isSuperAdmin() || Auth::user()->isAdmin() || Auth::user()->isHR())
          <p class="mb-0">
            <i class="fi fi-rr-money me-2 text-muted"></i>
            <span class="fw-medium text-success">৳{{ number_format($employee->salary, 2) }}</span>
          </p>
        @endif
      </div>

    </div>
  </div>
</div>
{{-- ===== END PROFILE HEADER BLOCK ===== --}}

<div class="row">
  <div class="col-lg-12">
    <!-- Personal Information -->
    <div class="card mb-4">
      <div class="card-header">
        <h6 class="card-title mb-0"><i class="fi fi-rr-user me-2"></i>Personal Information</h6>
      </div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-3">
            <small class="text-muted d-block">Full Name</small>
            <span class="fw-medium">{{ $employee->name }}</span>
          </div>
          <div class="col-md-3">
            <small class="text-muted d-block">Email</small>
            <span class="fw-medium">{{ $employee->email }}</span>
          </div>
          <div class="col-md-3">
            <small class="text-muted d-block">Phone</small>
            <span class="fw-medium">{{ $employee->phone ?? 'Not provided' }}</span>
          </div>
          <div class="col-md-3">
            <small class="text-muted d-block">Date of Birth</small>
            <span class="fw-medium">{{ $employee->date_of_birth ? $employee->date_of_birth->format('M d, Y') : 'Not provided' }}</span>
          </div>
          <div class="col-md-3">
            <small class="text-muted d-block">Gender</small>
            <span class="fw-medium">{{ $employee->gender ? ucfirst($employee->gender) : 'Not provided' }}</span>
          </div>
          <div class="col-md-3">
            <small class="text-muted d-block">Blood Group</small>
            <span class="fw-medium">{{ $employee->blood_group ?? 'Not provided' }}</span>
          </div>
          <div class="col-md-3">
            <small class="text-muted d-block">Emergency Contact</small>
            <span class="fw-medium">{{ $employee->emergency_contact_name ?? 'Not provided' }}</span>
          </div>
          <div class="col-md-3">
            <small class="text-muted d-block">Emergency Phone</small>
            <span class="fw-medium">{{ $employee->emergency_contact_phone ?? 'Not provided' }}</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Job Information -->
    <div class="card mb-4">
      <div class="card-header">
        <h6 class="card-title mb-0"><i class="fi fi-rr-building me-2"></i>Job Information</h6>
      </div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-3">
            <small class="text-muted d-block">Employee ID</small>
            <span class="fw-medium">{{ $employee->employee_id ?? 'EMP-' . str_pad($employee->id, 4, '0', STR_PAD_LEFT) }}</span>
          </div>
          <div class="col-md-3">
            <small class="text-muted d-block">Position/Designation</small>
            <span class="fw-medium">{{ $employee->position }}</span>
          </div>
          <div class="col-md-3">
            <small class="text-muted d-block">Department</small>
            <span class="fw-medium">{{ $employee->department }}</span>
          </div>
          <div class="col-md-3">
            <small class="text-muted d-block">Employment Type</small>
            <span class="fw-medium">{{ $employee->employment_type ? ucfirst(str_replace('-', ' ', $employee->employment_type)) : 'Not set' }}</span>
          </div>
          <div class="col-md-3">
            <small class="text-muted d-block">Work Shift</small>
            <span class="fw-medium">{{ $employee->work_shift ? ucfirst($employee->work_shift) : 'Not set' }}</span>
          </div>
          <div class="col-md-3">
            <small class="text-muted d-block">Work Location</small>
            <span class="fw-medium">{{ $employee->work_location ?? 'Not provided' }}</span>
          </div>
          <div class="col-md-3">
            <small class="text-muted d-block">Hire Date</small>
            <span class="fw-medium">{{ $employee->hire_date ? $employee->hire_date->format('M d, Y') : 'Not set' }}</span>
          </div>
          <div class="col-md-3">
            <small class="text-muted d-block">Confirmation Date</small>
            <span class="fw-medium">{{ $employee->confirmation_date ? $employee->confirmation_date->format('M d, Y') : 'Not set' }}</span>
          </div>
          @if(Auth::user()->isSuperAdmin() || Auth::user()->isAdmin() || Auth::user()->isHR())
            <div class="col-md-3">
              <small class="text-muted d-block">Salary</small>
              <span class="fw-medium text-success">৳{{ number_format($employee->salary ?? 0, 2) }} <small class="text-muted">({{ ucfirst($employee->salary_type ?? 'monthly') }})</small></span>
            </div>
          @endif
          <div class="col-md-3">
            <small class="text-muted d-block">Status</small>
            <span class="badge bg-{{ $employee->status === 'active' ? 'success' : ($employee->status === 'on_leave' ? 'warning' : 'danger') }}">
              {{ ucfirst(str_replace('_', ' ', $employee->status)) }}
            </span>
          </div>
        </div>
      </div>
    </div>

    <!-- Address Information -->
    <div class="row">
      <!-- Present Address -->
      <div class="col-md-6">
        <div class="card mb-4">
          <div class="card-header">
            <h6 class="card-title mb-0"><i class="fi fi-rr-marker me-2"></i>Present Address</h6>
          </div>
          <div class="card-body">
            <div class="mb-2">
              <small class="text-muted d-block">Address</small>
              <span class="fw-medium">{{ $employee->address ?? 'Not provided' }}</span>
            </div>
            <div class="mb-2">
              <small class="text-muted d-block">City</small>
              <span class="fw-medium">{{ $employee->city ?? 'Not provided' }}</span>
            </div>
            <div class="mb-2">
              <small class="text-muted d-block">State / Division</small>
              <span class="fw-medium">{{ $employee->state ?? 'Not provided' }}</span>
            </div>
            <div class="mb-2">
              <small class="text-muted d-block">Zip / Postal Code</small>
              <span class="fw-medium">{{ $employee->zip_code ?? 'Not provided' }}</span>
            </div>
            <div>
              <small class="text-muted d-block">Country</small>
              <span class="fw-medium">{{ $employee->country ?? 'Not provided' }}</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Permanent Address -->
      <div class="col-md-6">
        <div class="card mb-4">
          <div class="card-header">
            <h6 class="card-title mb-0"><i class="fi fi-rr-home me-2"></i>Permanent Address</h6>
          </div>
          <div class="card-body">
            <div class="mb-2">
              <small class="text-muted d-block">Address</small>
              <span class="fw-medium">{{ $employee->permanent_address ?? 'Not provided' }}</span>
            </div>
            <div class="mb-2">
              <small class="text-muted d-block">City</small>
              <span class="fw-medium">{{ $employee->permanent_city ?? 'Not provided' }}</span>
            </div>
            <div class="mb-2">
              <small class="text-muted d-block">State / Division</small>
              <span class="fw-medium">{{ $employee->permanent_state ?? 'Not provided' }}</span>
            </div>
            <div class="mb-2">
              <small class="text-muted d-block">Zip / Postal Code</small>
              <span class="fw-medium">{{ $employee->permanent_zip_code ?? 'Not provided' }}</span>
            </div>
            <div>
              <small class="text-muted d-block">Country</small>
              <span class="fw-medium">{{ $employee->permanent_country ?? 'Not provided' }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Documents -->
    <div class="card mb-4">
      <div class="card-header">
        <h6 class="card-title mb-0"><i class="fi fi-rr-document me-2"></i>Documents</h6>
      </div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-4">
            <div class="border rounded p-3 text-center">
              @if($employee->photo)
                <i class="fi fi-rr-check-circle text-success fs-3 d-block mb-2"></i>
                <small class="text-muted d-block">Photo</small>
                <a href="{{ asset('storage/' . $employee->photo) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2">
                  <i class="fi fi-rr-eye me-1"></i> View
                </a>
              @else
                <i class="fi fi-rr-cross-circle text-danger fs-3 d-block mb-2"></i>
                <small class="text-muted d-block">Photo</small>
                <span class="text-muted small">Not uploaded</span>
              @endif
            </div>
          </div>
          <div class="col-md-4">
            <div class="border rounded p-3 text-center">
              @if($employee->nid_file)
                <i class="fi fi-rr-check-circle text-success fs-3 d-block mb-2"></i>
                <small class="text-muted d-block">NID Document</small>
                <a href="{{ asset('storage/' . $employee->nid_file) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2">
                  <i class="fi fi-rr-eye me-1"></i> View
                </a>
              @else
                <i class="fi fi-rr-cross-circle text-danger fs-3 d-block mb-2"></i>
                <small class="text-muted d-block">NID Document</small>
                <span class="text-muted small">Not uploaded</span>
              @endif
            </div>
          </div>
          <div class="col-md-4">
            <div class="border rounded p-3 text-center">
              @if($employee->cv_file)
                <i class="fi fi-rr-check-circle text-success fs-3 d-block mb-2"></i>
                <small class="text-muted d-block">CV / Resume</small>
                <a href="{{ asset('storage/' . $employee->cv_file) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2">
                  <i class="fi fi-rr-eye me-1"></i> View
                </a>
              @else
                <i class="fi fi-rr-cross-circle text-danger fs-3 d-block mb-2"></i>
                <small class="text-muted d-block">CV / Resume</small>
                <span class="text-muted small">Not uploaded</span>
              @endif
            </div>
          </div>
          <div class="col-md-4">
            <div class="border rounded p-3 text-center">
              @if($employee->appointment_letter_file)
                <i class="fi fi-rr-check-circle text-success fs-3 d-block mb-2"></i>
                <small class="text-muted d-block">Appointment Letter</small>
                <a href="{{ asset('storage/' . $employee->appointment_letter_file) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2">
                  <i class="fi fi-rr-eye me-1"></i> View
                </a>
              @else
                <i class="fi fi-rr-cross-circle text-danger fs-3 d-block mb-2"></i>
                <small class="text-muted d-block">Appointment Letter</small>
                <span class="text-muted small">Not uploaded</span>
              @endif
            </div>
          </div>
          <div class="col-md-4">
            <div class="border rounded p-3 text-center">
              @if($employee->offer_letter_file)
                <i class="fi fi-rr-check-circle text-success fs-3 d-block mb-2"></i>
                <small class="text-muted d-block">Offer Letter</small>
                <a href="{{ asset('storage/' . $employee->offer_letter_file) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2">
                  <i class="fi fi-rr-eye me-1"></i> View
                </a>
              @else
                <i class="fi fi-rr-cross-circle text-danger fs-3 d-block mb-2"></i>
                <small class="text-muted d-block">Offer Letter</small>
                <span class="text-muted small">Not uploaded</span>
              @endif
            </div>
          </div>
          <div class="col-md-4">
            <div class="border rounded p-3 text-center">
              @if($employee->academic_certificate_file)
                <i class="fi fi-rr-check-circle text-success fs-3 d-block mb-2"></i>
                <small class="text-muted d-block">Academic Certificate</small>
                <a href="{{ asset('storage/' . $employee->academic_certificate_file) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2">
                  <i class="fi fi-rr-eye me-1"></i> View
                </a>
              @else
                <i class="fi fi-rr-cross-circle text-danger fs-3 d-block mb-2"></i>
                <small class="text-muted d-block">Academic Certificate</small>
                <span class="text-muted small">Not uploaded</span>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Record Information -->
    <div class="card">
      <div class="card-header">
        <h6 class="card-title mb-0"><i class="fi fi-rr-info me-2"></i>Record Information</h6>
      </div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-6">
            <small class="text-muted d-block">Created At</small>
            <span class="fw-medium">{{ $employee->created_at->format('M d, Y h:i A') }}</span>
          </div>
          <div class="col-md-6">
            <small class="text-muted d-block">Last Updated</small>
            <span class="fw-medium">{{ $employee->updated_at->format('M d, Y h:i A') }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
