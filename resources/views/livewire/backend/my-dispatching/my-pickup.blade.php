@section('PickUp', 'mm-active')
<!-- Breadcrumb Area -->
@php
    use Illuminate\Support\Facades\Auth;
    $currentUser = Auth::guard('Authorized')->user();
@endphp
<div class="breadcrumb-area">
    <h1>{{ $currentUser->usr_type }} Listing</h1>

    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>

        <li class="item">My PickUps</li>
    </ol>

</div>
<!-- End Breadcrumb Area -->

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
                <table class="display dataTable advance-6 datatable-range text-center w-100">
                    <thead>
                    <tr>
                        <th>Routes</th>
                        <th>Load Details</th>
                        <th>Ref. / Dist.</th>
                        <th>Company Details</th>
                        <th>Price / Assign</th>
                        <th>Assign Dates</th>
                        <th>Listing Dates</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($Lisiting as $List)
                        <tr>
                            <td>
                                <strong>Pickup: </strong>
                                <a href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                   target="_blank">
                                    {{ Str::replace(',', '-', $List->all_listing->routes->Origin_ZipCode) }}
                                </a><br>

                                <strong>Delivery: </strong>
                                <a href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                   target="_blank">
                                    {{ Str::replace(',', '-', $List->all_listing->routes->Dest_ZipCode) }}
                                </a>
                            </td>
                            <td>
                                @if(count($List->all_listing->vehicles) === 1)
                                    @foreach ($List->all_listing->vehicles as $vehcile)
                                        {{ $vehcile->Vehcile_Year }}
                                        {{ $vehcile->Vehcile_Make }}
                                        {{ $vehcile->Vehcile_Model }}<br>
                                        @if (!empty($vehcile->Vehcile_Condition))
                                            {{ $vehcile->Vehcile_Condition }}<br>
                                        @endif
                                        @if (!empty($vehcile->Trailer_Type))
                                            {{ $vehcile->Trailer_Type }}
                                        @endif
                                    @endforeach
                                @endif
                                @if(count($List->all_listing->vehicles) > 1)
                                    <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
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
                                        @endif
                                    @endforeach" data-html="true">vehicles
                                        ({{ count($List->all_listing->vehicles) }})
                                    </a>
                                @endif
                                @if(count($List->all_listing->heavy_equipments) === 1)
                                    @foreach ($List->all_listing->heavy_equipments as $vehcile)
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
                                @if(count($List->all_listing->heavy_equipments) > 1)
                                    <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                       data-trigger="focus" style="cursor: pointer;"
                                       title="Attached vehicles" data-content=
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
                                        @endif
                                    @endforeach" data-html="true">Vehicles
                                        ({{ count($List->all_listing->heavy_equipments) }})
                                    </a>
                                @endif
                                @if(count($List->all_listing->dry_vans) === 1)
                                    @foreach ($List->all_listing->dry_vans as $vehcile)
                                        {{ $vehcile->Freight_Class }}
                                        {{ $vehcile->Freight_Weight }}<br>
                                        @if ($vehcile->is_hazmat_Check !== 0)
                                            Hazmat Required<br>
                                        @endif
                                    @endforeach
                                @endif
                                @if(count($List->all_listing->dry_vans) > 1)
                                    <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                       data-trigger="focus" style="cursor: pointer;"
                                       title="Attached vehicles" data-content=
                                           "@foreach ($List->all_listing->dry_vans as $vehcile)
                                        {{ $vehcile->Freight_Class }}
                                        {{ $vehcile->Freight_Weight }}<br>
                                        @if ($vehcile->is_hazmat_Check !== 0)
                                            Hazmat Required<br>
                                        @endif
                                    @endforeach" data-html="true">Vehicles
                                        ({{ count($List->all_listing->dry_vans) }})
                                    </a>
                                @endif
                                <br>
                                <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                   data-trigger="focus" style="cursor: pointer;"
                                   title="Additional Terms" data-content=
                                       "{{ !empty($List->all_listing->additional_info->Additional_Terms) ? $List->all_listing->additional_info->Additional_Terms : '' }}">
                                    {{ !empty($List->all_listing->additional_info->Additional_Terms) ? Str::limit($List->all_listing->additional_info->Additional_Terms, 20) : '...' }}</a>
                            </td>
                            <td>
                                @if(count($List->all_listing->attachments) > 0)
                                    <strong><a
                                            href="{{ route('Order.Attachments', ['List_ID' => $List->all_listing->id]) }}"
                                            target="_blank">View Images</a></strong><br>
                                @endif
                                <strong>Ref-ID:</strong>{{ $List->all_listing->Ref_ID }} <br>
                                {{ $List->all_listing->routes->Miles }} miles<br>
                                $ {{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}
                                /miles
                            </td>
                            <td><strong><a href="{{ route('View.Profile', $List->all_listing->authorized_user->id) }}"
                                           target="_blank">{{ $List->all_listing->authorized_user->Company_Name }}</a></strong><br>
                                {{ $List->all_listing->authorized_user->Contact_Phone }}<br>
                                {{ $List->all_listing->authorized_user->Hours_Operations }}<br>
                                {{ $List->all_listing->authorized_user->Time_Zone }}<br>
                            </td>
                            <td>
                                <strong>Price to Pay:
                                </strong>${{ $List->all_listing->paymentinfo->COD_Amount }}
                                <br>
                                <strong>COD/COP:</strong>
                                {{ !empty($List->all_listing->paymentinfo->COD_Method_Mode) ? $List->all_listing->paymentinfo->COD_Method_Mode : '' }}
                                On
                                {{ !empty($List->all_listing->paymentinfo->COD_Location_Amount) ? $List->all_listing->paymentinfo->COD_Location_Amount : '' }}
                            </td>
                            <td>
                                <strong>Pickup:</strong><br>
                                {{ $List->all_listing->pickup_delivery_info->Pickup_Date }}
                                ({{ $List->all_listing->pickup_delivery_info->Pickup_Date_mode }})
                                <br>
                                <strong>Delivery:</strong><br>
                                {{ $List->all_listing->pickup_delivery_info->Delivery_Date }}
                                ({{ $List->all_listing->pickup_delivery_info->Delivery_Date_mode }})
                            </td>
                            <td>
                                <strong>Created At:</strong><br>
                                {{ $List->all_listing->created_at }}<br>
                                <strong>Modified At:</strong><br>
                                {{ $List->all_listing->updated_at }}
                            </td>
                            <td>
                                <h6>Status: <span
                                        class="badge badge-warning">{{ $List->all_listing->Listing_Status }}</span>
                                </h6>
                                <br>
                                <div class="dropdown show list-actions">
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
                                        @if ($List->all_listing->user_id === $currentUser->id)
                                            <a class="dropdown-item"
                                               href="{{ route('User.Edit.Listing', ['List_ID' => $List->all_listing->id]) }}">Edit
                                                Listing</a>
                                            {{-- <a class="dropdown-item"
                                               href="{{ route('Order.Deliverd.Approval', ['List_ID' => $List->all_listing->id]) }}">Delivered</a> --}}
                                            <a class="dropdown-item"
                                               href="{{ route('Order.Deliverd', ['List_ID' => $List->all_listing->id]) }}">Delivered</a>
                                            <a class="dropdown-item"
                                               href="{{ route('Order.Not.Deliverd.Approval', ['List_ID' => $List->all_listing->id]) }}">Not
                                                Delivered</a>
                                            <a class="dropdown-item"
                                               href="{{ route('User.Listing.Archive', ['List_ID' => $List->all_listing->id]) }}">Archive
                                                Order</a>
                                        @endif
                                        @if ($List->all_listing->user_id !== $currentUser->id)
                                            <a class="dropdown-item add-misc" data-toggle="modal"
                                               data-target="#AddMisc" href="javascript:void(0);">
                                                <input hidden type="text" class="Listed-ID"
                                                       value="{{ $List->all_listing->id }}">Add Misc.</a>
                                            <a class="dropdown-item attach-bill" data-toggle="modal"
                                               data-target="#AttachBill" href="javascript:void(0);">
                                                <input hidden type="text" class="Listed-ID"
                                                       value="{{ $List->all_listing->id }}">Deliver</a>
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
                        <th>Request</th>
                        <th>Routes</th>
                        <th>Load Details</th>
                        <th>Ref. / Dist.</th>
                        <th>Price / Assign</th>
                        <th>Dates</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($Lisiting as $List)
                        <tr>
                            <td>
                                <strong><a target="_blank"
                                           href="{{ route('View.Profile', $List->all_listing->pickup->pickup_user->id) }}">{{ $List->all_listing->pickup->pickup_user->Company_Name }}</a></strong><br>
                                <strong><a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                           target="_blank">View Contract</a>
                                </strong><br>
                                <strong>PickUp:
                                </strong>{{ $List->all_listing->pickup_delivery_info->Pickup_Date }}
                                ({{ $List->all_listing->pickup_delivery_info->Pickup_Date_mode }})
                                <br>
                                <strong>Delivery: </strong>
                                {{ $List->all_listing->pickup_delivery_info->Delivery_Date }}
                                ({{ $List->all_listing->pickup_delivery_info->Delivery_Date_mode }})
                            </td>
                            <td>
                                <strong>Pickup: </strong>
                                <a href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                   target="_blank">
                                    {{ Str::replace(',', '-', $List->all_listing->routes->Origin_ZipCode) }}
                                </a><br>

                                <strong>Delivery: </strong>
                                <a href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                                   target="_blank">
                                    {{ Str::replace(',', '-', $List->all_listing->routes->Dest_ZipCode) }}
                                </a>
                            </td>
                            <td>
                                @if(count($List->all_listing->vehicles) === 1)
                                    @foreach ($List->all_listing->vehicles as $vehcile)
                                        {{ $vehcile->Vehcile_Year }}
                                        {{ $vehcile->Vehcile_Make }}
                                        {{ $vehcile->Vehcile_Model }}<br>
                                        @if (!empty($vehcile->Vehcile_Condition))
                                            {{ $vehcile->Vehcile_Condition }}<br>
                                        @endif
                                        @if (!empty($vehcile->Trailer_Type))
                                            {{ $vehcile->Trailer_Type }}
                                        @endif
                                    @endforeach
                                @endif
                                @if(count($List->all_listing->vehicles) > 1)
                                    <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
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
                                        @endif
                                    @endforeach" data-html="true">vehicles
                                        ({{ count($List->all_listing->vehicles) }})
                                    </a>
                                @endif
                                @if(count($List->all_listing->heavy_equipments) === 1)
                                    @foreach ($List->all_listing->heavy_equipments as $vehcile)
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
                                @if(count($List->all_listing->heavy_equipments) > 1)
                                    <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                       data-trigger="focus" style="cursor: pointer;"
                                       title="Attached vehicles" data-content=
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
                                        @endif
                                    @endforeach" data-html="true">Vehicles
                                        ({{ count($List->all_listing->heavy_equipments) }})
                                    </a>
                                @endif
                                @if(count($List->all_listing->dry_vans) === 1)
                                    @foreach ($List->all_listing->dry_vans as $vehcile)
                                        {{ $vehcile->Freight_Class }}
                                        {{ $vehcile->Freight_Weight }}<br>
                                        @if ($vehcile->is_hazmat_Check !== 0)
                                            Hazmat Required<br>
                                        @endif
                                    @endforeach
                                @endif
                                @if(count($List->all_listing->dry_vans) > 1)
                                    <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                       data-trigger="focus" style="cursor: pointer;"
                                       title="Attached vehicles" data-content=
                                           "@foreach ($List->all_listing->dry_vans as $vehcile)
                                        {{ $vehcile->Freight_Class }}
                                        {{ $vehcile->Freight_Weight }}<br>
                                        @if ($vehcile->is_hazmat_Check !== 0)
                                            Hazmat Required<br>
                                        @endif
                                    @endforeach" data-html="true">Vehicles
                                        ({{ count($List->all_listing->dry_vans) }})
                                    </a>
                                @endif
                                <br>
                                <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                   data-trigger="focus" style="cursor: pointer;"
                                   title="Additional Terms" data-content=
                                       "{{ !empty($List->all_listing->additional_info->Additional_Terms) ? $List->all_listing->additional_info->Additional_Terms : '' }}">
                                    {{ !empty($List->all_listing->additional_info->Additional_Terms) ? Str::limit($List->all_listing->additional_info->Additional_Terms, 20) : '...' }}</a>
                            </td>
                            <td>
                                @if(count($List->all_listing->attachments) > 0)
                                    <strong><a
                                            href="{{ route('Order.Attachments', ['List_ID' => $List->all_listing->id]) }}"
                                            target="_blank">View Images</a></strong><br>
                                @endif
                                <strong>Ref-ID:</strong>{{ $List->all_listing->Ref_ID }} <br>
                                {{ $List->all_listing->routes->Miles }} miles<br>
                                $ {{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}
                                /miles
                            </td>
                            <td>
                                <strong>Price to Pay:
                                </strong>${{ $List->all_listing->paymentinfo->COD_Amount }}
                                <br>
                                {{-- <strong>Assigned to:
                                </strong>{{ $List->all_listing->pickup->pickup_user->usr_type }}
                                <br> --}}
                                <strong><a href="{{ route('View.Profile', $List->all_listing->pickup->pickup_user->id) }}"
                                           target="_blank">View
                                        MC</a>&nbsp;&nbsp;<a
                                        href="{{ route('View.Profile', $List->all_listing->pickup->pickup_user->id) }}"
                                        target="_blank">View DOT</a></strong>
                                @if(!empty($List->all_listing->request_broker->Offer_Price) && $List->all_listing->request_broker->Offer_Price !== 0)
                                    <br>
                                    <strong>Ask Price:
                                    </strong>${{ $List->all_listing->request_broker->Offer_Price }}
                                @endif
                            </td>
                            <td>
                                <strong>Created At:</strong><br>
                                {{ $List->all_listing->created_at }}<br>
                                <strong>Modified At:</strong><br>
                                {{ $List->all_listing->updated_at }}
                            </td>
                            <td>
                                <h6>Status: <span
                                        class="badge badge-primary">{{ $List->all_listing->Listing_Status }}</span>
                                </h6><br>
                                <div class="dropdown show list-actions">
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
                                        <a class="dropdown-item compare-listing" data-toggle="modal"
                                           data-target="#CompareListing" href="javascript:void(0);">
                                            <input hidden type="text" class="Listed-ID"
                                                   value="{{ $List->all_listing->id }}">
                                            <input hidden type="text" class="Listed-Type"
                                                   value="{{ $List->all_listing->Listing_Type }}">
                                            <input hidden type="text" class="Listed-Miles"
                                                   value="{{ $List->all_listing->routes->Miles }}">
                                            Compare Listing</a>
                                        @if ($List->all_listing->user_id === $currentUser->id)
                                            <a class="dropdown-item"
                                               href="{{ route('User.Edit.Listing', ['List_ID' => $List->all_listing->id]) }}">Edit
                                                Listing</a>
                                            {{-- <a class="dropdown-item"
                                               href="{{ route('Order.Deliverd.Approval', ['List_ID' => $List->all_listing->id]) }}">Delivered</a> --}}
                                            <a class="dropdown-item"
                                               href="{{ route('Order.Deliverd', ['List_ID' => $List->all_listing->id]) }}">Delivered</a>
                                            <a class="dropdown-item"
                                               href="{{ route('Order.Not.Deliverd.Approval', ['List_ID' => $List->all_listing->id]) }}">Not
                                                Delivered</a>
                                            <a class="dropdown-item"
                                               href="{{ route('User.Listing.Archive', ['List_ID' => $List->all_listing->id]) }}">Archive
                                                Order</a>
                                        @endif
                                        @if ($List->all_listing->user_id !== $currentUser->id)
                                            <a class="dropdown-item add-misc" data-toggle="modal"
                                               data-target="#AddMisc" href="javascript:void(0);">
                                                <input hidden type="text" class="Listed-ID"
                                                       value="{{ $List->all_listing->id }}">Add Misc.</a>
                                            <a class="dropdown-item attach-bill" data-toggle="modal"
                                               data-target="#AttachBill" href="javascript:void(0);">
                                                <input hidden type="text" class="Listed-ID"
                                                       value="{{ $List->all_listing->id }}">Deliver</a>
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
                                <label class="custom-control-label" for="customControlValidation2">Deliver Person</label>
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
                                       placeholder="Enter Odometer Reading" min="0" required=""
                                       autocomplete="off">
                                <div class="invalid-feedback">
                                    Entered Meter Reading
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Pickup Location</label>
                                <select class="custom-select" name="Pickup_Location" required>
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
                                    Entered Full Name
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" class="form-control phone-number" name="Pickup_Phone"
                                       placeholder="Enter Phone Number" required="" autocomplete="off">
                                <div class="invalid-feedback">
                                    Entered Phone Number
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

<script>
    // $('.advance-6').DataTable({
    //     "deferRender": true,
    // });
</script>
