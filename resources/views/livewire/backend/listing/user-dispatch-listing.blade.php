@section('Dispatch', 'mm-active')
<!-- Breadcrumb Area -->
@php
    use Illuminate\Support\Facades\Auth;
    $currentUser = Auth::guard('Authorized')->user();
@endphp
@php
    use Illuminate\Support\Str;
@endphp
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<div class="breadcrumb-area">
    <h1>{{ $currentUser->usr_type }} Listing</h1>
    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>
        <li class="item">Dispatch</li>
    </ol>
</div>
<!-- End Breadcrumb Area -->
@include('partials.global-search')
<div class="card">
    <div class="card-body">
        @if ($currentUser->usr_type === 'Carrier')
            <div class="table-responsive dataTables_wrapper me-0 d-flex">
                {{-- <div class="col-lg-6 col-md-6 col-sm-12" style="display: flex; align-items: end; column-gap: 14px;">
                    <table>
                        <tbody class="dataTables_filter">
                        <tr>
                            <td><strong>Search For: </strong></td>
                            <td>
                                <select class="form-control ml-1" id="Search_Criteria" name="Search_Criteria">
                                    <option value="1" selected>Order ID</option>
                                    <option value="2">Pickup City</option>
                                    <option value="3">Pickup State</option>
                                    <option value="4">Delivery City</option>
                                    <option value="5">Delivery State</option>
                                    <option value="6">Carrier Name</option>
                                </select>
                            </td>
                            <td>
                                <input class="form-control" id="Search_Value" placeholder="Enter Search Value"
                                    type="search" name="Search_Value">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table>
                        <tbody class="dataTables_filter">
                            <tr>
                                <td><strong>Search Vehicle Type: </strong></td>
                                <td>
                                    <form id="Search_vehicleType_form" action="{{ route('Dispatch.Listing') }}">
                                        <select class="form-control ml-1" id="Search_vehicleType" name="Search_vehicleType">
                                            <option>Select Vehicle Type</option>
                                            <option value="heavy_equipments" @if ($Search_vehicleType == 'heavy_equipments') selected @endif>Heavy Equipments</option>
                                            <option value="vehicles" @if ($Search_vehicleType == 'vehicles') selected @endif>Vehicles(Autos)</option>
                                            <option value="dry_vans" @if ($Search_vehicleType == 'dry_vans') selected @endif>Dry van</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> --}}
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
                <table class="display dataTable advance-6 table-1 text-center table-bordered table-cards">
                    <thead class="table-header">
                        <tr>
                            <th>ID</th>
                            <th>Company Details</th>
                            <th>Routes</th>
                            <th>Load Details</th>
                            <th>Payments</th>
                            <th>Dates</th>
                            {{-- <th>Listing Dates</th> --}}
                            <th style="width: 230px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Lisiting as $List)
                            @if ($List->all_listing)
                                <tr class="card-row" data-status="active">
                                    <td>
                                        <h6><span
                                                class="badge badge-primary">{{ $List->all_listing->Listing_Status }}</span>
                                        </h6>
                                        {{-- <strong>Ref-ID:</strong> --}}
                                        <span class="text-nowrap"
                                            style="font-size: x-large;"><strong>{{ $List->all_listing->Ref_ID }}</strong></span><br>
                                        @if (count($List->all_listing->attachments) > 0)
                                            <strong><a class="text-nowrap"
                                                    href="{{ route('Order.Attachments', ['List_ID' => $List->all_listing->id]) }}"
                                                    target="_blank">View Images</a></strong><br>
                                        @endif
                                        {{-- {{ $List->all_listing->routes->Miles }} miles<br>
                                                $ {{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}
                                                /miles --}}
                                    </td>
                                    @php
                                        $companyName = $List->all_listing->authorized_user->Company_Name;
                                        $trimmedCompanyName = Str::words($companyName, 3, '...');
                                    @endphp

                                    <td>  <span style="font-size: x-large;">
                                        <a class="fs-3 text-nowrap locations-color"
                                         href="{{ route('View.Profile', $List->all_listing->authorized_user->id) }}"
                                            target="_blank" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="{{ $companyName }}">
                                            <strong>{{ $trimmedCompanyName }}</strong>
                                        </a>
                                    </span><br>
                                    {{-- <td><span style="font-size: x-large; "><a class="fs-3 text-nowrap locations-color"
                                                href="{{ route('View.Profile', $List->all_listing->authorized_user->id) }}"
                                                target="_blank"><strong>{{ $List->all_listing->authorized_user->Company_Name }}</strong></a></span><br> --}}
                                    <span class="text-nowrap">
                                        <strong>Contact:</strong>
                                        <a class="locations-color"
                                            href="tel:{{ $List->all_listing->authorized_user->Contact_Phone }}">
                                            {{ $List->all_listing->authorized_user->Contact_Phone }}
                                        </a>
                                    </span><br>
                                    <span class="text-nowrap">
                                        <strong>Email:</strong>
                                        <a class="locations-color"
                                            href="mailto:{{ $List->all_listing->authorized_user->email }}">
                                            {{ $List->all_listing->authorized_user->email }}
                                        </a>
                                    </span>
                                    {{-- Contact:{{ $List->all_listing->authorized_user->Contact_Phone }}<br>
                                        Email:{{ $List->all_listing->authorized_user->email }}<br> --}}
                                    Time:{{ $List->all_listing->authorized_user->Hours_Operations }}<br>
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
                                        <div class="mb-2">
                                            <strong style="font-size: large;">Pickup</strong><br>
                                            <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                                href="https://www.google.com/maps/place/{{ urlencode($List->all_listing->routes->Origin_ZipCode) }}"
                                                target="_blank">
                                                {{-- <i class="fas fa-map-marker-alt text-success fs-30"></i> --}}
                                                {{ Str::replace(',', '-', $List->all_listing->routes->Origin_ZipCode) }}
                                            </a>
                                        </div>
                                        <div class="mb-2">
                                            <strong style="font-size: large;">Delivery</strong><br>
                                            <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                                href="https://www.google.com/maps/place/{{ urlencode($List->all_listing->routes->Dest_ZipCode) }}"
                                                target="_blank">
                                                {{-- <i class="fas fa-map-marker-alt text-danger fs-30"></i> --}}
                                                {{ Str::replace(',', '-', $List->all_listing->routes->Dest_ZipCode) }}
                                            </a>
                                        </div>
                                        <div class="mb-2">
                                            <span class="fs-5"><strong>
                                                    <a class="btn btn-outline-primary text-decoration-none fw-bold"
                                                        href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                        target="_blank">View Route</a>
                                                </strong></span>
                                        </div>
                                    </td>
                                    <td>
                                        @if (count($List->all_listing->vehicles) === 1)
                                            @foreach ($List->all_listing->vehicles as $vehcile)
                                                <a class="font-weight-bold text-dark"
                                                    href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                    target="_blank"><span
                                                        class="fs-5"><strong>{{ $vehcile->Vehcile_Year }}
                                                            {{ $vehcile->Vehcile_Make }}
                                                            {{ $vehcile->Vehcile_Model }}</span></strong></a><br>
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
                                        @if (count($List->all_listing->vehicles) > 1)
                                            <a href="javascript:void(0)" tabindex="0" class=""
                                                data-toggle="popover" data-trigger="focus" style="cursor: pointer;"
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
                                                            {{ $vehcile->Trailer_Type }}
                                                        @endif @endforeach"
                                                data-html="true">vehicles
                                                ({{ count($List->all_listing->vehicles) }})
                                            </a>
                                        @endif
                                        @if (count($List->all_listing->heavy_equipments) === 1)
                                            @foreach ($List->all_listing->heavy_equipments as $vehcile)
                                                <a class="font-weight-bold text-dark"
                                                    href="https://www.google.com/search?q={{ $vehcile->Equipment_Year }}%20{{ $vehcile->Equipment_Make }}%20{{ $vehcile->Equipment_Model }}"
                                                    target="_blank"> {{ $vehcile->Equipment_Year }}
                                                    {{ $vehcile->Equipment_Make }}
                                                    {{ $vehcile->Equipment_Model }}</a><br>

                                                <b>L</b>{{ $vehcile->Equip_Length }} |
                                                <b>W</b>{{ $vehcile->Equip_Width }} |
                                                <b>H</b>{{ $vehcile->Equip_Height }}
                                                | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                                {{-- @if (!empty($vehcile->Equipment_Condition))
                                                            <br>{{ $vehcile->Equipment_Condition }}<br>
                                                        @endif
                                                        @if (!empty($vehcile->Trailer_Type))
                                                            {{ $vehcile->Trailer_Type }}
                                                        @endif --}} <br>
                                                <span class="text-nowrap">
                                                    @if (!empty($vehcile->Equipment_Condition))
                                                        <span class="badge badge-success "
                                                            style="font-size: 16px;">{{ $vehcile->Equipment_Condition }}</span>
                                                    @endif
                                                    @if (!empty($vehcile->Trailer_Type))
                                                        <span class="badge badge-primary " style="font-size: 16px;">
                                                            {{ $vehcile->Trailer_Type }}</span>
                                                    @endif
                                                </span>
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
                                                            <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} | <b>H</b>{{ $vehcile->Equip_Height }} | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                                        @if (!empty($vehcile->Equipment_Condition))
                                                            <br>{{ $vehcile->Equipment_Condition }}<br>
                                                        @endif
                                                        @if (!empty($vehcile->Trailer_Type))
                                                            {{ $vehcile->Trailer_Type }}
                                                        @endif @endforeach"
                                                data-html="true">Vehicles
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
                                                data-html="true">Vehicles
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
                                        {{-- <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                            data-trigger="focus" style="cursor: pointer;" title="Additional Terms"
                                            data-content=
                                                    "{{ !empty($List->all_listing->additional_info->Additional_Terms) ? $List->all_listing->additional_info->Additional_Terms : '' }}">
                                            {{ !empty($List->all_listing->additional_info->Additional_Terms) ? Str::limit($List->all_listing->additional_info->Additional_Terms, 20) : '...' }}</a> --}}
                                    </td>
                                    <td>
                                        @if ($List->all_listing->paymentinfo->Price_Pay_Carrier === '0')
                                            <strong>
                                                Job Price:
                                            </strong>
                                        @else
                                            <strong>Job Price:</strong><span>
                                                ${{ $List->all_listing->paymentinfo->Price_Pay_Carrier }}
                                            </span>
                                        @endif
                                        <br>
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
                                        {{-- <span class="text-nowrap"><strong>Price to Pay: </strong>${{ $List->all_listing->paymentinfo->Price_Pay_Carrier }}</span>
                                        <br> --}}
                                        <span class="text-nowrap"><strong>Pay Mode:</strong>
                                            {{ !empty($List->all_listing->paymentinfo->COD_Method_Mode) ? $List->all_listing->paymentinfo->COD_Method_Mode : '' }}
                                            {{-- On
                                            {{ !empty($List->all_listing->paymentinfo->COD_Location_Amount) ? $List->all_listing->paymentinfo->COD_Location_Amount : '' }}--}}
                                            </span><br>
                                        {{-- @if (!empty($List->all_listing->request_broker->Offer_Price) && $List->all_listing->request_broker->Offer_Price !== 0)
                                        <span class="text-danger fs-5 text-nowrap">
                                            <strong>Bid Price: ${{ $List->all_listing->request_broker->Offer_Price }}</strong>
                                        </span>
                                            <br>
                                        @endif  --}}

                                        <span
                                            class="text-nowrap"><strong>Mile:</strong>{{ $List->all_listing->routes->Miles }}miles</span><br>
                                        <span class="text-nowrap"><strong>Price per
                                                Mile:</strong>${{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}/miles</span>
                                    </td>
                                    <td>
                                        {{-- <strong>Created At:</strong><br>
                                        {{ $List->all_listing->created_at }}<br>
                                        <strong>Modified At:</strong><br>
                                        {{ $List->all_listing->updated_at }}<br> --}}
                                        {{-- <strong>Pickup:</strong><br><span
                                            class="text-nowrap">{{ $List->all_listing->pickup_delivery_info->Pickup_Date }}
                                            ({{ $List->all_listing->pickup_delivery_info->Pickup_Date_mode }})</span>
                                            <br>
                                            <strong>Delivery:</strong><br><span class="text-nowrap">
                                                @if ($List->all_listing->pickup_delivery_info->Delivery_Date_mode === 'ASAP')
                                                    ({{ $List->all_listing->pickup_delivery_info->Delivery_Date_mode }})
                                                @else
                                                    {{ $List->all_listing->pickup_delivery_info->Delivery_Date }}
                                                @endif
                                            </span>
                                            <br>
                                            <strong>Dispatch At:</strong><br><span
                                                class="text-nowrap">{{ $List->created_at }}</span> --}}
                                        <span class="text-nowrap"><strong>Pickup
                                                Date:</strong><br>{{ \Carbon\Carbon::parse($List->all_listing->pickup_delivery_info->Pickup_Date)->format('d M, Y') }}</span>
                                        <br>
                                        <span class="text-nowrap"><strong>Delivery Date:</strong><br>
                                            {{ \Carbon\Carbon::parse($List->all_listing->pickup_delivery_info->Delivery_Date)->format('d M, Y') }}</span>
                                        <br>
                                        <span class="text-nowrap"><strong>Dispatch Date: <br>
                                            </strong>{{ \Carbon\Carbon::parse($List->created_at)->format('d M, Y') }}</span>
                                    </td>
                                    <td>
                                        {{-- <h6>Status: <span
                                                        class="badge badge-warning">{{ $List->all_listing->Listing_Status }}</span>
                                                </h6>
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
                                                        <a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                                        class="dropdown-item" role="button">View Detail</a>
                                                        <a class="dropdown-item compare-listing" data-toggle="modal"
                                                        data-target="#CompareListing" href="javascript:void(0);">
                                                            <input hidden type="text" class="Listed-ID"
                                                                value="{{ $List->all_listing->id }}">
                                                            <input hidden type="text" class="Listed-Type"
                                                                value="{{ $List->all_listing->Listing_Type }}">
                                                            <input hidden type="text" class="Listed-Miles"
                                                                value="{{ $List->all_listing->routes->Miles }}">
                                                            Compare Listing</a>
                                                        <a data-toggle="modal"
                                                        data-target="#CancelOrderModal" href="javascript:void(0);"
                                                        class="dropdown-item Cancel_Order" role="button">
                                                            <input hidden type="text" class="Listed-ID"
                                                                value="{{ $List->all_listing->id }}">
                                                            <input hidden type="text" class="User-ID"
                                                                value="{{ $List->all_listing->user_id }}">
                                                            <input hidden type="text" class="CMP-ID"
                                                                value="{{ $List->all_listing->dispatch_listing->waiting_users->id }}">
                                                            <input hidden type="text" class="Order-Status"
                                                                value="{{ $List->all_listing->Listing_Status }}">
                                                            Cancel Order</a>
                                                        <!-- @if ($List->all_listing->user_id !== $currentUser->id)
                                                            <a class="dropdown-item attach-bill" data-toggle="modal"
                                                            data-target="#AttachBill" href="javascript:void(0);">
                                                                <input hidden type="text" class="Listed-ID"
                                                                    value="{{ $List->all_listing->id }}">
                                                                <input hidden type="text" class="List-Ref-ID"
                                                                value="{{ $List->all_listing->Ref_ID }}">Pickup</a>
                                                        @endif -->
                                                        <form action="{{ route('Order.Pickup', ['List_ID' => $List->all_listing->id]) }}" method="POST" class="was-validated"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <a class="dropdown-item"
                                                            href="{{ route('Order.Pickup', ['List_ID' => $List->all_listing->id]) }}">Pick Up</a>
                                                        </form>
                                                        <!-- add Online Bol -->
                                                        @if ($List->all_listing->Listing_Status === 'Dispatch')
                                                            <a class="dropdown-item"
                                                                href="{{ route('User.Bol.Listing', ['List_ID' => $List->all_listing->id]) }}" target="_blank">Online BOL</a>
                                                        @endif
                                                        <!-- End Online Bol -->
                                                        @if ($List->all_listing->user_id === $currentUser->id)
                                                            <a class="dropdown-item"
                                                            href="{{ route('User.Edit.Listing', ['List_ID' => $List->all_listing->id]) }}">Edit
                                                                Listing</a>
                                                            <a class="dropdown-item"
                                                            href="{{ route('Order.Pickup.Approval', ['List_ID' => $List->all_listing->id]) }}">PickUp</a>
                                                            <a class="dropdown-item"
                                                            href="{{ route('Order.Not.Pickup.Approval', ['List_ID' => $List->all_listing->id]) }}">Not
                                                                PickUp</a>
                                                            <a class="dropdown-item"
                                                            href="{{ route('User.Listing.Archive', ['List_ID' => $List->all_listing->id]) }}">Archive
                                                                Order</a>
                                                        @endif
                                                    </div>
                                                </div> --}}
                                        {{-- <button class="btn btn-primary btn-sm mb-2 w-75"
                                                    href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                    target="_blank">View Route</button> --}}
                                        {{-- <form action="{{ route('Order.Pickup', ['List_ID' => $List->all_listing->id]) }}" method="GET" class="was-validated">
                                                        <button type="submit" class="btn btn-primary btn-sm mb-2 w-75">
                                                            Mark As Picked Up
                                                        </button>
                                                    </form> --}}
                                        <form
                                            action="{{ route('Order.Pickup', ['List_ID' => $List->all_listing->id]) }}"
                                            method="GET" class="was-validated" enctype="multipart/form-data">
                                            @csrf
                                            <button class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                >Mark As Picked Up</button>
                                        </form>
                                        <a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                            class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                            role="button">View Details</a>
                                        {{-- <button href="{{ route('Order.Misc') }}" class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap" role="button">Add Misc
                                            Charge</button> --}}
                                        <button class="add-misc btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                            data-toggle="modal" data-target="#AddMisc" href="javascript:void(0);">
                                            <input hidden type="text" class="Listed-ID"
                                                value="{{ $List->all_listing->id }}">
                                            <input hidden type="text" class="Ref-ID"
                                                value="{{ $List->all_listing->Ref_ID }}">Add Misc.</button>
                                        <button
                                            class="show-misc btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                            data-toggle="modal" data-target="#ShowMisc" href="javascript:void(0);">
                                            <input hidden type="text" class="Listed-ID"
                                                value="{{ $List->all_listing->id }}">
                                            <input hidden type="text" class="Ref-ID"
                                                value="{{ $List->all_listing->Ref_ID }}">Show Misc. <span
                                                class="badges">({{ count($List->all_listing->miscellenous) }})</span></button>
                                        {{-- <button class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap compare-listing" data-toggle="modal"
                                            data-target="#CompareListing" href="javascript:void(0);">
                                            <input hidden type="text" class="Listed-ID" value="{{ $List->all_listing->id }}">
                                            <input hidden type="text" class="Listed-Type"
                                                value="{{ $List->all_listing->Listing_Type }}">
                                            <input hidden type="text" class="Listed-Miles"
                                                value="{{ $List->all_listing->routes->Miles }}">Compare Listing</button> --}}
                                        <button data-toggle="modal" data-target="#CancelOrderModal"
                                            href="javascript:void(0);"
                                            class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap Cancel_Order"
                                            role="button">
                                            <input hidden type="text" class="Listed-ID"
                                                value="{{ $List->all_listing->id }}">
                                            <input hidden type="text" class="User-ID"
                                                value="{{ $List->all_listing->user_id }}">
                                            <input hidden type="text" class="CMP-ID"
                                                value="{{ $List->all_listing->dispatch_listing->waiting_users->id }}">
                                            <input hidden type="text" class="Order-Status"
                                                value="{{ $List->all_listing->Listing_Status }}">Cancel
                                            Dispatch</button>

                                        @if ($List->all_listing->Listing_Status === 'Dispatch')
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap "
                                               href="{{ route('User.Bol.Listing', ['List_ID' => $List->all_listing->id]) }}">
                                                {{ isset($List->all_listing->dispatch_bol->id) ? 'View Bol' : 'Upload Bol' }}
                                            </a>
                                        @endif
                                        {{-- @if ($List->all_listing->user_id !== $currentUser->id)
                                            <a class="dropdown-item attach-bill" data-toggle="modal"
                                            data-target="#AttachBill" href="javascript:void(0);">
                                                <input hidden type="text" class="Listed-ID"
                                                    value="{{ $List->all_listing->id }}">
                                                <input hidden type="text" class="List-Ref-ID"
                                                value="{{ $List->all_listing->Ref_ID }}">Pickup</a>
                                        @endif --}}
                                        @if ($List->all_listing->user_id === $currentUser->id)
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('User.Edit.Listing', ['List_ID' => $List->all_listing->id]) }}">Modify
                                                Listing</a>
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('Order.Pickup.Approval', ['List_ID' => $List->all_listing->id]) }}">PickUp</a>
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('Order.Not.Pickup.Approval', ['List_ID' => $List->all_listing->id]) }}">Not
                                                PickUp</a>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {{ $Lisiting->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        @else
            {{-- <div class="table-responsive dataTables_wrapper me-0 d-flex">
            <div class="col-lg-6 col-md-6 col-sm-12" style="display: flex; align-items: end; column-gap: 14px;">
                    <table>
                    <tbody class="dataTables_filter">
                    <tr>
                        <td><strong>Search For: </strong></td>
                        <td>
                            <select class="form-control ml-1" id="Search_Criteria" name="Search_Criteria">
                                <option value="1" selected>Order ID</option>
                                <option value="2">Pickup City</option>
                                <option value="3">Pickup State</option>
                                <option value="4">Delivery City</option>
                                <option value="5">Delivery State</option>
                            </select>
                        </td>
                        <td>
                            <input class="form-control" id="Search_Value" placeholder="Enter Search Value"
                                    type="search" name="Search_Value">
                        </td>
                    </tr>
                    </tbody>
                </table>
                    <table>
                    <tbody class="dataTables_filter">
                        <tr>
                            <td><strong>Search Vehicle Type: </strong></td>
                            <td>
                                <form id="Search_vehicleType_form" action="{{ route('Dispatch.Listing') }}">
                                    <select class="form-control ml-1" id="Search_vehicleType" name="Search_vehicleType">
                                        <option>Select Vehicle Type</option>
                                        <option value="heavy_equipments" @if ($Search_vehicleType == 'heavy_equipments') selected @endif>Heavy Equipments</option>
                                        <option value="vehicles" @if ($Search_vehicleType == 'vehicles') selected @endif>Vehicles(Autos)</option>
                                        <option value="dry_vans" @if ($Search_vehicleType == 'dry_vans') selected @endif>Dry van</option>
                                    </select>
                                </form>
                            </td>
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
                            <th>Payments</th>
                            <th>Dates</th>
                            <th style="width: 160px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Lisiting as $List)
                            @if ($List->all_listing)
                                <tr class="card-row" data-status="active">
                                    <td>
                                        {{-- <strong>Ref-ID:</strong> --}}
                                        {{-- {{ $List->all_listing->routes->Miles }} miles<br>
                                            $ {{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}
                                            /miles --}}
                                        <h6><span
                                                class="badge badge-primary">{{ $List->all_listing->Listing_Status }}</span>
                                        </h6>
                                        <span class="text-nowrap"
                                            style="font-size: x-large;"><strong>{{ $List->all_listing->Ref_ID }}</strong></span><br>
                                        @if (count($List->all_listing->attachments) > 0)
                                            <strong>
                                                <a href="{{ route('Order.Attachments', ['List_ID' => $List->all_listing->id]) }}"
                                                    target="_blank">View Images</a></strong>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $companyName = $List->all_listing->dispatch_listing->waiting_users->Company_Name;
                                            $trimmedCompanyName = Str::words($companyName, 3, '...');
                                        @endphp

                                        <span style="font-size: x-large;">
                                            <a target="_blank" class="locations-color"
                                                href="{{ route('View.Profile', $List->all_listing->dispatch_listing->waiting_users->id) }}"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ $companyName }}">
                                                <strong>{{ $trimmedCompanyName }}</strong>
                                            </a>
                                        </span><br>
                                        {{-- <span style="font-size: x-large; "><a target="_blank" class="locations-color"
                                                href="{{ route('View.Profile', $List->all_listing->dispatch_listing->waiting_users->id) }}"><strong>{{ $List->all_listing->dispatch_listing->waiting_users->Company_Name }}</strong></a>
                                        </span><br> --}}
                                        <span>
                                            <strong>Contact:</strong>
                                            <a class="locations-color"
                                                href="tel:{{ $List->all_listing->dispatch_listing->waiting_users->Contact_Phone }}">
                                                {{ $List->all_listing->dispatch_listing->waiting_users->Contact_Phone }}
                                            </a>
                                        </span><br>
                                        <span>
                                            <strong>Email:</strong>
                                            <a class="locations-color"
                                                href="mailto:{{ $List->all_listing->dispatch_listing->waiting_users->email }}">
                                                {{ $List->all_listing->dispatch_listing->waiting_users->email }}
                                            </a>
                                        </span><br>
                                        {{-- Contact:{{ $List->all_listing->dispatch_listing->waiting_users->Contact_Phone }}<br>
                                        Email:{{ $List->all_listing->dispatch_listing->waiting_users->email }}<br> --}}
                                        Time:{{ $List->all_listing->dispatch_listing->waiting_users->Hours_Operations }}<br>
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
                                                $List->all_listing->dispatch_listing->waiting_users->id,
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
                                    </td>
                                    <td>
                                        <div class="mb-2">
                                            <span class="fs-5"><strong>Pickup</strong></span><br>
                                            <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                                href="https://www.google.com/maps/place/{{ urlencode($List->all_listing->routes->Origin_ZipCode) }}"
                                                target="_blank">
                                                {{-- <i class="fas fa-map-marker-alt text-success fs-30"></i> --}}
                                                {{ Str::replace(',', '-', $List->all_listing->routes->Origin_ZipCode) }}
                                            </a>
                                        </div>
                                        <div class="mb-2">
                                            <span class="fs-5"><strong>Delivery</strong></span><br>
                                            <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                                href="https://www.google.com/maps/place/{{ urlencode($List->all_listing->routes->Dest_ZipCode) }}"
                                                target="_blank">
                                                {{-- <i class="fas fa-map-marker-alt text-danger fs-30"></i> --}}
                                                {{ Str::replace(',', '-', $List->all_listing->routes->Dest_ZipCode) }}
                                            </a>
                                        </div>
                                        <div class="mb-2">
                                            <span class="fs-5"><strong>
                                                    <a class="btn btn-outline-primary text-decoration-none fw-bold"
                                                        href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                        target="_blank">View Route
                                                    </a>
                                                </strong></span>
                                        </div>
                                    </td>
                                    <td>
                                        @if (count($List->all_listing->vehicles) === 1)
                                            @foreach ($List->all_listing->vehicles as $vehcile)
                                                <a class="font-weight-bold text-dark"
                                                    href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                    target="_blank">
                                                    <span class="fs-5"><strong>
                                                            {{ $vehcile->Vehcile_Year }}{{ $vehcile->Vehcile_Make }}{{ $vehcile->Vehcile_Model }}
                                                        </strong></span></a><br>
                                                <span class="text-nowrap">
                                                    @if (!empty($vehcile->Vehcile_Condition))
                                                        {{-- <span class="badge bg-success text-white"
                                                    style="font-size: 16px;">{{ $vehcile->Vehcile_Condition }}</span> --}}
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
                                        @if (count($List->all_listing->vehicles) > 1)
                                            <a href="javascript:void(0)" tabindex="0" class=""
                                                data-toggle="popover" data-trigger="focus" style="cursor: pointer;"
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
                                                        {{ $vehcile->Trailer_Type }}
                                                    @endif @endforeach"
                                                data-html="true">vehicles
                                                ({{ count($List->all_listing->vehicles) }})
                                            </a>
                                        @endif
                                        @if (count($List->all_listing->heavy_equipments) === 1)
                                            @foreach ($List->all_listing->heavy_equipments as $vehcile)
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
                                                @if (!empty($vehcile->Equipment_Condition))
                                                    <span class="badge bg-success text-white"
                                                        style="font-size: 16px;">{{ $vehcile->Equipment_Condition }}</span>
                                                @endif
                                                @if (!empty($vehcile->Trailer_Type))
                                                    <span class="badge badge-primary " style="font-size: 16px;">
                                                        {{ $vehcile->Trailer_Type }}</span>
                                                @endif <br>
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
                                                            <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} | <b>H</b>{{ $vehcile->Equip_Height }} | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                                        @if (!empty($vehcile->Equipment_Condition))
                                                            <br>{{ $vehcile->Equipment_Condition }}<br>
                                                        @endif
                                                        @if (!empty($vehcile->Trailer_Type))
                                                            {{ $vehcile->Trailer_Type }}
                                                        @endif @endforeach"
                                                data-html="true">Equipments
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
                                            <a class="locations-color" href="javascript:void(0)" tabindex="0"
                                                class="" data-toggle="popover" data-trigger="focus"
                                                style="cursor: pointer;" title="Attached vehicles"
                                                data-content=
                                                    "@foreach ($List->all_listing->dry_vans as $vehcile)
                                                    {{ $vehcile->Freight_Class }}
                                                    {{ $vehcile->Freight_Weight }}<br>
                                                    @if ($vehcile->is_hazmat_Check !== 0)
                                                        Hazmat Required<br>
                                                    @endif @endforeach"
                                                data-html="true">Vehicles
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
                                        {{-- <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                        data-trigger="focus" style="cursor: pointer;" title="Additional Terms"
                                        data-content=
                                                "{{ !empty($List->all_listing->additional_info->Additional_Terms) ? $List->all_listing->additional_info->Additional_Terms : '' }}">
                                        {{ !empty($List->all_listing->additional_info->Additional_Terms) ? Str::limit($List->all_listing->additional_info->Additional_Terms, 20) : '...' }}</a> --}}
                                    </td>
                                    <td>
                                        @if ($List->all_listing->paymentinfo->Price_Pay_Carrier === '0')
                                            <strong>
                                                Job Price:
                                            </strong>
                                        @else
                                            <strong>Job Price:</strong><span>
                                                ${{ $List->all_listing->paymentinfo->Price_Pay_Carrier }}
                                            </span>
                                            <br />
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
                                        {{-- <span class="text-nowrap"><strong>Price to Pay: </strong>${{ $List->all_listing->paymentinfo->Price_Pay_Carrier }}</span>
                                        <br> --}}
                                        {{-- <strong>Assigned to:
                                        </strong>{{ $List->all_listing->dispatch_listing->waiting_users->usr_type }}
                                        <br> --}}
                                        {{-- <strong><a
                                            href="{{ route('View.Profile', $List->all_listing->dispatch_listing->waiting_users->id) }}"
                                            target="_blank">View
                                            MC</a>&nbsp;&nbsp;<a
                                            href="{{ route('View.Profile', $List->all_listing->dispatch_listing->waiting_users->id) }}"
                                            target="_blank">View DOT</a></strong> --}}

                                        {{-- @if (!empty($List->all_listing->request_broker->Offer_Price) && $List->all_listing->request_broker->Offer_Price !== 0)
                                        <span class="text-danger fs-5 text-nowrap">
                                            <strong>Bid Price: ${{ $List->all_listing->request_broker->Offer_Price }}</strong>
                                        </span><br>
                                        @endif --}}
                                        <span class="text-nowrap"><strong>Pay Mode:</strong>
                                            {{ !empty($List->all_listing->paymentinfo->COD_Method_Mode) ? $List->all_listing->paymentinfo->COD_Method_Mode : '' }}
                                            {{-- On
                                            {{ !empty($List->all_listing->paymentinfo->COD_Location_Amount) ? $List->all_listing->paymentinfo->COD_Location_Amount : '' }} --}}
                                            </span><br>

                                            <span class="text-nowrap"><strong>Miles:
                                            </strong>{{ $List->all_listing->routes->Miles }}miles</span><br>
                                        <span class="text-nowrap"><strong>Price per Mile:
                                            </strong>${{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}/miles</span>
                                        {{-- {{ $List->all_listing->routes->Miles }} miles |
                                        ${{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}
                                        /miles --}}
                                    </td>
                                    <td>
                                        {{-- <strong>Created At:</strong><br>
                                            {{ $List->all_listing->created_at }}<br> --}}
                                        {{-- <strong>Modified At:</strong><br><span
                                        class="text-nowrap">{{ $List->updated_at }}</span><br>
                                        <strong>PickUp:</strong><br><span
                                        class="text-nowrap">{{ $List->all_listing->pickup_delivery_info->Pickup_Date }}
                                        ({{ $List->all_listing->pickup_delivery_info->Pickup_Date_mode }})</span>
                                        <br>
                                        <strong>Delivery:</strong><br><span class="text-nowrap">
                                        @if ($List->all_listing->pickup_delivery_info->Delivery_Date_mode === 'ASAP')
                                            ({{ $List->all_listing->pickup_delivery_info->Delivery_Date_mode }})
                                        @else
                                            {{ $List->all_listing->pickup_delivery_info->Delivery_Date }}
                                        @endif
                                        </span> --}}
                                        <strong>Pickup:</strong><br>{{ \Carbon\Carbon::parse($List->all_listing->pickup_delivery_info->Pickup_Date)->format('d M, Y') }}
                                        <br>
                                        <strong>Delivery:</strong><br>
                                        {{ \Carbon\Carbon::parse($List->all_listing->pickup_delivery_info->Delivery_Date)->format('d M, Y') }}
                                        <br>
                                        <strong>Dispatch:</strong><br>{{ $List->created_at }}
                                    </td>
                                    <td>
                                        {{-- <h6>Status: <span
                                                    class="badge badge-primary">{{ $List->all_listing->Listing_Status }}</span>
                                            </h6><br> --}}
                                        {{-- <div class="dropdown show list-actions">
                                                <a class="btn btn-success dropdown-toggle btn-sm" href="#"
                                                role="button" data-toggle="dropdown" aria-haspopup="true">
                                                    Actions
                                                </a>

                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                    href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                    target="_blank">View Route</a>
                                                    <a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                                    class="dropdown-item" role="button">View Detail</a>
                                                    <a data-toggle="modal"
                                                    data-target="#CancelOrderModal" href="javascript:void(0);"
                                                    class="dropdown-item Cancel_Order" role="button">
                                                        <input hidden type="text" class="Listed-ID"
                                                            value="{{ $List->all_listing->id }}">
                                                        <input hidden type="text" class="User-ID"
                                                            value="{{ $List->all_listing->user_id }}">
                                                        <input hidden type="text" class="CMP-ID"
                                                            value="{{ $List->all_listing->dispatch_listing->waiting_users->id }}">
                                                        <input hidden type="text" class="Order-Status"
                                                            value="{{ $List->all_listing->Listing_Status }}">
                                                        Cancel Order</a>
                                                    <a class="dropdown-item compare-listing" data-toggle="modal"
                                                    data-target="#CompareListing" href="javascript:void(0);">
                                                        <input hidden type="text" class="Listed-ID"
                                                            value="{{ $List->all_listing->id }}">
                                                        <input hidden type="text" class="Listed-Type"
                                                            value="{{ $List->all_listing->Listing_Type }}">
                                                        <input hidden type="text" class="Listed-Miles"
                                                            value="{{ $List->all_listing->routes->Miles }}">
                                                        Compare Listing</a>
                                                    @if ($List->all_listing->user_id !== $currentUser->id)
                                                        <a href="{{ route('Order.Pickup.Approval', ['List_ID' => $List->all_listing->id]) }}"
                                                        class="dropdown-item" role="button">PickUp</a>
                                                    @endif
                                                    @if ($List->all_listing->user_id === $currentUser->id)
                                                        <a class="dropdown-item"
                                                        href="{{ route('User.Edit.Listing', ['List_ID' => $List->all_listing->id]) }}">Edit
                                                            Listing</a>
                                                        <!-- <a class="dropdown-item"
                                                        href="{{ route('Order.Pickup.Approval', ['List_ID' => $List->all_listing->id]) }}">PickUp</a> -->
                                                        <form action="{{ route('Order.Pickup', ['List_ID' => $List->all_listing->id]) }}" method="POST" class="was-validated"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <a class="dropdown-item"
                                                            href="{{ route('Order.Pickup', ['List_ID' => $List->all_listing->id]) }}">Pick Up</a>
                                                        </form>
                                                        <a class="dropdown-item"
                                                        href="{{ route('Order.Not.Pickup.Approval', ['List_ID' => $List->all_listing->id]) }}">Not
                                                            PickUp</a>
                                                        <a class="dropdown-item"
                                                        href="{{ route('User.Listing.Archive', ['List_ID' => $List->all_listing->id]) }}">Archive
                                                            Order</a>
                                                    @endif
                                                </div>
                                            </div> --}}
                                        {{-- <button class="btn btn-primary mb-2 w-100 d-block"
                                        href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                        target="_blank">View Route
                                        </button> --}}
                                        <button class="show-misc btn btn-outline-primary mb-2 w-100 d-block"
                                            data-toggle="modal" data-target="#ShowMisc" href="javascript:void(0);">
                                            <input hidden type="text" class="Listed-ID"
                                                value="{{ $List->all_listing->id }}">
                                            <input hidden type="text" class="Ref-ID"
                                                value="{{ $List->all_listing->Ref_ID }}">Show Misc. <span
                                                class="badges">({{ count($List->all_listing->miscellenous) }})</span></button>
                                        @if ($List->all_listing->user_id === $currentUser->id)
{{--                                            <form--}}
{{--                                                action="{{ route('Order.Pickup', ['List_ID' => $List->all_listing->id]) }}"--}}
{{--                                                method="GET" class="was-validated" enctype="multipart/form-data">--}}
{{--                                                @csrf--}}
{{--                                                <button class="btn btn-outline-primary mb-2 w-100 d-block"--}}
{{--                                                    href="{{ route('Order.Pickup', ['List_ID' => $List->all_listing->id]) }}">Picked--}}
{{--                                                    Up</button>--}}
{{--                                            </form>--}}

                                            {{-- <button class="btn btn-outline-primary mb-2 w-100 d-block"
                                                href="{{ route('Order.Not.Pickup.Approval', ['List_ID' => $List->all_listing->id]) }}">Not PickUp</button> --}}
                                        @endif
                                        <a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                            class="btn btn-outline-primary mb-2 w-100 d-block" role="button">View
                                            Details</a>
                                        @if ($List->all_listing->user_id === $currentUser->id)
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                                href="{{ route('User.Edit.Listing', ['List_ID' => $List->all_listing->id]) }}">Modify
                                                Listing</a>
                                        @endif
                                        <button data-toggle="modal" data-target="#CancelOrderModal"
                                            href="javascript:void(0);"
                                            class="btn btn-outline-primary mb-2 w-100 d-block Cancel_Order"
                                            role="button">
                                            <input hidden type="text" class="Listed-ID"
                                                value="{{ $List->all_listing->id }}">
                                            <input hidden type="text" class="User-ID"
                                                value="{{ $List->all_listing->user_id }}">
                                            <input hidden type="text" class="CMP-ID"
                                                value="{{ $List->all_listing->dispatch_listing->waiting_users->id }}">
                                            <input hidden type="text" class="Order-Status"
                                                value="{{ $List->all_listing->Listing_Status }}">
                                            Cancel Listing
                                        </button>

                                        @if ($List->all_listing->Listing_Status === 'Dispatch')
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap {{ isset($List->all_listing->dispatch_bol->id) ? '' : 'disabled-link' }}"
                                               href="{{ isset($List->all_listing->dispatch_bol->id) ? route('User.Bol.Listing', ['List_ID' => $List->all_listing->id]) : '#' }}">
                                                {{ isset($List->all_listing->dispatch_bol->id) ? 'View Bol' : 'Upload Bol' }}
                                            </a>
                                        @endif
                                        {{-- <button class="btn btn-outline-primary mb-2 w-100 d-block"
                                        href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                        target="_blank">Delivered
                                        </button> --}}
                                        <input hidden type="text" class="Listed-ID"
                                            value="{{ $List->all_listing->id }}">
                                        <input hidden type="text" class="Listed-Type"
                                            value="{{ $List->all_listing->Listing_Type }}">
                                        <input hidden type="text" class="Listed-Miles"
                                            value="{{ $List->all_listing->routes->Miles }}">
                                        {{-- <button class="btn btn-outline-primary mb-2 w-100 d-block compare-listing" data-toggle="modal"
                                                data-target="#CompareListing" href="javascript:void(0);">Compare Listing
                                            </button> --}}
                                        {{-- @if ($List->all_listing->user_id !== $currentUser->id)
                                                <button href="{{ route('Order.Pickup.Approval', ['List_ID' => $List->all_listing->id]) }}"
                                                class="btn btn-outline-primary mb-2 w-100 d-block" role="button">PickUp</button>
                                            @endif --}}
                                    </td>
                                </tr>
                            @endif
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
<!-- Add Bill of Lading Modal -->
<div class="modal fade" id="AttachBill" data-backdrop="true" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Bill of Lading For Current Order. <span class="get_Order_ID"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body user-settings-box">
                <form action="{{ route('Attach.BOL.Pickup') }}" method="POST" class="was-validated"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="customControlValidation2"
                                    name="is_person_available" value="Pickup Person" checked>
                                <label class="custom-control-label" for="customControlValidation2">Pickup
                                    Person</label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" class="custom-control-input" id="customControlValidation3"
                                    name="is_person_available" value="Driver Person">
                                <label class="custom-control-label" for="customControlValidation3">Driver /
                                    Carrier</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Odometer Reading</label>
                                <input type="number" class="form-control" name="Meter_Reading"
                                    placeholder="Enter Odometer Reading" min="0" autocomplete="off">
                                <div class="invalid-feedback">
                                    Enter Meter Reading
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Pickup Location</label>
                                <select class="custom-select" name="Pickup_Location">
                                    <option value="">Select AnyOne</option>
                                    <option value="Residence Location">Residence Location</option>
                                    <option value="Business Location">Business Location</option>
                                    <option value="Dealership">Dealership</option>
                                    <option value="Sea Port">Sea Port</option>
                                    <option value="Airport">Airport</option>
                                    <option value="COPART Auction">COPART Auction</option>
                                    <option value="Mannheim Auction">Mannheim Auction</option>
                                    <option value="IAAI Auction">IAAI Auction</option>
                                    <option value="Other">Other</option>
                                </select>
                                <div class="invalid-feedback">
                                    Select Any Location.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Pickup Person</label>
                                <input type="text" class="form-control" name="Pickup_Person"
                                    placeholder="Enter Full Name" required="" autocomplete="off">
                                <div class="invalid-feedback">
                                    Enter Full Name
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" class="form-control phone-number" name="Pickup_Phone"
                                    placeholder="Enter Phone Number" required="" autocomplete="off">
                                <div class="invalid-feedback">
                                    Enter Phone Number
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label>Upload Document(s)</label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="Bill_Of_Lading[]" multiple>
                                    <label class="custom-file-label">Upload File</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Your Name</label>
                                <input type="text" class="form-control" placeholder="Enter Your Full Name"
                                    name="BOL_Name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Your Signature</label>
                                <input type="text" class="form-control" placeholder="Enter Your Signature"
                                    name="BOL_Sign" id="signature" required>
                            </div>
                        </div>
                    </div>
                    <div id="signatures"></div>
                    <div class="form-group form-check mt-3">
                        <input type="checkbox" class="form-check-input" id="deposit_Check" required>
                        <label class="form-check-label" for="deposit_Check"><b>I have read and accept the Terms &
                                Conditions
                                for this transport. (Click the plus sign above to view.) *</b></label>
                    </div>

                    <input hidden type="text" name="get_Listed_ID" class="get_Listed_ID" value="">
                    <input hidden type="text" name="Bol_Type" class="get_Bol_Type" value="On PickUp">
                    <div class="col-lg-12">
                        <div class="btn-box text-center">
                            <button type="submit" class="submit-btn w-100"><i class='bx bx-save'></i>
                                Upload Bill of Lading
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $("#Search_vehicleType").on("change", function() {
        $('#Search_vehicleType_form').submit();
    });
    // $('.advance-6').DataTable({
    //     "deferRender": true,
    // });
    // $(document).ready(function() {
    //     console.log("Document is ready");
    //     if ($.fn.dataTable.isDataTable('.advance-6')) {
    //         console.log("DataTable is already initialized on .advance-6");
    //         var table = $('.advance-6').DataTable();
    //         console.log("Destroying the existing DataTable instance");
    //         table.destroy();
    //     } else {
    //         console.log("DataTable is not initialized on .advance-6, proceeding with initialization");
    //     }
    //     console.log("Reinitializing DataTable with specified options");
    //     $('.advance-6').DataTable({
    //         "deferRender": true,
    //         "searching": false,
    //         "info": false,
    //         "lengthMenu": [
    //             [50, 100, 150, 200, 250],
    //             [50, 100, 150, 200, 250]
    //         ],
    //     });
    //     console.log("DataTable reinitialization complete");
    // });
</script>
