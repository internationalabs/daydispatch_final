<style>
    .p2 {
        padding: 20px;
    }
</style>
{{-- Perfect Layout --}}
<main style="border-radius: 30px;padding: 30px;background: #ffffff;z-index;box-shadow: 0px 0px 11px 1px #113771;red;">
    <div class="as-invoice invoice_style4">
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
                                        <td><b>Name: </b>{{ $Lisiting->all_listing->authorized_user->Company_Name }}</td>
                                        <td><b>Contact Phone:</b> {{ $Lisiting->all_listing->driver->Driver_Phone ?? 'null' }} </td>
                                    </tr>
                                    <tr>    
                                        <td><b>Phone No: </b{{ $Lisiting->all_listing->authorized_user->Contact_Phone }}</td>
                                        <td><b>Phone:</b> {{ $Lisiting->all_listing->driver->Driver_Phone ?? 'null' }} </td>
                                    </tr>
                                    <tr>
                                        <td><b>ICCMC:</b> {{ $Lisiting->all_listing->authorized_user->Mc_Number }}</td>
                                        <td><b>Agent Phone:</b> {{ $Lisiting->all_listing->driver->Driver_Phone ?? 'null' }} </td>
                                    </tr>
                                    <tr>
                                        <td><b>Address: </b>{{ $Lisiting->all_listing->authorized_user->Address }}</td>
                                        <td><b>Driver Phone:</b> {{ $Lisiting->all_listing->driver->Driver_Phone ?? 'null' }} </td>
                                    </tr>
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
                                <tr>
                                    <th>General Information</th>
                                    <th>Contact Information</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>Company Name: </b>{{ $Lisiting->waiting_users->Company_Name }}</td>
                                    <td><b>Contact Phone: </b>{{ $Lisiting->waiting_users->Contact_Phone }}</td>
                                </tr>
                                <tr>
                                    <td><b>Address: </b>{{ $Lisiting->waiting_users->Address }}</td>
                                    <td><b>Phone: </b>{{ $Lisiting->waiting_users->Local_Phone }}</td>
                                </tr>
                                <tr>
                                    <td><b>MC Number: </b>{{ $Lisiting->waiting_users->Mc_Number }}</td>
                                    <td><b>Agent Phone: </b>{{ $Lisiting->waiting_users->Agent_Phone }}</td>
                                </tr>
                                <tr>
                                    <td><b>Driver Name: </b>{{ $Lisiting->all_listing->driver->Driver_Name }}</td>
                                    <td><b>Driver Phone: </b>{{ $Lisiting->all_listing->driver->Driver_Phone }}
                                    </td>
                                </tr>
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
                                        {{-- <tr>
                                            <th colspan="6" class="text-center"><b>Vehicle(s) Information</b></th>
                                        </tr> --}}
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
                                            <td> {{ $vehcile->Vehcile_Year . " " . $vehcile->Vehcile_Make . " " . $vehcile->Vehcile_Model }} </td>
                                            <td>{{ $vehcile->Vin_Number }}</td>
                                            <td> {{ $vehcile->Vehcile_Type }}</td>
                                            <td> {{ $vehcile->Vehcile_Condition === '' ? 'Running' : $vehcile->Vehcile_Condition }}</td>
                                            <td> {{ $vehcile->Trailer_Type === '' ? 'Open' : $vehcile->Trailer_Type }}</td>
                                        </tr>
                                        {{-- <tr> --}}
                                            {{-- <td> {{ $vehcile->Vehcile_Condition === '' ? 'Running' : $vehcile->Vehcile_Condition }}</td>
                                            <td> {{ $vehcile->Trailer_Type === '' ? 'Open' : $vehcile->Trailer_Type }}</td> --}}
                                            {{-- <td></td> --}}
                                        {{-- </tr> --}}
                                        {{-- <tr>
                                            <th>Year Make Model</th>
                                            <td class="">{{ $vehcile->Vehcile_Year }}
                                                {{ $vehcile->Vehcile_Make }}
                                                {{ $vehcile->Vehcile_Model }}</td>
                                        </tr>
                                        <tr>
                                            <th>Vin No.</th>
                                            <td class="">{{ $vehcile->Vin_Number }}</td>
                                        </tr>
                                        <tr>
                                            <th>Title</th>
                                            <td class="">-</td>
                                        </tr>
                                        <tr>
                                            <th>Type</th>
                                            <td class="">{{ $vehcile->Vehcile_Type }}</td>
                                        </tr>
                                        <tr>
                                            <th>Condition</th>
                                            <td class="">
                                                {{ $vehcile->Vehcile_Condition === '' ? 'Running' : $vehcile->Vehcile_Condition }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Trailer Type</th>
                                            <td class="">
                                                {{ $vehcile->Trailer_Type === '' ? 'Open' : $vehcile->Trailer_Type }}
                                            </td>
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
                                    <td><b>Name:
                                        </b>{{ $Lisiting->all_listing->listing_origin_location->User_Name }}</td>
                                </tr>
                                <tr>
                                    <td><b>Email Address:
                                        </b>{{ $Lisiting->all_listing->listing_origin_location->User_Email }}</td>
                                </tr>
                                <tr>
                                    <td><b>Phone Number:
                                        </b>{{ $Lisiting->all_listing->listing_origin_location->Local_Phone }}</td>
                                </tr>
                                @if (!empty($Lisiting->all_listing->listing_origin_location->Location))
                                    <tr>
                                        <td><b>Location Type:
                                            </b>{{ $Lisiting->all_listing->listing_origin_location->Location }}
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
                                            {{ $Lisiting->all_listing->listing_origin_location->Auction_Phone }}
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($Lisiting->all_listing->listing_origin_location->Stock_Number))
                                    <tr>
                                        <td><b>Buyer / Stock Number:
                                            </b>
                                            {{-- {{ $Lisiting->all_listing->listing_origin_location->Stock_Number }} --}}
                                            *********
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($Lisiting->all_listing->listing_origin_location->Business_Phone))
                                    <tr>
                                        <td><b>Business Phone:
                                            </b>{{ $Lisiting->all_listing->listing_origin_location->Business_Phone }}
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($Lisiting->all_listing->listing_origin_location->Business_Location))
                                    <tr>
                                        <td><b>Business Location:
                                            </b>{{ $Lisiting->all_listing->listing_origin_location->Business_Location }}
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
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
                                        </b>{{ $Lisiting->all_listing->listing_destination_locations->Dest_User_Name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Email Address:
                                        </b>{{ $Lisiting->all_listing->listing_destination_locations->Dest_User_Email }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Phone Number:
                                        </b>{{ $Lisiting->all_listing->listing_destination_locations->Dest_Local_Phone }}
                                    </td>
                                </tr>
                                @if (!empty($Lisiting->all_listing->listing_destination_locations->Dest_Location))
                                    <tr>
                                        <td><b>Location Type:
                                            </b>{{ $Lisiting->all_listing->listing_destination_locations->Dest_Location }}
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
                                            {{ $Lisiting->all_listing->listing_destination_locations->Dest_Auction_Phone }}
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($Lisiting->all_listing->listing_destination_locations->Dest_Stock_Number))
                                    <tr>
                                        <td><b>Buyer / Stock Number:
                                            </b>
                                            {{-- {{ $Lisiting->all_listing->listing_destination_locations->Dest_Stock_Number }} --}}
                                            *********
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($Lisiting->all_listing->listing_destination_locations->Dest_Business_Phone))
                                    <tr>
                                        <td><b>Business Phone:
                                            </b>{{ $Lisiting->all_listing->listing_destination_locations->Dest_Business_Phone }}
                                        </td>
                                    </tr>
                                @endif
                                @if (!empty($Lisiting->all_listing->listing_destination_locations->Dest_Business_Location))
                                    <tr>
                                        <td><b>Business Location:
                                            </b>{{ $Lisiting->all_listing->listing_destination_locations->Dest_Business_Location }}
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
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

                        {{-- <div class="PaymentInfo col-sm-12">
                            <p class="alert alert-danger codPayor"><span class="codPayorText">The carrier will
                                    receive <b>${{ $Lisiting->all_listing->paymentinfo->COD_Amount }}</b> via
                                    <b>{{ $Lisiting->all_listing->paymentinfo->COD_Method_Mode }} /
                                        {{ $Lisiting->all_listing->paymentinfo->Payment_Method_Mode }}</b> at
                                    <b>{{ $Lisiting->all_listing->paymentinfo->COD_Location_Amount }}</b></span>
                            </p>
                        </div> --}}
                        @if ($Lisiting->all_listing->paymentinfo->PaymentInfo != null)
                            {!! $Lisiting->all_listing->paymentinfo->PaymentInfo !!}
                        @endif
                        @if ($Lisiting->all_listing->paymentinfo->BalPaymentInfo != null)
                            {!! $Lisiting->all_listing->paymentinfo->BalPaymentInfo !!}
                        @endif
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
                            <tbody>
                                @forelse($Lisiting->all_listing->bol as $lading)
                                    <tr>
                                        <th>Meter Reading</th>
                                        <td>{{ number_format($lading->Meter_Reading) }}</td>
                                    </tr>
                                    <tr>
                                        <th>PickUp / Deliver Info</th>
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
                                        <th>BOL Submit Info</th>
                                        <td>
                                            <b>Bol Name: </b>{{ $lading->BOL_Name }}<br>
                                            <b>Signature: </b>{{ $lading->BOL_Signature }}<br>
                                            <b>Submit: </b>{{ $lading->Bol_Type }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>BOL Attachment</th>
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
                                    <th class="text-center">Additional Terms</th>
                                </tr>
                                <tr>
                                    <td class="">
                                        {{ $Lisiting->all_listing->additional_info->Additional_Terms }}</td>
                                </tr>

                                <tr>
                                    <th class="text-center">Special Instructions</th>
                                </tr>
                                <tr>
                                    <td class="">
                                        {{ $Lisiting->all_listing->additional_info->Special_Instructions }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center">Notes From Customer</th>
                                </tr>
                                <tr>
                                    <td class="">
                                        {{ $Lisiting->all_listing->additional_info->Notes_Customer }}</td>
                                </tr>
                                <tr>
                                    <th class="text-center"><b>Contract Terms: <i class="fa fa-exclamation"></i>
                                            PLEASE READ CAREFULLY!</b></th>
                                </tr>
                                <tr>
                                    <td class="">{{ $Lisiting->all_listing->additional_info->Contract }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
            </div>
            <div class="invoice-buttons mt-4 d-flex justify-content-end">
                <button class="print_btn btn btn-primary d-flex align-items-center gap-2 px-4 py-2">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <!-- SVG Path here -->
                    </svg>
                    <span>Print</span>
                </button>

                <button id="download_btn"
                    class="download_btn btn btn-success d-flex align-items-center gap-2 px-4 py-2">
                    <svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <!-- SVG Path here -->
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
        </div>
    </div>
</main>
<script>
    $('.print_btn').click(function() {
        // Get the content of the main tag
        const mainContent = $('main').html();

        // Create a new window with the main content
        const printWindow = window.open('', '_blank');

        // language=HTML
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