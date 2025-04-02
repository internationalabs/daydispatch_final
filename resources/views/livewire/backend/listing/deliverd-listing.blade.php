@section('Delivered', 'mm-active')
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
        <li class="item">Delivered</li>
    </ol>
</div>
<style>
    /* .star-rating {
        display: flex;
        justify-content: center;
        gap: 5px;
    }

    .star-rating input[type="radio"] {
        display: none;
    }

    .star-rating label {
        font-size: 30px;
        color: #ddd;
        cursor: pointer;
        transition: color 0.2s ease-in-out;
    }

    .star-rating label:hover,
    .star-rating label:hover~label {
        color: #ffcc00;
    }

    .star-rating input[type="radio"]:checked~label {
        color: #ffcc00;
    }

    .star-rating input[type="radio"]:checked:hover,
    .star-rating input[type="radio"]:checked~label:hover {
        color: #ffcc00;
    }

    .star-rating label:active {
        transform: scale(1.2);
    }

    .btn-box {
        margin-top: 20px;
    }

    .modal-dialog {
        max-width: 80%;
    } */

    .rating i {
        color: #3d74cd;
        font-size: 18px;
    }

    #rate-stats .svg-inline--fa {
        height: auto !important;
    }

    #rate-stats .stats-box:hover {
        border: 1px solid #052c65 !important;
    }

    .active-stats-box {
        border: 1px solid #052c65 !important;
    }

    .bx {
        font-family: 'boxicons', serif !important;
        font-weight: normal;
        font-style: normal;
        font-variant: normal;
        line-height: 1;
        display: inline-block;
        text-transform: none;
        speak: none;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 25px;
        margin-left: 15px;
    }

    .card .card-body {
        background-color: transparent;
    }

    @media screen and (max-width: 767px) {
        .card-body .table-responsive .table tbody tr td span {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 100px;
        }

        .card-body .table-responsive .progress-content tbody tr td span {
            text-overflow: ellipsis;
            white-space: normal;
            max-width: 50px;
        }

        .card-body .table-responsive .checkbox-td-width tbody tr td,
        .card-body .table-responsive .radio-first-col-width tbody tr td {
            min-width: 200px !important;
        }
    }

    @media screen and (max-width: 575px) {
        div.table-responsive>div.dataTables_wrapper>div.row>div[class^="col-"]:last-child {
            padding-left: 0 !important;
        }

        div.table-responsive>div.dataTables_wrapper>div.row>div[class^="col-"]:first-child {
            padding-right: 0 !important;
        }
    }

