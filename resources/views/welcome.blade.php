@extends('layouts.frontend')

@section('title', 'NMC HR Management System - Home')

@section('meta_description', 'NMC HR System - Manage employees, attendance, leave requests and more in one place. Streamline your HR operations with our modern platform.')

@section('content')
<!-- Hero Section -->
<section class="hero overflow-hidden">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3">Next-Gen HR Platform</span>
                <h1 class="display-3 fw-bold mb-4">Smart <span class="text-accent">HR Management</span> Solution</h1>
                <p class="lead mb-5">Manage employees, attendance, leave requests & reports in one place. Streamline your operations and empower your workforce with our data-driven ecosystem.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-4">Get Started Free</a>
                    <a href="{{ route('login') }}" class="btn btn-outline-custom btn-lg px-4">Client Login</a>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                <div class="position-relative">
                    <div class="bg-light rounded-4 p-4 shadow-lg">
                        <div class="d-flex align-items-center mb-3">
                            <div class="d-flex gap-1">
                                <span class="bg-danger rounded-circle" style="width: 12px; height: 12px;"></span>
                                <span class="bg-warning rounded-circle" style="width: 12px; height: 12px;"></span>
                                <span class="bg-success rounded-circle" style="width: 12px; height: 12px;"></span>
                            </div>
                        </div>
                        <div class="bg-white rounded-3 p-4">
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="bg-primary-subtle rounded-3 p-3 text-center">
                                        <i class="bi bi-people fs-1 text-primary"></i>
                                        <h6 class="mt-2 mb-0">Employees</h6>
                                        <span class="text-muted small">Manage Team</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-success-subtle rounded-3 p-3 text-center">
                                        <i class="bi bi-calendar-check fs-1 text-success"></i>
                                        <h6 class="mt-2 mb-0">Leave</h6>
                                        <span class="text-muted small">Track Requests</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-warning-subtle rounded-3 p-3 text-center">
                                        <i class="bi bi-folder fs-1 text-warning"></i>
                                        <h6 class="mt-2 mb-0">Files</h6>
                                        <span class="text-muted small">Documents</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-info-subtle rounded-3 p-3 text-center">
                                        <i class="bi bi-shield-check fs-1 text-info"></i>
                                        <h6 class="mt-2 mb-0">Roles</h6>
                                        <span class="text-muted small">Permissions</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="position-absolute bottom-0 start-0 m-4 p-3 bg-white rounded-3 shadow-sm border-start border-4 border-primary d-none d-md-block" style="max-width: 200px;" data-aos="zoom-in" data-aos-delay="400">
                        <p class="mb-0 small fw-bold text-dark">"Empowering organizations worldwide."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About The System -->
