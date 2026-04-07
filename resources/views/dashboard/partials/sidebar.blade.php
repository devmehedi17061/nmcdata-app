<aside class="app-menubar" id="appMenubar">
  <div class="app-navbar-brand">
    <a class="navbar-brand-logo" href="{{ route('dashboard') }}">
      <img src="{{ asset('assets/images/logo.svg') }}" alt="GXON Admin Dashboard Logo" />
    </a>
    <a class="navbar-brand-mini visible-light" href="{{ route('dashboard') }}">
      <img src="{{ asset('assets/images/logo-text.svg') }}" alt="GXON Admin Dashboard Logo" />
    </a>
    <a class="navbar-brand-mini visible-dark" href="{{ route('dashboard') }}">
      <img src="{{ asset('assets/images/logo-text-white.svg') }}" alt="GXON Admin Dashboard Logo" />
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
            <a class="menu-link" href="{{ route('dashboard') }}">
              <span class="menu-label">Dashboard</span>
            </a>
          </li>
          @auth
            @if(Auth::user()->isAdmin() || Auth::user()->isHR())
              <li class="menu-item">
                <a class="menu-link" href="{{ route('employees.index') }}">
                  <span class="menu-label">Employee</span>
                </a>
              </li>
            @endif
          @endauth
        </ul>
      </li>

      @auth
        @if(Auth::user()->isAdmin() || Auth::user()->isHR() || Auth::user()->isSuperAdmin())
          <li class="menu-item">
            <a class="menu-link" href="{{ route('employees.index') }}">
              <i class="fi fi-rr-users"></i>
              <span class="menu-label">Employees</span>
            </a>
          </li>
        @endif

        <!-- Files Section for All Users -->
        <li class="menu-item">
          <a class="menu-link" href="{{ route('files.index') }}">
            <i class="fi fi-rr-folder-open"></i>
            <span class="menu-label">My Files</span>
            @php
              $myFileCount = \App\Models\File::where('user_id', Auth::id())->count();
            @endphp
            @if($myFileCount > 0)
              <span class="badge bg-info ms-auto">{{ $myFileCount }}</span>
            @endif
          </a>
        </li>

        @if(Auth::user()->isSuperAdmin() || Auth::user()->isAdmin())
        <li class="menu-item">
          <a class="menu-link" href="{{ route('files.all') }}">
            <i class="fi fi-rr-database"></i>
            <span class="menu-label">All Files</span>
            @php
              $allFileCount = \App\Models\File::count();
            @endphp
            @if($allFileCount > 0)
              <span class="badge bg-primary ms-auto">{{ $allFileCount }}</span>
            @endif
          </a>
        </li>
        @endif

        <!-- Leave Requests for Admin/HR -->
        @if(Auth::user()->isSuperAdmin() || Auth::user()->isAdmin() || Auth::user()->isHR())
        <li class="menu-item">
          <a class="menu-link" href="{{ route('leave.index') }}">
            <i class="fi fi-rr-calendar"></i>
            <span class="menu-label">Leave Requests</span>
            @php
              $pendingLeaves = \App\Models\LeaveRequest::where('status', 'pending')->count();
            @endphp
            @if($pendingLeaves > 0)
              <span class="badge bg-warning ms-auto">{{ $pendingLeaves }}</span>
            @endif
          </a>
        </li>
        @endif

        <!-- My Leave Requests for All Users -->
        <li class="menu-item">
          <a class="menu-link" href="{{ route('leave.my') }}">
            <i class="fi fi-rr-calendar-days"></i>
            <span class="menu-label">My Leaves</span>
          </a>
        </li>

        <!-- Email Management -->
        <li class="menu-item menu-arrow">
          <a class="menu-link" href="javascript:void(0);" role="button">
            <i class="fi fi-rr-envelope"></i>
            <span class="menu-label">Email Management</span>
          </a>
          <ul class="menu-inner">
            <li class="menu-item">
              <a class="menu-link" href="{{ route('email.index') }}">
                <span class="menu-label">All Emails</span>
              </a>
            </li>
            <li class="menu-item">
              <a class="menu-link" href="{{ route('email.compose') }}">
                <span class="menu-label">Compose Email</span>
              </a>
            </li>
          </ul>
        </li>

        @if(Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
          <li class="menu-item menu-arrow">
            <a class="menu-link" href="javascript:void(0);" role="button">
              <i class="fi fi-rr-user-key"></i>
              <span class="menu-label">Roles & Permissions</span>
            </a>
            <ul class="menu-inner">
              <li class="menu-item">
                <a class="menu-link" href="{{ route('roles.index') }}">
                  <span class="menu-label">Roles</span>
                </a>
              </li>
              <li class="menu-item">
                <a class="menu-link" href="{{ route('permissions.index') }}">
                  <span class="menu-label">Permissions</span>
                </a>
              </li>
            </ul>
          </li>
        @endif

        @if(Auth::user()->isSuperAdmin() || Auth::user()->isAdmin())
          <li class="menu-item">
            <a class="menu-link" href="{{ route('approval.index') }}">
              <i class="fi fi-rr-user-check"></i>
              <span class="menu-label">User Approval</span>
              @php
                // Count ALL pending users including employees
                $pendingCount = \App\Models\User::where('is_approved', false)->count();
              @endphp
              @if($pendingCount > 0)
                <span class="badge bg-warning ms-auto">{{ $pendingCount }}</span>
              @endif
            </a>
          </li>
        @endif
      @endauth

      <li class="menu-item menu-arrow">
        <a class="menu-link" href="javascript:void(0);" role="button">
          <i class="fi fi-rr-file"></i>
          <span class="menu-label">Pages</span>
        </a>
        <ul class="menu-inner">
          <li class="menu-item">
            <a class="menu-link" href="#">
              <span class="menu-label">Pricing</span>
            </a>
          </li>
          <li class="menu-item">
            <a class="menu-link" href="#">
              <span class="menu-label">FAQ's</span>
            </a>
          </li>
          <li class="menu-item">
            <a class="menu-link" href="#">
              <span class="menu-label">Profile</span>
            </a>
          </li>
          <li class="menu-item">
            <a class="menu-link" href="#">
              <span class="menu-label">Settings</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
  <div class="app-footer">
    <a href="#" class="btn btn-outline-light waves-effect btn-shadow btn-app-nav w-100">
      <i class="fi fi-rs-interrogation text-primary"></i>
      <span class="nav-text">Help and Support</span>
    </a>
  </div>
</aside>
