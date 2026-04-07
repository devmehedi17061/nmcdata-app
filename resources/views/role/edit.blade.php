@extends('layouts.dashboard')

@section('title', 'Edit Role - HR Management System')

@section('content')
<div class="app-page-head d-flex flex-wrap gap-3 align-items-center justify-content-between">
  <div class="clearfix">
    <h1 class="app-page-title">Edit Role</h1>
    <span>Update role and permissions</span>
  </div>
  <a href="{{ route('roles.index') }}" class="btn btn-outline-primary waves-effect waves-light">
    <i class="fi fi-rr-arrow-left me-1"></i> Back to Roles
  </a>
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <form action="{{ route('roles.update', $role->id) }}" method="POST">
          @csrf
          @method('PUT')
          
          <div class="mb-3">
            <label for="name" class="form-label">Role Name *</label>
            <input type="text" class="form-control @error('name') is-invalid @endif" 
                   id="name" name="name" value="{{ old('name', $role->name) }}" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $role->description) }}</textarea>
          </div>

          <h5 class="mt-4 mb-3">Assign Permissions</h5>
          <div class="row">
            @php
                $groupedPermissions = $allPermissions->groupBy('module');
            @endphp
            @foreach($groupedPermissions as $module => $permissions)
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">{{ ucfirst($module) }}</h6>
                        </div>
                        <div class="card-body">
                            @foreach($permissions as $permission)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="permission{{ $permission->id }}" 
                                           name="permissions[]" value="{{ $permission->id }}"
                                           {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $permission->id }}">
                                        {{ ucfirst(str_replace('_', ' ', $permission->name)) }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
          </div>

          <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-primary waves-effect waves-light">
              <i class="fi fi-rr-save me-1"></i> Update Role
            </button>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary waves-effect waves-light">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
