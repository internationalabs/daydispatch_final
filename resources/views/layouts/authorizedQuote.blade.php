<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/vendors.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/responsive.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}"> --}}
    <title>Day Dispatch - Transportation</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/logo/logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{ asset('backend/js/vendors.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script src="{{ asset('backend/js/custom.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/datatable.custom.js') }}"></script>
    {{-- <script src="{{ asset('backend/js/chartjs/chartjs-custom.js') }}"></script>
    <script src="{{ asset('backend/js/chartjs/chartjs.min.js') }}"></script> --}}
    <script src="{{ asset('backend/js/RightSideTypehead.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        /* .hover-effect {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .hover-effect:hover {
            transform: scale(1.05);
            color: white;
            background-color: #1e2d62;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        } */
        .top-navbar.navbar .nav-item .nav-link.verify-user {
            font-size: 22px;
            position: relative;
            cursor: pointer;
            top: 3px;
            margin-right: 5px;
        }

        .auto-complete-data {
            height: 120px;
            width: 95%;
            overflow-y: scroll;
            position: absolute;
            z-index: 1;
        }

        li .badge {
            float: right;
        }

        .btns_wrap a:hover {
            text-decoration: none !important;
            right: 0
        }

        .btns_wrap a {
            background: #001d4d;
            display: block;
            position: absolute;
            right: -225px;
            width: 280px;
            padding: 11px 0;
            top: 5px;
            border-radius: 10px 0 0 10px;
            overflow: hidden;
            box-shadow: 0 0 40px #00000026 !important;
            -webkit-transition: all .3s ease;
            -moz-transition: all .3s ease;
            -ms-transition: all .3s ease;
            -o-transition: all .3s ease;
            transition: all .3s ease;
            border-radius: 3px 0 0 3px;
            z-index: 9999;
        }

        .btns_wrap .call_wrap span {
            color: #fff;
            font-size: 20px;
            vertical-align: middle;
            padding: 15px 20px 15px 15px;
        }

        .btns_wrap .chat_wrap span.icoo,
        .btns_wrap .call_wrap span.icoo {
            color: #fff;
            background: -moz-linear-gradient(-45deg, #2a3db6 0, #1169cd 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#2a3db6', endColorstr='#1169cd', GradientType=1);
            font-size: 18px;
            padding: 15px 20px;
            border-right: 1px solid #ded9d9;
            vertical-align: middle;
            display: inline-block;
            border-radius: 10px 0 0 10px
        }

        .btns_wrap .chat_wrap span {
            color: #fff;
            font-size: 20px;
            vertical-align: middle;
            padding: 15px 30px 15px 15px;
        }

        .Rightbutton {
            -webkit-transition: .4s;
            -moz-transition: .4s;
            -o-transition: .4s;
            transition: .4s;
            position: fixed;
            right: -370px;
            top: 14%;
            font-size: 0;
            width: 420px;
            z-index: 999
        }

        .Rightbutton.active {
            right: 0;
            z-index: 9;
            -webkit-transition: .4s;
            -moz-transition: .4s;
            -o-transition: .4s;
            transition: .4s
        }

        .Rightbutton .clickbutton {
            background: #001d4d;
            width: 40px;
            z-index: 999;
            height: 160px;
            cursor: pointer;
            box-shadow: -20px 7px 18px -7px rgba(87, 184, 151, 0.09);
            border-radius: 3px 0 0 3px;
            display: inline-block;
            padding-top: 0;
            vertical-align: top;
            margin-top: 0px;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            position: relative;
            font-family: 'Heebo', sans-serif;
            box-shadow: 0 0 40px #00000026;
            -webkit-box-shadow: 0 0 40px #00000026;
            -ms-box-shadow: 0 0 40px #00000026;
            -o-box-shadow: 0 0 40px #00000026
        }

        .Rightbutton .clickbutton .crossplus:before {
            content: "";
            display: none;
            position: absolute;
            width: 20px;
            height: 2px;
            right: 0;
            background: #fbb334;
            z-index: 99;
            top: 0;
            left: 0;
            bottom: 0;
            margin: auto
        }

        .Rightbutton .clickbutton .crossplus:after {
            content: "";
            display: none;
            position: absolute;
            width: 2px;
            height: 20px;
            right: 0;
            background: #fab334;
            z-index: 99;
            top: 0;
            left: 0;
            bottom: 0;
            margin: auto
        }

        .Rightbutton .clickbutton .crossplus {
            position: absolute;
            display: block;
            transform: rotate(-90deg);
            -webkit-transition: .4s;
            -moz-transition: .4s;
            -o-transition: .4s;
            transition: .4s;
            left: -40px;
            white-space: pre;
            bottom: 70px
        }

        .Rightbutton .clickbutton .crossplus.rotate {
            transform: rotate(45deg);
            -webkit-transition: .4s;
            -moz-transition: .4s;
            -o-transition: .4s;
            transition: .4s
        }

        .Rightbutton .clickbutton .crossplus i {
            font-size: 18px;
            color: #fff;
            margin: 17px 0 0 15px
        }

        .banner-form {
            background: #fff;
            padding: 30px;
            position: relative;
            z-index: 9 !important;
            border-radius: 5px;
            margin: 0;
            width: 370px;
            display: inline-block;
            box-shadow: 0 0 30px #0000001f
        }

        .ban-form input {
            width: 100%;
            margin: 0;
            border: 1px solid #333333;
            background: white;
            padding: 10px 15px;
            color: gray;
            font-size: 14px;
            border-radius: 3px;
            height: 50px;
            font-weight: 400;
            outline: none !important;
        }

        .banner-form .intl-tel-input {
            width: 100%
        }

        .banner-form h3 {
            color: #141315;
            font-size: 24px;
            margin-bottom: 5px;
            font-weight: 700
        }

        .banner-form h3 strong {
            font: 24px/24px "Montserrat", sans-serif;
            font-weight: 600
        }

        .ban-form button[type="search"] {
            color: #0e0e0e;
            font-weight: 600;
            border-radius: 3px;
            text-align: center;
            padding: 10px 15px;
            border: 3px solid #3c3c3c;
            cursor: pointer;
            font-size: 16px;
        }

        .ban-form .form-group.inpchecbx label {
            display: inline-block;
            margin: 0;
            line-height: 1.4;
            color: #676767;
            font-size: 13px
        }

        .ban-form .form-group.inpchecbx input {
            display: inline-block;
            width: auto;
            height: auto;
            margin: 0
        }

        body {
            zoom: 85%;
        }

        .simplebar-content .nav-item {
            opacity: 0;
            transform: translateX(-100%);
            transition: opacity 1s, transform 1s;
        }

        .shownavitem {
            opacity: 1 !important;
            transform: translateX(0) !important;
        }

        @keyframes addShowClass {
            0% {
                opacity: 0;
                transform: translateX(-20px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .sidemenu-area .sidemenu-body .sidemenu-nav .nav-item .nav-link {
            animation: addShowClass 0.4s ease forwards;
            opacity: 0;
            transform: translateX(-20px);
        }

        .sidemenu-area .nav-item {
            animation: addShowClass 0.4s ease forwards;
            opacity: 0;
            transform: translateX(-20px);
        }

        .sidemenu-area::-webkit-scrollbar,
        .parentOfSreach .navbar-nav.right-nav.align-items-center::-webkit-scrollbar {
            width: 3px;
        }

        .sidemenu-area::-webkit-scrollbar-thumb,
        .parentOfSreach .navbar-nav.right-nav.align-items-center::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }

        .parentOfSreach {
            position: relative;
            width: 100%;
        }

        .parentOfSreach .dropdown-menu.show {
            position: relative !important;
        }

        .parentOfSreach .CMP-User-List {
            position: absolute;
            right: 0;
        }

        .parentOfSreach .CMP-User-List .dropdown-menu show {
            position: relative;
        }

        .parentOfSreach .navbar-nav.right-nav.align-items-center {
            display: flex;
            flex-direction: column;
            overflow: scroll;
            max-height: 400px;
        }

        .width-imp-style {
            width: 150px !important;
        }

        .search-globle-width {
            width: 25%;
        }

        .nav- {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        .nav-item- {
            margin-right: 10px;
        }

        .nav-link- {
            display: inline-block;
            padding: 10px 15px;
            text-decoration: none;
            color: #333;
            background: #f1f1f1;
            border-radius: 4px;
        }

        .nav-link-.active {
            background: #e1000a;
            color: white;
        }

        .tab-content {
            margin-top: 20px;
        }

        .tab-pane {
            display: none;
        }

        .tab-pane.active {
            display: block;
        }
        .alert-link {
        text-decoration: none;
        color: inherit;
    }
    .alert-link:hover {
        text-decoration: underline;
    }
    </style>
    <script>
        function zoom() {
            document.body.style.zoom = "85%"
        }
    </script>
</head>

<body>
    @php
        $currentUser = \Illuminate\Support\Facades\Auth::guard('Authorized')->user();
        $verification = $currentUser->admin_verify && $currentUser->is_email_verified && $currentUser->Profile_Update;
    @endphp
    <div class="chartjs-colors" style="display: none;">
        <div class="bg-primary" style="background-color: #007bff;"></div>
        <div class="bg-secondary" style="background-color: #6c757d;"></div>
        <div class="bg-info" style="background-color: #17a2b8;"></div>
        <div class="bg-success" style="background-color: #28a745;"></div>
        <div class="bg-danger" style="background-color: #dc3545;"></div>
        <div class="bg-warning" style="background-color: #ffc107;"></div>
        <div class="bg-purple" style="background-color: #6f42c1;"></div>
        <div class="bg-pink" style="background-color: #e83e8c;"></div>
        <div class="bg-primary-light" style="background-color: rgba(0, 123, 255, 0.2);"></div>
        <div class="bg-success-light" style="background-color: rgba(40, 167, 69, 0.2);"></div>
    </div>
    {{-- Searching Cavnvas --}}
    <div id="" class="Rightbutton">
        <div class="clickbutton">
            <div class="crossplus">      Feedback      </div>
        </div>
        <div class="banner-form">
            <div class="banform">
                <div class="container">
                    <div class="row">
                        <div class="ban-form">
                            <form action="{{ route('Customer.Feedback')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" name="feedback" class="Order_ID"
                                                placeholder="Write your review here..." required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger btn-block">Submit Feedback</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Model Popup Section End-->
    <!-- Start Sidemenu Area -->
    <div class="sidemenu-area toggle-sidemenu-area" style="overflow: auto;">
        <div class="sidemenu-header">
            <a href="{{ route('Quote.Dashboard') }}" class="navbar-brand d-flex align-items-center">
                <img src="{{ asset('frontend/img/logo/logo.png') }}" height="29" width="35" alt="image">
                <span style="font-size: 18px;">Day Dispatch</span>
            </a>
            <div class="burger-menu d-none d-lg-block active">
                <span class="top-bar"></span>
                <span class="middle-bar"></span>
                <span class="bottom-bar"></span>
            </div>
            <div class="responsive-burger-menu d-block d-lg-none">
                <span class="top-bar"></span>
                <span class="middle-bar"></span>
                <span class="bottom-bar"></span>
            </div>
        </div>
        <div id="Side-Bar-Menu"></div>
    </div>
    <!-- End Sidemen Area -->
    <!-- Start Main Content Wrapper Area -->
    <div class="main-content d-flex flex-column  hide-sidemenu-area">
        <!-- Top Navbar Area -->
        <nav class="DamyNavbar">
        </nav>
        <nav class="navbar top-navbar navbar-expand toggle-navbar-area">
            <div class="collapse navbar-collapse" id="navbarSupportContent">
                <div class="responsive-burger-menu d-block d-lg-none">
                    <span class="top-bar"></span>
                    <span class="middle-bar"></span>
                    <span class="bottom-bar"></span>
                </div>
                <ul class="navbar-nav left-nav align-items-center d-none">
                    <li class="nav-item">
                        <a href="JavaScript:void(0);" target="_blank" class="nav-link"></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('Filterd.Listing') }}" target="_blank" class="nav-link"
                            data-toggle="tooltip" data-placement="bottom" title="Filter">
                            <i class='bx bx-filter-alt'></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('View.Google.TruckSpace') }}" class="nav-link" data-toggle="tooltip"
                            data-placement="bottom" title="Truck Space">
                            <i class='bx bxs-truck'></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('View.Packages') }}" target="_blank" class="nav-link"
                            data-toggle="tooltip" data-placement="bottom" title="Pricing">
                            <i class="bx bx-dollar-circle"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('task.calendar') }}" target="_blank" class="nav-link"
                            data-toggle="tooltip" data-placement="bottom" title="Task Calender">
                            <i class="fas fa-calendar fa-sm"></i>
                        </a>
                    </li>
                    @php
                        $Check_Status = App\Models\Payments\PaymentSystem::where('id', '=', 6)->find(6);
                    @endphp
                    @if ($Check_Status->Payment_Switch === 0)
                        <li class="nav-item">
                            <a href="{{ route('number.of.login') }}" target="_blank" class="nav-link"
                                data-toggle="tooltip" data-placement="bottom" title="Pay For Seats">
                                <i class="fas fa-chair fa-sm"></i>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item dropdown apps-box">
                        <a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class='fas fa-link'></i>
                        </a>
                        <div class="dropdown-menu width-imp-style">
                            <div class="dropdown-header d-flex justify-content-between align-items-center">
                                <span class="title d-inline-block">Useful Links</span>
                            </div>
                            <div class="dropdown-body">
                                <div class=" flex-wrap align-items-center">
                                    <a href="{{ route('borderWaitTime.index') }}" class="dropdown-item">
                                        <span class="d-block mb-0">Border Wait Time</span>
                                    </a>
                                    <a href="https://www.eia.gov/petroleum/gasdiesel/" target="_blank"
                                        class="dropdown-item">
                                        <span class="d-block mb-0">Fuel Price</span>
                                    </a>
                                    <a href="https://safer.fmcsa.dot.gov/CompanySnapshot.aspx" target="_blank"
                                        class="dropdown-item">
                                        <span class="d-block mb-0">FMCSA Search</span>
                                    </a>
                                    <a target="_blank"
                                        href="https://www.google.com/maps/place/United+States/@36.0182818,-161.6911694,3z/data=!3m1!4b1!4m6!3m5!1s0x54eab584e432360b:0x1c3bb99243deb742!8m2!3d37.09024!4d-95.712891!16zL20vMDljN3cw?entry=ttu"
                                        class="dropdown-item">
                                        <span class="d-block mb-0">Google Maps</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="parentOfSreach">
                    <form class="nav-search-form d-none ml-auto d-md-block" method="POST"
                        action="{{ route('User.Company.Search') }}">
                        @csrf
                        <label><i class='bx bx-search d-none'></i></label>
                        <input type="text" class="form-control Search-Bar d-none" id="check-search-field"
                            name="Search_Bar" placeholder="Search Company..." value="">
                        <input type="submit" id="myBtn" hidden />
                    </form>
                    <div class="CMP-User-List"></div>
                </div>
                <ul class="navbar-nav right-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link bx-fullscreen-btn" id="fullscreen-button">
                            <i class="bx bx-fullscreen"></i>
                        </a>
                    </li>
                    <li class="nav-item notification-box dropdown Notification">
                    </li>
                    @if ($verification)
                        <li class="nav-item" data-toggle="tooltip" data-placement="top" title="User Verified">
                            <a class="nav-link verify-user" style="color: green;">
                                <i class='bx bxs-check-shield'></i>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item dropdown profile-nav-item">
                        <a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <div class="menu-profile">
                                <span
                                    class="name">{{ \Illuminate\Support\Str::limit($currentUser->Company_Name, $limit = 21, '...') }}</span>
                                <i class="fa-solid fa-caret-down" style="margin-bottom: -1px;"></i>
                                <img src="{{ $currentUser->profile_photo_path ? url($currentUser->profile_photo_path) : asset('backend/img/user1.jpg') }}"
                                    class="rounded-circle" alt="image">
                            </div>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-header d-flex flex-column align-items-center">
                                <div class="figure mb-3">
                                    <img src="{{ $currentUser->profile_photo_path ? url($currentUser->profile_photo_path) : asset('backend/img/user1.jpg') }}"
                                        class="rounded-circle" alt="image">
                                </div>
                                <div class="info text-center">
                                    <span class="name">
                                        {{ $currentUser->name }} <br>
                                        {{ $currentUser->usr_type }}
                                    </span>
                                    <p class="mb-3 email"><a href="mailto:{{ $currentUser->email }}"
                                            class="__cf_email__">[{{ $currentUser->email }}]</a>
                                    </p>
                                </div>
                                @if ($currentUser->usr_type == 'Dispatcher' && $currentUser->ref_code_dispatcher != null)
                                    <span class="name">
                                        Ref. Code: {{ $currentUser->ref_code_dispatcher }}
                                    </span>
                                @endif
                                @if (Auth::guard('Authorized')->user()->dispatcher()->exists())
                                    @if (Auth::guard('Authorized')->user()->usr_type == 'Dispatcher')
                                        <div class="info text-center">
                                            @php
                                                $All_Users = App\Models\Extras\ManagedUser::with('user')
                                                    ->where('dispatcher_id', Auth::guard('Authorized')->user()->id)
                                                    ->get();

                                                $checkMe = App\Models\Extras\ManagedUser::with('user')
                                                    ->where('dispatcher_id', Auth::guard('Authorized')->user()->id)
                                                    ->first();
                                            @endphp

                                            @if ($All_Users && $checkMe->user)
                                                <span class="name">
                                                    I Manage
                                                </span>
                                                @foreach ($All_Users as $row)
                                                    <a
                                                        href="{{ route('switch.managed.user', $row->user->id) }}">{{ $row->user->Company_Name }}</a>
                                                    <br>
                                                @endforeach
                                            @endif
                                        </div>
                                    @endif
                                @endif
                                @if (Auth::guard('Authorized')->user()->managedUsers)
                                    <div class="info text-center">
                                        @php
                                            $user = App\Models\Extras\ManagedUser::with('dispatcher')
                                                ->where('user_id', Auth::guard('Authorized')->user()->id)
                                                ->first();
                                        @endphp
                                        @if ($user && $user->dispatcher)
                                            <span class="name">
                                                Managed By
                                            </span>
                                            <a
                                                href="{{ route('Auth.Forms') }}">{{ $user->dispatcher->Company_Name }}</a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <div class="dropdown-body">
                                <ul class="profile-nav p-0 pt-3">
                                    <li class="nav-item">
                                        <a href="{{ route('User.Profile') }}" class="nav-link">
                                            <i class='bx bx-user'></i> <span>Account Settings</span>
                                        </a>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a href="{{ route('View.MyReports') }}" class="nav-link">
                                            <i class='bx bx-user'></i> <span>My Report</span>
                                        </a>
                                    </li> --}}
                                    <li class="nav-item">
                                        <a href="{{ route('View.Profile.Ratings', ['user_id' => $currentUser->id]) }}"
                                            class="nav-link">
                                            <i class='bx bx-star'></i> <span>My Ratings</span>
                                        </a>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a href="{{ route('View.Invoices') }}" class="nav-link">
                                            <i class='bx bx-receipt'></i> <span>Invoices</span>
                                        </a>
                                    </li> --}}
                                    {{-- <li class="nav-item">
                                        <a href="{{ route('My.Tickets') }}" class="nav-link">
                                            <i class='bx bx-extension'></i> <span>3-Way Support</span>
                                        </a>
                                    </li> --}}
                                    <li class="nav-item">
                                        <a href="{{ route('View.Notification', ['user_id' => $currentUser->id]) }}"
                                            class="nav-link">
                                            <i class='bx bx-detail'></i> <span>My Notifications</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dropdown-footer">
                                <ul class="profile-nav">
                                    <li class="nav-item">
                                        <a href="{{ route('User.LogOut') }}" class="nav-link">
                                            <i class='bx bx-log-out'></i> <span>Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- End Top Navbar Area -->
        @if (!$currentUser->admin_verify && !$currentUser->is_email_verified && !$currentUser->Profile_Update)
            <div class="alert alert-danger text-center" role="alert">
                <strong>
                    @if (!$currentUser->admin_verify)
                        Account Under Review |
                    @endif
                    @if (!$currentUser->is_email_verified)
                        Email Not Verified! Please Check Your Email. |
                    @endif
                    @if (!$currentUser->Profile_Update)
                        <a href="{{ route('User.Profile') }}" target="">Update Your Profile!</a>
                    @endif
                </strong>
                <i class="fa fa-question-circle"></i>
            </div>
        @endif
        {{ $slot }}
        <main class="container-fluid">
            @yield('content')
        </main>
        <!-- Start Footer End -->
        <footer class="footer-area">
            <div class="row align-items-center">
                <div class="col-lg-6 col-sm-6 col-md-6">
                    <p>Copyright <i class='bx bx-copyright'></i> (2022 - {{ date('Y') }}) <a
                            href="{{ url('') }}">Day Dispatch</a>. All rights reserved
                    </p>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 text-right">
                    <p>Designed by ❤️ <a href="{{ url('') }}" target="_blank">Day Dispatch</a></p>
                </div>
            </div>
        </footer>
        <!-- End Footer End -->
    </div>
    <!-- End Main Content Wrapper Area -->
    <!-- Add Listing Miscellaneous -->
    <div class="modal fade" id="AddMisc" data-backdrop="true" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Miscellaneous For Current Order. <span class="get_Order_ID"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body user-settings-box">
                    <form action="{{ route('Order.Misc') }}" method="POST" class="was-validated"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Select Any Miscellaneous Item</label>
                                    <select class="custom-select Misc" name="Misc_Item" required>
                                        @forelse($Misc_List as $Misc)
                                            <option value="{{ $Misc->Misc_Items }}">{{ $Misc->Misc_Items }}</option>
                                        @empty
                                            <option value="">Select AnyOne</option>
                                        @endforelse
                                        <option value="Other">Other</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Select Any Type.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 other-misc">
                                <div class="form-group">
                                    <label>Enter Other Miscellaneous Item</label>
                                    <input type="text" class="form-control" name="Other_Misc_Item"
                                        placeholder="Enter Miscellaneous Name" value="" autocomplete="off">
                                    <div class="invalid-feedback">
                                        Entered Misc. Item Name
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Enter Amount</label>
                                    <input type="number" class="form-control" name="Misc_Item_Amount"
                                        placeholder="Enter Amount" min="0" value="" autocomplete="off"
                                        required>
                                    <div class="invalid-feedback">
                                        Entered Misc. Item Amount
                                    </div>
                                </div>
                            </div>
                            <input hidden type="text" name="Listed_ID" class="get_Listed_ID" value="">
                            <div class="col-lg-12">
                                <div class="btn-box text-center">
                                    <button type="submit" class="submit-btn w-100"><i class='bx bx-save'></i>
                                        Add Miscellaneous Item
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Cancel Order Modal -->
    <div class="modal fade" id="CancelOrderModal" data-backdrop="true" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Are You Sure to Cancel This Order(<strong class="get_Order_ID">Order ID:
                        </strong>)?</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body user-settings-box">
                    <p>If Carrier Cancels The Order Than There is no Refund From the Company. Read Privacy Policy!</p>
                    <form action="{{ route('Listing.Cancel') }}" method="POST" class="was-validated">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Select Any Reason</label>
                                    <select class="custom-select select-reason" name="Main_Reason" required>
                                        <option value="">Select AnyOne</option>
                                        <option value="Customer Not Responding">Customer Not Responding</option>
                                        <option value="Price Issue">Price Issue</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <div class="invalid-feedback">Select AnyOne</div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group Reason">
                                    <label>Detailed Reason</label>
                                    <input type="text" class="form-control Cancel_Reason" maxlength="250"
                                        name="Detail_Reason" placeholder="Maximum 250 Words">
                                    <div class="invalid-feedback">
                                        Entered Reason.
                                    </div>
                                    <input hidden type="text" class="get_Listed_ID" name="get_Listed_ID"
                                        value="">
                                    <input hidden type="text" class="get_User_ID" name="get_User_ID"
                                        value="">
                                    <input hidden type="text" class="get_CMP_ID" name="get_CMP_ID"
                                        value="">
                                    <input hidden type="text" class="get_Order_Status" name="get_Order_Status"
                                        value="">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="btn-box text-center">
                                    <button type="submit" class="submit-btn w-100"><i class='fa fa-close'></i>
                                        Cancel Order
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add New Truck Space -->
    <div class="modal fade" id="AddTruckSpace" data-backdrop="true" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Truck Space</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <ul class="nav- justify-content-center" role="tablist">
                    <li class="nav-item-" role="presentation">
                        <a class="nav-link- active" href="#tab1" role="tab" aria-controls="tab1"
                            aria-selected="true">Freight Load</a>
                    </li>
                    <li class="nav-item-" role="presentation">
                        <a class="nav-link-" href="#tab2" role="tab" aria-controls="tab2"
                            aria-selected="false">Heavy Vehicle</a>
                    </li>
                    <li class="nav-item-" role="presentation">
                        <a class="nav-link-" href="#tab3" role="tab" aria-controls="tab3"
                            aria-selected="false">Vehicle Load</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                        <div class="modal-body user-settings-box">
                            <h4 class="text-bold text-center">Freight Load</h4>
                            {{-- Freight Load --}}
                            <form action="{{ route('Post.TruckSpaceDry') }}" method="POST" class="was-validated"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Equipment Condition</label>
                                            <select class="custom-select" name="Equipment_Condition_Dry" required>
                                                <option selected="" value="Running">Running</option>
                                                <option value="Not Running">Not Running</option>
                                            </select>
                                            <div class="invalid-feedback">Select Equipment Condition
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Trailer Type Dry Vans</label>
                                            <select class="custom-select" name="Trailer_Type_Dry" required>
                                                <option value="">Select Trailer Type Dry Vans</option>
                                                <option value="VAN">VAN</option>
                                                <option value="REEFER">REEFER</option>
                                                <option value="FLATBED">FLATBED</option>
                                                <option value="STEP OR DROP DECK">STEP OR DROP DECK</option>
                                                <option value="REMOVABLE GOOSENECK (RGN)">REMOVABLE GOOSENECK (RGN)
                                                </option>
                                                <option value="CONESTOGA">CONESTOGA</option>
                                                <option value="CONTAINER / DRAYAGE">CONTAINER / DRAYAGE</option>
                                                <option value="STRAIGHT TRUCK / BOX TRUCK /SPRINTER">STRAIGHT TRUCK /
                                                    BOX TRUCK /SPRINTER</option>
                                                <option value="HAZMAT">HAZMAT</option>
                                                <option value="POWER ONLY">POWER ONLY</option>
                                                <option value="HOT SHOT">HOT SHOT</option>
                                                <option value="LOWBOY">LOWBOY</option>
                                                <option value="ENDUMP">ENDUMP</option>
                                                <option value="LANDOLL">LANDOLL</option>
                                                <option value="PARTIAL">PARTIAL</option>
                                                <option value="20ft container">20ft container</option>
                                                <option value="48ft container">48ft container</option>
                                                <option value="53ft container">53ft container</option>
                                            </select>
                                            <div class="invalid-feedback">Select Any Equipment Type</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Heavy Departs</label>
                                            <input type="time" class="form-control" id="departs"
                                                name="Truck_Departs_Dry" required>
                                            <div class="invalid-feedback">
                                                Select Departs.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group multiSelect">
                                            <label>Trailer Specification Dry Vans</label>
                                            <select class="custom-select" name="Trailer_Specification_Dry" required>
                                                <option selected="" value="">Select Trailer</option>
                                                <option>Air Ride(A)</option>
                                                <option>Blanket Wrap (B)</option>
                                                <option>B-Train (BT)</option>
                                                <option>Chain(CH)</option>
                                                <option>Chassis (CS)</option>
                                                <option>Conestoga(CO)</option>
                                                <option>Curtain(C)</option>
                                                <option>Double(2)</option>
                                                <option>Extendable (E)</option>
                                                <option>E-Track (ET)</option>
                                                <option>Hazmat (Z)</option>
                                                <option>Hot Shot (HS)</option>
                                                <option>Insulated (N)</option>
                                                <option>Lift Gate (LG)</option>
                                                <option>Load Out (LO)</option>
                                                <option>Load Ramp (LR)</option>
                                                <option>Moving (MV)</option>
                                                <option>Open Top (OT)</option>
                                                <option>Oversized (O)</option>
                                                <option>Pallet Exchange (X)</option>
                                                <option>Side Kit (S)</option>
                                                <option>Tarp(T)</option>
                                                <option>Team Driver(M)</option>
                                                <option>Temp Control (TC)</option>
                                                <option>Triple (3)</option>
                                                <option>Vented (V)</option>
                                                <option>Walking Floor (WF)</option>
                                            </select>
                                            <div class="invalid-feedback">Select Any Trailer Type
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Shipment Preferences</label>
                                            <select class="custom-select" data-placeholder="Shipment Preferences"
                                                name="Shipment_Preferences_Dry" required>
                                                <option selected="" value="">Select Shipment Preferences
                                                </option>
                                                <option value="LTL">LTL (Less Than Truck Load)
                                                </option>
                                                <option value="FTL">FTL (Full Truck Load)</option>
                                            </select>
                                            <div class="invalid-feedback">Select Shipment Preferences
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Location</label>
                                            <input type="text" class="form-control Location_ZipCode typeahead"
                                                name="Truck_Location_Dry" placeholder="Enter ZipCode, State or City"
                                                required>
                                            <div class="invalid-feedback">
                                                Enter Location.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Heading</label>
                                            <input type="text" class="form-control Heading_ZipCode typeahead"
                                                name="Truck_Heading_Dry" placeholder="Enter ZipCode, State or City"
                                                required>
                                            <div class="invalid-feedback">
                                                Enter Heading.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Destination</label>
                                            <input type="text" class="form-control Destination_ZipCode typeahead"
                                                name="Truck_Destination_Dry"
                                                placeholder="Enter ZipCode, State or City" required>
                                            <div class="invalid-feedback">
                                                Enter Destination.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="hazmat_Check"
                                                name="is_hazmat_Check" value="1">
                                            <label class="form-check-label" for="hazmat_Check">Hazmat?</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="btn-box text-center">
                                            <button type="submit" class="submit-btn w-100"><i
                                                    class='bx bx-save'></i>
                                                Add Freight Load
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Heavy Vehicle Tab -->
                    <div class="tab-pane" id="tab2" role="tabpanel" aria-labelledby="tab2">
                        <div class="modal-body user-settings-box">
                            <h4 class="text-bold text-center">Heavy Vehicle</h4>
                            <form action="{{ route('Post.HeavyTruckSpace') }}" method="POST" class="was-validated"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Available Heavy Space</label>
                                            <input type="number" class="form-control" name="Heavy_Truck_Space"
                                                placeholder="Enter Truck Space" min="0" required>
                                            <div class="invalid-feedback">
                                                Enter Truck Space.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Equipment Condition</label>
                                            <select class="custom-select" name="Equipment_Condition" required>
                                                <option selected="" value="Running">Running</option>
                                                <option value="Not Running">Not Running</option>
                                            </select>
                                            <div class="invalid-feedback">Select Equipment Condition
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Trailer Type</label>
                                            <select class="custom-select" data-placeholder="Equipment Type"
                                                name="Trailer_Type" required>
                                                <option selected="" value="">Select Trailer Type</option>
                                                <option>VAN (V)</option>
                                                <option>REEFER (RE) </option>
                                                <option>FLATBED (F)</option>
                                                <option>Step Deck Trailer</option>
                                                <option>REMOVABLE GOOSENECK (RGN) </option>
                                                <option>CONESTOGA (CS)</option>
                                                <option>TRUCK (T)</option>
                                                <option>HAZMAT (hazardous materials)</option>
                                                <option>POWER ONLY (PO)</option>
                                                <option>HOT SHOT (HS)</option>
                                                <option>LOWBOY (LB)</option>
                                                <option>ENDUMP (ED)</option>
                                                <option>LANDOLL (LD)</option>
                                                <option>PARTIAL (PT)</option>
                                                <option>20ft container</option>
                                                <option>40ft container</option>
                                                <option>48ft container</option>
                                                <option>53ft container</option>
                                            </select>
                                            <div class="invalid-feedback">Select Trailer Type
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Heavy Departs</label>
                                            <input type="time" class="form-control" id="departs"
                                                name="Heavy_Truck_Departs" required>
                                            <div class="invalid-feedback">
                                                Select Departs.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Trailer Specification</label>
                                            <select class="custom-select" data-placeholder="Trailer Specification"
                                                name="option" required>
                                                <option selected="" value="">Select Trailer
                                                </option>
                                                <option>Air Ride(A)</option>
                                                <option>Blanket Wrap (B)</option>
                                                <option>B-Train (BT)</option>
                                                <option>Chain(CH)</option>
                                                <option>Chassis (CS)</option>
                                                <option>Conestoga(CO)</option>
                                                <option>Curtain(C)</option>
                                                <option>Double(2)</option>
                                                <option>Extendable (E)</option>
                                                <option>E-Track (ET)</option>
                                                <option>Hazmat (Z)</option>
                                                <option>Hot Shot (HS)</option>
                                                <option>Insulated (N)</option>
                                                <option>Lift Gate (LG)</option>
                                                <option>Load Out (LO)</option>
                                                <option>Load Ramp (LR)</option>
                                                <option>Moving (MV)</option>
                                                <option>Open Top (OT)</option>
                                                <option>Oversized (O)</option>
                                                <option>Pallet Exchange (X)</option>
                                                <option>Side Kit (S)</option>
                                                <option>Tarp(T)</option>
                                                <option>Team Driver(M)</option>
                                                <option>Temp Control (TC)</option>
                                                <option>Triple (3)</option>
                                                <option>Vented (V)</option>
                                                <option>Walking Floor (WF)</option>
                                            </select>
                                            <div class="invalid-feedback">Select Any Trailer Type
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Shipment Preferences</label>
                                            <select class="custom-select" data-placeholder="Shipment Preferences"
                                                name="Shipment_Preferences" required>
                                                <option selected="" value="">Select Shipment Preferences
                                                </option>
                                                <option value="LTL">LTL (Less Than Truck Load)
                                                </option>
                                                <option value="FTL">FTL (Full Truck Load)</option>
                                            </select>
                                            <div class="invalid-feedback">Select Shipment Preferences
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Location</label>
                                            <input type="text" class="form-control Location_ZipCode typeahead"
                                                name="Heavy_Truck_Location" placeholder="Enter ZipCode, State or City"
                                                required>
                                            <div class="invalid-feedback">
                                                Enter Location.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Heading</label>
                                            <input type="text" class="form-control Heading_ZipCode typeahead"
                                                name="Heavy_Truck_Heading" placeholder="Enter ZipCode, State or City"
                                                required>
                                            <div class="invalid-feedback">
                                                Enter Heading.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Destination</label>
                                            <input type="text" class="form-control Destination_ZipCode typeahead"
                                                name="Heavy_Truck_Destination"
                                                placeholder="Enter ZipCode, State or City" required>
                                            <div class="invalid-feedback">
                                                Enter Destination.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="btn-box text-center">
                                            <button type="submit" class="submit-btn w-100"><i
                                                    class='bx bx-save'></i>
                                                Add Heavy Space
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Vehicle Load Tab -->
                    <div class="tab-pane" id="tab3" role="tabpanel" aria-labelledby="tab3">
                        <div class="modal-body user-settings-box">
                            <h4 class="text-bold text-center">Vehicle Load</h4>
                            <form action="{{ route('Post.TruckSpace') }}" method="POST" class="was-validated"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row justify-content-center">
                                    {{-- <div class="col-lg-5">
                                    <div class="form-group">
                                        <label>Select Country</label>
                                        <select class="custom-select" name="Truck_Country" required>
                                            <option value="United State America (USA)">United State America (USA)</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Canada">Canada</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Select Any Country.
                                        </div>
                                    </div>
                                </div> --}}
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Available Space</label>
                                            <input type="number" class="form-control" name="Truck_Space"
                                                placeholder="Enter Truck Space" min="0" required>
                                            <div class="invalid-feedback">
                                                Enter Truck Space.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Trailer Type</label>
                                            <select class="custom-select" name="Truck_Trailer_Type" required>
                                                <option value="Open">Open</option>
                                                <option value="Enclosed">Enclosed</option>
                                                <option value="Flatbed Trailer">Flatbed Trailer</option>
                                                <option value="Removable Goose-neck Trailered">Removable Goose-neck
                                                    Trailered
                                                </option>
                                                <option value="Lowboy Trailer">Lowboy Trailer</option>
                                                <option value="Step Deck Trailer">Step Deck Trailer</option>
                                                <option value="Extendable Flatbed Trailer">Extendable Flatbed Trailer
                                                </option>
                                                <option value="Stretch Single Drop Deck Trailer">Stretch Single Drop
                                                    Deck
                                                    Trailer
                                                </option>
                                                <option value="Tow Away">Tow Away</option>
                                                <option value="Drive Away">Drive Away</option>
                                                <option value="Other">Other</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Select Any Type.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Select Condition</label>
                                            <select class="custom-select" name="Truck_Condition" required>
                                                <option value="Running">Running</option>
                                                <option value="Non-Running">Non-Running</option>
                                                <option value="Both">Both</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Select Truck Condition.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Departs</label>
                                            <input type="time" class="form-control" id="departs"
                                                name="Truck_Departs" required>
                                            <div class="invalid-feedback">
                                                Select Departs.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Location</label>
                                            <input type="text" class="form-control Location_ZipCode typeahead"
                                                name="Truck_Location" placeholder="Enter ZipCode, State or City"
                                                required>
                                            <div class="invalid-feedback">
                                                Enter Location.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Heading</label>
                                            <input type="text" class="form-control Heading_ZipCode typeahead"
                                                name="Truck_Heading" placeholder="Enter ZipCode, State or City"
                                                required>
                                            <div class="invalid-feedback">
                                                Enter Heading.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Destination</label>
                                            <input type="text" class="form-control Destination_ZipCode typeahead"
                                                name="Truck_Destination" placeholder="Enter ZipCode, State or City"
                                                required>
                                            <div class="invalid-feedback">
                                                Enter Destination.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="btn-box text-center">
                                            <button type="submit" class="submit-btn w-100"><i
                                                    class='bx bx-save'></i>
                                                Add Truck Space
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- View Compare Listing Modal -->
    <div class="modal fade" id="CompareListing" data-backdrop="true" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Comparable Listings for: <span class="get_Order_ID"></span></h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body user-settings-box">
                    <input hidden type="text" name="get_Listed_ID" class="get_Listed_ID" value="">
                    <input hidden type="text" name="get_Listed_Miles" class="get_Listed_Miles" value="">
                    <div class="table-responsive" id="all-fetch-comparison">
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- Waiting Approval --}}
<div class="modal fade" id="WaitingApproval" data-backdrop="true" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pending Admin Approval <span class="get_Order_ID"></span></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body user-settings-box text-center">
                <h5 class="font-weight-bold text-danger">Complete Your Profile for Verification</h5>
                <p class="mt-3 text-muted">
                    Kindly complete your profile to proceed with the verification process. Once the administrator verifies your information, you will be granted access to perform this function. Thank you for your cooperation.
                </p>
                <div class="d-flex justify-content-center">
                    <a class="btn btn-outline-primary mb-2 text-nowrap"
                        href="{{ route('User.Profile') }}">
                        Complete Your Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- View Authorization Form Modal -->
    <div class="modal fade" id="showModal" data-backdrop="true" role="dialog" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Authorization Form</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body user-settings-box">
                    <input hidden type="text" name="get_Listed_ID" class="get_Listed_ID" value="">
                    <input hidden type="text" name="get_Listed_Miles" class="get_Listed_Miles" value="">
                    <div id="all-fetch-comparison">
                        <form method="post" action="{{ route('authorization.form.email') }}">
                            @csrf
                            <div class="row">
                                <input type="hidden" class="form-control" name="id" id='authorization-orderId'
                                    placeholder="" readonly>
                                <input type="hidden" class="form-control" name="status" id='authorization-status'
                                    placeholder="" readonly>
                                <input type="hidden" class="form-control" name="cname" id='authorization-cname'
                                    placeholder="" readonly>
                                <input type="hidden" class="form-control" name="cphone" id='authorization-cphone'
                                    placeholder="" readonly>
                                <input type="hidden" class="form-control" name="origin" id='authorization-origin'
                                    placeholder="" readonly>
                                <input type="hidden" class="form-control" name="destination"
                                    id='authorization-destination' placeholder="" readonly>
                                <input type="hidden" class="form-control" name="vehicle" id='authorization-vehicle'
                                    placeholder="" readonly>
                                <br>
                                <div class="col-sm-12 col-md-12" id="msgReply">
                                    <div class="form-group">
                                        <label class="form-label">Enter Inv. Amount</label>
                                        <input type="number" value="" name="invoiceAmount"
                                            class="form-control" id="authorizationAmount" placeholder="Enter Amount"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Enter Email</label>
                                        <input type="email" value="" name="email"
                                            class="form-control userEmail" id="authorizationEmail"
                                            placeholder="Enter Email" />
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" id="authorizationForm">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="OrderHistory" data-backdrop="true" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">HISTORY/STATUS<span class="get_Order_ID"></span></h5>
                    <button type="button" class="close" data-id="{{ $List->id ?? '' }}" data-dismiss="modal"
                        onclick="redirect(this)">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body user-settings-box" id="modal-body">
                    <!-- Tab Navigation -->
                    <div id="button-section" class="mb-3">
                        <ul class="nav justify-content-center custom-nav" role="tablist">
                            <li class="nav-item mr-2" role="presentation">
                                <a class="nav-link custom-tab active" id="tab1" data-toggle="tab"
                                    href="#form-section" role="tab" aria-controls="form-section"
                                    aria-selected="true">HISTORY/STATUS</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link custom-tab" id="tab2" data-toggle="tab" href="#data-section"
                                    role="tab" aria-controls="data-section" aria-selected="false"
                                    data-id="{{ $List->id ?? '' }}">VIEW/HISTORY</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Tab Content -->
                    <div class="tab-content">
                        <!-- Form Section -->
                        <div class="tab-pane fade show active" id="form-section" role="tabpanel"
                            aria-labelledby="tab1">
                            <form id="order-status-form" action="{{ route('Order.Status') }}" method="POST"
                                class="was-validated" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="modal-quote-id" name="quote_id">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="pickup-location">HISTORY/STATUS</label>
                                                @php
                                                    $user_id = Auth::guard('Authorized')->user()->id;
                                                    $OptionName = App\Models\SidebarOption::where(
                                                        'user_id',
                                                        $user_id,
                                                    )->get();
                                                @endphp
                                                <select class="custom-select" name="history_status" required>
                                                    <option value="">Select AnyOne</option>
                                                    @foreach ($OptionName as $option)
                                                        <option value="{{ $option->name }}">{{ $option->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">Select Any Location.</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="expected-date">Expected Date</label>
                                                <input type="date" class="form-control" name="expected_date"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="history-description">HISTORY</label>
                                                <textarea class="form-control" name="history_description"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 text-center">
                                            <button type="submit" class="btn btn-danger w-100" id="empty_field">
                                                <i class='bx bx-save'></i> Save Changes
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Data Section -->
                        <div class="tab-pane fade" id="data-section" role="tabpanel" aria-labelledby="tab2">
                            <div id="data-container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="orderHistoryModal" tabindex="-1" role="dialog"
        aria-labelledby="orderHistoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderHistoryModalLabel">Order History</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="orderHistoryContent">
                        <!-- History data will be loaded here dynamically -->
                    </div>
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
    {{-- @if (Session::has('Success!'))
        <script>
            toastr.success("{!! Session::get('Success!') !!}");
        </script>
    @endif
    @if (Session::has('Error!'))
        <script>
            toastr.error("{!! Session::get('Error!') !!}");
        </script>
    @endif --}}
    <!-- ApexCharts JS -->
    <script src="{{ asset('backend/js/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('backend/js/apexcharts/apexcharts-stock-prices.js') }}"></script>
    <script src="{{ asset('backend/js/apexcharts/apexcharts-irregular-data-series.js') }}"></script>
    <script src="{{ asset('backend/js/apexcharts/apex-custom-line-chart.js') }}"></script>
    <script src="{{ asset('backend/js/apexcharts/apex-custom-pie-donut-chart.js') }}"></script>
    <script src="{{ asset('backend/js/apexcharts/apex-custom-area-charts.js') }}"></script>
    <script src="{{ asset('backend/js/apexcharts/apex-custom-column-chart.js') }}"></script>
    <script src="{{ asset('backend/js/apexcharts/apex-custom-bar-charts.js') }}"></script>
    <script src="{{ asset('backend/js/apexcharts/apex-custom-mixed-charts.js') }}"></script>
    <script src="{{ asset('backend/js/apexcharts/apex-custom-radialbar-charts.js') }}"></script>
    <script src="{{ asset('backend/js/apexcharts/apex-custom-radar-chart.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <div class="chartjs-colors">
        <div class="bg-primary"></div>
        <div class="bg-primary-light"></div>
        <div class="bg-secondary"></div>
        <div class="bg-info"></div>
        <div class="bg-success"></div>
        <div class="bg-success-light"></div>
        <div class="bg-danger"></div>
        <div class="bg-warning"></div>
        <div class="bg-purple"></div>
        <div class="bg-pink"></div>
    </div>
    @yield('extra_script')
    <script>
        // $('.advance-786').DataTable({
        //     "deferRender": true,
        //     "lengthMenu": [
        //         [50, 100, 150, 200, 250],
        //         [50, 100, 150, 200, 250]
        //     ],
        // });

        $(document).ready(function () {
        $('.table-1').DataTable({
            "paging": false,
            "ordering": true,
            "info": false,
            "searching": false
        });
    });
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.nav-link-');
            const tabPanes = document.querySelectorAll('.tab-pane');

            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Remove active class from all tabs
                    tabs.forEach(t => t.classList.remove('active'));
                    // Hide all tab panes
                    tabPanes.forEach(pane => pane.classList.remove('active'));

                    // Add active class to the clicked tab
                    this.classList.add('active');
                    // Show the corresponding tab pane
                    const targetPane = document.querySelector(this.getAttribute('href'));
                    targetPane.classList.add('active');
                });
            });
        });
    </script>
    <script>
        const path = "{{ route('autocomplete') }}";
        $(document).ready(function() {
            $(".clickbutton").click(function() {
                $('.Rightbutton').toggleClass("active");
            });
            $('.floating_strip .rotatekaro a').on('click', function(e) {
                $('.floating_form').toggleClass("open");
            });
            // Get All Notifications
            function getNotifications() {
                $.ajax({
                    url: '{{ route('Get.Notification') }}',
                    type: 'GET',
                    success: function(data) {
                        $('.Notification').html(
                            data); // Insert the retrieved HTML into the target element
                    },
                    error: function(data) {
                        console.log(data);
                        // alert(data);
                    },
                    complete: function() {
                        // Schedule the next request when the current one is complete
                        setTimeout(getNotifications, 5000); // The timeout set to 5 seconds
                    }
                });
            }
            // Call the function to start retrieving notifications
            getNotifications();

            function getSideBarCounts() {
                $.ajax({
                    url: '{{ route('Get.Quote.Counts') }}',
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            $('#Side-Bar-Menu').html(response
                                .html);
                        } else {
                            alert('Error: ' + response);
                        }
                    },
                    error: function(data) {
                        alert(data);
                    },
                    // complete: function () {
                    //     setTimeout(getSideBarCounts, 5000); // The timeout set to 5 seconds
                    // }
                });
            }
            getSideBarCounts();
            // BOL JS Functions
            $(".attach-bill").click(function() {
                const getListedID = $(this).find('.Listed-ID').val();
                const getListedRefID = $(this).find('.List-Ref-ID').val();
                $(".get_Order_ID").html(getListedRefID);
                $(".get_Listed_ID").val(getListedID);
            });
            $(document).on('focus', ':input', function() {
                $(this).attr('autocomplete', 'off');
            });

            function onlyNumberKey(evt) {
                const ASCIICode = evt.which ? evt.which : evt.keyCode;
                return !(ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57));
            }
            $("form").delegate(".phone-number", "focus", function() {
                const selectionStart = $('input')[0].selectionStart;
                const selectionEnd = $('input')[0].selectionEnd;
                $(".phone-number")[0].setSelectionRange(selectionStart, selectionEnd);
                $(".phone-number").mask("(999) 999-9999");
            });
            const CMP_User_List = $('.CMP-User-List');
            let debounceTimer;
            $('.Search-Bar').on('keyup', function() {
                clearTimeout(debounceTimer); // Clear the previous timer
                const query = $(this).val();
                debounceTimer = setTimeout(function() {
                    // Execute the AJAX request after 300ms of inactivity
                    $.ajax({
                        url: '{{ route('Find.Company') }}',
                        type: 'GET',
                        data: {
                            'name': query
                        },
                        success: function(data) {
                            if ($("#check-search-field").val() != '') {
                                CMP_User_List.html(data.html);
                            } else {
                                console.log('empty');
                                CMP_User_List.html('');

                            }
                        },
                        error: function(data) {
                            console.log(data);
                        }
                    });
                }, 300);
            });
            $(document).on('click', '.CMP-User-List li', function() {
                $('.Search-Bar').val('');
                CMP_User_List.html("");
            });
            // Date Validation
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var yyyy = today.getFullYear();
            today = yyyy + '-' + mm + '-' + dd;
            $('input[type="date"]').attr('min', today);
            //    Time Validation
            var date = new Date(Date.now());
            document.getElementById('departs').value = date.toISOString().substring(11, 16);
        });
    </script>
    <script>
        // Cache frequently used elements
        var $firstSign = $("#first_sign");
        var $secondSign = $("#second_sign");
        var $thirdSign = $("#third_sign");
        var $fourthSign = $("#fourth_sign");
        // Handle signature checkboxes
        $(".signature-checkbox").on("change", function() {
            const $checkbox = $(this);
            const $fieldset = $checkbox.closest("fieldset");
            if ($checkbox.is(":checked")) {
                $fieldset.css({
                    "background-color": "black",
                    "color": "white"
                });
            } else {
                $fieldset.css({
                    "background-color": "white",
                    "color": "black"
                });
            }
        });
        // Handle signature radio buttons
        $(".signature-radio").on("click", function() {
            var $radio = $(this);
            var $fieldset = $radio.closest("fieldset");
            $radio.prop("checked", true);
            // Reset all fieldsets
            $(".signature-fieldset").css({
                "background-color": "white",
                "color": "black"
            });
            // Apply styles to the selected fieldset
            $fieldset.css({
                "background-color": "black",
                "color": "white"
            });
        });
        // Handle signature input change
        $("#signature").on("change", function() {
            const valueSign = $(this).val();
            console.log(valueSign);
            var $signaturesContainer = $("#signatures");
            $signaturesContainer.html('');
            if (valueSign !== '') {
                var html = `
      <div class="row skin skin-line">
        <div class="col-md-6 col-sm-12 mt-2 radio_style">
          <fieldset class="sign signature-fieldset">
            <input required type="radio" name="signatureShw" value="1" class="signature-radio">
            <label for="signature1" style="font-weight: bolder;font-style: oblique">${valueSign}</label>
          </fieldset>
        </div>
        <div class="col-md-6 col-sm-12 mt-2 radio_style">
          <fieldset class="sign signature-fieldset">
            <input required type="radio" name="signatureShw" value="2" class="signature-radio">
            <label for="signature2" style="font-weight: bolder;font-style: oblique">${valueSign}</label>
          </fieldset>
        </div>
        <div class="col-md-6 col-sm-12 mt-2 radio_style">
          <fieldset class="sign signature-fieldset">
            <input required type="radio" name="signatureShw" value="3" class="signature-radio">
            <label for="signature3" style="font-family:monsieur;font-weight: bolder;font-style: oblique">${valueSign}</label>
          </fieldset>
        </div>
        <div class="col-md-6 col-sm-12 mt-2 radio_style">
          <fieldset class="sign signature-fieldset">
            <input required type="radio" name="signatureShw" value="4" class="signature-radio">
            <label for="signature4" style="font-family:monospace;font-weight: bolder;font-style: oblique">${valueSign}</label>
          </fieldset>
        </div>
      </div>`;

                $signaturesContainer.html(html);
            } else {
                $signaturesContainer.html('');
            }
        });

        function AgreementValidation() {
            var name = document.forms.Agreement_Form.Agreement_Name.value;
            var sign = document.forms.Agreement_Form.Agreement_Sign.value;
            var regName = /\d+$/g; // Javascript reGex for Name validation
            if (name === "" || regName.test(name)) {
                window.alert("Please Enter Your Name Properly.");
                name.focus();
                return false;
            }
            if (sign === "" || regName.test(sign)) {
                window.alert("Please Enter Your Signature.");
                address.focus();
                return false;
            }
            $('#deposite_Check').click(function() {
                if (!$(this).is(":checked")) {
                    this.focus();
                    return false;
                }
            });
            return true;
        }
        $('#save_btn').click(function() {

            if (AgreementValidation()) {
                $('#agreement-form').submit();
            }
        });
        // Miscellaneous Script
        $('.other-misc').hide();
        $('.Misc').change(function() {
            const Misc = $(this).val();
            if (Misc === 'Other') {
                $('.other-misc').show();
                $(".other-misc input").prop('required', true);
            } else {
                $('.other-misc').hide();
                $(".other-misc input").prop('required', false);
            }
        });
        // Get Profile Info Functionality For Cancel Request
        $(".cancel-request").click(function() {
            var getListedID = $(this).find('.Listed-ID').val();
            $(".get_Order_ID").html(getListedID);
            $(".get_Listed_ID").val(getListedID);
        });
        // Truck Space ZipCode
        $('.Location_ZipCode.typeahead, .Heading_ZipCode.typeahead, .Destination_ZipCode.typeahead').typeahead({
            source: function(query, process) {
                return $.get(path, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });
        // Reason Cancel Listing
        $('.Reason').hide();
        $('.select-reason').change(function() {
            var selectReason = $(this).val();
            if (selectReason === 'Other') {
                $('.Reason').show();
                $(".select-reason input").prop('required', true);
            } else {
                $('.Reason').hide();
                $(".select-reason input").prop('required', false);
            }
        });
        $(".Cancel_Order").click(function() {
            var getListedID = $(this).find('.Listed-ID').val();
            var getUserID = $(this).find('.User-ID').val();
            var getCMPID = $(this).find('.CMP-ID').val();
            var getOrderStatus = $(this).find('.Order-Status').val();
            $(".get_Order_ID").html(getListedID);
            $(".get_Listed_ID").val(getListedID);
            $(".get_User_ID").val(getUserID);
            $(".get_CMP_ID").val(getCMPID);
            $(".get_Order_Status").val(getOrderStatus);
        });
        // Search Order_ID
        const SearchOrderID = '{{ route('Search.Order.ID') }}';
        $('.Order_ID.typeahead').typeahead({
            source: function(query, process) {
                return $.get(SearchOrderID, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });
        // Compare Listing
        $(document).on('click', '.compare-listing', function() {
            // $('.compare-listing').on('click', function() {
            console.log('fsgfgsd');
            var getListedID = $(this).find('.Listed-ID').val();
            var getListedType = $(this).find('.Listed-Type').val();
            var getListedMiles = $(this).find('.Listed-Miles').val();
            $(".get_Order_ID").html(getListedMiles);
            $(".get_Listed_ID").val(getListedID);
            $(".get_Listed_Miles").val(getListedMiles);
            $.ajax({
                url: '{{ route('Get.All.Comparison.Listing') }}',
                type: 'GET',
                data: {
                    'Listed_ID': getListedID,
                    'Listed_Type': getListedType,
                    'Listed_Miles': getListedMiles
                },
                success: function(data) {
                    $('#all-fetch-comparison').html(data);

                    // $('.carrier-all-request').DataTable();
                },
                error: function(data) {
                    alert(data.responseJSON);
                }
            });
        });
        var input = document.getElementById("check-search-field");
        input.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById("myBtn").click();
            }
        });
        // on change to company name submits a form that shows company history
        $('#Search_Criteria').change(function() {
            if ($('#Search_Criteria').val() == 6) {
                console.log('Search_Criteria');
                $('#hiddenDiv').html('');
            } else {
                $('#hiddenDiv').html(`<input type="text" class="form-control d-none" id="hiddenValue" required>`);
            }
        });

        $(".order-history").click(function() {
            const quoteID = $(this).find('.Listed-ID').val();
            $("#modal-quote-id").val(quoteID);

            $.ajax({
                url: '{{ route('Get.Quote.Status') }}',
                method: 'GET',
                data: {
                    list_id: quoteID
                },
                success: function(response) {
                    // Clear previous content
                    console.log('asdasddsadsa', response);
                    $('#data-container').empty();

                    // Populate data section with a table
                    var html = '<table class="status-table">';
                    html += '<thead>';
                    html += '<tr>';
                    html += '<th>Status</th>';
                    html += '<th>Expected Date</th>';
                    html += '<th>Discription</th>';
                    html += '</tr>';
                    html += '</thead>';
                    html += '<tbody>';
                    $.each(response, function(index, item) {
                        html += '<tr>';
                            html += '<td class="status-text">' + item.history_status + '</td>';
                        html += '<td class="date-text">' + item.expected_date + '</td>';
                        html += '<td class="description-text">' + item.history_description +'</td>';
                        html += '</tr>';
                    });
                    html += '</tbody>';
                    html += '</table>';

                    $('#data-container').html(html);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    console.log('Response Text:', xhr.responseText);
                }
            });
        });

        $(document).ready(function() {
            $('#order-status-form').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                var form = $(this);
                var formData = new FormData(this); // Create a FormData object from the form
                var submitButton = form.find('button[type="submit"]'); // Find the submit button

                // Disable the submit button to prevent multiple submissions
                submitButton.prop('disabled', true);

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: formData,
                    processData: false, // Required for FormData
                    contentType: false, // Required for FormData
                    success: function(response) {
                        // Handle success
                        // console.log('Form submitted successfully:', response);

                        // Close the modal (Bootstrap modal)
                        $('#OrderHistory').modal('hide');
                        location.reload();

                        // Clear the form fields
                        form[0].reset(); // Reset the entire form

                        // Re-enable the submit button
                        submitButton.prop('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error('AJAX Error:', status, error);
                        console.log('Response Text:', xhr.responseText);

                        // Re-enable the submit button
                        submitButton.prop('disabled', false);
                    }
                });
            });
        });

        $(document).on('click', '.load-history', function() {
            var getListedID = $(this).find('.Listed-ID').val();
            var getListedPhone = $(this).find('.Listed-Phone').val();

            $.ajax({
                url: '{{ route('Get.Order.History') }}',
                type: 'GET',
                data: {
                    'Listed_ID': getListedID,
                    'Listed_Phone': getListedPhone,
                },
                success: function(response) {
                    var orders = response.orders;

                    // Build the HTML for the order history
                    var htmlContent = '<table class="table table-bordered">';
                    htmlContent +=
                        '<thead><tr><th>Order ID</th><th>Listing Status</th><th>Customer Name</th><th>Email</th><th>Phone</th><th>Vehicles</th><th>Origin</th><th>Destination</th><th>Book Price</th><th>Created At</th></tr></thead><tbody>';

                    orders.forEach(function(order) {
                        // Format the created_at date
                        var createdAt = new Date(order.created_at).toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: 'short',
                            day: '2-digit',
                        });

                        htmlContent += '<tr>';
                        htmlContent += '<td>' + order.Ref_ID + '</td>';
                        htmlContent += '<td>' + order.Listing_Status + '</td>';
                        htmlContent += '<td>' + order.Customer_Name + '</td>';
                        htmlContent += '<td>' + order.Customer_Email + '</td>';
                        htmlContent += '<td>' + order.Customer_Phone + '</td>';

                        // Vehicles details
                        if (order.vehicles && order.vehicles.length > 0) {
                            htmlContent += '<td style="text-align: center;">'; // Center alignment
                            order.vehicles.forEach(function(vehicle, index) {
                                htmlContent += `<div style="margin-bottom: 10px;">
                                    <a href="https://www.google.com/search?q=${vehicle.Vehcile_Year}%20${vehicle.Vehcile_Make}%20${vehicle.Vehcile_Model}"
                                    target="_blank"
                                    class="font-weight-bold text-dark"
                                    style="text-decoration: none;">
                                    <strong>${vehicle.Vehcile_Year}${vehicle.Vehcile_Make}${vehicle.Vehcile_Model}</strong>
                                    </a>
                                    <br>
                                    <span style="font-size: 16px; font-weight: bold;">
                                        ${vehicle.Vehcile_Condition ? vehicle.Vehcile_Condition : ''}
                                        ${vehicle.Trailer_Type ? vehicle.Trailer_Type : ''}
                                    </span>
                                </div>`;

                                // Add a separator unless it's the last vehicle
                                if (index !== order.vehicles.length - 1) {
                                    htmlContent += '<hr style="border: 1px dashed #ccc;">';
                                }
                            });
                            htmlContent += '</td>';
                        } else {
                            htmlContent += '<td style="text-align: center;">No vehicles found</td>';
                        }
                        htmlContent += '<td>' + order.routes.Origin_ZipCode + '</td>';
                        htmlContent += '<td>' + order.routes.Dest_ZipCode + '</td>';
                        htmlContent += '<td>' + order.paymentinfo.Order_Booking_Price + '</td>';
                        htmlContent += '<td>' + createdAt + '</td>';
                        htmlContent += '</tr>';
                    });

                    htmlContent += '</tbody></table>';

                    // Set the modal content and show the modal
                    $('#orderHistoryContent').html(htmlContent);
                    $('#orderHistoryModal').modal('show');
                },
                error: function(error) {
                    alert('Error fetching history: ' + error.responseJSON.message);
                }
            });
        });
    </script>

</body>

</html>
