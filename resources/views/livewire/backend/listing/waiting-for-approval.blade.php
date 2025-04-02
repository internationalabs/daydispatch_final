@section('Waitings', 'mm-active')
@php
    use Illuminate\Support\Facades\Auth;
    $currentUser = Auth::guard('Authorized')->user();
@endphp
@php
    use Illuminate\Support\Str;
@endphp
<div class="breadcrumb-area">
    <h1>{{ $currentUser->usr_type }} Listing</h1>
    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>
        <li class="item">Waiting's</li>
    </ol>
</div>
@include('partials.global-search')
<div class="card">
    <div class="card-body">
        @if ($currentUser->usr_type === 'Carrier')
            <div class="table-responsive">
                {{-- <table>
                    <tbody class="dataTables_filter">
                    <tr>
                        <form class="nav-search-form d-none ml-auto d-md-block" method="POST" action="{{ route('User.Company.Search') }}">
                            @csrf
                            <td><strong>Search For: </strong></td>
                            <td>
                                <select class="form-control ml-1" id="Search_Criteria" name="Search_Criteria">
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
                                <input class="form-control" id="Search_Value" placeholder="Enter Search Value"
                                type="search" name="Search_Value">
                                <div id="hiddenDiv">
                                    <input type="text" class="form-control d-none" id="hiddenValueinput" required>
                                </div>
                            </td>
                        </form>
                    </tr>
                    </tbody>
                </table> --}}
                {{-- <table>
                    <tbody class="dataTables_filter">
                        <tr>
                            <td><strong>Search Vehicle Type: </strong></td>
                            <td>
                                <form id="Search_vehicleType_form" action="{{ route('Waitings.Listing') }}">
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
                </table> --}}
                {{-- @include('partials.global-search') --}}
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
                            <th>Payments</th>
                            <th>Dates</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Lisiting as $List)
                            <tr class="card-row" data-status="active">
                                <td>
                                    <div><span class="badge badge-pill badge-primary">Waiting Approval</span></div>
                                    <span
                                        style="font-size: x-large;"><strong>{{ $List->all_listing->Ref_ID }}</strong></span><br>
                                    @if (count($List->all_listing->attachments) > 0)
                                        <strong><a
                                                href="{{ route('Order.Attachments', ['List_ID' => $List->all_listing->id]) }}"
                                                target="_blank">View Images</a></strong><br>
                                    @endif
                                    @if ($List->all_listing->user_id === $currentUser->id)
                                        {{-- <a class="btn mb-2 btn-primary w-75 btn-sm text-nowrap"
                                            href="{{ route('User.Listing.Archive', ['List_ID' => $List->all_listing->id]) }}">Archive Order</a> --}}
                                        <button class="btn btn-dark text-white"
                                            onclick="window.location.href='{{ route('User.Listing.Archive', ['List_ID' => $List->all_listing->id]) }}'">
                                            <i class="fas fa-archive text-white"></i>
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    {{-- <span style="font-size: x-large; "><a
                                            href="{{ route('View.Profile', $List->all_listing->authorized_user->id) }}"
                                            target="_blank"><strong>{{ $List->all_listing->authorized_user->Company_Name }}</strong></a></span><br>
                                    {{ $List->all_listing->authorized_user->Contact_Phone }}<br>
                                    {{ $List->all_listing->authorized_user->Hours_Operations }}<br>
                                    {{ $List->all_listing->authorized_user->Time_Zone }}<br> --}}

                                    {{-- {{ dd($List->all_listing->authorized_user->toArray(), $this->orderRatings->getUserRating($List->all_listing->authorized_user->id)->toArray(), $this->orderRatings->getUserRatingRecords($List->all_listing->authorized_user->id)->count()) }} --}}
                                    @php
                                    $companyName =  $List->all_listing->authorized_user->Company_Name;
                                    $trimmedCompanyName = Str::words($companyName, 3, '...'); // 4 words tak limit
                                @endphp
                                    <span style="font-size: x-large; "><strong><a target="_blank"
                                                class="locations-color"
                                                href="{{ route('View.Profile', $List->all_listing->authorized_user->id) }}"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="{{ $companyName }}">
                                                {{$trimmedCompanyName}}
                                            </a>
                                        </strong></span><br>
                                    {{-- <span>
                                        <strong>Contact:</strong>{{ $List->all_listing->authorized_user->Contact_Phone }}
                                    </span><br>
                                    <strong>Email:</strong>{{ $List->all_listing->authorized_user->email }}
                                    </span> --}}
                                    <span>
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
                                    <br>
                                    <strong>Time:</strong>
                                    {{ $List->all_listing->authorized_user->Hours_Operations }}
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
                                                    class="fa fa-star fa-fade  {{ $i <= $avg_rating ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                            {{ number_format($avg_rating, 1) }}
                                            <a href="">({{ $ratingsCount }})</a>
                                        </div>
                                    @else
                                        <span>No ratings yet.</span>
                                    @endif <br>
                                    <span class="badge badge-pill badge-success" style="cursor:pointer;"
                                        onclick="window.open('{{ route('chat', $List->user_id) }}', '_blank')">
                                        Message Broker
                                    </span>
                                </td>
                                <td>
                                    <span style="font-size: large;"><strong>Pickup:</strong></span><br>
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
                                        <span class="fs-5"><strong>
                                                <a class="btn btn-outline-primary text-decoration-none fw-bold"
                                                    href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                    target="_blank">View Route</a></strong></span>
                                    </div>
                                </td>
                                <td>
                                    @if (count($List->all_listing->vehicles) === 1)
                                        @foreach ($List->all_listing->vehicles as $vehcile)
                                            <span style="font-size: large; "><a class="font-weight-bold text-dark"
                                                    href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                    target="_blank"><strong>{{ $vehcile->Vehcile_Year }}
                                                        {{ $vehcile->Vehcile_Make }}
                                                        {{ $vehcile->Vehcile_Model }}
                                                        ({{ $vehcile->Vehcile_Type }})</strong></a>
                                            </span><br>
                                            <span class="text-nowrap">
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
                                            </span>
                                        @endforeach
                                    @endif
                                    @if (count($List->all_listing->vehicles) > 1)
                                        <div class="dropdown">
                                            <a href="javascript:void(0)"
                                                class="dropdown-toggle font-weight-bold d-inline-flex align-items-center text-dark text-decoration-none"
                                                data-toggle="dropdown"
                                                style="font-size: 21px; cursor: pointer;">Vehicles({{ count($List->all_listing->vehicles) }})
                                            </a>
                                            <div class="dropdown-menu text-center"
                                                style="max-height: 200px; overflow-y: auto;">
                                                <h6 class="dropdown-header" style="background-color: lightgrey;">
                                                    Attached Vehicles</h6>
                                                @foreach ($List->all_listing->vehicles as $vehcile)
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
                                    @if (count($List->all_listing->heavy_equipments) === 1)
                                        @foreach ($List->all_listing->heavy_equipments as $vehcile)
                                            <a>
                                                {{ $vehcile->Equipment_Year }}
                                                {{ $vehcile->Equipment_Make }}
                                                {{ $vehcile->Equipment_Model }} </a><br>
                                            <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }}
                                            | <b>H</b>{{ $vehcile->Equip_Height }}
                                            | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                            @if (!empty($vehcile->Equipment_Condition))
                                                <br><span
                                                    class="badge badge-success text-white badge-pill mb-1">{{ $vehcile->Equipment_Condition }}</span><br>
                                            @endif
                                            @if (!empty($vehcile->Trailer_Type))
                                                <span
                                                    class="badge badge-primary text-white badge-pill">{{ $vehcile->Trailer_Type }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                    @if (count($List->all_listing->heavy_equipments) > 1)
                                        <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                            data-trigger="focus" style="cursor: pointer;" title="Attached vehicles"
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
                                            (<span>{{ count($List->all_listing->heavy_equipments) }}</span>)
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
                                            data-html="true">Vehicles
                                            ({{ count($List->all_listing->dry_vans) }})
                                        </a>
                                    @endif
                                    <div class="dropdown mt-3 d-block">
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
                                        </span>
                                    @endif
                                    <br />
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
                                    {{-- <strong>Price to Pay:</strong><span> ${{ $List->all_listing->paymentinfo->Price_Pay_Carrier }}</span><br> --}}
                                    <span class="text-nowrap"><strong>Pay Mode: </strong>
                                        {{ !empty($List->all_listing->paymentinfo->COD_Method_Mode) ? $List->all_listing->paymentinfo->COD_Method_Mode : '' }}
                                        {{-- On
                                        {{ !empty($List->all_listing->paymentinfo->COD_Location_Amount) ? $List->all_listing->paymentinfo->COD_Location_Amount : '' }} --}}
                                        <br>
                                        <strong>Mile:</strong>{{ $List->all_listing->routes->Miles }}miles<br>
                                        <strong>Price per Mile:</strong>
                                        ${{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}/miles
                                        {{-- {{ $List->all_listing->routes->Miles }} miles |
                                    ${{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}
                                    /miles --}}
                                </td>
                                <td>
                                    {{-- <strong>Created At:</strong>
                                    {{ $List->all_listing->created_at }}<br>
                                    <strong>Modified At:</strong>
                                    {{ $List->all_listing->updated_at }}<br> --}}

                                    <strong>Pickup:</strong><br>
                                    <span
                                        class="text-nowrap">{{ \Carbon\Carbon::parse($List->all_listing->pickup_delivery_info->Pickup_Date)->format('d M, Y') }}</span>
                                    <br>
                                    <strong>Delivery:</strong><br><span class="text-nowrap">
                                        {{ \Carbon\Carbon::parse($List->all_listing->pickup_delivery_info->Delivery_Date)->format('d M, Y') }}</span><br>
                                    <strong>Requested Date:</strong><br><span class="text-nowrap">
                                        {{ \Carbon\Carbon::parse($List->created_at)->format('d M, Y') }}</span>

                                    {{-- <strong>Pickup:</strong>{{ $List->all_listing->pickup_delivery_info->Pickup_Date }}
                                    <br>
                                    <strong>Delivery:</strong>
                                    {{ $List->all_listing->pickup_delivery_info->Delivery_Date }}
                                    <br>
                                    <strong>Dispatch Date:</strong>
                                    {{ $List->created_at }} --}}
                                </td>
                                <td>
                                    {{-- <h6>Status: <span class="badge badge-warning">Waiting</span>
                                    </h6>
                                    <br> --}}
                                    {{-- <div class="dropdown show list-actions">
                                        <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true">
                                            Actions
                                        </a>
                                        <div class="dropdown-menu"> --}}
                                    {{-- <div class="row d-block"> --}}
                                    <a href="{{ route('Order.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                        target="_blank" class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                        role="button">Accept Offer</a>
                                    {{-- <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                        href="{{ route('User.Cancel.Request', ['List_ID' => $List->all_listing->id]) }}">Decline
                                        Request</a> --}}
                                    <a data-toggle="modal" data-target="#CancelWaitingOrderModal"
                                        href="javascript:void(0);"
                                        class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap Cancel_Waiting_Order"
                                        role="button">
                                        <input hidden type="text" class="Listed-ID"
                                            value="{{ $List->all_listing->id }}">
                                        <input hidden type="text" class="User-ID"
                                            value="{{ $List->all_listing->user_id }}">
                                        <input hidden type="text" class="CMP-ID"
                                            value="{{ $List->all_listing->waitings->waiting_users->id }}">
                                        <input hidden type="text" class="Order-Status"
                                            value="{{ $List->all_listing->Listing_Status }}">
                                        Decline Request</a>
                                    <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                        href="#">Request
                                        changes S</a>
                                    <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                        href="#">View Load
                                        Details S</a>
                                    <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                        data-toggle="modal" data-target="#CompareListing" href="javascript:void(0);">
                                        <input hidden type="text" class="Listed-ID"
                                            value="{{ $List->all_listing->id }}">
                                        <input hidden type="text" class="Listed-Type"
                                            value="{{ $List->all_listing->Listing_Type }}">
                                        <input hidden type="text" class="Listed-Miles"
                                            value="{{ $List->all_listing->routes->Miles }}">
                                        Compare Listing</a>
                                    @if ($List->all_listing->user_id === $currentUser->id)
                                        <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                            href="{{ route('User.Edit.Listing', ['List_ID' => $List->all_listing->id]) }}">Modify
                                            Listing</a>
                                        <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                            href="{{ route('User.Listing.Archive', ['List_ID' => $List->all_listing->id]) }}">Archive
                                            Order</a>
                                    @endif
                                    {{-- </div> --}}
                                    {{-- </div> --}}
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
                {{-- <table>
                        <tbody class="dataTables_filter">
                        <tr>
                            <form class="nav-search-form d-none ml-auto d-md-block" method="POST" action="{{ route('User.Company.Search') }}">
                                @csrf
                                <td><strong>Search For: </strong></td>
                                <td>
                                    <select class="form-control ml-1" id="Search_Criteria" name="Search_Criteria">
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
                                    <input class="form-control" id="Search_Value" placeholder="Enter Search Value"
                                    type="search" name="Search_Value">
                                    <div id="hiddenDiv">
                                        <input type="text" class="form-control d-none" id="hiddenValueinput" required>
                                    </div>
                                </td>
                            </form>
                        </tr>
                        </tbody>
                    </table> --}}
                {{--    <table>
                        <tbody class="dataTables_filter">
                            <tr>
                                <td><strong>Search Vehicle Type: </strong></td>
                                <td>
                                    <form id="Search_vehicleType_form" action="{{ route('Waitings.Listing') }}">
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
                    </table> --}}
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
                            <th style="width: 105px;">ID</th>
                            <th style="width: 250px;">Company info</th>
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
                                    <div><strong style="font-size: 14px;"></strong><br><span
                                            class="badge badge-pill badge-primary">Waiting Approval</span></div>
                                    <span
                                        style="font-size: x-large; "><strong>{{ $List->all_listing->Ref_ID }}</strong></span>
                                    <br>
                                    @if (count($List->all_listing->attachments) > 0)
                                        <strong>
                                            <a href="{{ route('Order.Attachments', ['List_ID' => $List->all_listing->id]) }}"
                                                target="_blank">View Images
                                            </a>
                                        </strong>
                                    @endif
                                    {{-- @if ($List->all_listing->user_id === $currentUser->id)
                                            <button class="btn btn-dark text-white"
                                                onclick="window.location.href='{{ route('User.Listing.Archive', ['List_ID' => $List->all_listing->id]) }}'">
                                                <i class="fas fa-archive text-white"></i>
                                            </button>
                                        @endif --}}
                                    {{-- @if ($List->all_listing->user_id === $currentUser->id)
                                            <button class="btn btn-dark text-white"
                                                href="{{ route('User.Listing.Archive', ['List_ID' => $List->all_listing->id]) }}"><i class="fas fa-archive text-white"></i></button>
                                        @endif --}}
                                    {{-- <strong>Ref-ID:</strong> --}}
                                    {{-- {{ $List->all_listing->routes->Miles }} miles |
                                        ${{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}
                                        /miles --}}
                                </td>
                                <td>
                                    {{-- <span style="font-size: x-large; ">
                                            <a target="_blank"
                                                href="{{ route('View.Profile', $List->all_listing->waitings->waiting_users->id) }}"><strong>{{ $List->all_listing->waitings->waiting_users->Company_Name }}</strong></a></span><br>
                                        <span><strong>Phone:</strong>(045) 454-4554
                                        </span><br>
                                        <strong>Email:</strong>ABC@123gmail.com
                                        </span><br>
                                        @if ($User_Rating && is_countable($User_Rating))
                                            <span>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i
                                                        class="fa fa-star {{ $i <= $avg_rating ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                            </span>
                                        @else
                                            <span>No ratings yet.</span><br>
                                        @endif --}}
                                    {{-- {{ dd($List->all_listing->authorized_user->toArray()) }} --}}
                                    {{-- <span style="font-size: x-large; "><strong><a target="_blank"
                                                    href="{{ route('View.Profile', $List->all_listing->authorized_user->id) }}">{{ $List->all_listing->authorized_user->Company_Name }}
                                                </a>
                                            </strong></span><br>
                                        <span>
                                            <strong>Contact:</strong>{{ $List->all_listing->authorized_user->Contact_Phone }}
                                        </span><br>
                                        <strong>Email:</strong>{{ $List->all_listing->authorized_user->email }}
                                        </span><br>
                                        <strong>Time:</strong>
                                        {{ $List->all_listing->authorized_user->Hours_Operations }}
                                        </span><br>
                                        @if (isset($List->all_listing->authorized_user->avg_rating))
                                            <div class="rating d-inline-block">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i
                                                        class="fa fa-star {{ $i <= $avg_rating ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                                {{ number_format($List->all_listing->authorized_user->avg_rating, 1) }}
                                                <a
                                                    href="">({{ $List->all_listing->authorized_user->ratings_count }})</a>
                                            </div>
                                        @else
                                            <span>No ratings yet.</span>
                                        @endif --}}
                                    @php
                                        $companyName = $List->all_listing->waitings->waiting_users->Company_Name;
                                        $trimmedCompanyName = Str::words($companyName, 3, '...'); 
                                    @endphp
                                    <span style="font-size: x-large;">
                                        <strong>
                                            <a target="_blank" class="locations-color"
                                                href="{{ route('View.Profile', $List->all_listing->waitings->waiting_users->id) }}"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ $companyName }}"> 
                                                {{ $trimmedCompanyName }}
                                            </a>
                                        </strong>
                                    </span><br>
                                    {{-- <span style="font-size: x-large; "><strong><a target="_blank" class="locations-color"
                                            href="{{ route('View.Profile', $List->all_listing->waitings->waiting_users->id) }}">{{ $List->all_listing->waitings->waiting_users->Company_Name }}
                                        </a>
                                    </strong></span><br> --}}
                                    {{-- <span>
                                            <strong>Contact:</strong>{{ $List->all_listing->waitings->waiting_users->Contact_Phone }}
                                        </span><br>
                                        <strong>Email:</strong>{{ $List->all_listing->waitings->waiting_users->email }}
                                        </span> --}}
                                    <span>
                                        <strong>Contact:</strong>
                                        <a class="locations-color"
                                            href="tel:{{ $List->all_listing->waitings->waiting_users->Contact_Phone }}">
                                            {{ $List->all_listing->waitings->waiting_users->Contact_Phone }}
                                        </a>
                                    </span><br>
                                    <span>
                                        <strong>Email:</strong>
                                        <a class="locations-color"
                                            href="mailto:{{ $List->all_listing->waitings->waiting_users->email }}">
                                            {{ $List->all_listing->waitings->waiting_users->email }}
                                        </a>
                                    </span>
                                    <br>
                                    <strong>Time:</strong>
                                    {{ $List->all_listing->waitings->waiting_users->Hours_Operations }}
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

                                        $userRatings = getUserRating($List->all_listing->waitings->waiting_users->id);
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
                                                    class="fa fa-star fa-fade {{ $i <= $avg_rating ? 'text-warning' : 'text-muted' }}"></i>
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
                                    <span style="font-size: large;"><strong>Pickup:</strong></span><br>
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
                                        <span class="fs-5"><strong>
                                                <a class="btn btn-outline-primary text-decoration-none fw-bold"
                                                    href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                    target="_blank">View Route</a></strong></span>
                                    </div>
                                </td>
                                <td>
                                    @if (count($List->all_listing->vehicles) === 1)
                                        @foreach ($List->all_listing->vehicles as $vehcile)
                                            <span style="font-size: large; "><a class="font-weight-bold text-dark"
                                                    href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                    target="_blank"><strong>{{ $vehcile->Vehcile_Year }}
                                                        {{ $vehcile->Vehcile_Make }}
                                                        {{ $vehcile->Vehcile_Model }}
                                                        ({{ $vehcile->Vehcile_Type }})</strong></a>
                                            </span>
                                            <div>
                                                @if (!empty($vehcile->Vehcile_Condition))
                                                    <span
                                                        class="badge badge-pill mt-2 @if ($vehcile->Vehcile_Condition == 'Running') badge-success @elseif($vehcile->Vehcile_Condition == 'Not Running') badge-danger @else badge-primary @endif"
                                                        style="font-size: 16px;">{{ $vehcile->Vehcile_Condition }}</span>
                                                @endif
                                                @if (!empty($vehcile->Trailer_Type))
                                                    <span class="badge badge-pill mt-2 badge-primary font-weight-bold"
                                                        style="font-size: 16px;">{{ $vehcile->Trailer_Type }}</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    @endif
                                    @if (count($List->all_listing->vehicles) > 1)
                                        <div class="dropdown">
                                            <a href="javascript:void(0)"
                                                class="dropdown-toggle font-weight-bold d-inline-flex align-items-center text-dark text-decoration-none"
                                                data-toggle="dropdown"
                                                style="font-size: 21px; cursor: pointer;">Vehicles({{ count($List->all_listing->vehicles) }})
                                            </a>
                                            <div class="dropdown-menu text-center"
                                                style="max-height: 200px; overflow-y: auto;">
                                                <h6 class="dropdown-header" style="background-color: lightgrey;">
                                                    Attached Vehicles</h6>
                                                @foreach ($List->all_listing->vehicles as $vehcile)
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
                                    @if (count($List->all_listing->heavy_equipments) === 1)
                                        @foreach ($List->all_listing->heavy_equipments as $vehcile)
                                            <p class="ymm"> {{ $vehcile->Equipment_Year }}
                                                {{ $vehcile->Equipment_Make }}
                                                {{ $vehcile->Equipment_Model }}</p><br>
                                            <b>L</b>{{ $vehcile->Equip_Length }} |
                                            <b>W</b>{{ $vehcile->Equip_Width }} |
                                            <b>H</b>{{ $vehcile->Equip_Height }}
                                            | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                            @if (!empty($vehcile->Equipment_Condition))
                                                <br><span>{{ $vehcile->Equipment_Condition }}</span><br>
                                            @endif
                                            @if (!empty($vehcile->Trailer_Type))
                                                <span> {{ $vehcile->Trailer_Type }}</span>
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
                                            data-html="true">Frieght Ship...
                                            ({{ count($List->all_listing->dry_vans) }})
                                        </a>
                                    @endif
                                    <div class="dropdown mt-3 d-block">
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
                                        </span>
                                    @endif
                                    <br />
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
                                    <span class="text-nowrap"><strong>Pay Mode: </strong>
                                        {{ !empty($List->all_listing->paymentinfo->COD_Method_Mode) ? $List->all_listing->paymentinfo->COD_Method_Mode : '' }}
                                        {{-- On
                                        {{ !empty($List->all_listing->paymentinfo->COD_Location_Amount) ? $List->all_listing->paymentinfo->COD_Location_Amount : '' }} --}}
                                        <br>
                                    {{-- <span class="text-nowrap"><strong>Price to Pay: </strong>${{ $List->all_listing->paymentinfo->Price_Pay_Carrier }}</span><br> --}}
                                    {{-- <strong>Assigned to:</strong>{{ $List->all_listing->waitings->waiting_users->usr_type }}<br> --}}
                                    {{-- <strong><a
                                                href="{{ route('View.Profile', $List->all_listing->waitings->waiting_users->id) }}"
                                                target="_blank">View
                                                Price to Pay:
                                                href="{{ route('View.Profile', $List->all_listing->waitings->waiting_users->id) }}"
                                                target="_blank">View DOT</a></strong> --}}
                                    {{-- @if (!empty($List->all_listing->request_broker->Offer_Price) && $List->all_listing->request_broker->Offer_Price !== 0)
                                    <span class="text-danger fs-5 text-nowrap">
                                        <strong>Bid Price: ${{ $List->all_listing->request_broker->Offer_Price }}</strong>
                                    </span><br>
                                @endif  --}}
                                    <strong>Mile:</strong>{{ $List->all_listing->routes->Miles }}miles<br>
                                    <strong>Price per Mile:</strong>
                                    ${{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}/miles
                                    {{-- {{ $List->all_listing->routes->Miles }} miles |
                                        ${{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}
                                        /miles --}}
                                </td>
                                <td>
                                    {{-- <strong>Created At:</strong>
                                        {{ $List->all_listing->created_at }}<br>
                                        <strong>Modified At:</strong>
                                        {{ $List->all_listing->updated_at }} <br> --}}
                                    <strong>Pickup:</strong><br>{{ \Carbon\Carbon::parse($List->all_listing->pickup_delivery_info->Pickup_Date)->format('d M, Y') }}
                                    <br>
                                    <strong>Delivery:</strong><br>
                                    {{ \Carbon\Carbon::parse($List->all_listing->pickup_delivery_info->Delivery_Date)->format('d M, Y') }}
                                    <br>
                                    <strong>Dispatch:</strong><br>{{ \Carbon\Carbon::parse($List->created_at)->format('d M, Y') }}
                                </td>
                                <td>
                                    {{-- <div class="row d-block"> --}}
                                    {{-- <button class="btn mb-2 btn-primary w-50 btn-sm text-nowrap"
                                            href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                            target="_blank">View Route</button> --}}
                                    {{-- <a class="btn mb-2 btn-primary w-75 btn-sm text-nowrap"
                                                href="{{ route('User.Cancel.Request', ['List_ID' => $List->all_listing->id]) }}">Cancel
                                                Request</a> --}}
                                    <a data-toggle="modal" data-target="#CancelWaitingOrderModal"
                                        href="javascript:void(0);"
                                        class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap Cancel_Waiting_Order"
                                        role="button">
                                        <input hidden type="text" class="Listed-ID"
                                            value="{{ $List->all_listing->id }}">
                                        <input hidden type="text" class="User-ID"
                                            value="{{ $List->all_listing->user_id }}">
                                        <input hidden type="text" class="CMP-ID"
                                            value="{{ $List->all_listing->waitings->waiting_users->id }}">
                                        <input hidden type="text" class="Order-Status"
                                            value="{{ $List->all_listing->Listing_Status }}">
                                        Cancel Order</a>
                                    {{-- <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('chat', $List->CMP_id) }}">Message Carrier</a> --}}
                                    <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                        href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}">View
                                        Details</a>
                                    <button data-email="{{ $List->all_listing->waitings->waiting_users->email }}"
                                        data-list-id="{{ $List->all_listing->id }}"
                                        class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap Remind-Carrier">
                                        Remind Carrier
                                    </button>
                                    {{-- <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}">View Details</a> --}}
                                    @if ($List->all_listing->user_id !== $currentUser->id)
                                        <a href="{{ route('Order.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                            target="_blank"
                                            class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                            role="button">View Offer</a>
                                    @endif
                                    @if ($List->all_listing->user_id === $currentUser->id)
                                        <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                            href="{{ route('User.Edit.Listing', ['List_ID' => $List->all_listing->id]) }}">Modify
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
                                        data-toggle="modal" data-target="#CompareListing" href="javascript:void(0);">
                                        <input hidden type="text" class="Listed-ID"
                                            value="{{ $List->all_listing->id }}">
                                        <input hidden type="text" class="Listed-Type"
                                            value="{{ $List->all_listing->Listing_Type }}">
                                        <input hidden type="text" class="Listed-Miles"
                                            value="{{ $List->all_listing->routes->Miles }}">
                                        Compare Listing</button>
                                    {{-- <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="#">View BOL(s)</a>
                                                <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="#">Add Misc. Charge(s)</a> --}}
                                    {{-- </div> --}}
                                    {{-- <h6>Status: <span class="badge badge-primary">Waiting</span></h6><br> --}}
                                    {{-- <div class="dropdown show list-actions">
                                    <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true">
                                        Actions
                                    </a>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                        href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                        target="_blank">View Route</a>
                                        <a class="dropdown-item"
                                        href="{{ route('User.Cancel.Request', ['List_ID' => $List->all_listing->id]) }}">Cancel
                                            Request</a>
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
                                            <a href="{{ route('Order.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                            target="_blank" class="dropdown-item" role="button">View Offer</a>
                                        @endif
                                        @if ($List->all_listing->user_id === $currentUser->id)
                                            <a class="dropdown-item"
                                            href="{{ route('User.Edit.Listing', ['List_ID' => $List->all_listing->id]) }}">Edit
                                                Listing</a>
                                            <a class="dropdown-item"
                                            href="{{ route('User.Listing.Archive', ['List_ID' => $List->all_listing->id]) }}">Archive
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
        @endif
    </div>
</div>
<script>
    $("#Search_vehicleType").on("change", function() {
        // console.log($(this).val());
        $('#Search_vehicleType_form').submit();
        // console.log(url);
    });
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
