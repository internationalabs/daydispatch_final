@section('Completed', 'mm-active')
    @php
        use Illuminate\Support\Facades\Auth;
        $currentUser = Auth::guard('Authorized')->user();
    @endphp
    <style>
        .rating i {
            color: #3d74cd;
            font-size: 18px;
        }

        #rate-stats .svg-inline--fa {
            height: auto !important;
        }

        #rate-stats .stats-box:hover {
            border: 1px solid #e1000a !important;
        }

        .active-stats-box {
            border: 1px solid #e1000a !important;
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
    <div class="breadcrumb-area">
        <h1>{{ $currentUser->usr_type }} Listing</h1>

        <ol class="breadcrumb">
            <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>

            <li class="item">Completed</li>
        </ol>

    </div>
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
                    <table class="display dataTable advance-72 text-center table-1 table-bordered table-cards">
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
                                        <h6><span
                                                class="badge badge-primary">{{ $List->all_listing->Listing_Status }}</span>
                                        </h6>
                                        <span
                                            style="font-size: x-large;"><strong>{{ $List->all_listing->Ref_ID }}</strong></span><br>
                                        @if (count($List->all_listing->attachments) > 0)
                                            <strong><a
                                                    href="{{ route('Order.Attachments', ['List_ID' => $List->all_listing->id]) }}"
                                                    target="_blank">View Images</a>
                                            </strong><br>
                                        @endif
                                    </td>
                                    <td><span style="font-size: x-large;"><a
                                                href="{{ route('View.Profile', $List->all_listing->authorized_user->id) }}"
                                                target="_blank">{{ $List->all_listing->authorized_user->Company_Name }}</a></span><br>
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
                                            <a href="tel:{{ $List->all_listing->authorized_user->Contact_Phone }}">
                                                {{ $List->all_listing->authorized_user->Contact_Phone }}
                                            </a>
                                        </span><br>
                                        <span>
                                            <strong>Email:</strong>
                                            <a href="mailto:{{ $List->all_listing->authorized_user->email }}">
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
                                        <span class="badge badge-pill badge-success" style="cursor:pointer;" onclick="window.open('{{ route('chat', $List->user_id) }}', '_blank')">
                                            Message Broker
                                        </span>
                                    </td>
                                    <td>
                                        <strong style="font-size: large;">Pick up</strong><br>
                                        {{-- <i class="fas fa-map-marker-alt text-success fs-30"></i> --}}
                                        <a href="https://www.google.com/maps/place/{{ urlencode($List->all_listing->routes->Origin_ZipCode) }}"
                                            target="_blank">
                                            {{ Str::replace(',', '-', $List->all_listing->routes->Origin_ZipCode) }}
                                        </a><br>

                                        <strong style="font-size: large;">Delivery</strong><br>
                                        {{-- <i class="fas fa-map-marker-alt text-danger fs-30"></i> --}}
                                        <a href="https://www.google.com/maps/place/{{ urlencode($List->all_listing->routes->Dest_ZipCode) }}"
                                            target="_blank">
                                            {{ Str::replace(',', '-', $List->all_listing->routes->Dest_ZipCode) }}
                                        </a>
                                    </td>
                                    <td>
                                        @if (count($List->all_listing->vehicles) === 1)
                                            @foreach ($List->all_listing->vehicles as $vehcile)
                                                {{-- <p class="ymm">  {{ $vehcile->Vehcile_Year }}
                                            {{ $vehcile->Vehcile_Make }}
                                            {{ $vehcile->Vehcile_Model }}  </p><br> --}}

                                                <a class="font-weight-bold text-dark text-nowrap"
                                                    href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                                    target="_blank"><span
                                                        class="fs-5"><strong>{{ $vehcile->Vehcile_Year }}
                                                            {{ $vehcile->Vehcile_Make }}
                                                            {{ $vehcile->Vehcile_Model }}</strong></span></a><br>
                                                {{-- @if (!empty($vehcile->Vehcile_Condition))
                                                <span> {{ $vehcile->Vehcile_Condition }} </span><br>
                                            @endif
                                            @if (!empty($vehcile->Trailer_Type))
                                            <span>  {{ $vehcile->Trailer_Type }} </span>
                                            @endif --}}
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
                                                <a href="javascript:void(0)"
                                                    class="dropdown-toggle font-weight-bold text-dark text-nowrap"
                                                    data-toggle="dropdown">
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
                                        @endif
                                        @if (count($List->all_listing->heavy_equipments) === 1)
                                            @foreach ($List->all_listing->heavy_equipments as $vehcile)
                                                {{-- <p class="ymm"> {{ $vehcile->Equipment_Year }}
                                            {{ $vehcile->Equipment_Make }}
                                            {{ $vehcile->Equipment_Model }} </p><br> --}}

                                                <a class="font-weight-bold text-dark text-nowrap"
                                                    href='https://www.google.com/search?q={{ $vehcile->Equipment_Year }}%20{{ $vehcile->Equipment_Make }}%20{{ $vehcile->Equipment_Model }}'
                                                    target='_blank'><span
                                                        class="fs-5"><strong>{{ $vehcile->Equipment_Year }}
                                                            {{ $vehcile->Equipment_Make }}
                                                            {{ $vehcile->Equipment_Model }}</strong></span>
                                                </a><br>
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
                                        <div class="dropdown">
                                            <a href="javascript:void(0)" tabindex="0" class="btn btn-link dropdown-toggle"
                                                id="additionalTermsDropdown" role="button" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                {{ !empty($List->all_listing->additional_info->Additional_Terms)
                                                    ? Str::limit($List->all_listing->additional_info->Additional_Terms, 20)
                                                    : '...' }}
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="additionalTermsDropdown">
                                                <p class="dropdown-item">
                                                    {{ !empty($List->all_listing->additional_info->Additional_Terms)
                                                        ? $List->all_listing->additional_info->Additional_Terms
                                                        : 'No additional terms available' }}
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
                                        <strong>Price to Pay:
                                        </strong><span>${{ $List->all_listing->paymentinfo->Price_Pay_Carrier }}</span>
                                        <br>
                                        {{ !empty($List->all_listing->paymentinfo->COD_Method_Mode) ? $List->all_listing->paymentinfo->COD_Method_Mode : '' }}
                                        On
                                        {{ !empty($List->all_listing->paymentinfo->COD_Location_Amount) ? $List->all_listing->paymentinfo->COD_Location_Amount : '' }}<br>
                                        {{ $List->all_listing->routes->Miles }} miles<br>
                                        ${{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}
                                        /miles
                                    </td>
                                    <td>
                                        <strong>Created At:</strong><br>
                                        {{ $List->created_at }}<br>
                                        <strong>Modified At:</strong><br>
                                        {{ $List->updated_at }}<br>
                                        <strong>Pickup:</strong><br>
                                        {{ $List->all_listing->pickup_delivery_info->Pickup_Date }}
                                        ({{ $List->all_listing->pickup_delivery_info->Pickup_Date_mode }})
                                        <br>
                                        <strong>Delivery:</strong><br>
                                        {{ $List->all_listing->pickup_delivery_info->Delivery_Date }}
                                        ({{ $List->all_listing->pickup_delivery_info->Delivery_Date_mode }})
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                            href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                            target="_blank">View Route</a>
                                        <a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                            class="btn btn-outline-primary mb-2 w-100 d-block" role="button">View Detail</a>
                                        @if ($List->all_listing->completed->completed_user->id === $currentUser->id && $List->all_listing->Is_Rate != 1)
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block rate-order" data-toggle="modal"
                                                data-target="#RatingOrderModal" href="javascript:void(0);">
                                                <input hidden type="hidden" class="New-Ref-ID"
                                                    value="{{ $List->all_listing->Ref_ID }}">
                                                <input hidden type="hidden" class="Listed-ID"
                                                    value="{{ $List->all_listing->id }}">
                                                <input hidden type="hidden" class="Profile-ID"
                                                    value="{{ $List->all_listing->completed->completed_user->id }}">
                                                Rate Order
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                    <table class="display dataTable advance-72 text-center table-1 table-bordered table-cards">
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
                                        <div><span
                                                class="badge badge-pill badge-primary">{{ $List->all_listing->Listing_Status }}</span>
                                        </div>
                                        <span
                                            style="font-size: x-large;"><strong>{{ $List->all_listing->Ref_ID }}</strong></span><br>
                                        @if (count($List->all_listing->attachments) > 0)
                                            <strong><a
                                                    href="{{ route('Order.Attachments', ['List_ID' => $List->all_listing->id]) }}"
                                                    target="_blank">View Images</a></strong><br>
                                        @endif
                                    </td>
                                    <td>
                                        <span style="font-size: x-large;"><a target="_blank"
                                                href="{{ route('View.Profile', $List->all_listing->completed->completed_user->id) }}"><strong>{{ $List->all_listing->completed->completed_user->Company_Name }}</strong></a>
                                        </span>
                                        <br>
                                        <span>
                                            <strong>Contact:</strong>
                                            <a href="tel:{{ $List->all_listing->completed->completed_user->Contact_Phone }}">
                                                {{ $List->all_listing->completed->completed_user->Contact_Phone }}
                                            </a>
                                        </span><br>
                                        <span>
                                            <strong>Email:</strong>
                                            <a href="mailto:{{ $List->all_listing->completed->completed_user->email }}">
                                                {{ $List->all_listing->completed->completed_user->email }}
                                            </a>
                                        </span><br>
                                        <strong>Time:</strong>
                                        {{ $List->all_listing->completed->completed_user->Hours_Operations }}
                                        </span>
                                        {{-- <strong><a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                                target="_blank">View Contract</a>
                                        </strong><br>
                                        <strong>PickUp: </strong>{{ $List->all_listing->pickup_delivery_info->Pickup_Date }}
                                        ({{ $List->all_listing->pickup_delivery_info->Pickup_Date_mode }})
                                        <br>
                                        <strong>Delivery: </strong>
                                        {{ $List->all_listing->pickup_delivery_info->Delivery_Date }}
                                        ({{ $List->all_listing->pickup_delivery_info->Delivery_Date_mode }}) --}}
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

                                            $userRatings = getUserRating($List->all_listing->completed->completed_user->id);
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
                                        <span class="badge badge-pill badge-success" style="cursor:pointer;" onclick="window.open('{{ route('chat', $List->CMP_id) }}', '_blank')">
                                            Message Carrier
                                        </span>
                                    </td>
                                    <td>
                                        <!--<strong>Pickup: </strong>-->
                                        {{-- <i class="fas fa-map-marker-alt text-success fs-30"></i> --}}
                                        <a href="https://www.google.com/maps/place/{{ urlencode($List->all_listing->routes->Origin_ZipCode) }}"
                                            target="_blank">
                                            {{ Str::replace(',', '-', $List->all_listing->routes->Origin_ZipCode) }}
                                        </a><br>

                                        <!--<strong>Delivery: </strong>-->
                                        {{-- <i class="fas fa-map-marker-alt text-danger fs-30"></i> --}}
                                        <a href="https://www.google.com/maps/place/{{ urlencode($List->all_listing->routes->Dest_ZipCode) }}"
                                            target="_blank">
                                            {{ Str::replace(',', '-', $List->all_listing->routes->Dest_ZipCode) }}
                                        </a>
                                    </td>
                                    <td>
                                        @if (count($List->all_listing->vehicles) === 1)
                                            @foreach ($List->all_listing->vehicles as $vehcile)
                                                <p class="ymm">{{ $vehcile->Vehcile_Year }}
                                                    {{ $vehcile->Vehcile_Make }}
                                                    {{ $vehcile->Vehcile_Model }} </p><br>
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
                                        @endif
                                        @if (count($List->all_listing->heavy_equipments) === 1)
                                            @foreach ($List->all_listing->heavy_equipments as $vehcile)
                                                <p class="ymm"> {{ $vehcile->Equipment_Year }}
                                                    {{ $vehcile->Equipment_Make }}
                                                    {{ $vehcile->Equipment_Model }} </p><br>
                                                <b>L</b>{{ $vehcile->Equip_Length }} |
                                                <b>W</b>{{ $vehcile->Equip_Width }} |
                                                <b>H</b>{{ $vehcile->Equip_Height }}
                                                | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                                @if (!empty($vehcile->Equipment_Condition))
                                                    <br> <span>{{ $vehcile->Equipment_Condition }} </span><br>
                                                @endif
                                                @if (!empty($vehcile->Trailer_Type))
                                                    <span> {{ $vehcile->Trailer_Type }} </span>
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
                                        <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                            data-trigger="focus" style="cursor: pointer;" title="Additional Terms"
                                            data-content=
                                                    "{{ !empty($List->all_listing->additional_info->Additional_Terms) ? $List->all_listing->additional_info->Additional_Terms : '' }}">
                                            {{ !empty($List->all_listing->additional_info->Additional_Terms) ? Str::limit($List->all_listing->additional_info->Additional_Terms, 20) : '...' }}</a>
                                    </td>
                                    <td>
                                        <strong>Price to Pay:
                                        </strong><span>${{ $List->all_listing->paymentinfo->Price_Pay_Carrier }}</span>
                                        <br>
                                        {{-- <strong>Assigned to:
                                        </strong>{{ $List->all_listing->completed->completed_user->usr_type }}
                                        <br> --}}
                                        {{-- <strong>
                                            <a href="{{ route('View.Profile', $List->all_listing->completed->completed_user->id) }}"
                                                target="_blank">View
                                                MC</a>
                                            &nbsp;&nbsp;
                                            <a href="{{ route('View.Profile', $List->all_listing->completed->completed_user->id) }}"
                                                target="_blank">View DOT</a>
                                        </strong> --}}
                                        @if (!empty($List->all_listing->request_broker->Offer_Price) && $List->all_listing->request_broker->Offer_Price !== 0)
                                            <strong>Ask
                                                Price:</strong>${{ $List->all_listing->request_broker->Offer_Price }}
                                            <br>
                                        @endif
                                        {{ $List->all_listing->routes->Miles }}miles<br>
                                        ${{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}
                                        /miles
                                    </td>
                                    <td>
                                        <strong>Created At:</strong><br>
                                        {{ $List->created_at }}<br>
                                        <strong>Modified At:</strong><br>
                                        {{ $List->updated_at }}<br>
                                        <strong>PickUp: </strong><br>
                                        {{ $List->all_listing->pickup_delivery_info->Pickup_Date }}
                                        ({{ $List->all_listing->pickup_delivery_info->Pickup_Date_mode }})
                                        <br>
                                        <strong>Delivery: </strong><br>
                                        {{ $List->all_listing->pickup_delivery_info->Delivery_Date }}
                                        ({{ $List->all_listing->pickup_delivery_info->Delivery_Date_mode }})
                                        <br>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-primary mb-2 w-100 d-block"
                                            href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                            target="_blank">View Route</a>
                                        <a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                            class="btn btn-outline-primary mb-2 w-100 d-block" role="button">View Detail</a>
                                        @if ($List->all_listing->user_id === $currentUser->id && $List->all_listing->Is_Rate != 1)
                                            <a class="btn btn-outline-primary mb-2 w-100 d-block rate-order" data-toggle="modal"
                                                data-target="#RatingOrderModal" href="javascript:void(0);">
                                                <input hidden type="text" class="New-Ref-ID"
                                                    value="{{ $List->all_listing->Ref_ID }}">
                                                <input hidden type="text" class="Listed-ID"
                                                    value="{{ $List->all_listing->id }}">
                                                <input hidden type="text" class="Profile-ID"
                                                    value="{{ $List->all_listing->completed->completed_user->id }}">
                                                Rate Order
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    <!-- Rating Order Modal -->
    <div class="modal fade" id="RatingOrderModal" data-backdrop="true" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h3 class="modal-title">Overall Rating For Order ID: <span class="get_Order_ID"></span></h3>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3 text-center">
                    <p class="text-muted text-justify">By submitting a rating you declare that you have conducted business
                        with the rated
                        company. Otherwise, your subscription and/or rating privileges may be suspended.

                        In the event of an inquiry by a rated company, proof of a business relationship may be
                        requested. <strong>Please keep your transaction documents secure and
                            accessible.</strong></p>
                    <div id="rate-stats">
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="new-user-box stats-box">
                                    <div class="icon" style="margin-bottom: 22px;">
                                        <i class="fa-regular fa-lg fa-face-smile"></i>
                                    </div>
                                    <span class="sub-text font-weight-bold positive-span">Positive</span>
                                    <button type="button" class="btn btn-success" id="positive-rate">Positive
                                    </button>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="upcoming-product-box stats-box">
                                    <div class="icon" style="margin-bottom: 22px;">
                                        <i class="fa-regular fa-lg fa-face-frown-open"></i>
                                    </div>
                                    <span class="sub-text font-weight-bold neutral-span">Neutral</span>
                                    <button type="button" class="btn btn-primary" id="neutral-rate">Neutral
                                    </button>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="new-product-box stats-box">
                                    <div class="icon" style="margin-bottom: 22px;">
                                        <i class="fa-regular fa-lg fa-face-frown"></i>
                                    </div>
                                    <span class="sub-text font-weight-bold negative-span">Negative</span>
                                    <button type="button" class="btn btn-danger" id="negative-rate">Negative
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="user-settings-box" id="comments">
                            <form action="{{ route('View.Profile.Post.Ratings') }}" method="POST"
                                class="was-validated p-3">
                                @csrf
                                {{-- Don’t take too long to respond --}}
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Timeliness</label>
                                            <select class="custom-select" name="Timeliness" required>
                                                <option value="">Select AnyOne</option>
                                                <option value="1">Poor</option>
                                                <option value="2">Fair</option>
                                                <option value="3">Good</option>
                                                <option value="4">Average</option>
                                                <option value="5">Excellent</option>
                                            </select>
                                            <div class="invalid-feedback">Select Timeliness</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Communication</label>
                                            <select class="custom-select" name="Communication" required>
                                                <option value="">Select AnyOne</option>
                                                <option value="1">Poor</option>
                                                <option value="2">Fair</option>
                                                <option value="3">Good</option>
                                                <option value="4">Average</option>
                                                <option value="5">Excellent</option>
                                            </select>
                                            <div class="invalid-feedback">Select Communication</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Documentation</label>
                                            <select class="custom-select" name="Documentation" required>
                                                <option value="">Select AnyOne</option>
                                                <option value="1">Poor</option>
                                                <option value="2">Fair</option>
                                                <option value="3">Good</option>
                                                <option value="4">Average</option>
                                                <option value="5">Excellent</option>
                                            </select>
                                            <div class="invalid-feedback">Select Documentation</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Comments</label>
                                            <textarea rows="3" name="Rating_Comments" id="Rating_Comments" placeholder="Enter Comments"
                                                class="form-control"></textarea>
                                            <div class="invalid-feedback">
                                                Reason Required to Submit this Rating.
                                            </div>
                                        </div>
                                        <input hidden type="text" id="Ratings" name="Rating" value="">
                                        <input hidden type="text" name="get_Listed_ID" class="get_Listed_ID"
                                            value="">
                                        <input hidden type="text" name="get_Profile_ID" class="get_Profile_ID"
                                            value="">
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="btn-box">
                                            <button type="submit" class="submit-btn"><i class='bx bx-save'></i>
                                                Save Rating
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <p class="small text-muted"><i class="fa fa-question-circle"></i>
                        To update the comments, remove the rating and re-submit.</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.advance-72').DataTable({
            "deferRender": true,
            "ordering": false, // Disables sorting on all columns
        });
        $(document).ready(function() {
            $("#comments").hide();
            $(".positive-span").hide();
            $(".negative-span").hide();
            $(".neutral-span").hide();

            $("#positive-rate").click(function() {

                $("#positive-rate").hide();
                $("#negative-rate").show();
                $("#neutral-rate").show();

                $(".new-user-box").addClass('active-stats-box');
                $(".upcoming-product-box").removeClass('active-stats-box');
                $(".new-product-box").removeClass('active-stats-box');

                $(".positive-span").show();
                $(".negative-span").hide();
                $(".neutral-span").hide();

                $("#comments").show();
                $("#comments textarea").html("Don’t take too long to respond");

                $("#Ratings").val('Positive');

            });

            $("#neutral-rate").click(function() {

                $("#negative-rate").show();
                $("#positive-rate").show();
                $("#neutral-rate").hide();

                $(".new-user-box").removeClass('active-stats-box');
                $(".upcoming-product-box").addClass('active-stats-box');
                $(".new-product-box").removeClass('active-stats-box');

                $(".neutral-span").show();
                $(".negative-span").hide();
                $(".positive-span").hide();

                $("#comments").show();
                $("#comments textarea").html("");

                $("#Ratings").val('Neutral');

            });

            $("#negative-rate").click(function() {

                $("#negative-rate").hide();
                $("#positive-rate").show();
                $("#neutral-rate").show();

                $(".new-user-box").removeClass('active-stats-box');
                $(".upcoming-product-box").removeClass('active-stats-box');
                $(".new-product-box").addClass('active-stats-box');

                $(".negative-span").show();
                $(".neutral-span").hide();
                $(".positive-span").hide();

                $("#comments").show();
                $("#comments textarea").html("");

                $("#Ratings").val('Negative');

            });

            // Get Profile Info Functionality For Rating Request
            $(".rate-order").click(function() {
                var getListedID = $(this).find('.Listed-ID').val();
                var getProfileID = $(this).find('.Profile-ID').val();
                var getRefID = $(this).find('.New-Ref-ID').val();
                // console.log('getRefID', getRefID);
                $(".get_Order_ID").html(getRefID);
                $(".get_Listed_ID").val(getListedID);
                $(".get_Profile_ID").val(getProfileID);
            });
            // Get Profile Info Functionality For Rating Replied
            $(".rate-reply").click(function() {
                var getListedID = $(this).find('.Listed-ID').val();
                var getRateID = $(this).find('.Rate-ID').val();
                $(".get_Order_ID").html(getListedID);
                $(".get_Listed_ID").val(getListedID);
                $(".get_Rate_ID").val(getRateID);
            });
        });
    </script>
    <!-- Add this script at the end of your page -->
    <script>
        document.querySelectorAll('.rate-order').forEach(function(element) {
            element.addEventListener('click', function() {
                var refId = this.querySelector('.New-Ref-ID').value;
                var listedId = this.querySelector('.Listed-ID').value;
                var profileId = this.querySelector('.Profile-ID').value;
                console.log('Ref ID:', refId, 'Listed ID:', listedId, 'Profile ID:', profileId);
                // You can now use these values to perform your desired action in the modal
            });
        });
    </script>