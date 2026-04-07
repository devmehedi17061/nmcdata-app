@extends('layouts.dashboard')

@section('title', 'My Leave Requests - HR Management System')

@section('content')
<div class="app-page-head d-flex flex-wrap gap-3 align-items-center justify-content-between">
  <div class="clearfix">
    <h1 class="app-page-title">My Leave Requests</h1>
    <span>View and manage your leave requests</span>
  </div>
  <div class="clearfix">
    <a href="{{ route('leave.create') }}" class="btn btn-primary waves-effect waves-light">
      <i class="fi fi-rr-calendar me-2"></i>Request Leave
    </a>
  </div>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fi fi-rr-check me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fi fi-rr-calendar me-2"></i>Leave History
                </h5>
            </div>
            <div class="card-body">
                @if($leaveRequests->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Leave Type</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Days</th>
                                    <th>Status</th>
                                    <th>Applied On</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($leaveRequests as $index => $leave)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $leave->leave_type_name }}</span>
                                        </td>
                                        <td>{{ $leave->start_date->format('M d, Y') }}</td>
                                        <td>{{ $leave->end_date->format('M d, Y') }}</td>
                                        <td>{{ $leave->total_days }} day(s)</td>
                                        <td>
                                            @if($leave->status === 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif($leave->status === 'approved')
                                                <span class="badge bg-success">Approved</span>
                                            @else
                                                <span class="badge bg-danger">Rejected</span>
                                            @endif
                                        </td>
                                        <td>{{ $leave->created_at->format('M d, Y') }}</td>
                                        <td>
                                            @if($leave->status === 'pending')
                                                <button class="btn btn-sm btn-link text-danger" data-bs-toggle="modal" data-bs-target="#cancelModal{{ $leave->id }}">
                                                    <i class="fi fi-rr-cross me-1"></i>Cancel
                                                </button>
                                                
                                                <div class="modal fade" id="cancelModal{{ $leave->id }}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Cancel Leave Request</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to cancel this leave request?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                                <form action="{{ route('leave.cancel', $leave->id) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Yes, Cancel</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <button class="btn btn-sm btn-link" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $leave->id }}">
                                                    <i class="fi fi-rr-eye me-1"></i>Details
                                                </button>
                                                
                                                <div class="modal fade" id="detailsModal{{ $leave->id }}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Leave Request Details</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><strong>Reason:</strong></p>
                                                                <p>{{ $leave->reason }}</p>
                                                                @if($leave->remarks)
                                                                    <p><strong>Admin Remarks:</strong></p>
                                                                    <p>{{ $leave->remarks }}</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fi fi-rr-calendar text-muted" style="font-size: 64px;"></i>
                        <h5 class="mt-3">No leave requests yet</h5>
                        <p class="text-muted">Submit your first leave request</p>
                        <a href="{{ route('leave.create') }}" class="btn btn-primary waves-effect waves-light mt-2">
                            <i class="fi fi-rr-calendar me-2"></i>Request Leave
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
