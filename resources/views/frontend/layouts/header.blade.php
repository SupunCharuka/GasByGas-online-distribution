<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{ route('/') }}" class="logo d-flex align-items-center me-auto">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1 class="sitename">GasByGas</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('/') }}" class="{{ Str::contains(Route::currentRouteName(), '/') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('aboutUs') }}" class="{{ Str::contains(Route::currentRouteName(), 'aboutUs') ? 'active' : '' }}">About</a></li>
                <li><a  href="{{ route('branches') }}" class="{{ Str::contains(Route::currentRouteName(), 'branches') ? 'active' : '' }}">Branches</a></li>
                <li><a href="{{ route('contactUs') }}" class="{{ Str::contains(Route::currentRouteName(), 'contactUs') ? 'active' : '' }}">Contact</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        @auth
            <a class="btn-getstarted" href="{{ route(authUserFolder() . '.dashboard') }}">Dashboard</a>
        @endauth
        @guest
            <a class="btn-getstarted" href="{{ route('login') }}">Login</a>
            <a class="btn-getstarted" href="{{ route('register') }}">Register</a>
        @endguest
    </div>
</header>
