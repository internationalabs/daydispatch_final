<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="horizontal" data-topbar="dark"
    data-sidebar-size="lg">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/favicon.png') }}" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script>
        function zoom() {
            document.body.style.zoom = "85%";
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="{{ url('admin-backend/libs/sweetalert2/sweetalert2.min.css') }}" />


    <link rel="stylesheet" href="{{ asset('admin-backend/libs/swiper/swiper-bundle.min.css') }}" />
    <!-- Layout config Js -->
    <script src="{{ asset('admin-backend/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('admin-backend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('admin-backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('admin-backend/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('admin-backend/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" />

    @livewireStyles

    <title>Day Dispatch - Transportation | Admin Portal</title>

    <style>
        .disabled-link {
            pointer-events: none;
            opacity: 0.5;
        }
        table.dataTable {
            width: 100% !important;
        }

        .tab-pane.active {
            display: block;
        }

        .tab-pane {
            display: none;
        }

        .btn-success.active {
            display: block;
        }

        .mf-content.w-100 {
            background: #8080802e;
            padding: 20px;
        }

        div#tab2 {
            overflow-y: scroll;
        }

        .modal-dialog.modal-dialog-centered {
            max-width: 50%;
        }

        .modal-backdrop.fade.show {
            width: 100%;
            height: 100%;
        }
    </style>

    <style>
        #areYouSureDelete .card svg {
            font-size: 39px;
            margin-top: -16px;
            color: red;
        }

        #areYouSureDelete .card {
            /*width: 100px;*/
            width: fit-content;
            margin: auto;
            margin-top: 23px;
            margin-top: 14px;
        }

        #areYouSureDelete {
            text-align: center;
            display: none;
            padding-left: 20px;
            background: #00000069;
        }

        .modal-body.user-settings-box input {
            width: 100%;
            padding: 8px;
            border: 0;
            border-bottom: 2px solid #6691e7;
            outline: 0;
            margin-top: 20px;
            text-align: center;
            padding-top: 0px;
        }

        .modal-body.user-settings-box button {
            padding: 3px;
            border: 0;
            background: #e3ebfb;
            width: 100%;
            margin-top: 11px;
            margin-left: 0px;
            color: #727e8c;
            font-weight: 700;
        }

        #areYouSureDelete p {
            color: #727e8c;
            text-align: center;
            font-size: 20px;
            font-weight: 700;
        }

        .modal-content {
            max-width: 447px;
            margin: auto;
        }

        .closebutton {
            border: 0;
            background: transparent;
            color: gray;
            font-size: 22px;
        }
    </style>
</head>
{{-- onload="zoom()" --}}

