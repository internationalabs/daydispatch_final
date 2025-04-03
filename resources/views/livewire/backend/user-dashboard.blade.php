@section('Dashboard', 'mm-active')
@section('content')
    <style>
        .empty-carousel-placeholder {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 300px;
            background-color: #f8f9fa;
            border: 1px solid #ccc;
        }

        .custom-style- {
            font-size: 20px;
        }

        .dashboard-card {
            position: relative;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            border-radius: 12px;
            overflow: hidden;
            color: #fff;
            padding: 20px;
            margin: 20px 0;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: linear-gradient(135deg, #007bff, #0056d2);
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .icon-container {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.15);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .icon-container i {
            font-size: 24px;
            color: #fff;
        }

        .stat-number {
            font-size: 3em;
            font-weight: bold;
            margin: 0;
        }

        .stat-title {
            font-size: 1.2em;
            text-transform: uppercase;
            opacity: 0.9;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .dashboard-card:hover .icon-container {
            animation: float 2s infinite ease-in-out;
        }

        .progress {
            height: 10px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
            overflow: hidden;
            margin-top: 15px;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #ffffff, #585858);
            transition: width 1s ease;
        }

        .dashboard-title {
            text-align: center;
            margin-bottom: 30px;
            color: #1e2d62;
        }

        .recent-activity-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .recent-activity-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background: #1e2d62;
            color: white;
            padding: 15px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-header h5 {
            margin: 0;
        }

        .card-header i {
            font-size: 1.5em;
        }

        .card-body {
            padding: 20px;
        }

        .card-body ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .card-body li {
            padding: 10px 0;
            border-bottom: 1px solid #dee2e6;
        }

        .activity-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .activity-status {
            font-weight: bold;
        }

        .completed {
            color: #28a745;
        }

        .pending {
            color: #ffc107;
        }

        .delivered {
            color: #28a745;
        }

        .in-transit {
            color: #007bff;
        }

        .picked-up {
            color: #17a2b8;
        }

        .scheduled {
            color: #6c757d;
        }

        /* .btn {
                                        margin-top: 15px;
                                        background-color: #1e2d62;
                                        color: white;
                                        border: none;
                                        padding: 10px 15px;
                                        border-radius: 5px;
                                        cursor: pointer;
                                        transition: background-color 0.3s;
                                    }

                                    .btn:hover {
                                        background-color: #0056b3;
                                    } */

        @media (max-width: 1199px) {
            .moiz{
              padding-top:  100px;
            }
        }

        @media (max-width: 768px) {
            .moiz{
              padding-top:  10px;
            }
        }

        /* @media (max-width: 768px) {
            .row {
                flex-direction: column;
            }

            .col-md-4 {
                margin-bottom: 20px;
            }
        } */

        .global-search-area {
            position: relative;
            z-index: 1;
            background: #f6f7fb;
        }

        .global-search-area.bg-image {
            background-image: url(../../frontend/img/slider-3.webp);
            background-position: center center;
            background-size: cover;
            background-repeat: no-repeat;
            border-radius: 50px;
            overflow: hidden;
        }

        .global-search-area .d-table {
            width: 100%;
            height: 100%;
        }

        .global-search-area .d-table-cell {
            vertical-align: middle;
        }

        .global-search-area .search-form {
            max-width: 1300px;
            background: #ffffff;
            border-radius: 30px;
            overflow: hidden;
            text-align: center;
            padding: 20px 20px;
            box-shadow: 1px 5px 24px 0 rgba(68, 102, 242, 0.05);
            margin: 20px auto;
        }

        .global-search-area .search-form h2 {
            font-size: 30px;
            font-weight: 700;
            margin-top: 30px;
            margin-bottom: 0;
        }

        .global-search-area .search-form form {
            margin-top: 25px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .global-search-area .search-form form .form-group {
            flex: 1;
            min-width: 200px;
            margin-bottom: 20px;
            position: relative;
        }

        .global-search-area .search-form form .form-group .label-title {
            margin-bottom: 0;
            position: absolute;
            display: block;
            left: 0;
            top: 0;
            pointer-events: none;
            width: 100%;
            height: 100%;
            color: #2a2a2a;
        }

        .global-search-area .search-form form .form-group .label-title i {
            position: absolute;
            left: 0;
            transition: 0.5s;
            top: 9px;
            font-size: 22px;
        }

        .global-search-area .search-form form .form-group .label-title::before {
            content: "";
            display: block;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            transition: 0.5s;
            background: #e1000a;
        }

        .global-search-area .search-form form .form-group .form-control {
            border-radius: 0;
            border: none;
            border-bottom: 2px solid #adadad;
            padding: 0 0 0 32px;
            color: #2a2a2a;
            height: 45px;
            transition: 0.5s;
            font-family: "Nunito", sans-serif;
            font-size: 17px;
            font-weight: 500;
        }

        .global-search-area .search-form form .form-group .form-control::placeholder {
            color: #A1A1A1;
            transition: 0.5s;
        }

        .global-search-area .search-form form .form-group .form-control:focus {
            padding-left: 5px;
        }

        .global-search-area .search-form form .form-group .form-control:focus::placeholder {
            color: transparent;
        }

        .global-search-area .search-form form .form-group .form-control:focus+.label-title::before {
            width: 100%;
        }

        .global-search-area .search-form form .form-group .form-control:focus+.label-title {
            color: #A1A1A1;
        }

        .global-search-area .search-form form .form-group .form-control:focus+.label-title i {
            top: -22px;
        }

        .global-search-area .search-form form .search-btn {
            height: 45px;
            padding: 0px 30px;
            border-radius: 30px;
            border: none;
            text-transform: uppercase;
            transition: 0.5s;
            background-color: #012862;
            color: #ffffff;
            font-size: 15px;
            font-weight: 700;
            flex: 0 0 auto;
        }

        .global-search-area .search-form form .search-btn:hover,
        .global-search-area .search-form form .search-btn:focus {
            background-color: #000b33;
            color: #ffffff;
        }

        .modal-dialog {
            display: flex;
            align-items: center;
            /* Vertical center */
            min-height: calc(100% - 1rem);
        }

        .modal-content {
            margin: auto;
        }
        .alert-link {
        text-decoration: none;
        color: inherit;
    }
    .alert-link:hover {
        text-decoration: underline;
    }
    </style>
    <br/>
    @php
    $user_adminver = Auth::guard('Authorized')->user();
    @endphp
    @if ($user_adminver && $user_adminver->admin_verify == 0)
    <div class="d-flex justify-content-center align-items-center">
        <div class="alert alert-warning d-flex align-items-center" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> <!-- Optional: Add an icon -->
            <div>
                Your profile verification is pending. Please
                <a href="{{ route('User.Profile') }}" class="alert-link fw-bold">complete your profile</a>
                to ensure uninterrupted access.
            </div>
        </div>
    </div>
    @endif

    @php
        $currentMonth = now()->format('Y-m');
        $currentMonthData = collect($revenue_summary)->firstWhere('month', $currentMonth);
        $gross = $currentMonthData['gross'] ?? 0;
        $owned = $currentMonthData['owned'] ?? 0;
        $billings = $currentMonthData['billing'] ?? 0;
        $carrierPrice = $currentMonthData['carrier_price'] ?? 0;
    @endphp
    @if ($currentUser->usr_type != 'Carrier')
        {{-- <div class="container-fluid my-5 mx-0"> --}}
            <div class="moiz my-5" style="display: flex; justify-content: center;  ">
                {{-- <div class="col-lg-4 col-md-4 col-sm-6"> --}}
                <div style="width: 400px" class=" text-center p-3 border fs-4 shadow-lg hover-effect">
                    <div class="d-flex justify-content-center">
                        <div id="dashboardLabel" class="text"></div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="dashboardSwitch"
                                onchange="toggleDashboardView()">
                            <label class="form-check-label" for="dashboardSwitch">Switch to Quote Dashboard</label>
                        </div>
                    </div>
                </div>
                {{-- </div> --}}
            </div>
        {{-- </div> --}}
    @endif
    @if ($currentUser->usr_type == 'Carrier')
        <div class="global-search-area bg-white mx-5 mb-3 z-0">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="search-form">
                        <h2>Search for Loads</h2>
                        <form action="{{ route('Filterd.Listing') }}" method="GET">
                            <div class="form-group">
                                <input type="text" class="form-control City_State typeahead" name="Origin_City[]"
                                    data-type="City" placeholder="Origin (City)" value="">
                                <span class="label-title"><i class='bx bx-user'></i></span>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control City_State typeahead" name="Origin_State[]"
                                    data-type="State" placeholder="Origin (State)" value="">
                                <span class="label-title"><i class='bx bx-user'></i></span>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control City_State typeahead" name="Dest_City[]"
                                    data-type="City" placeholder="Destination (City)" value="">
                                <span class="label-title"><i class='bx bx-user'></i></span>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control City_State typeahead" name="Destination_State[]"
                                    data-type="State" placeholder="Destination (State)" value="">
                                <span class="label-title"><i class='bx bx-user'></i></span>
                            </div>
                            <button type="submit" class="search-btn">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        @include('partials.global-search')
    @endif
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card mb-30">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="text-dark">Revenue Summary</h3>
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="bx bx-dots-horizontal-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bx bx-show"></i> View
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bx bx-edit-alt"></i> Edit
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bx bx-trash"></i> Delete
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bx bx-printer"></i> Print
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bx bx-download"></i> Download
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="position: relative;">
                    <div class="revenue-summary-content">
                        <div class="d-sm-flex ">
                            <div class="pr-4 border-right">
                                <p class="mb-1">Carrier Prices</p>
                                <h5 class="mb-0">
                                    <span class="font-weight-bold">${{ number_format($carrierPrice, 2) }}</span>
                                </h5>
                            </div>

                            <div class="px-4 border-right">
                                <p class="mb-1">Billings</p>
                                <h5 class="mb-0">
                                    <span class="font-weight-bold">${{ number_format($billings, 2) }}</span>
                                </h5>
                            </div>

                            <div class="px-4 border-right">
                                <p class="mb-1">Owed</p>
                                <h5 class="mb-0">
                                    <span class="font-weight-bold">${{ number_format($owned, 2) }}</span>
                                </h5>
                            </div>

                            <div class="px-4">
                                <div class="px-4">
                                    <p class="mb-1">Gross</p>
                                    <h5 class="mb-0">
                                        <span class="font-weight-bold">${{ number_format($gross, 2) }}</span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div id="revenue-summary-chart" class="extra-margin">
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="col-lg-6 col-md-12">

            <div class="row">
                <div class="col-lg-4 col-md-12">
                    @if (Auth::guard('Authorized')->user()->usr_type == 'Carrier')
                        <div class="new-product-box border shadow-sm">
                            <a href="{{ route('Filterd.Listing') }}" class="text-decoration-none  text-body" >
                                <div class="icon" >
                                    <i class="bx bx-list-check"></i>
                                </div>
                                 Available Loads
                                <span class="sub-text d-block font-weight-bold">
                                    @if ($LisitingCount)
                                        {{ $LisitingCount }}
                                    @endif
                                </span>
                            </a>
                        </div>
                    @else
                        <div class="new-product-box border shadow-sm">
                            <a class="text-decoration-none text-body" href="{{route('User.Listing') }}">
                                <div class="icon">
                                    <i class="bx bx-list-check"></i>
                                </div>
                                Listed
                                <span class="sub-text d-block font-weight-bold">{{ $orderCount['Listed'] }}</span>
                            </a>
                        </div>
                    @endif
                    <div class="new-product-box border shadow-sm">
                        <a class="text-decoration-none text-body" href="{{ route('Dispatch.Listing') }}">
                            <div class="icon">
                                <i class="bx bx-shopping-bag"></i>
                            </div>
                            Dispatch
                            <span class="sub-text d-block font-weight-bold">{{ $orderCount['Dispatch'] }}</span>
                        </a>
                    </div>
                    <div class="new-user-box border shadow-sm">
                        <a class="text-decoration-none text-body" href="{{ route('User.Archived.Listing') }}">
                            <div class="icon">
                                <i class="bx bx-archive"></i>
                            </div>
                            Archived
                            <span class="sub-text d-block font-weight-bold">{{ $orderCount['Archived'] }}</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="new-user-box border shadow-sm">
                        <a class="text-decoration-none text-body" href="{{ route('Requested.Listing') }}">
                            <div class="icon">
                                <i class="bx bx-message-square-dots"></i>
                            </div>
                            Requested
                            <span class="sub-text d-block font-weight-bold">{{ $orderCount['Requested'] }}</span>
                        </a>
                    </div>
                    <div class="new-user-box border shadow-sm">
                        <a class="text-decoration-none text-body" href="{{ route('PickUp.Listing') }}">
                            <div class="icon">
                                <i class="bx bx-box"></i>
                            </div>
                            PickUp
                            <span class="sub-text d-block font-weight-bold">{{ $orderCount['PickUp'] }}</span>
                        </a>
                    </div>
                    <div class="new-product-box border shadow-sm">
                        <a class="text-decoration-none text-body" href="{{ route('Cancelled.Listing') }}">
                            <div class="icon">
                                <i class="bx bx-block"></i>
                            </div>
                            Cancelled
                            <span class="sub-text d-block font-weight-bold">{{ $orderCount['Cancelled'] }}</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="new-user-box border shadow-sm">
                        <a class="text-decoration-none text-body" href="{{ route('Waitings.Listing') }}">
                            <div class="icon">
                                <i class="bx bx-time-five"></i>
                            </div>
                            Waiting Approval
                            <span class="sub-text d-block font-weight-bold">{{ $orderCount['Waiting_Approval'] }}</span>
                        </a>
                    </div>
                    <div class="new-user-box border shadow-sm">
                        <a class="text-decoration-none text-body" href="{{ route('Delivered.Listing') }}">
                            <div class="icon">
                                <i class="bx bx-package"></i>
                            </div>
                            Delivered
                            <span class="sub-text d-block font-weight-bold">{{ $orderCount['Delivered'] }}</span>
                        </a>
                    </div>
                    @if (Auth::guard('Authorized')->user()->usr_type == 'Carrier')
                        <div class="new-user-box border shadow-sm">
                            <a class="text-decoration-none text-body" href="{{ route('User.Watchlist') }}">
                                <div class="icon">
                                    <i class="bx bx-time"></i>
                                </div>
                                WatchList
                                <span class="sub-text d-block font-weight-bold">{{ $orderCount['WatchList'] }}</span>
                            </a>
                        </div>
                    @else
                        <div class="new-user-box border shadow-sm">
                            <a class="text-decoration-none text-body" href="{{ route('Private.Listing') }}">
                                <div class="icon">
                                    <i class="bx bx-time"></i>
                                </div>
                                Private Listing
                                <span class="sub-text d-block font-weight-bold">{{ $orderCount['pvt_Listing'] }}</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12 mb-3">
            <div class="card recent-orders-box mb-30 h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="text-dark">Waiting Approval</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Company</th>
                                    <th></th>
                                    <th>Date</th>
                                    <th>Vehicle</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($waiting->isNotEmpty())
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach ($waiting as $key => $row)
                                        @php
                                            $count = $count++;
                                        @endphp
                                        @if ($row->all_listing && $count <= 4)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('global.search.index', ['search_criteria' => 1, 'search_query' => $row->all_listing->Ref_ID]) }}"
                                                        class="text-decoration-none text-black font-bold">
                                                        #{{ $row->all_listing->Ref_ID }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('View.Profile', $row->waiting_users->id) }}"
                                                        class="text-decoration-none text-black font-bold">
                                                        {{ $row->waiting_users->Company_Name }}
                                                    </a>
                                                </td>
                                                <td class="name">
                                                <td>{{ \Carbon\Carbon::parse($row->created_at)->format('M d, Y') }}</td>
                                                <td>
                                                    @if (count($row->all_listing->vehicles) === 1)
                                                        @foreach ($row->all_listing->vehicles as $vehcile)
                                                            @php
                                                                $vehicleName =
                                                                    $vehcile->Vehcile_Year .
                                                                    ' ' .
                                                                    $vehcile->Vehcile_Make .
                                                                    ' ' .
                                                                    $vehcile->Vehcile_Model;
                                                                $firstThreeWords = implode(
                                                                    ' ',
                                                                    array_slice(explode(' ', $vehicleName), 0, 3),
                                                                );
                                                            @endphp
                                                            <span
                                                                class="@if ($vehcile->Vehcile_Condition == 'Not Running') text-danger @else text-success @endif">{{ $firstThreeWords }}</span>
                                                        @endforeach
                                                    @endif
                                                    @if (count($row->all_listing->vehicles) > 1)
                                                        <div class="dropdown">
                                                            <a href="javascript:void(0)" class="dropdown-toggle"
                                                                data-toggle="dropdown"
                                                                style="color: #0d6efd; font-weight: 800; cursor: pointer;">
                                                                Vehicles
                                                                ({{ count($row->all_listing->vehicles) }})
                                                            </a>
                                                            <div class="dropdown-menu text-center">
                                                                <h6 class="dropdown-header"
                                                                    style="background-color: lightgrey;">
                                                                    Attached Vehicles</h6>
                                                                @foreach ($row->all_listing->vehicles as $vehicle)
                                                                    <a class="dropdown-item"
                                                                        style="color: #0d6efd; font-weight: 800;"
                                                                        href="https://www.google.com/search?q={{ $vehicle->Vehcile_Year }}%20{{ $vehicle->Vehcile_Make }}%20{{ $vehicle->Vehcile_Model }}"
                                                                        target="_blank">
                                                                        {{ $vehicle->Vehcile_Year }}
                                                                        {{ $vehicle->Vehcile_Make }}
                                                                        {{ $vehicle->Vehcile_Model }}
                                                                    </a>
                                                                    @if (!empty($vehicle->Vehcile_Condition))
                                                                        <div
                                                                            class="badge rounded-pill bg-success text-white">
                                                                            {{ $vehicle->Vehcile_Condition }}
                                                                        </div>
                                                                    @endif
                                                                    @if (!empty($vehicle->Trailer_Type))
                                                                        <div
                                                                            class="dropdown-item @if ($vehicle->Trailer_Type == "'(Enclosed Trailer Required)'") badge rounded-pill bg-success text-white @endif">
                                                                            {{ $vehicle->Trailer_Type }}
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if (count($row->all_listing->heavy_equipments) === 1)
                                                        @foreach ($row->all_listing->heavy_equipments as $vehcile)
                                                            <a style="color: #0d6efd; font-weight: 800;"
                                                                href='https://www.google.com/search?q={{ $vehcile->Equipment_Year }}%20{{ $vehcile->Equipment_Make }}%20{{ $vehcile->Equipment_Model }}'
                                                                target='_blank'>
                                                                {{ $vehcile->Equipment_Year }}
                                                                {{ $vehcile->Equipment_Make }}
                                                                {{ $vehcile->Equipment_Model }}
                                                            </a><br>
                                                            <b>L</b>{{ $vehcile->Equip_Length }} |
                                                            <b>W</b>{{ $vehcile->Equip_Width }}
                                                            | <b>H</b>{{ $vehcile->Equip_Height }}
                                                            | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                                        @endforeach
                                                    @endif
                                                    @if (count($row->all_listing->heavy_equipments) > 1)
                                                        <a style="color: #0d6efd; font-weight: 800;"
                                                            href="javascript:void(0)" tabindex="0" class=""
                                                            data-toggle="popover" data-trigger="focus"
                                                            style="cursor: pointer background-color: lightgrey;;"
                                                            title="Attached vehicles"
                                                            data-content="@foreach ($row->all_listing->heavy_equipments as $vehcile)
                                                                <a href='https://www.google.com/search?q={{ $vehcile->Equipment_Year }}%20{{ $vehcile->Equipment_Make }}%20{{ $vehcile->Equipment_Model }}' 
                                                                target='_blank'>
                                                                {{ $vehcile->Equipment_Year }} {{ $vehcile->Equipment_Make }} {{ $vehcile->Equipment_Model }}
                                                                </a><br>
                                                                <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} | <b>H</b>{{ $vehcile->Equip_Height }} | {{ $vehcile->Equip_Weight }} <b>LBS</b> @endforeach"
                                                            data-html="true">
                                                            vehicles
                                                            ({{ count($row->all_listing->heavy_equipments) }})
                                                        </a>
                                                    @endif
                                                    @if (count($row->all_listing->dry_vans) === 1)
                                                        @foreach ($row->all_listing->dry_vans as $vehcile)
                                                            <span title="Freight Class">
                                                                <a href="javascript:void(0)" tabindex="0"
                                                                    class="" data-toggle="popover"
                                                                    data-trigger="focus" style="cursor: pointer;"
                                                                    title="Freight Class" data-html="true">
                                                                    {{ $vehcile->Freight_Class }}
                                                                </a>
                                                            </span>
                                                            <span title="Freight Weight">

                                                                <a href="javascript:void(0)" tabindex="0"
                                                                    class="" data-toggle="popover"
                                                                    data-trigger="focus" style="cursor: pointer;"
                                                                    title="Freight Weight"
                                                                    data-html="true">{{ $vehcile->Freight_Weight }}
                                                                </a>
                                                            </span> <b>LBS</b><br>
                                                            @if ($vehcile->is_hazmat_Check !== 0)
                                                                Hazmat Required<br>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @if (count($row->all_listing->dry_vans) > 1)
                                                        <a href="javascript:void(0)" tabindex="0" class=""
                                                            data-toggle="popover" data-trigger="focus"
                                                            style="cursor: pointer;" title="Attached vehicles"
                                                            data-content=
                                                                "@foreach ($row->all_listing->dry_vans as $vehcile)
                                                                <span title='Freight Class'>{{ $vehcile->Freight_Class }}</span>
                                                                <span title='Freight Weight'>{{ $vehcile->Freight_Weight }}</span> <b>LBS</b><br>
                                                                @if ($vehcile->is_hazmat_Check !== 0)
                                                                    Hazmat Required<br>
                                                                @endif @endforeach"
                                                            data-html="true">vehicles
                                                            ({{ count($row->all_listing->dry_vans) }})
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>${{ $row->all_listing->paymentinfo->Price_Pay_Carrier }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="d-flex justify-content-center align-items-center"
                                        style="height: 185px; background-color: #f7f7f7;">
                                        <p class="text-center text-muted" style="font-size: 1.25rem;">No recent entries
                                        </p>
                                    </div>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 mb-3">
            <div class="card recent-orders-box mb-30 h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="text-dark">Dispatch</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Company</th>
                                    <th></th>
                                    <th>Date</th>
                                    <th>Vehicle</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($dispatch->isNotEmpty())
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach ($dispatch as $key => $row)
                                        @php
                                            $count = $count++;
                                        @endphp
                                        @if ($row->all_listing && $count <= 4)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('global.search.index', ['search_criteria' => 1, 'search_query' => $row->all_listing->Ref_ID]) }}"
                                                        class="text-decoration-none text-black font-bold">
                                                        #{{ $row->all_listing->Ref_ID }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('View.Profile', $row->waiting_users->id) }}"
                                                        class="text-decoration-none text-black font-bold">
                                                        {{ $row->waiting_users->Company_Name }}
                                                    </a>
                                                </td>
                                                <td class="name">
                                                <td>{{ \Carbon\Carbon::parse($row->created_at)->format('M d, Y') }}</td>
                                                <td>
                                                    @if (count($row->all_listing->vehicles) === 1)
                                                        @foreach ($row->all_listing->vehicles as $vehcile)
                                                            @php
                                                                $vehicleName =
                                                                    $vehcile->Vehcile_Year .
                                                                    ' ' .
                                                                    $vehcile->Vehcile_Make .
                                                                    ' ' .
                                                                    $vehcile->Vehcile_Model;
                                                                $firstThreeWords = implode(
                                                                    ' ',
                                                                    array_slice(explode(' ', $vehicleName), 0, 3),
                                                                );
                                                            @endphp
                                                            <span
                                                                class="@if ($vehcile->Vehcile_Condition == 'Not Running') text-danger @else text-success @endif">{{ $firstThreeWords }}</span>
                                                        @endforeach
                                                    @endif
                                                    @if (count($row->all_listing->vehicles) > 1)
                                                        <div class="dropdown">
                                                            <a href="javascript:void(0)" class="dropdown-toggle"
                                                                data-toggle="dropdown"
                                                                style="color: #0d6efd; font-weight: 800; cursor: pointer;">
                                                                Vehicles
                                                                ({{ count($row->all_listing->vehicles) }})
                                                            </a>
                                                            <div class="dropdown-menu text-center">
                                                                <h6 class="dropdown-header"
                                                                    style="background-color: lightgrey;">
                                                                    Attached Vehicles</h6>
                                                                @foreach ($row->all_listing->vehicles as $vehicle)
                                                                    <a class="dropdown-item"
                                                                        style="color: #0d6efd; font-weight: 800;"
                                                                        href="https://www.google.com/search?q={{ $vehicle->Vehcile_Year }}%20{{ $vehicle->Vehcile_Make }}%20{{ $vehicle->Vehcile_Model }}"
                                                                        target="_blank">
                                                                        {{ $vehicle->Vehcile_Year }}
                                                                        {{ $vehicle->Vehcile_Make }}
                                                                        {{ $vehicle->Vehcile_Model }}
                                                                    </a>
                                                                    @if (!empty($vehicle->Vehcile_Condition))
                                                                        <div
                                                                            class="badge rounded-pill bg-success text-white">
                                                                            {{ $vehicle->Vehcile_Condition }}
                                                                        </div>
                                                                    @endif
                                                                    @if (!empty($vehicle->Trailer_Type))
                                                                        <div
                                                                            class="dropdown-item @if ($vehicle->Trailer_Type == "'(Enclosed Trailer Required)'") badge rounded-pill bg-success text-white @endif">
                                                                            {{ $vehicle->Trailer_Type }}
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if (count($row->all_listing->heavy_equipments) === 1)
                                                        @foreach ($row->all_listing->heavy_equipments as $vehcile)
                                                            <a style="color: #0d6efd; font-weight: 800;"
                                                                href='https://www.google.com/search?q={{ $vehcile->Equipment_Year }}%20{{ $vehcile->Equipment_Make }}%20{{ $vehcile->Equipment_Model }}'
                                                                target='_blank'>
                                                                {{ $vehcile->Equipment_Year }}
                                                                {{ $vehcile->Equipment_Make }}
                                                                {{ $vehcile->Equipment_Model }}
                                                            </a><br>
                                                            <b>L</b>{{ $vehcile->Equip_Length }} |
                                                            <b>W</b>{{ $vehcile->Equip_Width }}
                                                            | <b>H</b>{{ $vehcile->Equip_Height }}
                                                            | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                                        @endforeach
                                                    @endif
                                                    @if (count($row->all_listing->heavy_equipments) > 1)
                                                        <a style="color: #0d6efd; font-weight: 800;"
                                                            href="javascript:void(0)" tabindex="0" class=""
                                                            data-toggle="popover" data-trigger="focus"
                                                            style="cursor: pointer background-color: lightgrey;;"
                                                            title="Attached vehicles"
                                                            data-content="@foreach ($row->all_listing->heavy_equipments as $vehcile)
                                                                <a href='https://www.google.com/search?q={{ $vehcile->Equipment_Year }}%20{{ $vehcile->Equipment_Make }}%20{{ $vehcile->Equipment_Model }}' 
                                                                target='_blank'>
                                                                {{ $vehcile->Equipment_Year }} {{ $vehcile->Equipment_Make }} {{ $vehcile->Equipment_Model }}
                                                                </a><br>
                                                                <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} | <b>H</b>{{ $vehcile->Equip_Height }} | {{ $vehcile->Equip_Weight }} <b>LBS</b> @endforeach"
                                                            data-html="true">
                                                            vehicles
                                                            ({{ count($row->all_listing->heavy_equipments) }})
                                                        </a>
                                                    @endif
                                                    @if (count($row->all_listing->dry_vans) === 1)
                                                        @foreach ($row->all_listing->dry_vans as $vehcile)
                                                            <span title="Freight Class">
                                                                <a href="javascript:void(0)" tabindex="0"
                                                                    class="" data-toggle="popover"
                                                                    data-trigger="focus" style="cursor: pointer;"
                                                                    title="Freight Class" data-html="true">
                                                                    {{ $vehcile->Freight_Class }}
                                                                </a>
                                                            </span>
                                                            <span title="Freight Weight">

                                                                <a href="javascript:void(0)" tabindex="0"
                                                                    class="" data-toggle="popover"
                                                                    data-trigger="focus" style="cursor: pointer;"
                                                                    title="Freight Weight"
                                                                    data-html="true">{{ $vehcile->Freight_Weight }}
                                                                </a>
                                                            </span> <b>LBS</b><br>
                                                            @if ($vehcile->is_hazmat_Check !== 0)
                                                                Hazmat Required<br>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @if (count($row->all_listing->dry_vans) > 1)
                                                        <a href="javascript:void(0)" tabindex="0" class=""
                                                            data-toggle="popover" data-trigger="focus"
                                                            style="cursor: pointer;" title="Attached vehicles"
                                                            data-content=
                                                                "@foreach ($row->all_listing->dry_vans as $vehcile)
                                                                <span title='Freight Class'>{{ $vehcile->Freight_Class }}</span>
                                                                <span title='Freight Weight'>{{ $vehcile->Freight_Weight }}</span> <b>LBS</b><br>
                                                                @if ($vehcile->is_hazmat_Check !== 0)
                                                                    Hazmat Required<br>
                                                                @endif @endforeach"
                                                            data-html="true">vehicles
                                                            ({{ count($row->all_listing->dry_vans) }})
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>${{ $row->all_listing->paymentinfo->Price_Pay_Carrier }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="d-flex justify-content-center align-items-center"
                                        style="height: 185px; background-color: #f7f7f7;">
                                        <p class="text-center text-muted" style="font-size: 1.25rem;">No recent entries
                                        </p>
                                    </div>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12 mb-3">
            <div class="card recent-orders-box mb-30 h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="text-dark">Pickup</h3>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Company</th>
                                    <th></th>
                                    <th>Date</th>
                                    <th>Vehicle</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($pickup->isNotEmpty())
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach ($pickup as $key => $row)
                                        @php
                                            $count = $count++;
                                        @endphp
                                        @if ($row->all_listing && $count <= 4)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('global.search.index', ['search_criteria' => 1, 'search_query' => $row->all_listing->Ref_ID]) }}"
                                                        class="text-decoration-none text-black font-bold">
                                                        #{{ $row->all_listing->Ref_ID }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('View.Profile', $row->waiting_users->id) }}"
                                                        class="text-decoration-none text-black font-bold">
                                                        {{ $row->waiting_users->Company_Name }}
                                                    </a>
                                                </td>
                                                <td class="name">
                                                <td>{{ \Carbon\Carbon::parse($row->created_at)->format('M d, Y') }}</td>
                                                <td>
                                                    @if (count($row->all_listing->vehicles) === 1)
                                                        @foreach ($row->all_listing->vehicles as $vehcile)
                                                            @php
                                                                $vehicleName =
                                                                    $vehcile->Vehcile_Year .
                                                                    ' ' .
                                                                    $vehcile->Vehcile_Make .
                                                                    ' ' .
                                                                    $vehcile->Vehcile_Model;
                                                                $firstThreeWords = implode(
                                                                    ' ',
                                                                    array_slice(explode(' ', $vehicleName), 0, 3),
                                                                );
                                                            @endphp
                                                            <span
                                                                class="@if ($vehcile->Vehcile_Condition == 'Not Running') text-danger @else text-success @endif">{{ $firstThreeWords }}</span>
                                                        @endforeach
                                                    @endif
                                                    @if (count($row->all_listing->vehicles) > 1)
                                                        <div class="dropdown">
                                                            <a href="javascript:void(0)" class="dropdown-toggle"
                                                                data-toggle="dropdown"
                                                                style="color: #0d6efd; font-weight: 800; cursor: pointer;">
                                                                Vehicles
                                                                ({{ count($row->all_listing->vehicles) }})
                                                            </a>
                                                            <div class="dropdown-menu text-center">
                                                                <h6 class="dropdown-header"
                                                                    style="background-color: lightgrey;">
                                                                    Attached Vehicles</h6>
                                                                @foreach ($row->all_listing->vehicles as $vehicle)
                                                                    <a class="dropdown-item"
                                                                        style="color: #0d6efd; font-weight: 800;"
                                                                        href="https://www.google.com/search?q={{ $vehicle->Vehcile_Year }}%20{{ $vehicle->Vehcile_Make }}%20{{ $vehicle->Vehcile_Model }}"
                                                                        target="_blank">
                                                                        {{ $vehicle->Vehcile_Year }}
                                                                        {{ $vehicle->Vehcile_Make }}
                                                                        {{ $vehicle->Vehcile_Model }}
                                                                    </a>
                                                                    @if (!empty($vehicle->Vehcile_Condition))
                                                                        <div
                                                                            class="badge rounded-pill bg-success text-white">
                                                                            {{ $vehicle->Vehcile_Condition }}
                                                                        </div>
                                                                    @endif
                                                                    @if (!empty($vehicle->Trailer_Type))
                                                                        <div
                                                                            class="dropdown-item @if ($vehicle->Trailer_Type == "'(Enclosed Trailer Required)'") badge rounded-pill bg-success text-white @endif">
                                                                            {{ $vehicle->Trailer_Type }}
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if (count($row->all_listing->heavy_equipments) === 1)
                                                        @foreach ($row->all_listing->heavy_equipments as $vehcile)
                                                            <a style="color: #0d6efd; font-weight: 800;"
                                                                href='https://www.google.com/search?q={{ $vehcile->Equipment_Year }}%20{{ $vehcile->Equipment_Make }}%20{{ $vehcile->Equipment_Model }}'
                                                                target='_blank'>
                                                                {{ $vehcile->Equipment_Year }}
                                                                {{ $vehcile->Equipment_Make }}
                                                                {{ $vehcile->Equipment_Model }}
                                                            </a><br>
                                                            <b>L</b>{{ $vehcile->Equip_Length }} |
                                                            <b>W</b>{{ $vehcile->Equip_Width }}
                                                            | <b>H</b>{{ $vehcile->Equip_Height }}
                                                            | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                                        @endforeach
                                                    @endif
                                                    @if (count($row->all_listing->heavy_equipments) > 1)
                                                        <a style="color: #0d6efd; font-weight: 800;"
                                                            href="javascript:void(0)" tabindex="0" class=""
                                                            data-toggle="popover" data-trigger="focus"
                                                            style="cursor: pointer background-color: lightgrey;;"
                                                            title="Attached vehicles"
                                                            data-content="@foreach ($row->all_listing->heavy_equipments as $vehcile)
                                                                <a href='https://www.google.com/search?q={{ $vehcile->Equipment_Year }}%20{{ $vehcile->Equipment_Make }}%20{{ $vehcile->Equipment_Model }}' 
                                                                target='_blank'>
                                                                {{ $vehcile->Equipment_Year }} {{ $vehcile->Equipment_Make }} {{ $vehcile->Equipment_Model }}
                                                                </a><br>
                                                                <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} | <b>H</b>{{ $vehcile->Equip_Height }} | {{ $vehcile->Equip_Weight }} <b>LBS</b> @endforeach"
                                                            data-html="true">
                                                            vehicles
                                                            ({{ count($row->all_listing->heavy_equipments) }})
                                                        </a>
                                                    @endif
                                                    @if (count($row->all_listing->dry_vans) === 1)
                                                        @foreach ($row->all_listing->dry_vans as $vehcile)
                                                            <span title="Freight Class">
                                                                <a href="javascript:void(0)" tabindex="0"
                                                                    class="" data-toggle="popover"
                                                                    data-trigger="focus" style="cursor: pointer;"
                                                                    title="Freight Class" data-html="true">
                                                                    {{ $vehcile->Freight_Class }}
                                                                </a>
                                                            </span>
                                                            <span title="Freight Weight">

                                                                <a href="javascript:void(0)" tabindex="0"
                                                                    class="" data-toggle="popover"
                                                                    data-trigger="focus" style="cursor: pointer;"
                                                                    title="Freight Weight"
                                                                    data-html="true">{{ $vehcile->Freight_Weight }}
                                                                </a>
                                                            </span> <b>LBS</b><br>
                                                            @if ($vehcile->is_hazmat_Check !== 0)
                                                                Hazmat Required<br>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @if (count($row->all_listing->dry_vans) > 1)
                                                        <a href="javascript:void(0)" tabindex="0" class=""
                                                            data-toggle="popover" data-trigger="focus"
                                                            style="cursor: pointer;" title="Attached vehicles"
                                                            data-content=
                                                                "@foreach ($row->all_listing->dry_vans as $vehcile)
                                                                <span title='Freight Class'>{{ $vehcile->Freight_Class }}</span>
                                                                <span title='Freight Weight'>{{ $vehcile->Freight_Weight }}</span> <b>LBS</b><br>
                                                                @if ($vehcile->is_hazmat_Check !== 0)
                                                                    Hazmat Required<br>
                                                                @endif @endforeach"
                                                            data-html="true">vehicles
                                                            ({{ count($row->all_listing->dry_vans) }})
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>${{ $row->all_listing->paymentinfo->Price_Pay_Carrier }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">
                                            <div class="d-flex justify-content-center align-items-center"
                                                style="height: 185px; background-color: #f7f7f7;">
                                                <p class="text-center text-muted" style="font-size: 1.25rem;">No recent
                                                    entries</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 mb-3">
            <div class="card recent-orders-box mb-30 h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="text-dark">Delivered</h3>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Company</th>
                                    <th></th>
                                    <th>Date</th>
                                    <th>Vehicle</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($delivered->isNotEmpty())
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach ($delivered as $key => $row)
                                        @php
                                            $count = $count++;
                                        @endphp
                                        @if ($row->all_listing && $count <= 4)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('global.search.index', ['search_criteria' => 1, 'search_query' => $row->all_listing->Ref_ID]) }}"
                                                        class="text-decoration-none text-black font-bold">
                                                        #{{ $row->all_listing->Ref_ID }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('View.Profile', $row->waiting_users->id) }}"
                                                        class="text-decoration-none text-black font-bold">
                                                        {{ $row->waiting_users->Company_Name }}
                                                    </a>
                                                </td>
                                                <td class="name">
                                                <td>{{ \Carbon\Carbon::parse($row->created_at)->format('M d, Y') }}</td>
                                                <td>
                                                    @if (count($row->all_listing->vehicles) === 1)
                                                        @foreach ($row->all_listing->vehicles as $vehcile)
                                                            @php
                                                                $vehicleName =
                                                                    $vehcile->Vehcile_Year .
                                                                    ' ' .
                                                                    $vehcile->Vehcile_Make .
                                                                    ' ' .
                                                                    $vehcile->Vehcile_Model;
                                                                $firstThreeWords = implode(
                                                                    ' ',
                                                                    array_slice(explode(' ', $vehicleName), 0, 3),
                                                                );
                                                            @endphp
                                                            <span
                                                                class="@if ($vehcile->Vehcile_Condition == 'Not Running') text-danger @else text-success @endif">{{ $firstThreeWords }}</span>
                                                        @endforeach
                                                    @endif
                                                    @if (count($row->all_listing->vehicles) > 1)
                                                        <div class="dropdown">
                                                            <a href="javascript:void(0)" class="dropdown-toggle"
                                                                data-toggle="dropdown"
                                                                style="color: #0d6efd; font-weight: 800; cursor: pointer;">
                                                                Vehicles
                                                                ({{ count($row->all_listing->vehicles) }})
                                                            </a>
                                                            <div class="dropdown-menu text-center">
                                                                <h6 class="dropdown-header"
                                                                    style="background-color: lightgrey;">
                                                                    Attached Vehicles</h6>
                                                                @foreach ($row->all_listing->vehicles as $vehicle)
                                                                    <a class="dropdown-item"
                                                                        style="color: #0d6efd; font-weight: 800;"
                                                                        href="https://www.google.com/search?q={{ $vehicle->Vehcile_Year }}%20{{ $vehicle->Vehcile_Make }}%20{{ $vehicle->Vehcile_Model }}"
                                                                        target="_blank">
                                                                        {{ $vehicle->Vehcile_Year }}
                                                                        {{ $vehicle->Vehcile_Make }}
                                                                        {{ $vehicle->Vehcile_Model }}
                                                                    </a>
                                                                    @if (!empty($vehicle->Vehcile_Condition))
                                                                        <div
                                                                            class="badge rounded-pill bg-success text-white">
                                                                            {{ $vehicle->Vehcile_Condition }}
                                                                        </div>
                                                                    @endif
                                                                    @if (!empty($vehicle->Trailer_Type))
                                                                        <div
                                                                            class="dropdown-item @if ($vehicle->Trailer_Type == "'(Enclosed Trailer Required)'") badge rounded-pill bg-success text-white @endif">
                                                                            {{ $vehicle->Trailer_Type }}
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if (count($row->all_listing->heavy_equipments) === 1)
                                                        @foreach ($row->all_listing->heavy_equipments as $vehcile)
                                                            <a style="color: #0d6efd; font-weight: 800;"
                                                                href='https://www.google.com/search?q={{ $vehcile->Equipment_Year }}%20{{ $vehcile->Equipment_Make }}%20{{ $vehcile->Equipment_Model }}'
                                                                target='_blank'>
                                                                {{ $vehcile->Equipment_Year }}
                                                                {{ $vehcile->Equipment_Make }}
                                                                {{ $vehcile->Equipment_Model }}
                                                            </a><br>
                                                            <b>L</b>{{ $vehcile->Equip_Length }} |
                                                            <b>W</b>{{ $vehcile->Equip_Width }}
                                                            | <b>H</b>{{ $vehcile->Equip_Height }}
                                                            | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                                        @endforeach
                                                    @endif
                                                    @if (count($row->all_listing->heavy_equipments) > 1)
                                                        <a style="color: #0d6efd; font-weight: 800;"
                                                            href="javascript:void(0)" tabindex="0" class=""
                                                            data-toggle="popover" data-trigger="focus"
                                                            style="cursor: pointer background-color: lightgrey;;"
                                                            title="Attached vehicles"
                                                            data-content="@foreach ($row->all_listing->heavy_equipments as $vehcile)
                                                                <a href='https://www.google.com/search?q={{ $vehcile->Equipment_Year }}%20{{ $vehcile->Equipment_Make }}%20{{ $vehcile->Equipment_Model }}' 
                                                                target='_blank'>
                                                                {{ $vehcile->Equipment_Year }} {{ $vehcile->Equipment_Make }} {{ $vehcile->Equipment_Model }}
                                                                </a><br>
                                                                <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} | <b>H</b>{{ $vehcile->Equip_Height }} | {{ $vehcile->Equip_Weight }} <b>LBS</b> @endforeach"
                                                            data-html="true">
                                                            vehicles
                                                            ({{ count($row->all_listing->heavy_equipments) }})
                                                        </a>
                                                    @endif
                                                    @if (count($row->all_listing->dry_vans) === 1)
                                                        @foreach ($row->all_listing->dry_vans as $vehcile)
                                                            <span title="Freight Class">
                                                                <a href="javascript:void(0)" tabindex="0"
                                                                    class="" data-toggle="popover"
                                                                    data-trigger="focus" style="cursor: pointer;"
                                                                    title="Freight Class" data-html="true">
                                                                    {{ $vehcile->Freight_Class }}
                                                                </a>
                                                            </span>
                                                            <span title="Freight Weight">

                                                                <a href="javascript:void(0)" tabindex="0"
                                                                    class="" data-toggle="popover"
                                                                    data-trigger="focus" style="cursor: pointer;"
                                                                    title="Freight Weight"
                                                                    data-html="true">{{ $vehcile->Freight_Weight }}
                                                                </a>
                                                            </span> <b>LBS</b><br>
                                                            @if ($vehcile->is_hazmat_Check !== 0)
                                                                Hazmat Required<br>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @if (count($row->all_listing->dry_vans) > 1)
                                                        <a href="javascript:void(0)" tabindex="0" class=""
                                                            data-toggle="popover" data-trigger="focus"
                                                            style="cursor: pointer;" title="Attached vehicles"
                                                            data-content=
                                                                "@foreach ($row->all_listing->dry_vans as $vehcile)
                                                                <span title='Freight Class'>{{ $vehcile->Freight_Class }}</span>
                                                                <span title='Freight Weight'>{{ $vehcile->Freight_Weight }}</span> <b>LBS</b><br>
                                                                @if ($vehcile->is_hazmat_Check !== 0)
                                                                    Hazmat Required<br>
                                                                @endif @endforeach"
                                                            data-html="true">vehicles
                                                            ({{ count($row->all_listing->dry_vans) }})
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>${{ $row->all_listing->paymentinfo->Price_Pay_Carrier }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="d-flex justify-content-center align-items-center"
                                        style="height: 185px; background-color: #f7f7f7;">
                                        <p class="text-center text-muted" style="font-size: 1.25rem;">No recent entries
                                        </p>
                                    </div>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card mb-30">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="text-dark">Market Insights</h3>
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="bx bx-dots-horizontal-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bx bx-show"></i> View
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bx bx-edit-alt"></i> Edit
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bx bx-trash"></i> Delete
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bx bx-printer"></i> Print
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bx bx-download"></i> Download
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="position: relative;">
                    <div id="revenue-growth-chart" class="extra-margin" style="min-height: 365px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12  ">
            <div class="card ">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="text-dark ">Monthly Status</h3>
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="bx bx-dots-horizontal-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bx bx-download"></i> Download
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="position: relative;">
                    <div id="website-analytics-chart" class="extra-margin" style="min-height: 320px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @if (Auth::guard('Authorized')->user()->usr_type == 'Carrier')
         <div class="col-lg-6 col-md-12">
            <div class="card h-100 mb-30 social-marketing-box">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="text-dark">Saved Filters</h3>
                </div>
                <div class="card-body">
                    @foreach ($savedFilters as $row)
                        <div class="list ps-0">
                            {{-- <div class="icon facebook">
                                <i class="bx bxl-facebook"></i>
                            </div> --}}

                            <h4 class="mb-1 fs-5">
                                <a href="{{ route('Filterd.Listing', ['filterName' => $row->name]) }}"
                                    class="d-inline-block">
                                    <span class="icon-base">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-filter">
                                            <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                                        </svg>
                                    </span>
                                    {{ $row->name }}</a>
                            </h4>
                            <p class="mb-0">{{ $row->updated_at->format('d M Y') }}</p>
                            <div class="stats">
                                <button
                                    onclick="window.location.href='{{ route('Filterd.Listing', ['filterName' => $row->name]) }}'"
                                    class="btn btn-outline-danger rounded-pill">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="22"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-navigation">
                                        <polygon points="3 11 22 2 13 21 11 13 3 11"></polygon>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
         </div>
         @else 
         <div class="col-lg-6 col-md-12">
            <div class="card h-100 mb-30 social-marketing-box">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="text-dark">My Contacts</h3>
                   
                </div>
                <div class="table-responsive">
                    <table class="table table-striped"  >
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>title</th>
                                <th>Email Address</th>
                                <th>Phone Number</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            @foreach ( $User_Info as $contact )     
                            <tr>
                                <td>{{ $contact->CMP_Name }}</td>
                                <td>{{ $contact->Title }}</td>
                                <td>{{ $contact->CMP_Address }}</td>
                                <td>{{ $contact->CMP_Phone_Number }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
         </div>
         @endif
        
        <div class="col-lg-3 col-md-9">
            <div class="card h-100 mb-30 new-customer-box">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="text-dark">My Tasks</h3>

                    <a type="button" class="add-task add"> <i class="fa-solid fa-plus"></i></a>
                </div>
                <div class="card-body widget-todo-list">
                    <ul>
                        @foreach ($todo as $row)
                            <li class="ps-0">
                                <div class="todo-item-title">
                                    <h3 id="myTask" data-task-id="{{ $row->id }}">{{ $row->task_title }}
                                        <p>{{ $row->task_description }}</p>
                                </div>
                                <div class="todo-item-action">
                                    {{-- <a type="button" class="add-task add">
                                        <i class="fa-solid fa-plus"></i></a> --}}
                                    <a type="button" class="edit-task edit" data-task-id="{{ $row->id }}"><i
                                            class="bx bx-edit-alt"></i></a>
                                    <a href="{{ route('tasks.destroy2', $row->id) }}" class="delete delete-task"
                                        data-id="{{ $row->id }}">
                                        <i class="bx bx-trash"></i>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-9">
            <div class="card h-100 top-rated-product-box mb-30">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="text-dark">Recent Ratings</h3>
                </div>

                <div class="card-body">
                    <ul>
                        {{-- @foreach ($recentRatings as $row)
                            <li class="single-product">

                                <h4 class="mb-2"><a href="#"
                                        class="d-inline-block">{{ $row->rated_user->Company_Name }}</a></h4>
                                <div class="rating d-inline-block">
                                    @php
                                        if (!function_exists('getUserRating')) {
                                            function getUserRating($userId)
                                            {
                                                $orderRatings = app(\App\Services\OrderRatings::class);
                                                $ratings = $orderRatings->getUserRating($userId);
                                                $ratingsCount = $orderRatings->getUserRatingRecords($userId)->count();

                                                return [
                                                    'ratings' => $ratings,
                                                    'count' => $ratingsCount,
                                                ];
                                            }
                                        }

                                        $userRatings = getUserRating($row->rated_user->id);
                                        $ratings = $userRatings['ratings'];
                                        $ratingsCount = $userRatings['count'];

                                        $avg_rating = $ratings
                                            ? array_sum([
                                                    $ratings->ratings_avg_timeliness,
                                                    $ratings->ratings_avg_communication,
                                                    $ratings->ratings_avg_documentation,
                                                ]) / 3
                                            : null;
                                    @endphp
                                    @if (isset($avg_rating))
                                        <div class="rating d-inline-block">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i
                                                    class="fa fa-star {{ $i <= $avg_rating ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                            {{ number_format($avg_rating, 1) }}
                                        </div>
                                        <p>{{ $recentRatings[0]->Rating_Comments }}</p>
                                    @else
                                        <span>No ratings yet.</span>
                                    @endif
                                </div>
                                <a href="#" class="view-link d-inline-block" data-toggle="tooltip"
                                    data-placement="top" title="" data-original-title="View Details"><i
                                        class="bx bxs-arrow-to-right"></i></a>
                            </li>
                        @endforeach --}}
                        @php
                            if (!function_exists('getUserRating')) {
                                function getUserRating($userId)
                                {
                                    $orderRatings = app(\App\Services\OrderRatings::class);
                                    $ratings = $orderRatings->getUserRating($userId);
                                    $ratingsCount = $orderRatings->getUserRatingRecords($userId)->count();

                                    return [
                                        'ratings' => $ratings,
                                        'count' => $ratingsCount,
                                    ];
                                }
                            }
                        @endphp

                        @foreach ($recentRatings as $row)
                            <li class="single-product">
                                <h4 class="mb-2">
                                    <a href="#" class="d-inline-block">{{ $row->all_listing->Ref_ID }}</a>
                                </h4>
                                <h4 class="mb-2">
                                    <a href="#" class="d-inline-block">{{ $row->rated_user->Company_Name }}</a>
                                </h4>

                                @php
                                    $userRatings = getUserRating($row->rated_user->id);
                                    $ratings = $userRatings['ratings'];
                                    $ratingsCount = $userRatings['count'];

                                    $avg_rating = $ratings
                                        ? array_sum([
                                                $ratings->ratings_avg_timeliness,
                                                $ratings->ratings_avg_communication,
                                                $ratings->ratings_avg_documentation,
                                            ]) / 3
                                        : null;
                                @endphp

                                @if (isset($avg_rating))
                                    <div class="rating d-inline-block">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i
                                                class="fa fa-star {{ $i <= $avg_rating ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                        {{ number_format($avg_rating, 1) }}
                                    </div>
                                    <p>{{ $row->Rating_Comments }}</p>
                                @else
                                    <span>No ratings yet.</span>
                                @endif
                                {{-- {{ dd($row->toArray()) }} --}}

                                <a href="#" class="view-link d-inline-block" data-toggle="tooltip"
                                    data-placement="top" title="View Details">
                                    <i class="bx bxs-arrow-to-right"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-3">
                <a class="text-decoration-none text-body" href="{{ route('Dispatch.Listing') }}"
                    class="text-decoration-none">
                    <div class="dashboard-card text-center">
                        <div class="icon-container">
                            <i class="fas fa-truck"></i>
                        </div>
                        <p class="stat-number" id="totalVehicles">{{ $orderCount['Dispatch'] }}</p>
                        <p class="stat-title">Dispatch</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a class="text-decoration-none text-body" href="{{ route('PickUp.Listing') }}"
                    class="text-decoration-none">
                    <div class="dashboard-card text-center"
                        style="background: linear-gradient(135deg, #28a745, #218838);">
                        <div class="icon-container">
                            <i class="fas fa-box"></i>
                        </div>
                        <p class="stat-number" id="activeDeliveries">{{ $orderCount['PickUp'] }}</p>
                        <p class="stat-title">Pickup</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a class="text-decoration-none text-body" href="{{ route('Delivered.Listing') }}"
                    class="text-decoration-none">
                    <div class="dashboard-card text-center"
                        style="background: linear-gradient(135deg, #ffc107, #ff9800);">
                        <div class="icon-container">
                            <i class="fas fa-clock"></i>
                        </div>
                        <p class="stat-number" id="pendingOrders">{{ $orderCount['Delivered'] }}</p>
                        <p class="stat-title">Delivered</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a class="text-decoration-none text-body" href="{{ route('Cancelled.Listing') }}"
                    class="text-decoration-none">
                    <div class="dashboard-card text-center"
                        style="background: linear-gradient(135deg, #b81717a6, #961313);">
                        <div class="icon-container">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <p class="stat-number" id="completedToday">{{ $orderCount['Cancelled'] }}</p>
                        <p class="stat-title">Cancelled</p>
                    </div>
            </div>
            </a>
        </div>
    </div> --}}
    {{-- <div class="container-fluid mt-5">
        <div class="dashboard">
            <h2 class="dashboard-title font-weight-bold">Recent Activities</h2>
            <div class="row mb-5">
                <div class="col-sm-6">
                    <div class="card recent-activity-card">
                        <div class="card-header p-3 border-bottom d-flex justify-content-center">
                            <h5 class="font-weight-bold text-danger">Waiting Approval</h5>
                            <i class="fas fa-clock text-danger mx-2 mb-1"></i>
                        </div>
                        <div class="card-body">
                            @if ($waiting->isNotEmpty())
                                <div class="owl-carousel owl-theme-1">
                                    @foreach ($waiting as $key => $row)
                                        @php
                                            $count = 1;
                                            $count = $count++;
                                        @endphp
                                        @if ($row->all_listing && $count < 3)
                                            <div class="item">
                                                <div class="activity-info">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                            <i class="fas fa-tag text-secondary fs-5 custom-style-"></i>
                                                            <span class="text-secondary fw-bold fs-4 custom-style-">Load
                                                                ID:</span>
                                                            <span
                                                                class="text-danger fs-5 custom-style-">{{ $row->all_listing->Ref_ID }}</span>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                            <i
                                                                class="fas fa-map-marker-alt text-secondary fs-5 custom-style-"></i>
                                                            <span
                                                                class="text-secondary fw-bold fs-4 custom-style-">Pickup:</span>
                                                            <span
                                                                class="text-danger fs-5 custom-style-">{{ $row->all_listing->routes->Origin_ZipCode }}</span>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                            <i
                                                                class="fas fa-dollar-sign text-secondary fs-5 custom-style-"></i>
                                                            <span
                                                                class="text-secondary fw-bold fs-4 custom-style-">Payment:</span>
                                                            <span
                                                                class="text-danger fs-5 custom-style-">{{ $row->all_listing->routes->Miles }}
                                                                miles |
                                                                ${{ DayDispatchHelper::PricePerMiles($row->all_listing->paymentinfo->COD_Amount, $row->all_listing->routes->Miles) }}
                                                                /miles</span>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                            <i class="fas fa-car text-secondary fs-5 custom-style-"></i>
                                                            <span
                                                                class="text-secondary fw-bold fs-4 custom-style-">Vehicle:</span>
                                                            @if (count($row->all_listing->vehicles) === 1)
                                                                @foreach ($row->all_listing->vehicles as $vehcile)
                                                                    @php
                                                                        $vehicleName =
                                                                            $vehcile->Vehcile_Year .
                                                                            ' ' .
                                                                            $vehcile->Vehcile_Make .
                                                                            ' ' .
                                                                            $vehcile->Vehcile_Model;
                                                                        $firstThreeWords = implode(
                                                                            ' ',
                                                                            array_slice(
                                                                                explode(' ', $vehicleName),
                                                                                0,
                                                                                3,
                                                                            ),
                                                                        );
                                                                    @endphp
                                                                    <a class="text-danger fs-5 custom-style-"
                                                                        href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                                        target="_blank" title="{{ $vehicleName }}">
                                                                        <span>{{ $firstThreeWords }}</span>
                                                                    </a>
                                                                @endforeach
                                                            @endif
                                                            @if (count($row->all_listing->vehicles) > 1)
                                                                <a href="javascript:void(0)" tabindex="0"
                                                                    class="" data-toggle="popover"
                                                                    data-trigger="focus" style="cursor: pointer;"
                                                                    title="Attached vehicles"
                                                                    data-content=
                                                                "@foreach ($row->all_listing->vehicles as $vehcile)
                                                                        {{ $vehcile->Vehcile_Year }}
                                                                        {{ $vehcile->Vehcile_Make }}
                                                                        {{ $vehcile->Vehcile_Model }}<br> @endforeach"
                                                                    data-html="true">vehicles
                                                                    <span>({{ count($row->all_listing->vehicles) }})</span>
                                                                </a>
                                                            @endif
                                                            @if (count($row->all_listing->heavy_equipments) === 1)
                                                                @foreach ($row->all_listing->heavy_equipments as $vehcile)
                                                                    <a>
                                                                        {{ $vehcile->Equipment_Year }}
                                                                        {{ $vehcile->Equipment_Make }}
                                                                        {{ $vehcile->Equipment_Model }} </a><br>
                                                                    <b>L</b>{{ $vehcile->Equip_Length }} |
                                                                    <b>W</b>{{ $vehcile->Equip_Width }}
                                                                    | <b>H</b>{{ $vehcile->Equip_Height }}
                                                                    | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                                                @endforeach
                                                            @endif
                                                            @if (count($row->all_listing->heavy_equipments) > 1)
                                                                <a href="javascript:void(0)" tabindex="0"
                                                                    class="" data-toggle="popover"
                                                                    data-trigger="focus" style="cursor: pointer;"
                                                                    title="Attached vehicles"
                                                                    data-content=
                                                                "@foreach ($row->all_listing->heavy_equipments as $vehcile)
                                                                {{ $vehcile->Equipment_Year }}
                                                                {{ $vehcile->Equipment_Make }}
                                                                {{ $vehcile->Equipment_Model }}<br>
                                                                    <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} | <b>H</b>{{ $vehcile->Equip_Height }} | {{ $vehcile->Equip_Weight }} <b>LBS</b> @endforeach"
                                                                    data-html="true">Vehicles
                                                                    (<span>{{ count($row->all_listing->heavy_equipments) }}</span>)
                                                                </a>
                                                            @endif
                                                            @if (count($row->all_listing->dry_vans) === 1)
                                                                @foreach ($row->all_listing->dry_vans as $vehcile)
                                                                    {{ $vehcile->Freight_Class }}
                                                                    {{ $vehcile->Freight_Weight }}<br>
                                                                    @if ($vehcile->is_hazmat_Check !== 0)
                                                                        Hazmat Required<br>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                            @if (count($row->all_listing->dry_vans) > 1)
                                                                <a href="javascript:void(0)" tabindex="0"
                                                                    class="" data-toggle="popover"
                                                                    data-trigger="focus" style="cursor: pointer;"
                                                                    title="Attached vehicles"
                                                                    data-content=
                                                                    "@foreach ($row->all_listing->dry_vans as $vehcile)
                                                                    {{ $vehcile->Freight_Class }}
                                                                    {{ $vehcile->Freight_Weight }}<br>
                                                                    @if ($vehcile->is_hazmat_Check !== 0)
                                                                        Hazmat Required<br>
                                                                    @endif @endforeach"
                                                                    data-html="true">Vehicles
                                                                    ({{ count($row->all_listing->dry_vans) }})
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                            <i
                                                                class="fas fa-truck-loading text-secondary fs-5 custom-style-"></i>
                                                            <span
                                                                class="text-secondary fw-bold fs-4 custom-style-">Delivered:</span>
                                                            <span
                                                                class="text-danger fs-5 custom-style-">{{ $row->all_listing->routes->Dest_ZipCode }}</span>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                            <i
                                                                class="fas fa-money-bill-wave text-secondary fs-5 custom-style-"></i>
                                                            <span class="text-secondary fw-bold fs-4 custom-style-">Pay
                                                                Mode:</span>
                                                            <span
                                                                class="text-danger fs-5 custom-style-">{{ !empty($row->all_listing->paymentinfo->COD_Method_Mode) ? $row->all_listing->paymentinfo->COD_Method_Mode : '' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <div class="d-flex justify-content-center align-items-center"
                                    style="height: 185px; background-color: #f7f7f7;">
                                    <p class="text-center text-muted" style="font-size: 1.25rem;">No recent entries</p>
                                </div>
                            @endif
                        </div>
                        <a href="{{ route('Waitings.Listing') }}" class="btn btn-primary text-center mx-5">View All
                            Waiting Approval</a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card recent-activity-card">
                        <div class="card-header p-3 border-bottom d-flex justify-content-center">
                            <h5 class="font-weight-bold text-danger">Recent Dispatch</h5>
                            <i class="fas fa-tag text-danger mx-2 mb-1"></i>
                        </div>
                        <div class="card-body">
                            @if ($dispatch->isNotEmpty())
                                <div class="owl-carousel owl-theme-2">
                                    @foreach ($dispatch as $key => $row)
                                        @php
                                            $count = 1;
                                            $count = $count++;
                                        @endphp
                                        @if ($row->all_listing && $count < 3)
                                            <div class="item">
                                                <div class="activity-info">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                            <i class="fas fa-tag text-secondary fs-5 custom-style-"></i>
                                                            <span class="text-secondary fw-bold fs-4 custom-style-">Load
                                                                ID:</span>
                                                            <span
                                                                class="text-danger fs-5 custom-style-">{{ $row->all_listing->Ref_ID }}</span>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                            <i
                                                                class="fas fa-map-marker-alt text-secondary fs-5 custom-style-"></i>
                                                            <span
                                                                class="text-secondary fw-bold fs-4 custom-style-">Pickup:</span>
                                                            <span
                                                                class="text-danger fs-5 custom-style-">{{ $row->all_listing->routes->Origin_ZipCode }}</span>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                            <i
                                                                class="fas fa-dollar-sign text-secondary fs-5 custom-style-"></i>
                                                            <span
                                                                class="text-secondary fw-bold fs-4 custom-style-">Payment:</span>
                                                            <span
                                                                class="text-danger fs-5 custom-style-">{{ $row->all_listing->routes->Miles }}
                                                                miles |
                                                                ${{ DayDispatchHelper::PricePerMiles($row->all_listing->paymentinfo->COD_Amount, $row->all_listing->routes->Miles) }}
                                                                /miles</span>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                            <i class="fas fa-car text-secondary fs-5 custom-style-"></i>
                                                            <span
                                                                class="text-secondary fw-bold fs-4 custom-style-">Vehicle:</span>
                                                            
                                                                @foreach ($row->all_listing->vehicles as $vehicle)
                                                                    @php
                                                                        $vehicleName =
                                                                            $vehicle->Vehcile_Year .
                                                                            ' ' .
                                                                            $vehicle->Vehcile_Make .
                                                                            ' ' .
                                                                            $vehicle->Vehcile_Model;
                                                                        $firstThreeWords = implode(
                                                                            ' ',
                                                                            array_slice(
                                                                                explode(' ', $vehicleName),
                                                                                0,
                                                                                3,
                                                                            ),
                                                                        );
                                                                    @endphp
                                                                    <a class="text-danger fs-5 custom-style-"
                                                                        href="https://www.google.com/search?q={{ $vehicle->Vehcile_Year }}%20{{ $vehicle->Vehcile_Make }}%20{{ $vehicle->Vehcile_Model }}"
                                                                        target="_blank" title="{{ $vehicleName }}">
                                                                        <span>{{ $firstThreeWords }}</span>
                                                                    </a>
                                                                @endforeach
                                                            @endif
                                                            @if (count($row->all_listing->vehicles) > 1)
                                                                <a href="javascript:void(0)" tabindex="0"
                                                                    class="" data-toggle="popover"
                                                                    data-trigger="focus" style="cursor: pointer;"
                                                                    title="Attached vehicles"
                                                                    data-content=
                                                                "@foreach ($row->all_listing->vehicles as $vehcile)
                                                                {{ $vehcile->Vehcile_Year }}
                                                                {{ $vehcile->Vehcile_Make }}
                                                                {{ $vehcile->Vehcile_Model }}<br> @endforeach"
                                                                    data-html="true">vehicles
                                                                    ({{ count($row->all_listing->vehicles) }})
                                                                </a>
                                                            @endif
                                                            @if (count($row->all_listing->heavy_equipments) === 1)
                                                                @foreach ($row->all_listing->heavy_equipments as $vehcile)
                                                                    <a class="font-weight-bold text-dark"
                                                                        href="https://www.google.com/search?q={{ $vehcile->Equipment_Year }}%20{{ $vehcile->Equipment_Make }}%20{{ $vehcile->Equipment_Model }}"
                                                                        target="_blank">
                                                                        <span class="fs-5"><strong>
                                                                                {{ $vehcile->Equipment_Year }}
                                                                                {{ $vehcile->Equipment_Make }}
                                                                                {{ $vehcile->Equipment_Model }}</strong></span></a><br>
                                                                    <b>L</b>{{ $vehcile->Equip_Length }} |
                                                                    <b>W</b>{{ $vehcile->Equip_Width }} |
                                                                    <b>H</b>{{ $vehcile->Equip_Height }}
                                                                    | {{ $vehcile->Equip_Weight }} <b>LBS</b> <br>
                                                                @endforeach
                                                            @endif
                                                            @if (count($row->all_listing->heavy_equipments) > 1)
                                                                <a href="javascript:void(0)" tabindex="0"
                                                                    class="" data-toggle="popover"
                                                                    data-trigger="focus" style="cursor: pointer;"
                                                                    title="Attached vehicles"
                                                                    data-content=
                                                                    "@foreach ($row->all_listing->heavy_equipments as $vehcile)
                                                                    {{ $vehcile->Equipment_Year }}
                                                                    {{ $vehcile->Equipment_Make }}
                                                                    {{ $vehcile->Equipment_Model }}<br>
                                                                        <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} | <b>H</b>{{ $vehcile->Equip_Height }} | {{ $vehcile->Equip_Weight }} <b>LBS</b> @endforeach"
                                                                    data-html="true">Equipments
                                                                    ({{ count($row->all_listing->heavy_equipments) }})
                                                                </a>
                                                            @endif
                                                            @if (count($row->all_listing->dry_vans) === 1)
                                                                @foreach ($row->all_listing->dry_vans as $vehcile)
                                                                    {{ $vehcile->Freight_Class }}
                                                                    {{ $vehcile->Freight_Weight }}<br>
                                                                    @if ($vehcile->is_hazmat_Check !== 0)
                                                                        Hazmat Required<br>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                            @if (count($row->all_listing->dry_vans) > 1)
                                                                <a href="javascript:void(0)" tabindex="0"
                                                                    class="" data-toggle="popover"
                                                                    data-trigger="focus" style="cursor: pointer;"
                                                                    title="Attached vehicles"
                                                                    data-content=
                                                                "@foreach ($row->all_listing->dry_vans as $vehcile)
                                                                {{ $vehcile->Freight_Class }}
                                                                {{ $vehcile->Freight_Weight }}<br>
                                                                @if ($vehcile->is_hazmat_Check !== 0)
                                                                    Hazmat Required<br>
                                                                @endif @endforeach"
                                                                    data-html="true">Vehicles
                                                                    ({{ count($row->all_listing->dry_vans) }})
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                            <i
                                                                class="fas fa-truck-loading text-secondary fs-5 custom-style-"></i>
                                                            <span
                                                                class="text-secondary fw-bold fs-4 custom-style-">Delivered:</span>
                                                            <span
                                                                class="text-danger fs-5 custom-style-">{{ $row->all_listing->routes->Dest_ZipCode }}</span>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                            <i
                                                                class="fas fa-money-bill-wave text-secondary fs-5 custom-style-"></i>
                                                            <span class="text-secondary fw-bold fs-4 custom-style-">Pay
                                                                Mode:</span>
                                                            <span
                                                                class="text-danger fs-5 custom-style-">{{ !empty($row->all_listing->paymentinfo->COD_Method_Mode) ? $row->all_listing->paymentinfo->COD_Method_Mode : '' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <div class="d-flex justify-content-center align-items-center"
                                    style="height: 185px; background-color: #f7f7f7;">
                                    <p class="text-center text-muted" style="font-size: 1.25rem;">No recent entries</p>
                                </div>
                            @endif
                        </div>
                        <a href="{{ route('Dispatch.Listing') }}" class="btn btn-primary text-center mx-5">View All
                            Dispatches</a>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-sm-6">
                    <div class="card recent-activity-card">
                        <div class="card-header p-3 border-bottom d-flex justify-content-center">
                            <h5 class="font-weight-bold text-danger">Recent Delivery</h5>
                            <i class="fas fa-truck-loading text-danger mx-2 mb-1"></i>
                        </div>
                        <div class="card-body">
                            @if ($delivered->isNotEmpty())
                                <div class="owl-carousel owl-theme-3">
                                    @foreach ($delivered as $key => $row)
                                        @php
                                            $count = 1;
                                            $count = $count++;
                                        @endphp
                                        @if ($row->all_listing && $count < 3)
                                            <div class="item">
                                                <div class="activity-info">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                            <i class="fas fa-tag text-secondary fs-5 custom-style-"></i>
                                                            <span class="text-secondary fw-bold fs-4 custom-style-">Load
                                                                ID:</span>
                                                            <span
                                                                class="text-danger fs-5 custom-style-">{{ $row->all_listing->Ref_ID }}</span>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                            <i
                                                                class="fas fa-map-marker-alt text-secondary fs-5 custom-style-"></i>
                                                            <span
                                                                class="text-secondary fw-bold fs-4 custom-style-">Pickup:</span>
                                                            <span
                                                                class="text-danger fs-5 custom-style-">{{ $row->all_listing->routes->Origin_ZipCode }}</span>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                            <i
                                                                class="fas fa-dollar-sign text-secondary fs-5 custom-style-"></i>
                                                            <span
                                                                class="text-secondary fw-bold fs-4 custom-style-">Payment:</span>
                                                            <span class="text-danger fs-5 custom-style-">$
                                                                {{ DayDispatchHelper::PricePerMiles($row->all_listing->paymentinfo->COD_Amount, $row->all_listing->routes->Miles) }}
                                                                /miles</span>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                            <i class="fas fa-car text-secondary fs-5 custom-style-"></i>
                                                            <span
                                                                class="text-secondary fw-bold fs-4 custom-style-">Vehicle:</span>
                                                            @if (count($row->all_listing->vehicles) === 1)
                                                                @foreach ($row->all_listing->vehicles as $vehcile)
                                                                    @php
                                                                        $vehicleName =
                                                                            $vehcile->Vehcile_Year .
                                                                            ' ' .
                                                                            $vehcile->Vehcile_Make .
                                                                            ' ' .
                                                                            $vehcile->Vehcile_Model;
                                                                        $firstThreeWords = implode(
                                                                            ' ',
                                                                            array_slice(
                                                                                explode(' ', $vehicleName),
                                                                                0,
                                                                                3,
                                                                            ),
                                                                        );
                                                                    @endphp
                                                                    <a class="text-danger fs-5 custom-style-"
                                                                        href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                                        target="_blank" title="{{ $vehicleName }}">
                                                                        <span>{{ $firstThreeWords }}</span>
                                                                    </a>
                                                                @endforeach
                                                            @endif
                                                            @if (count($row->all_listing->vehicles) > 1)
                                                                <div class="dropdown">
                                                                    <a href="javascript:void(0)" class="dropdown-toggle"
                                                                        data-toggle="dropdown"
                                                                        style="color: #0d6efd; font-weight: 800; cursor: pointer;">
                                                                        Vehicles
                                                                        ({{ count($row->all_listing->vehicles) }})
                                                                    </a>
                                                                    <div class="dropdown-menu text-center">
                                                                        <h6 class="dropdown-header"
                                                                            style="background-color: lightgrey;">
                                                                            Attached Vehicles</h6>
                                                                        @foreach ($row->all_listing->vehicles as $vehicle)
                                                                            <a class="dropdown-item"
                                                                                style="color: #0d6efd; font-weight: 800;"
                                                                                href="https://www.google.com/search?q={{ $vehicle->Vehcile_Year }}%20{{ $vehicle->Vehcile_Make }}%20{{ $vehicle->Vehcile_Model }}"
                                                                                target="_blank">
                                                                                {{ $vehicle->Vehcile_Year }}
                                                                                {{ $vehicle->Vehcile_Make }}
                                                                                {{ $vehicle->Vehcile_Model }}
                                                                            </a>
                                                                            @if (!empty($vehicle->Vehcile_Condition))
                                                                                <div
                                                                                    class="badge rounded-pill bg-success text-white">
                                                                                    {{ $vehicle->Vehcile_Condition }}
                                                                                </div>
                                                                            @endif
                                                                            @if (!empty($vehicle->Trailer_Type))
                                                                                <div
                                                                                    class="dropdown-item @if ($vehicle->Trailer_Type == "'(Enclosed Trailer Required)'") badge rounded-pill bg-success text-white @endif">
                                                                                    {{ $vehicle->Trailer_Type }}
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if (count($row->all_listing->heavy_equipments) === 1)
                                                                @foreach ($row->all_listing->heavy_equipments as $vehcile)
                                                                    <a style="color: #0d6efd; font-weight: 800;"
                                                                        href='https://www.google.com/search?q={{ $vehcile->Equipment_Year }}%20{{ $vehcile->Equipment_Make }}%20{{ $vehcile->Equipment_Model }}'
                                                                        target='_blank'>
                                                                        {{ $vehcile->Equipment_Year }}
                                                                        {{ $vehcile->Equipment_Make }}
                                                                        {{ $vehcile->Equipment_Model }}
                                                                    </a><br>
                                                                    <b>L</b>{{ $vehcile->Equip_Length }} |
                                                                    <b>W</b>{{ $vehcile->Equip_Width }}
                                                                    | <b>H</b>{{ $vehcile->Equip_Height }}
                                                                    | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                                                @endforeach
                                                            @endif
                                                            @if (count($row->all_listing->heavy_equipments) > 1)
                                                                <a style="color: #0d6efd; font-weight: 800;"
                                                                    href="javascript:void(0)" tabindex="0"
                                                                    class="" data-toggle="popover"
                                                                    data-trigger="focus"
                                                                    style="cursor: pointer background-color: lightgrey;;"
                                                                    title="Attached vehicles"
                                                                    data-content="@foreach ($row->all_listing->heavy_equipments as $vehcile)
                                                                    <a href='https://www.google.com/search?q={{ $vehcile->Equipment_Year }}%20{{ $vehcile->Equipment_Make }}%20{{ $vehcile->Equipment_Model }}' 
                                                                    target='_blank'>
                                                                    {{ $vehcile->Equipment_Year }} {{ $vehcile->Equipment_Make }} {{ $vehcile->Equipment_Model }}
                                                                    </a><br>
                                                                    <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} | <b>H</b>{{ $vehcile->Equip_Height }} | {{ $vehcile->Equip_Weight }} <b>LBS</b> @endforeach"
                                                                    data-html="true">
                                                                    vehicles
                                                                    ({{ count($row->all_listing->heavy_equipments) }})
                                                                </a>
                                                            @endif
                                                            @if (count($row->all_listing->dry_vans) === 1)
                                                                @foreach ($row->all_listing->dry_vans as $vehcile)
                                                                    <span title="Freight Class">
                                                                        <a href="javascript:void(0)" tabindex="0"
                                                                            class="" data-toggle="popover"
                                                                            data-trigger="focus" style="cursor: pointer;"
                                                                            title="Freight Class" data-html="true">
                                                                            {{ $vehcile->Freight_Class }}
                                                                        </a>
                                                                    </span>
                                                                    <span title="Freight Weight">

                                                                        <a href="javascript:void(0)" tabindex="0"
                                                                            class="" data-toggle="popover"
                                                                            data-trigger="focus" style="cursor: pointer;"
                                                                            title="Freight Weight"
                                                                            data-html="true">{{ $vehcile->Freight_Weight }}
                                                                        </a>
                                                                    </span> <b>LBS</b><br>
                                                                    @if ($vehcile->is_hazmat_Check !== 0)
                                                                        Hazmat Required<br>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                            @if (count($row->all_listing->dry_vans) > 1)
                                                                <a href="javascript:void(0)" tabindex="0"
                                                                    class="" data-toggle="popover"
                                                                    data-trigger="focus" style="cursor: pointer;"
                                                                    title="Attached vehicles"
                                                                    data-content=
                                                                    "@foreach ($row->all_listing->dry_vans as $vehcile)
                                                                    <span title='Freight Class'>{{ $vehcile->Freight_Class }}</span>
                                                                    <span title='Freight Weight'>{{ $vehcile->Freight_Weight }}</span> <b>LBS</b><br>
                                                                    @if ($vehcile->is_hazmat_Check !== 0)
                                                                        Hazmat Required<br>
                                                                    @endif @endforeach"
                                                                    data-html="true">vehicles
                                                                    ({{ count($row->all_listing->dry_vans) }})
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                            <i
                                                                class="fas fa-truck-loading text-secondary fs-5 custom-style-"></i>
                                                            <span
                                                                class="text-secondary fw-bold fs-4 custom-style-">Delivered:</span>
                                                            <span
                                                                class="text-danger fs-5 custom-style-">{{ $row->all_listing->routes->Dest_ZipCode }}</span>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                            <i
                                                                class="fas fa-money-bill-wave text-secondary fs-5 custom-style-"></i>
                                                            <span class="text-secondary fw-bold fs-4 custom-style-">Pay
                                                                Mode:</span>
                                                            <span
                                                                class="text-danger fs-5 custom-style-">{{ !empty($row->all_listing->paymentinfo->COD_Method_Mode) ? $row->all_listing->paymentinfo->COD_Method_Mode : '' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <div class="d-flex justify-content-center align-items-center"
                                    style="height: 185px; background-color: #f7f7f7;">
                                    <p class="text-center text-muted" style="font-size: 1.25rem;">No recent entries</p>
                                </div>
                            @endif
                        </div>
                        <a href="{{ route('Delivered.Listing') }}" class="btn btn-primary text-center mx-5">View All
                            Deliveries</a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card recent-activity-card">
                        <div class="card-header p-3 border-bottom d-flex justify-content-center">
                            <h5 class="font-weight-bold text-danger">Recent Pickup</h5>
                            <i class="fas fa-truck text-danger mx-2 mb-1"></i>
                        </div>
                        <div class="card-body">
                            @if ($pickup->isNotEmpty())
                                <div class="owl-carousel owl-theme-4">
                                    @foreach ($pickup as $key => $row)
                                        @php
                                            $count = 1;
                                            $count = $count++;
                                        @endphp
                                        @if ($row->all_listing && $count < 3)
                                            <div class="item">
                                                <div class="activity-info">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                            <i class="fas fa-tag text-secondary fs-5 custom-style-"></i>
                                                            <span class="text-secondary fw-bold fs-4 custom-style-">Load
                                                                ID:</span>
                                                            <span
                                                                class="text-danger fs-5 custom-style-">{{ $row->all_listing->Ref_ID }}</span>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                            <i
                                                                class="fas fa-map-marker-alt text-secondary fs-5 custom-style-"></i>
                                                            <span
                                                                class="text-secondary fw-bold fs-4 custom-style-">Pickup:</span>
                                                            <span
                                                                class="text-danger fs-5 custom-style-">{{ $row->all_listing->routes->Origin_ZipCode }}</span>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                            <i
                                                                class="fas fa-dollar-sign text-secondary fs-5 custom-style-"></i>
                                                            <span
                                                                class="text-secondary fw-bold fs-4 custom-style-">Payment:</span>
                                                            <span
                                                                class="text-danger fs-5 custom-style-">{{ $row->all_listing->routes->Miles }}
                                                                miles |
                                                                ${{ DayDispatchHelper::PricePerMiles($row->all_listing->paymentinfo->COD_Amount, $row->all_listing->routes->Miles) }}
                                                                /miles</span>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                            <i class="fas fa-car text-secondary fs-5 custom-style-"></i>
                                                            <span
                                                                class="text-secondary fw-bold fs-4 custom-style-">Vehicle:</span>
                                                            
                                                            @if (count($row->all_listing->vehicles) === 1)
                                                                @foreach ($row->all_listing->vehicles as $vehcile)
                                                                    
                                                                    @php
                                                                        $vehicleName =
                                                                            $vehcile->Vehcile_Year .
                                                                            ' ' .
                                                                            $vehcile->Vehcile_Make .
                                                                            ' ' .
                                                                            $vehcile->Vehcile_Model;
                                                                        $firstThreeWords = implode(
                                                                            ' ',
                                                                            array_slice(
                                                                                explode(' ', $vehicleName),
                                                                                0,
                                                                                3,
                                                                            ),
                                                                        );
                                                                    @endphp
                                                                    <a class="text-danger fs-5 custom-style-"
                                                                        href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                                        target="_blank" title="{{ $vehicleName }}">
                                                                        <span>{{ $firstThreeWords }}</span>
                                                                    </a>
                                                                @endforeach
                                                            @endif
                                                            @if (count($row->all_listing->vehicles) > 1)
                                                                <a href="javascript:void(0)" tabindex="0"
                                                                    class="" data-toggle="popover"
                                                                    data-trigger="focus" style="cursor: pointer;"
                                                                    title="Attached vehicles"
                                                                    data-content=
                                                                    "@foreach ($row->all_listing->vehicles as $vehcile)
                                                                    {{ $vehcile->Vehcile_Year }}
                                                                    {{ $vehcile->Vehcile_Make }}
                                                                    {{ $vehcile->Vehcile_Model }}<br> @endforeach"
                                                                    data-html="true">vehicles
                                                                    ({{ count($row->all_listing->vehicles) }})
                                                                </a>
                                                            @endif
                                                            @if (count($row->all_listing->heavy_equipments) === 1)
                                                                @foreach ($row->all_listing->heavy_equipments as $vehcile)
                                                                    <p class="ymm"> {{ $vehcile->Equipment_Year }}
                                                                        {{ $vehcile->Equipment_Make }}
                                                                        {{ $vehcile->Equipment_Model }}</p><br>
                                                                    <b>L</b>{{ $vehcile->Equip_Length }} |
                                                                    <b>W</b>{{ $vehcile->Equip_Width }} |
                                                                    <b>H</b>{{ $vehcile->Equip_Height }}
                                                                    | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                                                @endforeach
                                                            @endif
                                                            @if (count($row->all_listing->heavy_equipments) > 1)
                                                                <a href="javascript:void(0)" tabindex="0"
                                                                    class="" data-toggle="popover"
                                                                    data-trigger="focus" style="cursor: pointer;"
                                                                    title="Attached vehicles"
                                                                    data-content=
                                                                    "@foreach ($row->all_listing->heavy_equipments as $vehcile)
                                                                    {{ $vehcile->Equipment_Year }}
                                                                    {{ $vehcile->Equipment_Make }}
                                                                    {{ $vehcile->Equipment_Model }}<br>
                                                                        <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} | <b>H</b>{{ $vehcile->Equip_Height }} | {{ $vehcile->Equip_Weight }} <b>LBS</b> @endforeach"
                                                                    data-html="true">Vehicles
                                                                    ({{ count($row->all_listing->heavy_equipments) }})
                                                                </a>
                                                            @endif
                                                            @if (count($row->all_listing->dry_vans) === 1)
                                                                @foreach ($row->all_listing->dry_vans as $vehcile)
                                                                    {{ $vehcile->Freight_Class }}
                                                                    {{ $vehcile->Freight_Weight }}<br>
                                                                    @if ($vehcile->is_hazmat_Check !== 0)
                                                                        Hazmat Required<br>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                            @if (count($row->all_listing->dry_vans) > 1)
                                                                <a href="javascript:void(0)" tabindex="0"
                                                                    class="" data-toggle="popover"
                                                                    data-trigger="focus" style="cursor: pointer;"
                                                                    title="Attached vehicles"
                                                                    data-content=
                                                                    "@foreach ($row->all_listing->dry_vans as $vehcile)
                                                                    {{ $vehcile->Freight_Class }}
                                                                    {{ $vehcile->Freight_Weight }}<br>
                                                                    @if ($vehcile->is_hazmat_Check !== 0)
                                                                        Hazmat Required<br>
                                                                    @endif @endforeach"
                                                                    data-html="true">Vehicles
                                                                    ({{ count($row->all_listing->dry_vans) }})
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                            <i
                                                                class="fas fa-truck-loading text-secondary fs-5 custom-style-"></i>
                                                            <span
                                                                class="text-secondary fw-bold fs-4 custom-style-">Delivered:</span>
                                                            <span
                                                                class="text-danger fs-5 custom-style-">{{ $row->all_listing->routes->Dest_ZipCode }}</span>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                                            <i
                                                                class="fas fa-money-bill-wave text-secondary fs-5 custom-style-"></i>
                                                            <span class="text-secondary fw-bold fs-4 custom-style-">Pay
                                                                Mode:</span>
                                                            <span
                                                                class="text-danger fs-5 custom-style-">{{ !empty($row->all_listing->paymentinfo->COD_Method_Mode) ? $row->all_listing->paymentinfo->COD_Method_Mode : '' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <div class="d-flex justify-content-center align-items-center"
                                    style="height: 185px; background-color: #f7f7f7;">
                                    <p class="text-center text-muted" style="font-size: 1.25rem;">No recent entries</p>
                                </div>
                            @endif
                        </div>
                        <a href="{{ route('PickUp.Listing') }}" class="btn btn-primary text-center mx-5">View All
                            Pickups</a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <div class="container-fluid mt-3">
        <div class="card user-info-box shadow custom-style">
            <h3 class="dashboard-title">My Trucks</h3>
            <div class="row mb-4">
                <div class="col-lg-4 col-sm-4 col-md-4">
                    <div class="dashboard-card">
                        <h3 class="fw-bold stat-title">Trucks # 1</h3>
                        <h3 class="stat-number">Model Ford 2000</h3>
                        <div class="icon-container">
                            <i class="fas fa-truck"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4">
                    <div class="dashboard-card">
                        <h3 class="fw-bold stat-title">Trucks # 2</h3>
                        <h3 class="stat-number">Model Ford 2000</h3>
                        <div class="icon-container">
                            <i class="fas fa-truck"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4">
                    <div class="dashboard-card">
                        <h3 class="fw-bold stat-title">Trucks # 3</h3>
                        <h3 class="stat-number">Model Ford 2000</h3>
                        <div class="icon-container">
                            <i class="fas fa-truck"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- >>>>>>>>>>>>>>>>>>> Add Modal <<<<<<<<<<<<<<<<<<<< --}}
    <div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEventModalLabel">Add Task</h5>
                </div>
                <div class="modal-body">
                    <form id="addEventForm" action="{{ route('task.calendar.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="eventId" id="" value="0">
                        <div class="form-group">
                            <label for="eventTitle">Task Title</label>
                            <input name="task_title" type="text" class="form-control" id=""
                                placeholder="Enter task title" required>
                        </div>

                        <div class="form-group">
                            <label for="task_date">Start Task Date</label>
                            <input name="task_date" type="date" class="form-control" id=""
                                placeholder="Enter task date" required>
                        </div>

                        <div class="form-group">
                            <label for="task_time">Start Task Time</label>
                            <input name="task_time" type="time" class="form-control" id=""
                                placeholder="Enter task time" required>
                        </div>


                        <div class="form-group">
                            <label for="end_task_date">End Task Date</label>
                            <input name="end_task_date" type="date" class="form-control" id=""
                                placeholder="Enter task date" required>
                        </div>

                        <div class="form-group">
                            <label for="end_task_time">End Task Time</label>
                            <input name="end_task_time" type="time" class="form-control" id=""
                                placeholder="Enter task time" required>
                        </div>

                        <div class="form-group">
                            <label for="eventDescription">Task Description</label>
                            <textarea name="task_description" class="form-control" id="" placeholder="Enter task description" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-danger" id="deleteEvent">Delete</button> -->
                            <button type="button" class="btn btn-secondary" id="closeModal">Close</button>
                            <button type="submit" class="btn btn-primary" id="">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    {{-- *// >>>>>>>>>>>>>>>>>>Edit  Modal<<<<<<<<<<<<<<<<<<<<<//* --}}
    <div class="modal fade" id="editEventModal" tabindex="-1" role="dialog" aria-labelledby="editEventModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEventModalLabel">Edit Task</h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                </div>
                <div class="modal-body">
                    <form id="editEventForm" action="{{ route('task.calendar.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="eventId" id="eventId" value="0">
                        <div class="form-group">
                            <label for="eventTitle">Task Title</label>
                            <input name="task_title" type="text" class="form-control" id="eventTitle"
                                placeholder="Enter task title" required>
                        </div>

                        <div class="form-group">
                            <label for="task_date">Start Task Date</label>
                            <input name="task_date" type="date" class="form-control" id="task_date"
                                placeholder="Enter task date" required>
                        </div>

                        <div class="form-group">
                            <label for="task_time">Start Task Time</label>
                            <input name="task_time" type="time" class="form-control" id="task_time"
                                placeholder="Enter task time" required>
                        </div>


                        <div class="form-group">
                            <label for="end_task_date">End Task Date</label>
                            <input name="end_task_date" type="date" class="form-control" id="end_task_date"
                                placeholder="Enter task date" required>
                        </div>

                        <div class="form-group">
                            <label for="end_task_time">End Task Time</label>
                            <input name="end_task_time" type="time" class="form-control" id="end_task_time"
                                placeholder="Enter task time" required>
                        </div>

                        <div class="form-group">
                            <label for="eventDescription">Task Description</label>
                            <textarea name="task_description" class="form-control" id="eventDescription" placeholder="Enter task description"
                                required></textarea>
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-danger" id="deleteEvent">Delete</button> -->
                            <button type="button" class="btn btn-secondary" id="closeEditModal">Close</button>
                            <button type="submit" class="btn btn-primary" id="saveEvent">Save / Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- >>>>>>>>>>>>>>>>>>>>>>>>>>> Edit Task Javascript <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< --}}

    <script>
        $('body').on('click', '#closeEditModal', function(event) {
            // hide the modal
            $('#editEventModal').modal('hide');
        })

        $('body').on('click', '.edit-task', function(event) {

            event.preventDefault(); // Prevent the default link behavior
            var taskId = $(this).data('task-id'); // Get the value of data-task-id
            console.log('Task ID:', taskId); // Log the task ID to ensure it's correct
            $.ajax({
                url: '{{ route('Get.Task.Data') }}',
                method: 'GET',
                data: {
                    task_id: taskId
                },
                success: function(response) {
                    if (response && response['task']) {
                        $('#eventId').val(taskId);
                        $('#eventTitle').val(response['task']['task_title'] || '');
                        // Handle task_date
                        if (response['task']['task_date']) {
                            let isoDate = response['task']['task_date'];
                            let date = new Date(isoDate);
                            if (!isNaN(date.getTime())) { // Check if date is valid
                                let formattedDate = date.toISOString().split('T')[0];
                                $('#task_date').val(formattedDate);
                            } else {
                                console.error('Invalid task date:', isoDate);
                            }
                        } else {
                            $('#task_date').val(''); // Clear the input if no date is provided
                        }
                        // Handle end_task_date
                        if (response['task']['end_task_date']) {
                            let isoDate = response['task']['end_task_date'];
                            let date = new Date(isoDate);
                            if (!isNaN(date.getTime())) { // Check if date is valid
                                let formattedDate = date.toISOString().split('T')[0];
                                $('#end_task_date').val(formattedDate);
                            } else {
                                console.error('Invalid end task date:', isoDate);
                            }
                        } else {
                            $('#end_task_date').val(''); // Clear the input if no date is provided
                        }
                        // Handle task_time
                        $('#task_time').val(response['time'] || '');
                        // Handle end_task_time
                        $('#end_task_time').val(response['endtime'] || '');
                        // Handle task_description
                        $('#eventDescription').val(response['task']['task_description'] || '');
                        // Show the modal
                        $('#editEventModal').modal('show');

                    } else {
                        console.error('Response data is incomplete or missing the task object');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error('AJAX Error:', xhr);
                }
            });
        });

        // >>>>>>>>>>>>>>>>>>>>>>>>>>>>Add Task Javascript<<<<<<<<<<<<<<<<<<<<<<<< //
        // Show the modal
        $('body').on('click', '.add-task', function(event) {
            $('#addEventModal').modal('show');
        })
        // hide the modal
        $('body').on('click', '#closeModal', function(event) {
            $('#addEventModal').modal('hide');
        })
    </script>

    {{-- >>>>>>>>>>>>>>>>>>>>>>>>> My Tasks Popup Modal <<<<<<<<<<<<<<<<<<<<<< --}}
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Task Discription</h5>
                </div>
                <div class="modal-body">
                    <span id="task-discription"> </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="closeTaskModal"
                        data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('body').on('click', '#closeTaskModal', function(event) {
            $('#myModal').modal('hide');
        })
        $('body').on('click', '#myTask', function(event) {

            event.preventDefault(); // Prevent the default link behavior
            var taskId = $(this).data('task-id'); // Get the value of data-task-id
            console.log('Task ID:', taskId); // Log the task ID to ensure it's correct
            $.ajax({
                url: '{{ route('Get.Task.Data') }}',
                method: 'GET',
                data: {
                    task_id: taskId
                },
                success: function(response) {
                    if (response && response['task']) {
                        $('#eventId').val(taskId);
                        $('#eventTitle').val(response['task']['task_title'] || '');
                        // Handle task_date
                        if (response['task']['task_date']) {
                            let isoDate = response['task']['task_date'];
                            let date = new Date(isoDate);
                            if (!isNaN(date.getTime())) { // Check if date is valid
                                let formattedDate = date.toISOString().split('T')[0];
                                $('#task_date').val(formattedDate);
                            } else {
                                console.error('Invalid task date:', isoDate);
                            }
                        } else {
                            $('#task_date').val(''); // Clear the input if no date is provided
                        }
                        // Handle end_task_date
                        if (response['task']['end_task_date']) {
                            let isoDate = response['task']['end_task_date'];
                            let date = new Date(isoDate);
                            if (!isNaN(date.getTime())) { // Check if date is valid
                                let formattedDate = date.toISOString().split('T')[0];
                                $('#end_task_date').val(formattedDate);
                            } else {
                                console.error('Invalid end task date:', isoDate);
                            }
                        } else {
                            $('#end_task_date').val(''); // Clear the input if no date is provided
                        }

                        // Handle task_description
                        $('#task-discription').text(response['task']['task_description']);
                        // Show the modal
                        $('#myModal').modal('show');

                    } else {
                        console.error('Response data is incomplete or missing the task object');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error('AJAX Error:', xhr);
                }
            });
        });
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    {{-- <script>
        $(document).ready(function() {
            $(".owl-theme-1").owlCarousel({
                items: 1,
                loop: true,
                margin: 10,
                nav: false,
                dots: false,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                smartSpeed: 800,
                fluidSpeed: true,
                navText: [
                    '<i class="fas fa-chevron-left"></i>',
                    '<i class="fas fa-chevron-right"></i>'
                ],
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            });
        });
        $(document).ready(function() {
            $(".owl-theme-2").owlCarousel({
                items: 1,
                loop: true,
                margin: 10,
                nav: false,
                dots: false,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                smartSpeed: 800,
                fluidSpeed: true,
                navText: [
                    '<i class="fas fa-chevron-left"></i>',
                    '<i class="fas fa-chevron-right"></i>'
                ],
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            });
        });
        $(document).ready(function() {
            $(".owl-theme-3").owlCarousel({
                items: 1,
                loop: true,
                margin: 10,
                nav: false,
                dots: false,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                smartSpeed: 800,
                fluidSpeed: true,
                navText: [
                    '<i class="fas fa-chevron-left"></i>',
                    '<i class="fas fa-chevron-right"></i>'
                ],
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            });
        });
        $(document).ready(function() {
            $(".owl-theme-4").owlCarousel({
                items: 1,
                loop: true,
                margin: 10,
                nav: false,
                dots: false,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                smartSpeed: 800,
                fluidSpeed: true,
                navText: [
                    '<i class="fas fa-chevron-left"></i>',
                    '<i class="fas fa-chevron-right"></i>'
                ],
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            });
        });
    </script> --}}
    <script>
        function toggleDashboardView() {
            const switchElement = document.getElementById('dashboardSwitch');
            const userDashboardRoute = "{{ route('User.Dashboard') }}";
            const quoteDashboardRoute = "{{ route('Quote.Dashboard') }}";
            if (switchElement.checked) {
                window.location.href = quoteDashboardRoute;
            } else {
                window.location.href = userDashboardRoute;
            }
        }
    </script>
    <script>
        const months = @json($monthsRevGrowth);
        const totals = @json($totals);
    </script>
    @php
        $months = [];
        $carrierPrices = [];
        $billings = [];
        $owned = [];
        $gross = [];
        if ($revenue_summary instanceof \Illuminate\Support\Collection) {
            foreach ($revenue_summary as $data) {
                $months[] = $data['month'];
                $carrierPrices[] = round($data['carrier_price'] ?? 0);
                $billings[] = round($data['billing'] ?? 0);
                $owned[] = round($data['owned'] ?? 0);
                $gross[] = round($data['gross'] ?? 0);
            }
        } else {
            echo 'Error: Failed to retrieve revenue summary.';
        }
    @endphp
    @php
        $dispatchCountsArray = json_decode($dispatchCounts, true);
        $pickupCountsArray = json_decode($pickupCounts, true);
        $deliverCountsArray = json_decode($deliverCounts, true);
        $cancelCountsArray = json_decode($cancelCounts, true);
        $dispatchData = [];
        $pickupData = [];
        $deliverData = [];
        $cancelData = [];

        // Define months from Jan to Dec
        $allMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        // Fill missing months with 0 if they are not in the data
        $allMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        foreach ($allMonths as $month) {
            $dispatchData[$month] = 0;
            $pickupData[$month] = 0;
            $deliverData[$month] = 0;
            $cancelData[$month] = 0;
        }
        foreach ($dispatchCountsArray as $data) {
            if (is_array($data)) {
                if (array_key_exists($data['month'] - 1, $allMonths)) {
                    $dispatchData[$allMonths[$data['month'] - 1]] = $data['count'];
                }
            } else {
                $monthIndex = $data;
                if (isset($allMonths[$monthIndex - 1])) {
                    // Check for valid month index
                    $dispatchData[$allMonths[$monthIndex - 1]] = $data;
                }
            }
        }
        foreach ($pickupCountsArray as $data) {
            if (is_array($data)) {
                if (array_key_exists($data['month'] - 1, $allMonths)) {
                    $pickupData[$allMonths[$data['month'] - 1]] = $data['count'];
                }
            } else {
                $monthIndex = $data;
                if (isset($allMonths[$monthIndex - 1])) {
                    $pickupData[$allMonths[$monthIndex - 1]] = $data;
                }
            }
        }
        foreach ($deliverCountsArray as $data) {
            if (is_array($data)) {
                if (array_key_exists($data['month'] - 1, $allMonths)) {
                    $deliverData[$allMonths[$data['month'] - 1]] = $data['count'];
                }
            } else {
                $monthIndex = $data;
                if (isset($allMonths[$monthIndex - 1])) {
                    $deliverData[$allMonths[$monthIndex - 1]] = $data;
                }
            }
        }
        foreach ($cancelCountsArray as $data) {
            if (is_array($data)) {
                if (array_key_exists($data['month'] - 1, $allMonths)) {
                    $cancelData[$allMonths[$data['month'] - 1]] = $data['count'];
                }
            } else {
                $monthIndex = $data;
                if (isset($allMonths[$monthIndex - 1])) {
                    $cancelData[$allMonths[$monthIndex - 1]] = $data;
                }
            }
        }
        $dispatchData = array_values($dispatchData);
        $pickupData = array_values($pickupData);
        $deliverData = array_values($deliverData);
        $cancelData = array_values($cancelData);
    @endphp
    <script>
        (function($) {
            "use strict";
            jQuery(document).on('ready', function() {

                if (document.getElementById("revenue-summary-chart")) {
                    var options = {
                        chart: {
                            height: 350,
                            type: 'area',
                        },
                        dataLabels: {
                            enabled: false
                        },
                        colors: ['#008FFB', '#18D2B7', '#6a4ffc', '#f4a261'],
                        stroke: {
                            curve: 'smooth'
                        },
                        series: [{
                                name: 'Carrier Price',
                                data: @json($carrierPrices)
                            },
                            {
                                name: 'Billing',
                                data: @json($billings)
                            },
                            {
                                name: 'Owned',
                                data: @json($owned)
                            },
                            {
                                name: 'Gross',
                                data: @json($gross)
                            }
                        ],
                        xaxis: {
                            categories: @json($months),
                        }
                    };

                    var chart = new ApexCharts(
                        document.querySelector("#revenue-summary-chart"),
                        options
                    );
                    chart.render();
                }

                if (document.getElementById("revenue-growth-chart")) {
                    var options = {
                        chart: {
                            height: 400,
                            type: 'line',
                            shadow: {
                                enabled: false,
                                color: '#eeeeee',
                                top: 3,
                                left: 2,
                                blur: 3,
                                opacity: 1
                            },
                        },
                        stroke: {
                            width: 7,
                            curve: 'smooth'
                        },
                        series: [{
                            name: 'Price Per Mile',
                            data: totals
                        }],
                        // xaxis: {
                        //     categories: months,
                        //     labels: {rotate: -45, 
                        //         style: fontSize:'12px',
                        //     }
                        // },
                        xaxis: {
                            categories: months, // This should be an array of month names like ["Mar 2023", "Apr 2023", ...]
                            labels: {
                                rotate: -45,
                                style: {
                                    fontSize: '12px' // Corrected syntax
                                }
                            }
                        },
                        fill: {
                            type: 'gradient',
                            gradient: {
                                shade: 'dark',
                                gradientToColors: ['#1da1f2'],
                                shadeIntensity: 1,
                                type: 'horizontal',
                                opacityFrom: 1,
                                opacityTo: 1,
                                stops: [100, 100, 100, 100],
                            },
                        },
                        markers: {
                            size: 4,
                            opacity: 0.9,
                            colors: ["#1da1f2"],
                            strokeColor: "#ffffff",
                            strokeWidth: 2,
                            hover: {
                                size: 7,
                            }
                        }
                    };

                    var chart = new ApexCharts(
                        document.querySelector("#revenue-growth-chart"),
                        options
                    );
                    chart.render();
                }

                // if(document.getElementById("website-analytics-chart")){
                //     var options = {
                //         chart: {
                //             height: 305,
                //             type: 'bar',
                //         },
                //         plotOptions: {
                //             bar: {
                //                 horizontal: false,
                //                 columnWidth: '50%',
                //             },
                //         },
                //         dataLabels: {
                //             enabled: false
                //         },
                //         stroke: {
                //             show: true,
                //             width: 2,
                //             colors: ['transparent']
                //         },
                //         colors: ['#ea3a3b', '#4788ff', '#6a4ffc', '#ffb700', '#3bff48', '#ff5733', '#3a8dff'],
                //         series: [ {
                //             name: 'Dispatch',
                //             data: @json($dispatchData)
                //         }, {
                //             name: 'Pickup',
                //             data: @json($pickupData)
                //         }, {
                //             name: 'Delivered',
                //             data: @json($deliverData)
                //         }, {
                //             name: 'Cancelled',
                //             data: @json($cancelData)
                //         }],
                //         xaxis: {
                //             categories: @json($months),
                //         },
                //         fill: {
                //             opacity: 1
                //         },
                //         tooltip: {
                //             y: {
                //                 formatter: function (val) {
                //                     return " " + val + " "
                //                 }
                //             }
                //         }
                //     };
                //     var chart = new ApexCharts(
                //         document.querySelector("#website-analytics-chart"),
                //         options
                //     );
                //     chart.render();
                // }

                if (document.getElementById("website-analytics-chart")) {
                    var options = {
                        chart: {
                            height: 305,
                            type: 'bar',
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '50%',
                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ['transparent']
                        },
                        colors: ['#ea3a3b', '#4788ff', '#6a4ffc', '#ffb700'],
                        series: [{
                                name: 'Dispatch',
                                data: @json($dispatchData)
                            },
                            {
                                name: 'Pickup',
                                data: @json($pickupData)
                            },
                            {
                                name: 'Delivered',
                                data: @json($deliverData)
                            },
                            {
                                name: 'Cancelled',
                                data: @json($cancelData)
                            }
                        ],
                        xaxis: {
                            categories: @json($allMonths),
                        },
                        fill: {
                            opacity: 1
                        },
                        tooltip: {
                            y: {
                                formatter: function(val) {
                                    return " " + val + " ";
                                }
                            }
                        }
                    };

                    var chart = new ApexCharts(
                        document.querySelector("#website-analytics-chart"),
                        options
                    );
                    chart.render();
                }

            });
        })
        (jQuery);
    </script>
@endsection
