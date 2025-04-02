@section('Requested', 'mm-active')
<!-- Breadcrumb Area -->
@php
    use Illuminate\Support\Facades\Auth;
    $currentUser = Auth::guard('Authorized')->user();
@endphp
@php
    use Illuminate\Support\Str;
@endphp
<style>
    .commentdiv {
        position: absolute;
        right: -12%;
        top: 64%;
        max-width: 304px;
        z-index: 1;
        padding: 23px 8px;
        border-radius: 7px;
        background-color: #f9ecef;
        color: #e1000a;
        display: flex;
        justify-content: center;
        display: none;
        opacity: 0;
        transition: .7s;
    }

    .commentdiv:before {
        content: '';
        width: 20px;
        height: 20px;
        position: absolute;
        top: -8px;
        background: #f9ecef;
        z-index: 1;
        transform: rotate(45deg);
        margin-left: -9px;
    }

    .relativetd {
        position: relative;
    }

    .relativetd:hover .commentdiv {
        display: block;
        opacity: 1;
    }
</style>
<div class="breadcrumb-area">
    <h1>{{ $currentUser->usr_type }} Listing</h1>
    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>
        <li class="item">Requested</li>
    </ol>
</div>
<!-- End Breadcrumb Area -->
@include('partials.global-search')
<div class="card">
    <div class="card-body">
        @if ($currentUser->usr_type === 'Carrier')
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
                <table class="display dataTable advance-6 text-center table-1 table-bordered table-cards">
                    <thead class="table-header">
                        <tr>
                            <th>ID</th>
                            <th>Company Details</th>
                            <th>Routes</th>
                            <th>Load Details</th>
                            <th>Payment</th>
                            <th>Dates</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Lisiting as $List)
                            <tr class="card-row" data-status="active">
                                <td>
                                    <span class="badge badge-pill badge-primary">Requested</span><br>
                                    {{-- <span class="badge badge-pill badge-primary">{{ $List->status }}</span> <br> --}}
                                    {{-- <strong>Ref-ID:</strong> --}}
                                    <span
                                        style="font-size: x-large; "><strong>{{ $List->all_listing->Ref_ID }}</strong></span><br>
                                    @if (count($List->all_listing->attachments) > 0)
                                        <span class="text-nowrap"><strong><a
                                                    href="{{ route('Order.Attachments', ['List_ID' => $List->all_listing->id]) }}"
                                                    target="_blank">View Images</a></strong></span><br>
                                    @endif
                                    {{-- {{ $List->all_listing->routes->Miles }} miles |
                                    ${{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}
                                    /miles --}}
                                </td>
                                <td>
                                    <strong>

                                        @php
                                            $companyName = $List->all_listing->authorized_user->Company_Name;
                                            $trimmedCompanyName = Str::words($companyName, 3, '...'); 
                                        @endphp

                                        <span style="font-size: x-large;">
                                            <a class="fs-3 text-nowrap locations-color"
                                                href="{{ route('View.Profile', $List->all_listing->authorized_user->id) }}"
                                                target="_blank" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ $companyName }}">
                                                {{ $trimmedCompanyName }}
                                            </a>
                                        </span><br>
                                        {{-- <span style="font-size: x-large; "><a class="fs-3 text-nowrap locations-color"
                                                href="{{ route('View.Profile', $List->all_listing->authorized_user->id) }}"
                                                target="_blank">{{ $List->all_listing->authorized_user->Company_Name }}</a>
                                        </span><br> --}}
                                        <span>
                                            Contact:
                                            <a class="locations-color"
                                                href="tel:{{ $List->all_listing->authorized_user->Contact_Phone }}">
                                                {{ $List->all_listing->authorized_user->Contact_Phone }}
                                            </a>
                                        </span>
                                        <br>
                                        <span class="text-nowrap">Email:<a class="locations-color"
                                                href="mailto:{{ $List->all_listing->authorized_user->email }}">
                                                {{ $List->all_listing->authorized_user->email }}
                                            </a></span><br>
                                        Time:{{ $List->all_listing->authorized_user->Hours_Operations }}<br>
                                        {{-- Timezone:{{ $List->all_listing->authorized_user->Time_Zone }}<br> --}}
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

                                            $userRatings = getUserRating($List->all_listing->authorized_user->id);
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
                                            onclick="window.open('{{ route('chat', $List->user_id) }}', '_blank')">
                                            Message Broker
                                        </span>
                                </td>
                                <td>
                                    <strong style="font-size: large;">Pickup:</strong><br>
                                    <a href="https://www.google.com/maps/place/{{ urlencode($List->all_listing->routes->Origin_ZipCode) }}"
                                        class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                        target="_blank">
                                        {{-- <i class="fas fa-map-marker-alt text-success fs-30"></i> --}}
                                        {{ Str::replace(',', '-', $List->all_listing->routes->Origin_ZipCode) }}
                                    </a><br>
                                    <strong style="font-size: large;">Delivery:</strong><br>
                                    <a href="https://www.google.com/maps/place/{{ urlencode($List->all_listing->routes->Dest_ZipCode) }}"
                                        class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                        target="_blank">
                                        {{-- <i class="fas fa-map-marker-alt text-danger fs-30"></i> --}}
                                        {{ Str::replace(',', '-', $List->all_listing->routes->Dest_ZipCode) }}
                                    </a>
                                    <div class="mb-2">
                                        <span class="fs-5"><strong>
                                                <a class="btn btn-outline-primary text-decoration-none fw-bold"
                                                    href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                    target="_blank">View Route</a>
                                            </strong></span>
                                    </div>
                                </td>
                                <td>
                                    @if (!is_null($List->all_listing->vehicles) && count($List->all_listing->vehicles) === 1)
                                        @foreach ($List->all_listing->vehicles as $vehcile)
                                            <span style="font-size: large;">
                                                <a class="font-weight-bold text-dark"
                                                    href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                    target="_blank">
                                                    <strong>{{ $vehcile->Vehcile_Year }} {{ $vehcile->Vehcile_Make }}
                                                        {{ $vehcile->Vehcile_Model }}
                                                        ({{ $vehcile->Vehcile_Type }})
                                                    </strong>
                                                </a>
                                            </span><br>
                                            @if (!empty($vehcile->Vehcile_Condition))
                                                <span
                                                    class="badge badge-pill mt-2 
                                                    @if ($vehcile->Vehcile_Condition == 'Running') badge-success 
                                                    @elseif($vehcile->Vehcile_Condition == 'Not Running') badge-danger 
                                                    @else badge-primary @endif"
                                                    style="font-size: 16px;">
                                                    {{ $vehcile->Vehcile_Condition }}
                                                </span>
                                            @endif
                                            @if (!empty($vehcile->Trailer_Type))
                                                <span class="badge badge-pill mt-2 badge-primary font-weight-bold"
                                                    style="font-size: 16px;">
                                                    {{ $vehcile->Trailer_Type }}
                                                </span>
                                            @endif
                                        @endforeach
                                    @endif
                                    @if (!is_null($List->all_listing->vehicles) && count($List->all_listing->vehicles) > 1)
                                        <div class="dropdown">
                                            <a href="javascript:void(0)"
                                                class="dropdown-toggle font-weight-bold d-inline-flex align-items-center text-dark text-decoration-none"
                                                data-toggle="dropdown" style="font-size: 21px; cursor: pointer;">
                                                Vehicles({{ count($List->all_listing->vehicles) }})
                                            </a>
                                            <div class="dropdown-menu text-center"
                                                style="max-height: 200px; overflow-y: auto;">
                                                <h6 class="dropdown-header" style="background-color: lightgrey;">
                                                    Attached Vehicles</h6>
                                                @foreach ($List->all_listing->vehicles as $vehcile)
                                                    <a class="dropdown-item" style="color: #0d6efd; font-weight: 800;"
                                                        href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                        target="_blank">
                                                        {{ $vehcile->Vehcile_Year }} {{ $vehcile->Vehcile_Make }}
                                                        {{ $vehcile->Vehcile_Model }}<br>
                                                        @if (!empty($vehcile->Vehcile_Condition))
                                                            <span
                                                                class="badge badge-pill mt-2 
                                                                @if ($vehcile->Vehcile_Condition == 'Running') badge-success 
                                                                @elseif($vehcile->Vehcile_Condition == 'Not Running') badge-danger 
                                                                @else badge-primary @endif"
                                                                style="font-size: 16px;">
                                                                {{ $vehcile->Vehcile_Condition }}
                                                            </span>
                                                        @endif
                                                        @if (!empty($vehcile->Trailer_Type))
                                                            <span
                                                                class="badge badge-pill mt-2 badge-primary font-weight-bold"
                                                                style="font-size: 16px;">
                                                                {{ $vehcile->Trailer_Type }}
                                                            </span>
                                                        @endif
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    {{-- @if (count($List->all_listing->vehicles) === 1)
                                        @foreach ($List->all_listing->vehicles as $vehcile)
                                            <span style="font-size: large; "><a class="font-weight-bold text-dark"
                                                    href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                    target="_blank"><strong>{{ $vehcile->Vehcile_Year }}
                                                        {{ $vehcile->Vehcile_Make }}
                                                        {{ $vehcile->Vehcile_Model }}({{ $vehicle->Vehcile_Type }})</strong></a>
                                            </span><br>
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
                                    @if (count($List->all_listing->vehicles) > 1)
                                        <div class="dropdown">
                                            <a href="javascript:void(0)" class="dropdown-toggle font-weight-bold d-inline-flex align-items-center text-dark text-decoration-none"
                                                data-toggle="dropdown" 
                                                style="font-size: 21px; cursor: pointer;">Vehicles({{ count($List->vehicles) }})
                                            </a>
                                            <div class="dropdown-menu text-center" style="max-height: 200px; overflow-y: auto;">
                                                <h6 class="dropdown-header" style="background-color: lightgrey;">
                                                    Attached Vehicles</h6>
                                                @foreach ($List->all_listing->vehicles as $vehcile)
                                                    <a class="dropdown-item" style="color: #0d6efd; font-weight: 800;"
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
                                                            <span class="badge badge-pill mt-2 badge-primary font-weight-bold"
                                                                style="font-size: 16px;">{{ $vehicle->Trailer_Type }}</span>
                                                        @endif
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif --}}
                                    @if (count($List->all_listing->heavy_equipments) === 2)
                                        @foreach ($List->all_listing->heavy_equipments as $vehcile)
                                            {{-- <p class="ymm"> {{ $vehcile->Equipment_Year }}
                                        {{ $vehcile->Equipment_Make }}
                                        {{ $vehcile->Equipment_Model }} </p> <br> --}}

                                            <a style="color: mediumvioletred; font-weight: 800;"
                                                href="https://www.google.com/search?q={{ $vehcile->Equipment_Year }}%20{{ $vehcile->Equipment_Make }}%20{{ $vehcile->Equipment_Model }}"
                                                target="_blank"> {{ $vehcile->Equipment_Year }}
                                                {{ $vehcile->Equipment_Make }}
                                                {{ $vehcile->Equipment_Model }}</a><br>

                                            @if (!empty($vehcile->Equipment_Condition))
                                                <span> {{ $vehcile->Equipment_Condition }}</span><br>
                                            @endif
                                            @if (!empty($vehcile->Trailer_Type))
                                                <span>{{ $vehcile->Trailer_Type }}</span> <br>
                                            @endif
                                        @endforeach
                                    @endif
                                    @if (count($List->all_listing->heavy_equipments) > 2)
                                        <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                            data-trigger="focus" style="cursor: pointer;" title="Attached vehicles"
                                            data-content=
                                        "@foreach ($List->all_listing->heavy_equipments as $vehcile)
                                        {{ $vehcile->Equipment_Year }}
                                        {{ $vehcile->Equipment_Make }}
                                        {{ $vehcile->Equipment_Model }}<br>
                                        @if (!empty($vehcile->Equipment_Condition))
                                            {{ $vehcile->Equipment_Condition }}<br>
                                        @endif
                                        @if (!empty($vehcile->Trailer_Type))
                                            {{ $vehcile->Trailer_Type }} <br>
                                        @endif @endforeach"
                                            data-html="true">vehicles ({{ count($List->heavy_equipments) }}
                                            )
                                        </a>
                                    @endif
                                    @if (count($List->all_listing->dry_vans) === 1)
                                        @foreach ($List->all_listing->dry_vans as $vehcile)
                                            {{ $vehcile->Freight_Class }}
                                            {{ $vehcile->Freight_Weight }}<br>
                                            @if ($vehcile->is_hazmat_Check !== 0)
                                                Hazmat Required<br>
                                            @endif
                                        @endforeach
                                    @endif
                                    @if (count($List->all_listing->dry_vans) > 1)
                                        <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                            data-trigger="focus" style="cursor: pointer;" title="Attached vehicles"
                                            data-content=
                                        "@foreach ($List->all_listing->dry_vans as $vehcile)
                                        {{ $vehcile->Freight_Class }}
                                        {{ $vehcile->Freight_Weight }}<br>
                                        @if ($vehcile->is_hazmat_Check !== 0)
                                            Hazmat Required<br>
                                        @endif @endforeach"
                                            data-html="true">vehicles
                                            ({{ count($List->all_listing->dry_vans) }})
                                        </a>
                                    @endif
                                    <br>
                                    {{-- <div class="dropdown">
                                        <a href="javascript:void(0)" tabindex="0"
                                            class="btn btn-link dropdown-toggle" id="additionalTermsDropdown"
                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            {{ !empty($List->additional_info->Additional_Terms)
                                                ? Str::limit($List->additional_info->Additional_Terms, 20)
                                                : '...' }}
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="additionalTermsDropdown">
                                            <p class="dropdown-item">
                                                {{ !empty($List->additional_info->Additional_Terms)
                                                    ? $List->additional_info->Additional_Terms
                                                    : 'No additional terms available' }}
                                            </p>
                                        </div>
                                    </div> --}}
                                    <div class="dropdown mt-3">
                                        <a href="javascript:void(0)" tabindex="0"
                                            class="btn btn-outline-primary dropdown-toggle text-truncate"
                                            id="additionalTermsDropdown" role="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false" style="max-width: 200px;">
                                            {{ $List->all_listing->additional_info->Additional_Terms }}Additional
                                            Terms
                                        </a>
                                        <div class="dropdown-menu p-3 shadow-sm"
                                            aria-labelledby="additionalTermsDropdown" style="max-width: 300px;">
                                            <p class="dropdown-item-text m-0 text-wrap">
                                                {{ !empty($List->all_listing->additional_info->Additional_Terms)
                                                    ? $List->all_listing->additional_info->Additional_Terms
                                                    : 'No additional terms available.' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if ($List->all_listing->paymentinfo->Price_Pay_Carrier === '0')
                                        <strong>
                                            Job Price:
                                        </strong>
                                    @else
                                        <strong>Job Price:</strong><span>
                                            ${{ $List->all_listing->paymentinfo->Price_Pay_Carrier }}
                                        </span> <br>
                                    @endif

                                    @if ($List->all_listing->paymentinfo->COD_Amount === '0')
                                        {{-- <strong>
                                                 Pay On Pickup:
                                             </strong>
                                             <br />
                                             <strong>
                                                 Pay On Delivery:
                                             </strong> --}}
                                    @else
                                        <strong>
                                            @if ($List->all_listing->paymentinfo->COD_Location_Amount == 'PickUp')
                                                Pay on Pickup:
                                            @else
                                                Pay on Delivery:
                                            @endif
                                        </strong>

                                        <span>${{ $List->all_listing->paymentinfo->COD_Amount }}</span>
                                        <br />
                                    @endif
                                    {{-- <span class="text-nowrap">
                                        <strong>Price to Pay:</strong>
                                        ${{ $List->all_listing->paymentinfo->Price_Pay_Carrier }}</span>
                                    <br> --}}
                                    <span class="text-nowrap"><strong>Pay Mode: </strong>
                                        {{ !empty($List->all_listing->paymentinfo->COD_Method_Mode) ? $List->all_listing->paymentinfo->COD_Method_Mode : '-' }}
                                        {{-- On
                                        {{ !empty($List->all_listing->paymentinfo->COD_Location_Amount) ? $List->all_listing->paymentinfo->COD_Location_Amount : '' }} --}}
                                    </span><br>
                                    @if (!empty($List->Offer_Price) && $List->Offer_Price !== 0)
                                        <span class="text-danger fs-5 text-nowrap">
                                            <strong>
                                                Bid Price: ${{ $List->Offer_Price }}
                                            </strong>
                                        </span><br>
                                    @endif
                                    {{-- <br /> --}}
                                    <strong>Mile: </strong>{{ $List->all_listing->routes->Miles }}miles<br>

                                    <strong>Price per Mile:
                                    </strong>${{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}/miles
                                    {{-- {{ $List->all_listing->routes->Miles }}miles <br>
                                    ${{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}/miles --}}
                                </td>
                                <td>
                                    <strong>Prefered Pickup:</strong><br>
                                    <span class="text-nowrap">{{ \Carbon\Carbon::parse($List->Pickup_Date)->format('d M, Y') }}
                                        ({{ $List->Date_Pickup_Mode }})</span>
                                    <br>
                                    <strong>Prefered Delivery:</strong><br><span class="text-nowrap">
                                        {{ \Carbon\Carbon::parse($List->Delivery_Date)->format('d M, Y') }}
                                        ({{ $List->Date_Delivery_Mode }})</span><br>
                                    <strong>Requested Date:</strong><br><span class="text-nowrap">
                                        {{ \Carbon\Carbon::parse($List->created_at)->format('d M, Y') }}</span>
                                    {{-- <strong>Created At:</strong><br>
                                        <span class=" text-nowrap">{{ $List->created_at }}</span><br>
                                        <strong>Modified At:</strong><br>
                                        <span class=" text-nowrap">{{ $List->updated_at }}</span>  --}}
                                </td>
                                <td>
                                    <a class="btn btn-outline-primary mb-2 w-100 d-block compare-listing text-nowrap notify-btn"
                                        data-id="{{ $List->all_listing->id }}">Notify Broker</a>
                                    {{-- <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap">View Request
                                        S</a> --}}
                                    <a onclick="carrier_request_load_click(this, {{ $List->id }})"
                                        id="{{ $List->id }}"
                                        class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap request-load {{ $List->id }}"
                                        data-toggle="modal" data-target="#CarrierViewRequestLoad"
                                        href="javascript:void(0);">
                                        <input hidden type="text" class="Listed-Ref-ID"
                                            value="{{ $List->all_listing->Ref_ID }}">
                                        <input hidden type="text" class="Listed-ID"
                                            value="{{ $List->all_listing->id }}">
                                        <input hidden type="text" class="modalFunc" value="view">
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
                                        View Request
                                    </a>
                                    <a onclick="carrier_request_load_click(this, {{ $List->id }})" id=""
                                        class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap request-load {{ $List->id }}"
                                        data-toggle="modal" data-target="#CarrierViewRequestLoad"
                                        href="javascript:void(0);">
                                        <input hidden type="text" class="Listed-Ref-ID"
                                            value="{{ $List->all_listing->Ref_ID }}">
                                        <input hidden type="text" class="Listed-ID"
                                            value="{{ $List->all_listing->id }}">
                                        <input hidden type="text" class="modalFunc" value="edit">
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
                                        Modify Request
                                    </a>
                                    <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap">Withdraw
                                        Request S</a>
                                    {{-- <button class="btn btn-outline-primary mb-2 w-100 d-block compare-listing text-nowrap"
                                        data-toggle="modal" data-target="#CompareListing" href="javascript:void(0);">
                                        <input hidden type="text" class="Listed-ID"
                                            value="{{ $List->all_listing->id }}">
                                        <input hidden type="text" class="Listed-Type"
                                            value="{{ $List->all_listing->Listing_Type }}">
                                        <input hidden type="text" class="Listed-Miles"
                                            value="{{ $List->all_listing->routes->Miles }}">
                                        Compare Listing</button> --}}
                                    @if ($List->all_listing->user_id === $currentUser->id)
                                        <button class="btn btn-outline-primary mb-2 w-100 d-block"
                                            href="{{ route('User.Dispatch.Listing', ['List_ID' => $List->all_listing->id]) }}">Assign
                                            Listing</button>
                                        <button class="btn btn-outline-primary mb-2 w-100 d-block"
                                            href="{{ route('Requested.Listing.Canceled', ['List_ID' => $List->id]) }}">Withdraw
                                            Request</button>
                                        {{-- <a class="dropdown-item"
                                                href="{{ route('Requested.Listing.Canceled', ['List_ID' => $List->all_listing->id]) }}">Cancel
                                                Request</a> --}}
                                    @endif
                                    {{-- <h6>Status: <span class="badge badge-warning">{{ $List->status }}</span></h6>
                                    <br> --}}
                                    {{-- <div class="dropdown show list-actions">
                                        <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true">
                                            Actions
                                        </a>

                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                            href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                            target="_blank">View Route</a>
                                            <a class="dropdown-item compare-listing" data-toggle="modal"
                                            data-target="#CompareListing" href="javascript:void(0);">
                                                <input hidden type="text" class="Listed-ID"
                                                    value="{{ $List->all_listing->id }}">
                                                <input hidden type="text" class="Listed-Type"
                                                    value="{{ $List->all_listing->Listing_Type }}">
                                                <input hidden type="text" class="Listed-Miles"
                                                    value="{{ $List->all_listing->routes->Miles }}">
                                                Compare Listing</a>
                                            @if ($List->all_listing->user_id === $currentUser->id)
                                                <a class="dropdown-item"
                                                href="{{ route('User.Dispatch.Listing', ['List_ID' => $List->all_listing->id]) }}">Assign
                                                    Listing</a>
                                                <a class="dropdown-item"
                                                        href="{{ route('Requested.Listing.Canceled', ['List_ID' => $List->id]) }}">Cancel
                                                        Request</a>
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
                <table class="display dataTable advance-6 text-center table-1 table-bordered table-cards">
                    <thead class="table-header">
                        <tr>
                            <th>ID</th>
                            <th>Company Info</th>
                            <th>Routes</th>
                            <th>Load Details</th>
                            <th>Payment</th>
                            <th>Dates</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Lisiting as $List)
                            <tr class="card-row" data-status="active">
                                <td>
                                    <span class="badge badge-pill badge-primary">Requested</span><br>
                                    {{-- <strong>Ref-ID:</strong> --}}
                                    <span
                                        style="font-size: x-large; "><strong>{{ $List->all_listing->Ref_ID }}</strong></span><br>
                                    {{-- <strong>Mile: </strong>  {{ $List->all_listing->routes->Miles }} miles <br>
                                    <strong>Price per Mile:</strong>  ${{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}
                                    /miles
                                    <br> --}}
                                    @if (count($List->all_listing->attachments) > 0)
                                        <strong>
                                            <a href="{{ route('Order.Attachments', ['List_ID' => $List->all_listing->id]) }}"
                                                target="_blank">View Images</a>
                                        </strong><br>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $companyName = $List->requested_user->Company_Name;
                                        $trimmedCompanyName = Str::words($companyName, 3, '...'); // 4 words tak limit
                                    @endphp

                                    <span style="font-size: x-large;">
                                        <strong>
                                            <a class="fs-3 text-nowrap locations-color" target="_blank"
                                                href="{{ route('View.Profile', $List->all_listing->request_broker->requested_user->id) }}"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ $companyName }}"> <!-- Tooltip Content -->
                                                {{ $trimmedCompanyName }}
                                            </a>
                                        </strong>
                                    </span><br>
                                    {{-- <span style="font-size: x-large; "><strong><a class="fs-3 text-nowrap locations-color"
                                                target="_blank"
                                                href="{{ route('View.Profile', $List->all_listing->request_broker->requested_user->id) }}">{{ $List->requested_user->Company_Name }}
                                            </a>
                                        </strong></span><br> --}}
                                    {{-- <span>
                                        <strong>Contact:</strong>{{ $List->requested_user->Contact_Phone }}
                                    </span><br>
                                    <strong>Email:</strong>{{ $List->requested_user->email }}
                                    </span> --}}
                                    <span>
                                        <strong>Contact:</strong>
                                        <a class="locations-color"
                                            href="tel:{{ $List->requested_user->Contact_Phone }}">
                                            {{ $List->requested_user->Contact_Phone }}
                                        </a>
                                    </span><br>
                                    <span>
                                        <strong>Email:</strong>
                                        <a class="locations-color" href="mailto:{{ $List->requested_user->email }}">
                                            {{ $List->requested_user->email }}
                                        </a>
                                    </span>
                                    <br>
                                    <strong>Time:</strong> {{ $List->requested_user->Hours_Operations }}
                                    </span><br>
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
                                        $userRatings = getUserRating($List->requested_user->id);
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
                                    @endif <br>
                                    <span class="badge badge-pill badge-success" style="cursor:pointer;"
                                        onclick="window.open('{{ route('chat', $List->CMP_id) }}', '_blank')">
                                        Message Carrier
                                    </span>
                                </td>
                                <td>
                                    <span style="font-size: large;"><strong>Pickup:</strong></span> <br>
                                    <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                        href="https://www.google.com/maps/place/{{ urlencode($List->all_listing->routes->Origin_ZipCode) }}"
                                        target="_blank">
                                        {{-- <i class="fas fa-map-marker-alt text-success fs-30"></i> --}}
                                        {{ Str::replace(',', '-', $List->all_listing->routes->Origin_ZipCode) }}
                                    </a><br>
                                    <span style="font-size: large;"><strong>Delivery:</strong></span><br>
                                    <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                        href="https://www.google.com/maps/place/{{ urlencode($List->all_listing->routes->Dest_ZipCode) }}"
                                        target="_blank">
                                        {{-- <i class="fas fa-map-marker-alt text-danger fs-30"></i> --}}
                                        {{ Str::replace(',', '-', $List->all_listing->routes->Dest_ZipCode) }}
                                    </a>
                                    <div class="mb-2">
                                        <span class="fs-5"><strong><a
                                                    class="btn btn-outline-primary text-decoration-none fw-bold"
                                                    href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                    target="_blank">View Route</a></strong></span>
                                    </div>
                                </td>
                                <td>
                                    @if (!is_null($List->all_listing->vehicles) && count($List->all_listing->vehicles) === 1)
                                        @foreach ($List->all_listing->vehicles as $vehcile)
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
                                                    style="font-size: 16px;">
                                                    {{ $vehcile->Vehcile_Condition }}
                                                </span>
                                            @endif
                                            @if (!empty($vehcile->Trailer_Type))
                                                <span class="badge badge-pill mt-2 badge-primary font-weight-bold"
                                                    style="font-size: 16px;">
                                                    {{ $vehcile->Trailer_Type }}
                                                </span>
                                            @endif
                                        @endforeach
                                    @endif
                                    @if (!is_null($List->all_listing->vehicles) && count($List->all_listing->vehicles) > 1)
                                        <div class="dropdown">
                                            <a href="javascript:void(0)"
                                                class="dropdown-toggle font-weight-bold d-inline-flex align-items-center text-dark text-decoration-none"
                                                data-toggle="dropdown"
                                                style="font-size: 21px; cursor: pointer;">Vehicles({{ count($List->all_listing->vehicles) }})</a>
                                            <div class="dropdown-menu text-center"
                                                style="max-height: 200px; overflow-y: auto;">
                                                <h6 class="dropdown-header" style="background-color: lightgrey;">
                                                    Attached Vehicles</h6>
                                                @foreach ($List->all_listing->vehicles as $vehcile)
                                                    <a class="dropdown-item" style="color: #0d6efd; font-weight: 800;"
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
                                    {{-- @if (count($List->all_listing->vehicles) === 1)
                                        @foreach ($List->all_listing->vehicles as $vehcile)
                                            <span style="font-size: large; "><a class="font-weight-bold text-dark"
                                                    href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                    target="_blank"><strong>{{ $vehcile->Vehcile_Year }}
                                                        {{ $vehcile->Vehcile_Make }}
                                                        {{ $vehcile->Vehcile_Model }}({{ $vehicle->Vehcile_Type }})</strong></a>
                                            </span><br>
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
                                    @if (count($List->all_listing->vehicles) > 1)
                                        <div class="dropdown">
                                            <a href="javascript:void(0)" class="dropdown-toggle font-weight-bold d-inline-flex align-items-center text-dark text-decoration-none"
                                                data-toggle="dropdown" 
                                                style="font-size: 21px; cursor: pointer;">Vehicles({{ count($List->vehicles) }})
                                            </a>
                                            <div class="dropdown-menu text-center" style="max-height: 200px; overflow-y: auto;">
                                                <h6 class="dropdown-header" style="background-color: lightgrey;">
                                                    Attached Vehicles</h6>
                                                @foreach ($List->all_listing->vehicles as $vehcile)
                                                    <a class="dropdown-item" style="color: #0d6efd; font-weight: 800;"
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
                                                            <span class="badge badge-pill mt-2 badge-primary font-weight-bold"
                                                                style="font-size: 16px;">{{ $vehicle->Trailer_Type }}</span>
                                                        @endif
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif --}}
                                    {{-- @if (count($List->all_listing->vehicles) === 1)
                                        @foreach ($List->all_listing->vehicles as $vehcile)
                                            <a class="font-weight-bold text-dark text-nowrap"
                                                href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                target="_blank"><span
                                                    class="fs-5"><strong>{{ $vehcile->Vehcile_Year }}{{ $vehcile->Vehcile_Make }}{{ $vehcile->Vehcile_Model }}</strong></span>
                                            </a><br>
                                            @if (!empty($vehcile->Vehcile_Condition))
                                                <span
                                                    class="badge badge-pill mt-2 @if ($vehcile->Vehcile_Condition == 'Running') badge-success @elseif($vehcile->Vehcile_Condition == 'Not Running') badge-danger @else badge-primary @endif"
                                                    style="font-size: 16px;">
                                                    {{ $vehcile->Vehcile_Condition }}
                                                </span>
                                            @endif
                                            @if (!empty($vehcile->Trailer_Type))
                                                <span class="badge badge-pill mt-2 badge-primary font-weight-bold"
                                                    style="font-size: 16px;">{{ $vehcile->Trailer_Type }}</span><br>
                                            @endif
                                        @endforeach
                                    @endif
                                    @if (count($List->all_listing->vehicles) > 1)
                                        <div class="dropdown">
                                            <a href="javascript:void(0)" tabindex="0" class=""
                                                data-toggle="dropdown" data-trigger="focus" style="cursor: pointer;"
                                                title="Attached vehicles"
                                                data-content=
                                                "@foreach ($List->all_listing->vehicles as $vehcile)
                                                {{ $vehcile->Vehcile_Year }}
                                                {{ $vehcile->Vehcile_Make }}
                                                {{ $vehcile->Vehcile_Model }}<br>
                                                @if (!empty($vehcile->Vehcile_Condition))
                                                    {{ $vehcile->Vehcile_Condition }}<br>
                                                @endif
                                                @if (!empty($vehcile->Trailer_Type))
                                                    {{ $vehcile->Trailer_Type }} <br>
                                                @endif @endforeach"
                                                data-html="true">vehicles ({{ count($List->all_listing->vehicles) }})
                                            </a>
                                        </div>
                                    @endif --}}
                                    @if (count($List->all_listing->heavy_equipments) === 1)
                                        @foreach ($List->all_listing->heavy_equipments as $vehcile)
                                            <p class="ymm"> {{ $vehcile->Equipment_Year }}
                                                {{ $vehcile->Equipment_Make }}
                                                {{ $vehcile->Equipment_Model }} </p><br>
                                            @if (!empty($vehcile->Equipment_Condition))
                                                <span> {{ $vehcile->Equipment_Condition }}</span><br>
                                            @endif
                                            @if (!empty($vehcile->Trailer_Type))
                                                <span> {{ $vehcile->Trailer_Type }} </span><br>
                                            @endif
                                        @endforeach
                                    @endif
                                    @if (count($List->all_listing->heavy_equipments) > 1)
                                        <a href="javascript:void(0)" tabindex="0" class=""
                                            data-toggle="popover" data-trigger="focus" style="cursor: pointer;"
                                            title="Attached vehicles"
                                            data-content=
                                            "@foreach ($List->all_listing->heavy_equipments as $vehcile)
                                        {{ $vehcile->Equipment_Year }}
                                        {{ $vehcile->Equipment_Make }}
                                        {{ $vehcile->Equipment_Model }}<br>
                                        @if (!empty($vehcile->Equipment_Condition))
                                            {{ $vehcile->Equipment_Condition }}<br>
                                        @endif
                                        @if (!empty($vehcile->Trailer_Type))
                                            {{ $vehcile->Trailer_Type }} <br>
                                        @endif @endforeach"
                                            data-html="true">vehicles
                                            ({{ count($List->all_listing->heavy_equipments) }})
                                        </a>
                                    @endif
                                    @if (count($List->all_listing->dry_vans) === 1)
                                        @foreach ($List->all_listing->dry_vans as $vehcile)
                                            {{ $vehcile->Freight_Class }}
                                            {{ $vehcile->Freight_Weight }}<br>
                                            @if ($vehcile->is_hazmat_Check !== 0)
                                                Hazmat Required<br>
                                            @endif
                                        @endforeach
                                    @endif
                                    @if (count($List->all_listing->dry_vans) > 1)
                                        <a href="javascript:void(0)" tabindex="0" class=""
                                            data-toggle="popover" data-trigger="focus" style="cursor: pointer;"
                                            title="Attached vehicles"
                                            data-content=
                                            "@foreach ($List->all_listing->dry_vans as $vehcile)
                                        {{ $vehcile->Freight_Class }}
                                        {{ $vehcile->Freight_Weight }}<br>
                                        @if ($vehcile->is_hazmat_Check !== 0)
                                            Hazmat Required<br>
                                        @endif @endforeach"
                                            data-html="true">vehicles
                                            ({{ count($List->all_listing->dry_vans) }})
                                        </a>
                                    @endif
                                    <br>
                                    <div class="dropdown mt-3">
                                        <a href="javascript:void(0)" tabindex="0"
                                            class="btn btn-outline-primary dropdown-toggle text-truncate"
                                            id="additionalTermsDropdown" role="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false" style="max-width: 200px;">
                                            {{ $List->all_listing->additional_info->Additional_Terms }}Additional
                                            Terms
                                        </a>
                                        <div class="dropdown-menu p-3 shadow-sm"
                                            aria-labelledby="additionalTermsDropdown" style="max-width: 300px;">
                                            <p class="dropdown-item-text m-0 text-wrap">
                                                {{ !empty($List->all_listing->additional_info->Additional_Terms)
                                                    ? $List->all_listing->additional_info->Additional_Terms
                                                    : 'No additional terms available.' }}
                                            </p>
                                        </div>
                                    </div>
                                    {{-- <div class="dropdown">
                                        <a href="javascript:void(0)" tabindex="0"
                                            class="btn btn-link dropdown-toggle" id="additionalTermsDropdown"
                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            {{ isset($List->all_listing->additional_info->Additional_Terms) &&
                                            $List->all_listing->additional_info->Additional_Terms
                                                ? Str::limit($List->all_listing->additional_info->Additional_Terms, 20)
                                                : '...' }}
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="additionalTermsDropdown">
                                            <p class="dropdown-item">
                                                {{ isset($List->all_listing->additional_info->Additional_Terms) &&
                                                $List->all_listing->additional_info->Additional_Terms
                                                    ? $List->all_listing->additional_info->Additional_Terms
                                                    : 'No additional terms available' }}
                                            </p>
                                        </div>
                                    </div> --}}
                                </td>
                                <td>
                                    @if ($List->all_listing->paymentinfo->Price_Pay_Carrier === '0')
                                        <strong>
                                            Job Price:
                                        </strong>
                                    @else
                                        <strong>Job Price:</strong><span>
                                            ${{ $List->all_listing->paymentinfo->Price_Pay_Carrier }}
                                        </span> <br>
                                    @endif

                                    @if ($List->all_listing->paymentinfo->COD_Amount === '0')
                                        {{-- <strong>
                                                 Pay On Pickup:
                                             </strong>
                                             <br />
                                             <strong>
                                                 Pay On Delivery:
                                             </strong> --}}
                                    @else
                                        <strong>
                                            @if ($List->all_listing->paymentinfo->COD_Location_Amount == 'PickUp')
                                                Pay on Pickup:
                                            @else
                                                Pay on Delivery:
                                            @endif
                                        </strong>

                                        <span>${{ $List->all_listing->paymentinfo->COD_Amount }}</span>
                                    @endif
                                    <br />
                                    {{-- <strong>Price to Pay:
                                    </strong><span>${{ $List->all_listing->paymentinfo->Price_Pay_Carrier }}</span><br> --}}
                                    {{-- <strong>Assigned to: </strong>{{ $List->all_listing->request_broker->requested_user->usr_type }}<br> --}}
                                    <span class="text-nowrap"><strong>Pay Mode: </strong>
                                        {{ !empty($List->all_listing->paymentinfo->COD_Method_Mode) ? $List->all_listing->paymentinfo->COD_Method_Mode : '' }}
                                        {{-- On
                                        {{ !empty($List->all_listing->paymentinfo->COD_Location_Amount) ? $List->all_listing->paymentinfo->COD_Location_Amount : '' }} --}}
                                    </span><br>
                                    @if (!empty($List->Offer_Price) && $List->Offer_Price !== 0)
                                        <span class="text-danger fs-5 text-nowrap">
                                            <strong>Bid Price: ${{ $List->Offer_Price }}</strong>
                                        </span><br>
                                    @endif
                                    <strong>Mile: </strong>{{ $List->all_listing->routes->Miles }}miles<br>
                                    <strong>Price per Mile:</strong>
                                    ${{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}/miles
                                    {{-- <strong><a
                                            href="{{ route('View.Profile', $List->all_listing->request_broker->requested_user->id) }}"
                                            target="_blank">View
                                            MC</a>&nbsp;<br><a
                                            href="{{ route('View.Profile', $List->all_listing->request_broker->requested_user->id) }}"
                                            target="_blank">View DOT</a>
                                    </strong> --}}
                                </td>
                                <td>
                                    {{-- <strong>PickUp Date:</strong><br><span
                                        class="text-nowrap">{{ $List->Pickup_Date }}</span><br>
                                    <strong>Delivery Date:</strong><br><span
                                        class="text-nowrap">{{ $List->Delivery_Date }}</span> --}}
                                    <strong>Pickup Date:</strong><br>
                                    <span class="text-nowrap">{{ \Carbon\Carbon::parse($List->Pickup_Date)->format('d M, Y') }}
                                        {{-- ({{ $List->Date_Pickup_Mode }}) --}}
                                    </span>
                                    <br>
                                    <strong>Delivery Date:</strong><br><span class="text-nowrap">
                                        {{ \Carbon\Carbon::parse($List->Delivery_Date)->format('d M, Y') }}
                                        {{-- ({{ $List->Date_Delivery_Mode }}) --}}
                                    </span><br>
                                    <strong>Requested Date:</strong><br><span class="text-nowrap">
                                        {{ \Carbon\Carbon::parse($List->created_at)->format('d M, Y') }}</span>
                                    {{-- ({{ $List->Date_Delivery_Mode }}) --}}
                                    {{-- <strong>Created At:</strong><br>
                                    {{ $List->created_at }}<br>
                                    <strong>Modified At:</strong><br>
                                    {{ $List->updated_at }} --}}
                                </td>
                                <td>
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Bid Comment</h5>
                                                    <button type="button"
                                                        class="btn-close text-danger bg-white border-0"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"style="font-size: larger; font-weight: 900;">X</button>
                                                </div>
                                                <div class="modal-body">
                                                    <p id="modalBidComment" class="text-start text-wrap">
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="mb-2">
                                            <button 
                                                type="button" 
                                                class="btn btn-dark" 
                                                data-toggle="tooltip" 
                                                data-placement="bottom" 
                                                title="Dark Theme Tooltip"
                                                data-theme="dark">
                                                <i class="fas fa-moon"></i>
                                            </button>
                                            <button type="button" data-toggle="tooltip" data-placement="top" title="Compare Listing" class="btn btn-outline-primary"><i class="far fa-eye"></i></button>
                                            <button type="button" data-toggle="tooltip" data-placement="top" title="Bid Comment" class="btn btn-dark"><i class="far fa-trash-alt"></i></button>
                                        </div>
                                        <div>
                                            <button type="button" data-toggle="tooltip" data-placement="top" title="Assign Listing" class="btn btn-secondary"><i class="far fa-eye"></i></button>
                                            <button type="button" data-toggle="tooltip" data-placement="top" title="Cancel Request" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                            <button type="button" data-toggle="tooltip" data-placement="top" title="Tooltip on top" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                                    </div> --}}
                                    @if ($List->all_listing->user_id === $currentUser->id)
                                        <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                            href="{{ route('User.Dispatch.Listing', ['List_ID' => $List->all_listing->id]) }}">Assign
                                            Carrier</a>
                                        <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                            href="{{ route('Requested.Listing.Canceled', ['List_ID' => $List->id]) }}">Decline
                                            Offer</a>
                                        <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                            href="{{ route('User.Edit.Listing', ['List_ID' => $List->all_listing->id]) }}">Modify
                                            Listing</a>
                                    @endif
                                    <button
                                        class="btn btn-outline-primary mb-2 w-100 d-block compare-listing text-nowrap"
                                        data-toggle="modal" data-target="#CompareListing" href="javascript:void(0);">
                                        <input hidden type="text" class="Listed-ID"
                                            value="{{ $List->all_listing->id }}">
                                        <input hidden type="text" class="Listed-Type"
                                            value="{{ $List->all_listing->Listing_Type }}">
                                        <input hidden type="text" class="Listed-Miles"
                                            value="{{ $List->all_listing->routes->Miles }}">
                                        Compare Request
                                    </button>
                                    <button type="button" class="btn btn-outline-primary mb-2 w-100 d-block"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal"
                                        data-bs-comment="{{ $List->Bid_Comment }}"
                                        {{ empty($List->Bid_Comment) ? 'disabled' : '' }}>
                                        {!! empty($List->Bid_Comment) ? '<span class="">No Bid Comments</span>' : 'Bid Comments' !!}
                                    </button>
                                    {{-- <h6>Status: <span class="badge badge-warning">Pending</span></h6><br> --}}
                                    {{-- <div class="dropdown show list-actions">
                                        <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true">
                                            Actions
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                target="_blank">View Route</a>
                                            <a class="dropdown-item compare-listing" data-toggle="modal"
                                                data-target="#CompareListing" href="javascript:void(0);">
                                                <input hidden type="text" class="Listed-ID"
                                                        value="{{ $List->all_listing->id }}">
                                                <input hidden type="text" class="Listed-Type"
                                                        value="{{ $List->all_listing->Listing_Type }}">
                                                <input hidden type="text" class="Listed-Miles"
                                                        value="{{ $List->all_listing->routes->Miles }}">
                                                Compare Listing</a>
                                            @if ($List->all_listing->user_id === $currentUser->id)
                                                <a class="dropdown-item"
                                                    href="{{ route('User.Dispatch.Listing', ['List_ID' => $List->all_listing->id]) }}">Assign
                                                    Listing</a>
                                                <a class="dropdown-item"
                                                        href="{{ route('Requested.Listing.Canceled', ['List_ID' => $List->id]) }}">Cancel
                                                        Request</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('Requested.Listing.Canceled', ['List_ID' => $List->all_listing->id]) }}">Cancel
                                                        Request</a>
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
        @endif
    </div>
</div>

{{-- carrier view request --}}
<div class="modal fade" id="CarrierViewRequestLoad" data-backdrop="true" role="dialog" aria-hidden="true">
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
                    <input hidden type="text" name="request_ID" class="request_ID" value="">
                    <input hidden type="text" name="get_Listed_ID" class="get_Listed_ID" value="">
                    <input hidden type="text" name="get_Ref_ID" class="get_Ref_ID" value="">
                    <input hidden type="text" name="type" class="check_type">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Current Price (Order Price)</label>
                                <input readonly type="text" class="form-control" id="get_Listed_Price"
                                    value="" name="Current_Price">
                            </div>
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
                                <input type="text" class="form-control" id="Bid_Comment"
                                    placeholder="Enter Your Bid Comment" value="" name="Bid_Comment">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Date to Pickup *</label>
                                <select class="custom-select" name="Date_Pickup_Mode">
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
                                    name="Pickup_Date">
                                <div class="invalid-feedback">
                                    Entered Pickup Date.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Date to Delivery *</label>
                                <select class="custom-select" name="Date_Delivery_Mode">
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
                                    name="Delivery_Date">
                                <div class="invalid-feedback">
                                    Entered Delivery Date.
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-lg-12">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="acknoledgement" che>
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
                        </div> --}}
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
            <div id="requested" class="d-none">
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
{{-- carrier view request end --}}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function carrier_request_load_click(element, value) {
        const getListedID = $(element).find('.Listed-ID').val();
        const modalFunc = $(element).find('.modalFunc').val();
        const request_ID = value;

        if (modalFunc === 'view') {
            $('#CarrierViewRequestLoad input, #CarrierViewRequestLoad select').prop('disabled', true);
            $('#CarrierViewRequestLoad .submit-btn').hide();
        } else {
            $('#CarrierViewRequestLoad input, #CarrierViewRequestLoad select').prop('disabled', false);
            $('#CarrierViewRequestLoad .submit-btn').show();
        }

        // Trigger the AJAX request
        $.ajax({
            url: '{{ route('View.Carrier.Request') }}',
            type: 'GET',
            data: {
                'Listed_ID': getListedID,
                'request_ID': request_ID
            },
            success: function(data) {

                const request_ID = data['id'];
                const Bid_Comment = data['Bid_Comment'];
                const CMP_id = data['CMP_id'];
                const Current_Price = data['Current_Price'];
                const Date_Delivery_Mode = data['Date_Delivery_Mode'];
                const Date_Pickup_Mode = data['Date_Pickup_Mode'];
                const Delivery_Date = data['Delivery_Date'];
                const Offer_Price = data['Offer_Price'];
                const Pickup_Date = data['Pickup_Date'];

                $('.request_ID').val(request_ID);
                $('.get_Order_ID').html(data['all_listing'].Ref_ID);
                $('#get_Listed_Price').val(Current_Price);
                $('#Bid_Comment').val(Bid_Comment);
                $('.get_Listed_ID').val(getListedID);
                $('.get_Ref_ID').val(data['all_listing'].Ref_ID);
                $('.check_type').val('request');

                $('select[name="Date_Pickup_Mode"]').val(Date_Pickup_Mode);
                $('select[name="Date_Delivery_Mode"]').val(Date_Delivery_Mode);

                $('input[name="Pickup_Date"]').val(Pickup_Date);
                $('input[name="Delivery_Date"]').val(Delivery_Date);

                if (Offer_Price) {
                    $('#offer-Bid').val(
                        Offer_Price);
                } else {
                    $('#offer-Bid').val('');
                }

                if (Bid_Comment) {
                    $('#Bid_Comment').val(Bid_Comment);
                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    // $('.advance-6').DataTable({
    //     "drawCallback": function(settings) {
    //         // Reinitialize tooltips after DataTable updates
    //         $('[data-toggle="tooltip"]').tooltip();
    //     }
    // });
    // $('.advance-6').DataTable({
    //     "deferRender": true,
    // });
    // $('#exampleModal').on('show.bs.modal', function (event) {
    //     var comment = $(event.relatedTarget).data('bs-comment'); 
    //     $(this).find('#modalBidComment').text(comment); 
    // });
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var comment = button.data('bs-comment'); // Extract comment from data-bs-comment
        // If comment is empty, prevent the modal from showing
        if (!comment) {
            return false; // Cancel modal show
        }
        $(this).find('#modalBidComment').text(comment);
    });
    // Get Profile Info Functionality
    $(".cancel-request").click(function() {
        const getListedID = $(this).find('.Listed-ID').val();
        $(".get_Order_ID").html(getListedID);
        $(".get_Listed_ID").val(getListedID);
    });

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
    $("#Search_vehicleType").on("change", function() {
        // console.log($(this).val());
        $('#Search_vehicleType_form').submit();
        // console.log(url);
    });
    // Offer Amount
    $('.offer-price').hide();
    $('#offer_Check').change(function() {
        const checkBox = document.getElementById('offer_Check');
        if (checkBox.checked) {
            $('.offer-price').show();
            $(".offer-price input").prop('required', true);
        } else {
            $('.offer-price').hide();
            $(".offer-price input").prop('required', false);
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('.notify-btn').on('click', function(e) {
            e.preventDefault(); // Prevent the default link behavior

            let id = $(this).data('id'); // Get the ID from the data attribute
            let url = "{{ route('Notify.Company', ':id') }}".replace(':id',
                id); // Replace :id with the actual ID

            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}" // Include CSRF token
                },
                success: function(response) {
                    if (response.success) {
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
                            `<span class="text-white font-weight-bold">${response.message}</span>`
                        );
                    } else {
                        toastr.error(
                            `<span class="text-white font-weight-bold">${response.message}</span>`
                        );
                    }
                },
                error: function(xhr) {
                    alert('Something went wrong. Please try again.');
                }
            });
        });
    });
</script>
