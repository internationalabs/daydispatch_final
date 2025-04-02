@extends('layouts.authorized')
@section('content')
    @php
        use Illuminate\Support\Facades\Auth;
        $currentUser = Auth::guard('Authorized')->user();
    @endphp
    @php
        use Illuminate\Support\Str;
    @endphp
    <style>
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
    </style>
    @include('partials.global-search')
    <div class="card">
        <p id="show-summary">
        </p>
        <div class="card-body"><br>
            @if ($auth_user->usr_type === 'Carrier')
                <div class="table-responsive">
                    <table
                        class="display carrier dataTable advance-6 datatable-range table-1 text-center table-bordered table-cards">
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
                                @if (!$auth_user->is_heavy_subscribe)
                                    @continue($List->Listing_Type === 2)
                                @endif
                                @if (!$auth_user->is_dry_van_subscribe)
                                    @continue($List->Listing_Type === 3)
                                @endif
                                @if ($List->Listing_Status == 'Deliver Approval')
                                    @continue
                                @endif
                                <tr class="card-row" data-status="active">
                                    <td>
                                        @php
                                            $createdAt = \Carbon\Carbon::createFromFormat(
                                                'Y-m-d H:i:s',
                                                $List->getRawOriginal('created_at'),
                                            );
                                        @endphp
                                        @if ($createdAt->gte(\Carbon\Carbon::now()->subHours(12)) && $createdAt->lte(\Carbon\Carbon::now()))
                                            {{--  <form id="searchForm" action="{{ route('global.search.index') }}" method="GET">
                                                <input type="hidden" id="new_listing" name="new_listing" value="new">
                                                <button type="submit">
                                                    <div class="ribbon-two ribbon-two-danger">
                                                        <span>New</span>
                                                    </div>
                                                </button>
                                            </form> --}}
                                            <form id="searchForm" action="{{ route('global.search.index') }}" method="GET">
                                                <input type="hidden" id="new_listing" name="new_listing" value="new">
                                                <button type="submit" class="ribbon-box">
                                                    <div class="ribbon-two ribbon-two-danger">
                                                        <span>New</span>
                                                    </div>
                                                </button>
                                            </form>
                                        @endif
                                        <span style="font-size: x-large;"><strong>{{ $List->Ref_ID }}</strong></span><br>
                                        <h6><span class="badge badge-warning">{{ $List->Listing_Status }}</span></h6>
                                        @if (count($List->attachments) > 0)
                                            <strong><a href="{{ route('Order.Attachments', ['List_ID' => $List->id]) }}"
                                                    target="_blank">View Images</a></strong><br>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $companyName = $List->authorized_user->Company_Name;
                                            $trimmedCompanyName = Str::words($companyName, 3, '...'); // 3 words tak limit
                                        @endphp

                                        <span style="font-size: x-large;">
                                            <a class="locations-color"
                                                href="{{ route('View.Profile', ['user_id' => $List->authorized_user->id]) }}"
                                                target="_blank" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ $companyName }}"> <!-- Tooltip Content -->
                                                <strong>{{ $trimmedCompanyName }}</strong>
                                            </a>
                                        </span><br>
                                        {{-- <span style="font-size: x-large; "><a class="locations-color"
                                                href="{{ route('View.Profile', ['user_id' => $List->authorized_user->id]) }}"><strong>{{ $List->authorized_user->Company_Name }}</strong></a></span><br> --}}
                                        <span class="text-nowrap"><strong>Contact:</strong><a class="locations-color"
                                                href="tel:{{ $List->authorized_user->Contact_Phone }}">
                                                {{ $List->authorized_user->Contact_Phone }}
                                            </a></span><br>
                                        <span class="text-nowrap">
                                            <strong>Email:</strong>
                                            <a class="locations-color" href="mailto:{{ $List->authorized_user->email }}">
                                                {{ $List->authorized_user->email }}
                                            </a>
                                        </span><br>
                                        <span class="text-nowrap">
                                            <strong>Time:</strong>{{ $List->authorized_user->Hours_Operations }}</span><br>
                                        {{-- Timezone:{{ $List->authorized_user->Time_Zone }} --}}
                                        @php
                                            if (!function_exists('getUserRating')) {
                                                function getUserRating($userId)
                                                {
                                                    $orderRatings = app(\App\Services\OrderRatings::class);
                                                    $ratings = $orderRatings->getUserRating($userId);
                                                    $ratingsCount = $orderRatings
                                                        ->getUserRatingRecords($userId)
                                                        ->count();

                                                    return [
                                                        'ratings' => $ratings,
                                                        'count' => $ratingsCount,
                                                    ];
                                                }
                                            }

                                            $dispatchUser = $List->dispatch_listing->dispatch_user ?? null;

                                            if ($dispatchUser) {
                                                $userRatings = getUserRating($dispatchUser->id);
                                                $ratings = $userRatings['ratings'];
                                                $ratingsCount = $userRatings['count'];

                                                $avg_rating =
                                                    $ratings &&
                                                    $ratings->ratings_avg_timeliness !== null &&
                                                    $ratings->ratings_avg_communication !== null &&
                                                    $ratings->ratings_avg_documentation !== null
                                                        ? array_sum([
                                                                $ratings->ratings_avg_timeliness ?? 0,
                                                                $ratings->ratings_avg_communication ?? 0,
                                                                $ratings->ratings_avg_documentation ?? 0,
                                                            ]) / 3
                                                        : null;
                                            } else {
                                                $ratings = null;
                                                $ratingsCount = 0;
                                                $avg_rating = null;
                                            }
                                        @endphp

                                        @if (!is_null($avg_rating) && $avg_rating > 0)
                                            <div class="rating d-inline-block">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i
                                                        class="fa fa-star {{ $i <= $avg_rating ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                                {{ number_format($avg_rating, 1) }}
                                                <a href="">({{ $ratingsCount }})</a>
                                            </div>
                                        @else
                                            <span>No ratings yet.</span>
                                        @endif

                                        <br>
                                        <span class="badge badge-pill badge-success" style="cursor:pointer;"
                                            onclick="window.open('{{ route('chat', $List->user_id) }}', '_blank')">
                                            Message Broker
                                        </span>
                                    </td>
                                    <td>
                                        <span style="font-size: large;"><strong>Pickup:</strong></span> <br>
                                        <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                            href="https://www.google.com/maps/place/{{ urlencode($List->routes->Origin_ZipCode) }}"
                                            target="_blank">
                                            {{-- <i class="fas fa-map-marker-alt text-success fs-30"></i> --}}
                                            {{ Str::replace(',', '-', $List->routes->Origin_ZipCode) }}
                                        </a><br>
                                        <span style="font-size: large;"><strong>Delivery:</strong></span><br>
                                        <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                            href="https://www.google.com/maps/place/{{ urlencode($List->routes->Dest_ZipCode) }}"
                                            target="_blank">
                                            {{-- <i class="fas fa-map-marker-alt text-danger fs-30"></i> --}}
                                            {{ Str::replace(',', '-', $List->routes->Dest_ZipCode) }}
                                        </a>
                                        <div class="mb-2">
                                            <span class="fs-5"><strong><a
                                                        class="btn btn-outline-primary text-decoration-none fw-bold"
                                                        href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                        target="_blank">View Route</a></strong></span>
                                        </div>
                                    </td>
                                    <td>
                                        {{-- @if (count($List->vehicles) === 1)
                                            @foreach ($List->vehicles as $vehcile)
                                                <a class="font-weight-bold text-dark"
                                                    href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                    target="_blank"><span class="fs-5"><strong>
                                                            {{ $vehcile->Vehcile_Year }}
                                                            {{ $vehcile->Vehcile_Make }}
                                                            {{ $vehcile->Vehcile_Model }}</strong></span></a><br>
                                                @if (!empty($vehcile->Vehcile_Condition))
                                                    <span class="badge bg-success text-white"
                                                        style="font-size: 16px;">{{ $vehcile->Vehcile_Condition }}</span>
                                                @endif
                                                @if (!empty($vehcile->Trailer_Type))
                                                    <span class="badge bg-primary text-white" style="font-size: 16px;">
                                                        {{ $vehcile->Trailer_Type }}</span>
                                                @endif
                                            @endforeach
                                        @endif
                                        @if (count($List->vehicles) > 1)
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"
                                                    style="cursor: pointer; color: mediumvioletred; font-weight: 800;">
                                                    Vehicles ({{ count($List->vehicles) }})
                                                </a>
                                                <div class="dropdown-menu">
                                                    <h6 class="dropdown-header" style="background-color: lightgrey;">
                                                        Attached Vehicles</h6>
                                                    @foreach ($List->vehicles as $vehcile)
                                                        <a class="dropdown-item"
                                                            style="color: mediumvioletred; font-weight: 800;"
                                                            href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                            target="_blank">
                                                            {{ $vehcile->Vehcile_Year }} {{ $vehcile->Vehcile_Make }}
                                                            {{ $vehcile->Vehcile_Model }}
                                                        </a>
                                                        @if (!empty($vehcile->Vehcile_Condition))
                                                            <div class="dropdown-item text-danger font-weight-bold">
                                                                {{ $vehcile->Vehcile_Condition }}</div>
                                                        @endif
                                                        @if (!empty($vehcile->Trailer_Type))
                                                            <div
                                                                class="dropdown-item @if ($vehcile->Trailer_Type == "'(Enclosed Trailer Required)'") text-primary font-weight-bold @endif">
                                                                {{ $vehcile->Trailer_Type }}
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif --}}
                                        @if (!is_null($List->vehicles) && count($List->vehicles) === 1)
                                            @foreach ($List->vehicles as $vehcile)
                                                <span style="font-size: large; ">
                                                    <a class="font-weight-bold text-dark"
                                                        href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                        target="_blank"><strong>{{ $vehcile->Vehcile_Year }}
                                                            {{ $vehcile->Vehcile_Make }}
                                                            {{ $vehcile->Vehcile_Model }}
                                                            ({{ $vehcile->Vehcile_Type }})
                                                        </strong></a>
                                                </span><br>
                                                @if (!empty($vehcile->Vehcile_Condition))
                                                    <span
                                                        class="badge badge-pill mt-2 @if ($vehcile->Vehcile_Condition == 'Running') badge-success @elseif($vehcile->Vehcile_Condition == 'Not Running') badge-danger @else badge-primary @endif"
                                                        style="font-size: 16px;">{{ $vehcile->Vehcile_Condition }}</span>
                                                @endif
                                                @if (!empty($vehcile->Trailer_Type))
                                                    <span class="badge badge-pill mt-2 badge-primary font-weight-bold"
                                                        style="font-size: 16px;">{{ $vehcile->Trailer_Type }}</span>
                                                @endif
                                            @endforeach
                                        @endif
                                        @if (!is_null($List->vehicles) && count($List->vehicles) > 1)
                                            <div class="dropdown">
                                                <a href="javascript:void(0)"
                                                    class="dropdown-toggle font-weight-bold d-inline-flex align-items-center text-dark text-decoration-none"
                                                    data-toggle="dropdown"
                                                    style="font-size: 21px; cursor: pointer;">Vehicles({{ count($List->vehicles) }})</a>
                                                <div class="dropdown-menu text-center"
                                                    style="max-height: 200px; overflow-y: auto;">
                                                    <h6 class="dropdown-header" style="background-color: lightgrey;">
                                                        Attached Vehicles</h6>
                                                    @foreach ($List->vehicles as $vehcile)
                                                        <a class="dropdown-item" style="color: #0560a6 ; font-weight: 800;"
                                                            href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                            target="_blank">{{ $vehcile->Vehcile_Year }}
                                                            {{ $vehcile->Vehcile_Make }}
                                                            {{ $vehcile->Vehcile_Model }}<br>
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
                                                                    style="font-size: 16px;">
                                                                    {{ $vehcile->Trailer_Type }}</span>
                                                            @endif
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                        @if (count($List->heavy_equipments) === 1)
                                            @foreach ($List->heavy_equipments as $vehcile)
                                                <a class="font-weight-bold text-dark"
                                                    href="https://www.google.com/search?q={{ $vehcile->Equipment_Year }}%20{{ $vehcile->Equipment_Make }}%20{{ $vehcile->Equipment_Model }}"
                                                    target="_blank"><span class="fs-5"><strong>
                                                            {{ $vehcile->Equipment_Year }}
                                                            {{ $vehcile->Equipment_Make }}
                                                            {{ $vehcile->Equipment_Model }}</strong></span></a><br>
                                                <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }}
                                                | <b>H</b>{{ $vehcile->Equip_Height }}
                                                | {{ $vehcile->Equip_Weight }} <b>LBS</b> <br>
                                                {{-- @if (!empty($vehcile->Equipment_Condition))
                                                    <br>{{ $vehcile->Equipment_Condition }}<br>
                                                @endif
                                                @if (!empty($vehcile->Trailer_Type))
                                                    <span
                                                        @if ($vehcile->Trailer_Type == '"(Enclosed Trailer Required)"') class="text-primary font-weight-bold" @endif>{{ $vehcile->Trailer_Type }}</span>
                                                @endif --}}
                                                @if (!empty($vehcile->Equipment_Condition))
                                                    <span class="badge badge-success "
                                                        style="font-size: 16px;">{{ $vehcile->Equipment_Condition }}</span>
                                                @endif
                                                @if (!empty($vehcile->Trailer_Type))
                                                    <span class="badge badge-primary " style="font-size: 16px;">
                                                        {{ $vehcile->Trailer_Type }}</span>
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
                                        {{-- <div class="dropdown">
                                            <a href="javascript:void(0)" tabindex="0"
                                                class="btn btn-link dropdown-toggle" id="additionalTermsDropdown"
                                                role="button" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                {{ isset($List->additional_info) && $List->additional_info->Additional_Terms ? Str::limit($List->additional_info->Additional_Terms, 20) : '...' }}
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="additionalTermsDropdown">
                                                <p class="dropdown-item">
                                                    {{ isset($List->additional_info) && $List->additional_info->Additional_Terms ? $List->additional_info->Additional_Terms : 'No additional terms available' }}
                                                </p>
                                            </div>
                                        </div> --}}
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
                                        <span class="text-nowrap"><strong>Job Price:</strong>
                                            ${{ $List->paymentinfo->Price_Pay_Carrier }}</span><br>
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
                                            </strong>${{ $List->paymentinfo->COD_Amount }}<br>
                                            <span class="text-nowrap"><strong>Pay Mode:</strong>
                                                {{ $List->paymentinfo->COD_Method_Mode }}</span><br>
                                        @endif
                                        <strong>Miles: </strong>{{ $List->routes->Miles }}miles<br>
                                        <strong>Price per Mile:
                                        </strong>${{ DayDispatchHelper::PricePerMiles($List->paymentinfo->Price_Pay_Carrier, $List->routes->Miles) }}/miles
                                    </td>
                                    <td>
                                        {{-- <strong>Pickup:</strong><br>
                                        <span class="text-nowrap">{{ $List->Pickup_Date }}
                                            ({{ $List->Date_Pickup_Mode }})</span>
                                        <br>
                                        <strong>Delivery:</strong><br><span class="text-nowrap">
                                            {{ $List->Delivery_Date }}
                                            ({{ $List->Date_Delivery_Mode }})</span><br>
                                        <strong>Date:</strong><br><span class="text-nowrap">
                                            {{ $List->created_at }}</span> --}}
                                        <strong>Pickup Date: </strong><br>
                                        {{-- ({{ $List->pickup_delivery_info->Pickup_Date_mode }}) --}}
                                        <span class="text-nowrap">{{ $List->pickup_delivery_info->Pickup_Date }}</span>
                                        {{-- @if (!is_null($List->pickup_delivery_info->Pickup_Start_Time))
                                            <br>
                                            {{ \Carbon\Carbon::parse($List->pickup_delivery_info->Pickup_Start_Time)->format('g:i A') . ' - ' . \Carbon\Carbon::parse($List->pickup_delivery_info->Pickup_End_Time)->format('g:i A') }}
                                        @endif --}}
                                        <br>
                                        <strong>Deliver Date: </strong><br>
                                        {{-- ({{ $List->pickup_delivery_info->Delivery_Date_mode }}) --}}
                                        <span class="text-nowrap">{{ $List->pickup_delivery_info->Delivery_Date }}</span>
                                        {{-- @if (!is_null($List->pickup_delivery_info->Delivery_Start_Time))
                                            <br>
                                            {{ \Carbon\Carbon::parse($List->pickup_delivery_info->Delivery_Start_Time)->format('g:i A') . ' - ' . \Carbon\Carbon::parse($List->pickup_delivery_info->Delivery_End_Time)->format('g:i A') }}
                                        @endif --}}
                                        <br>
                                        <span class="text-nowrap"><strong>Created Date:</strong><br>
                                            @php
                                                $created_at = \Carbon\Carbon::parse($List->created_at);
                                                $diffInHours = $created_at->diffInHours();

                                                if ($diffInHours >= 1 && $diffInHours <= 23) {
                                                    $created_at = $diffInHours . ' hrs ago';
                                                } else {
                                                    $created_at = $created_at->format('Y-m-d'); // You can use any desired date format here
                                                }
                                            @endphp
                                            {{ $created_at }}</span>
                                    </td>
                                    @if ($List->Listing_Status == 'Expired')
                                        <td>
                                            @if ($List->user_id === $currentUser->id)
                                                <a href="{{ route('User.ReList.Expired.Listing', ['List_ID' => $List->id]) }}"
                                                    target="_blank">
                                                    <button class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap">
                                                        Re-List
                                                    </button>
                                                </a>
                                                <a href="{{ route('User.Expire.Re.Edit.Listing', ['List_ID' => $List->id]) }}"
                                                    target="_blank">
                                                    <button class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap">
                                                        Re-List & Edit
                                                    </button>
                                                </a>
                                            @endif
                                            {{-- <h6><span class="badge badge-primary">{{ $List->Listing_Status }}</span> <br>
                                                <strong>Expired Date: </strong><br> --}}
                                            {{--  {{ $List->expire_at }}
                                                <div class="dropdown show list-actions">
                                                    <a class="btn btn-success dropdown-toggle btn-sm" href="#"
                                                        role="button" data-toggle="dropdown" aria-haspopup="true">
                                                        Actions
                                                    </a>

                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                            target="_blank">View Route</a>
                                                        @if ($List->user_id === $auth_user->id)
                                                            <a class="dropdown-item"
                                                                href="{{ route('User.ReList.Expired.Listing', ['List_ID' => $List->id]) }}"
                                                                target="_blank">Re-List</a>
                                                        @endif
                                                        @if ($List->user_id === $auth_user->id)
                                                            <a class="dropdown-item"
                                                                href="{{ route('User.Expire.Re.Edit.Listing', ['List_ID' => $List->id]) }}"
                                                                target="_blank">Re-List & Edit</a>
                                                        @endif
                                                    </div>
                                                </div> --}}
                                        </td>

                                    @elseif($List->Listing_Status == 'Waiting For Approval')
                                        <td>
                                            {{-- <h6><span class="badge badge-warning">Waiting</span></h6>
                                            <br> --}}
                                            {{-- <div class="dropdown show list-actions">
                                                <a class="btn btn-success dropdown-toggle btn-sm" href="#"
                                                    role="button" data-toggle="dropdown" aria-haspopup="true">
                                                    Actions
                                                </a>

                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                        target="_blank">View Route</a>
                                                    <a href="{{ route('Order.Agreement', ['List_ID' => $List->id]) }}"
                                                        target="_blank" class="dropdown-item" role="button">View
                                                        Offer</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('User.Cancel.Request', ['List_ID' => $List->id]) }}">Cancel
                                                        Request</a>
                                                    <a class="dropdown-item compare-listing" data-toggle="modal"
                                                        data-target="#CompareListing" href="javascript:void(0);">
                                                        <input hidden type="text" class="Listed-ID"
                                                            value="{{ $List->id }}">
                                                        <input hidden type="text" class="Listed-Type"
                                                            value="{{ $List->Listing_Type }}">
                                                        <input hidden type="text" class="Listed-Miles"
                                                            value="{{ $List->routes->Miles }}">
                                                        Compare Listing</a>
                                                    @if ($List->user_id === $auth_user->id)
                                                        <a class="dropdown-item"
                                                            href="{{ route('User.Edit.Listing', ['List_ID' => $List->id]) }}">Edit
                                                            Listing</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('User.Listing.Archive', ['List_ID' => $List->id]) }}">Archive
                                                            Order</a>
                                                    @endif
                                                </div>
                                            </div> --}}
                                            <a href="{{ route('Order.Agreement', ['List_ID' => $List->id]) }}"
                                                target="_blank"
                                                class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                role="button">Accept Offer</a>
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('User.Cancel.Request', ['List_ID' => $List->id]) }}">Decline
                                                Request</a>
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="#">Request changes S</a>
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="#">View
                                                Load Details S</a>
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                data-toggle="modal" data-target="#CompareListing"
                                                href="javascript:void(0);">
                                                <input hidden type="text" class="Listed-ID"
                                                    value="{{ $List->id }}">
                                                <input hidden type="text" class="Listed-Type"
                                                    value="{{ $List->Listing_Type }}">
                                                <input hidden type="text" class="Listed-Miles"
                                                    value="{{ $List->routes->Miles }}">
                                                Compare Listing</a>
                                            @if ($List->user_id === $currentUser->id)
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    href="{{ route('User.Edit.Listing', ['List_ID' => $List->id]) }}">Modify
                                                    Listing</a>
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    href="{{ route('User.Listing.Archive', ['List_ID' => $List->id]) }}">Archive
                                                    Order</a>
                                            @endif

                                        </td>
                                    @elseif($List->Listing_Status == 'Completed')
                                        <td>
                                            {{-- <h6><span class="badge badge-warning">{{ $List->Listing_Status }}</span>
                                            </h6> --}}
                                            <br>
                                            {{-- <div class="dropdown show list-actions">
                                                <a class="btn btn-success dropdown-toggle btn-sm" href="#"
                                                    role="button" data-toggle="dropdown" aria-haspopup="true">
                                                    Actions
                                                </a>

                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                    href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                    target="_blank">View Route</a>
                                                    <a href="{{ route('View.Agreement', ['List_ID' => $List->id]) }}"
                                                    class="dropdown-item" role="button">View Detail</a>

                                                    @if ($List->completed->completed_user->id === $auth_user->id)
                                                    <a class="dropdown-item rate-order" data-toggle="modal"
                                                        data-target="#RatingOrderModal" href="javascript:void(0);">
                                                        <input hidden type="text" class="New-Ref-ID"
                                                            value="{{ $List->Ref_ID }}">
                                                        <input hidden type="text" class="Listed-ID"
                                                            value="{{ $List->id }}">
                                                        @if ($List->Is_Rate != 1)
                                                            <input hidden type="text" class="Profile-ID"
                                                                value="{{ $List->completed->completed_user->id }}">
                                                            Rate Order
                                                            </a>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div> --}}
                                            {{-- <a class="btn btn-primary mb-2 w-100 d-block"
                                                href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                target="_blank">View Route</a> --}}
                                            <a href="{{ route('View.Agreement', ['List_ID' => $List->id]) }}"
                                                class="btn btn-outline-primary mb-2 w-100 d-block" role="button"
                                                target="_blank">View Detail</a>
                                            @if ($List->completed->completed_user->id === $currentUser->id && $List->Is_Rate != 1)
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block rate-order"
                                                    data-toggle="modal" data-target="#RatingOrderModal"
                                                    href="javascript:void(0);">
                                                    <input hidden type="hidden" class="New-Ref-ID"
                                                        value="{{ $List->Ref_ID }}">
                                                    <input hidden type="hidden" class="Listed-ID"
                                                        value="{{ $List->id }}">
                                                    <input hidden type="hidden" class="Profile-ID"
                                                        value="{{ $List->completed->completed_user->id }}">
                                                    Rate Order
                                                </a>
                                            @endif
                                        </td>
                                    @elseif($List->Listing_Status == 'Delivered')
                                        <td>
                                            {{-- <h6><span class="badge badge-warning">{{ $List->Listing_Status }}</span>
                                            </h6>
                                            <br> --}}
                                            @if ($List->Is_Rate != 1)
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap rate-order"
                                                    data-toggle="modal" data-target="#RatingOrderModal"
                                                    href="javascript:void(0);">
                                                    <input hidden type="text" class="New-Ref-ID"
                                                        value="{{ $List->Ref_ID }}">
                                                    <input hidden type="text" class="Listed-ID"
                                                        value="{{ $List->id }}">
                                                    <input hidden type="text" class="Profile-ID"
                                                        value="{{ $List->deliver->delivered_user->id }}">
                                                    <input hidden type="text" class="Company-Name"
                                                        value="{{ $List->deliver->delivered_user->Company_Name }}">
                                                    Rate Order
                                                </a>
                                            @else
                                                <button type="button" class="btn btn-outline-primary mb-2 w-100 d-block"
                                                    disabled>
                                                    <span class="">Rate Order</span>
                                                </button>
                                            @endif
                                            <a href="{{ route('View.Agreement', ['List_ID' => $List->id]) }}"
                                                class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                target="_blank" role="button">View
                                                Detail</a>
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                               href="{{ route('PostPickup.Bol.Listing', ['List_ID' => $List->id]) }}"
                                               target="_blank">View BOL</a>
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('User.Listing.Archive', ['List_ID' => $List->id]) }}">Archive</a>
                                            {{-- <div class="dropdown show list-actions">
                                                <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button" data-toggle="dropdown"
                                                    aria-haspopup="true">
                                                    Actions
                                                </a>

                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                        target="_blank">View Route</a>
                                                    <a href="{{ route('View.Agreement', ['List_ID' => $List->id]) }}" class="dropdown-item"
                                                        role="button">View Detail</a>
                                                    <a class="dropdown-item compare-listing" data-toggle="modal" data-target="#CompareListing"
                                                        href="javascript:void(0);">
                                                        <input hidden type="text" class="Listed-ID" value="{{ $List->id }}">
                                                        <input hidden type="text" class="Listed-Type" value="{{ $List->Listing_Type }}">
                                                        <input hidden type="text" class="Listed-Miles" value="{{ $List->routes->Miles }}">
                                                        Compare Listing</a>
                                                    @if ($List->user_id !== $auth_user->id)
                                                        <a class="dropdown-item add-misc" data-toggle="modal" data-target="#AddMisc"
                                                            href="javascript:void(0);">
                                                            <input hidden type="text" class="Listed-ID" value="{{ $List->id }}">Add Misc.</a>
                                                    @endif
                                                </div>
                                            </div> --}}
                                        </td>
                                    @elseif($List->Listing_Status == 'Listed')
                                        <td>
                                            {{-- <h6><span class="badge badge-primary">{{ $List->Listing_Status }}</span> <br><br> --}}
                                            {{-- <a href="{{ route('User.Watchlist.store', $List->id) }}">
                                                    @if ($List->authorized_user->my_watch_check($List->id) !== null)
                                                        <i class="fa fa-heart" aria-hidden="true"
                                                            title="Remove from Watch List"></i>
                                                    @else
                                                        <i class="fa-regular fa-heart" title="Add to Watch List"></i>
                                                    @endif
                                                </a> --}}
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
                                                        @if (\App\Models\Carrier\RequestBroker::where('order_id', $List->id)->where('CMP_id', Auth::guard('Authorized')->user()->id)->where('is_cancel', 0)->exists())
                                                            <a class="dropdown-item request-load text-danger" href="javascript:void(0);">Already
                                                                Requested</a>
                                                        @else
                                                            <a onclick="request_load_click({{ $List->id }})" id="{{ $List->id }}"
                                                                class="dropdown-item request-load" data-toggle="modal" data-target="#CarrierRequestLoad"
                                                                href="javascript:void(0);">
                                                                <input hidden type="text" class="Listed-Ref-ID" value="{{ $List->Ref_ID }}">
                                                                <input hidden type="text" class="Listed-ID" value="{{ $List->id }}">
                                                                <input hidden type="text" class="Listed-Price"
                                                                    value="{{ (int) Str::replace(['$ ', ','], '', $List->paymentinfo->Price_Pay_Carrier) }}">
                                                                <input hidden type="text" class="Pickup-Date"
                                                                    value="{{ $List->pickup_delivery_info->Pickup_Date }}">
                                                                <input hidden type="text" class="Deliver-Date"
                                                                    value="{{ $List->pickup_delivery_info->Delivery_Date }}">
                                                                Bid / Request Load</a>
                                                        @endif

                                                        <a class="dropdown-item compare-listing" data-toggle="modal" data-target="#CompareListing"
                                                            href="javascript:void(0);">
                                                            <input hidden type="text" class="Listed-ID" value="{{ $List->id }}">
                                                            <input hidden type="text" class="Listed-Type" value="{{ $List->Listing_Type }}">
                                                            <input hidden type="text" class="Listed-Miles" value="{{ $List->routes->Miles }}">
                                                            Compare Listing</a>

                                                        @if ($List->user_id === $auth_user->id)
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
                                            {{-- <div class="row d-block">
                                                    <div class="col-12 mb-1"> --}}
                                            {{-- <a onclick="request_load_click({{ $List->id }})"
                                                id="{{ $List->id }}" data-toggle="modal"
                                                data-target="#CarrierRequestLoad" href="javascript:void(0);"
                                                class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap request-load">Bid/Request
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
                                            </a> --}}
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                                href="{{ route('User.Watchlist.store', $List->id) }}">
                                                Remove From Watchlist
                                            </a>
                                            {{-- </div> --}}
                                            {{-- @if ($List->user_id === $currentUser->id)
                                                <div class="col-12 mb-1">
                                                <a href="{{ route('User.Dispatch.Listing', ['List_ID' => $List->id]) }}"
                                                    class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap ">Assign
                                                    Listing</a>
                                                </div>
                                                        <div class="col-12 mb-1">
                                                <a href="{{ route('User.Edit.Listing', ['List_ID' => $List->id]) }}"
                                                    class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap ">Edit
                                                    Listing</a>
                                                </div>
                                            @endif
                                            <div class="col-12 mb-1">
                                            <a href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                target="_blank"
                                                class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap ">View
                                                Route</a> --}}
                                            {{-- </div>
                                                </div> --}}
                                        </td>
                                    @elseif($List->Listing_Status == 'Dispatch')
                                        <td>
                                            {{-- <h6><span class="badge badge-warning">{{ $List->Listing_Status }}</span>
                                            </h6>
                                            <br> --}}
                                            {{-- <div class="dropdown show list-actions">
                                                <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button" data-toggle="dropdown"
                                                    aria-haspopup="true">
                                                    Actions
                                                </a>

                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                        target="_blank">View Route</a>
                                                    <a href="{{ route('View.Agreement', ['List_ID' => $List->id]) }}" class="dropdown-item"
                                                        role="button">View Detail</a>
                                                    <a class="dropdown-item compare-listing" data-toggle="modal" data-target="#CompareListing"
                                                        href="javascript:void(0);">
                                                        <input hidden type="text" class="Listed-ID" value="{{ $List->id }}">
                                                        <input hidden type="text" class="Listed-Type" value="{{ $List->Listing_Type }}">
                                                        <input hidden type="text" class="Listed-Miles" value="{{ $List->routes->Miles }}">
                                                        Compare Listing</a>
                                                    <a data-toggle="modal" data-target="#CancelOrderModal" href="javascript:void(0);"
                                                        class="dropdown-item Cancel_Order" role="button">
                                                        <input hidden type="text" class="Listed-ID" value="{{ $List->id }}">
                                                        <input hidden type="text" class="User-ID" value="{{ $List->user_id }}">
                                                        <input hidden type="text" class="CMP-ID" value="{{ $List->id }}">
                                                        <input hidden type="text" class="Order-Status" value="{{ $List->Listing_Status }}">
                                                        Cancel Order</a>
                                                    @if ($List->user_id !== $auth_user->id)
                                                        <a class="dropdown-item attach-bill" data-toggle="modal" data-target="#AttachBill"
                                                            href="javascript:void(0);">
                                                            <input hidden type="text" class="Listed-ID" value="{{ $List->id }}">
                                                            <input hidden type="text" class="List-Ref-ID" value="{{ $List->Ref_ID }}">Pickup</a>
                                                    @endif
                                                    @if ($List->user_id === $auth_user->id)
                                                        <a class="dropdown-item" href="{{ route('User.Edit.Listing', ['List_ID' => $List->id]) }}">Edit
                                                            Listing</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('Order.Pickup.Approval', ['List_ID' => $List->id]) }}">PickUp</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('Order.Not.Pickup.Approval', ['List_ID' => $List->id]) }}">Not
                                                            PickUp</a>
                                                    @endif
                                                </div>
                                            </div> --}}

                                            <form action="{{ route('Order.Pickup', ['List_ID' => $List->id]) }}"
                                                method="GET" class="was-validated" enctype="multipart/form-data">
                                                @csrf
                                                <button class="btn btn-outline-primary mb-2 w-100 d-block"
                                                    href="{{ route('Order.Pickup', ['List_ID' => $List->id]) }}">Mark As
                                                    Picked Up</button>
                                            </form>
                                            <a href="{{ route('View.Agreement', ['List_ID' => $List->id]) }}"
                                                class="btn btn-outline-primary mb-2 w-100 d-block" target="_blank"
                                                role="button">View Details</a>
                                            <button class="add-misc btn btn-outline-primary mb-2 w-100 d-block"
                                                data-toggle="modal" data-target="#AddMisc" href="javascript:void(0);">
                                                <input hidden type="text" class="Listed-ID"
                                                    value="{{ $List->id }}">
                                                <input hidden type="text" class="Ref-ID"
                                                    value="{{ $List->Ref_ID }}">Add Misc.</button>
                                            <button class="show-misc btn btn-outline-primary mb-2 w-100 d-block"
                                                data-toggle="modal" data-target="#ShowMisc" href="javascript:void(0);">
                                                <input hidden type="text" class="Listed-ID"
                                                    value="{{ $List->id }}">
                                                <input hidden type="text" class="Ref-ID"
                                                    value="{{ $List->Ref_ID }}">Show Misc. <span
                                                    class="badges">({{ count($List->miscellenous) }})</span></button>
                                            <button data-toggle="modal" data-target="#CancelOrderModal"
                                                href="javascript:void(0);"
                                                class="btn btn-outline-primary mb-2 w-100 d-block Cancel_Order"
                                                role="button">
                                                <input hidden type="text" class="Listed-ID"
                                                    value="{{ $List->id }}">
                                                <input hidden type="text" class="User-ID"
                                                    value="{{ $List->user_id }}">
                                                <input hidden type="text" class="CMP-ID"
                                                    value="{{ $List->dispatch_listing->dispatch_user->id }}">
                                                <input hidden type="text" class="Order-Status"
                                                    value="{{ $List->Listing_Status }}">Cancel Dispatch</button>

                                            @if ($List->Listing_Status === 'Dispatch')
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                                    href="{{ route('User.Bol.Listing', ['List_ID' => $List->id]) }}"
                                                    target="_blank">
                                                    {{ isset($List->dispatch_bol->id) ? 'View Bol' : 'Upload Bol' }}
                                                </a>
                                            @endif
                                            @if ($List->user_id === $currentUser->id)
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                                    href="{{ route('User.Edit.Listing', ['List_ID' => $List->id]) }}">Modify
                                                    Listing</a>
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                                    href="{{ route('Order.Pickup.Approval', ['List_ID' => $List->id]) }}">PickUp</a>
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                                    href="{{ route('Order.Not.Pickup.Approval', ['List_ID' => $List->id]) }}">Not
                                                    PickUp</a>
                                            @endif
                                        </td>
                                    @elseif($List->Listing_Status == 'Deleted')
                                        <td>
                                            {{-- <h6><span class="badge badge-primary">{{ $List->Listing_Status }}</span> <br>
                                                <strong>Expired Date: </strong><br>
                                                {{ $List->expire_at }} --}}
                                            {{-- <div class="dropdown show list-actions">
                                                    <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button"
                                                        data-toggle="dropdown" aria-haspopup="true">
                                                        Actions
                                                    </a>

                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                            target="_blank">View Route</a>
                                                        @if ($List->user_id === $auth_user->id)
                                                            <a class="dropdown-item"
                                                                href="{{ route('User.Listing.Restore', ['List_ID' => $List->id]) }}">Restore
                                                                Listing</a>
                                                        @endif
                                                    </div>
                                                </div> --}}
                                            @if ($List->user_id === $currentUser->id)
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    href="{{ route('User.Deleted.Restore', ['List_ID' => $List->id]) }}">Restore
                                                    Listing</a>
                                            @endif
                                        </td>
                                    @elseif($List->Listing_Status == 'Cancelled')
                                        <td>
                                            {{-- <h6><span class="badge badge-primary">{{ $List->Listing_Status }}</span> <br> --}}
                                            @if ($List->deleted_at !== null)
                                                <h6>Status:
                                                    <span class="badge badge-primary">
                                                        Re Listed
                                                    </span>
                                                    <span class="badge badge-warning">
                                                        {{ $List->Ref_ID }}
                                                        {{-- {{ !is_null($List->cancel->cancelled_by) ? $List->cancel->cancelled_by->Company_Name : '' }} --}}
                                                    </span>
                                                    {{-- <span class="badge badge-warning">
                                                                Cancelled by {{ $List->cancel->cancel_user->Company_Name }}
                                                            </span> --}}
                                                </h6>
                                            @else
                                                {{-- <h6><span class="badge badge-warning">{{ $List->Listing_Status }}</span>
                                                    </h6>
                                                    <div class="dropdown show list-actions">
                                                        <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button"
                                                            data-toggle="dropdown" aria-haspopup="true">
                                                            Actions
                                                        </a>

                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item"
                                                                href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                                target="_blank">View Route</a>
                                                            <a href="{{ route('View.Agreement', ['List_ID' => $List->id]) }}" class="dropdown-item"
                                                                role="button">View Detail</a>
                                                            @if ($List->user_id === $auth_user->id)
                                                                <a class="dropdown-item" href="{{ route('User.Edit.Listing', $List->id) }}"
                                                                    target="_blank">Re Listed</a>
                                                            @endif
                                                            <a class="dropdown-item Generate-Ticket" data-toggle="modal" data-target="#TicketModal"
                                                                href="javascript:void(0);">
                                                                <input hidden type="text" class="Listed-ID" value="{{ $List->id }}">
                                                                <input hidden type="text" class="Ref-ID" value="{{ $List->Ref_ID }}">
                                                                <input hidden type="text" class="User-ID" value="{{ $List->user_id }}">
                                                                <input hidden type="text" class="User-Email"
                                                                    value="{{ $List->authorized_user->email }}">
                                                                <input hidden type="text" class="User-Name"
                                                                    value="{{ $List->authorized_user->Company_Name }}">
                                                                <input hidden type="text" class="CMP-ID" value="{{ $List->Ref_ID }}">
                                                                <input hidden type="text" class="CMP-Email" value="{{ $List->Ref_ID }}">
                                                                <input hidden type="text" class="CMP-Name" value="{{ $List->Ref_ID }}">
                                                                Generate Ticket</a>
                                                        </div>
                                                    </div> --}}
                                                <a href="{{ route('View.Agreement', ['List_ID' => $List->id]) }}"
                                                    target="_blank"
                                                    class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    role="button">View
                                                    Detail</a>
                                                @if ($List->user_id === $currentUser->id)
                                                    <button class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                        onclick="window.location.href='{{ route('User.Replicate.Listing', ['List_ID' => $List->id]) }}'">
                                                        Replicate Listing
                                                    </button>
                                                @endif
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap Generate-Ticket"
                                                    data-toggle="modal" data-target="#TicketModal"
                                                    href="javascript:void(0);">
                                                    <input hidden type="text" class="Listed-ID"
                                                        value="{{ $List->id }}">
                                                    <input hidden type="text" class="Ref-ID"
                                                        value="{{ $List->Ref_ID }}">
                                                    <input hidden type="text" class="User-ID"
                                                        value="{{ $List->user_id }}">
                                                    <input hidden type="text" class="User-Email"
                                                        value="{{ $List->authorized_user->email }}">
                                                    <input hidden type="text" class="User-Name"
                                                        value="{{ $List->authorized_user->Company_Name }}">
                                                    <input hidden type="text" class="CMP-ID"
                                                        value="{{ $List->cancel->cancel_user->id }}">
                                                    <input hidden type="text" class="CMP-Email"
                                                        value="{{ $List->cancel->cancel_user->email }}">
                                                    <input hidden type="text" class="CMP-Name"
                                                        value="{{ $List->cancel->cancel_user->Company_Name }}">
                                                    Generate Ticket</a>
                                            @endif
                                        </td>
                                    @elseif($List->Listing_Status == 'PickUp Approval')
                                        <td>
                                            {{-- <h6><span class="badge badge-warning">{{ $List->Listing_Status }}</span>
                                            </h6>
                                            <br> --}}
                                            <div class="dropdown show list-actions">
                                                <a class="btn btn-success dropdown-toggle btn-sm" href="#"
                                                    role="button" data-toggle="dropdown" aria-haspopup="true">
                                                    Actions
                                                </a>

                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                        target="_blank">View Route</a>
                                                    <a href="{{ route('View.Agreement', ['List_ID' => $List->id]) }}"
                                                        target="_blank" class="dropdown-item" role="button">View
                                                        Detail</a>
                                                    <a data-toggle="modal" data-target="#CancelOrderModal"
                                                        href="javascript:void(0);" class="dropdown-item Cancel_Order"
                                                        role="button">
                                                        <input hidden type="text" class="Listed-ID"
                                                            value="{{ $List->id }}">
                                                        <input hidden type="text" class="User-ID"
                                                            value="{{ $List->user_id }}">
                                                        {{-- <input hidden type="text" class="CMP-ID"
                                                                                                                                value="{{ $List->pickup_approve->pickup_approval_user->id }}"> --}}
                                                        <input hidden type="text" class="Order-Status"
                                                            value="{{ $List->Listing_Status }}">
                                                        Cancel Order</a>
                                                    <a class="dropdown-item compare-listing" data-toggle="modal"
                                                        data-target="#CompareListing" href="javascript:void(0);">
                                                        <input hidden type="text" class="Listed-ID"
                                                            value="{{ $List->id }}">
                                                        <input hidden type="text" class="Listed-Type"
                                                            value="{{ $List->Listing_Type }}">
                                                        <input hidden type="text" class="Listed-Miles"
                                                            value="{{ $List->routes->Miles }}">
                                                        Compare Listing</a>
                                                    @if ($List->user_id !== $auth_user->id)
                                                        <a class="dropdown-item add-misc" data-toggle="modal"
                                                            data-target="#AddMisc" href="javascript:void(0);">
                                                            <input hidden type="text" class="Listed-ID"
                                                                value="{{ $List->id }}">Add Misc.</a>
                                                    @endif
                                                    @if ($List->user_id === $auth_user->id)
                                                        <a class="dropdown-item"
                                                            href="{{ route('User.Edit.Listing', ['List_ID' => $List->id]) }}">Edit
                                                            Listing</a>

                                                        <a href="{{ route('Order.Not.Pickup.Approval', ['List_ID' => $List->id]) }}"
                                                            class="dropdown-item" role="button">Not
                                                            Approve</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('Order.Pickup', ['List_ID' => $List->id]) }}">Pick
                                                            Up</a>
                                                        {{-- <a class="dropdown-item"
                                                                                                                                href="{{ route('User.Listing.Archive', ['List_ID' => $List->id]) }}">Archive
                                                                                                                                Order</a> --}}
                                                        <button class="btn get-history" data-toggle="modal"
                                                            data-target="#showModal">
                                                            <i class="ri-mail-line align-bottom me-2 text-muted"></i>
                                                            Authorization Form
                                                            <input type="hidden" class="user_email" name="user_email"
                                                                value=""></button>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    @elseif($List->Listing_Status == 'PickUp')
                                        <td>
                                            {{-- <h6><span class="badge badge-warning">{{ $List->Listing_Status }}</span>
                                            </h6>
                                            <br>
                                            <div class="dropdown show list-actions">
                                                <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button" data-toggle="dropdown"
                                                    aria-haspopup="true">
                                                    Actions
                                                </a>

                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                        target="_blank">View Route</a>
                                                    <a href="{{ route('View.Agreement', ['List_ID' => $List->id]) }}" class="dropdown-item"
                                                        role="button">View Detail</a>
                                                    <a class="dropdown-item compare-listing" data-toggle="modal" data-target="#CompareListing"
                                                        href="javascript:void(0);">
                                                        <input hidden type="text" class="Listed-ID" value="{{ $List->id }}">
                                                        <input hidden type="text" class="Listed-Type" value="{{ $List->Listing_Type }}">
                                                        <input hidden type="text" class="Listed-Miles" value="{{ $List->routes->Miles }}">
                                                        Compare Listing</a>
                                                    @if ($List->user_id === $auth_user->id)
                                                        <a class="dropdown-item" href="{{ route('User.Edit.Listing', ['List_ID' => $List->id]) }}">Edit
                                                            Listing</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('Order.Deliverd.Approval', ['List_ID' => $List->id]) }}">Delivered</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('Order.Not.Deliverd.Approval', ['List_ID' => $List->id]) }}">Not
                                                            Delivered</a>
                                                    @endif
                                                    @if ($List->user_id !== $auth_user->id)
                                                        <a class="dropdown-item add-misc" data-toggle="modal" data-target="#AddMisc"
                                                            href="javascript:void(0);">
                                                            <input hidden type="text" class="Listed-ID" value="{{ $List->id }}">Add Misc.</a>
                                                        <a class="dropdown-item attach-bill" data-toggle="modal" data-target="#AttachBill"
                                                            href="javascript:void(0);">
                                                            <input hidden type="text" class="Listed-ID" value="{{ $List->id }}">Deliver</a>
                                                    @endif
                                                </div>
                                            </div> --}}
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('Order.Deliverd', ['List_ID' => $List->id]) }}">Mark
                                                as Delivered</a>
                                            <a href="{{ route('View.Agreement', ['List_ID' => $List->id]) }}"
                                                class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                target="_blank" role="button">View
                                                Details</a>
                                            <a class="btn btn-outline-primary  mb-2 w-100 d-block text-nowrap"
                                               href="{{ route('PostPickup.Bol.Listing', ['List_ID' => $List->id]) }}">View/Upload Delivered Bol
                                            </a>
                                            <button class="text-nowrap add-misc btn btn-outline-primary mb-2 w-100 d-block"
                                                data-toggle="modal" data-target="#AddMisc" href="javascript:void(0);">
                                                <input hidden type="text" class="Listed-ID"
                                                    value="{{ $List->id }}">
                                                <input hidden type="text" class="Ref-ID"
                                                    value="{{ $List->Ref_ID }}">Add Misc.</button>
                                            <button
                                                class="text-nowrap show-misc btn btn-outline-primary mb-2 w-100 d-block"
                                                data-toggle="modal" data-target="#ShowMisc" href="javascript:void(0);">
                                                <input hidden type="text" class="Listed-ID"
                                                    value="{{ $List->id }}">
                                                <input hidden type="text" class="Ref-ID"
                                                    value="{{ $List->Ref_ID }}">Show Misc. <span
                                                    class="badges">({{ count($List->miscellenous) }})</span></button>
                                            @if ($List->user_id !== $currentUser->id)
                                                @php
                                                    $idsArray = $idsArray ?? [];
                                                    $listingId = $List->id;
                                                    $inArray = in_array($listingId, $idsArray);
                                                @endphp
                                            @endif
                                        </td>
                                    @elseif($List->Listing_Status == 'Archived')
                                        <td>
                                            {{-- <h6><span class="badge badge-primary">{{ $List->Listing_Status }}</span> <br>
                                                <strong>Expired Date: </strong><br>
                                                {{ $List->expire_at }}
                                                <div class="dropdown show list-actions">
                                                    <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button"
                                                        data-toggle="dropdown" aria-haspopup="true">
                                                        Actions
                                                    </a>

                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                            target="_blank">View Route</a>
                                                        @if ($List->user_id === $auth_user->id)
                                                            <a class="dropdown-item"
                                                                href="{{ route('User.Listing.Restore', ['List_ID' => $List->id]) }}">Restore
                                                                Listing</a>
                                                        @endif
                                                    </div>
                                                </div> --}}
                                            @if ($List->user_id === $currentUser->id)
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                                    href="{{ route('User.Listing.Delete', ['List_ID' => $List->id]) }}">Delete
                                                    Listing</a>
                                            @endif
                                            @if ($List->user_id === $currentUser->id)
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                                    href="{{ route('User.Edit.Listing', ['List_ID' => $List->id]) }}">Modify
                                                    Listing</a>
                                            @endif
                                            @if ($List->user_id === $currentUser->id)
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                                    href="{{ route('User.Listing.Restore', ['List_ID' => $List->id]) }}"
                                                    role="button">Restore
                                                    Listing</a>
                                            @endif
                                        </td>
                                    @elseif($List->Listing_Status == 'Deliver Approval')
                                        <td>
                                            {{-- <h6><span class="badge badge-warning">{{ $List->Listing_Status }}</span>
                                            </h6>
                                            <br> --}}
                                            <div class="dropdown show list-actions">
                                                <a class="btn btn-success dropdown-toggle btn-sm" href="#"
                                                    role="button" data-toggle="dropdown" aria-haspopup="true">
                                                    Actions
                                                </a>

                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                        target="_blank">View Route</a>
                                                    <a href="{{ route('View.Agreement', ['List_ID' => $List->id]) }}"
                                                        target="_blank" class="dropdown-item" role="button">View
                                                        Detail</a>
                                                    <a class="dropdown-item compare-listing" data-toggle="modal"
                                                        data-target="#CompareListing" href="javascript:void(0);">
                                                        <input hidden type="text" class="Listed-ID"
                                                            value="{{ $List->id }}">
                                                        <input hidden type="text" class="Listed-Miles"
                                                            value="{{ $List->routes->Miles }}">
                                                        Compare Listing</a>
                                                    @if ($List->user_id === $auth_user->id)
                                                        <a class="dropdown-item"
                                                            href="{{ route('User.Edit.Listing', ['List_ID' => $List->id]) }}">Edit
                                                            Listing</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('Order.Deliverd', ['List_ID' => $List->id]) }}">Delivered</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('Order.Not.Deliverd', ['List_ID' => $List->id]) }}">Not
                                                            Delivered</a>
                                                        {{-- <a class="dropdown-item"
                                                                                                                                href="{{ route('User.Listing.Archive', ['List_ID' => $List->id]) }}">Archive
                                                                                                                                Order</a> --}}
                                                        <button class="btn get-history" data-bs-toggle="modal"
                                                            data-bs-target="#showModal">
                                                            <i class="ri-mail-line align-bottom me-2 text-muted"></i>
                                                            Authorization Form
                                                            <input type="hidden" class="user_email" name="user_email"
                                                                value=""></button>
                                                    @endif
                                                    @if ($List->user_id !== $auth_user->id)
                                                        <a class="dropdown-item add-misc" data-toggle="modal"
                                                            data-target="#AddMisc" href="javascript:void(0);">
                                                            <input hidden type="text" class="Listed-ID"
                                                                value="{{ $List->id }}">Add Misc.</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="table-responsive">
                    <table
                        class="display dataTable datatable-range table-1 advance-6 text-center table-bordered table-cards">
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
                                @if ($List->Listing_Status == 'Deliver Approval')
                                    @continue
                                @endif
                                <tr class="card-row" data-status="active">
                                    <td>
                                        @if ($List->deleted_at == null)
                                            <h6><span class="badge badge-warning">{{ $List->Listing_Status }}</span>
                                            </h6>
                                        @endif
                                        <span class="fs-4"><strong>{{ $List->Ref_ID }}</strong></span><br>
                                        @if (count($List->attachments) > 0)
                                            <strong><a href="{{ route('Order.Attachments', ['List_ID' => $List->id]) }}"
                                                    target="_blank">View Images</a></strong><br>
                                        @endif

                                    </td>
                                    <td>
                                        @if ($List->dispatch_listing)
                                            @php
                                                $companyName = $List->dispatch_listing->dispatch_user->Company_Name;
                                                $trimmedCompanyName = Str::words($companyName, 3, '...');
                                            @endphp

                                            <span style="font-size: x-large;">
                                                <a target="_blank" class="locations-color"
                                                    href="{{ route('View.Profile', $List->dispatch_listing->dispatch_user->id) }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="{{ $companyName }}">
                                                    <strong>{{ $trimmedCompanyName }}</strong>
                                                </a>
                                            </span><br>
                                            {{-- <span style="font-size: x-large; "><a target="_blank" class="locations-color"
                                                    href="{{ route('View.Profile', $List->dispatch_listing->dispatch_user->id) }}"><strong>{{ $List->dispatch_listing->dispatch_user->Company_Name }}</strong></a>
                                            </span><br> --}}
                                            <span>
                                                <strong>Contact:</strong>
                                                <a class="locations-color"
                                                    href="tel:{{ $List->dispatch_listing->dispatch_user->Contact_Phone }}">
                                                    {{ $List->dispatch_listing->dispatch_user->Contact_Phone }}
                                                </a>
                                            </span><br>
                                            <span>
                                                <strong>Email:</strong>
                                                <a class="locations-color"
                                                    href="mailto:{{ $List->dispatch_listing->dispatch_user->email }}">
                                                    {{ $List->dispatch_listing->dispatch_user->email }}
                                                </a>
                                            </span><br>
                                            {{-- Contact:{{ $List->dispatch_listing->dispatch_user->Contact_Phone }}<br>
                                        Email:{{ $List->dispatch_listing->dispatch_user->email }}<br> --}}
                                            Time:{{ $List->dispatch_listing->dispatch_user->Hours_Operations }}<br>
                                            @php
                                                if (!function_exists('getUserRating')) {
                                                    function getUserRating($userId)
                                                    {
                                                        $orderRatings = app(\App\Services\OrderRatings::class);
                                                        $ratings = $orderRatings->getUserRating($userId);
                                                        $ratingsCount = $orderRatings
                                                            ->getUserRatingRecords($userId)
                                                            ->count();

                                                        return [
                                                            'ratings' => $ratings,
                                                            'count' => $ratingsCount,
                                                        ];
                                                    }
                                                }

                                                $userRatings = getUserRating(
                                                    $List->dispatch_listing->dispatch_user->id,
                                                );
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
                                                    <a href="">({{ $ratingsCount }})</a>
                                                </div>
                                            @else
                                                <span>No ratings yet.</span>
                                            @endif
                                            <br>
                                            <span class="badge badge-pill badge-success" style="cursor:pointer;"
                                                onclick="window.open('{{ route('chat', $List->CMP_id) }}', '_blank')">
                                                Message Carrier
                                            </span>
                                        @else
                                            Not dispatched yet.
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
                                            {{-- <form id="searchForm" action="{{ route('global.search.index') }}" method="GET">
                                                    <input type="hidden" id="new_listing" name="new_listing" value="new">
                                                    <button type="submit">
                                                        <div class="ribbon-two ribbon-two-danger">
                                                            <span>New</span>
                                                        </div>
                                                    </button>
                                                </form> --}}
                                            {{-- <form id="searchForm" action="{{ route('global.search.index') }}"
                                                method="GET">
                                                <input type="hidden" id="new_listing" name="new_listing"
                                                    value="new">
                                                <button type="submit" class="ribbon-box">
                                                    <div class="ribbon-two ribbon-two-danger">
                                                        <span>New</span>
                                                    </div>
                                                </button>
                                            </form> --}}
                                        @endif
                                        <div class="mb-2">
                                            <span><strong style="font-size: 1.3rem;">Pickup</strong></span><br>
                                            <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                                href="https://www.google.com/maps/place/{{ urlencode($List->routes->Origin_ZipCode) }}"
                                                target="_blank">
                                                {{-- <i class="fas fa-map-marker-alt text-success fs-30"></i> --}}
                                                {{ Str::replace(',', '-', $List->routes->Origin_ZipCode) }}
                                            </a>
                                        </div>
                                        <div class="mb-2">
                                            <span><strong style="font-size: 1.3rem;">Delivery</strong></span><br>
                                            <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                                href="https://www.google.com/maps/place/{{ urlencode($List->routes->Dest_ZipCode) }}"
                                                target="_blank">
                                                {{-- <i class="fas fa-map-marker-alt text-danger fs-30"></i> --}}
                                                {{ Str::replace(',', '-', $List->routes->Dest_ZipCode) }}
                                            </a>
                                        </div>
                                        <div class="mb-2">
                                            <span class="fs-5"><strong><a
                                                        class="btn btn-outline-primary text-decoration-none fw-bold"
                                                        href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                        target="_blank">View Route</a></strong></span>
                                        </div>
                                        {{-- <strong>Pickup Route</strong><br>
                                        <a class="text-nowrap"
                                            href="https://www.google.com/maps/place/{{ urlencode($List->routes->Origin_ZipCode) }}"
                                            target="_blank"><i class="fas fa-map-marker-alt text-success fs-30"></i>
                                            {{ Str::replace(',', '-', $List->routes->Origin_ZipCode) }}
                                        </a><br>
                                        <strong>Delivery Route</strong><br>
                                        <a class="text-nowrap"
                                            href="https://www.google.com/maps/place/{{ urlencode($List->routes->Dest_ZipCode) }}"
                                            target="_blank"><i class="fas fa-map-marker-alt text-danger fs-30"></i>
                                            {{ Str::replace(',', '-', $List->routes->Dest_ZipCode) }}
                                        </a>
                                        <div class="mb-2">
                                            <span class="fs-5"><strong>
                                                    <a class="badge badge-pill badge-primary"
                                                        href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                        target="_blank">View Route</a>
                                                </strong></span>
                                        </div> --}}
                                    </td>
                                    <td>
                                        {{-- @if (count($List->vehicles) === 1)
                                                                @foreach ($List->vehicles as $vehcile)
                                                                    <a class="font-weight-bold text-dark"
                                                                        href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                                        target="_blank">
                                                                        <span class="fs-5"><strong>{{ $vehcile->Vehcile_Year }}
                                                                                {{ $vehcile->Vehcile_Make }}
                                                                                {{ $vehcile->Vehcile_Model }}</strong></span></a><br>
                                                                    @if (!empty($vehcile->Vehcile_Condition))
                                                                        <span class="badge bg-success text-white"
                                                                            style="font-size: 16px;">{{ $vehcile->Vehcile_Condition }}</span>
                                                                    @endif
                                                                    @if (!empty($vehcile->Trailer_Type))
                                                                        <span class="badge bg-primary text-white" style="font-size: 16px;">
                                                                            {{ $vehcile->Trailer_Type }}</span>
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
                                                            @endif --}}
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
                                                    style="font-size: 21px; cursor: pointer;">{{-- <i class="fa-solid fa-car-side" style="margin-right: 5px;"></i> --}}Vehicles({{ count($List->vehicles) }})
                                                </a>
                                                <div class="dropdown-menu text-center"
                                                    style="max-height: 200px; overflow-y: auto;">
                                                    <h6 class="dropdown-header" style="background-color: lightgrey;">
                                                        Attached Vehicles</h6>
                                                    @foreach ($List->vehicles as $vehicle)
                                                        <a class="dropdown-item" style="color: #0560a6; font-weight: 800;"
                                                            href="https://www.google.com/search?q={{ $vehicle->Vehcile_Year }}%20{{ $vehicle->Vehcile_Make }}%20{{ $vehicle->Vehcile_Model }}"
                                                            target="_blank">{{ $vehicle->Vehcile_Year }}{{ $vehicle->Vehcile_Make }}{{ $vehicle->Vehcile_Model }}<br>
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
                                            @foreach ($List->heavy_equipments as $vehcile)
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
                                                {{-- @if (!empty($vehcile->Equipment_Condition))
                                                                                    <br>{{ $vehcile->Equipment_Condition }}<br>
                                                                                @endif
                                                                                @if (!empty($vehcile->Trailer_Type))
                                                                                    <span
                                                                                        @if ($vehcile->Trailer_Type == '"(Enclosed Trailer Required)"') class="text-primary font-weight-bold" @endif>{{ $vehcile->Trailer_Type }}</span>
                                                                                @endif --}}
                                                @if (!empty($vehcile->Equipment_Condition))
                                                    <span class="badge badge-success "
                                                        style="font-size: 16px;">{{ $vehcile->Equipment_Condition }}</span>
                                                @endif
                                                @if (!empty($vehcile->Trailer_Type))
                                                    <span class="badge badge-primary " style="font-size: 16px;">
                                                        {{ $vehcile->Trailer_Type }}</span>
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
                                        <div class="dropdown mt-3 d-block">
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
                                        {{-- <div class="dropdown">
                                                                <a href="javascript:void(0)" tabindex="0" class="btn btn-link dropdown-toggle"
                                                                    id="additionalTermsDropdown" role="button" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    {{ isset($List->additional_info) && $List->additional_info->Additional_Terms ? Str::limit($List->additional_info->Additional_Terms, 20) : '...' }}
                                                                </a>
                                                                <div class="dropdown-menu" aria-labelledby="additionalTermsDropdown">
                                                                    <p class="dropdown-item">
                                                                        {{ isset($List->additional_info) && $List->additional_info->Additional_Terms ? $List->additional_info->Additional_Terms : 'No additional terms available' }}
                                                                    </p>
                                                                </div>
                                                            </div> --}}
                                        {{-- <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                                                data-trigger="focus" style="cursor: pointer;" title="Additional Terms"
                                                                data-content=
                                                                        "{{ !empty($List->additional_info->Additional_Terms) ? $List->additional_info->Additional_Terms : '' }}">
                                                                {{ !empty($List->additional_info->Additional_Terms) ? Str::limit($List->additional_info->Additional_Terms, 20) : '...' }}</a> --}}
                                    </td>
                                    <td>
                                        <strong>Job Price: </strong>${{ $List->paymentinfo->Price_Pay_Carrier }}<br>
                                        @if ($List->paymentinfo->COD_Amount === '0')
                                        @else
                                            <strong>
                                                @if ($List->paymentinfo->COD_Location_Amount == 'PickUp')
                                                    Pay on Pickup
                                                @else
                                                    Pay on Delivery
                                                @endif
                                            </strong>:${{ $List->paymentinfo->COD_Amount }}<br>
                                            <span class="text-nowrap"><strong>Pay Mode:</strong>
                                                {{ $List->paymentinfo->COD_Method_Mode }}</span><br>
                                        @endif
                                        <strong>Mile:</strong>{{ $List->routes->Miles }}miles<br>
                                        <strong>Price per
                                            Mile:</strong>${{ DayDispatchHelper::PricePerMiles($List->paymentinfo->Price_Pay_Carrier, $List->routes->Miles) }}/miles
                                    </td>
                                    <td>
                                        @if ($List->pickup_delivery_info)
                                            <span class="text-nowrap"><strong>Pickup Date: </strong></span><br>
                                            <span
                                                class="text-nowrap">{{ $List->pickup_delivery_info->Pickup_Date }}</span><br>
                                            <span class="text-nowrap"><strong>Modify Date:</strong></span><br>
                                            <span class="text-nowrap">{{ $List->updated_at }}</span>
                                        @endif
                                        <br>
                                        <span class="text-nowrap"><strong>Expired Date:</strong></span><br>
                                        <span class="text-nowrap">{{ $List->expire_at }}</span>
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
                                                            <strong>Modify Date: </strong><br>
                                                            {{ $List->updated_at }} --}}
                                    </td>
                                    @if ($List->Listing_Status == 'Expired')
                                        <td>
                                            {{-- <h6><span class="badge badge-primary">{{ $List->Listing_Status }}</span> <br>
                                                <strong>Expired Date: </strong><br>
                                                {{ $List->expire_at }}
                                                <div class="dropdown show list-actions">
                                                    <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button"
                                                        data-toggle="dropdown" aria-haspopup="true">
                                                        Actions
                                                    </a>

                                                    <div class="dropdown-menu"> --}}
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                target="_blank">View Route</a>
                                            @if ($List->user_id === $auth_user->id)
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    href="{{ route('User.ReList.Expired.Listing', ['List_ID' => $List->id]) }}"
                                                    target="_blank">Re-List</a>
                                            @endif
                                            @if ($List->user_id === $auth_user->id)
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    href="{{ route('User.Expire.Re.Edit.Listing', ['List_ID' => $List->id]) }}"
                                                    target="_blank">Re-List & Edit</a>
                                            @endif
                                            {{-- </div>
                                                </div> --}}
                                        </td>
                                    @elseif($List->Listing_Status == 'Waiting For Approval')
                                        <td>
                                            {{-- <h6><span class="badge badge-primary">Waiting</span></h6><br>
                                            <div class="dropdown show list-actions">
                                                <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true">
                                                    Actions
                                                </a>

                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                        target="_blank">View Route</a> --}}
                                            {{-- <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap "
                                                href="{{ route('User.Cancel.Request', ['List_ID' => $List->id]) }}">Cancel
                                                Request</a>
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap  compare-listing"
                                                data-toggle="modal" data-target="#CompareListing"
                                                href="javascript:void(0);">
                                                <input hidden type="text" class="Listed-ID"
                                                    value="{{ $List->id }}">
                                                <input hidden type="text" class="Listed-Type"
                                                    value="{{ $List->Listing_Type }}">
                                                <input hidden type="text" class="Listed-Miles"
                                                    value="{{ $List->routes->Miles }}">
                                                Compare Listing</a>
                                            @if ($List->user_id !== $auth_user->id)
                                                <a href="{{ route('Order.Agreement', ['List_ID' => $List->id]) }}"
                                                    target="_blank"
                                                    class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap "
                                                    role="button">View Offer</a>
                                            @endif
                                            @if ($List->user_id === $auth_user->id)
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap "
                                                    href="{{ route('User.Edit.Listing', ['List_ID' => $List->id]) }}">Edit
                                                    Listing</a>
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap "
                                                    href="{{ route('User.Listing.Archive', ['List_ID' => $List->id]) }}">Archive
                                                    Order</a>
                                            @endif --}}

                                            <a data-toggle="modal" data-target="#CancelWaitingOrderModal"
                                                href="javascript:void(0);"
                                                class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap Cancel_Waiting_Order"
                                                role="button">
                                                <input hidden type="text" class="Listed-ID"
                                                    value="{{ $List->id }}">
                                                <input hidden type="text" class="User-ID"
                                                    value="{{ $List->user_id }}">
                                                <input hidden type="text" class="CMP-ID"
                                                    value="{{ $List->waitings->waiting_users->id }}">
                                                <input hidden type="text" class="Order-Status"
                                                    value="{{ $List->Listing_Status }}">
                                                Cancel Order</a>
                                            {{-- <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    href="{{ route('chat', $List->CMP_id) }}">Message Carrier</a> --}}
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('View.Agreement', ['List_ID' => $List->id]) }}">View
                                                Details</a>
                                            <button data-email="{{ $List->waitings->waiting_users->email }}"
                                                data-list-id="{{ $List->id }}"
                                                class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap Remind-Carrier">
                                                Remind Carrier
                                            </button>
                                            {{-- <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}">View Details</a> --}}
                                            @if ($List->user_id !== $currentUser->id)
                                                <a href="{{ route('Order.Agreement', ['List_ID' => $List->id]) }}"
                                                    target="_blank"
                                                    class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    role="button">View Offer</a>
                                            @endif
                                            @if ($List->user_id === $currentUser->id)
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    href="{{ route('User.Edit.Listing', ['List_ID' => $List->id]) }}">Modify
                                                    Listing</a>
                                                {{-- <button class="btn mb-2 btn-outline-primary w-50 btn-sm text-nowrap"
                                                    href="{{ route('User.Listing.Archive', ['List_ID' => $List->all_listing->id]) }}">Archive
                                                    Order</button> --}}
                                            @endif
                                            {{-- <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    href="{{ route('User.Cancel.Request', ['List_ID' => $List->all_listing->id]) }}">Cancel Request</a> --}}
                                            {{-- <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    href="{{ route('chat', $List->CMP_id) }}">Message Carrier</a> --}}
                                            <button
                                                class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap compare-listing"
                                                data-toggle="modal" data-target="#CompareListing"
                                                href="javascript:void(0);">
                                                <input hidden type="text" class="Listed-ID"
                                                    value="{{ $List->id }}">
                                                <input hidden type="text" class="Listed-Type"
                                                    value="{{ $List->Listing_Type }}">
                                                <input hidden type="text" class="Listed-Miles"
                                                    value="{{ $List->routes->Miles }}">
                                                Compare Listing</button>

                                            {{-- </div>
                                            </div> --}}
                                        </td>
                                    @elseif($List->Listing_Status == 'Completed')
                                        <td>
                                            {{-- <h6><span class="badge badge-primary">{{ $List->Listing_Status }}</span> <br>
                                            </h6><br>
                                            <div class="dropdown show list-actions">
                                                <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true">
                                                    Actions
                                                </a>

                                                <div class="dropdown-menu">
                                                    <a class="btn btn-primary mb-2 w-100 d-block text-nowrap"
                                                        href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                        target="_blank">View Route</a> --}}
                                            <a href="{{ route('View.Agreement', ['List_ID' => $List->id]) }}"
                                                class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                target="_blank" role="button">View
                                                Detail</a>
                                            @if ($List->user_id === $auth_user->id)
                                                {{-- <a class="btn btn-primary mb-2 w-100 d-block text-nowrap" role="button"
                                                                                                    href="{{ route('View.Profile.Ratings', $List->completed->completed_user->id) }}"
                                                                                                    target="_blank">Rate
                                                                                                        Carrier</a> --}}
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap rate-order"
                                                    data-toggle="modal" data-target="#RatingOrderModal"
                                                    href="javascript:void(0);">
                                                    Rate Order
                                                    <input hidden type="text" class="New-Ref-ID"
                                                        value="{{ $List->Ref_ID }}">
                                                    <input hidden type="text" class="Listed-ID"
                                                        value="{{ $List->id }}">
                                                    {{-- only showing which are not rated yet --}}
                                                    @if ($List->Is_Rate != 1)
                                                        <input hidden type="text" class="Profile-ID"
                                                            value="{{ $List->completed->completed_user->id }}">
                                                        {{-- Rate Order --}}
                                                </a>
                                            @endif
                                    @endif
                                    {{-- </div>
                                            </div> --}}
                                    </td>
                                @elseif($List->Listing_Status == 'Delivered')
                                    <td>
                                        {{-- <h6><span class="badge badge-primary">{{ $List->Listing_Status }}</span> <br>
                                            </h6><br>
                                            <div class="dropdown show list-actions">
                                                <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button" data-toggle="dropdown"
                                                    aria-haspopup="true">
                                                    Actions
                                                </a>

                                                <div class="dropdown-menu">
                                                    <a class="btn btn-primary mb-2 w-100 d-block text-nowrap"
                                                        href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                        target="_blank">View Route</a> --}}
                                        {{-- <a href="{{ route('View.Agreement', ['List_ID' => $List->id]) }}"
                                            class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap" target="_blank"
                                            role="button">View
                                            Detail</a>
                                        <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap compare-listing"
                                            data-toggle="modal" data-target="#CompareListing" href="javascript:void(0);">
                                            <input hidden type="text" class="Listed-ID" value="{{ $List->id }}">
                                            <input hidden type="text" class="Listed-Type"
                                                value="{{ $List->Listing_Type }}">
                                            <input hidden type="text" class="Listed-Miles"
                                                value="{{ $List->routes->Miles }}">
                                            Compare Listing</a>
                                        @if ($List->user_id === $auth_user->id)
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('User.Edit.Listing', ['List_ID' => $List->id]) }}">Edit
                                                Listing</a>
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('Order.Completed', ['List_ID' => $List->id]) }}">Completed</a>
                                            {{-- <a class="btn btn-primary mb-2 w-100 d-block text-nowrap"
                                                                    href="{{ route('Order.Not.Completed', ['List_ID' => $List->id]) }}">Not
                                                                        Completed</a>
                                                                    <a class="btn btn-primary mb-2 w-100 d-block text-nowrap"
                                                                    href="{{ route('User.Listing.Archive', ['List_ID' => $List->id]) }}">Archive
                                                                        Order</a> --}}
                                        {{-- @endif --}}
                                        @if ($List->user_id === $currentUser->id)
                                            @if ($List->Is_Rate != 1)
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block rate-order"
                                                    data-toggle="modal" data-target="#RatingOrderModal"
                                                    href="javascript:void(0);">
                                                    <input hidden type="text" class="New-Ref-ID"
                                                        value="{{ $List->Ref_ID }}">
                                                    <input hidden type="text" class="Listed-ID"
                                                        value="{{ $List->id }}">
                                                    <input hidden type="text" class="Profile-ID"
                                                        value="{{ $List->deliver->delivered_user->id }}">
                                                    <input hidden type="text" class="Company-Name"
                                                        value="{{ $List->deliver->delivered_user->Company_Name }}">
                                                    Rate Order
                                                </a>
                                            @else
                                                <button type="button" class="btn btn-outline-primary mb-2 w-100 d-block"
                                                    disabled>
                                                    <span class="">Rate Order</span>
                                                </button>
                                            @endif
                                        @endif
                                        <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                            href="{{ route('User.Listing.Archive', ['List_ID' => $List->id]) }}">Archive</a>
                                        <a href="{{ route('View.Agreement', ['List_ID' => $List->id]) }}"
                                            class="btn btn-outline-primary mb-2 w-100 d-block" role="button">View
                                            Detail</a>
                                        {{-- <a href="#" class="btn btn-outline-primary mb-2 w-100 d-block" role="button">Replicate Listing (s)</a> --}}
                                        <button class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                            onclick="window.location.href='{{ route('User.Replicate.Listing', ['List_ID' => $List->id]) }}'">
                                            Replicate Listing
                                        </button>
                                        @if ($List->dispatch_bol)
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('PostPickup.Bol.Listing', ['List_ID' => $List->id]) }}">View
                                                BOL</a>
                                        @endif
                                        @if ($List->user_id !== $auth_user->id)
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap add-misc"
                                                data-toggle="modal" data-target="#AddMisc" href="javascript:void(0);">
                                                <input hidden type="text" class="Listed-ID"
                                                    value="{{ $List->id }}">Add Misc.</a>
                                        @endif
                                        {{-- </div>
                                            </div> --}}
                                    </td>
                                @elseif($List->Listing_Status == 'Listed')
                                    <td>
                                        {{-- <h6><span class="badge badge-primary">{{ $List->Listing_Status }}</span> <br><br>
                                                <a href="{{ route('User.Watchlist.store', $List->id) }}">
                                                        @if ($List->authorized_user->my_watch_check($List->id) !== null)
                                                            <i class="fa fa-heart" aria-hidden="true" title="Remove from Watch List"></i>
                                                        @else
                                                            <i class="fa-regular fa-heart" title="Add to Watch List"></i>
                                                        @endif
                                                    </a>
                                                <strong>Expired Date: </strong><br>
                                                {{ $List->expire_at }}
                                                <div class="dropdown show list-actions">
                                                    <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button" data-toggle="dropdown"
                                                        aria-haspopup="true">
                                                        Actions
                                                    </a>
                                                    <div class="dropdown-menu">
                                                            <a class="btn btn-primary mb-2 w-100 d-block text-nowrap"
                                                            href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                            target="_blank">View Route</a>
                                                            @if ($List->user_id === $currentUser->id)
                                                                <a class="btn btn-primary mb-2 w-100 d-block text-nowrap"
                                                                href="{{ route('User.Listing.Restore', ['List_ID' => $List->id]) }}">Restore
                                                                    Listing</a>
                                                            @endif
                                                        </div>
                                                    <div class="dropdown-menu">
                                                        <a class="btn btn-primary mb-2 w-100 d-block text-nowrap"
                                                            href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                            target="_blank">View Route</a> --}}
                                        <!--<div ></div>-->
                                        {{-- <a onclick="request_load_click({{ $List->id }})" id="{{ $List->id }}"
                                                                class="btn btn-primary mb-2 w-100 d-block text-nowrap request-load" data-toggle="modal" data-target="#CarrierRequestLoad"
                                                                href="javascript:void(0);">
                                                                <input hidden type="text" class="Listed-Ref-ID" value="{{ $List->Ref_ID }}">
                                                                <input hidden type="text" class="Listed-ID" value="{{ $List->id }}">
                                                                <input hidden type="text" class="Listed-Price"
                                                                    value="{{ (int) Str::replace(['$ ', ','], '', $List->paymentinfo->Price_Pay_Carrier) }}">
                                                                <input hidden type="text" class="Pickup-Date"
                                                                    value="{{ $List->pickup_delivery_info->Pickup_Date }}">
                                                                <input hidden type="text" class="Deliver-Date"
                                                                    value="{{ $List->pickup_delivery_info->Delivery_Date }}">
                                                                Bid / Request Load</a> --}}
                                        {{-- <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap compare-listing"
                                            data-toggle="modal" data-target="#CompareListing" href="javascript:void(0);">
                                            <input hidden type="text" class="Listed-ID" value="{{ $List->id }}">
                                            <input hidden type="text" class="Listed-Type"
                                                value="{{ $List->Listing_Type }}">
                                            <input hidden type="text" class="Listed-Miles"
                                                value="{{ $List->routes->Miles }}">
                                            Compare Listing</a> --}}
                                        @if ($List->user_id === $auth_user->id)
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('User.Dispatch.Listing', ['List_ID' => $List->id]) }}">Assign
                                                Carrier</a>
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('User.Edit.Listing', ['List_ID' => $List->id]) }}">Modify
                                                Listing</a>
                                            <button class="btn btn-outline-primary mb-2 w-100 d-block all-requests"
                                                data-toggle="modal" data-target="#CarrierRequests"
                                                href="javascript:void(0);">
                                                <input hidden type="text" class="Listed-ID"
                                                    value="{{ $List->id }}">
                                                View Request <span
                                                    class="badges">({{ count($List->request_broker_all) }})</span>
                                            </button>
                                            <button class="btn btn-outline-primary mb-2 w-100 d-block">
                                                View Bids
                                            </button>
                                            <button class="btn btn-outline-primary mb-2 w-100 d-block request-carrier"
                                                data-toggle="modal" data-target="#requestCarrier"
                                                href="javascript:void(0);">
                                                Carrier Outreach
                                            </button>
                                            {{-- <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('User.Listing.Archive', ['List_ID' => $List->id]) }}">Archive
                                                Order</a>
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('User.Listing.Delete', ['List_ID' => $List->id]) }}">Delete
                                                Order</a> --}}
                                        @endif

                                        {{-- </div>
                                                </div> --}}
                                    </td>
                                @elseif($List->Listing_Status == 'Dispatch')
                                    <td>
                                        {{-- <h6><span class="badge badge-primary">{{ $List->Listing_Status }}</span> <br>
                                            </h6><br>
                                            <div class="dropdown show list-actions">
                                                <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button" data-toggle="dropdown"
                                                    aria-haspopup="true">
                                                    Actions
                                                </a>

                                                <div class="dropdown-menu">
                                                    <a class="btn btn-primary mb-2 w-100 d-block text-nowrap"
                                                        href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                        target="_blank">View Route</a> --}}
                                        {{-- <a href="{{ route('View.Agreement', ['List_ID' => $List->id]) }}"
                                            class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap" target="_blank"
                                            role="button">View
                                            Detail</a>
                                        <a data-toggle="modal" data-target="#CancelOrderModal" href="javascript:void(0);"
                                            class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap Cancel_Order"
                                            role="button">
                                            <input hidden type="text" class="Listed-ID" value="{{ $List->id }}">
                                            <input hidden type="text" class="User-ID" value="{{ $List->user_id }}">
                                            <input hidden type="text" class="CMP-ID" value="{{ $List->id }}">
                                            <input hidden type="text" class="Order-Status"
                                                value="{{ $List->Listing_Status }}">
                                            Cancel Order</a>
                                        <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap compare-listing"
                                            data-toggle="modal" data-target="#CompareListing" href="javascript:void(0);">
                                            <input hidden type="text" class="Listed-ID" value="{{ $List->id }}">
                                            <input hidden type="text" class="Listed-Type"
                                                value="{{ $List->Listing_Type }}">
                                            <input hidden type="text" class="Listed-Miles"
                                                value="{{ $List->routes->Miles }}">
                                            Compare Listing</a>
                                        @if ($List->user_id !== $auth_user->id)
                                            <a href="{{ route('Order.Pickup.Approval', ['List_ID' => $List->id]) }}"
                                                class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                role="button">PickUp</a>
                                        @endif
                                        @if ($List->user_id === $auth_user->id)
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('User.Edit.Listing', ['List_ID' => $List->id]) }}">Edit
                                                Listing</a>
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('Order.Pickup.Approval', ['List_ID' => $List->id]) }}">PickUp</a>
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('Order.Not.Pickup.Approval', ['List_ID' => $List->id]) }}">Not
                                                PickUp</a> --}}
                                        {{-- <a class="btn btn-primary mb-2 w-100 d-block text-nowrap"
                                                            href="{{ route('User.Listing.Archive', ['List_ID' => $List->id]) }}">Archive
                                                                Order</a> --}}
                                        <button class="show-misc btn btn-outline-primary mb-2 w-100 d-block"
                                            data-toggle="modal" data-target="#ShowMisc" href="javascript:void(0);">
                                            <input hidden type="text" class="Listed-ID" value="{{ $List->id }}">
                                            <input hidden type="text" class="Ref-ID"
                                                value="{{ $List->Ref_ID }}">Show Misc. <span
                                                class="badges">({{ count($List->miscellenous) }})</span>
                                        </button>
                                        @if ($List->user_id === $currentUser->id)
{{--                                            <form action="{{ route('Order.Pickup', ['List_ID' => $List->id]) }}"--}}
{{--                                                method="GET" class="was-validated" enctype="multipart/form-data">--}}
{{--                                                @csrf--}}
{{--                                                <button class="btn btn-outline-primary mb-2 w-100 d-block"--}}
{{--                                                    href="{{ route('Order.Pickup', ['List_ID' => $List->id]) }}">Picked--}}
{{--                                                    Up</button>--}}
{{--                                            </form>--}}

                                            {{-- <button class="btn btn-outline-primary mb-2 w-100 d-block"
                                                                    href="{{ route('Order.Not.Pickup.Approval', ['List_ID' => $List->all_listing->id]) }}">Not PickUp</button> --}}
                                        @endif
                                        <a href="{{ route('View.Agreement', ['List_ID' => $List->id]) }}"
                                            class="btn btn-outline-primary mb-2 w-100 d-block" role="button">View
                                            Details</a>
                                        @if ($List->user_id === $currentUser->id)
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                                href="{{ route('User.Edit.Listing', ['List_ID' => $List->id]) }}">Modify
                                                Listing</a>
                                        @endif
                                        <button data-toggle="modal" data-target="#CancelOrderModal"
                                            href="javascript:void(0);"
                                            class="btn btn-outline-primary mb-2 w-100 d-block Cancel_Order"
                                            role="button">
                                            <input hidden type="text" class="Listed-ID" value="{{ $List->id }}">
                                            <input hidden type="text" class="User-ID" value="{{ $List->user_id }}">
                                            <input hidden type="text" class="CMP-ID"
                                                value="{{ $List->dispatch_listing->dispatch_user->id }}">
                                            <input hidden type="text" class="Order-Status"
                                                value="{{ $List->Listing_Status }}">
                                            Cancel Listing
                                        </button>

                                        <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap {{ isset($List->dispatch_bol->id) ? '' : 'disabled-link' }}"
                                           href="{{ isset($List->all_listing->dispatch_bol->id) ? route('User.Bol.Listing', ['List_ID' => $List->id]) : '#' }}">
                                            {{ isset($List->dispatch_bol->id) ? 'View Bol' : 'Upload Bol' }}
                                        </a>
                                        {{-- @endif --}}
                                        <input hidden type="text" class="Listed-ID" value="{{ $List->id }}">
                                        <input hidden type="text" class="Listed-Type"
                                            value="{{ $List->Listing_Type }}">
                                        <input hidden type="text" class="Listed-Miles"
                                            value="{{ $List->routes->Miles }}">
                                        {{-- </div>
                                            </div> --}}
                                    </td>
                                @elseif($List->Listing_Status == 'Deleted')
                                    <td>
                                        {{-- <h6><span class="badge badge-primary">{{ $List->Listing_Status }}</span> <br>
                                                <strong>Expired Date: </strong><br>
                                                {{ $List->expire_at }}
                                                <div class="dropdown show list-actions">
                                                    <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button" data-toggle="dropdown"
                                                        aria-haspopup="true">
                                                        Actions
                                                    </a>

                                                    <div class="dropdown-menu">
                                                        <a class="btn btn-primary mb-2 w-100 d-block text-nowrap"
                                                            href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                            target="_blank">View Route</a> --}}
                                        @if ($List->user_id === $auth_user->id)
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('User.Listing.Restore', ['List_ID' => $List->id]) }}">Restore
                                                Listing</a>
                                        @endif
                                        {{-- </div>
                                                </div> --}}
                                    </td>
                                @elseif($List->Listing_Status == 'Cancelled')
                                    <td>
                                        <h6>
                                            {{-- <span class="badge badge-primary">{{ $List->Listing_Status }}</span> <br> --}}
                                            @if ($List->deleted_at !== null)
                                                <h6>Status:
                                                    <span class="badge badge-primary">
                                                        Re Listed
                                                    </span>
                                                    <span class="badge badge-warning">
                                                        {{ !is_null($List->Ref_ID) ? $List->Ref_ID->Company_Name : '' }}
                                                    </span>
                                                </h6>
                                            @else
                                                <a href=""
                                                    class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    role="button">Rate Carrier</a>
                                                <a href="{{ route('View.Agreement', ['List_ID' => $List->id]) }}"
                                                    class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    role="button">View
                                                    Detail</a>
                                                @if ($List->user_id === $currentUser->id)
                                                    <button class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                        onclick="window.location.href='{{ route('User.Replicate.Listing', ['List_ID' => $List->id]) }}'">
                                                        Replicate Listing
                                                    </button>
                                                @endif
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap Generate-Ticket"
                                                    data-toggle="modal" data-target="#TicketModal"
                                                    href="javascript:void(0);">
                                                    <input hidden type="text" class="Listed-ID"
                                                        value="{{ $List->id }}">
                                                    <input hidden type="text" class="Ref-ID"
                                                        value="{{ $List->Ref_ID }}">
                                                    <input hidden type="text" class="User-ID"
                                                        value="{{ $List->user_id }}">
                                                    <input hidden type="text" class="User-Email"
                                                        value="{{ $List->authorized_user->email }}">
                                                    <input hidden type="text" class="User-Name"
                                                        value="{{ $List->authorized_user->Company_Name }}">
                                                    <input hidden type="text" class="CMP-ID"
                                                        value="{{ $List->cancel->cancel_user->id }}">
                                                    <input hidden type="text" class="CMP-Email"
                                                        value="{{ $List->cancel->cancel_user->email }}">
                                                    <input hidden type="text" class="CMP-Name"
                                                        value="{{ $List->cancel->cancel_user->Company_Name }}">
                                                    Generate Ticket</a>
                                                {{-- <h6><span class="badge badge-warning">{{ $List->Listing_Status }}</span>
                                                    </h6> --}}
                                                {{-- <div class="dropdown show list-actions">
                                                        <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button"
                                                            data-toggle="dropdown" aria-haspopup="true">
                                                            Actions
                                                        </a>

                                                        <div class="dropdown-menu"> --}}
                                                {{-- <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                    target="_blank">View Route</a>
                                                <a href="{{ route('View.Agreement', ['List_ID' => $List->id]) }}"
                                                    target="_blank"
                                                    class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    role="button">View Detail</a>
                                                @if ($List->user_id === $auth_user->id)
                                                    <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                        href="{{ route('User.Edit.Listing', $List->id) }}"
                                                        target="_blank">Re Listed</a>
                                                @endif
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap Generate-Ticket"
                                                    data-toggle="modal" data-target="#TicketModal"
                                                    href="javascript:void(0);">
                                                    <input hidden type="text" class="Listed-ID"
                                                        value="{{ $List->id }}">
                                                    <input hidden type="text" class="Ref-ID"
                                                        value="{{ $List->Ref_ID }}">
                                                    <input hidden type="text" class="User-ID"
                                                        value="{{ $List->user_id }}">
                                                    <input hidden type="text" class="User-Email"
                                                        value="{{ $List->authorized_user->email }}">
                                                    <input hidden type="text" class="User-Name"
                                                        value="{{ $List->authorized_user->Company_Name }}">
                                                    <input hidden type="text" class="CMP-ID" --}}
                                                {{-- value="{{ $List->Ref_ID }}"> --}}
                                                {{-- value="{{ $List->cancel->cancel_user->id }}"> --}}
                                                {{-- <input hidden type="text" class="CMP-Email"
                                                        value="{{ $List->Ref_ID }}"> --}}
                                                {{-- value="{{ $List->cancel->cancel_user->email }}"> --}}
                                                {{-- <input hidden type="text" class="CMP-Name"
                                                        value="{{ $List->Ref_ID }}"> --}}
                                                {{-- value="{{ $List->cancel->cancel_user->Company_Name }}"> --}}
                                                {{-- Generate Ticket</a> --}}
                                                {{-- </div>
                                                    </div> --}}
                                            @endif
                                    </td>
                                @elseif($List->Listing_Status == 'PickUp Approval')
                                    <td>
                                        <h6><span class="badge badge-primary">{{ $List->Listing_Status }}</span> <br>
                                        </h6><br>
                                        <div class="dropdown show list-actions">
                                            <a class="btn btn-success dropdown-toggle btn-sm" href="#"
                                                role="button" data-toggle="dropdown" aria-haspopup="true">
                                                Actions
                                            </a>

                                            <div class="dropdown-menu">
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                    target="_blank">View Route</a>
                                                <a href="{{ route('View.Agreement', ['List_ID' => $List->id]) }}"
                                                    class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    target="_blank" role="button">View Detail</a>
                                                <a data-toggle="modal" data-target="#CancelOrderModal"
                                                    href="javascript:void(0);"
                                                    class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap Cancel_Order"
                                                    role="button">
                                                    <input hidden type="text" class="Listed-ID"
                                                        value="{{ $List->id }}">
                                                    <input hidden type="text" class="User-ID"
                                                        value="{{ $List->user_id }}">
                                                    {{-- <input hidden type="text" class="CMP-ID"
                                                                                                                                                                        value="{{ $List->pickup_approve->pickup_approval_user->id }}"> --}}
                                                    <input hidden type="text" class="Order-Status"
                                                        value="{{ $List->Listing_Status }}">
                                                    Cancel Order</a>
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap compare-listing"
                                                    data-toggle="modal" data-target="#CompareListing"
                                                    href="javascript:void(0);">
                                                    <input hidden type="text" class="Listed-ID"
                                                        value="{{ $List->id }}">
                                                    <input hidden type="text" class="Listed-Type"
                                                        value="{{ $List->Listing_Type }}">
                                                    <input hidden type="text" class="Listed-Miles"
                                                        value="{{ $List->routes->Miles }}">
                                                    Compare Listing</a>
                                                @if ($List->user_id === $auth_user->id)
                                                    <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                        href="{{ route('User.Edit.Listing', ['List_ID' => $List->id]) }}">Edit
                                                        Listing</a>

                                                    <a href="{{ route('Order.Not.Pickup.Approval', ['List_ID' => $List->id]) }}"
                                                        target="_blank"
                                                        class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                        role="button">Not
                                                        Approve</a>
                                                    <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                        href="{{ route('Order.Pickup', ['List_ID' => $List->id]) }}">Pick
                                                        Up</a>
                                                    {{-- <a class="btn btn-primary mb-2 w-100 d-block text-nowrap"
                                                                                                                                                                        href="{{ route('User.Listing.Archive', ['List_ID' => $List->id]) }}">Archive
                                                                                                                                                                        Order</a> --}}
                                                    <button class="btn get-history" data-toggle="modal"
                                                        data-target="#showModal">
                                                        <i class="ri-mail-line align-bottom me-2 text-muted"></i>
                                                        Authorization Form
                                                        <input type="hidden" class="user_email" name="user_email"
                                                            value=""></button>
                                                @endif
                                                @if ($List->user_id !== $auth_user->id)
                                                    <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap add-misc"
                                                        data-toggle="modal" data-target="#AddMisc"
                                                        href="javascript:void(0);">
                                                        <input hidden type="text" class="Listed-ID"
                                                            value="{{ $List->id }}">Add Misc.</a>
                                                    <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap attach-bill"
                                                        data-toggle="modal" data-target="#AttachBill"
                                                        href="javascript:void(0);">
                                                        <input hidden type="text" class="Listed-ID"
                                                            value="{{ $List->id }}">Pickup</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                @elseif($List->Listing_Status == 'PickUp')
                                    <td>
                                        {{-- <h6><span class="badge badge-primary">{{ $List->Listing_Status }}</span> <br>
                                            </h6><br>
                                            <div class="dropdown show list-actions">
                                                <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button" data-toggle="dropdown"
                                                    aria-haspopup="true">
                                                    Actions
                                                </a>

                                                <div class="dropdown-menu">
                                                    <a class="btn btn-primary mb-2 w-100 d-block text-nowrap"
                                                        href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                        target="_blank">View Route</a> --}}
                                        {{-- <a href="{{ route('View.Agreement', ['List_ID' => $List->id]) }}"
                                            class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap" target="_blank"
                                            role="button">View
                                            Detail</a>
                                        <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap compare-listing"
                                            data-toggle="modal" data-target="#CompareListing" href="javascript:void(0);">
                                            <input hidden type="text" class="Listed-ID" value="{{ $List->id }}">
                                            <input hidden type="text" class="Listed-Type"
                                                value="{{ $List->Listing_Type }}">
                                            <input hidden type="text" class="Listed-Miles"
                                                value="{{ $List->routes->Miles }}">
                                            Compare Listing</a>
                                        @if ($List->user_id === $auth_user->id)
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('User.Edit.Listing', ['List_ID' => $List->id]) }}">Edit
                                                Listing</a>
                                            <a class="btn btn-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('Order.Deliverd.Approval', ['List_ID' => $List->id]) }}">Delivered</a>
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('Order.Deliverd', ['List_ID' => $List->id]) }}">Delivered</a>
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('Order.Not.Deliverd.Approval', ['List_ID' => $List->id]) }}">Not
                                                Delivered</a>
                                            <a class="btn btn-primary mb-2 w-100 d-block text-nowrap"
                                                                href="{{ route('User.Listing.Archive', ['List_ID' => $List->id]) }}">Archive
                                                                    Order</a>
                                        @endif
                                        @if ($List->user_id !== $auth_user->id)
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap add-misc"
                                                data-toggle="modal" data-target="#AddMisc" href="javascript:void(0);">
                                                <input hidden type="text" class="Listed-ID"
                                                    value="{{ $List->id }}">Add Misc.</a>
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap attach-bill"
                                                data-toggle="modal" data-target="#AttachBill" href="javascript:void(0);">
                                                <input hidden type="text" class="Listed-ID"
                                                    value="{{ $List->id }}">Deliver</a>
                                        @endif --}}

                                        @if ($List->user_id === $currentUser->id)
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('User.Edit.Listing', ['List_ID' => $List->id]) }}">Modify
                                                Listing</a>
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('Order.Deliverd', ['List_ID' => $List->id]) }}">Mark
                                                as Delivered</a>
                                            {{-- <a href="{{ route('Order.Not.Pickup.Approval', ['List_ID' => $List->all_listing->id]) }}"
                                            class="btn btn-primary mb-2 w-100 d-block text-nowrap"
                                            role="button">Not Approve</a> --}}
                                        @endif
                                        <a href="{{ route('View.Agreement', ['List_ID' => $List->id]) }}"
                                            class="btn btn-outline-primary  mb-2 w-100 d-block text-nowrap"
                                            role="button">View
                                            Details</a>
                                        <button class="show-misc btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                            data-toggle="modal" data-target="#ShowMisc" href="javascript:void(0);">
                                            <input hidden type="text" class="Listed-ID" value="{{ $List->id }}">
                                            <input hidden type="text" class="Ref-ID"
                                                value="{{ $List->Ref_ID }}">Show Misc. <span
                                                class="badges">({{ count($List->miscellenous) }})</span></button>
                                        @if ($List->user_id !== $currentUser->id)
                                            {{-- <a class="btn btn-primary mb-2 w-100 d-block text-nowrap add-misc"
                                            data-toggle="modal" data-target="#AddMisc"
                                            href="javascript:void(0);">
                                            <input hidden type="text" class="Listed-ID"
                                                value="{{ $List->all_listing->id }}">Add Misc.</a> --}}
                                            {{-- <a class="btn btn-primary mb-2 w-100 d-block text-nowrap attach-bill"
                                            data-toggle="modal" data-target="#AttachBill"
                                            href="javascript:void(0);">
                                            <input hidden type="text" class="Listed-ID"
                                                value="{{ $List->all_listing->id }}">Deliver</a> --}}
                                        @endif
                                        {{-- <a class="btn btn-primary mb-2 w-100 d-block text-nowrap" href="#">View
                                        BOL(s)</a> --}}
                                        <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap {{ isset($List->dispatch_bol->id) ? '' : 'disabled-link' }}"
                                           href="{{ isset($List->dispatch_bol->id) ? route('PostPickup.Bol.Listing', ['List_ID' => $List->id]) : '#' }}">
                                            View BOL
                                        </a>

                                        {{-- </div>
                                            </div> --}}
                                    </td>
                                @elseif($List->Listing_Status == 'Archived')
                                    <td>
                                        {{-- <h6><span class="badge badge-primary">{{ $List->Listing_Status }}</span> <br>
                                                <strong>Expired Date: </strong><br>
                                                {{ $List->expire_at }}
                                                <div class="dropdown show list-actions">
                                                    <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button" data-toggle="dropdown"
                                                        aria-haspopup="true">
                                                        Actions
                                                    </a>

                                                    <div class="dropdown-menu">
                                                        <a class="btn btn-primary mb-2 w-100 d-block text-nowrap"
                                                            href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                            target="_blank">View Route</a> --}}
                                        @if ($List->user_id === $currentUser->id)
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                                href="{{ route('User.Listing.Delete', ['List_ID' => $List->id]) }}">Delete
                                                Listing</a>
                                        @endif
                                        @if ($List->user_id === $currentUser->id)
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                                href="{{ route('User.Edit.Listing', ['List_ID' => $List->id]) }}">Modify
                                                Listing</a>
                                        @endif
                                        @if ($List->user_id === $currentUser->id)
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                                href="{{ route('User.Listing.Restore', ['List_ID' => $List->id]) }}"
                                                role="button">Restore
                                                Listing</a>
                                        @endif
                                        {{-- </div>
                                                </div> --}}
                                    </td>
                                @elseif($List->Listing_Status == 'Deliver Approval')
                                    <td>
                                        <h6><span class="badge badge-primary">{{ $List->Listing_Status }}</span> <br>
                                        </h6><br>
                                        <div class="dropdown show list-actions">
                                            <a class="btn btn-success dropdown-toggle btn-sm" href="#"
                                                role="button" data-toggle="dropdown" aria-haspopup="true">
                                                Actions
                                            </a>

                                            <div class="dropdown-menu">
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                    target="_blank">View Route</a>
                                                <a href="{{ route('View.Agreement', ['List_ID' => $List->id]) }}"
                                                    class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                    target="_blank" role="button">View Detail</a>
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap compare-listing"
                                                    data-toggle="modal" data-target="#CompareListing"
                                                    href="javascript:void(0);">
                                                    <input hidden type="text" class="Listed-ID"
                                                        value="{{ $List->id }}">
                                                    <input hidden type="text" class="Listed-Type"
                                                        value="{{ $List->Listing_Type }}">
                                                    <input hidden type="text" class="Listed-Miles"
                                                        value="{{ $List->routes->Miles }}">
                                                    Compare Listing</a>
                                                @if ($List->user_id === $auth_user->id)
                                                    <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                        href="{{ route('User.Edit.Listing', ['List_ID' => $List->id]) }}">Edit
                                                        Listing</a>
                                                    <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                        href="{{ route('Order.Deliverd', ['List_ID' => $List->id]) }}">Delivered</a>
                                                    <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                        href="{{ route('Order.Not.Deliverd', ['List_ID' => $List->id]) }}">Not
                                                        Delivered</a>
                                                    {{-- <a class="btn btn-primary mb-2 w-100 d-block text-nowrap"
                                                                                                                                                                        href="{{ route('User.Listing.Archive', ['List_ID' => $List->id]) }}">Archive
                                                                                                                                                                        Order</a> --}}
                                                    <button class="btn get-history" data-toggle="modal"
                                                        data-target="#showModal">
                                                        <i class="ri-mail-line align-bottom me-2 text-muted"></i>
                                                        Authorization Form
                                                        <input type="hidden" class="user_email" name="user_email"
                                                            value=""></button>
                                                @endif
                                                @if ($List->user_id !== $auth_user->id)
                                                    <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap add-misc"
                                                        data-toggle="modal" data-target="#AddMisc"
                                                        href="javascript:void(0);">
                                                        <input hidden type="text" class="Listed-ID"
                                                            value="{{ $List->id }}">Add Misc.</a>
                                                    <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap attach-bill"
                                                        data-toggle="modal" data-target="#AttachBill"
                                                        href="javascript:void(0);">
                                                        <input hidden type="text" class="Listed-ID"
                                                            value="{{ $List->id }}">Delivered</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                            @endif
                            </tr>
            @endforeach
            </tbody>
            </table>
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
                                    <input type="date" class="form-control deliver-date"
                                        placeholder="Delivery Date" name="Delivery_Date" required>
                                    <div class="invalid-feedback">
                                        Entered Delivery Date.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="acknoledgement" required>
                                    <label class="form-check-label" for="acknoledgement">I acknowledge and agree that
                                        once
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
    <script>
        // $('.advance-6').DataTable({
        //     "deferRender": true,
        // });
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

        $(".request-carrier").click(function() {
            var getListedID = $(this).find('.Listed-ID').val();
            $(".get_Order_ID").html(getListedID);
            $(".get_Listed_ID").val(getListedID);
        });
        // Offer Amount
        $('.offer-price').hide();
        $('#offer_Check').change(function() {
            checkBox = document.getElementById('offer_Check');
            if (checkBox.checked) {
                $('.offer-price').show();
                $(".offer-price input").prop('required', true);
            } else {
                $('.offer-price').hide();
                $(".offer-price input").prop('required', false);
            }
        });
        $("#Search_vehicleType").on("change", function() {
            console.log($(this).val());
            $('#Search_vehicleType_form').submit();
        });

        function request_load_click(value) {
            const getListedRefID = $(`#${value}`).find('.Listed-Ref-ID').val();
            const getListedID = $(`#${value}`).find('.Listed-ID').val();
            const getListedPrice = $(`#${value}`).find('.Listed-Price').val();
            const getPickupDate = $(`#${value}`).find('.Pickup-Date').val();
            const getDeliverDate = $(`#${value}`).find('.Deliver-Date').val();
            $(".get_Order_ID").html(getListedRefID);
            console.log(getListedRefID);
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
        $(".close").click(function() {
            $("#request_load_clear").trigger("reset");
            console.log('close')

            document.getElementById('modalbody').style.display = 'none'
            document.getElementById('requested').style.display = 'block'
        });

        $('.all-requests').on('click', function() {
            const getListedID = $(this).find('.Listed-ID').val();
            $(".get_Order_ID").html(getListedID);
            $(".get_Listed_ID").val(getListedID);

            $.ajax({
                url: '{{ route('Get.All.Carrier.Request') }}',
                type: 'GET',
                data: {
                    'Listed_ID': getListedID
                },
                success: function(data) {
                    $('#all-fetch-requests').html(data);
                },
                error: function(data) {
                    console.log(data);
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
            } else {
                $('.bidoffer').html(`
                <input type="text" class="form-control" placeholder="Enter Your Bid Price" id="bid"
                value="" name="Offer_Price" required>
            `)
                $('.offer-price').show();
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

        function updateSummary() {
            var searchCriteriaText = $('#search_criteria option:selected').text();
            var searchQuery = $('#search_query').val();
            var vehicleTypeText = $('#Search_vehicleType option:selected').text();
            var timeFrameText = $('#Time_Frame option:selected').text();

            if (vehicleTypeText == 'EveryThing') {
                vehicleTypeText = 'All';
            }

            var html = `
            <p><strong>${searchCriteriaText}:</strong> ${searchQuery} | <strong>Vehicle Type:</strong> ${vehicleTypeText} | <strong>Time Frame:</strong> ${timeFrameText}</p>
        `;

            $('#show-summary').html(html);
        }

        updateSummary();

        $('#search_criteria, #search_query, #Search_vehicleType, #Time_Frame').on('change keyup', function() {
            updateSummary();
        });
    </script>
@endsection
