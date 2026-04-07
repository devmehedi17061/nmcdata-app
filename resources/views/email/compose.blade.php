@extends('layouts.dashboard')

@section('title', 'Compose Email - HR Management System')

@section('content')
<div class="app-page-head d-flex flex-wrap gap-3 align-items-center justify-content-between">
  <div class="clearfix">
    <h1 class="app-page-title">Compose Email</h1>
    <span>Send an email to anyone</span>
  </div>
  <a href="{{ route('email.index') }}" class="btn btn-outline-primary waves-effect waves-light">
    <i class="fi fi-rr-arrow-left me-1"></i> Back to Emails
  </a>
</div>

@if(session('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fi fi-rr-cross-circle me-2"></i>{{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

<form action="{{ route('email.send') }}" method="POST">
  @csrf

  {{-- Sender Information --}}
  <div class="card mb-4">
    <div class="card-header bg-primary text-white">
      <h5 class="mb-0"><i class="fi fi-rr-user me-2"></i>Sender Information</h5>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="sender_name" class="form-label">Name *</label>
          <input type="text" class="form-control @error('sender_name') is-invalid @enderror"
                 id="sender_name" name="sender_name"
                 value="{{ old('sender_name', Auth::user()->name) }}" required>
          @error('sender_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-6 mb-3">
          <label for="sender_email" class="form-label">Email *</label>
          <input type="email" class="form-control @error('sender_email') is-invalid @enderror"
                 id="sender_email" name="sender_email"
                 value="{{ old('sender_email', Auth::user()->email) }}" required>
          @error('sender_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
      </div>
    </div>
  </div>

  {{-- Recipient Information --}}
  <div class="card mb-4">
    <div class="card-header bg-success text-white">
      <h5 class="mb-0"><i class="fi fi-rr-envelope me-2"></i>Recipient Information</h5>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12 mb-3">
          <label for="recipient_email" class="form-label">To (Email) *</label>
          <input type="email" class="form-control @error('recipient_email') is-invalid @enderror"
                 id="recipient_email" name="recipient_email"
                 value="{{ old('recipient_email') }}"
                 placeholder="recipient@example.com" required>
          @error('recipient_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="cc" class="form-label">CC</label>
          <input type="text" class="form-control @error('cc') is-invalid @enderror"
                 id="cc" name="cc" value="{{ old('cc') }}"
                 placeholder="cc1@example.com, cc2@example.com">
          @error('cc')<div class="invalid-feedback">{{ $message }}</div>@enderror
          <small class="text-muted">Separate multiple emails with commas</small>
        </div>

        <div class="col-md-6 mb-3">
          <label for="bcc" class="form-label">BCC</label>
          <input type="text" class="form-control @error('bcc') is-invalid @enderror"
                 id="bcc" name="bcc" value="{{ old('bcc') }}"
                 placeholder="bcc1@example.com, bcc2@example.com">
          @error('bcc')<div class="invalid-feedback">{{ $message }}</div>@enderror
          <small class="text-muted">Separate multiple emails with commas</small>
        </div>
      </div>
    </div>
  </div>

  {{-- Email Content --}}
  <div class="card mb-4">
    <div class="card-header bg-info text-white">
      <h5 class="mb-0"><i class="fi fi-rr-document me-2"></i>Email Content</h5>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12 mb-3">
          <label for="subject" class="form-label">Subject *</label>
          <input type="text" class="form-control @error('subject') is-invalid @enderror"
                 id="subject" name="subject" value="{{ old('subject') }}"
                 placeholder="Enter email subject" required>
          @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 mb-3">
          <label for="description" class="form-label">Description *</label>
          <textarea class="form-control @error('description') is-invalid @enderror"
                    id="description" name="description" rows="8"
                    placeholder="Write your email message here..." required>{{ old('description') }}</textarea>
          @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
      </div>
    </div>
  </div>

  {{-- Submit Buttons --}}
  <div class="card">
    <div class="card-body d-flex gap-2">
      <button type="submit" class="btn btn-primary waves-effect waves-light">
        <i class="fi fi-rr-paper-plane me-1"></i> Send Email
      </button>
      <a href="{{ route('email.index') }}" class="btn btn-secondary waves-effect waves-light">Cancel</a>
    </div>
  </div>
</form>
@endsection
