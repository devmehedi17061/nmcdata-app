@extends('layouts.dashboard')

@section('title', 'Employees - HR Management System')

@section('content')
<div class="app-page-head d-flex flex-wrap gap-3 align-items-center justify-content-between">
  <div class="clearfix">
    <h1 class="app-page-title">
      <span class="text-primary">{{ $employees->total() }}</span> Employee
    </h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">
          <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Employee</li>
      </ol>
    </nav>
  </div>
  @if(Auth::user()->isSuperAdmin() || Auth::user()->isAdmin() || Auth::user()->isHR())
    <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
      <i class="fi fi-rr-plus me-1"></i> Add Employee
    </button>
  @endif
</div>

<div class="card d-flex flex-row flex-wrap align-items-center h-auto mb-5">
  <ul class="nav nav-underline me-auto px-3 gap-2">
    <li class="nav-item">
      <a class="nav-link border-3 py-3 px-2 active" href="{{ route('employees.index') }}">Employee</a>
    </li>
    <li class="nav-item">
      <a class="nav-link border-3 py-3 px-2" href="{{ route('leave.index') }}">Leave Request</a>
    </li>
  </ul>
  <div class="d-flex ps-3">
    <!-- Grid/List View Toggle Buttons -->
    <div class="d-flex align-items-center me-4">
      <button class="btn btn-link p-0 me-3 text-primary" id="gridViewBtn" title="Grid View">
        <i class="fi fi-rr-apps text-sm"></i>
      </button>
      <button class="btn btn-link p-0 text-body" id="listViewBtn" title="List View">
        <i class="fi fi-br-list text-sm"></i>
      </button>
    </div>
    <div class="vr"></div>
    <form class="d-flex align-items-center h-100 w-150px w-lg-300px position-relative" action="{{ route('employees.search') }}" method="GET">
      <button type="submit" class="btn btn-sm border-0 position-absolute start-0 ms-3 p-0">
        <i class="fi fi-rr-search"></i>
      </button>
      <input type="text" name="q" class="form-control form-control-lg ps-5 rounded-start-0 border-0 shadow-none bg-transparent" placeholder="Search Employee" value="{{ request('q') }}">
    </form>
  </div>
</div>

