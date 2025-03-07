<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">{{ Auth::user()->getRoleNames()->first() }}</div>
                <a class="nav-link {{ Str::contains(Route::currentRouteName(), 'admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                @can('permission.manage')
                    <a class="nav-link {{ Str::contains(Route::currentRouteName(), 'admin.permission') ? 'active' : '' }}"
                        href="{{ route('admin.permission') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-unlock"></i></div>
                        Permissions
                    </a>
                @endcan

                @can('role.manage')
                    <a class="nav-link {{ Str::contains(Route::currentRouteName(), 'admin.role') ? 'active' : '' }}"
                        href="{{ route('admin.role') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-network-wired"></i></div>
                        Roles
                    </a>
                @endcan

                @can('manage-user.create')
                    <a class="nav-link {{ Str::contains(Route::currentRouteName(), 'admin.manage-user.create') ? 'active' : '' }}"
                        href="{{ route('admin.manage-user.create') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-user-plus"></i></div>
                        Create user
                    </a>
                @endcan

                @can('manage-user.manage')
                    <a class="nav-link {{ Str::contains(Route::currentRouteName(), 'admin.manage-user') ? 'active' : '' }}"
                        href="{{ route('admin.manage-user') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-users-cog"></i></div>
                        Manage Users
                    </a>
                @endcan

                @can('business.manage')
                    <a class="nav-link {{ Str::contains(Route::currentRouteName(), 'admin.manage-business') ? 'active' : '' }}"
                        href="{{ route('admin.manage-business') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-building"></i></div>
                        Manage Business
                    </a>
                @endcan


                @can('outlet.manage')
                    <a class="nav-link {{ Str::contains(Route::currentRouteName(), 'admin.outlet') ? 'active' : '' }}"
                        href="{{ route('admin.outlet') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-warehouse"></i></div>
                        Manage Outlets
                    </a>
                @endcan

                @role('outlet-manager')
                    <a class="nav-link {{ Str::contains(Route::currentRouteName(), 'admin.gas-requests') ? 'active' : '' }}"
                        href="{{ route('admin.gas-requests') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tasks"></i></div>
                        My Gas Requests
                    </a>

                    <a class="nav-link {{ Str::contains(Route::currentRouteName(), 'admin.tokens') ? 'active' : '' }}"
                        href="{{ route('admin.tokens') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-th-list"></i></div>
                        Tokens
                    </a>

                    <a class="nav-link {{ Str::contains(Route::currentRouteName(), 'admin.outlet-stock-request') ? 'active' : '' }}"
                        href="{{ route('admin.outlet-stock-request') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Outlet Stock Request
                    </a>
                @endrole

                @can('tokens')
                    <a class="nav-link {{ Str::contains(Route::currentRouteName(), 'admin.tokens') ? 'active' : '' }}"
                        href="{{ route('admin.tokens') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-th-list"></i></i></div>
                        Tokens
                    </a>
                @endcan

                @can('stock-request.manage')
                    <a class="nav-link {{ Str::contains(Route::currentRouteName(), 'admin.stock-request.adminIndex') ? 'active' : '' }}"
                        href="{{ route('admin.stock-request.adminIndex') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-th-table"></i></i></div>
                        Stock Requests
                    </a>
                @endcan

                @can('caontact-us.manage')
                    <a class="nav-link {{ Str::contains(Route::currentRouteName(), 'admin.contact-us') ? 'active' : '' }}"
                        href="{{ route('admin.contact-us') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></i></div>
                        Contact Us
                    </a>
                @endcan
       



            </div>
        </div>

    </nav>
</div>
