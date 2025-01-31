<script src="{{ asset('assets/backend/js/jquery-3.6/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/frontend/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/scripts.js') }}"></script>
<script src="{{ asset('assets/backend/js/simple-datatables.min.js') }}" crossorigin="anonymous"></script>


@yield('scripts')
@stack('scripts')