<!-- Grid View (Card Layout) -->
<div class="row" id="gridView">
  @forelse($employees as $employee)
    <div class="col-xxl-3 col-lg-4 col-md-6">
      <div class="card {{ $employee->status === 'active' ? '' : ($employee->status === 'on_leave' ? 'bg-danger-subtle border-0' : '') }}">
        <div class="card-header d-flex align-items-center justify-content-between border-0 pb-0 p-3">
          <span class="badge bg-{{ $employee->status === 'active' ? 'success' : ($employee->status === 'on_leave' ? 'danger' : 'warning') }}-subtle text-{{ $employee->status === 'active' ? 'success' : ($employee->status === 'on_leave' ? 'danger' : 'warning') }}">
            {{ ucfirst(str_replace('_', ' ', $employee->status)) }}
          </span>
          <div class="clearfix">
            <div class="btn-group">
              <button class="btn btn-white btn-sm btn-shadow btn-icon waves-effect dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fi fi-rr-menu-dots"></i>
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="dropdown-item" href="{{ route('employees.show', $employee->id) }}">View</a>
                </li>
                @if(Auth::user()->isSuperAdmin() || Auth::user()->isAdmin() || Auth::user()->isHR())
                  <li>
                    <a class="dropdown-item" href="{{ route('employees.edit', $employee->id) }}">Edit</a>
                  </li>
                  <li>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="dropdown-item text-danger">Delete</button>
                    </form>
                  </li>
                @endif
              </ul>
            </div>
          </div>
        </div>
        <div class="card-body p-2 pt-0">
          <div class="text-center mb-3">
            <div class="avatar avatar-xxl rounded-4 mx-auto mb-3">
              <img src="{{ $employee->photo ? asset('storage/' . $employee->photo) : asset('assets/images/avatar/avatar1.webp') }}" alt="{{ $employee->name }}">
            </div>
            <h5 class="mb-0 fw-bold">{{ $employee->name }}</h5>
            <p class="text-primary mb-0">{{ $employee->position }}</p>
          </div>
          <div class="p-3 {{ $employee->status === 'on_leave' ? 'bg-body' : 'bg-light' }} rounded">
            <div class="d-flex gap-3">
              <div class="w-50">
                <span class="text-1xs">Department</span>
                <h6 class="mb-0">{{ $employee->department }}</h6>
              </div>
              <div class="w-50">
                <span class="text-1xs">Hired Date</span>
                <h6 class="mb-0">{{ $employee->hire_date ? \Carbon\Carbon::parse($employee->hire_date)->format('d M Y') : 'N/A' }}</h6>
              </div>
            </div>
            <hr class="border-dashed">
            <div class="d-grid gap-2">
              <span class="d-block text-dark">
                <i class="fi fi-rr-envelope me-2 text-primary"></i>
                {{ $employee->email }}
              </span>
              <span class="d-block text-dark">
                <i class="fi fi-rr-phone-call me-2 text-primary"></i>
                {{ $employee->phone ?? 'N/A' }}
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  @empty
    <div class="col-12 empty-state-grid">
      <div class="card">
        <div class="card-body text-center py-5">
          <i class="fi fi-rr-user-slash text-muted" style="font-size: 48px;"></i>
          <h5 class="mt-3 text-muted">No employees found</h5>
          <p class="text-muted">There are no employees to display.</p>
          @if(Auth::user()->isSuperAdmin() || Auth::user()->isAdmin() || Auth::user()->isHR())
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
              <i class="fi fi-rr-plus me-1"></i> Add Employee
            </button>
          @endif
        </div>
      </div>
    </div>
  @endforelse
</div>

<!-- List View (Table Layout) - Hidden by default -->
<div class="row d-none" id="listView">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-light">
              <tr>
                <th>Employee</th>
                <th>Email</th>
                <th>Position</th>
                <th>Department</th>
                <th>Hired Date</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($employees as $employee)
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="avatar avatar-sm rounded-circle me-2">
                        <img src="{{ $employee->photo ? asset('storage/' . $employee->photo) : asset('assets/images/avatar/avatar1.webp') }}" alt="{{ $employee->name }}">
                      </div>
                      <div>
                        <h6 class="mb-0">{{ $employee->name }}</h6>
                        <small class="text-muted">{{ $employee->phone ?? 'N/A' }}</small>
                      </div>
                    </div>
                  </td>
                  <td>{{ $employee->email }}</td>
                  <td>{{ $employee->position }}</td>
                  <td>{{ $employee->department }}</td>
                  <td>{{ $employee->hire_date ? \Carbon\Carbon::parse($employee->hire_date)->format('d M Y') : 'N/A' }}</td>
                  <td>
                    <span class="badge bg-{{ $employee->status === 'active' ? 'success' : ($employee->status === 'on_leave' ? 'danger' : 'warning') }}-subtle text-{{ $employee->status === 'active' ? 'success' : ($employee->status === 'on_leave' ? 'danger' : 'warning') }}">
                      {{ ucfirst(str_replace('_', ' ', $employee->status)) }}
                    </span>
                  </td>
                  <td>
                    <div class="d-flex gap-1">
                      <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-sm btn-light btn-icon" title="View">
                        <i class="fi fi-rr-eye text-primary"></i>
                      </a>
                      @if(Auth::user()->isSuperAdmin() || Auth::user()->isAdmin() || Auth::user()->isHR())
                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-light btn-icon" title="Edit">
                          <i class="fi fi-rr-pencil text-warning"></i>
                        </a>
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-light btn-icon" title="Delete">
                            <i class="fi fi-rr-trash text-danger"></i>
                          </button>
                        </form>
                      @endif
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="text-center py-4">
                    <i class="fi fi-rr-user-slash text-muted" style="font-size: 32px;"></i>
                    <p class="mt-2 mb-0 text-muted">No employees found</p>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@if($employees->hasPages())
