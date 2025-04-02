@php
    use Illuminate\Support\Facades\Auth;
    $currentUser = Auth::guard('Authorized')->user();
@endphp
<style>
    #modalbody{
        display: none;
    }
    .text-primary.font-weight-bold{
        color: #1e2d62;
    }
</style>
@if (@isset($data['Completed']) && count($data['Completed']) > 0)
    <section>
        </br>
        <h3>Completed</h3>
        <table class="table-1 dataTable advance-6e datatable-range text-center table-bordered table-cards">
            <thead class="table-header">
                <tr>
                    <th>Request</th>
                    <th>Routes</th>
                    <th>Load Details</th>
                    <th>ID</th>
                    <th>Paymenets</th>
                    <th>Dates</th>
                    @if (Request::url() === 'daydispatch.com/Admin/Admin-View-Profile/*/User')
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                {{-- Completed Listings --}}
                @foreach ($data['Completed'] as $row)
                    @if (!is_null($row->completed_user))
                        <tr class="card-row" data-status="active">
                            <td>
                                <strong><a target="_blank"
                                        href="{{ route('View.Profile', $row->all_listing->completed->completed_user->id) }}">{{ $row->all_listing->completed->completed_user->Company_Name }}</a></strong><br>
                                <strong><a href="{{ route('View.Agreement', ['List_ID' => $row->all_listing->id]) }}"
                                        target="_blank">View Contract</a>
                                </strong><br>
                                <strong>PickUp: </strong>{{ $row->all_listing->pickup_delivery_info->Pickup_Date }}
                                ({{ $row->all_listing->pickup_delivery_info->Pickup_Date_mode }})
                                <br>
                                <strong>Delivery: </strong>
                                {{ $row->all_listing->pickup_delivery_info->Delivery_Date }}
                                ({{ $row->all_listing->pickup_delivery_info->Delivery_Date_mode }})
                            </td>
                            <td>
                                <strong>Pickup: </strong>
                                <a href="https://www.google.com/maps/dir/{{ $row->all_listing->routes->Origin_ZipCode }},+USA/{{ $row->all_listing->routes->Dest_ZipCode }},+USA/"
                                target="_blank">
                                    {{ Str::replace(',', '-', $row->all_listing->routes->Origin_ZipCode) }}
                                </a><br>

                                <strong>Delivery: </strong>
                                <a href="https://www.google.com/maps/dir/{{ $row->all_listing->routes->Origin_ZipCode }},+USA/{{ $row->all_listing->routes->Dest_ZipCode }},+USA/"
                                target="_blank">
                                    {{ Str::replace(',', '-', $row->all_listing->routes->Dest_ZipCode) }}
                                </a>
                            </td>
                            <td>
                                @if(count($row->all_listing->vehicles) === 1)
                                    @foreach ($row->all_listing->vehicles as $vehcile)
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
                                @if(count($row->all_listing->vehicles) > 1)
                                    <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                    data-trigger="focus" style="cursor: pointer;"
                                    title="Attached vehicles" data-content=
                                        "@foreach ($row->all_listing->vehicles as $vehcile)
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
                                        ({{ count($row->all_listing->vehicles) }})
                                    </a>
                                @endif
                                @if(count($row->all_listing->heavy_equipments) === 1)
                                    @foreach ($row->all_listing->heavy_equipments as $vehcile)
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
                                @if(count($row->all_listing->heavy_equipments) > 1)
                                    <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                    data-trigger="focus" style="cursor: pointer;"
                                    title="Attached vehicles" data-content=
                                        "@foreach ($row->all_listing->heavy_equipments as $vehcile)
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
                                        ({{ count($row->all_listing->heavy_equipments) }})
                                    </a>
                                @endif
                                @if(count($row->all_listing->dry_vans) === 1)
                                    @foreach ($row->all_listing->dry_vans as $vehcile)
                                        {{ $vehcile->Freight_Class }}
                                        {{ $vehcile->Freight_Weight }}<br>
                                        @if ($vehcile->is_hazmat_Check !== 0)
                                            Hazmat Required<br>
                                        @endif
                                    @endforeach
                                @endif
                                @if(count($row->all_listing->dry_vans) > 1)
                                    <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                    data-trigger="focus" style="cursor: pointer;"
                                    title="Attached vehicles" data-content=
                                        "@foreach ($row->all_listing->dry_vans as $vehcile)
                                        {{ $vehcile->Freight_Class }}
                                        {{ $vehcile->Freight_Weight }}<br>
                                        @if ($vehcile->is_hazmat_Check !== 0)
                                            Hazmat Required<br>
                                        @endif
                                    @endforeach" data-html="true">Vehicles
                                        ({{ count($row->all_listing->dry_vans) }})
                                    </a>
                                @endif
                                <br>
                                <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                data-trigger="focus" style="cursor: pointer;"
                                title="Additional Terms" data-content=
                                    "{{ !empty($row->all_listing->additional_info->Additional_Terms) ? $row->all_listing->additional_info->Additional_Terms : '' }}">
                                    {{ !empty($row->all_listing->additional_info->Additional_Terms) ? Str::limit($row->all_listing->additional_info->Additional_Terms, 20) : '...' }}</a>
                            </td>
                            <td>
                                @if(count($row->all_listing->attachments) > 0)
                                    <strong><a
                                            href="{{ route('Order.Attachments', ['List_ID' => $row->all_listing->id]) }}"
                                            target="_blank">View Images</a></strong><br>
                                @endif
                                <strong>Ref-ID:</strong>{{ $row->all_listing->Ref_ID }} <br>
                                {{ $row->all_listing->routes->Miles }} miles<br>
                                $ {{ DayDispatchHelper::PricePerMiles($row->all_listing->paymentinfo->COD_Amount, $row->all_listing->routes->Miles) }}
                                /miles
                            </td>
                            <td>
                                <strong>Price to Pay:
                                </strong>${{ $row->all_listing->paymentinfo->COD_Amount }}
                                <br>
                                {{-- <strong>Assigned to:
                                </strong>{{ $row->all_listing->completed->completed_user->usr_type }}
                                <br> --}}
                                <strong><a href="{{ route('View.Profile', $row->all_listing->completed->completed_user->id) }}" target="_blank">View
                                        MC</a>&nbsp;&nbsp;<a href="{{ route('View.Profile', $row->all_listing->completed->completed_user->id) }}"
                                                            target="_blank">View DOT</a></strong>
                                @if(!empty($row->all_listing->request_broker->Offer_Price) && $row->all_listing->request_broker->Offer_Price !== 0)
                                    <br>
                                    <strong>Ask Price:
                                    </strong>${{ $row->all_listing->request_broker->Offer_Price }}
                                @endif
                            </td>
                            <td>
                                <strong>Created At:</strong><br>
                                {{ $row->all_listing->created_at }}<br>
                                <strong>Modified At:</strong><br>
                                {{ $row->all_listing->updated_at }}
                                <strong>Status:</strong><br>
                                <strong class="badge-primary">Completed</strong><br>
                                <strong>Current Status:</strong><br>
                                <span class="badge-success">{{$List->all_listing->Listing_Status}}</span>
                            </td>
                            @if (Request::url() === 'daydispatch.com/Admin/Admin-View-Profile/*/User')
                                <td>
                                    <h6>Status: <span
                                            class="badge badge-primary">{{ $row->all_listing->Listing_Status }}</span>
                                    </h6><br>
                                    <div class="dropdown show list-actions">
                                        <a class="btn btn-success dropdown-toggle btn-sm" href="#"
                                        role="button" data-toggle="dropdown" aria-haspopup="true">
                                            Actions
                                        </a>

                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                            href="https://www.google.com/maps/dir/{{ $row->all_listing->routes->Origin_ZipCode }},+USA/{{ $row->all_listing->routes->Dest_ZipCode }},+USA/"
                                            target="_blank">View Route</a>
                                            <a href="{{ route('View.Agreement', ['List_ID' => $row->all_listing->id]) }}"
                                            class="dropdown-item" role="button">View Detail</a>
                                            @if ($row->all_listing->user_id === $currentUser->id)
                                                {{-- <a class="dropdown-item" role="button"
                                                href="{{ route('View.Profile.Ratings', $row->all_listing->completed->completed_user->id) }}"
                                                target="_blank">Rate
                                                    Carrier</a> --}}
                                                    <a class="dropdown-item rate-order" data-toggle="modal"
                                                    data-target="#RatingOrderModal" href="javascript:void(0);">
                                                    <input hidden type="text" class="New-Ref-ID"
                                                        value="{{ $row->all_listing->Ref_ID }}">
                                                    <input hidden type="text" class="Listed-ID"
                                                            value="{{ $row->all_listing->id }}">
                                                    <input hidden type="text" class="Profile-ID"
                                                        value="{{ $row->all_listing->completed->completed_user->id }}">
                                                    Rate Order</a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </section>
