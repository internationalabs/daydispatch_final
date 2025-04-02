<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="horizontal" data-topbar="dark"
      data-sidebar-size="lg" data-sidebar="light" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8"/>
    <title>Day Dispatch | 419 Page Expired</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <!-- App favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/favicon.png') }}">

    <!-- Layout config Js -->
    <script src="{{ asset('admin-backend/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('admin-backend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="{{ asset('admin-backend/css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="{{ asset('admin-backend/css/app.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- custom Css-->
    <link href="{{ asset('admin-backend/css/custom.min.css') }}" rel="stylesheet" type="text/css"/>


</head>

<body>

<!-- auth-page wrapper -->
<div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100">

    <!-- auth-page content -->
    <div class="auth-page-content overflow-hidden p-0">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-4 text-center">
                    <div class="error-500 position-relative">
                        <img src="{{ asset('errors/maintenance.png') }}" alt=""
                             class="img-fluid error-500-img error-img"/>
                        <h1 class="title text-muted">419</h1>
                    </div>
                    <div>
                        <h4>Page Expired Error!</h4>
                        <p class="text-muted w-75 mx-auto">419 page expired Laravel error occurs when the valid CSRF
                            token missing in the post request or when the page takes too long to send the post request
                            which leads to expiring the CSRF token.</p>
                        <a href="{{ redirect()->back() }}" class="btn btn-success"><i class="mdi mdi-home me-1"></i>Back
                            to home</a>
                    </div>
                </div><!-- end col-->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth-page content -->
</div>
<!-- end auth-page-wrapper -->

</body>

</html>
