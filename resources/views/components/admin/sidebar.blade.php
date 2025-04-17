<div class="d-flex flex-column flex-shrink-0 bg-white sidebar-admin " style="width: 280px; height: 100vh;">
    <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
      <a href="{{ route('dashboard') }}" class="text-decoration-none">
        <span class="fs-4 fw-semibold text-primary">Admin<span class="text-secondary">Panel</span></span>
      </a>
      <button class="btn btn-sm btn-outline-primary d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
        <i class="bi bi-list"></i>
      </button>
    </div>
    
    <div class="d-flex align-items-center p-3 border-bottom">
      <div class="rounded-circle overflow-hidden me-2" style="width: 40px; height: 40px;">
        <img src="{{ asset('images/default-profile.png') }}" class="img-fluid" alt="Admin">
      </div>
      <div>
        <h6 class="mb-0 fs-6 fw-semibold">{{ Auth::user()->name ?? 'Admin User' }}</h6>
        <small class="text-muted">{{ Auth::user()->role ?? 'Administrator' }}</small>
      </div>
    </div>
    
    <div class="collapse show" id="sidebarMenu">
      <ul class="nav nav-pills flex-column mb-auto p-2">
        <li class="nav-item mb-1">
          <small class="text-uppercase fw-bold text-muted px-3 py-2 d-block">Main</small>
        </li>
        <li class="nav-item mb-1">
          <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : 'text-dark' }} d-flex align-items-center">
            <i class="bi bi-grid-1x2-fill me-2"></i>
            Dashboard
          </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.index') ? 'active' : 'text-dark' }}  d-flex align-items-center">
              <i class="bi bi-people-fill me-2"></i>
              Users Management
            </a>
          </li>
        <li class="nav-item mb-1">
          <a href="{{ route('admin.books.index') }}" class="nav-link {{ request()->routeIs('admin.books.index') ? 'active' : 'text-dark' }} d-flex align-items-center">
            <i class="bi bi-book-fill me-2"></i>
            Books Management
          </a>
        </li>
        <li class="nav-item mb-1">
          <a class="nav-link text-dark d-flex align-items-center justify-content-between" 
             data-bs-toggle="collapse" 
             href="#reportsSubmenu" 
             role="button" 
             aria-expanded="false">
            <div>
              <i class="bi bi-file-earmark-text-fill me-2"></i>
              Reports
            </div>
            <i class="bi bi-chevron-down small"></i>
          </a>
          <div class="collapse" id="reportsSubmenu">
            <ul class="nav flex-column ms-3 mt-1">
              <li class="nav-item">
                <a class="nav-link text-dark py-2" href="#">Daily Reports</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark py-2" href="#">Monthly Stats</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark py-2" href="#">Analytics</a>
              </li>
            </ul>
          </div>
        </li>
        
        <li class="nav-item mt-3 mb-1">
          <small class="text-uppercase fw-bold text-muted px-3 py-2 d-block">System</small>
        </li>
        <li class="nav-item mb-1">
          <a href="#" class="nav-link text-dark d-flex align-items-center">
            <i class="bi bi-gear-fill me-2"></i>
            Settings
          </a>
        </li>
        <li class="nav-item mb-1">
          <a href="" 
             onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
             class="nav-link text-danger d-flex align-items-center">
            <i class="bi bi-box-arrow-right me-2"></i>
            Logout
          </a>
          <form id="logout-form" action="" method="POST" class="d-none">
            @csrf
          </form>
        </li>
      </ul>
    </div>
  </div>
  
  <style>
    /* Additional custom styling */
    .sidebar-admin {
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
      position: sticky;
      top: 0;
    }
    
    .sidebar-admin .nav-link {
      border-radius: 6px;
      padding: 10px 16px;
      font-size: 14px;
      transition: all 0.2s ease;
    }
    
    .sidebar-admin .nav-link:hover {
      background-color: rgba(var(--bs-primary-rgb), 0.1);
    }
    
    .sidebar-admin .nav-link.active {
      background-color: var(--bs-primary);
    }
    
    .sidebar-admin .nav-link i {
      font-size: 18px;
    }
    
    /* Submenu styling */
    .sidebar-admin .collapse .nav-link {
      padding-left: 16px;
      padding-right: 16px;
      font-size: 13px;
    }
    
    /* Adjust for smaller screens */
    @media (max-width: 767.98px) {
      .sidebar-admin {
        width: 100% !important;
        height: auto !important;
      }
    }
  </style>