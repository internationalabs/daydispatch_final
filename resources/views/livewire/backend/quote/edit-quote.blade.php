@extends('layouts.authorizedQuote')
@section('content')
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
</style>
<div class="breadcrumb-area">
    <h1>Dashboard</h1>
    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>
        <li class="item">Edit Qoute &nbsp; (<strong>Order ID: {{ $Lisiting->id }}</strong>)</li>
    </ol>
</div>
<div class="card user-settings-box mb-30">
    <div class="card-body">
        <form class="was-validated" method="POST" action="{{ route('User.Quote.Update') }}"
            enctype="multipart/form-data">
            @csrf
            <input hidden type="text" name="List_ID" value="{{ $Lisiting->id }}">
            <h3><i class='bx bx-file'></i>Edit Quote</h3>
            <h5><b>Refrence ID:</b> #{{ $Lisiting->id }}</h5>
            <div class="row">
                <div class="col-lg-12 shadow-sm p-3">
                    @if (count($Lisiting->vehicles) > 0)
                        <input hidden type="text" name="postType" value="1">
                        <div class="row mt-4">
                            <div class="col-lg-4">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" name="Custom_Listing"
                                        value="1" id="custom_Check">
                                    <label class="form-check-label" for="custom_Check">Custom
                                        Listing</label>
                                </div>
                                <div class="form-group Custom-Date">
                                    <label>Posted Date</label>
                                    <input type="date" class="form-control"
                                        placeholder="Order Booking Price" name="Custom_Date" value="{{ $Lisiting->Posted_Date }}">
                                    <div class="invalid-feedback">
                                        Select Custom Date.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 shadow-sm p-3">
                            <h4 class="text-white py-2 d-flex justify-content-center"
                                style="background: #113771;">
                                <i class="bi bi-hash mr-2"></i>Customer Information
                            </h4>
                                <div class="">
                                <div class="vehcile-information-container-ymm">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Customer Name</label>
                                                <input type="text"
                                                    class="form-control " placeholder="Enter Customer Name"
                                                    name="Customer_Name"
                                                    value="{{ $Lisiting->Customer_Name }}" required>
                                                <div class="invalid-feedback">
                                                    Entered Customer Name.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Customer Email</label>
                                                <input type="email"
                                                    class="form-control"
                                                    placeholder="Enter Customer Email" name="Customer_Email"
                                                    value="{{ $Lisiting->Customer_Email }}" autocomplete="off">
                                                <div class="invalid-feedback">
                                                    Entered Customer Email.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Customer Phone</label>
                                                <input type="text"
                                                    class="form-control models phone-number"
                                                    placeholder="Enter Customer Phone"
                                                    name="Customer_Phone"
                                                    value="{{ $Lisiting->Customer_Phone }}">
                                                <div class="invalid-feedback">
                                                    Entered Customer Phone.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Where did you hear about us ?</label>
                                                <select class="custom-select" name="Hear_about">
                                                    <option value="">Select any option
                                                    </option>
                                                    <option value="Organic">Organic
                                                    </option>
                                                    <option value="Email">Email
                                                    </option>
                                                    <option value="Social (Facebook, Instagram, Youtube, X, Linkedin)">Social (Facebook, Instagram, Youtube, X, Linkedin)
                                                    </option>
                                                    <option value="Reference (with name)">Reference (with name)
                                                    </option>
                                                    <option @selected(!is_null($Lisiting->hear_about_us)) value="{{ $Lisiting->hear_about_us }}">
                                                        {{ $Lisiting->hear_about_us }}
                                                    </option>
                                                </select>
                                                <div class="invalid-feedback">Select Where did you hear about us ?
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 class="text-white py-2 d-flex justify-content-center"
                            style="background: #113771;">
                            <i class="bi bi-hash mr-2"></i>VEHICLE INFORMATION
                        </h4>
                        <div class="justify-content-end">
                            <div class="btn-box text-right">
                                <button type="button" id="add-vehcile" class="btn btn-success"><i class='bx bx-add'></i>
                                    Add Vehicle
                                </button>
                            </div>
                        </div>
                        @foreach ($Lisiting->vehicles as $vehcile)
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
                                </div>
                                <div class="row vin-box">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Vin Number</label>
                                            <input type="text" class="form-control" placeholder="Ex: WBSWL93558P331570"
                                                name="Vin_Number[]" value="{{ $vehcile->Vin_Number }}">
                                            <div class="invalid-feedback">
                                                Entered Vin Number.
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
                                                    Entered Year.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 basic-vehcile-info">
                                            <div class="form-group">
                                                <label>Make *</label>
                                                <input type="text" class="form-control make typeahead" placeholder="Enter Make"
                                                    name="Vehcile_Make[]" value="{{ $vehcile->Vehcile_Make }}" required>
                                                <div class="invalid-feedback">
                                                    Entered Make.
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
                                                    Entered Model.
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
                                                    Entered Year.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 basic-vehcile-info">
                                            <div class="form-group">
                                                <label>Make *</label>
                                                <input type="text" class="form-control makes typeahead" placeholder="Enter Make"
                                                    name="Vehcile_Make[]" value="{{ $vehcile->Vehcile_Make }}" required>
                                                <div class="invalid-feedback">
                                                    Entered Make.
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
                                                    Entered Model.
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
                                                Entered Color.
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
                                                <option value="">Select Vehicle Condition</option>
                                                <option @selected($vehcile->Vehcile_Condition === 'Running') value="Running">Running</option>
                                                <option @selected($vehcile->Vehcile_Condition === 'Not Running') value="Not Running">Not Running</option>
                                            </select>
                                            <div class="invalid-feedback">Select Vehicle Condition</div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Trailer Typesss</label>
                                            <select class="custom-select" name="Trailer_Type[]" required>
                                                <option value="">Select Trailer</option>
                                                <option value="Open"
                                                    {{ $vehcile->Trailer_Type === 'Open' ? 'selected' : '' }}>Open
                                                </option>
                                                <option value="Enclosed"
                                                    {{ $vehcile->Trailer_Type === 'Enclosed' ? 'selected' : '' }}>
                                                    Enclosed
                                                </option>
                                                <option value="Drive Away"
                                                    {{ $vehcile->Trailer_Type === 'Drive Away' ? 'selected' : '' }}>
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
                        <h4 class="text-white py-2 d-flex justify-content-center"
                            style="background: #113771;">
                            <i class="bi bi-hash mr-2"></i>HEAVY EQUIPMENTS INFORMATION
                        </h4>
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
                                                Entered Year.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Make *</label>
                                            <input type="text" class="form-control" placeholder="Enter Make"
                                                name="Equipment_Make[]" value="{{ $vehcile->Equipment_Make }}" required>
                                            <div class="invalid-feedback">
                                                Entered Make.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Model *</label>
                                            <input type="text" class="form-control" placeholder="Enter Model"
                                                name="Equipment_Model[]" value="{{ $vehcile->Equipment_Model }}" required>
                                            <div class="invalid-feedback">
                                                Entered Model.
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
                                                Entered Length.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Width *</label>
                                            <input type="number" class="form-control" placeholder="Enter Width" min="0"
                                                name="Equip_Width[]" value="{{ $vehcile->Equip_Width }}">
                                            <div class="invalid-feedback">
                                                Entered Width.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Height *</label>
                                            <input type="number" class="form-control" placeholder="Enter Height" min="0"
                                                name="Equip_Height[]" value="{{ $vehcile->Equip_Height }}">
                                            <div class="invalid-feedback">
                                                Entered Height.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Weight *</label>
                                            <input type="number" class="form-control" placeholder="Enter Weight" min="0"
                                                name="Equip_Weight[]" value="{{ $vehcile->Equip_Weight }}">
                                            <div class="invalid-feedback">
                                                Entered Weight.
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
                        <h4 class="text-white py-2 d-flex justify-content-center"
                            style="background: #113771;">
                            <i class="bi bi-hash mr-2"></i>DRY VANS INFORMATION
                        </h4>
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
                                                Entered Weight.
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
                <div class="col-lg-12 shadow-sm p-3">
                    <h4 class="text-white py-2 d-flex justify-content-center"
                            style="background: #113771;">
                            <i class="bi bi-hash mr-2"></i>VEHICLE PICKUP INFORMATION
                        </h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Pickup Date</label>
                                <input type="date" class="form-control pick-date" placeholder="Pickup Date" id="pdatate1"
                                    name="Pickup_Date" value="{{ date('Y-m-d', strtotime($Lisiting->pickup_delivery_info->Pickup_Date)) }}" required>
                                <div class="invalid-feedback">
                                    Entered Pickup Date.
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
                                            name="PickUp_mode" value="On" checked @checked($Lisiting->pickup_delivery_info->Pickup_Date_mode === 'On')>
                                        <label class="custom-control-label" for="customControlValidation7777">On</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="custom-control custom-radio mb-3">
                                        <input type="radio" class="custom-control-input" id="customControlValidation888"
                                            name="Delivery_mode" value="After" @checked($Lisiting->pickup_delivery_info->Delivery_Date_mode === 'After')>
                                        <label class="custom-control-label" for="customControlValidation888">After</label>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-2">
                                    <div class="custom-control custom-radio mb-3">
                                        <input type="radio" class="custom-control-input" id="customControlValidation888"
                                            name="PickUp_mode" value="After" @checked($Lisiting->pickup_delivery_info->Pickup_Date_mode === 'After')>
                                        <label class="custom-control-label" for="customControlValidation888">After</label>
                                    </div>
                                </div> -->
                                
                                <!-- <div class="col-lg-2">
                                    <div class="custom-control custom-radio mb-3">
                                        <input type="radio" class="custom-control-input" id="customControlValidation8888"
                                            name="PickUp_mode" value="ASAP" @checked($Lisiting->pickup_delivery_info->Pickup_Date_mode === 'ASAP')>
                                        <label class="custom-control-label" for="customControlValidation8888">ASAP</label>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            @if (!empty($Lisiting->pickup_delivery_info->Delivery_Date))
                                <div class="form-group">
                                    <label>Delivery Date</label>
                                    <input type="date" class="form-control deliver-date" placeholder="Delivery Date"
                                        name="Delivery_Date"
                                        value="{{ date('Y-m-d', strtotime($Lisiting->pickup_delivery_info->Delivery_Date)) }}">
                                    <div class="invalid-feedback">
                                        Entered Delivery Date.
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
                                            name="Delivery_mode" value="On" checked @checked($Lisiting->pickup_delivery_info->Delivery_Date_mode === 'On')>
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
                                
                                <!-- <div class="col-lg-2">
                                    <div class="custom-control custom-radio mb-3">
                                        <input type="radio" class="custom-control-input" id="customControlValidation88788"
                                            name="Delivery_mode" value="ASAP" @checked($Lisiting->pickup_delivery_info->Delivery_Date_mode === 'ASAP')>
                                        <label class="custom-control-label" for="customControlValidation88788">ASAP</label>
                                    </div>
                                </div> -->
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
                                    Entered Pickup From.
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
                                    Entered Pickup To.
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
                                    Entered Delivery From.
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
                                    Entered Delivery To.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 shadow-sm p-3">
                    <h4 class="text-white py-2 d-flex justify-content-center"
                        style="background: #113771;">
                        <i class="bi bi-hash mr-2"></i>ORIGIN LOCATION
                    </h4>
                    <!-- <input hidden type="text" name="List_ID" value=""> -->
                    @if (isset($currentRouteMatchesPattern))
                        <input hidden type="text" name="isExpire" value="{{ $currentRouteMatchesPattern }}">
                    @endif
                    {{-- <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Terminal, Dealer, Auction</label>
                                <select class="custom-select Orig" name="Orign_Location" id="Orign_Location_Check">
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
                                    Entered UserName.
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
                                    Entered Email Address.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 orig-basic">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" class="form-control phone-number" placeholder="Phone Number"
                                    name="Local_Phone"
                                    value="{{ !is_null($Lisiting->listing_origin_location) ? $Lisiting->listing_origin_location->Local_Phone : '' }}">
                                <div class="invalid-feedback">
                                    Entered Local Phone.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 orig-location">
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
                                    Entered UserName.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 orig-location-business">
                            <div class="form-group">
                                <label>Business Phone Number</label>
                                <input type="text" class="form-control phone-number" placeholder="Business Phone Number"
                                    name="Business_Phone" value="{{ old('Business_Phone') }}">
                                <div class="invalid-feedback">
                                    Entered Business Phone Number.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 orig-location-business">
                            <div class="form-group">
                                <label>Business Name</label>
                                <input type="text" class="form-control" placeholder="Business Name" name="Business_Location"
                                    value="{{ old('Business_Location') }}" value="">
                                <div class="invalid-feedback">
                                    Entered Business Name.
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
                                    Entered UserName.
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
                                    Entered Auction Phone.
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
                                    Entered Stock Number.
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
                                    Entered Auction Name.
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
                                    Entered Auction Phone.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 orig-dealership">
                            <div class="form-group">
                                <label>Buyer/Lot/Stock Number</label>
                                <input type="text" class="form-control" placeholder="Buyer/Lot/Stock Number"
                                    name="Dealer_Stock_Number"
                                    value="{{ !is_null($Lisiting->listing_origin_location) ? $Lisiting->listing_origin_location->Stock_Number : '' }}">
                                <div class="invalid-feedback">
                                    Entered Stock Number.
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Terminal, Dealer, Auction</label>
                                <select class="custom-select" name="Orign_Location " >
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
                                    
                                </select>
                                <div class="invalid-feedback">
                                    Select Any Type.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control"
                                    name="Dest_User_Name"
                                    placeholder="Enter User Name"
                                    value="{{ old('Dest_User_Name') }}"
                                    autocomplete="off">
                                <div class="invalid-feedback">
                                    Enter UserName.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" class="form-control"
                                    name="Dest_User_Email"
                                    placeholder="Enter Email Address"
                                    value="{{ old('Dest_User_Email') }}"
                                    autocomplete="off">
                                <div class="invalid-feedback">
                                    Enter Email Address.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Buyer Number</label>
                                <input type="text" class="form-control"
                                    placeholder="Buyer Number"
                                    name="Dest_Stock_Number" value="">
                                <div class="invalid-feedback">
                                    Enter Stock Number.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="form-group">
                                <label>Phone Numbers</label>
                                <div class="d-flex">
                                    <!-- Initial Phone Number Input -->
                                    <input id="phone-number-input" class="form-control phone-number" type="text" placeholder="Phone Number" name="Dest_Local_Phone[]" value="{{ old('Dest_Local_Phone') }}">
                                    <button type="button" class="btn btn-success ms-2" id="add-phone-number">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <div class="invalid-feedback" id="invalid-phone-message-2">
                                    Enter Phone.
                                </div>
                                <!-- Toast container for added phone numbers -->
                                <div id="phone-numbers-toast-container" class="mt-3"></div>
                            </div>
                        </div>
                        <div class="toast" style="display: none;">
                            <div class="toast-body d-flex justify-content-between align-items-center">
                                <span class="phone-number"></span>
                                <button type="button" class="btn-close remove-phone-number"></button>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="col-lg-6 shadow-sm p-3">
                    <h4 class="text-white py-2 d-flex justify-content-center"
                        style="background: #113771;">
                        <i class="bi bi-hash mr-2"></i>DESTINATION LOCATION
                    </h4>
                    {{-- <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Terminal, Dealer, Auction</label>
                                <select class="custom-select Dest" name="Destination_Location" id="Destination_Location_Check">
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
                                    Entered UserName.
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
                                    Entered Email Address.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 dest-basic">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" class="form-control phone-number" placeholder="Phone Number"
                                    name="Dest_Local_Phone"
                                    value="{{ !is_null($Lisiting->listing_destination_locations) ? $Lisiting->listing_destination_locations->Dest_Local_Phone : '' }}">
                                <div class="invalid-feedback">
                                    Entered Local Phone.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 dest-location">
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
                                    Entered Business Phone Number.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 dest-location-business">
                            <div class="form-group">
                                <label>Business Name</label>
                                <input type="text" class="form-control" placeholder="Business Name"
                                    name="Dest_Business_Location" value="{{ old('Dest_Business_Location') }}">
                                <div class="invalid-feedback">
                                    Entered Business Name.
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
                                    Entered UserName.
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
                                    Entered Auction Phone.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 dest-auction">
                            <div class="form-group">
                                <label>Buyer/Lot/Stock Number</label>
                                <input type="text" class="form-control" placeholder="Buyer/Lot/Stock Number"
                                    name="Dest_Stock_Number"
                                    value="{{ !is_null($Lisiting->listing_destination_locations) ? $Lisiting->listing_destination_locations->Dest_Stock_Number : '' }}">
                                <div class="invalid-feedback">
                                    Entered Stock Number.
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
                                    Entered Auction Name.
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
                                    Entered Auction Phone.
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
                                    Entered Stock Number.
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
                                    Entered Port Phone.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 dest-port">
                            <div class="form-group">
                                <label>Terminal</label>
                                <input type="text" class="form-control" placeholder="Terminal" name="Port_Dest_Stock_Number"
                                    value="{{ !is_null($Lisiting->listing_destination_locations) ? $Lisiting->listing_destination_locations->Dest_Stock_Number : '' }}">
                                <div class="invalid-feedback">
                                    Entered Terminal.
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Terminal, Dealer, Auction</label>
                                <select class="custom-select" name="Orign_Location " >
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
                                    
                                </select>
                                <div class="invalid-feedback">
                                    Select Any Type.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control"
                                    name="Dest_User_Name"
                                    placeholder="Enter User Name"
                                    value="{{ old('Dest_User_Name') }}"
                                    autocomplete="off">
                                <div class="invalid-feedback">
                                    Enter UserName.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" class="form-control"
                                    name="Dest_User_Email"
                                    placeholder="Enter Email Address"
                                    value="{{ old('Dest_User_Email') }}"
                                    autocomplete="off">
                                <div class="invalid-feedback">
                                    Enter Email Address.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Buyer Number</label>
                                <input type="text" class="form-control"
                                    placeholder="Buyer Number"
                                    name="Dest_Stock_Number" value="">
                                <div class="invalid-feedback">
                                    Enter Stock Number.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="form-group">
                                <label>Phone Numbers</label>
                                <div class="d-flex">
                                    <!-- Initial Phone Number Input -->
                                    <input id="phone-number-input" class="form-control phone-number" type="text" placeholder="Phone Number" name="Dest_Local_Phone[]" value="{{ old('Dest_Local_Phone') }}">
                                    <button type="button" class="btn btn-success ms-2" id="add-phone-number">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <div class="invalid-feedback" id="invalid-phone-message-2">
                                    Enter Phone.
                                </div>
                                <!-- Toast container for added phone numbers -->
                                <div id="phone-numbers-toast-container" class="mt-3"></div>
                            </div>
                        </div>
                        <div class="toast" style="display: none;">
                            <div class="toast-body d-flex justify-content-between align-items-center">
                                <span class="phone-number"></span>
                                <button type="button" class="btn-close remove-phone-number"></button>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 shadow-sm p-3">
                    {{-- <h4 class="text-white py-2 d-flex justify-content-center"
                        style="background: #113771;">
                        <i class="bi bi-hash mr-2"></i>ORIGIN ADDRESS
                    </h4> --}}
                    {{-- <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="Origin_Address" placeholder="Enter Origin"
                                    value="{{ !is_null($Lisiting->routes) ? $Lisiting->routes->Origin_Address : '' }}"
                                    autocomplete="off">
                                <div class="invalid-feedback">
                                    Entered Origin.
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
                                    Entered Origin 2.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Zip Code</label>
                                <input type="text" class="form-control Origin_ZipCode typeahead" name="Origin_ZipCode"
                                    placeholder="Enter ZipCode"
                                    value="{{ !is_null($Lisiting->routes) ? $Lisiting->routes->Origin_ZipCode : '' }}" required>
                                <div class="invalid-feedback">
                                    Entered ZipCode.
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row p-3">

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control"
                                    name="Origin_Address" placeholder="Enter Origin"
                                    value="" autocomplete="off">
                                <div class="invalid-feedback">
                                    Entered Origin.
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Address 2</label>
                                <input type="text" class="form-control"
                                    name="Origin_Address_II" placeholder="Enter Origin 2"
                                    value="" autocomplete="off">
                                <div class="invalid-feedback">
                                    Entered Origin 2.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Pickup Location *</label>
                                <input type="text"
                                    class="form-control Origin_ZipCode typeahead"
                                    name="Origin_ZipCode" placeholder="Enter ZipCode"
                                    value="{{ old('Origin_ZipCode') }}" required>
                                <div class="invalid-feedback">
                                    Enter Pickup Location.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>State</label>
                                <input type="text" class="form-control Orig_State"
                                    name="Origin_State" placeholder="State">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" class="form-control Orig_City"
                                    name="Origin_City" placeholder="City">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Zip Code</label>
                                <input type="text"
                                    class="form-control heavy_Origin_ZipCode typeahead"
                                    name="Origin_ZipCode" placeholder="Enter ZipCode"
                                    value="" required>
                                <div class="invalid-feedback">
                                    Entered ZipCode.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6 shadow-sm p-3">
                    {{-- <h4 class="text-white py-2 d-flex justify-content-center"
                        style="background: #113771;">
                        <i class="bi bi-hash mr-2"></i>DESTINATION ADDRESS
                    </h4> --}}
                    {{-- <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="Destination_Address"
                                    placeholder="Enter Destination"
                                    value="{{ !is_null($Lisiting->routes) ? $Lisiting->routes->Destination_Address : '' }}"
                                    autocomplete="off">
                                <div class="invalid-feedback">
                                    Entered Destination.
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
                                    Entered Destination 2.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Zip Code</label>
                                <input type="text" class="form-control Dest_ZipCode typeahead" name="Dest_ZipCode"
                                    placeholder="Enter ZipCode"
                                    value="{{ !is_null($Lisiting->routes) ? $Lisiting->routes->Dest_ZipCode : '' }}" required>
                                <div class="invalid-feedback">
                                    Entered ZipCode.
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row p-3">

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control"
                                    name="Destination_Address"
                                    placeholder="Enter Destination" value=""
                                    autocomplete="off">
                                <div class="invalid-feedback">
                                    Entered Destination.
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Address 2</label>
                                <input type="text" class="form-control"
                                    name="Destination_Address_II"
                                    placeholder="Enter Destination 2" value=""
                                    autocomplete="off">
                                <div class="invalid-feedback">
                                    Entered Destination 2.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Delivery Location *</label>
                                <input type="text"
                                    class="form-control Dest_ZipCode typeahead"
                                    name="Dest_ZipCode" placeholder="Enter ZipCode"
                                    value="{{ old('Dest_ZipCode') }}" required>
                                <div class="invalid-feedback">
                                    Enter Delivery Location.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>State</label>
                                <input type="text" class="form-control Dest_State"
                                    name="Dest_State" placeholder="State">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" class="form-control Dest_City"
                                    name="Dest_City" placeholder="City">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Zip Code</label>
                                <input type="text"
                                    class="form-control heavy_Dest_ZipCode typeahead"
                                    name="Dest_ZipCode" placeholder="Enter ZipCode"
                                    value="" required>
                                <div class="invalid-feedback">
                                    Entered ZipCode.
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
                <div class="col-lg-12 shadow-sm p-3">
                    <h4 class="text-white py-2 d-flex justify-content-center"
                        style="background: #113771;">
                        <i class="bi bi-hash mr-2"></i>Carrier / Payment
                    </h4>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Book Price</label>
                                <input type="number" class="form-control" placeholder="Order Booking Price"
                                    name="Booking_Price"
                                    id="Booking_Price" required
                                    value="{{ (int) Str::replace(['$ ', ','], '', $Lisiting->paymentinfo->Order_Booking_Price) }}">
                                <div class="invalid-feedback">
                                    Entered Booking Price.
                                </div>
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="deposite_Check"
                                    @checked(!is_null($Lisiting->paymentinfo->Deposite_Amount))>
                                <label class="form-check-label" for="deposite_Check">Deposit Amount?</label>
                            </div>

                        </div>
                        <div class="col-lg-3 deposite-box">
                            <div class="form-group">
                                <label>Deposit Amount *</label>
                                <input type="number" class="form-control" placeholder="Deposite Amount" name="Deposite_Amount" id="Deposite_Amount"
                                    value="{{ (int) Str::replace(['$ ', ','], '', $Lisiting->paymentinfo->Deposite_Amount) }}">
                                <div class="invalid-feedback">
                                    Entered Deposit Amount.
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
                                    Entered Price Pay Amount.
                                </div>
                            </div>
                            <div class="row">
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
                                    Entered COD/COP Amount.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Balance Amount</label>
                                <input readonly type="number" class="form-control Balance-Amount" placeholder="Balanced Amount"
                                    name="Bal_Amount"
                                    id="Bal_Amount"
                                    value="{{ (int) Str::replace(['$ ', ','], '', $Lisiting->paymentinfo->Balance_Amount) }}"
                                    required>
                                <div class="invalid-feedback">
                                    Entered Balance Amount.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 cod-inputs">
                            <div class="form-group">
                                <label>COD/COP Payment Method *</label>
                                <select class="custom-select" name="COD_Payment_Mode">
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
                                <select class="custom-select" name="Location_Mode">
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
                                <select class="custom-select" name="Balance_Payment_Mode">
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
                                <select class="custom-select" name="Bal_Payment_Time">
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
                                <select class="custom-select" name="Payment_Terms">
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
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Additional Payment Information</label>
                            <textarea cols="30" rows="5" name="Desc_For_Vehcile" placeholder="Write something..."
                                class="form-control">{{ !is_null($Lisiting->additional_info) ? $Lisiting->additional_info->Vehcile_Desc : '' }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="PaymentInfo col-sm-12">
                    </div>
                    <div class="BalPaymentInfo col-sm-12">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 shadow-sm p-3">
                    <h4 class="text-white py-2 d-flex justify-content-center"
                    style="background: #113771;">
                    <i class="bi bi-hash mr-2"></i>Additional Information
                </h4>
                    <div class="row">
                        <div class="col-lg-4 basic-vehcile-info">
                            <div class="form-group">
                                <label>Order ID</label>
                                <input type="text" class="form-control" placeholder="Dispatch ID" name="Order ID"
                                    value="{{ $Lisiting->Ref_ID }}" required>
                                <div class="invalid-feedback">
                                    Entered Order ID.
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4">
                            <label>Upload Any Vehicle Images</label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"
                                        name="Vehcile_Images[]" id="image-upload-first"
                                        accept="image/*" multiple>
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- <div id="image-preview-first" class="displayimages row"></div> -->
                        <div class="col-lg-4">
                        @foreach($Lisiting->attachments as $image)
                                <img src="{{ asset($image->Image_Name) }}" alt="Existing Image">
                                <!-- Optionally, add a delete button/icon here if needed -->
                        @endforeach
                        </div>
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
                </div>
            </div>
            @if($Lisiting->Listing_Status != 'Book Order')
            <div class="text-center">
                <h4 class="text-white py-2 d-flex justify-content-center"
                style="background: #113771;">
                <i class="bi bi-hash mr-2"></i>Select Option
            </h4>
                {{-- <label for="sidebarOptionsDropdown">Select Option:</label> --}}
                <select id="sidebarOptionsDropdown" class="custom-select" name="selectedName">
                    <option value="">Select Option</option>
                    @foreach($sidebarOptions as $option)
                        <option value="{{ $option->name }}" {{ $option->name == $Lisiting->Listing_Status ? 'selected' : '' }}>{{ $option->name }}</option>
                    @endforeach
                </select>
            </div>
            @endif
            <div class="btn-box text-center">
                <button type="submit" class="submit-btn w-100"><i class='bx bx-save'></i>
                    Update Quote
                </button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    function updateTextareaAndLabel(){
    let contractDropdown = document.getElementById('contractDropdown');
    let selectedContractValue = contractDropdown.value;
    let selectedContractName = contractDropdown.options[contractDropdown.selectedIndex].getAttribute('data-contract-name');
    document.querySelector('.showcontent').value = selectedContractValue;
    document.getElementById('textareaLabel').innerText = 'Contract: ' + selectedContractName;
    }
</script>
<script>
    $(document).ready(function() {
        $('.Price-Pay').on('keyup keydown', function(event) {
            var eventType = event.type;
            var price = $(this).val();
            var keyCode = event.keyCode;
            console.log('Event type:', eventType);
            console.log('Price entered:', price);
            console.log('Key code pressed:', keyCode);
        });
        $('.COD_Amount').on('keyup keydown', function(event) {
            $('.PaymentInfo').html(
                "<p class='alert alert-danger codPayor'><span class='codPayorText'>The carrier will receive <b>$" +
                $(this).val() + "</b></span></p>");
            if ($('.COD_Amount').val() === $('.Price-Pay').val()) {
                $('.BalPaymentInfo').hide();
            }
            else{
                $('.BalPaymentInfo').show();
            }
        });
        $('.custom-select[name="COD_Payment_Mode"]').on('change', function() {
            updatePaymentInfo();
        });
        $('.custom-select[name="Location_Mode"]').on('change', function() {
            updatePaymentInfo();
        });
        $('.custom-select[name="Balance_Payment_Mode"]').on('change', function() {
            updateBalPaymentInfo();
        });
        $('.custom-select[name="Bal_Payment_Time"]').on('change', function() {
            updateBalPaymentInfo();
        });
        $('.custom-select[name="Payment_Terms"]').on('change', function() {
            console.log('oksss2');
            updateBalPaymentInfo();
        });
        function updatePaymentInfo() {
            var codAmount = $('.COD_Amount').val();
            var codPaymentMode = $('.custom-select[name="COD_Payment_Mode"]').val();
            var locationMode = $('.custom-select[name="Location_Mode"]').val();
            var htmlContent = '';
            if (codAmount && codPaymentMode && locationMode) {
                htmlContent =
                    "<p class='alert alert-danger codPayor'><span class='codPayorText'>The carrier will receive <b>$" +
                    codAmount + "</b> via <b>" + codPaymentMode + "</b> at <b>" + locationMode +
                    "</b></span></p>";
            }
            $('.PaymentInfo').empty().append(htmlContent);
        }
        function updateBalPaymentInfo() {
            var balanceAmount = $('.Balance-Amount').val();
            var balancePaymentMode = $('.custom-select[name="Balance_Payment_Mode"]').val();
            var balPaymentTime = $('.custom-select[name="Bal_Payment_Time"]').val();
            var paymentTerms = $('.custom-select[name="Payment_Terms"]').val();
            var codAmount = $('.COD_Amount').val();
            var Price_Pay = $('.Price-Pay').val();
            var htmlContent = '';
            if (balanceAmount && balancePaymentMode && balPaymentTime && Price_Pay) {
                if (balPaymentTime === "Immediately") {
                    if ($('.COD_Amount').val() === $('.Price-Pay').val()) {
                        console.log('yes equal');
                    }
                    htmlContent =
                        "<p class='alert alert-danger balancePayor'><span class='balancePayorText'>Carrier will pay you <b>$" +
                        balanceAmount + "</b> via <b>" + balancePaymentMode + "</b> " + balPaymentTime +
                        "</span> " + paymentTerms + " </p>";
                } else {
                    htmlContent =
                        "<p class='alert alert-danger balancePayor'><span class='balancePayorText'>You will pay carrier <b>$" +
                        balanceAmount + "</b> via <b>" + balancePaymentMode + "</b> within " + balPaymentTime +
                        "</span> " + paymentTerms + " </p>";
                }
            }
            $('.BalPaymentInfo').empty().append(htmlContent);
        }
        $('.custom-select[name="COD_Payment_Mode"]').change();
        $('.custom-select[name="Location_Mode"]').change();
        $('.custom-select[name="Balance_Payment_Mode"]').change();
        $('.custom-select[name="Bal_Payment_Time"]').change();
        $('.COD_Amount').change(function() {
            var PricPay = parseFloat($('.Price-Pay').val());
            var CodAmount = parseFloat($('.COD_Amount').val());
            var PaymentVia = $('.COD_Payment_Mode').val();
            var LocationMode = $('.custom-select[name="Location_Mode"]').val();
            var BalancePaymentVia = $('.custom-select[name="Balance_Payment_Mode"]').val();
            var BalancePaymentTime = $('.custom-select[name="Bal_Payment_Time"]').val();
            var BalanceAmount = Math.max(0, PricPay - CodAmount);
            var htmlContent;
            if (PricPay < CodAmount) {
                htmlContent =
                    "<p class='alert alert-danger balancePayor'><span class='balancePayorText'>Carrier will pay you <b>$" +
                    BalanceAmount + "</b> via <b>" + BalancePaymentVia + "</b> within " +
                    BalancePaymentTime + "</span></p>";
                $('.BalPaymentInfo').html(htmlContent).show();
            } else if (PricPay > CodAmount) {
                htmlContent =
                    "<p class='alert alert-danger balancePayor'><span class='balancePayorText'>You will pay the carrier <b>$" +
                    BalanceAmount + "</b> via <b>" + BalancePaymentVia + "</b> within " +
                    BalancePaymentTime + "</span></p>";
                $('.BalPaymentInfo').html(htmlContent).show();
            } else {
                $('.BalPaymentInfo').hide();
            }
        });
        console.log($('#Orign_Location_Check').val() + 'show')
        $('.orig-auction-input-field').hide();
        $('.dest-auction-input-field').hide();
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
        $(document).ready(function() {
            $('.custom-control-input').change(function() {
                const mod = $(this).val();
                const vehicleInfo = $(this).closest('.vehcile-information');
                if (mod === 'VIN') {
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
                    vehicleInfo.find('.basic-vehcile-info select').hide();
                }
                if (mod === 'YMM') {
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
            $('.custom-control-input:checked').trigger('change');
        });
        $('.Custom-Date').hide();
        $('#custom_Check').change(function() {
            checkBox = document.getElementById('custom_Check');
            if (checkBox.checked) {
                $('.Custom-Date').show();
                $(".Custom-Date input").prop('required', true);
            } else {
                $('.Custom-Date').hide();
                $(".Custom-Date input").prop('required', false);
            }
        });
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

            $('.cod-inputs').hide();
        } else if ($('.Balance-Amount').val() <= 0) {
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
                $('.balance-inputs').hide();
                $(".balance-inputs select").prop('required', false);
            } else {
                $('.balance-inputs').show();
                $(".balance-inputs select").prop('required', true);
            }
        });
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
        const imageInput1 = document.getElementById('image-upload-first');
        const imagePreview1 = document.getElementById('image-preview-first');
        imageInput1.addEventListener('change', () => {
            const files = imageInput1.files;
            if (files.length === 0) {
                alert('Please select at least one image.');
                return;
            }
            imagePreview1.innerHTML = '';
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const colDiv = document.createElement('div');
                colDiv.classList.add('col-md-3');
                const imgWrapper = document.createElement('div');
                imgWrapper.classList.add('image-wrapper');
                const img = document.createElement('img');
                img.classList.add('preview-image');
                img.src = URL.createObjectURL(file);
                img.alt = file.name;
                const deleteIcon = document.createElement('span');
                deleteIcon.classList.add('delete-icon');
                deleteIcon.innerHTML = '&times;';
                deleteIcon.addEventListener('click', () => {
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
    document.addEventListener('DOMContentLoaded', function () {
        const bookingPriceInput = document.getElementById('Booking_Price');
        const depositAmountInput = document.getElementById('Deposite_Amount');
        const balanceAmountInput = document.getElementById('Bal_Amount');
        function updateBalanceAmount() {
            const bookingPrice = parseFloat(bookingPriceInput.value) || 0;
            const depositAmount = parseFloat(depositAmountInput.value) || 0;
            const balanceAmount = bookingPrice - depositAmount;
            balanceAmountInput.value = balanceAmount.toFixed(2);
        }
        bookingPriceInput.addEventListener('input', updateBalanceAmount);
        depositAmountInput.addEventListener('input', updateBalanceAmount);
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        var min_vehcile = 1;
        var max_vehcile = 25;
        $("#add-vehcile").click(function() {
            if (min_vehcile <= max_vehcile) {
                var new_vehcile =
                    '<div id="reform' + min_vehcile + '">' +
                    '<div class="vehcile-information">' +
                    '<div class="row">' +
                    '<div class="col-lg-4">' +
                    '<div class="custom-control custom-radio">' +
                    '<input type="radio" class="custom-control-input" id="customControlValidation5_' +
                    min_vehcile +
                    '" name="radio_stacked[' +
                    min_vehcile +
                    ']" value="YMM" checked>' +
                    '<label class="custom-control-label" for="customControlValidation5_' +
                    min_vehcile +
                    '">Year, Make, and Model</label>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-4">' +
                    '<div class="custom-control custom-radio mb-3">' +
                    '<input type="radio" class="custom-control-input vin-input" id="customControlValidation4_' +
                    min_vehcile +
                    '" name="radio_stacked[' +
                    min_vehcile +
                    ']" value="VIN">' +
                    '<label class="custom-control-label" for="customControlValidation4_' +
                    min_vehcile +
                    '">Vin Number</label>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-4 justify-content-end">' +
                    '<div class="btn-box text-right">' +
                    '<button type="button" id="" class="remove-vehcile btn btn-danger"><i class="bx bx-trash"></i>Remove Vehicle</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row vin-box vin-box-dynimic" style="display:none;">' +
                    '<div class="col-lg-12">' +
                    '<div class="form-group">' +
                    '<label>Vin Number</label>' +
                    '<input type="text" class="form-control vin-input" placeholder="Vin #" name="Vin_Number[]" value="">' +
                    '<div class="invalid-feedback">Entered Vin Number.</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="vehcile-information-container-vins" style="display:none;">' +
                    '<div class="row">' +
                    '<div class="col-lg-4  new-basic-info">' +
                    '<div class="form-group">' +
                    '<label>Year *</label>' +
                    '<input type="text" class="form-control year-vin-vehcile" placeholder="Ex: 2022" name="Vehcile_Year[]"  value="" disabled>' +
                    '<div class="invalid-feedback">Entered Year.</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-4  new-basic-info">' +
                    '<div class="form-group">' +
                    '<label>Make *</label>' +
                    '<input type="text" class="form-control  typeahead make-vin-vehcile" placeholder="Enter Make" name="Vehcile_Make[]" disabled value="">' +
                    '<div class="invalid-feedback">Entered Make.</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-4  new-basic-info">' +
                    '<div class="form-group">' +
                    '<label>Model *</label>' +
                    '<input type="text" class="form-control  typeahead model-vin-vehcile" placeholder="Enter Model" name="Vehcile_Model[]" disabled value="">' +
                    '<div class="invalid-feedback">Entered Model.</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="vehcile-information-container-ymms">' +
                    '<div class="row">' +
                    '<div class="col-lg-4  new-basic-info">' +
                    '<div class="form-group">' +
                    // '<label>Year_ymm *</label>' +
                    '<label>Year *</label>' +
                    '<input type="text" class="form-control year-vehcile" placeholder="Ex: 2022" name="Vehcile_Year[]" value="">' +
                    // '<input type="text" class="form-control year-vehcile" placeholder="Ex: 2022" name="Vehcile_Year_ymm[]" value="">' +
                    '<div class="invalid-feedback">Entered Year.</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-4  new-basic-info">' +
                    '<div class="form-group">' +
                    // '<label>Make *</label>' +
                    // '<label>Make_ymm *</label>' +
                    '<label>Make *</label>' +
                    '<input type="text" class="form-control makes typeahead make-vehcile" placeholder="Enter Make" name="Vehcile_Make[]" value="">' +
                    // '<input type="text" class="form-control makes typeahead make-vehcile" placeholder="Enter Make" name="Vehcile_Make_ymm[]" value="">' +
                    '<div class="invalid-feedback">Entered Make.</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-4  new-basic-info">' +
                    '<div class="form-group">' +
                    // '<label>Model_ymm *</label>' +
                    '<label>Modem *</label>' +
                    '<input type="text" class="form-control models typeahead model-vehcile" placeholder="Enter Model" name="Vehcile_Model[]" value="">' +
                    // '<input type="text" class="form-control models typeahead model-vehcile" placeholder="Enter Model" name="Vehcile_Model_ymm[]" value="">' +
                    '<div class="invalid-feedback">Entered Model.</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-lg-3">' +
                    '<div class="form-group">' +
                    '<label>Color</label>' +
                    '<input type="text" class="form-control" placeholder="Enter Color" name="Vehcile_Color[]" value="">' +
                    '<div class="invalid-feedback">Entered Color.</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-3">' +
                    '<div class="form-group">' +
                    '<label>Vehicle Type</label>' +
                    '<select class="custom-select" name="Vehcile_Type[]" required>' +
                    '<option selected="" value="">Select Vehicle Type</option>' +
                    '<option value="Car">Car</option>' +
                    '<option value="SUV">SUV</option>' +
                    '<option value="Pickup">Pickup</option>' +
                    '<option value="Van">Van</option>' +
                    '<option disabled="">————————————</option>' +
                    '<option value="motorcycle">Motorcycle</option>' +
                    '<option value="atv">ATV</option>' +
                    '<option disabled="">————————————</option>' +
                    '<option value="Mini Van">Mini Van</option>' +
                    '<option value="Cargo Van">Cargo Van</option>' +
                    '<option value="Passenger Van">Passenger Van</option>' +
                    '<option disabled="">————————————</option>' +
                    '<option value="Boat">Boat</option>' +
                    '<option value="Large Yacht">Large Yacht</option>' +
                    '<option value="RVs">RVs</option>' +
                    '<option value="Travel Trailer">Travel Trailer</option>' +
                    '<option disabled="">————————————</option>' +
                    '<option value="other_vehicle">Other Vehicle</option>' +
                    '<option value="other_motorcycle">Other Motorcycle</option>' +
                    '</select>' +
                    '<div class="invalid-feedback">Select Vehicle Type</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-3">' +
                    '<div class="form-group">' +
                    '<label>Vehcile Condition</label>' +
                    '<select class="custom-select" name="Vehcile_Condition[]" required>' +
                    '<option value="Running">Running</option>' +
                    '<option value="Not Running">Not Running</option>' +
                    '</select>' +
                    '<div class="invalid-feedback">Select Vehcile Condition</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-3">' +
                    '<div class="form-group">' +
                    '<label>Trailer Type</label>' +
                    '<select class="custom-select" name="Trailer_Type[]" required>' +
                    '<option value="Open">Open</option>' +
                    '<option value="Enclosed">Enclosed</option>' +
                    '<option value="Drive Away">Drive Away</option>' +
                    '</select>' +
                    '<div class="invalid-feedback">Select Any Trailer Type</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

                $("#vehciles").append(new_vehcile);
                min_vehcile++;
                $('#vehciles').on('keyup', '#reform' + (min_vehcile - 1) + ' .vin-box input',
                    function() {
                        const Vin_Number = $(this).val();
                        const currentVinInput = $(
                            this);
                        $.ajax({
                            url: '{{ route('Get.Vin.Number') }}',
                            type: 'GET',
                            data: {
                                'Vin_Number': Vin_Number
                            },
                            success: function(data) {
                                console.log('Response:', data);
                                currentVinInput.closest('.vehcile-information').find(
                                    '.new-basic-info input[name="Vehcile_Make[]"]'
                                ).val(data['Make']);
                                currentVinInput.closest('.vehcile-information').find(
                                    '.new-basic-info input[name="Vehcile_Year[]"]'
                                ).val(data['Year']);
                                currentVinInput.closest('.vehcile-information').find(
                                    '.new-basic-info input[name="Vehcile_Model[]"]'
                                ).val(data['Model']);
                            }
                        });
                    });
                const GetVehicleMake = '{{ route('Get.Vehcile.Make') }}';
                const GetVehicleModel = '{{ route('Get.Vehcile.Model') }}';
                $('#vehciles').on('focus', 'input.makes.typeahead', function() {
                    $(this).typeahead({
                        source: function(query, process) {
                            return $.get(GetVehicleMake, {
                                query: query
                            }, function(data) {
                                return process(data);
                            });
                        }
                    });
                });
                $('#vehciles').on('focus', 'input.models.typeahead', function() {
                    $(this).typeahead({
                        source: function(query, process) {
                            return $.get(GetVehicleModel, {
                                query: query
                            }, function(data) {
                                return process(data);
                            });
                        }
                    });
                });
                $('#vehciles').on('change', '[name^="radio_stacked"]', function() {
                    const vehcileId = $(this).closest('.vehcile-information').find(
                        '[name="Vehcile_ID[]"]').val();
                    const radioName = $(this).attr('name').replace(/\[\d+\]/, `[${vehcileId}]`);
                    const min_vehcile_id = $(this).attr('name').match(/\[(\d+)\]/)[
                        1];
                    const reformSelector = `#reform${min_vehcile_id}`;
                    if ($(this).val() === 'YMM') {
                        $(`${reformSelector} .vin-box-dynimic`)
                            .hide(); 
                        $(`${reformSelector} .new-basic-info`)
                            .show();
                        $(`${reformSelector} .vehcile-information-container-vins`).hide();
                        $(`${reformSelector} .vehcile-information-container-ymms`).show();
                        $(`${reformSelector} .vehcile-information-container-vins input`).prop(
                            'disabled', true);
                        $(`${reformSelector} .vehcile-information-container-ymms input`).prop(
                            'disabled', false);
                        $(`${reformSelector} .new-basic-info input`).prop('required', true);
                        $(`${reformSelector} .new-basic-info input`).attr("readonly", false);
                        $(`${reformSelector} .vin-box-dynimic input`).prop('required', false);
                    } else if ($(this).val() === 'VIN') {
                        $(`${reformSelector} .vin-box-dynimic`)
                            .show(); 
                        $(`${reformSelector} .vehcile-information-container-vins`).show();
                        $(`${reformSelector} .vehcile-information-container-ymms`).hide();
                        $(`${reformSelector} .vehcile-information-container-vins input`).prop(
                            'disabled', false);
                        $(`${reformSelector} .vehcile-information-container-ymms input`).prop(
                            'disabled', true);
                        $(`${reformSelector} .vin-box-dynimic input`).prop('required', true);
                        $(`${reformSelector} .new-basic-info input`).attr("readonly", true);
                        $(`${reformSelector} .new-basic-info input`).prop('required', false);
                    }
                });
            }
        });
        $(document).on('click', '.remove-vehcile', function() {
            const getVehicleID = $(this).find('.Vehicle-ID').val();
            const getListID = '{{ $Lisiting->id }}';
            const $clickedElement = $(this);
            if (getVehicleID !== undefined) {
                console.log('yahoo');
                $.ajax({
                    url: '{{ route('Remove.Single.Vehicle') }}',
                    type: 'GET',
                    data: {
                        'Vehicle_ID': getVehicleID,
                        'List_ID': getListID
                    },
                    success: function(response) {
                        console.log('apap');
                        toastr.success(response.message, "Success");
                        $clickedElement.closest('.vehcile-information').remove();
                    },
                    error: function(xhr) {
                        console.log('okok');
                        toastr.error(xhr.responseJSON.message ||
                            'An unexpected error occurred.', "Error");
                    }
                });
            } else {
                $(this).closest('.vehcile-information').remove();
            }
            min_vehcile--;
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        var min_heavy_vehcile = 1;
        var max_heavy_vehcile = 25;
        var new_heavy_vehciles =
            '<div id="reform"><div class="heavy-vehcile-information"><div class="row"><div class="col-lg-4"></div><div class="col-lg-4"></div><div class="col-lg-4 justify-content-end"><div class="btn-box text-right"><button type="button" id="remove-heavy-vehicle" class="btn btn-danger"><i class="bx bx-trash"></i>Remove Heavy Vehicle</button></div></div></div><div class="row"><div class="col-lg-4 basic-vehcile-info"><div class="form-group"><label>Year *</label><input type="text" class="form-control" placeholder="Ex: 2022" name="Equipment_Year[]" value="" required><div class="invalid-feedback">Entered Year.</div></div></div><div class="col-lg-4 basic-vehcile-info"><div class="form-group"><label>Make *</label><input type="text" class="form-control" placeholder="Enter Make" name="Equipment_Make[]" value="" required><div class="invalid-feedback">Entered Make.</div></div></div><div class="col-lg-4 basic-vehcile-info"><div class="form-group"><label>Model *</label><input type="text" class="form-control" placeholder="Enter Model" name="Equipment_Model[]" value="" required><div class="invalid-feedback">Entered Model.</div></div></div></div><div class="row"><div class="col-lg-3"><div class="form-group"><label>Length *</label><input type="number" class="form-control" placeholder="Enter Length" min="0" name="Equip_Length[]" value="" required><div class="invalid-feedback">Entered Length.</div></div></div><div class="col-lg-3"><div class="form-group"><label>Width *</label><input type="number" class="form-control" placeholder="Enter Width" min="0" name="Equip_Width[]" value="" required><div class="invalid-feedback">Entered Width.</div></div></div><div class="col-lg-3"><div class="form-group"><label>Height *</label><input type="number" class="form-control" placeholder="Enter Height" min="0" name="Equip_Height[]" value="" required><div class="invalid-feedback">Entered Height.</div></div></div><div class="col-lg-3"><div class="form-group"><label>Weight *</label><input type="number" class="form-control" placeholder="Enter Weight" min="0" name="Equip_Weight[]" value="" required><div class="invalid-feedback">Entered Weight.</div></div></div></div><div class="row"><div class="col-lg-3"><div class="form-group"><label>Equipment Condition</label><select class="custom-select" name="Equipment_Condition[]" required><option selected="" value="">Select Equipment Condition</option><option value="Running">Running</option><option value="Not Running">Not Running</option></select><div class="invalid-feedback">Select Equipment Condition</div></div></div><div class="col-lg-3"><div class="form-group"><label>Trailer Type</label><select class="custom-select" name="Trailer_Type[]" required><option selected="" value="">Select Trailer</option><option value="Flatbed Trailer">Flatbed Trailer</option><option value="Removable Gooseneck Trailer">Removable Gooseneck Trailer</option><option value="Lowboy Trailer">Lowboy Trailer</option><option value="Step Deck Trailer">Step Deck Trailer</option><option value="Extendable Flatbed Trailer">Extendable Flatbed Trailer</option><option value="Stretch Single Drop Deck Trailer">Stretch Single Drop Deck Trailer</option><option value="Tow Away">Tow Away</option><option value="Drive Away">Drive Away</option><option value="Other">Other</option></select><div class="invalid-feedback">Select Any Trailer Type</div></div></div><div class="col-lg-3"><div class="form-group"><label>Shipment Preferences</label><select class="custom-select" name="Shipment_Preferences[]" required><option selected="" value="">Select Shipment Preferences</option><option value="LTL">LTL (Less Than Truck Load)</option><option value="FTL">FTL (Full Truck Load)</option></select><div class="invalid-feedback">Select Shipment Preferences</div></div></div></div></div></div>';
        $("#add-heavy-vehicle").click(function() {
            if (min_heavy_vehcile <= max_heavy_vehcile) {
                $("#heavy-vehciles").append(new_heavy_vehciles);
                min_heavy_vehcile++;
            }
        });
        $("#heavy-vehciles").on('click', '#remove-heavy-vehicle', function() {
            $(this).closest('#reform').remove();
            min_heavy_vehcile--;
        });
    });
</script>
<script type="text/javascript">
    var min_dry_van = 1;
    var max_dry_van = 25;
    var new_dry_van =
        '<div id="reform"><div class="dry-van-information"><div class="row"><div class="col-lg-4"></div><div class="col-lg-4"></div><div class="col-lg-4 justify-content-end"><div class="btn-box text-right"><button type="button" id="remove-dry-van" class="btn btn-danger"><i class="bx bx-trash"></i>Remove Current Shipment</button></div></div></div><div class="row"><div class="col-lg-3"><div class="form-group"><label>Freight Class *</label><select class="custom-select" name="Freight_Class[]" required><option selected="" value="">Select Class</option><option value="500">500</option><option value="400">400</option><option value="300">300</option><option value="250">250</option><option value="200">200</option><option value="175">175</option><option value="150">150</option><option value="125">125</option><option value="110">110</option><option value="100">100</option><option value="92.5">92.5</option><option value="85">85</option><option value="77.5">77.5</option><option value="70">70</option><option value="65">65</option><option value="60">60</option><option value="55">55</option><option value="50">50</option></select><div class="invalid-feedback">Select Any Class</div></div></div><div class="col-lg-3"><div class="form-group"><label>Freight Weight *</label><input type="number" class="form-control" placeholder="Enter Weight" min="0" name="Freight_Weight[]" value="" required><div class="invalid-feedback">Entered Weight.</div></div><div class="form-group form-check"><input type="checkbox" class="form-check-input" id="hazmat_Check" name="is_hazmat_Check[]"><label class="form-check-label" for="hazmat_Check">Hazmat?</label></div></div><div class="col-lg-3"><div class="form-group"><label>Shipment Preferences</label><select class="custom-select" name="Shipment_Preferences[]"><option selected="" value="">Select Shipment Preferences</option><option value="LTL">LTL (Less Than Truck Load)</option><option value="FTL">FTL (Full Truck Load)</option></select><div class="invalid-feedback">Select Shipment Preferences</div></div></div></div></div></div>';
    $("#add-dry-van").click(function() {
        if (min_dry_van <= max_dry_van) {
            $("#dry-vans").append(new_dry_van);
            min_dry_van++;
        }
    });
    $("#dry-vans").on('click', '#remove-dry-van', function() {
        $(this).closest('#reform').remove();
        min_dry_van--;
    });
</script>
<script>
    window.onload = function() {
        var today = '{{ $Lisiting->dispatch_listing ? $Lisiting->dispatch_listing->created_at : now() }}';
        var njDate = new Date(today.toLocaleString("en-US", {
            timeZone: "America/New_York"
        }));
        var tomorrow = new Date(njDate);
        tomorrow.setDate(tomorrow.getDate() + 1);
        var tomorrowString = tomorrow.toISOString().split('T')[0];
        var todayString = njDate.toISOString().split('T')[0];
        document.getElementById("pdatate1").setAttribute("min", todayString);
        document.querySelector('.deliver-date').setAttribute("min", todayString);
        $('#pdatate1, .deliver-date').change(function() {
            var pickupDate = new Date($('#pdatate1').val()); 
            var deliveryDate = new Date($('.deliver-date').val());
            if (!pickupDate || !deliveryDate || isNaN(pickupDate) || isNaN(deliveryDate)) {
                console.log("Invalid date format.");
                return;
            }
            var pickupDateNJ = new Date(pickupDate.toLocaleString("en-US", {
                timeZone: "America/New_York"
            }));
            var deliveryDateNJ = new Date(deliveryDate.toLocaleString("en-US", {
                timeZone: "America/New_York"
            }));
            if (pickupDateNJ > deliveryDateNJ) {
                console.error('Pickup date cannot be later than delivery date.');
                alert('Pickup date cannot be greater than delivery date.');
                $('#pdatate1').val('');
                return;
            }
            if (pickupDateNJ < new Date()) {
                console.error('Pickup date cannot be in the past.');
                alert('Pickup date cannot be in the past.');
                $('#pdatate1').val('');
                return;
            }
            console.log('Dates are valid.');
        });
        $('input[name="PickUp_mode"]').click(function() {
            if ($(this).val() === 'Before') {
                $('#pdatate1').attr('min', tomorrowString);
            } else {
                $('#pdatate1').attr('min', todayString);
            }
        });
        $('input[name="Delivery_mode"]').click(function() {
            if ($(this).val() === 'Before') {

                $('.deliver-date').attr('min', tomorrowString);
            } else {
                $('.deliver-date').attr('min', todayString);
            }
        });
    };
</script>
<script>
    $(document).ready(function() {
        $('input[name="Pickup_End_Time"]').on('change', function() {
            var pickupStartTime = $('input[name="Pickup_Start_Time"]').val();
            var pickupEndTime = $(this).val();
            var startTime = new Date('1970-01-01 ' + pickupStartTime);
            var endTime = new Date('1970-01-01 ' + pickupEndTime);
            if (endTime < startTime) {
                $(this).val(pickupStartTime);
                alert('Pickup End Time cannot be earlier than Pickup Start Time.');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('input[name="Delivery_End_Time"]').on('change', function() {
            var deliveryStartTime = $('input[name="Delivery_Start_Time"]').val();
            var deliveryEndTime = $(this).val();
            var startTime = new Date('1970-01-01 ' + deliveryStartTime);
            var endTime = new Date('1970-01-01 ' + deliveryEndTime);
            if (endTime < startTime) {
                $(this).val(deliveryStartTime);
                alert('Delivery End Time cannot be earlier than Delivery Start Time.');
            }
        });
        $(document).on('input', 'input[name^="Vehcile_Year"]', function() {
            const yearInput = $(this);
            const year = yearInput.val();
            if (year.length > 4) {
                yearInput.val(year.slice(0, 4));
            } else if (year.length === 4) {
                const yearInt = parseInt(year);
                if (yearInt < 1990 || yearInt > 2024) {
                    yearInput.val('');
                    alert('Please enter a year between 1990 and 2024.');
                }
            }
        });
    });
</script>
@endsection