<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>
        <div id="sidebar-menu">
            <div class="logo-box">
                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('admin-assets/images/logo-sm.png') }}" alt="" height="35">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('admin-assets/images/logo-light.png') }}" alt="" height="35">
                    </span>
                </a>
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('admin-assets/images/logo-sm.png') }}" alt="" height="35">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('admin-assets/images/logo-dark.png') }}" alt="" height="35">
                    </span>
                </a>
            </div>
<ul id="sidebar-menu">

    <li class="{{ request()->routeIs('admin.dashboard') ? 'menuitem-active' : '' }}">
        <a href="{{ route('admin.dashboard') }}" class="tp-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="nav-icon">
                <iconify-icon icon="tabler:layout-dashboard"></iconify-icon>
            </span>
            <span class="sidebar-text">Dashboard</span>
        </a>
    </li>

    <li class="menu-title mt-2">Manajemen Data</li>
    <li class="{{ request()->routeIs('admin.varieties.*') ? 'menuitem-active' : '' }}">
        <a href="{{ route('admin.varieties.index') }}" class="tp-link {{ request()->routeIs('admin.varieties.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <iconify-icon icon="tabler:coffee"></iconify-icon>
            </span>
            <span class="sidebar-text">Varietas Kopi</span>
        </a>
    </li>
    <li class="{{ request()->routeIs('admin.regions.*') ? 'menuitem-active' : '' }}">
        <a href="{{ route('admin.regions.index') }}" class="tp-link {{ request()->routeIs('admin.regions.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <iconify-icon icon="tabler:map-2"></iconify-icon>
            </span>
            <span class="sidebar-text">Daerah Kopi</span>
        </a>
    </li>
    <li class="{{ request()->routeIs('admin.farmers.*') ? 'menuitem-active' : '' }}">
        <a href="{{ route('admin.farmers.index') }}" class="tp-link {{ request()->routeIs('admin.farmers.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <iconify-icon icon="tabler:users"></iconify-icon>
            </span>
            <span class="sidebar-text">Petani</span>
        </a>
    </li>
    <li class="{{ request()->routeIs('admin.plantations.*') ? 'menuitem-active' : '' }}">
        <a href="{{ route('admin.plantations.index') }}" class="tp-link {{ request()->routeIs('admin.plantations.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <iconify-icon icon="tabler:plant-2"></iconify-icon>
            </span>
            <span class="sidebar-text">Kebun</span>
        </a>
    </li>

    <li class="menu-title mt-2">Data Parameter (API)</li>
    <li class="{{ request()->routeIs('admin.parameters.climate') ? 'menuitem-active' : '' }}">
        <a href="{{ route('admin.parameters.climate') }}" class="tp-link {{ request()->routeIs('admin.parameters.climate') ? 'active' : '' }}">
            <span class="nav-icon">
                <iconify-icon icon="tabler:cloud-rain"></iconify-icon>
            </span>
            <span class="sidebar-text">Iklim</span>
        </a>
    </li>
    <li class="{{ request()->routeIs('admin.parameters.topography') ? 'menuitem-active' : '' }}">
        <a href="{{ route('admin.parameters.topography') }}" class="tp-link {{ request()->routeIs('admin.parameters.topography') ? 'active' : '' }}">
            <span class="nav-icon">
                <iconify-icon icon="tabler:mountain"></iconify-icon>
            </span>
            <span class="sidebar-text">Topografi</span>
        </a>
    </li>
    <li class="{{ request()->routeIs('admin.parameters.soil') ? 'menuitem-active' : '' }}">
        <a href="{{ route('admin.parameters.soil') }}" class="tp-link {{ request()->routeIs('admin.parameters.soil') ? 'active' : '' }}">
            <span class="nav-icon">
                <iconify-icon icon="tabler:world-latitude"></iconify-icon>
            </span>
            <span class="sidebar-text">Tanah</span>
        </a>
    </li>

    <li class="menu-title mt-2">Analisis</li>
    <li class="{{ request()->routeIs('admin.analysis.prediction') ? 'menuitem-active' : '' }}">
        <a href="{{ route('admin.analysis.prediction') }}" class="tp-link {{ request()->routeIs('admin.analysis.prediction') ? 'active' : '' }}">
            <span class="nav-icon">
                <iconify-icon icon="tabler:flask"></iconify-icon>
            </span>
            <span class="sidebar-text">Prediksi Kualitas</span>
        </a>
    </li>
    <li class="{{ request()->routeIs('admin.analysis.history') ? 'menuitem-active' : '' }}">
        <a href="{{ route('admin.analysis.history') }}" class="tp-link {{ request()->routeIs('admin.analysis.history') ? 'active' : '' }}">
            <span class="nav-icon">
                <iconify-icon icon="tabler:history"></iconify-icon>
            </span>
            <span class="sidebar-text">Riwayat Prediksi</span>
        </a>
    </li>
</ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>