<section class="py-5">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-up">
                <h2 class="section-title mb-4">Why Modern HR Needs a <span class="text-accent">Smart Solution</span></h2>
                <p class="text-muted">Manual HR management is prone to errors, paperwork heavy, and time-consuming. From tedious attendance tracking to complex leave management, legacy systems hold your business back.</p>
                <div class="row mt-4 g-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-file-earmark-diff text-accent fs-4"></i>
                            <span class="fw-semibold">Reduce Paperwork</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-clock-history text-accent fs-4"></i>
                            <span class="fw-semibold">Save Time</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-lightning-charge text-accent fs-4"></i>
                            <span class="fw-semibold">Fast Processing</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-shield-lock text-accent fs-4"></i>
                            <span class="fw-semibold">Data Security</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
                <div class="p-5 bg-light rounded-4 border">
                    <h5 class="fw-bold mb-3">The Problem with Manual HR</h5>
                    <ul class="list-unstyled text-muted mb-0">
                        <li class="mb-2"><i class="bi bi-x-circle text-danger me-2"></i> Difficulty tracking employee information</li>
                        <li class="mb-2"><i class="bi bi-x-circle text-danger me-2"></i> Manual leave request management</li>
                        <li class="mb-2"><i class="bi bi-x-circle text-danger me-2"></i> No centralized document storage</li>
                        <li><i class="bi bi-x-circle text-danger me-2"></i> Unsecured employee sensitive data</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Core Features -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Core Features</h2>
            <p class="text-muted mx-auto" style="max-width: 600px;">Experience the real power of an automated HR ecosystem with our integrated tools.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="service-card">
                    <div class="service-icon"><i class="bi bi-people"></i></div>
                    <h5>Employee Management</h5>
                    <p class="text-muted small">Comprehensive database for employee profiles, documents, and history.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="service-card">
                    <div class="service-icon"><i class="bi bi-calendar-event"></i></div>
                    <h5>Leave Management</h5>
                    <p class="text-muted small">Streamlined leave requests, approvals, and balance tracking.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="service-card">
                    <div class="service-icon"><i class="bi bi-shield-check"></i></div>
                    <h5>Role & Permissions</h5>
                    <p class="text-muted small">Granular access control for Admins, HR Managers, and Employees.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="service-card">
                    <div class="service-icon"><i class="bi bi-folder"></i></div>
                    <h5>File Management</h5>
                    <p class="text-muted small">Secure document storage and sharing with access controls.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="service-card">
                    <div class="service-icon"><i class="bi bi-person-check"></i></div>
                    <h5>User Approval</h5>
                    <p class="text-muted small">Control who joins your organization with approval workflows.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="service-card">
                    <div class="service-icon"><i class="bi bi-bar-chart-line"></i></div>
                    <h5>Dashboard & Reports</h5>
                    <p class="text-muted small">Real-time insights into your workforce with visual dashboards.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="py-5">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">How It Works</h2>
            <p class="text-muted">Simple steps to digitize your HR operations.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                <div class="step-item">
                    <div class="step-number">1</div>
                    <h6 class="fw-bold">Register</h6>
                    <p class="small text-muted">Create your account and wait for approval.</p>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                <div class="step-item">
                    <div class="step-number">2</div>
                    <h6 class="fw-bold">Add Employees</h6>
                    <p class="small text-muted">Add your team members to the platform.</p>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
                <div class="step-item">
                    <div class="step-number">3</div>
                    <h6 class="fw-bold">Manage Leave</h6>
                    <p class="small text-muted">Handle leave requests efficiently.</p>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
                <div class="step-item">
                    <div class="step-number">4</div>
                    <h6 class="fw-bold">Track & Report</h6>
                    <p class="small text-muted">Get insights with real-time dashboards.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="py-5 bg-primary text-white">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold text-white">Why Choose Us</h2>
            <p class="opacity-75">The benefits of switching to an intelligent HR system.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="d-flex gap-3">
                    <div class="fs-1"><i class="bi bi-cloud-check"></i></div>
                    <div>
                        <h6 class="fw-bold text-white">Cloud Based</h6>
                        <p class="small opacity-75">Access your data securely from anywhere, anytime.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="d-flex gap-3">
                    <div class="fs-1"><i class="bi bi-shield-lock"></i></div>
                    <div>
                        <h6 class="fw-bold text-white">Secure & Private</h6>
                        <p class="small opacity-75">Your sensitive employee data is encrypted and protected.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="d-flex gap-3">
                    <div class="fs-1"><i class="bi bi-hand-thumbs-up"></i></div>
                    <div>
                        <h6 class="fw-bold text-white">Easy To Use</h6>
                        <p class="small opacity-75">Zero learning curve with our intuitive UX design.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-5">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-md-3" data-aos="zoom-in" data-aos-delay="100">
                <div class="text-center">
                    <div class="display-4 fw-bold text-accent">100+</div>
                    <p class="text-muted mb-0">Organizations</p>
                </div>
            </div>
            <div class="col-md-3" data-aos="zoom-in" data-aos-delay="200">
                <div class="text-center">
                    <div class="display-4 fw-bold text-accent">5K+</div>
                    <p class="text-muted mb-0">Employees</p>
                </div>
            </div>
            <div class="col-md-3" data-aos="zoom-in" data-aos-delay="300">
                <div class="text-center">
                    <div class="display-4 fw-bold text-accent">99%</div>
                    <p class="text-muted mb-0">Uptime</p>
                </div>
            </div>
            <div class="col-md-3" data-aos="zoom-in" data-aos-delay="400">
                <div class="text-center">
                    <div class="display-4 fw-bold text-accent">24/7</div>
                    <p class="text-muted mb-0">Support</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Slider Section -->
