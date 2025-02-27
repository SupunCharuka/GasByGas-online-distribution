<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title') - GasByGas</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons -->
    <link href="{{ asset('assets/frontend/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/frontend//img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('frontend.layouts.styles')
    @livewireStyles
</head>

<body class="index-page">
    @include('frontend.layouts.header')

    <main class="main">
        @yield('content')
    </main>

    @include('frontend.layouts.footer')

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    @include('frontend.layouts.scripts')
    @livewireScripts

</body>

</html>
