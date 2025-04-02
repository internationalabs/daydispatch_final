<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f8;
            color: #333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            margin-top: 20px;
        }

        .event {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .invoice-table {
            width: 100%;
            margin-bottom: 30px;
        }

        .invoice-table thead {
            background-color: #007bff;
            color: white;
            border-radius: 5px 5px 0 0;
        }

        .invoice-table th, .invoice-table td {
            padding: 15px;
            text-align: left;
        }

        .invoice-table tbody tr {
            transition: background-color 0.3s;
        }

        .invoice-table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .details {
            margin-top: 30px;
        }

        .details .info {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .details table {
            width: 100%;
        }

        .details th, .details td {
            padding: 15px;
            text-align: left;
        }

        .details th {
            background-color: #f8f9fa;
        }

        .img-gallery img {
            cursor: pointer;
            margin: 10px;
            max-width: 200px;
            max-height: 150px;
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .img-gallery img:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .modal-dialog {
            max-width: 90%;
            margin: auto;
        }

        .modal-content {
            background: #000;
            border-radius: 15px;
        }

        .modal-body {
            text-align: center;
        }

        .modal-body img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
        /* Container to hold all content */
        .container {
            font-family: Arial, sans-serif; /* Use your preferred font */
            /* margin: 20px; Adjust margin as needed */
        }

        /* Section for informational content */
        .info-section {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .info-section-2 {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
        /* Style each information item */
        .info-item {
            margin-bottom: 15px; /* Space between items */
        }

        /* Style for labels */
        .info-label {
            font-weight: bold;
            color: #333; /* Darker color for labels */
            margin-bottom: 5px;
        }

        /* Style for values */
        .info-value {
            color: #555; /* Lighter color for values */
        }
        .header {
        background-color: #f8f9fa; /* Light gray background for contrast */
        color: #333; /* Dark text color for readability */
        padding: 15px 30px; /* Increased padding for better spacing */
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-radius: 0 0 20px 20px; /* Slightly larger border-radius */
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        margin-bottom: 20px;
        }

        .header img {
            max-height: 60px; /* Slightly larger logo for visibility */
            margin-left: 20px;
        }

        .header span {
            margin: 0 10px; /* Spacing between equipment details */
            font-size: 16px; /* Slightly larger font size */
            font-weight: 500; /* Medium font weight for emphasis */
        }

        .header .copy-link {
            background: #007bff; /* Primary blue color for the button */
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            color: white;
            transition: background-color 0.3s, box-shadow 0.3s; /* Smooth transition for hover effect */
        }

        .header .copy-link:hover {
            background-color: #0056b3; /* Darker blue on hover */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); /* Deeper shadow on hover */
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header img {
                margin: 0 0 10px 0; /* Margin adjustment for stacked layout */
            }

            .header .copy-link {
                margin-top: 10px; /* Margin adjustment for stacked layout */
            }
        }



    </style>
</head>
<body>
    <div class="header">
        <img src="http://127.0.0.1:8000/frontend/img/logo/logo.png" alt="Logo">

        <button class="copy-link" onclick="copyLink()">Copy Link</button>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="event">
                <div class="container">
                    <div class="info-section-2">
                        @if($Lisiting->Listing_Type === 1)
                        @foreach($Lisiting->vehicles as $item)
                            <div class="info-item">
                                <!-- <p class="info-label">Year:</p> -->
                                <p class="info-value">{{ $item->Vehcile_Year}} {{ $item->Vehcile_Make}} {{ $item->Vehcile_Model}}</p>
                            </div>

                            <!-- <div class="info-item">
                                <p class="info-label">Make:</p>
                                <p class="info-value">{{ $item->Vehcile_Make}}</p>
                            </div>
                            <div class="info-item">
                                <p class="info-label">Model:</p>
                                <p class="info-value">{{ $item->Vehcile_Model}}</p>
                            </div> -->

                        @endforeach
                        @endif

                        @if($Lisiting->Listing_Type === 2)
                        @foreach($Lisiting->heavy_equipments as $item)
                            <div class="info-item">
                                <!-- <p class="info-label">Make:</p> -->
                                <p class="info-label">{{ $item->Equipment_Year }} {{ $item->Equipment_Make }} {{ $item->Equipment_Model }}</p>
                            </div>
                            <!-- <div class="info-item">
                                <p class="info-label">Model:</p>
                                <p class="info-value">{{ $item->Equipment_Model }}</p>
                            </div>
                            <div class="info-item">
                                <p class="info-label">Year:</p>
                                <p class="info-value">{{ $item->Equipment_Year }}</p>
                            </div> -->
                        @endforeach
                        @endif
                    </div>
                    <div>
                        @if($Lisiting->Listing_Type === 1)
                        <p>{{ isset($Lisiting->vehicles->Vin_Number) ? $Lisiting->vehicles->Vin_Number : '' }}</p>
                        @endif
                    </div>
                </div>
                    <div class="map-container mt-2">
                <iframe
                    src="https://www.google.com/maps/embed?pb=YOUR_MAP_EMBED_URL_HERE"
                    width="100%"
                    height="300"
                    frameborder="0"
                    style="border:0;"
                    allowfullscreen=""
                    aria-hidden="false"
                    tabindex="0">
                </iframe>
                </div>
                <div class="container">
                    <div class="info-section row">
                    <div class="info-item col-12">
                        <p class="info-label">
                            <i class="fas fa-id-card" style="color: #1F2E63;"></i>
                            Ref ID: {{ $Lisiting->Ref_ID }}
                        </p>
                    </div>
                    <br>
                    <div class="info-item col-12">
                        <p class="info-label">
                            {{-- <i class="fas fa-map-marker-alt" style="color: #28a745;"></i>  --}}
                            {{ $Lisiting->routes->Origin_ZipCode }}
                            <span style="font-weight: 100; color: #1F2E63;">
                                <i class="fas fa-calendar-day" style="color: #1F2E63;"></i> {{ $Lisiting->pickup_delivery_info->Pickup_Date }}
                            </span>
                        </p>
                    </div>
                    <br>
                    <div class="info-item col-12">
                        <p class="info-label">
                            {{-- <i class="fas fa-map-marker-alt" style="color: #dc3545;"></i>  --}}
                            {{ $Lisiting->routes->Dest_ZipCode }}
                            <span style="font-weight: 100; color: #1F2E63;">
                                <i class="fas fa-calendar-day" style="color: #1F2E63;"></i> {{ $Lisiting->pickup_delivery_info->Delivery_Date }}
                            </span>
                        </p>
                    </div>

                        <!-- <div class="info-item">
                            <p class="info-label">Pickup Date:</p>
                            <p class="info-value">{{$Lisiting->pickup_delivery_info->Pickup_Date}}</p>
                        </div> -->
                        <!-- <div class="info-item">
                            <p class="info-label">Delivery Date:</p>
                            <p class="info-value">{{$Lisiting->pickup_delivery_info->Delivery_Date}}</p>
                        </div> -->

                    </div>
                </div>

            </div>
            <div class="accordion mt-4" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Damage Code Definitions
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ul>
                                    <li>BR - Broken</li>
                                    <li>CH - Chipped</li>
                                    <li>CR - Cracked</li>
                                    <li>D - Dented</li>
                                    <li>F - Faded</li>
                                    <li>FF - Foreign Fluid</li>
                                    <li>FT - Flat Tire</li>
                                    <li>G - Gouge</li>
                                    <li>HD - Hail Damage</li>
                                    <li>LC - Loose Contents</li>
                                    <li>M - Missing</li>
                                    <li>MD - Major Damage</li>
                                    <li>MS - Multiple Scratches</li>
                                    <li>O - Other</li>
                                    <li>PC - Paint Chip</li>
                                    <li>R - Rubbed</li>
                                    <li>RU - Rust</li>
                                    <li>S - Scratched</li>
                                    <li>SC - Scuffed</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <table class="invoice-table table table-striped">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-center">Order Tracking History</th>
                        </tr>
                        <tr>
                            <th>Order Status</th>
                            <th>Order Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tracking_history->all_listing->history as $record)
                            <tr>
                                <td>{{ $record->status }}</td>
                                <td>{{ $record->created_at }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">Order Tracking History Not Found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>


                <h1 class="mb-4" style="color: #007bff;">Pickup Inspection</h1>
                <h3 class="mb-4">Inspection Images:</h3>
                <div class="img-gallery">
                    @if(isset($onlinebol->online_bol_imgs))
                        @foreach ($onlinebol->online_bol_imgs as $img)
                            <img src="{{ $img->photo_name }}" alt="Pickup Image" class="img-fluid" width="50" height="50">
                        @endforeach
                    @endif
                </div>
                <div class="details">
                    <table class="table">
                        <tr>
                            <th>Odometer</th>
                            <th>Inspection notes</th>

                        </tr>
                        <tr>
                        <td>{{ $onlinebol->no_odometer ?? 'NULL' }}</td>
                            <td>{{ $onlinebol->no_inspection_note ?? 'NULL' }}</td>
                        </tr>
                    </table>

                    <div class="info">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Loose Items</th>
                                    <th>Number/Condition</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(isset($onlinebol->online_bol_items))
                                @foreach ($onlinebol->online_bol_items as $item)
                                    <tr>
                                        <td><strong>{{ $item->item_name }}</strong></td>
                                        <td>{{ $item->condition }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <h1 class="mt-4" style="color: #007bff;">Delivery Inspection</h1>
                <h3 class="mb-4">Inspection Images:</h3>
                <div class="img-gallery">
                    @if(isset($pickuponlinebol->pickup_online_bol_imgs))
                        @foreach ($pickuponlinebol->pickup_online_bol_imgs as $img)
                            <img src="{{ $img->photo_name }}" alt="Delivery Image" class="img-fluid" width="50" height="50">
                        @endforeach
                    @endif
                </div>

                <div class="details">
                    <table class="table">
                        <tr>
                            <th>Odometer</th>
                            <td>{{ $pickuponlinebol->deliver_no_odometer ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <th>Inspection notes</th>
                            <td>{{ $pickuponlinebol->deliver_no_inspection_note ?? 'NULL' }}</td>
                        </tr>
                    </table>

                    <div class="info">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Loose Items</th>
                                    <th>Number/Condition</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(isset($pickuponlinebol->pickup_online_bol_items))
                                @foreach ($pickuponlinebol->pickup_online_bol_items as $item)
                                    <tr>
                                        <td><strong>{{ $item->item_name }}</strong></td>
                                        <td>{{ $item->condition }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="row">
            <div class="col-md-12">

            </div>
        </div>


        <div class="row">
            <div class="col-md-6">

            </div>


            <div class="col-md-6">

            </div>
        </div> -->
    </div>


    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="" alt="Full-Screen Image">
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function copyLink() {
            // Get the current URL
            var link = window.location.href;

            // Create a temporary input element
            var tempInput = document.createElement('input');
            tempInput.value = link;
            document.body.appendChild(tempInput);

            // Select and copy the text
            tempInput.select();
            document.execCommand('copy');

            // Remove the temporary input element
            document.body.removeChild(tempInput);

            // Alert the user
            alert('Link copied to clipboard!');
        }

        $('#imageModal').on('show.bs.modal', function (e) {
            var imgSrc = $(e.relatedTarget).data('src');
            $(this).find('.modal-body img').attr('src', imgSrc);
        });
    </script>
</body>
</html>
