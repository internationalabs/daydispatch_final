<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-layout-style="default"
      data-layout-position="fixed" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm-hover"
      data-layout-width="fluid">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <!-- Place favicon.ico in the root directory -->
    <!--<link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/favicon.png') }}">-->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/logo/logo.png') }}">

    <script>
        function zoom() {
            document.body.style.zoom = "85%"
        }
    </script>
    <!--JQuery Script-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- swiper slider css -->
    <link href="{{ asset('admin-backend/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet"/>
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
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css"/>
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css"/>

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    @livewireStyles

    <title>Day Dispatch - Transportation | Agent Portal</title>

</head>
{{--onload="zoom()"--}}
<body onload="zoom()">

<!-- Begin page -->
<div id="layout-wrapper">

    <header id="page-topbar">
        <div class="layout-width">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box horizontal-logo">
                        <a href="{{ route('Agent.Dashboard') }}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset('frontend/img/logo/logo.png') }}" alt="" height="25">
                        </span>
                            <span class="logo-lg">
                            <img src="{{ asset('frontend/img/logo/logo.png') }}" alt="" height="25">
                        </span>
                        </a>

                        <a href="{{ route('Agent.Dashboard') }}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('frontend/img/logo/logo.png') }}" alt="" height="25"> <span
                                style="font-size: 18px; color: white;">Day Dispatch</span>
                        </span>
                            <span class="logo-lg">
                            <img src="{{ asset('frontend/img/logo/logo.png') }}" alt="" height="25"> <span
                                    style="font-size: 18px; color: white;">Day Dispatch</span>
                        </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                            id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                    </button>

                    <!-- App Search-->
                    <form class="app-search d-none d-md-block">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search..." autocomplete="off"
                                   id="search-options" value="">
                            <span class="mdi mdi-magnify search-widget-icon"></span>
                            <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                                  id="search-close-options"></span>
                        </div>
                        <div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
                            <div data-simplebar style="max-height: 320px;">
                                <!-- item-->
                                <div class="dropdown-header">
                                    <h6 class="text-overflow text-muted mb-0 text-uppercase">Recent Searches</h6>
                                </div>
                            </div>

                            <div class="text-center pt-3 pb-1">
                                <a href="pages-search-results.html" class="btn btn-primary btn-sm">View All Results <i
                                        class="ri-arrow-right-line ms-1"></i></a>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="d-flex align-items-center">

                    <div class="dropdown d-md-none topbar-head-dropdown header-item">
                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                            <i class="bx bx-search fs-22"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                             aria-labelledby="page-header-search-dropdown">
                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..."
                                               aria-label="Recipient's username">
                                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="ms-1 header-item d-none d-sm-flex">
                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                data-toggle="fullscreen">
                            <i class='bx bx-fullscreen fs-22'></i>
                        </button>
                    </div>

                    <div class="ms-1 header-item d-none d-sm-flex">
                        <button type="button"
                                class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                            <i class='bx bx-moon fs-22'></i>
                        </button>
                    </div>

                    <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                id="page-header-notifications-dropdown" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                            <i class='bx bx-bell fs-22'></i>
                            <span
                                class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">3<span
                                    class="visually-hidden">unread messages</span></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                             aria-labelledby="page-header-notifications-dropdown">

                            <div class="dropdown-head bg-primary bg-pattern rounded-top">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
                                        </div>
                                        <div class="col-auto dropdown-tabs">
                                            <span class="badge badge-soft-light fs-13"> 4 New</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="px-2 pt-2">
                                    <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true"
                                        id="notificationItemsTab" role="tablist">
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab"
                                               role="tab" aria-selected="true">
                                                All (4)
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </div>

                            <div class="tab-content position-relative" id="notificationItemsTabContent">
                                <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                                    <div class="Notification"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown ms-sm-3 header-item topbar-user">
                        <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user"
                                 src="{{ Auth::guard('Agent')->user()->profile_photo_path ? url(Auth::guard('Agent')->user()->profile_photo_path) : asset('backend/img/user1.jpg') }}"
                                 alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span
                                    class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ Auth::guard('Agent')->user()->name }}</span>
                                <span
                                    class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">{{ Auth::guard('Agent')->user()->email }}</span>
                            </span>
                        </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <h6 class="dropdown-header">Welcome {{ Auth::guard('Agent')->user()->name }}!</h6>
                            <a class="dropdown-item" href="JavaScript:void(0);"><i
                                    class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i> <span
                                    class="align-middle">Ref-Code : <b>{{ Auth::guard('Agent')->user()->ref_code }}</b></span></a>
{{--                            @if (Auth::guard('Agent')->user()->permissions(1))--}}
{{--                                <a class="dropdown-item" href="{{ route('Agent.carriers') }}"><i--}}
{{--                                    class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i> <span--}}
{{--                                    class="align-middle">Carriers</span></a>--}}
{{--                            @endif--}}
                            @if (Auth::guard('Agent')->user()->permissions(1))
                                <a class="dropdown-item" href="{{ route('Agent.logisticCarriers') }}"><i
                                    class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i> <span
                                    class="align-middle">Logistic Carriers</span></a>
                            @endif
                            @if (Auth::guard('Agent')->user()->permissions(2))
                                <a class="dropdown-item" href="{{ route('Agent.logisticShippers') }}"><i
                                    class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i> <span
                                    class="align-middle">Logistic Shippers</span></a>
                            @endif
                            @if (Auth::guard('Agent')->user()->permissions(3))
                                <a class="dropdown-item" href="{{ route('Agent.logisticBrokers') }}"><i
                                    class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i> <span
                                    class="align-middle">Logistic Brokers</span></a>
                            @endif
                            <a class="dropdown-item" href="{{ route('Agent.LogOut') }}"><i
                                    class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                                    class="align-middle" data-key="t-logout">Logout</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- removeNotificationModal -->
    <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="NotificationModalbtn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                   colors="primary:#f7b84b,secondary:#f06548"
                                   style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!
                        </button>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- ========== App Menu ========== -->
    <div class="app-menu navbar-menu">
        <!-- LOGO -->
        <div class="navbar-brand-box">
            <!-- Dark Logo-->
            <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="22">
                    </span>
                <span class="logo-lg">
                        <img src="assets/images/logo-dark.png" alt="" height="17">
                    </span>
            </a>
            <!-- Light Logo-->
            <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="22">
                    </span>
                <span class="logo-lg">
                        <img src="assets/images/logo-light.png" alt="" height="17">
                    </span>
            </a>
            <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover">
                <i class="ri-record-circle-line"></i>
            </button>
        </div>

        <div id="scrollbar">
            <div class="container-fluid">

                <div id="two-column-menu">
                </div>
                <ul class="navbar-nav" id="navbar-nav">
                    <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('Agent.Dashboard') }}">
                            <i class="bx bx-aperture"></i> <span data-key="t-widgets">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('Agent.Users') }}">
                            <i class="bx bx-aperture"></i> <span data-key="t-widgets">Manage Users</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('Agent.Revenue') }}">
                            <i class="bx bx-aperture"></i> <span data-key="t-widgets">Manage Revenues</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Sidebar -->
        </div>

        <div class="sidebar-background"></div>
    </div>
    <!-- Left Sidebar End -->
    <!-- Vertical Overlay-->
    <div class="vertical-overlay"></div>

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


