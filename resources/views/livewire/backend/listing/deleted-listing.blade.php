@section('Listing', 'mm-active')
<!-- Breadcrumb Area -->
@php
    use Illuminate\Support\Facades\Auth;
    $currentUser = Auth::guard('Authorized')->user();
@endphp
<div class="breadcrumb-area">
    <h1>{{ $currentUser->usr_type }} Listing </h1>

    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>

        <li class="item">Deleted ( All The deleted ids Show For 30 Days, After 30 day The deleted ids Will Be
            Automatically Removed.)
        </li>
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
</style>
<!-- End Breadcrumb Area -->
@include('partials.global-search')
<div class="card">
    <div class="card-body">
        @if ($currentUser->usr_type === 'Carrier')
            {{--    <div class="table-responsive dataTables_wrapper me-0 d-flex">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <table>
                        <tbody class="dataTables_filter">
                            <tr>
                                <form class="nav-search-form d-none ml-auto d-md-block hiddenDivsecond" method="POST"
                                    action="{{ route('User.Company.Search') }}">
                                    @csrf
                                    <td><strong>Search For: </strong></td>
                                    <td>
                                        <select class="form-control ml-1" onchange="myfunc(event)" id="Search_Criteria"
                                            name="Search_Criteria">
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
                                        <div class="hiddenDiv">
                                            <input type="text" class="form-control d-none" class="hiddenValueinput"
                                                required>
                                        </div>
                                    </td>
                                </form>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <tbody class="dataTables_filter">
                            <tr>
                                <td><strong>Search Vehicle Type: </strong></td>
                                <td>
                                    <form id="Search_vehicleType_form" action="{{ route('User.Listing') }}">
                                        <select class="form-control ml-1" id="Search_vehicleType"
                                            name="Search_vehicleType">
                                            <option>Select Vehicle Type</option>
                                            <option value="heavy_equipments"
                                                @if ($Search_vehicleType == 'heavy_equipments') selected @endif>Heavy Equipments
                                            </option>
                                            <option value="vehicles" @if ($Search_vehicleType == 'vehicles') selected @endif>
                                                Vehicles(Autos)</option>
                                            <option value="dry_vans" @if ($Search_vehicleType == 'dry_vans') selected @endif>
                                                Freight Shipping</option>
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
                <table class="table-1 display dataTable advance-68 text-center table-bordered table-cards">
                    <thead class="table-header">
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
                            @if (!$auth_user->is_heavy_subscribe)
                                @continue($List->Listing_Type === 2)
                            @endif
                            @if (!$auth_user->is_dry_van_subscribe)
                                @continue($List->Listing_Type === 3)
                            @endif
                            <tr class="card-row" data-status="active">
                                <td>
                                    <div><strong style="font-size: 14px;"></strong><br><span
                                            class="badge badge-pill badge-primary">Deleted</span></div>
                                    <span style="font-size: x-large;"><strong>{{ $List->Ref_ID }}</strong></span><br>
                                    @if (count($List->attachments) > 0)
                                        <strong><a href="{{ route('Order.Attachments', ['List_ID' => $List->id]) }}"
                                                target="_blank">View Images</a></strong><br>
                                    @endif
                                </td>
                                <td>
                                    <strong>Pickup</strong><br>
                                    <a href="https://www.google.com/maps/place/{{ urlencode($List->routes->Origin_ZipCode) }}"
                                        target="_blank">
                                        {{-- <i class="fas fa-map-marker-alt text-success fs-30"></i> --}}
                                        {{ Str::replace(',', '-', $List->routes->Origin_ZipCode) }}
                                    </a><br>
                                    <strong>Delivery</strong><br>
                                    <a href="https://www.google.com/maps/place/{{ urlencode($List->routes->Dest_ZipCode) }}"
                                        target="_blank">
                                        {{-- <i class="fas fa-map-marker-alt text-danger fs-30"></i> --}}
                                        {{ Str::replace(',', '-', $List->routes->Dest_ZipCode) }}
                                    </a>
                                    <div class="mb-2">
                                        <span class="fs-5 bg-white"><strong><a class="badge badge-pill badge-primary"
                                                    href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                    target="_blank">View Route</a></strong></span>
                                    </div>
                                </td>
                                <td>
                                    @if (count($List->vehicles) === 1)
                                        @foreach ($List->vehicles as $vehcile)
                                            <a class="font-weight-bold text-dark"
                                                href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                target="_blank"><span
                                                    class="fs-5"><strong>{{ $vehcile->Vehcile_Year }}
                                                        {{ $vehcile->Vehcile_Make }}
                                                        {{ $vehcile->Vehcile_Model }}</strong></span></a><br>
                                            @if (!empty($vehcile->Vehcile_Condition))
                                                <span>
                                                    {{ $vehcile->Vehcile_Condition }}</span><br>
                                            @endif
                                            @if (!empty($vehcile->Trailer_Type))
                                                <span>
                                                    @if ($vehcile->Trailer_Type == '"(Enclosed Trailer Required)"')
                                                    @endif{{ $vehcile->Trailer_Type }}
                                                </span>
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
                                            <span @if ($vehcile->Trailer_Type == "'(Enclosed Trailer Required)'") class='text-primary font-weight-bold' @endif{{ $vehcile->Trailer_Type }}</span> <br>
                                        @endif @endforeach"
                                            data-html="true">vehicles ({{ count($List->vehicles) }})
                                        </a>
                                    @endif
                                    @if (count($List->heavy_equipments) === 1)
                                        @foreach ($List->heavy_equipments as $vehcile)
                                            <span style="font-size: large;"><a class="font-weight-bold text-dark"
                                                    href='https://www.google.com/search?q={{ $vehcile->Equipment_Year }}%20{{ $vehcile->Equipment_Make }}%20{{ $vehcile->Equipment_Model }}'
                                                    target='_blank'>{{ $vehcile->Equipment_Year }}
                                                    {{ $vehcile->Equipment_Make }}
                                                    {{ $vehcile->Equipment_Model }}</a></span><br>
                                            <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }}
                                            | <b>H</b>{{ $vehcile->Equip_Height }}
                                            | {{ $vehcile->Equip_Weight }} <b>LBS</b><br>
                                            @if (!empty($vehcile->Equipment_Condition))
                                                <span
                                                    class="badge badge-pill mt-2 @if ($vehcile->Equipment_Condition == 'Running') badge-success @elseif($vehcile->Equipment_Condition == 'Not Running') badge-danger @else badge-primary @endif"
                                                    style="font-size: 16px;">
                                                    {{ $vehcile->Equipment_Condition }}
                                                </span>
                                            @endif
                                            @if (!empty($vehcile->Trailer_Type))
                                                <span class="badge badge-pill mt-2 badge-primary font-weight-bold"
                                                    style="font-size: 16px;">{{ $vehcile->Trailer_Type }}</span><br>
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
                                            <span @if ($vehcile->Trailer_Type == "'(Enclosed Trailer Required)'") class='text-primary font-weight-bold' @endif{{ $vehcile->Trailer_Type }}</span>
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
                                    <div class="dropdown">
                                        <a href="javascript:void(0)" tabindex="0" class="btn btn-link dropdown-toggle"
                                            id="additionalTermsDropdown" role="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
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
                                    </div>
                                </td>
                                <td>
                                    <strong><a
                                            href="{{ route('View.Profile', ['user_id' => $List->authorized_user->id]) }}">{{ $List->authorized_user->Company_Name }}</a></strong><br>
                                    {{ $List->authorized_user->Contact_Phone }}<br>
                                    {{ $List->authorized_user->Hours_Operations }}<br>
                                    {{ $List->authorized_user->Time_Zone }}
                                    <br>
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

                                        $userRatings = getUserRating($List->authorized_user->id);
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
                                </td>
                                <td>
                                    <strong>Price to Pay:
                                    </strong><span>${{ $List->paymentinfo->Price_Pay_Carrier }}</span><br>
                                    <strong>COP Amount: </strong>${{ $List->paymentinfo->COD_Amount }}<br>
                                    <strong>COD / COP:</strong>{{ $List->paymentinfo->COD_Method_Mode }}<br>
                                    {{ $List->routes->Miles }}miles<br>
                                    ${{ DayDispatchHelper::PricePerMiles($List->paymentinfo->COD_Amount, $List->routes->Miles) }}/miles
                                </td>
                                <td>
                                    <strong>Pickup Date: </strong><br>
                                    ({{ $List->pickup_delivery_info->Pickup_Date_mode }})
                                    {{ $List->pickup_delivery_info->Pickup_Date }}
                                    @if (!is_null($List->pickup_delivery_info->Pickup_Start_Time))
                                        <br>
                                        {{ \Carbon\Carbon::parse($List->pickup_delivery_info->Pickup_Start_Time)->format('g:i:s A') . ' - ' . \Carbon\Carbon::parse($List->pickup_delivery_info->Pickup_End_Time)->format('g:i:s A') }}
                                    @endif
                                    <br>
                                    <strong>Deliver Date: </strong><br>
                                    ({{ $List->pickup_delivery_info->Delivery_Date_mode }})
                                    {{ $List->pickup_delivery_info->Delivery_Date }}
                                    @if (!is_null($List->pickup_delivery_info->Delivery_Start_Time))
                                        <br>
                                        {{ \Carbon\Carbon::parse($List->pickup_delivery_info->Delivery_Start_Time)->format('g:i:s A') . ' - ' . \Carbon\Carbon::parse($List->pickup_delivery_info->Delivery_End_Time)->format('g:i:s A') }}
                                    @endif
                                </td>
                                <td>
                                    <strong>Expired Date: </strong><br>
                                    {{ $List->expire_at }}
                                    {{-- <div class="dropdown show list-actions">
                                        <a class="btn btn-success dropdown-toggle btn-sm" href="#"
                                            role="button" data-toggle="dropdown" aria-haspopup="true">
                                            Actions
                                        </a>
                                        <div class="dropdown-menu"> --}}
                                            @if ($List->user_id === $currentUser->id)
                                                <a class="btn btn-primary mb-2 w-100 d-block text-nowrap"
                                                    href="{{ route('User.Deleted.Restore', ['List_ID' => $List->id]) }}">Restore
                                                    Listing</a>
                                            @endif
                                        {{-- </div>
                                    </div> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="table-responsive dataTables_wrapper me-0 d-flex">

                <div class="col-lg-6 col-md-6 col-sm-12">
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

            </div>
            <div class="table-responsive">
                <table class="table-1 display dataTable advance-68 text-center table-bordered table-cards">
                    <thead class="table-header">
                        <tr>
                            <th>ID</th>
                            <th>Company info</th>
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
                                    <div><span class="badge badge-pill badge-primary">Deleted</span></div>
                                    <span style="font-size: x-large;"><strong>{{ $List->Ref_ID }}</strong></span><br>
                                    @if (count($List->attachments) > 0)
                                        <strong><a href="{{ route('Order.Attachments', ['List_ID' => $List->id]) }}"
                                                target="_blank">View Images</a></strong><br>
                                    @endif
                                </td>
                                <td>
                                    <span style="font-size: x-large; "><a
                                            href="{{ route('View.Profile', ['user_id' => $List->authorized_user->id]) }}"><strong>{{ $List->authorized_user->Company_Name }}</strong></a></span><br>
                                    {{ $List->authorized_user->Contact_Phone }}<br>
                                    {{ $List->authorized_user->Hours_Operations }}<br>
                                    {{ $List->authorized_user->Time_Zone }}
                                    <br>
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

                                        $userRatings = getUserRating($List->authorized_user->id);
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
                                </td>
                                <td>
                                    <span style="font-size: large;"><strong>Pickup</strong></span><br>
                                    <a href="https://www.google.com/maps/place/{{ urlencode($List->routes->Origin_ZipCode) }}"
                                        target="_blank">
                                        {{-- <i class="fas fa-map-marker-alt text-success fs-30"></i> --}}
                                        {{ Str::replace(',', '-', $List->routes->Origin_ZipCode) }}
                                    </a><br>
                                    <span style="font-size: large;"><strong>Delivery</strong></span><br>
                                    <a href="https://www.google.com/maps/place/{{ urlencode($List->routes->Dest_ZipCode) }}"
                                        target="_blank">
                                        {{-- <i class="fas fa-map-marker-alt text-danger fs-30"></i> --}}
                                        {{ Str::replace(',', '-', $List->routes->Dest_ZipCode) }}
                                    </a>
                                    <div class="mb-2">
                                        <span class="fs-5 bg-white"><strong><a
                                                    class="badge badge-pill badge-primary text-white"
                                                    href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                                    target="_blank">View Route</a></strong></span>
                                    </div>
                                </td>
                                <td>
                                    @if (count($List->vehicles) === 1)
                                        @foreach ($List->vehicles as $vehcile)
                                            <span style="font-size: large; "><a class="font-weight-bold text-dark"
                                                    href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                    target="_blank">{{ $vehcile->Vehcile_Year }}
                                                    {{ $vehcile->Vehcile_Make }}
                                                    {{ $vehcile->Vehcile_Model }}</a></span><br>
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
                                    @if (count($List->vehicles) > 1)
                                        {{-- <a href="javascript:void(0)" tabindex="0" class=""
                                            data-toggle="popover" data-trigger="focus" style="cursor: pointer;"
                                            title="Attached vehicles"
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
                                                <span @if ($vehcile->Trailer_Type == "'(Enclosed Trailer Required)'") class='text-primary font-weight-bold' @endif{{ $vehcile->Trailer_Type }}</span> <br>
                                            @endif @endforeach"
                                            data-html="true">vehicles ({{ count($List->vehicles) }})
                                        </a> --}}
                                        <div class="dropdown">
                                            <a href="javascript:void(0)" class="dropdown-toggle"
                                                data-toggle="dropdown" style="cursor: pointer;">vehicles
                                                ({{ count($List->vehicles) }})
                                            </a>
                                            <div class="dropdown-menu text-center p-2">
                                                <h6 class="dropdown-header" style="background-color: lightgrey;">
                                                    Attached Vehicles</h6>
                                                @foreach ($List->vehicles as $vehcile)
                                                    <a class="dropdown-item" style="color: #0d6efd; font-weight: 800;"
                                                        href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                        target="_blank">{{ $vehcile->Vehcile_Year }}{{ $vehcile->Vehcile_Make }}{{ $vehcile->Vehcile_Model }}</a>
                                                    <div class="d-flex justify-content-center">
                                                        @if (!empty($vehcile->Vehcile_Condition))
                                                            <span
                                                                class="badge rounded-pill bg-success text-white">{{ $vehcile->Vehcile_Condition }}</span>
                                                        @endif
                                                        @if (!empty($vehcile->Trailer_Type))
                                                            <span
                                                                class="badge rounded-pill bg-primary text-white">{{ $vehcile->Trailer_Type }}</span>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    @if (count($List->heavy_equipments) === 1)
                                        @foreach ($List->heavy_equipments as $vehcile)
                                            <span style="font-size: large;"><a class="font-weight-bold text-dark"
                                                    href='https://www.google.com/search?q={{ $vehcile->Equipment_Year }}%20{{ $vehcile->Equipment_Make }}%20{{ $vehcile->Equipment_Model }}'
                                                    target="_blank">{{ $vehcile->Equipment_Year }}
                                                    {{ $vehcile->Equipment_Make }}
                                                    {{ $vehcile->Equipment_Model }}</a></span><br>
                                            <b>L</b>{{ $vehcile->Equip_Length }} |
                                            <b>W</b>{{ $vehcile->Equip_Width }}
                                            | <b>H</b>{{ $vehcile->Equip_Height }}
                                            | {{ $vehcile->Equip_Weight }} <b>LBS</b><br>
                                            @if (!empty($vehcile->Equipment_Condition))
                                                <span
                                                    class="badge badge-pill mt-2 @if ($vehcile->Equipment_Condition == 'Running') badge-success @elseif($vehcile->Equipment_Condition == 'Not Running') badge-danger @else badge-primary @endif"
                                                    style="font-size: 16px;">
                                                    {{ $vehcile->Equipment_Condition }}
                                                </span>
                                            @endif
                                            @if (!empty($vehcile->Trailer_Type))
                                                <span class="badge badge-pill mt-2 badge-primary font-weight-bold"
                                                    style="font-size: 16px;">{{ $vehcile->Trailer_Type }}</span><br>
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
                                            <span @if ($vehcile->Trailer_Type == "'(Enclosed Trailer Required)'") class='text-primary font-weight-bold' @endif{{ $vehcile->Trailer_Type }}</span>
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
                                        {{-- <a href="javascript:void(0)" tabindex="0" class=""
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
                                        </a> --}}
                                        <div class="dropdown">
                                            <a href="javascript:void(0)" class="dropdown-toggle"
                                                data-toggle="dropdown" style="cursor: pointer;">Freight
                                                ({{ count($List->dry_vans) }})
                                            </a>
                                            <div class="dropdown-menu text-center p-2">
                                                <h6 class="dropdown-header" style="background-color: lightgrey;">
                                                    Attached Freight</h6>
                                                @foreach ($List->dry_vans as $vehcile)
                                                    <a class="dropdown-item"
                                                        style="color: #0d6efd; font-weight: 800;">
                                                        <span
                                                            title='Freight Class'>{{ $vehcile->Freight_Class }}</span>
                                                        <span
                                                            title='Freight Weight'>{{ $vehcile->Freight_Weight }}</span>
                                                        <b>LBS</b><br>
                                                        @if ($vehcile->is_hazmat_Check !== 0)
                                                            Hazmat Required<br>
                                                        @endif
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    <br>
                                    <div class="dropdown">
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
                                    </div>
                                </td>
                                <td>
                                    @if ($List->paymentinfo)
                                        <strong>Price to Pay: </strong> <span>$
                                            {{ $List->paymentinfo->Price_Pay_Carrier }}</span><br>
                                        <strong>COP Amount: </strong> $
                                        {{ $List->paymentinfo->COD_Amount }}<br>
                                        <strong>COD / COP: </strong>
                                        {{ $List->paymentinfo->COD_Method_Mode }}<br>
                                        {{ $List->routes->Miles }} miles <br>
                                        ${{ DayDispatchHelper::PricePerMiles($List->paymentinfo->COD_Amount, $List->routes->Miles) }}/miles
                                    @endif
                                </td>
                                <td>
                                    @if ($List->pickup_delivery_info)
                                        <strong>Pickup Date: </strong><br>
                                        ({{ $List->pickup_delivery_info->Pickup_Date_mode }})
                                        {{ $List->pickup_delivery_info->Pickup_Date }}
                                        @if (!is_null($List->pickup_delivery_info->Pickup_Start_Time))
                                            <br>
                                            {{ \Carbon\Carbon::parse($List->pickup_delivery_info->Pickup_Start_Time)->format('g:i:s A') . ' - ' . \Carbon\Carbon::parse($List->pickup_delivery_info->Pickup_End_Time)->format('g:i:s A') }}
                                        @endif
                                        <br>
                                        <strong>Deliver Date: </strong><br>
                                        ({{ $List->pickup_delivery_info->Delivery_Date_mode }})
                                        {{ $List->pickup_delivery_info->Delivery_Date }}
                                        @if (!is_null($List->pickup_delivery_info->Delivery_Start_Time))
                                            <br>
                                            {{ \Carbon\Carbon::parse($List->pickup_delivery_info->Delivery_Start_Time)->format('g:i:s A') . ' - ' . \Carbon\Carbon::parse($List->pickup_delivery_info->Delivery_End_Time)->format('g:i:s A') }}
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    {{-- <div class="dropdown show list-actions">
                                        <a class="btn btn-success dropdown-toggle btn-sm" href="#"
                                            role="button" data-toggle="dropdown" aria-haspopup="true">
                                            Actions
                                        </a>
                                        <div class="dropdown-menu"> --}}
                                            @if ($List->user_id === $currentUser->id)
                                                <a class="btn btn-primary mb-2 w-100 d-block text-nowrap"
                                                    href="{{ route('User.Deleted.Restore', ['List_ID' => $List->id]) }}">Restore
                                                    Listing</a>
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
                                    Enter Pickup Date.
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
                                    Enter Delivery Date.
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
<script>
    $('.advance-68').DataTable({
        "deferRender": true,
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