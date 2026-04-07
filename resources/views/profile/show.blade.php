@extends('layouts.dashboard')

@section('title', 'My Profile - HR Management System')

@push('styles')
<style>
  .profile-cover {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    height: 190px;
    border-radius: 16px 16px 0 0;
    position: relative;
    overflow: hidden;
  }
  .profile-cover::after {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.06'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
  }
  .profile-avatar {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border: 5px solid #fff;
    border-radius: 50%;
    box-shadow: 0 8px 25px rgba(0,0,0,0.18);
    margin-top: -60px;
  }
  .profile-avatar-admin {
    width: 120px;
    height: 120px;
    border: 5px solid #fff;
    border-radius: 50%;
    box-shadow: 0 8px 25px rgba(0,0,0,0.18);
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 46px;
    color: #fff;
    font-weight: 700;
    margin-top: -60px;
  }
  .stat-pill {
    border-right: 1px solid #e2e8f0;
    padding: 4px 20px;
  }
  .stat-pill:last-child { border-right: none; }
  .info-row {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 13px 0;
    border-bottom: 1px solid #f1f3f5;
  }
  .info-row:last-child { border-bottom: none; padding-bottom: 0; }
  .info-row:first-child { padding-top: 0; }
  .info-icon {
    width: 36px; height: 36px;
    border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    font-size: 14px;
    flex-shrink: 0;
  }
  .field-box {
    background: #f8f9fb;
    border-radius: 10px;
    padding: 14px 16px;
    height: 100%;
  }
  .doc-card {
    background: #f8f9ff;
    border: 1.5px dashed #c9d1e4;
    border-radius: 12px;
    padding: 15px;
    display: flex;
    align-items: center;
    gap: 13px;
    transition: all .2s;
  }
  .doc-card:hover { border-color: #667eea; background: #f0f2ff; }
  .doc-icon {
    width: 44px; height: 44px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
  }
  .nav-pills .nav-link {
    border-radius: 9px;
    color: #6c757d;
    font-weight: 500;
    padding: 8px 17px;
    font-size: 14px;
  }
  .nav-pills .nav-link.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    box-shadow: 0 4px 12px rgba(102,126,234,.35);
  }
</style>
@endpush

