<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Vendors Min CSS -->
    <link rel="stylesheet" href="{{ asset('backend/css/vendors.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/datatables.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('backend/css/responsive.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}"> --}}

    <title>Day Dispatch - Transportation</title>

    <!--<link rel="icon" type="image/png" href="{{ asset('backend/img/favicon.png') }}">-->
    <link
        href="https://fonts.googleapis.com/css2?family=Caveat&family=Cedarville+Cursive&family=Pacifico&family=Tilt+Prism&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/logo/logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://daydispatch.com/frontend/css/style.css">
    <style>
        :root {
            --clr-common-white: #fff;
            --clr-common-black: #000;
            --clr-common-blue: #2785ff;
            --clr-common-heading: #012863;
            --clr-common-text: #777777;
            --clr-common-border: #eaebee;
            --clr-common-color-5: #113771;
            --clr-table-header-bg: #f5f5f5;
            --clr-table-header-text: var(--clr-common-black);
            --clr-bg-gray-2: #f5f5f5;
        }

        .section-heading {
            text-wrap: nowrap;
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--clr-common-heading);
            border-bottom: 2px solid #e11f26;
            padding-bottom: 10px;
            margin-bottom: 20px;
            /* display: flex;
            align-items: center; */
        }

        .section-heading i {
            margin-right: 10px;
            color: var(--clr-common-color-5);
        }

        .form-label {
            text-wrap: nowrap;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--clr-common-color-5);
            display: flex;
            align-items: center;
        }

        .form-label i {
            margin-right: 8px;
            color: var(--clr-common-color-5);
        }

        .table {
            border: 1px solid var(--clr-common-border);
            background-color: var(--clr-bg-gray-2);
        }

        .table th {
            background-color: var(--clr-table-header-bg);
            color: var(--clr-table-header-text);
            font-weight: 600;
            padding: 12px;
            text-align: left;
        }

        .table td {
            padding: 10px;
            border: 1px solid var(--clr-common-border);
            text-align: left;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: var(--clr-bg-gray-4);
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

        /* .fill-btn {
            font-size: 16px;
        color: var(--clr-common-white);
        font-weight: 600;
        background: var(--clr-common-color-red);
        height: 60px;
        display: inline-block;
        line-height: 60px;
        padding: 0 38px;
        position: relative;
        overflow: hidden;
        text-align: center;
        text-transform: uppercase;
        font-family: oswald, sans-serif;
   
        }
        .fill-btn:hover {
            color: var(--clr-common-white);
            background: var(--clr-common-heading);
        } */
    </style>
</head>

<body>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-message">
            {{ session('success') }}
            <span type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></span>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-message">
            {{ session('error') }}
            <span type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></span>
        </div>
    @endif

    <section class="my-3">
        <div class="container my-5"
            style="border-radius: 30px;padding: 30px;background: #f5f5f5;z-index;box-shadow: 0px 0px 11px 1px #113771;red;">
            <div class="row">
                <div class="col-sm-6" style="display: flex; align-items: center;">
                    <h1>{{ $settings->company_name }}</h1>
                </div>

                <div class="col-sm-6" style="display: flex;justify-content: end;align-items: center;">
                    <img src="{{ asset($settings->logo) }}" width="200" height="200">
                </div>
            </div>
            <form action="{{ route('order.form.store') }}" method="POST">
                @csrf
                <div class="container-flude mt-5">
                    <!-- Styled Bootstrap Table -->
                    <h2 class="section-heading text-center">
                        <i class="bi bi-table"></i> SUMMARY
                    </h2>
                    <div class="row">
                        <label class="form-label justify-content-end">
                            <i class="fas fa-id-card"></i> Reference ID:&nbsp;
                            <span>({{ $item->Ref_ID }})</span>
                        </label>
                        <div class="col-sm-6">
                            <h4 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                                <i class="bi bi-hash mr-2"></i> Order Information
                            </h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th><i class="bi bi-hash"></i> Order ID</th>
                                            <td>{{ $item->Ref_ID }}</td>
                                        </tr>
                                        <tr>
                                            @if ($item->Listing_Type === 1)
                                                <th><i class="fas fa-car"></i> Vehicle Name</th>
                                                @foreach ($item->vehicles as $vehicle)
                                                    <td>{{ $vehicle->Vehcile_Make }}, {{ $vehicle->Vehcile_Model }},
                                                        {{ $vehicle->Vehcile_Year }}</td>
                                                @endforeach
                                            @endif

                                            @if ($item->Listing_Type === 2)
                                                <th><i class="fas fa-car"></i> Equipment Name</th>
                                                @foreach ($item->heavy_equipments as $heavy_equipments)
                                                    <td>{{ $heavy_equipments->Equipment_Make }},
                                                        {{ $heavy_equipments->Equipment_Model }},
                                                        {{ $heavy_equipments->Equipment_Year }}</td>
                                                @endforeach
                                            @endif
                                        </tr>
                                        <tr>
                                            @if ($item->Listing_Type === 1)
                                                <th><i class="fa-solid fa-check-double"></i> Vehicle Condition</th>
                                                @foreach ($item->vehicles as $vehicle)
                                                    <td>{{ $vehicle->Vehcile_Condition }}</td>
                                                @endforeach
                                            @endif

                                            @if ($item->Listing_Type === 2)
                                                <th><i class="fa-solid fa-check-double"></i> Equipment Condition</th>
                                                @foreach ($item->heavy_equipments as $heavy_equipments)
                                                    <td>{{ $heavy_equipments->Equipment_Condition }}</td>
                                                @endforeach
                                            @endif
                                        </tr>
                                        <tr>
                                            <th><i class="fa-solid fa-car-tunnel"></i> Trailer Type</th>
                                            @if ($item->Listing_Type === 1)
                                                @foreach ($item->vehicles as $vehicle)
                                                    <td>{{ $vehicle->Trailer_Type }}</td>
                                                @endforeach
                                            @endif

                                            @if ($item->Listing_Type === 2)
                                                @foreach ($item->heavy_equipments as $heavy_equipments)
                                                    <td>{{ $heavy_equipments->Trailer_Type }}</td>
                                                @endforeach
                                            @endif

                                            @if ($item->Listing_Type === 3)
                                                @foreach ($item->dry_vans as $dry_vans)
                                                    <td>{{ $dry_vans->Trailer_Type_Dry }}</td>
                                                @endforeach
                                            @endif
                                        </tr>
                                        <tr>
                                            @if ($item->Listing_Type === 2)
                                                <th><i class="fa-solid fa-car-tunnel"></i> Shipment Preferences</th>
                                                @foreach ($item->heavy_equipments as $heavy_equipments)
                                                    <td>{{ $heavy_equipments->Shipment_Preferences }}</td>
                                                @endforeach
                                            @endif

                                            @if ($item->Listing_Type === 3)
                                                <th><i class="fa-solid fa-car-tunnel"></i> Shipment Preferences</th>
                                                @foreach ($item->dry_vans as $dry_vans)
                                                    <td>{{ $dry_vans->Shipment_Preferences }}</td>
                                                @endforeach
                                            @endif
                                        </tr>
                                        <tr>
                                            <th><i class="fa-solid fa-location-dot"></i> Pickup Location</th>
                                            <td>{{ $item->routes->Origin_ZipCode }}</td>
                                        </tr>
                                        <tr>
                                            <th><i class="fa-solid fa-location-dot"></i> Delivery Location</th>
                                            <td>{{ $item->routes->Dest_ZipCode }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h4 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                                <i class="bi bi-currency-dollar mr-2"></i> Pricing Information
                            </h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th><i class="fa-solid fa-hand-holding-dollar"></i> Booking Price</th>
                                            <td>${{ $item->paymentinfo->Order_Booking_Price }}</td>
                                        </tr>
                                        <tr>
                                            <th><i class="fa-solid fa-money-bill-transfer"></i> Deposit</th>
                                            <td>${{ $item->paymentinfo->Deposite_Amount }}</td>
                                        </tr>
                                        @php
                                            $balance_amount =
                                                $item->paymentinfo->Order_Booking_Price -
                                                $item->paymentinfo->Deposite_Amount;
                                        @endphp
                                        <tr>
                                            <th><i class="bi bi-currency-dollar"></i> Balance Amount</th>
                                            <td>${{ $balance_amount }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if ($item->Listing_Type === 1)
                        <h2 class="section-heading text-center">
                            <i class="fas fa-car"></i> Vehicle Information
                        </h2>
                    @endif
                    @if ($item->Listing_Type === 2)
                        <h2 class="section-heading text-center">
                            <i class="fas fa-car"></i> Equipment Information
                        </h2>
                    @endif
                    <!-- Order Details -->
                    <div class="form-group">
                        <!-- <label for="order_id">Order ID</label> -->
                        <input type="hidden" class="form-control @error('order_id') is-invalid @enderror"
                            id="order_id" name="order_id" value="{{ $item->id }}">
                        <!-- @error('order_id')
    <div class="invalid-feedback">{{ $message }}</div>
                            @enderror -->
                    </div>
                    <input type="hidden" class="form-control" id="user_id" name="user_id"
                        value="{{ $item->authorized_user->id }}">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                                <i class="fa-regular fa-circle-question mr-2 mt-1"></i> Customer Information
                            </h4>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="full_name"><i class="bi bi-person"></i> Full Name</label>
                                        <input type="text"
                                            class="form-control @error('full_name') is-invalid @enderror"
                                            id="full_name" name="full_name" value="{{ $item->Customer_Name }}"
                                            readonly="">
                                        @error('full_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="first_phone"><i class="bi bi-phone"></i> First Phone</label>
                                        <input type="text" oninput="js_us_phoneFormat2(`.phoneNum-1`);"
                                            maxlength="14"
                                            class="form-control phoneNum-1 @error('first_phone') is-invalid @enderror"
                                            id="first_phone" name="first_phone" value="{{ old('first_phone') }}">
                                        @error('first_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="second_phone"><i class="bi bi-phone"></i> Second Phone</label>
                                        <input type="text" oninput="js_us_phoneFormat3(`.phoneNum-2`);"
                                            maxlength="14"
                                            class="form-control phoneNum-2 @error('second_phone') is-invalid @enderror"
                                            id="second_phone" name="second_phone" value="{{ old('second_phone') }}">
                                        @error('second_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address"><i class="bi bi-house"></i> Address</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        id="address" name="address" value="{{ $item->routes->Origin_Address }}">
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="zip_code"><i class="bi bi-geo-alt"></i> Zip Code</label>
                                    <input type="text" class="form-control @error('zip_code') is-invalid @enderror"
                                        id="zip_code" name="zip_code" value="{{ $item->routes->Origin_ZipCode }}"
                                        readonly="">
                                    @error('zip_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email_address"><i class="bi bi-envelope"></i> Email Address</label>
                                    <input type="email"
                                        class="form-control @error('email_address') is-invalid @enderror"
                                        id="email_address" name="email_address"
                                        value="{{ $item->authorized_user->email }}" readonly="">
                                    @error('email_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            @if ($item->Listing_Type === 1)
                                <h4 class="text-white py-2 d-flex justify-content-center"
                                    style="background: #113771;">
                                    <i class="fa-regular fa-circle-question mr-2 mt-1"></i> Vehicle Information
                                </h4>
                            @endif

                            @if ($item->Listing_Type === 2)
                                <h4 class="text-white py-2 d-flex justify-content-center"
                                    style="background: #113771;">
                                    <i class="fa-regular fa-circle-question mr-2 mt-1"></i> Equipment Information
                                </h4>
                            @endif
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        @if ($item->Listing_Type === 1)
                                            @foreach ($item->vehicles as $vehicleinfo)
                                                <label for="vehicle_name"><i class="fas fa-car"></i> Vehicle
                                                    Name</label>
                                                <input type="text"
                                                    class="form-control @error('vehicle_name') is-invalid @enderror"
                                                    id="vehicle_name" name="vehicle_name"
                                                    value="{{ $vehicleinfo->Vehcile_Make }}, {{ $vehicleinfo->Vehcile_Model }}, {{ $vehicleinfo->Vehcile_Year }}"
                                                    readonly="">
                                            @endforeach
                                        @endif

                                        @if ($item->Listing_Type === 2)
                                            @foreach ($item->heavy_equipments as $heavy_equipments)
                                                <label for="vehicle_name"><i class="fas fa-car"></i> Equipment
                                                    Name</label>
                                                <input type="text"
                                                    class="form-control @error('vehicle_name') is-invalid @enderror"
                                                    id="vehicle_name" name="vehicle_name"
                                                    value="{{ $heavy_equipments->Equipment_Make }}, {{ $heavy_equipments->Equipment_Model }}, {{ $heavy_equipments->Equipment_Year }}"
                                                    readonly="">
                                            @endforeach
                                        @endif

                                        @error('vehicle_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        @if ($item->Listing_Type === 1)
                                            <label for="carrier_type">Vehicle Condition</label>
                                            @foreach ($item->vehicles as $vehicle)
                                                <input type="text"
                                                    class="form-control @error('carrier_type') is-invalid @enderror"
                                                    id="carrier_type" name="carrier_type"
                                                    value="{{ $vehicle->Vehcile_Condition }}" readonly="">
                                            @endforeach
                                        @endif

                                        @if ($item->Listing_Type === 2)
                                            <label for="carrier_type">Equipment Condition</label>
                                            @foreach ($item->heavy_equipments as $heavy_equipments)
                                                <input type="text"
                                                    class="form-control @error('carrier_type') is-invalid @enderror"
                                                    id="carrier_type" name="carrier_type"
                                                    value="{{ $heavy_equipments->Equipment_Condition }}"
                                                    readonly="">
                                            @endforeach
                                        @endif
                                        @error('carrier_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <!-- <label for="vehicle_runs">Vehicle Runs</label> -->
                                        <label for="vehicle_runs"><i class="fa-solid fa-map-location-dot"></i>
                                            Miles</label>
                                        <input type="text"
                                            class="form-control @error('vehicle_runs') is-invalid @enderror"
                                            id="vehicle_runs" name="vehicle_runs" value="{{ $item->routes->Miles }}"
                                            readonly="">
                                        @error('vehicle_runs')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="pricing_payment">PRICING & PAYMENT</label>
                                        <input type="text"
                                            class="form-control @error('pricing_payment') is-invalid @enderror"
                                            id="pricing_payment" name="pricing_payment"
                                            value="{{ $item->paymentinfo->Order_Booking_Price }}" readonly="">
                                        @error('pricing_payment')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="auction">Auction</label>
                                        <input type="text"
                                            class="form-control @error('auction') is-invalid @enderror"
                                            id="auction" name="auction"
                                            value="{{ $item->listing_origin_location->Orign_Location }}"
                                            readonly="">
                                        @error('auction')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="auction_name">Auction Name</label>
                                        <input type="text"
                                            class="form-control @error('auction_name') is-invalid @enderror"
                                            id="auction_name" name="auction_name"
                                            value="{{ $item->listing_origin_location->User_Name }}" readonly="">
                                        @error('auction_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="stock_number">Stock Number</label>
                                        <input type="text"
                                            class="form-control @error('stock_number') is-invalid @enderror"
                                            id="stock_number" name="stock_number"
                                            value="{{ $item->listing_origin_location->Stock_Number }}"
                                            readonly="">
                                        @error('stock_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="last_of_vin">Last of VIN (8)*</label>
                                        <input type="phone" maxlength="8"
                                            class="form-control @error('last_of_vin') is-invalid @enderror"
                                            id="last_of_vin" name="last_of_vin" value="{{ old('last_of_vin') }}">
                                        @error('last_of_vin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="key">Key</label>
                                        <select class="form-select @error('key') is-invalid @enderror" id="key"
                                            name="key" value="{{ old('key') }}">
                                            <option selected value="">Select Key</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                        {{-- <input type="number" class="form-control @error('key') is-invalid @enderror" id="key"
                                        name="key" value="{{ old('key') }}"> --}}
                                        @error('key')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="vehicle_first_available_date">Vehicle First Available Date</label>
                                        <input type="date"
                                            class="form-control @error('vehicle_first_available_date') is-invalid @enderror"
                                            id="vehicle_first_available_date" name="vehicle_first_available_date"
                                            value="{{ old('vehicle_first_available_date') }}"
                                            min="{{ date('Y-m-d') }}"> <!-- Set min to the current date -->
                                        @error('vehicle_first_available_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <!-- Origin Information -->
                        <div class="col-sm-6">
                            <h4 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                                <i class="fa-regular fa-circle-question mr-2 mt-1"></i> Origin Information
                            </h4>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="origin_contact_name">Origin Contact Name</label>
                                        <input type="text"
                                            class="form-control @error('origin_contact_name') is-invalid @enderror"
                                            id="origin_contact_name" name="origin_contact_name"
                                            value="{{ $item->listing_origin_location->User_Name }}" readonly="">
                                        @error('origin_contact_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="origin_email">Origin Email</label>
                                        <input type="email"
                                            class="form-control @error('origin_email') is-invalid @enderror"
                                            id="origin_email" name="origin_email"
                                            value="{{ $item->listing_origin_location->User_Email }}" readonly="">
                                        @error('origin_email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="origin_first_phone">Origin First Phone</label>
                                        <input type="text"
                                            class="form-control @error('origin_first_phone') is-invalid @enderror"
                                            id="origin_first_phone" name="origin_first_phone"
                                            value="{{ $item->listing_origin_location->Local_Phone }}" readonly="">
                                        @error('origin_first_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="origin_second_phone">Origin Second Phone</label>
                                        <input type="text"
                                            class="form-control @error('origin_second_phone') is-invalid @enderror"
                                            id="origin_second_phone" name="origin_second_phone"
                                            value="{{ $item->listing_origin_location->Auction_Phone }}"
                                            readonly="">
                                        @error('origin_second_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="origin_address">Origin Address</label>
                                        <input type="text"
                                            class="form-control @error('origin_address') is-invalid @enderror"
                                            id="origin_address" name="origin_address"
                                            value="{{ $item->routes->Origin_Address }}" readonly="">
                                        @error('origin_address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="origin_zip_code">Origin Zip Code</label>
                                        <input type="text"
                                            class="form-control @error('origin_zip_code') is-invalid @enderror"
                                            id="origin_zip_code" name="origin_zip_code"
                                            value="{{ $item->routes->Origin_ZipCode }}" readonly="">
                                        @error('origin_zip_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- Destination Information -->
                            <h4 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                                <i class="fa-regular fa-circle-question mr-2 mt-1"></i> Destination Information
                            </h4>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="destination_contact_name">Destination Contact Name</label>
                                        <input type="text"
                                            class="form-control @error('destination_contact_name') is-invalid @enderror"
                                            id="destination_contact_name" name="destination_contact_name"
                                            value="{{ $item->listing_destination_locations->Destination_Location }}"
                                            readonly="">
                                        @error('destination_contact_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="destination_email">Destination Email</label>
                                        <input type="email"
                                            class="form-control @error('destination_email') is-invalid @enderror"
                                            id="destination_email" name="destination_email"
                                            value="{{ $item->listing_destination_locations->Dest_User_Email }}"
                                            readonly="">
                                        @error('destination_email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="destination_first_phone">Destination First Phone</label>
                                        <input type="text"
                                            class="form-control @error('destination_first_phone') is-invalid @enderror"
                                            id="destination_first_phone" name="destination_first_phone"
                                            value="{{ $item->listing_destination_locations->Dest_Local_Phone }}"
                                            readonly="">
                                        @error('destination_first_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="destination_second_phone">Destination Second Phone</label>
                                        <input type="text"
                                            class="form-control @error('destination_second_phone') is-invalid @enderror"
                                            id="destination_second_phone" name="destination_second_phone"
                                            value="{{ $item->listing_destination_locations->Dest_Auction_Phone }}"
                                            readonly="">
                                        @error('destination_second_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="destination_address">Destination Address</label>
                                        <input type="text"
                                            class="form-control @error('destination_address') is-invalid @enderror"
                                            id="destination_address" name="destination_address"
                                            value="{{ $item->routes->Destination_Address }}" readonly="">
                                        @error('destination_address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="destination_zip_code">Destination Zip Code</label>
                                        <input type="text"
                                            class="form-control @error('destination_zip_code') is-invalid @enderror"
                                            id="destination_zip_code" name="destination_zip_code"
                                            value="{{ $item->routes->Dest_ZipCode }}" readonly="">
                                        @error('destination_zip_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h2 class="section-heading text-center">
                            <i class="fas fa-car"></i> Additional Information
                        </h2>
                        <!-- Additional Information -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="additional_vehicle_information">Additional Vehicle Information</label>
                                <textarea class="form-control" id="additional_vehicle_information" name="additional_vehicle_information"
                                    rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="your_name">Your Name</label>
                                <input type="text" class="form-control" id="your_name" name="your_name">
                            </div>
                        </div>
                        <!-- <div class="col-sm-6">
                        <div class="form-group">
                            <label for="your_signature">Your Signature</label>
                            <input type="text" class="form-control target" id="your_signature" name="your_signature">
                        </div>
                    </div> -->

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Your Signature</label>
                                <input type="text" class="form-control" placeholder="Enter Your Signature"
                                    name="your_signature" id="signature" required>
                            </div>
                        </div>

                        <div id="signtures"></div>

                        <!-- Signature preview area -->
                        <div class="row mt-3 signature_view"></div>

                        <!-- Hidden divs that will be shown based on interactions -->
                        <!-- <div class="offThisDiv" style="display: none;">Signature options visible</div>
                    <div class="offThisBth" style="display: none;">Button to hide</div> -->

                        {{-- <div class="foemDiv2">
                        <div class="formPd">
                            Your Signature
                            <input type="text" class="form-control a-input a-border target" name="billing_zip"
                                placeholder="Your Signature" required />
                        </div>
                    </div>
                    <div class="signature_view"></div>
                    <div class="signature_style_view"></div> --}}
                    </div>
                    <!-- Terms and Signature -->
                    <h2 class="section-heading text-center">
                        <i class="fas fa-car"></i> Terms & Conditions
                    </h2>
                    <div class="form-group">
                        <label for="terms_condition">Terms & Conditions</label>
                        <input type="text" class="form-control" id="terms_condition" name="terms_condition"
                            value="{{ $settings->terms_condition }}" readonly="">
                    </div>
                    <div class="form-group form-check mt-3">
                        <input type="checkbox" class="form-check-input" id="deposite_Check" required>
                        <label class="form-check-label" for="deposite_Check"><b>I have read and accept the Terms &
                                Conditions for this transport</b></label>
                    </div>
                    <!-- Submit Button -->
                    <div class="price__cta-btn">
                        <a class="fill-btn clip-sm-btn d-block">
                            <button type="submit" class="text-white">Submit Order</button>
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </section>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Initialize a variable to store the currently selected signature
        // let selectedSignature = null;

        // $("#your_signature").on("keyup", function () {
        //     let signature_view = $(this).val();  // Get the value from the input field

        //     if (signature_view.length > 2) {  // Check if input is more than 2 characters
        //         $(".signature_view").html(`
    //             <div class="col-md-3">
    //                 <div class="p-3 border signature sig_set c1 bg-light text-dark">
    //                     <span class="font-weight-bold" style="font-family: 'Caveat', cursive; font-size: 20px;" 
    //                           onclick="toggleSignature('.c1', this);">
    //                         ${signature_view}
    //                     </span>
    //                 </div>
    //             </div>
    //             <div class="col-md-3">
    //                 <div class="p-3 border signature sig_set c2 bg-light text-dark">
    //                     <span class="font-weight-bold" style="font-family: 'Cedarville Cursive', cursive; font-size: 22px;" 
    //                           onclick="toggleSignature('.c2', this);">
    //                         ${signature_view}
    //                     </span>
    //                 </div>
    //             </div>
    //             <div class="col-md-3">
    //                 <div class="p-3 border signature sig_set c3 bg-light text-dark">
    //                     <span class="font-weight-bold" style="font-family: 'Pacifico', cursive; font-size: 24px;" 
    //                           onclick="toggleSignature('.c3', this);">
    //                         ${signature_view}
    //                     </span>
    //                 </div>
    //             </div>
    //             <div class="col-md-3">
    //                 <div class="p-3 border signature sig_set c4 bg-light text-dark">
    //                     <span class="font-weight-bold" style="font-family: 'Tilt Prism', cursive; font-size: 26px;" 
    //                           onclick="toggleSignature('.c4', this);">
    //                         ${signature_view}
    //                     </span>
    //                 </div>
    //             </div>
    //         `);
        //     } else {
        //         $('.offThisBth').hide();  // Hide button when less than 2 characters
        //         $('.offThisDiv').hide();  // Hide div with signature options
        //         $(".signature_view").html(``);  // Clear the signature preview area
        //     }
        // });

        // // Function to toggle signature selection
        // function toggleSignature(className, element) {
        //     // Check if the clicked signature is already selected
        //     if (selectedSignature === className) {
        //         // If it is, deselect it
        //         $(element).css({
        //             'background-color': '#fff',
        //             'color': '#333'
        //         });
        //         selectedSignature = null;  // Clear the selected signature
        //     } else {
        //         // If it's a new selection, update the previous one if any
        //         if (selectedSignature) {
        //             $(`.signature_view span[onclick*='${selectedSignature}']`).css({
        //                 'background-color': '#fff',
        //                 'color': '#333'
        //             });
        //         }
        //         // Select the new signature
        //         $(element).css({
        //             'background-color': '#333',
        //             'color': '#fff'
        //         });
        //         selectedSignature = className;  // Update the selected signature
        //         $('.offThisDiv').show();  // Show the offThisDiv if needed
        //     }
        // }

        // // Function to handle signature color selection
        // function select_col(a) {
        //     $(".signature_style_view").html(`
    //         <style>
    //             ${a[0]} {
    //                 background-color: #333 !important;
    //                 color: #fff !important;
    //             }
    //             ${a[1]}, ${a[2]}, ${a[3]} {
    //                 background-color: #fff !important;
    //                 color: #333 !important;
    //             }
    //         </style>
    //     `);
        // }

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
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var successMessage = document.getElementById('success-message');
            var errorMessage = document.getElementById('error-message'); // Changed variable name
            if (successMessage) {
                setTimeout(function() {
                    successMessage.classList.remove('show');
                    successMessage.classList.add('fade');
                }, 3000); // 3000 milliseconds = 3 seconds
            }
            if (errorMessage) {
                setTimeout(function() {
                    errorMessage.classList.remove('show');
                    errorMessage.classList.add('fade');
                }, 3000); // 3000 milliseconds = 3 seconds
            }
        });

        function js_us_phoneFormat2(a) {
            let telEl = document.querySelector(a)

            telEl.addEventListener(`keyup`, (e) => {
                let val = e.target.value;
                e.target.value = val
                    .replace(/\D/g, ``)
                    .replace(/(\d{1,3})(\d{1,3})?(\d{1,4})?/g, function(txt, f, s, t) {
                        if (t) {
                            return `(${f}) ${s}-${t}`
                        } else if (s) {
                            return `(${f}) ${s}`
                        } else if (f) {
                            return `(${f})`
                        }
                    });
            })

        }

        function js_us_phoneFormat3(a) {
            let telEl = document.querySelector(a)

            telEl.addEventListener(`keyup`, (e) => {
                let val = e.target.value;
                e.target.value = val
                    .replace(/\D/g, ``)
                    .replace(/(\d{1,3})(\d{1,3})?(\d{1,4})?/g, function(txt, f, s, t) {
                        if (t) {
                            return `(${f}) ${s}-${t}`
                        } else if (s) {
                            return `(${f}) ${s}`
                        } else if (f) {
                            return `(${f})`
                        }
                    });
            })

        }
    </script>
    {{-- <script>
        document.getElementById('key').addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9]/g, ''); // Replace non-numeric characters
        });
    </script> --}}
</body>

</html>
