<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard | @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('backend.layouts.styles')
    <!-- Styles -->
    @livewireStyles
</head>

<body class="sb-nav-fixed">
    @include('backend.layouts.header')

    <div id="layoutSidenav">
        @include('backend.' . authUserFolder() . '.sidebar')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">@yield('breadcrumb-title')</h1>
                    <ol class="breadcrumb mb-4">
                        @yield('breadcrumb-items')</li>
                    </ol>
                    @yield('content')
                </div>
            </main>
            @include('backend.layouts.footer')
        </div>
    </div>

    @include('backend.layouts.scripts')
    @livewireScripts
</body>

</html>
