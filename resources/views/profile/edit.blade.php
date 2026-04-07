@extends('layouts.dashboard')

@section('title', 'Edit Profile - HR Management System')

@section('content')
<div class="app-page-head d-flex flex-wrap gap-3 align-items-center justify-content-between">
  <div class="clearfix">
    <h1 class="app-page-title">Edit Profile</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">
          <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
          <a href="{{ route('profile.show') }}">Profile</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
      </ol>
    </nav>
  </div>
  <a href="{{ route('profile.show') }}" class="btn btn-outline-primary waves-effect waves-light">
    <i class="fi fi-rr-arrow-left me-1"></i> Back to Profile
  </a>
</div>

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <i class="fi fi-rr-exclamation me-2"></i>
  <strong>Please fix the following errors:</strong>
  <ul class="mb-0 mt-2">
    @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
  </ul>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="row">
    <!-- Left Column - Photo & Basic Info -->
    <div class="col-lg-4">
      <div class="card mb-4">
        <div class="card-header">
          <h6 class="card-title mb-0"><i class="fi fi-rr-camera me-2"></i>Profile Photo</h6>
        </div>
        <div class="card-body text-center">
          <div class="avatar avatar-xxl rounded-4 mx-auto mb-3 position-relative">
            @if($employee && $employee->photo)
              <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $user->name }}" class="rounded-4" style="width: 150px; height: 150px; object-fit: cover;" id="photoPreview">
            @else
              <img src="{{ asset('assets/images/avatar/avatar1.webp') }}" alt="{{ $user->name }}" class="rounded-4" style="width: 150px; height: 150px; object-fit: cover;" id="photoPreview">
            @endif
          </div>
          
          @if($employee)
          <div class="mb-3">
            <label for="photo" class="btn btn-outline-primary btn-sm">
              <i class="fi fi-rr-upload me-1"></i> Change Photo
            </label>
            <input type="file" class="d-none @error('photo') is-invalid @enderror" id="photo" name="photo" accept="image/*" onchange="previewImage(this)">
            @error('photo')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            <small class="text-muted d-block mt-2">JPG, PNG, GIF (Max 2MB)</small>
          </div>
          @endif

          <hr class="my-3">

          <div class="text-start">
            <p class="mb-2">
              <i class="fi fi-rr-envelope text-primary me-2"></i>
              <strong>Email:</strong> {{ $user->email }}
            </p>
            <p class="mb-2">
              <i class="fi fi-rr-shield-check text-primary me-2"></i>
              <strong>Role:</strong> {{ $user->role ? $user->role->name : 'User' }}
            </p>
            @if($employee)
            <p class="mb-0">
              <i class="fi fi-rr-id-badge text-primary me-2"></i>
              <strong>Employee ID:</strong> {{ $employee->employee_id ?? 'N/A' }}
            </p>
            @endif
          </div>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="card">
        <div class="card-header">
          <h6 class="card-title mb-0"><i class="fi fi-rr-link me-2"></i>Quick Links</h6>
        </div>
        <div class="card-body">
          <a href="{{ route('password.show') }}" class="btn btn-outline-secondary w-100 mb-2">
            <i class="fi fi-rr-key me-2"></i>Change Password
          </a>
          <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary w-100">
            <i class="fi fi-rr-eye me-2"></i>View Profile
          </a>
        </div>
      </div>
    </div>

    <!-- Right Column - Edit Form -->
    <div class="col-lg-8">
      <!-- Basic Information -->
      <div class="card mb-4">
        <div class="card-header bg-primary text-white">
          <h6 class="card-title mb-0"><i class="fi fi-rr-user me-2"></i>Basic Information</h6>
        </div>
        <div class="card-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="name" class="form-label">Full Name *</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" 
                     id="name" name="name" value="{{ old('name', $user->name) }}" required>
              @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            
            @if($employee)
            <div class="col-md-6">
              <label for="phone" class="form-label">Phone Number</label>
              <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                     id="phone" name="phone" value="{{ old('phone', $employee->phone) }}">
              @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
              <label for="date_of_birth" class="form-label">Date of Birth</label>
              <input type="date" class="form-control flatpickr-date @error('date_of_birth') is-invalid @enderror" 
                     id="date_of_birth" name="date_of_birth" 
                     value="{{ old('date_of_birth', $employee->date_of_birth ? $employee->date_of_birth->format('Y-m-d') : '') }}">
              @error('date_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
              <label for="gender" class="form-label">Gender</label>
              <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender">
                <option value="">Select Gender</option>
                <option value="male" {{ old('gender', $employee->gender) == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender', $employee->gender) == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ old('gender', $employee->gender) == 'other' ? 'selected' : '' }}>Other</option>
              </select>
              @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
              <label for="blood_group" class="form-label">Blood Group</label>
              <select class="form-select @error('blood_group') is-invalid @enderror" id="blood_group" name="blood_group">
                <option value="">Select Blood Group</option>
                @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $bg)
                  <option value="{{ $bg }}" {{ old('blood_group', $employee->blood_group) == $bg ? 'selected' : '' }}>{{ $bg }}</option>
                @endforeach
              </select>
              @error('blood_group')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            @endif
          </div>
        </div>
      </div>

      @if($employee)
      <!-- Emergency Contact -->
      <div class="card mb-4">
        <div class="card-header bg-danger text-white">
          <h6 class="card-title mb-0"><i class="fi fi-rr-phone-call me-2"></i>Emergency Contact</h6>
        </div>
        <div class="card-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="emergency_contact_name" class="form-label">Contact Name</label>
              <input type="text" class="form-control @error('emergency_contact_name') is-invalid @enderror" 
                     id="emergency_contact_name" name="emergency_contact_name" 
                     value="{{ old('emergency_contact_name', $employee->emergency_contact_name) }}">
              @error('emergency_contact_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
              <label for="emergency_contact_phone" class="form-label">Contact Phone</label>
              <input type="text" class="form-control @error('emergency_contact_phone') is-invalid @enderror" 
                     id="emergency_contact_phone" name="emergency_contact_phone" 
                     value="{{ old('emergency_contact_phone', $employee->emergency_contact_phone) }}">
              @error('emergency_contact_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>
        </div>
      </div>

      <!-- Present Address -->
      <div class="card mb-4">
        <div class="card-header bg-info text-white">
          <h6 class="card-title mb-0"><i class="fi fi-rr-marker me-2"></i>Present Address</h6>
        </div>
        <div class="card-body">
          <div class="row g-3">
            <div class="col-12">
              <label for="address" class="form-label">Street Address</label>
              <textarea class="form-control @error('address') is-invalid @enderror" 
                        id="address" name="address" rows="2">{{ old('address', $employee->address) }}</textarea>
              @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
              <label for="city" class="form-label">City</label>
              <input type="text" class="form-control @error('city') is-invalid @enderror" 
                     id="city" name="city" value="{{ old('city', $employee->city) }}">
              @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
              <label for="state" class="form-label">State/Province</label>
              <input type="text" class="form-control @error('state') is-invalid @enderror" 
                     id="state" name="state" value="{{ old('state', $employee->state) }}">
              @error('state')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
              <label for="zip_code" class="form-label">Zip/Postal Code</label>
              <input type="text" class="form-control @error('zip_code') is-invalid @enderror" 
                     id="zip_code" name="zip_code" value="{{ old('zip_code', $employee->zip_code) }}">
              @error('zip_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
              <label for="country" class="form-label">Country</label>
              <input type="text" class="form-control @error('country') is-invalid @enderror" 
                     id="country" name="country" value="{{ old('country', $employee->country) }}">
              @error('country')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>
        </div>
      </div>

      <!-- Permanent Address -->
      <div class="card mb-4">
        <div class="card-header bg-success text-white">
          <h6 class="card-title mb-0"><i class="fi fi-rr-home me-2"></i>Permanent Address</h6>
        </div>
        <div class="card-body">
          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="sameAsPresent" onchange="copyAddress()">
              <label class="form-check-label" for="sameAsPresent">
                Same as Present Address
              </label>
            </div>
          </div>

          <div class="row g-3">
            <div class="col-12">
              <label for="permanent_address" class="form-label">Street Address</label>
              <textarea class="form-control @error('permanent_address') is-invalid @enderror" 
                        id="permanent_address" name="permanent_address" rows="2">{{ old('permanent_address', $employee->permanent_address) }}</textarea>
              @error('permanent_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
              <label for="permanent_city" class="form-label">City</label>
              <input type="text" class="form-control @error('permanent_city') is-invalid @enderror" 
                     id="permanent_city" name="permanent_city" value="{{ old('permanent_city', $employee->permanent_city) }}">
              @error('permanent_city')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
              <label for="permanent_state" class="form-label">State/Province</label>
              <input type="text" class="form-control @error('permanent_state') is-invalid @enderror" 
                     id="permanent_state" name="permanent_state" value="{{ old('permanent_state', $employee->permanent_state) }}">
              @error('permanent_state')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
              <label for="permanent_zip_code" class="form-label">Zip/Postal Code</label>
              <input type="text" class="form-control @error('permanent_zip_code') is-invalid @enderror" 
                     id="permanent_zip_code" name="permanent_zip_code" value="{{ old('permanent_zip_code', $employee->permanent_zip_code) }}">
              @error('permanent_zip_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
              <label for="permanent_country" class="form-label">Country</label>
              <input type="text" class="form-control @error('permanent_country') is-invalid @enderror" 
                     id="permanent_country" name="permanent_country" value="{{ old('permanent_country', $employee->permanent_country) }}">
              @error('permanent_country')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>
        </div>
      </div>
      @endif

      <!-- Submit Buttons -->
      <div class="card">
        <div class="card-body d-flex justify-content-end gap-2">
          <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary">
            <i class="fi fi-rr-cross-circle me-1"></i> Cancel
          </a>
          <button type="submit" class="btn btn-primary">
            <i class="fi fi-rr-check me-1"></i> Save Changes
          </button>
        </div>
      </div>
    </div>
  </div>
</form>

@push('scripts')
<script>
function previewImage(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function(e) {
      document.getElementById('photoPreview').src = e.target.result;
    }
    reader.readAsDataURL(input.files[0]);
  }
}

function copyAddress() {
  const checkbox = document.getElementById('sameAsPresent');
  if (checkbox.checked) {
    document.getElementById('permanent_address').value = document.getElementById('address').value;
    document.getElementById('permanent_city').value = document.getElementById('city').value;
    document.getElementById('permanent_state').value = document.getElementById('state').value;
    document.getElementById('permanent_zip_code').value = document.getElementById('zip_code').value;
    document.getElementById('permanent_country').value = document.getElementById('country').value;
  }
}
</script>
@endpush
@endsection