</style>
<!-- End Breadcrumb Area -->
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
                <form method="POST" action="{{ route('bulk.action') }}" id="bulk-action-form">
                    @csrf
                    <div class="d-flex align-items-center mb-3">
                        <label class="me-2">Bulk Actions</label>
                        <select name="action_option" class="form-select w-auto" id="bulk-action-select" onchange="toggleSubmitButton()">
                            <option value="" selected>Select Action</option>
                            <option value="archive_delivered">Archive</option>
                        </select>
                        <button type="button" id="submit-button" class="btn btn-outline-primary w-auto ms-2" style="display: none;" onclick="confirmBulkAction()">Submit</button>
                    </div>
                <table class="display dataTable table-1 text-center table-bordered table-cards">
                    <thead class="table-header">
                        <tr>
                            <th style="width: 50px;">
                                <input type="checkbox" id="select-all">
                            </th>
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
                            @if ($List->all_listing && $List->all_listing->routes && $List->all_listing->paymentinfo)
                                <tr class="card-row" data-status="active">
                                    <td>
                                        <input type="checkbox" name="selected_ids[]" value="{{ $List->order_id }}" class="row-checkbox">
                                    </td>
                                    <td>
                                        <div><span
                                                class="badge badge-pill badge-primary">{{ $List->all_listing->Listing_Status }}</span>
                                        </div>
                                        <span
                                            style="font-size: x-large;"><strong>{{ $List->all_listing->Ref_ID }}</strong></span><br>
                                        @if (count($List->all_listing->attachments) > 0)
                                            <strong><a class="text-nowrap"
                                                    href="{{ route('Order.Attachments', ['List_ID' => $List->all_listing->id]) }}"
                                                    target="_blank">View Images</a></strong><br>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- <strong>
                                            <span style="font-size: x-large; "><a
                                                    href="{{ route('View.Profile', $List->all_listing->authorized_user->id) }}"
                                                    target="_blank"><strong>{{ $List->all_listing->authorized_user->Company_Name }}</strong></a></span><br> --}}
                                        {{-- Ph no:{{ $List->all_listing->authorized_user->Contact_Phone }}<br>
                                            Hours:{{ $List->all_listing->authorized_user->Hours_Operations }}<br>
                                            Timezone:{{ $List->all_listing->authorized_user->Time_Zone }}<br> --}}

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
                                        <strong>Time:</strong>
                                        {{ $List->all_listing->authorized_user->Hours_Operations }}
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
                                                <a href="javascript:void(0)" class="dropdown-toggle"
                                                    data-toggle="dropdown"
                                                    style="cursor: pointer;">vehicles({{ count($List->all_listing->vehicles) }})
                                                </a>
                                                <div class="dropdown-menu text-center">
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
                                                <b>W</b>{{ $vehcile->Equip_Width }}
                                                | <b>H</b>{{ $vehcile->Equip_Height }}
                                                | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                                @if (!empty($vehcile->Equipment_Condition))
                                                    <br><span>{{ $vehcile->Equipment_Condition }}</span><br>
                                                @endif
                                                @if (!empty($vehcile->Trailer_Type))
                                                    <span>{{ $vehcile->Trailer_Type }}</span>
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
                                            <br />
                                        @endif
                                        {{-- <strong>Price to pay:</strong><span>
                                            ${{ $List->all_listing->paymentinfo->Price_Pay_Carrier }}</span>
                                        <br> --}}
                                        <span class="text-nowrap"><strong>Pay Mode:
                                            </strong>{{ !empty($List->all_listing->paymentinfo->COD_Method_Mode) ? $List->all_listing->paymentinfo->COD_Method_Mode : '-' }}
                                            {{-- On
                                            {{ !empty($List->all_listing->paymentinfo->COD_Location_Amount) ? $List->all_listing->paymentinfo->COD_Location_Amount : '' }} --}}
                                        </span><br>
                                        <strong>Mile:</strong>{{ $List->all_listing->routes->Miles }} miles<br>
                                        <strong>Price per
                                            Mile:</strong>${{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}/miles
                                    </td>
                                    <td>
                                        @php
                                            // Helper function to get formatted date if Carbon instance, else return raw value
                                            $getFormattedDate = function ($item) {
                                                return $item instanceof \Carbon\Carbon ? $item->format('Y-m-d') : $item;
                                            };
                                        @endphp
                                        @if ($List->all_listing->pickup || $List->all_listing->pickup()->withTrashed()->first())
                                            <strong>Picked up:</strong><br>
                                            <span
                                                class="text-nowrap">{{ $getFormattedDate($List->all_listing->pickup ? $List->all_listing->pickup->created_at : $List->all_listing->pickup()->withTrashed()->first()->created_at) }}</span><br>
                                        @endif
                                        @if ($List->all_listing->deliver || $List->all_listing->deliver()->withTrashed()->first())
                                            <strong>Delivered:</strong><br>
                                            <span
                                                class="text-nowrap">{{ $getFormattedDate($List->all_listing->deliver ? $List->all_listing->deliver->created_at : $List->all_listing->deliver()->withTrashed()->first()->created_at) }}</span><br>
                                        @endif
                                        {{-- @if ($List->all_listing->dispatch_listing || $List->all_listing->dispatch_listing()->withTrashed()->first())
                                            <strong>Dispatched:</strong><br>
                                            <span
                                                class="text-nowrap">{{ $getFormattedDate($List->all_listing->dispatch_listing ? $List->all_listing->dispatch_listing->created_at : $List->all_listing->dispatch_listing()->withTrashed()->first()->created_at) }}</span>
                                        @endif --}}


                                        {{-- @if ($List->all_listing->pickup || $List->all_listing->pickup()->withTrashed()->first())
                                            <strong>Picked up:</strong><br>
                                            {{ $List->all_listing->pickup ? $List->all_listing->pickup->created_at : $List->all_listing->pickup()->withTrashed()->first()->created_at }}<br>
                                        @endif

                                        @if ($List->all_listing->deliver || $List->all_listing->deliver()->withTrashed()->first())
                                            <strong>Delivered:</strong><br>
                                            {{ $List->all_listing->deliver ? $List->all_listing->deliver->created_at : $List->all_listing->deliver()->withTrashed()->first()->created_at }}<br>
                                        @endif

                                        @if ($List->all_listing->dispatch_listing || $List->all_listing->dispatch_listing()->withTrashed()->first())
                                            <strong>Dispatched:</strong><br>
                                            {{ $List->all_listing->dispatch_listing ? $List->all_listing->dispatch_listing->created_at : $List->all_listing->dispatch_listing()->withTrashed()->first()->created_at }}
                                        @endif --}}
                                        {{-- <strong>Pickup:</strong><br>
                                        {{ $List->all_listing->pickup_delivery_info->Pickup_Date }}
                                        ({{ $List->all_listing->pickup_delivery_info->Pickup_Date_mode }})
                                        <br>
                                        <strong>Delivery:</strong><br>
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
                                        {{-- <a class="btn mb-2 btn-primary w-100 btn-sm text-nowrap d-block btn-sm"
                                            href="{{ route('chat', $List->user_id) }}">Message Broker</a> --}}
                                        {{-- @if ($List->all_listing->deliver->delivered_user->user_id === $currentUser->id) --}}
                                        @if ($List->all_listing->Is_Rate != 1)

                                            <a class="btn btn-outline-primary  mb-2 w-100 d-block text-nowrap rate-order"
                                                data-toggle="modal" data-target="#RatingOrderModal"
                                                href="javascript:void(0);">
                                                <input hidden type="text" class="New-Ref-ID"
                                                    value="{{ $List->all_listing->Ref_ID }}">
                                                <input hidden type="text" class="Listed-ID"
                                                    value="{{ $List->all_listing->id }}">
                                                <input hidden type="text" class="Profile-ID"
                                                    value="{{ $List->all_listing->deliver->delivered_user->id }}">
                                                <input hidden type="text" class="Company-Name"
                                                    value="{{ $List->all_listing->deliver->delivered_user->Company_Name }}">
                                                Rate Order
                                            </a>
                                        @else
                                            <a type="button" class="btn btn-outline-primary mb-2 w-100 d-block"
                                                disabled>
                                                <span class="">Rate Order</span>
                                            </a>
                                        @endif
                                        {{-- @endif --}}
                                        <a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                            class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                            role="button">View
                                            Detail</a>
                                        {{-- <a class="btn btn-primary mb-2 w-100 d-block text-nowrap"
                                            href="#">Upload BOL(s)</a> --}}
                                        <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                            href="#"
                                            target="_blank">View BOL</a>
                                        <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                            href="{{ route('User.Listing.Archive', ['List_ID' => $List->all_listing->id]) }}">Archive</a>
                                        {{-- <a class="btn btn-primary mb-2 w-100 d-block text-nowrap compare-listing"
                                            data-toggle="modal" data-target="#CompareListing"
                                            href="javascript:void(0);">
                                            <input hidden type="text" class="Listed-ID"
                                                value="{{ $List->all_listing->id }}">
                                            <input hidden type="text" class="Listed-Type"
                                                value="{{ $List->all_listing->Listing_Type }}">
                                            <input hidden type="text" class="Listed-Miles"
                                                value="{{ $List->all_listing->routes->Miles }}">
                                            Compare Listing</a> --}}
                                        {{-- @if ($List->all_listing->user_id !== $currentUser->id)
                                            <a class="btn btn-primary mb-2 w-100 d-block add-misc"
                                                data-toggle="modal" data-target="#AddMisc"
                                                href="javascript:void(0);">
                                                <input hidden type="text" class="Listed-ID"
                                                    value="{{ $List->all_listing->id }}">Add Misc.</a>
                                        @endif --}}

                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                </form>
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

                <form method="POST" action="{{ route('bulk.action') }}" id="bulk-action-form">
                    @csrf
                    <div class="d-flex align-items-center mb-3">
                        <label class="me-2">Bulk Actions</label>
                        <select name="action_option" class="form-select w-auto" id="bulk-action-select" onchange="toggleSubmitButton()">
                            <option value="" selected>Select Action</option>
                            <option value="archive_delivered">Archive</option>
                        </select>
                        <button type="button" id="submit-button" class="btn btn-outline-primary w-auto ms-2" style="display: none;" onclick="confirmBulkAction()">Submit</button>
                    </div>
                <table class="display dataTable advance-71 table-1 text-center table-bordered table-cards">
                    <thead class="table-header">
                        <tr>
                            <th style="width: 50px;">
                                <input type="checkbox" id="select-all">
                            </th>
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
                                    <input type="checkbox" name="selected_ids[]" value="{{ $List->order_id }}" class="row-checkbox">
                                </td>
                                <td>
                                    <div><span
                                            class="badge badge-pill badge-primary">{{ $List->all_listing->Listing_Status }}</span>
                                    </div>
                                    <span
                                        style="font-size: x-large;"><strong>{{ $List->all_listing->Ref_ID }}</strong></span><br>
                                    @if (count($List->all_listing->attachments) > 0)
                                        <strong>
                                            <a class="text-nowrap"
                                                href="{{ route('Order.Attachments', ['List_ID' => $List->all_listing->id]) }}"
                                                target="_blank">View Images</a>
                                        </strong><br>
                                    @endif
                                </td>
                                <td>
                                    {{-- <strong><a target="_blank"
                                            href="{{ route('View.Profile', $List->all_listing->deliver->delivered_user->id) }}">{{ $List->all_listing->deliver->delivered_user->Company_Name }}</a></strong><br> --}}

                                    @php
                                        $companyName = $List->all_listing->deliver->delivered_user->Company_Name;
                                        $trimmedCompanyName = Str::words($companyName, 3, '...');
                                    @endphp
                                    <span style="font-size: x-large; "><a class="locations-color"
                                            href="{{ route('View.Profile', $List->all_listing->deliver->delivered_user->id) }}"
                                            target="_blank"><strong class="locations-color"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="{{ $companyName }}">
                                                {{ $trimmedCompanyName }}</strong></a></span>
                                    <br>
                                    {{-- <span>
                                    <strong>Contact:</strong>{{ $List->all_listing->deliver->delivered_user->Contact_Phone }}
                                    </span><br>
                                    <strong>Email:</strong>{{ $List->all_listing->deliver->delivered_user->email }}
                                    </span> --}}
                                    <span>
                                        <strong>Contact:</strong>
                                        <a class="locations-color"
                                            href="tel:{{ $List->all_listing->deliver->delivered_user->Contact_Phone }}">
                                            {{ $List->all_listing->deliver->delivered_user->Contact_Phone }}
                                        </a>
                                    </span><br>
                                    <span>
                                        <strong>Email:</strong>
                                        <a class="locations-color"
                                            href="mailto:{{ $List->all_listing->deliver->delivered_user->email }}">
                                            {{ $List->all_listing->deliver->delivered_user->email }}
                                        </a>
                                    </span>
                                    <br>
                                    <strong>Time:</strong>
                                    {{ $List->all_listing->deliver->delivered_user->Hours_Operations }}
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
                                        $userRatings = getUserRating($List->all_listing->deliver->delivered_user->id);
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
                                    {{-- <a href="{{ route('chat', $List->CMP_id) }}">
                                            <button type="button" class="badge badge-success mt-2 border-success"><i class="fas fa-envelope mt-2 fa-lg text-primary"></i>Message Carrier</button>
                                    </a> --}}
                                    <span class="badge badge-pill badge-success" style="cursor:pointer;"
                                        onclick="window.open('{{ route('chat', $List->CMP_id) }}', '_blank')">
                                        Message Carrier
                                    </span>
                                    {{-- <a href="{{ route('chat', $List->CMP_id) }}">
                                            <i class="fas fa-envelope mt-2 fs-3 text-primary"></i>
                                    </a> --}}
                                    {{-- <strong><a class="text-nowrap"
                                            href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                            target="_blank">View Contract</a>
                                    </strong> --}}
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
                                            <a href="javascript:void(0)" class="dropdown-toggle"
                                                data-toggle="dropdown"
                                                style="cursor: pointer;">vehicles({{ count($List->all_listing->vehicles) }})
                                            </a>
                                            <div class="dropdown-menu text-center">
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
                                                {{ $vehcile->Equipment_Model }} </p><br>
                                            <b>L</b>{{ $vehcile->Equip_Length }} |
                                            <b>W</b>{{ $vehcile->Equip_Width }}
                                            | <b>H</b>{{ $vehcile->Equip_Height }}
                                            | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                            @if (!empty($vehcile->Equipment_Condition))
                                                <br><span>{{ $vehcile->Equipment_Condition }}</span><br>
                                            @endif
                                            @if (!empty($vehcile->Trailer_Type))
                                                <span>{{ $vehcile->Trailer_Type }}</span>
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
                                        <br />
                                    @endif
                                    <span class="text-nowrap"><strong>Pay Mode:
                                    </strong>{{ !empty($List->all_listing->paymentinfo->COD_Method_Mode) ? $List->all_listing->paymentinfo->COD_Method_Mode : '-' }}
                                    {{-- On
                                    {{ !empty($List->all_listing->paymentinfo->COD_Location_Amount) ? $List->all_listing->paymentinfo->COD_Location_Amount : '' }} --}}
                                </span><br>
                                    {{-- <strong>Price to Pay:
                                    </strong><span>${{ $List->all_listing->paymentinfo->Price_Pay_Carrier }}</span><br> --}}
                                    {{-- <strong>Assigned
                                        to:</strong>{{ $List->all_listing->deliver->delivered_user->usr_type }}
                                    <br> --}}
                                    {{-- <strong><a
                                            href="{{ route('View.Profile', $List->all_listing->deliver->delivered_user->id) }}"
                                            target="_blank">View MC</a>&nbsp;&nbsp;<a
                                            href="{{ route('View.Profile', $List->all_listing->deliver->delivered_user->id) }}"
                                            target="_blank">View DOT</a></strong> --}}
                                    {{-- @if (!empty($List->all_listing->request_broker->Offer_Price) && $List->all_listing->request_broker->Offer_Price !== 0)
                                    <span class="text-danger fs-5 text-nowrap">
                                        <strong>
                                            Bid Price: ${{ $List->all_listing->request_broker->Offer_Price }}
                                        </strong>
                                    </span><br>
                                    @endif --}}
                                    <strong>Mile:</strong>{{ $List->all_listing->routes->Miles }} miles<br>
                                    <strong>Price per
                                        Mile:</strong>${{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}/miles
                                </td>
                                <td>
                                    @php
                                        // Helper function to get formatted date if Carbon instance, else return raw value
                                        $getFormattedDate = function ($item) {
                                            return $item instanceof \Carbon\Carbon ? $item->format('Y-m-d') : $item;
                                        };
                                    @endphp
                                    @if ($List->all_listing->pickup || $List->all_listing->pickup()->withTrashed()->first())
                                        <strong>Picked up:</strong><br>
                                        {{ $getFormattedDate($List->all_listing->pickup ? $List->all_listing->pickup->created_at : $List->all_listing->pickup()->withTrashed()->first()->created_at) }}<br>
                                    @endif
                                    @if ($List->all_listing->deliver || $List->all_listing->deliver()->withTrashed()->first())
                                        <strong>Delivered:</strong><br>
                                        {{ $getFormattedDate($List->all_listing->deliver ? $List->all_listing->deliver->created_at : $List->all_listing->deliver()->withTrashed()->first()->created_at) }}<br>
                                    @endif
                                    {{-- @if ($List->all_listing->dispatch_listing || $List->all_listing->dispatch_listing()->withTrashed()->first())
                                        <strong>Dispatched:</strong><br>
                                        {{ $getFormattedDate($List->all_listing->dispatch_listing ? $List->all_listing->dispatch_listing->created_at : $List->all_listing->dispatch_listing()->withTrashed()->first()->created_at) }}
                                    @endif --}}
                                    {{-- @if ($List->all_listing->pickup || $List->all_listing->pickup()->withTrashed()->first())
                                        <strong>Picked up:</strong><br>
                                        {{ $List->all_listing->pickup ? $List->all_listing->pickup->created_at : $List->all_listing->pickup()->withTrashed()->first()->created_at }}<br>
                                    @endif
                                    @if ($List->all_listing->deliver || $List->all_listing->deliver()->withTrashed()->first())
                                        <strong>Delivered:</strong><br>
                                        {{ $List->all_listing->deliver ? $List->all_listing->deliver->created_at : $List->all_listing->deliver()->withTrashed()->first()->created_at }}<br>
                                    @endif
                                    @if ($List->all_listing->dispatch_listing || $List->all_listing->dispatch_listing()->withTrashed()->first())
                                        <strong>Dispatched:</strong><br>
                                        {{ $List->all_listing->dispatch_listing ? $List->all_listing->dispatch_listing->created_at : $List->all_listing->dispatch_listing()->withTrashed()->first()->created_at }}
                                    @endif --}}
                                    {{-- <strong>Created At:</strong><br>
                                    {{ $List->created_at }}<br>
                                    <strong>Modified At:</strong><br>
                                    {{ $List->updated_at }} <br>
                                    <strong>PickUp:</strong>{{ $List->all_listing->pickup_delivery_info->Pickup_Date }}
                                    ({{ $List->all_listing->pickup_delivery_info->Pickup_Date_mode }})
                                    <br>
                                    <strong>Delivery: </strong>
                                    {{ $List->all_listing->pickup_delivery_info->Delivery_Date }}
                                    ({{ $List->all_listing->pickup_delivery_info->Delivery_Date_mode }})
                                    <br> --}}
                                </td>
                                <td>
                                    {{-- <div class="dropdown show list-actions">
                                        <a class="btn btn-success dropdown-toggle btn-sm" href="#"
                                            role="button" data-toggle="dropdown" aria-haspopup="true">
                                            Actions
                                        </a>
                                        <div class="dropdown-menu"> --}}
                                    {{-- <a class="btn mb-2 btn-primary w-50 btn-sm text-nowrap"
                                        href="{{ route('chat', $List->CMP_id) }}">Message Carrier</a> --}}
                                    @if ($List->all_listing->user_id === $currentUser->id)
                                        @if ($List->all_listing->Is_Rate != 1)
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block rate-order"
                                                data-toggle="modal" data-target="#RatingOrderModal"
                                                href="javascript:void(0);">
                                                <input hidden type="text" class="New-Ref-ID"
                                                    value="{{ $List->all_listing->Ref_ID }}">
                                                <input hidden type="text" class="Listed-ID"
                                                    value="{{ $List->all_listing->id }}">
                                                <input hidden type="text" class="Profile-ID"
                                                    value="{{ $List->all_listing->deliver->delivered_user->id }}">
                                                <input hidden type="text" class="Company-Name"
                                                    value="{{ $List->all_listing->deliver->delivered_user->Company_Name }}">
                                                Rate Order
                                            </a>
                                        @else
                                            <a type="button" class="btn btn-outline-primary mb-2 w-100 d-block"
                                                disabled>
                                                <span class="">Rate Order</span>
                                            </a>
                                        @endif
                                    @endif
                                    <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                        href="{{ route('User.Listing.Archive', ['List_ID' => $List->all_listing->id]) }}">Archive</a>
                                    <a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                        class="btn btn-outline-primary mb-2 w-100 d-block" role="button">View
                                        Detail</a>
                                    {{-- <a href="#" class="btn btn-outline-primary mb-2 w-100 d-block" role="button">Replicate Listing (s)</a> --}}
                                    <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                        onclick="window.location.href='{{ route('User.Replicate.Listing', ['List_ID' => $List->all_listing->id]) }}'">
                                        Replicate Listing
                                    </a>
                                    @if ($List->all_listing->dispatch_bol)
                                        <a class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                            >View
                                            BOL</a>
                                    @endif
                                    {{-- <a class="btn btn-outline-primary mb-2 w-100 d-block compare-listing"
                                        data-toggle="modal" data-target="#CompareListing" href="javascript:void(0);">
                                        <input hidden type="text" class="Listed-ID"
                                            value="{{ $List->all_listing->id }}">
                                        <input hidden type="text" class="Listed-Type"
                                            value="{{ $List->all_listing->Listing_Type }}">
                                        <input hidden type="text" class="Listed-Miles"
                                            value="{{ $List->all_listing->routes->Miles }}">
                                        Compare Listing</a> --}}
                                    {{-- @if ($List->all_listing->user_id === $currentUser->id)
                                        <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                            href="{{ route('User.Edit.Listing', ['List_ID' => $List->all_listing->id]) }}">Edit
                                            Listing</a>
                                        <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                            href="{{ route('Order.Completed', ['List_ID' => $List->all_listing->id]) }}">Completed</a>
                                        <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                               href="{{ route('Order.Not.Completed', ['List_ID' => $List->all_listing->id]) }}">Not
                                                Completed</a>
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                               href="{{ route('User.Listing.Archive', ['List_ID' => $List->all_listing->id]) }}">Archive
                                                Order</a>
                                    @endif --}}
                                    @if ($List->all_listing->user_id !== $currentUser->id)
                                        <a class="btn btn-outline-primary mb-2 w-100 d-block add-misc"
                                            data-toggle="modal" data-target="#AddMisc" href="javascript:void(0);">
                                            <input hidden type="text" class="Listed-ID"
                                                value="{{ $List->all_listing->id }}">Add Misc.</a>
                                    @endif
                                    {{-- </div>
                                    </div> --}}
                                </td>
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

<script>
    function toggleSubmitButton() {
    const action = document.getElementById('bulk-action-select').value;
    const submitButton = document.getElementById('submit-button');

    if (action) {
        submitButton.style.display = 'inline-block'; // Show the button
    } else {
        submitButton.style.display = 'none'; // Hide the button
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

document.getElementById('select-all').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.row-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
});
</script>

<script>
    // $('.timelinessValue').click(function() {
    //     console.log('timelinessValue', $(this).val());
    // });
    //     document.getElementById('ratingForm').addEventListener('submit', function(e) {
    //     e.preventDefault(); // Prevent default form submission


    //     // if (timelinessValue) {
    //     //     fetch('/submit-rating', {
    //     //         method: 'POST',
    //     //         headers: { 'Content-Type': 'application/json' },
    //     //         body: JSON.stringify({ Timeliness: timelinessValue })
    //     //     }).then(response => response.json())
    //     //       .then(data => console.log(data))
    //     //       .catch(error => console.error(error));
    //     // } else {
    //     //     alert('Please select a rating for Timeliness.');
    //     // }
    // });
</script>
