<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                @can('permission.manage')
                    <a class="nav-link {{ Str::contains(Route::currentRouteName(), 'admin.permission') ? 'active' : '' }}" href="{{ route('admin.permission') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-unlock"></i></div>
                        Permissions
                    </a>
                @endcan

                @can('role.manage')
                    <a class="nav-link {{ Str::contains(Route::currentRouteName(), 'admin.role') ? 'active' : '' }}" href="{{ route('admin.role') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-network-wired"></i></div>
                        Roles
                    </a>
                @endcan

                @can('manage-user.create')
                    <a class="nav-link {{ Str::contains(Route::currentRouteName(), 'admin.manage-user.create') ? 'active' : '' }}" href="{{ route('admin.manage-user.create') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-user-plus"></i></div>
                        Create user
                    </a>
                @endcan

                @can('manage-user.manage')
                    <a class="nav-link {{ Str::contains(Route::currentRouteName(), 'admin.manage-user') ? 'active' : '' }}" href="{{ route('admin.manage-user') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-users-cog"></i></div>
                        Manage Users
                    </a>
                @endcan

            </div>
        </div>

    </nav>
</div>