@elseif (@isset($data['Requested']) && count($data['Requested']) > 0)
    <section>
        </br>
        <h3>Requested</h3>
        <table class="table-1 dataTable advance-6e datatable-range text-center table-bordered table-cards">
            <thead class="table-header">
                <tr>
                    <th>Routes</th>
                    <th>Load Details</th>
                    <th>ID</th>
                    <th>Request</th>
                    <th>Paymenets</th>
                    <th>Assign Dates</th>
                    <th>Listing Dates</th>
                    @if (Request::url() === 'daydispatch.com/Admin/Admin-View-Profile/*/User')
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                {{-- Requested Listings --}}
                {{-- dd('oks', $data['Requested']->toArray()) --}}
                @foreach ($data['Requested'] as $List)
                    @if (!is_null($List->all_listing))
                        <tr class="card-row" data-status="active">
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
                                            {{ $vehcile->Trailer_Type }} <br>
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
                                            {{ $vehcile->Trailer_Type }} <br>
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
                                        @if (!empty($vehcile->Equipment_Condition))
                                            {{ $vehcile->Equipment_Condition }}<br>
                                        @endif
                                        @if (!empty($vehcile->Trailer_Type))
                                            {{ $vehcile->Trailer_Type }} <br>
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
                                        @if (!empty($vehcile->Equipment_Condition))
                                            {{ $vehcile->Equipment_Condition }}<br>
                                        @endif
                                        @if (!empty($vehcile->Trailer_Type))
                                            {{ $vehcile->Trailer_Type }} <br>
                                        @endif
                                    @endforeach" data-html="true">vehicles ({{ count($List->heavy_equipments) }}
                                        )
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
                                    @endforeach" data-html="true">vehicles
                                        ({{ count($List->all_listing->dry_vans) }})
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
                                @if(count($List->all_listing->attachments) > 0)
                                    <strong><a
                                            href="{{ route('Order.Attachments', ['List_ID' => $List->all_listing->id]) }}"
                                            target="_blank">View Images</a></strong><br>
                                @endif
                                <strong>Ref-ID:</strong>{{ $List->all_listing->Ref_ID }} <br>
                                {{ $List->all_listing->routes->Miles }} miles
                                $ {{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}
                                /miles
                            </td>
                            <td>
                                @if (!is_null($List->all_listing->request_broker))
                                    <strong><a target="_blank"
                                            href="{{ route('View.Profile', $List->requested_user->id) }}">{{ $List->requested_user->Company_Name }}</a></strong><br>
                                    <strong>Request Post:
                                    </strong>{{ date('F d, Y', strtotime($List->created_at)) }}<br>
                                    <strong>PickUp: </strong>{{ $List->Pickup_Date }}
                                    ({{ $List->Date_Pickup_Mode }})
                                    <br>
                                    <strong>Delivery: </strong>{{ $List->Delivery_Date }}
                                    ({{ $List->Date_Delivery_Mode }})
                                @endif
                            </td>
                            <td>
                                <strong>Price to Pay:
                                </strong>${{ $List->all_listing->paymentinfo->COD_Amount }}
                                <br>
                                {{ !empty($List->all_listing->paymentinfo->COD_Method_Mode) ? $List->all_listing->paymentinfo->COD_Method_Mode : '' }}
                                On
                                {{ !empty($List->all_listing->paymentinfo->COD_Location_Amount) ? $List->all_listing->paymentinfo->COD_Location_Amount : '' }}
                                @if(!empty($List->Offer_Price) && $List->Offer_Price !== 0)
                                    <br>
                                    <strong>Ask Price:
                                    </strong>${{ $List->Offer_Price }}
                                @endif
                            </td>
                            <td>
                                <strong>Pickup:</strong><br>
                                {{ $List->Pickup_Date }}
                                ({{ $List->Date_Pickup_Mode }})
                                <br>
                                <strong>Delivery:</strong><br>
                                {{ $List->Delivery_Date }}
                                ({{ $List->Date_Delivery_Mode }})<br>
                            </td>
                            <td>
                                <strong>Created At:</strong><br>
                                {{ $List->created_at }}<br>
                                <strong>Modified At:</strong><br>
                                {{ $List->updated_at }}
                                <strong>Status:</strong><br>
                                <strong class="badge-primary">Requested</strong><br>
                                <strong>Current Status:</strong><br>
                                <span class="badge-success">{{$List->all_listing->Listing_Status}}</span>
                            </td>
                            @if (Request::url() === 'daydispatch.com/Admin/Admin-View-Profile/*/User')
                                <td>
                                    <h6>Status: <span class="badge badge-warning">{{ $List->status }}</span></h6>
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
                                                href="{{ route('User.Dispatch.Listing', ['List_ID' => $List->all_listing->id]) }}">Assign
                                                    Listing</a>
                                                <a class="dropdown-item"
                                                href="{{ route('Requested.Listing.Canceled', ['List_ID' => $List->all_listing->id]) }}">Cancel
                                                    Request</a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </section>
@elseif (@isset($data['Dispatch']) && count($data['Dispatch']) > 0)
    <section>
        </br>
        <h3>Dispatched</h3>
        <table class="table-1 dataTable advance-6e datatable-range text-center table-bordered table-cards">
            <thead class="table-header">
                <tr>
                    <th>Request</th>
                    <th>Routes</th>
                    <th>Load Details</th>
                    <th>ID</th>
                    <th>Paymenets</th>
                    <th>Dates</th>
                    @if (Request::url() === 'daydispatch.com/Admin/Admin-View-Profile/*/User')
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                {{-- Dispatched Listings --}}
                @foreach ($data['Dispatch'] as $List)
                    {{-- dd('oks', $List->toArray()) --}}
                    @if (!is_null($List->dispatch_user))
                        <tr class="card-row" data-status="active">
                            <td>
                                <strong><a target="_blank"
                                        href="{{ route('View.Profile', $List->all_listing->dispatch_listing->dispatch_user->id) }}">{{ $List->all_listing->dispatch_listing->dispatch_user->Company_Name }}</a></strong><br>
                                <strong><a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                        target="_blank">View Contract</a>
                                </strong><br>
                                <strong>PickUp: </strong>{{ $List->all_listing->pickup_delivery_info->Pickup_Date }}
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
                                    <strong><a href="{{ route('Order.Attachments', ['List_ID' => $List->all_listing->id]) }}"
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
                                </strong>{{ $List->all_listing->dispatch_listing->dispatch_user->usr_type }}
                                <br> --}}
                                <strong><a href="{{ route('View.Profile', $List->all_listing->dispatch_listing->dispatch_user->id) }}"
                                        target="_blank">View
                                        MC</a>&nbsp;&nbsp;<a
                                        href="{{ route('View.Profile', $List->all_listing->dispatch_listing->dispatch_user->id) }}"
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
                                <strong>Status:</strong><br>
                                <strong class="badge-primary">Dispatch</strong><br>
                                <strong>Current Status:</strong><br>
                                <span class="badge-success">{{$List->all_listing->Listing_Status}}</span>
                            </td>
                            @if (Request::url() === 'daydispatch.com/Admin/Admin-View-Profile/*/User')
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
                                            <a data-toggle="modal"
                                            data-target="#CancelOrderModal" href="javascript:void(0);"
                                            class="dropdown-item Cancel_Order" role="button">
                                                <input hidden type="text" class="Listed-ID"
                                                    value="{{ $List->all_listing->id }}">
                                                <input hidden type="text" class="User-ID"
                                                    value="{{ $List->all_listing->user_id }}">
                                                <input hidden type="text" class="CMP-ID"
                                                    value="{{ $List->all_listing->dispatch_listing->dispatch_user->id }}">
                                                <input hidden type="text" class="Order-Status"
                                                    value="{{ $List->all_listing->Listing_Status }}">
                                                Cancel Order</a>
                                            <a class="dropdown-item compare-listing" data-toggle="modal"
                                            data-target="#CompareListing" href="javascript:void(0);">
                                                <input hidden type="text" class="Listed-ID"
                                                    value="{{ $List->all_listing->id }}">
                                                <input hidden type="text" class="Listed-Type"
                                                    value="{{ $List->all_listing->Listing_Type }}">
                                                <input hidden type="text" class="Listed-Miles"
                                                    value="{{ $List->all_listing->routes->Miles }}">
                                                Compare Listing</a>
                                            @if($List->all_listing->user_id !== $currentUser->id)
                                                <a href="{{ route('Order.Pickup.Approval', ['List_ID' => $List->all_listing->id]) }}"
                                                class="dropdown-item" role="button">PickUp</a>
                                            @endif
                                            @if ($List->all_listing->user_id === $currentUser->id)
                                                <a class="dropdown-item"
                                                href="{{ route('User.Edit.Listing', ['List_ID' => $List->all_listing->id]) }}">Edit
                                                    Listing</a>
                                                <a class="dropdown-item"
                                                href="{{ route('Order.Pickup.Approval', ['List_ID' => $List->all_listing->id]) }}">PickUp</a>
                                                <a class="dropdown-item"
                                                href="{{ route('Order.Not.Pickup.Approval', ['List_ID' => $List->all_listing->id]) }}">Not
                                                    PickUp</a>
                                                <a class="dropdown-item"
                                                href="{{ route('User.Listing.Archive', ['List_ID' => $List->all_listing->id]) }}">Archive
                                                    Order</a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </section>
