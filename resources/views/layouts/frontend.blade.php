<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta_description', 'NMC HR Management System - Streamline your HR operations')">
    <title>@yield('title', 'NMC HR Management System')</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- AOS Animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #0f172a;
            --primary-light: #1e293b;
            --accent: #3b82f6;
            --accent-dark: #2563eb;
            --text: #334155;
            --text-light: #64748b;
            --bg-light: #f8fafc;
            --white: #ffffff;
            --glass: rgba(255, 255, 255, 0.8);
            --shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text);
            background-color: var(--white);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar {
            background: var(--glass) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            box-shadow: var(--shadow);
        }

        .navbar-brand {
            color: var(--primary) !important;
            font-size: 1.5rem;
            letter-spacing: -0.025em;
        }

        .nav-link {
            color: var(--text) !important;
            font-weight: 500;
            margin: 0 0.5rem;
            transition: color 0.2s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--accent) !important;
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--accent);
            border: none;
            padding: 0.8rem 2rem;
            font-weight: 600;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.4);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--accent-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.4);
        }

        .btn-outline-custom {
            border: 2px solid var(--primary);
            color: var(--primary);
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
            background: transparent;
        }

        .btn-outline-custom:hover {
            background-color: var(--primary);
            color: var(--white);
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: radial-gradient(circle at top right, rgba(59, 130, 246, 0.1), transparent),
                radial-gradient(circle at bottom left, rgba(59, 130, 246, 0.05), transparent);
            padding: 120px 0 80px;
            position: relative;
        }

        .hero h1 {
            font-weight: 800;
            font-size: clamp(2.5rem, 5vw, 4rem);
            color: var(--primary);
            line-height: 1.1;
            margin-bottom: 1.5rem;
            letter-spacing: -0.05em;
        }

        .hero p {
            font-size: 1.25rem;
            color: var(--text-light);
            max-width: 600px;
            margin-bottom: 2.5rem;
        }

        /* Page Header */
        .page-header {
            background: var(--bg-light);
            padding: 120px 0 60px;
            margin-top: 0;
        }

        .page-header h1 {
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        /* Section Title */
        .section-title {
            font-weight: 800;
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 1rem;
            letter-spacing: -0.025em;
        }

        /* Service Cards */
        .service-card {
            background: var(--white);
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 16px;
            padding: 2.5rem;
            height: 100%;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow);
        }

        .service-card:hover {
            transform: translateY(-12px);
            box-shadow: var(--shadow-lg);
        }

        .service-icon {
            width: 54px;
            height: 54px;
            background: rgba(59, 130, 246, 0.1);
            color: var(--accent);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .service-card h5 {
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--primary);
        }

        /* Steps */
        .step-item {
            position: relative;
            text-align: center;
            padding: 0 1rem;
        }

        .step-number {
            width: 50px;
            height: 50px;
            background: var(--accent);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            margin: 0 auto 1.5rem;
            position: relative;
            z-index: 2;
            box-shadow: 0 0 0 8px rgba(59, 130, 246, 0.1);
        }

        /* Dashboard Preview */
        .nav-pills-custom .nav-link {
            color: var(--text-light);
            background: var(--white);
            border: 1px solid rgba(0, 0, 0, 0.05);
            font-weight: 600;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .nav-pills-custom .nav-link.active {
            background: var(--accent);
            color: var(--white);
            box-shadow: var(--shadow);
        }

        .dashboard-preview-img {
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            border: 8px solid var(--white);
        }

        /* Form Controls */
        .form-control {
            padding: 0.8rem 1.25rem;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            background: var(--bg-light);
        }

        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
            border-color: var(--accent);
        }

        /* Footer */
        footer {
            background-color: var(--primary);
            padding: 4rem 0 2rem;
        }

        .footer-text {
            color: #94a3b8;
        }

        .social-links a {
            color: #94a3b8;
            font-size: 1.25rem;
            margin: 0 10px;
            transition: color 0.2s;
        }

        .social-links a:hover {
            color: var(--white);
        }

        /* AOS */
        [data-aos] {
            pointer-events: none;
        }

        .aos-animate {
            pointer-events: auto;
        }

        /* Text accent color */
        .text-accent {
            color: var(--accent) !important;
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <span style="color: var(--accent);">NMC</span> HR System
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('frontend.about') ? 'active' : '' }}" href="{{ route('frontend.about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('frontend.services') ? 'active' : '' }}" href="{{ route('frontend.services') }}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('frontend.contact') ? 'active' : '' }}" href="{{ route('frontend.contact') }}">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('files.public') ? 'active' : '' }}" href="{{ route('files.public') }}">
                            <i class="bi bi-folder me-1"></i>Files
                        </a>
                    </li>
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        @auth
                            <a class="btn btn-primary btn-sm" href="{{ route('dashboard') }}">
                                <i class="bi bi-speedometer2 me-1"></i>Dashboard
                            </a>
                        @else
                            <a class="btn btn-primary btn-sm" href="{{ route('login') }}">Login</a>
                            <a class="btn btn-outline-custom btn-sm ms-2" href="{{ route('register') }}">Register</a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="text-white">
        <div class="container">
            <div class="row g-4 mb-4">
                <div class="col-lg-4">
                    <h4 class="fw-bold mb-4"><span style="color: var(--accent);">NMC</span> HR System</h4>
                    <p class="footer-text">Empowering organizations through innovative human resource management and strategic talent solutions.</p>
                    <div class="social-links">
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-2">
                    <h6 class="fw-bold mb-4 text-white">Quick Links</h6>
                    <ul class="list-unstyled footer-text">
                        <li class="mb-2"><a href="{{ route('home') }}" class="text-decoration-none text-reset">Home</a></li>
                        <li class="mb-2"><a href="{{ route('frontend.about') }}" class="text-decoration-none text-reset">About Us</a></li>
                        <li class="mb-2"><a href="{{ route('frontend.services') }}" class="text-decoration-none text-reset">Services</a></li>
                        <li class="mb-2"><a href="{{ route('frontend.contact') }}" class="text-decoration-none text-reset">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h6 class="fw-bold mb-4 text-white">Contact Us</h6>
                    <ul class="list-unstyled footer-text">
                        <li class="mb-2"><i class="bi bi-envelope me-2"></i>info@nmchr.com</li>
                        <li class="mb-2"><i class="bi bi-telephone me-2"></i>+880 1234-567890</li>
                        <li class="mb-2"><i class="bi bi-geo-alt me-2"></i>Dhaka, Bangladesh</li>
                    </ul>
                </div>
            </div>
            <hr class="border-secondary opacity-25">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0 footer-text small">&copy; {{ date('Y') }} NMC HR System. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0 footer-text small">info@nmchr.com | +880 1234-567890</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 1000, once: true });
        
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
    @yield('scripts')
</body>
</html>
