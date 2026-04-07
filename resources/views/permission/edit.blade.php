@extends('layouts.dashboard')

@section('title', 'Edit Permission - HR Management System')

@section('content')
<div class="app-page-head d-flex flex-wrap gap-3 align-items-center justify-content-between">
  <div class="clearfix">
    <h1 class="app-page-title">Edit Permission</h1>
    <span>Update permission details</span>
  </div>
  <a href="{{ route('permissions.index') }}" class="btn btn-outline-primary waves-effect waves-light">
    <i class="fi fi-rr-arrow-left me-1"></i> Back to Permissions
  </a>
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
          @csrf
          @method('PUT')
          
          <div class="mb-3">
            <label for="name" class="form-label">Permission Name *</label>
            <input type="text" class="form-control @error('name') is-invalid @endif" 
                   id="name" name="name" value="{{ old('name', $permission->name) }}" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $permission->description) }}</textarea>
          </div>

          <div class="mb-3">
            <label for="module" class="form-label">Module *</label>
            <select class="form-select @error('module') is-invalid @endif" id="module" name="module" required>
              <option value="">Select Module</option>
              <option value="dashboard" {{ old('module', $permission->module) === 'dashboard' ? 'selected' : '' }}>Dashboard</option>
              <option value="employee" {{ old('module', $permission->module) === 'employee' ? 'selected' : '' }}>Employee</option>
              <option value="role" {{ old('module', $permission->module) === 'role' ? 'selected' : '' }}>Role</option>
              <option value="permission" {{ old('module', $permission->module) === 'permission' ? 'selected' : '' }}>Permission</option>
              <option value="general" {{ old('module', $permission->module) === 'general' ? 'selected' : '' }}>General</option>
            </select>
            @error('module')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary waves-effect waves-light">
              <i class="fi fi-rr-save me-1"></i> Update Permission
            </button>
            <a href="{{ route('permissions.index') }}" class="btn btn-secondary waves-effect waves-light">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
