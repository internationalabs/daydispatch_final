<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Order Agreement | Day Dispatch</title>
    <meta name="author" content="Muhammad Yasir Amin">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/favicon.png') }}">
    <meta name="theme-color" content="#ffffff">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('invoice/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('invoice/css/style.css') }}">
    <script src="{{ asset('invoice/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('invoice/js/app.min.js') }}"></script>
    <script src="{{ asset('invoice/js/main.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>

    {{--  Gallery  --}}
    {{--    <!-- Vendors Min CSS -->--}}
    {{--    <link rel="stylesheet" href="{{ asset('backend/css/vendors.min.css') }}">--}}
    {{--    <!-- Vendors Min JS -->--}}
    {{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>--}}
    {{--    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>--}}
    {{--    <script src="{{ asset('backend/js/vendors.min.js') }}"></script>--}}
    {{--    <!-- Custom JS -->--}}
    {{--    <script src="{{ asset('backend/js/custom.js') }}"></script>--}}
</head>

<body>
    {{-- <div class="invoice-container-wrap"> --}}
        <div class="container py-4">
            {{ $slot }}
        </div>
    {{-- </div> --}}
    @if (Session::has('Success!'))
        <script>
            toastr.success("{!! Session::get('Success!') !!}");
        </script>
    @endif
    @if (Session::has('Error!'))
        <script>
            toastr.error("{!! Session::get('Error!') !!}");
        </script>
    @endif
</body>

</html>
