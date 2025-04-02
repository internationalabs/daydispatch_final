@php
    use Illuminate\Support\Facades\Auth;
    $currentUser = Auth::guard('Authorized')->user();
@endphp
<style>
    .hidden {
        display: none;
    }

    /* Optionally, add some styles to show the modal body */
    #modalbody {
        /* Your modal styling here */
        display: none;
        /* Start hidden */
    }

    .ribbon-box .ribbon-two {
        overflow: hidden;
        width: 100px;
        /* height: 67px; */
        text-align: right;
        left: -11px;
        display: block;

        /* position: absolute;
        top: -8px;
        z-index: 1;
        overflow: hidden;
        width: 65px;
        height: 67px;
        text-align: right;
        left: -11px;
        clip-path: polygon(13% 0, 116% 0, 0 103%, 0 103%);
        display: block; */
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
        font-weight: 500
            /* font-size: 13px;
        color: #fff;
        text-align: center;
        line-height: 20px;
        -webkit-transform: rotate(-45deg);
        transform: rotate(-45deg);
        width: 100px;
        display: block;
        -webkit-box-shadow: 0 0 8px 0 rgba(0, 0, 0, .06), 0 1px 0 0 rgba(0, 0, 0, .02);
        box-shadow: 0 0 8px 0 rgba(0, 0, 0, .06), 0 1px 0 0 rgba(0, 0, 0, .02);
        position: absolute;
        top: 19px;
        left: -21px;
        font-weight: 500; */
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

    .blurred-text {
        filter: blur(5px);
        pointer-events: none;
        user-select: none;
    }
</style>

<div class="card">
    <div class="card-body">
        <h2 class="bg-white py-2 fw-bold d-flex justify-content-center" style="background: #ffffff; color:#113771;">
            <i class="bi bi-hash mr-2"></i>ALL AVAILABLE LOADS @if ($Lisiting)
                ({{ $Lisiting->total() }})
            @endif
        </h2>
        <div class="table-responsive">
            {{-- <div class="col-md-1">
                <label for="perPage">Show</label>
                <select id="perPage" name="per_page" >
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                    <option value="150" {{ request('per_page') == 150 ? 'selected' : '' }}>150</option>
                    <option value="500" {{ request('per_page') == 500 ? 'selected' : '' }}>500</option>
                </select>
                <input id="currentPage" type="hidden" value="1">
            </div> --}}

            <form method="GET" action="{{ request()->url() }}" class="d-flex align-items-center mb-3">
                <label class="me-2">Show</label>
                <select name="per_page" class="form-select w-auto" onchange="this.form.submit()">
                    @foreach ([10, 25, 50, 100] as $size)
                        <option value="{{ $size }}" {{ request('per_page', 10) == $size ? 'selected' : '' }}>
                            {{ $size }}
                        </option>
                    @endforeach
                </select>
                <label class="ms-2">entries</label>
            </form>
            <table class="table-1 display dataTable advance-786 text-center table-bordered table-cards">
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
                        <tr class="card-row" data-status="active">
                            <td>
                                @php
                                    $createdAt = \Carbon\Carbon::createFromFormat(
                                        'Y-m-d H:i:s',
                                        $List->getRawOriginal('created_at'),
                                    );
                                @endphp
                                @if ($createdAt->gte(\Carbon\Carbon::now()->subHours(12)) && $createdAt->lte(\Carbon\Carbon::now()))
                                    <form id="searchForm" action="{{ route('global.search.index') }}" method="GET">
                                        <input type="hidden" id="new_listing" name="new_listing" value="new">
                                        <button type="submit" class="badge badge-warning border-0">New</button>
                                    </form>
                                @endif
                                <span style="font-size: x-large;"><strong>{{ $List->Ref_ID }}</strong></span><br>
                                @if (count($List->attachments) > 0)
                                    <strong><a class="text-nowrap"
                                            href="{{ route('Order.Attachments', ['List_ID' => $List->id]) }}"
                                            target="_blank">View Images</a></strong><br>
                                @endif
                            </td>
                            @php
                                $user = Auth::guard('Authorized')->user();
                            @endphp
                            @if ($user && $user->admin_verify == 0)
                                <td>
                                    <span style="font-size: x-large; "><a class="locations-color blurred-text"
                                            href="{{ route('View.Profile', $List->authorized_user->id) }}"
                                            target="_blank"><strong>{{ $List->authorized_user->Company_Name }}</strong></a></span><br>
                                    <span class="text-nowrap blurred-text">
                                        <strong>Contact:</strong>
                                        <a class="locations-color"
                                            href="tel:{{ $List->authorized_user->Contact_Phone }}">
                                            {{ $List->authorized_user->Contact_Phone }}
                                        </a>
                                    </span><br>
                                    <span class="text-nowrap blurred-text">
                                        <strong>Email:</strong>
                                        <a class="locations-color" href="mailto:{{ $List->authorized_user->email }}">
                                            {{ $List->authorized_user->email }}
                                        </a>
                                    </span>
                                    <br>
                                    <span class="blurred-text">
                                        <strong>Time:</strong> {{ $List->authorized_user->Hours_Operations }}
                                    </span><br>
                                </td>
                            @else
                                <td>
                                    <span style="font-size: x-large; "><a class="locations-color"
                                            href="{{ route('View.Profile', $List->authorized_user->id) }}"
                                            target="_blank"><strong>{{ $List->authorized_user->Company_Name }}</strong></a></span><br>
                                    <span class="text-nowrap">
                                        <strong>Contact:</strong>
                                        <a class="locations-color"
                                            href="tel:{{ $List->authorized_user->Contact_Phone }}">
                                            {{ $List->authorized_user->Contact_Phone }}
                                        </a>
                                    </span><br>
                                    <span class="text-nowrap ">
                                        <strong>Email:</strong>
                                        <a class="locations-color" href="mailto:{{ $List->authorized_user->email }}">
                                            {{ $List->authorized_user->email }}
                                        </a>
                                    </span>
                                    <br>
                                    <strong>Time:</strong> {{ $List->authorized_user->Hours_Operations }}
                                    </span><br>
                                </td>
                            @endif

                            <td>
                                <div class="mb-2">
                                    <span><strong>Pickup</strong></span><br>
                                    <a class="fs-5 text-nowrap text-decoration-none fw-bold locations-color"
                                        href="https://www.google.com/maps/place/{{ urlencode($List->routes->Origin_ZipCode) }}"
                                        target="_blank">
                                        {{-- <i class="fas fa-map-marker-alt text-success fs-30"></i> --}}
                                        {{ Str::replace(',', '-', $List->routes->Origin_ZipCode) }}
                                    </a>
                                </div>
                                <div class="mb-2">
                                    <span><strong>Delivery</strong></span><br>
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
                            </td>
                            <td>
                                @if (count($List->vehicles) === 1)
                                    @foreach ($List->vehicles as $vehcile)
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
                                @if (count($List->vehicles) > 1)
                                    <div class="dropdown">
                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"
                                            style="cursor: pointer;">vehicles({{ count($List->vehicles) }})
                                        </a>
                                        <div class="dropdown-menu text-center">
                                            <h6 class="dropdown-header" style="background-color: lightgrey;">
                                                Attached Vehicles</h6>
                                            @foreach ($List->vehicles as $vehicle)
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
                                        <!-- {{ $vehcile->Equipment_Year }}
                                            {{ $vehcile->Equipment_Make }}
                                            {{ $vehcile->Equipment_Model }}<br> -->

                                        <a style="color: mediumvioletred; font-weight: 800;"
                                            href="https://www.google.com/search?q={{ $vehcile->Equipment_Year }}%20{{ $vehcile->Equipment_Make }}%20{{ $vehcile->Equipment_Model }}"
                                            target="_blank"> {{ $vehcile->Equipment_Year }}
                                            {{ $vehcile->Equipment_Make }}
                                            {{ $vehcile->Equipment_Model }}</a><br>

                                        <b>L</b>{{ $vehcile->Equip_Length }} |
                                        <b>W</b>{{ $vehcile->Equip_Width }}
                                        | <b>H</b>{{ $vehcile->Equip_Height }}
                                        | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                        @if (!empty($vehcile->Equipment_Condition))
                                            <br>{{ $vehcile->Equipment_Condition }}<br>
                                        @endif
                                        @if (!empty($vehcile->Trailer_Type))
                                            <span
                                                @if ($vehcile->Trailer_Type == '"(Enclosed Trailer Required)"') class="text-primary font-weight-bold" @endif>{{ $vehcile->Trailer_Type }}</span>
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
                                <div class="dropdown mt-3">
                                    <a href="javascript:void(0)" tabindex="0"
                                        class="btn btn-outline-primary dropdown-toggle text-truncate"
                                        id="additionalTermsDropdown" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false" style="max-width: 200px;">
                                        {{ $List->additional_info && $List->additional_info->Additional_Terms
                                            ? $List->additional_info->Additional_Terms
                                            : 'Additional Terms' }}
                                    </a>
                                    <div class="dropdown-menu p-3 shadow-sm" aria-labelledby="additionalTermsDropdown"
                                        style="max-width: 300px;">
                                        <p class="dropdown-item-text m-0 text-wrap">
                                            {{ !empty($List->additional_info->Additional_Terms)
                                                ? $List->additional_info->Additional_Terms
                                                : 'No additional terms available.' }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if ($List->paymentinfo)
                                    <strong>Job
                                        Price:</strong><span>${{ $List->paymentinfo->Price_Pay_Carrier }}
                                    </span>
                                    <br>
                                    @if ($List->paymentinfo->COD_Amount === '0')
                                    @else
                                        <strong>
                                            @if ($List->paymentinfo->COD_Location_Amount == 'PickUp')
                                                Pay on Pickup
                                            @else
                                                Pay on Delivery
                                            @endif:
                                        </strong>
                                        <span>${{ $List->paymentinfo->COD_Amount }}</span>
                                        <br>
                                        <strong>Pay Mode:</strong><span
                                            class="text-nowrap">{{ $List->paymentinfo->COD_Method_Mode }}</span><br>
                                    @endif
                                @endif
                                @if ($List->paymentinfo)
                                    <strong>Price per
                                        Mile:</strong>${{ DayDispatchHelper::PricePerMiles($List->paymentinfo->Price_Pay_Carrier !== null ? $List->paymentinfo->Price_Pay_Carrier : 0, $List->routes->Miles) }}/miles
                                @endif<br/>
                                <strong>Mile:</strong>{{ $List->routes->Miles }}miles<br>
                            </td>
                            <td>
                                @if ($List->pickup_delivery_info)
                                    <strong>Pickup Date: </strong><br><span class="text-nowrap">
                                        ({{ $List->pickup_delivery_info->Pickup_Date_mode }})
                                        {{ \Carbon\Carbon::parse($List->pickup_delivery_info->Pickup_Date)->format('d M, Y') }}</span>
                                    <br>
                                    <strong>Deliver Date: </strong><br><span class="text-nowrap">
                                        ({{ $List->pickup_delivery_info->Delivery_Date_mode }})
                                        {{ \Carbon\Carbon::parse($List->pickup_delivery_info->Delivery_Date)->format('d M, Y') }}</span>
                                    <br>
                                    <strong>Created Date: </strong><br>
                                    @php
                                        $created_at = \Carbon\Carbon::parse($List->created_at);
                                        $diffInHours = $created_at->diffInHours();

                                        if ($diffInHours >= 1 && $diffInHours <= 23) {
                                            $created_at = $diffInHours . ' hrs ago';
                                        } else {
                                            $created_at = $created_at->format('d M, Y'); // You can use any desired date format here
                                        }
                                    @endphp
                                    {{ $created_at }}
                                @endif
                            </td>

                            @if ($user && $user->admin_verify == 0)
                                <td>
                                    <span data-toggle="modal" data-target="#WaitingApproval">
                                        <i class="fa-regular fa-heart text-danger toggle-icon" title="Add to Watch List"></i>
                                    </span>
                                    <br>
                                    <a onclick="" class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap"
                                        data-toggle="modal" data-target="#WaitingApproval"
                                        href="javascript:void(0);">
                                        Bid / Request Load
                                    </a>
                                    <a class="btn btn-outline-primary mb-2 w-100 d-block" data-toggle="modal"
                                        data-target="#WaitingApproval" href="javascript:void(0);">
                                        Compare Listing</a>
                                </td>
                            @else
                                <td>
                                    <span class="watchlist-toggle"
                                        data-url="{{ route('User.Watchlist.store', $List->id) }}">
                                        @if ($List->authorized_user->my_watch_check($List->id) !== null)
                                            <i class="fa fa-heart text-danger toggle-icon" aria-hidden="true"
                                                title="Remove from Watch List"></i>
                                        @else
                                            <i class="fa-regular fa-heart text-danger toggle-icon"
                                                title="Add to Watch List"></i>
                                        @endif
                                    </span>
                                    <br>
                                    @if (\App\Models\Carrier\RequestBroker::where('order_id', $List->id)->where('CMP_id', Auth::guard('Authorized')->user()->id)->where('is_cancel', 0)->exists())
                                        <a class="btn btn-outline-primary mb-2 w-100 d-block request-load text-nowrap"
                                            href="javascript:void(0);">Already Requested</a>
                                    @else
                                        <a onclick="request_load_click({{ $List->id }})"
                                            id="{{ $List->id }}"
                                            class="btn btn-outline-primary mb-2 w-100 d-block text-nowrap request-load"
                                            data-toggle="modal" data-target="#CarrierRequestLoad"
                                            href="javascript:void(0);">
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
                                                Bid / Request Load
                                            @endif
                                        </a>
                                    @endif
                                    <a class="btn btn-outline-primary mb-2 w-100 d-block compare-listing" data-toggle="modal"
                                        data-target="#CompareListing" href="javascript:void(0);">
                                        <input hidden type="text" class="Listed-ID" value="{{ $List->id }}">
                                        <input hidden type="text" class="Listed-Type"
                                            value="{{ $List->Listing_Type }}">
                                        <input hidden type="text" class="Listed-Miles"
                                            value="{{ $List->routes->Miles }}">
                                        Compare Listing</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <div class="d-flex justify-content-between">
                {{ $Lisiting->links('pagination::bootstrap-4') }}
            </div> --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $Lisiting->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
