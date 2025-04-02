<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="horizontal" data-topbar="dark"
      data-sidebar-size="lg">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/favicon.png') }}">

    <script>
        function zoom() {
            document.body.style.zoom = "85%"
        }
    </script>
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
    @livewireStyles

    <title>Day Dispatch - Transportation | Admin Portal</title>

    <!-- JAVASCRIPT -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('admin-backend/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin-backend/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin-backend/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('admin-backend/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('admin-backend/js/plugins.js') }}"></script>
    <!-- validation init -->
    <script src="{{ asset('admin-backend/js/pages/form-validation.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('admin-backend/js/app.js') }}"></script>
    @livewireScripts

</head>
{{--onload="zoom()"--}}
<body onload="zoom()">

<!-- Begin page -->
<div id="layout-wrapper">

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                {{ $slot }}
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script>
                        © Day Dispatch.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop by Day Dispatch Team
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

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

<script>
    $(document).ready(function () {
    });
</script>

</body>

</html>
