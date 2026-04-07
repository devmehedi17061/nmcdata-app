@extends('layouts.dashboard')

@section('title', 'My Files - HR Management System')

@section('content')
<div class="app-page-head d-flex flex-wrap gap-3 align-items-center justify-content-between">
  <div class="clearfix">
    <h1 class="app-page-title">My Files</h1>
    <span>Manage your uploaded files</span>
  </div>
  <div class="clearfix">
    <a href="{{ route('files.create') }}" class="btn btn-primary waves-effect waves-light">
      <i class="fi fi-rr-upload me-2"></i>Upload File
    </a>
  </div>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fi fi-rr-check me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fi fi-rr-cross me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fi fi-rr-folder-open me-2"></i>Uploaded Files
                    <span class="badge bg-primary ms-2">{{ $files->count() }}</span>
                </h5>
            </div>
            <div class="card-body">
                @if($files->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>File Name</th>
                                    <th>Size</th>
                                    <th>Type</th>
                                    <th>Visibility</th>
                                    <th>Uploaded</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($files as $index => $file)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <strong>{{ $file->title }}</strong>
                                            @if($file->description)
                                                <br><small class="text-muted">{{ Str::limit($file->description, 50) }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <i class="fi {{ $file->file_icon }} me-2 text-primary"></i>
                                            {{ $file->file_name }}
                                        </td>
                                        <td>{{ $file->formatted_size }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $file->file_type }}</span>
                                        </td>
                                        <td>
                                            @if($file->is_public)
                                                <span class="badge bg-success"><i class="fi fi-rr-world me-1"></i>Public</span>
                                            @else
                                                <span class="badge bg-secondary"><i class="fi fi-rr-lock me-1"></i>Private</span>
                                            @endif
                                        </td>
                                        <td>{{ $file->created_at->format('M d, Y') }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('files.show', $file->id) }}" class="btn btn-sm btn-info waves-effect" title="View">
                                                    <i class="fi fi-rr-eye"></i>
                                                </a>
                                                <a href="{{ route('files.download', $file->id) }}" class="btn btn-sm btn-primary waves-effect" title="Download">
                                                    <i class="fi fi-rr-download"></i>
                                                </a>
                                                <form action="{{ route('files.destroy', $file->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger waves-effect" title="Delete"
                                                            onclick="return confirm('Are you sure you want to delete this file?')">
                                                        <i class="fi fi-rr-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fi fi-rr-folder-open text-muted" style="font-size: 64px;"></i>
                        <h5 class="mt-3">No files uploaded yet</h5>
                        <p class="text-muted">Upload your first file to get started</p>
                        <a href="{{ route('files.create') }}" class="btn btn-primary waves-effect waves-light mt-2">
                            <i class="fi fi-rr-upload me-2"></i>Upload File
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
