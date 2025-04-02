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
    <title>Day Dispatch - Transportation</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/logo/logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .top-navbar.navbar .nav-item .nav-link.verify-user {
            font-size: 22px;
            position: relative;
            cursor: pointer;
            top: 3px;
            margin-right: 5px;
        }
        .disabled-link {
            pointer-events: none;
            opacity: 0.5;
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
            top: 17%;
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

        .dropbtn {
            border-radius: 30px;
            background-color: #1e2d62;
            color: white;
            padding: 8px 50px;
            font-size: 16px;
            border: none;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }

        .star-rating {
            display: flex;
            justify-content: center ;
            font-size: 25px;
            direction: rtl;
            /* z-index: 2; */
            /* This reverses the order for proper star rating appearance */
        }

        .star-rating input[type="radio"] {
            display: none;
            /* Hide the radio buttons */
        }

        .star-rating label {
            color: #ccc;
            /* Gray color for unselected stars */
            cursor: pointer;
        }

        .star-rating input[type="radio"]:checked~label {
            color: #ffcc00;
            /* Gold color for selected stars */
        }

        .star-rating label:hover,
        .star-rating label:hover~label {
            color: #ffcc00;
            /* Change color on hover */
        }

        .star-rating input[type="radio"]:checked+label {
            color: #ffcc00;
            /* Change color of the checked star */
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="{{ asset('backend/js/vendors.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script src="{{ asset('backend/js/datatable.custom.js') }}"></script>
    <script src="{{ asset('backend/js/custom.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/datatable.custom.js') }}"></script>
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
    {{-- <div class="sidemenu-area toggle-sidemenu-area" style="overflow: auto;">
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
    </div> --}}
    <!-- End Sidemen Area -->
    <!-- Start Main Content Wrapper Area -->
    <div class="container-fluid d-flex flex-column">
        <!-- Top Navbar Area -->
        @include('partials.nav-bar-new')
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
        <main class="container-fluid mx-0">
            @yield('content')
        </main>
        <!-- Start Footer End -->
        <footer class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 col-sm-6 col-md-6">
                    <p>Copyright <i class='bx bx-copyright'></i> (2020 - {{ date('Y') }}) <a
                            href="{{ url('') }}">Day Dispatch</a>. All rights reserved
                    </p>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 text-right">
                    <p>Designed with ❤️ by <a href="{{ url('') }}" target="_blank">Day Dispatch</a></p>
                </div>
            </div>
        </footer>
        <div class="toast toast-error" aria-live="assertive" style="display: block; opacity: 0.00044405;">
            <div class="toast-message text-dark">An error occurred while archiving your order. Please try again later.
            </div>
        </div>
        {{-- <div class="toast toast-error" aria-live="assertive"
        style="display: block; opacity: 1; position: fixed; top: 20px; right: 20px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); z-index: 1055;">
            <div class="toast-message text-dark" style="padding: 10px 15px; font-size: 14px; line-height: 1.5;">
                An error occurred while archiving your order. Please try again later.
            </div>
        </div>         --}}
        <!-- End Footer End -->
    </div>
    <!-- End Main Content Wrapper Area -->

    <!-- Add Account Modal -->
    <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAccountModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @php
                    $User_Roles = App\Models\LoadboardRole::orderBy('id', 'ASC')->get();
                    $accounts = App\Models\Auth\AuthorizedUsers::where(
                        'owner_id',
                        Auth::guard('Authorized')->user()->id,
                    )->get();
                @endphp
                <div class="modal-body">
                    <div class="global-search-area mx-5 mb-3 z-0">
                        <div class="d-table">
                            <div class="d-table-cell">
                                <div class="search-form">
                                    <h2>Add Account</h2>
                                    <form action="{{ route('Auth.Reg.User') }}" method="POST" class="">
                                        @csrf
                                        <input type="hidden" name="owner_id"
                                            value="{{ Auth::guard('Authorized')->user()->id }}">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12"></div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <select id="Roles" class="form-control" name="User_Type"
                                                        data-live-search="true" title="Select Role" required>
                                                        @forelse($User_Roles as $role)
                                                            <option value="{{ $role->name }}">{{ $role->name }}
                                                            </option>
                                                        @empty
                                                            <option value="">Select AnyOne</option>
                                                        @endforelse
                                                    </select>
                                                    <span class="label-title"><i class='bx bx-building'></i></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12"></div>

                                            {{-- <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <input type="text" id="Company_USDot" class="form-control"
                                                        name="Company_USDot" maxlength="8"
                                                        placeholder="USDOT Number" autocomplete="off" required>
                                                    <span class="label-title"><i class='bx bx-file'></i></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <input type="text" id="Mc_Number" class="form-control"
                                                        name="Mc_Number" maxlength="8" placeholder="MC Number"
                                                        autocomplete="off" required>
                                                    <span class="label-title"><i class='bx bx-file'></i></span>
                                                </div>
                                            </div> --}}

                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="Agent_Name"
                                                        maxlength="40" placeholder="User Name" autocomplete="off" required>
                                                    <span class="label-title"><i class='bx bx-building'></i></span>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <input type="email" class="form-control" name="Company_Email"
                                                        maxlength="50" placeholder="Login Email" autocomplete="off"
                                                        required>
                                                    <span class="label-title"><i class='bx bx-envelope'></i></span>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <input id="user_password" type="password" class="form-control"
                                                        name="Company_Password" placeholder="Password"
                                                        onkeyup="match_password()" required>
                                                    <span class="label-title"><i class='bx bx-lock'></i></span>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <input id="user_password2" type="password" class="form-control"
                                                        name="password_confirmation" placeholder="Confirm Password"
                                                        onkeyup="match_password()" required>
                                                    <span class="label-title"><i class='bx bx-lock'></i></span>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control phone-number"
                                                        name="Contact_Phone" maxlength="14"
                                                        placeholder="Phone Number" autocomplete="off"
                                                        onkeypress="return onlyNumberKey(evnt)" required>
                                                    <span class="label-title"><i class='bx bx-phone'></i></span>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <select class="form-control" name="Company_Country"
                                                        data-live-search="true" title="Select Country" required>
                                                        <option value="United State America (USA)">United State America
                                                            (USA)</option>
                                                        <option value="Mexico">Mexico</option>
                                                        <option value="Canada">Canada</option>
                                                    </select>
                                                    <span class="label-title"><i class='bx bx-building'></i></span>
                                                </div>
                                            </div>

                                            {{-- <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <select class="form-control" name="Company_State"
                                                        data-live-search="true" title="Select State" required>
                                                        <option selected="" disabled="" value="default">State
                                                        </option>
                                                        <option value="AL">Alabama</option>
                                                        <option value="AK">Alaska</option>
                                                        <option value="AZ">Arizona</option>
                                                        <option value="AR">Arkansas</option>
                                                        <option value="CA">California</option>
                                                        <option value="CO">Colorado</option>
                                                        <option value="CT">Connecticut</option>
                                                        <option value="DE">Delaware</option>
                                                        <option value="FL">Florida</option>
                                                        <option value="GA">Georgia</option>
                                                        <option value="HI">Hawaii</option>
                                                        <option value="ID">Idaho</option>
                                                        <option value="IL">Illinois</option>
                                                        <option value="IN">Indiana</option>
                                                        <option value="IA">Iowa</option>
                                                        <option value="KS">Kansas</option>
                                                        <option value="KY">Kentucky</option>
                                                        <option value="LA">Louisiana</option>
                                                        <option value="ME">Maine</option>
                                                        <option value="MD">Maryland</option>
                                                        <option value="MA">Massachusetts
                                                        </option>
                                                        <option value="MI">Michigan</option>
                                                        <option value="MN">Minnesota</option>
                                                        <option value="MS">Mississippi</option>
                                                        <option value="MO">Missouri</option>
                                                        <option value="MT">Montana</option>
                                                        <option value="NE">Nebraska</option>
                                                        <option value="NV">Nevada</option>
                                                        <option value="NH">New Hampshire
                                                        </option>
                                                        <option value="NJ">New Jersey</option>
                                                        <option value="NM">New Mexico</option>
                                                        <option value="NY">New York</option>
                                                        <option value="NC">North Carolina
                                                        </option>
                                                        <option value="ND">North Dakota</option>
                                                        <option value="OH">Ohio</option>
                                                        <option value="OK">Oklahoma</option>
                                                        <option value="OR">Oregon</option>
                                                        <option value="PA">Pennsylvania</option>
                                                        <option value="RI">Rhode Island</option>
                                                        <option value="SC">South Carolina
                                                        </option>
                                                        <option value="SD">South Dakota</option>
                                                        <option value="TN">Tennessee</option>
                                                        <option value="TX">Texas</option>
                                                        <option value="UT">Utah</option>
                                                        <option value="VT">Vermont</option>
                                                        <option value="VA">Virginia</option>
                                                        <option value="WA">Washington</option>
                                                        <option value="DC">Washington DC
                                                        </option>
                                                        <option value="WV">West Virginia
                                                        </option>
                                                        <option value="WI">Wisconsin</option>
                                                        <option value="WY">Wyoming</option>
                                                    </select>
                                                    <span class="label-title"><i class='bx bx-building'></i></span>
                                                </div>
                                            </div> --}}
                                            {{-- <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="Company_City"
                                                        maxlength="40" placeholder="City Name" autocomplete="off"
                                                        onkeypress="return /^[a-zA-Z\s]*$/g.test(event.key)" required>
                                                    <span class="label-title"><i class='bx bxs-city'></i></span>
                                                </div>
                                            </div> --}}

                                            {{-- <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="Company_Name"
                                                        maxlength="40" placeholder="Company Name" autocomplete="off"
                                                        onkeypress="return /^[a-zA-Z\s]*$/g.test(event.key)" required>
                                                    <span class="label-title"><i class='bx bx-building'></i></span>
                                                </div>
                                            </div> --}}


                                            {{-- <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <input id="Business_Licence" type="text" class="form-control"
                                                        name="Business_Licence" maxlength="8"
                                                        placeholder="Business Licence" autocomplete="off">
                                                    <span class="label-title"><i class='bx bx-file'></i></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="ref_code"
                                                        maxlength="15"
                                                        placeholder="Agent/Dispatcher Referral Code (Optional)"
                                                        autocomplete="off">
                                                    <span class="label-title"><i
                                                            class='bx bx-git-repo-forked'></i></span>
                                                </div>
                                            </div> --}}
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="Company_Address"
                                                        maxlength="100" placeholder="Complete Address"
                                                        autocomplete="off" required>
                                                    <span class="label-title"><i class='bx bx-home'></i></span>
                                                </div>
                                            </div>

                                            <button type="submit" class="search-btn">Add</button>
                                        </div>
                                    </form>
                                    <table
                                        class="display dataTable advance-6677 text-center table-striped table-1 table-bordered table-cards"
                                        id="accountsTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Role</th>
                                                <th>User Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Status</th>
                                                {{-- <th>Actions</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($accounts as $index => $account)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $account->usr_type }}</td>
                                                    <td>{{ $account->name }}</td>
                                                    <td>
                                                        {{ $account->email }}
                                                        @if ($account->is_email_verified == 1)
                                                            <span class="text-success ms-2">
                                                                <i class="fas fa-check-circle"></i>
                                                            </span>
                                                        @else
                                                            <span class="text-danger ms-2">
                                                                <i class="fas fa-times-circle"></i>
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $account->Contact_Phone }}</td>
                                                    <td>
                                                        <span
                                                            class="badge {{ $account->is_active ? 'bg-success' : 'bg-danger' }}">
                                                            {{ $account->is_active ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </td>
                                                    {{-- <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input toggle-status"
                                                                type="checkbox" id="statusSwitch{{ $account->id }}"
                                                                data-id="{{ $account->id }}"
                                                                {{ $account->is_active ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="statusSwitch{{ $account->id }}">
                                                                {{ $account->is_active ? 'Active' : 'Inactive' }}
                                                            </label>
                                                        </div>
                                                    </td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
    <!-- Add Miscellaneous -->
    <div class="modal fade" id="ShowMisc" data-backdrop="true" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Show Miscellaneous For Current Order. <span class="get_Order_ID"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body user-settings-box show-all-misc">
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
    <!-- Cancel Waiting Order Modal -->
    <div class="modal fade" id="CancelWaitingOrderModal" data-backdrop="true" role="dialog" aria-hidden="true">
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
                    <form action="{{ route('User.Cancel.Request') }}" method="POST" class="was-validated">
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
                                            <input type="time" class="form-control departs"
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
                                            <input type="time" class="form-control departs"
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
                                            <input type="time" class="form-control departs" name="Truck_Departs"
                                                required>
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


    <!-- Rating Order Modal -->
    <div class="modal fade" id="RatingOrderModal" data-backdrop="true" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h3 class="modal-title">Overall Rating For Order IDsss: <span class="get_Order_ID"></span></h3>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3 text-center">
                    <p class="text-muted text-justify">By submitting a rating you declare that you have conducted
                        business
                        with the rated
                        company. Otherwise, your subscription and/or rating privileges may be suspended.

                        In the event of an inquiry by a rated company, proof of a business relationship may be
                        requested. <strong>Please keep your transaction documents secure and
                            accessible.</strong></p>
                    <div id="rate-stats">
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="new-user-box stats-box" id="positive-rate" style="cursor: pointer">
                                    <div class="icon" style="margin-bottom: 22px;">
                                        <i class="fa-regular fa-lg fa-face-smile"></i>
                                    </div>
                                    {{-- <span class="sub-text font-weight-bold positive-span">Positive</span> --}}
                                    <button type="button" class="btn btn-success" id="">Positive
                                    </button>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="upcoming-product-box stats-box" id="neutral-rate"
                                    style="cursor: pointer">
                                    <div class="icon" style="margin-bottom: 22px;">
                                        <i class="fa-regular fa-lg fa-face-frown-open"></i>
                                    </div>
                                    {{-- <span class="sub-text font-weight-bold neutral-span">Neutral</span> --}}
                                    <button type="button" class="btn btn-primary" id="">Neutral
                                    </button>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="new-product-box stats-box" id="negative-rate" style="cursor: pointer">
                                    <div class="icon" style="margin-bottom: 22px;">
                                        <i class="fa-regular fa-lg fa-face-frown"></i>
                                    </div>
                                    {{-- <span class="sub-text font-weight-bold negative-span">Negative</span> --}}
                                    <button type="button" class="btn btn-danger">Negative
                                    </button>
                                </div>
                            </div>
                            <div class="user-settings-box" id="comments">
                                <form action="{{ route('View.Profile.Post.Ratings') }}" id="ratingForm"
                                    method="POST" class="was-validated p-3">
                                    @csrf
                                    <div class="row ">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Timeliness</label>
                                                <div class="star-rating">
                                                    <input type="radio" id="star5" name="Timeliness"
                                                        class="timelinessValue" value="5">
                                                    <label class="fs-1" for="star5">&#9733;</label>

                                                    <input type="radio" id="star4" name="Timeliness"
                                                        class="timelinessValue" value="4">
                                                    <label class="fs-1" for="star4">&#9733;</label>

                                                    <input type="radio" id="star3" name="Timeliness"
                                                        class="timelinessValue" value="3">
                                                    <label class="fs-1" for="star3">&#9733;</label>

                                                    <input type="radio" id="star2" name="Timeliness"
                                                        class="timelinessValue" value="2">
                                                    <label class="fs-1" for="star2">&#9733;</label>

                                                    <input type="radio" id="star1" name="Timeliness"
                                                        class="timelinessValue" value="1">
                                                    <label class="fs-1" for="star1">&#9733;</label>
                                                </div>
                                                <div class="invalid-feedback">Select Timeliness</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Communication</label>
                                                <div class="star-rating">
                                                    <input type="radio" id="communication5" name="Communication"
                                                        value="5">
                                                    <label class="fs-1" for="communication5">&#9733;</label>

                                                    <input type="radio" id="communication4" name="Communication"
                                                        value="4">
                                                    <label class="fs-1" for="communication4">&#9733;</label>

                                                    <input type="radio" id="communication3" name="Communication"
                                                        value="3">
                                                    <label class="fs-1" for="communication3">&#9733;</label>

                                                    <input type="radio" id="communication2" name="Communication"
                                                        value="2">
                                                    <label class="fs-1" for="communication2">&#9733;</label>

                                                    <input type="radio" id="communication1" name="Communication"
                                                        value="1">
                                                    <label class="fs-1" for="communication1">&#9733;</label>
                                                </div>
                                                <div class="invalid-feedback">Select Communication</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Documentation</label>
                                                <div class="star-rating">
                                                    <input type="radio" id="documentation5" name="Documentation"
                                                        value="5">
                                                    <label class="fs-1" for="documentation5">&#9733;</label>

                                                    <input type="radio" id="documentation4" name="Documentation"
                                                        value="4">
                                                    <label class="fs-1" for="documentation4">&#9733;</label>

                                                    <input type="radio" id="documentation3" name="Documentation"
                                                        value="3">
                                                    <label class="fs-1" for="documentation3">&#9733;</label>

                                                    <input type="radio" id="documentation2" name="Documentation"
                                                        value="2">
                                                    <label class="fs-1" for="documentation2">&#9733;</label>

                                                    <input type="radio" id="documentation1" name="Documentation"
                                                        value="1">
                                                    <label class="fs-1" for="documentation1">&#9733;</label>
                                                </div>
                                                <div class="invalid-feedback">Select Documentation</div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Comments</label>
                                            <textarea rows="3" name="Rating_Comments" id="Rating_Comments" placeholder="Enter Comments"
                                                class="form-control"></textarea>
                                            <div class="invalid-feedback">
                                                Reason Required to Submit this Rating.
                                            </div>
                                        </div>
                                        <input hidden type="text" id="Ratings" name="Rating" value="">
                                        <input hidden type="text" name="get_Listed_ID" class="get_Listed_ID"
                                            value="">
                                        <input hidden type="text" name="get_Profile_ID" class="get_Profile_ID"
                                            value="">
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="btn-box">
                                            <button type="submit" class="submit-btn w-100"><i
                                                    class='bx bx-save'></i>
                                                Save Rating
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <p class="small text-muted"><i class="fa fa-question-circle"></i>
                            To update the comments, remove the rating and re-submit.</p>
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
                        <input hidden type="text" name="get_Listed_Miles" class="get_Listed_Miles"
                            value="">
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
                        <input hidden type="text" name="get_Listed_Miles" class="get_Listed_Miles"
                            value="">
                        <div id="all-fetch-comparison">
                            <form method="post" action="{{ route('authorization.form.email') }}">
                                @csrf
                                <div class="row">
                                    <input type="hidden" class="form-control" name="id"
                                        id='authorization-orderId' placeholder="" readonly>
                                    <input type="hidden" class="form-control" name="status"
                                        id='authorization-status' placeholder="" readonly>
                                    <input type="hidden" class="form-control" name="cname"
                                        id='authorization-cname' placeholder="" readonly>
                                    <input type="hidden" class="form-control" name="cphone"
                                        id='authorization-cphone' placeholder="" readonly>
                                    <input type="hidden" class="form-control" name="origin"
                                        id='authorization-origin' placeholder="" readonly>
                                    <input type="hidden" class="form-control" name="destination"
                                        id='authorization-destination' placeholder="" readonly>
                                    <input type="hidden" class="form-control" name="vehicle"
                                        id='authorization-vehicle' placeholder="" readonly>
                                    <br>
                                    <div class="col-sm-12 col-md-12" id="msgReply">
                                        <div class="form-group">
                                            <label class="form-label">Enter Inv. Amount</label>
                                            <input type="number" value="" name="invoiceAmount"
                                                class="form-control" id="authorizationAmount"
                                                placeholder="Enter Amount" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Enter Email</label>
                                            <input type="email" value="" name="email"
                                                class="form-control userEmail" id="authorizationEmail"
                                                placeholder="Enter Email" />
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary"
                                    id="authorizationForm">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Change Password Modal -->
        <div class="modal fade" id="changePasswordModal" tabindex="-1"
            aria-labelledby="changePasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form id="changePasswordForm">
                            <!-- Current Password -->
                            <div class="mb-3">
                                <label for="currentPassword" class="form-label">Current Password</label>
                                <input type="password" class="form-control" id="currentPassword"
                                    name="currentPassword" placeholder="Enter current password" required>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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

                function getNotifications() {
                    $.ajax({
                        url: '{{ route('Get.Notification') }}',
                        type: 'GET',
                        success: function(data) {
                            $('.Notification').html(data);

                            let previousCount = $('.dataCount').val();
                            let currentCount = $('.dataCount').val();

                            if (currentCount > previousCount) {
                                playBeep();
                            }

                            previousCount = currentCount;
                        },
                        error: function(data) {
                            console.error('Error fetching notifications:', data);
                        },
                        complete: function() {
                            setTimeout(getNotifications, 5000);
                        }
                    });
                }

                let previousMessageCount = parseInt($('.messageCount').val(), 10);

                function getMessages() {
                    $.ajax({
                        url: '{{ route('Get.Message') }}',
                        type: 'GET',
                        success: function(data) {
                            $('.Message').html(data);

                            let currentCount = parseInt($('.messageCount').val(), 10);

                            if (currentCount > previousMessageCount) {
                                playBeep();
                            }

                            previousMessageCount = currentCount;
                        },
                        error: function(data) {
                            console.error('Error fetching messages:', data);
                        },
                        complete: function() {
                            setTimeout(getMessages, 5000);
                        }
                    });
                }

                // Function to play beep sound
                function playBeep() {
                    console.log('Playing beep sound');
                    const beep = new Audio("{{ asset('alert/noti_alert.mp3') }}");
                    beep.play();
                }

                getMessages();

                // Call the function to start retrieving notifications
                getNotifications();
                getMessages();


                // function getNotifications() {
                //     $.ajax({
                //         url: '{{ route('Get.Notification') }}',
                //         type: 'GET',
                //         success: function(data) {
                //             $('.Notification').html(
                //                 data); // Insert the retrieved HTML into the target element
                //         },
                //         error: function(data) {
                //             console.log(data);
                //             // alert(data);
                //         },
                //         complete: function() {
                //             // Schedule the next request when the current one is complete
                //             setTimeout(getNotifications, 5000); // The timeout set to 5 seconds
                //         }
                //     });
                // }
                // // Call the function to start retrieving notifications
                // getNotifications();

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
                // Miscellaneous Items JS Functions
                // $(".add-misc").click(function() {
            });
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
            // Set minimum date for all date inputs
            $('input[type="date"]').attr('min', today);
            // Time Validation
            var currentTime = new Date(Date.now());
            var timeValue = currentTime.toISOString().substring(11, 16);
            // Set current time for all elements with class 'departs'
            document.querySelectorAll('.departs').forEach(function(element) {
                element.value = timeValue;
            });
            // // Date Validation
            // var today = new Date();
            // var dd = String(today.getDate()).padStart(2, '0');
            // var mm = String(today.getMonth() + 1).padStart(2, '0');
            // var yyyy = today.getFullYear();
            // today = yyyy + '-' + mm + '-' + dd;
            // $('input[type="date"]').attr('min', today);
            // //    Time Validation
            // var date = new Date(Date.now());
            // document.getElementById('departs').value = date.toISOString().substring(11, 16);
        </script>
        <script>
            var $firstSign = $("#first_sign");
            var $secondSign = $("#second_sign");
            var $thirdSign = $("#third_sign");
            var $fourthSign = $("#fourth_sign");
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
            $(".Cancel_Waiting_Order").click(function() {
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

            // Get Profile Info Functionality For Rating Request
            $(".rate-order").click(function() {
                var getListedID = $(this).find('.Listed-ID').val();
                var getProfileID = $(this).find('.Profile-ID').val();
                var getRefID = $(this).find('.New-Ref-ID').val();
                var getCompName = $(this).find('.Company-Name').val();
                $(".get_Order_ID").html(getRefID + " (" + getCompName + ")");
                $(".get_Listed_ID").val(getListedID);
                $(".get_Profile_ID").val(getProfileID);
            });
            // Search Order_ID
            // const SearchOrderID = '{{ route('Search.Order.ID') }}';
            // $('.Order_ID.typeahead').typeahead({
            //     source: function(query, process) {
            //         return $.get(SearchOrderID, {
            //             query: query
            //         }, function(data) {
            //             return process(data);
            //         });
            //     }
            // });
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
        <script>
            $(document).ready(function () {
        $('.table-1').DataTable({
            "paging": false,
            "ordering": true,
            "info": false,
            "searching": false
        });
    });
        </script>
        {{-- <script>
        $(document).ready(function() {
            var sel = $('select[multiple]');
            sel.each(function() {
                let select = $(this);
                var options = $(this).find('option');

                var div = $('<div />').addClass('selectMultiple');
                var active = $('<div />').addClass('single-input-field');
                var list = $('<ul />');
                var placeholder = $(this).data('placeholder');

                var span = $('<span />').text(placeholder).appendTo(active);

                options.each(function() {
                    var text = $(this).text();
                    if ($(this).is(':selected')) {
                        active.append($('<a />').html('<em>' + text + '</em><i></i>'));
                        span.addClass('hide');
                    } else {
                        list.append($('<li />').html(text));
                    }
                });

                active.append($('<div />').addClass('arrow'));
                div.append(active).append(list);
                // div.append(`<strong>${placeholder}</strong>`);
                select.wrap(div);
            });
            $(document).on('click', '.selectMultiple ul li', function(e) {
                var select = $(this).parent().parent();
                var li = $(this);
                if (!select.hasClass('clicked')) {
                    select.addClass('clicked');
                    li.prev().addClass('beforeRemove');
                    li.next().addClass('afterRemove');
                    li.addClass('remove');
                    var a = $('<a />').addClass('notShown').html('<em>' + li.text() + '</em><i></i>').hide()
                        .appendTo(select.children('div'));
                    a.slideDown(400, function() {
                        setTimeout(function() {
                            a.addClass('shown');
                            select.children('div').children('span').addClass('hide');
                            select.find('option:contains(' + li.text() + ')').prop(
                                'selected', true);
                        }, 500);
                    });
                    setTimeout(function() {
                        if (li.prev().is(':last-child')) {
                            li.prev().removeClass('beforeRemove');

                        }
                        if (li.next().is(':first-child')) {
                            li.next().removeClass('afterRemove');
                        }
                        setTimeout(function() {
                            li.prev().removeClass('beforeRemove');
                            li.next().removeClass('afterRemove');
                        }, 200);

                        li.slideUp(400, function() {
                            li.remove();
                            select.removeClass('clicked');
                        });

                        // Show another select
                        var anotherSelect = select.siblings('select[multiple]');
                        anotherSelect.show();
                    }, 600);
                }
            });
            $(document).on('click', '.selectMultiple > div a', function(e) {
                var select = $(this).parent().parent();
                var self = $(this);
                self.removeClass().addClass('remove');
                select.addClass('open');
                setTimeout(function() {
                    self.addClass('disappear');
                    setTimeout(function() {
                        self.animate({
                            width: 0,
                            height: 0,
                            padding: 0,
                            margin: 0
                        }, 300, function() {
                            var li = $('<li />').text(self.children('em').text())
                                .addClass('notShown').appendTo(select.find('ul'));
                            li.slideDown(400, function() {
                                li.addClass('show');
                                setTimeout(function() {
                                    select.find('option:contains(' +
                                        self.children('em')
                                        .text() + ')').prop(
                                        'selected', false);
                                    if (!select.find(
                                            'option:selected')
                                        .length) {
                                        // select.children('div').children('span').removeClass('hide');

                                    }
                                    li.removeClass();
                                }, 400);
                            });
                            self.remove();
                        })
                    }, 300);
                }, 400);
            });
            $(document).on('click', '.selectMultiple > div .arrow, .selectMultiple > div span', function(e) {
                $(this).parent().parent().toggleClass('open');
            });
            $(document).on('click', 'body', function(e) {
                // Check if the clicked element or its ancestors have the class "selectMultiple"
                const selectMultipleElements = $(e.target).closest('.selectMultiple');

                // Remove the "open" class from all elements with the class "selectMultiple"
                console.log(selectMultipleElements.length)
                if (selectMultipleElements.length == '1') {} else {
                    $(".selectMultiple").removeClass('open');
                }

            });
        });
    </script> --}}
        <script type="text/javascript">
            $(document).ready(function() {
                var sel = $('select.custom-multi-select'); // Target your custom select class
                sel.each(function() {
                    let select = $(this);
                    var options = $(this).find('option');
                    var div = $('<div />').addClass('selectMultiple');
                    var active = $('<div />').addClass('single-input-field');
                    var list = $('<ul />');
                    var searchInput = $(
                        '<input type="text" class="searchInput" placeholder="Search..." style=" width: 100%; border: 1px solid red; padding: 8px;border-radius: 10px;">'
                    ); // Search input
                    var placeholder = $(this).data('placeholder');
                    var span = $('<span />').text(placeholder).appendTo(active);
                    list.append(searchInput); // Add search input to list
                    options.each(function() {
                        var text = $(this).text();
                        if ($(this).is(':selected')) {
                            active.append($('<a />').html('<em>' + text + '</em><i></i>'));
                            span.addClass('hide');
                        } else {
                            list.append($('<li />').html(text));
                        }
                    });
                    active.append($('<div />').addClass('arrow'));
                    div.append(active).append(list);
                    select.wrap(div);
                });
                // Function to handle enabling/disabling input fields
                function toggleInputs() {
                    const selectedCount = $('#Origin_Address option:selected').length;
                    const selectedCountdest = $('#Destination_Address option:selected').length;
                    // Get the input elements
                    var stateInput = $('#Origin_State');
                    var zipcodeInput = $('#Origin_ZipCode_single');
                    var zipcityInput = $('#Origin_City');
                    var ajax_city_list = document.getElementById('ajax_city_list');
                    var ajax_state_list = document.getElementById('ajax_state_list');
                    var origin_zipcode_list = document.getElementById('origin_zipcode_list');
                    // for dest
                    var deststateInput = $('#Dest_City');
                    var destzipcodeInput = $('#Destination_State');
                    var destzipcityInput = $('#Destination_ZipCode_single');
                    var dest_ajax_city_list = document.getElementById('dest_ajax_city_list');
                    var dest_ajax_state_list = document.getElementById('dest_ajax_state_list');
                    var dest_zipcode_list = document.getElementById('dest_zipcode_list');
                    // Clear input fields if options are selected
                    if (selectedCount > 0) {
                        if (stateInput.val() !== "") {
                            stateInput.val("");
                        }
                        if (zipcodeInput.val() !== "") {
                            zipcodeInput.val("");
                        }
                        if (zipcityInput.val() !== "") {
                            zipcityInput.val("");
                        }
                        ajax_city_list.innerHTML = "";
                        ajax_state_list.innerHTML = "";
                        origin_zipcode_list.innerHTML = "";
                        // Disable inputs
                        stateInput.prop('disabled', true);
                        zipcodeInput.prop('disabled', true);
                        zipcityInput.prop('disabled', true);
                    } else {
                        // Enable inputs if no options are selected
                        stateInput.prop('disabled', false);
                        zipcodeInput.prop('disabled', false);
                        zipcityInput.prop('disabled', false);
                    }
                    if (selectedCountdest > 0) {
                        if (deststateInput.val() !== "") {
                            deststateInput.val("");
                        }
                        if (destzipcodeInput.val() !== "") {
                            destzipcodeInput.val("");
                        }
                        if (destzipcityInput.val() !== "") {
                            destzipcityInput.val("");
                        }
                        dest_ajax_city_list.innerHTML = "";
                        dest_ajax_state_list.innerHTML = "";
                        dest_zipcode_list.innerHTML = "";

                        deststateInput.prop('disabled', true);
                        destzipcodeInput.prop('disabled', true);
                        destzipcityInput.prop('disabled', true);
                    } else {
                        deststateInput.prop('disabled', false);
                        destzipcodeInput.prop('disabled', false);
                        destzipcityInput.prop('disabled', false);
                    }
                }
                toggleInputs();
                // Search functionality
                $(document).on('keyup', '.searchInput', function(e) {
                    var filter = $(this).val().toLowerCase();
                    $(this).siblings('li').each(function() {
                        var text = $(this).text().toLowerCase();
                        $(this).toggle(text.indexOf(filter) > -1);
                    });
                });
                $(document).on('click', '.selectMultiple ul li', function(e) {
                    var select = $(this).parent().parent();
                    var li = $(this);
                    if (!select.hasClass('clicked')) {
                        select.addClass('clicked');
                        li.prev().addClass('beforeRemove');
                        li.next().addClass('afterRemove');
                        li.addClass('remove');
                        var a = $('<a />').addClass('notShown').html('<em>' + li.text() + '</em><i></i>').hide()
                            .appendTo(select.children('div'));
                        a.slideDown(400, function() {
                            setTimeout(function() {
                                a.addClass('shown');
                                select.children('div').children('span').addClass('hide');
                                select.find('option:contains(' + li.text() + ')').prop(
                                    'selected', true);
                                // Check and toggle input fields after selection
                                toggleInputs();
                            }, 500);
                        });
                        setTimeout(function() {
                            if (li.prev().is(':last-child')) {
                                li.prev().removeClass('beforeRemove');
                            }
                            if (li.next().is(':first-child')) {
                                li.next().removeClass('afterRemove');
                            }
                            setTimeout(function() {
                                li.prev().removeClass('beforeRemove');
                                li.next().removeClass('afterRemove');
                            }, 200);

                            li.slideUp(400, function() {
                                li.remove();
                                select.removeClass('clicked');
                            });
                            // Show another select
                            var anotherSelect = select.siblings('select[multiple]');
                            anotherSelect.show();
                        }, 600);
                    }
                });
                $(document).on('click', '.selectMultiple > div a', function(e) {
                    var select = $(this).parent().parent();
                    var self = $(this);
                    self.removeClass().addClass('remove');
                    select.addClass('open');
                    setTimeout(function() {
                        self.addClass('disappear');
                        setTimeout(function() {
                            self.animate({
                                width: 0,
                                height: 0,
                                padding: 0,
                                margin: 0
                            }, 300, function() {
                                var li = $('<li />').text(self.children('em').text())
                                    .addClass('notShown').appendTo(select.find('ul'));
                                li.slideDown(400, function() {
                                    li.addClass('show');
                                    setTimeout(function() {
                                        select.find('option:contains(' +
                                            self.children('em')
                                            .text() + ')').prop(
                                            'selected', false);
                                        // Check and toggle input fields after deselection
                                        toggleInputs();
                                        if (!select.find(
                                                'option:selected')
                                            .length) {
                                            select.children('div')
                                                .children('span')
                                                .removeClass('hide');
                                        }
                                        li.removeClass();
                                    }, 400);
                                });
                                self.remove();
                            });
                        }, 300);
                    }, 400);
                });
                $(document).on('click', '.selectMultiple > div .arrow, .selectMultiple > div span', function(e) {
                    $(this).parent().parent().toggleClass('open');
                });
                $(document).on('click', 'body', function(e) {
                    const selectMultipleElements = $(e.target).closest('.selectMultiple');
                    if (selectMultipleElements.length === 0) {
                        $(".selectMultiple").removeClass('open');
                    }
                });
            });
        </script>
        <script>
            $(".add-misc").click(function() {
                const getListedID = $(this).find('.Listed-ID').val();
                const getRefID = $(this).find('.Ref-ID').val();
                $(".get_Order_ID").html(getRefID);
                $(".get_Listed_ID").val(getListedID);
            });

            $(".show-misc").click(function() {
                const getListedID = $(this).find('.Listed-ID').val();
                const getRefID = $(this).find('.Ref-ID').val();
                $(".get_Order_ID").html(getRefID);
                $(".get_Listed_ID").val(getListedID);
                $.ajax({
                    url: '{{ route('get.misc.charges') }}',
                    type: 'GET',
                    data: {
                        'Listed_ID': getListedID,
                    },
                    success: function(data) {
                        console.log('datadata');
                        $('.show-all-misc').html(data.html);
                        // $('.carrier-all-request').DataTable();
                    },
                    error: function(data) {
                        alert(data.responseJSON);
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#positive-rate').click(function() {
                    $('#Ratings').val('positive');
                });
                $('#neutral-rate').click(function() {
                    $('#Ratings').val('neutral');
                });
                $('#negative-rate').click(function() {
                    $('#Ratings').val('negative');
                });


                $(document).ready(function() {
                    $("#comments").show();
                    $(".positive-span").hide();
                    $(".negative-span").hide();
                    $(".neutral-span").hide();

                    $("#positive-rate").click(function() {

                        $("#positive-rate").show();
                        $("#negative-rate").show();
                        $("#neutral-rate").show();

                        $(".new-user-box").addClass('active-stats-box');
                        $(".upcoming-product-box").removeClass('active-stats-box');
                        $(".new-product-box").removeClass('active-stats-box');

                        $(".positive-span").show();
                        $(".negative-span").hide();
                        $(".neutral-span").hide();

                        $("#comments").show();
                        $("#comments textarea").html("");

                        $("#Ratings").val('Positive');

                    });

                    $("#neutral-rate").click(function() {

                        $("#negative-rate").show();
                        $("#positive-rate").show();
                        $("#neutral-rate").show();

                        $(".new-user-box").removeClass('active-stats-box');
                        $(".upcoming-product-box").addClass('active-stats-box');
                        $(".new-product-box").removeClass('active-stats-box');

                        $(".neutral-span").show();
                        $(".negative-span").hide();
                        $(".positive-span").hide();

                        $("#comments").show();
                        $("#comments textarea").html("");

                        $("#Ratings").val('Neutral');

                    });

                    $("#negative-rate").click(function() {

                        $("#negative-rate").show();
                        $("#positive-rate").show();
                        $("#neutral-rate").show();

                        $(".new-user-box").removeClass('active-stats-box');
                        $(".upcoming-product-box").removeClass('active-stats-box');
                        $(".new-product-box").addClass('active-stats-box');

                        $(".negative-span").show();
                        $(".neutral-span").hide();
                        $(".positive-span").hide();

                        $("#comments").show();
                        $("#comments textarea").html("");

                        $("#Ratings").val('Negative');

                    });
                    // Get Profile Info Functionality For Rating Replied
                    $(".rate-reply").click(function() {
                        var getListedID = $(this).find('.Listed-ID').val();
                        var getRateID = $(this).find('.Rate-ID').val();
                        $(".get_Order_ID").html(getListedID);
                        $(".get_Listed_ID").val(getListedID);
                        $(".get_Rate_ID").val(getRateID);
                    });
                });
            });
        </script>
        <script>
            document.querySelectorAll('.rate-order').forEach(function(element) {
                element.addEventListener('click', function() {
                    var refId = this.querySelector('.New-Ref-ID').value;
                    var listedId = this.querySelector('.Listed-ID').value;
                    var profileId = this.querySelector('.Profile-ID').value;
                    console.log('Ref ID:', refId, 'Listed ID:', listedId, 'Profile ID:', profileId);
                });
            });
        </script>
        <script>
            $(document).on('click', '.watchlist-toggle', function() {
                const url = $(this).data('url');
                const icon = $(this).find('.toggle-icon');

                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            if (response.isInWatchlist) {
                                icon.removeClass('fa-regular fa-heart')
                                    .addClass('fa fa-heart')
                                    .attr('title', 'Remove from Watch List');
                            } else {
                                icon.removeClass('fa fa-heart')
                                    .addClass('fa-regular fa-heart')
                                    .attr('title', 'Add to Watch List');
                            }
                        } else {
                            alert(response.message || 'Something went wrong!');
                        }
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
                        toastr.success(
                            `<span class="text-white font-weight-bold">${response.data}</span>`);
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
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
                        toastr.error(
                            '<span class="text-white font-weight-bold">Unable to add to watchlist</span>',
                            "❌ Error");
                    }
                });
            });
        </script>
        <script>
            function changePassModal() {
                $('#changePasswordModal').modal('show');
            }

            function submitChangePassword() {
                const currentPassword = $('#currentPassword').val();
                const newPassword = $('#newPassword').val();
                const user_id = '{{ Auth::guard('Authorized')->user()->id }}';
                const confirmNewPassword = $('#confirmNewPassword').val();

                if (newPassword !== confirmNewPassword) {
                    alert("New password and confirmation do not match.");
                    return;
                }

                $.ajax({
                    url: '{{ route('change.password') }}',
                    method: 'POST',
                    data: {
                        user_id: user_id,
                        currentPassword: currentPassword,
                        newPassword: newPassword,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        $('#changePasswordModal').modal('hide');
                        $('#changePasswordModal form')[0].reset();
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON.message);
                    }
                });
            }
        </script>
        <script>
            const path2 = "{{ route('get.city.state') }}";
            $('.City_State.typeahead').typeahead({
                source: function(query, process) {
                    let type = this.$element.data('type');
                    return $.get(path2, {
                        query: query,
                        type: type
                    }, function(data) {
                        return process(data);
                    });
                },
                updater: function(item) {
                    return item;
                },
                autoSelect: true,
                minLength: 2
            });
        </script>
        <script>
            $(document).on('change', '.toggle-status', function() {
                let userId = $(this).data('id');
                let status = $(this).prop('checked') ? 1 : 0;

                $.ajax({
                    url: "{{ route('updateUserStatus') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        user_id: userId,
                        is_active: status
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                        } else {
                            alert(response.message, "Something went wrong.");
                        }
                    },
                    error: function(xhr) {
                        alert("Error: " + xhr.responseJSON.message);
                    }
                });
            });
        </script>
</body>

</html>
