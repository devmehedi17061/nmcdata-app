@extends('layouts.dashboard')

@section('title', 'Leave Requests - HR Management System')

@section('content')
<div class="app-page-head d-flex flex-wrap gap-3 align-items-center justify-content-between">
  <div class="clearfix">
    <h1 class="app-page-title">Leave Requests</h1>
    <span>Manage employee leave requests</span>
  </div>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fi fi-rr-check me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="fi fi-rr-exclamation me-2"></i>{{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Pending Leave Requests -->
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header bg-warning bg-opacity-10">
                <h5 class="card-title mb-0">
                    <i class="fi fi-rr-time-past me-2 text-warning"></i>Pending Leave Requests
                    <span class="badge bg-warning ms-2">{{ $pendingLeaves->count() }}</span>
                </h5>
            </div>
            <div class="card-body">
                @if($pendingLeaves->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Employee</th>
                                    <th>Leave Type</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Days</th>
                                    <th>Reason</th>
                                    <th>Applied</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingLeaves as $index => $leave)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm bg-primary rounded-circle text-white me-2">
                                                    {{ strtoupper(substr($leave->user->name, 0, 1)) }}
                                                </div>
                                                {{ $leave->user->name }}
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $leave->leave_type_name }}</span>
                                        </td>
                                        <td>{{ $leave->start_date->format('M d, Y') }}</td>
                                        <td>{{ $leave->end_date->format('M d, Y') }}</td>
                                        <td>{{ $leave->total_days }} day(s)</td>
                                        <td>
                                            <button class="btn btn-sm btn-link" data-bs-toggle="modal" data-bs-target="#reasonModal{{ $leave->id }}">
                                                View Reason
                                            </button>
                                            <div class="modal fade" id="reasonModal{{ $leave->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Leave Reason</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>{{ $leave->reason }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $leave->created_at->format('M d, Y') }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-sm btn-success waves-effect" data-bs-toggle="modal" data-bs-target="#approveModal{{ $leave->id }}">
                                                    <i class="fi fi-rr-check me-1"></i>Approve
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger waves-effect" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $leave->id }}">
                                                    <i class="fi fi-rr-cross me-1"></i>Reject
                                                </button>
                                            </div>
                                            
                                            <!-- Approve Modal -->
                                            <div class="modal fade" id="approveModal{{ $leave->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('leave.approve', $leave->id) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Approve Leave Request</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to approve leave request for <strong>{{ $leave->user->name }}</strong>?</p>
                                                                <div class="mb-3">
                                                                    <label for="remarks" class="form-label">Remarks (Optional)</label>
                                                                    <textarea class="form-control" name="remarks" rows="2" placeholder="Add any remarks..."></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-success">Approve</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Reject Modal -->
                                            <div class="modal fade" id="rejectModal{{ $leave->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('leave.reject', $leave->id) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Reject Leave Request</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to reject leave request for <strong>{{ $leave->user->name }}</strong>?</p>
                                                                <div class="mb-3">
                                                                    <label for="remarks" class="form-label">Reason for Rejection</label>
                                                                    <textarea class="form-control" name="remarks" rows="2" placeholder="Provide reason for rejection..." required></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-danger">Reject</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fi fi-rr-check-circle text-success" style="font-size: 48px;"></i>
                        <p class="text-muted mt-3">No pending leave requests</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Approved Leave Requests -->
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header bg-success bg-opacity-10">
                <h5 class="card-title mb-0">
                    <i class="fi fi-rr-check me-2 text-success"></i>Approved Leave Requests
                    <span class="badge bg-success ms-2">{{ $approvedLeaves->count() }}</span>
                </h5>
            </div>
            <div class="card-body">
                @if($approvedLeaves->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Employee</th>
                                    <th>Leave Type</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Days</th>
                                    <th>Approved By</th>
                                    <th>Approved Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($approvedLeaves as $index => $leave)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $leave->user->name }}</td>
                                        <td><span class="badge bg-info">{{ $leave->leave_type_name }}</span></td>
                                        <td>{{ $leave->start_date->format('M d, Y') }}</td>
                                        <td>{{ $leave->end_date->format('M d, Y') }}</td>
                                        <td>{{ $leave->total_days }} day(s)</td>
                                        <td>{{ $leave->approver->name ?? 'N/A' }}</td>
                                        <td>{{ $leave->approved_at->format('M d, Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <p class="text-muted mb-0">No approved leave requests</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Rejected Leave Requests -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-danger bg-opacity-10">
                <h5 class="card-title mb-0">
                    <i class="fi fi-rr-cross me-2 text-danger"></i>Rejected Leave Requests
                    <span class="badge bg-danger ms-2">{{ $rejectedLeaves->count() }}</span>
                </h5>
            </div>
            <div class="card-body">
                @if($rejectedLeaves->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Employee</th>
                                    <th>Leave Type</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Days</th>
                                    <th>Rejected By</th>
                                    <th>Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rejectedLeaves as $index => $leave)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $leave->user->name }}</td>
                                        <td><span class="badge bg-info">{{ $leave->leave_type_name }}</span></td>
                                        <td>{{ $leave->start_date->format('M d, Y') }}</td>
                                        <td>{{ $leave->end_date->format('M d, Y') }}</td>
                                        <td>{{ $leave->total_days }} day(s)</td>
                                        <td>{{ $leave->approver->name ?? 'N/A' }}</td>
                                        <td>{{ $leave->remarks ?? 'No reason provided' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <p class="text-muted mb-0">No rejected leave requests</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
