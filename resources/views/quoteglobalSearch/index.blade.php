@extends('layouts.authorizedQuote')
@section('content')

    @php
        use Illuminate\Support\Facades\Auth;
        $currentUser = Auth::guard('Authorized')->user();
    @endphp

    <div class="breadcrumb-area">
        <h1>{{ $currentUser->usr_type }} Quote </h1>

        <ol class="breadcrumb">
            <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>

            <li class="item">Quote Global Search</li>
        </ol>

    </div>
    <style>
        .custom-nav {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 10px 0;
            width: 100%;
            margin: 20px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .custom-tab {
            text-align: center;
            padding: 12px 20px;
            margin: 5px;
            background-color: #fff;
            border: 2px solid #e01f26;
            color: #e01f26;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .custom-tab:hover {
            background-color: #e01f26;
            color: #fff;
        }

        .active-tab {
            background-color: #e01f26;
            color: #fff;
            border: 2px solid #e01f26;
        }

        @media (max-width: 768px) {
            .custom-nav {
                width: 90%;
            }

            .custom-tab {
                font-size: 14px;
                padding: 10px;
            }
        }

        .status-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
            text-align: left;
        }

        .status-table thead tr {
            background-color: #e01f26;
            color: white;
            text-align: left;
        }

        .status-table th,
        .status-table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .status-table tbody tr:nth-of-type(odd) {
            background-color: #f3f3f3;
        }

        .status-table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .status-text {
            font-weight: bold;
            color: #333;
        }

        .date-text {
            color: #333;
        }

        .description-text {
            color: #333;
        }

        @media screen and (max-width: 600px) {
            .status-table {
                font-size: 14px;
            }
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
    <!-- End Breadcrumb Area -->
    @include('partials.quote-global-search')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table
                    class="display carrier dataTable advance-786 datatable-range text-center table-1 table-bordered table-cards">
                    <thead class="table-header">
                        <tr>
                            <th>ID</th>
                            <th>Company Info</th>
                            {{-- <th>Customer Info</th> --}}
                            <th>Routes</th>
                            <th>Load Details</th>
                            <th>Payments</th>
                            <th>Dates</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Lisiting as $List)
                            {{-- @if (!$auth_user->is_heavy_subscribe)
                            @continue($List->Listing_Type === 2)
                        @endif
                        @if (!$auth_user->is_dry_van_subscribe)
                            @continue($List->Listing_Type === 3)
                        @endif --}}
                            <tr class="card-row" data-status="active">
                                <td>
                                    {{-- @php
                                    $createdAt = \Carbon\Carbon::createFromFormat(
                                        'Y-m-d H:i:s',
                                        $List->getRawOriginal('created_at'),
                                    );
                                @endphp
                                @if ($createdAt->gte(\Carbon\Carbon::now()->subHours(12)) && $createdAt->lte(\Carbon\Carbon::now()))
                                    <form id="searchForm" action="{{ route('quote.global.search') }}"
                                        method="GET">
                                        <input type="hidden" id="new_listing" name="new_listing" value="new">
                                        <button type="submit" class="ribbon-box">
                                            <div class="ribbon-two ribbon-two-danger">
                                                <span>New</span>
                                            </div>
                                        </button>
                                    </form>
                                @endif --}}
                                    <span class="text-nowrap"
                                        style="font-size: x-large;"><strong>{{ $List->Ref_ID }}</strong></span><br>
                                    {{-- @if (count($List->attachments) > 0)
                                    <strong><a href="{{ route('Order.Attachments', ['List_ID' => $List->id]) }}"
                                            target="_blank">View Images</a></strong>
                                @endif --}}
                                    @if (count($List->attachments) > 0)
                                        <strong>
                                            <a class="text-nowrap"
                                                href="{{ route('Order.Attachments', ['List_ID' => $List->id]) }}"
                                                target="_blank">View Images</a></strong>
                                    @endif
                                    @if ($List->user_id === $currentUser->id)
                                        <br><button class="btn btn-dark text-white"
                                            onclick="window.location.href='{{ route('User.Quote.Delete', ['List_ID' => $List->id]) }}'">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    <span style="font-size: x-large; "><a target="_blank" class="locations-color"
                                            href="{{ route('View.Profile', ['user_id' => $List->authorized_user->id]) }}"><strong
                                                class="locations-color">{{ $List->authorized_user->Company_Name }}</strong></a>
                                    </span><br>
                                    <span class="text-nowrap">
                                        <strong>Contact: </strong>
                                        <a class="locations-color" href="tel:{{ $List->authorized_user->Contact_Phone }}">
                                            {{ $List->authorized_user->Contact_Phone }}
                                        </a>
                                    </span><br>
                                    <span><strong>Time: </strong>{{ $List->authorized_user->Hours_Operations }}</span>
                                    {{-- <strong><a
                                        href="{{ route('View.Profile', ['user_id' => $List->authorized_user->id]) }}">{{ $List->authorized_user->Company_Name }}</a></strong><br>
                                {{ $List->authorized_user->Contact_Phone }}<br>
                                {{ $List->authorized_user->Hours_Operations }}<br>
                                {{ $List->authorized_user->Time_Zone }} --}}
                                </td>
                                {{-- <td>
                                <strong>Customer Name: </strong>
                                {{ $List->Customer_Name }}
                                <br>
                                <strong>Customer Email: </strong>
                                {{ $List->Customer_Email }}
                                <br>
                                <strong>Customer Phone: </strong>
                                {{ $List->Customer_Phone }}
                                <br>
                            </td> --}}
                                <td>
                                    <div class="mb-2">
                                        <span class="fs-5"><strong>Pickup</strong></span><br>
                                        <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                            href="https://www.google.com/maps/place/{{ urlencode($List->routes->Origin_ZipCode) }}"
                                            target="_blank">
                                            {{-- <i class="fas fa-map-marker-alt text-success fs-30 m-0"></i> --}}
                                            {{ Str::replace(',', '-', $List->routes->Origin_ZipCode) }}
                                        </a>
                                    </div>
                                    <div class="mb-2">
                                        <span class="fs-5"><strong>Delivery</strong></span><br>
                                        <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                            href="https://www.google.com/maps/place/{{ urlencode($List->routes->Dest_ZipCode) }}"
                                            target="_blank">
                                            {{-- <i class="fas fa-map-marker-alt text-danger fs-30 m-0"></i> --}}
                                            {{ Str::replace(',', '-', $List->routes->Dest_ZipCode) }}
                                        </a>
                                    </div>
                                    <div class="mb-2">
                                        <span class="fs-5"><strong>
                                                <a class="btn btn-outline-primary text-decoration-none fw-bold"
                                                    href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                    target="_blank">View Route
                                                </a>
                                            </strong></span>
                                    </div>
                                    {{-- <a class="dropdown-item"
                                    href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                    target="_blank">View Route</a>
                                <i class="fas fa-map-marker-alt text-success fs-30"></i>

                                <a href="https://www.google.com/maps/place/{{ urlencode($List->routes->Origin_ZipCode) }}"
                                    target="_blank">
                                    {{ Str::replace(',', '-', $List->routes->Origin_ZipCode) }}
                                </a><br>

                                <i class="fas fa-map-marker-alt text-danger fs-30"></i>
                                <a href="https://www.google.com/maps/place/{{ urlencode($List->routes->Dest_ZipCode) }}"
                                    target="_blank">
                                    {{ Str::replace(',', '-', $List->routes->Dest_ZipCode) }}
                                </a> --}}
                                </td>
                                <td>
                                    @if (count($List->vehicles) === 1)
                                        @foreach ($List->vehicles as $vehcile)
                                            <a class="font-weight-bold text-dark"
                                                href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                target="_blank">
                                                <span class="fs-5"><strong>
                                                        {{ $vehcile->Vehcile_Year }}{{ $vehcile->Vehcile_Make }}{{ $vehcile->Vehcile_Model }}
                                                    </strong></span></a><br>
                                            <span class="text-nowrap">
                                                @if (!empty($vehcile->Vehcile_Condition))
                                                    <span
                                                        class="badge badge-pill mt-2 @if ($vehcile->Vehcile_Condition == 'Running') badge-success @elseif($vehcile->Vehcile_Condition == 'Not Running') badge-danger @else badge-primary @endif"
                                                        style="font-size: 16px;">
                                                        {{ $vehcile->Vehcile_Condition }}
                                                    </span>
                                                @endif
                                                @if (!empty($vehcile->Trailer_Type))
                                                    <span class="badge badge-primary " style="font-size: 16px;">
                                                        {{ $vehcile->Trailer_Type }}</span>
                                                @endif
                                            </span>
                                        @endforeach
                                    @endif
                                    @if (count($List->vehicles) > 1)
                                        <div class="dropdown d-block">
                                            <a href="javascript:void(0)"
                                                class="dropdown-toggle font-weight-bold d-inline-flex align-items-center text-dark text-decoration-none"
                                                data-toggle="dropdown"
                                                style="font-size: 21px; cursor: pointer;">Vehicles({{ count($List->vehicles) }})
                                            </a>
                                            <div class="dropdown-menu text-center"
                                                style="max-height: 200px; overflow-y: auto;">
                                                <h6 class="dropdown-header" style="background-color: lightgrey;">
                                                    Attached Vehicles</h6>
                                                @foreach ($List->vehicles as $vehicle)
                                                    <a class="dropdown-item badge-primary" style=" font-weight: 800;"
                                                        href="https://www.google.com/search?q={{ $vehicle->Vehcile_Year }}%20{{ $vehicle->Vehcile_Make }}%20{{ $vehicle->Vehcile_Model }}"
                                                        target="_blank">{{ $vehicle->Vehcile_Year }}
                                                        {{ $vehicle->Vehcile_Make }} {{ $vehicle->Vehcile_Model }}<br>

                                                        @if (!empty($vehicle->Vehcile_Condition))
                                                            <span
                                                                class="badge badge-pill mt-2 
                                                    @if ($vehicle->Vehcile_Condition == 'Running') badge-success 
                                                    @elseif($vehicle->Vehcile_Condition == 'Not Running') badge-danger 
                                                    @else badge-primary @endif"
                                                                style="font-size: 16px;">
                                                                {{ $vehicle->Vehcile_Condition }}
                                                            </span>
                                                        @endif

                                                        @if (!empty($vehicle->Trailer_Type))
                                                            <span
                                                                class="badge badge-pill mt-2 badge-primary font-weight-bold"
                                                                style="font-size: 16px;">{{ $vehicle->Trailer_Type }}</span>
                                                        @endif
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    @if (count($List->heavy_equipments) === 1)
                                        @foreach ($List->heavy_equipments as $vehcile)
                                            {{ $vehcile->Equipment_Year }}
                                            {{ $vehcile->Equipment_Make }}
                                            {{ $vehcile->Equipment_Model }}<br>
                                            <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }}
                                            | <b>H</b>{{ $vehcile->Equip_Height }}
                                            | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                            @if (!empty($vehcile->Equipment_Condition))
                                                <br>{{ $vehcile->Equipment_Condition }}<br>
                                            @endif
                                            @if (!empty($vehcile->Trailer_Type))
                                                <span
                                                    @if ($vehcile->Trailer_Type == '"(Enclosed Trailer Required)"') class="text-primary font-weight-bold" @endif>{{ $vehcile->Trailer_Type }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                    @if (count($List->heavy_equipments) > 1)
                                        <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                            data-trigger="focus" style="cursor: pointer;" title="Attached vehicles"
                                            data-content=
                                    "@foreach ($List->heavy_equipments as $vehcile)
                                    {{ $vehcile->Equipment_Year }}
                                    {{ $vehcile->Equipment_Make }}
                                    {{ $vehcile->Equipment_Model }}<br>
                                        <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} | <b>H</b>{{ $vehcile->Equip_Height }} | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                    @if (!empty($vehcile->Equipment_Condition))
                                        <br>{{ $vehcile->Equipment_Condition }}<br>
                                    @endif
                                    @if (!empty($vehcile->Trailer_Type))
                                        <span @if ($vehcile->Trailer_Type == "'(Enclosed Trailer Required)'") class='text-primary font-weight-bold' @endif>{{ $vehcile->Trailer_Type }}</span>
                                    @endif @endforeach"
                                            data-html="true">vehicles ({{ count($List->heavy_equipments) }})
                                        </a>
                                    @endif
                                    @if (count($List->dry_vans) === 1)
                                        @foreach ($List->dry_vans as $vehcile)
                                            <span title="Freight Class">
                                                <a href="javascript:void(0)" tabindex="0" class=""
                                                    data-toggle="popover" data-trigger="focus" style="cursor: pointer;"
                                                    title="Freight Class" data-html="true">
                                                    {{ $vehcile->Freight_Class }}
                                                </a>
                                            </span>
                                            <span title="Freight Weight">

                                                <a href="javascript:void(0)" tabindex="0" class=""
                                                    data-toggle="popover" data-trigger="focus" style="cursor: pointer;"
                                                    title="Freight Weight" data-html="true">{{ $vehcile->Freight_Weight }}
                                                </a>
                                            </span> <b>LBS</b><br>
                                            @if ($vehcile->is_hazmat_Check !== 0)
                                                Hazmat Required<br>
                                            @endif
                                        @endforeach
                                    @endif
                                    @if (count($List->dry_vans) > 1)
                                        <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                            data-trigger="focus" style="cursor: pointer;" title="Attached vehicles"
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
                                    <div class="dropdown mt-3">
                                        <a href="javascript:void(0)" tabindex="0"
                                            class="btn btn-outline-primary dropdown-toggle text-truncate"
                                            id="additionalTermsDropdown" role="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false" style="max-width: 200px;">
                                            {{ $List->additional_info->Additional_Terms }}Additional
                                            Terms
                                        </a>
                                        <div class="dropdown-menu p-3 shadow-sm" aria-labelledby="additionalTermsDropdown"
                                            style="max-width: 300px;">
                                            <p class="dropdown-item-text m-0 text-wrap">
                                                {{ !empty($List->additional_info->Additional_Terms)
                                                    ? $List->additional_info->Additional_Terms
                                                    : 'No additional terms available.' }}
                                            </p>
                                        </div>
                                    </div>
                                    {{-- <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                    data-trigger="focus" style="cursor: pointer;" title="Additional Terms"
                                    data-content=
                                "{{ !empty($List->additional_info->Additional_Terms) ? $List->additional_info->Additional_Terms : '' }}">
                                    {{ !empty($List->additional_info->Additional_Terms) ? Str::limit($List->additional_info->Additional_Terms, 20) : '...' }}</a> --}}
                                </td>
                                <td>
                                    <strong>Price to Pay: </strong>
                                    <span>${{ $List->paymentinfo->Price_Pay_Carrier }} </span>
                                    <br>
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
                                        <span>${{ $List->paymentinfo->COD_Amount }} </span>
                                        <br>
                                        <span class="text-nowrap"><strong>Pay Mode:
                                            </strong><br>{{ $List->paymentinfo->COD_Method_Mode }}</span><br>
                                    @endif
                                    <strong>Mile: </strong>{{ $List->routes->Miles }}miles<br>
                                    <strong>Price per Mile:</strong>
                                    @if ($List->paymentinfo)
                                        ${{ DayDispatchHelper::PricePerMiles($List->paymentinfo->Price_Pay_Carrier !== null ? $List->paymentinfo->Price_Pay_Carrier : 0, $List->routes->Miles) }}/miles
                                    @endif
                                    {{-- {{ $List->routes->Miles }}miles<br>
                                ${{ DayDispatchHelper::PricePerMiles($List->paymentinfo->Price_Pay_Carrier, $List->routes->Miles) }}/miles --}}
                                </td>
                                <td>
                                    @if ($List->pickup_delivery_info)
                                        <strong>Prefered Pickup Date: </strong><br>
                                        {{ $List->pickup_delivery_info->Pickup_Date }}
                                        <br>
                                        <strong>Prefered Delivery Date:</strong><br>
                                        {{ $List->pickup_delivery_info->Delivery_Date }}
                                    @endif
                                    <br>
                                    <strong>Posted Date:</strong><br>
                                    {{ $List->created_at }}
                                    {{-- <strong>Pickup Date: </strong><br>
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
                                <strong>Created Date: </strong><br>
                                @php
                                    $created_at = \Carbon\Carbon::parse($List->created_at);
                                    $diffInHours = $created_at->diffInHours();

                                    if ($diffInHours >= 1 && $diffInHours <= 23) {
                                        $created_at = $diffInHours . ' hrs ago';
                                    } else {
                                        $created_at = $created_at->format('Y-m-d'); // You can use any desired date format here
                                    }
                                @endphp
                                {{ $created_at }} --}}
                                </td>
                                @if ($List->Listing_Status == 'Book Order')
                                    <td>
                                        <h6>Quote Status: <span
                                                class="badge badge-primary">{{ $List->Listing_Status }}</span></h6>
                                        {{-- <div class="dropdown show list-actions"> --}}
                                        {{-- <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"> Actions</a> --}}
                                        <div class="">
                                            @if ($List->user_id === $currentUser->id)
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    href="{{ route('Edit.Quote', ['List_ID' => $List->id]) }}">Modify
                                                    Listing</a>
                                                @php
                                                    $check = App\Models\OrderForm::where('order_id', $List->id)
                                                        ->where('user_id', $List->user_id)
                                                        ->first();
                                                @endphp
                                                @if ($check != null)
                                                    <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                        href="{{ route('order.form.submitted', ['List_ID' => $List->id, 'User_ID' => $List->user_id]) }}">Order
                                                        Form</a>
                                                @endif
                                                @php
                                                    $exist = App\Models\Listing\AllUserListing::where(
                                                        'order_id',
                                                        $List->id,
                                                    )
                                                        ->where('user_id', $List->user_id)
                                                        ->first();
                                                @endphp
                                                @if (!$exist)
                                                    <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                        href="{{ route('MoveTo.Loardboard', ['List_ID' => $List->id, 'User_ID' => $List->user_id]) }}">MoveTo
                                                        Loardboard</a>
                                                @endif
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    href="{{ route('Generate.Invoice', ['List_ID' => $List->id, 'User_ID' => $List->user_id]) }}">Generate
                                                    Invoice</a>
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    data-toggle="modal" data-target="#OrderHistory"
                                                    href="javascript:void(0);">
                                                    <input hidden type="text" id="hiddenListId" class="Listed-ID"
                                                        value="{{ $List->id }}"> Cancelled Order
                                                </a>
                                            @endif
                                        </div>
                                        {{-- </div> --}}
                                    </td>
                                @elseif($List->Listing_Status == 'Deleted')
                                    <td>
                                        <h6>Status: <span class="badge badge-primary">{{ $List->Listing_Status }}</span>
                                        </h6>
                                        {{-- <div class="dropdown show list-actions">
                                    <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true">
                                        Actions
                                    </a> --}}

                                        <div class="">
                                            @if ($List->user_id === $currentUser->id)
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    href="{{ route('Edit.Quote', ['List_ID' => $List->id]) }}">Modify
                                                    Listing</a>
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    data-toggle="modal" data-target="#OrderHistory"
                                                    href="javascript:void(0);">
                                                    <input hidden type="text" id="hiddenListId" class="Listed-ID"
                                                        value="{{ $List->id }}"> Quote History
                                                </a>
                                                @php
                                                    $check = App\Models\OrderForm::where('order_id', $List->id)
                                                        ->where('user_id', $List->user_id)
                                                        ->first();
                                                @endphp
                                                {{-- @if ($check != null)
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap" href="{{ route('order.form.submitted', ['List_ID' => $List->id, 'User_ID' => $List->user_id]) }}"> Order Form</a>
                                            @endif --}}
                                                {{-- <a class="dropdown-item" href="{{ route('User.Quote.Delete', ['List_ID' => $List->id]) }}"> Delete Quote</a> --}}
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    href="{{ route('User.Quote.Restore', ['List_ID' => $List->id]) }}">
                                                    Restore Quote</a>
                                            @endif
                                        </div>
                                        {{-- </div> --}}
                                    </td>
                                @elseif($List->Listing_Status == 'Cancelled')
                                    <td>
                                        <h6>Status: <span class="badge badge-primary">{{ $List->Listing_Status }}</span>
                                        </h6>
                                        {{-- <div class="dropdown show list-actions"> --}}
                                        {{-- <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true">
                                        Actions
                                    </a> --}}

                                        {{-- <div class="dropdown-menu"> --}}
                                        @if ($List->user_id === $currentUser->id)
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('Edit.Quote', ['List_ID' => $List->id]) }}">Modify
                                                Listing</a>
                                            @php
                                                $check = App\Models\OrderForm::where('order_id', $List->id)
                                                    ->where('user_id', $List->user_id)
                                                    ->first();
                                            @endphp
                                            @if ($check != null)
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    href="{{ route('order.form.submitted', ['List_ID' => $List->id, 'User_ID' => $List->user_id]) }}">
                                                    Order Form</a>
                                            @endif
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap OrderHistory"
                                                data-toggle="modal" data-target="#OrderHistory"
                                                href="javascript:void(0);">
                                                <input hidden type="text" id="hiddenListId" class="Listed-ID"
                                                    value="{{ $List->id }}"> Restore
                                            </a>
                                            <!-- <a class="dropdown-item" href="{{ route('User.Quote.Delete', ['List_ID' => $List->id]) }}"> Delete Quote</a> -->
                                            <!-- <a class="dropdown-item" href="{{ route('User.Quote.Restore', ['List_ID' => $List->id]) }}"> Restore Quote</a> -->
                                        @endif
                                        {{-- </div> --}}
                                        {{-- </div> --}}
                                    </td>
                                @elseif($List->Listing_Status == 'New Quote')
                                    <td>
                                        <h6>Status: <span class="badge badge-primary">{{ $List->Listing_Status }}</span>
                                        </h6>
                                        {{-- <div class="dropdown show list-actions"> --}}
                                        {{-- <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true">
                                        Actions
                                    </a> --}}

                                        <div class="">
                                            @if ($List->user_id === $currentUser->id)
                                                @php
                                                    $check = App\Models\OrderForm::where('order_id', $List->id)
                                                        ->where('user_id', $List->user_id)
                                                        ->first();
                                                @endphp
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    href="{{ route('Edit.Quote', ['List_ID' => $List->id]) }}">Modify
                                                    Listing</a>
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    data-toggle="modal" data-target="#OrderHistory"
                                                    href="javascript:void(0);">
                                                    <input hidden type="text" id="hiddenListId" class="Listed-ID"
                                                        value="{{ $List->id }}"> Quote History
                                                </a>
                                                @if ($check != null)
                                                    <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                        href="{{ route('order.form.submitted', ['List_ID' => $List->id, 'User_ID' => $List->user_id]) }}">
                                                        Order Form</a>
                                                @endif
                                                <!-- <a class="btn btn-primary mb-2 w-100 d-block text-nowrap" href="{{ route('order.form', ['List_ID' => base64_encode($List->id), 'User_ID' => base64_encode($List->user_id)]) }}">Order Form</a> -->
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    href="#" data-toggle="modal" data-target="#copyLinkModal"
                                                    data-list-id="{{ $List->id }}"
                                                    data-user-id="{{ $List->user_id }}">Mail
                                                    Order Form</a>

                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    href="{{ route('User.Move.Book.Order', ['List_ID' => $List->id, 'User_ID' => $List->user_id]) }}">
                                                    Book Order</a>



                                                {{-- @php
                                            $check = App\Models\OrderForm::where('order_id', $List->id)->where('user_id', $List->user_id)->first();
                                            @endphp
                                            @if ($check != null)
                                            <a class="dropdown-item" href="{{ route('order.form.submitted', ['List_ID' => $List->id, 'User_ID' => $List->user_id]) }}"> Order Form</a>
                                            @endif
                                            <!-- <a class="dropdown-item" href="{{ route('order.form', ['List_ID' => base64_encode($List->id), 'User_ID' => base64_encode($List->user_id)]) }}">Order Form</a> -->
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#copyLinkModal" data-list-id="{{ $List->id }}" data-user-id="{{ $List->user_id }}">Copy Link</a>
                                            
                                            <a class="dropdown-item" href="{{ route('User.Move.Book.Order', ['List_ID' => $List->id, 'User_ID' => $List->user_id]) }}">Move To Book Order</a>

                                            <a class="dropdown-item" href="{{ route('User.Quote.Delete', ['List_ID' => $List->id]) }}"> Delete Order</a> --}}
                                            @endif
                                        </div>
                                        {{-- </div> --}}
                                    </td>
                                @elseif(
                                    $List->Listing_Status != 'Book Order' &&
                                        $List->Listing_Status != 'Deleted' &&
                                        $List->Listing_Status != 'Cancelled' &&
                                        $List->Listing_Status != 'New Quote')
                                    <td>
                                        <h6>Status: <span class="badge badge-primary">{{ $List->Listing_Status }}</span>
                                        </h6>
                                        {{-- <div class="dropdown show list-actions">
                                    <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true">
                                        Actions
                                    </a> --}}

                                        <div class="">
                                            @if ($List->user_id === $currentUser->id)
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    href="{{ route('Edit.Quote', ['List_ID' => $List->id]) }}">Modify
                                                    Listing</a>
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap order-history"
                                                    data-toggle="modal" data-target="#OrderHistory"
                                                    href="javascript:void(0);">
                                                    <input hidden type="text" id="hiddenListId" class="Listed-ID"
                                                        value="{{ $List->id }}"> Quote History
                                                </a>
                                                @php
                                                    $check = App\Models\OrderForm::where('order_id', $List->id)
                                                        ->where('user_id', $List->user_id)
                                                        ->first();
                                                @endphp
                                                @if ($check != null)
                                                    <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                        href="{{ route('order.form.submitted', ['List_ID' => $List->id, 'User_ID' => $List->user_id]) }}">
                                                        Order Form</a>
                                                @endif
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    href="#" data-toggle="modal" data-target="#copyLinkModal"
                                                    data-list-id="{{ $List->id }}"
                                                    data-user-id="{{ $List->user_id }}">
                                                    Mail Order Form
                                                </a>
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    href="{{ route('User.Move.Book.Order', ['List_ID' => $List->id, 'User_ID' => $List->user_id]) }}">
                                                    Book Order</a>
                                                {{-- <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap" href="{{ route('User.Quote.Delete', ['List_ID' => $List->id]) }}"> Delete Order</a> --}}
                                            @endif
                                        </div>
                                        {{-- </div> --}}
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal HTML -->
    {{-- <div class="modal fade" id="OrderHistory" data-backdrop="static" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">HISTORY/STATUS<span class="get_Order_ID"></span></h5>
                <button type="button" class="close" data-id="" data-dismiss="modal" > <!-- onclick="redirect(this)" -->
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body user-settings-box" id="modal-body">
                <div id="button-section" class="mb-3">
                    <ul class="nav justify-content-center custom-nav" role="tablist">
                        <li class="nav-item mr-2" role="presentation">
                            <a class="nav-link w-100 custom-tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true" onclick="showForm()">HISTORY/STATUS</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link w-100  custom-tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false" data-id="{{ $List->id ?? '' }}" onclick="setListId(this)">VIEW/HISTORY</a>
                        </li>
                    </ul>
                </div>

                <!-- Form Section -->
                <div id="form-section" style="display:none;">
                    <form id="order-status-form" action="{{ route('Order.Status') }}" method="POST" class="was-validated" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="modal-quote-id" name="quote_id">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="pickup-location">HISTORY/STATUS</label>
                                        <select class="custom-select" name="history_status" required>
                                            <option value="">Select AnyOne</option>
                                            @foreach ($OptionName as $option)
                                            <option value="{{ $option->name }}">{{ $option->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Select Any Location.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="expected-date">Expected Date</label>
                                        <input type="date" class="form-control" name="expected_date" required>
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

                <!-- Data Display Section -->
                <div id="data-section" style="display:none;">
                    <div id="data-container"></div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
    <!-- Modal -->
    <div class="modal fade" id="copyLinkModal" tabindex="-1" role="dialog" aria-labelledby="copyLinkModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="copyLinkModalLabel">Copy Link</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="sendLinkForm" method="GET"
                        action="{{ route('send.link.email', ['id' => ':id', 'userid' => ':userid']) }}">
                        @csrf
                        <div class="form-group">
                            <label for="generatedLink">Generated Link</label>
                            <input type="text" class="form-control" id="generatedLink" name="generatedLink" readonly>
                        </div>
                        <div class="form-group">
                            <label for="emailAddress">Email Address</label>
                            <input type="email" class="form-control" id="emailAddress" name="email"
                                placeholder="Enter email" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Send Email</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            $('#copyLinkModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var listId = button.data('list-id'); // Extract info from data-* attributes
                var userId = button.data('user-id');

                // Construct the URL
                var generatedUrl = `{{ url('/') }}/order-form/List_ID=${listId}/user_id=${userId}`;

                // Update the modal's input fields
                var modal = $(this);
                modal.find('#generatedLink').val(generatedUrl);

                // Update the form action with listId and userId
                var form = modal.find('#sendLinkForm');
                var actionUrl = form.attr('action').replace(':id', listId).replace(':userid', userId);
                form.attr('action', actionUrl);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // $('#order-status-form').on('submit', function(e) {
            //     e.preventDefault(); // Prevent the default form submission

            //     var form = $(this);
            //     var formData = new FormData(this); // Create a FormData object from the form

            //     $.ajax({
            //         url: form.attr('action'),
            //         type: form.attr('method'),
            //         data: formData,
            //         processData: false, // Required for FormData
            //         contentType: false, // Required for FormData
            //         success: function(response) {
            //             // Handle success
            //             console.log('Form submitted successfully:', response);

            //             // Clear the form fields
            //             form.find('input[type="text"], input[type="date"], textarea').val('');
            //             form.find('select').prop('selectedIndex', 0); // Reset dropdowns

            //             // Alternatively, reset the entire form
            //             // form[0].reset();
            //         },
            //         error: function(xhr, status, error) {
            //             // Handle errors
            //             console.error('AJAX Error:', status, error);
            //             console.log('Response Text:', xhr.responseText);
            //         }
            //     });
            // });
        });


        $(document).ready(function() {
            // When a dropdown item is clicked
            $('.dropdown-item').on('click', function() {
                // Get the value from the hidden input
                var id = $(this).find('.Listed-ID').val();
                // Set the value in the modal's hidden input field
                $('#modal-quote-id').val(id);
            });
        });
        // function showForm() {
        //     // Show the form section and hide the data section
        //     document.getElementById('form-section').style.display = 'block';
        //     document.getElementById('data-section').style.display = 'none';
        // }

        // function showData() {
        //     // Hide the form section and show the data section
        //     document.getElementById('form-section').style.display = 'none';
        //     document.getElementById('data-section').style.display = 'block';
        // }

        // function setListId(button) {
        //     var listId = button.getAttribute('data-id');
        //     document.getElementById('modal-quote-id').value = listId; // Set the hidden input field
        //     // alert(listId);

        //     $.ajax({
        //         url: '{{ route('Get.Quote.Status') }}',
        //         method: 'GET',
        //         data: {
        //             list_id: listId
        //         },
        //         success: function(response) {
        //             // Clear previous content
        //             $('#data-container').empty();

        //             // Show data section
        //             showData();

        //             // Populate data section with a table
        //             var html = '<table class="status-table">';
        //             html += '<thead>';
        //             html += '<tr>';
        //             html += '<th>Status</th>';
        //             html += '<th>Expected Date</th>';
        //             html += '<th>Description</th>';
        //             html += '</tr>';
        //             html += '</thead>';
        //             html += '<tbody>';
        //             $.each(response, function(index, item) {
        //                 html += '<tr>';
        //                 html += '<td class="status-text">' + item.history_status + '</td>';
        //                 html += '<td class="date-text">' + item.expected_date + '</td>';
        //                 html += '<td class="description-text">' + item.history_description + '</td>';
        //                 html += '</tr>';
        //             });
        //             html += '</tbody>';
        //             html += '</table>';

        //             $('#data-container').html(html);
        //         },
        //         error: function(xhr, status, error) {
        //             console.error('AJAX Error:', status, error);
        //             console.log('Response Text:', xhr.responseText);
        //         }
        //     });
        //     // $.ajax({
        //     //     url: '{{ route('Get.Quote.Status') }}',
        //     //     method: 'GET',
        //     //     data: {
        //     //         list_id: listId
        //     //     },
        //     //     success: function(response) {
        //     //         // Clear previous content
        //     //         $('#data-container').empty();

        //     //         // Show data section
        //     //         showData();

        //     //         // Populate data section
        //     //         var html = '<ul>';
        //     //         $.each(response, function(index, item) {
        //     //             html += '<li>';
        //     //             html += '<strong>Status:</strong> ' + item.history_status + '<br>';
        //     //             html += '<strong>Expected Date:</strong> ' + item.expected_date + '<br>';
        //     //             html += '<strong>Description:</strong> ' + item.history_description;
        //     //             html += '</li>';
        //     //         });
        //     //         html += '</ul>';

        //     //         $('#data-container').html(html);
        //     //     },
        //     //     error: function(xhr, status, error) {
        //     //         console.error('AJAX Error:', status, error);
        //     //         console.log('Response Text:', xhr.responseText);
        //     //     }
        //     // });
        // }

        function redirect(button) {
            var listId = button.getAttribute('data-id');
            // alert(listId);
            document.getElementById('modal-quote-id').value = listId;
            $.ajax({
                url: '{{ route('redirection') }}',
                method: 'GET',
                data: {
                    list_id: listId
                },
                success: function(response) {
                    // Redirect to folder or list after status update
                    if (response.redirectUrl) {
                        window.location.href = response.redirectUrl; // Redirect to the given folder or list
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    console.log('Response Text:', xhr.responseText);
                }
            });
        }
    </script>
@endsection
