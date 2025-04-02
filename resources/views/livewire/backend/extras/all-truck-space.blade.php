<!-- Breadcrumb Area -->
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

<div class="breadcrumb-area">
    <h1>Truck Space</h1>

    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>

        <li class="item">Search Truck Space</li>
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
      {{-- Start Post Vehicle --}}
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
                        {{-- dd($Listing->toArray(), $truck_count) --}}
                    @if($List->Listing_Type == 1 && $truck_count != 0)
                        <a class="accordion-title {{ ($i === 1)? 'active' : '' }}" href="javascript:void(0)">
                            <i class="bx bx-plus"></i>
                            <div class="row">
                                <div class="col-6 justify-content-start">
                                    <span>{{ DayDispatchHelper::getZipCodeStateCity($List->routes->Origin_ZipCode, 1) }} - {{ DayDispatchHelper::VehicleCount($List->vehicles, $List->heavy_equipments, $List->dry_vans) }} Vehicle</span>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <span>({{ $truck_count }}) — Trucks Matching</span>
                                </div>
                            </div>
                        </a>
                    @endif    
                        <div class="accordion-content {{ ($i === 1)? 'show' : '' }}"
                             style="{{ ($i === 1)? 'display: block;' : '' }}">
                            <table class="table table-hover text-center">
                                <thead>
                                <tr>
                                    <th scope="col">S.Location</th>
                                    <th scope="col">Heading 2</th>
                                    <th scope="col">F.Destination</th>
                                    <th scope="col">Departs</th>
                                    <th scope="col">Spaces</th>
                                    <th scope="col">Trailer Type</th>
                                    <th scope="col">Condition</th>
                                    <th scope="col">Contact</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($Truck_Space as $truck_space)
                                    @if(DayDispatchHelper::getZipCodeStateCity($truck_space->Truck_Location, 1) == DayDispatchHelper::getZipCodeStateCity($List->routes->Origin_ZipCode, 1))
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
                                    @endif
                                @empty
                                    <tr class="text-center">
                                        <td><h6 class="font-weight-bold">No Trucks Match This Vehicle Shipment!</h6>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            
                             <ul class="accordion">
                            <li class="accordion-item">
                           <a class="accordion-title-child" href="javascript:void(0)">
                            <i class="bx bx-plus"></i>
                              <div class="row">
                                <div class="col-6 justify-content-start">
                                    <span>Matching Trucks </span>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    
                                </div>
                            </div>
                            </a>
                            <div class="accordion-content-child" >
                            <table class="table table-hover text-center">
                                <thead>
                                <tr>
                                    <th scope="col">Routes</th>
                                    <th scope="col">Vehicles Info</th>
                                    <th scope="col">Ref. / Dist.</th>
                                    <th scope="col">Company Info</th>
                                    <th scope="col">Customer / Payments</th>
                                    <th scope="col">Dates</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($Truck_Space as $key => $truck_space)
                                    @if(DayDispatchHelper::getZipCodeStateCity($truck_space->Truck_Location, 1) == DayDispatchHelper::getZipCodeStateCity($List->routes->Origin_ZipCode, 1))
                                        @if($List->Listing_Type == 1)
                                            @foreach ($All_Listing as $key => $List_all)
                                                @if(DayDispatchHelper::getZipCodeStateCity($List_all->routes->Origin_ZipCode) === DayDispatchHelper::getZipCodeStateCity($truck_space->Truck_Location))
                                                    <tr>
                                                        <td>
                                                            <strong>Pickup Route</strong><br>
                                                            <a href="https://www.google.com/maps/dir/{{ $List_all->routes->Origin_ZipCode }},+USA/{{ $List_all->routes->Dest_ZipCode }},+USA/"
                                                            target="_blank">
                                                                {{ Str::replace(',', '-', $List_all->routes->Origin_ZipCode) }}
                                                            </a><br>
                                                            <strong>Delivery Route</strong><br>
                                                            <a href="https://www.google.com/maps/dir/{{ $List_all->routes->Origin_ZipCode }},+USA/{{ $List_all->routes->Dest_ZipCode }},+USA/"
                                                            target="_blank">
                                                                {{ Str::replace(',', '-', $List_all->routes->Dest_ZipCode) }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            @if(count($List_all->vehicles) === 1)
                                                                @foreach ($List_all->vehicles as $vehicle)
                                                                    <a href="https://www.google.com/search?q={{ $vehicle->Vehcile_Year }}%20{{ $vehicle->Vehcile_Make }}%20{{ $vehicle->Vehcile_Model }}"
                                                                    target="_blank"> {{ $vehicle->Vehcile_Year }}
                                                                        {{ $vehicle->Vehcile_Make }}
                                                                        {{ $vehicle->Vehcile_Model }}</a><br>
                                                                    @if (!empty($vehicle->Vehcile_Condition))
                                                                        <span class="text-danger font-weight-bold">{{ $vehicle->Vehcile_Condition }}<br></span>
                                                                    @endif
                                                                    @if (!empty($vehicle->Trailer_Type))
                                                                        <span @if($vehicle->Trailer_Type == '"(Enclosed Trailer Required)"') class="text-primary font-weight-bold" @endif>{{ $vehicle->Trailer_Type }}</span> <br>
                                                                    @endif
                                                                @endforeach
                                                            @elseif(count($List_all->vehicles) > 1)
                                                                <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                                                data-trigger="focus" style="cursor: pointer;"
                                                                title="Attached vehicles" data-content=
                                                                    "@foreach ($List_all->vehicles as $vehicle)
                                                                    <a href='https://www.google.com/search?q={{ $vehicle->Vehcile_Year }}%20{{ $vehicle->Vehcile_Make }}%20{{ $vehicle->Vehcile_Model }}'
                                                                    target='_blank'> {{ $vehicle->Vehcile_Year }}
                                                                    {{ $vehicle->Vehcile_Make }}
                                                                    {{ $vehicle->Vehcile_Model }}</a><br>
                                                                    @if (!empty($vehicle->Vehcile_Condition))
                                                                        <span class="text-danger font-weight-bold">{{ $vehicle->Vehcile_Condition }}<br></span>
                                                                    @endif
                                                                    @if (!empty($vehicle->Trailer_Type))
                                                                        <span @if($vehicle->Trailer_Type == '"(Enclosed Trailer Required)"') class="text-primary font-weight-bold" @endif>{{ $vehicle->Trailer_Type }}</span> <br>
                                                                    @endif
                                                                @endforeach" data-html="true">vehicles ({{ count($List_all->vehicles) }})
                                                                </a>
                                                            @endif
                                                            @if(count($List_all->heavy_equipments) === 1)
                                                                @foreach ($List_all->heavy_equipments as $equipment)
                                                                    {{ $equipment->Equipment_Year }}
                                                                    {{ $equipment->Equipment_Make }}
                                                                    {{ $equipment->Equipment_Model }}<br>
                                                                    <b>L</b>{{ $equipment->Equip_Length }} | <b>W</b>{{ $equipment->Equip_Width }} | <b>H</b>{{ $equipment->Equip_Height }}
                                                                    | {{ $equipment->Equip_Weight }} <b>LBS</b>
                                                                    @if (!empty($equipment->Equipment_Condition))
                                                                        <br>{{ $equipment->Equipment_Condition }}<br>
                                                                    @endif
                                                                    @if (!empty($equipment->Trailer_Type))
                                                                        <span @if($equipment->Trailer_Type == '"(Enclosed Trailer Required)"') class="text-primary font-weight-bold" @endif>{{ $equipment->Trailer_Type }}</span>
                                                                    @endif
                                                                @endforeach
                                                            @elseif(count($List_all->heavy_equipments) > 1)
                                                                <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                                                data-trigger="focus" style="cursor: pointer;"
                                                                title="Attached vehicles" data-content=
                                                                    "@foreach ($List_all->heavy_equipments as $equipment)
                                                                    {{ $equipment->Equipment_Year }}
                                                                    {{ $equipment->Equipment_Make }}
                                                                    {{ $equipment->Equipment_Model }}<br>
                                                                        <b>L</b>{{ $equipment->Equip_Length }} | <b>W</b>{{ $equipment->Equip_Width }} | <b>H</b>{{ $equipment->Equip_Height }} | {{ $equipment->Equip_Weight }} <b>LBS</b>
                                                                    @if (!empty($equipment->Equipment_Condition))
                                                                        <br>{{ $equipment->Equipment_Condition }}<br>
                                                                    @endif
                                                                    @if (!empty($equipment->Trailer_Type))
                                                                        <span @if($equipment->Trailer_Type == '"(Enclosed Trailer Required)"') class="text-primary font-weight-bold" @endif>{{ $equipment->Trailer_Type }}</span>
                                                                    @endif
                                                                @endforeach" data-html="true">vehicles ({{ count($List_all->heavy_equipments) }})
                                                                </a>
                                                            @endif
                                                            @if(count($List_all->dry_vans) === 1)
                                                                @foreach ($List_all->dry_vans as $dry_van)
                                                                    <span title="Freight Class">{{ $dry_van->Freight_Class }}</span>
                                                                    <span title="Freight Weight">{{ $dry_van->Freight_Weight }}</span> <b>LBS</b><br>
                                                                    @if ($dry_van->is_hazmat_Check !== 0)
                                                                        Hazmat Required<br>
                                                                    @endif
                                                                @endforeach
                                                            @elseif(count($List_all->dry_vans) > 1)
                                                                <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                                                data-trigger="focus" style="cursor: pointer;"
                                                                title="Attached vehicles" data-content=
                                                                    "@foreach ($List_all->dry_vans as $dry_van)
                                                                    <span title="Freight Class">{{ $dry_van->Freight_Class }}</span>
                                                                    <span title="Freight Weight">{{ $dry_van->Freight_Weight }}</span> <b>LBS</b><br>
                                                                    @if ($dry_van->is_hazmat_Check !== 0)
                                                                        Hazmat Required<br>
                                                                    @endif
                                                                @endforeach" data-html="true">vehicles ({{ count($List_all->dry_vans) }})
                                                                </a>
                                                            @endif
                                                            <br>
                                                            <a href="javascript:void(0)" tabindex="0" class="" data-toggle="popover"
                                                            data-trigger="focus" style="cursor: pointer;"
                                                            title="Additional Terms" data-content=
                                                                "{{ !empty($List_all->additional_info->Additional_Terms) ? $List_all->additional_info->Additional_Terms : '' }}">
                                                                {{ !empty($List_all->additional_info->Additional_Terms) ? Str::limit($List_all->additional_info->Additional_Terms, 20) : '...' }}</a>
                                                        </td>
                                                        <td>
                                                            @if(count($List_all->attachments) > 0)
                                                                <strong><a href="{{ route('Order.Attachments', ['List_ID' => $List_all->id]) }}"
                                                                        target="_blank">View Images</a></strong><br>
                                                            @endif
                                                            <strong>Ref-ID:</strong>{{ $List_all->Ref_ID }} <br>
                                                            {{ $List_all->routes->Miles }} miles <br>
                                                            $ {{ DayDispatchHelper::PricePerMiles($List_all->paymentinfo->COD_Amount, $List_all->routes->Miles) }}
                                                            /miles
                                                        </td>
                                                        <td>
                                                            <strong><a
                                                                    href="{{ route('View.Profile', ['user_id' => $List_all->authorized_user->id]) }}">{{ $List_all->authorized_user->Company_Name }}</a></strong><br>
                                                            {{ $List_all->authorized_user->Contact_Phone }}<br>
                                                            {{ $List_all->authorized_user->Hours_Operations }}<br>
                                                            {{ $List_all->authorized_user->Time_Zone }}
                                                        </td>
                                                        <td>
                                                            <strong>Price to Pay: </strong> $
                                                            {{ $List_all->paymentinfo->COD_Amount }}<br>
                                                            <strong>COD / COP: </strong>
                                                            {{ $List_all->paymentinfo->COD_Method_Mode }}
                                                        </td>
                                                        <td>
                                                            <strong>Pickup Date: </strong><br>
                                                            ({{ $List_all->pickup_delivery_info->Pickup_Date_mode }})
                                                            {{ $List_all->pickup_delivery_info->Pickup_Date }}
                                                            @if (!is_null($List_all->pickup_delivery_info->Pickup_Start_Time) && !empty($List_all->pickup_delivery_info->Pickup_Start_Time))
                                                                ({{ $List_all->pickup_delivery_info->Pickup_Start_Time }})
                                                            @endif
                                                            <br>
                                                            <strong>Delivery Date: </strong><br>
                                                            ({{ $List_all->pickup_delivery_info->Delivery_Date_mode }})
                                                            {{ $List_all->pickup_delivery_info->Delivery_Date }}
                                                            @if (!is_null($List_all->pickup_delivery_info->Delivery_Start_Time) && !empty($List_all->pickup_delivery_info->Delivery_Start_Time))
                                                                ({{ $List_all->pickup_delivery_info->Delivery_Start_Time }})
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="7">No records found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                                </div>
                            </li>
                            </ul>
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
                        {{-- End Post Vehicle --}}


                        {{-- Start Heavy Post Vehicle --}}
<div class="tab-pane" id="tab2" role="tabpanel" aria-labelledby="tab2">
<div class="card mb-30 collapse-card-box">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Heavy Post Vehicle</h3>
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
                                    <span>({{ $truck_count }}) — Trucks Matching</span>
                                </div>
                            </div>
                        </a>
                        @endif
                        <div class="accordion-content {{ ($i === 1)? 'show' : '' }}"
                             style="{{ ($i === 1)? 'display: block;' : '' }}">
                            
                            <table class="table table-hover text-center">
                                <thead>
                                <tr>
                                    <th scope="col">S.Location</th>
                                    <th scope="col">Heading 2</th>
                                    <th scope="col">F.Destination</th>
                                    <th scope="col">Departs</th>
                                    <th scope="col">Spaces</th>
                                    <th scope="col">Trailer Type</th>
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
                            
                             <ul class="accordion">
                            <li class="accordion-item">
                           <a class="accordion-title-child" href="javascript:void(0)">
                            <i class="bx bx-plus"></i>
                              <div class="row">
                                <div class="col-6 justify-content-start">
                                    <span>Matching Trucks </span>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    
                                </div>
                            </div>
                            </a>
                            <div class="accordion-content-child" >
                            <table class="table table-hover text-center">
                                <thead>
                                <tr>
                                    <th scope="col">Routes</th>
                                    <th scope="col">Vehicles Info</th>
                                    <th scope="col">Ref. / Dist.</th>
                                    <th scope="col">Company Info</th>
                                    <th scope="col">Customer / Payments</th>
                                    <th scope="col">Dates</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($Heavy_Truck_Space as $truck_space)
                                    @if(DayDispatchHelper::getZipCodeStateCity($truck_space->Heavy_Truck_Location, 1) !== DayDispatchHelper::getZipCodeStateCity($List->routes->Origin_ZipCode, 1))
                                        @continue
                                    @endif
                                    {{-- {{dd($List)}} --}}
                                    @if($List->Listing_Type == 2)
                                    @foreach ($All_Listing as $key => $List)
                                    {{-- @if(!$auth_user->is_heavy_subscribe)
                                        @continue($List->Listing_Type === 2)
                                    @endif --}}
                                   {{--  @if(!$auth_user->is_dry_van_subscribe)
                                        @continue($List->Listing_Type === 3)
                                    @endif --}}
                                    @if(DayDispatchHelper::getZipCodeStateCity($List->routes->Origin_ZipCode) === DayDispatchHelper::getZipCodeStateCity($truck_space->Heavy_Truck_Location))
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
                                                            <span class="text-danger font-weight-bold">{{ $vehcile->Vehcile_Condition }}<br></span>
                                                        @endif
                                                        @if (!empty($vehcile->Trailer_Type))
                                                            <span @if($vehcile->Trailer_Type == '"(Enclosed Trailer Required)"') class="text-primary font-weight-bold" @endif>{{ $vehcile->Trailer_Type }}</span> <br>
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
                                                            <span @if($vehcile->Trailer_Type == '"(Enclosed Trailer Required)"') class="text-primary font-weight-bold" @endif>{{ $vehcile->Trailer_Type }}</span>
                                                        @endif
                                                    @endforeach" data-html="true">vehicles ({{ count($List->heavy_equipments) }})
                                                    </a>
                                                @endif
                                                @if(count($List->dry_vans) === 1)
                                                    @foreach ($List->dry_vans as $vehcile)
                                                        <span title="Freight Class">{{ $vehcile->Freight_Class }}</span>
                                                        <span title="Freight Weight">{{ $vehcile->Freight_Weight }}</span> <b>LBS</b><br>
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
                                                        <span title="Freight Class">{{ $vehcile->Freight_Class }}</span>
                                                        <span title="Freight Weight">{{ $vehcile->Freight_Weight }}</span> <b>LBS</b><br>
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
                                                {{ $List->pickup_delivery_info->Delivery_Date }}
                                                @if (!is_null($List->pickup_delivery_info->Delivery_Start_Time))
                                                    <br>
                                                    {{ \Carbon\Carbon::parse($List->pickup_delivery_info->Delivery_Start_Time)->format('g:i:s A').' - '.\Carbon\Carbon::parse($List->pickup_delivery_info->Delivery_End_Time)->format('g:i:s A')}}
                                                @endif
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
                                        </tr>
                                    @endif 
                                @endforeach
                                @endif
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
                            </ul>
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
                        {{-- End Heavy Post Vehicle --}}




                        {{-- Start Freight Load Vehicle --}}
<div class="tab-pane" id="tab3" role="tabpanel" aria-labelledby="tab3">
<div class="card mb-30 collapse-card-box">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Freight Load Vehicle</h3>
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
                    @foreach($Truck_Space_Dry as $truck_space)
                        @if(DayDispatchHelper::getZipCodeStateCity($truck_space->Truck_Location_Dry, 1) === DayDispatchHelper::getZipCodeStateCity($List->routes->Origin_ZipCode, 1))
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
                                    <span>({{ $truck_count }}) — Trucks Matching</span>
                                </div>
                            </div>
                        </a>
                        @endif
                        <div class="accordion-content {{ ($i === 1)? 'show' : '' }}"
                             style="{{ ($i === 1)? 'display: block;' : '' }}">
                            
                            <table class="table table-hover text-center">
                                <thead>
                                <tr>
                                    <th scope="col">S.Location</th>
                                    <th scope="col">Heading 2</th>
                                    <th scope="col">F.Destination</th>
                                    <th scope="col">Departs</th>
                                    <th scope="col">Trailer Specification</th>
                                    <th scope="col">Shipment Preference</th>
                                    <th scope="col">Trailer Type</th>
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
                                        <td>{{ $truck_space->Trailer_Specification_Dry }}</td>
                                        <td>{{ $truck_space->Shipment_Preferences_Dry }}</td>
                                        <td>{{ $truck_space->Trailer_Type_Dry }}</td>
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
                            
                             <ul class="accordion">
                            <li class="accordion-item">
                           <a class="accordion-title-child" href="javascript:void(0)">
                            <i class="bx bx-plus"></i>
                              <div class="row">
                                <div class="col-6 justify-content-start">
                                    <span>Matching Trucks </span>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    
                                </div>
                            </div>
                            </a>
                            <div class="accordion-content-child" >
                            <table class="table table-hover text-center">
                                <thead>
                                <tr>
                                    <th scope="col">Routes</th>
                                    <th scope="col">Vehicles Info</th>
                                    <th scope="col">Ref. / Dist.</th>
                                    <th scope="col">Company Info</th>
                                    <th scope="col">Customer / Payments</th>
                                    <th scope="col">Dates</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($Truck_Space_Dry as $truck_space)
                                    @if(DayDispatchHelper::getZipCodeStateCity($truck_space->Truck_Location_Dry, 1) !== DayDispatchHelper::getZipCodeStateCity($List->routes->Origin_ZipCode, 1))
                                        @continue
                                    @endif
                                    @if($List->Listing_Type == 3)
                                    @foreach ($All_Listing as $key => $List)
                                    {{-- {{dd($List)}} --}}
                                    {{-- @if(!$auth_user->is_heavy_subscribe)
                                        @continue($List->Listing_Type === 2)
                                    @endif --}}
                                   {{--  @if(!$auth_user->is_dry_van_subscribe)
                                        @continue($List->Listing_Type === 3)
                                    @endif --}}
                                    @if(DayDispatchHelper::getZipCodeStateCity($List->routes->Origin_ZipCode) === DayDispatchHelper::getZipCodeStateCity($truck_space->Truck_Location_Dry))
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
                                                            <span class="text-danger font-weight-bold">{{ $vehcile->Vehcile_Condition }}<br></span>
                                                        @endif
                                                        @if (!empty($vehcile->Trailer_Type))
                                                            <span @if($vehcile->Trailer_Type == '"(Enclosed Trailer Required)"') class="text-primary font-weight-bold" @endif>{{ $vehcile->Trailer_Type }}</span> <br>
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
                                                            <span @if($vehcile->Trailer_Type == '"(Enclosed Trailer Required)"') class="text-primary font-weight-bold" @endif>{{ $vehcile->Trailer_Type }}</span>
                                                        @endif
                                                    @endforeach" data-html="true">vehicles ({{ count($List->heavy_equipments) }})
                                                    </a>
                                                @endif
                                                @if(count($List->dry_vans) === 1)
                                                    @foreach ($List->dry_vans as $vehcile)
                                                        <span title="Freight Class">{{ $vehcile->Freight_Class }}</span>
                                                        <span title="Freight Weight">{{ $vehcile->Freight_Weight }}</span> <b>LBS</b><br>
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
                                                        <span title="Freight Class">{{ $vehcile->Freight_Class }}</span>
                                                        <span title="Freight Weight">{{ $vehcile->Freight_Weight }}</span> <b>LBS</b><br>
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
                                                {{ $List->pickup_delivery_info->Delivery_Date }}
                                                @if (!is_null($List->pickup_delivery_info->Delivery_Start_Time))
                                                    <br>
                                                    {{ \Carbon\Carbon::parse($List->pickup_delivery_info->Delivery_Start_Time)->format('g:i:s A').' - '.\Carbon\Carbon::parse($List->pickup_delivery_info->Delivery_End_Time)->format('g:i:s A')}}
                                                @endif
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
                                        </tr>
                                    @endif 
                                @endforeach
                                @endif
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
                            </ul>
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
{{-- End Freight Load Vehicle --}}
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
        console.log('show')

        // const bid = document.getElementsByClassName("bidoffer");
        
        
        
        if(params == 1){
            $('.offer-price').hide();
            // const get = bid[0].querySelector("#bid");
            $('.bidoffer #bid').remove();  
        }
        else{
            $('.bidoffer').html(`
                <input type="text" class="form-control" placeholder="Enter Your Bid Price" id="bid"
                value="" name="Offer_Price" required>
            `)
            $('.offer-price').show();
        }
    }


</script>