@section('content')
{{-- Page Header --}}
<div class="app-page-head d-flex flex-wrap gap-3 align-items-center justify-content-between mb-4">
  <div class="clearfix">
    <h1 class="app-page-title">My Profile</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Profile</li>
      </ol>
    </nav>
  </div>
  <div class="d-flex gap-2">
    <a href="{{ route('profile.edit') }}" class="btn btn-primary waves-effect waves-light">
      <i class="fi fi-rr-edit me-1"></i> Edit Profile
    </a>
    <a href="{{ route('password.show') }}" class="btn btn-outline-secondary waves-effect waves-light">
      <i class="fi fi-rr-key me-1"></i> Change Password
    </a>
  </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
  <i class="fi fi-rr-check-circle me-2"></i>{{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if($employee)
{{-- ===== EMPLOYEE PROFILE ===== --}}
<div class="row g-4">

  {{-- LEFT --}}
  <div class="col-xl-4 col-lg-5">

    {{-- Profile Hero Card --}}
    <div class="card overflow-hidden mb-4" style="border-radius:16px;">
      <div class="profile-cover"></div>
      <div class="card-body text-center pt-0">
        <div class="d-flex justify-content-center">
          <img src="{{ $employee->photo ? asset('storage/'.$employee->photo) : asset('assets/images/avatar/avatar1.webp') }}"
               alt="{{ $employee->name }}" class="profile-avatar">
        </div>
        <h4 class="fw-bold mt-3 mb-1">{{ $employee->name }}</h4>
        <p class="text-primary fw-semibold mb-1" style="font-size:14px;">{{ $employee->position }}</p>
        <p class="text-muted mb-3" style="font-size:13px;"><i class="fi fi-rr-building me-1"></i>{{ $employee->department }}</p>
        @php $sc = match($employee->status){ 'active'=>'success','on_leave'=>'warning',default=>'danger' }; @endphp
        <span class="badge bg-{{ $sc }}-subtle text-{{ $sc }} px-3 py-2 rounded-pill">
          <i class="fi fi-rr-circle" style="font-size:7px;vertical-align:middle;margin-right:4px;"></i>
          {{ ucfirst(str_replace('_',' ',$employee->status)) }}
        </span>

        <hr class="my-3">

        <div class="d-flex justify-content-center">
          <div class="stat-pill text-center">
            <h5 class="fw-bold mb-0 text-primary">{{ $employee->hire_date ? now()->diffInYears($employee->hire_date) : 0 }}</h5>
            <small class="text-muted">Yrs</small>
          </div>
          <div class="stat-pill text-center">
            <h5 class="fw-bold mb-0 text-success" style="font-size:14px;">{{ $employee->employee_id ?? '—' }}</h5>
            <small class="text-muted">Emp ID</small>
          </div>
          <div class="stat-pill text-center" style="border-right:none">
            <h5 class="fw-bold mb-0 text-info" style="font-size:13px;">{{ ucfirst($employee->employment_type ?? '—') }}</h5>
            <small class="text-muted">Type</small>
          </div>
        </div>
      </div>
    </div>

    {{-- Contact Card --}}
    <div class="card mb-4" style="border-radius:16px;">
      <div class="card-header border-0 pt-4 px-4 pb-0">
        <h6 class="fw-bold mb-0"><i class="fi fi-rr-address-book me-2 text-primary"></i>Contact Details</h6>
      </div>
      <div class="card-body px-4">
        <div class="info-row">
          <div class="info-icon bg-primary-subtle text-primary"><i class="fi fi-rr-envelope"></i></div>
          <div><small class="text-muted d-block">Email</small><span class="fw-semibold small">{{ $employee->email }}</span></div>
        </div>
        <div class="info-row">
          <div class="info-icon bg-success-subtle text-success"><i class="fi fi-rr-phone-call"></i></div>
          <div><small class="text-muted d-block">Phone</small><span class="fw-semibold small">{{ $employee->phone ?? 'Not provided' }}</span></div>
        </div>
        <div class="info-row">
          <div class="info-icon bg-warning-subtle text-warning"><i class="fi fi-rr-marker"></i></div>
          <div><small class="text-muted d-block">Work Location</small><span class="fw-semibold small">{{ $employee->work_location ?? 'Not provided' }}</span></div>
        </div>
        <div class="info-row">
          <div class="info-icon bg-info-subtle text-info"><i class="fi fi-rr-time-fast"></i></div>
          <div><small class="text-muted d-block">Work Shift</small><span class="fw-semibold small">{{ ucfirst($employee->work_shift ?? 'N/A') }}</span></div>
        </div>
      </div>
    </div>

    {{-- Emergency Contact Card --}}
    <div class="card" style="border-radius:16px; border-top: 3px solid #f5576c;">
      <div class="card-header border-0 pt-4 px-4 pb-0">
        <h6 class="fw-bold mb-0"><i class="fi fi-rr-phone-flip me-2 text-danger"></i>Emergency Contact</h6>
      </div>
      <div class="card-body px-4">
        <div class="info-row">
          <div class="info-icon bg-danger-subtle text-danger"><i class="fi fi-rr-user"></i></div>
          <div><small class="text-muted d-block">Name</small><span class="fw-semibold small">{{ $employee->emergency_contact_name ?? 'Not provided' }}</span></div>
        </div>
        <div class="info-row">
          <div class="info-icon bg-danger-subtle text-danger"><i class="fi fi-rr-phone-call"></i></div>
          <div><small class="text-muted d-block">Phone</small><span class="fw-semibold small">{{ $employee->emergency_contact_phone ?? 'Not provided' }}</span></div>
        </div>
      </div>
    </div>

  </div>{{-- end left --}}

  {{-- RIGHT --}}
  <div class="col-xl-8 col-lg-7">

    {{-- Tab Nav --}}
    <div class="card mb-4" style="border-radius:16px;">
      <div class="card-body py-3 px-4">
        <ul class="nav nav-pills gap-1 flex-wrap" id="profileTabs" role="tablist">
          <li class="nav-item"><button class="nav-link active" data-bs-toggle="pill" data-bs-target="#tp-personal" type="button"><i class="fi fi-rr-user me-1"></i>Personal</button></li>
          <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#tp-job" type="button"><i class="fi fi-rr-briefcase me-1"></i>Job Details</button></li>
          <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#tp-address" type="button"><i class="fi fi-rr-marker me-1"></i>Address</button></li>
          <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#tp-docs" type="button"><i class="fi fi-rr-document me-1"></i>Documents</button></li>
        </ul>
      </div>
    </div>

    <div class="tab-content">

      {{-- TAB: Personal --}}
      <div class="tab-pane fade show active" id="tp-personal" role="tabpanel">
        <div class="card" style="border-radius:16px; border-top:3px solid #667eea;">
          <div class="card-header border-0 pt-4 px-4 pb-0 d-flex align-items-center justify-content-between">
            <h6 class="fw-bold mb-0"><i class="fi fi-rr-user me-2 text-primary"></i>Personal Information</h6>
            <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-primary"><i class="fi fi-rr-edit me-1"></i>Edit</a>
          </div>
          <div class="card-body px-4">
            <div class="row g-3">
              @php
                $pf = [
                  ['Full Name','fi-rr-user','primary', $employee->name],
                  ['Email Address','fi-rr-envelope','info', $employee->email],
                  ['Phone Number','fi-rr-phone-call','success', $employee->phone ?? 'N/A'],
                  ['Date of Birth','fi-rr-calendar','warning', $employee->date_of_birth ? $employee->date_of_birth->format('d M, Y') : 'N/A'],
                  ['Gender','fi-rr-person','secondary', ucfirst($employee->gender ?? 'N/A')],
                  ['Blood Group','fi-rr-heart','danger', $employee->blood_group ?? 'N/A'],
                ];
              @endphp
              @foreach($pf as [$label,$icon,$color,$val])
              <div class="col-sm-6">
                <div class="field-box">
                  <div class="d-flex align-items-center gap-2 mb-1">
                    <i class="fi {{ $icon }} text-{{ $color }}" style="font-size:12px;"></i>
                    <small class="text-muted fw-medium">{{ $label }}</small>
                  </div>
                  <p class="fw-semibold mb-0 ps-1">{{ $val }}</p>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>

      {{-- TAB: Job --}}
      <div class="tab-pane fade" id="tp-job" role="tabpanel">
        <div class="card" style="border-radius:16px; border-top:3px solid #11998e;">
          <div class="card-header border-0 pt-4 px-4 pb-0">
            <h6 class="fw-bold mb-0"><i class="fi fi-rr-briefcase me-2 text-success"></i>Job Information</h6>
          </div>
          <div class="card-body px-4">
            {{-- Stat Boxes --}}
            <div class="row g-3 mb-4">
              <div class="col-sm-4">
                <div class="p-3 text-center rounded-3" style="background:linear-gradient(135deg,#667eea18,#764ba218);">
                  <i class="fi fi-rr-calendar text-primary d-block mb-1" style="font-size:22px;"></i>
                  <h6 class="fw-bold text-primary mb-0">{{ $employee->hire_date ? $employee->hire_date->format('d M Y') : 'N/A' }}</h6>
                  <small class="text-muted">Joining Date</small>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="p-3 text-center rounded-3" style="background:linear-gradient(135deg,#11998e18,#38ef7d18);">
                  <i class="fi fi-rr-badge-check text-success d-block mb-1" style="font-size:22px;"></i>
                  <h6 class="fw-bold text-success mb-0">{{ $employee->confirmation_date ? $employee->confirmation_date->format('d M Y') : 'Pending' }}</h6>
                  <small class="text-muted">Confirmed On</small>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="p-3 text-center rounded-3" style="background:linear-gradient(135deg,#f5576c18,#f093fb18);">
                  <i class="fi fi-rr-usd-circle text-danger d-block mb-1" style="font-size:22px;"></i>
                  <h6 class="fw-bold text-danger mb-0">{{ $employee->salary ? '$'.number_format($employee->salary,0) : 'N/A' }}</h6>
                  <small class="text-muted">{{ ucfirst($employee->salary_type ?? 'Salary') }}</small>
                </div>
              </div>
            </div>
            <div class="row g-3">
              @php
                $jf = [
                  ['Employee ID','fi-rr-id-badge','primary', $employee->employee_id ?? 'N/A'],
                  ['Position','fi-rr-briefcase','success', $employee->position],
                  ['Department','fi-rr-building','info', $employee->department],
                  ['Employment Type','fi-rr-layers','warning', ucfirst($employee->employment_type ?? 'N/A')],
                  ['Work Shift','fi-rr-time-fast','secondary', ucfirst($employee->work_shift ?? 'N/A')],
                  ['Work Location','fi-rr-marker','danger', $employee->work_location ?? 'N/A'],
                ];
              @endphp
              @foreach($jf as [$label,$icon,$color,$val])
              <div class="col-sm-6">
                <div class="field-box">
                  <div class="d-flex align-items-center gap-2 mb-1">
                    <i class="fi {{ $icon }} text-{{ $color }}" style="font-size:12px;"></i>
                    <small class="text-muted fw-medium">{{ $label }}</small>
                  </div>
                  <p class="fw-semibold mb-0 ps-1">{{ $val }}</p>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>

      {{-- TAB: Address --}}
      <div class="tab-pane fade" id="tp-address" role="tabpanel">
        <div class="row g-4">
          @foreach([
            ['Present Address', 'primary', '#667eea', $employee->address, $employee->city, $employee->state, $employee->zip_code, $employee->country],
            ['Permanent Address', 'success', '#11998e', $employee->permanent_address, $employee->permanent_city, $employee->permanent_state, $employee->permanent_zip_code, $employee->permanent_country],
          ] as [$title, $color, $border, $addr, $city, $state, $zip, $country])
          <div class="col-md-6">
            <div class="card h-100" style="border-radius:16px; border-top:3px solid {{ $border }};">
              <div class="card-header border-0 pt-4 px-4 pb-0">
                <h6 class="fw-bold mb-0"><i class="fi fi-rr-marker me-2 text-{{ $color }}"></i>{{ $title }}</h6>
              </div>
              <div class="card-body px-4">
                <div class="info-row">
                  <div class="info-icon bg-{{ $color }}-subtle text-{{ $color }}"><i class="fi fi-rr-home"></i></div>
                  <div><small class="text-muted d-block">Street</small><span class="fw-semibold small">{{ $addr ?? 'Not provided' }}</span></div>
                </div>
                <div class="info-row">
                  <div class="info-icon bg-{{ $color }}-subtle text-{{ $color }}"><i class="fi fi-rr-city"></i></div>
                  <div><small class="text-muted d-block">City</small><span class="fw-semibold small">{{ $city ?? 'N/A' }}</span></div>
                </div>
                <div class="info-row">
                  <div class="info-icon bg-{{ $color }}-subtle text-{{ $color }}"><i class="fi fi-rr-map"></i></div>
                  <div><small class="text-muted d-block">State / Zip</small><span class="fw-semibold small">{{ $state ?? 'N/A' }} {{ $zip ?? '' }}</span></div>
                </div>
                <div class="info-row">
                  <div class="info-icon bg-{{ $color }}-subtle text-{{ $color }}"><i class="fi fi-rr-globe"></i></div>
                  <div><small class="text-muted d-block">Country</small><span class="fw-semibold small">{{ $country ?? 'N/A' }}</span></div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>

      {{-- TAB: Documents --}}
      <div class="tab-pane fade" id="tp-docs" role="tabpanel">
        <div class="card" style="border-radius:16px; border-top:3px solid #f6a623;">
          <div class="card-header border-0 pt-4 px-4 pb-0">
            <h6 class="fw-bold mb-0"><i class="fi fi-rr-folder me-2 text-warning"></i>My Documents</h6>
          </div>
          <div class="card-body px-4">
            <div class="row g-3">
              @php
                $docs = [
                  ['CV / Resume',          $employee->cv_file,                   'fi-rr-file-pdf',         'danger',   '#fff0f0'],
                  ['NID / Passport',       $employee->nid_file,                  'fi-rr-id-card-clip-alt', 'primary',  '#f0f4ff'],
                  ['Appointment Letter',   $employee->appointment_letter_file,   'fi-rr-document-signed',  'success',  '#f0fff5'],
                  ['Offer Letter',         $employee->offer_letter_file,         'fi-rr-envelope-open-text','warning', '#fffbf0'],
                  ['Academic Certificate', $employee->academic_certificate_file, 'fi-rr-diploma',          'info',     '#f0faff'],
                ];
              @endphp
              @foreach($docs as [$label, $file, $icon, $col, $bg])
              <div class="col-md-6">
                <div class="doc-card">
                  <div class="doc-icon" style="background:{{ $bg }}">
                    <i class="fi {{ $icon }} text-{{ $col }}"></i>
                  </div>
                  <div class="flex-grow-1">
                    <p class="fw-semibold mb-0" style="font-size:13px;">{{ $label }}</p>
                    @if($file)
                      <a href="{{ asset('storage/'.$file) }}" target="_blank" class="small text-primary fw-medium d-inline-flex align-items-center gap-1 mt-1">
                        <i class="fi fi-rr-eye" style="font-size:11px;"></i> View Document
                      </a>
                    @else
                      <span class="small text-muted d-inline-flex align-items-center gap-1 mt-1">
                        <i class="fi fi-rr-cross-circle" style="font-size:11px;"></i> Not uploaded
                      </span>
                    @endif
                  </div>
                  @if($file)
                    <span class="badge bg-success-subtle text-success rounded-pill" style="font-size:10px;">✓</span>
                  @else
                    <span class="badge bg-secondary-subtle text-secondary rounded-pill" style="font-size:10px;">—</span>
                  @endif
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>

    </div>{{-- /tab-content --}}
  </div>{{-- /right col --}}
</div>{{-- /row --}}

@else
{{-- ===== ADMIN / NON-EMPLOYEE PROFILE ===== --}}
<div class="row justify-content-center">
  <div class="col-lg-6">
    <div class="card overflow-hidden" style="border-radius:16px;">
      <div class="profile-cover" style="height:155px;"></div>
      <div class="card-body text-center pt-0">
        <div class="d-flex justify-content-center">
          <div class="profile-avatar-admin">{{ strtoupper(substr($user->name,0,1)) }}</div>
        </div>
        <h4 class="fw-bold mt-3 mb-1">{{ $user->name }}</h4>
        <span class="badge bg-primary-subtle text-primary px-4 py-2 mb-4 rounded-pill">
          {{ $user->role ? $user->role->name : 'User' }}
        </span>

        <div class="row g-3 text-start mb-3">
          <div class="col-sm-6">
            <div class="field-box">
              <div class="d-flex align-items-center gap-2 mb-1"><i class="fi fi-rr-envelope text-primary" style="font-size:12px;"></i><small class="text-muted">Email</small></div>
              <p class="fw-semibold mb-0 small">{{ $user->email }}</p>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="field-box">
              <div class="d-flex align-items-center gap-2 mb-1"><i class="fi fi-rr-shield-check text-success" style="font-size:12px;"></i><small class="text-muted">Role</small></div>
              <p class="fw-semibold mb-0 small">{{ $user->role ? $user->role->name : 'No role assigned' }}</p>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="field-box">
              <div class="d-flex align-items-center gap-2 mb-1"><i class="fi fi-rr-badge-check text-warning" style="font-size:12px;"></i><small class="text-muted">Account Status</small></div>
              <span class="badge bg-{{ $user->is_approved ? 'success' : 'warning' }}-subtle text-{{ $user->is_approved ? 'success' : 'warning' }}" style="font-size:11px;">
                {{ $user->is_approved ? 'Approved' : 'Pending Approval' }}
              </span>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="field-box">
              <div class="d-flex align-items-center gap-2 mb-1"><i class="fi fi-rr-calendar text-info" style="font-size:12px;"></i><small class="text-muted">Member Since</small></div>
              <p class="fw-semibold mb-0 small">{{ $user->created_at->format('d M, Y') }}</p>
            </div>
          </div>
        </div>

        @if(Auth::user()->isAdmin() || Auth::user()->isHR())
        <div class="alert alert-info d-flex align-items-start gap-2 mb-0 text-start" style="border-radius:12px;">
          <i class="fi fi-rr-info fs-5 flex-shrink-0 mt-1"></i>
          <div>No employee profile linked. Create one from the <a href="{{ route('employees.index') }}" class="fw-semibold">Employee Management</a> page.</div>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endif
@endsection
