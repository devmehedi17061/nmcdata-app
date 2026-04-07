@extends('layouts.frontend')

@section('title', 'Our Services - NMC HR System')

@section('meta_description', 'Explore our comprehensive HR services including employee management, leave tracking, role management, and more.')

@section('content')
<!-- Page Header -->
<header class="page-header">
    <div class="container py-5 text-center">
        <h1 class="fw-bold mb-3" data-aos="fade-up">Our <span class="text-accent">Services</span></h1>
        <p class="lead text-muted mx-auto" style="max-width: 700px;" data-aos="fade-up" data-aos-delay="100">
            End-to-end HR solutions tailored to help your organization reach its full potential.
        </p>
    </div>
</header>

<!-- Services Grid -->
<section class="container py-5">
    <div class="row g-4 pt-4">
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-card h-100">
                <div class="service-icon"><i class="bi bi-people"></i></div>
                <h5>Employee Management</h5>
                <p class="text-muted">Comprehensive database for employee profiles, documents, and employment history. Easily manage all employee information in one place.</p>
                <ul class="list-unstyled mt-3 text-muted small">
                    <li><i class="bi bi-check2 text-accent me-2"></i>Profile Management</li>
                    <li><i class="bi bi-check2 text-accent me-2"></i>Document Storage</li>
                    <li><i class="bi bi-check2 text-accent me-2"></i>Employment History</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-card h-100">
                <div class="service-icon"><i class="bi bi-calendar-event"></i></div>
                <h5>Leave Management</h5>
                <p class="text-muted">Streamlined leave requests, approvals, and balance tracking. Manage all types of leave with automated workflows.</p>
                <ul class="list-unstyled mt-3 text-muted small">
                    <li><i class="bi bi-check2 text-accent me-2"></i>Easy Leave Requests</li>
                    <li><i class="bi bi-check2 text-accent me-2"></i>Approval Workflows</li>
                    <li><i class="bi bi-check2 text-accent me-2"></i>Balance Tracking</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-card h-100">
                <div class="service-icon"><i class="bi bi-shield-check"></i></div>
                <h5>Role & Permissions</h5>
                <p class="text-muted">Granular access control for Admins, HR Managers, and Employees. Define who can access what with precision.</p>
                <ul class="list-unstyled mt-3 text-muted small">
                    <li><i class="bi bi-check2 text-accent me-2"></i>Role-Based Access</li>
                    <li><i class="bi bi-check2 text-accent me-2"></i>Custom Permissions</li>
                    <li><i class="bi bi-check2 text-accent me-2"></i>Secure Access Control</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-card h-100">
                <div class="service-icon"><i class="bi bi-folder"></i></div>
                <h5>File Management</h5>
                <p class="text-muted">Secure document storage and sharing. Upload, organize, and share important files with your team.</p>
                <ul class="list-unstyled mt-3 text-muted small">
                    <li><i class="bi bi-check2 text-accent me-2"></i>Secure Storage</li>
                    <li><i class="bi bi-check2 text-accent me-2"></i>Easy Sharing</li>
                    <li><i class="bi bi-check2 text-accent me-2"></i>Access Control</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="service-card h-100">
                <div class="service-icon"><i class="bi bi-person-check"></i></div>
                <h5>User Approval</h5>
                <p class="text-muted">Control who joins your organization. Review and approve new user registrations before granting access.</p>
                <ul class="list-unstyled mt-3 text-muted small">
                    <li><i class="bi bi-check2 text-accent me-2"></i>Registration Review</li>
                    <li><i class="bi bi-check2 text-accent me-2"></i>Approval Workflow</li>
                    <li><i class="bi bi-check2 text-accent me-2"></i>Access Management</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-card h-100">
                <div class="service-icon"><i class="bi bi-bar-chart-line"></i></div>
                <h5>Reports & Analytics</h5>
                <p class="text-muted">Deep insights into workforce data and operational metrics. Make informed decisions with real-time analytics.</p>
                <ul class="list-unstyled mt-3 text-muted small">
                    <li><i class="bi bi-check2 text-accent me-2"></i>Workforce Analytics</li>
                    <li><i class="bi bi-check2 text-accent me-2"></i>Custom Reports</li>
                    <li><i class="bi bi-check2 text-accent me-2"></i>Data Visualization</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">How It Works</h2>
            <p class="text-muted">Simple steps to digitize your HR operations</p>
        </div>
        <div class="row g-4">
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                <div class="step-item">
                    <div class="step-number">1</div>
                    <h6 class="fw-bold">Register</h6>
                    <p class="small text-muted">Create your account and set up your organization profile.</p>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                <div class="step-item">
                    <div class="step-number">2</div>
                    <h6 class="fw-bold">Add Employees</h6>
                    <p class="small text-muted">Add your team members and set up their profiles.</p>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
                <div class="step-item">
                    <div class="step-number">3</div>
                    <h6 class="fw-bold">Configure Roles</h6>
                    <p class="small text-muted">Set up roles and permissions for your team.</p>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
                <div class="step-item">
                    <div class="step-number">4</div>
                    <h6 class="fw-bold">Start Managing</h6>
                    <p class="small text-muted">Begin managing your HR operations efficiently.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Benefits -->
<section class="py-5">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Why Choose Our Services</h2>
            <p class="text-muted">The benefits of switching to an intelligent HR system</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="d-flex gap-3">
                    <div class="fs-1 text-accent"><i class="bi bi-cloud-check"></i></div>
                    <div>
                        <h6 class="fw-bold">Cloud Based</h6>
                        <p class="small text-muted">Access your data securely from anywhere, anytime.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="d-flex gap-3">
                    <div class="fs-1 text-accent"><i class="bi bi-shield-lock"></i></div>
                    <div>
                        <h6 class="fw-bold">Secure & Private</h6>
                        <p class="small text-muted">Your sensitive data is encrypted and protected.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="d-flex gap-3">
                    <div class="fs-1 text-accent"><i class="bi bi-hand-thumbs-up"></i></div>
                    <div>
                        <h6 class="fw-bold">Easy To Use</h6>
                        <p class="small text-muted">Intuitive interface with zero learning curve.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="400">
                <div class="d-flex gap-3">
                    <div class="fs-1 text-accent"><i class="bi bi-lightning-charge"></i></div>
                    <div>
                        <h6 class="fw-bold">Fast & Efficient</h6>
                        <p class="small text-muted">Streamline your HR processes and save time.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="500">
                <div class="d-flex gap-3">
                    <div class="fs-1 text-accent"><i class="bi bi-headset"></i></div>
                    <div>
                        <h6 class="fw-bold">24/7 Support</h6>
                        <p class="small text-muted">Our support team is always ready to help you.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="600">
                <div class="d-flex gap-3">
                    <div class="fs-1 text-accent"><i class="bi bi-arrow-repeat"></i></div>
                    <div>
                        <h6 class="fw-bold">Regular Updates</h6>
                        <p class="small text-muted">We continuously improve with new features.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-primary text-white">
    <div class="container py-5 text-center">
        <h2 class="fw-bold mb-4" data-aos="fade-up">Ready to Get Started?</h2>
        <p class="lead opacity-75 mb-4" data-aos="fade-up" data-aos-delay="100">Experience the full power of our HR management platform</p>
        <div data-aos="fade-up" data-aos-delay="200">
            <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5 me-2">Start Free Trial</a>
            <a href="{{ route('frontend.contact') }}" class="btn btn-outline-light btn-lg px-5">Request Demo</a>
        </div>
    </div>
</section>
@endsection
