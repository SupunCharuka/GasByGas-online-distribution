<script type="text/javascript">
    let APP_URL = {!! json_encode(url('/')) !!}

    let _TOKEN = "{!! csrf_token() !!}"
</script>
<link href="{{ asset('assets/backend/css/datatables.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/backend/css/styles.css') }}" rel="stylesheet" />
<script src="{{ asset('assets/backend/js/fontawesome.js') }}" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
@yield('styles')
