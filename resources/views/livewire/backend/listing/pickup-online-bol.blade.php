<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Inspection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <style>
        #map {
            height: 250px;
            width: 100%;
        }
    </style>
    <style>
        /* .image-wrapper {
            width: 100%;
            height: auto;
            Fixed height for uniformity
            overflow: hidden;
            border-radius: 8px;
            Optional: Rounded corners
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .img-cover {
            width: 100%;
            height: 100%;
            object-fit: cover;
            Ensures image fills the container
        } */

        #imageModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
        }

        .pickup_check {
            margin-right: 5px;
            transform: scale(1.2);
            /* Makes the checkbox slightly bigger */
            cursor: pointer;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
        }

        .main {
            /*display: flex;*/
            margin-top: 20px;
        }

        .main .left {
            flex: 2;
            margin-right: 20px;
        }

        .main .left .map {
            margin-bottom: 20px;
        }

        .main .left .timeline {
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 4px;
        }

        .main .left .timeline .event {
            margin-bottom: 10px;
        }

        .main .left .timeline .event:last-child {
            margin-bottom: 0;
        }

        .main .right {
            flex: 3;
        }

        .main .right .vehicle-info {
            margin-bottom: 20px;
        }

        .main .right .vehicle-info h2 {
            font-size: 20px;
            margin: 0 0 10px 0;
        }

        .main .right .vehicle-info .details {
            display: flex;
        }

        .main .right .vehicle-info .details .image {
            flex: 1;
            margin-right: 20px;
        }

        .main .right .vehicle-info .details .info {
            flex: 2;
        }

        .main .right .vehicle-info .details .info table {
            width: 100%;
            border-collapse: collapse;
        }

        .main .right .vehicle-info .details .info table th,
        .main .right .vehicle-info .details .info table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            color: #888;
        }


        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation - Zoom in the Modal */
        .modal-content,
        #caption {
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        /*----------- image modal style start ----------*/

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 20px;
        }

        .image-wrapper {
            height: 200px;
            /* Adjust as needed */
            width: 100%;
            position: relative;
            overflow: hidden
        }

        .image-wrapper img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .highlight {
            position: absolute;
            border: 2px solid rgba(255, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 12px;
            font-weight: bold;
        }

        .highlight-label {
            position: absolute;
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            padding: 2px 5px;
            border-radius: 3px;
            font-size: 12px;
        }

        .button-wrapper {
            text-align: center;
            margin-top: 20px;
        }

        .button-wrapper button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .table-wrapper {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        .modal-body img {
            max-width: 100%;
            height: auto;
        }

        /*----------- image modal style end----------*/
    </style>
    <style>
        .extra-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.5rem;
            font-weight: bold;
            cursor: pointer;
        }

        .signature {
            font-family: 'Dancing Script', cursive;
            /* Elegant handwritten font */
            font-size: 26px;
            font-weight: 500;
            color: #2c3e50;
            /* Dark ink effect */
            display: inline-block;
            transform: rotate(-2deg);
            /* Subtle tilt for authenticity */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
            /* Soft shadow for depth */
            border-bottom: 2px solid rgba(0, 0, 0, 0.2);
            /* Mimic handwritten underline */
            padding-bottom: 5px;
            letter-spacing: 1px;
        }
    </style>

    <style>
        .modal-xl {
            max-width: 90%; /* Increase modal width */
        }

        .upload-label {
            font-size: 18px;
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }

        #inspectionImages {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #f9f9f9;
        }

    </style>

    <style>
        .img-fluid2 {
            max-width: 100%;
            height: 120px;
        }
    </style>
</head>

