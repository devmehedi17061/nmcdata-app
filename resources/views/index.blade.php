@extends('layouts.app')

@section('title', 'Dashboard - HR Management System')

@section('content')
<h2 class="mb-4">Dashboard</h2>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Total Employees</h6>
                        <h3 class="text-primary">{{ $totalEmployees }}</h3>
                    </div>
                    <div class="text-primary" style="font-size: 2rem;">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Active Employees</h6>
                        <h3 class="text-success">{{ $activeEmployees }}</h3>
                    </div>
                    <div class="text-success" style="font-size: 2rem;">
                        <i class="fas fa-user-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">On Leave</h6>
                        <h3 class="text-warning">{{ $employeesOnLeave }}</h3>
                    </div>
                    <div class="text-warning" style="font-size: 2rem;">
                        <i class="fas fa-calendar-times"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Inactive</h6>
                        <h3 class="text-danger">{{ $totalEmployees - $activeEmployees - $employeesOnLeave }}</h3>
                    </div>
                    <div class="text-danger" style="font-size: 2rem;">
                        <i class="fas fa-user-slash"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Recent Employees</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Position</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentEmployees as $employee)
                                <tr>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->position }}</td>
                                    <td>{{ $employee->department }}</td>
                                    <td>
                                        <span class="badge bg-{{ $employee->status === 'active' ? 'success' : ($employee->status === 'on_leave' ? 'warning' : 'danger') }}">
                                            {{ ucfirst(str_replace('_', ' ', $employee->status)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="/employees/{{ $employee->id }}" class="btn btn-sm btn-info">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No employees found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Quick Actions</h6>
            </div>
            <div class="card-body">
                @if(Auth::user()->isAdmin() || Auth::user()->isHR())
                    <a href="/employees/create" class="btn btn-primary w-100 mb-2">
                        <i class="fas fa-plus"></i> Add New Employee
                    </a>
                    <a href="/employees" class="btn btn-outline-primary w-100 mb-2">
                        <i class="fas fa-list"></i> View All Employees
                    </a>
                @endif
                @if(Auth::user()->isAdmin())
                    <a href="/roles" class="btn btn-outline-primary w-100 mb-2">
                        <i class="fas fa-user-shield"></i> Manage Roles
                    </a>
                    <a href="/permissions" class="btn btn-outline-primary w-100">
                        <i class="fas fa-lock"></i> Manage Permissions
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">System Information</h6>
            </div>
            <div class="card-body">
                <p><strong>Your Role:</strong> <span class="badge bg-primary">{{ Auth::user()->role->name ?? 'No Role' }}</span></p>
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <p><strong>Account Created:</strong> {{ Auth::user()->created_at->format('M d, Y') }}</p>
                <p><strong>Last Login:</strong> Today</p>
            </div>
        </div>
    </div>
</div>
@endsection
  <meta name="theme-color" content="#316AFF" />
  <meta name="robots" content="index, follow" />
  <meta name="author" content="LayoutDrop" />
  <meta name="format-detection" content="telephone=no" />
  <meta name="keywords"
    content="HR Management, HR Dashboard, Admin Template, Admin Dashboard, Bootstrap Admin, HR Admin Panel, Employee Management, Human Resources Dashboard, Responsive Admin Template, Web App Dashboard, HRMS Admin, Staff Management Dashboard, Bootstrap 5 Admin, Modern Admin Template, Admin UI Kit, ThemeForest Admin Template, SaaS Dashboard, Project Management Admin, HR Web Application, RTL Dashboard" />
  <meta name="description"
    content="GXON is a professional and modern HR Management Admin Dashboard Template built with Bootstrap. It includes light and dark modes, and is ideal for managing employees, attendance, payroll, recruitment, and more — perfect for HR software and admin panels." />
   <!-- end::GXON Meta Basic --> 

   <!-- begin::GXON Meta Social --> 
  <meta property="og:url" content="https://gxon.layoutdrop.com/demo/" />
  <meta property="og:site_name" content="GXON HR Management Admin Dashboard Template + RTL" />
  <meta property="og:type" content="website" />
  <meta property="og:locale" content="en_US" />
  <meta property="og:title" content="GXON HR Management Admin Dashboard Template + RTL" />
  <meta property="og:description"
    content="GXON is a professional and modern HR Management Admin Dashboard Template built with Bootstrap. It includes light and dark modes, and is ideal for managing employees, attendance, payroll, recruitment, and more — perfect for HR software and admin panels." />
  <meta property="og:image" content="https://gxon.layoutdrop.com/demo/preview.png" />
   <!-- end::GXON Meta Social --> 

   <!-- begin::GXON Meta Twitter --> 
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:url" content="https://gxon.layoutdrop.com/demo/" />
  <meta name="twitter:creator" content="@layoutdrop" />
  <meta name="twitter:title" content="GXON HR Management Admin Dashboard Template + RTL" />
  <meta name="twitter:description"
    content="GXON is a professional and modern HR Management Admin Dashboard Template built with Bootstrap. It includes light and dark modes, and is ideal for managing employees, attendance, payroll, recruitment, and more — perfect for HR software and admin panels." />
   <!-- end::GXON Meta Twitter --> 

   <!-- begin::GXON Website Page Title --> 
  <title>GXON HR Management Admin Dashboard Template + RTL</title>
   <!-- end::GXON Website Page Title --> 

   <!-- begin::GXON Mobile Specific --> 
  <meta name="viewport" content="width=device-width, initial-scale=1" />
   <!-- end::GXON Mobile Specific --> 

   <!-- begin::GXON Favicon Tags --> 
  <link rel="icon" type="image/png" href="assets/images/favicon.png" />
  <link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-touch-icon.png" />
   <!-- end::GXON Favicon Tags --> 

   <!-- begin::GXON Google Fonts --> 
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
    rel="stylesheet" />
   <!-- end::GXON Google Fonts --> 

   <!-- begin::GXON Required Stylesheet --> 
  <link rel="stylesheet" href="assets/libs/flaticon/css/all/all.css" />
  <link rel="stylesheet" href="assets/libs/lucide/lucide.css" />
  <link rel="stylesheet" href="assets/libs/fontawesome/css/all.min.css" />
  <link rel="stylesheet" href="assets/libs/simplebar/simplebar.css" />
  <link rel="stylesheet" href="assets/libs/node-waves/waves.css" />
  <link rel="stylesheet" href="assets/libs/bootstrap-select/css/bootstrap-select.min.css" />
   <!-- end::GXON Required Stylesheet --> 

   <!-- begin::GXON CSS Stylesheet --> 
  <link rel="stylesheet" href="assets/libs/flatpickr/flatpickr.min.css" />
  <link rel="stylesheet" href="assets/libs/datatables/datatables.min.css" />
  <link rel="stylesheet" href="assets/css/styles.css" />
   <!-- end::GXON CSS Stylesheet --> 



</head>

<body>
  <div class="page-layout">

     <!-- begin::GXON Page Header --> 
    <header class="app-header">
      <div class="app-header-inner">
        <button class="app-toggler" type="button" aria-label="app toggler">
          <span></span>
          <span></span>
          <span></span>
        </button>
        <div class="app-header-start d-none d-md-flex">
          <form class="d-flex align-items-center h-100 w-lg-250px w-xxl-300px position-relative" action="#">
            <button type="button" class="btn btn-sm border-0 position-absolute start-0 ms-3 p-0">
              <i class="fi fi-rr-search"></i>
            </button>
            <input type="text" class="form-control rounded-5 ps-5" placeholder="Search anything's"
              data-bs-toggle="modal" data-bs-target="#searchResultsModal" />
          </form>
          <ul class="navbar-nav gap-4 flex-row d-none d-xxl-flex">
            <li class="nav-item">
              <a class="nav-link" href="analytics.html">Reports & Analytics</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/faq.html">Help</a>
            </li>
          </ul>
        </div>
        <div class="app-header-end">
          <div class="px-lg-3 px-2 ps-0 d-flex align-items-center">
            <div class="dropdown">
              <button class="btn btn-icon btn-action-gray rounded-circle waves-effect waves-light position-relative"
                id="ld-theme" type="button" data-bs-auto-close="outside" aria-expanded="false"
                data-bs-toggle="dropdown">
                <i class="fi fi-rr-brightness scale-1x theme-icon-active"></i>
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <button type="button" class="dropdown-item d-flex gap-2 align-items-center"
                    data-bs-theme-value="light" aria-pressed="false">
                    <i class="fi fi-rr-brightness scale-1x" data-theme="light"></i> Light
                  </button>
                </li>
                <li>
                  <button type="button" class="dropdown-item d-flex gap-2 align-items-center" data-bs-theme-value="dark"
                    aria-pressed="false">
                    <i class="fi fi-rr-moon scale-1x" data-theme="dark"></i> Dark
                  </button>
                </li>
                <li>
                  <button type="button" class="dropdown-item d-flex gap-2 align-items-center" data-bs-theme-value="auto"
                    aria-pressed="true">
                    <i class="fi fi-br-circle-half-stroke scale-1x" data-theme="auto"></i> Auto
                  </button>
                </li>
              </ul>
            </div>
          </div>
          <div class="vr my-3"></div>
          <div class="d-flex align-items-center gap-sm-2 gap-0 px-lg-4 px-sm-2 px-1">
            <a href="email/inbox.html"
              class="btn btn-icon btn-action-gray rounded-circle waves-effect waves-light position-relative">
              <i class="fi fi-rr-envelope"></i>
              <span
                class="position-absolute top-0 end-0 p-1 mt-1 me-1 bg-danger border border-3 border-light rounded-circle">
                <span class="visually-hidden">New alerts</span>
              </span>
            </a>
            <div class="dropdown text-end">
              <button type="button" class="btn btn-icon btn-action-gray rounded-circle waves-effect waves-light"
                data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="true">
                <i class="fi fi-rr-bell"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-lg-end p-0 w-300px mt-2">
                <div class="px-3 py-3 border-bottom d-flex justify-content-between align-items-center">
                  <h6 class="mb-0">Notifications <span class="badge badge-sm rounded-pill bg-primary ms-2">9</span>
                  </h6>
                  <i class="bi bi-x-lg cursor-pointer"></i>
                </div>
                <div class="p-2" style="height: 300px;" data-simplebar>
                  <ul class="list-group list-group-hover list-group-smooth list-group-unlined">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="avatar avatar-xs avatar-status-success rounded-circle me-1">
                        <img src="assets/images/avatar/avatar2.webp" alt="" />
                      </div>
                      <div class="ms-2 me-auto">
                        <h6 class="mb-0">Emma Smith</h6>
                        <small class="text-body d-block">Need to update the details.</small>
                        <small class="text-muted position-absolute end-0 top-0 mt-2 me-3">7 hr ago</small>
                      </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="avatar avatar-xs bg-success rounded-circle text-white">D</div>
                      <div class="ms-2 me-auto">
                        <h6 class="mb-0">Design Team</h6>
                        <small class="text-body d-block">Check your shared folder.</small>
                        <small class="text-muted position-absolute end-0 top-0 mt-2 me-3">6 hr ago</small>
                      </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="avatar avatar-xs bg-dark rounded-circle text-white">
                        <i class="fi fi-rr-lock"></i>
                      </div>
                      <div class="ms-2 me-auto">
                        <h6 class="mb-0">Security Update</h6>
                        <small class="text-body d-block">Password successfully set.</small>
                        <small class="text-muted position-absolute end-0 top-0 mt-2 me-3">5 hr ago</small>
                      </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="avatar avatar-xs bg-info rounded-circle text-white">
                        <i class="fi fi-rr-shopping-cart"></i>
                      </div>
                      <div class="ms-2 me-auto">
                        <h6 class="mb-0">Invoice #1432</h6>
                        <small class="text-body d-block">has been paid Amount: $899.00</small>
                        <small class="text-muted position-absolute end-0 top-0 mt-2 me-3">5 hr ago</small>
                      </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="avatar avatar-xs bg-danger rounded-circle text-white">R</div>
                      <div class="ms-2 me-auto">
                        <h6 class="mb-0">Emma Smith</h6>
                        <small class="text-body d-block">added you to Dashboard Analytics</small>
                        <small class="text-muted position-absolute end-0 top-0 mt-2 me-3">5 hr ago</small>
                      </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="avatar avatar-xs avatar-status-success rounded-circle me-1">
                        <img src="assets/images/avatar/avatar3.webp" alt="" />
                      </div>
                      <div class="ms-2 me-auto">
                        <h6 class="mb-0">Olivia Clark</h6>
                        <small class="text-body d-block">You can now view the “Report”.</small>
                        <small class="text-muted position-absolute end-0 top-0 mt-2 me-3">4 hr ago</small>
                      </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="avatar avatar-xs avatar-status-danger rounded-circle me-1">
                        <img src="assets/images/avatar/avatar5.webp" alt="" />
                      </div>
                      <div class="ms-2 me-auto">
                        <h6 class="mb-0">Isabella Walker</h6>
                        <small class="text-body d-block">@Isabella please review.</small>
                        <small class="text-muted position-absolute end-0 top-0 mt-2 me-3">2 hr ago</small>
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="p-2">
                  <a href="javascript:void(0);" class="btn w-100 btn-primary waves-effect waves-light">View all
                    notifications</a>
                </div>
              </div>
            </div>
            <a href="calendar.html" class="btn btn-icon btn-action-gray rounded-circle waves-effect waves-light">
              <i class="fi fi-rr-calendar"></i>
            </a>
          </div>
          <div class="vr my-3"></div>
          <div class="dropdown text-end ms-sm-3 ms-2 ms-lg-4">
            <a href="#" class="d-flex align-items-center py-2" data-bs-toggle="dropdown" data-bs-auto-close="outside"
              aria-expanded="true">
              <div class="text-end me-2 d-none d-lg-inline-block">
                <div class="fw-bold text-dark">Robert Brown</div>
                <small class="text-body d-block lh-sm">
                  <i class="fi fi-rr-angle-down text-3xs me-1"></i> Manager
                </small>
              </div>
              <div class="avatar avatar-sm rounded-circle avatar-status-success">
                <img src="assets/images/avatar/avatar1.webp" alt="" />
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end w-225px mt-1">
              <li class="d-flex align-items-center p-2">
                <div class="avatar avatar-sm rounded-circle">
                  <img src="assets/images/avatar/avatar1.webp" alt="" />
                </div>
                <div class="ms-2">
                  <div class="fw-bold text-dark">Robert Brown </div>
                  <small class="text-body d-block lh-sm">robert@gmail.com</small>
                </div>
              </li>
              <li>
                <div class="dropdown-divider my-1"></div>
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center gap-2" href="profile.html">
                  <i class="fi fi-rr-user scale-1x"></i> View Profile
                </a>
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center gap-2" href="task-management.html">
                  <i class="fi fi-rr-note scale-1x"></i> My Task
                </a>
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center gap-2" href="pages/faq.html">
                  <i class="fi fi-rs-interrogation scale-1x"></i> Help Center
                </a>
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center gap-2" href="settings.html">
                  <i class="fi fi-rr-settings scale-1x"></i> Account Settings
                </a>
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center gap-2" href="pages/pricing.html">
                  <i class="fi fi-rr-usd-circle scale-1x"></i> Upgrade Plan
                </a>
              </li>
              <li>
                <div class="dropdown-divider my-1"></div>
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center gap-2 text-danger"
                  href="authentication/login-basic.html">
                  <i class="fi fi-sr-exit scale-1x"></i> Log Out
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </header>
     <!-- end::GXON Page Header --> 

    <div class="modal fade" id="searchResultsModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header py-1 px-3">
            <form class="d-flex align-items-center position-relative w-100" action="#">
              <button type="button" class="btn btn-sm border-0 position-absolute start-0 p-0 text-sm ">
                <i class="fi fi-rr-search"></i>
              </button>
              <input type="text" class="form-control form-control-lg ps-4 border-0 shadow-none" id="searchInput"
                placeholder="Search anything's" />
            </form>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body pb-2" style="height: 300px;" data-simplebar>
            <div id="recentlyResults">
              <span class="text-uppercase text-2xs fw-semibold text-muted d-block mb-2">Recently Searched:</span>
              <ul class="list-inline search-list">
                <li>
                  <a class="search-item" href="index.html">
                    <i class="fi fi-rr-apps"></i> Dashboard
                  </a>
                </li>

                <li>
                  <a class="search-item" href="calendar.html">
                    <i class="fi fi-rr-calendar"></i> Calendar
                  </a>
                </li>
                <li>
                  <a class="search-item" href="chart/apexchart.html">
                    <i class="fi fi-rr-chart-pie-alt"></i> Apexchart
                  </a>
                </li>
                <li>
                  <a class="search-item" href="pages/pricing.html">
                    <i class="fi fi-rr-file"></i> Pricing
                  </a>
                </li>
                <li>
                  <a class="search-item" href="email/inbox.html">
                    <i class="fi fi-rr-envelope"></i> Email
                  </a>
                </li>
              </ul>
            </div>
            <div id="searchContainer"></div>
          </div>
        </div>
      </div>
    </div>

     <!-- begin::GXON Sidebar Menu --> 
    <aside class="app-menubar" id="appMenubar">
      <div class="app-navbar-brand">
        <a class="navbar-brand-logo" href="index.html">
          <img src="assets/images/logo.svg" alt="GXON Admin Dashboard Logo" />
        </a>
        <a class="navbar-brand-mini visible-light" href="index.html">
          <img src="assets/images/logo-text.svg" alt="GXON Admin Dashboard Logo" />
        </a>
        <a class="navbar-brand-mini visible-dark" href="index.html">
          <img src="assets/images/logo-text-white.svg" alt="GXON Admin Dashboard Logo" />
        </a>
      </div>
      <nav class="app-navbar" data-simplebar>
        <ul class="menubar">
          <li class="menu-item menu-arrow">
            <a class="menu-link" href="javascript:void(0);" role="button">
              <i class="fi fi-rr-apps"></i>
              <span class="menu-label">Dashboard</span>
            </a>
            <ul class="menu-inner">
              <li class="menu-item">
                <a class="menu-link" href="index.html">
                  <span class="menu-label">Dashboard</span>
                </a>
              </li>


              <li class="menu-item">
                <a class="menu-link" href="employee.html">
                  <span class="menu-label">Employee</span>
                </a>
              </li>
              <li class="menu-item">
                <a class="menu-link" href="attendance.html">
                  <span class="menu-label">Attendance</span>
                </a>
              </li>
              <li class="menu-item">
                <a class="menu-link" href="leave.html">
                  <span class="menu-label">Leave</span>
                </a>
              </li>
              <li class="menu-item">
                <a class="menu-link" href="payroll.html">
                  <span class="menu-label">Payroll</span>
                </a>
              </li>
              <li class="menu-item">
                <a class="menu-link" href="recruitment.html">
                  <span class="menu-label">Recruitment</span>
                </a>
              </li>
              <li class="menu-item">
                <a class="menu-link" href="task-management.html">
                  <span class="menu-label">Task Management</span>
                </a>
              </li>

            </ul>
          </li>


          <li class="menu-item menu-arrow">
            <a class="menu-link" href="javascript:void(0);" role="button">
              <i class="fi fi-rr-file"></i>
              <span class="menu-label">Pages</span>
            </a>
            <ul class="menu-inner">
              <li class="menu-item">
                <a class="menu-link" href="pages/pricing.html">
                  <span class="menu-label">Pricing</span>
                </a>
              </li>
              <li class="menu-item">
                <a class="menu-link" href="pages/faq.html">
                  <span class="menu-label">FAQ's</span>
                </a>
              </li>
              <li class="menu-item">
                <a class="menu-link" href="pages/coming-soon.html">
                  <span class="menu-label">Coming Soon</span>
                </a>
              </li>
              <li class="menu-item">
                <a class="menu-link" href="profile.html">
                  <span class="menu-label">Profile</span>
                </a>
              </li>
              <li class="menu-item">
                <a class="menu-link" href="roles-permissions.html">
                  <span class="menu-label">Roles Permissions</span>
                </a>
              </li>
              <li class="menu-item">
                <a class="menu-link" href="settings.html">
                  <span class="menu-label">Settings</span>
                </a>
              </li>



              

            </ul>
          </li>

          <li class="menu-item menu-arrow">
                <a class="menu-link" href="javascript:void(0);">
                  <span class="menu-label">Blog</span>
                </a>
                <ul class="menu-inner">
                  <li class="menu-item">
                    <a class="menu-link" href="pages/blog.html">
                      <span class="menu-label">Blog Grid</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="pages/blog-list.html">
                      <span class="menu-label">Blog List</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="pages/blog-details.html">
                      <span class="menu-label">Blog Details</span>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="menu-item menu-arrow">
                <a class="menu-link" href="javascript:void(0);" role="button">
                  <i class="fi fi-rr-user-key"></i>
                  <span class="menu-label">Authentication</span>
                </a>
                <ul class="menu-inner">
                  <li class="menu-item menu-arrow">
                    <a class="menu-link" href="javascript:void(0);">
                      <span class="menu-label">Login</span>
                    </a>
                    <ul class="menu-inner">
                      <li class="menu-item">
                        <a class="menu-link" href="authentication/login-basic.html">
                          <span class="menu-label">Basic</span>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a class="menu-link" href="authentication/login-cover.html">
                          <span class="menu-label">Cover</span>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a class="menu-link" href="authentication/login-frame.html">
                          <span class="menu-label">Frame</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="menu-item menu-arrow">
                    <a class="menu-link" href="javascript:void(0);">
                      <span class="menu-label">Register</span>
                    </a>
                    <ul class="menu-inner">
                      <li class="menu-item">
                        <a class="menu-link" href="authentication/register-basic.html">
                          <span class="menu-label">Basic</span>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a class="menu-link" href="authentication/register-cover.html">
                          <span class="menu-label">Cover</span>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a class="menu-link" href="authentication/register-frame.html">
                          <span class="menu-label">Frame</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="menu-item menu-arrow">
                    <a class="menu-link" href="javascript:void(0);">
                      <span class="menu-label">Forgot Password</span>
                    </a>
                    <ul class="menu-inner">
                      <li class="menu-item">
                        <a class="menu-link" href="authentication/forgot-password-basic.html">
                          <span class="menu-label">Basic</span>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a class="menu-link" href="authentication/forgot-password-cover.html">
                          <span class="menu-label">Cover</span>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a class="menu-link" href="authentication/forgot-password-frame.html">
                          <span class="menu-label">Frame</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="menu-item menu-arrow">
                    <a class="menu-link" href="javascript:void(0);">
                      <span class="menu-label">New Password</span>
                    </a>
                    <ul class="menu-inner">
                      <li class="menu-item">
                        <a class="menu-link" href="authentication/new-password-basic.html">
                          <span class="menu-label">Basic</span>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a class="menu-link" href="authentication/new-password-cover.html">
                          <span class="menu-label">Cover</span>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a class="menu-link" href="authentication/new-password-frame.html">
                          <span class="menu-label">Frame</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>


        </ul>
        </li>
        </ul>
      </nav>
      <div class="app-footer">
        <a href="pages/faq.html" class="btn btn-outline-light waves-effect btn-shadow btn-app-nav w-100">
          <i class="fi fi-rs-interrogation text-primary"></i>
          <span class="nav-text">Help and Support</span>
        </a>
      </div>
    </aside>
     <!-- end::GXON Sidebar Menu --> 

     <!-- begin::GXON Sidebar right --> 
    <div class="app-sidebar-end">
      <ul class="sidebar-list">
        <li>
          <a href="task-management.html">
            <div class="avatar avatar-sm bg-warning shadow-sharp-warning rounded-circle text-white mx-auto mb-2">
              <i class="fi fi-rr-to-do"></i>
            </div>
            <span class="text-dark">Task</span>
          </a>
        </li>
        <li>
          <a href="pages/faq.html">
            <div class="avatar avatar-sm bg-secondary shadow-sharp-secondary rounded-circle text-white mx-auto mb-2">
              <i class="fi fi-rr-interrogation"></i>
            </div>
            <span class="text-dark">Help</span>
          </a>
        </li>
        <li>
          <a href="calendar.html">
            <div class="avatar avatar-sm bg-info shadow-sharp-info rounded-circle text-white mx-auto mb-2">
              <i class="fi fi-rr-calendar"></i>
            </div>
            <span class="text-dark">Event</span>
          </a>
        </li>
        <li>
          <a href="settings.html">
            <div class="avatar avatar-sm bg-gray shadow-sharp-gray rounded-circle text-white mx-auto mb-2">
              <i class="fi fi-rr-settings"></i>
            </div>
            <span class="text-dark">Settings</span>
          </a>
        </li>
      </ul>
    </div>
     <!-- end::GXON Sidebar right --> 

    <main class="app-wrapper">

      <div class="container">

        <div class="app-page-head d-flex flex-wrap gap-3 align-items-center justify-content-between">
          <div class="clearfix">
            <h1 class="app-page-title">Dashboard</h1>
            <span>{{ now()->format('D, M d, Y') }} - {{ now()->addDays(30)->format('D, M d, Y') }}</span>
          </div>
          <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
            data-bs-target="#addEmployeeModal">
            <i class="fi fi-rr-plus me-1"></i> Add Employee
          </button>
        </div>

        <div class="row">

          <div class="col-xxl-9">

            <div class="row">
              <div class="col-6 col-md-4 col-lg">
                <div class="card bg-secondary bg-opacity-05 shadow-none border-0">
                  <div class="card-body">
                    <div class="avatar bg-secondary shadow-secondary rounded-circle text-white mb-3">
                      <i class="fi fi-sr-users"></i>
                    </div>
                    <h3>{{ $totalEmployees }}</h3>
                    <h6 class="mb-0">Total Employee</h6>
                    <small class="fw-medium">
                      <span class="text-success">
                        <i class="fi fi-rr-arrow-small-up scale-3x"></i> +{{ $employeeGrowthPercentage }}%
                      </span> Last Month
                    </small>
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-4 col-lg">
                <div class="card bg-info bg-opacity-05 shadow-none border-0">
                  <div class="card-body">
                    <div class="avatar bg-info shadow-info rounded-circle text-white mb-3">
                      <i class="fi fi-sr-user-add"></i>
                    </div>
                    <h3>{{ $newEmployees }}</h3>
                    <h6 class="mb-0">New Employee</h6>
                    <small class="fw-medium">
                      <span class="text-success">
                        <i class="fi fi-rr-arrow-small-up scale-3x"></i> +{{ $newEmployeePercentage }}%
                      </span> Last Month
                    </small>
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-4 col-lg">
                <div class="card bg-secondary bg-opacity-05 shadow-none border-0">
                  <div class="card-body">
                    <div class="avatar bg-warning shadow-warning rounded-circle text-white mb-3">
                      <i class="fi fi-sr-delete-user"></i>
                    </div>
                    <h3>{{ $employeesOnLeave }}</h3>
                    <h6 class="mb-0">On Leave</h6>
                    <small class="fw-medium">
                      <span class="text-danger">
                        <i class="fi fi-rr-arrow-small-down scale-3x"></i> -{{ $leavePercentage }}%
                      </span> Last Month
                    </small>
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-6 col-lg">
                <div class="card bg-success bg-opacity-05 shadow-none border-0">
                  <div class="card-body">
                    <div class="avatar bg-success shadow-success rounded-circle text-white mb-3">
                      <i class="fi fi-sr-shopping-bag"></i>
                    </div>
                    <h3>{{ $activeEmployees }}</h3>
                    <h6 class="mb-0">Active Employees</h6>
                    <small class="fw-medium">
                      <span class="text-success">
                        <i class="fi fi-rr-arrow-small-up scale-3x"></i> +{{ $totalEmployees > 0 ? round(($activeEmployees/$totalEmployees)*100, 1) : 0 }}%
                      </span> Last Month
                    </small>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg">
                <div class="card bg-danger bg-opacity-05 shadow-none border-0">
                  <div class="card-body">
                    <div class="avatar bg-danger shadow-danger rounded-circle text-white mb-3">
                      <i class="fi fi-sr-clock-three"></i>
                    </div>
                    <h3>{{ $inactiveEmployees }}</h3>
                    <h6 class="mb-0">Inactive Employees</h6>
                    <small class="fw-medium">
                      <span class="text-danger">
                        <i class="fi fi-rr-arrow-small-down scale-3x"></i> -{{ $totalEmployees > 0 ? round(($inactiveEmployees/$totalEmployees)*100, 1) : 0 }}%
                      </span> Last Month
                    </small>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xxl-3">
            <div class="card overflow-hidden z-1">
              <div class="card-body">
                <div class="w-75">
                  <h6 class="card-title">Create Announcement</h6>
                  <p>Make a announcement to your employee</p>
                </div>
                <img src="assets/images/media/svg/media1.svg" alt="" class="position-absolute bottom-0 end-0 z-n1" />
              </div>
              <div class="card-footer border-0 pt-0">
                <a href="calendar.html" class="btn btn-outline-light waves-effect btn-shadow">Create Now</a>
              </div>
            </div>
          </div>

          <div class="col-xxl-7 col-lg-6">
            <div class="card">
              <div class="card-header d-flex align-items-center justify-content-between border-0 pb-0">
                <h6 class="card-title mb-0">Employee Structure</h6>
                <button type="button" class="btn btn-sm btn-outline-light btn-shadow waves-effect">Download
                  Report</button>
              </div>
              <div class="card-body p-2">
                <div id="chartEmployee"></div>
              </div>
            </div>
          </div>

          <div class="col-xxl-5 col-lg-6">
            <div class="card">
              <div class="card-header d-flex align-items-center justify-content-between border-0 pb-0">
                <h6 class="card-title mb-0">Company Pay</h6>
                <select class="selectpicker" data-style="btn-sm btn-outline-light btn-shadow waves-effect">
                  <option value="pending">2024</option>
                  <option>2023</option>
                  <option>2022</option>
                  <option>2021</option>
                </select>
              </div>
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-sm-6">
                    <div class="maxw-250px ratio ratio-1x1">
                      <canvas id="companyPayChart"></canvas>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="d-grid gap-2">
                      <div class="d-flex gap-1 align-items-center mx-1">
                        <i class="fa fa-circle text-danger text-2xs me-1"></i>
                        <strong class="text-dark fw-semibold">15%</strong> Salary
                      </div>
                      <div class="d-flex gap-1 align-items-center mx-1">
                        <i class="fa fa-circle text-success text-2xs me-1"></i>
                        <strong class="text-dark fw-semibold">08%</strong> Bonus
                      </div>
                      <div class="d-flex gap-1 align-items-center mx-1">
                        <i class="fa fa-circle text-info text-2xs me-1"></i>
                        <strong class="text-dark fw-semibold">20%</strong> Commission
                      </div>
                      <div class="d-flex gap-1 align-items-center mx-1">
                        <i class="fa fa-circle text-secondary text-2xs me-1"></i>
                        <strong class="text-dark fw-semibold">11%</strong> Overtime
                      </div>
                      <div class="d-flex gap-1 align-items-center mx-1">
                        <i class="fa fa-circle text-primary text-2xs me-1"></i>
                        <strong class="text-dark fw-semibold">28%</strong> Reimbursement
                      </div>
                      <div class="d-flex gap-1 align-items-center mx-1">
                        <i class="fa fa-circle text-warning text-2xs me-1"></i>
                        <strong class="text-dark fw-semibold">18%</strong> Benefits
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="row gy-3 align-items-center">
                  <div class="col-sm-6">
                    <p class="mb-0">2024 Download Report Company Trends and Insights</p>
                  </div>
                  <div class="col-sm-6 text-sm-end">
                    <button type="button" class="btn btn-primary waves-effect waves-light">
                      <i class="fi fi-rr-download me-1"></i> Download Report
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xxl-4 col-lg-5">
            <div class="card">
              <div class="card-header d-flex align-items-center justify-content-between border-0 pb-0">
                <h6 class="card-title mb-0">Recent Job Application</h6>
                <a href="recruitment.html" class="btn-link">View All</a>
              </div>
              <div class="card-body pb-3">
                <ul class="list-group list-group-hover list-group-smooth list-group-unlined list-group-outer">
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="avatar rounded-circle me-1">
                      <img src="assets/images/avatar/avatar1.webp" alt="" />
                    </div>
                    <div class="ms-2 me-auto">
                      <h6 class="mb-0">Sophia Hall</h6>
                      <small>Front-End Developer</small>
                    </div>
                    <div class="dropdown select-status">
                      <button class="btn btn-sm btn-secondary btn-sm dropdown-toggle waves-effect waves-light"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Select Status
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                          <a class="dropdown-item" href="javascript:void(0);" data-class="btn-outline-light"
                            data-selected="true">Pending</a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="javascript:void(0);"
                            data-class="btn-subtle-primary">Approved</a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="javascript:void(0);"
                            data-class="btn-subtle-secondary">Rejected</a>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="avatar rounded-circle me-1">
                      <img src="assets/images/avatar/avatar2.webp" alt="" />
                    </div>
                    <div class="ms-2 me-auto">
                      <h6 class="mb-0">Emma Smith</h6>
                      <small>Back-End Developer</small>
                    </div>
                    <div class="dropdown select-status">
                      <button class="btn btn-sm btn-secondary btn-sm dropdown-toggle waves-effect waves-light"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Select Status
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                          <a class="dropdown-item" href="javascript:void(0);" data-class="btn-outline-light">Pending</a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="javascript:void(0);" data-class="btn-subtle-primary"
                            data-selected="true">Approved</a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="javascript:void(0);"
                            data-class="btn-subtle-secondary">Rejected</a>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="avatar rounded-circle me-1">
                      <img src="assets/images/avatar/avatar3.webp" alt="" />
                    </div>
                    <div class="ms-2 me-auto">
                      <h6 class="mb-0">Olivia Clark</h6>
                      <small>UI/UX Designer</small>
                    </div>
                    <div class="dropdown select-status">
                      <button class="btn btn-sm btn-secondary btn-sm dropdown-toggle waves-effect waves-light"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Select Status
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                          <a class="dropdown-item" href="javascript:void(0);" data-class="btn-outline-light">Pending</a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="javascript:void(0);"
                            data-class="btn-subtle-primary">Approved</a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="javascript:void(0);" data-class="btn-subtle-secondary"
                            data-selected="true">Rejected</a>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="avatar rounded-circle me-1">
                      <img src="assets/images/avatar/avatar4.webp" alt="" />
                    </div>
                    <div class="ms-2 me-auto">
                      <h6 class="mb-0">Ava Lewis</h6>
                      <small>Web Designer</small>
                    </div>
                    <div class="dropdown select-status">
                      <button class="btn btn-sm btn-secondary btn-sm dropdown-toggle waves-effect waves-light"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Select Status
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                          <a class="dropdown-item" href="javascript:void(0);" data-class="btn-outline-light"
                            data-selected="true">Pending</a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="javascript:void(0);"
                            data-class="btn-subtle-primary">Approved</a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="javascript:void(0);"
                            data-class="btn-subtle-secondary">Rejected</a>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="avatar rounded-circle me-1">
                      <img src="assets/images/avatar/avatar5.webp" alt="" />
                    </div>
                    <div class="ms-2 me-auto">
                      <h6 class="mb-0">Isabella Walker</h6>
                      <small>Full-Stack Developer</small>
                    </div>
                    <div class="dropdown select-status">
                      <button class="btn btn-sm btn-secondary btn-sm dropdown-toggle waves-effect waves-light"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Select Status
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                          <a class="dropdown-item" href="javascript:void(0);" data-class="btn-outline-light">Pending</a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="javascript:void(0);" data-class="btn-subtle-primary"
                            data-selected="true">Approved</a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="javascript:void(0);"
                            data-class="btn-subtle-secondary">Rejected</a>
                        </li>
                      </ul>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-xxl-8 col-lg-7">
            <div class="card overflow-hidden">
              <div class="card-header d-flex flex-wrap gap-3 align-items-center justify-content-between border-0 pb-0">
                <h6 class="card-title mb-0">Employee’s Leave</h6>
                <div id="dt_EmployeeLeave_Search"></div>
              </div>
              <div class="card-body px-3 pt-2 pb-0 gradient-layer">
                <table id="dt_EmployeeLeave" class="table display table-row-rounded">
                  <thead class="table-light">
                    <tr>
                      <th class="minw-150px">Name</th>
                      <th class="minw-200px">Department</th>
                      <th class="minw-150px">Days</th>
                      <th class="minw-150px">Date</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($recentEmployees as $employee)
                      <tr>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->department ?? 'N/A' }}</td>
                        <td>{{ $employee->status === 'on_leave' ? '2 Days' : 'Active' }}</td>
                        <td>{{ $employee->created_at->format('d M Y') }}</td>
                        <td>
                          <span class="badge bg-{{ $employee->status === 'active' ? 'success' : ($employee->status === 'on_leave' ? 'warning' : 'danger') }}">
                            {{ ucfirst(str_replace('_', ' ', $employee->status)) }}
                          </span>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="5" class="text-center text-muted">No employees found</td>
                      </tr>
                    @endforelse
                  </tbody>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-outline-light">Pending</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);" data-class="btn-subtle-primary"
                                data-selected="true">Approved</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-subtle-secondary">Rejected</a>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Benjamin Martinez</td>
                      <td>Full-Stack Developer</td>
                      <td>1st Half Day</td>
                      <td>03 July 2024</td>
                      <td>
                        <div class="dropdown select-status">
                          <button class="btn btn-sm btn-secondary btn-sm dropdown-toggle waves-effect waves-light"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Status
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-outline-light">Pending</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);" data-class="btn-subtle-primary"
                                data-selected="true">Approved</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-subtle-secondary">Rejected</a>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Alexander Brown</td>
                      <td>Mobile App Developer</td>
                      <td>4 Days</td>
                      <td>27 July 2024</td>
                      <td>
                        <div class="dropdown select-status">
                          <button class="btn btn-sm btn-secondary btn-sm dropdown-toggle waves-effect waves-light"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Status
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-outline-light">Pending</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);" data-class="btn-subtle-primary"
                                data-selected="true">Approved</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-subtle-secondary">Rejected</a>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Michael Davis</td>
                      <td>UI/UX Designer</td>
                      <td>2nd Half Day</td>
                      <td>05 June 2024</td>
                      <td>
                        <div class="dropdown select-status">
                          <button class="btn btn-sm btn-secondary btn-sm dropdown-toggle waves-effect waves-light"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Status
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-outline-light">Pending</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);" data-class="btn-subtle-primary"
                                data-selected="true">Approved</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-subtle-secondary">Rejected</a>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>David Wilson</td>
                      <td>DevOps Engineer</td>
                      <td>1 Days</td>
                      <td>04 Aug 2024</td>
                      <td>
                        <div class="dropdown select-status">
                          <button class="btn btn-sm btn-secondary btn-sm dropdown-toggle waves-effect waves-light"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Status
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-outline-light">Pending</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);" data-class="btn-subtle-primary"
                                data-selected="true">Approved</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-subtle-secondary">Rejected</a>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Brielle Williamson</td>
                      <td>Back-End Developer</td>
                      <td>2 Days</td>
                      <td>12 July 2024</td>
                      <td>
                        <div class="dropdown select-status">
                          <button class="btn btn-sm btn-secondary btn-sm dropdown-toggle waves-effect waves-light"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Status
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-outline-light">Pending</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);" data-class="btn-subtle-primary"
                                data-selected="true">Approved</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-subtle-secondary">Rejected</a>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Herrod Chandler</td>
                      <td>Full-Stack Developer</td>
                      <td>1st Half Day</td>
                      <td>03 July 2024</td>
                      <td>
                        <div class="dropdown select-status">
                          <button class="btn btn-sm btn-secondary btn-sm dropdown-toggle waves-effect waves-light"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Status
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-outline-light">Pending</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-subtle-primary">Approved</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);" data-class="btn-subtle-secondary"
                                data-selected="true">Rejected</a>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Rhona Davidson</td>
                      <td>Mobile App Developer</td>
                      <td>4 Days</td>
                      <td>27 July 2024</td>
                      <td>
                        <div class="dropdown select-status">
                          <button class="btn btn-sm btn-secondary btn-sm dropdown-toggle waves-effect waves-light"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Status
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);" data-class="btn-outline-light"
                                data-selected="true">Pending</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-subtle-primary">Approved</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-subtle-secondary">Rejected</a>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Colleen Hurst</td>
                      <td>UI/UX Designer</td>
                      <td>2nd Half Day</td>
                      <td>27 July 2024</td>
                      <td>
                        <div class="dropdown select-status">
                          <button class="btn btn-sm btn-secondary btn-sm dropdown-toggle waves-effect waves-light"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Status
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-outline-light">Pending</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);" data-class="btn-subtle-primary"
                                data-selected="true">Approved</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-subtle-secondary">Rejected</a>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Sonya Frost</td>
                      <td>DevOps Engineer</td>
                      <td>1 Days</td>
                      <td>04 Aug 2024</td>
                      <td>
                        <div class="dropdown select-status">
                          <button class="btn btn-sm btn-secondary btn-sm dropdown-toggle waves-effect waves-light"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Status
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);" data-class="btn-outline-light"
                                data-selected="true">Pending</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-subtle-primary">Approved</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-subtle-secondary">Rejected</a>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Jena Gaines</td>
                      <td>Back-End Developer</td>
                      <td>2 Days</td>
                      <td>12 July 2024</td>
                      <td>
                        <div class="dropdown select-status">
                          <button class="btn btn-sm btn-secondary btn-sm dropdown-toggle waves-effect waves-light"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Status
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-outline-light">Pending</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-subtle-primary">Approved</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);" data-class="btn-subtle-secondary"
                                data-selected="true">Rejected</a>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Quinn Flynn</td>
                      <td>Full-Stack Developer</td>
                      <td>1st Half Day</td>
                      <td>03 July 2024</td>
                      <td>
                        <div class="dropdown select-status">
                          <button class="btn btn-sm btn-secondary btn-sm dropdown-toggle waves-effect waves-light"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Status
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-outline-light">Pending</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-subtle-primary">Approved</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);" data-class="btn-subtle-secondary"
                                data-selected="true">Rejected</a>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Charde Marshall</td>
                      <td>Mobile App Developer</td>
                      <td>4 Days</td>
                      <td>27 July 2024</td>
                      <td>
                        <div class="dropdown select-status">
                          <button class="btn btn-sm btn-secondary btn-sm dropdown-toggle waves-effect waves-light"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Status
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);" data-class="btn-outline-light"
                                data-selected="true">Pending</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-subtle-primary">Approved</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-subtle-secondary">Rejected</a>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Haley Kennedy</td>
                      <td>UI/UX Designer</td>
                      <td>2nd Half Day</td>
                      <td>05 June 2024</td>
                      <td>
                        <div class="dropdown select-status">
                          <button class="btn btn-sm btn-secondary btn-sm dropdown-toggle waves-effect waves-light"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Status
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);" data-class="btn-outline-light"
                                data-selected="true">Pending</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-subtle-primary">Approved</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-subtle-secondary">Rejected</a>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Tatyana Fitzpatrick</td>
                      <td>DevOps Engineer</td>
                      <td>1 Days</td>
                      <td>04 Aug 2024</td>
                      <td>
                        <div class="dropdown select-status">
                          <button class="btn btn-sm btn-secondary btn-sm dropdown-toggle waves-effect waves-light"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Status
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-outline-light">Pending</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-subtle-primary">Approved</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);" data-class="btn-subtle-secondary"
                                data-selected="true">Rejected</a>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Michael Silva</td>
                      <td>Back-End Developer</td>
                      <td>2 Days</td>
                      <td>12 July 2024</td>
                      <td>
                        <div class="dropdown select-status">
                          <button class="btn btn-sm btn-secondary btn-sm dropdown-toggle waves-effect waves-light"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Status
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);" data-class="btn-outline-light"
                                data-selected="true">Pending</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-subtle-primary">Approved</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-subtle-secondary">Rejected</a>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Paul Byrd</td>
                      <td>Full-Stack Developer</td>
                      <td>1st Half Day</td>
                      <td>03 July 2024</td>
                      <td>
                        <div class="dropdown select-status">
                          <button class="btn btn-sm btn-secondary btn-sm dropdown-toggle waves-effect waves-light"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Status
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-outline-light">Pending</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);" data-class="btn-subtle-primary"
                                data-selected="true">Approved</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-subtle-secondary">Rejected</a>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Gloria Little</td>
                      <td>Mobile App Developer</td>
                      <td>4 Days</td>
                      <td>27 July 2024</td>
                      <td>
                        <div class="dropdown select-status">
                          <button class="btn btn-sm btn-secondary btn-sm dropdown-toggle waves-effect waves-light"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Status
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);" data-class="btn-outline-light"
                                data-selected="true">Pending</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-subtle-primary">Approved</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-subtle-secondary">Rejected</a>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Bradley Greer</td>
                      <td>UI/UX Designer</td>
                      <td>2nd Half Day</td>
                      <td>05 June 2024</td>
                      <td>
                        <div class="dropdown select-status">
                          <button class="btn btn-sm btn-secondary btn-sm dropdown-toggle waves-effect waves-light"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Status
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-outline-light">Pending</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-subtle-primary">Approved</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);" data-class="btn-subtle-secondary"
                                data-selected="true">Rejected</a>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Dai Rios</td>
                      <td>DevOps Engineer</td>
                      <td>1 Days</td>
                      <td>04 Aug 2024</td>
                      <td>
                        <div class="dropdown select-status">
                          <button class="btn btn-sm btn-secondary btn-sm dropdown-toggle waves-effect waves-light"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Status
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-outline-light">Pending</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);" data-class="btn-subtle-primary"
                                data-selected="true">Approved</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);"
                                data-class="btn-subtle-secondary">Rejected</a>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="col-xxl-3 col-md-6">
            <div class="card">
              <div class="card-header d-flex align-items-center justify-content-between border-0 pb-0">
                <h6 class="card-title mb-0">Employee Type </h6>
                <div class="btn-group">
                  <button class="btn btn-white btn-sm btn-shadow btn-icon waves-effect dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fi fi-rr-menu-dots"></i>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);">Onsite</a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);">Remote</a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);">Hybrid</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card-body py-0 px-3 d-flex align-items-center justify-content-center">
                <div class="maxw-250px ratio ratio-1x1">
                  <canvas id="employeeTypeChart"></canvas>
                </div>
              </div>
              <div class="card-footer pt-0 border-0">
                <div class="d-flex flex-wrap gap-2 justify-content-center">
                  <div class="d-flex gap-1 align-items-center mx-1">
                    <i class="fa fa-circle text-primary text-2xs"></i>
                    <strong class="text-dark fw-semibold">800</strong> Onsite
                  </div>
                  <div class="d-flex gap-1 align-items-center mx-1">
                    <i class="fa fa-circle text-secondary text-2xs"></i>
                    <strong class="text-dark fw-semibold">105</strong> Remote
                  </div>
                  <div class="d-flex gap-1 align-items-center mx-1">
                    <i class="fa fa-circle text-info text-2xs"></i>
                    <strong class="text-dark fw-semibold">301</strong> Hybrid
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xxl-3 col-md-6">
            <div class="card">
              <div class="card-header d-flex align-items-center justify-content-between border-0 pb-0">
                <h6 class="card-title mb-0">Team</h6>
                <div class="clearfix">
                  <a href="extended-ui/team.html" class="btn-link">View All</a>
                </div>
              </div>
              <div class="card-body px-3 pb-3">
                <ul class="list-group list-group-hover list-group-smooth list-group-space-sm">
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="me-auto">
                      <h6 class="mb-0">Marketing</h6>
                      <small class="fw-medium text-body d-block">Member <span class="text-primary">03</span>
                      </small>
                    </div>
                    <div class="avatar-group">
                      <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                        <img src="assets/images/avatar/avatar1.webp" alt="" />
                      </div>
                      <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                        <img src="assets/images/avatar/avatar2.webp" alt="" />
                      </div>
                      <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                        <img src="assets/images/avatar/avatar3.webp" alt="" />
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="me-auto">
                      <h6 class="mb-0">Development</h6>
                      <small class="fw-medium text-body d-block">Member <span class="text-secondary">40</span>
                      </small>
                    </div>
                    <div class="avatar-group">
                      <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                        <img src="assets/images/avatar/avatar4.webp" alt="" />
                      </div>
                      <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                        <img src="assets/images/avatar/avatar5.webp" alt="" />
                      </div>
                      <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                        <img src="assets/images/avatar/avatar1.webp" alt="" />
                      </div>
                      <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                        <img src="assets/images/avatar/avatar2.webp" alt="" />
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="me-auto">
                      <h6 class="mb-0">Designing Team</h6>
                      <small class="fw-medium text-body d-block">Member <span class="text-suc">03</span>
                      </small>
                    </div>
                    <div class="avatar-group">
                      <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                        <img src="assets/images/avatar/avatar3.webp" alt="" />
                      </div>
                      <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                        <img src="assets/images/avatar/avatar4.webp" alt="" />
                      </div>
                      <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                        <img src="assets/images/avatar/avatar5.webp" alt="" />
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="me-auto">
                      <h6 class="mb-0">Management</h6>
                      <small class="fw-medium text-body d-block">Member <span class="text-primary">02</span>
                      </small>
                    </div>
                    <div class="avatar-group">
                      <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                        <img src="assets/images/avatar/avatar1.webp" alt="" />
                      </div>
                      <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                        <img src="assets/images/avatar/avatar2.webp" alt="" />
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="me-auto">
                      <h6 class="mb-0">Finance</h6>
                      <small class="fw-medium text-body d-block">Member <span class="text-primary">12</span>
                      </small>
                    </div>
                    <div class="avatar-group">
                      <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                        <img src="assets/images/avatar/avatar5.webp" alt="" />
                      </div>
                      <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                        <img src="assets/images/avatar/avatar4.webp" alt="" />
                      </div>
                      <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                        <img src="assets/images/avatar/avatar3.webp" alt="" />
                      </div>
                      <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                        <img src="assets/images/avatar/avatar2.webp" alt="" />
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-xxl-6">
            <div class="card-group overflow-hidden">
              <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between border-0 pb-0">
                  <h6 class="card-title mb-0">Schedule</h6>
                  <button type="button" class="btn btn-sm btn-outline-light btn-shadow waves-effect text-primary ms-3">
                    <i class="fi fi-rr-plus text-2xs me-1"></i> Create New
                  </button>
                </div>
                <div class="card-body p-3">
                  <input type="text" class="form-control d-none flatpickr-inline-custom" placeholder="Select Date.."
                    id="dateTimeFlatpickr" />
                </div>
              </div>
              <div class="card">
                <div class="card-body gradient-layer" style="height: 325px;" data-simplebar>
                  <div class="p-3 bg-light bg-opacity-50 mb-2 rounded">
                    <div class="d-flex align-items-center justify-content-between">
                      <h6 class="mb-0">Team Stand Up</h6>
                      <div class="clearfix d-flex align-items-center">
                        <div class="btn-group">
                          <button class="btn btn-action-dark btn-sm btn-icon waves-effect dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fi fi-rr-menu-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="text-2xs d-flex gap-1 align-items-center">
                      <img src="assets/images/icons/google-meet.svg" alt="" />
                      <span>On Google Meet</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                      <span class="badge bg-white text-black fw-semibold">Marketing</span>
                      <span class="text-primary text-2xs fw-semibold d-flex align-items-center">
                        <i class="fi fi-rr-clock-three me-1"></i> 06:00 - 07:00
                      </span>
                    </div>
                  </div>
                  <div class="p-3 bg-light bg-opacity-50 mb-2 rounded">
                    <div class="d-flex align-items-center justify-content-between">
                      <h6 class="mb-0">All Hands Meeting</h6>
                      <div class="clearfix d-flex align-items-center">
                        <div class="btn-group">
                          <button class="btn btn-action-dark btn-sm btn-icon waves-effect dropdown-toggle"
                            aria-label="Meeting options menu" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fi fi-rr-menu-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="text-2xs d-flex gap-1 align-items-center">
                      <img src="assets/images/icons/google-meet.svg" alt="" />
                      <span>On Google Meet</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                      <span class="badge bg-white text-black fw-semibold">Manager</span>
                      <span class="text-primary text-2xs fw-semibold d-flex align-items-center">
                        <i class="fi fi-rr-clock-three me-1"></i> 06:00 - 07:00
                      </span>
                    </div>
                  </div>
                  <div class="p-3 bg-light bg-opacity-50 mb-2 rounded">
                    <div class="d-flex align-items-center justify-content-between">
                      <h6 class="mb-0">Sprint Planning</h6>
                      <div class="clearfix d-flex align-items-center">
                        <div class="btn-group">
                          <button class="btn btn-action-dark btn-sm btn-icon waves-effect dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fi fi-rr-menu-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="text-2xs d-flex gap-1 align-items-center">
                      <img src="assets/images/icons/google-meet.svg" alt="" />
                      <span>On Google Meet</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                      <span class="badge bg-white text-black fw-semibold">HR</span>
                      <span class="text-primary text-2xs fw-semibold d-flex align-items-center">
                        <i class="fi fi-rr-clock-three me-1"></i> 06:00 - 07:00
                      </span>
                    </div>
                  </div>
                  <div class="p-3 bg-light bg-opacity-50 mb-2 rounded">
                    <div class="d-flex align-items-center justify-content-between">
                      <h6 class="mb-0">Team Stand Up</h6>
                      <div class="clearfix d-flex align-items-center">
                        <div class="btn-group">
                          <button class="btn btn-action-dark btn-sm btn-icon waves-effect dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fi fi-rr-menu-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="text-2xs d-flex gap-1 align-items-center">
                      <img src="assets/images/icons/google-meet.svg" alt="" />
                      <span>On Google Meet</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                      <span class="badge bg-white text-black fw-semibold">Marketing</span>
                      <span class="text-primary text-2xs fw-semibold d-flex align-items-center">
                        <i class="fi fi-rr-clock-three me-1"></i> 06:00 - 07:00
                      </span>
                    </div>
                  </div>
                  <div class="p-3 bg-light bg-opacity-50 mb-2 rounded">
                    <div class="d-flex align-items-center justify-content-between">
                      <h6 class="mb-0">All Hands Meeting</h6>
                      <div class="clearfix d-flex align-items-center">
                        <div class="btn-group">
                          <button class="btn btn-action-dark btn-sm btn-icon waves-effect dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fi fi-rr-menu-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="text-2xs d-flex gap-1 align-items-center">
                      <img src="assets/images/icons/google-meet.svg" alt="" />
                      <span>On Google Meet</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                      <span class="badge bg-white text-black fw-semibold">Manager</span>
                      <span class="text-primary text-2xs fw-semibold d-flex align-items-center">
                        <i class="fi fi-rr-clock-three me-1"></i> 06:00 - 07:00
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-5">
            <div class="card">
              <div class="card-header d-flex align-items-center justify-content-between border-0">
                <h6 class="card-title mb-0">Employee Performance</h6>
                <div class="dropdown">
                  <button class="btn dropdown-toggle btn-white btn-shadow waves-effect btn-sm" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Last Month
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);">Category</a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);">Published</a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);">Date Modifed</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card-body px-2 pb-2 pt-0">
                <table class="table table-sm table-borderless table-row-rounded mb-0">
                  <thead class="table-light">
                    <tr>
                      <th>Name</th>
                      <th>Score</th>
                      <th class="text-end">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="avatar rounded-circle">
                            <img src="assets/images/avatar/avatar1.webp" alt="" />
                          </div>
                          <div class="ms-2 me-auto">
                            <h6 class="mb-0">Olivia Clark</h6>
                            <small class="text-body">UI/UX Designer</small>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div id="employeeScore1"></div>
                      </td>
                      <td>
                        <div class="btn-group float-end">
                          <button class="btn btn-white btn-sm btn-shadow btn-icon waves-effect dropdown-toggle"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fi fi-rr-menu-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="avatar rounded-circle">
                            <img src="assets/images/avatar/avatar2.webp" alt="" />
                          </div>
                          <div class="ms-2 me-auto">
                            <h6 class="mb-0">Michael Davis</h6>
                            <small class="text-body">Full-Stack Developer</small>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div id="employeeScore2"></div>
                      </td>
                      <td>
                        <div class="btn-group float-end">
                          <button class="btn btn-white btn-sm btn-shadow btn-icon waves-effect dropdown-toggle"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fi fi-rr-menu-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="avatar rounded-circle">
                            <img src="assets/images/avatar/avatar3.webp" alt="" />
                          </div>
                          <div class="ms-2 me-auto">
                            <h6 class="mb-0">Michael Davis</h6>
                            <small class="text-body">Web Designer</small>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div id="employeeScore3"></div>
                      </td>
                      <td>
                        <div class="btn-group float-end">
                          <button class="btn btn-white btn-sm btn-shadow btn-icon waves-effect dropdown-toggle"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fi fi-rr-menu-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="avatar rounded-circle">
                            <img src="assets/images/avatar/avatar4.webp" alt="" />
                          </div>
                          <div class="ms-2 me-auto">
                            <h6 class="mb-0">David Wilson</h6>
                            <small class="text-body">Back-End Developer</small>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div id="employeeScore4"></div>
                      </td>
                      <td>
                        <div class="btn-group float-end">
                          <button class="btn btn-white btn-sm btn-shadow btn-icon waves-effect dropdown-toggle"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fi fi-rr-menu-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="col-lg-7">
            <div class="card">
              <div class="card-header d-flex align-items-center justify-content-between border-0 pb-0">
                <h6 class="card-title mb-0">Attendance Rate</h6>
                <a href="javascript:void(0);" class="btn btn-sm btn-outline-light waves-effect btn-shadow">Download
                  Report</a>
              </div>
              <div class="card-body px-1 py-2">
                <div id="chartAttendanceRate"></div>
              </div>
            </div>
          </div>

          <div class="col-xxl-7">
            <div class="card bg-gray bg-opacity-10 border-0 shadow-none">
              <div class="card-header d-flex flex-wrap gap-3 align-items-center justify-content-between border-0 pb-0">
                <h6 class="card-title mb-0">Interview Schedule</h6>
                <div class="clearfix d-flex align-items-center">
                  <a href="javascript:void(0);" class="btn-link me-4">View All</a>
                  <div class="dropdown">
                    <button class="btn dropdown-toggle btn-white btn-shadow waves-effect btn-sm" type="button"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      Last Month
                    </button>
                    <ul class="dropdown-menu">
                      <li>
                        <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="javascript:void(0);">Category</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="javascript:void(0);">Published</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="javascript:void(0);">Date Modifed</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="card-body px-3 pb-2">
                <div class="row gy-2">
                  <div class="col-md-6">
                    <ul class="list-group list-group-smooth list-group-unlined">
                      <li class="list-group-item d-flex justify-content-between align-items-center mb-2">
                        <div class="avatar rounded-circle me-1">
                          <img src="assets/images/avatar/avatar1.webp" alt="" />
                        </div>
                        <div class="ms-2 me-auto">
                          <h6 class="mb-0">William Johnson</h6>
                          <small class="text-body">Web Designer</small>
                        </div>
                        <span class="badge badge-lg bg-danger-subtle text-danger">12.30 PM</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center mb-2">
                        <div class="avatar rounded-circle me-1">
                          <img src="assets/images/avatar/avatar2.webp" alt="" />
                        </div>
                        <div class="ms-2 me-auto">
                          <h6 class="mb-0">Alexander Brown</h6>
                          <small class="text-body">Front-End Developer</small>
                        </div>
                        <span class="badge badge-lg bg-primary-subtle text-primary">24 July 2024</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center mb-2">
                        <div class="avatar rounded-circle me-1">
                          <img src="assets/images/avatar/avatar3.webp" alt="" />
                        </div>
                        <div class="ms-2 me-auto">
                          <h6 class="mb-0">Michael Davis</h6>
                          <small class="text-body">UI/UX Designer</small>
                        </div>
                        <span class="badge badge-lg bg-secondary-subtle text-secondary">11.00 AM</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center mb-2">
                        <div class="avatar rounded-circle me-1">
                          <img src="assets/images/avatar/avatar4.webp" alt="" />
                        </div>
                        <div class="ms-2 me-auto">
                          <h6 class="mb-0">David Wilson</h6>
                          <small class="text-body">Back-End Developer</small>
                        </div>
                        <span class="badge badge-lg bg-success-subtle text-success">12.30 PM</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-6">
                    <ul class="list-group list-group-smooth list-group-unlined">
                      <li class="list-group-item d-flex justify-content-between align-items-center mb-2">
                        <div class="avatar rounded-circle me-1">
                          <img src="assets/images/avatar/avatar4.webp" alt="" />
                        </div>
                        <div class="ms-2 me-auto">
                          <h6 class="mb-0">David Wilson</h6>
                          <small class="text-body">Back-End Developer</small>
                        </div>
                        <span class="badge badge-lg bg-success-subtle text-success">12.30 - 02.30</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center mb-2">
                        <div class="avatar rounded-circle me-1">
                          <img src="assets/images/avatar/avatar1.webp" alt="" />
                        </div>
                        <div class="ms-2 me-auto">
                          <h6 class="mb-0">William Johnson</h6>
                          <small class="text-body">Web Designer</small>
                        </div>
                        <span class="badge badge-lg bg-secondary-subtle text-secondary">10.30 AM</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center mb-2">
                        <div class="avatar rounded-circle me-1">
                          <img src="assets/images/avatar/avatar2.webp" alt="" />
                        </div>
                        <div class="ms-2 me-auto">
                          <h6 class="mb-0">Alexander Brown</h6>
                          <small class="text-body">Front-End Developer</small>
                        </div>
                        <span class="badge badge-lg bg-primary-subtle text-primary">24 July 2024</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center mb-2">
                        <div class="avatar rounded-circle me-1">
                          <img src="assets/images/avatar/avatar3.webp" alt="" />
                        </div>
                        <div class="ms-2 me-auto">
                          <h6 class="mb-0">Michael Davis</h6>
                          <small class="text-body">UI/UX Designer</small>
                        </div>
                        <span class="badge badge-lg bg-secondary-subtle text-secondary">25 Dec 2024</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xxl-5">
            <div class="card">
              <div class="card-header d-flex align-items-center justify-content-between border-0 pb-0">
                <h6 class="card-title mb-0">Task Update</h6>
                <div class="clearfix">
                  <a href="javascript:void(0);" class="btn-link">View All</a>
                  <button type="button" class="btn btn-sm btn-outline-light btn-shadow text-primary waves-effect ms-3"
                    data-bs-toggle="modal" data-bs-target="#todoTaskModal">
                    <i class="fi fi-rr-plus text-2xs me-1"></i> New Task
                  </button>
                </div>
              </div>
              <div class="card-body pb-1 px-2 pt-3 overflow-auto" style="height: 325px;" data-simplebar>
                <ul id="todoList" class="list-group list-group-smooth list-group-unlined todo-nav">
                  <li class="list-group-item d-flex gap-2 align-items-center todo-item mb-1 ps-3 pe-2 py-2">
                    <span class="sortable-handle">
                      <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M11.9998 3.16667C12.7362 3.16667 13.3332 2.56971 13.3332 1.83333C13.3332 1.09695 12.7362 0.5 11.9998 0.5C11.2635 0.5 10.6665 1.09695 10.6665 1.83333C10.6665 2.56971 11.2635 3.16667 11.9998 3.16667Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M11.9998 9.26237C12.7362 9.26237 13.3332 8.66542 13.3332 7.92904C13.3332 7.19266 12.7362 6.5957 11.9998 6.5957C11.2635 6.5957 10.6665 7.19266 10.6665 7.92904C10.6665 8.66542 11.2635 9.26237 11.9998 9.26237Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M11.9998 15.3571C12.7362 15.3571 13.3332 14.7601 13.3332 14.0238C13.3332 13.2874 12.7362 12.6904 11.9998 12.6904C11.2635 12.6904 10.6665 13.2874 10.6665 14.0238C10.6665 14.7601 11.2635 15.3571 11.9998 15.3571Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M4.7618 3.16667C5.49818 3.16667 6.09513 2.56971 6.09513 1.83333C6.09513 1.09695 5.49818 0.5 4.7618 0.5C4.02542 0.5 3.42847 1.09695 3.42847 1.83333C3.42847 2.56971 4.02542 3.16667 4.7618 3.16667Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M4.7618 9.26237C5.49818 9.26237 6.09513 8.66542 6.09513 7.92904C6.09513 7.19266 5.49818 6.5957 4.7618 6.5957C4.02542 6.5957 3.42847 7.19266 3.42847 7.92904C3.42847 8.66542 4.02542 9.26237 4.7618 9.26237Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M4.7618 15.3571C5.49818 15.3571 6.09513 14.7601 6.09513 14.0238C6.09513 13.2874 5.49818 12.6904 4.7618 12.6904C4.02542 12.6904 3.42847 13.2874 3.42847 14.0238C3.42847 14.7601 4.02542 15.3571 4.7618 15.3571Z"
                          fill="var(--bs-body-color)" />
                      </svg>
                    </span>
                    <input class="form-check-input todo-checkbox check-dark" type="checkbox" />
                    <span class="form-label mb-0">Prepare monthly financial report</span>
                    <span class="todo-time text-body">04:25PM</span>
                    <button type="button"
                      class="btn btn-action-gray btn-sm btn-icon waves-effect waves-light item-delete ms-auto">
                      <i class="fi fi-rr-trash"></i>
                    </button>
                  </li>
                  <li class="list-group-item d-flex gap-2 align-items-center todo-item mb-1 ps-3 pe-2 py-2">
                    <span class="sortable-handle">
                      <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M11.9998 3.16667C12.7362 3.16667 13.3332 2.56971 13.3332 1.83333C13.3332 1.09695 12.7362 0.5 11.9998 0.5C11.2635 0.5 10.6665 1.09695 10.6665 1.83333C10.6665 2.56971 11.2635 3.16667 11.9998 3.16667Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M11.9998 9.26237C12.7362 9.26237 13.3332 8.66542 13.3332 7.92904C13.3332 7.19266 12.7362 6.5957 11.9998 6.5957C11.2635 6.5957 10.6665 7.19266 10.6665 7.92904C10.6665 8.66542 11.2635 9.26237 11.9998 9.26237Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M11.9998 15.3571C12.7362 15.3571 13.3332 14.7601 13.3332 14.0238C13.3332 13.2874 12.7362 12.6904 11.9998 12.6904C11.2635 12.6904 10.6665 13.2874 10.6665 14.0238C10.6665 14.7601 11.2635 15.3571 11.9998 15.3571Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M4.7618 3.16667C5.49818 3.16667 6.09513 2.56971 6.09513 1.83333C6.09513 1.09695 5.49818 0.5 4.7618 0.5C4.02542 0.5 3.42847 1.09695 3.42847 1.83333C3.42847 2.56971 4.02542 3.16667 4.7618 3.16667Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M4.7618 9.26237C5.49818 9.26237 6.09513 8.66542 6.09513 7.92904C6.09513 7.19266 5.49818 6.5957 4.7618 6.5957C4.02542 6.5957 3.42847 7.19266 3.42847 7.92904C3.42847 8.66542 4.02542 9.26237 4.7618 9.26237Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M4.7618 15.3571C5.49818 15.3571 6.09513 14.7601 6.09513 14.0238C6.09513 13.2874 5.49818 12.6904 4.7618 12.6904C4.02542 12.6904 3.42847 13.2874 3.42847 14.0238C3.42847 14.7601 4.02542 15.3571 4.7618 15.3571Z"
                          fill="var(--bs-body-color)" />
                      </svg>
                    </span>
                    <input class="form-check-input todo-checkbox check-dark" type="checkbox" checked />
                    <span class="form-label mb-0">Develop new marketing strategy</span>
                    <span class="todo-time text-body">04:25PM</span>
                    <button type="button"
                      class="btn btn-action-gray btn-sm btn-icon waves-effect waves-light item-delete ms-auto">
                      <i class="fi fi-rr-trash"></i>
                    </button>
                  </li>
                  <li class="list-group-item d-flex gap-2 align-items-center todo-item mb-1 ps-3 pe-2 py-2">
                    <span class="sortable-handle">
                      <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M11.9998 3.16667C12.7362 3.16667 13.3332 2.56971 13.3332 1.83333C13.3332 1.09695 12.7362 0.5 11.9998 0.5C11.2635 0.5 10.6665 1.09695 10.6665 1.83333C10.6665 2.56971 11.2635 3.16667 11.9998 3.16667Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M11.9998 9.26237C12.7362 9.26237 13.3332 8.66542 13.3332 7.92904C13.3332 7.19266 12.7362 6.5957 11.9998 6.5957C11.2635 6.5957 10.6665 7.19266 10.6665 7.92904C10.6665 8.66542 11.2635 9.26237 11.9998 9.26237Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M11.9998 15.3571C12.7362 15.3571 13.3332 14.7601 13.3332 14.0238C13.3332 13.2874 12.7362 12.6904 11.9998 12.6904C11.2635 12.6904 10.6665 13.2874 10.6665 14.0238C10.6665 14.7601 11.2635 15.3571 11.9998 15.3571Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M4.7618 3.16667C5.49818 3.16667 6.09513 2.56971 6.09513 1.83333C6.09513 1.09695 5.49818 0.5 4.7618 0.5C4.02542 0.5 3.42847 1.09695 3.42847 1.83333C3.42847 2.56971 4.02542 3.16667 4.7618 3.16667Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M4.7618 9.26237C5.49818 9.26237 6.09513 8.66542 6.09513 7.92904C6.09513 7.19266 5.49818 6.5957 4.7618 6.5957C4.02542 6.5957 3.42847 7.19266 3.42847 7.92904C3.42847 8.66542 4.02542 9.26237 4.7618 9.26237Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M4.7618 15.3571C5.49818 15.3571 6.09513 14.7601 6.09513 14.0238C6.09513 13.2874 5.49818 12.6904 4.7618 12.6904C4.02542 12.6904 3.42847 13.2874 3.42847 14.0238C3.42847 14.7601 4.02542 15.3571 4.7618 15.3571Z"
                          fill="var(--bs-body-color)" />
                      </svg>
                    </span>
                    <input class="form-check-input todo-checkbox check-dark" type="checkbox" />
                    <span class="form-label mb-0">Reply to customer emails</span>
                    <span class="todo-time text-body">04:25PM</span>
                    <button type="button"
                      class="btn btn-action-gray btn-sm btn-icon waves-effect waves-light item-delete ms-auto">
                      <i class="fi fi-rr-trash"></i>
                    </button>
                  </li>
                  <li class="list-group-item d-flex gap-2 align-items-center todo-item mb-1 ps-3 pe-2 py-2">
                    <span class="sortable-handle">
                      <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M11.9998 3.16667C12.7362 3.16667 13.3332 2.56971 13.3332 1.83333C13.3332 1.09695 12.7362 0.5 11.9998 0.5C11.2635 0.5 10.6665 1.09695 10.6665 1.83333C10.6665 2.56971 11.2635 3.16667 11.9998 3.16667Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M11.9998 9.26237C12.7362 9.26237 13.3332 8.66542 13.3332 7.92904C13.3332 7.19266 12.7362 6.5957 11.9998 6.5957C11.2635 6.5957 10.6665 7.19266 10.6665 7.92904C10.6665 8.66542 11.2635 9.26237 11.9998 9.26237Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M11.9998 15.3571C12.7362 15.3571 13.3332 14.7601 13.3332 14.0238C13.3332 13.2874 12.7362 12.6904 11.9998 12.6904C11.2635 12.6904 10.6665 13.2874 10.6665 14.0238C10.6665 14.7601 11.2635 15.3571 11.9998 15.3571Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M4.7618 3.16667C5.49818 3.16667 6.09513 2.56971 6.09513 1.83333C6.09513 1.09695 5.49818 0.5 4.7618 0.5C4.02542 0.5 3.42847 1.09695 3.42847 1.83333C3.42847 2.56971 4.02542 3.16667 4.7618 3.16667Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M4.7618 9.26237C5.49818 9.26237 6.09513 8.66542 6.09513 7.92904C6.09513 7.19266 5.49818 6.5957 4.7618 6.5957C4.02542 6.5957 3.42847 7.19266 3.42847 7.92904C3.42847 8.66542 4.02542 9.26237 4.7618 9.26237Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M4.7618 15.3571C5.49818 15.3571 6.09513 14.7601 6.09513 14.0238C6.09513 13.2874 5.49818 12.6904 4.7618 12.6904C4.02542 12.6904 3.42847 13.2874 3.42847 14.0238C3.42847 14.7601 4.02542 15.3571 4.7618 15.3571Z"
                          fill="var(--bs-body-color)" />
                      </svg>
                    </span>
                    <input class="form-check-input todo-checkbox check-dark" type="checkbox" />
                    <span class="form-label mb-0">Update website content</span>
                    <span class="todo-time text-body">04:25PM</span>
                    <button type="button"
                      class="btn btn-action-gray btn-sm btn-icon waves-effect waves-light item-delete ms-auto">
                      <i class="fi fi-rr-trash"></i>
                    </button>
                  </li>
                  <li class="list-group-item d-flex gap-2 align-items-center todo-item mb-1 ps-3 pe-2 py-2">
                    <span class="sortable-handle">
                      <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M11.9998 3.16667C12.7362 3.16667 13.3332 2.56971 13.3332 1.83333C13.3332 1.09695 12.7362 0.5 11.9998 0.5C11.2635 0.5 10.6665 1.09695 10.6665 1.83333C10.6665 2.56971 11.2635 3.16667 11.9998 3.16667Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M11.9998 9.26237C12.7362 9.26237 13.3332 8.66542 13.3332 7.92904C13.3332 7.19266 12.7362 6.5957 11.9998 6.5957C11.2635 6.5957 10.6665 7.19266 10.6665 7.92904C10.6665 8.66542 11.2635 9.26237 11.9998 9.26237Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M11.9998 15.3571C12.7362 15.3571 13.3332 14.7601 13.3332 14.0238C13.3332 13.2874 12.7362 12.6904 11.9998 12.6904C11.2635 12.6904 10.6665 13.2874 10.6665 14.0238C10.6665 14.7601 11.2635 15.3571 11.9998 15.3571Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M4.7618 3.16667C5.49818 3.16667 6.09513 2.56971 6.09513 1.83333C6.09513 1.09695 5.49818 0.5 4.7618 0.5C4.02542 0.5 3.42847 1.09695 3.42847 1.83333C3.42847 2.56971 4.02542 3.16667 4.7618 3.16667Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M4.7618 9.26237C5.49818 9.26237 6.09513 8.66542 6.09513 7.92904C6.09513 7.19266 5.49818 6.5957 4.7618 6.5957C4.02542 6.5957 3.42847 7.19266 3.42847 7.92904C3.42847 8.66542 4.02542 9.26237 4.7618 9.26237Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M4.7618 15.3571C5.49818 15.3571 6.09513 14.7601 6.09513 14.0238C6.09513 13.2874 5.49818 12.6904 4.7618 12.6904C4.02542 12.6904 3.42847 13.2874 3.42847 14.0238C3.42847 14.7601 4.02542 15.3571 4.7618 15.3571Z"
                          fill="var(--bs-body-color)" />
                      </svg>
                    </span>
                    <input class="form-check-input todo-checkbox" type="checkbox" checked />
                    <span class="form-label mb-0">Review employee performance</span>
                    <span class="todo-time text-body text-body">04:25PM</span>
                    <button type="button"
                      class="btn btn-action-gray btn-sm btn-icon waves-effect waves-light item-delete ms-auto">
                      <i class="fi fi-rr-trash"></i>
                    </button>
                  </li>
                  <li class="list-group-item d-flex gap-2 align-items-center todo-item mb-1 ps-3 pe-2 py-2">
                    <span class="sortable-handle">
                      <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M11.9998 3.16667C12.7362 3.16667 13.3332 2.56971 13.3332 1.83333C13.3332 1.09695 12.7362 0.5 11.9998 0.5C11.2635 0.5 10.6665 1.09695 10.6665 1.83333C10.6665 2.56971 11.2635 3.16667 11.9998 3.16667Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M11.9998 9.26237C12.7362 9.26237 13.3332 8.66542 13.3332 7.92904C13.3332 7.19266 12.7362 6.5957 11.9998 6.5957C11.2635 6.5957 10.6665 7.19266 10.6665 7.92904C10.6665 8.66542 11.2635 9.26237 11.9998 9.26237Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M11.9998 15.3571C12.7362 15.3571 13.3332 14.7601 13.3332 14.0238C13.3332 13.2874 12.7362 12.6904 11.9998 12.6904C11.2635 12.6904 10.6665 13.2874 10.6665 14.0238C10.6665 14.7601 11.2635 15.3571 11.9998 15.3571Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M4.7618 3.16667C5.49818 3.16667 6.09513 2.56971 6.09513 1.83333C6.09513 1.09695 5.49818 0.5 4.7618 0.5C4.02542 0.5 3.42847 1.09695 3.42847 1.83333C3.42847 2.56971 4.02542 3.16667 4.7618 3.16667Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M4.7618 9.26237C5.49818 9.26237 6.09513 8.66542 6.09513 7.92904C6.09513 7.19266 5.49818 6.5957 4.7618 6.5957C4.02542 6.5957 3.42847 7.19266 3.42847 7.92904C3.42847 8.66542 4.02542 9.26237 4.7618 9.26237Z"
                          fill="var(--bs-body-color)" />
                        <path
                          d="M4.7618 15.3571C5.49818 15.3571 6.09513 14.7601 6.09513 14.0238C6.09513 13.2874 5.49818 12.6904 4.7618 12.6904C4.02542 12.6904 3.42847 13.2874 3.42847 14.0238C3.42847 14.7601 4.02542 15.3571 4.7618 15.3571Z"
                          fill="var(--bs-body-color)" />
                      </svg>
                    </span>
                    <input class="form-check-input todo-checkbox check-success" type="checkbox" checked />
                    <span class="form-label mb-0">Reply to customer emails</span>
                    <span class="todo-time text-body">04:25PM</span>
                    <button type="button"
                      class="btn btn-action-gray btn-sm btn-icon waves-effect waves-light item-delete ms-auto">
                      <i class="fi fi-rr-trash"></i>
                    </button>
                  </li>
                </ul>
              </div>
              <div class="modal fade" id="todoTaskModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header py-3">
                      <h5 class="modal-title">Add New Task</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form id="taskForm">
                        <div class="row">
                          <div class="col-12 mb-3">
                            <input type="text" id="todoInput" class="form-control" placeholder="Add a new task" />
                          </div>
                          <div class="col-12 mb-3">
                            <select id="todoPriority" class="form-select">
                              <option value="default">Default</option>
                              <option value="success">Completed</option>
                              <option value="danger">High Priority</option>
                              <option value="info">Info</option>
                            </select>
                          </div>
                          <div class="col-12 text-end">
                            <button type="button" class="btn btn-light waves-effect waves-light me-2"
                              data-bs-dismiss="modal">Close</button>
                            <button type="button" id="todoAdd" class="btn btn-primary waves-effect waves-light"
                              data-bs-dismiss="modal">Add Task</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

        <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header py-3">
                <h5 class="modal-title">Add Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form>
                  <div class="mb-3">
                    <label for="fullName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="fullName" placeholder="Enter full name" />
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="email" class="form-label">Email Address</label>
                      <input type="email" class="form-control" id="email" placeholder="example@email.com" />
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="phone" class="form-label">Phone Number</label>
                      <input type="tel" class="form-control" id="phone" placeholder="+91 9876543210" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="department" class="form-label">Department</label>
                      <select class="form-select" id="department">
                        <option selected disabled>Select Department</option>
                        <option>HR</option>
                        <option>Development</option>
                        <option>Sales</option>
                        <option>Marketing</option>
                      </select>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="designation" class="form-label">Designation</label>
                      <input type="text" class="form-control" id="designation" placeholder="e.g. Software Engineer" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="joiningDate" class="form-label">Joining Date</label>
                      <input type="date" class="form-control flatpickr-date" id="joiningDate" />
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="status" class="form-label">Employment Status</label>
                      <select class="form-select" id="status">
                        <option>Active</option>
                        <option>Inactive</option>
                        <option>Probation</option>
                      </select>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" rows="2" placeholder="Enter address"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="photo" class="form-label">Profile Photo</label>
                    <input class="form-control" type="file" id="photo" />
                  </div>
                  <div class="text-end">
                    <button type="submit" class="btn btn-success">Add Employee</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>

    </main>

     <!-- begin::GXON Footer --> 
    <footer class="footer-wrapper bg-body">
      <div class="container">
        <div class="row g-2">
          <div class="col-lg-6 col-md-7 text-center text-md-start">
            <p class="mb-0">© <span class="currentYear">2025</span> GXON. Proudly powered by <a
                href="javascript:void(0);">LayoutDrop</a>.</p>
          </div>
          <div class="col-lg-6 col-md-5">
            <ul class="d-flex list-inline mb-0 gap-3 flex-wrap justify-content-center justify-content-md-end">
              <li>
                <a class="text-body" href="index.html">Home</a>
              </li>
              <li>
                <a class="text-body" href="pages/faq.html">Faq's</a>
              </li>
              <li>
                <a class="text-body" href="pages/faq.html">Support</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
     <!-- end::GXON Footer --> 

  </div>

   <!-- begin::GXON Page Scripts --> 
  <script src="assets/libs/global/global.min.js"></script>
  <script src="assets/libs/sortable/Sortable.min.js"></script>
  <script src="assets/libs/chartjs/chart.js"></script>
  <script src="assets/libs/flatpickr/flatpickr.min.js"></script>
  <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
  <script src="assets/libs/datatables/datatables.min.js"></script>
  <script src="assets/js/dashboard.js"></script>
  <script src="assets/js/todolist.js"></script>
  <script src="assets/js/appSettings.js"></script>
  <script src="assets/js/main.js"></script>
   <!-- end::GXON Page Scripts --> 
</body>

</html>