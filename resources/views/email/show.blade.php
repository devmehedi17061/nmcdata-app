@extends('layouts.dashboard')

@section('title', 'View Email - HR Management System')

@section('content')
<div class="app-page-head d-flex flex-wrap gap-3 align-items-center justify-content-between">
  <div class="clearfix">
    <h1 class="app-page-title">View Email</h1>
    <span>Email details</span>
  </div>
  <a href="{{ route('email.index') }}" class="btn btn-outline-primary waves-effect waves-light">
    <i class="fi fi-rr-arrow-left me-1"></i> Back to Emails
  </a>
</div>

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">{{ $email->subject }}</h5>
    @if($email->status === 'sent')
      <span class="badge bg-success"><i class="fi fi-rr-check me-1"></i>Sent</span>
    @elseif($email->status === 'failed')
      <span class="badge bg-danger"><i class="fi fi-rr-cross me-1"></i>Failed</span>
    @else
      <span class="badge bg-warning"><i class="fi fi-rr-clock me-1"></i>Pending</span>
    @endif
  </div>
  <div class="card-body">
    <div class="row mb-4">
      <div class="col-md-6">
        <div class="mb-3">
          <label class="form-label fw-bold text-muted">From</label>
          <p class="mb-0">{{ $email->sender_name }} &lt;{{ $email->sender_email }}&gt;</p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="mb-3">
          <label class="form-label fw-bold text-muted">To</label>
          <p class="mb-0">{{ $email->recipient_email }}</p>
        </div>
      </div>
    </div>

    <div class="row mb-4">
      @if($email->cc)
      <div class="col-md-6">
        <div class="mb-3">
          <label class="form-label fw-bold text-muted">CC</label>
          <p class="mb-0">{{ $email->cc }}</p>
        </div>
      </div>
      @endif

      @if($email->bcc)
      <div class="col-md-6">
        <div class="mb-3">
          <label class="form-label fw-bold text-muted">BCC</label>
          <p class="mb-0">{{ $email->bcc }}</p>
        </div>
      </div>
      @endif
    </div>

    <div class="row mb-3">
      <div class="col-md-6">
        <label class="form-label fw-bold text-muted">Date</label>
        <p class="mb-0">{{ $email->sent_at ? $email->sent_at->format('M d, Y h:i A') : $email->created_at->format('M d, Y h:i A') }}</p>
      </div>
    </div>

    <hr>

    <div class="mt-3">
      <label class="form-label fw-bold text-muted">Message</label>
      <div class="p-3 bg-light rounded">
        {!! nl2br(e($email->description)) !!}
      </div>
    </div>
  </div>
  <div class="card-footer d-flex gap-2">
    <form action="{{ route('email.destroy', $email) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this email?')">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger waves-effect waves-light">
        <i class="fi fi-rr-trash me-1"></i> Delete
      </button>
    </form>
    <a href="{{ route('email.index') }}" class="btn btn-secondary waves-effect waves-light">Back</a>
  </div>
</div>
@endsection
