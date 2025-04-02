@if ($Agreement)
    <style>
        .invoice-buttons .download_btn {
            border-radius: 0 !important;
        }

        .save_btn {
            background-color: #010F1C;
            border-radius: 0 99px 99px 0;
        }

        .agreement-note {
            border-top: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .sign {
            padding: 19px 15px 12px 38px;
            font-size: 30px;
            line-height: 30px;
            color: #000;
            background: #fff;
            border: 1px solid #000;
        }

        .sign1 {
            font-family: 'Shadows Into Light', cursive;
            font-weight: bold;
        }

        .sign2 {
            font-family: 'Rock Salt', cursive;
            font-weight: bold;
        }

        .sign3 {
            font-family: 'Jazz LET, fantasy';
            font-weight: bold;
        }

        .sign4 {
            font-family: 'prestige';
            font-size: 36px;
            font-weight: bold;
        }
    </style>
@endif
<!-- Include Viewer.js CSS and JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.1/viewer.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.1/viewer.min.js"></script>
<style>
    /*
    Payment Selector
    */
    * {
        font-family: "Nunito-Sans", sans-serif;
        /* font-family: 'Nunito', sans-serif; */
        transition: all 0.15s ease;
        position: relative;
    }

    .container {
        margin: 0 auto;
        width: 90%;
    }

    .flex-container {
        display: block;
    }

    @media (min-width: 800px) {
        .flex-container {
            display: flex;
        }
    }

    .payment-method {
        margin-bottom: 2rem;
    }

    .checkout {
        font-size: 1.25rem;
        border: none;
    }

    .checkout input {
        font-size: 1.25rem;
        padding: 0.75rem 1rem;
        border-radius: 5px;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .checkout input,
    .checkout select {
        margin-right: 1rem;
        margin-bottom: 1rem;
    }

    .checkout select {
        font-size: 1.25rem;
        height: 3rem;
        border-radius: 5px;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .checkout-radio-group:hover {
        border: 0px solid rgba(0, 0, 0, 0.35);
    }

    .checkout-radio-group input.payment-type,
    .checkout-radio-group .payment-type-label,
    .checkout-radio-group .payment-type-img {
        margin: 0;
        padding: 0;
        line-height: 1;
        vertical-align: middle;
        cursor: pointer;
    }

    .checkout-radio-group input.payment-type {
        margin-right: 0.5rem;
    }

    .checkout-radio-group .payment-type-label {
        margin-left: 0.5rem;
    }

    .checkout-radio-group .payment-type-img {
        max-height: 30px;
        text-align: center;
        vertical-align: middle;
    }

    .checkout-radio-group {
        margin-bottom: 1rem;
        border: 0px solid rgba(0, 0, 0, 0.15);
        border-radius: 5px;
        padding: 1.2rem;
        display: block;
        /* background: #fff;*/
        background: #e1ecf4;
        color: #336380;
        text-align: center;
        cursor: pointer;
        -moz-transition: all 10ms ease-in-out;
        -o-transition: all 10ms ease-in-out;
        -webkit-transition: all 10ms ease-in-out;
        transition: all 10ms ease-in-out;
    }

    @media (min-width: 800px) {
        .checkout-radio-group {
            margin-bottom: 1rem;
            margin-right: 1rem;
            display: flex 1;
            flex: 1;
            align-items: flex-end;
        }

        .checkout-radio-group:last-of-type {
            margin-right: 0;
        }
    }

    .checkout-radio-group span {
        margin: 0;
        margin-right: 8px;
        margin-left: 8px;
        padding: 0;
        line-height: 0;
        vertical-align: middle;
    }

    element.style {}

    .checkout-radio-group input.payment-type {
        margin-right: 0.5rem;
    }

    .checkout-radio-group input.payment-type,
    .checkout-radio-group .payment-type-label,
    .checkout-radio-group .payment-type-img {
        margin: 0;
        padding: 0;
        line-height: 1;
        vertical-align: middle;
    }

    .checkout-radio-group input.payment-type {
        margin-right: 0.5rem;
        display: none;
    }

    .checkout-radio-group input.payment-type,
    .checkout-radio-group .payment-type-label,
    .checkout-radio-group .payment-type-img {
        margin: 0;
        padding: 0;
        line-height: 1;
        vertical-align: middle;
    }

    .payment-method-content.active,
    .shipping-address.active,
    .billing-address.active {
        display: block;
        visibility: visible;
        -webkit-animation: slide-down 0.3s ease-out;
        -moz-animation: slide-down 0.3s ease-out;
    }

    .checkout-radio-group.active {
        border-color: #40b3ff;
        background: #336380;
        color: #fff;
    }

    .checkout-radio-group.active {
        color: #fff;
    }
</style>
<main style="border-radius: 30px;padding: 30px;background: #ffffff;z-index;box-shadow: 0px 0px 11px 1px #113771;red;">
    <div class="as-invoice invoice_style4">
        <!--<div class="template_shape1"><img src="{{ asset('invoice/img/template/car_road.png') }}" alt="car road"></div>-->
        <div class="download-inner p-0" id="download_section">
            <header class="as-header header-layout4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <div class="header-logo"><a href="{{ route('User.Dashboard') }}"><img
                                    src="{{ asset('frontend/img/logo/logo.png') }}" alt="Day Dispatch Logo"></a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <h1 class="big-title" style="color:#e01f26;">View Dispatch </h1>
                        <span><b>Reference ID: </b>#{{ $Lisiting->Ref_ID }}</span>
                        <span><b>Current Status: </b>{{ $Lisiting->Listing_Status }}</span>
                        <span><b>Last Modified: </b>{{ $Lisiting->updated_at }}</span>
                    </div>
                </div>
            </header>
            @if ($Lisiting->Listing_Status !== 'Waiting For Approval')
                <div class="row justify-content-between mb-4">
                    <div class="col-auto">
                        <div class="invoice-left">
                            <span class="fs-5" style="color:#e01f26;">Pick-Up Information</span>
                            <address>
                                <b>Date: </b> {{ $Lisiting->pickup_delivery_info->Pickup_Date }}
                                ({{ $Lisiting->pickup_delivery_info->Pickup_Date_mode }})<br>
                                <b>Address: </b>{{ $Lisiting->routes->Origin_Address }}
                                {!! !empty($Lisiting->routes->Origin_Address_II) ? ',<br>' . $Lisiting->routes->Origin_Address_II : '' !!}
                                <br>
                                <b>ZipCode: </b>{{ $Lisiting->routes->Origin_ZipCode }}
                            </address>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="invoice-middle">
                            <span class="fs-5" style="color:#e01f26;">Delivery Information</span>
                            <address>
                                <b>Date: </b> {{ $Lisiting->pickup_delivery_info->Delivery_Date }}
                                ({{ $Lisiting->pickup_delivery_info->Delivery_Date_mode }})<br>
                                <b>Address: </b>{{ $Lisiting->routes->Destination_Address }}
                                {!! !empty($Lisiting->routes->Destination_Address_II) ? ',<br>' . $Lisiting->routes->Destination_Address_II : '' !!}
                                <br>
                                <b>ZipCode: </b>{{ $Lisiting->routes->Dest_ZipCode }}
                            </address>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="invoice-right"><b>Dispatch From:</b>
                            <address>
                                <b>Name: </b> {{ $Lisiting->authorized_user->Company_Name }}<br>
                                <b>Phone No.: </b>{{ $Lisiting->authorized_user->Contact_Phone }}<br>
                                <b>ICC-MC: </b>{{ $Lisiting->authorized_user->Mc_Number }}
                            </address>
                        </div>
                    </div>
                </div>
            @endif
            @if (!empty($Lisiting->driver))
                <div class="table-responsive">
                    <h5 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                        <i class="bi bi-hash mr-2"></i> Driver Info
                    </h5>
                    <table class="table table-striped">
                        <thead>
                            {{-- <tr>
                                <th colspan="3" class="text-center text-white">Driver Info</th>
                            </tr> --}}
                            <tr>
                                <th>Full Name</th>
                                <th>Email Address</th>
                                <th>Phone Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $Lisiting->driver->Driver_Name ?? 'N/A' }}</td>
                                <td>{{ $Lisiting->driver->Driver_Email ?? 'N/A' }}</td>
                                <td>{{ $Lisiting->driver->Driver_Phone ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif
            <div class="table-responsive">
                <h5 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                    <i class="bi bi-hash mr-2"></i> Terminal, Dealer, Auction
                </h5>
                <table class="table table-striped">
                    <thead>
                        {{-- <tr>
                            <th colspan="2" class="text-center text-white">Terminal, Dealer, Auction</th>
                        </tr> --}}
                        <tr>
                            <th>Origin Location ({{ $Lisiting->listing_origin_location->Orign_Location ?? 'N/A' }})
                            </th>
                            <th>Destination Location
                                ({{ $Lisiting->listing_destination_locations->Destination_Location ?? 'N/A' }})
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>ZipCode: </b>{{ $Lisiting->routes->Origin_ZipCode }}</td>
                            <td><b>ZipCode: </b>{{ $Lisiting->routes->Dest_ZipCode }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">
                <h5 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                    <i class="bi bi-hash mr-2"></i> Dispatch To:
                </h5>
                <table class="table table-striped">
                    <thead>
                        {{-- <tr>
                            <th colspan="2" class="text-center text-white">Dispatch To</th>
                        </tr> --}}
                        <tr>
                            <th>General Information</th>
                            <th>Contact Information</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>Company Name: </b>{{ $Lisiting->waitings->waiting_users->Company_Name }}</td>
                            <td><b>Contact Phone: </b>{{ $Lisiting->waitings->waiting_users->Contact_Phone }}</td>
                        </tr>
                        <tr>
                            <td><b>Address: </b>{{ $Lisiting->waitings->waiting_users->Address }}</td>
                            <td><b>Phone: </b>{{ $Lisiting->waitings->waiting_users->Local_Phone }}</td>
                        </tr>
                        <tr>
                            <td><b>MC Number: </b>{{ $Lisiting->waitings->waiting_users->Mc_Number }}</td>
                            <td><b>Driver Phone: </b>{{ $Lisiting->waitings->waiting_users->Agent_Phone }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Status:
                                </b>{{ $Lisiting->Listing_Status === 'Waiting For Approval' ? 'Listed' : $Lisiting->Listing_Status }}
                            </td>
                        </tr>
                        @if (
                            !empty($Lisiting->all_listing->listing_origin_location->Business_Phone) ||
                                !empty($Lisiting->all_listing->listing_destination_locations->Dest_Business_Phone))
                            <tr>
                                <td><b>Business Phone:
                                    </b>{{ $Lisiting->all_listing->listing_origin_location->Business_Phone }}</td>
                                <td><b>Business Phone:
                                    </b>{{ $Lisiting->all_listing->listing_destination_locations->Dest_Business_Phone }}
                                </td>
                            </tr>
                        @endif
                        @if (
                            !empty($Lisiting->all_listing->listing_origin_location->Business_Location) ||
                                !empty($Lisiting->all_listing->listing_destination_locations->Dest_Business_Location))
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
            </div>
            @php
                $order_type = 0;
                $amount = 0;
                $V_Load = $Payment_Info->where('Payment_Type', 'Vehicle Load')->where('Payment_Switch', 0)->first();
                $H_Load = $Payment_Info->where('Payment_Type', 'Heavy Load')->where('Payment_Switch', 0)->first();
                $D_Load = $Payment_Info->where('Payment_Type', 'Dry Van Load')->where('Payment_Switch', 0)->first();
            @endphp
            @if (count($Lisiting->vehicles) > 0)
                @php
                    $order_type = 1;
                @endphp
                <div class="table-responsive">
                    <h5 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                        <i class="bi bi-hash mr-2"></i> Vehicle(s) Information
                    </h5>
                    <table class="table table-striped text-center">
                        <thead>
                            {{-- <tr>
                                <th colspan="6" class="text-center text-white">Vehicle(s) Information</th>
                            </tr> --}}
                            <tr>
                                <th>Year Make Model</th>
                                <th>Vin No.</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Condition</th>
                                <th>Trailer Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Lisiting->vehicles as $vehcile)
                                <tr>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            @if (count($Lisiting->heavy_equipments) > 0)
                @php
                    $order_type = 2;
                @endphp
                <div class="table-responsive">
                    <h5 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                        <i class="bi bi-hash mr-2"></i> Heavy Equipment(s) Information
                    </h5>
                    <table class="table table-striped text-center">
                        <thead>
                            {{-- <tr>
                                <th colspan="6" class="text-center text-white">Heavy Equipment(s) Information</th>
                            </tr> --}}
                            <tr>
                                <th>Year Make Model</th>
                                <th>Dimensions</th>
                                <th>Preference</th>
                                <th>Condition</th>
                                <th>Trailer Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Lisiting->heavy_equipments as $vehcile)
                                <tr>
                                    <td class="text-center">{{ $vehcile->Equipment_Year }}
                                        {{ $vehcile->Equipment_Make }}
                                        {{ $vehcile->Equipment_Model }}</td>
                                    <td class="text-center">
                                        {{ $vehcile->Equip_Length }} {{ $vehcile->Equip_Width }}
                                        {{ $vehcile->Equip_Height }} {{ $vehcile->Equip_Weight }}
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
            @if (count($Lisiting->dry_vans) > 0)
                @php
                    $order_type = 3;
                @endphp
                <div class="table-responsive">
                    <h5 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                        <i class="bi bi-hash mr-2"></i> Dry Van(s) Information
                    </h5>
                    <table class="table table-striped text-center">
                        <thead>
                            {{-- <tr>
                                <th colspan="6" class="text-center text-white">Dry Van(s) Information</th>
                            </tr> --}}
                            <tr>
                                <th>Freight Class</th>
                                <th>Freight Weight</th>
                                <th>Hazmat?</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Lisiting->dry_vans as $vehcile)
                                <tr>
                                    <td class="text-center">{{ $vehcile->Freight_Class }}</td>
                                    <td class="text-center">{{ $vehcile->Freight_Weight }}</td>
                                    <td class="text-center">{{ $vehcile->is_hazmat_Check === 1 ? 'Yes' : 'No' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            @if (count($Lisiting->dry_vans_services) > 0)
                <div class="table-responsive">
                    <h5 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                        <i class="bi bi-hash mr-2"></i> Dry Van(s) Services
                    </h5>
                    <table class="table table-striped text-center">
                        <thead>
                            {{-- <tr>
                                <th colspan="6" class="text-center text-white">Dry Van(s) Services</th>
                            </tr> --}}
                            <tr>
                                <th>Pickup Services</th>
                                <th>Delivery Services</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Lisiting->dry_vans_services as $Service)
                                <tr>
                                    <td class="text-center">{{ $Service->Pickup_Service }}</td>
                                    <td class="text-center">{{ $Service->Delivery_Service }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            <div class="table-responsive">
                <h5 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                    <i class="bi bi-hash mr-2"></i> Payment Information
                </h5>
                <table class="table table-striped">
                    <thead>
                        {{-- <tr>
                            <th colspan="3" class="text-center text-white">Payment Information</th>
                        </tr> --}}
                        <tr>
                            <th>Miscellaneous Name</th>
                            <th>Item Price</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- @php
                            $subTotal = 0;
                            $grandTotal = 0;
                        @endphp
                        @forelse($Lisiting->miscellenous as $misc)
<tr>
                                <td>{{ !empty($misc->Other) ? $misc->Other : $misc->Item_Name }}</td>
                                <td>$ {{ number_format((float) $misc->Item_Price) }}</td>
                                <td> {{ date('M d, Y', strtotime($misc->created_at)) }}</td>
                            </tr>
                            @php
                                $subTotal += $misc->Item_Price;
                            @endphp
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Miscellaneous Item(s) are not Added.</td>
                            </tr>
@endforelse
                        <tr>
                            <td colspan="3" class="text-center"><b>**The company (broker, dealer, auction, rental
                                    company, etc.) that originated this dispatch sheet.</b></td>
                        </tr> -->
                        <!-- add new work -->
                        @php
                            $subTotal = 0;
                            $grandTotal = 0;
                        @endphp
                        {{-- Status 1 is approved, 0 is not approved yet, 2 is rejected --}}
                        @forelse($Lisiting->miscellenous as $misc)
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
                        <!-- end new work -->
                    </tbody>
                </table>
            </div>
            <div class="row justify-content-between">
                <div class="col-auto">
                    <div class="invoice-left"><b>Payment Info:</b>
                        <!-- new work -->
                        <p class="mb-0">Listed Price:
                            ${{ $Lisiting->paymentinfo->Price_Pay_Carrier }}<br></p>
                        <p class="mb-0">Payment Method:
                            {{ $Lisiting->paymentinfo->COD_Method_Mode }}<br></p>
                        {{-- <div class="PaymentInfo col-sm-12">
                            <p class="alert alert-danger codPayor"><span class="codPayorText">The carrier will receive
                                    <b>${{ $Lisiting->paymentinfo->COD_Amount }}</b> via
                                    <b>{{ $Lisiting->paymentinfo->COD_Method_Mode }} /
                                        {{ $Lisiting->paymentinfo->Payment_Method_Mode }}</b> at
                                    <b>{{ $Lisiting->paymentinfo->COD_Location_Amount }}</b></span></p>
                        </div>
                        <!-- end new work -->
                        <!-- add new condition -->
                        @if ($Lisiting->paymentinfo->Bal_Payment_Time === 'Immediately')
                            @if ($Lisiting->paymentinfo->Price_Pay_Carrier < $Lisiting->paymentinfo->COD_Amount)
                                <p class='alert alert-danger balancePayor'>
                                    <span class='balancePayorText'>Carrier will pay you
                                        <b>${{ $Lisiting->paymentinfo->Balance_Amount }}</b>
                                        via <b>{{ $Lisiting->paymentinfo->Bal_Method_Mode }}</b>
                                        {{ $Lisiting->paymentinfo->BAL_Payment_Time }}
                                        <b> {{ $Lisiting->paymentinfo->BAL_Payment_Terms }} </b></span>
                                </p>
                            @else
                                <p class='alert alert-danger balancePayor'>
                                    <span class='balancePayorText'>You will pay the carrier
                                        <b>${{ $Lisiting->paymentinfo->Balance_Amount }}</b>
                                        via <b>{{ $Lisiting->paymentinfo->Bal_Method_Mode }}</b>
                                        {{ $Lisiting->paymentinfo->BAL_Payment_Time }}
                                        <b> {{ $Lisiting->paymentinfo->BAL_Payment_Terms }} </b></span>
                                </p>
                            @endif
                        @else
                            @if ($Lisiting->paymentinfo->Price_Pay_Carrier < $Lisiting->paymentinfo->COD_Amount)
                                <p class='alert alert-danger balancePayor'>
                                    <span class='balancePayorText'>Carrier will pay you
                                        <b>${{ $Lisiting->paymentinfo->Balance_Amount }}</b>
                                        via <b>{{ $Lisiting->paymentinfo->Bal_Method_Mode }}</b> within
                                        {{ $Lisiting->paymentinfo->BAL_Payment_Time }}
                                        <b> {{ $Lisiting->paymentinfo->BAL_Payment_Terms }} </b></span>
                                </p>
                            @else
                                <p class='alert alert-danger balancePayor'>
                                    <span class='balancePayorText'>You will pay the carrier
                                        <b>${{ $Lisiting->paymentinfo->Balance_Amount }}</b>
                                        via <b>{{ $Lisiting->paymentinfo->Bal_Method_Mode }}</b> within
                                        {{ $Lisiting->paymentinfo->BAL_Payment_Time }}
                                        <b> {{ $Lisiting->paymentinfo->BAL_Payment_Terms }} </b></span>
                                </p>
                            @endif
                        @endif
                        <!-- End new condition --> --}}
                        @if ($Lisiting->paymentinfo->PaymentInfo != null)
                            {!! $Lisiting->paymentinfo->PaymentInfo !!}
                        @endif
                        @if ($Lisiting->paymentinfo->BalPaymentInfo != null)
                            {!! $Lisiting->paymentinfo->BalPaymentInfo !!}
                        @endif
                        {{-- <div class="PaymentInfo col-sm-12">
                            {!! $Lisiting->paymentinfo->PaymentInfo ?? null !!}
                        </div>
                        <div class="BalPaymentInfo col-sm-12">
                            {!! $Lisiting->paymentinfo->BalPaymentInfo ?? null !!}
                        </div> --}}
                    </div>
                </div>
                <div class="col-auto">
                    <!-- add new work -->
                    <div class="table-responsive">
                        <table class="total-table">
                            <tbody>
                                <tr>
                                    <th>Sub Total:</th>
                                    <td>$ {{ $subTotal }}</td>
                                </tr>
                                <tr>
                                    <th>Pay To Carrier:</th>
                                    <td>$ {{ $Lisiting->paymentinfo->Price_Pay_Carrier }}</td>
                                </tr>
                                <tr>
                                    <th>COD/COP:</th>
                                    <td>$ {{ $Lisiting->paymentinfo->COD_Amount }}</td>
                                </tr>
                                {{-- @php
                                    $grandTotal =
                                        $subTotal +
                                        (int) \Illuminate\Support\Str::replace(
                                            ['$ ', ','],
                                            '',
                                            $Lisiting->paymentinfo->Price_Pay_Carrier,
                                        ) -
                                        (int) \Illuminate\Support\Str::replace(
                                            ['$ ', ','],
                                            '',
                                            $Lisiting->paymentinfo->COD_Amount,
                                        );
                                @endphp --}}
                                @php
                                    $grandTotal =
                                        $subTotal +
                                        (int) \Illuminate\Support\Str::replace(
                                            ['$ ', ','],
                                            '',
                                            $Lisiting->paymentinfo->Price_Pay_Carrier,
                                        ) -
                                        (int) \Illuminate\Support\Str::replace(
                                            ['$ ', ','],
                                            '',
                                            $Lisiting->paymentinfo->COD_Amount,
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
                    <!-- end new work -->
                </div>
            </div>
            <div class="table-responsive">
                <h5 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                    <i class="bi bi-hash mr-2"></i> Additionals
                </h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Additional Terms</th>
                            <th class="text-center">Special Instructions</th>
                            <th class="text-center">Notes From Customer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">{{ $Lisiting->additional_info->Additional_Terms }}</td>
                            <td class="text-center">{{ $Lisiting->additional_info->Special_Instructions }}</td>
                            <td class="text-center">{{ $Lisiting->additional_info->Notes_Customer }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            {{-- <div class="gallery-area">
                <div class="row">
                    @foreach ($Lisiting->attachments as $attachments)
                        <div class="col-lg-4 col-sm-6 col-md-6">
                            <div class="single-gallery-image mb-30">
                                <img src="{{ asset($attachments->Image_Name) }}" alt="Gallery Image"
                                    data-original="{{ asset($attachments->Image_Name) }}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <p class="company-address style2 text-justify">
                <b>Contract Terms: <i class="fa fa-exclamation"></i> PLEASE READ CAREFULLY!</b><br>
                {{ $Lisiting->additional_info->Contract }}
            </p> --}}
            <div class="container-fluid my-2 px-0">
                <div class="gallery-area">
                    <div class="row g-3" id="gallery">
                        @foreach ($Lisiting->attachments as $attachments)
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="single-gallery-image mb-30 card shadow-sm">
                                    <img src="{{ asset($attachments->Image_Name) }}" class="card-img-top img-fluid"
                                        alt="Gallery Image" data-original="{{ asset($attachments->Image_Name) }}">
                                    <div class="card-body text-center">
                                        <p class="card-text">Gallery Image</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-warning text-white">
                            <h5 class="mb-0">
                                <i class="fa fa-exclamation-circle me-2"></i> Contract Terms: PLEASE READ CAREFULLY!
                            </h5>
                        </div>
                        <div class="card-body">
                            <p>
                                {{ $Lisiting->additional_info->Contract }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <p class="company-address style2"><b>Address:</b><br>{{ $Lisiting->authorized_user->Address }}</p>
            <form action="{{ route('User.Wait.Listing') }}" method="POST" name="Agreement_Form"
                id="agreement-form" class="agreement-note">
                @csrf

                @if (
                    ($order_type === 1 && !empty($V_Load)) ||
                        ($order_type === 2 && !empty($H_Load)) ||
                        ($order_type === 3 && !empty($D_Load)))
                    <!-- PAYMENT SELECTOR -->
                    <div class="checkout payment-method">
                        <p class="payment-validation" style="font-size: 15px; color: red;">Select Any Payment Method
                        </p>
                        <div class="flex-container">
                            <div class="checkout-radio-group">
                                <input type="radio" class="checkout-radio payment-type" name="payment_type"
                                    id="payment-type-Stripe" value="1" required>
                                <img class="payment-type-img"
                                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Stripe_Logo%2C_revised_2016.svg/2560px-Stripe_Logo%2C_revised_2016.svg.png"
                                    alt="stripe payment type">
                                <label class="payment-type-label select-pointer" for="payment-type-Stripe">Pay With
                                    Stripe</label>
                            </div>
                            <div class="checkout-radio-group">
                                <input type="radio" class="checkout-radio payment-type" name="payment_type"
                                    id="payment-type-paypal" value="2">
                                <img class="payment-type-img"
                                    src="https://upload.wikimedia.org/wikipedia/commons/a/a4/Paypal_2014_logo.png"
                                    alt="paypal payment type">
                                <label class="payment-type-label select-pointer" for="payment-type-paypal">Pay With
                                    PayPal</label>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Your Name</label>
                            <input type="text" class="form-control" placeholder="Enter Your Full Name"
                                name="Agreement_Name" required>
                        </div>
                    </div>
                    <input type="hidden" name="Order_ID" value="{{ $Lisiting->id }}">
                    <input type="hidden" name="CMP_ID" value="{{ $Lisiting->authorized_user->id }}">
                    <input type="hidden" name="Order_Amount" value="{{ $grandTotal }}">
                    <input type="hidden" name="Order_Type" value="{{ $order_type }}">
                    <input type="hidden" name="Payment_Method" id="Payment_Method">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Your Signature</label>
                            <input type="text" class="form-control" placeholder="Enter Your Signature"
                                name="Agreement_Sign" id="signature" required>
                        </div>
                    </div>
                </div>
                <div id="signtures"></div>
                <div class="form-group form-check mt-3">
                    <input type="checkbox" class="form-check-input" id="deposite_Check" required>
                    <label class="form-check-label" for="deposite_Check"><b>I have read and accept the Terms &
                            Conditions
                            for this transport. (Click the plus sign above to view.) *</b></label>
                </div>
                <div class="invoice-buttons" style="top: 0;">
                    <button class="print_btn">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11.9688 8.46875C12.1146 8.32292 12.2917 8.25 12.5 8.25C12.7083 8.25 12.8854 8.32292 13.0312 8.46875C13.1771 8.61458 13.25 8.79167 13.25 9C13.25 9.20833 13.1771 9.38542 13.0312 9.53125C12.8854 9.67708 12.7083 9.75 12.5 9.75C12.2917 9.75 12.1146 9.67708 11.9688 9.53125C11.8229 9.38542 11.75 9.20833 11.75 9C11.75 8.79167 11.8229 8.61458 11.9688 8.46875ZM13.5 5.5C14.1875 5.5 14.7708 5.75 15.25 6.25C15.75 6.72917 16 7.3125 16 8V12C16 12.1458 15.9479 12.2708 15.8438 12.375C15.7604 12.4583 15.6458 12.5 15.5 12.5H13.5V15.5C13.5 15.6458 13.4479 15.7604 13.3438 15.8438C13.2604 15.9479 13.1458 16 13 16H3C2.85417 16 2.72917 15.9479 2.625 15.8438C2.54167 15.7604 2.5 15.6458 2.5 15.5V12.5H0.5C0.354167 12.5 0.229167 12.4583 0.125 12.375C0.0416667 12.2708 0 12.1458 0 12V8C0 7.3125 0.239583 6.72917 0.71875 6.25C1.21875 5.75 1.8125 5.5 2.5 5.5V1C2.5 0.729167 2.59375 0.5 2.78125 0.3125C2.96875 0.104167 3.1875 0 3.4375 0H10.375C10.7917 0 11.1458 0.145833 11.4375 0.4375L13.0625 2.0625C13.3542 2.35417 13.5 2.70833 13.5 3.125V5.5ZM4 1.5V5.5H12V3.5H10.5C10.3542 3.5 10.2292 3.45833 10.125 3.375C10.0417 3.27083 10 3.14583 10 3V1.5H4ZM12 14.5V12.5H4V14.5H12ZM14.5 11V8C14.5 7.72917 14.3958 7.5 14.1875 7.3125C14 7.10417 13.7708 7 13.5 7H2.5C2.22917 7 1.98958 7.10417 1.78125 7.3125C1.59375 7.5 1.5 7.72917 1.5 8V11H14.5Z"
                                fill="white" />
                        </svg>
                        <span>Print</span></button>
                    <button id="download_btn" class="download_btn" type="button">
                        <svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16.5 9C16.9167 9 17.2708 9.14583 17.5625 9.4375C17.8542 9.72917 18 10.0833 18 10.5V14.5C18 14.9167 17.8542 15.2708 17.5625 15.5625C17.2708 15.8542 16.9167 16 16.5 16H1.5C1.08333 16 0.729167 15.8542 0.4375 15.5625C0.145833 15.2708 0 14.9167 0 14.5V10.5C0 10.0833 0.145833 9.72917 0.4375 9.4375C0.729167 9.14583 1.08333 9 1.5 9H4.375L2.9375 7.5625C2.47917 7.08333 2.375 6.54167 2.625 5.9375C2.875 5.3125 3.33333 5 4 5H6V1.5C6 1.08333 6.14583 0.729167 6.4375 0.4375C6.72917 0.145833 7.08333 0 7.5 0H10.5C10.9167 0 11.2708 0.145833 11.5625 0.4375C11.8542 0.729167 12 1.08333 12 1.5V5H14C14.6667 5 15.125 5.3125 15.375 5.9375C15.6458 6.54167 15.5417 7.08333 15.0625 7.5625L13.625 9H16.5ZM4 6.5L9 11.5L14 6.5H10.5V1.5H7.5V6.5H4ZM16.5 14.5V10.5H12.125L10.0625 12.5625C9.77083 12.8542 9.41667 13 9 13C8.58333 13 8.22917 12.8542 7.9375 12.5625L5.875 10.5H1.5V14.5H16.5ZM13.9688 13.0312C13.8229 12.8854 13.75 12.7083 13.75 12.5C13.75 12.2917 13.8229 12.1146 13.9688 11.9688C14.1146 11.8229 14.2917 11.75 14.5 11.75C14.7083 11.75 14.8854 11.8229 15.0312 11.9688C15.1771 12.1146 15.25 12.2917 15.25 12.5C15.25 12.7083 15.1771 12.8854 15.0312 13.0312C14.8854 13.1771 14.7083 13.25 14.5 13.25C14.2917 13.25 14.1146 13.1771 13.9688 13.0312Z"
                                fill="white" />
                        </svg>
                        <span>Download</span></button>
                    @if ($Agreement)
                        <button id="save_btn" class="save_btn" type="submit">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3.22969 12.6H9.77031V11.4H3.22969V12.6ZM3.22969 9.2H9.77031V8H3.22969V9.2ZM1.21875 16C0.89375 16 0.609375 15.88 0.365625 15.64C0.121875 15.4 0 15.12 0 14.8V1.2C0 0.88 0.121875 0.6 0.365625 0.36C0.609375 0.12 0.89375 0 1.21875 0H8.55156L13 4.38V14.8C13 15.12 12.8781 15.4 12.6344 15.64C12.3906 15.88 12.1063 16 11.7812 16H1.21875ZM7.94219 4.92V1.2H1.21875V14.8H11.7812V4.92H7.94219ZM1.21875 1.2V4.92V1.2V14.8V1.2Z"
                                    fill="white" />
                            </svg>
                            <span>Accept</span></button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the gallery element
        const galleryElement = document.getElementById('gallery');

        // Initialize Viewer.js on gallery images
        const viewer = new Viewer(galleryElement, {
            url: 'data-original', // Use the data-original attribute for full-size images
            navbar: true,
            toolbar: {
                zoomIn: 1,
                zoomOut: 1,
                oneToOne: 1,
                reset: 1,
                prev: 1,
                play: {
                    show: true,
                    size: 'large',
                },
                next: 1,
                rotateLeft: 1,
                rotateRight: 1,
                flipHorizontal: 1,
                flipVertical: 1,
            },
            title: [true, (image) => `${image.alt} (${image.naturalWidth} × ${image.naturalHeight})`],
        });
    });
</script>
<script>
    $("#signtures").click(function() {
        if ($("#signature1").is(":checked")) {
            // do something if the checkbox is NOT checked
            $("#first_sign").css("background-color", "black");
            $("#first_sign").css("color", "white");


        }
        if (!$("#signature1").is(":checked")) {
            // do something if the checkbox is NOT checked
            $("#first_sign").css("background-color", "white");
            $("#first_sign").css("color", "black");


        }
        if ($("#signature2").is(":checked")) {
            // do something if the checkbox is NOT checked
            $("#second_sign").css("background-color", "black");
            $("#second_sign").css("color", "white");


        }
        if (!$("#signature2").is(":checked")) {
            // do something if the checkbox is NOT checked
            $("#second_sign").css("background-color", "white");
            $("#second_sign").css("color", "black");


        }
        if ($("#signature3").is(":checked")) {
            // do something if the checkbox is NOT checked
            $("#third_sign").css("background-color", "black");
            $("#third_sign").css("color", "white");

        }
        if (!$("#signature3").is(":checked")) {
            // do something if the checkbox is NOT checked
            $("#third_sign").css("background-color", "white");
            $("#third_sign").css("color", "black");
        }

        if ($("#signature4").is(":checked")) {
            // do something if the checkbox is NOT checked
            $("#fourth_sign").css("background-color", "black");
            $("#fourth_sign").css("color", "white");

        }
        if (!$("#signature4").is(":checked")) {
            // do something if the checkbox is NOT checked
            $("#fourth_sign").css("background-color", "white");
            $("#fourth_sign").css("color", "black");
        }
    });
    $("#s1").click(function() {
        $("#signature1").prop("checked", true);
        var checked = $(this).is(':checked');
    });
    $(".sign2").click(function() {
        $("#signature2").prop("checked", true);
    });
    $(".sign3").click(function() {
        $("#signature3").prop("checked", true);
    });
    $(".sign4").click(function() {
        $("#signature4").prop("checked", true);
    });

    $("#signature").change(function() {
        var valueSign = $(this).val();
        $("#signtures").html('');
        if (valueSign) {
            $("#signtures").html(`
                        <div class="row skin skin-line">

                            <div class="col-md-6 col-sm-12 mt-2 radio_style "  id="s1">
                                <fieldset class="sign sign1" id="first_sign">
                                    <input required type="radio"  name="signatureShw" value="1" id="signature1" required>
                                    <label for="signature1"  style="font-weight: bolder;font-style: oblique" id="signShw1">${valueSign}</label>
                                </fieldset>
                            </div>
                            <div class="col-md-6 col-sm-12 mt-2 radio_style" id="s2">
                                <fieldset class="sign sign2" id="second_sign">
                                    <input required type="radio"  name="signatureShw" value="2" id="signature2" required>
                                    <label for="signature2" style="font-weight: bolder;font-style: oblique" id="signShw2">${valueSign}</label>
                                </fieldset>
                            </div>
                            <div class="col-md-6 col-sm-12 mt-2 radio_style" id="s3">
                                <fieldset class="sign sign3" id="third_sign">
                                    <input required type="radio"  name="signatureShw" value="3" id="signature3" required>
                                    <label for="signature3"  style="font-family:monsieur;font-weight: bolder;font-style: oblique"  id="signShw3">${valueSign}</label>
                                </fieldset>
                            </div>
                            <div class="col-md-6 col-sm-12 mt-2 radio_style" id="s4">
                                <fieldset class="sign sign4" id="fourth_sign">
                                    <input required type="radio" name="signatureShw" value="4" id="signature4" required>
                                    <label for="signature4" style="font-family:monospace;font-weight: bolder;font-style: oblique"  id="signShw4">${valueSign}</label>
                                </fieldset>
                            </div>

                        </div>`);
        }
    });

    function AgreementValidation() {

        var name = document.forms.Agreement_Form.Agreement_Name.value;
        var sign = document.forms.Agreement_Form.Agreement_Sign.value;
        var pmethod = document.forms.Agreement_Form.Payment_Method.value;

        var regName = /\d+$/g; // Javascript reGex for Name validation
        @if (
            ($order_type === 1 && !empty($V_Load)) ||
                ($order_type === 2 && !empty($H_Load)) ||
                ($order_type === 3 && !empty($D_Load)))
            if ($('.checkout-radio').checked === false) {
                window.alert("Please Select Payment Method.");
                $('.checkout-radio').focus();
                return false;
            }

            if (pmethod === "" || regName.test(pmethod)) {
                window.alert("Please Enter Your Name Properly.");
                pmethod.focus();
                return false;
            }
        @endif
        if (name === "" || regName.test(name)) {
            window.alert("Please Enter Your Name Properly.");
            name.focus();
            return false;
        }

        if (sign === "" || regName.test(sign)) {
            window.alert("Please Enter Your Signature.");
            address.focus();
            return false;
        }

        $('#deposite_Check').click(function() {
            if (!$(this).is(":checked")) {
                this.focus();
                return false;
            }
        });

        return true;
    }

    // $('#save_btn').click(function () {
    //
    //     if (AgreementValidation()) {
    //         $('#agreement-form').submit();
    //     }
    // });
</script>
@if (!empty($V_Load) || !empty($H_Load) || !empty($D_Load))
    <script>
        // Selects radio group
        var method = document.querySelectorAll('.checkout-radio-group');
        method.forEach(function(elem) {
            elem.addEventListener('click', function() {
                method.forEach(function(elemM) {
                    elemM.classList.remove('active');
                });
                this.classList.add('active');
                var radio = $(this).find('input').val();
                $('form #Payment_Method').val(radio);
                $('.payment-validation').hide();
            })
        });
    </script>
@endif
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
                <link rel="shortcut icon" type="image/x-icon" href="https://daydispatch.com/frontend/img/favicon.png" media="print">
                <meta name="theme-color" content="#ffffff">
                <link rel="preconnect" href="https://fonts.googleapis.com" media="print">
                <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
                    rel="stylesheet" media="print">
                <link rel="stylesheet" href="https://daydispatch.com/invoice/css/app.min.css" media="print">
                <link rel="stylesheet" href="https://daydispatch.com/invoice/css/style.css" media="print">
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
