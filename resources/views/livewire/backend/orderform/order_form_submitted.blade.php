<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submitted Order Form</title>
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
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/logo/logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
            border-bottom:  2px solid #e11f26;
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
    </style>
</head>

<body>
<section class="my-3">
    <div class="container my-5" style="border-radius: 30px;padding: 30px;background: #f5f5f5;z-index;box-shadow: 0px 0px 11px 1px #113771;red;">
        <div class="row">
            <div class="col-sm-6" style="display: flex; align-items: center;">
                <h1>{{ $settings->company_name }}</h1>
            </div>

            <div class="col-sm-6" style="display: flex;justify-content: end;align-items: center;">
                <img src="{{ asset($settings->logo) }}" width="200" height="200">
            </div>
        </div>
        <div class="container-flude mt-5">
            <h2 class="section-heading text-center">
                <i class="bi bi-table"></i> SUMMARY
                </h2>
                <label class="form-label justify-content-end">
                    <i class="fas fa-id-card"></i> Reference ID:&nbsp;
                    <span>({{ $data->Ref_ID }})</span>
                    </label>
            <div class="row">
                <div class="col-sm-6">
                    <h4  class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                        <i class="bi bi-hash mr-2"></i> Customer Information
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th><i class="bi bi-hash"></i> Full Name</th>
                                    <td>{{ $item->full_name }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-car"></i> First Phone</th>
                                    <td>{{ $item->first_phone }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fa-solid fa-check-double"></i> Second Phone</th>
                                    <td>{{ $item->second_phone }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fa-solid fa-location-dot"></i> Email Address</th>
                                    <td>{{ $item->email_address }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fa-solid fa-car-tunnel"></i> Address</th>
                                    <td>{{ $item->address }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fa-solid fa-location-dot"></i> Zip Code</th>
                                    <td>{{ $item->zip_code }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fa-solid fa-location-dot"></i> Delivery Location</th>
                                    <td>Freeport, TX, 77541</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-6">
                    <h4 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                        <i class=" mr-2"></i> Vehicle Information
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th><i class="fa-solid fa-hand-holding-dollar"></i> Vehicle Name</th>
                                    <td>{{ $item->vehicle_name }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fa-solid fa-money-bill-transfer"></i> Carrier Type</th>
                                    <td>{{ $item->carrier_type }}</td>
                                </tr>
                                <tr>
                                    <th><i class=""></i> Miles</th>
                                    <td>{{ $item->vehicle_runs }}</td>
                                </tr>
                                <tr>
                                    <th><i class=""></i> PRICING & PAYMENT</th>
                                    <td>{{ $item->pricing_payment }}</td>
                                </tr>
                                <tr>
                                    <th><i class=""></i> Auction</th>
                                    <td>{{ $item->auction }}</td>
                                </tr>
                                <tr>
                                    <th><i class=""></i> Auction Name</th>
                                    <td>{{ $item->auction_name }}</td>
                                </tr>
                                <tr>
                                    <th><i class=""></i> Stock Number</th>
                                    <td>{{ $item->vehicle_runs }}</td>
                                </tr>
                                <tr>
                                    <th><i class=""></i> Last of VIN</th>
                                    <td>{{ $item->last_of_vin }}</td>
                                </tr>
                                <tr>
                                    <th><i class=""></i> Key</th>
                                    <td>{{ $item->key }}</td>
                                </tr>
                                <tr>
                                    <th><i class=""></i> Vehicle First Available Date</th>
                                    <td>{{ $item->vehicle_first_available_date }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <h4  class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                        <i class="bi bi-hash mr-2"></i> Origin Information
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th><i class="bi bi-hash"></i> Origin Contact Name</th>
                                    <td>{{ $item->origin_contact_name }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-car"></i> Origin Email</th>
                                    <td>{{ $item->origin_email }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fa-solid fa-check-double"></i> Origin First Phone</th>
                                    <td>{{ $item->origin_first_phone }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fa-solid fa-location-dot"></i> Origin Second Phone</th>
                                    <td>{{ $item->origin_second_phone }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fa-solid fa-car-tunnel"></i> Origin Address</th>
                                    <td>{{ $item->origin_address ?? 'NULL' }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fa-solid fa-location-dot"></i> Origin Zip Code</th>
                                    <td>{{ $item->origin_city_zip_state }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-6">
                    <h4 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                        <i class=" mr-2"></i> Destination Information
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th><i class="fa-solid fa-hand-holding-dollar"></i> Destination Contact Name</th>
                                    <td>{{ $item->destination_contact_name }}</td>
                                </tr>
                                <tr>
                                    <th><i class="fa-solid fa-money-bill-transfer"></i> Destination Email</th>
                                    <td>{{ $item->destination_email }}</td>
                                </tr>
                                <tr>
                                    <th><i class=""></i> Destination First Phone</th>
                                    <td>{{ $item->destination_first_phone }}</td>
                                </tr>
                                <tr>
                                    <th><i class=""></i> Destination Second Phone</th>
                                    <td>{{ $item->destination_second_phone }}</td>
                                </tr>
                                <tr>
                                    <th><i class=""></i> Destination Address</th>
                                    <td>{{ $item->destination_address ?? 'NULL' }}</td>
                                </tr>
                                <tr>
                                    <th><i class=""></i> Destination Zip Code</th>
                                    <td>{{ $data->routes->Dest_ZipCode }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            {{-- <div class="form-group">
                <label for="terms_condition">Terms & Conditions</label>
                
                <div id="termsAccordion">
                    <div class="card">
                        <div class="card-header" id="headingTerms">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTerms" aria-expanded="true" aria-controls="collapseTerms">
                                    View Terms & Conditions
                                </button>
                            </h5>
                        </div>
            
                        <div id="collapseTerms" class="collapse show" aria-labelledby="headingTerms" data-parent="#termsAccordion">
                            <div class="card-body">
                                {{ $item->terms_condition }}
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
                      
                <input type="hidden" class="form-control"  name="user_id"
                    value="{{ $data->authorized_user->id }}">

                {{-- <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" class="form-control" 
                        name="full_name" value="{{ $item->full_name }}">
                </div>
                <div class="form-group">
                    <label for="first_phone">First Phone</label>
                    <input type="text" class="form-control" 
                        name="first_phone" value="{{ $item->first_phone }}">
                </div>
                <div class="form-group">
                    <label for="second_phone">Second Phone</label>
                    <input type="text" class="form-control" 
                        name="second_phone" value="{{ $item->second_phone }}">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" 
                        name="address" value="{{ $item->address }}">
                </div>
                <div class="form-group">
                    <label for="zip_code">Zip Code</label>
                    <input type="text" class="form-control" 
                        name="zip_code" value="{{ $item->zip_code }}">
                </div>
                <div class="form-group">
                    <label for="email_address">Email Address</label>
                    <input type="email" class="form-control"
                        name="email_address" value="{{ $item->email_address }}">
                </div>
                <div class="form-group">
                    <label for="carrier_type">Carrier Type</label>
                    <input type="text" class="form-control" 
                        name="carrier_type" value="{{ $item->carrier_type }}">
                </div>
                <div class="form-group">
                    <label for="vehicle_name">Vehicle Name</label>
                    <input type="text" class="form-control"  name="vehicle_name" value="{{ $item->vehicle_name }}">
                </div>
                <div class="form-group">
                    <!-- <label for="vehicle_runs">Vehicle Runs</label> -->
                    <label for="vehicle_runs">Miles</label>
                    <input type="text" class="form-control"
                        name="vehicle_runs" value="{{ $item->vehicle_runs }}">
                </div>
                <div class="form-group">
                    <label for="pricing_payment">PRICING & PAYMENT</label>
                    <input type="text" class="form-control"
                        name="pricing_payment" value="{{ $item->pricing_payment }}">
                </div>
                <div class="form-group">
                    <label for="auction">Auction</label>
                    <input type="text" class="form-control" 
                        name="auction" value="{{ $item->auction }}">
                </div>
                <div class="form-group">
                    <label for="auction_name">Auction Name</label>
                    <input type="text" class="form-control"
                        name="auction_name" value="{{ $item->auction_name }}">
                </div>
                <div class="form-group">
                    <label for="stock_number">Stock Number</label>
                    <input type="text" class="form-control"
                        name="stock_number"
                        value="{{ $item->stock_number }}">
                </div>
                <div class="form-group">
                    <label for="last_of_vin">Last of VIN</label>
                    <input type="text" class="form-control"
                        name="last_of_vin" value="{{ $item->last_of_vin }}">
                </div>
                <div class="form-group">
                    <label for="key">Key</label>
                    <input type="number" class="form-control" 
                        name="key" value="{{ $item->key }}">
                </div>
                <div class="form-group">
                    <label for="vehicle_first_available_date">Vehicle First Available Date</label>
                    <input type="text"
                        class="form-control"
                        name="vehicle_first_available_date"
                        value="{{ $item->vehicle_first_available_date }}">
                </div>
                <!-- Origin Information -->
                <h4>Origin Information</h4>
                <div class="form-group">
                    <label for="origin_contact_name">Origin Contact Name</label>
                    <input type="text" class="form-control"
                        name="origin_contact_name"
                        value="{{ $item->origin_contact_name }}">
                </div>
                <div class="form-group">
                    <label for="origin_email">Origin Email</label>
                    <input type="email" class="form-control"
                        name="origin_email" value="{{ $item->origin_email }}">
                </div>
                <div class="form-group">
                    <label for="origin_first_phone">Origin First Phone</label>
                    <input type="text" class="form-control"
                        name="origin_first_phone"
                        value="{{ $item->origin_first_phone }}">
                </div>
                <div class="form-group">
                    <label for="origin_second_phone">Origin Second Phone</label>
                    <input type="text" class="form-control"
                        name="origin_second_phone"
                        value="{{ $item->origin_second_phone }}">
                </div>
                <div class="form-group">
                    <label for="origin_address">Origin Address</label>
                    <input type="text" class="form-control"
                        name="origin_address" value="{{ $item->origin_address ?? 'NULL' }}">
                </div>
                <div class="form-group">
                    <label for="origin_zip_code">Origin Zip Code</label>
                    <input type="text" class="form-control"
                        name="origin_zip_code" value="{{ $item->origin_city_zip_state }}">
                </div>
                <!-- Destination Information -->
                <h4>Destination Information</h4>
                <div class="form-group">
                    <label for="destination_contact_name">Destination Contact Name</label>
                    <input type="text" class="form-control"
                        name="destination_contact_name"
                        value="{{ $item->destination_contact_name }}">
                </div>
                <div class="form-group">
                    <label for="destination_email">Destination Email</label>
                    <input type="email" class="form-control"
                        name="destination_email"
                        value="{{ $item->destination_email }}">
                </div>
                <div class="form-group">
                    <label for="destination_first_phone">Destination First Phone</label>
                    <input type="text" class="form-control"
                        name="destination_first_phone"
                        value="{{ $item->destination_first_phone }}">
                </div>
                <div class="form-group">
                    <label for="destination_second_phone">Destination Second Phone</label>
                    <input type="text" class="form-control"
                        name="destination_second_phone"
                        value="{{ $item->destination_second_phone }}">
                </div>
                <div class="form-group">
                    <label for="destination_address">Destination Address</label>
                    <input type="text" class="form-control"
                        name="destination_address"
                        value="{{ $item->destination_address ?? 'NULL' }}">
                </div>
                <div class="form-group">
                    <label for="destination_zip_code">Destination Zip Code</label>
                    <input type="text" class="form-control"
                        name="destination_zip_code" value="{{ $data->routes->Dest_ZipCode }}">
                </div> --}}
                <!-- Terms and Signature -->
                {{-- <div class="form-group">
                    <label for="terms_condition">Terms & Conditions</label>
                    <input type="text" class="form-control"  name="terms_condition"
                        value=" {{ $item->terms_condition }} ">
                </div> --}}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <h4  class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                                <i class="bi bi-hash mr-2"></i> Terms & Conditions
                            </h4>
                            {{-- <label for="terms_condition">Terms & Conditions</label> --}}
                            <div id="termsAccordion">
                                <div class="card">
                                    <div class="card-header text-center" id="headingTerms">
                                        <div class="price__cta-btn">
                                            <a class="fill-btn clip-sm-btn d-block">
                                                <button class="text-white" type="button" data-toggle="collapse" data-target="#collapseTerms" aria-expanded="false" aria-controls="collapseTerms">
                                                    View Terms & Conditions
                                                </button>
                                            </a>
                                        </div>
                                        {{-- <h5 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTerms" aria-expanded="false" aria-controls="collapseTerms">
                                                View Terms & Conditions
                                            </button>
                                        </h5> --}}
                                    </div>
                                    <div id="collapseTerms" class="collapse" aria-labelledby="headingTerms" data-parent="#termsAccordion">
                                        <div class="card-body">
                                            {{ $item->terms_condition }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Additional Information -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4  class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                            <i class="bi bi-hash mr-2"></i> Additional Information
                        </h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Section</th>
                                        <th>Information</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Additional Vehicle Information</strong></td>
                                        <td>{{ $item->additional_vehicle_information }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Your Name</strong></td>
                                        <td>{{ $item->your_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Your Signature</strong></td>
                                        <td>{{ $item->your_signature }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                {{-- <div class="form-group">
                    <label for="additional_vehicle_information">Additional Vehicle Information</label>
                    <textarea class="form-control" name="additional_vehicle_information" rows="3">{{ $item->additional_vehicle_information }}</textarea>
                </div>
                <div class="form-group">
                    <label for="your_name">Your Name</label>
                    <input type="text" class="form-control"  name="your_name" value="{{ $item->your_name }} ">
                </div>
                <div class="form-group">
                    <label for="your_signature">Your Signature</label>
                    <input type="text" class="form-control"  name="your_signature" value="{{ $item->your_signature }} ">
                </div> --}}
        </div>
    </div>
</section>
    <!-- Bootstrap JS -->
    <!-- jQuery, Popper.js, and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
