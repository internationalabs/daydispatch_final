<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Dashboard</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('Admin.Dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Listing</li>
                    <li class="breadcrumb-item active"><a href="{{ route('Admin.WaitingListing') }}">Waiting's For
                            Approval</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">All Waiting's For Approval</h5>
    </div>
    <div class="card-body">
        <table id="scroll-horizontal" class="table nowrap align-middle text-center" style="width:100%">
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
                            @if (count($List->all_listing->vehicles) === 1)
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
                            @if (count($List->all_listing->vehicles) > 1)
                                <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                    data-trigger="focus" style="cursor: pointer;" title="Attached vehicles"
                                    data-content=
                                   "@foreach ($List->all_listing->vehicles as $vehcile)
                                {{ $vehcile->Vehcile_Year }}
                                {{ $vehcile->Vehcile_Make }}
                                {{ $vehcile->Vehcile_Model }}<br>
                                @if (!empty($vehcile->Vehcile_Condition))
                                    {{ $vehcile->Vehcile_Condition }}<br>
                                @endif
                                @if (!empty($vehcile->Trailer_Type))
                                    {{ $vehcile->Trailer_Type }} <br>
                                @endif @endforeach"
                                    data-html="true">vehicles ({{ count($List->all_listing->vehicles) }})
                                </a>
                            @endif
                            @if (count($List->all_listing->heavy_equipments) === 1)
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
                            @if (count($List->all_listing->heavy_equipments) > 1)
                                <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                    data-trigger="focus" style="cursor: pointer;" title="Attached vehicles"
                                    data-content=
                                   "@foreach ($List->all_listing->heavy_equipments as $vehcile)
                                {{ $vehcile->Equipment_Year }}
                                {{ $vehcile->Equipment_Make }}
                                {{ $vehcile->Equipment_Model }}<br>
                                @if (!empty($vehcile->Equipment_Condition))
                                    {{ $vehcile->Equipment_Condition }}<br>
                                @endif
                                @if (!empty($vehcile->Trailer_Type))
                                    {{ $vehcile->Trailer_Type }} <br>
                                @endif @endforeach"
                                    data-html="true">vehicles
                                    ({{ count($List->all_listing->heavy_equipments) }}
                                    )
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
                                    data-html="true">vehicles
                                    ({{ count($List->all_listing->dry_vans) }})
                                </a>
                                <br>
                            @endif
                            <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                data-trigger="focus" style="cursor: pointer;" title="Additional Terms"
                                data-content=
                               "{{ !empty($List->all_listing->additional_info->Additional_Terms) ? $List->all_listing->additional_info->Additional_Terms : '' }}">
                                {{ !empty($List->all_listing->additional_info->Additional_Terms) ? Str::limit($List->all_listing->additional_info->Additional_Terms, 20) : '...' }}</a>
                        </td>
                        <td>
                            <strong>Ref-ID:</strong>{{ $List->all_listing->Ref_ID }} <br>
                            {{ $List->all_listing->routes->Miles }} miles<br>
                            $
                            {{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}
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
                            </strong>${{ $List->all_listing->paymentinfo->Order_Booking_Price }}
                            <br>
                            <strong>COD/COP:
                            </strong>${{ $List->all_listing->paymentinfo->COD_Amount }}
                            <br>
                            {{ !empty($List->all_listing->paymentinfo->COD_Method_Mode) ? $List->all_listing->paymentinfo->COD_Method_Mode : '' }}
                            On
                            {{ !empty($List->all_listing->paymentinfo->COD_Location_Amount) ? $List->all_listing->paymentinfo->COD_Location_Amount : '' }}
                        </td>
                        <td>
                            <strong>Pickup:</strong><br>{{ $List->all_listing->pickup_delivery_info->Pickup_Date }}
                            ({{ $List->all_listing->pickup_delivery_info->Pickup_Date_mode }})
                            <br>
                            <strong>Delivery:</strong><br>{{ $List->all_listing->pickup_delivery_info->Delivery_Date }}
                            ({{ $List->all_listing->pickup_delivery_info->Delivery_Date_mode }})
                        </td>
                        <td>
                            <strong>Created At:</strong><br>
                            {{ $List->all_listing->created_at }}<br>
                            <strong>Modified At:</strong><br>
                            {{ $List->all_listing->updated_at }}
                        </td>
                        <td>
                            <h6>Status: <span class="badge bg-warning">Waiting</span>
                            </h6>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
