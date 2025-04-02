<!-- Breadcrumb Area -->
@php
    use Illuminate\Support\Facades\Auth;
    $currentUser = Auth::guard('Authorized')->user();
@endphp
<div class="breadcrumb-area">
    <h1>{{ $currentUser->usr_type }} Listing</h1>

    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>

        <li class="item">Custom Listed</li>
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
                            {{--                            <td>--}}
                            {{--                                <button class="btn btn-danger" type="button" name="Search_Btn" >Search</button>--}}
                            {{--                            </td>--}}
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
                <table class="display carrier dataTable advance-6 datatable-range text-center w-100">
                    <thead>
                    <tr>
                        <th>Routes</th>
                        <th>Load Details</th>
                        <th>Ref. / Dist.</th>
                        <th>Company Info</th>
                        <th>Customer / Payments</th>
                        <th>Dates</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($Lisiting as $List)
                        @if(!$auth_user->is_heavy_subscribe)
                            @continue($List->Listing_Type === 2)
                        @endif
                        @if(!$auth_user->is_dry_van_subscribe)
                            @continue($List->Listing_Type === 3)
                        @endif
                        <tr>
                            <td>
                                <!--<strong>Pickup Route</strong><br>-->
                                 {{-- <i class="fas fa-map-marker-alt text-success fs-30"></i> --}}
                                <a href="https://www.google.com/maps/place/{{ urlencode($List->routes->Origin_ZipCode) }}"
                                   target="_blank">
                                    {{ Str::replace(',', '-', $List->routes->Origin_ZipCode) }}
                                </a><br>
                                <!--<strong>Delivery Route</strong><br>--> 
                                {{-- <i class="fas fa-map-marker-alt  text-danger fs-30"></i> --}}
                                <a href="https://www.google.com/maps/place/{{ urlencode($List->routes->Dest_ZipCode) }}"
                                   target="_blank">
                                    {{ Str::replace(',', '-', $List->routes->Dest_ZipCode) }}
                                </a>
                            </td>
                            <td>
                                @if(count($List->vehicles) === 1)
                                    @foreach ($List->vehicles as $vehcile)
                                        <a href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                           target="_blank"> {{ $vehcile->Vehcile_Year }}
                                            {{ $vehcile->Vehcile_Make }}
                                            {{ $vehcile->Vehcile_Model }}</a><br>
                                        @if (!empty($vehcile->Vehcile_Condition))
                                            {{ $vehcile->Vehcile_Condition }}<br>
                                        @endif
                                        @if (!empty($vehcile->Trailer_Type))
                                            {{ $vehcile->Trailer_Type }} <br>
                                        @endif
                                    @endforeach
                                @endif
                                @if(count($List->vehicles) > 1)
                                    <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                       data-trigger="focus" style="cursor: pointer;"
                                       title="Attached vehicles" data-content=
                                           "@foreach ($List->vehicles as $vehcile)
                                        <a href='https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}'
                                        target='_blank'> {{ $vehcile->Vehcile_Year }}
                                        {{ $vehcile->Vehcile_Make }}
                                        {{ $vehcile->Vehcile_Model }}</a><br>
                                        @if (!empty($vehcile->Vehcile_Condition))
                                            {{ $vehcile->Vehcile_Condition }}<br>
                                        @endif
                                        @if (!empty($vehcile->Trailer_Type))
                                            {{ $vehcile->Trailer_Type }} <br>
                                        @endif
                                    @endforeach" data-html="true">vehicles ({{ count($List->vehicles) }})
                                    </a>
                                @endif
                                @if(count($List->heavy_equipments) === 1)
                                    @foreach ($List->heavy_equipments as $vehcile)
                                        {{ $vehcile->Equipment_Year }}
                                        {{ $vehcile->Equipment_Make }}
                                        {{ $vehcile->Equipment_Model }}<br>
                                        <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} | <b>H</b>{{ $vehcile->Equip_Height }}
                                        | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                        @if (!empty($vehcile->Equipment_Condition))
                                            <br>{{ $vehcile->Equipment_Condition }}<br>
                                        @endif
                                        @if (!empty($vehcile->Trailer_Type))
                                            {{ $vehcile->Trailer_Type }}
                                        @endif
                                    @endforeach
                                @endif
                                @if(count($List->heavy_equipments) > 1)
                                    <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                       data-trigger="focus" style="cursor: pointer;"
                                       title="Attached vehicles" data-content=
                                           "@foreach ($List->heavy_equipments as $vehcile)
                                        {{ $vehcile->Equipment_Year }}
                                        {{ $vehcile->Equipment_Make }}
                                        {{ $vehcile->Equipment_Model }}<br>
                                            <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} | <b>H</b>{{ $vehcile->Equip_Height }} | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                        @if (!empty($vehcile->Equipment_Condition))
                                            <br>{{ $vehcile->Equipment_Condition }}<br>
                                        @endif
                                        @if (!empty($vehcile->Trailer_Type))
                                            {{ $vehcile->Trailer_Type }}
                                        @endif
                                    @endforeach" data-html="true">vehicles ({{ count($List->heavy_equipments) }})
                                    </a>
                                @endif
                                @if(count($List->dry_vans) === 1)
                                    @foreach ($List->dry_vans as $vehcile)
                                        {{ $vehcile->Freight_Class }}
                                        {{ $vehcile->Freight_Weight }}<br>
                                        @if ($vehcile->is_hazmat_Check !== 0)
                                            Hazmat Required<br>
                                        @endif
                                    @endforeach
                                @endif
                                @if(count($List->dry_vans) > 1)
                                    <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                       data-trigger="focus" style="cursor: pointer;"
                                       title="Attached vehicles" data-content=
                                           "@foreach ($List->dry_vans as $vehcile)
                                        {{ $vehcile->Freight_Class }}
                                        {{ $vehcile->Freight_Weight }}<br>
                                        @if ($vehcile->is_hazmat_Check !== 0)
                                            Hazmat Required<br>
                                        @endif
                                    @endforeach" data-html="true">vehicles ({{ count($List->dry_vans) }})
                                    </a>
                                @endif
                                <br>
                                <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                   data-trigger="focus" style="cursor: pointer;"
                                   title="Additional Terms" data-content=
                                       "{{ !empty($List->additional_info->Additional_Terms) ? $List->additional_info->Additional_Terms : '' }}">
                                    {{ !empty($List->additional_info->Additional_Terms) ? Str::limit($List->additional_info->Additional_Terms, 20) : '...' }}</a>
                            </td>
                            <td>
                                <strong>Ref-ID:</strong>{{ $List->Ref_ID }} <br>
                                {{ $List->routes->Miles }} miles <br>
                                $ {{ DayDispatchHelper::PricePerMiles($List->paymentinfo->COD_Amount, $List->routes->Miles) }}
                                /miles
                            </td>
                            <td>
                                <strong><a
                                        href="">{{ $List->authorized_user->Company_Name }}</a></strong><br>
                                {{ $List->authorized_user->Contact_Phone }}<br>
                                {{ $List->authorized_user->Hours_Operations }}<br>
                                {{ $List->authorized_user->Time_Zone }}
                            </td>
                            <td>
                                <strong>Price to Pay: </strong> $
                                {{ $List->paymentinfo->Price_Pay_Carrier }}<br>
                                <strong>COD / COP: </strong>
                                {{ $List->paymentinfo->COD_Method_Mode }}
                            </td>
                            <td>
                                <strong>Pickup Date: </strong><br>
                                ({{ $List->pickup_delivery_info->Pickup_Date_mode }})
                                {{ $List->pickup_delivery_info->Pickup_Date }}
                                <br>
                                <strong>Deliver Date: </strong><br>
                                ({{ $List->pickup_delivery_info->Delivery_Date_mode }})
                                {{ $List->pickup_delivery_info->Delivery_Date }}
                            </td>
                            <td>
                                <div class="dropdown show list-actions">
                                    <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button"
                                       data-toggle="dropdown" aria-haspopup="true">
                                        Actions
                                    </a>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                           href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                           target="_blank">View Route</a>

                                        <a class="dropdown-item request-load" data-toggle="modal"
                                           data-target="#CarrierRequestLoad" href="javascript:void(0);">
                                            <input hidden type="text" class="Listed-ID"
                                                   value="{{ $List->id }}">
                                            <input hidden type="text" class="Listed-Price"
                                                   value="$ {{ $List->paymentinfo->COD_Amount }}">
                                            <input hidden type="text" class="Pickup-Date"
                                                   value="{{ $List->pickup_delivery_info->Pickup_Date }}">
                                            <input hidden type="text" class="Deliver-Date"
                                                   value="{{ $List->pickup_delivery_info->Delivery_Date }}">
                                            Request Load</a>

                                        <a class="dropdown-item compare-listing" data-toggle="modal"
                                           data-target="#CompareListing" href="javascript:void(0);">
                                            <input hidden type="text" class="Listed-ID"
                                                   value="{{ $List->id }}">
                                            <input hidden type="text" class="Listed-Miles"
                                                   value="{{ $List->routes->Miles }}">
                                            Compare Listing</a>

                                        @if ($List->user_id == $currentUser->id)
                                            <a class="dropdown-item"
                                               href="{{ route('User.Edit.Listing', ['List_ID' => $List->id]) }}">Edit
                                                Listing</a>
                                            <a class="dropdown-item"
                                               href="{{ route('User.Dispatch.Listing', ['List_ID' => $List->id]) }}">Assign
                                                Listing</a>
                                            <a class="dropdown-item"
                                               href="{{ route('User.Listing.Archive', ['List_ID' => $List->id]) }}">Archive
                                                Order</a>
                                        @endif
                                    </div>
                                </div>
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
                            {{--                            <td>--}}
                            {{--                                <button class="btn btn-danger" type="button" name="Search_Btn" >Search</button>--}}
                            {{--                            </td>--}}
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
                <table class="display dataTable advance-6 datatable-range text-center w-100">
                    <thead>
                    <tr>
                        <th>Routes</th>
                        <th>Load Details</th>
                        <th>Ref. / Dist</th>
                        <th>Customer / Payments</th>
                        <th>Dates</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($Lisiting as $List)
                        <tr>
                            <td>
                                <!--<strong>Pickup Route</strong><br>-->
                                {{-- <i class="fas fa-map-marker-alt text-success fs-30"></i> --}}
                                <a href="https://www.google.com/maps/place/{{ urlencode($List->routes->Origin_ZipCode) }}"
                                   target="_blank">
                                    {{ Str::replace(',', '-', $List->routes->Origin_ZipCode) }}
                                </a><br>
                                <!--<strong>Delivery Route</strong><br>-->
                                  {{-- <i class="fas fa-map-marker-alt text-danger fs-30"></i> --}}
                                <a href="https://www.google.com/maps/place/{{ urlencode($List->routes->Dest_ZipCode) }}"
                                   target="_blank">
                                    {{ Str::replace(',', '-', $List->routes->Dest_ZipCode) }}
                                </a>
                            </td>
                            <td>
                                @if(count($List->vehicles) === 1)
                                    @foreach ($List->vehicles as $vehcile)
                                        <a href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                           target="_blank"> {{ $vehcile->Vehcile_Year }}
                                            {{ $vehcile->Vehcile_Make }}
                                            {{ $vehcile->Vehcile_Model }}</a><br>
                                        @if (!empty($vehcile->Vehcile_Condition))
                                            {{ $vehcile->Vehcile_Condition }}<br>
                                        @endif
                                        @if (!empty($vehcile->Trailer_Type))
                                            <p>{{ $vehcile->Trailer_Type }}</p> <br>
                                        @endif
                                    @endforeach
                                @endif
                                @if(count($List->vehicles) > 1)
                                    <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                       data-trigger="focus" style="cursor: pointer;"
                                       title="Attached vehicles" data-content=
                                           "@foreach ($List->vehicles as $vehcile)
                                        <a href='https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}'
                                        target='_blank'> {{ $vehcile->Vehcile_Year }}
                                        {{ $vehcile->Vehcile_Make }}
                                        {{ $vehcile->Vehcile_Model }}</a><br>
                                        @if (!empty($vehcile->Vehcile_Condition))
                                            {{ $vehcile->Vehcile_Condition }}<br>
                                        @endif
                                        @if (!empty($vehcile->Trailer_Type))
                                            {{ $vehcile->Trailer_Type }} <br>
                                        @endif
                                    @endforeach" data-html="true">vehicles ({{ count($List->vehicles) }})
                                    </a>
                                @endif
                                @if(count($List->heavy_equipments) === 1)
                                    @foreach ($List->heavy_equipments as $vehcile)
                                        {{ $vehcile->Equipment_Year }}
                                        {{ $vehcile->Equipment_Make }}
                                        {{ $vehcile->Equipment_Model }}<br>
                                        <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} | <b>H</b>{{ $vehcile->Equip_Height }}
                                        | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                        @if (!empty($vehcile->Equipment_Condition))
                                            <br>{{ $vehcile->Equipment_Condition }}<br>
                                        @endif
                                        @if (!empty($vehcile->Trailer_Type))
                                            {{ $vehcile->Trailer_Type }}
                                        @endif
                                    @endforeach
                                @endif
                                @if(count($List->heavy_equipments) > 1)
                                    <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                       data-trigger="focus" style="cursor: pointer;"
                                       title="Attached vehicles" data-content=
                                           "@foreach ($List->heavy_equipments as $vehcile)
                                        {{ $vehcile->Equipment_Year }}
                                        {{ $vehcile->Equipment_Make }}
                                        {{ $vehcile->Equipment_Model }}<br>
                                            <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} | <b>H</b>{{ $vehcile->Equip_Height }} | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                        @if (!empty($vehcile->Equipment_Condition))
                                            <br>{{ $vehcile->Equipment_Condition }}<br>
                                        @endif
                                        @if (!empty($vehcile->Trailer_Type))
                                            {{ $vehcile->Trailer_Type }}
                                        @endif
                                    @endforeach" data-html="true">vehicles ({{ count($List->heavy_equipments) }})
                                    </a>
                                @endif
                                @if(count($List->dry_vans) === 1)
                                    @foreach ($List->dry_vans as $vehcile)
                                        {{ $vehcile->Freight_Class }}
                                        {{ $vehcile->Freight_Weight }}<br>
                                        @if ($vehcile->is_hazmat_Check !== 0)
                                            Hazmat Required<br>
                                        @endif
                                    @endforeach
                                @endif
                                @if(count($List->dry_vans) > 1)
                                    <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                       data-trigger="focus" style="cursor: pointer;"
                                       title="Attached vehicles" data-content=
                                           "@foreach ($List->dry_vans as $vehcile)
                                        {{ $vehcile->Freight_Class }}
                                        {{ $vehcile->Freight_Weight }}<br>
                                        @if ($vehcile->is_hazmat_Check !== 0)
                                            Hazmat Required<br>
                                        @endif
                                    @endforeach" data-html="true">vehicles ({{ count($List->dry_vans) }})
                                    </a>
                                @endif
                                <br>
                                <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                   data-trigger="focus" style="cursor: pointer;"
                                   title="Additional Terms" data-content=
                                       "{{ !empty($List->additional_info->Additional_Terms) ? $List->additional_info->Additional_Terms : '' }}">
                                    {{ !empty($List->additional_info->Additional_Terms) ? Str::limit($List->additional_info->Additional_Terms, 20) : '...' }}</a>
                            </td>
                            <td>
                                <strong>Ref-ID:</strong>{{ $List->Ref_ID }} <br>
                                {{ $List->routes->Miles }} miles <br>
                                $ {{ DayDispatchHelper::PricePerMiles($List->paymentinfo->COD_Amount, $List->routes->Miles) }}
                                /miles
                            </td>
                            <td>
                                <strong>Price to Pay: </strong> <span>$
                                {{ $List->paymentinfo->Price_Pay_Carrier }} </span> <br>
                                <strong>COD / COP: </strong>
                                {{ $List->paymentinfo->COD_Method_Mode }}
                            </td>
                            <td>
                                <strong>Pickup Date: </strong><br>
                                ({{ $List->pickup_delivery_info->Pickup_Date_mode }})
                                {{ $List->pickup_delivery_info->Pickup_Date }}
                                <br>
                                <strong>Deliver Date: </strong><br>
                                ({{ $List->pickup_delivery_info->Delivery_Date_mode }})
                                {{ $List->pickup_delivery_info->Delivery_Date }}
                            </td>
                            <td>
                                <h6>Status: <span class="badge badge-primary">Time Quote</span></h6>
                                <strong>Expired Date: </strong><br>
                                {{ $List->expire_at }}
                                <div class="dropdown show list-actions">
                                    <a class="btn btn-success dropdown-toggle btn-sm" href="#"
                                       role="button" data-toggle="dropdown" aria-haspopup="true">
                                        Actions
                                    </a>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                           href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                           target="_blank">View Route</a>
                                        @if ($currentUser->usr_type === 'Broker')
                                            <a class="dropdown-item all-requests" data-toggle="modal"
                                               data-target="#CarrierRequests" href="javascript:void(0);">
                                                <input hidden type="text" class="Listed-ID"
                                                       value="{{ $List->id }}">
                                                Request</a>

                                            <a class="dropdown-item request-carrier" data-toggle="modal"
                                               data-target="#requestCarrier" href="javascript:void(0);">
                                                <input hidden type="text" class="Listed-ID"
                                                       value="{{ $List->id }}">
                                                Request Carrier</a>
                                        @endif
                                        @if ($List->user_id === $currentUser->id)
                                            <a class="dropdown-item"
                                               href="{{ route('User.Edit.Listing', ['List_ID' => $List->id]) }}">Edit
                                                Listing</a>
                                            <a class="dropdown-item"
                                               href="{{ route('User.Dispatch.Listing', ['List_ID' => $List->id]) }}">Assign
                                                Listing</a>
                                            <a class="dropdown-item"
                                               href="{{ route('User.Listing.Archive', ['List_ID' => $List->id]) }}">Archive
                                                Order</a>
                                        @endif
                                    </div>
                                </div>
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
            <div class="modal-body user-settings-box">
                <form action="{{ route('User.Request.Broker') }}" method="POST" class="was-validated">
                    @csrf
                    <input hidden type="text" name="get_Listed_ID" class="get_Listed_ID" value="">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Current Price (Order Price)</label>
                                <input readonly type="text" class="form-control" id="get_Listed_Price"
                                       value="" name="Current_Price" required>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="offer_Check">
                                <label class="form-check-label" for="offer_Check">If You have any Offer?</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group offer-price">
                                <label>My Offer (Order Price)</label>
                                <input type="text" class="form-control" placeholder="Enter Your Offer Price"
                                       value="" name="Offer_Price">
                                <div class="invalid-feedback offer-required">
                                    Offer Price is Required.
                                </div>
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
                                    Entered Pickup Date.
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
                                    Entered Delivery Date.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="acknoledgement" required>
                                <label class="form-check-label" for="acknoledgement">I acknowledge and agree that once
                                    the i has accepted the request, I will be entered into a legal contract with Day
                                    Dispatch for the transportation of vehicle(s).<br> I further acknowledge and agree i
                                    have no obligation or liability whatsoever arising out of such contract. I consent
                                    to Day Dispatch adding a provision to this effect in my dispatch sheets. I also
                                    understand that any changes that I make to the dispatch sheet after i has accepted
                                    the request, unless i has approved the change, and may not be binding on the
                                    customer or company.</label>
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
        </div>
    </div>
