@extends('layouts.frontend')

@section('title', 'Contact Us - NMC HR System')

@section('meta_description', 'Get in touch with NMC HR System team. We are here to help you with your HR management needs.')

@section('content')
<!-- Page Header -->
<header class="page-header">
    <div class="container py-5 text-center">
        <h1 class="fw-bold mb-3" data-aos="fade-up">Get in <span class="text-accent">Touch</span></h1>
        <p class="lead text-muted mx-auto" style="max-width: 700px;" data-aos="fade-up" data-aos-delay="100">
            Have questions about our HR solutions? We're here to help you streamline your HR operations.
        </p>
    </div>
</header>

<!-- Contact Section -->
<section class="container py-5">
    <div class="row g-5 justify-content-center">
        <div class="col-lg-5" data-aos="fade-right">
            <h3 class="fw-bold mb-4">Contact Information</h3>
            <p class="text-muted mb-5">Our team is ready to provide you with a personalized demonstration of our platform and answer any questions you may have.</p>

            <div class="d-flex align-items-center mb-4">
                <div class="service-icon me-3 mb-0" style="width: 50px; height: 50px;"><i class="bi bi-geo-alt"></i></div>
                <div>
                    <h6 class="fw-bold mb-0">Our Office</h6>
                    <small class="text-muted">Dhaka, Bangladesh</small>
                </div>
            </div>
            <div class="d-flex align-items-center mb-4">
                <div class="service-icon me-3 mb-0" style="width: 50px; height: 50px;"><i class="bi bi-envelope"></i></div>
                <div>
                    <h6 class="fw-bold mb-0">Email Us</h6>
                    <small class="text-muted">info@nmchr.com</small>
                </div>
            </div>
            <div class="d-flex align-items-center mb-4">
                <div class="service-icon me-3 mb-0" style="width: 50px; height: 50px;"><i class="bi bi-telephone"></i></div>
                <div>
                    <h6 class="fw-bold mb-0">Call Us</h6>
                    <small class="text-muted">+880 1234-567890</small>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <div class="service-icon me-3 mb-0" style="width: 50px; height: 50px;"><i class="bi bi-clock"></i></div>
                <div>
                    <h6 class="fw-bold mb-0">Business Hours</h6>
                    <small class="text-muted">Sun - Thu: 9:00 AM - 6:00 PM</small>
                </div>
            </div>

            <!-- Social Links -->
            <div class="mt-5">
                <h6 class="fw-bold mb-3">Follow Us</h6>
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-light btn-sm rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-facebook text-accent"></i>
                    </a>
                    <a href="#" class="btn btn-light btn-sm rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-twitter-x text-accent"></i>
                    </a>
                    <a href="#" class="btn btn-light btn-sm rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-linkedin text-accent"></i>
                    </a>
                    <a href="#" class="btn btn-light btn-sm rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-instagram text-accent"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-6" data-aos="fade-left">
            <div class="bg-white p-5 rounded-4 shadow-sm border">
                <h4 class="fw-bold mb-4">Send us a Message</h4>
                
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form action="{{ route('frontend.contact.submit') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">First Name</label>
                            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="John" value="{{ old('first_name') }}" required>
                            @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Last Name</label>
                            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Doe" value="{{ old('last_name') }}" required>
                            @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="john@company.com" value="{{ old('email') }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Subject</label>
                            <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" placeholder="How can we help?" value="{{ old('subject') }}" required>
                            @error('subject')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Message</label>
                            <textarea name="message" class="form-control @error('message') is-invalid @enderror" rows="4" placeholder="Tell us about your organization's needs..." required>{{ old('message') }}</textarea>
                            @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold">
                                <i class="bi bi-send me-2"></i>Send Message
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10" data-aos="fade-up">
                <div class="bg-white rounded-4 shadow-sm overflow-hidden">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d233668.0638445474!2d90.27923897396949!3d23.780573258035856!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2sDhaka!5e0!3m2!1sen!2sbd!4v1709312000000!5m2!1sen!2sbd" 
                        width="100%" 
                        height="400" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Frequently Asked Questions</h2>
            <p class="text-muted">Find answers to common questions</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item border-0 mb-3" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                How do I get started with NMC HR System?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Getting started is easy! Simply register for a free account, complete your organization profile, and start adding your employees. Our intuitive interface will guide you through the setup process.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Is my data secure with NMC HR System?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Absolutely! We take data security very seriously. All data is encrypted in transit and at rest, and we implement industry-standard security measures to protect your sensitive information.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3" data-aos="fade-up" data-aos-delay="300">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Can I customize the system for my organization?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Yes! NMC HR System offers flexible role and permission settings that allow you to customize access levels based on your organization's structure and needs.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0" data-aos="fade-up" data-aos-delay="400">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                What kind of support do you offer?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                We offer comprehensive support including email support, documentation, and training resources. Our team is always ready to help you get the most out of your HR management system.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
    .accordion-button {
        background: var(--white) !important;
        color: var(--primary) !important;
        font-weight: 600;
        border-radius: 12px !important;
        box-shadow: var(--shadow) !important;
        padding: 1.25rem;
    }

    .accordion-button:not(.collapsed) {
        background: var(--accent) !important;
        color: var(--white) !important;
    }

    .accordion-body {
        padding: 1.5rem;
        background: var(--white);
        border-radius: 0 0 12px 12px;
        margin-top: -5px;
        box-shadow: var(--shadow);
    }
</style>
@endsection
