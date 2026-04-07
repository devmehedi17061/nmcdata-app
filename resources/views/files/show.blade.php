@extends('layouts.dashboard')

@section('title', $file->title . ' - HR Management System')

@section('content')
<div class="app-page-head d-flex flex-wrap gap-3 align-items-center justify-content-between">
  <div class="clearfix">
    <h1 class="app-page-title">{{ $file->title }}</h1>
    <span>File Details</span>
  </div>
  <div class="clearfix">
    <a href="{{ route('files.index') }}" class="btn btn-outline-secondary waves-effect">
      <i class="fi fi-rr-arrow-left me-2"></i>Back to Files
    </a>
  </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fi {{ $file->file_icon }} me-2"></i>File Preview
                </h5>
            </div>
            <div class="card-body text-center py-5">
                @if(Str::contains($file->file_type, 'image'))
                    <img src="{{ $file->file_url }}" alt="{{ $file->title }}" class="img-fluid rounded" style="max-height: 400px;">
                @elseif(Str::contains($file->file_type, 'pdf'))
                    <div class="pdf-preview">
                        <i class="fi fi-rr-file-pdf text-danger" style="font-size: 80px;"></i>
                        <p class="mt-3">PDF Document</p>
                    </div>
                @else
                    <div class="file-preview">
                        <i class="fi {{ $file->file_icon }} text-primary" style="font-size: 80px;"></i>
                        <p class="mt-3">{{ $file->file_name }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">File Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td class="text-muted">Title</td>
                        <td><strong>{{ $file->title }}</strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted">File Name</td>
                        <td>{{ $file->file_name }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">File Size</td>
                        <td>{{ $file->formatted_size }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Type</td>
                        <td><span class="badge bg-info">{{ $file->file_type }}</span></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Visibility</td>
                        <td>
                            @if($file->is_public)
                                <span class="badge bg-success"><i class="fi fi-rr-world me-1"></i>Public</span>
                            @else
                                <span class="badge bg-secondary"><i class="fi fi-rr-lock me-1"></i>Private</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Uploaded By</td>
                        <td>{{ $file->user->name }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Uploaded Date</td>
                        <td>{{ $file->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                    @if($file->description)
                    <tr>
                        <td class="text-muted">Description</td>
                        <td>{{ $file->description }}</td>
                    </tr>
                    @endif
                </table>
            </div>
            <div class="card-footer">
                <div class="d-grid gap-2">
                    <a href="{{ route('files.download', $file->id) }}" class="btn btn-primary waves-effect">
                        <i class="fi fi-rr-download me-2"></i>Download File
                    </a>
                    @if($file->user_id === Auth::id() || Auth::user()->isSuperAdmin())
                        <form action="{{ route('files.destroy', $file->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger waves-effect w-100"
                                    onclick="return confirm('Are you sure you want to delete this file?')">
                                <i class="fi fi-rr-trash me-2"></i>Delete File
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
