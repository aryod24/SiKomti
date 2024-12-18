<div class="sidebar">
    <!-- SidebarSearch Form -->
    <div class="form-inline mt-2">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link {{ $activeMenu == 'dashboard' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/profile') }}" class="nav-link {{ $activeMenu == 'profile' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Profile</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/mhskompen') }}" class="nav-link {{ $activeMenu == 'mhskompen' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tasks"></i>
                    <p>Kompen</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/progressmhs') }}" class="nav-link {{ $activeMenu == 'progressmhs' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-file-alt"></i>
                    <p>Progress</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/historymhs') }}" class="nav-link {{ $activeMenu == 'history_mahasiswa' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-chart-line"></i>
                    <p>Hasil</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/logout') }}" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </nav>
</div>

<style>
    /* Custom CSS for Sidebar */
    .sidebar {
        background: linear-gradient(90deg, #5c759c, #2C3E50);
        font-family: 'Montserrat', sans-serif;
        font-weight: bold;
    }

    .sidebar .nav-link {
        color: #ffffff;
    }

    .sidebar .nav-link.active {
        background-color: #1F2937;
        color: #ffffff;
    }

    .sidebar .nav-icon {
        color: #ffffff;
    }
</style>
