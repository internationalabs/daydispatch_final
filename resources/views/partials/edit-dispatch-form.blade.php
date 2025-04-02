<style>
    .showmycontract .text {
        margin-top: 8px;
        margin-left: 8px;
    }

    .showmycontract h3 i {
        margin-bottom: 0px;
        background-color: #1e2d62;
        color: white;
    }

    .showmycontract {
        box-shadow: 1px 5px 24px 0 rgb(132 136 151 / 19%);
        background: white;
        color: black;
    }

    .showmycontract p {
        background: #1e2d62;
        padding: 9px 13px;
        margin-top: 14px;
        border-radius: 4px;
        color: white;
    }

    .buttons-style {
        width: 55%;
        row-gap: 20px;
        margin: auto;
        margin-top: 15px;
        margin-bottom: 22px;
    }

    /* .was-validated .form-control:valid,
    .was-validated .form-control:invalid,
    .was-validated .form-select:valid,
    .was-validated .form-select:invalid {
        background-image: none !important;
    } */

    .was-validated .custom-select:valid,
    .was-validated .custom-select:invalid {
        background-image: none !important;
    }
</style>
<div class="row">
    <div class="col-lg-12 shadow-sm border rounded p-3">
        @if (count($Lisiting->vehicles) > 0)
            <input hidden type="text" name="postType" value="1">
            {{-- <div class="row mt-4">
                <div class="col-lg-4">
                    <!-- <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" name="Custom_Listing"
                            value="{{ $Lisiting->Custom_Listing }}" id="custom_Check" @if ($Lisiting->Custom_Listing == 1) checked @endif>
                        <label class="form-check-label" for="custom_Check">Custom Listing</label>
                    </div>

                    <div class="form-group Custom-Date">
                        <label>Posted Date</label>
                        <input type="date" class="form-control"
                            placeholder="Order Booking Price" name="Custom_Date" value="{{ $Lisiting->Posted_Date }}">
                        <div class="invalid-feedback">
                            Select Custom Date.
                        </div>
                    </div> -->
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" name="Custom_Listing" value="1"
                            id="custom_Check" @if ($Lisiting->Custom_Listing == 1) checked @endif>
                        <label class="form-check-label" for="custom_Check">Custom Listing</label>
                    </div>

                    <div class="form-group Custom-Date" style="display: none;"> <!-- Initially hidden -->
                        <label>Posted Date</label>
                        <input type="date" class="form-control" placeholder="Order Booking Price" name="Custom_Date"
                            value="{{ $Lisiting->Posted_Date }}">
                        <div class="invalid-feedback">
                            Select Custom Date.
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <h5 class="text-center"><b>VEHICLE INFORMATION</b></h5> --}}
            <h4 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                <i class="bi bi-hash mr-2"></i> VEHICLE INFORMATION
            </h4>
            <div class="justify-content-end">
                <div class="btn-box text-right">
                    <button type="button" id="add-vehcile" class="btn btn-success"><i class='bx bx-add'></i>
                        Add Vehicle
                    </button>
                </div>
            </div>
            <input hidden name="post_type" value="{{ $Lisiting->Listing_Type }}">
            @foreach ($Lisiting->vehicles as $key => $vehcile)
                <div class="vehcile-information">
                    <input hidden type="text" name="Vehcile_ID[]" value="{{ $vehcile->id }}">
                    {{-- <div class="row">
                        <div class="col-lg-4">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="customControlValidation2"
                                    name="radio_stacked[0]" value="YMM" @checked($vehcile->Reg_By === 'YMM')>
                                <label class="custom-control-label" for="customControlValidation2">Year,
                                    Make,
                                    and
                                    Model</label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" class="custom-control-input" id="customControlValidation3"
                                    name="radio_stacked[0]" value="VIN" @checked($vehcile->Reg_By === 'Vin Number')>
                                <label class="custom-control-label" for="customControlValidation3">Vin
                                    Number</label>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input"
                                    id="customControlValidation2_{{ $vehcile->id }}"
                                    name="radio_stacked[{{ $vehcile->id }}]" value="YMM"
                                    {{ $vehcile->Reg_By === 'YMM' ? 'checked' : '' }}>
                                <label class="custom-control-label"
                                    for="customControlValidation2_{{ $vehcile->id }}">Year, Make, and Model</label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" class="custom-control-input"
                                    id="customControlValidation3_{{ $vehcile->id }}"
                                    name="radio_stacked[{{ $vehcile->id }}]" value="VIN"
                                    {{ $vehcile->Reg_By === 'Vin Number' ? 'checked' : '' }}>
                                <label class="custom-control-label"
                                    for="customControlValidation3_{{ $vehcile->id }}">Vin Number</label>
                            </div>
                        </div>
                        @if ($key != 0)
                            <div class="justify-content-end">
                                <div class="btn-box text-right">
                                    <button type="button" class="remove-vehcile btn btn-danger"><i
                                            class="bx bx-trash"></i>
                                        <input hidden type="text" class="Vehicle-ID" value="{{ $vehcile->id }}">
                                        Remove Vehicle</button>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row vin-box">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Vin Number</label>
                                <input type="text" class="form-control" placeholder="Ex: WBSWL93558P331570"
                                    name="Vin_Number[]" value="{{ $vehcile->Vin_Number }}">
                                <div class="invalid-feedback">
                                    Enter Vin Number.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="vehcile-information-container-vin">
                        <div class="row">
                            <div class="col-lg-4 basic-vehcile-info">
                                <div class="form-group">
                                    <label>Year *</label>
                                    <input type="text" class="form-control" placeholder="Ex: 2022"
                                        name="Vehcile_Year[]" value="{{ $vehcile->Vehcile_Year }}" required>
                                    <div class="invalid-feedback">
                                        Enter Year.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 basic-vehcile-info">
                                <div class="form-group">
                                    <label>Make *</label>
                                    <input type="text" class="form-control make typeahead" placeholder="Enter Make"
                                        name="Vehcile_Make[]" value="{{ $vehcile->Vehcile_Make }}" required>
                                    <div class="invalid-feedback">
                                        Enter Make.
                                    </div>
                                </div>
                                {{-- <input hidden type="text" class="make_ID" name="make_ID" value=""> --}}
                            </div>
                            <div class="col-lg-4 basic-vehcile-info">
                                <div class="form-group">
                                    <label>Model *</label>
                                    <input type="text" class="form-control model typeahead" placeholder="Enter Model"
                                        name="Vehcile_Model[]" value="{{ $vehcile->Vehcile_Model }}" required>
                                    <div class="invalid-feedback">
                                        Enter Model.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="vehcile-information-container-ymm">
                        <div class="row">
                            <div class="col-lg-4 basic-vehcile-info">
                                <div class="form-group">
                                    <label>Year *</label>
                                    <input type="text" class="form-control" placeholder="Ex: 2022"
                                        name="Vehcile_Year[]" value="{{ $vehcile->Vehcile_Year }}" required>
                                    <div class="invalid-feedback">
                                        Enter Year.
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 basic-vehcile-info">
                                <div class="form-group">
                                    <label>Make *</label>
                                    <input type="text" class="form-control makes typeahead" placeholder="Enter Make"
                                        name="Vehcile_Make[]" value="{{ $vehcile->Vehcile_Make }}" required>
                                    <div class="invalid-feedback">
                                        Enter Make.
                                    </div>
                                </div>
                                {{-- <input hidden type="text" class="make_ID" name="make_ID" value=""> --}}
                            </div>
                            <div class="col-lg-4 basic-vehcile-info">
                                <div class="form-group">
                                    <label>Model *</label>
                                    <input type="text" class="form-control models typeahead"
                                        placeholder="Enter Model" name="Vehcile_Model[]"
                                        value="{{ $vehcile->Vehcile_Model }}" required>
                                    <div class="invalid-feedback">
                                        Enter Model.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Color</label>
                                <input type="text" class="form-control" placeholder="Enter Color"
                                    name="Vehcile_Color[]" value="{{ $vehcile->Vehcile_Color }}">
                                <div class="invalid-feedback">
                                    Enter Color.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Vehicle Type</label>
                                <select class="custom-select" name="Vehcile_Type[]" required>
                                    <option value="">Select Vehicle Type</option>
                                    <option value="Car">Car</option>
                                    <option value="SUV">SUV</option>
                                    <option value="Pickup">Pickup</option>
                                    <option value="Van">Van</option>
                                    <option disabled="">————————————</option>
                                    <option value="motorcycle">Motorcycle</option>
                                    <option value="atv">ATV</option>
                                    <option disabled="">————————————</option>
                                    <option value="Mini Van">Mini Van</option>
                                    <option value="Cargo Van">Cargo Van</option>
                                    <option value="Passenger Van">Passenger Van</option>
                                    <option disabled="">————————————</option>
                                    <option value="Boat">Boat</option>
                                    <option value="Large Yacht">Large Yacht</option>
                                    <option value="RVs">RVs</option>
                                    <option value="Travel Trailer">Travel Trailer</option>
                                    <option disabled="">————————————</option>
                                    <option value="other_vehicle">Other Vehicle</option>
                                    <option value="other_motorcycle">Other Motorcycle</option>
                                    <option @selected(!is_null($vehcile->Vehcile_Type)) value="{{ $vehcile->Vehcile_Type }}">
                                        {{ $vehcile->Vehcile_Type }}
                                    </option>
                                </select>
                                <div class="invalid-feedback">Select Vehicle Type</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Vehicle Condition</label>
                                <select class="custom-select" name="Vehcile_Condition[]" required>
                                    <option @selected(is_null($vehcile->Vehcile_Condition)) value="">Select
                                        Vehicle
                                        Condition
                                    </option>
                                    <option @selected($vehcile->Vehcile_Condition === 'Running') value="Running">
                                        Running
                                    </option>
                                    <option @selected($vehcile->Vehcile_Condition === 'Not Running') value="Not Running">
                                        Not Running
                                    </option>
                                </select>
                                <div class="invalid-feedback">Select Vehicle Condition</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Trailer type</label>
                                <select class="custom-select" name="Trailer_Type[]" required>
                                    <option @selected(is_null($vehcile->Trailer_Type)) value="">Select Trailer</option>
                                    <option value="Open Trailer"
                                        {{-- {{ $vehcile->Trailer_Type === 'Open Trailer' ? 'selected' : '' }} --}}
                                        >Open
                                    </option>
                                    <option @selected($vehcile->Trailer_Type === 'Enclosed Trailer' ) value="Enclosed"
                                        {{-- {{ $vehcile->Trailer_Type === '(Enclosed Trailer)' ? 'selected' : '' }}  --}}
                                        >
                                        Enclosed
                                    </option>
                                    <option @selected($vehcile->Trailer_Type === 'Drive Away') value="Drive Away"
                                        {{-- {{ $vehcile->Trailer_Type === 'Drive Away' ? 'selected' : '' }} --}}
                                        >
                                        Drive Away
                                    </option>
                                </select>
                                <div class="invalid-feedback">Select any trailer type.</div>
                            </div>
                        </div>
                    </div>
                </div>
               
            @endforeach
            <div id="vehciles"></div>
        @endif
        @if (count($Lisiting->heavy_equipments) > 0)
            <input hidden type="text" name="postType" value="2">
            <h5 class="text-center"><b>HEAVY EQUIPMENTS INFORMATION</b></h5>
            @foreach ($Lisiting->heavy_equipments as $vehcile)
                <div class="heavy-vehcile-information">
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4 justify-content-end">
                            <div class="btn-box text-right">
                                <button type="button" id="add-heavy-vehicle" class="btn btn-success"><i
                                        class='bx bx-add'></i>
                                    Add Vehicle
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <input hidden type="text" name="Vehcile_ID[]" value="{{ $vehcile->id }}">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Year *</label>
                                <input type="text" class="form-control" placeholder="Ex: 2022"
                                    name="Equipment_Year[]" value="{{ $vehcile->Equipment_Year }}" required>
                                <div class="invalid-feedback">
                                    Enter Year.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Make *</label>
                                <input type="text" class="form-control" placeholder="Enter Make"
                                    name="Equipment_Make[]" value="{{ $vehcile->Equipment_Make }}" required>
                                <div class="invalid-feedback">
                                    Enter Make.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Model *</label>
                                <input type="text" class="form-control" placeholder="Enter Model"
                                    name="Equipment_Model[]" value="{{ $vehcile->Equipment_Model }}" required>
                                <div class="invalid-feedback">
                                    Enter Model.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Length *</label>
                                <input type="number" class="form-control" placeholder="Enter Length" min="0"
                                    name="Equip_Length[]" value="{{ $vehcile->Equip_Length }}">
                                <div class="invalid-feedback">
                                    Enter Length.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Width *</label>
                                <input type="number" class="form-control" placeholder="Enter Width" min="0"
                                    name="Equip_Width[]" value="{{ $vehcile->Equip_Width }}">
                                <div class="invalid-feedback">
                                    Enter Width.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Height *</label>
                                <input type="number" class="form-control" placeholder="Enter Height" min="0"
                                    name="Equip_Height[]" value="{{ $vehcile->Equip_Height }}">
                                <div class="invalid-feedback">
                                    Enter Height.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Weight *</label>
                                <input type="number" class="form-control" placeholder="Enter Weight" min="0"
                                    name="Equip_Weight[]" value="{{ $vehcile->Equip_Weight }}">
                                <div class="invalid-feedback">
                                    Enter Weight.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Equipment Condition</label>
                                <select class="custom-select" name="Equipment_Condition[]" required>
                                    <option @selected($vehcile->Equipment_Condition === 'Running') value="Running">
                                        Running
                                    </option>
                                    <option @selected($vehcile->Equipment_Condition === 'Not Running') value="Not Running">
                                        Not Running
                                    </option>
                                </select>
                                <div class="invalid-feedback">Select Equipment Condition</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Trailer Type</label>
                                <select class="custom-select" name="Trailer_Type[]" required>
                                    <option @selected($vehcile->Trailer_Type === 'Flatbed Trailer') value="Flatbed Trailer">
                                        Flatbed Trailer
                                    </option>
                                    <option @selected($vehcile->Trailer_Type === 'Removable Goose-neck Trailer') value="Removable Goose-neck Trailer">
                                        Removable
                                        Goose-neck Trailer
                                    </option>
                                    <option @selected($vehcile->Trailer_Type === 'Lowboy Trailer') value="Lowboy Trailer">
                                        Lowboy Trailer
                                    </option>
                                    <option @selected($vehcile->Trailer_Type === 'Step Deck Trailer') value="Step Deck Trailer">
                                        Step Deck Trailer
                                    </option>
                                    <option @selected($vehcile->Trailer_Type === 'Extendable Flatbed Trailer') value="Extendable Flatbed Trailer">
                                        Extendable
                                        Flatbed Trailer
                                    </option>
                                    <option @selected($vehcile->Trailer_Type === 'Stretch Single Drop Deck Trailer') value="Stretch Single Drop Deck Trailer">
                                        Stretch
                                        Single Drop Deck Trailer
                                    </option>
                                    <option @selected($vehcile->Trailer_Type === 'Tow Away') value="Tow Away">Tow
                                        Away
                                    </option>
                                    <option @selected($vehcile->Trailer_Type === 'Drive Away') value="Drive Away">
                                        Drive Away
                                    </option>
                                    <option @selected($vehcile->Trailer_Type === 'Other') value="Other">
                                        Other
                                    </option>
                                </select>
                                <div class="invalid-feedback">Select Any Trailer Type</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Shipment Preferences</label>
                                <select class="custom-select" name="Shipment_Preferences[]">
                                    <option @selected($vehcile->Shipment_Preferences === 'LTL') value="LTL">
                                        LTL (Less Than Truck Load)
                                    </option>
                                    <option @selected($vehcile->Shipment_Preferences === 'FTL') value="FTL">
                                        FTL (Full Truck Load)
                                    </option>
                                </select>
                                <div class="invalid-feedback">Select Shipment Preferences</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div id="heavy-vehciles"></div>
        @endif
        @if (count($Lisiting->dry_vans) > 0)
            <input hidden type="text" name="postType" value="3">
            <h5 class="text-center"><b>DRY VANS INFORMATION</b></h5>
            @foreach ($Lisiting->dry_vans as $vehcile)
                <input hidden type="text" name="Vehcile_ID[]" value="{{ $vehcile->id }}">
                <div class="dry-van-information">
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <div class="btn-box text-left">
                                <a href="{{ route('Freight.Calculate') }}" target="_blank"
                                    class="btn btn-warning"><i class='bx bx-calculator'></i>
                                    Calculate Freight Class
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4 justify-content-end">
                            <div class="btn-box text-right">
                                <button type="button" id="add-dry-van" class="btn btn-success"><i
                                        class='bx bx-add'></i>
                                    Add Another Shipment
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Freight Class *</label>
                                <select class="custom-select" name="Freight_Class[]" required>
                                    <option @selected($vehcile->Freight_Class == '500') value="500">500
                                    </option>
                                    <option @selected($vehcile->Freight_Class == '400') value="400">400
                                    </option>
                                    <option @selected($vehcile->Freight_Class == '300') value="300">300
                                    </option>
                                    <option @selected($vehcile->Freight_Class == '250') value="250">250
                                    </option>
                                    <option @selected($vehcile->Freight_Class == '200') value="200">200
                                    </option>
                                    <option @selected($vehcile->Freight_Class == '175') value="175">175
                                    </option>
                                    <option @selected($vehcile->Freight_Class == '150') value="150">150
                                    </option>
                                    <option @selected($vehcile->Freight_Class == '125') value="125">125
                                    </option>
                                    <option @selected($vehcile->Freight_Class == '110') value="110">110
                                    </option>
                                    <option @selected($vehcile->Freight_Class == '100') value="100">100
                                    </option>
                                    <option @selected($vehcile->Freight_Class == '92.5') value="92.5">92.5
                                    </option>
                                    <option @selected($vehcile->Freight_Class == '85') value="85">85
                                    </option>
                                    <option @selected($vehcile->Freight_Class == '77.5') value="77.5">77.5
                                    </option>
                                    <option @selected($vehcile->Freight_Class == '70') value="70">70
                                    </option>
                                    <option @selected($vehcile->Freight_Class == '65') value="65">65
                                    </option>
                                    <option @selected($vehcile->Freight_Class == '60') value="60">60
                                    </option>
                                    <option @selected($vehcile->Freight_Class == '55') value="55">55
                                    </option>
                                    <option @selected($vehcile->Freight_Class == '50') value="50">50
                                    </option>
                                </select>
                                <div class="invalid-feedback">Select Any Class</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Freight Weight *</label>
                                <input type="number" class="form-control" placeholder="Enter Weight" min="0"
                                    name="Freight_Weight[]" value="{{ $vehcile->Freight_Weight }}">
                                <div class="invalid-feedback">
                                    Enter Weight.
                                </div>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" name="is_hazmat_Check[]"
                                    @checked($vehcile->is_hazmat_Check === 1) value="1">
                                <label class="form-check-label" for="hazmat_Check">Hazmat?</label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Shipment Preferences</label>
                                <select class="custom-select" name="Shipment_Preferences[]">
                                    <option @selected($vehcile->Shipment_Preferences === 'LTL') value="LTL">
                                        LTL (Less Than Truck Load)
                                    </option>
                                    <option @selected($vehcile->Shipment_Preferences === 'FTL') value="FTL">
                                        FTL (Full Truck Load)
                                    </option>
                                </select>
                                <div class="invalid-feedback">Select Shipment Preferences</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div id="dry-vans"></div>
        @endif
        @if (count($Lisiting->dry_vans_services) > 0)
            <strong class="mb-2">Pickup Services</strong>
            <div class="row px-5">
                @foreach ($Lisiting->dry_vans_services as $Service)
                    <div class="col-lg-4">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input"
                                id="{{ Str::replace(' ', '_', $Service->Pickup_Service) }}" name="Pickup_Service[]"
                                value="{{ $Service->Pickup_Service }}" checked>
                            <label class="form-check-label"
                                for="{{ Str::replace(' ', '_', $Service->Pickup_Service) }}">{{ $Service->Pickup_Service }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        @if (count($Lisiting->dry_vans_services) > 0)
            <strong class="mb-2">Delivery Services</strong>
            <div class="row px-5">
                @foreach ($Lisiting->dry_vans_services as $Service)
                    <div class="col-lg-4">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input"
                                id="{{ Str::replace(' ', '_', $Service->Delivery_Service) }}"
                                name="Delivery_Service[]" value="{{ $Service->Delivery_Service }}" checked>
                            <label class="form-check-label"
                                for="{{ Str::replace(' ', '_', $Service->Delivery_Service) }}">{{ $Service->Delivery_Service }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Additional Vehicle Information</label>
                    <textarea cols="30" rows="5" name="Vehcile_Desc" placeholder="Write something..." class="form-control">{{ !is_null($Lisiting->additional_info) ? $Lisiting->additional_info->Vehcile_Desc : '' }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 shadow-sm border rounded p-3">
        <h4 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
            <i class="bi bi-hash mr-2"></i>VEHICLE PICKUP INFORMATION
        </h4>
        {{-- <h5 class="text-center"><b>VEHICLE PICKUP INFORMATION</b></h5> --}}
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Pickup Date</label>
                    <input type="date" class="form-control pick-date" placeholder="Pickup Date" id="pdatate1"
                        name="Pickup_Date"
                        value="{{ date('Y-m-d', strtotime($Lisiting->pickup_delivery_info->Pickup_Date)) }}">
                    <div class="invalid-feedback">
                        Enter Pickup Date.
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="customControlValidation777"
                                name="PickUp_mode" value="Before" @checked($Lisiting->pickup_delivery_info->Pickup_Date_mode === 'Before')>
                            <label class="custom-control-label" for="customControlValidation777">Before</label>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="customControlValidation7777"
                                name="PickUp_mode" value="On" @checked($Lisiting->pickup_delivery_info->Pickup_Date_mode === 'On')>
                            <label class="custom-control-label" for="customControlValidation7777">On</label>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="custom-control custom-radio mb-3">
                            <input type="radio" class="custom-control-input" id="customControlValidation888"
                                name="PickUp_mode" value="After" @checked($Lisiting->pickup_delivery_info->Pickup_Date_mode === 'After')>
                            <label class="custom-control-label" for="customControlValidation888">After</label>
                        </div>
                    </div>

                    {{-- <div class="col-lg-2">
                        <div class="custom-control custom-radio mb-3">
                            <input type="radio" class="custom-control-input" id="customControlValidation8888"
                                name="PickUp_mode" value="ASAP" @checked($Lisiting->pickup_delivery_info->Pickup_Date_mode === 'ASAP')>
                            <label class="custom-control-label" for="customControlValidation8888">ASAP</label>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="col-lg-6">
                @if (!empty($Lisiting->pickup_delivery_info->Delivery_Date))
                    <div class="form-group">
                        <label>Delivery Date</label>
                        <input type="date" class="form-control deliver-date" required placeholder="Delivery Date"
                            name="Delivery_Date"
                            value="{{ date('Y-m-d', strtotime($Lisiting->pickup_delivery_info->Delivery_Date)) }}">
                        <div class="invalid-feedback">
                            Enter Delivery Date.
                        </div>
                    </div>
                @else
                    <div class="form-group">
                        <label>Delivery Date</label>
                        <input type="date" class="form-control"  placeholder="dd/mm/yy"
                            name="Delivery_Date">
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-2">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="customControlValidation77777"
                                name="Delivery_mode" value="Before" @checked($Lisiting->pickup_delivery_info->Delivery_Date_mode === 'Before')>
                            <label class="custom-control-label" for="customControlValidation77777">Before</label>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="customControlValidation77787"
                                name="Delivery_mode" value="On" @checked($Lisiting->pickup_delivery_info->Delivery_Date_mode === 'On')>
                            <label class="custom-control-label" for="customControlValidation77787">On</label>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="custom-control custom-radio mb-3">
                            <input type="radio" class="custom-control-input" id="customControlValidation88888"
                                name="Delivery_mode" value="After" @checked($Lisiting->pickup_delivery_info->Delivery_Date_mode === 'After')>
                            <label class="custom-control-label" for="customControlValidation88888">After</label>
                        </div>
                    </div>

                    {{-- <div class="col-lg-2">
                        <div class="custom-control custom-radio mb-3">
                            <input type="radio" class="custom-control-input" id="customControlValidation88788"
                                name="Delivery_mode" value="ASAP" @checked($Lisiting->pickup_delivery_info->Delivery_Date_mode === 'ASAP')>
                            <label class="custom-control-label" for="customControlValidation88788">ASAP</label>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Pickup From</label>
                    <input type="time" class="form-control pick-date" placeholder="Pickup From"
                        name="Pickup_Start_Time"
                        value="{{ !is_null($Lisiting->pickup_delivery_info) ? $Lisiting->pickup_delivery_info->Pickup_Start_Time : '' }}">
                    <div class="invalid-feedback">
                        Enter Pickup From.
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Pickup To</label>
                    <input type="time" class="form-control pick-date" placeholder="Pickup To"
                        name="Pickup_End_Time"
                        value="{{ !is_null($Lisiting->pickup_delivery_info) ? $Lisiting->pickup_delivery_info->Pickup_End_Time : '' }}">
                    <div class="invalid-feedback">
                        Enter Pickup To.
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Delivery From</label>
                    <input type="time" class="form-control deliver-time" placeholder="Delivery From"
                        name="Delivery_Start_Time"
                        value="{{ !is_null($Lisiting->pickup_delivery_info) ? $Lisiting->pickup_delivery_info->Delivery_Start_Time : '' }}">
                    <div class="invalid-feedback">
                        Enter Delivery From.
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Delivery To</label>
                    <input type="time" class="form-control deliver-time" placeholder="Delivery To"
                        name="Delivery_End_Time"
                        value="{{ !is_null($Lisiting->pickup_delivery_info) ? $Lisiting->pickup_delivery_info->Delivery_End_Time : '' }}">
                    <div class="invalid-feedback">
                        Enter Delivery To.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 shadow-sm border rounded p-3">
        {{-- <h5 class="text-center"><b>ORIGIN LOCATION</b></h5> --}}
        <h4 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
            <i class="bi bi-hash mr-2"></i>ORIGIN LOCATION
        </h4>
        <input hidden type="text" name="List_ID" value="{{ $Listed_ID }}">
        @if (isset($currentRouteMatchesPattern))
            <input hidden type="text" name="isExpire" value="{{ $currentRouteMatchesPattern }}">
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Terminal, Dealer, Auction</label>
                    {{-- <select class="custom-select Orig" name="Orign_Location" id="Orign_Location_Check">
                        <option @selected(is_null($Lisiting->listing_origin_location->Orign_Location)) value="">
                            Select AnyOne
                        </option>
                        <option @selected($Lisiting->listing_origin_location->Orign_Location === 'Location') value="Location">
                            Location
                        </option>
                        <option @selected($Lisiting->listing_origin_location->Orign_Location === 'Dealership') value="Dealership">
                            Dealership
                        </option>
                        <option @selected($Lisiting->listing_origin_location->Orign_Location === 'Auction') value="Auction">
                            Auction
                        </option>
                        <option @selected($Lisiting->listing_origin_location->Orign_Location === 'Other') value="Other">
                            Other
                        </option>
                    </select> --}}
                    <select class="custom-select" name="Orign_Location" id="Orign_Location_Check">
                        <option @selected(is_null($Lisiting->listing_origin_location->Orign_Location)) value="">
                            Select AnyOne
                        </option>
                        <option @selected($Lisiting->listing_origin_location->Orign_Location === 'Location') value="Location">
                            Location
                        </option>
                        <option @selected($Lisiting->listing_origin_location->Orign_Location === 'Dealership') value="Dealership">
                            Dealership
                        </option>
                        <option @selected($Lisiting->listing_origin_location->Orign_Location === 'Auction') value="Auction">
                            Auction
                        </option>
                        <option @selected($Lisiting->listing_origin_location->Orign_Location === 'Other') value="Other">
                            Other
                        </option>
                    </select>
                    {{-- <select class="custom-select" name="Orign_Location " >
                        <option value="Auto Service Center">Auto Service Center</option>
                        <option value="Salvage Facility">Salvage Facility</option>
                        <option value="Vehicle Holding Lot">Vehicle Holding Lot</option>
                        <option value="Auto Manufacturing Hub">Auto Manufacturing Hub</option>
                        <option value="Distribution Center">Distribution Center</option>
                        <option value="Vehicle Inspection Hub">Vehicle Inspection Hub</option>
                        <option value="Fleet Operations Center">Fleet Operations Center</option>
                        <option value="Rental Car Drop-Off Site">Rental Car Drop-Off Site</option>
                        <option value="Towing & Impound Lot">Towing & Impound Lot</option>
                        <option value="Exhibition & Trade Venue">Exhibition & Trade Venue</option>
                        <option value="Government Vehicle Depot">Government Vehicle Depot</option>
                        <option value="Corporate Fleet Facility">Corporate Fleet Facility</option>
                        <option value="Airport Vehicle Terminal">Airport Vehicle Terminal</option>
                        <option value="Luxury Auto Storage">Luxury Auto Storage</option>
                        <option value="Auction Evaluation Site">Auction Evaluation Site</option>
                        <option value="Compliance & Testing Center">Compliance & Testing Center</option>
                        <option value="Rideshare Fleet Depot">Rideshare Fleet Depot</option>
                        <option value="EV Charging & Storage Facility">EV Charging & Storage Facility</option>
                        <option value="Shipping Container Yard">Shipping Container Yard</option>
                        <option value="Heavy Equipment Storage">Heavy Equipment Storage</option>
                        <option value="Airport Rental Hub">Airport Rental Hub</option>
                        <option value="Auto Auction House">Auto Auction House</option>
                        <option value="Satellite Auction Lot">Satellite Auction Lot</option>
                        <option value="Commercial Enterprise Site">Commercial Enterprise Site</option>
                        <option value="Corporate HQ & Operations Center">Corporate HQ & Operations Center</option>
                        <option value="Cross-Dock & Staging Area">Cross-Dock & Staging Area</option>
                        <option value="Vehicle Dealership">Vehicle Dealership</option>
                        <option value="Impound Facility">Impound Facility</option>
                        <option value="Vehicle Marshalling Zone">Vehicle Marshalling Zone</option>
                        <option value="Military Installation">Military Installation</option>
                        <option value="Mobile Auto Auction">Mobile Auto Auction</option>
                        <option value="Miscellaneous Location">Miscellaneous Location</option>
                        <option value="Port Terminal">Port Terminal</option>
                        <option value="Railway Yard">Railway Yard</option>
                        <option value="Vehicle Reconditioning Facility">Vehicle Reconditioning Facility</option>
                        <option value="Rental Car Distribution Site">Rental Car Distribution Site</option>
                        <option value="Retail Car Sales Center">Retail Car Sales Center</option>
                        <option value="Repossession Lot">Repossession Lot</option>
                        <option value="Residential Pickup/Drop-off">Residential Pickup/Drop-off</option>
                        <option value="Auto Service & Maintenance Hub">Auto Service & Maintenance Hub</option>
                        <option value="Logistics & Transport Terminal">Logistics & Transport Terminal</option>
                        <option value="Undefined Location">Undefined Location</option>
                        <option value="Other">Other</option>
                        
                    </select> --}}
                    <div class="invalid-feedback">
                        Select Any Type.
                    </div>
                </div>
            </div>

            <div class="col-lg-6 orig-basic">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="User_Name" placeholder="Enter User Name"
                        value="{{ !is_null($Lisiting->listing_origin_location) ? $Lisiting->listing_origin_location->User_Name : '' }}"
                        autocomplete="off">
                    <div class="invalid-feedback">
                        Enter UserName.
                    </div>
                </div>
            </div>

            <div class="col-lg-6 orig-basic">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" class="form-control" name="User_Email" placeholder="Enter Email Address"
                        value="{{ !is_null($Lisiting->listing_origin_location) ? $Lisiting->listing_origin_location->User_Email : '' }}"
                        autocomplete="off">
                    <div class="invalid-feedback">
                        Enter Email Address.
                    </div>
                </div>
            </div>

            <div class="col-lg-6 orig-basic">
                <div class="form-group">
                    <label>Buyer/Lot/Stock Number</label>
                    <input type="text" class="form-control" placeholder="Buyer/Lot/Stock Number"
                        name="Dealer_Stock_Number"
                        value="{{ !is_null($Lisiting->listing_origin_location) ? $Lisiting->listing_origin_location->Stock_Number : '' }}">
                    <div class="invalid-feedback">
                        Enter Stock Number.
                    </div>
                </div>
            </div>

            {{-- <div class="col-lg-6 orig-basic">
                @php
                    $Local_Phone = explode(',', $Lisiting->listing_origin_location->Local_Phone);
                @endphp
                <div class="form-group">
                    <label>Phone Number</label>
                    @foreach ($Local_Phone as $row)
                        <input type="text" id="local-phone-input" class="form-control phone-number"
                            placeholder="Phone Number" name="Local_Phone[]" value="{{ $row }}">
                        <button type="button" class="btn btn-success ms-2" id="add-local-phone-number">
                            <i class="fas fa-plus"></i>
                        </button>
                        <div class="invalid-feedback">
                            Enter Local Phone.
                        </div>
                    @endforeach
                    <input type="text" class="form-control phone-number" placeholder="Phone Number"
                        name="Local_Phone"
                        value="{{ !is_null($Lisiting->listing_origin_location) ? $Lisiting->listing_origin_location->Local_Phone : '' }}">
                    <div class="invalid-feedback">
                        Enter Local Phone.
                    </div>
                </div>
            </div> --}}

            <div class="col-lg-6 orig-basic">
                <div class="form-group">
                    <label>Phone Numbers</label>
                    <div class="d-flex">
                        <!-- Initial Phone Number Input (Local_Phone) -->
                        <input id="local-phone-input" class="form-control phone-number" type="text"
                            placeholder="Phone Number" name="Local_Phone[]" value="{{ old('Local_Phone') }}">
                        <button type="button" class="btn btn-success ms-2" id="add-local-phone-number">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="invalid-feedback" id="invalid-phone-message">
                        Enter Phone.
                    </div>
                    <!-- Toast container for added phone numbers -->
                    <div id="local-phone-numbers-toast-container" class="mt-3"></div>
                </div>
            </div>
            {{-- @php
                $Local_Phone = explode(',', $Lisiting->listing_origin_location->Local_Phone);
            @endphp
            @foreach ($Local_Phone as $row)
                <div class="toast" style="display: none;">
                    <div class="toast-body d-flex justify-content-between align-items-center">
                        <span class="phone-number" name="Local_Phone[]" value="{{ $row }}"></span>
                        <button type="button" class="btn-close remove-phone-number"></button>
                    </div>
                </div>
            @endforeach --}}
            <div class="toast" style="display: none;">
                <div class="toast-body d-flex justify-content-between align-items-center">
                    <span class="phone-number"></span>
                    <button type="button" class="btn-close remove-phone-number"></button>
                </div>
            </div>

            {{-- <div class="col-lg-6 orig-location">
                <div class="form-group">
                    <label>Location Type</label>
                    <select class="custom-select orig-business-location" name="Location">
                        <option @selected(is_null($Lisiting->listing_origin_location->Location)) value="">
                            Select AnyOne
                        </option>
                        <option @selected($Lisiting->listing_origin_location->Location === 'Residence') value="Residence">
                            Residence
                        </option>
                        <option @selected($Lisiting->listing_origin_location->Location === 'Business') value="Business">
                            Business
                        </option>
                    </select>
                    <div class="invalid-feedback">Select Auction Type</div>
                </div>
                <div class="form-group orig-auction-input-field">
                    <label>Auction Name</label>
                    <input type="text" class="form-control" name="Auction_Method"
                        placeholder="Enter Auction Name" value="" autocomplete="off">
                    <div class="invalid-feedback">
                        Enter UserName.
                    </div>
                </div>
            </div>

            <div class="col-lg-6 orig-location-business">
                <div class="form-group">
                    <label>Business Phone Number</label>
                    <input type="text" class="form-control phone-number" placeholder="Business Phone Number"
                        name="Business_Phone" value="{{ old('Business_Phone') }}">
                    <div class="invalid-feedback">
                        Enter Business Phone Number.
                    </div>
                </div>
            </div>

            <div class="col-lg-6 orig-location-business">
                <div class="form-group">
                    <label>Business Name</label>
                    <input type="text" class="form-control" placeholder="Business Name" name="Business_Location"
                        value="{{ old('Business_Location') }}" value="">
                    <div class="invalid-feedback">
                        Enter Business Name.
                    </div>
                </div>
            </div>

            <div class="col-lg-6 orig-auction">
                <div class="form-group orig-auction-select-field">
                    <label>Auction Name</label>
                    <select class="custom-select" name="Auction_Method_abc">
                        <option @selected(is_null($Lisiting->listing_origin_location->Auction_Method)) value="">
                            Select AnyOne
                        </option>
                        <option @selected($Lisiting->listing_origin_location->Auction_Method === 'COPART Auction') value="COPART Auction">
                            Copart Auction
                        </option>
                        <option @selected($Lisiting->listing_origin_location->Auction_Method === 'Mannheim Auction') value="Mannheim Auction">
                            Manheim Auction
                        </option>
                        <option @selected($Lisiting->listing_origin_location->Auction_Method === 'IAAI Auction') value="IAAI Auction">
                            IAAI Auction
                        </option>
                        <option @selected($Lisiting->listing_destination_locations->Dest_Auction_Method === 'Other') value="Other">
                            Other
                        </option>
                    </select>
                    <div class="invalid-feedback">Select Auction Type</div>
                </div>
                <!-- yahan hai main issue -->
                <div class="form-group orig-auction-input-field">
                    <label>Auction Name</label>
                    <input type="text" class="form-control" name="Auction_Method_abc"
                        placeholder="Enter Auction Name" value="" autocomplete="off">
                    <div class="invalid-feedback">
                        Enter UserName.
                    </div>
                </div>
                <!-- yahan hai main issue -->

            </div>

            <div class="col-lg-6 orig-auction">
                <div class="form-group">
                    <label>Auction Phone</label>
                    <input type="text" class="form-control phone-number" placeholder="Auction Phone Number"
                        name="Auction_Phone"
                        value="{{ !is_null($Lisiting->listing_origin_location) ? $Lisiting->listing_origin_location->Auction_Phone : '' }}">
                    <div class="invalid-feedback">
                        Enter Auction Phone.
                    </div>
                </div>
            </div>

            <div class="col-lg-6 orig-auction">
                <div class="form-group">
                    <label>Buyer/Lot/Stock Number</label>
                    <input type="text" class="form-control" placeholder="Buyer/Lot/Stock Number"
                        name="Stock_Number"
                        value="{{ !is_null($Lisiting->listing_origin_location) ? $Lisiting->listing_origin_location->Stock_Number : '' }}">
                    <div class="invalid-feedback">
                        Enter Stock Number.
                    </div>
                </div>
            </div>

            <div class="col-lg-6 orig-dealership">
                <div class="form-group">
                    <label>Dealership / Contact Person / Shop Name</label>
                    <input type="text" class="form-control" placeholder="Dealership / Contact Person / Shop Name"
                        name="Dealer_Auction_Method"
                        value="{{ !is_null($Lisiting->listing_origin_location) ? $Lisiting->listing_origin_location->Auction_Method : '' }}">
                    <div class="invalid-feedback">
                        Enter Auction Name.
                    </div>
                </div>
            </div>

            <div class="col-lg-6 orig-dealership">
                <div class="form-group">
                    <label>Dealership Phone</label>
                    <input type="text" class="form-control phone-number" placeholder="Auction Phone Number"
                        name="Dealer_Auction_Phone"
                        value="{{ !is_null($Lisiting->listing_origin_location) ? $Lisiting->listing_origin_location->Auction_Phone : '' }}">
                    <div class="invalid-feedback">
                        Enter Auction Phone.
                    </div>
                </div>
            </div> --}}

        </div>
    </div>
    <div class="col-lg-6 shadow-sm border rounded p-3">
        {{-- <h5 class="text-center"><b>DESTINATION LOCATION</b></h5> --}}
        <h4 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
            <i class="bi bi-hash mr-2"></i>DESTINATION LOCATION
        </h4>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Terminal, Dealer, Auction</label>
                    {{-- <select class="custom-select Dest" name="Destination_Location" id="Destination_Location_Check">
                        <option @selected(is_null($Lisiting->listing_destination_locations->Destination_Location)) value="">
                            Select AnyOne
                        </option>
                        <option @selected($Lisiting->listing_destination_locations->Destination_Location === 'Location') value="Location">
                            Location
                        </option>
                        <option @selected($Lisiting->listing_destination_locations->Destination_Location === 'Dealership') value="Dealership">
                            Dealership
                        </option>
                        <option @selected($Lisiting->listing_destination_locations->Destination_Location === 'Port') value="Port">
                            Port
                        </option>
                        <option @selected($Lisiting->listing_destination_locations->Destination_Location === 'Auction') value="Auction">
                            Auction
                        </option>
                        <option @selected($Lisiting->listing_destination_locations->Destination_Location === 'Other') value="Other">
                            Other
                        </option>
                    </select> --}}
                    <select class="custom-select" name="Destination_Location" id="Destination_Location_Check">
                        <option @selected(is_null($Lisiting->listing_destination_locations->Destination_Location)) value="">
                            Select AnyOne
                        </option>
                        <option @selected($Lisiting->listing_destination_locations->Destination_Location === 'Location') value="Location">
                            Location
                        </option>
                        <option @selected($Lisiting->listing_destination_locations->Destination_Location === 'Dealership') value="Dealership">
                            Dealership
                        </option>
                        <option @selected($Lisiting->listing_destination_locations->Destination_Location === 'Port') value="Port">
                            Port
                        </option>
                        <option @selected($Lisiting->listing_destination_locations->Destination_Location === 'Auction') value="Auction">
                            Auction
                        </option>
                        <option @selected($Lisiting->listing_destination_locations->Destination_Location === 'Other') value="Other">
                            Other
                        </option>
                    </select>
                    {{-- <select class="custom-select" name="Orign_Location " >
                        <option value="Auto Service Center">Auto Service Center</option>
                        <option value="Salvage Facility">Salvage Facility</option>
                        <option value="Vehicle Holding Lot">Vehicle Holding Lot</option>
                        <option value="Auto Manufacturing Hub">Auto Manufacturing Hub</option>
                        <option value="Distribution Center">Distribution Center</option>
                        <option value="Vehicle Inspection Hub">Vehicle Inspection Hub</option>
                        <option value="Fleet Operations Center">Fleet Operations Center</option>
                        <option value="Rental Car Drop-Off Site">Rental Car Drop-Off Site</option>
                        <option value="Towing & Impound Lot">Towing & Impound Lot</option>
                        <option value="Exhibition & Trade Venue">Exhibition & Trade Venue</option>
                        <option value="Government Vehicle Depot">Government Vehicle Depot</option>
                        <option value="Corporate Fleet Facility">Corporate Fleet Facility</option>
                        <option value="Airport Vehicle Terminal">Airport Vehicle Terminal</option>
                        <option value="Luxury Auto Storage">Luxury Auto Storage</option>
                        <option value="Auction Evaluation Site">Auction Evaluation Site</option>
                        <option value="Compliance & Testing Center">Compliance & Testing Center</option>
                        <option value="Rideshare Fleet Depot">Rideshare Fleet Depot</option>
                        <option value="EV Charging & Storage Facility">EV Charging & Storage Facility</option>
                        <option value="Shipping Container Yard">Shipping Container Yard</option>
                        <option value="Heavy Equipment Storage">Heavy Equipment Storage</option>
                        <option value="Airport Rental Hub">Airport Rental Hub</option>
                        <option value="Auto Auction House">Auto Auction House</option>
                        <option value="Satellite Auction Lot">Satellite Auction Lot</option>
                        <option value="Commercial Enterprise Site">Commercial Enterprise Site</option>
                        <option value="Corporate HQ & Operations Center">Corporate HQ & Operations Center</option>
                        <option value="Cross-Dock & Staging Area">Cross-Dock & Staging Area</option>
                        <option value="Vehicle Dealership">Vehicle Dealership</option>
                        <option value="Impound Facility">Impound Facility</option>
                        <option value="Vehicle Marshalling Zone">Vehicle Marshalling Zone</option>
                        <option value="Military Installation">Military Installation</option>
                        <option value="Mobile Auto Auction">Mobile Auto Auction</option>
                        <option value="Miscellaneous Location">Miscellaneous Location</option>
                        <option value="Port Terminal">Port Terminal</option>
                        <option value="Railway Yard">Railway Yard</option>
                        <option value="Vehicle Reconditioning Facility">Vehicle Reconditioning Facility</option>
                        <option value="Rental Car Distribution Site">Rental Car Distribution Site</option>
                        <option value="Retail Car Sales Center">Retail Car Sales Center</option>
                        <option value="Repossession Lot">Repossession Lot</option>
                        <option value="Residential Pickup/Drop-off">Residential Pickup/Drop-off</option>
                        <option value="Auto Service & Maintenance Hub">Auto Service & Maintenance Hub</option>
                        <option value="Logistics & Transport Terminal">Logistics & Transport Terminal</option>
                        <option value="Undefined Location">Undefined Location</option>
                        <option value="Other">Other</option>
                        
                    </select> --}}
                    <div class="invalid-feedback">
                        Select Any Type.
                    </div>
                </div>
            </div>

            <div class="col-lg-6 dest-basic">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="Dest_User_Name" placeholder="Enter User Name"
                        value="{{ !is_null($Lisiting->listing_destination_locations) ? $Lisiting->listing_destination_locations->Dest_User_Name : '' }}"
                        autocomplete="off">
                    <div class="invalid-feedback">
                        Enter UserName.
                    </div>
                </div>
            </div>

            <div class="col-lg-6 dest-basic">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" class="form-control" name="Dest_User_Email"
                        placeholder="Enter Email Address"
                        value="{{ !is_null($Lisiting->listing_destination_locations) ? $Lisiting->listing_destination_locations->Dest_User_Email : '' }}"
                        autocomplete="off">
                    <div class="invalid-feedback">
                        Enter Email Address.
                    </div>
                </div>
            </div>

            <div class="col-lg-6 dest-basic">
                <div class="form-group">
                    <label>Buyer/Lot/Stock Number</label>
                    <input type="text" class="form-control" placeholder="Buyer/Lot/Stock Number"
                        name="Dest_Stock_Number"
                        value="{{ !is_null($Lisiting->listing_destination_locations) ? $Lisiting->listing_destination_locations->Dest_Stock_Number : '' }}">
                    <div class="invalid-feedback">
                        Enter Stock Number.
                    </div>
                </div>
            </div>

            {{-- <div class="col-lg-6 dest-basic">
                @php
                    $Dest_Local_Phone = explode(',', $Lisiting->listing_destination_locations->Dest_Local_Phone);
                @endphp
                <div class="form-group">
                    <label>Phone Number</label>
                    @foreach ($Dest_Local_Phone as $row)
                        <input type="text" class="form-control phone-number" placeholder="Phone Number"
                            name="Dest_Local_Phone[]" value="{{ $row }}">
                        <div class="invalid-feedback">
                            Enter Local Phone.
                        </div>
                    @endforeach
                    <input type="text" class="form-control phone-number" placeholder="Phone Number"
                        name="Dest_Local_Phone"
                        value="{{ !is_null($Lisiting->listing_destination_locations) ? $Lisiting->listing_destination_locations->Dest_Local_Phone : '' }}">
                    <div class="invalid-feedback">
                        Enter Local Phone.
                    </div>
                </div>
            </div> --}}


            <div class="col-lg-6 orig-basic">
                <div class="form-group">
                    <label>Phone Numbers</label>
                    <div class="d-flex">
                        <!-- Initial Phone Number Input (Local_Phone) -->
                        <input id="phone-number-input" class="form-control phone-number" type="text"
                            placeholder="Phone Number" name="Dest_Local_Phone[]" value="{{ old('Local_Phone') }}">
                        <button type="button" class="btn btn-success ms-2" id="add-phone-number">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="invalid-feedback" id="invalid-phone-message">
                        Enter Phone.
                    </div>
                    <!-- Toast container for added phone numbers -->
                    <div id="phone-numbers-toast-container" class="mt-3"></div>
                </div>
            </div>
            {{-- @php
                $Local_Phone = explode(',', $Lisiting->listing_origin_location->Local_Phone);
            @endphp
            @foreach ($Local_Phone as $row)
                <div class="toast" style="display: none;">
                    <div class="toast-body d-flex justify-content-between align-items-center">
                        <span class="phone-number" name="Local_Phone[]" value="{{ $row }}"></span>
                        <button type="button" class="btn-close remove-phone-number"></button>
                    </div>
                </div>
            @endforeach --}}
            <div class="toast" style="display: none;">
                <div class="toast-body d-flex justify-content-between align-items-center">
                    <span class="phone-number"></span>
                    <button type="button" class="btn-close remove-phone-number"></button>
                </div>
            </div>


            {{-- <div class="col-lg-6 dest-location">
                <div class="form-group">
                    <label>Location Type</label>
                    <select class="custom-select dest-business-location" name="Dest_Location">
                        <option @selected(is_null($Lisiting->listing_destination_locations->Dest_Location)) value="">
                            Select AnyOne
                        </option>
                        <option @selected($Lisiting->listing_destination_locations->Dest_Location === 'Residence') value="Residence">
                            Residence
                        </option>
                        <option @selected($Lisiting->listing_destination_locations->Dest_Location === 'Business') value="Business">
                            Business
                        </option>
                    </select>
                    <div class="invalid-feedback">Select Auction Type</div>
                </div>
            </div>

            <div class="col-lg-6 dest-location-business">
                <div class="form-group">
                    <label>Business Phone Number</label>
                    <input type="text" class="form-control phone-number" placeholder="Business Phone Number"
                        name="Dest_Business_Phone" value="{{ old('Dest_Business_Phone') }}">
                    <div class="invalid-feedback">
                        Enter Business Phone Number.
                    </div>
                </div>
            </div>

            <div class="col-lg-6 dest-location-business">
                <div class="form-group">
                    <label>Business Name</label>
                    <input type="text" class="form-control" placeholder="Business Name"
                        name="Dest_Business_Location" value="{{ old('Dest_Business_Location') }}">
                    <div class="invalid-feedback">
                        Enter Business Name.
                    </div>
                </div>
            </div>

            <div class="col-lg-6 dest-auction">
                <div class="form-group">
                    <label>Auction Name</label>
                    <select class="custom-select" name="Auction_Method_def">
                        <option @selected(is_null($Lisiting->listing_destination_locations->Dest_Auction_Method)) value="">
                            Select AnyOne
                        </option>
                        <option @selected($Lisiting->listing_destination_locations->Dest_Auction_Method === 'COPART Auction') value="COPART Auction">
                            Copart Auction
                        </option>
                        <option @selected($Lisiting->listing_destination_locations->Dest_Auction_Method === 'Mannheim Auction') value="Mannheim Auction">
                            Manheim Auction
                        </option>
                        <option @selected($Lisiting->listing_destination_locations->Dest_Auction_Method === 'IAAI Auction') value="IAAI Auction">
                            IAAI Auction
                        </option>
                        <option @selected($Lisiting->listing_destination_locations->Dest_Auction_Method === 'Other') value="Other">
                            Other
                        </option>
                    </select>
                    <div class="invalid-feedback">Select Auction Type</div>
                </div>
                <div class="form-group dest-auction-input-field">
                    <label>Auction Name</label>
                    <input type="text" class="form-control" name="Dest_Auction_Method"
                        placeholder="Enter Auction Name" value="" autocomplete="off">
                    <div class="invalid-feedback">
                        Enter UserName.
                    </div>
                </div>
            </div>

            <div class="col-lg-6 dest-auction">
                <div class="form-group">
                    <label>Auction Phone</label>
                    <input type="text" class="form-control phone-number" placeholder="Auction Phone Number"
                        name="Dest_Auction_Phone"
                        value="{{ !is_null($Lisiting->listing_destination_locations) ? $Lisiting->listing_destination_locations->Dest_Auction_Phone : '' }}">
                    <div class="invalid-feedback">
                        Enter Auction Phone.
                    </div>
                </div>
            </div>

            <div class="col-lg-6 dest-dealership">
                <div class="form-group">
                    <label>Dealership / Contact Person / Shop Name</label>
                    <input type="text" class="form-control" placeholder="Dealership / Contact Person / Shop Name"
                        name="Dealer_Dest_Auction_Method"
                        value="{{ !is_null($Lisiting->listing_destination_locations) ? $Lisiting->listing_destination_locations->Dest_Auction_Method : '' }}">
                    <div class="invalid-feedback">
                        Enter Auction Name.
                    </div>
                </div>
            </div>

            <div class="col-lg-6 dest-dealership">
                <div class="form-group">
                    <label>Dealership Phone</label>
                    <input type="text" class="form-control phone-number" placeholder="Auction Phone Number"
                        name="Dealer_Dest_Auction_Phone"
                        value="{{ !is_null($Lisiting->listing_destination_locations) ? $Lisiting->listing_destination_locations->Dest_Auction_Phone : '' }}">
                    <div class="invalid-feedback">
                        Enter Auction Phone.
                    </div>
                </div>
            </div>

            <div class="col-lg-6 dest-dealership">
                <div class="form-group">
                    <label>Buyer/Lot/Stock Number</label>
                    <input type="text" class="form-control" placeholder="Buyer/Lot/Stock Number"
                        name="Dealer_Dest_Stock_Number"
                        value="{{ !is_null($Lisiting->listing_destination_locations) ? $Lisiting->listing_destination_locations->Dest_Stock_Number : '' }}">
                    <div class="invalid-feedback">
                        Enter Stock Number.
                    </div>
                </div>
            </div>

            <div class="col-lg-6 dest-port">
                <div class="form-group">
                    <label>Port Type</label>
                    <select class="custom-select" name="Port_Dest_Auction_Method">
                        <option @selected(is_null($Lisiting->listing_destination_locations->Dest_Auction_Method)) value="">
                            Select AnyOne
                        </option>
                        <option @selected($Lisiting->listing_destination_locations->Dest_Auction_Method === 'Sea Port') value="Sea Port">
                            Sea Port
                        </option>
                        <option @selected($Lisiting->listing_destination_locations->Dest_Auction_Method === 'Airport') value="Airport">
                            Airport
                        </option>
                    </select>
                    <div class="invalid-feedback">Select Auction Type</div>
                </div>
            </div>

            <div class="col-lg-6 dest-port">
                <div class="form-group">
                    <label>Port Phone</label>
                    <input type="text" class="form-control phone-number" placeholder="Port Phone Number"
                        name="Port_Dest_Auction_Phone"
                        value="{{ !is_null($Lisiting->listing_destination_locations) ? $Lisiting->listing_destination_locations->Dest_Auction_Phone : '' }}">
                    <div class="invalid-feedback">
                        Enter Port Phone.
                    </div>
                </div>
            </div>

            <div class="col-lg-6 dest-port">
                <div class="form-group">
                    <label>Terminal</label>
                    <input type="text" class="form-control" placeholder="Terminal" name="Port_Dest_Stock_Number"
                        value="{{ !is_null($Lisiting->listing_destination_locations) ? $Lisiting->listing_destination_locations->Dest_Stock_Number : '' }}">
                    <div class="invalid-feedback">
                        Enter Terminal.
                    </div>
                </div>
            </div> --}}

        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 shadow-sm border rounded p-3">
        {{-- <h5 class="text-center"><b>ORIGIN ADDRESS</b></h5> --}}
        {{-- <h4 class="text-white py-2 d-flex justify-content-center"
            style="background: #113771;">
            <i class="bi bi-hash mr-2"></i>ORIGIN ADDRESS
        </h4> --}}
        <div class="row">

            <div class="col-lg-12">
                <div class="form-group">
                    <label>Address *</label>
                    <input type="text" class="form-control" name="Origin_Address" placeholder="Enter Origin"
                        value="{{ !is_null($Lisiting->routes) ? $Lisiting->routes->Origin_Address : '' }}"
                        autocomplete="off" required>
                    <div class="invalid-feedback">
                        Enter Address.
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <label>Address 2</label>
                    <input type="text" class="form-control" name="Origin_Address_II" placeholder="Enter Origin 2"
                        value="{{ !is_null($Lisiting->routes) ? $Lisiting->routes->Origin_Address_II : '' }}"
                        autocomplete="off">
                    <div class="invalid-feedback">
                        Enter Origin 2.
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <label>Zip Code *</label>
                    <input type="text" class="form-control Origin_ZipCode typeahead" name="Origin_ZipCode"
                        placeholder="Enter ZipCode"
                        value="{{ !is_null($Lisiting->routes) ? $Lisiting->routes->Origin_ZipCode : '' }}" required>
                    <div class="invalid-feedback">
                        Enter ZipCode.
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="col-lg-6 shadow-sm border rounded p-3">
        {{-- <h5 class="text-center"><b>DESTINATION ADDRESS</b></h5> --}}
        {{-- <h4 class="text-white py-2 d-flex justify-content-center"
            style="background: #113771;">
            <i class="bi bi-hash mr-2"></i>DESTINATION ADDRESS
        </h4> --}}
        <div class="row">

            <div class="col-lg-12">
                <div class="form-group">
                    <label>Address *</label>
                    <input type="text" class="form-control" name="Destination_Address"
                        placeholder="Enter Destination"
                        value="{{ !is_null($Lisiting->routes) ? $Lisiting->routes->Destination_Address : '' }}"
                        autocomplete="off" required>
                    <div class="invalid-feedback">
                        Entere Address.
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <label>Address 2</label>
                    <input type="text" class="form-control" name="Destination_Address_II"
                        placeholder="Enter Destination 2"
                        value="{{ !is_null($Lisiting->routes) ? $Lisiting->routes->Destination_Address_II : '' }}"
                        autocomplete="off">
                    <div class="invalid-feedback">
                        Enter Destination 2.
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <label>Zip Code *</label>
                    <input type="text" class="form-control Dest_ZipCode typeahead" name="Dest_ZipCode"
                        placeholder="Enter ZipCode"
                        value="{{ !is_null($Lisiting->routes) ? $Lisiting->routes->Dest_ZipCode : '' }}" required>
                    <div class="invalid-feedback">
                        Enter ZipCode.
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="row justify-content-center buttons-style">
    <div class="col-lg-3">
        <button type="button" class="btn btn-danger compare-listing" data-toggle="modal"
            data-target="#CompareListing">
            <input hidden class="Listed-Type" value="3">Price Insight
        </button>
    </div>
    <div class="col-lg-3">
        <a href="https://www.weather.gov/" target="_blank" class="btn btn-success"> View Weather</a>
    </div>
    <div class="col-lg-3">
        <a href="https://gasprices.aaa.com/" target="_blank" class="btn btn-primary"> Fuel Prices</a>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 shadow-sm border rounded p-3">
        {{-- <h5 class="text-center"><b>Carrier / Payment</b></h5> --}}
        <h4 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
            <i class="bi bi-hash mr-2"></i>Carrier / Payment
        </h4>

        <div class="row">

            <div class="col-lg-3">
                <div class="form-group">
                    <label>PRICING & PAYMENT</label>
                    <input type="number" class="form-control" placeholder="Order Booking Price"
                        name="Booking_Price" id="Booking_Price"
                        value="{{ (int) Str::replace(['$ ', ','], '', $Lisiting->paymentinfo->Order_Booking_Price) }}">
                    <div class="invalid-feedback">
                        Enter Booking Price.
                    </div>
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="deposite_Check" {{-- @checked(!is_null($Lisiting->paymentinfo->Deposite_Amount)) --}}>
                    <label class="form-check-label" for="deposite_Check">Deposit Amount?</label>
                </div>

            </div>
            <div class="col-lg-3 deposite-box">
                <div class="form-group">
                    <label>Deposit Amount *</label>
                    <input type="number" class="form-control Deposite_Amount" placeholder="Deposite Amount"
                        name="Deposite_Amount" id="Deposite_Amount"
                        value="{{ (int) Str::replace(['$ ', ','], '', $Lisiting->paymentinfo->Deposite_Amount) }}">
                    <div class="invalid-feedback">
                        Enter Deposit Amount.
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Price to Pay Carrier</label>
                    <input type="number" class="form-control Price-Pay" placeholder="Price to Pay" name="Price_Pay"
                        value="{{ (int) Str::replace(['$ ', ','], '', $Lisiting->paymentinfo->Price_Pay_Carrier) }}"
                        required>
                    <div class="invalid-feedback">
                        Enter Price Pay Amount.
                    </div>
                </div>
                <div class="row d-none">
                    <div class="col-lg-6">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="customControlValidation77"
                                name="Payment_Mode" value="COD" @checked($Lisiting->paymentinfo->Payment_Method_Mode === 'COD')>
                            <label class="custom-control-label" for="customControlValidation77">COD</label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="custom-control custom-radio mb-3">
                            <input type="radio" class="custom-control-input" id="customControlValidation88"
                                name="Payment_Mode" value="Quick Pay" @checked($Lisiting->paymentinfo->Payment_Method_Mode === 'Quick Pay')>
                            <label class="custom-control-label" for="customControlValidation88">Quick
                                Pay</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>COD/COP Amount</label>
                    <input type="number" class="form-control COD_Amount" placeholder="COD / COP Amount"
                        name="COD_Amount"
                        value="{{ (int) Str::replace(['$ ', ','], '', $Lisiting->paymentinfo->COD_Amount) }}"
                        required>
                    <div class="invalid-feedback">
                        Enter COD/COP Amount.
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Balance Amount</label>
                    <input readonly type="number" class="form-control Balance-Amount" placeholder="Balanced Amount"
                        name="Bal_Amount" id="Bal_Amount"
                        value="{{ (int) Str::replace(['$ ', ','], '', $Lisiting->paymentinfo->Balance_Amount) }}"
                        required>
                    <div class="invalid-feedback">
                        Enter Balance Amount.
                    </div>
                </div>
            </div>
            <div class="col-lg-3 cod-inputs">
                <div class="form-group">
                    <label>COD/COP Payment Method *</label>
                    <select class="custom-select COD_Payment_Mode" name="COD_Payment_Mode">
                        <option @selected(is_null($Lisiting->paymentinfo->COD_Method_Mode)) value="">Select
                            AnyOne
                        </option>
                        <option @selected($Lisiting->paymentinfo->COD_Method_Mode === 'Cash') value="Cash">
                            Cash
                        </option>
                        <option @selected($Lisiting->paymentinfo->COD_Method_Mode === 'Company Check') value="Company Check">
                            Company Check
                        </option>
                        <option @selected($Lisiting->paymentinfo->COD_Method_Mode === 'Certified Funds') value="Certified Funds">
                            Certified Funds
                        </option>
                        <option @selected($Lisiting->paymentinfo->COD_Method_Mode === 'Comcheck') value="Comcheck">
                            Comcheck
                        </option>
                        <option @selected($Lisiting->paymentinfo->COD_Method_Mode === 'TCH') value="TCH">
                            TCH
                        </option>
                    </select>
                    <div class="invalid-feedback">Select AnyOne</div>
                </div>
            </div>
            <div class="col-lg-3 cod-inputs">
                <div class="form-group">
                    <label>COD/COP Location *</label>
                    <select class="custom-select Location_Mode" name="Location_Mode">
                        <option @selected(is_null($Lisiting->paymentinfo->COD_Location_Amount)) value="">
                            Select AnyOne
                        </option>
                        <option @selected($Lisiting->paymentinfo->COD_Location_Amount === 'PickUp') value="PickUp">
                            PickUp
                        </option>
                        <option @selected($Lisiting->paymentinfo->COD_Location_Amount === 'Delivery') value="Delivery">
                            Delivery
                        </option>
                    </select>
                    <div class="invalid-feedback">Select AnyOne</div>
                </div>
            </div>
            <div class="col-lg-3 balance-inputs">
                <div class="form-group">
                    <label>Balance Payment Method *</label>
                    <select class="custom-select Balance_Payment_Mode" name="Balance_Payment_Mode">
                        <option @selected(is_null($Lisiting->paymentinfo->Bal_Method_Mode)) value="">Select
                            AnyOne
                        </option>
                        <option @selected($Lisiting->paymentinfo->Bal_Method_Mode === 'Cash') value="Cash">
                            Cash
                        </option>
                        <option @selected($Lisiting->paymentinfo->Bal_Method_Mode === 'Company Check') value="Company Check">
                            Company Check
                        </option>
                        <option @selected($Lisiting->paymentinfo->Bal_Method_Mode === 'Certified Funds') value="Certified Funds">
                            Certified Funds
                        </option>
                        <option @selected($Lisiting->paymentinfo->Bal_Method_Mode === 'Comcheck') value="Comcheck">
                            Comcheck
                        </option>
                        <option @selected($Lisiting->paymentinfo->Bal_Method_Mode === 'TCH') value="TCH">
                            TCH
                        </option>
                    </select>
                    <div class="invalid-feedback">Select AnyOne</div>
                </div>
            </div>
            <div class="col-lg-3 balance-inputs">
                <div class="form-group">
                    <label>Balance Payment Time *</label>
                    <select class="custom-select Bal_Payment_Time" name="Bal_Payment_Time">
                        <option @selected(is_null($Lisiting->paymentinfo->BAL_Payment_Time)) value="">Select
                            AnyOne
                        </option>
                        <option @selected($Lisiting->paymentinfo->BAL_Payment_Time === 'Immediately') value="Immediately">
                            Immediately
                        </option>
                        <option @selected($Lisiting->paymentinfo->BAL_Payment_Time === '2 Business Days (Quick Pay)') value="2 Business Days (Quick Pay)">
                            2
                            Business Days (Quick
                            Pay)
                        </option>
                        <option @selected($Lisiting->paymentinfo->BAL_Payment_Time === '5 Business Days') value="5 Business Days">
                            5 Business Days
                        </option>
                        <option @selected($Lisiting->paymentinfo->BAL_Payment_Time === '10 Business Days') value="10 Business Days">
                            10 Business Days
                        </option>
                        <option @selected($Lisiting->paymentinfo->BAL_Payment_Time === '15 Business Days') value="15 Business Days">
                            15 Business Days
                        </option>
                        <option @selected($Lisiting->paymentinfo->BAL_Payment_Time === '30 Business Days') value="30 Business Days">
                            30 Business Days
                        </option>
                    </select>
                    <div class="invalid-feedback">Select AnyOne</div>
                </div>
            </div>
            <div class="col-lg-3 balance-inputs">
                <div class="form-group">
                    <label>Balance Payment Terms Begin On *</label>
                    <select class="custom-select Payment_Terms" name="Payment_Terms">
                        <option @selected(is_null($Lisiting->paymentinfo->BAL_Payment_Terms)) value="">
                            Select AnyOne
                        </option>
                        <option @selected($Lisiting->paymentinfo->BAL_Payment_Terms === 'PickUp') value="PickUp">
                            PickUp
                        </option>
                        <option @selected($Lisiting->paymentinfo->BAL_Payment_Terms === 'Delivery') value="Delivery">
                            Delivery
                        </option>
                        <option @selected($Lisiting->paymentinfo->BAL_Payment_Terms === 'Receiving a Sign Bill Of Lading') value="Receiving a Sign Bill Of Lading">
                            Receiving a Sign Bill Of Lading
                        </option>
                    </select>
                    <div class="invalid-feedback">Select AnyOne</div>
                </div>
            </div>
        </div>

        {{-- <div class="col-lg-12">
            <div class="form-group">
                <label>Additional Payment Information</label>
                <textarea cols="30" rows="5" name="Desc_For_Vehcile" placeholder="Write something..."
                    class="form-control">{{ !is_null($Lisiting->additional_info) ? $Lisiting->additional_info->Vehcile_Desc : '' }}</textarea>
            </div>
        </div> --}}
    </div>
    <div class="row">
        <div class="PaymentInfo col-sm-12">
            {!! $Lisiting->paymentinfo->PaymentInfo ?? null !!}
        </div>
        <input type="hidden" name="PaymentInfo" id="PaymentInfoInput">
        <div class="BalPaymentInfo col-sm-12">
            {!! $Lisiting->paymentinfo->BalPaymentInfo ?? null !!}
        </div>
        <input type="hidden" name="BalPaymentInfo" id="BalPaymentInfoInput">
    </div>
</div>
<div class="row">
    <div class="col-lg-12 shadow-sm border rounded p-3">
        {{-- <h5 class="text-center"><b>Additional Information</b></h5> --}}
        <h4 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
            <i class="bi bi-hash mr-2"></i>Additional Information
        </h4>
        <div class="row">
            <div class="col-lg-4 basic-vehcile-info">
                <div class="form-group">
                    <label>Order ID</label>
                    <input type="text" class="form-control" placeholder="Dispatch ID" name="Ref_ID"
                        value="{{ $Lisiting->Ref_ID }}" required>
                    <div class="invalid-feedback">
                        Enter Order ID.
                    </div>
                </div>
            </div>
            @foreach ($Lisiting->attachments as $image)
                <div class="col-md-3">
                    <img src="{{ asset($image->Image_Name) }}" alt="Existing Image">
                    <!-- Optionally, add a delete button/icon here if needed -->
                </div>
            @endforeach
            <div class="col-lg-4">
                <label>Upload Any Vehicle Images</label>
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="Vehcile_Images[]"
                            id="image-upload-first" accept="image/*" multiple>
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="image-preview-first" class="displayimages row"></div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Additional Terms</label>
                    <textarea cols="30" rows="5" name="Additional_Terms" placeholder="Enter Additional Terms"
                        class="form-control">{{ !empty($Lisiting->additional_info->Additional_Terms) ? $Lisiting->additional_info->Additional_Terms : '' }}</textarea>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Special Instructions</label>
                    <textarea cols="30" rows="5" name="Special_Terms"
                        placeholder="Enter Any Special Instructions Regarding this Shipment" class="form-control">{{ !empty($Lisiting->additional_info->Special_Instructions) ? $Lisiting->additional_info->Special_Instructions : '' }}</textarea>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Notes From Customer</label>
                    <textarea cols="30" rows="5" name="Special_Notes"
                        placeholder="Enter Any Notes From Customer or Detail Regarding this Shipment" class="form-control">{{ !is_null($Lisiting->additional_info) ? $Lisiting->additional_info->Notes_Customer : '' }}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- <div class="row">
                    @foreach ($MyContract as $key => $row)
<div class="col-md-2">
                            <div class="form-group card showmycontract">
                                <div class="row">
                                    <div class="col-md-2">
                                        <h3>
                                            <i class="bx bx-file"></i>
                                        </h3>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="text">
                                            Contract:{{ $key + 1 }}
                                        </div>
                                    </div>
                                </div>
                                <p>{{ $row->contractName }}</p>
                                <input type="hidden" value='{{ $row->My_Contract }}' />
                            </div>
                        </div>
@endforeach
                </div>
                <div class="form-group">
                    <label>Contract</label>
                    <textarea cols="30" rows="15" name="Listing_Contract" class="form-control showcontent">
                        @if (count($MyContract) > 0)
{{ $MyContract[0]->My_Contract }}
@endif
                    </textarea>
                </div> -->
                <div class="form-group">
                    <label for="contractDropdown">Select Contract:</label>
                    <select id="contractDropdown" class="form-control showmycontract"
                        onchange="updateTextareaAndLabel()">
                        @foreach ($MyContract as $key => $row)
                            <option value="{{ $row->My_Contract }}" data-contract-name="{{ $row->contractName }}">
                                Contract:{{ $key + 1 }} - {{ $row->contractName }}
                            </option>
                        @endforeach
                    </select>
                    @if (!empty($MyContract) && isset($MyContract[0]->My_Contract))
                        <input type="hidden" class="hiddenContract" value='{{ $MyContract[0]->My_Contract }}' />
                    @else
                        <input type="hidden" class="hiddenContract" value='' />
                    @endif
                </div>

                <div class="form-group">
                    <label id="textareaLabel">Contract</label>
                    <textarea cols="30" rows="15" name="Listing_Contract" class="showcontent form-control">
                        @if (count($MyContract) > 0)
{{ $MyContract[0]->My_Contract }}
@endif
                    </textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function updateTextareaAndLabel() {
        let contractDropdown = document.getElementById('contractDropdown');
        let selectedContractValue = contractDropdown.value;
        let selectedContractName = contractDropdown.options[contractDropdown.selectedIndex].getAttribute(
            'data-contract-name');

        // Update the textarea with the selected contract value
        document.querySelector('.showcontent').value = selectedContractValue;

        // Update the label above the textarea with the selected contract name
        document.getElementById('textareaLabel').innerText = 'Contract: ' + selectedContractName;
    }
</script>
<script>
    $(document).ready(function() {
        // $('.Price-Pay').on('keyup keydown', function(event) {
        //     // Check if the event is keyup or keydown
        //     var eventType = event.type;

        //     // Get the value enter in the input field
        //     var price = $(this).val();

        //     // Get the key code of the pressed key
        //     var keyCode = event.keyCode;

        //     // Example: Log the event type, enter price, and key code
        //     console.log('Event type:', eventType);
        //     console.log('Price entered:', price);
        //     console.log('Key code pressed:', keyCode);
        // });

        // // Define event handlers
        // $('.COD_Amount').on('keyup keydown', function(event) {
        //     $('.PaymentInfo').html(
        //         "<p class='alert alert-danger codPayor'><span class='codPayorText'>The carrier will receive <b>$" +
        //         $(this).val() + "</b></span></p>");
        // });

        // $('.custom-select[name="COD_Payment_Mode"]').on('change', function() {
        //     updatePaymentInfo();
        // });

        // $('.custom-select[name="Location_Mode"]').on('change', function() {
        //     updatePaymentInfo();
        // });

        // $('.custom-select[name="Balance_Payment_Mode"]').on('change', function() {
        //     updateBalPaymentInfo();
        // });

        // $('.custom-select[name="Bal_Payment_Time"]').on('change', function() {
        //     updateBalPaymentInfo();
        // });

        // $('.custom-select[name="Payment_Terms"]').on('change', function() {
        //     console.log('oksss2');
        //     updateBalPaymentInfo();
        // });

        // Function to update PaymentInfo section
        // function updatePaymentInfo() {
        //     var codAmount = $('.COD_Amount').val();
        //     var codPaymentMode = $('.custom-select[name="COD_Payment_Mode"]').val();
        //     var locationMode = $('.custom-select[name="Location_Mode"]').val();

        //     var htmlContent = '';

        //     if (codAmount && codPaymentMode && locationMode) {
        //         htmlContent =
        //             "<p class='alert alert-danger codPayor'><span class='codPayorText'>The carrier will receive <b>$" +
        //             codAmount + "</b> via <b>" + codPaymentMode + "</b> at <b>" + locationMode +
        //             "</b></span></p>";
        //     }

        //     $('.PaymentInfo').empty().append(htmlContent);
        // }

        // // Function to update BalPaymentInfo section
        // function updateBalPaymentInfo() {
        //     var balanceAmount = $('.Balance-Amount').val();
        //     var balancePaymentMode = $('.custom-select[name="Balance_Payment_Mode"]').val();
        //     var balPaymentTime = $('.custom-select[name="Bal_Payment_Time"]').val();
        //     var paymentTerms = $('.custom-select[name="Payment_Terms"]').val();

        //     // NEW
        //     var codAmount = $('.COD_Amount').val();
        //     var Price_Pay = $('.Price-Pay').val();

        //     // alert(Price_Pay); alert(codAmount);



        //     // var htmlContent = '';



        //     // if (balanceAmount && balancePaymentMode && balPaymentTime && Price_Pay) {
        //     //     if (balPaymentTime === "Immediately") {
        //     //         if ($('.COD_Amount').val() === $('.Price-Pay').val()) {
        //     //             console.log('yes equal');
        //     //         }
        //     //         htmlContent =
        //     //             "<p class='alert alert-danger balancePayor'><span class='balancePayorText'>Carrier will pay you <b>$" +
        //     //             balanceAmount + "</b> via <b>" + balancePaymentMode + "</b> " + balPaymentTime +
        //     //             "</span> " + paymentTerms + " </p>";
        //     //     } else {
        //     //         htmlContent =
        //     //             "<p class='alert alert-danger balancePayor'><span class='balancePayorText'>You will pay carrier <b>$" +
        //     //             balanceAmount + "</b> via <b>" + balancePaymentMode + "</b> within " + balPaymentTime +
        //     //             "</span> " + paymentTerms + " </p>";
        //     //     }
        //     // }

        //     // $('.BalPaymentInfo').empty().append(htmlContent);
        // }




        // Trigger change event initially
        $('.custom-select[name="COD_Payment_Mode"]').change();
        $('.custom-select[name="Location_Mode"]').change();
        $('.custom-select[name="Balance_Payment_Mode"]').change();
        $('.custom-select[name="Bal_Payment_Time"]').change();

        // Add new work
        $('.COD_Amount').change(function() {
            console.log('iojasdo');
            var PricPay = parseFloat($('.Price-Pay').val());
            var CodAmount = parseFloat($('.COD_Amount').val());
            var PaymentVia = $('.COD_Payment_Mode').val();
            var LocationMode = $('.custom-select[name="Location_Mode"]').val();
            var BalancePaymentVia = $('.custom-select[name="Balance_Payment_Mode"]').val();
            var BalancePaymentTime = $('.custom-select[name="Bal_Payment_Time"]').val();
            var BalanceAmount = Math.max(0, PricPay - CodAmount);
            // alert(BalancePaymentVia);
            // var htmlContent;

            // if (PricPay < CodAmount) {
            //     htmlContent =
            //         "<p class='alert alert-danger balancePayor'><span class='balancePayorText'>Carrier will pay you <b>$" +
            //         BalanceAmount + "</b> via <b>" + BalancePaymentVia + "</b> within " +
            //         BalancePaymentTime + "</span></p>";
            //     $('.BalPaymentInfo').html(htmlContent).show();
            // } else if (PricPay > CodAmount) {
            //     htmlContent =
            //         "<p class='alert alert-danger balancePayor'><span class='balancePayorText'>You will pay the carrier <b>$" +
            //         BalanceAmount + "</b> via <b>" + BalancePaymentVia + "</b> within " +
            //         BalancePaymentTime + "</span></p>";
            //     $('.BalPaymentInfo').html(htmlContent).show();
            // } else {
            //     $('.BalPaymentInfo').hide();
            // }
        });




        // $('.custom-select[name="Payment_Terms"]').on('change', function() {

        //     console.log('Selected Balance Payment Terms Begin On:', selectedValue);

        // });

        console.log($('#Orign_Location_Check').val() + 'show')

        $('.orig-auction-input-field').hide();
        $('.dest-auction-input-field').hide();
        // if ($('#Orign_Location_Check').val() == null || $('#Orign_Location_Check').val() == '') {

        //     $('.orig-auction').hide();
        //     $('.orig-dealership').hide();
        //     $('.orig-location').hide();
        //     $('.orig-port').hide();

        // } else if ($('#Orign_Location_Check').val() == 'Location') {

        //     $('.orig-basic').hide();
        //     $('.orig-auction').hide();
        //     $('.orig-dealership').hide();
        //     $('.orig-port').hide();

        // } else if ($('#Orign_Location_Check').val() == 'Dealership') {

        //     $('.orig-basic').hide();
        //     $('.orig-auction').hide();
        //     $('.orig-location').hide();
        //     $('.orig-port').hide();

        // } else if ($('#Orign_Location_Check').val() == 'Auction') {

        //     $('.orig-basic').hide();
        //     $('.orig-dealership').hide();
        //     $('.orig-location').hide();
        //     $('.orig-port').hide();

        // } else if ($('#Orign_Location_Check').val() == 'Port') {

        //     $('.orig-basic').hide();
        //     $('.orig-auction').hide();
        //     $('.orig-dealership').hide();
        //     $('.orig-location').hide();

        // }

        const Orig = $('#Orign_Location_Check').val();
        if (Orig !== null) {
            $('.orig-basic').show();
        } else {
            $('.orig-basic').hide();
        }
        if (Orig === 'Location') {
            $('.orig-location').show();
        } else {
            $('.orig-location').hide();
        }
        if (Orig === 'Dealership') {
            $('.orig-dealership').show();
        } else {
            $('.orig-dealership').hide();
        }
        if (Orig === 'Auction') {
            $('.orig-auction').show();
            $('.orig-auction select').change(function() {
                const $auctionVal = $(this).val();
                console.log('working');
                if ($auctionVal === 'Other') {
                    $('.orig-auction-input-field').show();
                    $('.orig-auction select').removeAttr('name');
                } else {
                    $('.orig-auction-input-field').hide();
                    $('.orig-auction select').attr('name', 'Auction_Method');
                }
            });
        } else {
            $('.orig-auction').hide();
        }
        if (Orig === 'Port') {
            $('.orig-port').show();
        } else {
            $('.orig-port').hide();
        }


        $('.Orig').change(function() {
            const Orig = $(this).val();
            if (Orig !== null) {
                $('.orig-basic').show();
            } else {
                $('.orig-basic').hide();
            }
            if (Orig === 'Location') {
                $('.orig-location').show();
            } else {
                $('.orig-location').hide();
            }
            if (Orig === 'Dealership') {
                $('.orig-dealership').show();
            } else {
                $('.orig-dealership').hide();
            }
            if (Orig === 'Auction') {
                $('.orig-auction').show();
                $('.orig-auction select').change(function() {
                    const $auctionVal = $(this).val();
                    console.log('working');
                    if ($auctionVal === 'Other') {
                        $('.orig-auction-input-field').show();
                        $('.orig-auction select').removeAttr('name');
                    } else {
                        $('.orig-auction-input-field').hide();
                        $('.orig-auction select').attr('name', 'Auction_Method');
                    }
                });
            } else {
                $('.orig-auction').hide();
            }
            if (Orig === 'Port') {
                $('.orig-port').show();
            } else {
                $('.orig-port').hide();
            }
        });

        // if ($('#Destination_Location_Check').val() == null || $('#Destination_Location_Check').val() == '') {

        //     $('.dest-auction').hide();
        //     $('.dest-dealership').hide();
        //     $('.dest-location').hide();
        //     $('.dest-port').hide();

        // } else if ($('#Destination_Location_Check').val() == 'Location') {

        //     $('.dest-basic').hide();
        //     $('.dest-auction').hide();
        //     $('.dest-dealership').hide();
        //     $('.dest-port').hide();

        // } else if ($('#Destination_Location_Check').val() == 'Dealership') {

        //     $('.dest-basic').hide();
        //     $('.dest-auction').hide();
        //     $('.dest-location').hide();
        //     $('.dest-port').hide();

        // } else if ($('#Destination_Location_Check').val() == 'Auction') {

        //     $('.dest-basic').hide();
        //     $('.dest-dealership').hide();
        //     $('.dest-location').hide();
        //     $('.dest-port').hide();

        // } else if ($('#Destination_Location_Check').val() == 'Port') {

        //     $('.dest-basic').hide();
        //     $('.dest-auction').hide();
        //     $('.dest-dealership').hide();
        //     $('.dest-location').hide();
        // }

        const Dest = $('#Destination_Location_Check').val();
        if (Dest !== null) {
            $('.dest-basic').show();
        } else {
            $('.dest-basic').hide();
        }
        if (Dest === 'Location') {
            $('.dest-location').show();
        } else {
            $('.dest-location').hide();
        }
        if (Dest === 'Dealership') {
            $('.dest-dealership').show();
        } else {
            $('.dest-dealership').hide();
        }
        if (Dest === 'Auction') {
            $('.dest-auction').show();
            $('.dest-auction select').change(function() {
                const $auctionVal = $(this).val();
                if ($auctionVal === 'Other') {
                    $('.dest-auction-input-field').show();
                    $('.dest-auction select').removeAttr('name');
                } else {
                    $('.dest-auction-input-field').hide();
                    $('.dest-auction select').attr('name', 'Auction_Method_def');
                }
            });
        } else {
            $('.dest-auction').hide();
        }
        if (Dest === 'Port') {
            $('.dest-port').show();
        } else {
            $('.dest-port').hide();
        }

        $('.Dest').change(function() {
            const Dest = $(this).val();
            if (Dest !== null) {
                $('.dest-basic').show();
            } else {
                $('.dest-basic').hide();
            }
            if (Dest === 'Location') {
                $('.dest-location').show();
            } else {
                $('.dest-location').hide();
            }
            if (Dest === 'Dealership') {
                $('.dest-dealership').show();
            } else {
                $('.dest-dealership').hide();
            }
            if (Dest === 'Auction') {
                $('.dest-auction').show();
                $('.dest-auction select').change(function() {
                    const $auctionVal = $(this).val();
                    if ($auctionVal === 'Other') {
                        $('.dest-auction-input-field').show();
                        $('.dest-auction select').removeAttr('name');
                    } else {
                        $('.dest-auction-input-field').hide();
                        $('.dest-auction select').attr('name', 'Auction_Method_def_abc');
                    }
                });
            } else {
                $('.dest-auction').hide();
            }
            if (Dest === 'Port') {
                $('.dest-port').show();
            } else {
                $('.dest-port').hide();
            }
        });

        $('.vin-box').hide();
        // $('.custom-control-input', this).change(function() {
        //     const mod = $(this).val();
        //     // $(".basic-vehcile-info input").prop('required', true);
        //     if (mod === 'VIN') {
        //         $('.vehcile-information .vin-box').show();
        //         $(".vin-box input").prop('required', true);
        //         $(".basic-vehcile-info input").attr("readonly", true);
        //         $(".basic-vehcile-info input").prop('required', false);
        //         // $('.basic-vehcile-info').hide();
        //         $('.vin-box input').on('keyup', function() {
        //             const Vin_Number = $(this).val();
        //             console.log(Vin_Number, 'Vin_Number');

        //             $.ajax({
        //                 url: '{{ route('Get.Vin.Number') }}',
        //                 type: 'GET',
        //                 data: {
        //                     'Vin_Number': Vin_Number
        //                 },
        //                 success: function(data) {
        //                     $('.vehcile-information .basic-vehcile-info input.make')
        //                         .val(data['Make']);
        //                     $('.vehcile-information .basic-vehcile-info input.year')
        //                         .val(data['Year']);
        //                     $('.vehcile-information .basic-vehcile-info input.model')
        //                         .val(data['Model']);
        //                 }
        //             });

        //         });
        //     }
        //     if (mod === 'YMM') {
        //         $('.basic-vehcile-info').show();
        //         $(".basic-vehcile-info input").prop('required', true);
        //         $(".basic-vehcile-info input").attr("readonly", false);
        //         $(".vin-box input").prop('required', false);
        //         $('.vehcile-information .vin-box').hide();
        //     }
        // });
        // $(document).ready(function() {
        //     // Attach change event handler to radio buttons with class .custom-control-input
        //     $('.custom-control-input').change(function() {
        //         const mod = $(this).val();

        //         if (mod === 'VIN') {
        //             // Show VIN-related elements
        //             $('.vehcile-information .vin-box').show();
        //             $('.vehcile-information .vehcile-information-container-vin').show();
        //             $('.vehcile-information .vehcile-information-container-ymm').hide();
        //             $('.vehcile-information .vehcile-information-container-vin input').prop(
        //                 'disabled', false);
        //             $('.vehcile-information .vehcile-information-container-ymm input').prop(
        //                 'disabled', true);
        //             $(".vin-box input").prop('required', true);
        //             $(".basic-vehcile-info input").attr("readonly", true);
        //             $(".basic-vehcile-info input").prop('required', false);

        //             // Attach keyup event handler to VIN input
        //             $('.vin-box input').off('keyup').on('keyup', function() {
        //                 const Vin_Number = $(this).val();
        //                 console.log(Vin_Number, 'Vin_Number');

        //                 $.ajax({
        //                     url: '{{ route('Get.Vin.Number') }}',
        //                     type: 'GET',
        //                     data: {
        //                         'Vin_Number': Vin_Number
        //                     },
        //                     success: function(data) {
        //                         $('.vehcile-information .basic-vehcile-info input.make')
        //                             .val(data['Make']);
        //                         $('.vehcile-information .basic-vehcile-info input.year')
        //                             .val(data['Year']);
        //                         $('.vehcile-information .basic-vehcile-info input.model')
        //                             .val(data['Model']);
        //                     }
        //                 });
        //             });

        //             // Hide YMM-related elements
        //             // $('.basic-vehcile-info').hide();
        //         }

        //         if (mod === 'YMM') {
        //             // Show YMM-related elements
        //             $('.basic-vehcile-info').show();
        //             $('.vehcile-information .vehcile-information-container-vin').hide();
        //             $('.vehcile-information .vehcile-information-container-vin input').prop(
        //                 'disabled', true);
        //             $('.vehcile-information .vehcile-information-container-ymm input').prop(
        //                 'disabled', false);
        //             $('.vehcile-information .vehcile-information-container-ymm').show();
        //             $(".basic-vehcile-info input").prop('required', true);
        //             $(".basic-vehcile-info input").attr("readonly", false);
        //             $(".vin-box input").prop('required', false);
        //             $('.vehcile-information .vin-box').hide();
        //         }
        //     });

        //     // Trigger change event on initially checked radio button (if any)
        //     $('.custom-control-input:checked').trigger('change');
        // });

        $(document).ready(function() {
            // Attach change event handler to radio buttons with class .custom-control-input
            $('.custom-control-input').change(function() {
                const mod = $(this).val();
                const vehicleInfo = $(this).closest('.vehcile-information');

                if (mod === 'VIN') {
                    // Show VIN-related elements within the specific vehicle information container
                    vehicleInfo.find('.vin-box').show();
                    vehicleInfo.find('.vehcile-information-container-vin').show();
                    vehicleInfo.find('.vehcile-information-container-ymm').hide();
                    vehicleInfo.find('.vehcile-information-container-vin input').prop(
                        'disabled', false);
                    vehicleInfo.find('.vehcile-information-container-ymm input').prop(
                        'disabled', true);
                    vehicleInfo.find(".vin-box input").prop('required', true);
                    vehicleInfo.find(".basic-vehcile-info input").attr("readonly", true);
                    vehicleInfo.find(".basic-vehcile-info input").prop('required', false);

                    // Attach keyup event handler to VIN input within the specific vehicle information container
                    vehicleInfo.find('.vin-box input').off('keyup').on('keyup', function() {
                        const Vin_Number = $(this).val();
                        console.log(Vin_Number, 'Vin_Number');

                        $.ajax({
                            url: '{{ route('Get.Vin.Number') }}',
                            type: 'GET',
                            data: {
                                'Vin_Number': Vin_Number
                            },
                            success: function(data) {
                                vehicleInfo.find(
                                        '.basic-vehcile-info input.make')
                                    .val(data['Make']);
                                vehicleInfo.find(
                                        '.basic-vehcile-info input.year')
                                    .val(data['Year']);
                                vehicleInfo.find(
                                        '.basic-vehcile-info input.model')
                                    .val(data['Model']);
                            }
                        });
                    });

                    // Hide YMM-related elements within the specific vehicle information container
                    // Except the Year, Make, and Model fields
                    // vehicleInfo.find('.basic-vehcile-info input:not(.make, .model, .year)')
                    //     .hide();
                    vehicleInfo.find('.basic-vehcile-info select').hide();
                }

                if (mod === 'YMM') {
                    // Show YMM-related elements within the specific vehicle information container
                    vehicleInfo.find('.basic-vehcile-info input').show();
                    vehicleInfo.find('.basic-vehcile-info select').show();
                    vehicleInfo.find('.vehcile-information-container-vin').hide();
                    vehicleInfo.find('.vehcile-information-container-vin input').prop(
                        'disabled', true);
                    vehicleInfo.find('.vehcile-information-container-ymm input').prop(
                        'disabled', false);
                    vehicleInfo.find('.vehcile-information-container-ymm').show();
                    vehicleInfo.find(".basic-vehcile-info input").prop('required', true);
                    vehicleInfo.find(".basic-vehcile-info input").attr("readonly", false);
                    vehicleInfo.find(".vin-box input").prop('required', false);
                    vehicleInfo.find('.vin-box').hide();
                }
            });

            // Trigger change event on initially checked radio button (if any)
            $('.custom-control-input:checked').trigger('change');
        });


        // Custom Listing
        // $('.Custom-Date').hide();
        // $('#custom_Check').change(function() {
        //     checkBox = document.getElementById('custom_Check');
        //     if (checkBox.checked) {
        //         $('.Custom-Date').show();
        //         $(".Custom-Date input").prop('required', true);
        //     } else {
        //         $('.Custom-Date').hide();
        //         $(".Custom-Date input").prop('required', false);
        //     }
        // });

        $(document).ready(function() {
            // Check the initial state of the checkbox
            if ($('#custom_Check').is(':checked')) {
                $('.Custom-Date').show();
                $(".Custom-Date input").prop('required', true);
            }

            // Toggle the date field based on the checkbox
            $('#custom_Check').change(function() {
                if ($(this).is(':checked')) {
                    $('.Custom-Date').show();
                    $(".Custom-Date input").prop('required', true);
                } else {
                    $('.Custom-Date').hide();
                    $(".Custom-Date input").prop('required', false);
                }
            });
        });

        // ZipCodes For Vehicle Posting
        $('.Dest_ZipCode.typeahead, .Origin_ZipCode.typeahead').typeahead({
            source: function(query, process) {
                return $.get(path, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });

        const GetVehicleMake = '{{ route('Get.Vehcile.Make') }}';
        const GetVehicleModel = '{{ route('Get.Vehcile.Model') }}';

        $('input.make.typeahead').typeahead({
            source: function(query, process) {
                return $.get(GetVehicleMake, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });
        $('input.makes.typeahead').typeahead({
            source: function(query, process) {
                return $.get(GetVehicleMake, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });

        $('input.model.typeahead').typeahead({
            source: function(query, process) {
                return $.get(GetVehicleModel, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });
        $('input.models.typeahead').typeahead({
            source: function(query, process) {
                return $.get(GetVehicleModel, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });

        // Deposite Amount
        var depositeBox = $('.deposite-box input').val();
        if (depositeBox !== null && depositeBox != 0) {
            $('.deposite-box').show();
        } else {
            $('.deposite-box').hide();
        }

        $('#deposite_Check').change(function() {
            checkBox = document.getElementById('deposite_Check');
            if (checkBox.checked) {
                $('.deposite-box').show();
                $(".deposite-box input").prop('required', true);
            } else {
                $('.deposite-box').hide();
                $(".deposite-box input").prop('required', false);
            }
        });

        if ($('.Balance-Amount').val() <= 0 && $('.COD_Amount').val() <= 0) {
            // $('.balance-inputs').hide();
            $('.cod-inputs').hide();
        } else if ($('.Balance-Amount').val() <= 0) {
            // $('.balance-inputs').hide();
            // } else if ($('.COD_Amount').val() <= 0) {
        } else if ($('.Balance-Amount').val() == 0) {
            $('.cod-inputs').hide();
        }
        $('.Balance-Amount').on('change', function() {
            var balance = parseInt($(this).val());
            if (balance === 0) {
                $('.balance-inputs').hide();
                $(".balance-inputs select").prop('required', false);
            } else {
                $('.balance-inputs').show();
                $(".balance-inputs select").prop('required', true);
            }
        });

        // $('.cod-inputs').hide();
        $('.COD_Amount').on('change', function() {
            var cod = parseInt($(this).val());
            if (cod === 0) {
                $('.cod-inputs').hide();
                $(".cod-inputs select").prop('required', false);
            } else {
                $('.cod-inputs').show();
                $(".cod-inputs select").prop('required', true);
            }
        });

        $(".Price-Pay, .COD_Amount").on("keydown keyup", function() {
            var PricPay = parseInt($('.Price-Pay').val());
            var CodAmount = parseInt($('.COD_Amount').val());

            var BalanceAmount = Math.max(0, PricPay - CodAmount);
            $('.Balance-Amount').val(Math.abs(BalanceAmount));
            if (BalanceAmount == 0) {
                // $('.balance-inputs').show();
                $('.balance-inputs').hide();
                $(".balance-inputs select").prop('required', false);
            } else {
                $('.balance-inputs').show();
                $(".balance-inputs select").prop('required', true);
            }

            // $('.PaymentInfo').html(
            //     "<p class='alert alert-danger codPayor'><span class='codPayorText'>The carrier will receive <b>$" +
            //     CodAmount + "</b> via <b>" + 'PaymentVia' + "</b> at <b>" + 'LocationMode' +
            //     "</b></span></p>");

            // $('.BalPaymentInfo').html(
            //     "<p class='alert alert-danger balancePayor'><span class='balancePayorText'>You will pay the carrier <b>$" +
            //     BalanceAmount + "</b> via <b>" + 'BalancePaymentVia' + "</b> within " +
            //     '$('.custom-select[name="Bal_Payment_Time"]').val()' +
            //     "</span></p>");
        });

        // $('.showmycontract').click(function() {
        //     let x = $(this).children('input').val();
        //     $('.showcontent').text(x);
        // })



        $('.orig-location-business').hide();
        $('.dest-location-business').hide();
        $('.orig-business-location').change(function() {
            const Dest = $(this).val();
            console.log('orig-business-location', Dest);
            if (Dest === 'Business') {
                $('.orig-location-business').show();
            } else {
                $('.orig-location-business').hide();
            }
        });
        $('.dest-business-location').change(function() {
            const Dest = $(this).val();
            console.log('dest-business-location', Dest);
            if (Dest === 'Business') {
                $('.dest-location-business').show();
            } else {
                $('.dest-location-business').hide();
            }
        });

        // Get references to the input and image preview div
        const imageInput1 = document.getElementById('image-upload-first');
        const imagePreview1 = document.getElementById('image-preview-first');

        // Handle file input change
        imageInput1.addEventListener('change', () => {
            const files = imageInput1.files;

            if (files.length === 0) {
                alert('Please select at least one image.');
                return;
            }

            // Clear the previous image previews
            imagePreview1.innerHTML = '';

            // Loop through the selected files and create image previews
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const colDiv = document.createElement('div');
                colDiv.classList.add('col-md-3'); // Add Bootstrap class

                const imgWrapper = document.createElement('div');
                imgWrapper.classList.add('image-wrapper');

                const img = document.createElement('img');
                img.classList.add('preview-image');
                img.src = URL.createObjectURL(file);
                img.alt = file.name;

                const deleteIcon = document.createElement('span');
                deleteIcon.classList.add('delete-icon');
                deleteIcon.innerHTML = '&times;'; // Displaying 'x' as a cross icon
                deleteIcon.addEventListener('click', () => {
                    // Remove the image preview on click
                    colDiv.remove();
                });

                imgWrapper.appendChild(img);
                imgWrapper.appendChild(deleteIcon);
                colDiv.appendChild(imgWrapper);
                imagePreview1.appendChild(colDiv);
            }
        });

    });

    $('#heavy .Custom-Date').hide();
    $('#heavy #custom_Check').change(function() {
        checkBox = document.getElementById('custom_Check');
        if (checkBox.checked) {
            $('#heavy .Custom-Date').show();
            $("#heavy .Custom-Date input").prop('required', true);
        } else {
            $('#heavy .Custom-Date').hide();
            $("#heavy .Custom-Date input").prop('required', false);
        }
    });
</script>
<script>
    // JavaScript to handle the calculation of Balance Amount
    document.addEventListener('DOMContentLoaded', function() {
        const bookingPriceInput = document.getElementById('Booking_Price');
        const depositAmountInput = document.getElementById('Deposite_Amount');
        const balanceAmountInput = document.getElementById('Bal_Amount');

        // Function to update balance amount
        function updateBalanceAmount() {
            const bookingPrice = parseFloat(bookingPriceInput.value) || 0; // Get Booking Price
            const depositAmount = parseFloat(depositAmountInput.value) || 0; // Get Deposit Amount

            const balanceAmount = bookingPrice - depositAmount; // Calculate Balance Amount
            balanceAmountInput.value = balanceAmount.toFixed(2); // Set the value in Bal_Amount
        }

        // Event listeners to update balance amount when inputs change
        bookingPriceInput.addEventListener('input', updateBalanceAmount);
        depositAmountInput.addEventListener('input', updateBalanceAmount);
    });
</script>
<script>
    $(document).ready(function() {

        var PricPay = parseFloat($('.Price-Pay').val()) || 0;
        var CodAmount = parseFloat($('.COD_Amount').val()) || 0;
        var BalanceAmount = PricPay - CodAmount;

        if (BalanceAmount < 0) {
            $('.balance-inputs').show();
            $('.BalPaymentInfo').show();
        } else {
            $('.balance-inputs').hide();
            $('.BalPaymentInfo').hide();
        }
        // asd

        const fields =
            '.Price-Pay, .COD_Amount, .Balance-Amount, .COD_Payment_Mode, .Location_Mode, .Balance_Payment_Mode, .Bal_Payment_Time, .Payment_Terms';

        $(document).on('change', fields, function(e) {
            // console.log(`Changed element: ${e.target.name}, Value: ${$(this).val()}`);

            var PricPay = parseFloat($('.Price-Pay').val()) || 0;
            var CodAmount = parseFloat($('.COD_Amount').val()) || 0;
            var BalanceAmount = PricPay - CodAmount;
            var PaymentVia = $('.COD_Payment_Mode').val() || 'N/A';
            var LocationMode = $('.Location_Mode').val() || 'N/A';
            var BalancePaymentVia = $('.Balance_Payment_Mode').val() || 'N/A';
            var BalancePaymentTime = $('.Bal_Payment_Time').val() || 'N/A';
            var PaymentTerms = $('.Payment_Terms').val() || 'N/A';

            console.log('BalancePaymentTimeBalancePaymentTime', BalancePaymentTime);

            // Ensure BalanceAmount cannot be negative
            if (BalanceAmount < 0) {
                BalanceAmount = Math.abs(BalanceAmount);
                var isCarrierPaying = true;
            } else {
                var isCarrierPaying = false;
            }

            // Build htmlContent
            var htmlContent = "<p class='alert alert-danger codPayor'><span class='codPayorText'>";
            htmlContent += "The carrier will receive <b>$" + CodAmount.toFixed(2) + "</b>";

            if (PaymentVia !== 'N/A') {
                htmlContent += " via <b>" + PaymentVia + "</b>";
            }

            if (LocationMode !== 'N/A') {
                htmlContent += " at <b>" + LocationMode + "</b>";
            }

            htmlContent += "</span></p>";

            if (CodAmount === 0) {
                $('.PaymentInfo').empty().hide();
            } else {
                $('.PaymentInfo').show();
                $('.PaymentInfo').empty().append(htmlContent);
                $('#PaymentInfoInput').val(htmlContent);
            }

            // Build htmlBalContent
            var htmlBalContent =
                "<p class='alert alert-danger balancePayor'><span class='balancePayorText'>";

            if (isCarrierPaying) {
                htmlBalContent += "Carrier will pay you <b>$" + BalanceAmount.toFixed(2) + "</b>";
            } else {
                htmlBalContent += "You will pay the carrier <b>$" + BalanceAmount.toFixed(2) + "</b>";
            }

            if (BalancePaymentVia !== 'N/A' && $('.Balance_Payment_Mode').is(':visible')) {
                htmlBalContent += " via <b>" + BalancePaymentVia + "</b>";
            }

            if (BalancePaymentTime !== 'N/A' && $('.balance-inputs').is(':visible')) {
                if (BalancePaymentTime == "Immediately") {
                    htmlBalContent += " <b>" + BalancePaymentTime + "</b>";
                } else {
                    htmlBalContent += " within <b>" + BalancePaymentTime + "</b>";
                }
            }

            if (PaymentTerms !== 'N/A' && $('.Payment_Terms').is(':visible')) {
                htmlBalContent += " at <b>" + PaymentTerms + "</b>";
            }

            htmlBalContent += "</span></p>";

            if (BalanceAmount === 0) {
                $('.BalPaymentInfo').empty().hide();
            } else {
                $('.BalPaymentInfo').show();
                $('.BalPaymentInfo').empty().append(htmlBalContent);
                $('#BalPaymentInfoInput').val(htmlBalContent);
            }
        });

        // Select the number fields and apply validation on blur or change
        $('.Booking_Price, .Deposite_Amount, .Price-Pay').on('input', function() {
            var value = parseFloat($(this).val());

            if (value <= 0 || isNaN(value)) {
                $(this).val('');
                alert('Please enter a value greater than 0.');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".Price-Pay, .COD_Amount").on("keydown keyup", function() {
            var PricPay = $('.Price-Pay').val();
            var CodAmount = $('.COD_Amount').val();
            var PaymentVia = $('.COD_Payment_Mode').val();
            var LocationMode = $('.Location_Mode').val();
            var BalancePaymentVia = $('.Balance_Payment_Mode').val();
            var BalancePaymentTime = $('.Bal_Payment_Time').val();
            var BalanceAmount = PricPay - CodAmount;

            $('.Balance-Amount').val(Math.abs(BalanceAmount));
            if (BalanceAmount !== 0) {
                $('.balance-inputs').show();
                $(".balance-inputs select").prop('required', true);
            } else {
                $('.balance-inputs').hide();
                $(".balance-inputs select").prop('required', false);
            }
            // $('.PaymentInfo').html(
            //     "<p class='alert alert-danger codPayor'><span class='codPayorText'>The carrier will receive <b>$" +
            //     CodAmount + "</b></span></p>");
        });
        $('.COD_Payment_Mode').change(function() {
            var PricPay = $('.Price-Pay').val();
            var CodAmount = $('.COD_Amount').val();
            var PaymentVia = $('.COD_Payment_Mode').val();
            var LocationMode = $('.Location_Mode').val();
            var BalancePaymentVia = $('.Balance_Payment_Mode').val();
            var BalancePaymentTime = $('.Bal_Payment_Time').val();
            var BalanceAmount = PricPay - CodAmount;
            // var htmlContent =
            //     "<p class='alert alert-danger codPayor'><span class='codPayorText'>The carrier will receive <b>$" +
            //     CodAmount + "</b> via <b>" + PaymentVia + "</b></span></p>";
            // $('.PaymentInfo').empty().append(htmlContent);
        })
        $('.Location_Mode').change(function() {
            var PricPay = $('.Price-Pay').val();
            var CodAmount = $('.COD_Amount').val();
            var PaymentVia = $('.COD_Payment_Mode').val();
            var LocationMode = $('.Location_Mode').val();
            var BalancePaymentVia = $('.Balance_Payment_Mode').val();
            var BalancePaymentTime = $('.Bal_Payment_Time').val();
            var BalanceAmount = PricPay - CodAmount;
        })

        $('.Balance_Payment_Mode').change(function() {
            var PricPay = $('.Price-Pay').val();
            var CodAmount = $('.COD_Amount').val();
            var PaymentVia = $('.COD_Payment_Mode').val();
            var LocationMode = $('.Location_Mode').val();
            var BalancePaymentVia = $('.Balance_Payment_Mode').val();
            var BalancePaymentTime = $('.Bal_Payment_Time').val();
            var BalanceAmount = PricPay - CodAmount;
        })

        $('.Bal_Payment_Time').change(function() {
            var PricPay = $('.Price-Pay').val();
            var CodAmount = $('.COD_Amount').val();
            var PaymentVia = $('.COD_Payment_Mode').val();
            var LocationMode = $('.Location_Mode').val();
            var BalancePaymentVia = $('.Balance_Payment_Mode').val();
            var BalancePaymentTime = $('.Bal_Payment_Time').val();
            var BalanceAmount = PricPay - CodAmount;
        })

        $('.Payment_Terms').change(function() {
            var PricPay = $('.Price-Pay').val();
            var CodAmount = $('.COD_Amount').val();
            var PaymentVia = $('.COD_Payment_Mode').val();
            var LocationMode = $('.Location_Mode').val();
            var BalancePaymentVia = $('.Balance_Payment_Mode').val();
            var BalancePaymentTime = $('.Bal_Payment_Time').val();
            var PaymentTerms = $('.Payment_Terms').val();
            var BalanceAmount = PricPay - CodAmount;
            var htmlContent;
        })

        // COD pr neche title change krne wala code
        $('.COD_Amount').change(function() {
            var PricPay = parseFloat($('.Price-Pay').val());
            var CodAmount = parseFloat($('.COD_Amount').val());
            var PaymentVia = $('.COD_Payment_Mode').val();
            var LocationMode = $('.Location_Mode').val();
            var BalancePaymentVia = $('.Balance_Payment_Mode').val();
            var BalancePaymentTime = $('.Bal_Payment_Time').val();
            var BalanceAmount = PricPay - CodAmount;
            // var htmlContent;

            // if (PricPay < CodAmount) {
            //     htmlContent =
            //         "<p class='alert alert-danger balancePayor'><span class='balancePayorText'>Carrier will pay you <b>$" +
            //         BalanceAmount + "</b> via <b>" + BalancePaymentVia + "</b> within " +
            //         BalancePaymentTime + "</span></p>";
            //     $('.BalPaymentInfo').html(htmlContent).show();
            // } else if (PricPay > CodAmount) {
            //     htmlContent =
            //         "<p class='alert alert-danger balancePayor'><span class='balancePayorText'>You will pay the carrier <b>$" +
            //         BalanceAmount + "</b> via <b>" + BalancePaymentVia + "</b> within " +
            //         BalancePaymentTime + "</span></p>";
            //     $('.BalPaymentInfo').html(htmlContent).show();
            // } else {
            //     $('.BalPaymentInfo').hide();
            // }
        });
    })


    function addPhoneNumber(buttonId, inputId, containerId, messageId, phoneType) {
        var addButton = document.getElementById(buttonId);
        var phoneNumberInput = document.getElementById(inputId);
        addButton.addEventListener('click', function() {
            var phoneNumberValue = phoneNumberInput.value.trim();
            var phoneNumbersContainer = document.getElementById(containerId);

            if (phoneNumberValue !== "") {
                var toast = document.createElement('div');
                toast.classList.add('toast', 'show');
                toast.innerHTML = `
                <div class="toast-body d-flex justify-content-between align-items-center">
                    <input type="text" class="phone-number" name="${phoneType}[]" value="${phoneNumberValue}" readonly />
                    <button type="button" class="btn-close remove-phone-number"></button>
                </div>
            `;
                phoneNumbersContainer.appendChild(toast);
                phoneNumberInput.value = "";

                // Check if the maximum limit is reached immediately after adding
                if (phoneNumbersContainer.children.length >= 4) {
                    phoneNumberInput.setAttribute('readonly', true); // Make input readonly
                    addButton.setAttribute('disabled', true); // Disable the button
                }

                // Add event listener to remove button
                toast.querySelector('.remove-phone-number').addEventListener('click', function() {
                    toast.remove();

                    // Enable input and button if total phone numbers are less than 4
                    if (phoneNumbersContainer.children.length < 4) {
                        phoneNumberInput.removeAttribute('readonly');
                        addButton.removeAttribute('disabled');
                    }
                });
            } else {
                document.getElementById(messageId).style.display = 'block';
            }
        });
    };
    addPhoneNumber('add-local-phone-number', 'local-phone-input', 'local-phone-numbers-toast-container',
        'invalid-phone-message', 'Local_Phone');
    addPhoneNumber('add-phone-number', 'phone-number-input', 'phone-numbers-toast-container', 'invalid-phone-message-2',
        'Dest_Local_Phone');
</script>
