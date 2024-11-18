<nav class="main-header navbar navbar-expand navbar-light" style="background: linear-gradient(90deg, #7c93b8, #3B465D); padding: 1rem;">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="color: rgb(248, 242, 242);">
            <i class="fas fa-bars"></i>
        </a>
      </li>  
      <li class="nav-item d-none d-sm-inline-block">
          <div class="nav-title-box" style="color: rgb(245, 236, 236); font-size: 1.25rem; font-weight: bold;">SiKomti</div>
      </li>
  </ul>

  <!-- Right navbar links (Profile & Logout dropdown) -->
  <ul class="navbar-nav ml-auto">
    <!-- Dropdown Menu for Profile and Logout -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
        @if(auth()->user()->avatar)
            <img src="{{ asset('images/' . auth()->user()->avatar) }}" alt="User Avatar" class="rounded-circle" width="30" height="30">
        @else
            <i class="fas fa-user"></i>
        @endif
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <a href="{{ url('/profile') }}" class="dropdown-item {{ $activeMenu == 'profile' ? 'active' : '' }}">
          <i class="fas fa-user nav-icon"></i> Profile
        </a>
        <a href="{{ url('/logout') }}" class="dropdown-item">
          <i class="fas fa-sign-out-alt nav-icon"></i> Logout
        </a>
      </div>
    </li>
  </ul>
</nav>
