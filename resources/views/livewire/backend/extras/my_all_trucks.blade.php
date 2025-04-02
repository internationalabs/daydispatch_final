<!-- Breadcrumb Area -->
<div class="breadcrumb-area">
    <h1>Truck Space</h1>
    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>

        <li class="item">My All Trucks</li>
    </ol>
</div>
<!-- End Breadcrumb Area -->

<ul class="nav- justify-content-center" role="tablist">
    <li class="nav-item-" role="presentation">
      <a class="nav-link- active" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Vehicle Load</a>
    </li>
    <li class="nav-item-" role="presentation">
      <a class="nav-link-" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Heavy Vehicle</a>
    </li>
    <li class="nav-item-" role="presentation">
      <a class="nav-link-" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">Freight Load</a>
    </li>
  </ul>

<div class="tab-content">
  <div class="tab-pane active" id="tab1" role="tabpanel" aria-labelledby="tab1">
<div class="card mb-30 collapse-card-box">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Post Vehicle Listing</h3>
    </div>
    <div class="card-body">
        <div class="faq-accordion p-0">
            <ul class="accordion">
                @php
                    $i = 1;
                @endphp
                @forelse($Listing as $List)
                    @php
                        $truck_count = 0;
                    @endphp
                    @foreach($Truck_Space as $truck_space)
                        @if(DayDispatchHelper::getZipCodeStateCity($truck_space->Truck_Location, 1) === DayDispatchHelper::getZipCodeStateCity($List->routes->Origin_ZipCode, 1))
                            @php
                                $truck_count++;
                            @endphp
                        @endif
                    @endforeach
                    <li class="accordion-item">
                        @if($List->Listing_Type == 1)
                        {{-- {{dd('ok')}} --}}
                        
                        <a class="accordion-title {{ ($i === 1)? 'active' : '' }}" href="javascript:void(0)">
                            <i class="bx bx-plus"></i>
                            <div class="row">
                                <div class="col-6 justify-content-start">
                                    <span>{{ DayDispatchHelper::getZipCodeStateCity($List->routes->Origin_ZipCode, 1) }} - {{ DayDispatchHelper::VehicleCount($List->vehicles, $List->heavy_equipments, $List->dry_vans) }} Vehicle</span>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <span>({{ $truck_count }}) — Trucks Available</span>
                                </div>
                            </div>
                        </a>
                        @endif
                        <div class="accordion-content {{ ($i === 1)? 'show' : '' }}"
                             style="{{ ($i === 1)? 'display: block;' : '' }}">
                            <table class="table table-hover text-center">
                                <thead>
                                <tr>
                                    <th scope="col">Pickup</th>
                                    <th scope="col">Delivery</th>
                                    <th scope="col">Vehicle</th>
                                    <th scope="col">Ship On</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $List->routes->Origin_ZipCode }}</td>
                                    <td>{{ $List->routes->Dest_ZipCode }}</td>
                                    <td>
                                        @if(count($List->vehicles) > 0)
                                            @foreach ($List->vehicles as $vehcile)
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
                                        {{-- @if(count($List->heavy_equipments) > 0) --}}
                                        {{-- {{dd($List->Listing_Type)}} --}}
                                        {{-- @if($List->Listing_Type == 2)
                                            @foreach ($List->heavy_equipments as $vehcile)
                                                {{ $vehcile->Equipment_Year }}
                                                {{ $vehcile->Equipment_Make }}
                                                {{ $vehcile->Equipment_Model }}
                                                @if (!empty($vehcile->Equipment_Condition))
                                                    <br>
                                                    {{ $vehcile->Equipment_Condition }}
                                                @endif
                                                @if (!empty($vehcile->Trailer_Type))
                                                    <br>
                                                    {{ $vehcile->Trailer_Type }}
                                                @endif
                                            @endforeach
                                        @endif --}}
                                       {{--  @if(count($List->dry_vans) > 0)
                                            @foreach ($List->dry_vans as $vehcile)
                                                {{ $vehcile->Freight_Class }}
                                                {{ $vehcile->Freight_Weight }}
                                                @if ($vehcile->is_hazmat_Check !== 0)
                                                    <br>
                                                    Hazmat Required
                                                @endif
                                            @endforeach
                                        @endif --}}
                                    </td>
                                    <td>{{ $List->created_at }}</td>
                                </tr> 
                                </tbody>
                            </table>

                            <h4 class="font-weight-bold text-center">Matching Trucks </h4>
                            <table class="table table-hover text-center">
                                <thead>
                                <tr>
                                    <th scope="col">Location</th>
                                    <th scope="col">Heading</th>
                                    <th scope="col">Destination</th>
                                    <th scope="col">Departs</th>
                                    <th scope="col">Spaces</th>
                                    <th scope="col">Trailer Type</th>
                                    <th scope="col">Condition</th>
                                    <th scope="col">Contact</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($Truck_Space as $truck_space)
                                    @if(DayDispatchHelper::getZipCodeStateCity($truck_space->Truck_Location, 1) !== DayDispatchHelper::getZipCodeStateCity($List->routes->Origin_ZipCode, 1))
                                        @continue
                                    @endif
                                    <tr>
                                        <td>{{ $truck_space->Truck_Location }}</td>
                                        <td>{{ $truck_space->Truck_Heading }}</td>
                                        <td>{{ $truck_space->Truck_Destination }}</td>
                                        <td>{{ $truck_space->Truck_Departs }}</td>
                                        <td>{{ $truck_space->Truck_Space }}</td>
                                        <td>{{ $truck_space->Truck_Trailer_Type }}</td>
                                        <td>{{ $truck_space->Truck_Condition }}</td>
                                        <td>
                                            {{ $truck_space->authorized_user->Company_Name }}<br>
                                            {{ $truck_space->authorized_user->Contact_Phone }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td><h6 class="font-weight-bold">No Trucks Match This Vehicle Shipment!</h6>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </li>
                    @php
                        $i++;
                    @endphp
                @empty
                @endforelse
            </ul>
        </div>
    </div>
</div>
</div>

    {{-- Start For Heavy --}}
    <div class="tab-pane" id="tab2" role="tabpanel" aria-labelledby="tab2">
<div class="card mb-30 collapse-card-box">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Heavy Truck Space</h3>
    </div>

    <div class="card-body">
        <div class="faq-accordion p-0">
            <ul class="accordion">
                @php
                    $i = 1;
                @endphp
                @forelse($Listing as $List)
                    @php
                        $truck_count = 0;
                    @endphp
                    @foreach($Heavy_Truck_Space as $truck_space)
                        @if(DayDispatchHelper::getZipCodeStateCity($truck_space->Heavy_Truck_Location, 1) === DayDispatchHelper::getZipCodeStateCity($List->routes->Origin_ZipCode, 1))
                            @php
                                $truck_count++;
                            @endphp
                        @endif
                    @endforeach
                    <li class="accordion-item">
                        @if($List->Listing_Type == 2)
                        <a class="accordion-title {{ ($i === 1)? 'active' : '' }}" href="javascript:void(0)">
                            <i class="bx bx-plus"></i>
                            <div class="row">
                                <div class="col-6 justify-content-start">
                                    <span>{{ DayDispatchHelper::getZipCodeStateCity($List->routes->Origin_ZipCode, 1) }} - {{ DayDispatchHelper::VehicleCount($List->vehicles, $List->heavy_equipments, $List->dry_vans) }} Vehicle</span>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <span>({{ $truck_count }}) — Trucks Available</span>
                                </div>
                            </div>
                        </a>
                        @endif
                        <div class="accordion-content {{ ($i === 1)? 'show' : '' }}"
                             style="{{ ($i === 1)? 'display: block;' : '' }}">
                            <table class="table table-hover text-center">
                                <thead>
                                <tr>
                                    <th scope="col">Pickup</th>
                                    <th scope="col">Delivery</th>
                                    <th scope="col">Vehicle</th>
                                    <th scope="col">Ship On</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $List->routes->Origin_ZipCode }}</td>
                                    <td>{{ $List->routes->Dest_ZipCode }}</td>
                                    <td>
                                        @if($List->Listing_Type == 2)
                                            @foreach ($List->heavy_equipments as $vehcile)
                                                {{ $vehcile->Equipment_Year }}
                                                {{ $vehcile->Equipment_Make }}
                                                {{ $vehcile->Equipment_Model }}
                                                @if (!empty($vehcile->Equipment_Condition))
                                                    <br>
                                                    {{ $vehcile->Equipment_Condition }}
                                                @endif
                                                @if (!empty($vehcile->Trailer_Type))
                                                    <br>
                                                    {{ $vehcile->Trailer_Type }}
                                                @endif
                                            @endforeach
                                        @endif
                                       {{--  @if(count($List->dry_vans) > 0)
                                            @foreach ($List->dry_vans as $vehcile)
                                                {{ $vehcile->Freight_Class }}
                                                {{ $vehcile->Freight_Weight }}
                                                @if ($vehcile->is_hazmat_Check !== 0)
                                                    <br>
                                                    Hazmat Required
                                                @endif
                                            @endforeach
                                        @endif --}}
                                    </td>
                                    <td>{{ $List->created_at }}</td>
                                </tr> 
                                </tbody>
                            </table>

                            <h4 class="font-weight-bold text-center">Matching Trucks </h4>
                            <table class="table table-hover text-center">
                                <thead>
                                <tr>
                                    <th scope="col">Location</th>
                                    <th scope="col">Heading</th>
                                    <th scope="col">Destination</th>
                                    <th scope="col">Departs</th>
                                    <th scope="col">Spaces</th>
                                    <th scope="col">Trailer Type</th>
                                    <th scope="col">Trailer Specification</th>
                                    <th scope="col">Shipment Preferences</th>
                                    <th scope="col">Condition</th>
                                    <th scope="col">Contact</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($Heavy_Truck_Space as $truck_space)
                                    @if(DayDispatchHelper::getZipCodeStateCity($truck_space->Heavy_Truck_Location, 1) !== DayDispatchHelper::getZipCodeStateCity($List->routes->Origin_ZipCode, 1))
                                        @continue
                                    @endif
                                    <tr>
                                        <td>{{ $truck_space->Heavy_Truck_Location }}</td>
                                        <td>{{ $truck_space->Heavy_Truck_Heading }}</td>
                                        <td>{{ $truck_space->Heavy_Truck_Destination }}</td>
                                        <td>{{ $truck_space->Heavy_Truck_Departs }}</td>
                                        <td>{{ $truck_space->Heavy_Truck_Space }}</td>
                                        <td>{{ $truck_space->trailer_type }}</td>
                                        <td>{{ $truck_space->trailer_specification }}</td>
                                        <td>{{ $truck_space->shipment_preferences }}</td>
                                        <td>{{ $truck_space->Equipment_condition }}</td>
                                        <td>
                                            {{ $truck_space->authorized_user->Company_Name }}<br>
                                            {{ $truck_space->authorized_user->Contact_Phone }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td><h6 class="font-weight-bold">No Trucks Match This Vehicle Shipment!</h6>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </li>
                    @php
                        $i++;
                    @endphp
                @empty
                @endforelse
            </ul>
        </div>
    </div>

</div>
</div>
    {{-- End For Heavy --}}

    {{-- Start Freight Load --}}
    <div class="tab-pane" id="tab3" role="tabpanel" aria-labelledby="tab3">
<div class="card mb-30 collapse-card-box">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Freight Truck Space</h3>
    </div>

    <div class="card-body">
        <div class="faq-accordion p-0">
            <ul class="accordion">
                @php
                    $i = 1;
                @endphp
                @forelse($Listing as $List)
                    @php
                        $truck_count = 0;
                    @endphp
                    @foreach($Truck_Space as $truck_space)
                        @if(DayDispatchHelper::getZipCodeStateCity($truck_space->Truck_Location, 1) === DayDispatchHelper::getZipCodeStateCity($List->routes->Origin_ZipCode, 1))
                            @php
                                $truck_count++;
                            @endphp
                        @endif
                    @endforeach
                    <li class="accordion-item">
                        @if($List->Listing_Type == 3)
                        <a class="accordion-title {{ ($i === 1)? 'active' : '' }}" href="javascript:void(0)">
                            <i class="bx bx-plus"></i>
                            <div class="row">
                                <div class="col-6 justify-content-start">
                                    <span>{{ DayDispatchHelper::getZipCodeStateCity($List->routes->Origin_ZipCode, 1) }} - {{ DayDispatchHelper::VehicleCount($List->vehicles, $List->heavy_equipments, $List->dry_vans) }} Vehicle</span>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <span>({{ $truck_count }}) — Trucks Available</span>
                                </div>
                            </div>
                        </a>
                        @endif
                        <div class="accordion-content {{ ($i === 1)? 'show' : '' }}"
                             style="{{ ($i === 1)? 'display: block;' : '' }}">
                            <table class="table table-hover text-center">
                                <thead>
                                <tr>
                                    <th scope="col">Pickup</th>
                                    <th scope="col">Delivery</th>
                                    <th scope="col">Vehicle</th>
                                    <th scope="col">Ship On</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $List->routes->Origin_ZipCode }}</td>
                                    <td>{{ $List->routes->Dest_ZipCode }}</td>
                                    <td>
                                        
                                        @if($List->Listing_Type == 3)
                                            @foreach ($List->dry_vans as $vehcile)
                                                {{ $vehcile->Freight_Class }}
                                                {{ $vehcile->Freight_Weight }}
                                                @if ($vehcile->is_hazmat_Check !== 0)
                                                    <br>
                                                    Hazmat Required
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{ $List->created_at }}</td>
                                </tr> 
                                </tbody>
                            </table>

                            <h4 class="font-weight-bold text-center">Matching Trucks </h4>
                            <table class="table table-hover text-center">
                                <thead>
                                <tr>
                                    <th scope="col">Location</th>
                                    <th scope="col">Heading</th>
                                    <th scope="col">Destination</th>
                                    <th scope="col">Departs</th>
                                    <th scope="col">Spaces</th>
                                    <th scope="col">Trailer Type</th>
                                    <th scope="col">Trailer Specification</th>
                                    <th scope="col">Shipment Preferences</th>
                                    <th scope="col">Condition</th>
                                    <th scope="col">Contact</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($Truck_Space_Dry as $truck_space)
                                    @if(DayDispatchHelper::getZipCodeStateCity($truck_space->Truck_Location_Dry, 1) !== DayDispatchHelper::getZipCodeStateCity($List->routes->Origin_ZipCode, 1))
                                        @continue
                                    @endif
                                    <tr>
                                        <td>{{ $truck_space->Truck_Location_Dry }}</td>
                                        <td>{{ $truck_space->Truck_Heading_Dry }}</td>
                                        <td>{{ $truck_space->Truck_Destination_Dry }}</td>
                                        <td>{{ $truck_space->Truck_Departs_Dry }}</td>
                                        <td>{{ $truck_space->Heavy_Truck_Space }}</td>
                                        <td>{{ $truck_space->Trailer_Type_Dry }}</td>
                                        <td>{{ $truck_space->Trailer_Specification_Dry }}</td>
                                        <td>{{ $truck_space->Shipment_Preferences_Dry }}</td>
                                        <td>{{ $truck_space->Equipment_Condition_Dry }}</td>
                                        <td>
                                            {{ $truck_space->authorized_user->Company_Name }}<br>
                                            {{ $truck_space->authorized_user->Contact_Phone }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td><h6 class="font-weight-bold">No Trucks Match This Vehicle Shipment!</h6>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </li>
                    @php
                        $i++;
                    @endphp
                @empty
                @endforelse
            </ul>
        </div>
    </div>

</div>
</div>
    {{-- End Freight Load --}}
</div>

    