<div class="row">
  <div class="col-lg-12">
    <nav aria-label="pagination" class="float-end">
      <ul class="pagination">
        @if($employees->onFirstPage())
          <li class="page-item disabled">
            <span class="page-link">
              <i class="fi fi-rr-angle-left me-1"></i> Previous
            </span>
          </li>
        @else
          <li class="page-item">
            <a class="page-link" href="{{ $employees->previousPageUrl() }}" aria-label="Previous">
              <i class="fi fi-rr-angle-left me-1"></i> Previous
            </a>
          </li>
        @endif

        @foreach($employees->getUrlRange(1, $employees->lastPage()) as $page => $url)
          <li class="page-item {{ $page == $employees->currentPage() ? 'active' : '' }}">
            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
          </li>
        @endforeach

        @if($employees->hasMorePages())
          <li class="page-item">
            <a class="page-link" href="{{ $employees->nextPageUrl() }}" aria-label="Next">
              Next <i class="fi fi-rr-angle-right ms-1"></i>
            </a>
          </li>
        @else
          <li class="page-item disabled">
            <span class="page-link">
              Next <i class="fi fi-rr-angle-right ms-1"></i>
            </span>
          </li>
        @endif
      </ul>
    </nav>
  </div>
</div>
@endif

<!-- Add Employee Modal -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header py-3">
        <h5 class="modal-title">Add Employee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter full name" required>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="example@email.com" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="phone" class="form-label">Phone Number</label>
              <input type="tel" class="form-control" id="phone" name="phone" placeholder="+880 1234567890">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="department" class="form-label">Department</label>
              <select class="form-select" id="department" name="department" required>
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
              <label for="position" class="form-label">Designation</label>
              <input type="text" class="form-control" id="position" name="position" placeholder="e.g. Software Engineer" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="hire_date" class="form-label">Joining Date</label>
              <input type="date" class="form-control flatpickr-date" id="hire_date" name="hire_date">
            </div>
            <div class="col-md-6 mb-3">
              <label for="status" class="form-label">Employment Status</label>
              <select class="form-select" id="status" name="status" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="on_leave">On Leave</option>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" name="address" rows="2" placeholder="Enter address"></textarea>
          </div>
          <div class="mb-3">
            <label for="photo" class="form-label">Profile Photo</label>
            <input class="form-control" type="file" id="photo" name="photo" accept="image/*">
          </div>
          <div class="text-end">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Add Employee</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript for Grid/List View Toggle -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const gridViewBtn = document.getElementById('gridViewBtn');
    const listViewBtn = document.getElementById('listViewBtn');
    const gridView = document.getElementById('gridView');
    const listView = document.getElementById('listView');

    // Load saved preference from localStorage
    const savedView = localStorage.getItem('employeeViewPreference');
    if (savedView === 'list') {
        showListView();
    }

    // Grid View Button Click
    gridViewBtn.addEventListener('click', function() {
        showGridView();
        localStorage.setItem('employeeViewPreference', 'grid');
    });

    // List View Button Click
    listViewBtn.addEventListener('click', function() {
        showListView();
        localStorage.setItem('employeeViewPreference', 'list');
    });

    // Show Grid View
    function showGridView() {
        gridView.classList.remove('d-none');
        listView.classList.add('d-none');
        gridViewBtn.classList.remove('text-body');
        gridViewBtn.classList.add('text-primary');
        listViewBtn.classList.remove('text-primary');
        listViewBtn.classList.add('text-body');
    }

    // Show List View
    function showListView() {
        gridView.classList.add('d-none');
        listView.classList.remove('d-none');
        listViewBtn.classList.remove('text-body');
        listViewBtn.classList.add('text-primary');
        gridViewBtn.classList.remove('text-primary');
        gridViewBtn.classList.add('text-body');
    }
});
</script>
@endsection
