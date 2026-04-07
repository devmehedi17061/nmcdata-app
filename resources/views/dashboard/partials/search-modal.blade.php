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
              <a class="search-item" href="{{ route('dashboard') }}">
                <i class="fi fi-rr-apps"></i> Dashboard
              </a>
            </li>
            <li>
              <a class="search-item" href="{{ route('employees.index') }}">
                <i class="fi fi-rr-users"></i> Employees
              </a>
            </li>
            @auth
              @if(Auth::user()->isAdmin())
                <li>
                  <a class="search-item" href="{{ route('roles.index') }}">
                    <i class="fi fi-rr-shield"></i> Roles
                  </a>
                </li>
                <li>
                  <a class="search-item" href="{{ route('permissions.index') }}">
                    <i class="fi fi-rr-lock"></i> Permissions
                  </a>
                </li>
              @endif
            @endauth
          </ul>
        </div>
        <div id="searchContainer"></div>
      </div>
    </div>
  </div>
</div>
