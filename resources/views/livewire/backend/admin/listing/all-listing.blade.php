<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Dashboard</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('Admin.Dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Listing</li>
                    <li class="breadcrumb-item active"><a href="{{ route('Admin.Listing') }}">All Listing</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">All Users Listing</h5>
    </div>
    <div class="card-body">
        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
               style="width:100%">
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
                <tr>
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
                        $ {{ DayDispatchHelper::PricePerMiles($List->paymentinfo->COD_Amount ?? 0, $List->routes->Miles) }}
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
                        {{ $List->paymentinfo->Price_Pay_Carrier ?? 0}}<br>
                        <strong>COD / COP: </strong> $
                        {{ $List->paymentinfo->COD_Amount ?? 0}}<br>
                        {{ $List->paymentinfo->COD_Method_Mode ?? 0}}
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

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
