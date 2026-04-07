@extends('layouts.frontend')

@section('title', 'Public Files - HR Management System')

@section('content')
<!-- Page Content -->
<main class="page-content">
    <!-- Our Services -->
    <section class="section-90 section-lg-0 section-lg-bottom-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="section-header text-center">
                        <h2 class="section-title">Public Files</h2>
                        <p class="section-subtitle">Browse and download shared files</p>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fi fi-rr-check me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($files->count() > 0)
                <div class="row row-30">
                    @foreach($files as $file)
                        <div class="col-md-6 col-lg-4">
                            <div class="card file-card h-100">
                                <div class="card-body text-center">
                                    <i class="fi {{ $file->file_icon }} text-primary" style="font-size: 48px;"></i>
                                    <h5 class="card-title mt-3">{{ $file->title }}</h5>
                                    @if($file->description)
                                        <p class="card-text text-muted small">{{ Str::limit($file->description, 80) }}</p>
                                    @endif
                                    <div class="file-meta mt-3">
                                        <span class="badge bg-secondary">{{ $file->formatted_size }}</span>
                                        <span class="badge bg-info">{{ $file->user->name }}</span>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent border-0">
                                    <a href="{{ route('files.download', $file->id) }}" class="btn btn-primary w-100">
                                        <i class="fi fi-rr-download me-2"></i>Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fi fi-rr-folder-open text-muted" style="font-size: 64px;"></i>
                    <h5 class="mt-3">No public files available</h5>
                    <p class="text-muted">Check back later for shared files</p>
                </div>
            @endif
        </div>
    </section>
</main>

<style>
.file-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.file-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}
.file-meta {
    display: flex;
    gap: 8px;
    justify-content: center;
    flex-wrap: wrap;
}
</style>
@endsection
