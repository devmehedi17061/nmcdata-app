<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HR Management System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f5f7fa;
        }
        .sidebar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px 0;
        }
        .sidebar .nav-link {
            color: white;
            padding: 12px 20px;
            margin: 5px 0;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }
        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
        }
        .sidebar h5 {
            color: white;
            padding: 20px;
            font-weight: bold;
        }
        .navbar-brand {
            font-weight: bold;
            color: #667eea !important;
        }
        .content {
            padding: 30px;
        }
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #667eea;
            border: none;
        }
        .btn-primary:hover {
            background-color: #764ba2;
        }
        .top-navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #667eea;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        .alert {
            margin-bottom: 20px;
        }
        .table thead {
            background-color: #f8f9fa;
        }
        .breadcrumb {
            background-color: transparent;
            padding: 0;
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 sidebar">
                <h5 class="text-white"><i class="fas fa-building"></i> HR System</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link @if(Route::is('dashboard')) active @endif" href="/dashboard">
                            <i class="fas fa-dashboard"></i> Dashboard
                        </a>
                    </li>

                    @auth
                        @if(Auth::user()->isAdmin() || Auth::user()->isHR())
                            <li class="nav-item">
                                <a class="nav-link @if(Route::is('employees.*')) active @endif" href="/employees">
                                    <i class="fas fa-users"></i> Employees
                                </a>
                            </li>
                        @endif

                        @if(Auth::user()->isAdmin() || Auth::user()->isHR())
                            <li class="nav-item">
                                <a class="nav-link @if(Route::is('roles.*')) active @endif" href="/roles">
                                    <i class="fas fa-user-shield"></i> Roles
                                </a>
                            </li>
                        @endif

                        @if(Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link @if(Route::is('permissions.*')) active @endif" href="/permissions">
                                    <i class="fas fa-lock"></i> Permissions
                                </a>
                            </li>
                        @endif
                    @endauth

                    <li class="nav-item mt-4">
                        <form action="/logout" method="POST" class="d-inline">
                            @csrf
                            <button class="nav-link btn btn-link text-start w-100" type="submit">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 col-lg-10">
                <!-- Top Navbar -->
                <nav class="navbar navbar-expand-lg navbar-light top-navbar">
                    <div class="container-fluid">
                        <span class="navbar-text">Welcome, <strong>{{ Auth::user()->name }}</strong></span>
                        <div class="user-menu ms-auto">
                            <div class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                            <span class="badge bg-primary">{{ Auth::user()->role->name ?? 'No Role' }}</span>
                        </div>
                    </div>
                </nav>

                <!-- Content Area -->
                <div class="content">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