@if($employees->count() > 0)
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Our <span class="text-accent">Team</span></h2>
            <p class="text-muted">Meet the talented people behind our success</p>
        </div>
        <div class="position-relative" data-aos="fade-up" data-aos-delay="100">
            <div class="team-slider-container">
                <div class="team-slider" id="teamSlider">
                    @foreach($employees as $employee)
                    <div class="team-slide">
                        <div class="team-card bg-white rounded-4 shadow-sm overflow-hidden h-100">
                            <div class="team-image-wrapper">
                                <img src="{{ $employee->photo ? asset('storage/' . $employee->photo) : asset('assets/images/avatar/avatar1.webp') }}" alt="{{ $employee->name }}" class="team-image">
                            </div>
                            <div class="p-4 text-center">
                                <h5 class="fw-bold mb-1">{{ $employee->name }}</h5>
                                <p class="text-accent small mb-3">{{ $employee->position }}</p>
                                <div class="team-contact">
                                    @if($employee->email)
                                    <span class="d-block text-muted small mb-1">
                                        <i class="bi bi-envelope me-1"></i>{{ Str::limit($employee->email, 18) }}
                                    </span>
                                    @endif
                                    @if($employee->phone)
                                    <span class="d-block text-muted small">
                                        <i class="bi bi-telephone me-1"></i>{{ $employee->phone }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- Slider Controls -->
            <button class="slider-btn slider-btn-prev" id="sliderPrev">
                <i class="bi bi-chevron-left"></i>
            </button>
            <button class="slider-btn slider-btn-next" id="sliderNext">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('frontend.about') }}" class="btn btn-outline-custom">View All Team Members</a>
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="py-5">
    <div class="container py-5 text-center">
        <h2 class="section-title mb-4" data-aos="fade-up">Ready to Get Started?</h2>
        <p class="lead text-muted mb-4" data-aos="fade-up" data-aos-delay="100">Join hundreds of companies already using NMC HR System</p>
        <div data-aos="fade-up" data-aos-delay="200">
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5 me-2">Start Free Trial</a>
            <a href="{{ route('frontend.contact') }}" class="btn btn-outline-custom btn-lg px-5">Contact Us</a>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
    .team-slider-container {
        overflow: hidden;
        margin: 0 -10px;
    }
    
    .team-slider {
        display: flex;
        transition: transform 0.5s ease;
        gap: 20px;
    }
    
    .team-slide {
        flex: 0 0 calc(25% - 15px);
        min-width: calc(25% - 15px);
    }
    
    @media (max-width: 991px) {
        .team-slide {
            flex: 0 0 calc(33.333% - 14px);
            min-width: calc(33.333% - 14px);
        }
    }
    
    @media (max-width: 767px) {
        .team-slide {
            flex: 0 0 calc(50% - 10px);
            min-width: calc(50% - 10px);
        }
    }
    
    @media (max-width: 575px) {
        .team-slide {
            flex: 0 0 100%;
            min-width: 100%;
        }
    }
    
    .team-card {
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1) !important;
    }
    
    .team-image-wrapper {
        height: 180px;
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
    
    .slider-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--white);
        border: 1px solid rgba(0, 0, 0, 0.1);
        color: var(--primary);
        font-size: 1.25rem;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: var(--shadow);
    }
    
    .slider-btn:hover {
        background: var(--accent);
        color: var(--white);
        border-color: var(--accent);
    }
    
    .slider-btn-prev {
        left: -25px;
    }
    
    .slider-btn-next {
        right: -25px;
    }
    
    @media (max-width: 767px) {
        .slider-btn-prev {
            left: 10px;
        }
        .slider-btn-next {
            right: 10px;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('teamSlider');
        const prevBtn = document.getElementById('sliderPrev');
        const nextBtn = document.getElementById('sliderNext');
        
        if (!slider || !prevBtn || !nextBtn) return;
        
        let currentIndex = 0;
        const slides = slider.querySelectorAll('.team-slide');
        const totalSlides = slides.length;
        
        function getSlidesPerView() {
            if (window.innerWidth < 576) return 1;
            if (window.innerWidth < 768) return 2;
            if (window.innerWidth < 992) return 3;
            return 4;
        }
        
        function updateSlider() {
            const slidesPerView = getSlidesPerView();
            const maxIndex = Math.max(0, totalSlides - slidesPerView);
            
            if (currentIndex > maxIndex) currentIndex = maxIndex;
            if (currentIndex < 0) currentIndex = 0;
            
            const slideWidth = slides[0].offsetWidth + 20; // width + gap
            slider.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
        }
        
        prevBtn.addEventListener('click', function() {
            currentIndex--;
            if (currentIndex < 0) currentIndex = totalSlides - getSlidesPerView();
            updateSlider();
        });
        
        nextBtn.addEventListener('click', function() {
            const maxIndex = totalSlides - getSlidesPerView();
            currentIndex++;
            if (currentIndex > maxIndex) currentIndex = 0;
            updateSlider();
        });
        
        window.addEventListener('resize', updateSlider);
        
        // Auto slide
        setInterval(function() {
            const maxIndex = totalSlides - getSlidesPerView();
            currentIndex++;
            if (currentIndex > maxIndex) currentIndex = 0;
            updateSlider();
        }, 5000);
    });
</script>
@endsection
