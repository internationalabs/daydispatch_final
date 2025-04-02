@section('Watchlist', 'mm-active')
<!-- Breadcrumb Area -->
@php
    use Illuminate\Support\Facades\Auth;
    $currentUser = Auth::guard('Authorized')->user();
@endphp
@php
   use Illuminate\Support\Str;
@endphp
<div class="breadcrumb-area">
    <h1>{{ $currentUser->usr_type }} Listing </h1>
    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>
        <li class="item">Watchlist</li>
    </ol>
</div>
<style>
    #modalbody {
        display: none;
    }

    .text-primary.font-weight-bold {
        color: #1e2d62;
    }
</style>
<!-- End Breadcrumb Area -->
@include('partials.global-search')
<div class="card">
    <div class="card-body">
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
                                <option value="6">Company Name</option>
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
                                <form id="Search_vehicleType_form" action="{{ route('User.Listing') }}">
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
            <table
                class="display carrier dataTable table-1 text-center table-bordered table-cards">
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
                    @foreach ($watch_list as $List)
                        <tr class="card-row" data-status="active">
                            <td>
                                <span class="fs-4"><strong>{{ $List->listing->Ref_ID }}</strong></span><br>
                                @if (count($List->listing->attachments) > 0)
                                    <strong><a
                                            href="{{ route('Order.Attachments', ['List_ID' => $List->listing->id]) }}"
                                            target="_blank">View Images</a></strong><br>
                                @endif
                            </td>
                            <td>
                                @php
                                    $companyName = $List->listing->authorized_user->Company_Name;
                                    $trimmedCompanyName = Str::words($companyName, 3, '...'); 
                                @endphp

                                <span style="font-size: x-large;">
                                    <a class="fs-3 text-nowrap locations-color"
                                        href="{{ route('View.Profile', ['user_id' => $List->listing->authorized_user->id]) }}"
                                        target="_blank" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="{{ $companyName }}"> 
                                        <strong>{{ $trimmedCompanyName }}</strong>
                                    </a>
                                </span><br>

                                {{-- <span style="font-size: x-large; "><a class="fs-3 text-nowrap locations-color"
                                    href="{{ route('View.Profile', ['user_id' => $List->listing->authorized_user->id]) }}"
                                    target="_blank"><strong>{{ $List->listing->authorized_user->Company_Name }}</strong></a></span><br> --}}
                                <span class="text-nowrap">
                                    <strong>Contact:</strong>
                                    <a class="locations-color"
                                        href="tel:{{ $List->listing->authorized_user->Contact_Phone }}">
                                        {{ $List->listing->authorized_user->Contact_Phone }}
                                    </a>
                                </span><br>
                                <span class="text-nowrap">
                                    <strong>Email:</strong>
                                    <a class="locations-color"
                                        href="mailto:{{ $List->listing->authorized_user->email }}">
                                        {{ $List->listing->authorized_user->email }}
                                    </a>
                                </span><br>
                                <span class="text-nowrap">
                                    <strong>Time:</strong>
                                    {{-- <a href="mailto:{{ $List->listing->authorized_user->Hours_Operations }}"> --}}
                                    {{ $List->listing->authorized_user->Hours_Operations }}
                                    {{-- </a> --}}
                                </span><br>
                                {{-- @php
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
                            <br> --}}
                                <span class="badge badge-pill badge-success" style="cursor:pointer;"
                                    onclick="window.open('{{ route('chat', $List->user_id) }}', '_blank')">
                                    Message Broker
                                </span>


                                {{-- <strong><a
                                        href="{{ route('View.Profile', ['user_id' => $List->listing->authorized_user->id]) }}">{{ $List->listing->authorized_user->Company_Name }}</a></strong><br>
                                {{ $List->listing->authorized_user->Contact_Phone }}<br>
                                {{ $List->listing->authorized_user->Hours_Operations }}<br>
                                {{ $List->listing->authorized_user->Time_Zone }} --}}
                            </td>
                            <td>
                                {{-- <strong>Pickup Route</strong><br>
                                <a href="https://www.google.com/maps/place/{{ urlencode($List->listing->routes->Origin_ZipCode) }}"
                                target="_blank">
                                    {{ Str::replace(',', '-', $List->listing->routes->Origin_ZipCode) }}
                                </a><br>
                                <strong>Delivery Route</strong><br>
                                <a href="https://www.google.com/maps/place/{{ urlencode($List->listing->routes->Dest_ZipCode) }}"
                                target="_blank">
                                    {{ Str::replace(',', '-', $List->listing->routes->Dest_ZipCode) }}
                                </a>
                                <a class="btn btn-primary mb-2 w-100 d-block"
                                        href="https://www.google.com/maps/dir/{{ $List->listing->routes->Origin_ZipCode }},+USA/{{ $List->listing->routes->Dest_ZipCode }},+USA/"
                                        target="_blank">View Route</a> --}}
                                <div class="mb-2">
                                    <span><strong>Pickup</strong></span><br>
                                    <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                        href="https://www.google.com/maps/place/{{ urlencode($List->listing->routes->Origin_ZipCode) }}"
                                        target="_blank">
                                        {{-- <i class="fas fa-map-marker-alt text-success fs-30"></i> --}}
                                        {{ Str::replace(',', '-', $List->listing->routes->Origin_ZipCode) }}
                                    </a>
                                </div>
                                <div class="mb-2">
                                    <span><strong>Delivery</strong></span><br>
                                    <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                        href="https://www.google.com/maps/place/{{ urlencode($List->listing->routes->Dest_ZipCode) }}"
                                        target="_blank">
                                        {{-- <i class="fas fa-map-marker-alt text-danger fs-30"></i> --}}
                                        {{ Str::replace(',', '-', $List->listing->routes->Dest_ZipCode) }}
                                    </a>
                                </div>
                                <div class="mb-2">
                                    <span class="fs-5"><strong><a
                                                class="btn btn-outline-primary text-decoration-none fw-bold"
                                                href="https://www.google.com/maps/dir/{{ $List->listing->routes->Origin_ZipCode }},+USA/{{ $List->listing->routes->Dest_ZipCode }},+USA/"
                                                target="_blank">View Route</a></strong></span>
                                </div>
                            </td>
                            <td>
                                {{-- @if (count($List->listing->vehicles) === 1)
                                    @foreach ($List->listing->vehicles as $vehcile)
                                        <a href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                        target="_blank"> {{ $vehcile->Vehcile_Year }}
                                            {{ $vehcile->Vehcile_Make }}
                                            {{ $vehcile->Vehcile_Model }}</a><br>
                                        @if (!empty($vehcile->Vehcile_Condition))
                                            <span class="text-danger font-weight-bold">{{ $vehcile->Vehcile_Condition }}<br></span>
                                        @endif
                                        @if (!empty($vehcile->Trailer_Type))
                                            <span @if ($vehcile->Trailer_Type == '"(Enclosed Trailer Required)"') class="text-primary font-weight-bold" @endif>{{ $vehcile->Trailer_Type }}</span> <br>
                                        @endif
                                    @endforeach
                                @endif
                                @if (count($List->listing->vehicles) > 1)
                                    <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                    data-trigger="focus" style="cursor: pointer;"
                                    title="Attached vehicles" data-content=
                                        "@foreach ($List->listing->vehicles as $vehcile)
                                        <a href='https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}'
                                        target='_blank'> {{ $vehcile->Vehcile_Year }}
                                        {{ $vehcile->Vehcile_Make }}
                                        {{ $vehcile->Vehcile_Model }}</a><br>
                                        @if (!empty($vehcile->Vehcile_Condition))
                                            <span class="text-danger font-weight-bold">{{ $vehcile->Vehcile_Condition }}<br></span>
                                        @endif
                                        @if (!empty($vehcile->Trailer_Type))
                                            <span @if ($vehcile->Trailer_Type == '"(Enclosed Trailer Required)"') class="text-primary font-weight-bold" @endif>{{ $vehcile->Trailer_Type }}</span> <br>
                                        @endif
                                    @endforeach" data-html="true">vehicles ({{ count($List->listing->vehicles) }})
                                    </a>
                                @endif --}}
                                @if (count($List->listing->vehicles) === 1)
                                    @foreach ($List->listing->vehicles as $vehcile)
                                        <span style="font-size: large; "><a class="font-weight-bold text-dark"
                                                href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                target="_blank"><strong>{{ $vehcile->Vehcile_Year }}
                                                    {{ $vehcile->Vehcile_Make }}
                                                    {{ $vehcile->Vehcile_Model }}</strong></a>
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
                                                style="font-size: 16px;">{{ $vehcile->Trailer_Type }}</span> <br>
                                        @endif
                                    @endforeach
                                @endif
                                @if (count($List->listing->vehicles) > 1)
                                    <div class="dropdown d-block">
                                        <a href="javascript:void(0)"
                                            class="dropdown-toggle font-weight-bold d-inline-flex align-items-center text-dark text-decoration-none"
                                            data-toggle="dropdown"
                                            style="font-size: 21px; cursor: pointer;">Vehicles({{ count($List->listing->vehicles) }})
                                        </a>
                                        <div class="dropdown-menu text-center"
                                            style="max-height: 200px; overflow-y: auto;">
                                            <h6 class="dropdown-header" style="background-color: lightgrey;">
                                                Attached Vehicles</h6>
                                            @foreach ($List->listing->vehicles as $vehcile)
                                                <a class="dropdown-item" style="color: #0560a6; font-weight: 800;"
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
                                @if (count($List->listing->heavy_equipments) === 1)
                                    @foreach ($List->listing->heavy_equipments as $vehcile)
                                        <p class="ymm"> {{ $vehcile->Equipment_Year }}
                                            {{ $vehcile->Equipment_Make }}
                                            {{ $vehcile->Equipment_Model }}</p><br>
                                        <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} |
                                        <b>H</b>{{ $vehcile->Equip_Height }}
                                        | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                        @if (!empty($vehcile->Equipment_Condition))
                                            <br><span>{{ $vehcile->Equipment_Condition }}</span><br>
                                        @endif
                                        @if (!empty($vehcile->Trailer_Type))
                                            <span
                                                @if ($vehcile->Trailer_Type == '"(Enclosed Trailer Required)"') class="text-primary font-weight-bold" @endif>{{ $vehcile->Trailer_Type }}</span>
                                        @endif
                                    @endforeach
                                @endif
                                @if (count($List->listing->heavy_equipments) > 1)
                                    <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                        data-trigger="focus" style="cursor: pointer;" title="Attached vehicles"
                                        data-content=
                                        "@foreach ($List->listing->heavy_equipments as $vehcile)
                                        {{ $vehcile->Equipment_Year }}
                                        {{ $vehcile->Equipment_Make }}
                                        {{ $vehcile->Equipment_Model }}<br>
                                            <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} | <b>H</b>{{ $vehcile->Equip_Height }} | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                        @if (!empty($vehcile->Equipment_Condition))
                                            <br>{{ $vehcile->Equipment_Condition }}<br>
                                        @endif
                                        @if (!empty($vehcile->Trailer_Type))
                                            <span @if ($vehcile->Trailer_Type == '"(Enclosed Trailer Required)"') class="text-primary font-weight-bold" @endif>{{ $vehcile->Trailer_Type }}</span>
                                        @endif @endforeach"
                                        data-html="true">vehicles ({{ count($List->listing->heavy_equipments) }})
                                    </a>
                                @endif
                                @if (count($List->listing->dry_vans) === 1)
                                    @foreach ($List->listing->dry_vans as $vehcile)
                                        <span title="Freight Class">{{ $vehcile->Freight_Class }}</span>
                                        <span title="Freight Weight">{{ $vehcile->Freight_Weight }}</span>
                                        <b>LBS</b><br>
                                        @if ($vehcile->is_hazmat_Check !== 0)
                                            Hazmat Required<br>
                                        @endif
                                    @endforeach
                                @endif
                                @if (count($List->listing->dry_vans) > 1)
                                    <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                        data-trigger="focus" style="cursor: pointer;" title="Attached vehicles"
                                        data-content=
                                        "@foreach ($List->listing->dry_vans as $vehcile)
                                        <span title="Freight Class">{{ $vehcile->Freight_Class }}</span>
                                        <span title="Freight Weight">{{ $vehcile->Freight_Weight }}</span> <b>LBS</b><br>
                                        @if ($vehcile->is_hazmat_Check !== 0)
                                            Hazmat Required<br>
                                        @endif @endforeach"
                                        data-html="true">vehicles ({{ count($List->listing->dry_vans) }})
                                    </a>
                                @endif
                                <div class="dropdown mt-3">
                                    <a href="javascript:void(0)" tabindex="0"
                                        class="btn btn-outline-primary dropdown-toggle text-truncate"
                                        id="additionalTermsDropdown" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false" style="max-width: 200px;">
                                        {{ $List->listing->additional_info && $List->listing->additional_info->Additional_Terms
                                            ? $List->listing->additional_info->Additional_Terms
                                            : 'Additional Terms' }}
                                    </a>
                                    <div class="dropdown-menu p-3 shadow-sm" aria-labelledby="additionalTermsDropdown"
                                        style="max-width: 300px;">
                                        <p class="dropdown-item-text m-0 text-wrap">
                                            {{ $List->listing->additional_info && $List->listing->additional_info->Additional_Terms
                                                ? $List->listing->additional_info->Additional_Terms
                                                : 'No additional terms available.' }}
                                        </p>
                                    </div>
                                </div>
                                {{-- <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                data-trigger="focus" style="cursor: pointer;"
                                title="Additional Terms" data-content=
                                    "{{ !empty($List->listing->additional_info->Additional_Terms) ? $List->listing->additional_info->Additional_Terms : '' }}">
                                    {{ !empty($List->listing->additional_info->Additional_Terms) ? Str::limit($List->listing->additional_info->Additional_Terms, 20) : '...' }}</a> --}}
                            </td>
                            <td>
                                @if ($List->listing->paymentinfo->Price_Pay_Carrier > 0)
                                    <strong>Job Price:</strong><span>
                                        ${{ $List->listing->paymentinfo->Price_Pay_Carrier }}
                                    </span>  
                                @else
                                    <strong>
                                        Job Price:
                                    </strong>
                                @endif
                                <br>
                                @if ($List->listing->paymentinfo->COD_Amount > 0)
                                    <strong>
                                        @if ($List->listing->paymentinfo->COD_Location_Amount == 'PickUp')
                                            Pay on Pickup:
                                        @else
                                            Pay on Delivery:
                                        @endif
                                    </strong>

                                    <span>${{ $List->listing->paymentinfo->COD_Amount }}</span>
                                @else
                                    <strong>
                                        Pay On Pickup:
                                    </strong>
                                    <br />
                                    <strong>
                                        Pay On Delivery:
                                    </strong>    
                                @endif
                                <br />
                                {{-- <strong>Price to Pay: </strong><span>${{ $List->listing->paymentinfo->COD_Amount }}</span><br>
                                <strong>COD / COP: </strong><br>
                                {{ $List->listing->paymentinfo->COD_Method_Mode }} --}}
                                <span
                                    class="text-nowrap"><strong>Mile:</strong>{{ $List->listing->routes->Miles }}miles</span><br>
                                <span class="text-nowrap"><strong>Price per
                                        Mile:</strong>${{ DayDispatchHelper::PricePerMiles($List->listing->paymentinfo->COD_Amount, $List->listing->routes->Miles) }}/miles</span>

                                {{-- {{ $List->listing->routes->Miles }} miles <br>
                                $ {{ DayDispatchHelper::PricePerMiles($List->listing->paymentinfo->COD_Amount, $List->listing->routes->Miles) }}
                                /miles --}}
                            </td>
                            <td>
                                <strong>Pickup Date: </strong><br>
                                ({{ $List->listing->pickup_delivery_info->Pickup_Date_mode }})
                                {{ \Carbon\Carbon::parse($List->listing->pickup_delivery_info->Pickup_Date)->format('d M, Y') }}
                                @if (!is_null($List->listing->pickup_delivery_info->Pickup_Start_Time))
                                    <br>
                                    {{ \Carbon\Carbon::parse($List->listing->pickup_delivery_info->Pickup_Start_Time)->format('g:i:s A') . ' - ' . \Carbon\Carbon::parse($List->listing->pickup_delivery_info->Pickup_End_Time)->format('g:i:s A') }}
                                @endif
                                <br>
                                <strong>Deliver Date: </strong><br>
                                ({{ $List->listing->pickup_delivery_info->Delivery_Date_mode }})
                                {{ \Carbon\Carbon::parse($List->listing->pickup_delivery_info->Delivery_Date)->format('d M, Y') }}
                                @if (!is_null($List->listing->pickup_delivery_info->Delivery_Start_Time))
                                    <br>
                                    {{ \Carbon\Carbon::parse($List->listing->pickup_delivery_info->Delivery_Start_Time)->format('g:i:s A') . ' - ' . \Carbon\Carbon::parse($List->listing->pickup_delivery_info->Delivery_End_Time)->format('g:i:s A') }}
                                @endif
                            </td>
                            <td>
                                {{-- <div class="dropdown show list-actions">
                                    <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true">
                                        Actions
                                    </a>

                                    <div class="dropdown-menu"> --}}


                                <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                    href="{{ route('User.Watchlist.store', $List->listing->id) }}">
                                    Remove From Watchlist
                                </a>
                                {{-- </div>
                                </div> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">
                {{ $watch_list->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
            </div>
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
        console.log(url);
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
</script>
