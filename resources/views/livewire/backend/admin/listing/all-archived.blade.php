<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Dashboard</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('Admin.Dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Listing</li>
                    <li class="breadcrumb-item active"><a href="{{ route('Admin.Archived') }}">All Archived</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">All Archived</h5>
    </div>
    <div class="card-body">
        <table id="scroll-horizontal" class="table nowrap align-middle text-center"
               style="width:100%">
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
                        <strong>Pickup Route</strong><br>
                        <a href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                           target="_blank">
                            {{ Str::replace(',', '-', $List->all_listing->routes->Origin_ZipCode) }}
                        </a><br>
                        <strong>Delivery Route</strong><br>
                        <a href="https://www.google.com/maps/dir/{{ $List->all_listing->routes->Origin_ZipCode }},+USA/{{ $List->all_listing->routes->Dest_ZipCode }},+USA/"
                           target="_blank">
                            {{ Str::replace(',', '-', $List->all_listing->routes->Dest_ZipCode) }}
                        </a>
                    </td>
                    <td>
                        @if(count($List->all_listing->vehicles) === 1)
                            @foreach ($List->all_listing->vehicles as $vehcile)
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
                        @if(count($List->all_listing->vehicles) > 1)
                            <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                               data-trigger="focus" style="cursor: pointer;"
                               title="Attached vehicles" data-content=
                                   "@foreach ($List->all_listing->vehicles as $vehcile)
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
                            @endforeach" data-html="true">vehicles ({{ count($List->all_listing->vehicles) }})
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
                            @endforeach" data-html="true">vehicles ({{ count($List->all_listing->heavy_equipments) }})
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
                        <a tabindex="0" class="" role="button" data-toggle="popover" data-trigger="focus"
                           title="Additional Terms" data-content=
                               "{{ !empty($List->all_listing->additional_info->Additional_Terms) ? $List->all_listing->additional_info->Additional_Terms : '' }}">
                            {{ !empty($List->all_listing->additional_info->Additional_Terms) ? Str::limit($List->all_listing->additional_info->Additional_Terms, 20) : '...' }}</a>
                    </td>
                    <td>
                        <strong>Ref-ID:</strong>{{ $List->all_listing->Ref_ID }} <br>
                        {{ $List->all_listing->routes->Miles }} miles <br>
                        $ {{ DayDispatchHelper::PricePerMiles($List->all_listing->paymentinfo->COD_Amount, $List->all_listing->routes->Miles) }}
                        /miles
                    </td>
                    <td>
                        {{-- <strong>Price to Pay: </strong> $ --}}
                        {{-- {{ $List->all_listing->paymentinfo->Order_Booking_Price }}<br> --}}
                        <strong>COD / COP: </strong> $
                        {{ $List->all_listing->paymentinfo->COD_Amount }}<br>
                        {{ $List->all_listing->paymentinfo->COD_Method_Mode }}
                        @if(!empty($List->request_broker->Offer_Price) && $List->all_listing->request_broker->Offer_Price !== 0)
                            <br>
                            <strong>Ask Price:
                            </strong>${{ $List->all_listing->request_broker->Offer_Price }}
                        @endif
                    </td>
                    <td>
                        <strong>Pickup Date: </strong><br>
                        ({{ $List->all_listing->pickup_delivery_info->Pickup_Date_mode }})
                        {{ \Carbon\Carbon::parse($List->all_listing->pickup_delivery_info->Pickup_Date)->format('d M, Y') }}
                        <br>
                        <strong>Deliver Date: </strong><br>
                        ({{ $List->all_listing->pickup_delivery_info->Delivery_Date_mode }})
                        {{ \Carbon\Carbon::parse($List->all_listing->pickup_delivery_info->Delivery_Date)->format('d M, Y') }}
                    </td>
                    <td>
                        <strong>Expired Date: </strong><br>
                        {{ \Carbon\Carbon::parse($List->all_listing->expire_at)->format('d M, Y') }}
                        <a href="{{ route('User.Order.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                           class="btn btn-sm btn-primary" role="button">View Detail</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
