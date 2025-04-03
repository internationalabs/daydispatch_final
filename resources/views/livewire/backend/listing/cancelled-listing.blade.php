@section('Cancelled', 'mm-active')
@php
    use Illuminate\Support\Facades\Auth;
    $currentUser = Auth::guard('Authorized')->user();
    $getFormattedDate = function ($item) {
        return $item instanceof \Carbon\Carbon ? $item->format('Y-m-d') : $item;
    };
@endphp
@php
    use Illuminate\Support\Str;
@endphp
<div class="breadcrumb-area">
    <h1>{{ $currentUser->usr_type }} Listing</h1>
    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>
        <li class="item">Cancelled</li>
    </ol>
</div>
@include('partials.global-search')
<div class="card">
    <div class="card-body">
        @if ($currentUser->usr_type === 'Carrier')
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
                </div>  --}}
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
                <table
                    class="table-1 display dataTable advance-786 text-center table-bordered table-cards">
                    <thead class="table-header">
                        <tr>
                            <th>ID</th>
                            <th>Company Details</th>
                            <th>Routes</th>
                            <th>Load Details</th>
                            <th>Payments</th>
                            {{-- <th>Assign Dates</th> --}}
                            <th>Dates</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Lisiting as $List)
                            <tr class="card-row" data-status="active">
                                <td>
                                    @if ($List->deleted_at !== null)
                                        <h6><span class="badge badge-primary mb-2">Re Listed</span>
                                            <span
                                                class="badge badge-primary">{{ !is_null($List->cancelled_By) ? $List->cancelled_By->Company_Name : '' }}</span>
                                        </h6>
                                    @else
                                        <h6><span class="badge badge-primary">{{ $List->status }}
                                                by {{ $List->cancelled_By->Company_Name }}</span>
                                        </h6>
                                    @endif
                                    <span
                                        style="font-size: x-large; "><strong>{{ $List->all_listing->Ref_ID }}</strong></span><br>
                                    @if (count($List->all_listing->attachments) > 0)
                                        <strong><a
                                                href="{{ route('Order.Attachments', ['List_ID' => $List->all_listing->id]) }}"
                                                target="_blank">View Images</a></strong><br>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $companyName = $List->all_listing->authorized_user->Company_Name;
                                        $trimmedCompanyName = Str::words($companyName, 3, '...'); 
                                    @endphp

                                    <strong>
                                        <span style="font-size: x-large;">
                                            <a class="fs-3 text-nowrap locations-color"
                                                href="{{ route('View.Profile', $List->all_listing->authorized_user->id) }}"
                                                target="_blank" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ $companyName }}"> 
                                                {{ $trimmedCompanyName }}
                                            </a>
                                        </span>
                                    </strong><br>
                                    {{-- <strong>
                                        <span style="font-size: x-large; "><a class="fs-3 text-nowrap locations-color"
                                                href="{{ route('View.Profile', $List->all_listing->authorized_user->id) }}"
                                                target="_blank">{{ $List->all_listing->authorized_user->Company_Name }}</a>
                                        </span>
                                    </strong><br> --}}
                                    {{-- Ph no:{{ $List->all_listing->authorized_user->Contact_Phone }}<br>
                                        Hours:{{ $List->all_listing->authorized_user->Hours_Operations }}<br>
                                        Timezone:{{ $List->all_listing->authorized_user->Time_Zone }}<br> --}}
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
                                    <span>
                                        <strong>Email:</strong>
                                        <a class="locations-color"
                                            href="mailto:{{ $List->all_listing->authorized_user->email }}">
                                            {{ $List->all_listing->authorized_user->email }}
                                        </a>
                                    </span><br>
                                    {{-- <strong>Time:</strong> {{ $List->all_listing->authorized_user->Hours_Operations }}
                                        </span><br> --}}
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
                                        Message Broker
                                    </span>
                                </td>
                                <td>
                                    <div class="mb-2">
                                        <span><strong>Pickup</strong></span><br>
                                        <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                            href="https://www.google.com/maps/place/{{ urlencode($List->all_listing->routes->Origin_ZipCode) }}"
                                            target="_blank">
                                            {{-- <i class="fas fa-map-marker-alt text-success fs-30"></i> --}}
                                            {{ Str::replace(',', '-', $List->all_listing->routes->Origin_ZipCode) }}
                                        </a>
                                    </div>
                                    <div class="mb-2">
                                        <span><strong>Delivery</strong></span><br>
                                        <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                            href="https://www.google.com/maps/place/{{ urlencode($List->all_listing->routes->Dest_ZipCode) }}"
                                            target="_blank">
                                            {{-- <i class="fas fa-map-marker-alt text-danger fs-30"></i> --}}
                                            {{ Str::replace(',', '-', $List->all_listing->routes->Dest_ZipCode) }}
                                        </a>
                                    </div>
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
                                                    style="font-size: 16px;">{{ $vehcile->Vehcile_Condition }}</span>
                                            @endif
                                            @if (!empty($vehcile->Trailer_Type))
                                                <span class="badge badge-pill mt-2 badge-primary font-weight-bold"
                                                    style="font-size: 16px;">{{ $vehcile->Trailer_Type }}</span>
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
                                                <a class="font-weight-bold text-dark text-nowrap"
                                                    href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                    target="_blank"><span
                                                        class="fs-5"><strong>{{ $vehcile->Vehcile_Year }}
                                                            {{ $vehcile->Vehcile_Make }}
                                                            {{ $vehcile->Vehcile_Model }}</strong></span></a><br>
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
                                            <!-- <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                        data-trigger="focus" style="cursor: pointer;"
                                        title="Attached vehicles" data-content=
                                            "@foreach ($List->all_listing->vehicles as $vehcile)
                                            {{ $vehcile->Vehcile_Year }}
                                            {{ $vehcile->Vehcile_Make }}
                                            {{ $vehcile->Vehcile_Model }}<br>
                                            @if (!empty($vehcile->Vehcile_Condition))
                                                {{ $vehcile->Vehcile_Condition }}<br>
                                            @endif
                                            @if (!empty($vehcile->Trailer_Type))
                                                {{ $vehcile->Trailer_Type }}
                                            @endif @endforeach" data-html="true">vehicles
                                            ({{ count($List->all_listing->vehicles) }})
                                            </a> -->
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"
                                                    style="cursor: pointer; color: mediumvioletred; font-weight: 800;">
                                                    Vehicles ({{ count($List->all_listing->vehicles) }})
                                                </a>
                                                <div class="dropdown-menu">
                                                    <h6 class="dropdown-header" style="background-color: lightgrey;">
                                                        Attached Vehicles</h6>
                                                    @foreach ($List->all_listing->vehicles as $vehcile)
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
                                    @if (count($List->all_listing->heavy_equipments) === 1)
                                        @foreach ($List->all_listing->heavy_equipments as $vehcile)
                                            {{-- <p class="ymm">{{ $vehcile->Equipment_Year }}
                                            {{ $vehcile->Equipment_Make }}
                                            {{ $vehcile->Equipment_Model }}</p><br> --}}

                                            <a class="font-weight-bold text-dark"
                                                href='https://www.google.com/search?q={{ $vehcile->Equipment_Year }}%20{{ $vehcile->Equipment_Make }}%20{{ $vehcile->Equipment_Model }}'
                                                target='_blank'><span
                                                    class="fs-5"><strong>{{ $vehcile->Equipment_Year }}
                                                        {{ $vehcile->Equipment_Make }} {{ $vehcile->Equipment_Model }}
                                                </span></strong></a><br>

                                            <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }}
                                            | <b>H</b>{{ $vehcile->Equip_Height }}
                                            | {{ $vehcile->Equip_Weight }} <b>LBS</b> <br>
                                            {{-- @if (!empty($vehcile->Equipment_Condition))
                                                <br><span>{{ $vehcile->Equipment_Condition }}</span><br>
                                            @endif
                                            @if (!empty($vehcile->Trailer_Type))
                                            <span> {{ $vehcile->Trailer_Type }}</span>
                                            @endif --}}

                                            @if (!empty($vehcile->Equipment_Condition))
                                                <span
                                                    class="badge badge-pill mt-2 @if ($vehcile->Equipment_Condition == 'Running') badge-success @elseif($vehcile->Equipment_Condition == 'Not Running') badge-danger @else badge-primary @endif"
                                                    style="font-size: 16px;">
                                                    {{ $vehcile->Equipment_Condition }}
                                                </span>
                                            @endif
                                            @if (!empty($vehcile->Trailer_Type))
                                                <span class="badge badge-pill mt-2 badge-primary font-weight-bold"
                                                    style="font-size: 16px;">{{ $vehcile->Trailer_Type }}</span>
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
                                    data-trigger="focus" style="cursor: pointer;"
                                    title="Additional Terms" data-content=
                                        "{{ !empty($List->all_listing->additional_info->Additional_Terms) ? $List->all_listing->additional_info->Additional_Terms : '' }}">
                                        {{ !empty($List->all_listing->additional_info->Additional_Terms) ? Str::limit($List->all_listing->additional_info->Additional_Terms, 20) : '...' }}</a> --}}
                                </td>
                                <td>
                                    <strong>Job
                                        Price:</strong><span>${{ $List->all_listing->paymentinfo->COD_Amount }}</span>
                                    {{-- {{ !empty($List->all_listing->paymentinfo->COD_Method_Mode) ? $List->all_listing->paymentinfo->COD_Method_Mode : '' }}
                                        On
                                        {{ !empty($List->all_listing->paymentinfo->COD_Location_Amount) ? $List->all_listing->paymentinfo->COD_Location_Amount : '' }} --}}
                                    <br>
                                    @if (!empty($List->all_listing->paymentinfo->COD_Method_Mode))
                                        <strong class="text-nowrap">Pay Mode:</strong>
                                        <span
                                            class="text-nowrap">{{ $List->all_listing->paymentinfo->COD_Method_Mode }}
                                        </span>
                                    @endif
                                    
                                    {{-- @if (!empty($List->all_listing->paymentinfo->COD_Location_Amount))
                                        <strong class="text-nowrap">COD Location Amount On:</strong><br>
                                        <span
                                            class="text-nowrap">{{ $List->all_listing->paymentinfo->COD_Location_Amount }}
                                        </span>
                                    @endif --}}
                                    {{-- {{ !empty($List->all_listing->paymentinfo->COD_Method_Mode) ? $List->all_listing->paymentinfo->COD_Method_Mode : '' }}
                                        On
                                        {{ !empty($List->all_listing->paymentinfo->COD_Location_Amount) ? $List->all_listing->paymentinfo->COD_Location_Amount : '' }} --}}
                                    <br>
                                    <strong>Mile:</strong>{{ $List->all_listing->routes->Miles }}miles
                                </td>
                                <td>
                                    <strong>Cancellation Date:</strong>
                                    <span class="text-nowrap">{{ \Carbon\Carbon::parse($List->created_at)->format('d M, Y') }}</span><br>
                                    <strong>Cancellation Reason:</strong><br>
                                    <span class="text-nowrap">{{ $List->Main_Reason }}</span>
                                    {{-- <strong>Pickup:</strong><br>
                                        {{ $List->all_listing->pickup_delivery_info->Pickup_Date }}
                                        ({{ $List->all_listing->pickup_delivery_info->Pickup_Date_mode }})
                                        <br>
                                        <strong>Delivery:</strong><br>
                                        {{ $List->all_listing->pickup_delivery_info->Delivery_Date }}
                                        ({{ $List->all_listing->pickup_delivery_info->Delivery_Date_mode }})
                                        <strong>Created At:</strong><br>
                                        {{ $List->all_listing->created_at }}<br>
                                        <strong>Modified At:</strong><br>
                                        {{ $List->all_listing->updated_at }} --}}
                                </td>
                                <td>
                                    {{-- @if ($List->deleted_at !== null)
                                            <h6> 
                                                <span class="badge badge-primary">
                                                    Re Listed
                                                </span>
                                                <span class="badge badge-primary">
                                                    {{ !is_null($List->all_listing->cancel->waiting_users) ? $List->all_listing->cancel->waiting_users->Company_Name : '' }}
                                                </span>
                                                <span class="badge badge-primary">
                                                    Cancelled by {{ $List->all_listing->cancel->waiting_users->Company_Name }}
                                                </span>
                                            </h6>
                                            @else --}}
                                    {{-- <h6><span
                                                class="badge badge-primary">{{ $List->status }} by {{ $List->all_listing->cancel->waiting_users->Company_Name }}</span>
                                            </h6> --}}
                                    {{-- <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                                href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                target="_blank">View Route</a> --}}
                                    <a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                        class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                        role="button">View
                                        Detail</a>
                                    @if ($List->all_listing->user_id === $currentUser->id)
                                        <button class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                            onclick="window.location.href='{{ route('User.Replicate.Listing', ['List_ID' => $List->all_listing->id]) }}'">
                                            Replicate Listing
                                        </button>
                                    @endif
                                    <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap Generate-Ticket"
                                        data-toggle="modal" data-target="#TicketModal" href="javascript:void(0);">
                                        <input hidden type="text" class="Listed-ID"
                                            value="{{ $List->all_listing->id }}">
                                        <input hidden type="text" class="Ref-ID"
                                            value="{{ $List->all_listing->Ref_ID }}">
                                        <input hidden type="text" class="User-ID"
                                            value="{{ $List->all_listing->user_id }}">
                                        <input hidden type="text" class="User-Email"
                                            value="{{ $List->all_listing->authorized_user->email }}">
                                        <input hidden type="text" class="User-Name"
                                            value="{{ $List->all_listing->authorized_user->Company_Name }}">
                                        <input hidden type="text" class="CMP-ID"
                                            value="{{ $List->waiting_users->id }}">
                                        <input hidden type="text" class="CMP-Email"
                                            value="{{ $List->waiting_users->email }}">
                                        <input hidden type="text" class="CMP-Name"
                                            value="{{ $List->waiting_users->Company_Name }}">
                                        Generate Ticket</a>
                                    {{-- </div>
                                            </div>
                                        @endif --}}
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
                {{-- <table class="table-1 display dataTable advance-71 datatable-range text-center w-100"> --}}

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
                
                <table
                    class="table-1 display dataTable advance-786 text-center table-bordered table-cards">
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
                                    @if ($List->deleted_at !== null)
                                        <h6><span class="badge badge-primary mb-2">Re Listed</span><br><span
                                                class="badge badge-warning">{{ !is_null($List->all_listing->cancel->waiting_users) ? $List->all_listing->cancel->waiting_users->Company_Name : '' }}</span>
                                        </h6>
                                    @else
                                        <h6><span class="badge badge-warning">{{ $List->status }}
                                                by {{ $List->cancelled_By->Company_Name }}</span>
                                        </h6>
                                    @endif
                                    <span
                                        style="font-size: x-large;"><strong>{{ $List->all_listing->Ref_ID }}</strong></span><br>
                                    @if (count($List->all_listing->attachments) > 0)
                                        <strong><a href="{{ route('Order.Attachments', ['List_ID' => $List->id]) }}"
                                                target="_blank">View Images</a></strong><br>
                                    @endif
                                    {{-- @if (count($List->all_listing->attachments) > 0)
                                            <strong><a href="{{ route('Order.Attachments', ['List_ID' => $List->all_listing->id]) }}"
                                                    target="_blank">View Images</a></strong><br>
                                        @endif
                                        <strong>Ref-ID:</strong>{{ $List->all_listing->Ref_ID }} <br> --}}
                                </td>
                                <td>

                                    @php
                                        $companyName = $List->all_listing->cancel->waiting_users->Company_Name;
                                        $trimmedCompanyName = Str::words($companyName, 3, '...');
                                    @endphp

                                    <strong>
                                        <span style="font-size: x-large;">
                                            <a class="fs-3 text-wrap locations-color"
                                                href="{{ route('View.Profile', $List->all_listing->cancel->waiting_users->id) }}"
                                                target="_blank" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ $companyName }}">
                                                {{ $trimmedCompanyName }}
                                            </a>
                                        </span>
                                    </strong><br>

                                    {{-- <strong>
                                            <span style="font-size: x-large; "><a class="fs-3 text-wrap locations-color"
                                                    href="{{ route('View.Profile', $List->all_listing->cancel->waiting_users->id) }}"
                                                    target="_blank">{{ $List->all_listing->cancel->waiting_users->Company_Name }}</a>
                                            </span>
                                        </strong><br> --}}
                                    {{-- <strong><a target="_blank"
                                                href="{{ route('View.Profile', $List->all_listing->cancel->waiting_users->id) }}">{{ $List->all_listing->cancel->waiting_users->Company_Name }}</a></strong><br> --}}
                                    <span>
                                        <strong>Contact:</strong>
                                        <a class="locations-color"
                                            href="tel:{{ $List->all_listing->cancel->waiting_users->Contact_Phone }}">
                                            {{ $List->all_listing->cancel->waiting_users->Contact_Phone }}
                                        </a>
                                    </span><br>
                                    <span>
                                        <strong>Email:</strong>
                                        <a class="locations-color"
                                            href="mailto:{{ $List->all_listing->cancel->waiting_users->email }}">
                                            {{ $List->all_listing->cancel->waiting_users->email }}
                                        </a>
                                    </span><br>
                                    {{-- <span>
                                            <strong>Contact:</strong>{{ $List->all_listing->cancel->waiting_users->Contact_Phone }}
                                        </span><br>
                                        <strong>Email:</strong>{{ $List->all_listing->cancel->waiting_users->email }}
                                        </span><br> --}}
                                    {{-- <strong>Time:</strong>
                                        {{ $List->all_listing->cancel->waiting_users->Hours_Operations }}
                                        </span><br> --}}
                                    {{-- <strong><a
                                            href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                            target="_blank">View Contract</a>
                                        </strong><br> --}}
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

                                        $userRatings = getUserRating($List->all_listing->cancel->waiting_users->id);
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
                                    <div class="mb-2">
                                        <span><strong>Pickup Location</strong></span><br>
                                        <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                            href="https://www.google.com/maps/place/{{ urlencode($List->all_listing->routes->Origin_ZipCode) }}"
                                            target="_blank">
                                            {{-- <i class="fas fa-map-marker-alt text-success fs-30"></i> --}}
                                            {{ Str::replace(',', '-', $List->all_listing->routes->Origin_ZipCode) }}
                                        </a>
                                    </div>
                                    <div class="mb-2">
                                        <span><strong>Delivery Location</strong></span><br>
                                        <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                            href="https://www.google.com/maps/place/{{ urlencode($List->all_listing->routes->Dest_ZipCode) }}"
                                            target="_blank">
                                            {{-- <i class="fas fa-map-marker-alt text-danger fs-30"></i> --}}
                                            {{ Str::replace(',', '-', $List->all_listing->routes->Dest_ZipCode) }}
                                        </a>
                                    </div>
                                    <div class="mb-2">
                                        <span class="fs-5"><strong><a
                                                    class="btn btn-outline-primary text-decoration-none fw-bold"
                                                    href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                    target="_blank">View Route</a></strong></span>
                                    </div>
                                </td>
                                <td>
                                    {{-- @if (count($List->all_listing->vehicles) === 1)
                                            @foreach ($List->all_listing->vehicles as $vehcile)
                                                <p class="ymm"> {{ $vehcile->Vehcile_Year }}
                                                    {{ $vehcile->Vehcile_Make }}
                                                    {{ $vehcile->Vehcile_Model }}</p><br>
                                                @if (!empty($vehcile->Vehcile_Condition))
                                                    <span> {{ $vehcile->Vehcile_Condition }}</span><br>
                                                @endif
                                                @if (!empty($vehcile->Trailer_Type))
                                                    <span>{{ $vehcile->Trailer_Type }}</span>
                                                @endif
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
                                        @endif --}}
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
                                                <br>{{ $vehcile->Equipment_Condition }}<br>
                                            @endif
                                            @if (!empty($vehcile->Trailer_Type))
                                                {{ $vehcile->Trailer_Type }}
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
                                        {{-- <strong>
                                            @if ($List->all_listing->paymentinfo->COD_Location_Amount == 'PickUp')
                                                Pay on Pickup:
                                            @else
                                                Pay on Delivery:
                                            @endif
                                        </strong>

                                        <span>${{ $List->all_listing->paymentinfo->COD_Amount }}</span>
                                        <br /> --}}
                                    @endif
                                    @if (!empty($List->all_listing->paymentinfo->COD_Method_Mode))
                                    <strong class="text-nowrap">Pay Mode:</strong>
                                    <span
                                        class="text-nowrap">{{ $List->all_listing->paymentinfo->COD_Method_Mode }}
                                    </span>
                                    <br/>
                                @endif
                                    <strong>Mile:</strong>{{ $List->all_listing->routes->Miles }}miles<br>
                                    {{-- <strong>Assigned to:
                                        </strong>{{ $List->all_listing->cancel->waiting_users->usr_type }}
                                        <br> --}}
                                    {{-- <strong><a
                                            href="{{ route('View.Profile', $List->all_listing->cancel->waiting_users->id) }}"
                                            target="_blank">View
                                            MC</a>&nbsp;&nbsp;<a
                                            href="{{ route('View.Profile', $List->all_listing->cancel->waiting_users->id) }}"
                                            target="_blank">View DOT</a></strong> --}}
                                    @if (!empty($List->all_listing->request_broker->Offer_Price) && $List->all_listing->request_broker->Offer_Price !== 0)
                                        <span class="text-danger fs-5 text-nowrap">
                                            <strong>
                                                Bid Price: ${{ $List->all_listing->request_broker->Offer_Price }}
                                            </strong>
                                        </span><br>
                                        {{-- <strong>Ask Price:</strong><br><span
                                                class="text-nowrap">${{ $List->all_listing->request_broker->Offer_Price }}</span> --}}
                                    @endif
                                </td>
                                <td>
                                    <strong>Cancellation Date:</strong><br>
                                    <span class="text-nowrap">{{ \Carbon\Carbon::parse($List->created_at)->format('d M, Y') }}</span><br>
                                    @if ($List->all_listing->dispatch_listing || $List->all_listing->dispatch_listing()->withTrashed()->first())
                                        <strong>Dispatched:</strong><br>
                                        {{ $getFormattedDate($List->all_listing->dispatch_listing ? $List->all_listing->dispatch_listing->created_at : $List->all_listing->dispatch_listing()->withTrashed()->first()->created_at) }}
                                    @endif
                                    {{-- <strong>Modified At:</strong><br>
                                        <span class="text-nowrap">{{ $List->updated_at }}</span> --}}
                                    {{-- <strong>PickUp:
                                        </strong>{{ $List->all_listing->pickup_delivery_info->Pickup_Date }}
                                        ({{ $List->all_listing->pickup_delivery_info->Pickup_Date_mode }})
                                        <br>
                                        <strong>Delivery: </strong>
                                        {{ $List->all_listing->pickup_delivery_info->Delivery_Date }}
                                        ({{ $List->all_listing->pickup_delivery_info->Delivery_Date_mode }}) --}}
                                </td>
                                <td>
                                    {{-- <div class="dropdown show list-actions">
                                                <a class="btn btn-success dropdown-toggle btn-sm" href="#"
                                                    role="button" data-toggle="dropdown" aria-haspopup="true">
                                                    Actions
                                                </a>
                                                <div class="dropdown-menu"> --}}
                                    {{-- <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                                href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                                target="_blank">View Route</a> --}}
                                    <a href="" class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                        role="button">Rate Carrier</a>
                                    <a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                        class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                        role="button">View
                                        Detail</a>
                                    @if ($List->all_listing->user_id === $currentUser->id)
                                        <button class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                            onclick="window.location.href='{{ route('User.Replicate.Listing', ['List_ID' => $List->all_listing->id]) }}'">
                                            Replicate Listing
                                        </button>
                                    @endif
                                    <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap Generate-Ticket"
                                        data-toggle="modal" data-target="#TicketModal" href="javascript:void(0);">
                                        <input hidden type="text" class="Listed-ID"
                                            value="{{ $List->all_listing->id }}">
                                        <input hidden type="text" class="Ref-ID"
                                            value="{{ $List->all_listing->Ref_ID }}">
                                        <input hidden type="text" class="User-ID"
                                            value="{{ $List->all_listing->user_id }}">
                                        <input hidden type="text" class="User-Email"
                                            value="{{ $List->all_listing->authorized_user->email }}">
                                        <input hidden type="text" class="User-Name"
                                            value="{{ $List->all_listing->authorized_user->Company_Name }}">
                                        <input hidden type="text" class="CMP-ID"
                                            value="{{ $List->waiting_users->id }}">
                                        <input hidden type="text" class="CMP-Email"
                                            value="{{ $List->waiting_users->email }}">
                                        <input hidden type="text" class="CMP-Name"
                                            value="{{ $List->waiting_users->Company_Name }}">
                                        Generate Ticket</a>
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
        @endif
    </div>
