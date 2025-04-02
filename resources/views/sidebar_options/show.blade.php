<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/favicon.png') }}">
    <!-- Vendors Min CSS -->
    <link rel="stylesheet" href="{{ asset('backend/css/vendors.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/datatables.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('backend/css/responsive.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}"> --}}
    <title>Day Dispatch - Transportation</title>
    <!--<link rel="icon" type="image/png" href="{{ asset('backend/img/favicon.png') }}">-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/logo/logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <style>
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

        #modalbody {
            display: none;
        }

        .text-primary.font-weight-bold {
            color: #1e2d62;
        }

        @media only screen and (max-width: 1200px) {
            .margin-media-query {
                margin-bottom: 35px;
            }
        }

        .fs-30 {
            font-size: 20px;
            font-size: 20px;
            margin-block: 7px;
            vertical-align: inherit;
        }

        .new-tag {
            background-color: #ff0000;
            color: #ffffff;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .ribbon-box .ribbon-two {
            position: absolute;
            top: -8px;
            z-index: 1;
            overflow: hidden;
            width: 65px;
            height: 67px;
            text-align: right;
            left: -11px;
            clip-path: polygon(13% 0, 116% 0, 0 103%, 0 103%);
            display: block;
        }

        button.ribbon-box {
            border: none;
        }

        .ribbon-box .ribbon-two span {
            font-size: 13px;
            color: #fff;
            text-align: center;
            line-height: 20px;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
            width: 100px;
            display: block;
            -webkit-box-shadow: 0 0 8px 0 rgba(0, 0, 0, .06), 0 1px 0 0 rgba(0, 0, 0, .02);
            box-shadow: 0 0 8px 0 rgba(0, 0, 0, .06), 0 1px 0 0 rgba(0, 0, 0, .02);
            position: absolute;
            top: 19px;
            left: -21px;
            font-weight: 500;
        }

        .ribbon-box .ribbon-two-danger span {
            background: #078528;
        }

        form#searchForm {
            position: relative;
        }

        .ribbon-box.right.ribbon-box .ribbon-two span {
            left: auto;
            right: -21px;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
        }
    </style>

    <!-- Vendors Min JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{ asset('backend/js/vendors.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('backend/js/custom.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/datatable.custom.js') }}"></script>
    {{--     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> --}}
    <!--<script-->
        <!--    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>-->
    <script src="{{ asset('backend/js/RightSideTypehead.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
            <a href="{{ route('User.Dashboard') }}" class="navbar-brand d-flex align-items-center">
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

                <ul class="navbar-nav left-nav align-items-center">
                    <li class="nav-item">
                        <a href="JavaScript:void(0);" target="_blank" class="nav-link"></a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('Filterd.Listing') }}" target="_blank" class="nav-link" data-toggle="tooltip"
                            data-placement="bottom" title="Filter">
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
                    <!-- add new -->
                    <li class="nav-item">
                        <a href="{{ route('task.calendar') }}" target="_blank" class="nav-link"
                            data-toggle="tooltip" data-placement="bottom" title="Task Calender">
                            <i class="fas fa-calendar fa-sm"></i>
                        </a>
                    </li>
                    @php
                        $Check_Status = App\Models\Payments\PaymentSystem::where('id', '=', 6)->find(6);
                        // print_r( $Check_Status);
                    @endphp
                    @if ($Check_Status->Payment_Switch === 0)
                        <li class="nav-item">
                            <a href="{{ route('number.of.login') }}" target="_blank" class="nav-link"
                                data-toggle="tooltip" data-placement="bottom" title="Pay For Seats">
                                <i class="fas fa-chair fa-sm"></i>
                            </a>
                        </li>
                    @endif
                    <!-- end new -->


                    <!--<li class="nav-item dropdown apps-box"> -->
                    <!--    <a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown"-->
                    <!--        aria-haspopup="true" aria-expanded="false">-->
                    <!--        <i class='bx bxs-grid'></i>-->
                    <!--    </a>-->

                    <!--    <div class="dropdown-menu">-->
                    <!--        <div class="dropdown-header d-flex justify-content-between align-items-center">-->
                    <!--            <span class="title d-inline-block">Dispatch To Me</span>-->
                    <!--            <span class="edit-btn d-inline-block">My Dispatching</span>-->
                    <!--        </div>-->

                    <!--        <div class="dropdown-body">-->
                    <!--            <div class="d-flex flex-wrap align-items-center">-->
                    <!--                <a href="{{ route('Time.Qoute') }}" class="dropdown-item">-->
                    <!--                    <span class="d-block mb-0">Time <br>Quote</span>-->
                    <!--                </a>-->

                    <!--                <a href="{{ route('My.Waiting.Approval') }}" class="dropdown-item">-->
                    <!--                    <span class="d-block mb-0">Waiting<br>Approval</span>-->
                    <!--                </a>-->

                    <!--                <a href="{{ route('My.Requested') }}" class="dropdown-item">-->
                    <!--                    <span class="d-block mb-0">Requested <br> To Me</span>-->
                    <!--                </a>-->

                    <!--                <a href="{{ route('My.Dispatched') }}" class="dropdown-item">-->
                    <!--                    <span class="d-block mb-0">Dispatch<br>To Me</span>-->
                    <!--                </a>-->

                    <!--                <a href="{{ route('My.Pickup.Approval') }}" class="dropdown-item">-->
                    <!--                    <span class="d-block mb-0">Pickup<br>Approval</span>-->
                    <!--                </a>-->

                    <!--                <a href="{{ route('My.Pickups') }}" class="dropdown-item">-->
                    <!--                    <span class="d-block mb-0">My<br>Pick Ups</span>-->
                    <!--                </a>-->

                    <!--                <a href="{{ route('My.Deliver.Approval') }}" class="dropdown-item">-->
                    <!--                    <span class="d-block mb-0">Deliver<br>Approval</span>-->
                    <!--                </a>-->

                    <!--                <a href="{{ route('My.Delivers') }}" class="dropdown-item">-->
                    <!--                    <span class="d-block mb-0">My<br>Delivered</span>-->
                    <!--                </a>-->

                    <!--                <a href="{{ route('My.Completed') }}" class="dropdown-item">-->
                    <!--                    <span class="d-block mb-0">My<br>Completed</span>-->
                    <!--                </a>-->

                    <!--                <a href="{{ route('My.Cancelled') }}" class="dropdown-item">-->
                    <!--                    <span class="d-block mb-0">My<br>Cancelled</span>-->
                    <!--                </a>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</li>-->

                    <!--=======  useful link  ====-->
                    <li class="nav-item dropdown apps-box">
                        <a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class='fas fa-link'></i>
                        </a>



                        <div class="dropdown-menu width-imp-style">
                            <div class="dropdown-header d-flex justify-content-between align-items-center">
                                <span class="title d-inline-block">Useful Links</span>
                                <!--<span class="edit-btn d-inline-block">My Dispatching</span>-->
                            </div>

                            <div class="dropdown-body">
                                <div class=" flex-wrap align-items-center">
                                    <!--<a href="https://daydispatch.com/border-wait-time" class="dropdown-item">-->
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
                    <!--=======  useful link  ====-->
                </ul>
                <div class="parentOfSreach">

                    {{-- Company search filter search to new page --}}
                    <form class="nav-search-form d-none ml-auto d-md-block" method="POST"
                        action="{{ route('User.Company.Search') }}">
                        @csrf
                        <label><i class='bx bx-search'></i></label>
                        <input type="text" class="form-control Search-Bar" id="check-search-field"
                            name="Search_Bar" placeholder="Search Company..." value="">
                        <input type="submit" id="myBtn" hidden />
                    </form>
                    {{--  <form action="{{ route('global.search.index') }}" method="GET">
                        <div>
                            <label for="search_query">Search:</label>
                            <input type="text" name="search_query" id="search_query" value="{{ old('search_query', request()->input('search_query')) }}">
                        </div>
                        <div>
                            <label for="search_criteria">Search Criteria:</label>
                            <select class="search-globle-width" name="search_criteria" id="search_criteria">
                                <option value="1" {{ request()->input('search_criteria') == 1 ? 'selected' : '' }}>Order ID</option>
                                <option value="2" {{ request()->input('search_criteria') == 2 ? 'selected' : '' }}>Pickup City</option>
                                <option value="3" {{ request()->input('search_criteria') == 3 ? 'selected' : '' }}>Pickup State</option>
                                <option value="4" {{ request()->input('search_criteria') == 4 ? 'selected' : '' }}>Delivery City</option>
                                <option value="5" {{ request()->input('search_criteria') == 5 ? 'selected' : '' }}>Delivery State</option>
                                <option value="6" {{ request()->input('search_criteria') == 6 ? 'selected' : '' }}>Company Name</option>
                                <option value="7" {{ request()->input('search_criteria') == 7 ? 'selected' : '' }}>Vehicle</option>
                            </select>
                        </div>
                        <button type="submit">Search</button>
                    </form> --}}
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
        <main class="container-fluid">
            <div class="breadcrumb-area">
                <h1>{{ $currentUser->usr_type }} Listing </h1>

                <ol class="breadcrumb">
                    <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a>
                    </li>

                    <li class="item">Listed</li>
                </ol>

            </div>
            <!--  -->
            <div class="card">
                <div class="card-body">
                    <br>

                    {{-- <div class="table-responsive dataTables_wrapper me-0 d-flex">
                            <div class="col-lg-6 col-md-6 col-sm-12"  style="display: flex; align-items: end; column-gap: 14px;">
                               <table>
                                    <tbody class="dataTables_filter">
                                        <tr>
                                          <form class="nav-search-form d-none ml-auto d-md-block" method="POST"
                                                action="{{ route('User.Company.Search') }}">
                                                @csrf
                                                <td><strong>Search For: </strong></td>
                                                <td>
                                                    <select class="form-control ml-1" onchange="myfunc(event)"
                                                        id="Search_Criteria" name="Search_Criteria">
                                                        <option value="1" selected>Order ID</option>
                                                        <option value="2">Pickup City</option>
                                                        <option value="3">Pickup State</option>
                                                        <option value="4">Delivery City</option>
                                                        <option value="5">Delivery State</option>
                                                        <option value="6">Company Name</option>
                                                        <option value="7">Vehicle</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input class="form-control" id="Search_Value"
                                                        placeholder="Enter Search Value" type="search" name="Search_Value">
                                                    <div class="hiddenDiv">
                                                        <input type="text" class="form-control d-none"
                                                            class="hiddenValueinput" required>
                                                    </div>
                                                </td>
                                            </form> 
                                               <table>
                                                <tbody class="dataTables_filter">
                                                    <tr>
                                                        <td><strong>Search Vehicle Type: </strong></td>
                                                        <td>
                                                            <form id="Search_vehicleType_form"
                                                                action="{{ route('User.Listing') }}">
                                                                <select class="form-control ml-1" id="Search_vehicleType"
                                                                    name="Search_vehicleType">
                                                                    <option>Select Vehicle Type</option>
                                                                    <option value="heavy_equipments"
                                                                        @if ($Search_vehicleType == 'heavy_equipments') selected @endif>Heavy
                                                                        Equipments</option>
                                                                    <option value="vehicles"
                                                                        @if ($Search_vehicleType == 'vehicles') selected @endif>
                                                                        Vehicles(Autos)</option>
                                                                    <option value="dry_vans"
                                                                        @if ($Search_vehicleType == 'dry_vans') selected @endif>Freight
                                                                        Shipping</option>
                                                                </select>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <table>
                                    <tbody class="dataTables_filter">
                                        <tr>
                                            <td><strong>Time Frame: </strong></td>
                                            <td>
                                                <select class="form-control ml-1" id="Time_Frame" name="Time_Frame">
                                                    <option value="1" selected>EveryThing</option>
                                                    <option value="2">03 Months</option>
                                                    <option value="3">06 Months</option>
                                                    <option value="4">01 Year</option>
                                                    <option value="5">03 Years</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> --}}
                    <div class="table-responsive">
                        <table class="display dataTable advance-6 datatable-range text-center w-100">
                            <thead>
                                <tr>
                                    <th>Routes</th>
                                    <th>Load Details</th>
                                    <th>Ref. / Dist</th>
                                    <th>Customer / Payments</th>
                                    <th>Dates</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sidebarOptions = App\Models\SidebarOption::pluck('name')->all();

                                    $quote_listing = App\Models\Quote\Order::with(
                                        'authorized_user',
                                        'paymentinfo',
                                        'additional_info',
                                        'pickup_delivery_info',
                                        'vehicles',
                                    )
                                        ->where('user_id', Auth::guard('Authorized')->user()->id)
                                        ->whereIn('Listing_Status', $sidebarOptions)
                                        ->whereNull('deleted_at')
                                        ->get();

                                @endphp
                                <!-- Show Qoute Listing -->
                                @foreach ($quote_listing as $List)
                                    <tr>
                                        <td>
                                            @php
                                                $createdAt = \Carbon\Carbon::createFromFormat(
                                                    'Y-m-d H:i:s',
                                                    $List->getRawOriginal('created_at'),
                                                );
                                            @endphp
                                            @if ($createdAt->gte(\Carbon\Carbon::now()->subHours(12)) && $createdAt->lte(\Carbon\Carbon::now()))
                                                {{-- <form id="searchForm" action="{{ route('global.search.index') }}" method="GET">
                                                        <input type="hidden" id="new_listing" name="new_listing" value="new">
                                                        <button type="submit">
                                                            <div class="ribbon-two ribbon-two-danger">
                                                                <span>New</span>
                                                            </div>
                                                        </button>
                                                    </form> --}}
                                                <form id="searchForm" action="{{ route('global.search.index') }}"
                                                    method="GET">
                                                    <input type="hidden" id="new_listing" name="new_listing"
                                                        value="new">
                                                    <button type="submit" class="ribbon-box">
                                                        <div class="ribbon-two ribbon-two-danger">
                                                            <span>New</span>
                                                        </div>
                                                    </button>
                                                </form>
                                            @endif
                                            <a class="dropdown-item"
                                                href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                target="_blank">View Route</a>
                                            {{-- <i class="fas fa-map-marker-alt text-success fs-30"></i> --}}
                                            <a href="https://www.google.com/maps/place/{{ urlencode($List->routes->Origin_ZipCode) }}"
                                                target="_blank">
                                                {{ Str::replace(',', '-', $List->routes->Origin_ZipCode) }}
                                            </a><br>
                                            {{-- <i class="fas fa-map-marker-alt text-danger fs-30"></i> --}}
                                            <a href="https://www.google.com/maps/place/{{ urlencode($List->routes->Dest_ZipCode) }}"
                                                target="_blank">
                                                {{ Str::replace(',', '-', $List->routes->Dest_ZipCode) }}
                                            </a>
                                        </td>
                                        <td>
                                            @if (count($List->vehicles) === 1)
                                                @foreach ($List->vehicles as $vehcile)
                                                    <a href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                        target="_blank"> {{ $vehcile->Vehcile_Year }}
                                                        {{ $vehcile->Vehcile_Make }}
                                                        {{ $vehcile->Vehcile_Model }}</a><br>
                                                    @if (!empty($vehcile->Vehcile_Condition))
                                                        <span
                                                            class="text-danger font-weight-bold">{{ $vehcile->Vehcile_Condition }}</span><br>
                                                    @endif
                                                    @if (!empty($vehcile->Trailer_Type))
                                                        <span
                                                            class="text-primary font-weight-bold">{{ $vehcile->Trailer_Type }}</span>
                                                        <br>
                                                        {{-- <span @if ($vehcile->Trailer_Type == '"(Enclosed Trailer Required)"') class="text-primary font-weight-bold" @endif>{{ $vehcile->Trailer_Type }}</span> <br> --}}
                                                    @endif
                                                @endforeach
                                            @endif
                                            @if (count($List->vehicles) > 1)
                                                <a href="javascript:void(0)" tabindex="0" class=""
                                                    data-toggle="popover" data-trigger="focus"
                                                    style="cursor: pointer;" title="Attached vehicles"
                                                    data-content=
                                                    "@foreach ($List->vehicles as $vehcile)
                                                    <a href='https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}'
                                                    target='_blank'> {{ $vehcile->Vehcile_Year }}
                                                    {{ $vehcile->Vehcile_Make }}
                                                    {{ $vehcile->Vehcile_Model }}</a><br>
                                                    @if (!empty($vehcile->Vehcile_Condition))
                                                        <span class='text-danger font-weight-bold'>{{ $vehcile->Vehcile_Condition }}<br></span>
                                                    @endif
                                                    @if (!empty($vehcile->Trailer_Type))
                                                        <span @if ($vehcile->Trailer_Type == "'(Enclosed Trailer Required)'") class='text-primary font-weight-bold' @endif>{{ $vehcile->Trailer_Type }}</span> <br>
                                                    @endif @endforeach"
                                                    data-html="true">vehicles ({{ count($List->vehicles) }})
                                                </a>
                                            @endif
                                            @if (count($List->heavy_equipments) === 1)
                                                @foreach ($List->heavy_equipments as $vehcile)
                                                    {{ $vehcile->Equipment_Year }}
                                                    {{ $vehcile->Equipment_Make }}
                                                    {{ $vehcile->Equipment_Model }}<br>
                                                    <b>L</b>{{ $vehcile->Equip_Length }} |
                                                    <b>W</b>{{ $vehcile->Equip_Width }} |
                                                    <b>H</b>{{ $vehcile->Equip_Height }}
                                                    | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                                    @if (!empty($vehcile->Equipment_Condition) && !empty($vehcile->Shipment_Preferences))
                                                        <br>{{ $vehcile->Equipment_Condition }} |
                                                        {{ $vehcile->Shipment_Preferences }}<br>
                                                    @endif
                                                    @if (!empty($vehcile->Trailer_Type))
                                                        <span
                                                            @if ($vehcile->Trailer_Type == '"(Enclosed Trailer Required)"') class="text-primary font-weight-bold" @endif>{{ $vehcile->Trailer_Type }}</span>
                                                    @endif
                                                @endforeach
                                            @endif
                                            @if (count($List->heavy_equipments) > 1)
                                                <a href="javascript:void(0)" tabindex="0" class=""
                                                    data-toggle="popover" data-trigger="focus"
                                                    style="cursor: pointer;" title="Attached vehicles"
                                                    data-content=
                                                    "@foreach ($List->heavy_equipments as $vehcile)
                                                    {{ $vehcile->Equipment_Year }}
                                                    {{ $vehcile->Equipment_Make }}
                                                    {{ $vehcile->Equipment_Model }}<br>
                                                        <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} | <b>H</b>{{ $vehcile->Equip_Height }} | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                                    @if (!empty($vehcile->Equipment_Condition) && !empty($vehcile->Shipment_Preferences))
                                                        <br>{{ $vehcile->Equipment_Condition }} | {{ $vehcile->Shipment_Preferences }}<br>
                                                    @endif
                                                    @if (!empty($vehcile->Trailer_Type))
                                                        <span @if ($vehcile->Trailer_Type == "'(Enclosed Trailer Required)'") class='text-primary font-weight-bold' @endif>{{ $vehcile->Trailer_Type }}</span>
                                                    @endif @endforeach"
                                                    data-html="true">vehicles ({{ count($List->heavy_equipments) }})
                                                </a>
                                            @endif
                                            @if (count($List->dry_vans) === 1)
                                                @foreach ($List->dry_vans as $vehcile)
                                                    <!--<span title="Freight Class">{{ $vehcile->Freight_Class }}</span>-->
                                                    <!--<span title="Freight Weight">{{ $vehcile->Freight_Weight }}</span>-->
                                                    <span title="Freight Class">
                                                        <a href="javascript:void(0)" tabindex="0" class=""
                                                            data-toggle="popover" data-trigger="focus"
                                                            style="cursor: pointer;" title="Freight Class"
                                                            data-html="true">
                                                            {{ $vehcile->Freight_Class }}
                                                        </a>
                                                    </span>
                                                    <span title="Freight Weight">

                                                        <a href="javascript:void(0)" tabindex="0" class=""
                                                            data-toggle="popover" data-trigger="focus"
                                                            style="cursor: pointer;" title="Freight Weight"
                                                            data-html="true">{{ $vehcile->Freight_Weight }}
                                                        </a>
                                                    </span>
                                                    <b>LBS</b><br>
                                                    @if ($vehcile->is_hazmat_Check !== 0)
                                                        Hazmat Required<br>
                                                    @endif
                                                @endforeach
                                            @endif
                                            @if (count($List->dry_vans) > 1)
                                                <a href="javascript:void(0)" tabindex="0" class=""
                                                    data-toggle="popover" data-trigger="focus"
                                                    style="cursor: pointer;" title="Attached vehicles"
                                                    data-content=
                                                    "@foreach ($List->dry_vans as $vehcile)
                                                    <span title='Freight Class'>{{ $vehcile->Freight_Class }}</span>
                                                    <span title='Freight Weight'>{{ $vehcile->Freight_Weight }}</span> <b>LBS</b><br>
                                                    @if ($vehcile->is_hazmat_Check !== 0)
                                                        Hazmat Required<br>
                                                    @endif @endforeach"
                                                    data-html="true">vehicles ({{ count($List->dry_vans) }})
                                                </a>
                                            @endif
                                            <br>
                                            <a href="javascript:void(0)" tabindex="0" class=""
                                                data-toggle="popover" data-trigger="focus" style="cursor: pointer;"
                                                title="Additional Terms"
                                                data-content=
                                                "{{ !empty($List->additional_info->Additional_Terms) ? $List->additional_info->Additional_Terms : '' }}">
                                                {{ !empty($List->additional_info->Additional_Terms) ? Str::limit($List->additional_info->Additional_Terms, 20) : '...' }}</a>
                                        </td>
                                        <td>
                                            <!--  -->
                                            <strong>Ref-ID:</strong>{{ $List->Ref_ID }} <br>
                                            {{ $List->routes->Miles }} miles <br>
                                            $
                                            {{ DayDispatchHelper::PricePerMiles($List->paymentinfo->Price_Pay_Carrier, $List->routes->Miles) }}
                                            /miles
                                        </td>
                                        <td>
                                            <strong>Price to Pay: </strong><span> $
                                                {{ $List->paymentinfo->Price_Pay_Carrier }}</span><br>
                                            @if ($List->paymentinfo->COD_Amount === '0')
                                                {{-- <strong>Balance Amount: </strong>
                                                    {{ $List->paymentinfo->Balance_Amount }}<br>
                                                    <strong>Pay Mode: </strong>
                                                    {{ $List->paymentinfo->Bal_Method_Mode }}<br> --}}
                                            @else
                                                <strong>
                                                    @if ($List->paymentinfo->COD_Location_Amount == 'PickUp')
                                                        PickUp
                                                    @else
                                                        Delivery
                                                    @endif
                                                    Amount:
                                                </strong>
                                                <span>${{ $List->paymentinfo->COD_Amount }}</span><br>
                                                <strong>Pay Mode: </strong>
                                                {{ $List->paymentinfo->COD_Method_Mode }}<br>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>Pickup Date: </strong><br>
                                            ({{ $List->pickup_delivery_info->Pickup_Date_mode }})
                                            {{ $List->pickup_delivery_info->Pickup_Date }}
                                            @if (!is_null($List->pickup_delivery_info->Pickup_Start_Time))
                                                <br>
                                                {{ \Carbon\Carbon::parse($List->pickup_delivery_info->Pickup_Start_Time)->format('g:i A') . ' - ' . \Carbon\Carbon::parse($List->pickup_delivery_info->Pickup_End_Time)->format('g:i A') }}
                                            @endif
                                            <br>
                                            <strong>Deliver Date: </strong><br>
                                            ({{ $List->pickup_delivery_info->Delivery_Date_mode }})
                                            {{ $List->pickup_delivery_info->Delivery_Date }}
                                            @if (!is_null($List->pickup_delivery_info->Delivery_Start_Time))
                                                <br>
                                                {{ \Carbon\Carbon::parse($List->pickup_delivery_info->Delivery_Start_Time)->format('g:i A') . ' - ' . \Carbon\Carbon::parse($List->pickup_delivery_info->Delivery_End_Time)->format('g:i A') }}
                                            @endif
                                            <br>
                                            <strong>Modify Date: </strong><br>
                                            {{ $List->updated_at }}
                                        </td>
                                        <td>
                                            <h6>Status: <span
                                                    class="badge badge-primary">{{ $List->Listing_Status }}</span>
                                            </h6>
                                            <!-- <a href="{{ route('User.Watchlist.store', $List->id) }}">
                                                    @if ($List->authorized_user->my_watch_check($List->id) !== null)
                                                <i class="fa fa-heart" aria-hidden="true"
                                                                                                            title="Remove from Watch List"></i>
                                                @else
                                                <i class="fa-regular fa-heart" title="Add to Watch List"></i>
                                                @endif
                                                </a><br> -->
                                            <!-- <br> -->
                                            <strong>Expired Date: </strong><br>
                                            {{ $List->expire_at }}
                                            <div class="dropdown show list-actions">
                                                <a class="btn btn-success dropdown-toggle btn-sm" href="#"
                                                    role="button" data-toggle="dropdown" aria-haspopup="true">
                                                    Actions
                                                </a>

                                                {{--   <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                           href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                           target="_blank">View Route</a>
                                                        @if ($List->user_id === $currentUser->id)
                                                            <a class="dropdown-item"
                                                               href="{{ route('User.Listing.Restore', ['List_ID' => $List->id]) }}">Restore
                                                                Listing</a>
                                                        @endif
                                                    </div>
                                                    --}}
                                                <div class="dropdown-menu">
                                                    {{-- <a class="dropdown-item"
                                                    href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                    target="_blank">View Route</a> --}}

                                                    <!--<div ></div>-->
                                                    <a onclick="request_load_click({{ $List->id }})"
                                                        id="{{ $List->id }}" class="dropdown-item request-load"
                                                        data-toggle="modal" data-target="#CarrierRequestLoad"
                                                        href="javascript:void(0);">
                                                        <input hidden type="text" class="Listed-Ref-ID"
                                                            value="{{ $List->Ref_ID }}">
                                                        <input hidden type="text" class="Listed-ID"
                                                            value="{{ $List->id }}">
                                                        <input hidden type="text" class="Listed-Price"
                                                            value="{{ (int) Str::replace(['$ ', ','], '', $List->paymentinfo->Price_Pay_Carrier) }}">
                                                        <input hidden type="text" class="Pickup-Date"
                                                            value="{{ $List->pickup_delivery_info->Pickup_Date }}">
                                                        <input hidden type="text" class="Deliver-Date"
                                                            value="{{ $List->pickup_delivery_info->Delivery_Date }}">
                                                        Bid / Request Load</a>

                                                    <a class="dropdown-item compare-listing" data-toggle="modal"
                                                        data-target="#CompareListing" href="javascript:void(0);">
                                                        <input hidden type="text" class="Listed-ID"
                                                            value="{{ $List->id }}">
                                                        <input hidden type="text" class="Listed-Type"
                                                            value="{{ $List->Listing_Type }}">
                                                        <input hidden type="text" class="Listed-Miles"
                                                            value="{{ $List->routes->Miles }}">
                                                        Compare Listing</a>

                                                    @if ($currentUser->usr_type === 'Broker')
                                                        <a class="dropdown-item all-requests" data-toggle="modal"
                                                            data-target="#CarrierRequests" href="javascript:void(0);">
                                                            <input hidden type="text" class="Listed-ID"
                                                                value="{{ $List->id }}">
                                                            Request

                                                        </a>

                                                        <a class="dropdown-item request-carrier" data-toggle="modal"
                                                            data-target="#requestCarrier" href="javascript:void(0);">
                                                            <input hidden type="text" class="Listed-ID"
                                                                value="{{ $List->id }}">
                                                            <input hidden type="text" class="Listed-Ref-ID"
                                                                value="{{ $List->Ref_ID }}">
                                                            Request Carrier</a>
                                                    @endif

                                                    @if ($List->user_id === $currentUser->id)
                                                        <a class="dropdown-item"
                                                            href="{{ route('Edit.Quote', ['List_ID' => $List->id]) }}">Edit
                                                            Listing</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('User.Dispatch.Listing', ['List_ID' => $List->id]) }}">Assign
                                                            Listing</a>



                                                        <a class="dropdown-item"
                                                            href="{{ route('User.Listing.Archive', ['List_ID' => $List->id]) }}">Archive
                                                            Order</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('User.Listing.Delete', ['List_ID' => $List->id]) }}">Delete
                                                            Order</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- End Qoute Listing -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--  -->
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
                                            <option value="{{ $Misc->Misc_Items }}">{{ $Misc->Misc_Items }}
                                            </option>
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



    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
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
                    url: '{{ route('Get.Order.Counts') }}',
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            $('#Side-Bar-Menu').html(response
                                .html); // Insert the retrieved HTML into the target element
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
    </script>

</body>

</html>
