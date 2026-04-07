@extends('layouts.dashboard')

@section('title', 'Create Role - HR Management System')

@section('content')
<h2 class="mb-4">Create New Role</h2>

<div class="card">
    <div class="card-body">
        <form action="/roles" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="name" class="form-label">Role Name *</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name') }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Create Role
                </button>
                <a href="/roles" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