<body>
<div class="container mt-4">

    @if (session('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div id="error-message" class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <?php

    use Illuminate\Support\Facades\DB;

    $mapUrl = "";
    if (!function_exists('getLatLon')) {
        function getLatLon($zip)
        {
            return DB::table('zip_codes')
                ->select('latitude as lat', 'longitude as lon')
                ->where('zipcode', $zip)
                ->first(); // Fetch a single matching record
        }
    }

// Extract only numbers from zip codes
    $originZip = isset($Lisiting->routes->Origin_ZipCode) ? preg_replace('/\D/', '', $Lisiting->routes->Origin_ZipCode) : null;
    $destZip = isset($Lisiting->routes->Dest_ZipCode) ? preg_replace('/\D/', '', $Lisiting->routes->Dest_ZipCode) : null;

    $originCoords = $originZip ? getLatLon($originZip) : null;
    $destCoords = $destZip ? getLatLon($destZip) : null;

// Ensure valid coordinates before generating the map URL
    if ($originCoords && $destCoords) {
        $mapUrl = "https://www.openstreetmap.org/export/embed.html?bbox="
            . $originCoords->lon . "," . $originCoords->lat . ","
            . $destCoords->lon . "," . $destCoords->lat
            . "&layer=mapnik&marker=" . $originCoords->lat . "," . $originCoords->lon;
    }


    ?>

    <form action="{{ route('pickup.store.online.bol') }}" id="myForm" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="order_id" value="{{ $Lisiting->id }}">
        <input type="hidden" name="marked_img_form" id="marked_img_form" value="">

        <div class="header">
            <h1>Online BOL</h1>
            <a href="#" onclick="copyCurrentURL(event)" class="copy-link btn btn-primary">
                Copy Link
            </a>
            <span id="copy-message" style="display: none;" class="text-secondary ml-2">
                    Link Copied!
                </span>
        </div>
        <div class="row">
            <!-- Left Section -->
            <div class="col-md-4">
                <div class=" ">
                    <iframe height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                            src="{{$mapUrl}}"
                            style="border: 1px solid white" class="col-12">
                    </iframe>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order ID {{ $Lisiting->Ref_ID }}</h5>
                        <p><strong>Pickup:</strong> {{ $Lisiting->pickup_delivery_info->Pickup_Date }}</p>
                        <p><strong>Delivery:</strong> {{ $Lisiting->pickup_delivery_info->Delivery_Date }}</p>

                        @if(isset($Lisiting->request_broker->Pickup_Date))
                            <h6 class="text-success">Carrier </h6>
                            <p><strong>Pickup:</strong> {{ $Lisiting->request_broker->Pickup_Date }}</p>
                            <p><strong>Delivery:</strong> {{ $Lisiting->request_broker->Delivery_Date }}</p>
                            <p><strong>Accepted:</strong> {{ $Lisiting->request_broker->created_at }}</p>
                        @endif
                        @if(isset($Lisiting->history_pick->created_at))
                            <p><strong>Picked Up: {{$Lisiting->history_pick->created_at}}</strong> </p>
                        @endif
                    </div>
                </div>
                <div class="col-md-12 accordion mt-4" id="accordionExample">
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
                <div class="col-md-12 accordion mt-4" id="accordionExample">
                    <div class="accordion-item">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th colspan="2" class="text-center"><b>Order Tracking History</b></th>
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
                                    <td colspan="2" class="text-center">Order Tracking History Not Found.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Right Section -->
            <div class="col-md-8 d-flex gap-3">
                <div class="card col-md-6">
                    <div class="col-md-12 accordion mt-4" id="accordionExample">
                         <div class="card-body">
                            <h4>
                                @foreach ($Lisiting->vehicles as $vehicle)
                                    <span>{{ $vehicle->Vehcile_Year }}</span>
                                    <span>{{ $vehicle->Vehcile_Make }}</span>
                                    <span>{{ $vehicle->Vehcile_Model }}</span>
                                @endforeach
                            </h4>

                        <h4>Pickup Images</h4>
                        <div class="row mt-3" id="imageGallery2"></div>
                         <h4>Delivered Images</h4>
                         @if ($auth_user->usr_type == 'Carrier' &&  empty($pickuponlinebol))
                             <div class="mb-3">
                                 <div class="input-group">
                                     <input type="file" class="form-control d-none" id="inspectionImages" multiple>
                                     <input type="text" class="form-control form-control-sm" id="fileLabel" placeholder="No file selected" readonly>
                                     <button type="button" class="btn btn-sm btn-outline-primary" id="selectFiles">
                                         <i class="fas fa-upload"></i>
                                     </button>
                                 </div>
                                 <small class="text-muted">Upload Delivered Inspection Images</small>
                             </div>
                         @endif
                         <div class="row mt-3" id="imageGallery"></div>

                        <div class="mt-4">
                            <h4>Note:</h4>
                            <hr>
                            <p style="font-weight:700 ">I Agree with the drivers assesment of the condition of this
                                vehicle</p>
                            <p>Origin Signature: <span
                                    class="signature">{{ $Lisiting->agreement->Agreement_Signature ?? '' }}</span>
                            </p>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="card col-md-6">
                    <div class="col-md-12 accordion mt-4" id="accordionExample">
                        <div class="card-body">
                            <h4 style="text-align: center">Loose Items</h4>
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead class="border-bottom">
                                    <tr>
                                        <th>Loose Items</th>
                                        <th     >Number/Condition</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody class="form_field_outer">

                                    <tr>
                                        <td colspan="3" style="text-align: center">Pickup Lose Items</td>
                                    </tr>
                                    @if(!empty($onlinebol->online_bol_items) && count($onlinebol->online_bol_items) > 0)
                                        @foreach ($onlinebol->online_bol_items as $item)
                                            <tr>
                                                <td><strong>{{ $item->item_name }}</strong></td>
                                                <td colspan="2">{{ $item->condition }}</td>
                                            </tr>
                                        @endforeach
                                    @else

                                    @endif

                                    <tr>
                                        <td colspan="3" style="text-align: center">Delivered Lose Items</td>
                                    </tr>

                                    @if(!empty($pickuponlinebol->pickup_online_bol_items) && count($pickuponlinebol->pickup_online_bol_items) > 0)
                                        @foreach ($pickuponlinebol->pickup_online_bol_items as $item)
                                            <tr>
                                                <td><strong>{{ $item->item_name }}</strong></td>
                                                <td>{{ $item->condition }}</td>
                                            </tr>
                                        @endforeach
                                    @else

                                    @endif

                                    </tbody>
                                </table>
                            </div>
                            @if(empty($pickuponlinebol))
                            <button type="button" class="btn btn-outline-primary mt-3 add_new_frm_field_btn">
                                <i class="fas fa-plus add_icon"></i> Add New Field Row
                            </button>
                            @endif
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        @if ($auth_user->usr_type == 'Carrier' && empty($pickuponlinebol))
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="checkbox" name="delivered" class="" style="width: 15px;height: 15px">
                        Mark Delivered
                    </div>
                </div>
            </div>
            <br/>
            <button type="submit" class="btn btn-primary">Submit Delivered Bol</button>
        @endif
    </form>

    <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewModalLabel">Mark Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center" id="imageWrapper2">
                    <img id="previewImage" src="" class="img-fluid" alt="Selected Image">
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-primary" onclick="enableDrawing2()">Enable
                        Highlighting</button> --}}
                    {{-- <button type="button" class="btn btn-secondary" onclick="disableDrawing2()">Disable
                        Highlighting</button> --}}
                    <button type="button" class="btn btn-danger" onclick="clearHighlights2()">Clear
                        Highlights
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveToTable2()">Save Markings</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">  <!-- Changed modal-lg to modal-xl -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Select Inspection Images</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <label for="inspectionImages" class="upload-label">Upload Inspection Images</label>
                    <input type="file" class="form-control-file" id="inspectionImages" multiple/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="loadImages()">Upload Images</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="markingModal" tabindex="-1" role="dialog" aria-labelledby="markingModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="markingModalLabel">Select Marking Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <select id="markingType" class="form-control">
                        <option value="BR">BR - Broken</option>
                        <option value="CH">CH - Chipped</option>
                        <option value="CR">CR - Cracked</option>
                        <option value="D">D - Dented</option>
                        <option value="F">F - Faded</option>
                        <option value="FF">FF - Foreign Fluid</option>
                        <option value="FT">FT - Flat Tire</option>
                        <option value="G">G - Gouge</option>
                        <option value="HD">HD - Hail Damage</option>
                        <option value="LC">LC - Loose Contents</option>
                        <option value="M">M - Missing</option>
                        <option value="MD">MD - Major Damage</option>
                        <option value="MM">MM - Minor Marks</option>
                        <option value="P">P - Paint</option>
                        <option value="S">S - Scratched</option>
                        <option value="T">T - Torn</option>
                        <option value="W">W - Water Damage</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="confirmMarking()">Confirm
                        Marking
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="imageModal2" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img id="modalImage" class="img-fluid2" src="">
                    <div class="d-flex justify-content-between mt-2">
                        <button type="button" class="btn btn-secondary"
                                onclick="prevImage2()">&#8592; Prev</button>
                        <button type="button" class="btn btn-secondary"
                                onclick="nextImage2()">Next &#8594;</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Modal -->
    <div class="modal fade" id="mimageModal" tabindex="-1" aria-labelledby="mimageModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mimageModalLabel">Image Preview</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="modalImage2" src="" alt="Inspection Image"
                             class="img-fluid">
                        <!-- Previous and Next Buttons -->
                        <div class="d-flex justify-content-between w-96 ">
                            <button id="prevButton" class="btn btn-primary">Previous</button>
                            <button id="nextButton" class="btn btn-primary">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
