@extends('layouts.dashboard')

@section('title', 'Email Management - HR Management System')

@section('content')
<div class="app-page-head d-flex flex-wrap gap-3 align-items-center justify-content-between">
  <div class="clearfix">
    <h1 class="app-page-title">Email Management</h1>
    <span>View and manage your sent emails</span>
  </div>
  <a href="{{ route('email.compose') }}" class="btn btn-primary waves-effect waves-light">
    <i class="fi fi-rr-edit me-1"></i> Compose Email
  </a>
</div>

@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fi fi-rr-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

@if(session('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fi fi-rr-cross-circle me-2"></i>{{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

<div class="card">
  <div class="card-body">
    @if($emails->count() > 0)
    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>Recipient</th>
            <th>Subject</th>
            <th>Status</th>
            <th>Sent At</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($emails as $email)
          <tr>
            <td>{{ $loop->iteration + ($emails->currentPage() - 1) * $emails->perPage() }}</td>
            <td>
              <div class="d-flex align-items-center gap-2">
                <div class="avatar avatar-sm bg-soft-primary rounded-circle d-flex align-items-center justify-content-center">
                  <i class="fi fi-rr-user text-primary"></i>
                </div>
                <div>
                  <span class="fw-medium">{{ $email->recipient_email }}</span>
                  @if($email->cc)
                    <br><small class="text-muted">CC: {{ Str::limit($email->cc, 30) }}</small>
                  @endif
                </div>
              </div>
            </td>
            <td>
              <span class="fw-medium">{{ Str::limit($email->subject, 40) }}</span>
              <br><small class="text-muted">{{ Str::limit($email->description, 50) }}</small>
            </td>
            <td>
              @if($email->status === 'sent')
                <span class="badge bg-success"><i class="fi fi-rr-check me-1"></i>Sent</span>
              @elseif($email->status === 'failed')
                <span class="badge bg-danger"><i class="fi fi-rr-cross me-1"></i>Failed</span>
              @else
                <span class="badge bg-warning"><i class="fi fi-rr-clock me-1"></i>Pending</span>
              @endif
            </td>
            <td>
              <small>{{ $email->sent_at ? $email->sent_at->format('M d, Y h:i A') : $email->created_at->format('M d, Y h:i A') }}</small>
            </td>
            <td class="text-end">
              <div class="dropdown">
                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                  <i class="fi fi-rr-menu-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="{{ route('email.show', $email) }}">
                      <i class="fi fi-rr-eye me-2"></i>View
                    </a>
                  </li>
                  <li>
                    <form action="{{ route('email.destroy', $email) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this email?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="dropdown-item text-danger">
                        <i class="fi fi-rr-trash me-2"></i>Delete
                      </button>
                    </form>
                  </li>
                </ul>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
      {{ $emails->links() }}
    </div>
    @else
    <div class="text-center py-5">
      <div class="mb-3">
        <i class="fi fi-rr-envelope" style="font-size: 3rem; color: #ccc;"></i>
      </div>
      <h5 class="text-muted">No emails sent yet</h5>
      <p class="text-muted">Click "Compose Email" to send your first email.</p>
      <a href="{{ route('email.compose') }}" class="btn btn-primary waves-effect waves-light">
        <i class="fi fi-rr-edit me-1"></i> Compose Email
      </a>
    </div>
    @endif
  </div>
</div>
@endsection
