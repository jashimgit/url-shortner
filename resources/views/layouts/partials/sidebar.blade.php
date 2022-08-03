<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
    <div class="sidebar-brand-icon">
      <img src="{{ asset('backend/img/logo/logo2.png')}}">
    </div>
    <div class="sidebar-brand-text mx-3">Dashboard</div>
  </a>
  <hr class="sidebar-divider my-0">
  <li class="nav-item active">
    <a class="nav-link" href="{{ route('admin.dashboard')}}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <hr class="sidebar-divider">

  
  <li class="nav-item">
    <a class="nav-link" href="{{ url('/admin/link/create')}}">
      <i class="fab fa-fw fa-wpforms"></i>
      <span>Links</span>
    </a>
  </li>


</ul>