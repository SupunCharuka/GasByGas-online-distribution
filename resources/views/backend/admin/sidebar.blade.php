<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                @can('manage-user.create')
                    <a class="nav-link" href="{{ route('admin.manage-user.create') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-user-plus"></i></div>
                        Create user
                    </a>
                @endcan
                @can('manage-user.manage')
                    <a class="nav-link" href="{{ route('admin.manage-user') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-users-cog"></i></div>
                        Manage Users
                    </a>
                @endcan

            </div>
        </div>

    </nav>
</div>
