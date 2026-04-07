@extends('layouts.dashboard')

@section('title', 'Dashboard - HR Management System')

@section('content')
<div class="app-page-head d-flex flex-wrap gap-3 align-items-center justify-content-between">
  <div class="clearfix">
    <h1 class="app-page-title">Dashboard</h1>
    <span>{{ now()->format('D, M d, Y') }} - {{ now()->addDays(30)->format('D, M d, Y') }}</span>
  </div>
  @auth
    @if(Auth::user()->isAdmin() || Auth::user()->isHR() || Auth::user()->isSuperAdmin())
      <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
        data-bs-target="#addEmployeeModal">
        <i class="fi fi-rr-plus me-1"></i> Add Employee
      </button>
    @endif
  @endauth
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
                <i class="fi fi-rr-arrow-small-up scale-3x"></i> 
                +{{ $totalEmployees > 0 ? round(($activeEmployees/$totalEmployees)*100, 1) : 0 }}%
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
                <i class="fi fi-rr-arrow-small-down scale-3x"></i> 
                -{{ $totalEmployees > 0 ? round(($inactiveEmployees/$totalEmployees)*100, 1) : 0 }}%
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
        <img src="{{ asset('assets/images/media/svg/media1.svg') }}" alt="" class="position-absolute bottom-0 end-0 z-n1" />
      </div>
      <div class="card-footer border-0 pt-0">
        <a href="#" class="btn btn-outline-light waves-effect btn-shadow">Create Now</a>
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
          <option value="pending">{{ date('Y') }}</option>
          <option>{{ date('Y') - 1 }}</option>
          <option>{{ date('Y') - 2 }}</option>
          <option>{{ date('Y') - 3 }}</option>
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
            <p class="mb-0">{{ date('Y') }} Download Report Company Trends and Insights</p>
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
        <a href="#" class="btn-link">View All</a>
      </div>
      <div class="card-body pb-3">
        <ul class="list-group list-group-hover list-group-smooth list-group-unlined list-group-outer">
          @forelse($recentEmployees->take(5) as $employee)
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <div class="avatar rounded-circle me-1">
                <img src="{{ asset('assets/images/avatar/avatar1.webp') }}" alt="" />
              </div>
              <div class="ms-2 me-auto">
                <h6 class="mb-0">{{ $employee->name }}</h6>
                <small>{{ $employee->position ?? 'Employee' }}</small>
              </div>
              <span class="badge bg-{{ $employee->status === 'active' ? 'success' : ($employee->status === 'on_leave' ? 'warning' : 'danger') }}">
                {{ ucfirst(str_replace('_', ' ', $employee->status)) }}
              </span>
            </li>
          @empty
            <li class="list-group-item text-center text-muted">No recent applications</li>
          @endforelse
        </ul>
      </div>
    </div>
  </div>

  <div class="col-xxl-8 col-lg-7">
    <div class="card overflow-hidden">
      <div class="card-header d-flex flex-wrap gap-3 align-items-center justify-content-between border-0 pb-0">
        <h6 class="card-title mb-0">Employee's Leave</h6>
      </div>
      <div class="card-body px-3 pt-2 pb-0">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead class="table-light">
              <tr>
                <th>Name</th>
                <th>Department</th>
                <th>Status</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              @forelse($recentEmployees as $employee)
                <tr>
                  <td>{{ $employee->name }}</td>
                  <td>{{ $employee->department ?? 'N/A' }}</td>
                  <td>
                    <span class="badge bg-{{ $employee->status === 'active' ? 'success' : ($employee->status === 'on_leave' ? 'warning' : 'danger') }}">
                      {{ ucfirst(str_replace('_', ' ', $employee->status)) }}
                    </span>
                  </td>
                  <td>{{ $employee->created_at->format('d M Y') }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="text-center text-muted">No employees found</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xxl-3 col-md-6">
    <div class="card">
      <div class="card-header d-flex align-items-center justify-content-between border-0 pb-0">
        <h6 class="card-title mb-0">Employee Type</h6>
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
          <a href="#" class="btn-link">View All</a>
        </div>
      </div>
      <div class="card-body px-3 pb-3">
        <ul class="list-group list-group-hover list-group-smooth list-group-space-sm">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="me-auto">
              <h6 class="mb-0">Marketing</h6>
              <small class="fw-medium text-body d-block">Member <span class="text-primary">03</span></small>
            </div>
            <div class="avatar-group">
              <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                <img src="{{ asset('assets/images/avatar/avatar1.webp') }}" alt="" />
              </div>
              <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                <img src="{{ asset('assets/images/avatar/avatar2.webp') }}" alt="" />
              </div>
              <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                <img src="{{ asset('assets/images/avatar/avatar3.webp') }}" alt="" />
              </div>
            </div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="me-auto">
              <h6 class="mb-0">Development</h6>
              <small class="fw-medium text-body d-block">Member <span class="text-secondary">40</span></small>
            </div>
            <div class="avatar-group">
              <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                <img src="{{ asset('assets/images/avatar/avatar4.webp') }}" alt="" />
              </div>
              <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                <img src="{{ asset('assets/images/avatar/avatar5.webp') }}" alt="" />
              </div>
              <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                <img src="{{ asset('assets/images/avatar/avatar1.webp') }}" alt="" />
              </div>
              <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                <img src="{{ asset('assets/images/avatar/avatar2.webp') }}" alt="" />
              </div>
            </div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="me-auto">
              <h6 class="mb-0">Designing Team</h6>
              <small class="fw-medium text-body d-block">Member <span class="text-info">03</span></small>
            </div>
            <div class="avatar-group">
              <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                <img src="{{ asset('assets/images/avatar/avatar3.webp') }}" alt="" />
              </div>
              <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                <img src="{{ asset('assets/images/avatar/avatar4.webp') }}" alt="" />
              </div>
              <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                <img src="{{ asset('assets/images/avatar/avatar5.webp') }}" alt="" />
              </div>
            </div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="me-auto">
              <h6 class="mb-0">Management</h6>
              <small class="fw-medium text-body d-block">Member <span class="text-primary">02</span></small>
            </div>
            <div class="avatar-group">
              <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                <img src="{{ asset('assets/images/avatar/avatar1.webp') }}" alt="" />
              </div>
              <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                <img src="{{ asset('assets/images/avatar/avatar2.webp') }}" alt="" />
              </div>
            </div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="me-auto">
              <h6 class="mb-0">Finance</h6>
              <small class="fw-medium text-body d-block">Member <span class="text-primary">12</span></small>
            </div>
            <div class="avatar-group">
              <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                <img src="{{ asset('assets/images/avatar/avatar5.webp') }}" alt="" />
              </div>
              <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                <img src="{{ asset('assets/images/avatar/avatar4.webp') }}" alt="" />
              </div>
              <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                <img src="{{ asset('assets/images/avatar/avatar3.webp') }}" alt="" />
              </div>
              <div class="avatar avatar-xs rounded-circle border border-2 border-white">
                <img src="{{ asset('assets/images/avatar/avatar2.webp') }}" alt="" />
              </div>
            </div>
          </li>
        </ul>
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
              <a class="dropdown-item" href="javascript:void(0);">Date Modified</a>
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
                    <img src="{{ asset('assets/images/avatar/avatar1.webp') }}" alt="" />
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
                    <img src="{{ asset('assets/images/avatar/avatar2.webp') }}" alt="" />
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
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>

<!-- Add Employee Modal -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header py-3">
        <h5 class="modal-title">Add Employee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('employees.store') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="modal_name" class="form-label">Full Name *</label>
            <input type="text" class="form-control" id="modal_name" name="name" placeholder="Enter full name" required />
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="modal_email" class="form-label">Email Address *</label>
              <input type="email" class="form-control" id="modal_email" name="email" placeholder="example@email.com" required />
            </div>
            <div class="col-md-6 mb-3">
              <label for="modal_phone" class="form-label">Phone Number</label>
              <input type="tel" class="form-control" id="modal_phone" name="phone" placeholder="+91 9876543210" />
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="modal_password" class="form-label">Password *</label>
              <input type="password" class="form-control" id="modal_password" name="password" placeholder="Min 8 characters" required />
            </div>
            <div class="col-md-6 mb-3">
              <label for="modal_password_confirmation" class="form-label">Confirm Password *</label>
              <input type="password" class="form-control" id="modal_password_confirmation" name="password_confirmation" required />
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="modal_department" class="form-label">Department *</label>
              <select class="form-select" id="modal_department" name="department" required>
                <option selected disabled value="">Select Department</option>
                <option value="HR">HR</option>
                <option value="Development">Development</option>
                <option value="Sales">Sales</option>
                <option value="Marketing">Marketing</option>
                <option value="Finance">Finance</option>
                <option value="Operations">Operations</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="modal_position" class="form-label">Position *</label>
              <input type="text" class="form-control" id="modal_position" name="position" placeholder="e.g. Software Engineer" required />
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="modal_employment_type" class="form-label">Employment Type *</label>
              <select class="form-select" id="modal_employment_type" name="employment_type" required>
                <option value="full-time" selected>Full-Time</option>
                <option value="part-time">Part-Time</option>
                <option value="contract">Contract</option>
                <option value="intern">Intern</option>
              </select>
            </div>
            <div class="col-md-4 mb-3">
              <label for="modal_work_shift" class="form-label">Work Shift *</label>
              <select class="form-select" id="modal_work_shift" name="work_shift" required>
                <option value="morning" selected>Morning</option>
                <option value="evening">Evening</option>
                <option value="night">Night</option>
              </select>
            </div>
            <div class="col-md-4 mb-3">
              <label for="modal_hire_date" class="form-label">Joining Date *</label>
              <input type="date" class="form-control flatpickr-date" id="modal_hire_date" name="hire_date" required />
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="modal_status" class="form-label">Employment Status</label>
              <select class="form-select" id="modal_status" name="status">
                <option value="active" selected>Active</option>
                <option value="inactive">Inactive</option>
                <option value="on_leave">On Leave</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="modal_address" class="form-label">Address</label>
              <input type="text" class="form-control" id="modal_address" name="address" placeholder="Enter address" />
            </div>
          </div>
          <div class="text-end">
            <button type="submit" class="btn btn-success">Add Employee</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
