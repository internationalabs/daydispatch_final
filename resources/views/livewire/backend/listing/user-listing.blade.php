@section('Listing', 'mm-active')
@php
    use Illuminate\Support\Facades\Auth;
    $currentUser = Auth::guard('Authorized')->user();
@endphp
<div class="breadcrumb-area">
    <h1>{{ $currentUser->usr_type }} Listing </h1>
    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>
        <li class="item">Listed</li>
    </ol>
</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
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
        overflow: hidden;
        width: 100px;
        text-align: right;
        left: -11px;
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
        width: 100px;
        display: block;
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

    .dropdown-menu {
        overflow-y: auto;
    }

    .row-checkbox {
        cursor: pointer;
    }

    #select-all {
        cursor: pointer;
    }
</style>
@include('partials.global-search')
<div class="card">
    <div class="card-body">
        <br>
        @if ($currentUser->usr_type === 'Carrier')
            <div class="table-responsive">
            </div>
            <div class="table-responsive">

                <form method="GET" action="{{ request()->url() }}" class="d-flex align-items-center mb-3">
                    <label class="me-2">Show</label>
                    <select name="per_page" class="form-select w-auto" onchange="this.form.submit()">
                        @foreach([10, 25, 50, 100] as $size)
                            <option value="{{ $size }}" {{ request('per_page', 10) == $size ? 'selected' : '' }}>
                                {{ $size }}
                            </option>
                        @endforeach
                    </select>
                    <label class="ms-2">entries</label>
                </form>

                <table class="table-1 dataTable advance-786 datatable-range text-center table-bordered table-cards">
                    <thead class="table-header">
                    <tr>
                        <th>ID</th>
                        <th>Company Info</th>
                        <th>Routes</th>
                        <th>Load Details</th>
                        <th>Payments</th>
                        <th>Dates</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($Lisiting as $List)
                        <tr class="card-row" data-status="active">
                            <td>
                                @if (count($List->attachments) > 0)
                                    <strong><a href="{{ route('Order.Attachments', ['List_ID' => $List->id]) }}"
                                               target="_blank">View Images</a></strong><br>
                                @endif
                                <strong>{{ $List->Ref_ID }}</strong>
                                <br>
                                @if ($List->user_id === $currentUser->id)
                                    <a class="btn btn-dark text-white"
                                       href="{{ route('User.Listing.Archive', ['List_ID' => $List->id]) }}"><i
                                            class="fas fa-archive text-white"></i></a>
                                    <a class="btn btn-dark text-white"
                                       href="{{ route('User.Listing.Delete', ['List_ID' => $List->id]) }}"><i
                                            class="far fa-trash-alt"></i></a>
                                @endif
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
                                <strong><a
                                        href="{{ route('View.Profile', ['user_id' => $List->authorized_user->id]) }}">{{ $List->authorized_user->Company_Name }}</a></strong><br>
                                Ph no:{{ $List->authorized_user->Contact_Phone }}<br>
                                Hours:{{ $List->authorized_user->Hours_Operations }}<br>
                                Timezone:{{ $List->authorized_user->Time_Zone }}
                            </td>
                            <td>
                                <strong style="font-size: 14px; " class="locations-color">Pick up</strong><br>
                                {{-- <i class="fas fa-map-marker-alt text-success fs-30"></i> --}}
                                <a href="https://www.google.com/maps/place/{{ urlencode($List->routes->Origin_ZipCode) }}"
                                   target="_blank">
                                    {{ Str::replace(',', '-', $List->routes->Origin_ZipCode) }}
                                </a><br>
                                <strong style="font-size: 14px;" class="locations-color">Delivery</strong><br>
                                {{-- <i class="fas fa-map-marker-alt text-danger fs-30"></i> --}}
                                <a href="https://www.google.com/maps/place/{{ urlencode($List->routes->Dest_ZipCode) }}"
                                   target="_blank">
                                    {{ Str::replace(',', '-', $List->routes->Dest_ZipCode) }}
                                </a>
                                <a class="dropdown-item m-0 ps-4 fs-5 text-nowrap text-decoration-none fw-bold "
                                   href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                   target="_blank">View Route</a>
                            </td>
                            <td>
                                @if (count($List->vehicles) === 1)
                                    @foreach ($List->vehicles as $vehcile)
                                        <a style="color: #0d6efd; font-weight: 800;"
                                           href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                           target="_blank"> {{ $vehcile->Vehcile_Year }}
                                            {{ $vehcile->Vehcile_Make }}
                                            {{ $vehcile->Vehcile_Model }}</a><br>

                                        @if (!empty($vehcile->Vehcile_Condition))
                                            <span
                                                class="badge rounded-pill bg-success text-white">{{ $vehcile->Vehcile_Condition }}<br></span>
                                        @endif
                                        @if (!empty($vehcile->Trailer_Type))
                                            <span
                                                @if ($vehcile->Trailer_Type == '"(Enclosed Trailer Required)"') class="badge rounded-pill bg-success text-white" @endif>{{ $vehcile->Trailer_Type }}</span>
                                            <br>
                                        @endif
                                    @endforeach
                                @endif
                                @if (count($List->vehicles) > 1)
                                    <div class="dropdown">
                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"
                                           style="color: #0d6efd; font-weight: 800; cursor: pointer;">
                                            Vehicles ({{ count($List->vehicles) }})
                                        </a>
                                        <div class="dropdown-menu text-center"
                                             style="max-height: 200px; overflow-y: auto;">
                                            <h6 class="dropdown-header" style="background-color: lightgrey;">
                                                Attached Vehicles</h6>
                                            @foreach ($List->vehicles as $vehicle)
                                                <a class="dropdown-item" style="color: #0d6efd; font-weight: 800;"
                                                   href="https://www.google.com/search?q={{ $vehicle->Vehcile_Year }}%20{{ $vehicle->Vehcile_Make }}%20{{ $vehicle->Vehcile_Model }}"
                                                   target="_blank">
                                                    {{ $vehicle->Vehcile_Year }} {{ $vehicle->Vehcile_Make }}
                                                    {{ $vehicle->Vehcile_Model }}
                                                </a>
                                                @if (!empty($vehicle->Vehcile_Condition))
                                                    <div class="badge rounded-pill bg-success text-white">
                                                        {{ $vehicle->Vehcile_Condition }}</div>
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
                                {{-- @if (count($List->vehicles) === 1)
                                    @foreach ($List->vehicles as $vehicle)
                                        <a style="color: #0d6efd; font-weight: 800;" href="https://www.google.com/search?q={{ $vehicle->Vehcile_Year }}%20{{ $vehicle->Vehcile_Make }}%20{{ $vehicle->Vehcile_Model }}"
                                            target="_blank">
                                            {{ $vehicle->Vehcile_Year }} {{ $vehicle->Vehcile_Make }} {{ $vehicle->Vehcile_Model }}
                                        </a><br>

                                        @if (!empty($vehicle->Vehcile_Condition))
                                            <span class="badge rounded-pill bg-success text-white">{{ $vehicle->Vehcile_Condition }}<br></span>
                                        @endif
                                        @if (!empty($vehicle->Trailer_Type))
                                            <span @if ($vehicle->Trailer_Type == '(Enclosed Trailer Required)') class="badge rounded-pill bg-success text-white" @endif>
                                                {{ $vehicle->Trailer_Type }}
                                            </span><br>
                                        @endif
                                    @endforeach
                                @endif
                                @if (count($List->vehicles) > 1)
                                    <a href="javascript:void(0)" style="color: #0d6efd; font-weight: 800;" data-toggle="modal" data-target="#vehicleModal">
                                        Vehicles ({{ count($List->vehicles) }})
                                    </a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="vehicleModal" tabindex="-1" aria-labelledby="vehicleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="vehicleModalLabel">Attached Vehicles</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @foreach ($List->vehicles as $vehicle)
                                                        <a href="https://www.google.com/search?q={{ $vehicle->Vehcile_Year }}%20{{ $vehicle->Vehcile_Make }}%20{{ $vehicle->Vehcile_Model }}"
                                                        target="_blank" style="color: #0d6efd; font-weight: 800; display: block; margin-bottom: 10px;">
                                                            {{ $vehicle->Vehcile_Year }} {{ $vehicle->Vehcile_Make }} {{ $vehicle->Vehcile_Model }}
                                                        </a>

                                                        @if (!empty($vehicle->Vehcile_Condition))
                                                            <div class="badge rounded-pill bg-success text-white" style="margin-bottom: 5px;">
                                                                {{ $vehicle->Vehcile_Condition }}
                                                            </div>
                                                        @endif

                                                        @if (!empty($vehicle->Trailer_Type))
                                                            <div class="badge rounded-pill bg-info text-white" style="margin-bottom: 5px;">
                                                                {{ $vehicle->Trailer_Type }}
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif --}}

                                @if (count($List->heavy_equipments) === 1)
                                    @foreach ($List->heavy_equipments as $vehcile)
                                        <a style="color: #0d6efd; font-weight: 800;"
                                           href='https://www.google.com/search?q={{ $vehcile->Equipment_Year }}%20{{ $vehcile->Equipment_Make }}%20{{ $vehcile->Equipment_Model }}'
                                           target='_blank'>
                                            {{ $vehcile->Equipment_Year }} {{ $vehcile->Equipment_Make }}
                                            {{ $vehcile->Equipment_Model }}
                                        </a><br>
                                        <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }}
                                        | <b>H</b>{{ $vehcile->Equip_Height }}
                                        | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                        @if (!empty($vehcile->Equipment_Condition))
                                            <br>{{ $vehcile->Equipment_Condition }}<br>
                                        @endif
                                        @if (!empty($vehcile->Trailer_Type))
                                            <span
                                                @if ($vehcile->Trailer_Type == '"(Enclosed Trailer Required)"') class="badge rounded-pill bg-success text-white" @endif>{{ $vehcile->Trailer_Type }}</span>
                                        @endif
                                    @endforeach
                                @endif
                                @if (count($List->heavy_equipments) > 1)
                                    <!-- <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                            data-trigger="focus" style="cursor: pointer;" title="Attached vehicles"
                                            data-content=
                                        "@foreach ($List->heavy_equipments as $vehcile)
                                        <a href='https://www.google.com/search?q={{ $vehcile->Equipment_Year }}%20{{ $vehcile->Equipment_Make }}%20{{ $vehcile->Equipment_Model }}'
                                           target='_blank'>
                                           {{ $vehcile->Equipment_Year }} {{ $vehcile->Equipment_Make }} {{ $vehcile->Equipment_Model }}
                                        </a><br>
                                            <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} | <b>H</b>{{ $vehcile->Equip_Height }} | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                        @if (!empty($vehcile->Equipment_Condition))
                                            <br>{{ $vehcile->Equipment_Condition }}<br>

                                        @endif
                                        @if (!empty($vehcile->Trailer_Type))
                                            <span @if ($vehcile->Trailer_Type == "'(Enclosed Trailer Required)'")
                                                class='text-primary font-weight-bold'
                                            @endif>{{ $vehcile->Trailer_Type }}</span>

                                        @endif
                                    @endforeach"
                                            data-html="true">vehicles ({{ count($List->heavy_equipments) }})
                                        </a> -->
                                    <a style="color: #0d6efd; font-weight: 800;" href="javascript:void(0)"
                                       tabindex="0" class="" data-toggle="popover" data-trigger="focus"
                                       style="cursor: pointer background-color: lightgrey;;"
                                       title="Attached vehicles"
                                       data-content="@foreach ($List->heavy_equipments as $vehcile)
                                                <a href='https://www.google.com/search?q={{ $vehcile->Equipment_Year }}%20{{ $vehcile->Equipment_Make }}%20{{ $vehcile->Equipment_Model }}'
                                                   target='_blank'>
                                                   {{ $vehcile->Equipment_Year }} {{ $vehcile->Equipment_Make }} {{ $vehcile->Equipment_Model }}
                                                </a><br>
                                                <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} | <b>H</b>{{ $vehcile->Equip_Height }} | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                                @if (!empty($vehcile->Equipment_Condition))
                                                    <br>{{ $vehcile->Equipment_Condition }}<br>
                                                @endif
                                                @if (!empty($vehcile->Trailer_Type))
                                                    <span @if ($vehcile->Trailer_Type == '(Enclosed Trailer Required)') class='badge rounded-pill bg-success text-white' @endif>{{ $vehcile->Trailer_Type }}</span>
                                                @endif @endforeach"
                                       data-html="true">
                                        vehicles ({{ count($List->heavy_equipments) }})
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
                                                   data-toggle="popover" data-trigger="focus"
                                                   style="cursor: pointer;" title="Freight Weight"
                                                   data-html="true">{{ $vehcile->Freight_Weight }}
                                                </a>
                                            </span> <b>LBS</b><br>
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
                                        {{ $List->additional_info->Additional_Terms }}Additional
                                        Terms
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
                                {{-- <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                    data-trigger="focus" style="cursor: pointer;" title="Additional Terms"
                                    data-content=
                                "{{ !empty($List->additional_info->Additional_Terms) ? $List->additional_info->Additional_Terms : '' }}">
                                    {{ !empty($List->additional_info->Additional_Terms) ? Str::limit($List->additional_info->Additional_Terms, 20) : '...' }}</a> --}}
                            </td>
                            <td>
                                @if ($List->paymentinfo)
                                    <strong>Job Price: </strong>
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
                                                Pay on Pickup
                                            @else
                                                Pay on Delivery
                                            @endif:
                                        </strong>
                                        <span> $ {{ $List->paymentinfo->COD_Amount }} </span>
                                        <br>
                                        <strong>Pay Mode: </strong>
                                        {{ $List->paymentinfo->COD_Method_Mode }}<br>
                                    @endif
                                @endif
                                {{ $List->routes->Miles }} miles <br/>
                                @if ($List->paymentinfo)
                                    ${{ DayDispatchHelper::PricePerMiles($List->paymentinfo->Price_Pay_Carrier !== null ? $List->paymentinfo->Price_Pay_Carrier : 0, $List->routes->Miles) }}
                                    /miles
                                @endif
                            </td>
                            <td>
                                @if ($List->pickup_delivery_info)
                                    <strong>Pickup Date: </strong><br>
                                    ({{ $List->pickup_delivery_info->Pickup_Date_mode }})
                                    {{ \Carbon\Carbon::parse($List->pickup_delivery_info->Pickup_Date)->format('d M, Y') }}
                                    @if (!is_null($List->pickup_delivery_info->Pickup_Start_Time))
                                        <br>
                                        {{ \Carbon\Carbon::parse($List->pickup_delivery_info->Pickup_Start_Time)->format('g:i A') . ' - ' . \Carbon\Carbon::parse($List->pickup_delivery_info->Pickup_End_Time)->format('g:i A') }}
                                    @endif
                                    <br>
                                    <strong>Deliver Date: </strong><br>
                                    @if ($List->pickup_delivery_info->Delivery_Date_mode === 'ASAP')
                                        ({{ $List->pickup_delivery_info->Delivery_Date_mode }})
                                    @else
                                        {{ \Carbon\Carbon::parse($List->pickup_delivery_info->Delivery_Date)->format('d M, Y') }}
                                    @endif
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
                                @endif
                            </td>
                            <td>
                                <div class="row d-block">
                                    <div class="col-12 mb-1">
                                        <a onclick="request_load_click({{ $List->id }})"
                                           id="{{ $List->id }}" data-toggle="modal"
                                           data-target="#CarrierRequestLoad" href="javascript:void(0);"
                                           class="btn mb-2 btn-primary w-75 btn-sm text-nowrap request-load">Bid/Request
                                            Load
                                            <input hidden type="text" class="Listed-Ref-ID"
                                                   value="{{ $List->Ref_ID }}">
                                            <input hidden type="text" class="Listed-ID"
                                                   value="{{ $List->id }}">
                                            @if ($List->paymentinfo)
                                                <input hidden type="text" class="Listed-Price"
                                                       value="{{ (int) Str::replace(['$ ', ','], '', $List->paymentinfo->Price_Pay_Carrier) }}">
                                            @endif
                                            @if ($List->pickup_delivery_info)
                                                <input hidden type="text" class="Pickup-Date"
                                                       value="{{ $List->pickup_delivery_info->Pickup_Date }}">
                                                <input hidden type="text" class="Deliver-Date"
                                                       value="{{ $List->pickup_delivery_info->Delivery_Date }}">
                                            @endif
                                        </a>
                                    </div>
                                    @if ($List->user_id === $currentUser->id)
                                        <div class="col-12 mb-1"><a
                                                href="{{ route('User.Dispatch.Listing', ['List_ID' => $List->id]) }}"
                                                class="btn mb-2 btn-primary w-75 btn-sm text-nowrap">Assign
                                                Listing</a>
                                        </div>
                                        <div class="col-12 mb-1"><a
                                                href="{{ route('User.Edit.Listing', ['List_ID' => $List->id]) }}"
                                                class="btn mb-2 btn-primary w-75 btn-sm text-nowrap">Edit
                                                Listing</a>
                                        </div>
                                    @endif
                                    <div class="col-12 mb-1"><a
                                            href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                            target="_blank"
                                            class="btn mb-2 btn-primary w-75 btn-sm text-nowrap">View Route</a>
                                    </div>
                                </div>
                                {{-- <a href="{{ route('User.Watchlist.store', $List->id) }}">
                                    @if ($List->authorized_user->my_watch_check($List->id) !== null)
                                        <i class="fa fa-heart" aria-hidden="true"
                                            title="Remove from Watch List"></i>
                                    @else
                                        <i class="fa-regular fa-heart" title="Add to Watch List"></i>
                                    @endif
                                </a><br> --}}
                                {{-- @if (count($List->request_carrier) != 0)
                                    <span>Req Count:</span>
                                    <span
                                        style="background-color: red; color: white; border-radius: 50%; padding: 5px 10px; font-size: 12px; display: inline-block;">
                                        {{ count($List->request_carrier) }}
                                    </span><br>
                                @endif --}}

                                {{-- <div class="dropdown show list-actions">
                                    <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true">
                                        Actions
                                    </a>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                        href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                        target="_blank">View Route</a>


                                        <a onclick="request_load_click({{ $List->id }})"
                                            id="{{ $List->id }}" class="dropdown-item request-load"
                                            data-toggle="modal" data-target="#CarrierRequestLoad"
                                            href="javascript:void(0);">
                                            <input hidden type="text" class="Listed-Ref-ID"
                                                value="{{ $List->Ref_ID }}">
                                            <input hidden type="text" class="Listed-ID"
                                                value="{{ $List->id }}">
                                            @if ($List->paymentinfo)
                                                <input hidden type="text" class="Listed-Price"
                                                    value="{{ (int) Str::replace(['$ ', ','], '', $List->paymentinfo->Price_Pay_Carrier) }}">
                                            @endif
                                            @if ($List->pickup_delivery_info)
                                                <input hidden type="text" class="Pickup-Date"
                                                    value="{{ $List->pickup_delivery_info->Pickup_Date }}">
                                                <input hidden type="text" class="Deliver-Date"
                                                    value="{{ $List->pickup_delivery_info->Delivery_Date }}">
                                                Bid / Request Load
                                            @endif
                                        </a>

                                        <a class="dropdown-item compare-listing" data-toggle="modal"
                                            data-target="#CompareListing" href="javascript:void(0);">
                                            <input hidden type="text" class="Listed-ID"
                                                value="{{ $List->id }}">
                                            <input hidden type="text" class="Listed-Type"
                                                value="{{ $List->Listing_Type }}">
                                            <input hidden type="text" class="Listed-Miles"
                                                value="{{ $List->routes->Miles }}">
                                            Compare Listing
                                        </a>

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
                                </div> --}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {{ $Lisiting->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        @else
            <div class="table-responsive">

                <form method="GET" action="{{ request()->url() }}" class="d-flex align-items-center mb-3">
                    <label class="me-2">Show</label>
                    <select name="per_page" class="form-select w-auto" onchange="this.form.submit()">
                        @foreach([10, 25, 50, 100] as $size)
                            <option value="{{ $size }}" {{ request('per_page', 10) == $size ? 'selected' : '' }}>
                                {{ $size }}
                            </option>
                        @endforeach
                    </select>
                    <label class="ms-2">entries</label>
                </form>

                <form method="POST" action="{{ route('bulk.action') }}" id="bulk-action-form">
                    @csrf
                    <div class="d-flex align-items-center mb-3">
                        <label class="me-2">Bulk Actions</label>
                        <select name="action_option" class="form-select w-auto" id="bulk-action-select"
                                onchange="toggleSubmitButton()">
                            <option value="" selected>Select Action</option>
                            <option value="delete">Delete</option>
                            <option value="archive">Archive</option>
                            <option value="update_price">Update Price</option>
                            <option value="update_dates">Update Pickup & Delivery Date</option>
                        </select>
                        <button type="button" id="submit-button" class="btn btn-outline-primary w-auto ms-2"
                                style="display: none;" onclick="handleBulkAction()">Submit
                        </button>
                    </div>

                    <table class="table-1 display dataTable advance-786 text-center table-bordered table-cards">
                        <thead class="table-header">
                        <tr role="row">
                            <th style="width: 50px;">
                                <input type="checkbox" id="select-all">
                            </th>
                            <th style="width: 105px;">ID</th>
                            <th style="width: 250px;">Routes</th>
                            <th style="width: 250px;">Load Details</th>
                            <th style="width: 200px;">Payments</th>
                            <th style="width: 175px;">Dates</th>
                            <th style="width: 200px;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($Lisiting as $List)
                            <tr class="card-row" data-status="active">
                                <td>
                                    <input type="checkbox" name="selected_ids[]" value="{{ $List->id }}"
                                           class="row-checkbox">
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
                                            <input type="hidden" id="new_listing" name="new_listing"
                                                   value="new">
                                            <button type="submit" class="badge badge-warning border-0">
                                                {{-- <div class="ribbon-two ribbon-two-danger">
                                                        <span> --}}
                                                New
                                                {{-- </span>
                                                    </div> --}}
                                            </button>
                                        </form>
                                    @endif
                                    @if ($List->Private_Listing === 1)
                                        <h6><span class="badge badge-primary">Pvt Listed</span></h6>
                                    @else
                                        <h6><span class="badge badge-primary">Listed</span></h6>
                                    @endif
                                    @if ($List->Custom_Listing === 1)
                                        <h6><span class="badge badge-secondary">Schedule Listing</span></h6>
                                    @endif
                                    <span class="fs-4"><strong>{{ $List->Ref_ID }}</strong></span><br>
                                    @if (count($List->attachments) > 0)
                                        <strong><a href="{{ route('Order.Attachments', ['List_ID' => $List->id]) }}"
                                                   target="_blank">View Images</a></strong><br>
                                    @endif <br>
                                    @if ($List->user_id === $currentUser->id)
                                        <a class="btn btn-dark text-white"
                                           onclick="window.location.href='{{ route('User.Listing.Delete', ['List_ID' => $List->id]) }}'">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                        <a class="btn btn-dark text-white"
                                           onclick="window.location.href='{{ route('User.Listing.Archive', ['List_ID' => $List->id]) }}'">
                                            <i class="fas fa-archive text-white"></i>
                                        </a>
                                    @endif
                                    {{-- <strong>Ref-ID:</strong> --}}
                                    {{-- {{ $List->routes->Miles }} miles |
                                    @if ($List->paymentinfo)
                                        ${{ DayDispatchHelper::PricePerMiles($List->paymentinfo->Price_Pay_Carrier !== null ? $List->paymentinfo->Price_Pay_Carrier : 0, $List->routes->Miles) }}/miles
                                    @endif --}}
                                </td>
                                <td>
                                    {{-- @php
                                        $createdAt = \Carbon\Carbon::createFromFormat(
                                            'Y-m-d H:i:s',
                                            $List->getRawOriginal('created_at'),
                                        );
                                    @endphp
                                    @if ($createdAt->gte(\Carbon\Carbon::now()->subHours(12)) && $createdAt->lte(\Carbon\Carbon::now()))

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
                                    @endif --}}
                                    <div class="mb-2">
                                        <span><strong>Pickup</strong></span><br>
                                        <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                           href="https://www.google.com/maps/place/{{ urlencode($List->routes->Origin_ZipCode) }}"
                                           target="_blank">
                                            {{ Str::replace(',', '-', $List->routes->Origin_ZipCode) }}
                                        </a>
                                    </div>
                                    <div class="mb-2">
                                        <span><strong>Delivery</strong></span><br>
                                        <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                           href="https://www.google.com/maps/place/{{ urlencode($List->routes->Dest_ZipCode) }}"
                                           target="_blank">
                                            {{ Str::replace(',', '-', $List->routes->Dest_ZipCode) }}
                                        </a>
                                    </div>
                                    <div class="mb-2">
                                        <span class="fs-5"><strong><a
                                                    class="btn btn-outline-primary text-decoration-none fw-bold"
                                                    href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                    target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                         height="18" viewBox="0 0 24 24" fill="none"
                                                                         stroke="currentColor" stroke-width="2"
                                                                         stroke-linecap="round" stroke-linejoin="round"
                                                                         class="feather feather-map-pin"><path
                                                            d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle
                                                            cx="12" cy="10" r="3"></circle></svg>View Route</a></strong></span>
                                    </div>
                                </td>
                                <td>
                                    @if (count($List->vehicles) === 1)
                                        @foreach ($List->vehicles as $vehicle)
                                            <span style="font-size: large; "><a class="font-weight-bold text-dark"
                                                                                href="https://www.google.com/search?q={{ $vehicle->Vehcile_Year }}%20{{ $vehicle->Vehcile_Make }}%20{{ $vehicle->Vehcile_Model }}"
                                                                                target="_blank"><strong>{{ $vehicle->Vehcile_Year }}
                                                        {{ $vehicle->Vehcile_Make }}
                                                        {{ $vehicle->Vehcile_Model }}({{ $vehicle->Vehcile_Type }})</strong></a>
                                            </span><br>
                                            @if (!empty($vehicle->Vehcile_Condition))
                                                <span
                                                    class="badge badge-pill mt-2 @if ($vehicle->Vehcile_Condition == 'Running') badge-success @elseif($vehicle->Vehcile_Condition == 'Not Running') badge-danger @else badge-primary @endif"
                                                    style="font-size: 16px;">
                                                    {{ $vehicle->Vehcile_Condition }}
                                                </span>
                                            @endif
                                            @if (!empty($vehicle->Trailer_Type))
                                                <span class="badge badge-pill mt-2 badge-primary font-weight-bold"
                                                      style="font-size: 16px;">{{ $vehicle->Trailer_Type }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                    @if (count($List->vehicles) > 1)
                                        <div class="dropdown d-block">
                                            <a href="javascript:void(0)"
                                               class="dropdown-toggle font-weight-bold d-inline-flex align-items-center text-dark text-decoration-none"
                                               data-toggle="dropdown"
                                               style="font-size: 21px; cursor: pointer;">{{-- <i class="fa-solid fa-car-side" style="margin-right: 5px;"></i> --}}
                                                Vehicles({{ count($List->vehicles) }})
                                            </a>
                                            <div class="dropdown-menu text-center"
                                                 style="max-height: 200px; overflow-y: auto;">
                                                <h6 class="dropdown-header" style="background-color: lightgrey;">
                                                    Attached Vehicles</h6>
                                                @foreach ($List->vehicles as $vehicle)
                                                    <a class="dropdown-item" style="color: #0d6efd; font-weight: 800;"
                                                       href="https://www.google.com/search?q={{ $vehicle->Vehcile_Year }}%20{{ $vehicle->Vehcile_Make }}%20{{ $vehicle->Vehcile_Model }}"
                                                       target="_blank">{{ $vehicle->Vehcile_Year }}{{ $vehicle->Vehcile_Make }}{{ $vehicle->Vehcile_Model }}
                                                        <br>
                                                        @if (!empty($vehicle->Vehcile_Condition))
                                                            <span
                                                                class="badge badge-pill mt-2 @if ($vehicle->Vehcile_Condition == 'Running') badge-success @elseif($vehicle->Vehcile_Condition == 'Not Running') badge-danger @else badge-primary @endif"
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
                                        @foreach ($List->heavy_equipments as $vehicle)
                                            <a class="font-weight-bold text-dark"
                                               href="https://www.google.com/search?q={{ $vehicle->Equipment_Year }}%20{{ $vehicle->Equipment_Make }}%20{{ $vehicle->Equipment_Model }}"
                                               target="_blank">
                                                <span class="fs-5"><strong>{{ $vehicle->Equipment_Year }}
                                                    {{ $vehicle->Equipment_Make }}
                                                    {{ $vehicle->Equipment_Model }}</span></strong>
                                            </a><br>
                                            <b>L</b> {{ $vehicle->Equip_Length }} |
                                            <b>W</b> {{ $vehicle->Equip_Width }} |
                                            <b>H</b> {{ $vehicle->Equip_Height }} |
                                            {{ $vehicle->Equip_Weight }} <b>LBS</b><br>
                                            @if (!empty($vehicle->Equipment_Condition))
                                                <span
                                                    class="badge
                                                    {{ in_array(strtolower($vehicle->Equipment_Condition), ['good', 'new', 'excellent']) ? 'bg-success' : 'bg-danger' }}"
                                                    style="font-size: 16px;">
                                                    {{ $vehicle->Equipment_Condition }}
                                                </span>
                                            @endif
                                            @if (!empty($vehicle->Shipment_Preferences))
                                                <span
                                                    class="badge
                                                    {{ in_array(strtolower($vehicle->Shipment_Preferences), ['preferred', 'recommended']) ? 'bg-success' : 'bg-danger' }}"
                                                    style="font-size: 16px;">
                                                    {{ $vehicle->Shipment_Preferences }}
                                                </span>
                                            @endif
                                            @if (!empty($vehicle->Trailer_Type))
                                                <span
                                                    class="badge
                                                    {{ $vehicle->Trailer_Type == '"(Enclosed Trailer Required)"' ? 'bg-primary' : 'bg-success' }}"
                                                    style="font-size: 16px;">
                                                    {{ $vehicle->Trailer_Type }}
                                                </span>
                                            @endif
                                        @endforeach
                                    @endif
                                    @if (count($List->heavy_equipments) > 1)
                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"
                                           style="cursor: pointer;">Equipment({{ count($List->heavy_equipments) }})
                                        </a>
                                        <div class="dropdown-menu text-center">
                                            <h6 class="dropdown-header" style="background-color: lightgrey;">Attached
                                                Equipments</h6>
                                            @foreach ($List->heavy_equipments as $vehcile)
                                                <a href='https://www.google.com/search?q={{ $vehcile->Equipment_Year }}%20{{ $vehcile->Equipment_Make }}%20{{ $vehcile->Equipment_Model }}'
                                                   target='_blank'>
                                                    {{ $vehcile->Equipment_Year }} {{ $vehcile->Equipment_Make }}
                                                    {{ $vehcile->Equipment_Model }}
                                                </a><br>
                                                <b>L</b>{{ $vehcile->Equip_Length }} |
                                                <b>W</b>{{ $vehcile->Equip_Width }} |
                                                <b>H</b>{{ $vehcile->Equip_Height }} | {{ $vehcile->Equip_Weight }}
                                                <b>LBS</b>
                                                @if (!empty($vehcile->Equipment_Condition) && !empty($vehcile->Shipment_Preferences))
                                                    <br>
                                                    <span
                                                        class="badge badge-success">{{ $vehcile->Equipment_Condition }}</span>
                                                    <span
                                                        class="badge badge-success">{{ $vehcile->Shipment_Preferences }}</span>
                                                    <br>
                                                @endif
                                                @if (!empty($vehcile->Trailer_Type))
                                                    @php
                                                        $isNegative =
                                                            $vehcile->Trailer_Type === "'(Enclosed Trailer Required)'";
                                                    @endphp
                                                    <span
                                                        class="badge {{ $isNegative ? 'badge-danger' : 'badge-primary' }}">
                                                        {{ $vehcile->Trailer_Type }}
                                                    </span>
                                                @endif
                                                <br>
                                            @endforeach
                                        </div>
                                    @endif
                                    @if (count($List->dry_vans) === 1)
                                        @foreach ($List->dry_vans as $vehcile)
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
                                                {{ $List->additional_info && $List->additional_info->Additional_Terms
                                                    ? $List->additional_info->Additional_Terms
                                                    : 'No additional terms available.' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if ($List->paymentinfo)
                                        <strong>Job Price:</strong>
                                        <span> ${{ $List->paymentinfo->Price_Pay_Carrier }}</span><br>
                                        @if ($List->paymentinfo->COD_Amount === '0')
                                            {{-- <strong>Balance Amount: </strong>
                                        {{ $List->paymentinfo->Balance_Amount }}<br>
                                        <strong>Pay Mode: </strong>
                                        {{ $List->paymentinfo->Bal_Method_Mode }}<br> --}}
                                        @else
                                            <strong>
                                                @if ($List->paymentinfo->COD_Location_Amount == 'PickUp')
                                                    {{-- COP --}}
                                                    Pay on Pickup
                                                @else
                                                    {{-- COD --}}
                                                    Pay on Delivery
                                                @endif:
                                            </strong>
                                            <span>${{ $List->paymentinfo->COD_Amount }}</span><br>
                                            <span class="text-nowrap"><strong>Pay Mode: </strong>{{ $List->paymentinfo->COD_Method_Mode }}</span>
                                            <br>
                                        @endif
                                    @endif
                                    <strong>Mile: </strong>{{ $List->routes->Miles }}miles<br>
                                    <strong>Price per Mile:</strong>
                                    @if ($List->paymentinfo)
                                        ${{ DayDispatchHelper::PricePerMiles($List->paymentinfo->Price_Pay_Carrier !== null ? $List->paymentinfo->Price_Pay_Carrier : 0, $List->routes->Miles) }}
                                        /miles
                                    @endif
                                </td>
                                <td>
                                    @if ($List->pickup_delivery_info)
                                        <strong>Prefered Pickup Date: </strong><br>
                                        {{-- ({{ $List->pickup_delivery_info->Pickup_Date_mode }}) --}}
                                        {{ \Carbon\Carbon::parse($List->pickup_delivery_info->Pickup_Date)->format('d M, Y') }}
                                        {{-- @if (!is_null($List->pickup_delivery_info->Pickup_Start_Time))

                                            {{ \Carbon\Carbon::parse($List->pickup_delivery_info->Pickup_Start_Time)->format('g:i A') . ' - ' . \Carbon\Carbon::parse($List->pickup_delivery_info->Pickup_End_Time)->format('g:i A') }}
                                        @endif --}}
                                        {{-- <br> --}}
                                        {{-- <strong>Deliver Date:</strong><br>
                                        {{ $List->pickup_delivery_info->Delivery_Date }} --}}
                                        {{-- @if ($List->pickup_delivery_info->Delivery_Date_mode === 'ASAP')
                                        ({{ $List->pickup_delivery_info->Delivery_Date_mode }})
                                        @else
                                        {{ $List->pickup_delivery_info->Delivery_Date }}
                                        @endif
                                        @if (!is_null($List->pickup_delivery_info->Delivery_Start_Time))

                                            {{ \Carbon\Carbon::parse($List->pickup_delivery_info->Delivery_Start_Time)->format('g:i A') . ' - ' . \Carbon\Carbon::parse($List->pickup_delivery_info->Delivery_End_Time)->format('g:i A') }}
                                        @endif --}}
                                        <br>
                                        <strong>Prefered Delivery Date:</strong><br>
                                        {{ \Carbon\Carbon::parse($List->pickup_delivery_info->Delivery_Date)->format('d M, Y') }}
                                    @endif
                                    <br>
                                    @if ($List->Custom_Listing === 1)
                                        <strong>Posting Date:</strong><br>
                                        {{ \Carbon\Carbon::parse($List->Posted_Date)->format('d M, Y') }}
                                    @else
                                        <strong>Posted Date:</strong><br>
                                        {{ \Carbon\Carbon::parse($List->created_at)->format('d M, Y') }}
                                    @endif
                                </td>

                                @php
                                    $user = Auth::guard('Authorized')->user();
                                @endphp
                                @if ($user && $user->admin_verify == 0)

                                    <td>
                                        {{-- <div class="row d-block"> --}}
                                        @if ($List->user_id === $currentUser->id)
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                               data-toggle="modal"
                                               data-target="#WaitingApproval" href="javascript:void(0);">
                                                Assign Carrier
                                            </a>

                                            <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                               data-toggle="modal"
                                               data-target="#WaitingApproval" href="javascript:void(0);">
                                                Modify Listing
                                            </a>
                                        @endif
                                        @if ($List->Private_Listing === 0)
                                            @if ($currentUser->usr_type === 'Broker')
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block all-requests"
                                                   data-toggle="modal"
                                                   data-target="#WaitingApproval" href="javascript:void(0);">
                                                    View Request <span
                                                        class="badges">({{ count($List->request_broker_all) }})</span>
                                                </a>
                                            @endif
                                            @if ($currentUser->usr_type === 'Broker')
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block lane-carrier"
                                                   data-toggle="modal"
                                                   data-target="#WaitingApproval" href="javascript:void(0);">
                                                    Lane Carrier
                                                </a>
                                            @endif
                                        @else
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                               data-toggle="modal"
                                               data-target="#WaitingApproval" href="javascript:void(0);">
                                                Move to Listing
                                            </a>
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block lane-carrier"
                                               data-toggle="modal"
                                               data-target="#WaitingApproval" href="javascript:void(0);">
                                                Lane Carrier
                                            </a>
                                        @endif
                                        @if ($currentUser->usr_type === 'Broker')
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block request-carrier"
                                               data-toggle="modal"
                                               data-target="#WaitingApproval" href="javascript:void(0);">
                                                Carrier Outreach
                                            </a>
                                        @endif
                                        {{-- </div> --}}
                                    </td>

                                @else
                                    <td>
                                        {{-- <div class="row d-block"> --}}
                                        @if ($List->user_id === $currentUser->id)
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                               onclick="window.location.href='{{ route('User.Dispatch.Listing', ['List_ID' => $List->id]) }}'">
                                                Assign Carrier
                                            </a>

                                            <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                               onclick="window.location.href='{{ route('User.Edit.Listing', ['List_ID' => $List->id]) }}'">
                                                Modify Listing
                                            </a>
                                        @endif
                                        @if ($List->Private_Listing === 0)
                                            @if ($currentUser->usr_type === 'Broker')
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block all-requests"
                                                   data-toggle="modal" data-target="#CarrierRequests"
                                                   href="javascript:void(0);">
                                                    <input hidden type="text" class="Listed-ID"
                                                           value="{{ $List->id }}">
                                                    View Request <span
                                                        class="badges">({{ count($List->request_broker_all) }})</span>
                                                </a>
                                            @endif
                                            {{-- <button class="btn btn-outline-primary mb-2 w-100 d-block">
                                                View Bids
                                            </button> --}}
                                            @if ($currentUser->usr_type === 'Broker')
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block lane-carrier"
                                                   data-toggle="modal" data-target="#laneCarrier"
                                                   href="javascript:void(0);">
                                                    <input hidden type="text" class="Listed-ID"
                                                           value="{{ $List->id }}">
                                                    <input hidden type="text" class="From-Route"
                                                           value="{{ $List->routes->Origin_ZipCode }}">
                                                    <input hidden type="text" class="To-Route"
                                                           value="{{ $List->routes->Dest_ZipCode }}">
                                                    Lane Carrier
                                                </a>
                                            @endif
                                            {{-- <button class="btn btn-outline-primary mb-2 w-100 d-block" >
                                                Lane Carrier
                                            </button> --}}
                                        @else
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                               onclick="window.location.href='{{ route('Move.to.Listing', ['List_ID' => $List->id]) }}'">
                                                Move to Listing
                                            </a>

                                            {{-- <button class="btn btn-outline-primary mb-2 w-100 d-block lane-carrier"
                                                data-toggle="modal" data-target="#laneCarrier"
                                                href="javascript:void(0);">
                                                <input hidden type="text" class="Listed-ID"
                                                    value="{{ $List->id }}">
                                                <input hidden type="text" class="From-Route"
                                                    value="{{ $List->routes->Origin_ZipCode }}">
                                                <input hidden type="text" class="To-Route"
                                                    value="{{ $List->routes->Dest_ZipCode }}">
                                                    Lane Carrier
                                            </button> --}}
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block lane-carrier"
                                               data-toggle="modal" data-target="#laneCarrier"
                                               href="javascript:void(0);">
                                                <input hidden type="text" class="Listed-ID" value="{{ $List->id }}">
                                                <input hidden type="text" class="From-Route"
                                                       value="{{ $List->routes->Origin_ZipCode }}">
                                                <input hidden type="text" class="To-Route"
                                                       value="{{ $List->routes->Dest_ZipCode }}">
                                                Lane Carrier
                                            </a>
                                        @endif
                                        @if ($currentUser->usr_type === 'Broker')
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block request-carrier"
                                               data-toggle="modal" data-target="#requestCarrier"
                                               href="javascript:void(0);">
                                                Carrier Outreach
                                            </a>
                                        @endif
                                        {{-- </div> --}}
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>
                <div class="d-flex justify-content-center mt-3">
                    {{ $Lisiting->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Request Carrier Modal -->
<div class="modal fade" id="requestCarrier" data-backdrop="true" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Request Carrier For Order ID: <span class="get_Order_ID"></span></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body user-settings-box">
                <form action="{{ route('User.Request.Carrier') }}" method="POST" class="was-validated">
                    @csrf
                    <input hidden type="text" name="get_Listed_ID" class="get_Listed_ID" value="">
                    <input hidden type="text" name="get_Ref_ID" class="get_Ref_ID" value="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" class="form-control" value="" name="Requested_Email"
                                       required>
                                <div class="invalid-feedback">
                                    Email Required.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Message</label>
                                <textarea rows="3" class="form-control" name="Requested_Comments" required>
                                    We Like to offer you the load, with the listed price given below, for further detail Click the Proceed Button Below!
                                </textarea>
                                <div class="invalid-feedback">
                                    Message Required.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="btn-box text-center">
                                <button type="submit" class="submit-btn w-100"><i class='bx bx-save'></i>
                                    Submit Request
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- View Dispute Modal -->
<div class="modal fade" id="CarrierRequestLoad" data-backdrop="true" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Request Load For Order ID: <span class="get_Order_ID"></span></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body user-settings-box" id="modalbody">
                <form action="{{ route('User.Request.Broker') }}" method="POST" class="was-validated"
                      id="request_load_clear">
                    @csrf
                    <input hidden type="text" name="get_Listed_ID" class="get_Listed_ID" value="">
                    <input hidden type="text" name="get_Ref_ID" class="get_Ref_ID" value="">
                    <input hidden type="text" name="type" class="check_type">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Current Price (Order Price)</label>
                                <input readonly type="text" class="form-control" id="get_Listed_Price"
                                       value="" name="Current_Price" required>
                            </div>
                            <!--<div class="form-group form-check" id="offer">-->
                            <!--    <input type="checkbox" class="form-check-input" id="offer_Check">-->
                            <!--    <label class="form-check-label" for="offer_Check">If You have any Offer?</label>-->
                            <!--</div>-->
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group offer-price">
                                <label>My Bid (Order Price)</label>
                                <div class="bidoffer">

                                </div>
                                <div class="invalid-feedback offer-required">
                                    Bid Price is Required.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group offer-price" id="offer-Bid">
                                <label>Bid Comment</label>
                                <input type="text" class="form-control" placeholder="Enter Your Bid Comment"
                                       value="" name="Bid_Comment">
                                <!--<div class="invalid-feedback offer-required">-->
                                <!--    Offer Price is Required.-->
                                <!--</div>-->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Date to Pickup *</label>
                                <select class="custom-select" name="Date_Pickup_Mode" required>
                                    <option value="">Select AnyOne</option>
                                    <option value="Estimated">Estimated</option>
                                    <option value="Exactly">Exactly</option>
                                    <option value="No Earlier Than">No Earlier Than</option>
                                    <option value="No Later Than">No Later Than</option>
                                </select>
                                <div class="invalid-feedback">Select AnyOne</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Pickup Date</label>
                                <input type="date" class="form-control pickup-date" placeholder="Pickup Date"
                                       name="Pickup_Date" required>
                                <div class="invalid-feedback">
                                    Entered Pickup Date.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Date to Delivery *</label>
                                <select class="custom-select" name="Date_Delivery_Mode" required>
                                    <option value="">Select AnyOne</option>
                                    <option value="Estimated">Estimated</option>
                                    <option value="Exactly">Exactly</option>
                                    <option value="No Earlier Than">No Earlier Than</option>
                                    <option value="No Later Than">No Later Than</option>
                                </select>
                                <div class="invalid-feedback">Select AnyOne</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Delivery Date</label>
                                <input type="date" class="form-control deliver-date" placeholder="Delivery Date"
                                       name="Delivery_Date" required>
                                <div class="invalid-feedback">
                                    Entered Delivery Date.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="acknoledgement" required>
                                <label class="form-check-label" for="acknoledgement">I acknowledge and agree that once
                                    the I has accepted the request, I will be entered into a legal contract with Day
                                    Dispatch for the transportation of vehicle(s).<br> I further acknowledge and agree i
                                    have no obligation or liability whatsoever arising out of such contract. I consent
                                    to Day Dispatch adding a provision to this effect in my dispatch sheets. I also
                                    understand that any changes that I make to the dispatch sheet after I has accepted
                                    the request, unless I has approved the change, and may not be binding on the
                                    customer or company.</label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="btn-box text-center">
                                <button type="submit" class="submit-btn w-100 margin-media-query"><i
                                        class='bx bx-save'></i>
                                    Submit Request
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div id="requested">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card" onclick="requestforform('1')">
                            <span class="icon"><i class="bx bx-git-pull-request"></i></span>
                            <p>
                                Request for Load
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card" onclick="requestforform('2')">
                            <span class="icon"><i class="bx bx-git-pull-request"></i></span>
                            <p>
                                Bid for load
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- View Request Modal -->
<div class="modal fade" id="CarrierRequests" data-backdrop="true" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Request Load For Order ID: <span class="get_Order_ID"></span></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body user-settings-box">
                <input hidden type="text" name="get_Listed_ID" class="get_Listed_ID" value="">
                <div class="table-responsive" id="all-fetch-requests">
                </div>
            </div>

            {{-- @foreach ($Lisiting as $item)
                <div class="modal-body user-settings-box">
                    <input hidden type="text" name="get_Listed_ID" class="get_Listed_ID" value="">
                    <div class="table-responsive" id="all-fetch-requests">
                    </div>
                </div>
            @endforeach --}}
        </div>
    </div>
</div>

{{-- >>>>>>>>>>>> Lane Carrier <<<<<<<<<<<<<<<<< --}}
<div class="modal fade" id="laneCarrier" data-backdrop="true" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Carrier's From <strong><span class="From-Route-Display"></span></strong> To
                    <strong><span class="To-Route-Display"></span></strong></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body user-settings-box">
                <input hidden type="text" name="get_Listed_ID" class="get_Listed_ID" value="">
                <div class="table-responsive" id="all-lanecarriers-request">
                    <!-- AJAX content will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Update Price Modal -->
<div class="modal fade" id="updatePrice" data-backdrop="true" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bulk Update Price</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body user-settings-box">
                <form method="POST" action="{{ route('bulk.action') }}" class="was-validated">
                    @csrf
                    <input type="hidden" name="action_option" value="update_price">

                    <!-- Hidden inputs for selected IDs -->
                    @foreach($Lisiting as $listing)
                        <input type="hidden" name="selected_ids[]" value="{{ $listing->id }}" class="selected-id-input">
                    @endforeach

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Previous Prices</label>
                                <div id="previous-prices-list" class="form-control"
                                     style="height: auto; padding: 10px;">
                                    <!-- Dynamically populated list of selected listings and their prices -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Add Price</label>
                                <input type="text" class="form-control" name="update_new_price" required>
                                <div class="invalid-feedback">
                                    New Price is required.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="btn-box text-center">
                                <button type="submit" class="submit-btn w-100"><i class='bx bx-save'></i> Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Update Dates Modal -->
<div class="modal fade" id="updateDates" data-backdrop="true" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bulk Update Pickup & Delivery Date</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body user-settings-box">
                <form method="POST" action="{{ route('bulk.action') }}" class="was-validated">
                    @csrf
                    <input type="hidden" name="action_option" value="update_dates">

                    @foreach($Lisiting as $listing)
                        <input type="hidden" name="selected_ids[]" value="{{ $listing->id }}"
                               class="selected-id-input-date">
                    @endforeach

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Previous Dates</label>
                                <div id="previous-dates-list" class="form-control" style="height: auto; padding: 10px;">
                                    <!-- Dynamically populated list of selected listings and their dates -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>New Pickup Date</label>
                                <input type="date" class="form-control" name="new_pickup_date">
                                <div class="invalid-feedback">
                                    Pickup Date is required.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>New Delivery Date</label>
                                <input type="date" class="form-control" name="new_delivery_date">
                                <div class="invalid-feedback">
                                    Delivery Date is required.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="btn-box text-center">
                                <button type="submit" class="submit-btn w-100"><i class='bx bx-save'></i> Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>

    function toggleSubmitButton() {
        const action = document.getElementById('bulk-action-select').value;
        const submitButton = document.getElementById('submit-button');

        if (action) {
            submitButton.style.display = 'inline-block';
        } else {
            submitButton.style.display = 'none';
        }
    }

    function openUpdatePriceModal() {
        const selectedIds = Array.from(document.querySelectorAll('.row-checkbox:checked')).map(checkbox => checkbox.value);

        if (selectedIds.length === 0) {
            alert('Please select at least one item.');
            return;
        }

        fetch("{{ route('fetch.listings') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({selected_ids: selectedIds})
        })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                    return;
                }

                const previousPricesList = document.getElementById('previous-prices-list');
                previousPricesList.innerHTML = '';

                for (const [id, price] of Object.entries(data)) {
                    const listItem = document.createElement('div');
                    listItem.textContent = `Listing ID: ${id}, Previous Price: ${price}`;
                    previousPricesList.appendChild(listItem);
                }

                const selectedIdInputs = document.querySelectorAll('.selected-id-input');
                selectedIdInputs.forEach(input => {
                    input.disabled = true;
                });

                selectedIds.forEach(id => {
                    const input = document.querySelector(`.selected-id-input[value="${id}"]`);
                    if (input) {
                        input.disabled = false;
                    }
                });

                const modal = new bootstrap.Modal(document.getElementById('updatePrice'));
                modal.show();
            })
            .catch(error => {
                console.error('Error fetching listings:', error);
                alert('An error occurred while fetching the listings.');
            });
    }

    function openUpdateDatesModal() {
        const selectedIds = Array.from(document.querySelectorAll('.row-checkbox:checked')).map(checkbox => checkbox.value);

        if (selectedIds.length === 0) {
            alert('Please select at least one item.');
            return;
        }

        fetch("{{ route('fetch.listings.dates') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({selected_ids: selectedIds})
        })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                    return;
                }

                const previousDatesList = document.getElementById('previous-dates-list');
                previousDatesList.innerHTML = '';

                for (const [id, listing] of Object.entries(data)) {
                    const listItem = document.createElement('div');
                    listItem.textContent = `Listing ID: ${id}, Pickup Date: ${listing.Pickup_Date}, Delivery Date: ${listing.Delivery_Date}`;
                    previousDatesList.appendChild(listItem);
                }

                const selectedIdInputs = document.querySelectorAll('.selected-id-input-date');
                selectedIdInputs.forEach(input => {
                    input.disabled = true;
                });

                selectedIds.forEach(id => {
                    const input = document.querySelector(`.selected-id-input-date[value="${id}"]`);
                    if (input) {
                        input.disabled = false;
                    }
                });

                const modal = new bootstrap.Modal(document.getElementById('updateDates'));
                modal.show();
            })
            .catch(error => {
                console.error('Error fetching listings:', error);
                alert('An error occurred while fetching the listings.');
            });
    }

    function handleBulkAction() {
        const action = document.getElementById('bulk-action-select').value;

        if (action === 'update_price') {
            openUpdatePriceModal();
        } else if (action === 'update_dates') {
            openUpdateDatesModal();
        } else {
            confirmBulkAction();
        }
    }

    function confirmBulkAction() {
        const selectedIds = document.querySelectorAll('.row-checkbox:checked');
        const action = document.getElementById('bulk-action-select').value;

        if (selectedIds.length === 0) {
            alert('Please select at least one item.');
            return;
        }

        if (!action) {
            alert('Please select an action from the dropdown.');
            return;
        }

        if (confirm(`Are you sure you want to ${action} the selected items?`)) {
            const form = document.getElementById('bulk-action-form');
            form.submit();
        }
    }

    document.getElementById('select-all').addEventListener('change', function () {
        const checkboxes = document.querySelectorAll('.row-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });


    //     $('.advance-786').DataTable({
    //     "deferRender": true,
    //     // "pageLength": 10, // Matches backend pagination
    //     "lengthMenu": [
    //         [10, 50, 100, 150, 200, 250],
    //         [10, 50, 100, 150, 200, 250]
    //     ],
    // });
    // Reinitialize popovers dynamically if needed
    function reinitializePopovers() {
        $('[data-toggle="popover"]').popover('dispose'); // Remove existing popovers
        $('[data-toggle="popover"]').popover(); // Reinitialize
    }

    function getListedDate(getListedDate) {
        var ListedDate = new Date(getListedDate);
        var month = ListedDate.getMonth() + 1;
        var day = ListedDate.getDate();
        var year = ListedDate.getFullYear();
        if (month < 10) {
            month = '0' + month.toString();
        } else {
            month = month.toString();
        }
        if (day < 10) {
            day = '0' + day.toString();
        } else {
            day = day.toString();
        }
        return year + '-' + month + '-' + day;
    }

    $(".request-carrier").click(function () {
        var getListedID = $(this).find('.Listed-ID').val();
        var getRefID = $(this).find('.Listed-Ref-ID').val();
        // alert(getRefID); //get_Ref_ID
        $(".get_Order_ID").html(getListedID);
        $(".get_Listed_ID").val(getListedID);
        $(".get_Ref_ID").val(getRefID);
    });
    // Offer Amount
    $('.offer-price').hide();
    $('#offer_Check').change(function () {
        checkBox = document.getElementById('offer_Check');
        if (checkBox.checked) {
            $('.offer-price').show();
            $(".offer-price input").prop('required', true);
        } else {
            $('.offer-price').hide();
            $(".offer-price input").prop('required', false);
        }
    });
    $("#Search_vehicleType").on("change", function () {
        console.log($(this).val());
        $('#Search_vehicleType_form').submit();
        console.log(url);
    });

    function request_load_click(value) {
        const getListedRefID = $(`#${value}`).find('.Listed-Ref-ID').val();
        const getListedID = $(`#${value}`).find('.Listed-ID').val();
        const getListedPrice = $(`#${value}`).find('.Listed-Price').val();
        const getPickupDate = $(`#${value}`).find('.Pickup-Date').val();
        const getDeliverDate = $(`#${value}`).find('.Deliver-Date').val();
        $(".get_Order_ID").html(getListedRefID);
        // console.log(getListedRefID);
        $(".get_Listed_ID").val(getListedID);
        $('#get_Listed_Price').val(getListedPrice);
        // console.log(getDeliverDate);
        const pickupDate = getListedDate(getPickupDate);
        $('.pickup-date').val(pickupDate);
        const deliverDate = getListedDate(getDeliverDate);
        $('.deliver-date').val(deliverDate);
    }

    // $(".request-load").click(function () {
    //     console.log('Yes');
    // });
    $(".close").click(function () {
        $("#request_load_clear").trigger("reset");
        console.log('close')
        document.getElementById('modalbody').style.display = 'none'
        document.getElementById('requested').style.display = 'block'
    });
    $('.all-requests').on('click', function () {
        const getListedID = $(this).find('.Listed-ID').val();
        $(".get_Order_ID").html(getListedID);
        $(".get_Listed_ID").val(getListedID);
        $.ajax({
            url: '{{ route('Get.All.Carrier.Request') }}',
            type: 'GET',
            data: {
                'Listed_ID': getListedID
            },
            success: function (data) {
                $('#all-fetch-requests').html(data);
            },
            error: function (data) {
                console.log(data);
            }
        });
    });

    // Lane Carrier Script
    $('.lane-carrier').on('click', function () {
        const getListedID = $(this).find('.Listed-ID').val();
        const getFromRoute = $(this).find('.From-Route').val();
        const getToRoute = $(this).find('.To-Route').val();

        $(".From-Route-Display").html(getFromRoute);
        $(".To-Route-Display").html(getToRoute);

        $.ajax({
            url: '{{ route('Get.All.Lane.Carriers') }}',
            type: 'GET',
            data: {
                'Listed_ID': getListedID,
                'Listed_From_Route': getFromRoute,
                'Listed_To_Route': getToRoute
            },
            success: function (data) {
                $('#all-lanecarriers-request').html(data);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                $('#all-lanecarriers-request').html('<p class="text-danger">Error loading data. Please try again.</p>');
            }
        });
    });


    function requestforform(params) {
        console.log(params)
        document.getElementById('modalbody').style.display = 'block'
        document.getElementById('requested').style.display = 'none'
        console.log('show')
        // const bid = document.getElementsByClassName("bidoffer");
        if (params == 1) {
            $('.offer-price').hide();
            // const get = bid[0].querySelector("#bid");
            $('.bidoffer #bid').remove();
            var type = 'request';
            $('.check_type').val(type);
        } else {
            $('.bidoffer').html(`
            <input type="text" class="form-control" placeholder="Enter Your Bid Price" id="bid"
            value="" name="Offer_Price" required>
            `)
            var type = 'bid';
            $('.offer-price').show();
            $('.check_type').val(type);
        }
    }

    function myfunc(getparams) {
        if (getparams.target.value == '6') {
            console.log('company')
            $('.hiddenDiv').html('');
            $('.hiddenDivsecond').attr('action', 'https://daydispatch.com/Authorized/User-Search-Results');
        } else {
            console.log('test', getparams.target.value)
            $('.hiddenDiv').html(`<input type="text" class="form-control d-none" class="hiddenValueinput" required>`);
            $('.hiddenDivsecond').attr('action', '');
        }
    }
</script>