<body onload="zoom()">
    @php
        $checkAccess = Auth::guard('Admin')->user();
        $checkAccess = App\Models\Auth\AuthorizedAdmin::with('role')->where('id', $checkAccess->id)->first();
        // Check if the user has a role and if the role relationship is loaded
        if ($checkAccess->role) {
            // Access the permission attribute from the role relationship
            $permissions = explode(',', $checkAccess->role->permission);
        }
        $user_permissions = explode(',', $checkAccess->permission);
    @endphp

    <!-- Begin page -->
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box horizontal-logo">
                            <a href="{{ route('Admin.Dashboard') }}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ asset('frontend/img/logo/logo.png') }}" alt=""
                                        height="25" />
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('frontend/img/logo/logo.png') }}" alt=""
                                        height="25" />
                                </span>
                            </a>

                            <a href="{{ route('Admin.Dashboard') }}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ asset('frontend/img/logo/logo.png') }}" alt=""
                                        height="25" />
                                    <span style="font-size: 18px; color: white">Day Dispatch</span>
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('frontend/img/logo/logo.png') }}" alt=""
                                        height="25" />
                                    <span style="font-size: 18px; color: white">Day Dispatch</span>
                                </span>
                            </a>
                        </div>

                        <button type="button"
                            class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
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
                                    id="search-options" value="" />
                                <span class="mdi mdi-magnify search-widget-icon"></span>
                                <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                                    id="search-close-options"></span>
                            </div>
                            <div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
                                <div data-simplebar style="max-height: 320px">
                                    <!-- item-->
                                    <div class="dropdown-header">
                                        <h6 class="text-overflow text-muted mb-0 text-uppercase">
                                            Recent Searches
                                        </h6>
                                    </div>
                                    <!-- item-->
                                    <div class="dropdown-header mt-2">
                                        <h6 class="text-overflow text-muted mb-1 text-uppercase">
                                            Pages
                                        </h6>
                                    </div>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="ri-bubble-chart-line align-middle fs-18 text-muted me-2"></i>
                                        <span>Analytics Dashboard</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="ri-lifebuoy-line align-middle fs-18 text-muted me-2"></i>
                                        <span>Help Center</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="ri-user-settings-line align-middle fs-18 text-muted me-2"></i>
                                        <span>My account settings</span>
                                    </a>

                                    <!-- item-->
                                    <div class="dropdown-header mt-2">
                                        <h6 class="text-overflow text-muted mb-2 text-uppercase">
                                            Members
                                        </h6>
                                    </div>

                                    <div class="notification-list">
                                        <!-- item -->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                            <div class="d-flex">
                                                <img src="assets/images/users/avatar-2.jpg"
                                                    class="me-3 rounded-circle avatar-xs" alt="user-pic" />
                                                <div class="flex-1">
                                                    <h6 class="m-0">Angela Bernier</h6>
                                                    <span class="fs-11 mb-0 text-muted">Manager</span>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- item -->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                            <div class="d-flex">
                                                <img src="assets/images/users/avatar-3.jpg"
                                                    class="me-3 rounded-circle avatar-xs" alt="user-pic" />
                                                <div class="flex-1">
                                                    <h6 class="m-0">David Grasso</h6>
                                                    <span class="fs-11 mb-0 text-muted">Web Designer</span>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- item -->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                            <div class="d-flex">
                                                <img src="assets/images/users/avatar-5.jpg"
                                                    class="me-3 rounded-circle avatar-xs" alt="user-pic" />
                                                <div class="flex-1">
                                                    <h6 class="m-0">Mike Bunch</h6>
                                                    <span class="fs-11 mb-0 text-muted">React Developer</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="text-center pt-3 pb-1">
                                    <a href="pages-search-results.html" class="btn btn-primary btn-sm">View All
                                        Results
                                        <i class="ri-arrow-right-line ms-1"></i></a>
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
                                                aria-label="Recipient's username" />
                                            <button class="btn btn-primary" type="submit">
                                                <i class="mdi mdi-magnify"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                data-toggle="fullscreen">
                                <i class="bx bx-fullscreen fs-22"></i>
                            </button>
                        </div>

                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button"
                                class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                                <i class="bx bx-moon fs-22"></i>
                            </button>
                        </div>

                        <div class="ms-1 header-item d-none d-sm-flex">
                            <a href="{{ route('admin-chats') }}"
                                class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                                <i class="bx bx-chat fs-22"></i>
                            </a>
                        </div>

                        <div class="dropdown topbar-head-dropdown ms-1 header-item">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                id="page-header-notifications-dropdown" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-bell fs-22"></i>
                                <span
                                    class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">5<span
                                        class="visually-hidden">unread messages</span></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="dropdown-head bg-primary bg-pattern rounded-top">
                                    <div class="p-3">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="m-0 fs-16 fw-semibold text-white">
                                                    Notifications
                                                </h6>
                                            </div>
                                            <div class="col-auto dropdown-tabs">
                                                <span class="badge badge-soft-light fs-13">
                                                    5 New</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="px-2 pt-2">
                                        <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom"
                                            data-dropdown-tabs="true" id="notificationItemsTab" role="tablist">
                                            <li class="nav-item waves-effect waves-light">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab"
                                                    role="tab" aria-selected="true">
                                                    All (5)
                                                </a>
                                            </li>
                                            <li class="nav-item waves-effect waves-light">
                                                <a class="nav-link" data-bs-toggle="tab" href="#all-messages"
                                                    role="tab" aria-selected="true">
                                                    Messages
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="tab-content" id="notificationItemsTabContent">
                                    <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab"
                                        role="tabpanel">
                                        <div class="Notification"></div>
                                    </div>
                                    <div class="tab-pane fade show py-2 ps-2" id="all-messages" role="tabpanel">
                                        <div class="Messages"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="ms-1 header-item d-none d-sm-flex">
                            <a href="{{ route('user-chats') }}"
                                class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                                <i class="bx bx-support fs-22"></i>
                            </a>
                        </div>

                        <div class="dropdown ms-sm-3 header-item topbar-user">
                            <button type="button" class="btn" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle header-profile-user"
                                        src="{{ Auth::guard('Admin')->user()->profile_photo_path ? url(Auth::guard('Admin')->user()->profile_photo_path) : asset('backend/img/user1.jpg') }}"
                                        alt="Header Avatar" />
                                    <span class="text-start ms-xl-2">
                                        <span
                                            class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ Auth::guard('Admin')->user()->name }}</span>
                                        <span
                                            class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">{{ Auth::guard('Admin')->user()->email }}</span>
                                    </span>
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <h6 class="dropdown-header">
                                    Welcome {{ Auth::guard('Admin')->user()->name }}!
                                </h6>
                                @if (in_array('34', $permissions) || in_array('34', $user_permissions))
                                    <a class="dropdown-item" href="{{ route('All.Settings') }}"><i
                                            class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i>
                                        <span class="align-middle" data-key="t-logout">System Settings</span></a>
                                @endif
                                @if (in_array('35', $permissions) || in_array('35', $user_permissions))
                                    <a class="dropdown-item"><i
                                            class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i>
                                        <span class="align-middle" data-key="t-logout" data-toggle="modal"
                                            onclick="CarrierRequestLoadshowmodel()"
                                            class="CarrierRequestLoadshowmodel">All
                                            Companies</span></a>
                                @endif
                                <a class="dropdown-item">
                                    <i class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i>
                                    <span class="align-middle" data-key="t-logout" data-toggle="modal"
                                        onclick="changePassModal()">Change Password</span>
                                </a>

                                <a class="dropdown-item" href="{{ route('Admin.LogOut') }}"><i
                                        class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                    <span class="align-middle" data-key="t-logout">Logout</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="{{ route('Admin.Dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('frontend/img/logo/logo.png') }}" alt="" height="22" />
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('frontend/img/logo/logo.png') }}" alt="" height="17" />
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="{{ route('Admin.Dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('frontend/img/logo/logo.png') }}" alt="" height="22" />
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('frontend/img/logo/logo.png') }}" alt="" height="17" />
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">
                    <div id="two-column-menu"></div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('Admin.Dashboard') }}">
                                <i class="bx bxs-dashboard"></i>
                                <span data-key="t-dashboards">Dashboard</span>
                            </a>
                        </li>
                        @if (in_array('1', $permissions) || in_array('1', $user_permissions))
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                    <i class="bx bxs-package"></i>
                                    <span data-key="t-dashboards">Listing</span>
                                </a>
                                <div class="collapse menu-dropdown mega-dropdown-menu" id="sidebarDashboards"
                                    style="width: 27rem">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <ul class="nav nav-sm flex-column">
                                                @if (in_array('8', $permissions) || in_array('8', $user_permissions))
                                                    <li class="nav-item">
                                                        <a href="{{ route('Admin.Listing') }}" class="nav-link"
                                                            data-key="t-analytics">
                                                            All Listing
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (in_array('10', $permissions) || in_array('10', $user_permissions))
                                                    <li class="nav-item">
                                                        <a href="{{ route('Admin.WaitingListing') }}"
                                                            class="nav-link" data-key="t-crm">
                                                            Waiting For Approvals
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (in_array('12', $permissions) || in_array('12', $user_permissions))
                                                    <li class="nav-item">
                                                        <a href="{{ route('Admin.Requested') }}" class="nav-link"
                                                            data-key="t-ecommerce">
                                                            Requested
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (in_array('14', $permissions) || in_array('14', $user_permissions))
                                                    <li class="nav-item">
                                                        <a href="{{ route('Admin.Dispatches') }}" class="nav-link"
                                                            data-key="t-crypto">
                                                            Dispatches
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (in_array('16', $permissions) || in_array('16', $user_permissions))
                                                    <li class="nav-item">
                                                        <a href="{{ route('Admin.PickUp.Approval') }}"
                                                            class="nav-link" data-key="t-projects">
                                                            PickUp Approval
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (in_array('18', $permissions) || in_array('18', $user_permissions))
                                                    <li class="nav-item">
                                                        <a href="{{ route('Admin.PickUp') }}" class="nav-link"
                                                            data-key="t-projects">
                                                            PickUp
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="col-lg-6">
                                            <ul class="nav nav-sm flex-column">
                                                @if (in_array('9', $permissions) || in_array('9', $user_permissions))
                                                    <li class="nav-item">
                                                        <a href="{{ route('Admin.Deliver.Approval') }}"
                                                            class="nav-link" data-key="t-projects">
                                                            Deliver Approval
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (in_array('11', $permissions) || in_array('11', $user_permissions))
                                                    <li class="nav-item">
                                                        <a href="{{ route('Admin.Delivered') }}" class="nav-link"
                                                            data-key="t-projects">
                                                            Delivered
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (in_array('13', $permissions) || in_array('13', $user_permissions))
                                                    <li class="nav-item">
                                                        <a href="{{ route('Admin.Completed') }}" class="nav-link"
                                                            data-key="t-projects">
                                                            Completed
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (in_array('15', $permissions) || in_array('15', $user_permissions))
                                                    <li class="nav-item">
                                                        <a href="{{ route('Admin.Cancelled') }}" class="nav-link"
                                                            data-key="t-projects">
                                                            Cancelled
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (in_array('17', $permissions) || in_array('17', $user_permissions))
                                                    <li class="nav-item">
                                                        <a href="{{ route('Admin.Expired') }}" class="nav-link"
                                                            data-key="t-projects">
                                                            Expired
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (in_array('19', $permissions) || in_array('19', $user_permissions))
                                                    <li class="nav-item">
                                                        <a href="{{ route('Admin.Archived') }}" class="nav-link"
                                                            data-key="t-projects">
                                                            Archived
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endif
                        @if (in_array('2', $permissions) || in_array('2', $user_permissions))
                            <li class="nav-item">
                                <a class="nav-link menu-link collapsed" href="#sidebarAuth" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarAuth">
                                    <i class="bx bx-user-circle"></i>
                                    <span data-key="t-authentication">Manage Users</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarAuth">
                                    <ul class="nav nav-sm flex-column">
                                        @if (in_array('41', $permissions) || in_array('41', $user_permissions))
                                            <li class="nav-item">
                                                <a href="{{ route('All.Admins') }}" class="nav-link"
                                                    data-key="t-cover">Admins
                                                    List</a>
                                            </li>
                                        @endif
                                        @if (in_array('20', $permissions) || in_array('20', $user_permissions))
                                            <li class="nav-item">
                                                <a href="{{ route('All.Users') }}" class="nav-link"
                                                    data-key="t-cover">Users
                                                    List</a>
                                            </li>
                                        @endif
                                        @if (in_array('21', $permissions) || in_array('21', $user_permissions))
                                            <li class="nav-item">
                                                <a href="{{ route('All.Agents') }}" class="nav-link"
                                                    data-key="t-cover">Agents
                                                    List</a>
                                            </li>
                                        @endif
                                        @if (in_array('22', $permissions) || in_array('22', $user_permissions))
                                            <li class="nav-item">
                                                <a href="{{ route('All.Permissions') }}" class="nav-link"
                                                    data-key="t-cover">Permissions</a>
                                            </li>
                                        @endif
                                        @if (in_array('23', $permissions) || in_array('23', $user_permissions))
                                            <li class="nav-item">
                                                <a href="{{ route('All.Agents.Permissions') }}" class="nav-link"
                                                    data-key="t-cover">Manage Agent
                                                    Permissions</a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                        @endif
                        @if (in_array('3', $permissions) || in_array('3', $user_permissions))
                            <li class="nav-item">
                                <a class="nav-link menu-link collapsed" href="#sidebarAuth" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarAuth">
                                    <i class="bx bx-user-circle"></i>
                                    <span data-key="t-authentication">Manage Payments</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarAuth">
                                    <ul class="nav nav-sm flex-column">
                                        @if (in_array('24', $permissions) || in_array('24', $user_permissions))
                                            <li class="nav-item">
                                                <a href="{{ route('Users.Invoices') }}" class="nav-link"
                                                    data-key="t-cover">Users Invoices</a>
                                            </li>
                                        @endif
                                        @if (in_array('25', $permissions) || in_array('25', $user_permissions))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('Payment.Settings') }}"
                                                    data-key="t-dashboards">
                                                    Payment Settings
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                        @endif
                        @if (in_array('4', $permissions) || in_array('4', $user_permissions))
                            <li class="nav-item">
                                <a class="nav-link menu-link collapsed" href="#sidebarAuth" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarAuth">
                                    <i class="bx bx-user-circle"></i>
                                    <span data-key="t-authentication">Managed Companies</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarAuth">
                                    <ul class="nav nav-sm flex-column">
                                        @if (in_array('26', $permissions) || in_array('26', $user_permissions))
                                            <li class="nav-item">
                                                <a href="{{ route('All.Dispatch') }}" class="nav-link"
                                                    data-key="t-cover">
                                                    Dispatcher List
                                                </a>
                                            </li>
                                        @endif
                                        @if (in_array('27', $permissions) || in_array('27', $user_permissions))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('All.Managed.Companies') }}"
                                                    data-key="t-dashboards">
                                                    Managed Users
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                        @endif
                        @if (in_array('5', $permissions) || in_array('5', $user_permissions))
                            <li class="nav-item">
                                <a class="nav-link menu-link collapsed" href="#sidebarAuth" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarAuth">
                                    <i class="bx bx-user-circle"></i>
                                    <span data-key="t-authentication">History</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarAuth">
                                    <ul class="nav nav-sm flex-column">
                                        @if (in_array('28', $permissions) || in_array('28', $user_permissions))
                                            <li class="nav-item">
                                                <a href="{{ route('Admin.carriers.History') }}" class="nav-link"
                                                    data-key="t-cover">Carrier
                                                    History</a>
                                            </li>
                                        @endif
                                        @if (in_array('29', $permissions) || in_array('29', $user_permissions))
                                            <li class="nav-item">
                                                <a href="{{ route('Admin.logisticCarriers.History') }}"
                                                    class="nav-link" data-key="t-cover">Logistic
                                                    Carriers History</a>
                                            </li>
                                        @endif
                                        @if (in_array('30', $permissions) || in_array('30', $user_permissions))
                                            <li class="nav-item">
                                                <a href="{{ route('Admin.logisticBrokers.History') }}"
                                                    class="nav-link" data-key="t-cover">Logistic
                                                    Brokers
                                                    History</a>
                                            </li>
                                        @endif
                                        @if (in_array('31', $permissions) || in_array('31', $user_permissions))
                                            <li class="nav-item">
                                                <a href="{{ route('Admin.logisticShippers.History') }}"
                                                    class="nav-link" data-key="t-cover">Logistic
                                                    Shippers
                                                    History</a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('Filter.Comment.History') }}">
                                <i class="bx bxs-help-circle"></i>
                                <span data-key="t-dashboards">QA History Comments</span>
                            </a>
                        </li>
                        @if (in_array('6', $permissions) || in_array('6', $user_permissions))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('Filter.Agents.Calls') }}">
                                    <i class="bx bxs-help-circle"></i>
                                    <span data-key="t-dashboards">Filter Agent Call</span>
                                </a>
                            </li>
                        @endif
                        @if (in_array('32', $permissions) || in_array('32', $user_permissions))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('Admin.All.Tickets') }}">
                                    <i class="bx bxs-help-circle"></i>
                                    <span data-key="t-dashboards">3-Way Supports</span>
                                </a>
                            </li>
                        @endif
                        @if (in_array('33', $permissions) || in_array('33', $user_permissions))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('Website.Leads') }}">
                                    <i class="bx bx-globe-alt"></i>
                                    <span data-key="t-dashboards">Website Leads</span>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('authorization.forms.index') }}">
                                <i class="bx bx-globe-alt"></i>
                                <span data-key="t-dashboards">Authorization Forms</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('chat.group.index') }}">
                                <i class="bx bx-globe-alt"></i>
                                <span data-key="t-dashboards">Chat Groups</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('loadboard.roles') }}">
                                <i class="bx bx-globe-alt"></i>
                                <span data-key="t-dashboards">Loadboard Sub Roles</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('userSheet') }}">
                                <i class="bx bx-globe-alt"></i>
                                <span data-key="t-dashboards">User Sheets</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('All.Customer.Feedbacks') }}">
                                <i class="bx bx-globe-alt"></i>
                                <span data-key="t-dashboards">Customer Feedbacks</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">{{ isset($slot)?  $slot : null }}</div>
                <main class="container-fluid">
                    @yield('content')
                </main>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
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

    <!--preloader-->
    <!-- <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div> -->

    <div class="modal fade show" id="areYouSureDelete" data-backdrop="true" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Enter to Password to Enter to Carrier</h5>
                    <button type="button" class="closebutton close" data-dismiss="modal" autocomplete="off"
                        onclick="CarrierRequestLoadshowmodel()" class="CarrierRequestLoadshowmodel">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body user-settings-box"
                    style="
              min-height: 100px;
              display: flex;
              flex-direction: column;
              justify-content: center;
            ">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-primary text-primary rounded-2 fs-2">
                                        <span class="material-symbols-outlined text-primary">
                                            lock
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form id="passCheck">
                        @csrf
                        <div class="row buttons" style="justify-content: center">
                            <!--<div class="col-md-1"></div>-->
                            <div class="col-md-12">
                                <div>
                                    <input type="password" placeholder="Please Enter Carrier Password"
                                        name="Password_Check" onkeydown="PasswordCheck()" id="Password_Check" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form id="changePasswordForm">
                        <!-- Current Password -->
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="currentPassword" name="currentPassword"
                                placeholder="Enter current password" required>
                        </div>
                        <!-- New Password -->
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword"
                                placeholder="Enter new password" required>
                        </div>
                        <!-- Confirm New Password -->
                        <div class="mb-3">
                            <label for="confirmNewPassword" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirmNewPassword"
                                name="confirmNewPassword" placeholder="Re-enter new password" required>
                        </div>
                    </form>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitChangePassword()">Change
                        Password</button>
                </div>
            </div>
        </div>
    </div>



    @if (Session::has('Success!'))
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showMethod": "slideDown",
                "hideMethod": "slideUp",
                "toastClass": "toast-custom",
            };
            toastr.success('<span class="text-white font-weight-bold">{!! Session::get('Success!') !!}</span>', "✅ Success");
        </script>
    @endif
    @if (Session::has('Error!'))
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "7000",
                "extendedTimeOut": "1000",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
                "toastClass": "toast-custom",
            };
            toastr.error('<span class="text-white font-weight-bold">{!! Session::get('Error!') !!}</span>', "❌ Error");
        </script>
    @endif

    <!-- JAVASCRIPT -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
    <!-- swiper js -->
    <script src="{{ asset('admin-backend/libs/swiper/swiper-bundle.min.js') }}"></script>
    <!-- profile init js -->
    <script src="{{ asset('admin-backend/js/pages/profile.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('admin-backend/js/app.js') }}"></script>
    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

    <script src="{{ asset('admin-backend/js/pages/datatables.init.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    @livewireScripts @if (Session::has('Success!'))
        <script>
            toastr.success("{!! Session::get('Success!') !!}");
        </script>
        @endif @if (Session::has('Error!'))
            <script>
                toastr.error("{!! Session::get('Error!') !!}");
            </script>
        @endif

        <script>
            $(document).ready(function() {
                $(".empty-notification-elem").hide();
                sendRequest();

                function sendRequest() {
                    $.ajax({
                        url: '{{ route('Get.Admin.Notification') }}',
                        type: 'GET',
                        success: function(response) {
                            if (response.success) {
                                $('.Notification').html(response.html);
                                $('.Messages').html(response.htmlMsg);
                            }
                        },
                        error: function(data) {
                            console.log(data.responseJSON);
                            alert(data.responseJSON);
                        },
                        complete: function() {
                            // Schedule the next request when the current one's complete
                            setTimeout(sendRequest, 5000); // The interval set to 5 seconds
                        }
                    });
                }

                $(document).on('focus', ':input', function() {
                    $(this).attr('autocomplete', 'off');
                });

                function onlyNumberKey(evt) {
                    // Only ASCII character in that range allowed
                    const ASCIICode = evt.which ? evt.which : evt.keyCode;
                    return !(ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57));
                }

                $('form .numeric').on('change', function() {
                    var number = $(this).val();
                    return onlyNumberKey(number);
                });

                $("form").delegate(".phone-number", "focus", function() {
                    var selectionStart = $('input')[0].selectionStart;
                    var selectionEnd = $('input')[0].selectionEnd;
                    $(".phone-number")[0].setSelectionRange(selectionStart, selectionEnd);
                    $(".phone-number").mask("(999) 999-9999");
                });
            });
        </script>
        <script>
            $("#passCheck").on("submit", function(event) {
                event.preventDefault();

                var url = "{{ route('Admin.Pass.Check') }}";

                var formdata = $("#passCheck").serialize();

                $.ajax({
                    url: url,
                    method: "POST",
                    data: new FormData(this),
                    dataType: "JSON",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        console.log(data.Success);
                        if (data.Success == "Password Matched") {
                            // console.log('yes');
                            // window.location.href = "https://daydispatch.com/Admin/Admin-Carriers";
                            window.location.href =
                                "https://daydispatch.com/Admin/All-Companies";
                        } else {
                            // Swal.fire(
                            //     'The Internet?',
                            //     'That thing is still around?',
                            //     'question'
                            //     )

                            const x = document.getElementById("Password_Check");
                            x.style.borderBottom = "2px solid red";
                            x.style.color = "red";
                        }
                        // $(form).trigger("reset");
                        // alert(response.success)
                    },
                    error: function(response) {},
                });
            });

            function CarrierRequestLoadshowmodel() {
                // console.log('show ')
                $("#areYouSureDelete").toggle();
                var element = document.getElementById("CarrierRequestLoad");
                //   console.log(typeof element)
                if (element.style.display === "block") {
                    element.style.display = "none";
                } else {
                    element.style.display = "block";
                }
            }

            function PasswordCheck() {
                console.log("press");
                const x = document.getElementById("Password_Check");
                x.style.borderBottom = "2px solid #6691e7";
                x.style.color = "gray";
            }
        </script>
        <script>
            // Function to show the modal
            function changePassModal() {
                // Show the modal using Bootstrap's modal API
                $('#changePasswordModal').modal('show');
            }

            // Function to handle password change submission
            function submitChangePassword() {
                const currentPassword = $('#currentPassword').val();
                const newPassword = $('#newPassword').val();
                const user_id = '{{ Auth::guard('Admin')->user()->id }}';
                const confirmNewPassword = $('#confirmNewPassword').val();

                // Validate new password and confirmation match
                if (newPassword !== confirmNewPassword) {
                    alert("New password and confirmation do not match.");
                    return;
                }

                // Proceed with password change logic (AJAX or form submission)
                $.ajax({
                    url: '{{ route('change.password') }}', // Backend endpoint
                    method: 'POST',
                    data: {
                        user_id: user_id, // Assuming you're passing the logged-in user's ID
                        currentPassword: currentPassword,
                        newPassword: newPassword,
                        _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                    },
                    success: function(response) {
                        alert(response.message); // Notify success
                        $('#changePasswordModal').modal('hide'); // Close modal
                        $('#changePasswordModal form')[0].reset();
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON.message); // Notify error
                    }
                });
            }

            // Function to handle password change submission
            function submitUserChangePassword() {
                const newUserPassword = $('#newUserPassword').val();
                const confirmNewUserPassword = $('#confirmNewUserPassword').val();

                // Validate new password and confirmation match
                if (newUserPassword !== confirmNewUserPassword) {
                    alert("New password and confirmation do not match.");
                    return;
                }

                $('#changeUserPasswordForm').submit();
            }
        </script>
</body>

</html>
