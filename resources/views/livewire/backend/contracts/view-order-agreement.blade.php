    <style>
        .p2 {
            padding: 20px;
        }
    </style>
    <main
        style="border-radius: 30px;padding: 30px;background: #ffffff;z-index;box-shadow: 0px 0px 11px 1px #113771;red;">
        <div class="as-invoice invoice_style4">
            <!--<div class="template_shape1"><img src="{{ asset('invoice/img/template/car_road.png') }}" alt="car road"></div>-->
            <div class="" id="download_section">
                <header class="as-header header-layout4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="header-logo"><a href="{{ route('User.Dashboard') }}"><img
                                        src="{{ asset('frontend/img/logo/logo.png') }}" alt="Day Dispatch Logo"></a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <h1 class="big-title" style="color:#e01f26;">View Dispatch</h1>
                            <span><b>Reference ID: </b>#{{ $Lisiting->all_listing->Ref_ID }}</span>
                            <span><b>Current Status: </b>{{ $Lisiting->all_listing->Listing_Status }}</span>
                            <span><b>Last Modified: </b>{{ $Lisiting->all_listing->updated_at }}</span>
                        </div>
                    </div>
                </header>
                <div class="row justify-content-between mb-4">
                    <div class="col-auto">
                        <div class="invoice-left"><span class="fs-5" style="color:#e01f26;">Pick-Up Information</span>
                            <address>
                                <b>Date: </b> {{ $Lisiting->all_listing->pickup_delivery_info->Pickup_Date }}
                                ({{ $Lisiting->all_listing->pickup_delivery_info->Pickup_Date_mode }})<br>
                                @if (!is_null($Lisiting->all_listing->pickup_delivery_info->Pickup_Start_Time))
                                    <b>Pickup From: </b>
                                    {{ $Lisiting->all_listing->pickup_delivery_info->Pickup_Start_Time }}<br>
                                @endif
                                @if (!is_null($Lisiting->all_listing->pickup_delivery_info->Pickup_End_Time))
                                    <b>Pickup To: </b>
                                    {{ $Lisiting->all_listing->pickup_delivery_info->Pickup_End_Time }}<br>
                                @endif
                                <b>Address: </b>{{ $Lisiting->all_listing->routes->Origin_Address }}
                                {!! !empty($Lisiting->all_listing->routes->Origin_Address_II)
                                    ? ',<br>' . $Lisiting->all_listing->routes->Origin_Address_II
                                    : '' !!}
                                <br>
                                <b>ZipCode: </b>{{ $Lisiting->all_listing->routes->Origin_ZipCode }}
                            </address>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="invoice-middle"><span class="fs-5" style="color:#e01f26;">Delivery
                                Information</span>
                            <address>
                                <b>Date: </b> {{ $Lisiting->all_listing->pickup_delivery_info->Delivery_Date }}
                                ({{ $Lisiting->all_listing->pickup_delivery_info->Delivery_Date_mode }})<br>
                                @if (!is_null($Lisiting->all_listing->pickup_delivery_info->Delivery_Start_Time))
                                    <b>Delivery From: </b>
                                    {{ $Lisiting->all_listing->pickup_delivery_info->Delivery_Start_Time }}<br>
                                @endif
                                @if (!is_null($Lisiting->all_listing->pickup_delivery_info->Delivery_End_Time))
                                    <b>Delivery To: </b>
                                    {{ $Lisiting->all_listing->pickup_delivery_info->Delivery_End_Time }}<br>
                                @endif
                                <b>Address: </b>{{ $Lisiting->all_listing->routes->Destination_Address }}
                                {!! !empty($Lisiting->all_listing->routes->Destination_Address_II)
                                    ? ',<br>' . $Lisiting->all_listing->routes->Destination_Address_II
                                    : '' !!}
                                <br>
                                <b>ZipCode: </b>{{ $Lisiting->all_listing->routes->Dest_ZipCode }}
                            </address>
                        </div>
                    </div>
                    {{-- <div class="col-auto">
                        <div class=""><span class="fs-5" style="color:#e01f26;">Dispatch From:</span>
                            <address>
                                <b>Name: </b> {{ $Lisiting->all_listing->authorized_user->Company_Name }}<br>
                                <b>Phone No.: </b>{{ $Lisiting->all_listing->authorized_user->Contact_Phone }}<br>
                                <b>ICCMC: </b>{{ $Lisiting->all_listing->authorized_user->Mc_Number }}
                            </address>
                        </div>
                    </div> --}}
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        @if ($Lisiting->all_listing->driver)
                            <h5 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                                <i class="bi bi-hash mr-2"></i> Dispatch From:
                            </h5>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>General Information</th>
                                            <th>Contact Information</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><b>Name:</b> {{ $Lisiting->all_listing->authorized_user->Company_Name }}</td>
                                            <td><b>Contact Phone:</b> {{ $Lisiting->all_listing->driver->Driver_Phone ?? 'null' }} </td>
                                            {{-- <td>{{ $Lisiting->all_listing->driver->Driver_Name }}</td> --}}
                                        </tr>
                                        <tr>
                                            <td><b>Phone No:</b> {{ $Lisiting->all_listing->authorized_user->Contact_Phone }}</td>
                                            <td><b>Phone:</b> {{ $Lisiting->all_listing->driver->Driver_Phone ?? 'null' }} </td>
                                            {{-- <td>{{ $Lisiting->all_listing->driver->Driver_Email }}</td> --}}
                                        </tr>
                                        <tr>
                                            <td><b>ICCMC:</b> {{ $Lisiting->all_listing->authorized_user->Mc_Number }}</td>
                                            <td><b>Driver Phone:</b> {{ $Lisiting->all_listing->driver->Driver_Phone ?? 'null' }} </td>
                                            {{-- <td>{{ $Lisiting->all_listing->driver->Driver_Phone }}</td> --}}
                                        </tr>
                                        <tr>
                                            <td><b>Address:</b> {{ $Lisiting->all_listing->authorized_user->Address }}</td>
                                            <td><b>Agent Phone:</b> {{ $Lisiting->all_listing->driver->Driver_Phone ?? 'null' }} </td>
                                            {{-- <td>{{ $Lisiting->all_listing->driver->Driver_Phone }}</td> --}}
                                        </tr>
                                        {{-- <tr>
                                            <td>{{ $Lisiting->all_listing->driver->Driver_Name }}</td>
                                            <td>{{ $Lisiting->all_listing->driver->Driver_Email }}</td>
                                            <td>{{ $Lisiting->all_listing->driver->Driver_Phone }}</td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <h5 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                            <i class="bi bi-hash mr-2"></i> Dispatch To
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    {{-- <tr>
                                    <th colspan="2" class="text-center"><b>Dispatch To</b></th>
                                </tr> --}}
                                    <tr>
                                        <th>General Information</th>
                                        <th>Contact Information</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><b>Company Name: </b>{{ $Lisiting->agreement_user->Company_Name }}</td>
                                        <td><b>Contact Phone: </b>{{ $Lisiting->agreement_user->Contact_Phone }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Address: </b>{{ $Lisiting->agreement_user->Address }}</td>
                                        <td><b>Phone: </b>{{ $Lisiting->agreement_user->Local_Phone }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>MC Number: </b>{{ $Lisiting->agreement_user->Mc_Number }}</td>
                                        <td><b>Agent Phone: </b>{{ $Lisiting->agreement_user->Agent_Phone ?? 'null'}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Driver Name: </b>{{ $Lisiting->all_listing->driver->Driver_Name ?? 'null' }}</td>
                                        <td><b>Driver Phone: </b>{{ $Lisiting->all_listing->driver->Driver_Phone ?? 'null' }}
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                    <td colspan="2"><b>Status:
                                        </b>{{ $Lisiting->all_listing->Listing_Status }}</td>
                                </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        @if (count($Lisiting->all_listing->vehicles) > 0)
                            <h5 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                                <i class="bi bi-hash mr-2"></i> Vehicle(s) Information
                            </h5>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th colspan="6" class="text-center"><b>Vehicle(s) Information</b></th>
                                        </tr>
                                        <tr>
                                            <th>Year Make Model</th>
                                            <th>Vin No.</th>    
                                            <th>Type</th>
                                            <th>Condition</th>
                                            <th>Trailer Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Lisiting->all_listing->vehicles as $vehcile)
                                            <tr>
                                                <td>{{ $vehcile->Vehcile_Year . " " . $vehcile->Vehcile_Make . " " . $vehcile->Vehcile_Model }} </td>
                                                {{-- <td class="">{{ $vehcile->Vehcile_Year }}
                                                    {{ $vehcile->Vehcile_Make }}
                                                    {{ $vehcile->Vehcile_Model }}</td> --}}
                                                <td>{{ $vehcile->Vin_Number }}</td>
                                                <td>{{ $vehcile->Vehcile_Type }}</td>
                                                <td>{{ $vehcile->Vehcile_Condition === '' ? 'Running' : $vehcile->Vehcile_Condition }}</td>
                                                <td>{{ $vehcile->Trailer_Type === '' ? 'Open' : $vehcile->Trailer_Type }}</td>

                                            </tr>
                                            {{-- <tr>
                                                <td><b>Vin No.</b> {{ $vehcile->Vin_Number }}</td>
                                                <td class="">{{ $vehcile->Vin_Number }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Title</b></td>
                                                <td class="">-</td>
                                            </tr>
                                            <tr>
                                                <td><b>Type:</b> {{ $vehcile->Vehcile_Type }}</td>
                                                <td class="">{{ $vehcile->Vehcile_Type }}</td>
                                            </tr> --}}
                                            {{-- <tr> --}}
                                                {{-- <td>{{ $vehcile->Vehcile_Condition === '' ? 'Running' : $vehcile->Vehcile_Condition }}</td> --}}
                                                {{-- <td class="">
                                                    {{ $vehcile->Vehcile_Condition === '' ? 'Running' : $vehcile->Vehcile_Condition }}
                                                </td> --}}
                                                {{-- <td>{{ $vehcile->Trailer_Type === '' ? 'Open' : $vehcile->Trailer_Type }}</td>
                                                <td></td> --}}
                                            {{-- </tr> --}}
                                            {{-- <tr>
                                                <td><b>Trailer Type:</b> {{ $vehcile->Trailer_Type === '' ? 'Open' : $vehcile->Trailer_Type }}</td>
                                                <td class="">
                                                    {{ $vehcile->Trailer_Type === '' ? 'Open' : $vehcile->Trailer_Type }}
                                                </td>
                                            </tr> --}}
                                            {{-- <tr>
                                                <td class="text-center">{{ $vehcile->Vehcile_Year }} {{ $vehcile->Vehcile_Make }}
                                                    {{ $vehcile->Vehcile_Model }}</td>
                                                <td class="text-center">{{ $vehcile->Vin_Number }}</td>
                                                <td class="text-center">-</td>
                                                <td class="text-center">{{ $vehcile->Vehcile_Type }}</td>
                                                <td class="text-center">
                                                    {{ $vehcile->Vehcile_Condition === '' ? 'Running' : $vehcile->Vehcile_Condition }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $vehcile->Trailer_Type === '' ? 'Open' : $vehcile->Trailer_Type }}</td>
                                            </tr> --}}
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <h5 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                            <i class="bi bi-hash mr-2"></i> Origin Location
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td><b>Name:</b></td>
                                        <td>{{ $Lisiting->all_listing->listing_origin_location->User_Name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Email Address:</b></td>
                                        <td>{{ $Lisiting->all_listing->listing_origin_location->User_Email }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Phone Number:</b></td>
                                        <td>{{ $Lisiting->all_listing->listing_origin_location->Local_Phone }}</td>
                                    </tr>
                                    @if (!empty($Lisiting->all_listing->listing_origin_location->Location))
                                        <tr>
                                            <td><b>Location Type:</b></td>
                                            <td>{{ $Lisiting->all_listing->listing_origin_location->Location }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($Lisiting->all_listing->listing_origin_location->Auction_Method))
                                        <tr>
                                            <td>
                                                <b>
                                                    @if ($Lisiting->all_listing->listing_origin_location->Destination_Location == 'Dealership')
                                                        Dealership:
                                                    @elseif ($Lisiting->all_listing->listing_origin_location->Destination_Location == 'Port')
                                                        Port Name:
                                                    @elseif ($Lisiting->all_listing->listing_origin_location->Destination_Location == 'Auction')
                                                        Auction Name:
                                                    @else
                                                        Name:
                                                    @endif
                                                </b>
                                            </td>
                                            <td>
                                                {{ $Lisiting->all_listing->listing_origin_location->Auction_Method }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($Lisiting->all_listing->listing_origin_location->Auction_Phone))
                                        <tr>
                                            <td>
                                                <b>
                                                    @if ($Lisiting->all_listing->listing_origin_location->Auction_Phone == 'Dealership')
                                                        Dealership Phone:
                                                    @elseif ($Lisiting->all_listing->listing_origin_location->Auction_Phone == 'Port')
                                                        Port Phone:
                                                    @elseif ($Lisiting->all_listing->listing_origin_location->Auction_Phone == 'Auction')
                                                        Auction Phone:
                                                    @else
                                                        Phone:
                                                    @endif
                                                </b>
                                            </td>
                                            <td>
                                                {{ $Lisiting->all_listing->listing_origin_location->Auction_Phone }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($Lisiting->all_listing->listing_origin_location->Stock_Number))
                                        <tr>
                                            <td><b>Buyer / Stock Number:</b></td>
                                            <td>
                                                {{ $Lisiting->all_listing->listing_origin_location->Stock_Number }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($Lisiting->all_listing->listing_origin_location->Business_Phone))
                                        <tr>
                                            <td><b>Business Phone:</b></td>
                                            <td>{{ $Lisiting->all_listing->listing_origin_location->Business_Phone }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($Lisiting->all_listing->listing_origin_location->Business_Location))
                                        <tr>
                                            <td><b>Business Location:</b></td>
                                            <td>{{ $Lisiting->all_listing->listing_origin_location->Business_Location }}
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{-- <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Origin Location ({{ $Lisiting->all_listing->listing_origin_location->Orign_Location }})
                                        </th>
                                        <th>Destination Location
                                            ({{ $Lisiting->all_listing->listing_destination_locations->Destination_Location }})
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><b>Name: </b>{{ $Lisiting->all_listing->listing_origin_location->User_Name }}</td>
                                        <td><b>Name: </b>{{ $Lisiting->all_listing->listing_destination_locations->Dest_User_Name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Email Address: </b>{{ $Lisiting->all_listing->listing_origin_location->User_Email }}
                                        </td>
                                        <td><b>Email
                                                Address:
                                            </b>{{ $Lisiting->all_listing->listing_destination_locations->Dest_User_Email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Phone Number: </b>{{ $Lisiting->all_listing->listing_origin_location->Local_Phone }}
                                        </td>
                                        <td><b>Phone
                                                Number:
                                            </b>{{ $Lisiting->all_listing->listing_destination_locations->Dest_Local_Phone }}
                                        </td>
                                    </tr>
                                    @if (!empty($Lisiting->all_listing->listing_origin_location->Location) || !empty($Lisiting->all_listing->listing_destination_locations->Dest_Location))
                                        <tr>
                                            <td><b>Location Type: </b>{{ $Lisiting->all_listing->listing_origin_location->Location }}
                                            </td>
                                            <td><b>Location
                                                    Type:
                                                </b>{{ $Lisiting->all_listing->listing_destination_locations->Dest_Location }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($Lisiting->all_listing->listing_origin_location->Auction_Method) || !empty($Lisiting->all_listing->listing_destination_locations->Dest_Auction_Method))
                                        <tr>
                                            <td>
                                                <b>
                                                    @if ($Lisiting->all_listing->listing_origin_location->Destination_Location == 'Dealership')
                                                        Dealership:
                                                    @elseif ($Lisiting->all_listing->listing_origin_location->Destination_Location == 'Port')
                                                        Port Name:
                                                    @elseif ($Lisiting->all_listing->listing_origin_location->Destination_Location == 'Auction')
                                                        Auction Name:
                                                    @else
                                                        Name:
                                                    @endif
                                                </b>
                                                {{ $Lisiting->all_listing->listing_origin_location->Auction_Method }}
                                            </td>
                                            <td>
                                                <b>
                                                    @if ($Lisiting->all_listing->listing_destination_locations->Destination_Location == 'Dealership')
                                                        Dealership:
                                                    @elseif ($Lisiting->all_listing->listing_destination_locations->Destination_Location == 'Port')
                                                        Port Name:
                                                    @elseif ($Lisiting->all_listing->listing_destination_locations->Destination_Location == 'Auction')
                                                        Auction Name:
                                                    @else
                                                        Name:
                                                    @endif

                                                </b>{{ $Lisiting->all_listing->listing_destination_locations->Dest_Auction_Method }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($Lisiting->all_listing->listing_origin_location->Auction_Phone) || !empty($Lisiting->all_listing->listing_destination_locations->Dest_Auction_Phone))
                                        <tr>
                                            <td>
                                                <b>
                                                    @if ($Lisiting->all_listing->listing_origin_location->Auction_Phone == 'Dealership')
                                                        Dealership Phone:
                                                    @elseif ($Lisiting->all_listing->listing_origin_location->Auction_Phone == 'Port')
                                                        Port Phone:
                                                    @elseif ($Lisiting->all_listing->listing_origin_location->Auction_Phone == 'Auction')
                                                        Auction Phone:
                                                    @else
                                                        Phone:
                                                    @endif
                                                </b>
                                                {{ $Lisiting->all_listing->listing_origin_location->Auction_Phone }}
                                            </td>
                                            <td>
                                                <b>
                                                    @if ($Lisiting->all_listing->listing_destination_locations->Auction_Phone == 'Dealership')
                                                        Dealership Phone:
                                                    @elseif ($Lisiting->all_listing->listing_destination_locations->Auction_Phone == 'Port')
                                                        Port Phone:
                                                    @elseif ($Lisiting->all_listing->listing_destination_locations->Auction_Phone == 'Auction')
                                                        Auction Phone:
                                                    @else
                                                        Phone:
                                                    @endif
                                                </b>
                                                {{ $Lisiting->all_listing->listing_destination_locations->Dest_Auction_Phone }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($Lisiting->all_listing->listing_origin_location->Stock_Number) || !empty($Lisiting->all_listing->listing_destination_locations->Dest_Stock_Number))
                                        <tr>
                                            <td>
                                                <b>
                                                    @if ($Lisiting->all_listing->listing_origin_location->Stock_Number == 'Dealership')
                                                        Buyer / Stock
                                                        Number:
                                                    @elseif ($Lisiting->all_listing->listing_origin_location->Stock_Number == 'Port')
                                                        Buyer / Stock
                                                        Number:
                                                    @elseif ($Lisiting->all_listing->listing_origin_location->Stock_Number == 'Auction')
                                                        Buyer / Stock
                                                        Number:
                                                    @endif
                                                    Buyer / Stock
                                                    Number:
                                                </b>
                                                {{ $Lisiting->all_listing->listing_origin_location->Stock_Number }}
                                            </td>
                                            <td><b>Buyer / Stock Number:
                                                </b>{{ $Lisiting->all_listing->listing_destination_locations->Dest_Stock_Number }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($Lisiting->all_listing->listing_origin_location->Business_Phone) || !empty($Lisiting->all_listing->listing_destination_locations->Dest_Business_Phone))
                                        <tr>
                                            <td><b>Business Phone:
                                                </b>{{ $Lisiting->all_listing->listing_origin_location->Business_Phone }}</td>
                                            <td><b>Business Phone:
                                                </b>{{ $Lisiting->all_listing->listing_destination_locations->Dest_Business_Phone }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($Lisiting->all_listing->listing_origin_location->Business_Location) || !empty($Lisiting->all_listing->listing_destination_locations->Dest_Business_Location))
                                        <tr>
                                            <td><b>Business Location:
                                                </b>{{ $Lisiting->all_listing->listing_origin_location->Business_Location }}</td>
                                            <td><b>Business Location:
                                                </b>{{ $Lisiting->all_listing->listing_destination_locations->Dest_Business_Location }}
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div> --}}
                    </div>
                    <div class="col-sm-6">
                        <h5 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                            <i class="bi bi-hash mr-2"></i> Destination Location
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td><b>Name:
                                            </b></td>
                                        <td>{{ $Lisiting->all_listing->listing_destination_locations->Dest_User_Name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Email Address:
                                            </b></td>
                                        <td>{{ $Lisiting->all_listing->listing_destination_locations->Dest_User_Email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Phone Number:
                                            </b></td>
                                        <td>{{ $Lisiting->all_listing->listing_destination_locations->Dest_Local_Phone }}
                                        </td>
                                    </tr>
                                    @if (!empty($Lisiting->all_listing->listing_destination_locations->Dest_Location))
                                        <tr>
                                            <td><b>Location Type:
                                                </b></td>
                                            <td>{{ $Lisiting->all_listing->listing_destination_locations->Dest_Location }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($Lisiting->all_listing->listing_destination_locations->Dest_Auction_Method))
                                        <tr>
                                            <td>
                                                <b>
                                                    @if ($Lisiting->all_listing->listing_destination_locations->Destination_Location == 'Dealership')
                                                        Dealership:
                                                    @elseif ($Lisiting->all_listing->listing_destination_locations->Destination_Location == 'Port')
                                                        Port Name:
                                                    @elseif ($Lisiting->all_listing->listing_destination_locations->Destination_Location == 'Auction')
                                                        Auction Name:
                                                    @else
                                                        Name:
                                                    @endif
                                                </b>
                                            </td>
                                            <td>
                                                {{ $Lisiting->all_listing->listing_destination_locations->Dest_Auction_Method }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($Lisiting->all_listing->listing_destination_locations->Dest_Auction_Phone))
                                        <tr>
                                            <td>
                                                <b>
                                                    @if ($Lisiting->all_listing->listing_destination_locations->Auction_Phone == 'Dealership')
                                                        Dealership Phone:
                                                    @elseif ($Lisiting->all_listing->listing_destination_locations->Auction_Phone == 'Port')
                                                        Port Phone:
                                                    @elseif ($Lisiting->all_listing->listing_destination_locations->Auction_Phone == 'Auction')
                                                        Auction Phone:
                                                    @else
                                                        Phone:
                                                    @endif
                                                </b>
                                            </td>
                                            <td>
                                                {{ $Lisiting->all_listing->listing_destination_locations->Dest_Auction_Phone }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($Lisiting->all_listing->listing_destination_locations->Dest_Stock_Number))
                                        <tr>
                                            <td><b>Buyer / Stock Number:
                                                </b></td>
                                            <td>{{ $Lisiting->all_listing->listing_destination_locations->Dest_Stock_Number }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($Lisiting->all_listing->listing_destination_locations->Dest_Business_Phone))
                                        <tr>
                                            <td><b>Business Phone:
                                                </b></td>
                                            <td>{{ $Lisiting->all_listing->listing_destination_locations->Dest_Business_Phone }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($Lisiting->all_listing->listing_destination_locations->Dest_Business_Location))
                                        <tr>
                                            <td><b>Business Location:
                                                </b></td>
                                            <td>{{ $Lisiting->all_listing->listing_destination_locations->Dest_Business_Location }}
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{-- <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Origin Location ({{ $Lisiting->all_listing->listing_origin_location->Orign_Location }})
                                        </th>
                                        <th>Destination Location
                                            ({{ $Lisiting->all_listing->listing_destination_locations->Destination_Location }})
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><b>Name: </b>{{ $Lisiting->all_listing->listing_origin_location->User_Name }}</td>
                                        <td><b>Name: </b>{{ $Lisiting->all_listing->listing_destination_locations->Dest_User_Name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Email Address: </b>{{ $Lisiting->all_listing->listing_origin_location->User_Email }}
                                        </td>
                                        <td><b>Email
                                                Address:
                                            </b>{{ $Lisiting->all_listing->listing_destination_locations->Dest_User_Email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Phone Number: </b>{{ $Lisiting->all_listing->listing_origin_location->Local_Phone }}
                                        </td>
                                        <td><b>Phone
                                                Number:
                                            </b>{{ $Lisiting->all_listing->listing_destination_locations->Dest_Local_Phone }}
                                        </td>
                                    </tr>
                                    @if (!empty($Lisiting->all_listing->listing_origin_location->Location) || !empty($Lisiting->all_listing->listing_destination_locations->Dest_Location))
                                        <tr>
                                            <td><b>Location Type: </b>{{ $Lisiting->all_listing->listing_origin_location->Location }}
                                            </td>
                                            <td><b>Location
                                                    Type:
                                                </b>{{ $Lisiting->all_listing->listing_destination_locations->Dest_Location }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($Lisiting->all_listing->listing_origin_location->Auction_Method) || !empty($Lisiting->all_listing->listing_destination_locations->Dest_Auction_Method))
                                        <tr>
                                            <td>
                                                <b>
                                                    @if ($Lisiting->all_listing->listing_origin_location->Destination_Location == 'Dealership')
                                                        Dealership:
                                                    @elseif ($Lisiting->all_listing->listing_origin_location->Destination_Location == 'Port')
                                                        Port Name:
                                                    @elseif ($Lisiting->all_listing->listing_origin_location->Destination_Location == 'Auction')
                                                        Auction Name:
                                                    @else
                                                        Name:
                                                    @endif
                                                </b>
                                                {{ $Lisiting->all_listing->listing_origin_location->Auction_Method }}
                                            </td>
                                            <td>
                                                <b>
                                                    @if ($Lisiting->all_listing->listing_destination_locations->Destination_Location == 'Dealership')
                                                        Dealership:
                                                    @elseif ($Lisiting->all_listing->listing_destination_locations->Destination_Location == 'Port')
                                                        Port Name:
                                                    @elseif ($Lisiting->all_listing->listing_destination_locations->Destination_Location == 'Auction')
                                                        Auction Name:
                                                    @else
                                                        Name:
                                                    @endif

                                                </b>{{ $Lisiting->all_listing->listing_destination_locations->Dest_Auction_Method }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($Lisiting->all_listing->listing_origin_location->Auction_Phone) || !empty($Lisiting->all_listing->listing_destination_locations->Dest_Auction_Phone))
                                        <tr>
                                            <td>
                                                <b>
                                                    @if ($Lisiting->all_listing->listing_origin_location->Auction_Phone == 'Dealership')
                                                        Dealership Phone:
                                                    @elseif ($Lisiting->all_listing->listing_origin_location->Auction_Phone == 'Port')
                                                        Port Phone:
                                                    @elseif ($Lisiting->all_listing->listing_origin_location->Auction_Phone == 'Auction')
                                                        Auction Phone:
                                                    @else
                                                        Phone:
                                                    @endif
                                                </b>
                                                {{ $Lisiting->all_listing->listing_origin_location->Auction_Phone }}
                                            </td>
                                            <td>
                                                <b>
                                                    @if ($Lisiting->all_listing->listing_destination_locations->Auction_Phone == 'Dealership')
                                                        Dealership Phone:
                                                    @elseif ($Lisiting->all_listing->listing_destination_locations->Auction_Phone == 'Port')
                                                        Port Phone:
                                                    @elseif ($Lisiting->all_listing->listing_destination_locations->Auction_Phone == 'Auction')
                                                        Auction Phone:
                                                    @else
                                                        Phone:
                                                    @endif
                                                </b>
                                                {{ $Lisiting->all_listing->listing_destination_locations->Dest_Auction_Phone }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($Lisiting->all_listing->listing_origin_location->Stock_Number) || !empty($Lisiting->all_listing->listing_destination_locations->Dest_Stock_Number))
                                        <tr>
                                            <td>
                                                <b>
                                                    @if ($Lisiting->all_listing->listing_origin_location->Stock_Number == 'Dealership')
                                                        Buyer / Stock
                                                        Number:
                                                    @elseif ($Lisiting->all_listing->listing_origin_location->Stock_Number == 'Port')
                                                        Buyer / Stock
                                                        Number:
                                                    @elseif ($Lisiting->all_listing->listing_origin_location->Stock_Number == 'Auction')
                                                        Buyer / Stock
                                                        Number:
                                                    @endif
                                                    Buyer / Stock
                                                    Number:
                                                </b>
                                                {{ $Lisiting->all_listing->listing_origin_location->Stock_Number }}
                                            </td>
                                            <td><b>Buyer / Stock Number:
                                                </b>{{ $Lisiting->all_listing->listing_destination_locations->Dest_Stock_Number }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($Lisiting->all_listing->listing_origin_location->Business_Phone) || !empty($Lisiting->all_listing->listing_destination_locations->Dest_Business_Phone))
                                        <tr>
                                            <td><b>Business Phone:
                                                </b>{{ $Lisiting->all_listing->listing_origin_location->Business_Phone }}</td>
                                            <td><b>Business Phone:
                                                </b>{{ $Lisiting->all_listing->listing_destination_locations->Dest_Business_Phone }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($Lisiting->all_listing->listing_origin_location->Business_Location) || !empty($Lisiting->all_listing->listing_destination_locations->Dest_Business_Location))
                                        <tr>
                                            <td><b>Business Location:
                                                </b>{{ $Lisiting->all_listing->listing_origin_location->Business_Location }}</td>
                                            <td><b>Business Location:
                                                </b>{{ $Lisiting->all_listing->listing_destination_locations->Dest_Business_Location }}
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div> --}}
                    </div>
                </div>
                @if (count($Lisiting->all_listing->heavy_equipments) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped text-center">
                            <thead>
                                <tr>
                                    <th colspan="6" class="text-center"><b>Heavy Equipment(s) Information</b></th>
                                </tr>
                                <tr>
                                    <th>Year Make Model</th>
                                    <th>Dimensions</th>
                                    <th>Preference</th>
                                    <th>Condition</th>
                                    <th>Trailer Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Lisiting->all_listing->heavy_equipments as $vehcile)
                                    <tr>
                                        <td class="text-center">{{ $vehcile->Equipment_Year }}
                                            {{ $vehcile->Equipment_Make }}
                                            {{ $vehcile->Equipment_Model }}</td>
                                        <td class="text-center">
                                            <b>L</b>{{ $vehcile->Equip_Length }} | <b>W</b>{{ $vehcile->Equip_Width }}
                                            |
                                            <b>H</b>{{ $vehcile->Equip_Height }} | {{ $vehcile->Equip_Weight }}
                                            <b>LBS</b>
                                        </td>
                                        <td class="text-center">{{ $vehcile->Shipment_Preferences }}</td>
                                        <td class="text-center">{{ $vehcile->Equipment_Condition }}</td>
                                        <td class="text-center">{{ $vehcile->Trailer_Type }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                @if (count($Lisiting->all_listing->dry_vans) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped text-center">
                            <thead>
                                <tr>
                                    <th colspan="6" class="text-center"><b>Dry Van(s) Information</b></th>
                                </tr>
                                <tr>
                                    <th>Freight Class</th>
                                    <th>Freight Weight</th>
                                    <th>Hazmat?</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Lisiting->all_listing->dry_vans as $vehcile)
                                    <tr>
                                        <td class="text-center">{{ $vehcile->Freight_Class }}</td>
                                        <td class="text-center">{{ $vehcile->Freight_Weight }}</td>
                                        <td class="text-center">{{ $vehcile->is_hazmat_Check === 1 ? 'Yes' : 'No' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                <h5 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                    <i class="bi bi-hash mr-2"></i> Payment Information
                </h5>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            {{-- <tr>
                                <th colspan="3" class="text-center"><b>Payment Information</b></th>
                            </tr> --}}
                            <tr>
                                <th>Miscellaneous Name</th>
                                <th>Item Price</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $subTotal = 0;
                                $grandTotal = 0;
                            @endphp
                            {{-- Status 1 is approved, 0 is not approved yet, 2 is rejected --}}
                            @forelse($Lisiting->all_listing->miscellenous as $misc)
                                @if ($misc->status == 1)
                                    <tr>
                                        <td>{{ !empty($misc->Other) ? $misc->Other : $misc->Item_Name }}</td>
                                        <td>$ {{ number_format((float) $misc->Item_Price) }}</td>
                                        <td> {{ date('M d, Y', strtotime($misc->created_at)) }}</td>
                                    </tr>
                                    @php
                                        $subTotal += $misc->Item_Price;
                                    @endphp
                                @endif
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Miscellaneous Item(s) are not Added.</td>
                                </tr>
                            @endforelse
                            <tr>
                                <td colspan="3" class="text-center"><b>**The company (broker, dealer, auction, rental
                                        company, etc.) that originated this dispatch sheet.</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row justify-content-between">
                    <div class="col-auto">
                        <div class="invoice-left">
                            <b>Payment Info:</b>
                            <p class="mb-0">Listed Price:
                                ${{ $Lisiting->all_listing->paymentinfo->Price_Pay_Carrier }}<br></p>
                            <p class="mb-0">Payment Method:
                                {{ $Lisiting->all_listing->paymentinfo->COD_Method_Mode }}<br></p>

                            {{-- <div class="PaymentInfo col-sm-12"> --}}
                                {{-- <p class="alert alert-danger codPayor"><span class="codPayorText">The carrier will
                                        receive <b>${{ $Lisiting->all_listing->paymentinfo->COD_Amount }}</b> via
                                        <b>{{ $Lisiting->all_listing->paymentinfo->COD_Method_Mode }} /
                                            {{ $Lisiting->all_listing->paymentinfo->Payment_Method_Mode }}</b> at
                                        <b>{{ $Lisiting->all_listing->paymentinfo->COD_Location_Amount }}</b></span>
                                </p> --}}
                                @if ($Lisiting->all_listing->paymentinfo->PaymentInfo != null)
                                    {!! $Lisiting->all_listing->paymentinfo->PaymentInfo !!}
                                @endif
                                @if ($Lisiting->all_listing->paymentinfo->BalPaymentInfo != null)
                                    {!! $Lisiting->all_listing->paymentinfo->BalPaymentInfo !!}
                                @endif
                            {{-- </div> --}}
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="table-responsive">
                            <table class="total-table">
                                <tbody>
                                    <tr>
                                        <th>Sub Total:</th>
                                        <td>$ {{ $subTotal }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pay To Carrier:</th>
                                        <td>$ {{ $Lisiting->all_listing->paymentinfo->Price_Pay_Carrier }}</td>
                                    </tr>
                                    <tr>
                                        <th>COD/COP:</th>
                                        <td>$ {{ $Lisiting->all_listing->paymentinfo->COD_Amount }}</td>
                                    </tr>
                                    {{-- @php
                                        $grandTotal =
                                            $subTotal +
                                            (int) \Illuminate\Support\Str::replace(
                                                ['$ ', ','],
                                                '',
                                                $Lisiting->all_listing->paymentinfo->Price_Pay_Carrier,
                                            ) -
                                            (int) \Illuminate\Support\Str::replace(
                                                ['$ ', ','],
                                                '',
                                                $Lisiting->all_listing->paymentinfo->COD_Amount,
                                            );
                                    @endphp --}}
                                    @php
                                        $grandTotal =
                                            $subTotal +
                                            (int) \Illuminate\Support\Str::replace(
                                                ['$ ', ','],
                                                '',
                                                $Lisiting->all_listing->paymentinfo->Price_Pay_Carrier,
                                            ) -
                                            (int) \Illuminate\Support\Str::replace(
                                                ['$ ', ','],
                                                '',
                                                $Lisiting->all_listing->paymentinfo->COD_Amount,
                                            );
                                        $grandTotal = abs($grandTotal);
                                    @endphp
                                    <tr>
                                        <th>Balance:</th>
                                        <td>${{ number_format($grandTotal) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <h5 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                            <i class="bi bi-hash mr-2"></i> Bill Of Lading
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-striped ">
                                {{-- <thead>
                                    <tr>
                                        <th colspan="4" class=""><b>Bill Of Lading</b></th>
                                    </tr>
                                    <tr>
                                        <th>Meter Reading</th>
                                        <th>PickUp / Deliver Info</th>
                                        <th>BOL Submit Info</th>
                                        <th>BOL Attachment</th>
                                    </tr>
                                </thead> --}}
                                <tbody>
                                    @forelse($Lisiting->all_listing->bol as $lading)
                                        <tr>
                                            <td><b>Meter Reading</b></td>
                                            <td>{{ number_format($lading->Meter_Reading) }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>PickUp / Deliver Info</b></td>
                                            <td>
                                                @if (!is_null($lading->is_person_available))
                                                    <b>Available Person: </b>{{ $lading->is_person_available }}<br>
                                                @endif
                                                <b>Location: </b>{{ $lading->Pickup_Location }}<br>
                                                <b>Name: </b>{{ $lading->Pickup_Person }}<br>
                                                <b>Contact: </b>{{ $lading->Phone_Number }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>BOL Submit Info</b></td>
                                            <td>
                                                <b>Bol Name: </b>{{ $lading->BOL_Name }}<br>
                                                <b>Signature: </b>{{ $lading->BOL_Signature }}<br>
                                                <b>Submit: </b>{{ $lading->Bol_Type }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>BOL Attachment</b></td>
                                            <td>
                                                @forelse($lading->bol_attachments as $attach)
                                                    <a href="{{ $attach->Bill_Lading_Name ? url($attach->Bill_Lading_Name) : '' }}"
                                                        target="_blank">View BOL</a> <br>
                                                @empty
                                                    No Attachments
                                                @endforelse
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Bill Of Ladings are Not Attached.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h5 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                            <i class="bi bi-hash mr-2"></i> Order Tracking History
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    {{-- <tr>
                                        <th colspan="2" class="text-center"><b>Order Tracking History</b></th>
                                    </tr> --}}
                                    <tr>
                                        <th>Order Status</th>
                                        <th>Order Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($Lisiting->all_listing->history as $record)
                                        <tr>
                                            <td>{{ $record->status }}</td>
                                            <td>{{ $record->created_at }}</td>
                                        </tr>
                                        @if ($record->status === 'Cancelled')
                                            @if (!empty($Lisiting->all_listing->cancel))
                                                <tr>
                                                    <td colspan="2" class="text-center"><strong>Cancellation Order
                                                            Reason</strong><br>
                                                        {{ $Lisiting->all_listing->cancel->Main_Reason }} <br>
                                                        {{ $Lisiting->all_listing->cancel->Detail_Reason }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endif
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center">Order Tracking History Not Found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <h5 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                            <i class="bi bi-hash mr-2"></i> Additionals
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td class="border-bottom"><b>Additional Terms</b></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ $Lisiting->all_listing->additional_info->Additional_Terms }}</td>
                                    </tr>

                                    <tr>
                                        <td class="border-bottom"><b>Special Instructions</b></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ $Lisiting->all_listing->additional_info->Special_Instructions }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-bottom"><b>Notes From Customer</b></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ $Lisiting->all_listing->additional_info->Notes_Customer }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-bottom"><b>Contract Terms: <i class="fa fa-exclamation"></i>
                                                PLEASE READ CAREFULLY!</b></td>
                                    </tr>
                                    <tr>
                                        <td>{{ $Lisiting->all_listing->additional_info->Contract }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                {{-- <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th colspan="3" class="text-center"><b>Order Update History</b></th>
                            </tr>
                            <tr>
                                <th>Old Value</th>
                                <th>New Value</th>
                                <th>Modified Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($History->all_listing->update_history as $record)
                                <tr>
                                    <td>
                                        @foreach (json_decode($record['Old_Meta_Data'], true, 512, JSON_THROW_ON_ERROR) as $key => $value)
                                            @continue(empty($value))
                                            <strong>{{ $key }}:</strong> {{ $value }}<br>
                                        @endforeach
                                    </td>
                                    <td style=" overflow-wrap: anywhere;">
                                        @foreach (json_decode($record['New_Meta_Data'], true, 512, JSON_THROW_ON_ERROR) as $key => $value)
                                            @continue(empty($value))
                                            <strong>{{ $key }}:</strong> {{ $value }}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        {{ $record->created_at }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> --}}
                @if (count($Lisiting->all_listing->attachments) > 0)
                    <div class="gallery-area mt-5">
                        <div class="row g-3">
                            @foreach ($Lisiting->all_listing->attachments as $attachments)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="single-gallery-image mb-4 position-relative">
                                        <img src="{{ asset($attachments->Image_Name) }}" alt="Gallery Image"
                                            class="img-fluid rounded shadow"
                                            style="object-fit: cover; height: 250px; width: 100%;">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="mt-4">
                    {{-- <p class="" style="overflow-wrap: anywhere; line-height: 1.6;">
                        <b>Contract Terms: <i class="fa fa-exclamation"></i> PLEASE READ CAREFULLY!</b><br>
                        {{ $Lisiting->all_listing->additional_info->Contract }}
                    </p> --}}
                    {{-- <p class="">
                        <b>Address:</b><br>
                        {{ $Lisiting->all_listing->authorized_user->Address }}
                    </p> --}}
                </div>
                <div class="invoice-buttons mt-4 d-flex justify-content-end">
                    <button class="print_btn btn btn-primary d-flex align-items-center gap-2 px-4 py-2">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                        </svg>
                        <span>Print</span>
                    </button>
                    <button id="download_btn"
                        class="download_btn btn btn-success d-flex align-items-center gap-2 px-4 py-2">
                        <svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                        </svg>
                        <span>Download</span>
                    </button>
                </div>
                <div class="mt-5 p-3 border border-danger rounded" style="background-color: #fff4f4;">
                    <strong style="color: #ff0000;">Note:</strong>
                    <p class="mt-2" style="font-size: 0.9rem;">
                        Day Dispatch (PLATFORM) connects carriers with brokers and shippers but is not responsible for
                        mishaps. Shippers
                        should verify documents and secure insurance. Carriers are responsible for safe transport and
                        compliance. All
                        parties should exercise caution and communicate effectively.
                    </p>
                </div>
                {{-- @if (count($Lisiting->all_listing->attachments) > 0)
                    <div class="gallery-area">
                        <div class="row">
                            @foreach ($Lisiting->all_listing->attachments as $attachments)
                                <div class="col-lg-4 col-sm-6 col-md-6">
                                    <div class="single-gallery-image mb-30">
                                        <img src="{{ asset($attachments->Image_Name) }}" alt="Gallery Image"
                                            data-original="{{ asset($attachments->Image_Name) }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <p class="company-address style2 text-justify" style=" overflow-wrap: anywhere;">
                    <b>Contract Terms: <i class="fa fa-exclamation"></i> PLEASE READ CAREFULLY!</b><br>
                    {{ $Lisiting->all_listing->additional_info->Contract }}
                </p>
                <p class="company-address style2">
                    <b>Address:</b><br>{{ $Lisiting->all_listing->authorized_user->Address }}
                </p>
                </div>
                <div class="invoice-buttons">
                    <button class="print_btn">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11.9688 8.46875C12.1146 8.32292 12.2917 8.25 12.5 8.25C12.7083 8.25 12.8854 8.32292 13.0312 8.46875C13.1771 8.61458 13.25 8.79167 13.25 9C13.25 9.20833 13.1771 9.38542 13.0312 9.53125C12.8854 9.67708 12.7083 9.75 12.5 9.75C12.2917 9.75 12.1146 9.67708 11.9688 9.53125C11.8229 9.38542 11.75 9.20833 11.75 9C11.75 8.79167 11.8229 8.61458 11.9688 8.46875ZM13.5 5.5C14.1875 5.5 14.7708 5.75 15.25 6.25C15.75 6.72917 16 7.3125 16 8V12C16 12.1458 15.9479 12.2708 15.8438 12.375C15.7604 12.4583 15.6458 12.5 15.5 12.5H13.5V15.5C13.5 15.6458 13.4479 15.7604 13.3438 15.8438C13.2604 15.9479 13.1458 16 13 16H3C2.85417 16 2.72917 15.9479 2.625 15.8438C2.54167 15.7604 2.5 15.6458 2.5 15.5V12.5H0.5C0.354167 12.5 0.229167 12.4583 0.125 12.375C0.0416667 12.2708 0 12.1458 0 12V8C0 7.3125 0.239583 6.72917 0.71875 6.25C1.21875 5.75 1.8125 5.5 2.5 5.5V1C2.5 0.729167 2.59375 0.5 2.78125 0.3125C2.96875 0.104167 3.1875 0 3.4375 0H10.375C10.7917 0 11.1458 0.145833 11.4375 0.4375L13.0625 2.0625C13.3542 2.35417 13.5 2.70833 13.5 3.125V5.5ZM4 1.5V5.5H12V3.5H10.5C10.3542 3.5 10.2292 3.45833 10.125 3.375C10.0417 3.27083 10 3.14583 10 3V1.5H4ZM12 14.5V12.5H4V14.5H12ZM14.5 11V8C14.5 7.72917 14.3958 7.5 14.1875 7.3125C14 7.10417 13.7708 7 13.5 7H2.5C2.22917 7 1.98958 7.10417 1.78125 7.3125C1.59375 7.5 1.5 7.72917 1.5 8V11H14.5Z"
                                fill="white" />
                        </svg>
                        <span>Print</span>
                    </button>
                    <button id="download_btn" class="download_btn">
                        <svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16.5 9C16.9167 9 17.2708 9.14583 17.5625 9.4375C17.8542 9.72917 18 10.0833 18 10.5V14.5C18 14.9167 17.8542 15.2708 17.5625 15.5625C17.2708 15.8542 16.9167 16 16.5 16H1.5C1.08333 16 0.729167 15.8542 0.4375 15.5625C0.145833 15.2708 0 14.9167 0 14.5V10.5C0 10.0833 0.145833 9.72917 0.4375 9.4375C0.729167 9.14583 1.08333 9 1.5 9H4.375L2.9375 7.5625C2.47917 7.08333 2.375 6.54167 2.625 5.9375C2.875 5.3125 3.33333 5 4 5H6V1.5C6 1.08333 6.14583 0.729167 6.4375 0.4375C6.72917 0.145833 7.08333 0 7.5 0H10.5C10.9167 0 11.2708 0.145833 11.5625 0.4375C11.8542 0.729167 12 1.08333 12 1.5V5H14C14.6667 5 15.125 5.3125 15.375 5.9375C15.6458 6.54167 15.5417 7.08333 15.0625 7.5625L13.625 9H16.5ZM4 6.5L9 11.5L14 6.5H10.5V1.5H7.5V6.5H4ZM16.5 14.5V10.5H12.125L10.0625 12.5625C9.77083 12.8542 9.41667 13 9 13C8.58333 13 8.22917 12.8542 7.9375 12.5625L5.875 10.5H1.5V14.5H16.5ZM13.9688 13.0312C13.8229 12.8854 13.75 12.7083 13.75 12.5C13.75 12.2917 13.8229 12.1146 13.9688 11.9688C14.1146 11.8229 14.2917 11.75 14.5 11.75C14.7083 11.75 14.8854 11.8229 15.0312 11.9688C15.1771 12.1146 15.25 12.2917 15.25 12.5C15.25 12.7083 15.1771 12.8854 15.0312 13.0312C14.8854 13.1771 14.7083 13.25 14.5 13.25C14.2917 13.25 14.1146 13.1771 13.9688 13.0312Z"
                                fill="white" />
                        </svg>
                        <span>Download</span>
                    </button>
                </div>
                <div>
                    <div class="p2">
                        <strong style="color: #ff0000;">Note:</strong>
                        <p>
                            Day Dispatch (PLATFORM) connects carriers with brokers and shippers but is not responsible for
                            mishaps. Shippers should verify documents and secure insurance. Carriers are responsible for safe
                            transport and compliance. All parties should exercise caution and communicate effectively.
                        </p>
                    </div>
                </div> --}}
            </div>
    </main>
    <script>
        $('.print_btn').click(function() {
            const mainContent = $('main').html();
            const printWindow = window.open('', '_blank');
            const printPage = `
            <!DOCTYPE html>
            <html class="no-js" lang="en">
            <head>
                <meta charset="utf-8">
                <meta http-equiv="x-ua-compatible" content="ie=edge">
                <title>Order Agreement | Day Dispatch</title>
                <meta name="author" content="Muhammad Yasir Amin">
                <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
                <!-- Place favicon.ico in the root directory -->
                <link rel="shortcut icon" type="image/x-icon" href="https://daydispatch.com/frontend/img/favicon.png">
                <meta name="theme-color" content="#ffffff" >
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
                    rel="stylesheet">
                <link rel="stylesheet" href="https://daydispatch.com/invoice/css/app.min.css">
                <link rel="stylesheet" href="https://daydispatch.com/invoice/css/style.css">
            </head>
            <body>
                <div class="invoice-container-wrap">
                    <div class="invoice-container">
                    ${mainContent}
                    </div>
                </div>
            </body>
            </html>`;
            printWindow.document.write(printPage);
            printWindow.document.close();
            printWindow.print();
        });
        document.getElementById('download_btn').addEventListener('click', async function() {
            const pdf = await window.print();
        });
    </script>