</div>

<!-- View Compare Listing Modal -->
<div class="modal fade" id="CompareListing" data-backdrop="true" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Compareable Listings for: <span class="get_Order_ID"></span></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body user-settings-box">
                <input hidden type="text" name="get_Listed_ID" class="get_Listed_ID" value="">
                <input hidden type="text" name="get_Listed_Miles" class="get_Listed_Miles" value="">
                <div class="table-responsive" id="all-fetch-comparison">


                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // $('.advance-6').DataTable({
    //     "deferRender": true,
    // });

    // "columnDefs": [{
    //         "visible": false,
    //         "targets": 7
    //     }],
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

    $(".request-carrier").click(function () {
        var getListedID = $(this).find('.Listed-ID').val();
        $(".get_Order_ID").html(getListedID);
        $(".get_Listed_ID").val(getListedID);
    });
    // Offer Amount
    $('.offer-price').hide();
    $('#offer_Check').change(function () {
        checkBox = document.getElementById('offer_Check');
        if (checkBox.checked) {
            $('.offer-price').show();
            $(".offer-price input").prop('required', true);
        } else {
            $('.offer-price').hide();
            $(".offer-price input").prop('required', false);
        }
    });
    $(".request-load").click(function () {
        var getListedID = $(this).find('.Listed-ID').val();
        var getListedPrice = $(this).find('.Listed-Price').val();
        var getPickupDate = $(this).find('.Pickup-Date').val();
        var getDeliverDate = $(this).find('.Deliver-Date').val();
        $(".get_Order_ID").html(getListedID);
        $(".get_Listed_ID").val(getListedID);
        $('#get_Listed_Price').val(getListedPrice);

        var pickupDate = getListedDate(getPickupDate);
        $('.pickup-date').val(pickupDate);

        var deliverDate = getListedDate(getDeliverDate);
        $('.deliver-date').val(deliverDate);
    });

    $('.all-requests').on('click', function () {
        var getListedID = $(this).find('.Listed-ID').val();
        $(".get_Order_ID").html(getListedID);
        $(".get_Listed_ID").val(getListedID);

        $.ajax({
            url: '{{ route('Get.All.Carrier.Request') }}',
            type: 'GET',
            data: {
                'Listed_ID': getListedID
            },
            success: function (data) {
                $('#all-fetch-requests').html(data);
            },
            error: function (data) {
                var errors = data.responseJSON;
                console.log(errors);
            }

        });

    });
    // Compare Listing
    $('.compare-listing').on('click', function () {
        var getListedID = $(this).find('.Listed-ID').val();
        var getListedMiles = $(this).find('.Listed-Miles').val();
        $(".get_Order_ID").html(getListedMiles);
        $(".get_Listed_ID").val(getListedID);
        $(".get_Listed_Miles").val(getListedMiles);

        $.ajax({
            url: '{{ route('Get.All.Comparison.Listing') }}',
            type: 'GET',
            data: {
                'Listed_ID': getListedID,
                'Listed_Miles': getListedMiles
            },
            success: function (data) {
                $('#all-fetch-comparison').html(data);
                // $('.carrier-all-request').DataTable();
            },
            error: function (data) {
                var errors = data.responseJSON;
                console.log(errors);
            }

        });

    });
</script>