<!--start back-to-top-->
<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>
<!--end back-to-top-->

<!-- JAVASCRIPT -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="{{ asset('admin-backend/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin-backend/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('admin-backend/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('admin-backend/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('admin-backend/js/plugins.js') }}"></script>
<!-- password-addon init -->
<script src="{{ asset('admin-backend/js/pages/password-addon.init.js') }}"></script>
<!-- validation init -->
<script src="{{ asset('admin-backend/js/pages/form-validation.init.js') }}"></script>
<!-- password create init -->
<script src="{{ asset('admin-backend/js/pages/passowrd-create.init.js') }}"></script>
<!-- Swiper Js -->
<script src="{{ asset('admin-backend/libs/swiper/swiper-bundle.min.js') }}"></script>
<!-- profile init js -->
<script src="{{ asset('admin-backend/js/pages/profile.init.js') }}"></script>
<!-- CRM js -->
<script src="{{ asset('admin-backend/js/pages/dashboard-crypto.init.js') }}"></script>

<!-- App js -->
<script src="{{ asset('admin-backend/js/app.js') }}"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

<script src="{{ asset('admin-backend/js/pages/datatables.init.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@livewireScripts

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
        $(".empty-notification-elem").hide();
        sendRequest();

        function sendRequest() {
            $.ajax({
                url: '{{ route('Get.Admin.Notification') }}',
                type: 'GET',
                success(data) {
                    $('.Notification').html(data); //insert text of test.php into your div

                },
                // complete() {
                //     // Schedule the next request when the current one's complete
                //     setInterval(sendRequest, 5000); // The interval set to 5 seconds
                // }
            });
        }

        $(document).on('focus', ':input', function () {
            $(this).attr('autocomplete', 'off');
        });

        function onlyNumberKey(evt) {
            // Only ASCII character in that range allowed
            var ASCIICode = evt.which ? evt.which : evt.keyCode;
            return !(ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57));
        }

        $("form").delegate(".phone-number", "focus", function () {
            var selectionStart = $('input')[0].selectionStart;
            var selectionEnd = $('input')[0].selectionEnd;
            $(".phone-number")[0].setSelectionRange(selectionStart, selectionEnd);
            $(".phone-number").mask("(999) 999-9999");
        });
    });
</script>

</body>

</html>
