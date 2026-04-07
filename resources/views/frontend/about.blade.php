@extends('layouts.frontend')

@section('title', 'About Us - NMC HR System')

@section('meta_description', 'Learn about NMC HR System - Empowering organizations through strategic human resource management and innovative workplace solutions.')

@section('content')
<!-- Page Header -->
<header class="page-header">
    <div class="container py-5 text-center">
        <h1 class="fw-bold mb-3" data-aos="fade-up">About Our <span class="text-accent">Mission</span></h1>
        <p class="lead text-muted mx-auto" style="max-width: 700px;" data-aos="fade-up" data-aos-delay="100">
            Empowering organizations through strategic human resource management and innovative workplace solutions.
        </p>
    </div>
</header>

<!-- Main Content -->
<section class="container py-5">
    <div class="row g-5 align-items-center">
        <div class="col-lg-6" data-aos="fade-right">
            <h2 class="fw-bold mb-4">Driving Workplace Excellence</h2>
            <p class="text-muted">NMC HR System is dedicated to empowering organizations through strategic HR management, employee engagement, diversity & inclusion, and advanced HR technologies. We believe that a company's greatest asset is its people.</p>
            <p class="text-muted">Since our inception, we have helped numerous companies navigate the complexities of the modern workplace, transforming HR from a functional department into a strategic powerhouse.</p>
            
            <div class="row mt-4 g-4">
                <div class="col-sm-6">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill text-accent fs-4"></i>
                        <span class="fw-semibold">Employee Management</span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill text-accent fs-4"></i>
                        <span class="fw-semibold">Leave Tracking</span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill text-accent fs-4"></i>
                        <span class="fw-semibold">Role Management</span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill text-accent fs-4"></i>
                        <span class="fw-semibold">Data Security</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6" data-aos="fade-left">
            <div class="p-5 bg-white rounded-4 shadow-sm border">
                <div class="mb-4">
                    <h4 class="fw-bold"><i class="bi bi-shield-check text-accent me-2"></i> Our Mission</h4>
                    <p class="text-muted mb-0">To create positive workplace cultures that drive success and innovation through human-centric design and data-driven insights.</p>
                </div>
                <hr>
                <div>
                    <h4 class="fw-bold"><i class="bi bi-eye text-accent me-2"></i> Our Vision</h4>
                    <p class="text-muted mb-0">To be a leading provider of modern HR solutions, redefining how organizations connect with and grow their talent.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Our Core Values</h2>
            <p class="text-muted mx-auto" style="max-width: 600px;">The principles that guide everything we do</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="service-card text-center">
                    <div class="service-icon mx-auto"><i class="bi bi-heart"></i></div>
                    <h5>People First</h5>
                    <p class="text-muted small">We believe in putting people at the center of everything we do, creating solutions that truly serve human needs.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="service-card text-center">
                    <div class="service-icon mx-auto"><i class="bi bi-lightbulb"></i></div>
                    <h5>Innovation</h5>
                    <p class="text-muted small">We continuously evolve our platform with the latest technologies to stay ahead of HR challenges.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="service-card text-center">
                    <div class="service-icon mx-auto"><i class="bi bi-shield-lock"></i></div>
                    <h5>Trust & Security</h5>
                    <p class="text-muted small">Your data security is our top priority. We implement industry-leading security measures.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-5">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Meet Our <span class="text-accent">Team</span></h2>
            <p class="text-muted mx-auto" style="max-width: 600px;">The talented people behind our success</p>
        </div>
        <div class="row g-4">
            @forelse($employees as $employee)
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 100 }}">
                <div class="team-card bg-white rounded-4 shadow-sm overflow-hidden h-100">
                    <div class="team-image-wrapper">
                        <img src="{{ $employee->photo ? asset('storage/' . $employee->photo) : asset('assets/images/avatar/avatar1.webp') }}" alt="{{ $employee->name }}" class="team-image">
                    </div>
                    <div class="p-4 text-center">
                        <h5 class="fw-bold mb-1">{{ $employee->name }}</h5>
                        <p class="text-accent small mb-3">{{ $employee->position }}</p>
                        <div class="team-contact">
                            @if($employee->email)
                            <a href="mailto:{{ $employee->email }}" class="d-block text-muted small mb-1" title="{{ $employee->email }}">
                                <i class="bi bi-envelope me-1"></i>{{ Str::limit($employee->email, 20) }}
                            </a>
                            @endif
                            @if($employee->phone)
                            <a href="tel:{{ $employee->phone }}" class="d-block text-muted small">
                                <i class="bi bi-telephone me-1"></i>{{ $employee->phone }}
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">No team members to display at this time.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Why Choose Us</h2>
            <p class="text-muted mx-auto" style="max-width: 600px;">We're committed to delivering excellence in HR management</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="100">
                <div class="text-center p-4">
                    <div class="display-4 fw-bold text-accent mb-2">100+</div>
                    <p class="text-muted mb-0">Happy Clients</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="200">
                <div class="text-center p-4">
                    <div class="display-4 fw-bold text-accent mb-2">5K+</div>
                    <p class="text-muted mb-0">Employees Managed</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
                <div class="text-center p-4">
                    <div class="display-4 fw-bold text-accent mb-2">99%</div>
                    <p class="text-muted mb-0">Uptime Guarantee</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="400">
                <div class="text-center p-4">
                    <div class="display-4 fw-bold text-accent mb-2">24/7</div>
                    <p class="text-muted mb-0">Support Available</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-primary text-white">
    <div class="container py-5 text-center">
        <h2 class="fw-bold mb-4" data-aos="fade-up">Ready to Transform Your HR?</h2>
        <p class="lead opacity-75 mb-4" data-aos="fade-up" data-aos-delay="100">Join hundreds of companies already using NMC HR System</p>
        <div data-aos="fade-up" data-aos-delay="200">
            <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5 me-2">Get Started Free</a>
            <a href="{{ route('frontend.contact') }}" class="btn btn-outline-light btn-lg px-5">Contact Us</a>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
    .team-card {
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1) !important;
    }
    
    .team-image-wrapper {
        height: 200px;
        overflow: hidden;
        background: var(--bg-light);
    }
    
    .team-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .team-card:hover .team-image {
        transform: scale(1.1);
    }
    
    .team-contact a {
        text-decoration: none;
        transition: color 0.2s ease;
    }
    
    .team-contact a:hover {
        color: var(--accent) !important;
    }
</style>
@endsection