<!-- Image Preview Modal -->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>

<!-- MULTI ROW SCRIPT START -->
<script>


    let images2 = @json(optional($onlinebol?->online_bol_imgs)->pluck('photo_name') ?? []);

    let gallery2 = document.getElementById("imageGallery2");
    images2.forEach((src, index) => {
        if (index < 3) {
            gallery2.innerHTML += `<div class='col-6 mt-3'><img src='${src}' class='img-fluid2' onclick='openModal(${index})'></div>`;
        } else if (index === 3) {
            gallery2.innerHTML += `<div class='col-6 mt-3 '>
                                        <img src='${src}' class='img-fluid2' onclick='openModal(${index})'>
                                        <div class='extra-overlay' onclick='openModal(${index})'>+${images2.length - 4}</div>
                                    </div>`;
        }
    });
    let images3 = @json(optional($pickuponlinebol?->pickup_online_bol_imgs)->pluck('photo_name') ?? []);

    let gallery3 = document.getElementById("imageGallery");
    images3.forEach((src, index) => {
        if (index < 3) {
            gallery3.innerHTML += `<div class='col-6 mt-3'><img src='${src}' class='img-fluid2' onclick='openModal(${index})'></div>`;
        } else if (index === 3) {
            gallery3.innerHTML += `<div class='col-6 mt-3'>
                                        <img src='${src}' class='img-fluid2' onclick='openModal(${index})'>
                                        <div class='extra-overlay' onclick='openModal(${index})'>+${images3.length - 4}</div>
                                    </div>`;
        }
    });


    let modalImage = document.getElementById("modalImage");
    let currentIndex3 = 0;

    function openModal(index) {
        currentIndex3 = index;
        modalImage.src = images2[currentIndex3];
        let modal = new bootstrap.Modal(document.getElementById("imageModal2"));
        modal.show();
    }

    function prevImage2() {
        currentIndex3 = (currentIndex3 - 1 + images2.length) % images2.length;
        modalImage.src = images2[currentIndex3];
    }

    function nextImage2() {
        currentIndex3 = (currentIndex3 + 1) % images2.length;
        modalImage.src = images2[currentIndex3];
    }

    $(document).ready(function () {


        $("#selectFiles").on("click", function () {
            $("#inspectionImages").click();
        });

        // Auto-upload images when selected
        $("#inspectionImages").on("change", function () {
            let files = this.files;
            if (!files.length) return;

            let fileNames = Array.from(files).map(file => file.name).join(", ");
            $("#fileLabel").val(fileNames || "No file selected");

            // Load and preview images automatically
            loadImages(files);
        });


        var options = [
            "Keys", "Remotes", "Headrests", "Drivable", "Windscreen", "Glass (all intact)",
            "Title", "Cargo Cover", "Spare Tire", "Radio", "Manual(s)", "Navigation Disk",
            "Plugin Charger Cable", "Headphones", "Other" // Added "Other" option
        ];

        function updateDropdownOptions() {
            var selectedValues = [];
            $(".form_field_outer_row select").each(function () {
                if ($(this).val() && $(this).val() !== 'Other') {
                    selectedValues.push($(this).val());
                }
            });

            $(".form_field_outer_row select").each(function () {
                var currentValue = $(this).val();
                $(this).empty().append('<option>--Select item--</option>');

                options.forEach(function (option) {
                    if (selectedValues.indexOf(option) === -1 || option === currentValue) {
                        $(this).append(`<option value="${option}">${option}</option>`);
                    }
                }.bind(this));

                $(this).val(currentValue);
            });

            if (selectedValues.length >= options.length - 1) { // Exclude "Other"
                $(".add_new_frm_field_btn").addClass('disabled');
            } else {
                $(".add_new_frm_field_btn").removeClass('disabled');
            }
        }

        $("body").on("click", ".add_new_frm_field_btn", function () {
            if ($(this).hasClass('disabled')) return;

            var index = $(".form_field_outer").find(".form_field_outer_row").length + 1;

            var dropdownHtml = '<select name="loose_items[]" id="loose_items_' + index +
                '" class="form-control">';
            dropdownHtml += '<option>--Select item--</option>';
            options.forEach(function (option) {
                dropdownHtml += '<option value="' + option + '">' + option + '</option>';
            });
            dropdownHtml += '</select>';

            $(".form_field_outer").append(`
                        <tr class="form_field_outer_row">
                            <td>${dropdownHtml}<input type="text" class="form-control other-input" name="other_item_${index}" style="display: none;" placeholder="Enter custom item"></td>
                            <td><input type="text" class="form-control" name="number_condition[]" id="number_condition_${index}" placeholder="Enter number/condition" /></td>
                            <td><button class="btn btn-danger remove_node_btn_frm_field"><i class="fas fa-trash-alt"></i></button></td>
                        </tr>
                        `);
            updateDropdownOptions();
        });

        $("body").on("click", ".remove_node_btn_frm_field", function () {
            $(this).closest(".form_field_outer_row").remove();
            updateDropdownOptions();
        });

        $("body").on("change", ".form_field_outer_row select", function () {
            var $select = $(this);
            var $otherInput = $select.closest(".form_field_outer_row").find(".other-input");

            if ($select.val() === 'Other') {
                $select.hide();
                $otherInput.show().focus();
            } else {
                $select.show();
                $otherInput.hide();
                $otherInput.val('');
            }

            updateDropdownOptions();
        });

        updateDropdownOptions();
    });
