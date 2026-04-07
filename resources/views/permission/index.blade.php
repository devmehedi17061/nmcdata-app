@extends('layouts.dashboard')

@section('title', 'Permissions - HR Management System')

@section('content')
<div class="app-page-head d-flex flex-wrap gap-3 align-items-center justify-content-between">
  <div class="clearfix">
    <h1 class="app-page-title">Permission Management</h1>
    <span>Manage system permissions</span>
  </div>
  <a href="{{ route('permissions.create') }}" class="btn btn-primary waves-effect waves-light">
    <i class="fi fi-rr-plus me-1"></i> Add Permission
  </a>
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex align-items-center justify-content-between border-0 pb-0">
        <h6 class="card-title mb-0">All Permissions</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead class="table-light">
              <tr>
                <th>Permission Name</th>
                <th>Description</th>
                <th>Module</th>
                <th>Roles</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($permissions as $permission)
                <tr>
                  <td><strong>{{ ucfirst(str_replace('_', ' ', $permission->name)) }}</strong></td>
                  <td>{{ $permission->description ?? 'N/A' }}</td>
                  <td>
                    <span class="badge bg-success">{{ $permission->module }}</span>
                  </td>
                  <td>
                    <span class="badge bg-secondary">{{ $permission->roles->count() }} roles</span>
                  </td>
                  <td>
                    <div class="btn-group">
                      <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-warning">
                        <i class="fi fi-rr-pencil"></i>
                      </a>
                      <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                          <i class="fi fi-rr-trash"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center text-muted">No permissions found</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
          @if($permissions->hasPages())
            <nav aria-label="pagination">
              <ul class="pagination">
                @if($permissions->onFirstPage())
                  <li class="page-item disabled">
                    <span class="page-link">
                      <i class="fi fi-rr-angle-left me-1"></i> Previous
                    </span>
                  </li>
                @else
                  <li class="page-item">
                    <a class="page-link" href="{{ $permissions->previousPageUrl() }}" aria-label="Previous">
                      <i class="fi fi-rr-angle-left me-1"></i> Previous
                    </a>
                  </li>
                @endif

                @foreach($permissions->getUrlRange(1, $permissions->lastPage()) as $page => $url)
                  <li class="page-item {{ $page == $permissions->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                  </li>
                @endforeach

                @if($permissions->hasMorePages())
                  <li class="page-item">
                    <a class="page-link" href="{{ $permissions->nextPageUrl() }}" aria-label="Next">
                      Next <i class="fi fi-rr-angle-right ms-1"></i>
                    </a>
                  </li>
                @else
                  <li class="page-item disabled">
                    <span class="page-link">
                      Next <i class="fi fi-rr-angle-right ms-1"></i>
                    </span>
                  </li>
                @endif
              </ul>
            </nav>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
