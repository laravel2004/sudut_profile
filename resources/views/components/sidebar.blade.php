<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Logo Section -->
                <div class="img-fluid d-flex align-items-center">
                    <img src="{{ asset('storage/logo/' . $global_setting['app_profile']) }}" alt="Logo" class="img-fluid" style="width: 75px; height: auto;">
                    <h5 class="logo-text ms-3">{{ $global_setting['app_name'] }}</h5>
                </div>
                <!-- Theme Toggle -->
                <div class="theme-toggle d-flex gap-2 align-items-center mt-2">
                    <!-- SVG icons and theme switcher -->
                </div>
                <!-- Sidebar Toggler -->
                <div class="sidebar-toggler x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>
                <li class="sidebar-item {{ activeState('admin.dashboard') }}">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item {{ activeState('admin.setting') }}">
                    <a href="{{ route('admin.setting') }}" class="sidebar-link">
                        <i class="bi bi-gear-fill"></i>
                        <span>Setting</span>
                    </a>
                </li>
                <li class="sidebar-item {{ activeState('admin.prestation.index') }}">
                    <a href="{{ route('admin.prestation.index') }}" class="sidebar-link">
                        <i class="bi bi-award-fill"></i>
                        <span>Prestasi</span>
                    </a>
                </li>
                <li class="sidebar-item {{ activeState('admin.work-experience.index') }}">
                    <a href="{{ route('admin.work-experience.index') }}" class="sidebar-link">
                        <i class="bi bi-briefcase-fill"></i>
                        <span>Pengalaman Kerja</span>
                    </a>
                </li>
                <li class="sidebar-item {{ activeState('admin.education.index') }}">
                    <a href="{{ route('admin.education.index') }}" class="sidebar-link">
                        <i class="bi bi-book-fill"></i>
                        <span>Edukasi</span>
                    </a>
                </li>
                <li class="sidebar-item {{ activeState('admin.profile.index') }}">
                    <a href="{{ route('admin.profile.index') }}" class="sidebar-link">
                        <i class="bi bi-person-fill"></i>
                        <span>Profil</span>
                    </a>
                </li>
                <li class="sidebar-item {{ activeState('admin.artikel.index') }}">
                    <a href="{{ route('admin.artikel.index') }}" class="sidebar-link">
                        <i class="bi bi-file-earmark-text-fill"></i>
                        <span>Artikel</span>
                    </a>
                </li>
                <li class="sidebar-item {{ activeState('admin.project.index') }}">
                    <a href="{{ route('admin.project.index') }}" class="sidebar-link">
                        <i class="bi bi-kanban-fill"></i>
                        <span>Project</span>
                    </a>
                </li>
                <li class="sidebar-item {{ activeState('admin.logout') }}">
                    <a href="{{ route('admin.logout') }}" class="sidebar-link">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
