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

    <main>
        <div class="row">
            <div class="col-md-12">
                
                    @if ($From == "listing")
                        <section>
                            <h2>
                                Company History
                            </h2>
                            <p>
                                To search for a company, enter their full or partial name below. Click the company's name to rate them or veiw their profile
                            </p>
                            <hr />
                        </section>
                        {{-- dd(count($Lisiting)) --}}
                        @if (count($Lisiting['completed']) > 0 || count($Lisiting['requested']) > 0 || count($Lisiting['dispatched']) > 0 || count($Lisiting['waitingForApproval']) > 0 || count($Lisiting['pickupApproval']) > 0 || count($Lisiting['pickupOrders']) > 0 || count($Lisiting['deliverApprovalListing']) > 0 || count($Lisiting['deliverdOrders']) > 0 || count($Lisiting['cancelledOrders']) > 0)
                            @if (count($Lisiting['completed']) > 0)
                                <section>
                                    </br>
                                    <h3>Completed</h3>
                                    <table class="display dataTable advance-6 text-center w-100 no-footer table-1 table-bordered table-cards">
                                        <thead class="table-header">
                                            <tr>
                                                <th>Request</th>
                                                <th>Routes</th>
                                                <th>Load Details</th>
                                                <th>ID</th>
                                                <th>Payments</th>
                                                <th>Dates</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- Completed Listings --}}
                                            @foreach ($Lisiting['completed'] as $row)
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
                                                            <div class="dropdown mt-3">
                                                                <a href="javascript:void(0)" tabindex="0"
                                                                    class="btn btn-outline-primary dropdown-toggle text-truncate"
                                                                    id="additionalTermsDropdown" role="button" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false" style="max-width: 200px;">
                                                                    {{ $row->all_listing->additional_info->Additional_Terms }}Additional
                                                                    Terms
                                                                </a>
                                                                <div class="dropdown-menu p-3 shadow-sm"
                                                                    aria-labelledby="additionalTermsDropdown" style="max-width: 300px;">
                                                                    <p class="dropdown-item-text m-0 text-wrap">
                                                                        {{ !empty($row->all_listing->additional_info->Additional_Terms)
                                                                            ? $row->all_listing->additional_info->Additional_Terms
                                                                            : 'No additional terms available.' }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            {{-- <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                                            data-trigger="focus" style="cursor: pointer;"
                                                            title="Additional Terms" data-content=
                                                                "{{ !empty($row->all_listing->additional_info->Additional_Terms) ? $row->all_listing->additional_info->Additional_Terms : '' }}">
                                                                {{ !empty($row->all_listing->additional_info->Additional_Terms) ? Str::limit($row->all_listing->additional_info->Additional_Terms, 20) : '...' }}</a> --}}
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
                                                        </td>
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
                                                                    class="dropdown-item" target="_blank" role="button">View Detail</a>
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
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </section>
                            @endif
                            @if (count($Lisiting['requested']) > 0)
                                <section>
                                    </br>
                                    <h3>Requested</h3>
                                    <table class="display dataTable advance-6 text-center w-100 no-footer table-1 table-bordered table-cards">
                                        <thead class="table-header">
                                            <tr>
                                                <th>Routes</th>
                                                <th>Load Details</th>
                                                <th>ID</th>
                                                <th>Request</th>
                                                <th>Payments</th>
                                                <th>Assign Dates</th>
                                                <th>Listing Dates</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- Requested Listings --}}
                                            {{-- dd('oks', $Lisiting['requested']->toArray()) --}}
                                            @foreach ($Lisiting['requested'] as $List)
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
                                                            <div class="dropdown mt-3">
                                                                <a href="javascript:void(0)" tabindex="0"
                                                                    class="btn btn-outline-primary dropdown-toggle text-truncate"
                                                                    id="additionalTermsDropdown" role="button" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false" style="max-width: 200px;">
                                                                    {{ $List->additional_info->Additional_Terms }}Additional
                                                                    Terms
                                                                </a>
                                                                <div class="dropdown-menu p-3 shadow-sm"
                                                                    aria-labelledby="additionalTermsDropdown" style="max-width: 300px;">
                                                                    <p class="dropdown-item-text m-0 text-wrap">
                                                                        {{ !empty($List->additional_info->Additional_Terms)
                                                                            ? $List->additional_info->Additional_Terms
                                                                            : 'No additional terms available.' }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            {{-- <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                                            data-trigger="focus" style="cursor: pointer;"
                                                            title="Additional Terms" data-content=
                                                                "{{ !empty($List->additional_info->Additional_Terms) ? $List->additional_info->Additional_Terms : '' }}">
                                                                {{ !empty($List->additional_info->Additional_Terms) ? Str::limit($List->additional_info->Additional_Terms, 20) : '...' }}</a> --}}
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
                                                        </td>
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
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </section>
                            @endif
                            @if (count($Lisiting['dispatched']) > 0)
                                <section>
                                    </br>
                                    <h3>Dispatched</h3>
                                    <table class="display dataTable advance-6 text-center w-100 no-footer table-1 table-bordered table-cards">
                                        <thead class="table-header">
                                            <tr>
                                                <th>Request</th>
                                                <th>Routes</th>
                                                <th>Load Details</th>
                                                <th>ID</th>
                                                <th>Payments</th>
                                                <th>Dates</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- Dispatched Listings --}}
                                            @foreach ($Lisiting['dispatched'] as $List)
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
                                                            @endif <br>
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
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </section>
                            @endif
                            @if (count($Lisiting['waitingForApproval']) > 0)
                                <section>
                                    </br>
                                    <h3>WaitingForApproval</h3>
                                    <table class="display dataTable advance-6 text-center w-100 no-footer table-1 table-bordered table-cards">
                                        <thead class="table-header">
                                            <tr>
                                                <th>Request</th>
                                                <th>Routes</th>
                                                <th>Load Details</th>
                                                <th>ID</th>
                                                <th>Payments</th>
                                                <th>Dates</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- WaitingForApproval Listings --}}
                                            @foreach ($Lisiting['waitingForApproval'] as $List)
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
                                                            {{ $List->all_listing->updated_at }}
                                                        </td>
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
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </section>
                            @endif
                            @if (count($Lisiting['pickupApproval']) > 0)
                                <section>
                                    </br>
                                    <h3>PickupApproval</h3>
                                    <table class="display dataTable advance-6 text-center w-100 no-footer table-1 table-bordered table-cards">
                                        <thead class="table-header">
                                            <tr>
                                                <th>Routes</th>
                                                <th>Load Details</th>
                                                <th>ID</th>
                                                <th>Company Details</th>
                                                <th>Payments</th>
                                                <th>Assign Dates</th>
                                                <th>Listing Dates</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- PickupApproval Listings --}}
                                            @foreach ($Lisiting['pickupApproval'] as $List)
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
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </section>
                            @endif
                            @if (count($Lisiting['pickupOrders']) > 0)
                                <section>
                                    </br>
                                    <h3>PickupOrders</h3>
                                    <table class="display dataTable advance-6 text-center w-100 no-footer table-1 table-bordered table-cards">
                                        <thead class="table-header">
                                            <tr>
                                                <th>Request</th>
                                                <th>Routes</th>
                                                <th>Load Details</th>
                                                <th>ID</th>
                                                <th>Payments</th>
                                                <th>Dates</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- PickupOrders Listings --}}
                                            @foreach ($Lisiting['pickupOrders'] as $List)
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
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </section>
                            @endif
                            @if (count($Lisiting['deliverApprovalListing']) > 0)
                                <section>
                                    </br>
                                    <h3>Deliver Approval Listing</h3>
                                    <table class="display dataTable advance-6 text-center w-100 no-footer table-1 table-bordered table-cards">
                                        <thead class="table-header">
                                            <tr>
                                                <th>Request</th>
                                                <th>Routes</th>
                                                <th>Load Details</th>
                                                <th>ID</th>
                                                <th>Payments</th>
                                                <th>Dates</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- Deliver Approval Listings --}}
                                            @foreach ($Lisiting['deliverApprovalListing'] as $List)
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
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </section>
                            @endif
                            @if (count($Lisiting['deliverdOrders']) > 0)
                                <section>
                                    </br>
                                    <h3>Deliverd Orders</h3>
                                    <table class="display dataTable advance-6 text-center w-100 no-footer table-1 table-bordered table-cards">
                                        <thead class="table-header">
                                            <tr>
                                                <th>Request</th>
                                                <th>Routes</th>
                                                <th>Load Details</th>
                                                <th>ID</th>
                                                <th>Payments</th>
                                                <th>Dates</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- Deliverd Orders --}}
                                            @foreach ($Lisiting['deliverdOrders'] as $List)
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
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </section>
                            @endif
                            @if (count($Lisiting['cancelledOrders']) > 0)
                                <section>
                                    </br>
                                    <h3>Cancelled Orders</h3>
                                    <table class="display dataTable advance-6 text-center w-100 no-footer table-1 table-bordered table-cards">
                                        <thead class="table-header">
                                            <tr class="card-row" data-status="active">
                                                <th>Request</th>
                                                <th>Routes</th>
                                                <th>Load Details</th>
                                                <th>ID</th>
                                                <th>Payments</th>
                                                <th>Dates</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- Cancelled Orders --}}
                                            @foreach ($Lisiting['cancelledOrders'] as $List)
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
                                                        </td>
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
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </section>
                            @endif
                        @else
                            <h3>No Records Found...</h3>
                        @endif
                    @else
                        {{-- <section>
                            <h2>
                                Company Search
                            </h2>
                            <p>
                                To search for a company, enter their full or partial name below. Click the company's name to rate them or veiw their profile
                            </p>
                            <hr/>
                        </section>
                        <section>
                            <table class="display dataTable advance-6 text-center w-100 no-footer table-1 table-bordered table-cards">
                                <thead class="table-header">
                                    <tr>
                                        <th>Company</th>
                                        <th>Type</th>
                                        <th>Address</th>
                                        <th>Phone Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Lisiting as $List)
                                        <tr class="card-row" data-status="active">
                                            <td><a href="{{ route('View.Profile', $List->id) }}">{{ $List->Company_Name }}</a></td>
                                            <td>{{ $List->usr_type }}</td>
                                            <td>{{ $List->Address }}</td>
                                            <td>{{ $List->Contact_Phone }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </section> --}}

                        {{-- <section>
                            <h2>
                                <i class="bx bx-search"></i> Company Search
                            </h2>
                            <p>
                                To search for a company, enter their full or partial name below. Click the company's name to rate them or view their profile.
                            </p>
                            <hr />
                        </section>
                        <section>
                            <table class="display dataTable advance-6 text-center w-100 no-footer table-1 table-bordered table-cards">
                                <thead class="table-header">
                                    <tr>
                                        <th><i class="bx bx-buildings"></i> Company</th>
                                        <th><i class="bx bx-user-circle"></i> Type</th>
                                        <th><i class="bx bx-map"></i> Address</th>
                                        <th class="text-nowrap"><i class="bx bx-phone"></i>Contact Info</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Lisiting as $List)
                                        <tr class="card-row" data-status="active">
                                            <td>
                                                <a href="{{ route('View.Profile', $List->id) }}">
                                                    <i class="bx bx-link-alt"></i> {{ $List->Company_Name }}
                                                </a>
                                            </td>
                                            <td>
                                                <i class="bx bx-user"></i> {{ $List->usr_type }}
                                            </td>
                                            <td>
                                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($List->Address) }}" target="_blank">
                                                    <i class="bx bx-map-pin"></i> {{ $List->Address }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="tel:{{ $List->Contact_Phone }}">
                                                    <i class="bx bx-phone-call"></i> {{ $List->Contact_Phone }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </section> --}}

                        <style>
                            .visiting-card {
                                border: 1px solid #ddd;
                                border-radius: 8px;
                                padding: 20px;
                                background: #f8f9fa;
                                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                                transition: transform 0.2s ease-in-out;
                            }
                        
                            .visiting-card:hover {
                                transform: translateY(-5px);
                                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
                            }
                        
                            .visiting-card h5 {
                                margin-bottom: 8px;
                                font-size: 1.25rem;
                                color: #333;
                            }
                        
                            .visiting-card a {
                                text-decoration: none;
                                color: #007bff;
                            }
                        
                            .visiting-card a:hover {
                                text-decoration: underline;
                            }
                        
                            .visiting-card .icon {
                                margin-right: 10px;
                                color: #007bff;
                            }
                        
                            .visiting-card .contact-info {
                                font-size: 0.9rem;
                            }
                        </style>
                        <section class="my-4">
                            <h2 class="text-center">
                                <i class="bx bx-business"></i> Company Directory
                            </h2>
                            <p class="text-center">
                                Browse through the list of companies. Click on the company name to view their full profile.
                            </p>
                            <hr />
                        </section>
                        <section class="container">
                            <div class="row g-4">
                                @foreach ($Lisiting as $List)
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="visiting-card">
                                            <h5>
                                                <a href="{{ route('View.Profile', $List->id) }}">
                                                    <i class="bx bx-buildings icon"></i>{{ $List->Company_Name }}
                                                </a>
                                            </h5>
                                            <p class="contact-info">
                                                <i class="bx bx-user icon"></i><strong>Type:</strong> {{ $List->usr_type }}
                                            </p>
                                            <p class="contact-info">
                                                <i class="bx bx-map-pin icon"></i>
                                                <strong>Address:</strong>
                                                <a class="text-wrap" href="https://www.google.com/maps/search/?api=1&query={{ urlencode($List->Address) }}" target="_blank">
                                                    {{ $List->Address }}
                                                </a>
                                            </p>
                                            <p class="contact-info">
                                                <i class="bx bx-phone-call icon"></i>
                                                <strong>Phone:</strong>
                                                <a href="tel:{{ $List->Contact_Phone }}">
                                                    {{ $List->Contact_Phone }}
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                        
                    @endif
            </div>
        </div>
    </main>
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