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
                <a href="{{ url('/user') }}" class="nav-link {{ $activeMenu == 'user' ? 'active' : '' }}">
                    <i class="nav-icon far fa-user"></i>
                    <p>Data User</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/level') }}" class="nav-link {{ $activeMenu == 'level' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-layer-group"></i>
                    <p>Level User</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/datamahasiswa') }}" class="nav-link {{ $activeMenu == 'datamahasiswa' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user-graduate"></i>
                    <p>Data Mahasiswa</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/kompetensi') }}" class="nav-link {{ $activeMenu == 'kompetensi' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>Bidang Kompetensi</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/jenistugas') }}" class="nav-link {{ $activeMenu == 'jenistugas' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-book"></i>
                    <p>Jenis Tugas</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/kompen') }}" class="nav-link {{ $activeMenu == 'kompen' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-list"></i>
                    <p>List Kompen</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/pengajuankompen') }}" class="nav-link {{ $activeMenu == 'pengajuankompen' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-file-upload"></i>
                    <p>Pengajuan</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/progresskompen') }}" class="nav-link {{ $activeMenu == 'progresskompen' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-spinner"></i>
                    <p>Progres</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/history-kompen') }}" class="nav-link {{ $activeMenu == 'history_kompen' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-chart-bar"></i>
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
        background: linear-gradient(90deg, #3B465D, #2C3E50);
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