</script>
<!-- MULTI ROW SCRIPT END -->

<script>
    document.getElementById('myForm').addEventListener('submit', function (event) {
        // Get the input field and error message elements
        // var keyInput = document.getElementById('key');
        // var keyError = document.getElementById('keyError');

        // Check if the input field is empty
        if (keyInput.value.trim() === '') {
            // Prevent the form from being submitted
            event.preventDefault();
            // Show the error message
            keyError.style.display = 'block';
        } else {
            // Hide the error message if the input is not empty
            keyError.style.display = 'none';
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Function to hide the alert after a certain time
        function hideAlertAfterDelay(elementId, delay) {
            var element = document.getElementById(elementId);
            if (element) {
                setTimeout(function () {
                    element.style.opacity = '0';
                    setTimeout(function () {
                        element.style.display = 'none';
                    }, 500); // match the duration of the fade-out transition
                }, delay);
            }
        }

        // Hide the success message after 30 seconds (30000 milliseconds)
        hideAlertAfterDelay('success-message', 30000);
        // Hide the error message after 30 seconds (30000 milliseconds)
        hideAlertAfterDelay('error-message', 30000);
    });
</script>

<!-- ----------- image modal script start ---------- -->
<script>
    // let isDrawing = false;
    // let startX, startY;
    // const $imageWrapper = $("#imageWrapper");
    // const $highlightsTable = $("#highlightsTable tbody");
    // const colors = ["red", "blue", "green", "yellow", "purple", "orange", "pink", "brown"];
    // let colorIndex = 0;
    // let images = [];
    // let currentImageIndex = 0;
    // let currentHighlight = null;
    //
    //
    // function enableDrawing() {
    //     imageWrapper.addEventListener("mousedown", startDraw);
    //     imageWrapper.addEventListener("mousemove", draw);
    //     imageWrapper.addEventListener("mouseup", endDraw);
    // }
    //
    // function disableDrawing() {
    //     imageWrapper.removeEventListener("mousedown", startDraw);
    //     imageWrapper.removeEventListener("mousemove", draw);
    //     imageWrapper.removeEventListener("mouseup", endDraw);
    // }
    //
    // function startDraw(e) {
    //     isDrawing = true;
    //     startX = e.offsetX;
    //     startY = e.offsetY;
    //
    //     const highlight = document.createElement("div");
    //     highlight.className = "highlight";
    //     highlight.style.left = `${startX}px`;
    //     highlight.style.top = `${startY}px`;
    //     highlight.style.borderColor = colors[colorIndex];
    //     // highlight.style.backgroundColor = `rgba(${hexToRgb(colors[colorIndex])}, 0.3)`;
    //     highlight.dataset.startX = startX;
    //     highlight.dataset.startY = startY;
    //     highlight.dataset.color = colors[colorIndex];
    //     highlight.style.zIndex = 1000;
    //
    //     imageWrapper.appendChild(highlight);
    //     currentHighlight = highlight;
    // }
    //
    // function draw(e) {
    //     if (!isDrawing) return;
    //
    //     const width = e.offsetX - startX;
    //     const height = e.offsetY - startY;
    //
    //     currentHighlight.style.width = `${Math.abs(width)}px`;
    //     currentHighlight.style.height = `${Math.abs(height)}px`;
    //     currentHighlight.style.left = `${Math.min(startX, e.offsetX)}px`;
    //     currentHighlight.style.top = `${Math.min(startY, e.offsetY)}px`;
    // }
    //
    // function endDraw() {
    //     if (isDrawing) {
    //         isDrawing = false;
    //         $('#markingModal').modal('show');
    //     }
    // }
    //
    // function confirmMarking() {
    //     const markingType = document.getElementById("markingType").value;
    //     currentHighlight.dataset.type = markingType;
    //     const label = document.createElement("div");
    //     label.className = "highlight-label";
    //     label.textContent = markingType;
    //     currentHighlight.appendChild(label);
    //     colorIndex = (colorIndex + 1) % colors.length;
    //     $('#markingModal').modal('hide');
    // }
    //
    // function hexToRgb(hex) {
    //     let r = 0,
    //         g = 0,
    //         b = 0;
    //     if (hex.length === 4) {
    //         r = parseInt(hex[1] + hex[1], 16);
    //         g = parseInt(hex[2] + hex[2], 16);
    //         b = parseInt(hex[3] + hex[3], 16);
    //     } else if (hex.length === 7) {
    //         r = parseInt(hex[1] + hex[2], 16);
    //         g = parseInt(hex[3] + hex[4], 16);
    //         b = parseInt(hex[5] + hex[6], 16);
    //     }
    //     return `${r},${g},${b}`;
    // }
    //
    // function saveToTable() {
    //     html2canvas(imageWrapper, {
    //         useCORS: true
    //     }).then(canvas => {
    //         const dataUrl = canvas.toDataURL();
    //         const row = highlightsTable.insertRow();
    //
    //         // Create and insert the image cell
    //         const imgCell = row.insertCell(0);
    //         const imgElement = document.createElement("img");
    //         imgElement.src = dataUrl;
    //         imgElement.classList.add('marked_img');
    //         imgElement.alt = "Inspection Image";
    //         imgElement.style.width = "100px";
    //         imgElement.style.height = "auto";
    //         imgCell.appendChild(imgElement);
    //
    //         // Log the src attribute value of the image
    //         // Initialize an array to hold image sources
    //         let imgSources = [];
    //         let imgElements = document.querySelectorAll('.marked_img');
    //
    //         // Define your delimiter
    //         let delimiter = '|||';
    //
    //         for (let index = 0; index < imgElements.length; index++) {
    //             // Concatenate URL with delimiter
    //             imgSources[index] = imgElements[index].src + delimiter;
    //         }
    //
    //         // Remove the last delimiter (optional)
    //         if (imgSources.length > 0) {
    //             imgSources[imgSources.length - 1] = imgSources[imgSources.length - 1].slice(0, -delimiter
    //                 .length);
    //         }
    //
    //         // Join the array into a single string with the delimiter
    //         document.getElementById('marked_img_form').value = imgSources.join('');
    //
    //
    //         // Join the array into a single string with the delimiter
    //         document.getElementById('marked_img_form').value = imgSources.join(delimiter);
    //         console.log('imgElement.srcimgSources', $('#marked_img_form').val(imgSources));
    //
    //         // Add details to the table
    //         row.insertCell(1).textContent = `Image ${currentImageIndex + 1}`; // Image number
    //         row.insertCell(2).textContent = 'Highlights saved'; // Placeholder for highlights info
    //         row.insertCell(3).textContent = ''; // Additional info placeholder
    //         row.insertCell(4).textContent = ''; // Additional info placeholder
    //
    //         // Create and insert the action cell with a remove button
    //         const actionCell = row.insertCell(5);
    //         const removeBtn = document.createElement("button");
    //         removeBtn.textContent = "Remove";
    //         removeBtn.className = "btn btn-danger btn-sm";
    //         removeBtn.onclick = () => row.remove();
    //         actionCell.appendChild(removeBtn);
    //     }).catch(error => {
    //         console.error("Error capturing the image:", error);
    //     });
    // }
    //
    // // Function to handle the form submission
    // document.getElementById('inspectionForm').addEventListener('submit', function (e) {
    //     saveToTable(); // Ensure data is saved before submitting
    // });
    //
    // function displayImage() {
    //     if (images.length === 0) return;
    //     const imageUrl = URL.createObjectURL(images[currentImageIndex]);
    //     imageWrapper.innerHTML =
    //         `<img src="${imageUrl}" name="marked_img[]" class="marked_img" alt="Inspection Image">`;
    //     imageWrapper.innerHTML += '<div class="highlight"></div>'; // Dummy div for drawing highlights
    //     // $('.marked_img img').each(function() {
    //     //     console.log($(this).attr('src'));
    //     // });
    //     // console.log(document.querySelectorAll('.marked_img'));
    //     // document.getElementById("marked_img_form").value = ;
    // }
    //
    //
    // function loadImages() {
    //     const files = document.getElementById("inspectionImages").files;
    //     images = Array.from(files);
    //     currentImageIndex = 0;
    //     displayImage();
    //     $('#imageModal').modal('hide');
    // }
    //
    // function displayImage() {
    //     if (images.length === 0) return;
    //     const imageUrl = URL.createObjectURL(images[currentImageIndex]);
    //     imageWrapper.innerHTML = `<img src="${imageUrl}" alt="Inspection Image">`;
    //     imageWrapper.innerHTML += '<div class="highlight"></div>'; // Dummy div for drawing highlights
    // }
    //
    // function prevImage() {
    //     if (images.length === 0) return;
    //     currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
    //     displayImage();
    // }
    //
    // function nextImage() {
    //     if (images.length === 0) return;
    //     currentImageIndex = (currentImageIndex + 1) % images.length;
    //     displayImage();
    // }
    //
    // function clearHighlights() {
    //     document.querySelectorAll(".highlight").forEach(highlight => highlight.remove());
    //     highlightsTable.innerHTML = '';
    // }
</script>
<script>
    function copyCurrentURL(event) {
        event.preventDefault();
        const currentURL = window.location.href;
        navigator.clipboard.writeText(currentURL).then(() => {
            const messageElement = document.getElementById('copy-message');
            messageElement.style.display = 'inline';
            setTimeout(() => {
                messageElement.style.display = 'none';
            }, 3000);
        }).catch(err => {
            console.error('Failed to copy link: ', err);
        });
    }
</script>

<style>
    .highlight {
        position: absolute;
        background-color: rgba(255, 0, 0, 0.3);
        border: 2px solid red;
    }
</style>
<script>

    let isDrawing2 = false;
    let startX2, startY2;
    let $imageWrapper2 = $("#imageWrapper2");
    const colors2 = ["red", "blue", "green", "yellow", "purple", "orange", "pink", "brown"];
    let colorIndex2 = 0;
    let images = [];
    let currentImageIndex = 0;
    let currentHighlight = null;

    function enableDrawing2() {
        const imageWrapper2 = document.getElementById("imageWrapper2");
        imageWrapper2.addEventListener("mousedown", startDraw2);
        imageWrapper2.addEventListener("mousemove", draw2);
        imageWrapper2.addEventListener("mouseup", endDraw2);
    }

    function disableDrawing2() {
        const imageWrapper2 = document.getElementById("imageWrapper2");
        imageWrapper2.removeEventListener("mousedown", startDraw2);
        imageWrapper2.removeEventListener("mousemove", draw2);
        imageWrapper2.removeEventListener("mouseup", endDraw2);
    }

    function startDraw2(e) {
        isDrawing2 = true;
        startX2 = e.offsetX;
        startY2 = e.offsetY;

        const highlight = document.createElement("div");
        highlight.className = "highlight";
        highlight.style.position = "absolute";
        highlight.style.left = `${startX2}px`;
        highlight.style.top = `${startY2}px`;
        highlight.style.border = `2px solid ${colors2[colorIndex2]}`;
        highlight.style.zIndex = "1000";
        highlight.dataset.startX = startX2;
        highlight.dataset.startY = startY2;
        highlight.dataset.color = colors2[colorIndex2];

        document.getElementById("imageWrapper2").appendChild(highlight);
        currentHighlight2 = highlight;
    }

    function draw2(e) {
        if (!isDrawing2) return;
        const width = e.offsetX - startX2;
        const height = e.offsetY - startY2;

        currentHighlight2.style.width = `${Math.abs(width)}px`;
        currentHighlight2.style.height = `${Math.abs(height)}px`;
        currentHighlight2.style.left = `${Math.min(startX2, e.offsetX)}px`;
        currentHighlight2.style.top = `${Math.min(startY2, e.offsetY)}px`;
    }

    function endDraw2() {
        if (isDrawing2) {
            isDrawing2 = false;
            colorIndex2 = (colorIndex2 + 1) % colors2.length;
            $('#markingModal').modal('show');
        }
    }

    function confirmMarking() {
        const markingType = document.getElementById("markingType").value;
        currentHighlight2.dataset.type = markingType;
        const label = document.createElement("div");
        label.className = "highlight-label";
        label.textContent = markingType;
        currentHighlight2.appendChild(label);
        colorIndex2 = (colorIndex2 + 1) % colors2.length;
        $('#markingModal').modal('hide');
    }

    function clearHighlights2() {
        document.querySelectorAll("#imageWrapper2 .highlight").forEach(highlight => highlight.remove());
    }
</script>


<script>
    let imagesArray = [];
    let currentIndex = 0;

    function saveToTable2() {
        const imageWrapper = document.getElementById("imageWrapper2");

        if (!imageWrapper) {
            console.error("Element #imageWrapper2 not found.");
            return;
        }

        // Clone the element to capture its full content without affecting layout
        const clonedElement = imageWrapper.cloneNode(true);
        clonedElement.style.position = "absolute";
        clonedElement.style.width = imageWrapper.scrollWidth + "px";
        clonedElement.style.height = imageWrapper.scrollHeight + "px";
        clonedElement.style.overflow = "visible";

        document.body.appendChild(clonedElement); // Temporarily add cloned element

        setTimeout(() => {
            html2canvas(clonedElement, {
                useCORS: true,
                scale: 2, // High resolution
                logging: true,
                backgroundColor: null
            }).then(canvas => {
                document.body.removeChild(clonedElement); // Clean up cloned element

                const dataUrl = canvas.toDataURL();
                imagesArray.push(dataUrl);

                // Create image container
                const colDiv = document.createElement("div");
                colDiv.classList.add("col-md-6", "mb-3");

                const imgWrapper = document.createElement("div");
                // imgWrapper.classList.add("image-wrapper");
                // imgWrapper.style.height = "100px";
                // imgWrapper.style.overflow = "hidden";

                const imgElement = document.createElement("img");
                imgElement.src = dataUrl;
                imgElement.classList.add("img-fluid2",  "marked_img");
                imgElement.style.objectFit = "cover";
                imgElement.alt = "Inspection Image";

                imgElement.addEventListener("click", () => {
                    currentIndex = imagesArray.indexOf(dataUrl);
                    updateModalImage();
                    const imageModal2 = new bootstrap.Modal(document.getElementById("mimageModal"));
                    imageModal2.show();
                });

                imgWrapper.appendChild(imgElement);
                colDiv.appendChild(imgWrapper);
                document.getElementById("imageGallery").appendChild(colDiv);

                // ✅ Ensure multiple images are saved correctly in marked_img_form
                setTimeout(() => {
                    let imgElements = document.querySelectorAll('.marked_img');
                    let imgSources = [];

                    imgElements.forEach(img => {
                        imgSources.push(img.src); // Collect all images
                    });
                    let delimiter = '|||';
                    document.getElementById('marked_img_form').value = imgSources.join(delimiter);

                }, 500);

            }).catch(error => {
                console.error("Error capturing the image:", error);
            });
        }, 100);

        $('#previewModal').modal('hide');
    }



    function updateModalImage() {
        const modalImage2 = document.getElementById('modalImage2');
        modalImage2.src = imagesArray[currentIndex];
    }


    document.getElementById('prevButton').addEventListener('click', (e) => {
        e.preventDefault()
        if (currentIndex > 0) {
            currentIndex--; // Move to previous image
            updateModalImage();
        }
    });


    document.getElementById('nextButton').addEventListener('click', (e) => {
        e.preventDefault()
        if (currentIndex < imagesArray.length - 1) {
            currentIndex++;
            updateModalImage();
        }
    });

    function loadImages() {
        var input = document.getElementById("inspectionImages");
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#previewImage").attr("src", e.target.result);
                $("#previewModal").modal("show"); // Show the new modal
            };
            enableDrawing2()
            clearHighlights2()
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script>

    // // Initialize map and set center
    // var map = L.map('map').setView([31.5204, 74.3587], 12);
    //
    // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //     attribution: '© OpenStreetMap contributors'
    // }).addTo(map);
    //
    // var origin = [31.582045, 74.329376];
    // var destination = [31.5497, 74.3436];
    //
    // L.marker(origin).addTo(map)
    //     .bindPopup("<b>Origin:</b> Badshahi Mosque").openPopup();
    //
    // L.marker(destination).addTo(map)
    //     .bindPopup("<b>Destination:</b> Liberty Market");
    //
    // var latlngs = [origin, destination];
    // var polyline = L.polyline(latlngs, {
    //     color: 'red'
    // }).addTo(map);
</script>

</body>

</html>
