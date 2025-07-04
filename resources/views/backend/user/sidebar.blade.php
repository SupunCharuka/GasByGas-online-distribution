<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">{{ Auth::user()->getRoleNames()->first() }}</div>
                <a class="nav-link {{ Str::contains(Route::currentRouteName(), 'user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
               
                <a class="nav-link {{ Str::contains(Route::currentRouteName(), 'user.gas-requests') ? 'active' : '' }}" href="{{ route('user.gas-requests') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-upload"></i></div>
                    My Gas Requests
                </a>
          
            </div>
        </div>
       
    </nav>
</div>