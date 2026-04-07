@extends('layouts.dashboard')

@section('title', 'User Approval - HR Management System')

@section('content')
<div class="app-page-head d-flex flex-wrap gap-3 align-items-center justify-content-between">
  <div class="clearfix">
    <h1 class="app-page-title">User Approval Management</h1>
    <span>Approve or reject user registration requests</span>
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

<div class="row">
    <!-- Pending Users Section -->
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header bg-warning bg-opacity-10">
                <h5 class="card-title mb-0">
                    <i class="fi fi-rr-time-past me-2 text-warning"></i>Pending Approval
                    <span class="badge bg-warning ms-2">{{ $pendingUsers->count() }}</span>
                </h5>
            </div>
            <div class="card-body">
                @if($pendingUsers->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role Requested</th>
                                    <th>Registered At</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingUsers as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm bg-primary rounded-circle text-white me-2">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                                {{ $user->name }}
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $user->role->name ?? 'N/A' }}</span>
                                        </td>
                                        <td>{{ $user->created_at->format('M d, Y H:i') }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('approval.approve', $user->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success waves-effect" 
                                                        onclick="return confirm('Are you sure you want to approve this user?')">
                                                    <i class="fi fi-rr-check me-1"></i>Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('approval.reject', $user->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger waves-effect" 
                                                        onclick="return confirm('Are you sure you want to reject and delete this user?')">
                                                    <i class="fi fi-rr-cross me-1"></i>Reject
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fi fi-rr-check-circle text-success" style="font-size: 48px;"></i>
                        <p class="text-muted mt-3 mb-0">No pending approval requests</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Approved Users Section -->
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-success bg-opacity-10">
                <h5 class="card-title mb-0">
                    <i class="fi fi-rr-user-check me-2 text-success"></i>Approved Users (All)
                    <span class="badge bg-success ms-2">{{ $approvedUsers->count() }}</span>
                </h5>
            </div>
            <div class="card-body">
                @if($approvedUsers->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Registered At</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($approvedUsers as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm bg-success rounded-circle text-white me-2">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                                {{ $user->name }}
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="badge bg-primary">{{ $user->role->name ?? 'N/A' }}</span>
                                        </td>
                                        <td>{{ $user->created_at->format('M d, Y H:i') }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('approval.revoke', $user->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-warning waves-effect" 
                                                        onclick="return confirm('Are you sure you want to revoke approval for this user?')">
                                                    <i class="fi fi-rr-ban me-1"></i>Revoke
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fi fi-rr-users-alt text-muted" style="font-size: 48px;"></i>
                        <p class="text-muted mt-3 mb-0">No approved users yet</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