@elseif (@isset($data['Waiting_Approval']) && count($data['Waiting_Approval']) > 0)
    <section>
        </br>
        <h3>WaitingForApproval</h3>
        <table class="table-1 dataTable advance-6e datatable-range text-center table-bordered table-cards">
            <thead class="table-header">
                <tr>
                    <th>Request</th>
                    <th>Routes</th>
                    <th>Load Details</th>
                    <th>ID</th>
                    <th>Paymenets</th>
                    <th>Dates</th>
                    @if (Request::url() === 'daydispatch.com/Admin/Admin-View-Profile/*/User')
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                {{-- WaitingForApproval Listings --}}
                @foreach ($data['Waiting_Approval'] as $List)
                {{-- {{dd($data['Waiting_Approval']->toArray())}} --}}
                    @if (!is_null($List->waiting_users))
                        <tr class="card-row" data-status="active">
                            <td>
                                <strong><a target="_blank"
                                        href="{{ route('View.Profile', $List->all_listing->waitings->waiting_users->id) }}">{{ $List->all_listing->waitings->waiting_users->Company_Name }}</a></strong><br>
                                <strong>Request Post:
                                </strong>{{ $List->created_at }}<br>

                                <strong>Pickup:</strong><br>{{ $List->all_listing->pickup_delivery_info->Pickup_Date }}
                                ({{ $List->all_listing->pickup_delivery_info->Pickup_Date_mode }})
                                <br>
                                <strong>Delivery:</strong><br>{{ $List->all_listing->pickup_delivery_info->Delivery_Date }}
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
                                </strong>{{ $List->all_listing->waitings->waiting_users->usr_type }}<br> --}}
                                <strong><a
                                        href="{{ route('View.Profile', $List->all_listing->waitings->waiting_users->id) }}"
                                        target="_blank">View
                                        MC</a>&nbsp;&nbsp;<a
                                        href="{{ route('View.Profile', $List->all_listing->waitings->waiting_users->id) }}"
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
                                {{ $List->all_listing->updated_at }}<br>
                                <strong>Status:</strong><br>
                                <strong class="badge-primary">WaitingForApp</strong><br>
                                <strong>Current Status:</strong><br>
                                <span class="badge-success">{{$List->all_listing->Listing_Status}}</span>

                            </td>
                            @if (Request::url() === 'daydispatch.com/Admin/Admin-View-Profile/*/User')
                                <td>
                                    <h6>Status: <span class="badge badge-primary">Waiting</span></h6><br>
                                    <div class="dropdown show list-actions">
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
                                            @if($List->all_listing->user_id !== $currentUser->id)
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
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </section>
@elseif (@isset($data['PickUp_Approval']) && count($data['PickUp_Approval']) > 0)
    <section>
        </br>
        <h3>PickupApproval</h3>
        <table class="table-1 dataTable advance-6e datatable-range text-center table-bordered table-cards">
            <thead class="table-header">
                <tr>
                    <th>Routes</th>
                    <th>Load Details</th>
                    <th>ID</th>
                    <th>Company Details</th>
                    <th>Paymenets</th>
                    <th>Assign Dates</th>
                    <th>Listing Dates</th>
                    @if (Request::url() === 'daydispatch.com/Admin/Admin-View-Profile/*/User')
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                {{-- PickupApproval Listings --}}
                @foreach ($data['PickUp_Approval'] as $List)
                    @if (!is_null($List->pickup_approval_user))
                        <tr class="card-row" data-status="active">
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
                                <strong><a href="{{ route('View.Profile', $List->all_listing->authorized_user->id) }}"
                                        target="_blank">{{ $List->all_listing->authorized_user->Company_Name }}</a></strong><br>
                                {{ $List->all_listing->authorized_user->Contact_Phone }}<br>
                                {{ $List->all_listing->authorized_user->Hours_Operations }}<br>
                                {{ $List->all_listing->authorized_user->Time_Zone }}<br>
                            </td>
                            <td>
                                <strong>Price to Pay:
                                </strong>${{ $List->all_listing->paymentinfo->COD_Amount }}
                                <br>
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
                                <strong>Status:</strong><br>
                                <strong class="badge-primary">PickUp Approval</strong><br>
                                <strong>Current Status:</strong><br>
                                <span class="badge-success">{{$List->all_listing->Listing_Status}}</span>
                            </td>
                            @if (Request::url() === 'daydispatch.com/Admin/Admin-View-Profile/*/User')
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
                            @endif
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </section>
@elseif (@isset($data['PickUp']) && count($data['PickUp']) > 0)
    <section>
        </br>
        <h3>PickupOrders</h3>
        <table class="table-1 dataTable advance-6e datatable-range text-center table-bordered table-cards">
            <thead class="table-header">
                <tr>
                    <th>Request</th>
                    <th>Routes</th>
                    <th>Load Details</th>
                    <th>ID</th>
                    <th>Paymenets</th>
                    <th>Dates</th>
                    @if (Request::url() === 'daydispatch.com/Admin/Admin-View-Profile/*/User')
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                {{-- PickupOrders Listings --}}
                @foreach ($data['PickUp'] as $List)
                    @if (!is_null($List->pickup_user))
                        <tr class="card-row" data-status="active">
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
                                </strong>{{ $List->all_listing->pickup->pickup_user->usr_type }} --}}
                                <br>
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
                                <strong>Status:</strong><br>
                                <strong class="badge-primary">PickUp</strong><br>
                                <strong>Current Status:</strong><br>
                                <span class="badge-success">{{$List->all_listing->Listing_Status}}</span>
                            </td>
                            @if (Request::url() === 'daydispatch.com/Admin/Admin-View-Profile/*/User')
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
                            @endif
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </section>
@elseif (@isset($data['Deliver_Approval']) && count($data['Deliver_Approval']) > 0)
    <section>
        </br>
        <h3>Deliver Approval Listing</h3>
        <table class="table-1 dataTable advance-6e datatable-range text-center table-bordered table-cards">
            <thead class="table-header">
                <tr>
                    <th>Request</th>
                    <th>Routes</th>
                    <th>Load Details</th>
                    <th>ID</th>
                    <th>Paymenets</th>
                    <th>Dates</th>
                    @if (Request::url() === 'daydispatch.com/Admin/Admin-View-Profile/*/User')
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                {{-- Deliver Approval Listings --}}
                @foreach ($data['Deliver_Approval'] as $List)
                    @if (!is_null($List->deliver_approval_user))
                        <tr class="card-row" data-status="active">
                            <td>
                                <strong><a target="_blank"
                                        href="{{ route('View.Profile', $List->all_listing->deliver_approve->deliver_approval_user->id) }}">{{ $List->all_listing->deliver_approve->deliver_approval_user->Company_Name }}</a></strong><br>
                                <strong><a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                        target="_blank">View Contract</a>
                                </strong><br>
                                <strong>PickUp: </strong>{{ $List->all_listing->pickup_delivery_info->Pickup_Date }}
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
                                </strong>{{ $List->all_listing->deliver_approve->deliver_approval_user->usr_type }}
                                <br> --}}
                                <strong><a href="{{ route('View.Profile', $List->all_listing->deliver_approve->deliver_approval_user->id) }}" target="_blank">View
                                        MC</a>&nbsp;&nbsp;<a href="{{ route('View.Profile', $List->all_listing->deliver_approve->deliver_approval_user->id) }}"
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
                                <strong>Status:</strong><br>
                                <strong class="badge-primary">Deliver Approval</strong><br>
                                <strong>Current Status:</strong><br>
                                <span class="badge-success">{{$List->all_listing->Listing_Status}}</span>
                            </td>
                            @if (Request::url() === 'daydispatch.com/Admin/Admin-View-Profile/*/User')
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
                                                <a class="dropdown-item"
                                                href="{{ route('Order.Deliverd', ['List_ID' => $List->all_listing->id]) }}">Delivered</a>
                                                <a class="dropdown-item"
                                                href="{{ route('Order.Not.Deliverd', ['List_ID' => $List->all_listing->id]) }}">Not
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
                                                        value="{{ $List->all_listing->id }}">Delivered</a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </section>
