@extends('layouts.dashboard')

@section('title', 'Request Leave - HR Management System')

@section('content')
<div class="app-page-head d-flex flex-wrap gap-3 align-items-center justify-content-between">
  <div class="clearfix">
    <h1 class="app-page-title">Request Leave</h1>
    <span>Submit a new leave request</span>
  </div>
  <div class="clearfix">
    <a href="{{ route('leave.my') }}" class="btn btn-outline-secondary waves-effect">
      <i class="fi fi-rr-arrow-left me-2"></i>Back to My Leaves
    </a>
  </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="fi fi-rr-calendar me-2"></i>New Leave Request</h5>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('leave.store') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="leave_type" class="form-label">Leave Type <span class="text-danger">*</span></label>
                        <select class="form-select @error('leave_type') is-invalid @enderror" 
                                id="leave_type" name="leave_type" required>
                            <option value="">Select Leave Type</option>
                            <option value="annual">Annual Leave</option>
                            <option value="sick">Sick Leave</option>
                            <option value="casual">Casual Leave</option>
                            <option value="unpaid">Unpaid Leave</option>
                            <option value="maternity">Maternity Leave</option>
                            <option value="paternity">Paternity Leave</option>
                        </select>
                        @error('leave_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                       id="start_date" name="start_date" value="{{ old('start_date') }}" required
                                       min="{{ date('Y-m-d') }}">
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                                       id="end_date" name="end_date" value="{{ old('end_date') }}" required
                                       min="{{ date('Y-m-d') }}">
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="reason" class="form-label">Reason <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('reason') is-invalid @endif" 
                                  id="reason" name="reason" rows="4" required
                                  placeholder="Please provide a detailed reason for your leave request (minimum 10 characters)">{{ old('reason') }}</textarea>
                        @error('reason')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Minimum 10 characters</small>
                    </div>

                    <div class="alert alert-info">
                        <i class="fi fi-rr-info me-2"></i>
                        Your leave request will be sent to the administrator for approval. You will be notified once it's reviewed.
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('leave.my') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            <i class="fi fi-rr-paper-plane me-2"></i>Submit Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Set minimum end date to start date
    document.getElementById('start_date').addEventListener('change', function() {
        document.getElementById('end_date').min = this.value;
        if (document.getElementById('end_date').value && document.getElementById('end_date').value < this.value) {
            document.getElementById('end_date').value = this.value;
        }
    });
</script>
@endsection