</div>
<!-- Cancel Order Modal -->
<div class="modal fade" id="TicketModal" data-backdrop="true" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Generate 3-Way Support Ticket For(<strong class="get_Order_ID">Order ID:
                    </strong>)?</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body user-settings-box">
                <form action="{{ route('Create.Tickets') }}" method="POST" class="was-validated">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Carrier Name</label>
                                <input readonly type="text" class="form-control get_CMP_Name" name="Carrier_Name"
                                    placeholder="Carrier Name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Broker Name</label>
                                <input readonly type="text" class="form-control get_User_Name" name="Broker_Name"
                                    placeholder="Broker Name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Carrier Email</label>
                                <input readonly type="text" class="form-control get_CMP_Email"
                                    name="Carrier_Email" placeholder="Carrier Email">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Broker Email</label>
                                <input readonly type="text" class="form-control get_User_Email"
                                    name="Broker_Email" placeholder="Broker Email">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Order Subject</label>
                                <input type="text" class="form-control" name="Order_Subject"
                                    placeholder="Order Subject" required>
                                <div class="invalid-feedback">Enter Subject</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Select Any Reason</label>
                                <select class="custom-select" name="Order_Reason" required>
                                    <option value="">Select AnyOne</option>
                                    <option value="Disputes">Disputes</option>
                                </select>
                                <div class="invalid-feedback">Select AnyOne</div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="Order_Desc" required>
                                        Hello, We're Starting Communication Between Two Parties..........
                                    </textarea>
                                <div class="invalid-feedback">Enter Description</div>
                            </div>
                        </div>
                        <input hidden type="text" class="get_Listed_ID" name="get_Listed_ID" value="">
                        <input hidden type="text" class="get_User_ID" name="get_User_ID" value="">
                        <input hidden type="text" class="get_CMP_ID" name="get_CMP_ID" value="">
                        <div class="col-lg-12">
                            <div class="btn-box text-center">
                                <button type="submit" class="submit-btn w-100"><i class='fa fa-close'></i>
                                    Generate 3-Way Support Ticket
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    
    $(".Generate-Ticket").click(function() {
        const getListedID = $(this).find('.Listed-ID').val();
        const getListedRefID = $(this).find('.Ref-ID').val();
        const getUserID = $(this).find('.User-ID').val();
        const getUserEmail = $(this).find('.User-Email').val();
        const getUserName = $(this).find('.User-Name').val();
        const getCMPID = $(this).find('.CMP-ID').val();
        const getCMPEmail = $(this).find('.CMP-Email').val();
        const getCMPName = $(this).find('.CMP-Name').val();

        $(".get_Order_ID").html(getListedRefID);
        $(".get_Listed_ID").val(getListedID);
        $(".get_User_ID").val(getUserID);
        $(".get_User_Email").val(getUserEmail);
        $(".get_User_Name").val(getUserName);
        $(".get_CMP_ID").val(getCMPID);
        $(".get_CMP_Email").val(getCMPEmail);
        $(".get_CMP_Name").val(getCMPName);
    });
</script>