@elseif (@isset($data['Delivered']) && count($data['Delivered']) > 0)
    <section>
        </br>
        <h3>Deliverd Orders</h3>
        <table class="table-1 dataTable advance-6e datatable-range text-center table-bordered table-cards">
            <thead class="table-header">
                <tr>
                    <th>Request</th>
                    <th>Routes</th>
                    <th>Load Details</th>
                    <th>ID</th>
                    <th>Paymenets</th>
                    <th>Dates</th>
                    @if (Request::url() === 'daydispatch.com/Admin/Admin-View-Profile/*/User')
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                {{-- Deliverd Orders --}}
                @foreach ($data['Delivered'] as $List)
                    @if (!is_null($List->delivered_user))
                        <tr class="card-row" data-status="active">
                            <td>
                                <strong><a target="_blank"
                                        href="{{ route('View.Profile', $List->all_listing->deliver->delivered_user->id) }}">{{ $List->all_listing->deliver->delivered_user->Company_Name }}</a></strong><br>
                                <strong><a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                        target="_blank">View Contract</a>
                                </strong><br>
                                <strong>PickUp: </strong>{{ $List->all_listing->pickup_delivery_info->Pickup_Date }}
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
                                </strong>{{ $List->all_listing->deliver->delivered_user->usr_type }}
                                <br> --}}
                                <strong><a href="{{ route('View.Profile', $List->all_listing->deliver->delivered_user->id) }}"
                                        target="_blank">View
                                        MC</a>&nbsp;&nbsp;<a
                                        href="{{ route('View.Profile', $List->all_listing->deliver->delivered_user->id) }}"
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
                                <strong>Status:</strong><br>
                                <strong class="badge-primary">Delivered</strong><br>
                                <strong>Current Status:</strong><br>
                                <span class="badge-success">{{$List->all_listing->Listing_Status}}</span>
                            </td>
                            @if (Request::url() === 'daydispatch.com/Admin/Admin-View-Profile/*/User')
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
                                                <a class="dropdown-item"
                                                href="{{ route('Order.Completed', ['List_ID' => $List->all_listing->id]) }}">Completed</a>
                                                <a class="dropdown-item"
                                                href="{{ route('Order.Not.Completed', ['List_ID' => $List->all_listing->id]) }}">Not
                                                    Completed</a>
                                                <a class="dropdown-item"
                                                href="{{ route('User.Listing.Archive', ['List_ID' => $List->all_listing->id]) }}">Archive
                                                    Order</a>
                                            @endif
                                            @if ($List->all_listing->user_id !== $currentUser->id)
                                                <a class="dropdown-item add-misc" data-toggle="modal"
                                                data-target="#AddMisc" href="javascript:void(0);">
                                                    <input hidden type="text" class="Listed-ID"
                                                        value="{{ $List->all_listing->id }}">Add Misc.</a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </section>
