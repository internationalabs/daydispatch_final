@extends('layouts.authorized')
@section('content')
    @php
        use Illuminate\Support\Facades\Auth;
        $currentUser = Auth::guard('Authorized')->user();
    @endphp
    <div class="breadcrumb-area">
        <h1>{{ $currentUser->usr_type }} Quote Listing </h1>
        <ol class="breadcrumb">
            <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>
            <li class="item">Listed</li>
        </ol>
    </div>
    <style>
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
    @include('partials.global-search')
    <div class="card">
        <div class="card-body">
            <br>
            @if ($currentUser->usr_type === 'Carrier')
                <div class="table-responsive">
                    <table class="display carrier dataTable advance-6 datatable-range text-center w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Routes</th>
                                <th>Load Details</th>
                                <th>Company Info</th>
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
                                <tr>
                                    <td>
                                        @if (count($List->attachments) > 0)
                                            <strong><a href="{{ route('Order.Attachments', ['List_ID' => $List->id]) }}"
                                                    target="_blank">View Images</a></strong><br>
                                        @endif
                                        <strong>Ref-ID:</strong>{{ $List->Ref_ID }} <br>
                                        {{ $List->routes->Miles }} miles <br>
                                        $
                                        {{ DayDispatchHelper::PricePerMiles($List->paymentinfo->Price_Pay_Carrier, $List->routes->Miles) }}
                                        /miles
                                    </td>
                                    <td>
                                        @php
                                            $createdAt = \Carbon\Carbon::createFromFormat(
                                                'Y-m-d H:i:s',
                                                $List->getRawOriginal('created_at'),
                                            );
                                        @endphp
                                        @if ($createdAt->gte(\Carbon\Carbon::now()->subHours(12)) && $createdAt->lte(\Carbon\Carbon::now()))
                                            <form id="searchForm" action="{{ route('global.search.index') }}"
                                                method="GET">
                                                <input type="hidden" id="new_listing" name="new_listing" value="new">
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
                                                        class="text-danger font-weight-bold">{{ $vehcile->Vehcile_Condition }}<br></span>
                                                @endif
                                                @if (!empty($vehcile->Trailer_Type))
                                                    <span
                                                        @if ($vehcile->Trailer_Type == '"(Enclosed Trailer Required)"') class="text-primary font-weight-bold" @endif>{{ $vehcile->Trailer_Type }}</span>
                                                    <br>
                                                @endif
                                            @endforeach
                                        @endif
                                        @if (count($List->vehicles) > 1)
                                            <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                                data-trigger="focus" style="cursor: pointer;" title="Attached vehicles"
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
                                                        title="Freight Weight"
                                                        data-html="true">{{ $vehcile->Freight_Weight }}
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
                                        <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                            data-trigger="focus" style="cursor: pointer;" title="Additional Terms"
                                            data-content=
                                    "{{ !empty($List->additional_info->Additional_Terms) ? $List->additional_info->Additional_Terms : '' }}">
                                            {{ !empty($List->additional_info->Additional_Terms) ? Str::limit($List->additional_info->Additional_Terms, 20) : '...' }}</a>
                                    </td>
                                    <td>
                                        <strong><a
                                                href="{{ route('View.Profile', ['user_id' => $List->authorized_user->id]) }}">{{ $List->authorized_user->Company_Name }}</a></strong><br>
                                        {{ $List->authorized_user->Contact_Phone }}<br>
                                        {{ $List->authorized_user->Hours_Operations }}<br>
                                        {{ $List->authorized_user->Time_Zone }}
                                    </td>
                                    <td>
                                        <strong>Price to Pay: </strong>
                                        <span> $ {{ $List->paymentinfo->Price_Pay_Carrier }} </span>
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
                                            <span> $ {{ $List->paymentinfo->COD_Amount }} </span>
                                            <br>
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
                                        {{ $created_at }}
                                    </td>
                                    <td>
                                        <a href="{{ route('User.Watchlist.store', $List->id) }}">
                                            @if ($List->authorized_user->my_watch_check($List->id) !== null)
                                                <i class="fa fa-heart" aria-hidden="true"
                                                    title="Remove from Watch List"></i>
                                            @else
                                                <i class="fa-regular fa-heart" title="Add to Watch List"></i>
                                            @endif
                                        </a><br>
                                        @if (count($List->request_carrier) != 0)
                                            <span>Req Count:</span>
                                            <span
                                                style="background-color: red; color: white; border-radius: 50%; padding: 5px 10px; font-size: 12px; display: inline-block;">
                                                {{ count($List->request_carrier) }}
                                            </span><br>
                                        @endif



                                        <div class="dropdown show list-actions">
                                            <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button"
                                                data-toggle="dropdown" aria-haspopup="true">
                                                Actions
                                            </a>

                                            <div class="dropdown-menu">
                                                {{-- <a class="dropdown-item"
                                            href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                            target="_blank">View Route</a> --}}


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

                                                @if ($List->user_id === $currentUser->id)
                                                    <a class="dropdown-item"
                                                        href="{{ route('User.Edit.Listing', ['List_ID' => $List->id]) }}">Edit
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
                        </tbody>
                    </table>
                </div>
            @else
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
                                <th>ID</th>
                                <th>Routes</th>
                                <th>Load Details</th>
                                <th>Payments</th>
                                <th>Dates</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Lisiting as $List)
                                <tr>
                                    <td>
                                        @php
                                        $listing = App\Models\Listing\AllUserListing::where('order_id', $List->id)->first(); 
                                        $current_Status = $listing ? $listing->Listing_Status : null;
                                        @endphp

                                        @if($current_Status)
                                        <h6><span class="badge badge-primary">{{ $current_Status }}</span></h6>
                                        @endif
                                        <h6><span class="badge badge-primary">{{ $List->Listing_Status }}</span></h6>
                                        @php
                                            $createdAt = \Carbon\Carbon::createFromFormat(
                                                'Y-m-d H:i:s',
                                                $List->getRawOriginal('created_at'),
                                            );
                                        @endphp
                                        @if ($createdAt->gte(\Carbon\Carbon::now()->subHours(12)) && $createdAt->lte(\Carbon\Carbon::now()))
                                            <form id="searchForm" action="{{ route('global.search.index') }}"
                                                method="GET">
                                                <input type="hidden" id="new_listing" name="new_listing" value="new">
                                                <button type="submit" class="ribbon-box">
                                                    <div class="ribbon-two ribbon-two-danger">
                                                        <span>New</span>
                                                    </div>
                                                </button>
                                            </form>
                                        @endif
                                        <h6><span class="badge badge-primary">Listed</span></h6>
                                        <span style="font-size: x-large;"><strong>{{ $List->Ref_ID }}</strong></span><br>
                                        @if (count($List->attachments) > 0)
                                            <strong><a class="text-nowrap" href="{{ route('Order.Attachments', ['List_ID' => $List->id]) }}"
                                                    target="_blank">View Images</a></strong><br>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="mb-2">
                                            <span><strong>Pickup</strong></span><br>
                                            <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                                href="https://www.google.com/maps/place/{{ urlencode($List->routes->Origin_ZipCode) }}"
                                                target="_blank">
                                                {{-- <i class="fas fa-map-marker-alt text-success fs-30 m-0"></i> --}}
                                                {{ Str::replace(',', '-', $List->routes->Origin_ZipCode) }}
                                            </a>
                                        </div>
                                        <div class="mb-2">
                                            <span><strong>Delivery</strong></span><br>
                                            <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                                href="https://www.google.com/maps/place/{{ urlencode($List->routes->Dest_ZipCode) }}"
                                                target="_blank">
                                                {{-- <i class="fas fa-map-marker-alt text-danger fs-30 m-0"></i> --}}
                                                {{ Str::replace(',', '-', $List->routes->Dest_ZipCode) }}
                                            </a>
                                        </div>
                                        <div class="mb-2">
                                            <span class="fs-5"><strong><a
                                                        class="btn btn-outline-primary text-decoration-none fw-bold"
                                                        href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                        target="_blank">View Route</a></strong></span>
                                        </div>
                                    </td>
                                    <td>
                                        @if (count($List->vehicles) === 1)
                                            @foreach ($List->vehicles as $vehcile)
                                                <span style="font-size: large; "><a class="font-weight-bold text-dark"
                                                        href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                        target="_blank"><strong>{{ $vehcile->Vehcile_Year }}
                                                            {{ $vehcile->Vehcile_Make }}
                                                            {{ $vehcile->Vehcile_Model }}</strong></a></span><br>
                                                @if (!empty($vehcile->Vehcile_Condition))
                                                    <span
                                                        class="badge badge-pill mt-2 @if ($vehcile->Vehcile_Condition == 'Running') badge-success @elseif($vehcile->Vehcile_Condition == 'Not Running') badge-danger @else badge-primary @endif"
                                                        style="font-size: 16px;">
                                                        {{ $vehcile->Vehcile_Condition }}
                                                    </span>
                                                @endif
                                                @if (!empty($vehcile->Trailer_Type))
                                                    <span class="badge badge-pill mt-2 badge-primary font-weight-bold"
                                                        style="font-size: 16px;">{{ $vehcile->Trailer_Type }}</span>
                                                @endif
                                            @endforeach
                                        @endif
                                        @if (count($List->vehicles) > 1)
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" class="dropdown-toggle"
                                                    data-toggle="dropdown"
                                                    style="cursor: pointer;">vehicles({{ count($List->vehicles) }})
                                                </a>
                                                <div class="dropdown-menu text-center">
                                                    <h6 class="dropdown-header" style="background-color: lightgrey;">
                                                        Attached Vehicles</h6>
                                                    @foreach ($List->vehicles as $vehcile)
                                                        <a class="dropdown-item" style="color: #0d6efd; font-weight: 800;"
                                                            href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                            target="_blank">{{ $vehcile->Vehcile_Year }}{{ $vehcile->Vehcile_Make }}{{ $vehcile->Vehcile_Model }}<br>
                                                            @if (!empty($vehcile->Vehcile_Condition))
                                                                <span
                                                                    class="badge badge-pill mt-2 @if ($vehcile->Vehcile_Condition == 'Running') badge-success @elseif($vehcile->Vehcile_Condition == 'Not Running') badge-danger @else badge-primary @endif"
                                                                    style="font-size: 16px;">
                                                                    {{ $vehcile->Vehcile_Condition }}
                                                                </span>
                                                            @endif
                                                            @if (!empty($vehcile->Trailer_Type))
                                                                <span
                                                                    class="badge badge-pill mt-2 badge-primary font-weight-bold"
                                                                    style="font-size: 16px;">{{ $vehcile->Trailer_Type }}</span>
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
                                                data-toggle="popover" data-trigger="focus" style="cursor: pointer;"
                                                title="Attached vehicles"
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
                                                        style="cursor: pointer;" title="Freight Class" data-html="true">
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
                                                data-toggle="popover" data-trigger="focus" style="cursor: pointer;"
                                                title="Attached vehicles"
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
                                                {{ $List->additional_info && $List->additional_info->Additional_Terms
                                                    ? $List->additional_info->Additional_Terms
                                                    : 'Additional Terms' }}
                                            </a>
                                            <div class="dropdown-menu p-3 shadow-sm"
                                                aria-labelledby="additionalTermsDropdown" style="max-width: 300px;">
                                                <p class="dropdown-item-text m-0 text-wrap">
                                                    {{ !empty($List->additional_info->Additional_Terms)
                                                        ? $List->additional_info->Additional_Terms
                                                        : 'No additional terms available.' }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($List->paymentinfo)
                                            <strong>Job Price:</strong><span> ${{ $List->paymentinfo->Price_Pay_Carrier }}
                                            </span>
                                            <br>
                                            @if ($List->paymentinfo->COD_Amount === '0')
                                            @else
                                                <strong>
                                                    @if ($List->paymentinfo->COD_Location_Amount == 'PickUp')
                                                        Pay on Pickup:
                                                    @else
                                                        Pay on Delivery:
                                                    @endif
                                                </strong>
                                                <span>${{ $List->paymentinfo->COD_Amount }}</span>
                                                <br>
                                                <span class="text-nowrap"><strong>Pay
                                                        Mode:</strong><br>{{ $List->paymentinfo->COD_Method_Mode }}</span><br>
                                            @endif
                                        @endif
                                        @if ($List->paymentinfo)
                                            <strong>Price per Mile:</strong>
                                            ${{ DayDispatchHelper::PricePerMiles($List->paymentinfo->Price_Pay_Carrier !== null ? $List->paymentinfo->Price_Pay_Carrier : 0, $List->routes->Miles) }}/miles<br>
                                        @endif
                                        <strong>Mile: </strong>{{ $List->routes->Miles }}miles
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
                                        <a href="{{ route('User.Watchlist.store', $List->id) }}">
                                            @if ($List->authorized_user->my_watch_check($List->id) !== null)
                                                <i class="fa fa-heart" aria-hidden="true"
                                                    title="Remove from Watch List"></i>
                                            @else
                                                <i class="fa-regular fa-heart" title="Add to Watch List"></i>
                                            @endif
                                        </a><br>
                                        {{-- <div class="dropdown show list-actions">
                                            <a class="btn btn-success dropdown-toggle btn-sm" href="#"
                                                role="button" data-toggle="dropdown" aria-haspopup="true">
                                                Actions
                                            </a> --}}

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
                                            {{-- <div class="dropdown-menu"> --}}
                                                {{-- <a class="dropdown-item"
                                        href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                        target="_blank">View Route</a> --}}
                                                <!--<div ></div>-->
                                                <a onclick="request_load_click({{ $List->id }})"
                                                    id="{{ $List->id }}" class="btn btn-primary mb-2 w-100 d-block text-nowrap request-load"
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
                                                <a class="btn btn-primary mb-2 w-100 d-block text-nowrap compare-listing" data-toggle="modal"
                                                    data-target="#CompareListing" href="javascript:void(0);">
                                                    <input hidden type="text" class="Listed-ID"
                                                        value="{{ $List->id }}">
                                                    <input hidden type="text" class="Listed-Type"
                                                        value="{{ $List->Listing_Type }}">
                                                    <input hidden type="text" class="Listed-Miles"
                                                        value="{{ $List->routes->Miles }}">
                                                    Compare Listing</a>
                                                @if ($List->user_id === $currentUser->id)
                                                    <a class="btn btn-primary mb-2 w-100 d-block text-nowrap"
                                                        href="{{ route('User.Edit.Listing', ['List_ID' => $List->id]) }}">Edit
                                                        Listing</a>
                                                    <a class="btn btn-primary mb-2 w-100 d-block text-nowrap"
                                                        href="{{ route('User.Dispatch.Listing', ['List_ID' => $List->id]) }}">Assign
                                                        Listing</a>
                                                    <a class="btn btn-primary mb-2 w-100 d-block text-nowrap"
                                                        href="{{ route('User.Listing.Archive', ['List_ID' => $List->id]) }}">Archive
                                                        Order</a>
                                                    <a class="btn btn-primary mb-2 w-100 d-block text-nowrap"
                                                        href="{{ route('User.Listing.Delete', ['List_ID' => $List->id]) }}">Delete
                                                        Order</a>
                                                @endif
                                            {{-- </div>
                                        </div> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection