@extends('layouts.dashboard')

@section('title', 'Roles - HR Management System')

@section('content')
<div class="app-page-head d-flex flex-wrap gap-3 align-items-center justify-content-between">
  <div class="clearfix">
    <h1 class="app-page-title">Role Management</h1>
    <span>Manage user roles and permissions</span>
  </div>
  <a href="{{ route('roles.create') }}" class="btn btn-primary waves-effect waves-light">
    <i class="fi fi-rr-plus me-1"></i> Add Role
  </a>
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex align-items-center justify-content-between border-0 pb-0">
        <h6 class="card-title mb-0">All Roles</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead class="table-light">
              <tr>
                <th>Role Name</th>
                <th>Description</th>
                <th>Permissions</th>
                <th>Users</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($roles as $role)
                <tr>
                  <td><strong>{{ $role->name }}</strong></td>
                  <td>{{ $role->description ?? 'N/A' }}</td>
                  <td>
                    <span class="badge bg-info">{{ $role->permissions->count() }} permissions</span>
                  </td>
                  <td>
                    <span class="badge bg-secondary">{{ $role->users->count() }} users</span>
                  </td>
                  <td>
                    <div class="btn-group">
                      <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-warning">
                        <i class="fi fi-rr-pencil"></i>
                      </a>
                      <a href="{{ route('roles.assign-permissions', $role->id) }}" class="btn btn-sm btn-info">
                        <i class="fi fi-rr-lock"></i>
                      </a>
                      @if($role->users()->count() === 0 && !in_array($role->name, ['Admin', 'HR', 'Employee']))
                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                            <i class="fi fi-rr-trash"></i>
                          </button>
                        </form>
                      @endif
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center text-muted">No roles found</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
          {{ $roles->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