@elseif (@isset($data['Archived']) && count($data['Archived']) > 0)
    <section>
        </br>
        <h3>Archived Orders</h3>
        <table class="table-1 dataTable advance-6e datatable-range text-center table-bordered table-cards">
            <thead class="table-header">
                <tr>
                    <th>Request</th>
                    <th>Routes</th>
                    <th>Load Details</th>
                    <th>ID</th>
                    <th>Paymenets</th>
                    <th>Dates</th>
                    @if (Request::url() === 'daydispatch.com/Admin/Admin-View-Profile/*/User')
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                {{-- Archived Orders --}}
                @foreach ($data['Archived'] as $List)
                    <tr class="card-row" data-status="active">
                        <td>
                            <strong>Pickup Route</strong><br>
                            <a href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                            target="_blank">
                                {{ Str::replace(',', '-', $List->routes->Origin_ZipCode) }}
                            </a><br>
                            <strong>Delivery Route</strong><br>
                            <a href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
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
                                    @if (!empty($vehcile->Equipment_Condition))
                                        {{ $vehcile->Equipment_Condition }}<br>
                                    @endif
                                    @if (!empty($vehcile->Trailer_Type))
                                        {{ $vehcile->Trailer_Type }} <br>
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
                                    @if (!empty($vehcile->Equipment_Condition))
                                        {{ $vehcile->Equipment_Condition }}<br>
                                    @endif
                                    @if (!empty($vehcile->Trailer_Type))
                                        {{ $vehcile->Trailer_Type }} <br>
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
                                @endforeach" data-html="true">vehicles
                                    ({{ count($List->dry_vans) }})
                                </a>
                            @endif
                            <br>
                            <a tabindex="0" class="" role="button" data-toggle="popover" data-trigger="focus"
                            title="Additional Terms" data-content=
                                "{{ !empty($List->additional_info->Additional_Terms) ? $List->additional_info->Additional_Terms : '' }}">
                                {{ !empty($List->additional_info->Additional_Terms) ? Str::limit($List->additional_info->Additional_Terms, 20) : '...' }}</a>
                        </td>
                        <td>
                            @if(count($List->attachments) > 0)
                                <strong><a
                                        href="{{ route('Order.Attachments', ['List_ID' => $List->id]) }}"
                                        target="_blank">View Images</a></strong><br>
                            @endif
                            <strong>Ref-ID:</strong>{{ $List->Ref_ID }} <br>
                            {{ $List->routes->Miles }} miles <br>
                            $ {{ DayDispatchHelper::PricePerMiles($List->paymentinfo->COD_Amount, $List->routes->Miles) }}
                            /miles
                        </td>
                        <td>
                            <strong>Price to Pay: </strong> $
                            {{ $List->paymentinfo->COD_Amount }}<br>
                            <strong>COD / COP: </strong>
                            {{ $List->paymentinfo->COD_Method_Mode }}
                            @if(!empty($List->request_broker->Offer_Price) && $List->request_broker->Offer_Price !== 0)
                                <br>
                                <strong>Ask Price:
                                </strong>${{ $List->request_broker->Offer_Price }}
                            @endif
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
                                    @if ($List->user_id === $currentUser->id)
                                        <a class="dropdown-item"
                                        href="{{ route('User.Listing.Restore', ['List_ID' => $List->id]) }}">Restore
                                            Listing</a>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@elseif (@isset($data['Listed']) && count($data['Listed']) > 0)
    <section>
        </br>
        <h3>Listed</h3>
        <table class="table-1 dataTable advance-6e datatable-range text-center table-bordered table-cards">
            <thead class="table-header">
                <tr>
                    <th>Request</th>
                    <th>Routes</th>
                    <th>Load Details</th>
                    <th>ID</th>
                    <th>Paymenets</th>
                    <th>Dates</th>
                    @if (Request::url() === 'daydispatch.com/Admin/Admin-View-Profile/*/User')
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                {{-- Listed Orders --}}
                {{-- {{dd($data['Listed']->toArray())}} --}}
                @foreach ($data['Listed'] as $List)
                    @if(!$currentUser->is_heavy_subscribe)
                        @continue($List->Listing_Type === 2)
                    @endif
                    @if(!$currentUser->is_dry_van_subscribe)
                        @continue($List->Listing_Type === 3)
                    @endif
                    <tr class="card-row" data-status="active">
                        <td>
                            <strong>Pickup Route</strong><br>
                            <a href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                            target="_blank">
                                {{ Str::replace(',', '-', $List->routes->Origin_ZipCode) }}
                            </a><br>
                            <strong>Delivery Route</strong><br>
                            <a href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
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
                                        <span class="text-danger font-weight-bold">{{ $vehcile->Vehcile_Condition }}<br></span>
                                    @endif
                                    @if (!empty($vehcile->Trailer_Type))
                                        <span @if($vehcile->Trailer_Type == '"(Enclosed Trailer Required)"') class="text-primary font-weight-bold" @endif>{{ $vehcile->Trailer_Type }}</span> <br>
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
                                        <span class='text-danger font-weight-bold'>{{ $vehcile->Vehcile_Condition }}<br></span>
                                    @endif
                                    @if (!empty($vehcile->Trailer_Type))
                                        <span @if($vehcile->Trailer_Type == "'(Enclosed Trailer Required)'") class='text-primary font-weight-bold' @endif>{{ $vehcile->Trailer_Type }}</span> <br>
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
                                        <span @if($vehcile->Trailer_Type == '"(Enclosed Trailer Required)"') class="text-primary font-weight-bold" @endif>{{ $vehcile->Trailer_Type }}</span>
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
                                        <span @if($vehcile->Trailer_Type == "'(Enclosed Trailer Required)'") class='text-primary font-weight-bold' @endif>{{ $vehcile->Trailer_Type }}</span>
                                    @endif
                                @endforeach" data-html="true">vehicles ({{ count($List->heavy_equipments) }})
                                </a>
                            @endif
                            @if(count($List->dry_vans) === 1)
                                @foreach ($List->dry_vans as $vehcile)
                                    <span title="Freight Class">
                                        <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                            data-trigger="focus" style="cursor: pointer;"
                                            title="Freight Class" data-html="true"> {{ $vehcile->Freight_Class }} 
                                        </a>
                                    </span>
                                    <span title="Freight Weight">  
                                        
                                    <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                        data-trigger="focus" style="cursor: pointer;"
                                        title="Freight Weight" data-html="true">{{ $vehcile->Freight_Weight }} 
                                    </a>    
                                    </span> <b>LBS</b><br>
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
                                    <span title='Freight Class'>{{ $vehcile->Freight_Class }}</span>
                                    <span title='Freight Weight'>{{ $vehcile->Freight_Weight }}</span> <b>LBS</b><br>
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
                            @if(count($List->attachments) > 0)
                                <strong><a href="{{ route('Order.Attachments', ['List_ID' => $List->id]) }}"
                                        target="_blank">View Images</a></strong><br>
                            @endif
                            <strong>Ref-ID:</strong>{{ $List->Ref_ID }} <br>
                            {{ $List->routes->Miles }} miles <br>
                            $ {{ DayDispatchHelper::PricePerMiles($List->paymentinfo->COD_Amount, $List->routes->Miles) }}
                            /miles
                        </td>
                        <td>
                            <strong><a
                                    href="{{ route('View.Profile', ['user_id' => $List->authorized_user->id]) }}">{{ $List->authorized_user->Company_Name }}</a></strong><br>
                            {{ $List->authorized_user->Contact_Phone }}<br>
                            {{ $List->authorized_user->Hours_Operations }}<br>
                            {{ $List->authorized_user->Time_Zone }}
                        </td>
                        <td>
                            <strong>Price to Pay: </strong> $
                            {{ $List->paymentinfo->COD_Amount }}<br>
                            <strong>COD / COP: </strong>
                            {{ $List->paymentinfo->COD_Method_Mode }}
                        </td>
                        <td>
                            <strong>Pickup Date: </strong><br>
                            ({{ $List->pickup_delivery_info->Pickup_Date_mode }})
                            {{ $List->pickup_delivery_info->Pickup_Date }}
                            @if (!is_null($List->pickup_delivery_info->Pickup_Start_Time))
                                <br>
                                {{ \Carbon\Carbon::parse($List->pickup_delivery_info->Pickup_Start_Time)->format('g:i:s A').' - '.\Carbon\Carbon::parse($List->pickup_delivery_info->Pickup_End_Time)->format('g:i:s A')}}
                            @endif
                            <br>
                            <strong>Deliver Date: </strong><br>
                            ({{ $List->pickup_delivery_info->Delivery_Date_mode }})
                            {{ $List->pickup_delivery_info->Delivery_Date }}<br>

                            <strong>Status:</strong><br>
                            <strong class="badge-primary">Listed</strong><br>
                            <strong>Current Status:</strong><br>
                            <span class="badge-success">{{$List->Listing_Status}}</span>

                            @if (!is_null($List->pickup_delivery_info->Delivery_Start_Time))
                                <br>
                                {{ \Carbon\Carbon::parse($List->pickup_delivery_info->Delivery_Start_Time)->format('g:i:s A').' - '.\Carbon\Carbon::parse($List->pickup_delivery_info->Delivery_End_Time)->format('g:i:s A')}}
                            @endif
                        </td>
                        @if (Request::url() === 'daydispatch.com/Admin/Admin-View-Profile/*/User')
                            <td>
                                {{-- {{ dd($List->authorized_user->my_watch_check($List->id)->toArray()) }} --}}
                                <a href="{{ route('User.Watchlist.store', $List->id) }}">
                                    @if($List->authorized_user->my_watch_check($List->id) !== null)
                                        <i class="fa fa-heart" aria-hidden="true" title="Remove from Watch List"></i>
                                    @else
                                        <i class="fa-regular fa-heart" title="Add to Watch List"></i>
                                    @endif
                                </a>
                                <div class="dropdown show list-actions">
                                    <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true">
                                        Actions
                                    </a>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                        href="https://www.google.com/maps/dir/{{ $List->routes->Origin_ZipCode }},+USA/{{ $List->routes->Dest_ZipCode }},+USA/"
                                        target="_blank">View Route</a>
                                    
                                    <!--<div ></div>-->
                                        <a  onclick="request_load_click({{ $List->id }})"  id="{{ $List->id }}" class="dropdown-item request-load" data-toggle="modal"
                                        data-target="#CarrierRequestLoad" href="javascript:void(0);">
                                            <input hidden type="text" class="Listed-Ref-ID"
                                                value="{{ $List->Ref_ID }}">
                                            <input hidden type="text" class="Listed-ID"
                                                value="{{ $List->id }}">
                                            <input hidden type="text" class="Listed-Price"
                                                value="{{ (int)Str::replace(['$ ', ','], "", $List->paymentinfo->COD_Amount) }}">
                                            <input hidden type="text" class="Pickup-Date"
                                                value="{{ $List->pickup_delivery_info->Pickup_Date }}">
                                            <input hidden type="text" class="Deliver-Date"
                                                value="{{ $List->pickup_delivery_info->Delivery_Date }}">
                                            Bid / Request Load</a>

                                        <a class="dropdown-item compare-listing" data-toggle="modal"
                                        data-target="#CompareListing" href="javascript:void(0);">
                                            <input hidden type="text" class="Listed-ID"
                                                value="{{ $List->id }}">
                                            <input hidden type="text" class="Listed-Type"
                                                value="{{ $List->Listing_Type }}">
                                            <input hidden type="text" class="Listed-Miles" 
                                                value="{{ $List->routes->Miles }}">
                                            Compare Listing</a>

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
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@elseif (@isset($data['WatchList']) && count($data['WatchList']) > 0)
    <section>
        </br>
        <h3>WatchList</h3>
        <table class="table-1 dataTable advance-6e datatable-range text-center table-bordered table-cards">
            <thead class="table-header">
                <tr>
                    <th>Request</th>
                    <th>Routes</th>
                    <th>Load Details</th>
                    <th>ID</th>
                    <th>Paymenets</th>
                    <th>Dates</th>
                    @if (Request::url() === 'daydispatch.com/Admin/Admin-View-Profile/*/User')
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                {{-- WatchList --}}
                @foreach ($data['WatchList'] as $List)
                    <tr class="card-row" data-status="active">
                        <td>
                            <strong>Pickup Route</strong><br>
                            <a href="https://www.google.com/maps/dir/{{ $List->listing->routes->Origin_ZipCode }},+USA/{{ $List->listing->routes->Dest_ZipCode }},+USA/"
                            target="_blank">
                                {{ Str::replace(',', '-', $List->listing->routes->Origin_ZipCode) }}
                            </a><br>
                            <strong>Delivery Route</strong><br>
                            <a href="https://www.google.com/maps/dir/{{ $List->listing->routes->Origin_ZipCode }},+USA/{{ $List->listing->routes->Dest_ZipCode }},+USA/"
                            target="_blank">
                                {{ Str::replace(',', '-', $List->listing->routes->Dest_ZipCode) }}
                            </a>
                        </td>
                        <td>
                            @if(count($List->listing->vehicles) === 1)
                                @foreach ($List->listing->vehicles as $vehcile)
                                    <a href="https://www.google.com/search?q={{ $vehcile->Vehcile_Year }}%20{{ $vehcile->Vehcile_Make }}%20{{ $vehcile->Vehcile_Model }}"
                                    target="_blank"> {{ $vehcile->Vehcile_Year }}
                                        {{ $vehcile->Vehcile_Make }}
                                        {{ $vehcile->Vehcile_Model }}</a><br>
                                    @if (!empty($vehcile->Vehcile_Condition))
                                        <span class="text-danger font-weight-bold">{{ $vehcile->Vehcile_Condition }}<br></span>
                                    @endif
                                    @if (!empty($vehcile->Trailer_Type))
                                        <span @if($vehcile->Trailer_Type == '"(Enclosed Trailer Required)"') class="text-primary font-weight-bold" @endif>{{ $vehcile->Trailer_Type }}</span> <br>
                                    @endif
                                @endforeach
                            @endif
                            @if(count($List->listing->vehicles) > 1)
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
                                        <span @if($vehcile->Trailer_Type == '"(Enclosed Trailer Required)"') class="text-primary font-weight-bold" @endif>{{ $vehcile->Trailer_Type }}</span> <br>
                                    @endif
                                @endforeach" data-html="true">vehicles ({{ count($List->listing->vehicles) }})
                                </a>
                            @endif
                            @if(count($List->listing->heavy_equipments) === 1)
                                @foreach ($List->listing->heavy_equipments as $vehcile)
                                    {{ $vehcile->Equipment_Year }}
                                    {{ $vehcile->Equipment_Make }}
                                    {{ $vehcile->Equipment_Model }}<br>
                                    <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} | <b>H</b>{{ $vehcile->Equip_Height }}
                                    | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                    @if (!empty($vehcile->Equipment_Condition))
                                        <br>{{ $vehcile->Equipment_Condition }}<br>
                                    @endif
                                    @if (!empty($vehcile->Trailer_Type))
                                        <span @if($vehcile->Trailer_Type == '"(Enclosed Trailer Required)"') class="text-primary font-weight-bold" @endif>{{ $vehcile->Trailer_Type }}</span>
                                    @endif
                                @endforeach
                            @endif
                            @if(count($List->listing->heavy_equipments) > 1)
                                <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                data-trigger="focus" style="cursor: pointer;"
                                title="Attached vehicles" data-content=
                                    "@foreach ($List->listing->heavy_equipments as $vehcile)
                                    {{ $vehcile->Equipment_Year }}
                                    {{ $vehcile->Equipment_Make }}
                                    {{ $vehcile->Equipment_Model }}<br>
                                        <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }} | <b>H</b>{{ $vehcile->Equip_Height }} | {{ $vehcile->Equip_Weight }} <b>LBS</b>
                                    @if (!empty($vehcile->Equipment_Condition))
                                        <br>{{ $vehcile->Equipment_Condition }}<br>
                                    @endif
                                    @if (!empty($vehcile->Trailer_Type))
                                        <span @if($vehcile->Trailer_Type == '"(Enclosed Trailer Required)"') class="text-primary font-weight-bold" @endif>{{ $vehcile->Trailer_Type }}</span>
                                    @endif
                                @endforeach" data-html="true">vehicles ({{ count($List->listing->heavy_equipments) }})
                                </a>
                            @endif
                            @if(count($List->listing->dry_vans) === 1)
                                @foreach ($List->listing->dry_vans as $vehcile)
                                    <span title="Freight Class">{{ $vehcile->Freight_Class }}</span>
                                    <span title="Freight Weight">{{ $vehcile->Freight_Weight }}</span> <b>LBS</b><br>
                                    @if ($vehcile->is_hazmat_Check !== 0)
                                        Hazmat Required<br>
                                    @endif
                                @endforeach
                            @endif
                            @if(count($List->listing->dry_vans) > 1)
                                <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                data-trigger="focus" style="cursor: pointer;"
                                title="Attached vehicles" data-content=
                                    "@foreach ($List->listing->dry_vans as $vehcile)
                                    <span title="Freight Class">{{ $vehcile->Freight_Class }}</span>
                                    <span title="Freight Weight">{{ $vehcile->Freight_Weight }}</span> <b>LBS</b><br>
                                    @if ($vehcile->is_hazmat_Check !== 0)
                                        Hazmat Required<br>
                                    @endif
                                @endforeach" data-html="true">vehicles ({{ count($List->listing->dry_vans) }})
                                </a>
                            @endif
                            <br>
                            <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                            data-trigger="focus" style="cursor: pointer;"
                            title="Additional Terms" data-content=
                                "{{ !empty($List->listing->additional_info->Additional_Terms) ? $List->listing->additional_info->Additional_Terms : '' }}">
                                {{ !empty($List->listing->additional_info->Additional_Terms) ? Str::limit($List->listing->additional_info->Additional_Terms, 20) : '...' }}</a>
                        </td>
                        <td>
                            @if(count($List->listing->attachments) > 0)
                                <strong><a href="{{ route('Order.Attachments', ['List_ID' => $List->listing->id]) }}"
                                        target="_blank">View Images</a></strong><br>
                            @endif
                            <strong>Ref-ID:</strong>{{ $List->listing->Ref_ID }} <br>
                            {{ $List->listing->routes->Miles }} miles <br>
                            $ {{ DayDispatchHelper::PricePerMiles($List->listing->paymentinfo->COD_Amount, $List->listing->routes->Miles) }}
                            /miles
                        </td>
                        <td>
                            <strong><a
                                    href="{{ route('View.Profile', ['user_id' => $List->listing->authorized_user->id]) }}">{{ $List->listing->authorized_user->Company_Name }}</a></strong><br>
                            {{ $List->listing->authorized_user->Contact_Phone }}<br>
                            {{ $List->listing->authorized_user->Hours_Operations }}<br>
                            {{ $List->listing->authorized_user->Time_Zone }}
                        </td>
                        <td>
                            <strong>Price to Pay: </strong> $
                            {{ $List->listing->paymentinfo->COD_Amount }}<br>
                            <strong>COD / COP: </strong>
                            {{ $List->listing->paymentinfo->COD_Method_Mode }}
                        </td>
                        <td>
                            <strong>Pickup Date: </strong><br>
                            ({{ $List->listing->pickup_delivery_info->Pickup_Date_mode }})
                            {{ $List->listing->pickup_delivery_info->Pickup_Date }}
                            @if (!is_null($List->listing->pickup_delivery_info->Pickup_Start_Time))
                                <br>
                                {{ \Carbon\Carbon::parse($List->listing->pickup_delivery_info->Pickup_Start_Time)->format('g:i:s A').' - '.\Carbon\Carbon::parse($List->listing->pickup_delivery_info->Pickup_End_Time)->format('g:i:s A')}}
                            @endif
                            <br>
                            <strong>Deliver Date: </strong><br>
                            ({{ $List->listing->pickup_delivery_info->Delivery_Date_mode }})
                            {{ $List->listing->pickup_delivery_info->Delivery_Date }}
                            <strong>Status:</strong><br>
                            <strong class="badge-primary">WatchList</strong><br>
                            <strong>Current Status:</strong><br>
                            <span class="badge-success">{{$List->all_listing->Listing_Status}}</span>
                            @if (!is_null($List->listing->pickup_delivery_info->Delivery_Start_Time))
                                <br>
                                {{ \Carbon\Carbon::parse($List->listing->pickup_delivery_info->Delivery_Start_Time)->format('g:i:s A').' - '.\Carbon\Carbon::parse($List->listing->pickup_delivery_info->Delivery_End_Time)->format('g:i:s A')}}
                            @endif
                        </td>
                        @if (Request::url() === 'daydispatch.com/Admin/Admin-View-Profile/*/User')
                            <td>
                                <div class="dropdown show list-actions">
                                    <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true">
                                        Actions
                                    </a>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                        href="https://www.google.com/maps/dir/{{ $List->listing->routes->Origin_ZipCode }},+USA/{{ $List->listing->routes->Dest_ZipCode }},+USA/"
                                        target="_blank">View Route</a>

                                        <a class="dropdown-item" href="{{ route('User.Watchlist.store', $List->listing->id) }}">
                                            Remove From Watchlist
                                        </a>
                                    </div>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@elseif (@isset($data['Cancelled']) && count($data['Cancelled']) > 0)
    <section>
        </br>
        <h3>Cancelled Orders</h3>
        <table class="table-1 dataTable advance-6e datatable-range text-center table-bordered table-cards">
            <thead class="table-header">
                <tr>
                    <th>Request</th>
                    <th>Routes</th>
                    <th>Load Details</th>
                    <th>ID</th>
                    <th>Paymenets</th>
                    <th>Dates</th>
                    @if (Request::url() === 'daydispatch.com/Admin/Admin-View-Profile/*/User')
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                {{-- Cancelled Orders --}}
                @foreach ($data['Cancelled'] as $List)
                    @if (!is_null($List->cancel_user))
                        <tr class="card-row" data-status="active">
                            <td>
                                <strong><a target="_blank"
                                        href="{{ route('View.Profile', $List->all_listing->cancel->cancel_user->id) }}">{{ $List->all_listing->cancel->cancel_user->Company_Name }}</a></strong><br>
                                <strong><a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                        target="_blank">View Contract</a>
                                </strong><br>
                                <strong>PickUp: </strong>{{ $List->all_listing->pickup_delivery_info->Pickup_Date }}
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
                                {{ $List->all_listing->routes->Miles }} miles
                            </td>
                            <td>
                                <strong>Price to Pay:
                                </strong>${{ $List->all_listing->paymentinfo->COD_Amount }}
                                <br>
                                {{-- <strong>Assigned to:
                                </strong>{{ $List->all_listing->cancel->cancel_user->usr_type }}
                                <br> --}}
                                <strong><a href="{{ route('View.Profile', $List->all_listing->cancel->cancel_user->id) }}" target="_blank">View
                                        MC</a>&nbsp;&nbsp;<a href="{{ route('View.Profile', $List->all_listing->cancel->cancel_user->id) }}"
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
                                <strong>Status:</strong><br>
                                <strong class="badge-primary">Cancelled</strong><br>
                                <strong>Current Status:</strong><br>
                                <span class="badge-success">{{$List->all_listing->Listing_Status}}</span>
                            </td>
                            @if (Request::url() === 'daydispatch.com/Admin/Admin-View-Profile/*/User')
                                <td>
                                    <h6>Status: <span
                                            class="badge badge-primary">{{ $List->all_listing->Listing_Status }}</span>
                                    </h6>
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
                                            @if ($List->all_listing->user_id === $currentUser->id)
                                                <a class="dropdown-item"
                                                href="{{ route('User.Edit.Listing', $List->all_listing->id) }}"
                                                target="_blank">Re Listed</a>
                                            @endif
                                            <a class="dropdown-item Generate-Ticket" data-toggle="modal"
                                            data-target="#TicketModal" href="javascript:void(0);">
                                                <input hidden type="text" class="Listed-ID"
                                                    value="{{ $List->all_listing->id }}">
                                                <input hidden type="text" class="User-ID"
                                                    value="{{ $List->all_listing->user_id }}">
                                                <input hidden type="text" class="User-Email"
                                                    value="{{ $List->all_listing->authorized_user->email }}">
                                                <input hidden type="text" class="User-Name"
                                                    value="{{ $List->all_listing->authorized_user->Company_Name }}">
                                                <input hidden type="text" class="CMP-ID"
                                                    value="{{ $List->all_listing->cancel->cancel_user->id }}">
                                                <input hidden type="text" class="CMP-Email"
                                                    value="{{ $List->all_listing->cancel->cancel_user->email }}">
                                                <input hidden type="text" class="CMP-Name"
                                                    value="{{ $List->all_listing->cancel->cancel_user->Company_Name }}">
                                                Generate Ticket</a>
                                        </div>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </section>
