<!-- resources/views/components/navbar.blade.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-gradient shadow">
    <div class="container">
      <!-- Brand with icon -->
      <a class="navbar-brand fw-bold fs-4 d-flex align-items-center" href="{{ route('beranda') }}">
        <i class="bi bi-book-half me-2"></i>
        <span>E-Library</span>
      </a>
  
      <!-- Mobile toggle button -->
      <button class="navbar-toggler border-0 py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
      </button>
  
      <!-- Navbar content -->
      <div class="collapse navbar-collapse" id="navbarContent">
        <!-- Center navigation -->
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item mx-1">
            <a class="nav-link px-3 py-2 rounded-3 position-relative {{ request()->routeIs('beranda') ? 'active' : '' }}" href="{{ route('home') }}">
              Beranda
              <span class="position-absolute bottom-0 start-50 translate-middle-x bg-white" style="height: 2px; width: 0; transition: width 0.3s ease;"></span>
            </a>
          </li>
          <li class="nav-item mx-1">
            <a class="nav-link px-3 py-2 rounded-3 position-relative {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}" href="{{ route('peminjaman.index') }}">
              Peminjaman Saya
              <span class="position-absolute bottom-0 start-50 translate-middle-x bg-white" style="height: 2px; width: 0; transition: width 0.3s ease;"></span>
            </a>
          </li>
          <li class="nav-item mx-1">
            <a class="nav-link px-3 py-2 rounded-3 position-relative {{ request()->routeIs('books.*') ? 'active' : '' }}" href="{{ route('books.index') }}">
              Koleksi Buku
              <span class="position-absolute bottom-0 start-50 translate-middle-x bg-white" style="height: 2px; width: 0; transition: width 0.3s ease;"></span>
            </a>
          </li>
        </ul>
  
        <!-- Right side - user profile -->
        <div class="d-flex align-items-center">
          @if(Auth::check() || session('is_logged_in'))
            <div class="dropdown">
              <a class="btn btn-outline-light bg-white bg-opacity-10 rounded-pill px-3 py-1 dropdown-toggle d-flex align-items-center" href="#" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="position-relative me-2">
                  <img src="{{ session('profile_picture', asset('images/default-profile.png')) }}" 
                       class="rounded-circle object-fit-cover border border-2 border-white border-opacity-25" 
                       width="32" height="32">
                  <span class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-2 border-white" style="width: 10px; height: 10px;"></span>
                </div>
                <span class="d-none d-sm-inline">{{ session('name', optional(Auth::user())->name ?? 'User') }}</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end shadow mt-2 border-0" aria-labelledby="profileDropdown">
                <li><a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ route('profile.show') }}"><i class="bi bi-person"></i> Profile</a></li>
                <li><a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ route('settings') }}"><i class="bi bi-gear"></i> Settings</a></li>
                <li><hr class="dropdown-divider my-1"></li>
                <li>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item d-flex align-items-center gap-2 py-2 w-100">
                      <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                  </form>
                </li>
              </ul>
            </div>
          @else
            <div class="d-flex gap-2">
              <a href="{{ route('login') }}" class="btn btn-outline-light rounded-pill px-3">Login</a>
              <a href="{{ route('register') }}" class="btn btn-light rounded-pill px-3 text-primary">Register</a>
            </div>
          @endif
        </div>
      </div>
    </div>
  </nav>
  
  <!-- Add this script for hover effects -->
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    // Nav link hover animation
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
      link.addEventListener('mouseenter', function() {
        this.querySelector('span').style.width = '50%';
      });
      link.addEventListener('mouseleave', function() {
        if(!this.classList.contains('active')) {
          this.querySelector('span').style.width = '0';
        }
      });
    });
  
    // Active links show underline
    document.querySelectorAll('.nav-link.active').forEach(link => {
      link.querySelector('span').style.width = '50%';
    });
  });
  </script>