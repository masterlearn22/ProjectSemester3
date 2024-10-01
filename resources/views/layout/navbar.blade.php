<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  {{-- <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
    <a class="navbar-brand brand-logo" href="../index.html"><img src="../assets/images/logo.svg" alt="logo" /></a>
    <a class="navbar-brand brand-logo-mini" href="../index.html"><img src="../assets/images/logo-mini.svg" alt="logo" /></a>
  </div> --}}
  <div class="navbar-menu-wrapper d-flex align-items-stretch">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu"></span>
    </button>
    <div class="search-field d-none d-md-block">
      <form class="d-flex align-items-center h-100" action="#">
        <div class="input-group">
          <div class="input-group-prepend bg-transparent">
            <i class="input-group-text border-0 mdi mdi-magnify"></i>
          </div>
          <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
        </div>
      </form>
    </div>
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item d-none d-lg-block full-screen-link">
        <a class="nav-link">
          <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
        </a>
      </li>
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" id="profileDropdown" href="/admin/users" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="nav-profile-img">
            @if (Auth::user()->ID_JENIS_USER == 4)
            <img src="../assets/images/faces/photo4.jpg" alt="profile" />
            @elseif (Auth::user()->ID_JENIS_USER == 3)
            <img src="../assets/images/faces/photo3.jpg" alt="profile" />
            @elseif (Auth::user()->ID_JENIS_USER == 2)
            <img src="../assets/images/faces/photo2.jpg" alt="profile" />
            @elseif (Auth::user()->ID_JENIS_USER == 1)
            <img src="../assets/images/faces/photo1.jpg" alt="profile" />
            @endif
            <span class="availability-status online"></span>
          </div>
          <div class="nav-profile-text">
            <p class="mb-1 text-black">{{ session('name') }}</p>
          </div>
        </a>
        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="#">
            <i class="mdi mdi-cached me-2 text-success"></i> Activity Log </a>
          <div class="dropdown-divider"></div>
          <form id="logout-form" action="logout" method="POST" style="display: none;">
            @csrf
        </form>
        
          <a class="dropdown-item" href="login">
            <i class="mdi mdi-cached me-2 text-success" @csrf></i>Login</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> 
              <i class="mdi mdi-cached me-2 text-success"></i>
              Logout
          </a>
      </li>
      
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>