@endif
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
                <form action="{{ route('User.Request.Broker') }}" method="POST" class="was-validated" id="request_load_clear">
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
                                <button type="submit" class="submit-btn w-100"><i class='bx bx-save'></i>
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
                                Bid fro load
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
    $("#Search_vehicleType").on("change", function () {
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
    $(".close").click(function () {
        $("#request_load_clear").trigger("reset");
        console.log('close')
        
        document.getElementById('modalbody').style.display = 'none' 
        document.getElementById('requested').style.display = 'block'
    });

    $('.all-requests').on('click', function () {
        const getListedID = $(this).find('.Listed-ID').val();
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
                console.log(data);
            }

        });

    });
    
    
    function requestforform(params){
        console.log(params)
        document.getElementById('modalbody').style.display = 'block'
        document.getElementById('requested').style.display = 'none'
        // if(params == 1){
        //     $('.offer-price').hide();
        //     // const get = bid[0].querySelector("#bid");
        //     $('.bidoffer #bid').remove(); 
        // }
        // else{
        //     $('.bidoffer').html(`
        //         <input type="text" class="form-control" placeholder="Enter Your Bid Price" id="bid"
        //         value="" name="Offer_Price" required>
        //     `)
        //     $('.offer-price').show();
        // }
    }


</script>