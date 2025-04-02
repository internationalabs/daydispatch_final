@section('PickUp', 'mm-active')
<!-- Breadcrumb Area -->
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

        <li class="item">PickUps</li>
    </ol>

</div>
<!-- End Breadcrumb Area -->
@include('partials.global-search')
<div class="card">
    <div class="card-body">
        @if ($currentUser->usr_type === 'Carrier')
            <div class="table-responsive dataTables_wrapper me-0 d-flex">
                <div class="col-lg-6 col-md-6 col-sm-12">
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
                <table class="display dataTable advance-68 text-center table-1 table-bordered table-cards">
                    <thead class="table-header">
                        <tr>
                            <th>ID</th>
                            {{-- <th class="d-none"></th> --}}
                            <th>Company Info</th>
                            <th>Routes</th>
                            <th>Load Details</th>
                            <th>Payment</th>
                            <th>Dates</th>
                            {{-- <th>Listing Dates</th> --}}
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Lisiting as $List)
                            {{-- {{ dd($List->toArray(), $List->all_listing->Listing_Status) }} --}}
                            <tr class="card-row" data-status="active">
                                <td>
                                    <div><span
                                            class="badge badge-pill badge-primary">{{ $List->all_listing->Listing_Status }}</span>
                                    </div>
                                    <span
                                        style="font-size: x-large;"><strong>{{ $List->all_listing->Ref_ID }}</strong></span><br>
                                    @if (count($List->all_listing->attachments) > 0)
                                        <strong><a
                                                class="text-nowrap"href="{{ route('Order.Attachments', ['List_ID' => $List->all_listing->id]) }}"
                                                target="_blank">View Images</a></strong><br>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $companyName = $List->all_listing->authorized_user->Company_Name;
                                        $trimmedCompanyName = Str::words($companyName, 3, '...');
                                    @endphp

                                    <span style="font-size: x-large;">
                                        <a class="locations-color"
                                            href="{{ route('View.Profile', $List->all_listing->authorized_user->id) }}"
                                            target="_blank" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="{{ $companyName }}">
                                            <strong>{{ $trimmedCompanyName }}</strong>
                                        </a>
                                    </span><br>
                                    {{-- <span style="font-size: x-large; "><a class="locations-color"
                                            href="{{ route('View.Profile', $List->all_listing->authorized_user->id) }}"
                                            target="_blank"><strong>{{ $List->all_listing->authorized_user->Company_Name }}</strong></a></span><br> --}}
                                    {{-- Ph no:{{ $List->all_listing->authorized_user->Contact_Phone }}<br>
                                    Hours:{{ $List->all_listing->authorized_user->Hours_Operations }}<br>
                                    Timezone:{{ $List->all_listing->authorized_user->Time_Zone }}<br> --}}
                                    {{-- <span>
                                        <strong>Contact:</strong>{{ $List->all_listing->authorized_user->Contact_Phone }}
                                    </span><br>
                                    <strong>Email:</strong>{{ $List->all_listing->authorized_user->email }}
                                    </span> --}}
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
                                    <br>
                                    <strong>Time:</strong> {{ $List->all_listing->authorized_user->Hours_Operations }}
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
                                        Message Broker
                                    </span>
                                    {{-- <a class="btn btn-primary mb-2 w-100 d-block text-nowrap"
                                        href="{{ route('chat', $List->CMP_id) }}">Message Carrier</a> --}}
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
                                                        {{ $vehcile->Vehcile_Model }}</strong></a></span><br>
                                            <span class="text-nowrap">
                                                @if (!empty($vehcile->Vehcile_Condition))
                                                    <span
                                                        class="badge badge-pill @if ($vehcile->Vehcile_Condition == 'Running') badge-success @elseif($vehcile->Vehcile_Condition == 'Not Running') badge-danger @else badge-primary @endif"
                                                        style="font-size: 16px;">
                                                        {{ $vehcile->Vehcile_Condition }}
                                                    </span>
                                                @endif
                                                @if (!empty($vehcile->Trailer_Type))
                                                    <span class="badge badge-pill badge-primary font-weight-bold"
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
                                            <p class="ymm"> {{ $vehcile->Equipment_Year }}
                                                {{ $vehcile->Equipment_Make }}
                                                {{ $vehcile->Equipment_Model }}</p><br>
                                            <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }}
                                            | <b>H</b>{{ $vehcile->Equip_Height }}
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
                                            data-html="true">Vehicles
                                            ({{ count($List->all_listing->dry_vans) }})
                                        </a>
                                    @endif
                                    <br>
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
                                    <br>
                                    @if ($List->all_listing->paymentinfo->COD_Amount === '0')
                                        <strong>
                                            Pay On Pickup:
                                        </strong>
                                        <br />
                                        <strong>
                                            Pay On Delivery:
                                        </strong>
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
                                    {{-- <span class="text-nowrap"> --}}
                                        {{-- <strong>Price to Pay:</strong>
                                        ${{ $List->all_listing->paymentinfo->Price_Pay_Carrier }}</span> --}}
                                        <span class="text-nowrap">
                                        <strong>Pay Mode:</strong><span
                                            class="text-nowrap">{{ !empty($List->all_listing->paymentinfo->COD_Method_Mode) ? $List->all_listing->paymentinfo->COD_Method_Mode : '' }}</span></span><br>
                                    {{-- <span class="text-nowrap">
                                        <strong>COD Location Amount:</strong><br><span
                                            class="text-nowrap">{{ !empty($List->all_listing->paymentinfo->COD_Location_Amount) ? $List->all_listing->paymentinfo->COD_Location_Amount : '' }}</span></span> --}}
                                        {{-- {{ !empty($List->all_listing->paymentinfo->COD_Method_Mode) ? $List->all_listing->paymentinfo->COD_Method_Mode : '' }}
                                    On
                                    {{ !empty($List->all_listing->paymentinfo->COD_Location_Amount) ? $List->all_listing->paymentinfo->COD_Location_Amount : '' }} --}}
                                        <strong>Mile: </strong>{{ $List->all_listing->routes->Miles }}/miles<br>
                                        <strong>Price per Mile:</strong>
                                        ${{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}/miles


                                        {{-- <span class="text-nowrap">
                                        {{ $List->all_listing->routes->Miles }} miles |
                                        ${{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}
                                        /miles</span> --}}
                                </td>
                                <td>
                                    <span class="text-nowrap">
                                        {{-- <strong>Pickup:</strong>
                                    {{ $List->all_listing->pickup_delivery_info->Pickup_Date }}
                                    ({{ $List->all_listing->pickup_delivery_info->Pickup_Date_mode }})</span>
                                    <br><span class="text-nowrap">
                                    <strong>Delivery:</strong>
                                    @if ($List->all_listing->pickup_delivery_info->Delivery_Date_mode === 'ASAP')
                                        ({{ $List->all_listing->pickup_delivery_info->Delivery_Date_mode }})
                                    @else
                                        {{ $List->all_listing->pickup_delivery_info->Delivery_Date }}
                                    @endif </span><br><span class="text-nowrap">
                                    <strong>Created At:</strong>
                                    {{ $List->created_at }}</span><br><span class="text-nowrap">
                                    <strong>Modified At:</strong>
                                    {{ $List->updated_at }}</span> --}}
                                        <strong>Pickup:</strong><br>{{ \Carbon\Carbon::parse($List->all_listing->pickup_delivery_info->Pickup_Date)->format('d M, Y') }}
                                        <br>
                                        <strong>Delivery:</strong><br>
                                        {{ \Carbon\Carbon::parse($List->all_listing->pickup_delivery_info->Delivery_Date)->format('d M, Y') }}
                                        <br>
                                        <strong>PickedUp:</strong><br>{{ \Carbon\Carbon::parse($List->created_at)->format('d M, Y') }}
                                </td>
                                <td>
                                    {{-- <div class="dropdown show list-actions">
                                        <a class="btn btn-success dropdown-toggle btn-sm" href="#"
                                            role="button" data-toggle="dropdown" aria-haspopup="true">
                                            Actions
                                        </a>
                                        <div class="dropdown-menu"> --}}
                                    {{-- <a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                        class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap" role="button">View
                                        Detail</a> --}}
                                    {{-- <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap compare-listing"
                                        data-toggle="modal" data-target="#CompareListing" href="javascript:void(0);">
                                        <input hidden type="text" class="Listed-ID"
                                            value="{{ $List->all_listing->id }}">
                                        <input hidden type="text" class="Listed-Type"
                                            value="{{ $List->all_listing->Listing_Type }}">
                                        <input hidden type="text" class="Listed-Miles"
                                            value="{{ $List->all_listing->routes->Miles }}">
                                        Compare Listing</a> --}}
                                    {{-- <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                        href="{{ route('chat', $List->CMP_id) }}">Message Carrier</a> --}}
                                    {{-- @if ($List->all_listing->user_id === $currentUser->id) --}}
                                    <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                        href="{{ route('Order.Deliverd', ['List_ID' => $List->all_listing->id]) }}">Mark
                                        as Delivered</a>
                                    {{-- @endif --}}
                                    <a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                        class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                        role="button">View
                                        Details</a>
                                    {{-- @if ($List->all_listing->Listing_Status === 'Dispatch') --}}

                                    <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap "
                                       href="{{ route('PostPickup.Bol.Listing', ['List_ID' => $List->all_listing->id])}}">
                                        {{ isset($List->all_listing->delivered_bol->id) ? 'View Bol' : 'Upload Bol' }}
                                    </a>

                                    {{-- @endif --}}
                                    {{-- @if ($List->all_listing->user_id === $currentUser->id)
                                        <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                            href="{{ route('User.Edit.Listing', ['List_ID' => $List->all_listing->id]) }}">Modify
                                            Listing</a>
                                        <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                            href="{{ route('Order.Deliverd.Approval', ['List_ID' => $List->all_listing->id]) }}">Mark
                                            as Delivered</a>
                                        <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                            href="{{ route('Order.Not.Deliverd.Approval', ['List_ID' => $List->all_listing->id]) }}">Not
                                            Delivered</a>
                                    @endif --}}
                                    <button class="text-nowrap add-misc btn btn-outline-primary mb-2 w-100 d-block"
                                        data-toggle="modal" data-target="#AddMisc" href="javascript:void(0);">
                                        <input hidden type="text" class="Listed-ID"
                                            value="{{ $List->all_listing->id }}">
                                        <input hidden type="text" class="Ref-ID"
                                            value="{{ $List->all_listing->Ref_ID }}">Add Misc.</button>
                                    <button class="text-nowrap show-misc btn btn-outline-primary mb-2 w-100 d-block"
                                        data-toggle="modal" data-target="#ShowMisc" href="javascript:void(0);">
                                        <input hidden type="text" class="Listed-ID"
                                            value="{{ $List->all_listing->id }}">
                                        <input hidden type="text" class="Ref-ID"
                                            value="{{ $List->all_listing->Ref_ID }}">Show Misc. <span
                                            class="badges">({{ count($List->all_listing->miscellenous) }})</span></button>
                                    @if ($List->all_listing->user_id !== $currentUser->id)
                                        {{-- <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap add-misc"
                                            data-toggle="modal" data-target="#AddMisc" href="javascript:void(0);">
                                            <input hidden type="text" class="Listed-ID"
                                                value="{{ $List->all_listing->id }}">Add Misc.</a> --}}
                                        @php
                                            $idsArray = $idsArray ?? [];
                                            $listingId = $List->all_listing->id;
                                            $inArray = in_array($listingId, $idsArray);
                                        @endphp
                                        {{-- @if ($inArray)
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('PostPickup.Bol.Listing', ['List_ID' => $listingId]) }}">Online
                                                BOL</a>
                                        @endif --}}
                                        {{-- <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap attach-bill"
                                            data-toggle="modal" data-target="#AttachBill" href="javascript:void(0);">
                                            <input hidden type="text" class="Listed-ID"
                                                value="{{ $List->all_listing->id }}">Deliver</a> --}}
                                        {{-- <a href="{{ route('Order.Not.Pickup.Approval', ['List_ID' => $List->all_listing->id]) }}"
                                            class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap" role="button">Not
                                            Approve</a> --}}
                                    @endif
                                    {{-- </div>
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
            {{-- <div class="table-responsive dataTables_wrapper me-0 d-flex">
                <div class="col-lg-6 col-md-6 col-sm-12">
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
                <table class="display dataTable advance-68 text-center table-1 table-bordered table-cards">
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
                            @if ($List->all_listing != null)
                                <tr class="card-row" data-status="active">
                                    <td>
                                        <div><span
                                                class="badge badge-pill badge-primary">{{ $List->all_listing->Listing_Status }}</span>
                                        </div>
                                        <span
                                            style="font-size: x-large;"><strong>{{ $List->all_listing->Ref_ID }}</strong></span><br>
                                        @if (count($List->all_listing->attachments) > 0)
                                            <strong><a
                                                    class="text-nowrap"href="{{ route('Order.Attachments', ['List_ID' => $List->all_listing->id]) }}"
                                                    target="_blank">View Images</a>
                                            </strong><br>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $companyName = $List->all_listing->pickup->pickup_user->Company_Name;
                                            $trimmedCompanyName = Str::words($companyName, 3, '...');
                                        @endphp

                                        <span style="font-size: x-large;">
                                            <a target="_blank" class="locations-color"
                                                href="{{ route('View.Profile', $List->all_listing->pickup->pickup_user->id) }}"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ $companyName }}">
                                                <strong>{{ $trimmedCompanyName }}</strong>
                                            </a>
                                        </span><br>
                                        {{-- <span style="font-size: x-large; ">
                                            <a target="_blank" class="locations-color"
                                                href="{{ route('View.Profile', $List->all_listing->pickup->pickup_user->id) }}"><strong>{{ $List->all_listing->pickup->pickup_user->Company_Name }}</strong>
                                            </a></span><br> --}}
                                        {{-- <strong><a
                                                href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                                target="_blank">View Contract</a>
                                        </strong> --}}
                                        {{-- <span>
                                            <strong>Contact:</strong>{{ $List->all_listing->pickup->pickup_user->Contact_Phone }}
                                        </span><br>
                                        <strong>Email:</strong>{{ $List->all_listing->pickup->pickup_user->email }}
                                        </span> --}}
                                        <span>
                                            <strong>Contact:</strong>
                                            <a class="locations-color"
                                                href="tel:{{ $List->all_listing->pickup->pickup_user->Contact_Phone }}">
                                                {{ $List->all_listing->pickup->pickup_user->Contact_Phone }}
                                            </a>
                                        </span><br>
                                        <span>
                                            <strong>Email:</strong>
                                            <a class="locations-color"
                                                href="mailto:{{ $List->all_listing->pickup->pickup_user->email }}">
                                                {{ $List->all_listing->pickup->pickup_user->email }}
                                            </a>
                                        </span><br>
                                        <strong>Time:</strong>
                                        {{ $List->all_listing->pickup->pickup_user->Hours_Operations }}
                                        </span><br>
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

                                            $userRatings = getUserRating($List->all_listing->pickup->pickup_user->id);
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
                                            onclick="window.open('{{ route('chat', $List->user_id) }}', '_blank')">
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
                                                        <a class="dropdown-item"
                                                            style="color: #0d6efd; font-weight: 800;"
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
                                                data-html="true">Vehicles
                                                ({{ count($List->all_listing->dry_vans) }})
                                            </a>
                                        @endif
                                        <br>
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
                                        <span class="text-nowrap">
                                            <strong>Pay Mode:</strong><span
                                                class="text-nowrap">{{ !empty($List->all_listing->paymentinfo->COD_Method_Mode) ? $List->all_listing->paymentinfo->COD_Method_Mode : '' }}</span></span><br>
                                        {{-- <span class="text-nowrap">
                                            <strong>Price to pay:</strong><span>
                                                ${{ $List->all_listing->paymentinfo->Price_Pay_Carrier }}</span>
                                        </span><br> --}}
                                        {{-- <strong>Assigned to:
                                        </strong>{{ $List->all_listing->pickup->pickup_user->usr_type }}
                                        <br> --}}
                                        {{-- <strong><a
                                                href="{{ route('View.Profile', $List->all_listing->pickup->pickup_user->id) }}"
                                                target="_blank">View
                                                MC</a>&nbsp;&nbsp;<a
                                                href="{{ route('View.Profile', $List->all_listing->pickup->pickup_user->id) }}"
                                                target="_blank">View DOT</a></strong> --}}

                                        {{-- @if (!empty($List->all_listing->request_broker->Offer_Price) && $List->all_listing->request_broker->Offer_Price !== 0)
                                        <span class="text-danger fs-5 text-nowrap">
                                            <strong>Bid Price: ${{ $List->all_listing->request_broker->Offer_Price }}</strong>
                                        </span>
                                            <br>
                                        @endif --}}
                                        <span class="text-nowrap">
                                            <strong>Mile:</strong>
                                            {{ $List->all_listing->routes->Miles }}miles</span><br>
                                        <span class="text-nowrap">
                                            <strong>Price per Mile:</strong>
                                            ${{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}/miles</span>
                                        {{-- {{ $List->all_listing->routes->Miles }} miles |
                                        ${{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}
                                        /miles --}}
                                    </td>
                                    <td>
                                        {{-- <span class="text-nowrap"><strong>PickUp:</strong>{{ $List->all_listing->pickup_delivery_info->Pickup_Date }}
                                        ({{ $List->all_listing->pickup_delivery_info->Pickup_Date_mode }})
                                        </span>
                                        <br>
                                        <span class="text-nowrap">
                                        <strong>Delivery:</strong>
                                        @if ($List->all_listing->pickup_delivery_info->Delivery_Date_mode === 'ASAP')
                                            ({{ $List->all_listing->pickup_delivery_info->Delivery_Date_mode }})
                                        @else
                                            {{ $List->all_listing->pickup_delivery_info->Delivery_Date }}
                                        @endif
                                        </span>
                                        <br>
                                        <span class="text-nowrap">
                                        <strong>Created At:</strong>
                                        {{ $List->created_at }}</span><br>
                                        <span class="text-nowrap">
                                        <strong>Modified At:</strong>
                                        {{ $List->updated_at }}</span> --}}
                                        <strong>Pickup:</strong><br>{{ \Carbon\Carbon::parse($List->all_listing->pickup_delivery_info->Pickup_Date)->format('d M, Y') }}
                                        <br>
                                        <strong>Delivery:</strong><br>
                                        {{ \Carbon\Carbon::parse($List->all_listing->pickup_delivery_info->Delivery_Date)->format('d M, Y') }}
                                        <br>
                                        <strong>PickedUp:</strong><br>{{ \Carbon\Carbon::parse($List->created_at)->format('d M, Y') }}
                                    </td>
                                    <td>
                                        {{-- <div class="row d-block"> --}}
                                        {{-- <div class="dropdown show list-actions">
                                            <a class="btn btn-success dropdown-toggle btn-sm" href="#"
                                                role="button" data-toggle="dropdown" aria-haspopup="true">
                                                Actions
                                            </a> --}}

                                        {{-- <div class="dropdown-menu"> --}}
                                        {{-- <a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                                    class="dropdown-item" role="button">View Detail</a> --}}
                                        {{-- <a class="btn btn-primary mb-2 w-100 d-block text-nowrap text-nowrap compare-listing"
                                            data-toggle="modal" data-target="#CompareListing"
                                            href="javascript:void(0);">
                                            <input hidden type="text" class="Listed-ID"
                                                value="{{ $List->all_listing->id }}">
                                            <input hidden type="text" class="Listed-Type"
                                                value="{{ $List->all_listing->Listing_Type }}">
                                            <input hidden type="text" class="Listed-Miles"
                                                value="{{ $List->all_listing->routes->Miles }}">
                                            Compare Listing</a> --}}
                                        {{-- <a class="btn mb-2 btn-primary w-100 text-nowrap"
                                            href="{{ route('chat', $List->user_id) }}">Message Broker</a> --}}
                                        @if ($List->all_listing->user_id !== $currentUser->id)
                                            <a class="btn btn-outline-primary  mb-2 w-100 d-block text-nowrap attach-bill"
                                                data-toggle="modal" data-target="#AttachBill"
                                                href="javascript:void(0);">
                                                <input hidden type="text" class="Listed-ID"
                                                    value="{{ $List->all_listing->id }}">Deliver</a>
                                        @endif

                                        @if ($List->all_listing->user_id === $currentUser->id)
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                                href="{{ route('User.Edit.Listing', ['List_ID' => $List->all_listing->id]) }}">Modify
                                                Listing</a>
{{--                                            <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"--}}
{{--                                                href="{{ route('Order.Deliverd', ['List_ID' => $List->all_listing->id]) }}">Mark--}}
{{--                                                as Delivered</a>--}}
                                            {{-- <a href="{{ route('Order.Not.Pickup.Approval', ['List_ID' => $List->all_listing->id]) }}"
                                                class="btn btn-primary mb-2 w-100 d-block text-nowrap"
                                                role="button">Not Approve</a> --}}
                                        @endif
                                        <a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                            class="btn btn-outline-primary  mb-2 w-100 d-block text-nowrap"
                                            role="button">View
                                            Details</a>
                                        <button
                                            class="show-misc btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                            data-toggle="modal" data-target="#ShowMisc" href="javascript:void(0);">
                                            <input hidden type="text" class="Listed-ID"
                                                value="{{ $List->all_listing->id }}">
                                            <input hidden type="text" class="Ref-ID"
                                                value="{{ $List->all_listing->Ref_ID }}">Show Misc. <span
                                                class="badges">({{ count($List->all_listing->miscellenous) }})</span></button>
                                        @if ($List->all_listing->user_id !== $currentUser->id)
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
                                        <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap {{ isset($List->all_listing->delivered_bol->id) ? '' : 'disabled-link' }}"
                                           href="{{ route('PostPickup.Bol.Listing', ['List_ID' => $List->all_listing->id]) }}">
                                            {{ isset($List->all_listing->delivered_bol->id) ? 'View Bol' : 'Upload Bol' }}
                                        </a>

                                        {{-- <a class="btn btn-primary mb-2 w-100 d-block text-nowrap"
                                            href="#">Add Misc. Charge(s)</a> --}}
                                        {{-- </div>
                                            </div> --}}
                                        {{-- </div> --}}
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
                <form action="{{ route('Attach.BOL.Deliver') }}" method="POST" class="was-validated"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="customControlValidation2"
                                    name="is_person_available" value="Pickup Person" checked>
                                <label class="custom-control-label" for="customControlValidation2">Deliver
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
                                <label>Delivery Location</label>
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
                                <label>Delivery Person</label>
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
                    <input hidden type="text" name="Bol_Type" class="get_Bol_Type" value="On Deliver">
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
