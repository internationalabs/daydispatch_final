@php
    $listingAccess = explode(',', Auth::guard('Authorized')->user()->other_access);
    $auth_user = Auth::guard('Authorized')->user();
@endphp
<!-- Breadcrumb Area -->
<style>
    .was-validated .form-control:valid,
    .was-validated .form-control:invalid,
    .was-validated .form-select:valid,
    .was-validated .form-select:invalid {
        background-image: none !important;
    }

    .was-validated .custom-select:valid,
    .was-validated .custom-select:invalid {
        background-image: none !important;
    }
    .preview-image {
        border-radius: 6px;
        max-height: 230px;
        width: 100%;
        margin-bottom: 20px;
    }

    .displayimages {
        width: 100%;
    }

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



    .multiSelect {
        width: 300px;
        position: relative;
    }

    .multiSelect *,
    .multiSelect *::before,
    .multiSelect *::after {
        box-sizing: border-box;
    }

    .multiSelect_dropdown {
        font-size: 14px;
        min-height: 41px;
        line-height: 35px;
        border-radius: 4px;
        box-shadow: none;
        outline: none;
        background-color: #fff;
        color: #444f5b;
        border: 1px solid #d9dbde;
        font-weight: 400;
        padding: 0.5px 13px;
        margin: 0;
        transition: .1s border-color ease-in-out;
        cursor: pointer;
        width: 100%;
        margin-top: 28px;
    }

    .multiSelect_dropdown.-hasValue {
        padding: 5px 30px 5px 5px;
        cursor: default;
    }

    .multiSelect_dropdown.-open {
        box-shadow: none;
        outline: none;
        padding: 4.5px 29.5px 4.5px 4.5px;
        /*border: 1.5px solid #28a745;*/
    }

    .multiSelect_arrow::before,
    .multiSelect_arrow::after {
        content: '';
        position: absolute;
        display: block;
        width: 2px;
        height: 8px;
        border-radius: 20px;
        border-bottom: 8px solid #99A3BA;
        top: 40%;
        transition: all .15s ease;
    }

    .multiSelect_arrow::before {
        right: 18px;
        -webkit-transform: rotate(-50deg);
        transform: rotate(-50deg);
    }

    .multiSelect_arrow::after {
        right: 13px;
        -webkit-transform: rotate(50deg);
        transform: rotate(50deg);
    }

    .multiSelect_list {
        margin: 0;
        margin-bottom: 25px;
        padding: 0;
        list-style: none;
        opacity: 0;
        visibility: hidden;
        position: absolute;
        max-height: calc(10 * 31px);
        top: 28px;
        left: 0;
        z-index: 9999;
        right: 0;
        background: #fff;
        border-radius: 4px;
        overflow-x: hidden;
        overflow-y: auto;
        -webkit-transform-origin: 0 0;
        transform-origin: 0 0;
        transition: opacity 0.1s ease, visibility 0.1s ease, -webkit-transform 0.15s cubic-bezier(0.4, 0.6, 0.5, 1.32);
        transition: opacity 0.1s ease, visibility 0.1s ease, transform 0.15s cubic-bezier(0.4, 0.6, 0.5, 1.32);
        transition: opacity 0.1s ease, visibility 0.1s ease, transform 0.15s cubic-bezier(0.4, 0.6, 0.5, 1.32), -webkit-transform 0.15s cubic-bezier(0.4, 0.6, 0.5, 1.32);
        -webkit-transform: scale(0.8) translate(0, 4px);
        transform: scale(0.8) translate(0, 4px);
        border: 1px solid #d9dbde;
        box-shadow: 0px 10px 20px 0px rgba(0, 0, 0, 0.12);
    }

    .multiSelect_option {
        margin: 0;
        padding: 0;
        opacity: 0;
        -webkit-transform: translate(6px, 0);
        transform: translate(6px, 0);
        transition: all .15s ease;
    }

    .multiSelect_option.-selected {
        display: none;
    }

    .multiSelect_option:hover .multiSelect_text {
        color: #fff;
        background: #dc3545;
    }

    .multiSelect_text {
        cursor: pointer;
        display: block;
        padding: 5px 13px;
        color: #525c67;
        font-size: 14px;
        text-decoration: none;
        outline: none;
        position: relative;
        transition: all .15s ease;
    }

    .multiSelect_list.-open {
        opacity: 1;
        visibility: visible;
        -webkit-transform: scale(1) translate(0, 12px);
        transform: scale(1) translate(0, 12px);
        transition: opacity 0.15s ease, visibility 0.15s ease, -webkit-transform 0.15s cubic-bezier(0.4, 0.6, 0.5, 1.32);
        transition: opacity 0.15s ease, visibility 0.15s ease, transform 0.15s cubic-bezier(0.4, 0.6, 0.5, 1.32);
        transition: opacity 0.15s ease, visibility 0.15s ease, transform 0.15s cubic-bezier(0.4, 0.6, 0.5, 1.32), -webkit-transform 0.15s cubic-bezier(0.4, 0.6, 0.5, 1.32);
    }

    .multiSelect_list.-open+.multiSelect_arrow::before {
        -webkit-transform: rotate(-130deg);
        transform: rotate(-130deg);
    }

    .multiSelect_list.-open+.multiSelect_arrow::after {
        -webkit-transform: rotate(130deg);
        transform: rotate(130deg);
    }

    .multiSelect_list.-open .multiSelect_option {
        opacity: 1;
        -webkit-transform: translate(0, 0);
        transform: translate(0, 0);
    }

    .multiSelect_list.-open .multiSelect_option:nth-child(1) {
        transition-delay: 10ms;
    }

    .multiSelect_list.-open .multiSelect_option:nth-child(2) {
        transition-delay: 20ms;
    }

    .multiSelect_list.-open .multiSelect_option:nth-child(3) {
        transition-delay: 30ms;
    }

    .multiSelect_list.-open .multiSelect_option:nth-child(4) {
        transition-delay: 40ms;
    }

    .multiSelect_list.-open .multiSelect_option:nth-child(5) {
        transition-delay: 50ms;
    }

    .multiSelect_list.-open .multiSelect_option:nth-child(6) {
        transition-delay: 60ms;
    }

    .multiSelect_list.-open .multiSelect_option:nth-child(7) {
        transition-delay: 70ms;
    }

    .multiSelect_list.-open .multiSelect_option:nth-child(8) {
        transition-delay: 80ms;
    }

    .multiSelect_list.-open .multiSelect_option:nth-child(9) {
        transition-delay: 90ms;
    }

    .multiSelect_list.-open .multiSelect_option:nth-child(10) {
        transition-delay: 100ms;
    }

    .multiSelect_choice {
        background: rgb(231 117 128 / 18%);
        color: #444f5b;
        padding: 4px 8px;
        line-height: 17px;
        margin: 5px;
        display: inline-block;
        font-size: 13px;
        border-radius: 30px;
        cursor: pointer;
        font-weight: 500;
    }

    .multiSelect_deselect {
        width: 12px;
        height: 12px;
        display: inline-block;
        stroke: #b2bac3;
        stroke-width: 4px;
        margin-top: -1px;
        margin-left: 2px;
        vertical-align: middle;
    }

    .multiSelect_choice:hover .multiSelect_deselect {
        stroke: #a1a8b1;
    }

    .multiSelect_noselections {
        text-align: center;
        padding: 7px;
        color: #b2bac3;
        font-weight: 450;
        margin: 0;
    }

    .multiSelect_placeholder {
        position: absolute;
        left: 20px;
        font-size: 14px;
        top: 10px;
        padding: 0 4px;
        background-color: #fff;
        color: #b8bcbf;
        pointer-events: none;
        transition: all .1s ease;
    }

    .multiSelect_dropdown.-open+.multiSelect_placeholder,
    .multiSelect_dropdown.-open.-hasValue+.multiSelect_placeholder {
        top: -11px;
        left: 17px;
        color: #a6a6a6;
        font-size: 13px;
    }

    .multiSelect_dropdown.-hasValue+.multiSelect_placeholder {
        top: -11px;
        left: 17px;
        color: #6e7277;
        font-size: 13px;
    }

    .showalternativecode {
        display: none;
        margin-top: 10px;
    }

    .fa-circle-question {
        cursor: pointer;
        margin-left: 10px;
    }

    .error-border {
        border-color: red !important;
    }

    .buttons-style {
        width: 55%;
        row-gap: 20px;
        margin: auto;
        margin-top: 15px;
        margin-bottom: 22px;
    }

    .preview-container {
        position: relative;
        display: inline-block;
    }
    .delete-icon {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: red;
        color: white;
        border-radius: 50%;
        cursor: pointer;
        width: 20px;
        height: 20px;
        text-align: center;
        line-height: 20px;
    }
    .image-preview {
        max-width: 100%;
        height: auto;
    }
</style>
<div class="breadcrumb-area">
    <h1>Dashboard</h1>

    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>

        <li class="item">Direct Dispatch (<strong>Order ID: {{ $L_PID }}</strong>)</li>
    </ol>
</div>
<!-- End Breadcrumb Area -->
<!-- Start Profile Area -->
<section class="profile-area">
    <div class="profile-header mb-10">
        <div class="user-profile-nav" style="padding: 25px 25px 25px 25px;">
            <ul class="nav nav-tabs justify-content-center" role="tablist">
                {{-- @if (in_array('1', $listingAccess)) --}}
                    <li class="nav-item">
                        <a class="nav-link active" id="vehicle-tab" data-toggle="tab" href="#vehicle" role="tab"
                            aria-controls="vehicle" aria-selected="false">Post Vehicle</a>
                    </li>
                {{-- @endif --}}
                {{-- @if (in_array('2', $listingAccess)) --}}
                    <li class="nav-item">
                        <a class="nav-link" id="heavy-tab" data-toggle="tab" href="#heavy" role="tab"
                            aria-controls="heavy" aria-selected="false">Post Heavy Vehicle</a>
                    </li>
                {{-- @endif --}}
                {{-- @if (in_array('3', $listingAccess)) --}}
                    <li class="nav-item">
                        <a class="nav-link" id="dry-tab" data-toggle="tab" href="#dry" role="tab"
                            aria-controls="dry" aria-selected="false">Post Freight Load</a>
                    </li>
                {{-- @endif --}}
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="tab-content">
                {{-- @if (in_array('1', $listingAccess)) --}}
                    <div class="tab-pane fade p-3 show active" id="vehicle" role="tabpanel"
                        aria-labelledby="vehicle-tab">
                        <div class="card user-settings-box mb-30">
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <strong>
                                            {!! implode('<br/>', $errors->all('<span>:message</span>')) !!}
                                        </strong>
                                    </div>
                                @endif
                                <form class="was-validated" method="POST"
                                    action="{{ route('User.Direct.Dispatch.Create') }}" enctype="multipart/form-data">
                                    @csrf
                                    <h3><i class='bx bx-file'></i>Direct Dispatch For Vehicle</h3>
                                    <h5 style="float: left;"><b>DAY DISPATCH ORDER:</b> #{{ $L_PID }}</h5><i
                                        class="fa-solid fa-circle-question" onclick="question()"></i>
                                    <div class="showalternativecode">This unique DD order id belongs to day dispatch,
                                        Create
                                        your custom order ID in the field below for a personalized experience.</div>
                                    <input hidden name="post_type" value="1">
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
                                                    placeholder="Order Booking Price" name="Custom_Date" value="">
                                                <div class="invalid-feedback">
                                                    Select Custom Date.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 shadow-sm p-3">
                                            {{-- <h5 class="text-center"><b>Dispatching Company</b></h5> --}}
                                            <h4 class="text-white py-2 d-flex justify-content-center"
                                                style="background: #113771;">
                                                <i class="bi bi-hash mr-2"></i>Dispatching Company
                                            </h4>
                                            <div class="row">
                                                <input hidden type="text" class="Dispatch_Company_ID" name="Dispatch_Company_ID">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Company Name</label>
                                                        <input type="text" class="form-control Dispatch-Company-Name typeahead" name="Company_Name"
                                                               value="" required>
                                                        <div class="CMP_list"></div>
                                                        <div class="invalid-feedback">
                                                            Enter Assign Order Company Name.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>#MC Number</label>
                                                        <input type="text" class="form-control Dispatch-Mc_Number" name="Mc_Number"
                                                               value=""
                                                               autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Contact Phone</label>
                                                        <input type="text" class="form-control Dispatch-Contact_Phone"
                                                               name="Contact_Phone" value=""
                                                               autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Company State</label>
                                                        <input type="text" class="form-control Dispatch-Company_State"
                                                               name="Company_State" value=""
                                                               autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Company City</label>
                                                        <input type="text" class="form-control Dispatch-Company_City"
                                                               name="Company_City" value=""
                                                               autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Company Address</label>
                                                        <input type="text" class="form-control Dispatch-Address" name="Address"
                                                               value=""
                                                               autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Local Phone</label>
                                                        <input type="text" class="form-control Dispatch-Local_Phone" name="Local_Phone"
                                                               value=""
                                                               autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Toll Free Phone</label>
                                                        <input type="text" class="form-control Dispatch-Toll_Free" name="Toll_Free"
                                                               value=""
                                                               autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Dispatch Phone</label>
                                                        <input type="text" class="form-control Dispatch-Dispatch_Phone"
                                                               name="Dispatch_Phone" value=""
                                                               autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Fax Number</label>
                                                        <input type="text" class="form-control Dispatch-Fax_Phone" name="Fax_Phone"
                                                               value=""
                                                               autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <h5 class="text-center"><b>Driver Information</b></h5> --}}
                                            <h4 class="text-white py-2 d-flex justify-content-center"
                                                style="background: #113771;">
                                                <i class="bi bi-hash mr-2"></i>Driver Information
                                            </h4>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Driver Name</label>
                                                        <input type="text" class="form-control" name="Driver_Name"
                                                               placeholder="Driver Name">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Driver Email</label>
                                                        <input type="email" class="form-control"
                                                               name="Driver_Email" placeholder="Driver Email">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Driver Phone</label>
                                                        <input type="text" class="form-control phone-number" name="Driver_Phone" placeholder="Driver Phone">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 shadow-sm p-3">
                                            {{-- <h5 class="text-center"><b>Your Company Information</b></h5> --}}
                                            <h4 class="text-white py-2 d-flex justify-content-center"
                                                style="background: #113771;">
                                                <i class="bi bi-hash mr-2"></i>Your Company Information
                                            </h4>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Company Name</label>
                                                        <input type="text" class="form-control" name="Company_Name"
                                                               value="{{ !is_null($auth_user->Company_Name) ? $auth_user->Company_Name : '' }}"
                                                               autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>#MC Number</label>
                                                        <input type="text" class="form-control" name="Mc_Number"
                                                               value="{{ !is_null($auth_user->Mc_Number) ? $auth_user->Mc_Number : '' }}"
                                                               autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Contact Phone</label>
                                                        <input type="text" class="form-control" name="Contact_Phone"
                                                               value="{{ !is_null($auth_user->Contact_Phone) ? $auth_user->Contact_Phone : '' }}"
                                                               autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Company State</label>
                                                        <input type="text" class="form-control" name="Company_State"
                                                               value="{{ !is_null($auth_user->Company_State) ? $auth_user->Company_State : '' }}"
                                                               autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Company City</label>
                                                        <input type="text" class="form-control" name="Company_City"
                                                               value="{{ !is_null($auth_user->Company_City) ? $auth_user->Company_City : '' }}"
                                                               autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Company Address</label>
                                                        <input type="text" class="form-control" name="Address"
                                                               value="{{ !is_null($auth_user->Address) ? $auth_user->Address : '' }}"
                                                               autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Local Phone</label>
                                                        <input type="text" class="form-control" name="Local_Phone"
                                                               value="{{ !is_null($auth_user->Local_Phone) ? $auth_user->Local_Phone : '' }}"
                                                               autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Toll Free Phone</label>
                                                        <input type="text" class="form-control" name="Toll_Free"
                                                               value="{{ !is_null($auth_user->Toll_Free) ? $auth_user->Toll_Free : '' }}"
                                                               autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Dispatch Phone</label>
                                                        <input type="text" class="form-control" name="Dispatch_Phone"
                                                               value="{{ !is_null($auth_user->Dispatch_Phone) ? $auth_user->Dispatch_Phone : '' }}"
                                                               autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Fax Number</label>
                                                        <input type="text" class="form-control" name="Fax_Phone"
                                                               value="{{ !is_null($auth_user->Fax_Phone) ? $auth_user->Fax_Phone : '' }}"
                                                               autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 shadow-sm border rounded p-3">
                                            {{-- <h5 class="text-center"><b>VEHICLE INFORMATION</b></h5> --}}
                                            <h4 class="text-white py-2 d-flex justify-content-center"
                                                style="background: #113771;">
                                                <i class="bi bi-hash mr-2"></i> VEHICLE INFORMATION
                                            </h4>
                                            <div class="vehcile-information">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input"
                                                                id="customControlValidation2"
                                                                name="radio_stacked[0]" value="YMM"
                                                                checked>
                                                            <label class="custom-control-label"
                                                                for="customControlValidation2">Year, Make, and
                                                                Model</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="custom-control custom-radio mb-3">
                                                            <input type="radio" class="custom-control-input"
                                                                id="customControlValidation3"
                                                                name="radio_stacked[0]" value="VIN">
                                                            <label class="custom-control-label"
                                                                for="customControlValidation3">Vin
                                                                Number</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 justify-content-end">
                                                        <div class="btn-box text-right">
                                                            <button type="button" id="add-vehcile"
                                                                class="btn btn-success">
                                                                <i class='bx bx-add'></i>
                                                                Add Vehicle
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row vin-box vin-boxes">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Vin Number</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Vin #" name="Vin_Number[]"
                                                                value="{{ old('Origin_Address') }}">
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
                                                                <input id="date-dropdown" type="text"
                                                                    class="form-control year"
                                                                    placeholder="Ex: 2022"
                                                                    name="Vehcile_Year[]"
                                                                    value="{{ old('Vehcile_Year') }}" disabled
                                                                    min="1900" max="2025"
                                                                    maxlength="4" required>
                                                                <div class="invalid-feedback">
                                                                    Enter Year.
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4 basic-vehcile-info">
                                                            <div class="form-group">
                                                                <label>Make *</label>
                                                                <input type="text"
                                                                    class="form-control make typeahead"
                                                                    placeholder="Enter Make"
                                                                    name="Vehcile_Make[]"
                                                                    value="{{ old('Vehcile_Make') }}" disabled
                                                                    required>
                                                                <div class="invalid-feedback">
                                                                    Enter Make.
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4 basic-vehcile-info">
                                                            <div class="form-group">
                                                                <label>Model *</label>
                                                                <input type="text"
                                                                    class="form-control model typeahead"
                                                                    placeholder="Enter Model"
                                                                    name="Vehcile_Model[]"
                                                                    value="{{ old('Vehcile_Model') }}" disabled
                                                                    required>
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
                                                                <input id="date-dropdown" type="text"
                                                                    class="form-control "
                                                                    placeholder="Ex: 2022"
                                                                    name="Vehcile_Year_ymm[]"
                                                                    value="{{ old('Vehcile_Year') }}"
                                                                    min="1900" max="2025"
                                                                    maxlength="4" required>
                                                                <div class="invalid-feedback">
                                                                    Enter Year.
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4 basic-vehcile-info">
                                                            <div class="form-group">
                                                                <label>Make *</label>
                                                                <input type="text"
                                                                    class="form-control makes typeahead"
                                                                    placeholder="Enter Make"
                                                                    name="Vehcile_Make_ymm[]"
                                                                    value="{{ old('Vehcile_Make') }}" required>
                                                                <div class="invalid-feedback">
                                                                    Enter Make.
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4 basic-vehcile-info">
                                                            <div class="form-group">
                                                                <label>Model *</label>
                                                                <input type="text"
                                                                    class="form-control models typeahead"
                                                                    placeholder="Enter Model"
                                                                    name="Vehcile_Model_ymm[]"
                                                                    value="{{ old('Vehcile_Model') }}"
                                                                    required>
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
                                                            <input type="text" class="form-control"
                                                                placeholder="Enter Color"
                                                                name="Vehcile_Color[]"
                                                                value="{{ old('Vehcile_Color') }}">
                                                            <div class="invalid-feedback">
                                                                Enter Color.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Vehicle Type *</label>
                                                            <select class="custom-select"
                                                                name="Vehcile_Type[]" required>
                                                                <option selected="" value="">Select
                                                                    Vehicle
                                                                    Type
                                                                </option>
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
                                                                <option value="Passenger Van">Passenger Van
                                                                </option>
                                                                <option disabled="">————————————</option>
                                                                <option value="Boat">Boat</option>
                                                                <option value="Large Yacht">Large Yacht
                                                                </option>
                                                                <option value="RVs">RVs</option>
                                                                <option value="Travel Trailer">Travel Trailer
                                                                </option>
                                                                <option disabled="">————————————</option>
                                                                <option value="other_vehicle">Other Vehicle
                                                                </option>
                                                                <option value="other_motorcycle">Other
                                                                    Motorcycle
                                                                </option>
                                                            </select>
                                                            <div class="invalid-feedback">Select Vehicle Type
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Vehicle Condition *</label>
                                                            <select class="custom-select"
                                                                name="Vehcile_Condition[]" required>
                                                                <option selected="" value="Running">Running
                                                                </option>
                                                                <option value="Not Running">Not Running
                                                                </option>
                                                            </select>
                                                            <div class="invalid-feedback">Select Vehicle
                                                                Condition
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Trailer Type *</label>
                                                            <select class="custom-select"
                                                                name="Trailer_Type[]" required>
                                                                <option selected="" value="Open">Open
                                                                </option>
                                                                <option value="Enclosed">Enclosed</option>
                                                                <option value="Drive Away">Drive Away</option>
                                                            </select>
                                                            <div class="invalid-feedback">Select Any Trailer
                                                                Type</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="vehciles"></div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Additional Vehicle Information</label>
                                                        <textarea cols="30" rows="5" name="Vehcile_Desc" placeholder="Write something..." class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 shadow-sm border rounded p-3">
                                            {{-- <h5 class="text-center"><b>VEHICLE PICKUP INFORMATION</b></h5> --}}
                                            <h4 class="text-white py-2 d-flex justify-content-center"
                                                style="background: #113771;">
                                                <i class="bi bi-hash mr-2"></i> VEHICLE PICKUP INFORMATION
                                            </h4>
                                            <div class="row DateParent">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Pickup Date *</label>
                                                        <input id="pdatate1" type="date"
                                                            class="form-control pick-date myDate"
                                                            placeholder="Pickup Date" name="Pickup_Date"
                                                            value="{{ date('Y-m-d') }}" required>
                                                        <div class="invalid-feedback">
                                                            Enter Pickup Date.
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-2">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio"
                                                                    class="custom-control-input "
                                                                    id="vehicle_customControlValidation777"
                                                                    name="PickUp_mode" value="Before">
                                                                <label class="custom-control-label"
                                                                    for="vehicle_customControlValidation777">Before</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio"
                                                                    class="custom-control-input"
                                                                    id="vehicle_customControlValidation7777"
                                                                    name="PickUp_mode" value="On" checked>
                                                                <label class="custom-control-label"
                                                                    for="vehicle_customControlValidation7777">On</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="custom-control custom-radio mb-3">
                                                                <input type="radio"
                                                                    class="custom-control-input"
                                                                    id="vehicle_customControlValidation888"
                                                                    name="PickUp_mode" value="After">
                                                                <label class="custom-control-label"
                                                                    for="vehicle_customControlValidation888">After</label>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="col-lg-2">
                                                            <div class="custom-control custom-radio mb-3">
                                                                <input type="radio" class="custom-control-input"
                                                                    id="vehicle_customControlValidation8888"
                                                                    name="PickUp_mode" value="ASAP">
                                                                <label class="custom-control-label"
                                                                    for="vehicle_customControlValidation8888">ASAP</label>
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Delivery Date</label>
                                                        <input type="date"
                                                            class="form-control deliver-date seconddate"
                                                            placeholder="Delivery Date" name="Delivery_Date">
                                                        {{-- <div class="invalid-feedback">
                                                            Enter Delivery Date.
                                                        </div> --}}
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-2">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio"
                                                                    class="custom-control-input"
                                                                    id="vehicle_customControlValidation77777"
                                                                    name="Delivery_mode" value="Before">
                                                                <label class="custom-control-label"
                                                                    for="vehicle_customControlValidation77777">Before</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio"
                                                                    class="custom-control-input"
                                                                    id="vehicle_customControlValidation77787"
                                                                    name="Delivery_mode" value="On" checked>
                                                                <label class="custom-control-label"
                                                                    for="vehicle_customControlValidation77787">On</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="custom-control custom-radio mb-3">
                                                                <input type="radio"
                                                                    class="custom-control-input"
                                                                    id="vehicle_customControlValidation88888"
                                                                    name="Delivery_mode" value="After"
                                                                    >
                                                                <label class="custom-control-label"
                                                                    for="vehicle_customControlValidation88888">After</label>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="col-lg-2">
                                                            <div class="custom-control custom-radio mb-3">
                                                                <input type="radio" class="custom-control-input"
                                                                    id="vehicle_customControlValidation88788"
                                                                    name="Delivery_mode" value="ASAP" checked>
                                                                <label class="custom-control-label"
                                                                    for="vehicle_customControlValidation88788">ASAP</label>
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                {{-- <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Pickup Time</label>
                                                        <input type="time" class="form-control pick-date"
                                                            placeholder="Pickup Time" name="Pickup_Start_Time"
                                                            value="{{ date('Y-m-d') }}">
                                                        <div class="invalid-feedback">
                                                            Enter Pickup Time.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Pickup Time</label>
                                                        <input type="time" class="form-control pick-date"
                                                            placeholder="Pickup Time" name="Pickup_End_Time"
                                                            value="{{ date('Y-m-d') }}">
                                                        <div class="invalid-feedback">
                                                            Enter Pickup Time.
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Pickup From</label>
                                                        <input type="time" class="form-control pick-date"
                                                            placeholder="Pickup From" name="Pickup_Start_Time"
                                                            value="{{ date('Y-m-d') }}">
                                                        <div class="invalid-feedback">
                                                            Enter Pickup Time.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Pickup To</label>
                                                        <input type="time" class="form-control pick-date"
                                                            placeholder="Pickup To" name="Pickup_End_Time"
                                                            value="{{ date('Y-m-d') }}">
                                                        <div class="invalid-feedback">
                                                            Enter Pickup Time.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Delivery From</label>
                                                        <input type="time"
                                                            class="form-control deliver-time"
                                                            placeholder="Delivery Time"
                                                            name="Delivery_Start_Time">
                                                        <div class="invalid-feedback">
                                                            Enter Delivery Time.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Delivery To</label>
                                                        <input type="time"
                                                            class="form-control deliver-time"
                                                            placeholder="Delivery Time"
                                                            name="Delivery_End_Time">
                                                        <div class="invalid-feedback">
                                                            Enter Delivery Time.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 shadow-sm border rounded p-3">
                                            {{-- <h5 class="text-center"><b>ORIGIN LOCATION</b></h5> --}}
                                            <h4 class="text-white py-2 d-flex justify-content-center"
                                                style="background: #113771;">
                                                <i class="bi bi-hash mr-2"></i> ORIGIN LOCATION
                                            </h4>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Terminal, Dealer, Auction</label>
                                                        {{-- <select class="custom-select Orig"
                                                            name="Orign_Location">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="Location">Location</option>
                                                            <option value="Dealership">Dealership</option>
                                                            <option value="Auction">Auction</option>
                                                            <option value="Other">Other</option>
                                                        </select> --}}
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
                                                        <div class="invalid-feedback" >
                                                            Select Any Type.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 orig-basic">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control"
                                                            name="User_Name" placeholder="Enter User Name"
                                                            value="{{ old('User_Name') }}"
                                                            autocomplete="off">
                                                        <div class="invalid-feedback">
                                                            Enter UserName.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 orig-basic">
                                                    <div class="form-group">
                                                        <label>Email Address</label>
                                                        <input type="email" class="form-control"
                                                            name="User_Email"
                                                            placeholder="Enter Email Address"
                                                            value="{{ old('User_Email') }}"
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
                                                            name="Stock_Number"
                                                            value="{{ old('Stock_Number') }}" value="">
                                                        <div class="invalid-feedback">
                                                            Enter Stock Number.
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-lg-6 orig-basic">
                                                    <div class="form-group">
                                                        <label>Phone Number</label>
                                                        <input type="text"
                                                            class="form-control phone-number"
                                                            placeholder="Phone Number" name="Local_Phone"
                                                            value="{{ old('Local_Phone') }}">
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
                                                            <input id="local-phone-input" class="form-control phone-number" type="text" placeholder="Phone Number" name="Local_Phone[]" value="{{ old('Local_Phone') }}">
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
                                                <div class="toast" style="display: none;">
                                                    <div class="toast-body d-flex justify-content-between align-items-center">
                                                        <span class="phone-number"></span>
                                                        <button type="button" class="btn-close remove-phone-number"></button>
                                                    </div>
                                                </div>
                                                {{-- <div id="phone-container">
                                                    <div class="col-lg-6 orig-basic">
                                                        <div class="form-group">
                                                            <label>
                                                                Phone Number 
                                                                <span class="btn btn-sm btn-success add-phone">+</span>
                                                            </label>
                                                            <input type="text" class="form-control phone-number" placeholder="Phone Number" name="Local_Phone[]" value="{{ old('Local_Phone') }}">
                                                            <div class="invalid-feedback">Entered Local Phone.</div>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                {{-- <div class="col-lg-6 orig-location">
                                                    <div class="form-group">
                                                        <label>Location Type</label>
                                                        <select class="custom-select orig-business-location"
                                                            name="Location">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="Residence">Residence</option>
                                                            <option value="Business">Business</option>
                                                        </select>
                                                        <div class="invalid-feedback">Select Auction Type</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 orig-location-business">
                                                    <div class="form-group">
                                                        <label>Business Phone Number</label>
                                                        <input type="text"
                                                            class="form-control phone-number"
                                                            placeholder="Business Phone Number"
                                                            name="Business_Phone"
                                                            value="{{ old('Business_Phone') }}">
                                                        <div class="invalid-feedback">
                                                            Enter Business Phone Number.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 orig-location-business">
                                                    <div class="form-group">
                                                        <label>Business Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Business Name"
                                                            name="Business_Location"
                                                            value="{{ old('Business_Location') }}"
                                                            value="">
                                                        <div class="invalid-feedback">
                                                            Enter Business Name.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 orig-auction">
                                                    <div class="form-group orig-auction-select-field">
                                                        <label>Auction Name</label>
                                                        <select class="custom-select" name="Auction_Method">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="COPART Auction">Copart Auction
                                                            </option>
                                                            <option value="Mannheim Auction">Manheim Auction
                                                            </option>
                                                            <option value="IAAI Auction">IAAI Auction</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                        <div class="invalid-feedback">Select Auction Type</div>
                                                    </div>
                                                    <div class="form-group orig-auction-input-field">
                                                        <label>Auction Name</label>
                                                        <input type="text" class="form-control"
                                                            name="Auction_Method1"
                                                            placeholder="Enter Auction Name"
                                                            value="{{ old('Auction_Method1') }}"
                                                            autocomplete="off">
                                                        <div class="invalid-feedback">
                                                            Enter UserName.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 orig-auction">
                                                    <div class="form-group">
                                                        <label>Auction Phone</label>
                                                        <input type="text"
                                                            class="form-control phone-number"
                                                            placeholder="Auction Phone Number"
                                                            name="Auction_Phone"
                                                            value="{{ old('Auction_Phone') }}">
                                                        <div class="invalid-feedback">
                                                            Enter Auction Phone.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 orig-auction">
                                                    <div class="form-group">
                                                        <label>Buyer Number</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Buyer Number"
                                                            name="Stock_Number"
                                                            value="{{ old('Stock_Number') }}" value="">
                                                        <div class="invalid-feedback">
                                                            Enter Stock Number.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 orig-dealership">
                                                    <div class="form-group">
                                                        <label>Dealership / Contact Person / Shop Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Dealership / Contact Person / Shop Name"
                                                            name="Auction_Method2"
                                                            value="{{ old('Auction_Method2') }}">
                                                        <div class="invalid-feedback">
                                                            Enter Auction Phone.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 orig-dealership">
                                                    <div class="form-group">
                                                        <label>Dealership Phone</label>
                                                        <input type="text"
                                                            class="form-control phone-number"
                                                            placeholder="Auction Phone Number"
                                                            name="Auction_Phone1"
                                                            value="{{ old('Auction_Phone') }}">
                                                        <div class="invalid-feedback">
                                                            Enter Auction Phone.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 orig-dealership">
                                                    <div class="form-group">
                                                        <label>Buyer Number</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Buyer Number"
                                                            name="Stock_Number1" value="">
                                                        <div class="invalid-feedback">
                                                            Enter Stock Number.
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6 shadow-sm border rounded p-3">
                                            {{-- <h5 class="text-center"><b>DESTINATION LOCATION</b></h5> --}}
                                            <h4 class="text-white py-2 d-flex justify-content-center"
                                                style="background: #113771;">
                                                <i class="bi bi-hash mr-2"></i> DESTINATION LOCATION
                                            </h4>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Terminal, Dealer, Auction</label>
                                                        {{-- <select class="custom-select Dest"
                                                            name="Destination_Location">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="Location">Location</option>
                                                            <option value="Dealership">Dealership</option>
                                                            <option value="Port">Port</option>
                                                            <option value="Auction">Auction</option>
                                                            <option value="Other">Other</option>
                                                        </select> --}}
                                                        {{-- <select class="custom-select"
                                                            name="Destination_Location">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="Location">Location</option>
                                                            <option value="Dealership">Dealership</option>
                                                            <option value="Port">Port</option>
                                                            <option value="Auction">Auction</option>
                                                            <option value="Other">Other</option>
                                                        </select> --}}
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
                                                <div class="col-lg-6 dest-basic">
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
                                                <div class="col-lg-6 dest-basic">
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
                                                {{-- <div class="col-lg-6 dest-basic">
                                                    <div class="form-group">
                                                        <label>Phone Number</label>
                                                        <input type="text"
                                                            class="form-control phone-number"
                                                            placeholder="Phone Number" name="Dest_Local_Phone"
                                                            value="{{ old('Dest_Local_Phone') }}">
                                                        <div class="invalid-feedback">
                                                            Enter Local Phone.
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                {{-- <div id="dest-phone-container">
                                                    <div class="col-lg-6 dest-basic">
                                                        <div class="form-group">
                                                            <label>
                                                                Phone Number 
                                                                <span class="btn btn-sm btn-success add-dest-phone">+</span>
                                                            </label>
                                                            <input type="text" class="form-control phone-number" placeholder="Phone Number" name="Dest_Local_Phone[]" value="{{ old('Dest_Local_Phone') }}">
                                                            <div class="invalid-feedback">Entered Local Phone.</div>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="col-lg-6 dest-basic">
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
                                                {{-- <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Phone Numbers</label>
                                                        <div class="d-flex">
                                                            <input id="phone-number-input" class="form-control" type="text" placeholder="Phone Number" name="phone_numbers[]">
                                                            <button type="button" class="btn btn-success ms-2" id="add-phone-number">
                                                                <i class="fas fa-plus"></i>
                                                            </button>
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
                                                <script>
                                                    // Add new phone number
                                                    document.getElementById('add-phone-number').addEventListener('click', function () {
                                                        var phoneNumberInput = document.getElementById('phone-number-input');
                                                        var phoneNumberValue = phoneNumberInput.value.trim();
                                                
                                                        if (phoneNumberValue !== "") {
                                                            var phoneNumbersContainer = document.getElementById('phone-numbers-toast-container');
                                                
                                                            // Create toast for added phone number
                                                            var toast = document.createElement('div');
                                                            toast.classList.add('toast', 'show');
                                                            toast.style.display = 'block';
                                                            toast.innerHTML = `
                                                                <div class="toast-body d-flex justify-content-between align-items-center">
                                                                    <span class="phone-number">${phoneNumberValue}</span>
                                                                    <button type="button" class="btn-close remove-phone-number"></button>
                                                                </div>
                                                            `;
                                                            
                                                            // Append the toast to the container
                                                            phoneNumbersContainer.appendChild(toast);
                                                
                                                            // Clear the input field
                                                            phoneNumberInput.value = "";
                                                
                                                            // Set up event to remove the toast when clicking the remove button
                                                            toast.querySelector('.remove-phone-number').addEventListener('click', function () {
                                                                toast.remove();
                                                            });
                                                        } else {
                                                            alert("Please enter a phone number.");
                                                        }
                                                    });
                                                </script> --}}
                                                {{-- <div class="col-lg-6 dest-location">
                                                    <div class="form-group">
                                                        <label>Location Type</label>
                                                        <select class="custom-select dest-business-location"
                                                            name="Dest_Location">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="Residence">Residence</option>
                                                            <option value="Business">Business</option>
                                                        </select>
                                                        <div class="invalid-feedback">Select Auction Type</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 dest-location-business">
                                                    <div class="form-group">
                                                        <label>Business Phone Number</label>
                                                        <input type="text"
                                                            class="form-control phone-number"
                                                            placeholder="Business Phone Number"
                                                            name="Dest_Business_Phone"
                                                            value="{{ old('Dest_Business_Phone') }}">
                                                        <div class="invalid-feedback">
                                                            Enter Business Phone Number.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 dest-location-business">
                                                    <div class="form-group">
                                                        <label>Business Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Business Name"
                                                            name="Dest_Business_Location"
                                                            value="{{ old('Dest_Business_Location') }}">
                                                        <div class="invalid-feedback">
                                                            Enter Business Name.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 dest-auction">
                                                    <div class="form-group dest-auction-select-field">
                                                        <label>Auction Name</label>
                                                        <select class="custom-select"
                                                            name="Dest_Auction_Method1">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="COPART Auction">Copart Auction
                                                            </option>
                                                            <option value="Mannheim Auction">Manheim Auction
                                                            </option>
                                                            <option value="IAAI Auction">IAAI Auction</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                        <div class="invalid-feedback">Select Auction Type</div>
                                                    </div>
                                                    <div class="form-group dest-auction-input-field">
                                                        <label>Auction Name</label>
                                                        <input type="text" class="form-control"
                                                            name="Dest_Auction_Method2"
                                                            placeholder="Enter Auction Name" value=""
                                                            autocomplete="off">
                                                        <div class="invalid-feedback">
                                                            Enter UserName.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 dest-auction">
                                                    <div class="form-group">
                                                        <label>Auction Phone</label>
                                                        <input type="text"
                                                            class="form-control phone-number"
                                                            placeholder="Auction Phone Number"
                                                            name="Dest_Auction_Phone" value="">
                                                        <div class="invalid-feedback">
                                                            Enter Auction Phone.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 dest-auction">
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
                                                <div class="col-lg-6 dest-dealership">
                                                    <div class="form-group">
                                                        <label>Dealership / Contact Person / Shop Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Dealership / Contact Person / Shop Name"
                                                            name="Dest_Auction_Method3" value="">
                                                        <div class="invalid-feedback">
                                                            Enter Auction Phone.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 dest-dealership">
                                                    <div class="form-group">
                                                        <label>Dealership Phone</label>
                                                        <input type="text"
                                                            class="form-control phone-number"
                                                            placeholder="Auction Phone Number"
                                                            name="Dest_Auction_Phone6"
                                                            value="{{ old('Dest_Auction_Method4') }}">
                                                        <div class="invalid-feedback">
                                                            Enter Auction Phone.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 dest-dealership">
                                                    <div class="form-group">
                                                        <label>Buyer Number</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Buyer Number"
                                                            name="Dest_Stock_Number6" value="">
                                                        <div class="invalid-feedback">
                                                            Enter Stock Number.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 dest-port">
                                                    <div class="form-group">
                                                        <label>Port Type</label>
                                                        <select class="custom-select"
                                                            name="Dest_Auction_Method5">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="Sea Port">Sea Port</option>
                                                            <option value="Airport">Airport</option>
                                                        </select>
                                                        <div class="invalid-feedback">Select Auction Type</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 dest-port">
                                                    <div class="form-group">
                                                        <label>Port Phone</label>
                                                        <input type="text"
                                                            class="form-control phone-number"
                                                            placeholder="Port Phone Number"
                                                            name="Dest_Auction_Phone7" value="">
                                                        <div class="invalid-feedback">
                                                            Enter Port Phone.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 dest-port">
                                                    <div class="form-group">
                                                        <label>Terminal</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Terminal" name="Dest_Stock_Number7"
                                                            value="">
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
                                                <i class="bi bi-hash mr-2"></i> ORIGIN ADDRESS
                                            </h4> --}}
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Address *</label>
                                                        <input type="text" class="form-control"
                                                            name="Origin_Address" placeholder="Enter Origin"
                                                            value="{{ old('Origin_Address') }}"
                                                            autocomplete="off" required>
                                                        <div class="invalid-feedback">
                                                            Enter Origin.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Address 2</label>
                                                        <input type="text" class="form-control"
                                                            name="Origin_Address_II"
                                                            placeholder="Enter Origin 2"
                                                            value="{{ old('Origin_Address_II') }}"
                                                            autocomplete="off">
                                                        <div class="invalid-feedback">
                                                            Enter Origin 2.
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
                                                            class="form-control Orig_ZipCode2" readonly
                                                            name="" placeholder="zipcode">
                                                        <div class="invalid-feedback">Entered ZipCode.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 shadow-sm border rounded p-3">
                                            {{-- <h5 class="text-center"><b>DESTINATION ADDRESS</b></h5> --}}
                                            {{-- <h4 class="text-white py-2 d-flex justify-content-center"
                                                style="background: #113771;">
                                                <i class="bi bi-hash mr-2"></i> DESTINATION ADDRESS
                                            </h4> --}}
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Address *</label>
                                                        <input type="text" class="form-control"
                                                            name="Destination_Address"
                                                            placeholder="Enter Destination"
                                                            value="{{ old('Destination_Address') }}"
                                                            autocomplete="off" required>
                                                        <div class="invalid-feedback">
                                                            Enter Destination.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Address 2</label>
                                                        <input type="text" class="form-control"
                                                            name="Destination_Address_II"
                                                            placeholder="Enter Destination 2"
                                                            value="{{ old('Destination_Address_II') }}"
                                                            autocomplete="off">
                                                        <div class="invalid-feedback">
                                                            Enter Destination 2.
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
                                                            class="form-control Dest_ZipCode2" readonly
                                                            name="" placeholder="zipcode">
                                                        <div class="invalid-feedback">Entered ZipCode.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="row justify-content-center">-->
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 shadow-sm border rounded p-3">
                                            {{-- <h5 class="text-center"><b>Carrier / Payment</b></h5> --}}
                                            <h4 class="text-white py-2 d-flex justify-content-center"
                                                style="background: #113771;">
                                                <i class="bi bi-hash mr-2"></i> Carrier / Payment
                                            </h4>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Order Pricing</label>
                                                        <input type="number"
                                                            class="form-control Booking_Price"
                                                            placeholder="Order Pricing" name="Booking_Price"
                                                            value="">
                                                        <div class="invalid-feedback">
                                                            Enter Booking Price.
                                                        </div>
                                                    </div>

                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="vehicle_deposite_Check">
                                                        <label class="form-check-label"
                                                            for="vehicle_deposite_Check">Deposit
                                                            Amount?</label>
                                                    </div>

                                                </div>
                                                <div class="col-lg-3 deposite-box">
                                                    <div class="form-group">
                                                        <label>Deposit Amount *</label>
                                                        <input type="number"
                                                            class="form-control Deposite_Amount"
                                                            placeholder="Deposite Amount"
                                                            name="Deposite_Amount" value="">
                                                        <div class="invalid-feedback">
                                                            Enter Deposite Amount.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Pay To Carrier *</label>
                                                        <input type="number" class="form-control Price-Pay"
                                                            placeholder="Pay To Carrier" name="Price_Pay"
                                                            value="" required>
                                                        <div class="invalid-feedback">
                                                            Enter Price Pay Amount.
                                                        </div>
                                                    </div>
                                                    <div class="row d-none">
                                                        <div class="col-lg-6">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio"
                                                                    class="custom-control-input"
                                                                    id="vehicle_customControlValidation77"
                                                                    name="Payment_Mode" value="COD"
                                                                    checked>
                                                                <label class="custom-control-label"
                                                                    for="vehicle_customControlValidation77">COD</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="custom-control custom-radio mb-3">
                                                                <input type="radio"
                                                                    class="custom-control-input"
                                                                    id="vehicle_customControlValidation88"
                                                                    name="Payment_Mode" value="Quick Pay">
                                                                <label class="custom-control-label"
                                                                    for="vehicle_customControlValidation88">Quick
                                                                    Pay</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>COD/COP Amount</label>
                                                        <input type="number" class="form-control COD_Amount"
                                                            placeholder="COD / COP Amount" name="COD_Amount"
                                                            value="0" required>
                                                        <div class="invalid-feedback">
                                                            Enter COD/COP Amount.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Balance Amount</label>
                                                        <input readonly type="number"
                                                            class="form-control Balance-Amount"
                                                            placeholder="Balanced Amount" name="Bal_Amount"
                                                            value="" required>
                                                        <div class="invalid-feedback">
                                                            Enter Balance Amount.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 cod-inputs">
                                                    <div class="form-group">
                                                        <label>COD/COP Payment Method *</label>
                                                        <select class="custom-select COD_Payment_Mode"
                                                            name="COD_Payment_Mode">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="Cash">Cash</option>
                                                            <option value="Company Check">Company Check</option>
                                                            <option value="Certified Funds">Certified Funds</option>
                                                            <option value="Comcheck">Comcheck</option>
                                                            <option value="TCH">TCH</option>
                                                        </select>
                                                        <div class="invalid-feedback">Select AnyOne</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 cod-inputs">
                                                    <div class="form-group">
                                                        <label>COD/COP Location *</label>
                                                        <select class="custom-select Location_Mode"
                                                            name="Location_Mode">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="PickUp">PickUp</option>
                                                            <option value="Delivery">Delivery</option>
                                                        </select>
                                                        <div class="invalid-feedback">Select AnyOne</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 balance-inputs">
                                                    <div class="form-group">
                                                        <label>Balance Payment Method *</label>
                                                        <select class="custom-select Balance_Payment_Mode"
                                                            name="Balance_Payment_Mode">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="Cash">Cash</option>
                                                            <option value="Company Check">Company Check
                                                            </option>
                                                            <option value="Certified Funds">Certified Funds
                                                            </option>
                                                            <option value="Comcheck">Comcheck</option>
                                                            <option value="TCH">TCH</option>
                                                        </select>
                                                        <div class="invalid-feedback">Select AnyOne</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 balance-inputs">
                                                    <div class="form-group">
                                                        <label>Balance Payment Time *</label>
                                                        <select class="custom-select Bal_Payment_Time"
                                                            name="Bal_Payment_Time">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="Immediately">Immediately</option>
                                                            <option value="2 Business Days (Quick Pay)">2
                                                                Business Days
                                                                (Quick
                                                                Pay)
                                                            </option>
                                                            <option value="5 Business Days">5 Business Days
                                                            </option>
                                                            <option value="10 Business Days">10 Business Days
                                                            </option>
                                                            <option value="15 Business Days">15 Business Days
                                                            </option>
                                                            <option value="30 Business Days">30 Business Days
                                                            </option>
                                                        </select>
                                                        <div class="invalid-feedback">Select AnyOne</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 balance-inputs">
                                                    <div class="form-group">
                                                        <label>Balance Payment Terms Begin On *</label>
                                                        <select class="custom-select Payment_Terms"
                                                            name="Payment_Terms">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="PickUp">PickUp</option>
                                                            <option value="Delivery">Delivery</option>
                                                            <option value="Receiving a Sign Bill Of Lading">
                                                                Receiving a
                                                                Sign
                                                                Bill Of Lading
                                                            </option>
                                                        </select>
                                                        <div class="invalid-feedback">Select AnyOne</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Additional Vehicle Information</label>
                                                        <textarea cols="30" rows="5" name="Desc_For_Vehcile" placeholder="Write something..."
                                                            class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="row">
                                                <div class="PaymentInfo col-sm-12">
                                                </div>
                                                <input type="hidden" name="PaymentInfo"
                                                    id="PaymentInfoInput">
                                                <div class="BalPaymentInfo col-sm-12">
                                                </div>
                                                <input type="hidden" name="BalPaymentInfo"
                                                    id="BalPaymentInfoInput">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 shadow-sm border rounded p-3">
                                            {{-- <h5 class="text-center"><b>Additional Information</b></h5> --}}
                                            <h4 class="text-white py-2 d-flex justify-content-center"
                                                style="background: #113771;">
                                                <i class="bi bi-hash mr-2"></i> Additional Information
                                            </h4>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Order ID *</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Dispatch ID" name="Ref_ID"
                                                            value="" required>
                                                        <div class="invalid-feedback">
                                                            Enter Order ID.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label>Upload Any Vehicle Images</label>
                                                    <div class="input-group mb-3">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                name="Vehcile_Images[]"
                                                                id="image-upload-first" accept="image/*"
                                                                multiple>
                                                            <label class="custom-file-label">Choose
                                                                file</label>
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
                                                            class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Special Instructions</label>
                                                        <textarea cols="30" rows="5" name="Special_Terms"
                                                            placeholder="Enter Any Special Instructions Regarding this Shipment" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Notes From Customer</label>
                                                        <textarea cols="30" rows="5" name="Special_Notes"
                                                            placeholder="Enter Any Notes From Customer or Detail Regarding this Shipment" class="form-control"></textarea>
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
                                                                    <input type="hidden"
                                                                        value='{{ $row->My_Contract }}' />
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div> -->
                                                    <div class="form-group">
                                                        <label for="contractDropdown">Select Contract:</label>
                                                        <select id="contractDropdown"
                                                            class="form-control showmycontract"
                                                            onchange="updateTextareaAndLabel()">
                                                            @foreach ($MyContract as $key => $row)
                                                                <option value="{{ $row->My_Contract }}"
                                                                    data-contract-name="{{ $row->contractName }}">
                                                                    Contract:{{ $key + 1 }} -
                                                                    {{ $row->contractName }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        {{-- <input type="hidden" id="hiddenContract"
                                                            value='{{ $MyContract[0]->My_Contract }}' /> --}}
                                                        @if (!empty($MyContract) && isset($MyContract[0]->My_Contract))
                                                            <input type="hidden" class="hiddenContract"
                                                                value='{{ $MyContract[0]->My_Contract }}' />
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
                                                    <!-- <div class="form-group">
                                                    <label>Contract</label>
                                                    <textarea cols="30" rows="15" name="Listing_Contract" class="showcontent form-control">
                                                    @if (count($MyContract) > 0)
                                                    {{ $MyContract[0]->My_Contract }}
                                                    @endif
                                                    </textarea>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-box text-center">
                                        <button type="submit" class="submit-btn w-100"><i class='bx bx-save'></i>
                                            Assign Listing
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                {{-- @endif --}}
                {{-- @if (in_array('2', $listingAccess)) --}}
                    <div class="tab-pane fade p-3" id="heavy" role="tabpanel" aria-labelledby="heavy-tab">
                        <div class="card user-settings-box mb-30">
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <strong>
                                            {!! implode('<br/>', $errors->all('<span>:message</span>')) !!}
                                        </strong>
                                    </div>
                                @endif
                                <form class="was-validated" method="POST"
                                    action="{{ route('User.Direct.Dispatch.Create') }}" enctype="multipart/form-data">
                                    @csrf
                                    <h3><i class='bx bx-file'></i> New Quote For Heavy Equipment</h3>
                                    <h5 style="float: left;"><b>DAY DISPATCH ORDER:</b> #{{ $L_PID }}</h5><i
                                        class="fa-solid fa-circle-question" onclick="question()"></i>
                                    <div class="showalternativecode">This unique DD order id belongs to day dispatch,
                                        Create your custom order ID in the field below for a personalized experience.
                                    </div>
                                    <input hidden name="post_type" value="2">
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
                                                    placeholder="Order Booking Price" name="Custom_Date"
                                                    value="">
                                                <div class="invalid-feedback">
                                                    Select Custom Date.
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
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Terminal, Dealer, Auction</label>
                                                        {{-- <select class="custom-select Orig" name="Orign_Location">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="Location">Location</option>
                                                            <option value="Dealership">Dealership</option>
                                                            <option value="Auction">Auction</option>
                                                            <option value="Other">Other</option>
                                                        </select> --}}
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

                                                <div class="col-lg-6 orig-basic">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control" name="User_Name"
                                                            placeholder="Enter User Name" value=""
                                                            autocomplete="off">
                                                        <div class="invalid-feedback">
                                                            Enter UserName.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 orig-basic">
                                                    <div class="form-group">
                                                        <label>Email Address</label>
                                                        <input type="email" class="form-control" name="User_Email"
                                                            placeholder="Enter Email Address" value=""
                                                            autocomplete="off">
                                                        <div class="invalid-feedback">
                                                            Enter Email Address.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 orig-basic">
                                                    <div class="form-group">
                                                        <label>Phone Number</label>
                                                        <input type="text" class="form-control phone-number"
                                                            placeholder="Phone Number" name="Local_Phone"
                                                            value="">
                                                        <div class="invalid-feedback">
                                                            Enter Local Phone.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 orig-location">
                                                    <div class="form-group">
                                                        <label>Location Type</label>
                                                        <select class="custom-select" name="Location">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="Residence">Residence</option>
                                                            <option value="Business">Business</option>
                                                        </select>
                                                        <div class="invalid-feedback">Select Auction Type</div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 orig-auction">
                                                    <div class="form-group orig-auction-select-field">
                                                        <label>Auction Name</label>
                                                        <select class="custom-select" name="Auction_Method9">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="COP ART Auction">Copart Auction</option>
                                                            <option value="Mannheim Auction">Manheim Auction</option>
                                                            <option value="IAAI Auction">IAAI Auction</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                        <div class="invalid-feedback">Select Auction Type</div>
                                                    </div>
                                                    <div class="form-group orig-auction-input-field">
                                                        <label>Auction Name</label>
                                                        <input type="text" class="form-control"
                                                            name="Auction_Method11" placeholder="Enter Auction Name"
                                                            value="" autocomplete="off">
                                                        <div class="invalid-feedback">
                                                            Enter UserName.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 orig-auction">
                                                    <div class="form-group">
                                                        <label>Auction Phone</label>
                                                        <input type="text" class="form-control phone-number"
                                                            placeholder="Auction Phone Number" name="Auction_Phone"
                                                            value="">
                                                        <div class="invalid-feedback">
                                                            Enter Auction Phone.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 orig-auction">
                                                    <div class="form-group">
                                                        <label>Buyer/Lot/Stock Number</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Buyer/Lot/Stock Number" name="Stock_Number"
                                                            value="">
                                                        <div class="invalid-feedback">
                                                            Enter Stock Number.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 orig-dealership">
                                                    <div class="form-group">
                                                        <label>Dealership / Contact Person / Shop Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Dealership / Contact Person / Shop Name"
                                                            name="Auction_Method12" value="">
                                                        <div class="invalid-feedback">
                                                            Enter Auction Phone.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 orig-dealership">
                                                    <div class="form-group">
                                                        <label>Dealership Phone</label>
                                                        <input type="text" class="form-control phone-number"
                                                            placeholder="Auction Phone Number" name="Auction_Phone"
                                                            value="">
                                                        <div class="invalid-feedback">
                                                            Enter Auction Phone.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 orig-dealership">
                                                    <div class="form-group">
                                                        <label>Buyer/Lot/Stock Number</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Buyer/Lot/Stock Number" name="Stock_Number"
                                                            value="">
                                                        <div class="invalid-feedback">
                                                            Enter Stock Number.
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-6 shadow-sm p-3">
                                            <h4 class="text-white py-2 d-flex justify-content-center"
                                                style="background: #113771;">
                                                <i class="bi bi-hash mr-2"></i>DESTINATION LOCATION
                                            </h4>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Terminal, Dealer, Auction</label>
                                                        {{-- <select class="custom-select Dest"
                                                            name="Destination_Location">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="Location">Location</option>
                                                            <option value="Dealership">Dealership</option>
                                                            <option value="Port">Port</option>
                                                            <option value="Auction">Auction</option>
                                                            <option value="Other">Other</option>
                                                        </select> --}}
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

                                                <div class="col-lg-6 dest-basic">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control"
                                                            name="Dest_User_Name" placeholder="Enter User Name"
                                                            value="" autocomplete="off">
                                                        <div class="invalid-feedback">
                                                            Enter UserName.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 dest-basic">
                                                    <div class="form-group">
                                                        <label>Email Address</label>
                                                        <input type="email" class="form-control"
                                                            name="Dest_User_Email" placeholder="Enter Email Address"
                                                            value="" autocomplete="off">
                                                        <div class="invalid-feedback">
                                                            Enter Email Address.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 dest-basic">
                                                    <div class="form-group">
                                                        <label>Phone Number</label>
                                                        <input type="text" class="form-control phone-number"
                                                            placeholder="Phone Number" name="Dest_Local_Phone"
                                                            value="">
                                                        <div class="invalid-feedback">
                                                            Enter Local Phone.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 dest-location">
                                                    <div class="form-group">
                                                        <label>Location Type</label>
                                                        <select class="custom-select" name="Dest_Location">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="Residence">Residence</option>
                                                            <option value="Business">Business</option>
                                                        </select>
                                                        <div class="invalid-feedback">Select Auction Type</div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 dest-auction">
                                                    <div class="form-group dest-auction-select-field">
                                                        <label>Auction Name</label>
                                                        <select class="custom-select" name="Dest_Auction_Method6">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="COP ART Auction">Copart Auction</option>
                                                            <option value="Mannheim Auction">Manheim Auction</option>
                                                            <option value="IAAI Auction">IAAI Auction</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                        <div class="invalid-feedback">Select Auction Type</div>
                                                    </div>
                                                    <div class="form-group dest-auction-input-field">
                                                        <label>Auction Name</label>
                                                        <input type="text" class="form-control"
                                                            name="Dest_Auction_Method7"
                                                            placeholder="Enter Auction Name" value=""
                                                            autocomplete="off">
                                                        <div class="invalid-feedback">
                                                            Enter UserName.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 dest-auction">
                                                    <div class="form-group">
                                                        <label>Auction Phone</label>
                                                        <input type="text" class="form-control phone-number"
                                                            placeholder="Auction Phone Number"
                                                            name="Dest_Auction_Phone8" value="">
                                                        <div class="invalid-feedback">
                                                            Enter Auction Phone.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 dest-auction">
                                                    <div class="form-group">
                                                        <label>Buyer/Lot/Stock Number</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Buyer/Lot/Stock Number"
                                                            name="Dest_Stock_Number8" value="">
                                                        <div class="invalid-feedback">
                                                            Enter Stock Number.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 dest-dealership">
                                                    <div class="form-group">
                                                        <label>Dealership / Contact Person / Shop Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Dealership / Contact Person / Shop Name"
                                                            name="Dest_Auction_Method8" value="">
                                                        <div class="invalid-feedback">
                                                            Enter Auction Phone.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 dest-dealership">
                                                    <div class="form-group">
                                                        <label>Dealership Phone</label>
                                                        <input type="text" class="form-control phone-number"
                                                            placeholder="Auction Phone Number"
                                                            name="Dest_Auction_Phone9" value="">
                                                        <div class="invalid-feedback">
                                                            Enter Auction Phone.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 dest-dealership">
                                                    <div class="form-group">
                                                        <label>Buyer/Lot/Stock Number</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Buyer/Lot/Stock Number"
                                                            name="Dest_Stock_Number9" value="">
                                                        <div class="invalid-feedback">
                                                            Enter Stock Number.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 dest-port">
                                                    <div class="form-group">
                                                        <label>Port Type</label>
                                                        <select class="custom-select" name="Dest_Auction_Method9">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="Sea Port">Sea Port</option>
                                                            <option value="Airport">Airport</option>
                                                        </select>
                                                        <div class="invalid-feedback">Select Auction Type</div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 dest-port">
                                                    <div class="form-group">
                                                        <label>Port Phone</label>
                                                        <input type="text" class="form-control phone-number"
                                                            placeholder="Port Phone Number"
                                                            name="Dest_Auction_Phone11" value="">
                                                        <div class="invalid-feedback">
                                                            Enter Port Phone.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 dest-port">
                                                    <div class="form-group">
                                                        <label>Terminal</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Terminal" name="Dest_Stock_Number1"
                                                            value="">
                                                        <div class="invalid-feedback">
                                                            Enter Terminal.
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
                                                <i class="bi bi-hash mr-2"></i>ORIGIN ADDRESS
                                            </h4>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" class="form-control"
                                                            name="Origin_Address" placeholder="Enter Origin"
                                                            value="" autocomplete="off">
                                                        <div class="invalid-feedback">
                                                            Enter Origin.
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
                                                            Enter Origin 2.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Zip Code</label>
                                                        <input type="text"
                                                            class="form-control heavy_Origin_ZipCode typeahead"
                                                            name="Origin_ZipCode" placeholder="Enter ZipCode"
                                                            value="" required>
                                                        <div class="invalid-feedback">
                                                            Enter ZipCode.
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-6 shadow-sm p-3">
                                            <h4 class="text-white py-2 d-flex justify-content-center"
                                                style="background: #113771;">
                                                <i class="bi bi-hash mr-2"></i>DESTINATION ADDRESS
                                            </h4>
                                            <div class="row">

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" class="form-control"
                                                            name="Destination_Address"
                                                            placeholder="Enter Destination" value=""
                                                            autocomplete="off">
                                                        <div class="invalid-feedback">
                                                            Enter Destination.
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
                                                            Enter Destination 2.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Zip Code</label>
                                                        <input type="text"
                                                            class="form-control heavy_Dest_ZipCode typeahead"
                                                            name="Dest_ZipCode" placeholder="Enter ZipCode"
                                                            value="" required>
                                                        <div class="invalid-feedback">
                                                            Enter ZipCode.
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 shadow-sm p-3">
                                            {{-- <h5 class="text-center"><b>HEAVY EQUIPMENT INFORMATION</b></h5> --}}
                                            <h4 class="text-white py-2 d-flex justify-content-center"
                                                style="background: #113771;">
                                                <i class="bi bi-hash mr-2"></i>HEAVY EQUIPMENT INFORMATION
                                            </h4>

                                            <div class="heavy-vehcile-information">
                                                <div class="row">
                                                    <div class="col-lg-4"></div>
                                                    <div class="col-lg-4"></div>
                                                    <div class="col-lg-4 justify-content-end">
                                                        <div class="btn-box text-right">
                                                            <button type="button" id="add-heavy-vehicle"
                                                                class="btn btn-success"><i class='bx bx-add'></i>
                                                                Add Vehicle
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Year *</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Ex: 2022" name="Equipment_Year[]"
                                                                value="" required>
                                                            <div class="invalid-feedback">
                                                                Enter Year.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Make *</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Enter Make" name="Equipment_Make[]"
                                                                value="" required>
                                                            <div class="invalid-feedback">
                                                                Enter Make.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Model *</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Enter Model" name="Equipment_Model[]"
                                                                value="" required>
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
                                                            <input type="number" class="form-control"
                                                                placeholder="Enter Length" min="0"
                                                                name="Equip_Length[]" value="">
                                                            <div class="invalid-feedback">
                                                                Enter Length.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Width *</label>
                                                            <input type="number" class="form-control"
                                                                placeholder="Enter Width" min="0"
                                                                name="Equip_Width[]" value="">
                                                            <div class="invalid-feedback">
                                                                Enter Width.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Height *</label>
                                                            <input type="number" class="form-control"
                                                                placeholder="Enter Height" min="0"
                                                                name="Equip_Height[]" value="">
                                                            <div class="invalid-feedback">
                                                                Enter Height.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Weight *</label>
                                                            <input type="number" class="form-control"
                                                                placeholder="Enter Weight" min="0"
                                                                name="Equip_Weight[]" value="">
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
                                                            <select class="custom-select"
                                                                name="Equipment_Condition[]" required>
                                                                <option selected="" value="Running">Running
                                                                </option>
                                                                <option value="Not Running">Not Running</option>
                                                            </select>
                                                            <div class="invalid-feedback">Select Equipment Condition
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <div class="form-group ">
                                                            <label>Equipment Type</label>
                                                            <select class="custom-select"
                                                                data-placeholder="Equipment Type" 
                                                                name="Trailer_Type[]" required>
                                                                <option selected="" value="">Select
                                                                    Equipment
                                                                    Type</option>
                                                                <option>VAN (V)</option>
                                                                <option>REEFER (RE) </option>
                                                                <option>FLATBED (F)</option>
                                                                <option>Step Deck Trailer</option>
                                                                <option>REMOVABLE GOOSENECK (RGN) </option>
                                                                <option>CONESTOGA (CS)</option>
                                                                <option>TRUCK (T)</option>
                                                                <option>HAZMAT (hazardous materials)</option>
                                                                <option>POWER ONLY (PO)</option>
                                                                <option>HOT SHOT (HS)</option>
                                                                <option>LOWBOY (LB)</option>
                                                                <option>ENDUMP (ED)</option>
                                                                <option>LANDOLL (LD)</option>
                                                                <option>PARTIAL (PT)</option>
                                                                <option>20ft container</option>
                                                                <option>40ft container</option>
                                                                <option>48ft container</option>
                                                                <option>53ft container</option>
                                                            </select>

                                                            <div class="invalid-feedback">Select Any Equipment Type
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Trailer Specification</label>
                                                            <select class="custom-select"
                                                                data-placeholder="Trailer Specification" 
                                                                name="Trailer_Specification[]" required>
                                                                <option selected="" value="">Select Trailer
                                                                </option>
                                                                <option>Air Ride(A)</option>
                                                                <option>Blanket Wrap (B)</option>
                                                                <option>B-Train (BT)</option>
                                                                <option>Chain(CH)</option>
                                                                <option>Chassis (CS)</option>
                                                                <option>Conestoga(CO)</option>
                                                                <option>Curtain(C)</option>
                                                                <option>Double(2)</option>
                                                                <option>Extendable (E)</option>
                                                                <option>E-Track (ET)</option>
                                                                <option>Hazmat (Z)</option>
                                                                <option>Hot Shot (HS)</option>
                                                                <option>Insulated (N)</option>
                                                                <option>Lift Gate (LG)</option>
                                                                <option>Load Out (LO)</option>
                                                                <option>Load Ramp (LR)</option>
                                                                <option>Moving (MV)</option>
                                                                <option>Open Top (OT)</option>
                                                                <option>Oversized (O)</option>
                                                                <option>Pallet Exchange (X)</option>
                                                                <option>Side Kit (S)</option>
                                                                <option>Tarp(T)</option>
                                                                <option>Team Driver(M)</option>
                                                                <option>Temp Control (TC)</option>
                                                                <option>Triple (3)</option>
                                                                <option>Vented (V)</option>
                                                                <option>Walking Floor (WF)</option>
                                                            </select>


                                                            <!-- <select class="custom-select" multiple data-placeholder="Trailer Specification"  name="Trailer_Specification_Dry[]" required >-->
                                                            <!--    <option selected="" value="">Select Trailer</option>-->
                                                            <!--    <option>Air Ride(A)</option>-->
                                                            <!--    <option>Blanket Wrap (B)</option>-->
                                                            <!--    <option>B-Train (BT)</option>-->
                                                            <!--    <option>Chain(CH)</option>-->
                                                            <!--    <option>Chassis (CS)</option>-->
                                                            <!--    <option>Conestoga(CO)</option>-->
                                                            <!--    <option>Curtain(C)</option>-->
                                                            <!--    <option>Double(2)</option>-->
                                                            <!--    <option>Extendable (E)</option>-->
                                                            <!--    <option>E-Track (ET)</option>-->
                                                            <!--    <option>Hazmat (Z)</option>-->
                                                            <!--    <option>Hot Shot (HS)</option>-->
                                                            <!--    <option>Insulated (N)</option>-->
                                                            <!--    <option>Lift Gate (LG)</option>-->
                                                            <!--    <option>Load Out (LO)</option>-->
                                                            <!--    <option>Load Ramp (LR)</option>-->
                                                            <!--    <option>Moving (MV)</option>-->
                                                            <!--    <option>Open Top (OT)</option>-->
                                                            <!--    <option>Oversized (O)</option>-->
                                                            <!--    <option>Pallet Exchange (X)</option>-->
                                                            <!--    <option>Side Kit (S)</option>-->
                                                            <!--    <option>Tarp(T)</option>-->
                                                            <!--    <option>Team Driver(M)</option>-->
                                                            <!--    <option>Temp Control (TC)</option>-->
                                                            <!--    <option>Triple (3)</option>-->
                                                            <!--    <option>Vented (V)</option>-->
                                                            <!--    <option>Walking Floor (WF)</option>-->
                                                            <!--</select>-->

                                                            <div class="invalid-feedback">Select Any Trailer Type
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Shipment Preferences</label>
                                                            <select class="custom-select "
                                                                data-placeholder="Shipment Preferences"
                                                                name="Shipment_Preferences[]" required>
                                                                <option selected="" value="">Select
                                                                    Shipment
                                                                    Preferences
                                                                </option>
                                                                <option value="LTL">LTL (Less Than Truck Load)
                                                                </option>
                                                                <option value="FTL">FTL (Full Truck Load)</option>
                                                            </select>
                                                            <div class="invalid-feedback">Select Shipment Preferences
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div id="heavy-vehciles"></div>

                                            <div class="row">

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Additional Vehicle Information</label>
                                                        <textarea cols="30" rows="5" name="Vehcile_Desc" placeholder="Write something..."
                                                            class="form-control"></textarea>
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
                                            <div class="row DateParent">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Pickup Date</label>
                                                        <input type="date" class="form-control pick-date myDate"
                                                            placeholder="Pickup Date" name="Pickup_Date"
                                                            value="{{ date('Y-m-d') }}" required>
                                                        <div class="invalid-feedback">
                                                            Enter Pickup Date.
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-2">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input"
                                                                    id="heavy_customControlValidation777"
                                                                    name="PickUp_mode" value="Before" checked>
                                                                <label class="custom-control-label"
                                                                    for="heavy_customControlValidation777">Before</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="custom-control custom-radio mb-3">
                                                                <input type="radio" class="custom-control-input"
                                                                    id="heavy_customControlValidation888"
                                                                    name="PickUp_mode" value="After">
                                                                <label class="custom-control-label"
                                                                    for="heavy_customControlValidation888">After</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input"
                                                                    id="heavy_customControlValidation7777"
                                                                    name="PickUp_mode" value="On">
                                                                <label class="custom-control-label"
                                                                    for="heavy_customControlValidation7777">On</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="custom-control custom-radio mb-3">
                                                                <input type="radio" class="custom-control-input"
                                                                    id="heavy_customControlValidation8888"
                                                                    name="PickUp_mode" value="ASAP">
                                                                <label class="custom-control-label"
                                                                    for="heavy_customControlValidation8888">ASAP</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Delivery Date</label>
                                                        <input type="date"
                                                            class="form-control deliver-date seconddate"
                                                            placeholder="Delivery Date" name="Delivery_Date">
                                                        <div class="invalid-feedback">
                                                            Enter Delivery Date.
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-2">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input"
                                                                    id="heavy_customControlValidation77777"
                                                                    name="Delivery_mode" value="Before">
                                                                <label class="custom-control-label"
                                                                    for="heavy_customControlValidation77777">Before</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="custom-control custom-radio mb-3">
                                                                <input type="radio" class="custom-control-input"
                                                                    id="heavy_customControlValidation88888"
                                                                    name="Delivery_mode" value="After">
                                                                <label class="custom-control-label"
                                                                    for="heavy_customControlValidation88888">After</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input"
                                                                    id="heavy_customControlValidation77787"
                                                                    name="Delivery_mode" value="On">
                                                                <label class="custom-control-label"
                                                                    for="heavy_customControlValidation77787">On</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="custom-control custom-radio mb-3">
                                                                <input type="radio" class="custom-control-input"
                                                                    id="heavy_customControlValidation88788"
                                                                    name="Delivery_mode" value="ASAP" checked>
                                                                <label class="custom-control-label"
                                                                    for="heavy_customControlValidation88788">ASAP</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Pickup Date</label>
                                                        <input type="time" class="form-control pick-date"
                                                            placeholder="Pickup Time" name="Pickup_Time"
                                                            value="{{ date('Y-m-d') }}">
                                                        <div class="invalid-feedback">
                                                            Enter Pickup Time.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Pickup Date</label>
                                                        <input type="time" class="form-control pick-date"
                                                            placeholder="Pickup Time" name="Pickup_Time"
                                                            value="{{ date('Y-m-d') }}">
                                                        <div class="invalid-feedback">
                                                            Enter Pickup Time.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Delivery Time</label>
                                                        <input type="time" class="form-control deliver-time"
                                                            placeholder="Delivery Time" name="Delivery_Start_Time">
                                                        <div class="invalid-feedback">
                                                            Enter Delivery Time.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Delivery Time</label>
                                                        <input type="time" class="form-control deliver-time"
                                                            placeholder="Delivery Time" name="Delivery_End_Time">
                                                        <div class="invalid-feedback">
                                                            Enter Delivery Time.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-lg-2">
                                                    <button type="button" class="btn btn-danger compare-listing"
                                                        data-toggle="modal" data-target="#CompareListing">
                                                        <input hidden class="Listed-Type" value="2">
                                                        Price Insight
                                                    </button>
                                                </div>
                                                <div class="col-lg-2">
                                                    <a href="https://www.weather.gov/" target="_blank"
                                                        class="btn btn-success"> View Weather</a>
                                                </div>
                                                <div class="col-lg-2">
                                                    <a href="https://gasprices.aaa.com/" target="_blank"
                                                        class="btn btn-primary">
                                                        Fuel
                                                        Prices</a>
                                                </div>
                                            </div>
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
                                                        <label>Order Pricing</label>
                                                        <input type="number" class="form-control"
                                                            placeholder="Order Pricing" name="Booking_Price"
                                                            value="">
                                                        <div class="invalid-feedback">
                                                            Enter Booking Price.
                                                        </div>
                                                    </div>

                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="heavy_deposite_Check">
                                                        <label class="form-check-label"
                                                            for="heavy_deposite_Check">Deposit
                                                            Amount?</label>
                                                    </div>

                                                </div>
                                                <div class="col-lg-3 deposite-box">
                                                    <div class="form-group">
                                                        <label>Deposit Amount *</label>
                                                        <input type="number" class="form-control"
                                                            placeholder="Deposite Amount" name="Deposite_Amount"
                                                            value="">
                                                        <div class="invalid-feedback">
                                                            Enter Deposit Amount.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Pay To Carrier</label>
                                                        <input type="number" class="form-control Price-Pay"
                                                            placeholder="Pay To Carrier" name="Price_Pay"
                                                            value="" required>
                                                        <div class="invalid-feedback">
                                                            Enter Price Pay Amount.
                                                        </div>
                                                    </div>
                                                    {{-- <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input"
                                                                    id="heavy_customControlValidation77"
                                                                    name="Payment_Mode" value="COD" checked>
                                                                <label class="custom-control-label"
                                                                    for="heavy_customControlValidation77">COD</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="custom-control custom-radio mb-3">
                                                                <input type="radio" class="custom-control-input"
                                                                    id="heavy_customControlValidation88"
                                                                    name="Payment_Mode" value="Quick Pay">
                                                                <label class="custom-control-label"
                                                                    for="heavy_customControlValidation88">Quick
                                                                    Pay</label>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>COD/COP Amount</label>
                                                        <input type="number" class="form-control COD_Amount"
                                                            placeholder="COD / COP Amount" name="COD_Amount"
                                                            value="" required>
                                                        <div class="invalid-feedback">
                                                            Enter COD/COP Amount.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Balance Amount</label>
                                                        <input readonly type="number"
                                                            class="form-control Balance-Amount"
                                                            placeholder="Balanced Amount" name="Bal_Amount"
                                                            value="" required>
                                                        <div class="invalid-feedback">
                                                            Enter Balance Amount.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 cod-inputs">
                                                    <div class="form-group">
                                                        <label>COD/COP Payment Method *</label>
                                                        <select class="custom-select COD_Payment_Mode"
                                                            name="COD_Payment_Mode">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="Cash">Cash</option>
                                                            <option value="Company Check">Company Check</option>
                                                            <option value="Certified Funds">Certified Funds</option>
                                                            <option value="Comcheck">Comcheck</option>
                                                            <option value="TCH">TCH</option>
                                                        </select>
                                                        <div class="invalid-feedback">Select AnyOne</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 cod-inputs">
                                                    <div class="form-group">
                                                        <label>COD/COP Location *</label>
                                                        <select class="custom-select Location_Mode"
                                                            name="Location_Mode">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="PickUp">PickUp</option>
                                                            <option value="Delivery">Delivery</option>
                                                        </select>
                                                        <div class="invalid-feedback">Select AnyOne</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 balance-inputs">
                                                    <div class="form-group">
                                                        <label>Balance Payment Method *</label>
                                                        <select class="custom-select Balance_Payment_Mode"
                                                            name="Balance_Payment_Mode">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="Cash">Cash</option>
                                                            <option value="Company Check">Company Check</option>
                                                            <option value="Certified Funds">Certified Funds</option>
                                                            <option value="Comcheck">Comcheck</option>
                                                            <option value="TCH">TCH</option>
                                                        </select>
                                                        <div class="invalid-feedback">Select AnyOne</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 balance-inputs">
                                                    <div class="form-group">
                                                        <label>Balance Payment Time *</label>
                                                        <select class="custom-select Bal_Payment_Time"
                                                            name="Bal_Payment_Time">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="Immediately">Immediately</option>
                                                            <option value="2 Business Days (Quick Pay)">2 Business
                                                                Days
                                                                (Quick
                                                                Pay)
                                                            </option>
                                                            <option value="5 Business Days">5 Business Days</option>
                                                            <option value="10 Business Days">10 Business Days</option>
                                                            <option value="15 Business Days">15 Business Days</option>
                                                            <option value="30 Business Days">30 Business Days</option>
                                                        </select>
                                                        <div class="invalid-feedback">Select AnyOne</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 balance-inputs">
                                                    <div class="form-group">
                                                        <label>Balance Payment Terms Begin On *</label>
                                                        <select class="custom-select" name="Payment_Terms">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="PickUp">PickUp</option>
                                                            <option value="Delivery">Delivery</option>
                                                            <option value="Receiving a Sign Bill Of Lading">Receiving
                                                                a
                                                                Sign
                                                                Bill Of Lading
                                                            </option>
                                                        </select>
                                                        <div class="invalid-feedback">Select AnyOne</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Additional Vehicle Information</label>
                                                        <textarea cols="30" rows="5" name="Desc_For_Vehcile" placeholder="Write something..."
                                                            class="form-control"></textarea>
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
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 shadow-sm p-3">
                                            {{-- <h5 class="text-center"><b>Additional Information</b></h5> --}}
                                            <h4 class="text-white py-2 d-flex justify-content-center"
                                                style="background: #113771;">
                                                <i class="bi bi-hash mr-2"></i>Additional Information
                                            </h4>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Order ID</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Dispatch ID" name="Ref_ID"
                                                            value="" required>
                                                        <div class="invalid-feedback">
                                                            Enter Order ID.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <label>Upload Any Vehcile Images</label>
                                                    <div class="input-group mb-3">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                name="Vehcile_Images[]" id="image-upload-second"
                                                                accept="image/*" multiple>
                                                            <label class="custom-file-label">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div id="image-preview-second" class="displayimages row"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Additional Terms</label>
                                                        <textarea cols="30" rows="5" name="Additional_Terms" placeholder="Enter Additional Terms"
                                                            class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            {{-- </div>
                                            <div class="row"> --}}
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Special Instructions</label>
                                                        <textarea cols="30" rows="5" name="Special_Terms"
                                                            placeholder="Enter Any Special Instructions Regarding this Shipment" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            {{-- </div>
                                            <div class="row"> --}}
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Notes From Customer</label>
                                                        <textarea cols="30" rows="5" name="Special_Notes"
                                                            placeholder="Enter Any Notes From Customer or Detail Regarding this Shipment" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="row">
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
                                                                    <input type="hidden"
                                                                        value='{{ $row->My_Contract }}' />
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-box text-center">
                                        <button type="submit" class="submit-btn w-100"><i class='bx bx-save'></i>
                                            Assign Listing
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                {{-- @endif --}}
                {{-- @if (in_array('3', $listingAccess)) --}}
                    <div class="tab-pane fade p-3" id="dry" role="tabpanel" aria-labelledby="dry-tab">
                        <div class="card user-settings-box mb-30">
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <strong>
                                            {!! implode('<br/>', $errors->all('<span>:message</span>')) !!}
                                        </strong>
                                    </div>
                                @endif
                                <form class="was-validated" method="POST"
                                    action="{{ route('User.Direct.Dispatch.Create') }}" enctype="multipart/form-data">
                                    @csrf
                                    <h3><i class='bx bx-file'></i> New Quote For Freight Shipping</h3>
                                    <h5 style="float: left;"><b>DAY DISPATCH ORDER:</b> #{{ $L_PID }}</h5><i
                                        class="fa-solid fa-circle-question" onclick="question()"></i>
                                    <div class="showalternativecode">This unique DD order id belongs to day dispatch,
                                        Create your custom order ID in the field below for a personalized experience.
                                    </div>
                                    <input hidden name="post_type" value="3">
                                    <div class="row mt-4">
                                        <div class="col-lg-4">
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input"
                                                    name="Custom_Listing" value="1" id="custom_Check">
                                                <label class="form-check-label" for="custom_Check">Custom
                                                    Listing</label>
                                            </div>
                                            <div class="form-group Custom-Date">
                                                <label>Posted Date</label>
                                                <input type="date" class="form-control"
                                                    placeholder="Order Booking Price" name="Custom_Date"
                                                    value="">
                                                <div class="invalid-feedback">
                                                    Select Custom Date.
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
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Terminal, Dealer, Auction</label>
                                                        {{-- <select class="custom-select Orig" name="Orign_Location">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="Location">Location</option>
                                                            <option value="Dealership">Dealership</option>
                                                            <option value="Auction">Auction</option>
                                                            <option value="Other">Other</option>
                                                        </select> --}}
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

                                                <div class="col-lg-6 orig-basic">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control"
                                                            name="User_Name" placeholder="Enter User Name"
                                                            value="" autocomplete="off">
                                                        <div class="invalid-feedback">
                                                            Enter UserName.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 orig-basic">
                                                    <div class="form-group">
                                                        <label>Email Address</label>
                                                        <input type="email" class="form-control"
                                                            name="User_Email" placeholder="Enter Email Address"
                                                            value="" autocomplete="off">
                                                        <div class="invalid-feedback">
                                                            Enter Email Address.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 orig-basic">
                                                    <div class="form-group">
                                                        <label>Phone Number</label>
                                                        <input type="text" class="form-control phone-number"
                                                            placeholder="Phone Number" name="Local_Phone"
                                                            value="">
                                                        <div class="invalid-feedback">
                                                            Enter Local Phone.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 orig-location">
                                                    <div class="form-group">
                                                        <label>Location Type</label>
                                                        <select class="custom-select" name="Location">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="Residence">Residence</option>
                                                            <option value="Business">Business</option>
                                                        </select>
                                                        <div class="invalid-feedback">Select Auction Type</div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 orig-auction">
                                                    <div class="form-group orig-auction-select-field">
                                                        <label>Auction Name</label>
                                                        <select class="custom-select" name="Auction_Method16">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="COP ART Auction">Copart Auction</option>
                                                            <option value="Mannheim Auction">Manheim Auction</option>
                                                            <option value="IAAI Auction">IAAI Auction</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                        <div class="invalid-feedback">Select Auction Type</div>
                                                    </div>
                                                    <div class="form-group orig-auction-input-field">
                                                        <label>Auction Name</label>
                                                        <input type="text" class="form-control"
                                                            name="Auction_Method17" placeholder="Enter Auction Name"
                                                            value="" autocomplete="off">
                                                        <div class="invalid-feedback">
                                                            Enter UserName.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 orig-auction">
                                                    <div class="form-group">
                                                        <label>Auction Phone</label>
                                                        <input type="text" class="form-control phone-number"
                                                            placeholder="Auction Phone Number" name="Auction_Phone"
                                                            value="">
                                                        <div class="invalid-feedback">
                                                            Enter Auction Phone.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 orig-auction">
                                                    <div class="form-group">
                                                        <label>Buyer/Lot/Stock Number</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Buyer/Lot/Stock Number" name="Stock_Number"
                                                            value="">
                                                        <div class="invalid-feedback">
                                                            Enter Stock Number.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 orig-dealership">
                                                    <div class="form-group">
                                                        <label>Dealership / Contact Person / Shop Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Dealership / Contact Person / Shop Name"
                                                            name="Auction_Method18" value="">
                                                        <div class="invalid-feedback">
                                                            Enter Auction Phone.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 orig-dealership">
                                                    <div class="form-group">
                                                        <label>Dealership Phone</label>
                                                        <input type="text" class="form-control phone-number"
                                                            placeholder="Auction Phone Number" name="Auction_Phone"
                                                            value="">
                                                        <div class="invalid-feedback">
                                                            Enter Auction Phone.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 orig-dealership">
                                                    <div class="form-group">
                                                        <label>Buyer/Lot/Stock Number</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Buyer/Lot/Stock Number" name="Stock_Number"
                                                            value="">
                                                        <div class="invalid-feedback">
                                                            Enter Stock Number.
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-6 shadow-sm p-3">
                                            <h4 class="text-white py-2 d-flex justify-content-center"
                                                style="background: #113771;">
                                                <i class="bi bi-hash mr-2"></i>DESTINATION LOCATION
                                            </h4>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Terminal, Dealer, Auction</label>
                                                        {{-- <select class="custom-select Dest"
                                                            name="Destination_Location">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="Location">Location</option>
                                                            <option value="Dealership">Dealership</option>
                                                            <option value="Port">Port</option>
                                                            <option value="Auction">Auction</option>
                                                            <option value="Other">Other</option>
                                                        </select> --}}
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

                                                <div class="col-lg-6 dest-basic">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control"
                                                            name="Dest_User_Name" placeholder="Enter User Name"
                                                            value="" autocomplete="off">
                                                        <div class="invalid-feedback">
                                                            Enter UserName.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 dest-basic">
                                                    <div class="form-group">
                                                        <label>Email Address</label>
                                                        <input type="email" class="form-control"
                                                            name="Dest_User_Email" placeholder="Enter Email Address"
                                                            value="" autocomplete="off">
                                                        <div class="invalid-feedback">
                                                            Enter Email Address.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 dest-basic">
                                                    <div class="form-group">
                                                        <label>Phone Number</label>
                                                        <input type="text" class="form-control phone-number"
                                                            placeholder="Phone Number" name="Dest_Local_Phone"
                                                            value="">
                                                        <div class="invalid-feedback">
                                                            Enter Local Phone.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 dest-location">
                                                    <div class="form-group">
                                                        <label>Location Type</label>
                                                        <select class="custom-select" name="Dest_Location">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="Residence">Residence</option>
                                                            <option value="Business">Business</option>
                                                        </select>
                                                        <div class="invalid-feedback">Select Auction Type</div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 dest-auction">
                                                    <div class="form-group dest-auction-select-field">
                                                        <label>Auction Name</label>
                                                        <select class="custom-select" name="Dest_Auction_Method10">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="COP ART Auction">Copart Auction</option>
                                                            <option value="Mannheim Auction">Manheim Auction</option>
                                                            <option value="IAAI Auction">IAAI Auction</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                        <div class="invalid-feedback">Select Auction Type</div>
                                                    </div>
                                                    <div class="form-group dest-auction-input-field">
                                                        <label>Auction Name</label>
                                                        <input type="text" class="form-control"
                                                            name="Dest_Auction_Method11"
                                                            placeholder="Enter Auction Name" value=""
                                                            autocomplete="off">
                                                        <div class="invalid-feedback">
                                                            Enter UserName.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 dest-auction">
                                                    <div class="form-group">
                                                        <label>Auction Phone</label>
                                                        <input type="text" class="form-control phone-number"
                                                            placeholder="Auction Phone Number"
                                                            name="Dest_Auction_Phone12" value="">
                                                        <div class="invalid-feedback">
                                                            Enter Auction Phone.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 dest-auction">
                                                    <div class="form-group">
                                                        <label>Buyer/Lot/Stock Number</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Buyer/Lot/Stock Number"
                                                            name="Dest_Stock_Number2" value="">
                                                        <div class="invalid-feedback">
                                                            Enter Stock Number.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 dest-dealership">
                                                    <div class="form-group">
                                                        <label>Dealership / Contact Person / Shop Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Dealership / Contact Person / Shop Name"
                                                            name="Dest_Auction_Method12" value="">
                                                        <div class="invalid-feedback">
                                                            Enter Auction Phone.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 dest-dealership">
                                                    <div class="form-group">
                                                        <label>Dealership Phone</label>
                                                        <input type="text" class="form-control phone-number"
                                                            placeholder="Auction Phone Number"
                                                            name="Dest_Auction_Phone13" value="">
                                                        <div class="invalid-feedback">
                                                            Enter Auction Phone.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 dest-dealership">
                                                    <div class="form-group">
                                                        <label>Buyer/Lot/Stock Number</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Buyer/Lot/Stock Number"
                                                            name="Dest_Stock_Number3" value="">
                                                        <div class="invalid-feedback">
                                                            Enter Stock Number.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 dest-port">
                                                    <div class="form-group">
                                                        <label>Port Type</label>
                                                        <select class="custom-select" name="Dest_Auction_Method13">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="Sea Port">Sea Port</option>
                                                            <option value="Airport">Airport</option>
                                                        </select>
                                                        <div class="invalid-feedback">Select Auction Type</div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 dest-port">
                                                    <div class="form-group">
                                                        <label>Port Phone</label>
                                                        <input type="text" class="form-control phone-number"
                                                            placeholder="Port Phone Number"
                                                            name="Dest_Auction_Phone14" value="">
                                                        <div class="invalid-feedback">
                                                            Enter Port Phone.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 dest-port">
                                                    <div class="form-group">
                                                        <label>Terminal</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Terminal" name="Dest_Stock_Number4"
                                                            value="">
                                                        <div class="invalid-feedback">
                                                            Enter Terminal.
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
                                                <i class="bi bi-hash mr-2"></i>ORIGIN ADDRESS
                                            </h4>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" class="form-control"
                                                            name="Origin_Address" placeholder="Enter Origin"
                                                            value="" autocomplete="off">
                                                        <div class="invalid-feedback">
                                                            Enter Origin.
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
                                                            Enter Origin 2.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Zip Code</label>
                                                        <input type="text"
                                                            class="form-control dry_Origin_ZipCode typeahead"
                                                            name="Origin_ZipCode" placeholder="Enter ZipCode"
                                                            value="" required>
                                                        <div class="invalid-feedback">
                                                            Enter ZipCode.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 shadow-sm p-3">
                                            <h4 class="text-white py-2 d-flex justify-content-center"
                                                style="background: #113771;">
                                                <i class="bi bi-hash mr-2"></i>DESTINATION ADDRESS
                                            </h4>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" class="form-control"
                                                            name="Destination_Address"
                                                            placeholder="Enter Destination" value=""
                                                            autocomplete="off">
                                                        <div class="invalid-feedback">
                                                            Enter Destination.
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
                                                            Enter Destination 2.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Zip Code</label>
                                                        <input type="text"
                                                            class="form-control dry_Dest_ZipCode typeahead"
                                                            name="Dest_ZipCode" placeholder="Enter ZipCode"
                                                            value="" required>
                                                        <div class="invalid-feedback">
                                                            Enter ZipCode.
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 shadow-sm p-3">
                                            <h4 class="text-white py-2 d-flex justify-content-center"
                                                style="background: #113771;">
                                                <i class="bi bi-hash mr-2"></i>Post Freight Load
                                            </h4>
                                            <div class="dry-van-information">
                                                <div class="row mb-3">
                                                    <div class="col-lg-4">
                                                        <div class="btn-box text-left">
                                                            <a href="{{ route('Freight.Calculate') }}"
                                                                target="_blank" class="btn btn-warning"><i
                                                                    class='bx bx-calculator'></i>
                                                                Calculate Freight Class
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4"></div>
                                                    <div class="col-lg-4 justify-content-end">
                                                        <div class="btn-box text-right">
                                                            <button type="button" id="add-dry-van"
                                                                class="btn btn-success"><i class='bx bx-add'></i>
                                                                Add Another Shipment
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Freight Class *</label>
                                                            <select class="custom-select" name="Freight_Class[]"
                                                                required>
                                                                <option selected="" value="">Select Class
                                                                </option>
                                                                <option value="500">500</option>
                                                                <option value="400">400</option>
                                                                <option value="300">300</option>
                                                                <option value="250">250</option>
                                                                <option value="200">200</option>
                                                                <option value="175">175</option>
                                                                <option value="150">150</option>
                                                                <option value="125">125</option>
                                                                <option value="110">110</option>
                                                                <option value="100">100</option>
                                                                <option value="92.5">92.5</option>
                                                                <option value="85">85</option>
                                                                <option value="77.5">77.5</option>
                                                                <option value="70">70</option>
                                                                <option value="65">65</option>
                                                                <option value="60">60</option>
                                                                <option value="55">55</option>
                                                                <option value="50">50</option>
                                                            </select>
                                                            <div class="invalid-feedback">Select Any Class</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Freight Weight *</label>
                                                            <input type="number" class="form-control"
                                                                placeholder="Enter Weight" min="0"
                                                                name="Freight_Weight[]" required>
                                                            <div class="invalid-feedback">
                                                                Enter Weight.
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group ">
                                                            <label>Trailer Specification</label>
                                                            <select class="custom-select" 
                                                                data-placeholder="Trailer Specification"
                                                                name="Trailer_Specification_Dry[]" required>
                                                                <option selected="" value="">Select Trailer
                                                                </option>
                                                                <option>Air Ride(A)</option>
                                                                <option>Blanket Wrap (B)</option>
                                                                <option>B-Train (BT)</option>
                                                                <option>Chain(CH)</option>
                                                                <option>Chassis (CS)</option>
                                                                <option>Conestoga(CO)</option>
                                                                <option>Curtain(C)</option>
                                                                <option>Double(2)</option>
                                                                <option>Extendable (E)</option>
                                                                <option>E-Track (ET)</option>
                                                                <option>Hazmat (Z)</option>
                                                                <option>Hot Shot (HS)</option>
                                                                <option>Insulated (N)</option>
                                                                <option>Lift Gate (LG)</option>
                                                                <option>Load Out (LO)</option>
                                                                <option>Load Ramp (LR)</option>
                                                                <option>Moving (MV)</option>
                                                                <option>Open Top (OT)</option>
                                                                <option>Oversized (O)</option>
                                                                <option>Pallet Exchange (X)</option>
                                                                <option>Side Kit (S)</option>
                                                                <option>Tarp(T)</option>
                                                                <option>Team Driver(M)</option>
                                                                <option>Temp Control (TC)</option>
                                                                <option>Triple (3)</option>
                                                                <option>Vented (V)</option>
                                                                <option>Walking Floor (WF)</option>
                                                            </select>

                                                            <div class="invalid-feedback">Select Any Trailer Type
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group ">
                                                        <label>Trailer Specification</label>
                                                            <select class="custom-select" 
                                                                data-placeholder="Select Trailer"
                                                                name="Trailer_Type_Dry[]" required>
                                                                <option value="VAN">VAN</option>
                                                                <option value="REEFER">REEFER</option>
                                                                <option value="FLATBED">FLATBED</option>
                                                                <option value="STEP OR DROP DECK">STEP OR DROP DECK
                                                                </option>
                                                                <option value="REMOVABLE GOOSENECK (RGN)">REMOVABLE
                                                                    GOOSENECK (RGN)</option>
                                                                <option value="CONESTOGA">CONESTOGA</option>
                                                                <option value="CONTAINER / DRAYAGE">CONTAINER /
                                                                    DRAYAGE</option>
                                                                <option value="STRAIGHT TRUCK / BOX TRUCK /SPRINTER">
                                                                    STRAIGHT TRUCK / BOX TRUCK /SPRINTER</option>
                                                                <option value="HAZMAT">HAZMAT</option>
                                                                <option value="POWER ONLY">POWER ONLY</option>
                                                                <option value="HOT SHOT">HOT SHOT</option>
                                                                <option value="LOWBOY">LOWBOY</option>
                                                                <option value="ENDUMP">ENDUMP</option>
                                                                <option value="LANDOLL">LANDOLL</option>
                                                                <option value="PARTIAL">PARTIAL</option>
                                                                <option value="20ft container">20ft container</option>
                                                                <option value="48ft container">48ft container</option>
                                                                <option value="53ft container">53ft container</option>
                                                            </select>
                                                            <!--<div class="invalid-feedback">Select Any Equipment Type</div>-->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Shipment Preferences</label>
                                                            <select class="custom-select"
                                                                name="Shipment_Preferences[]">
                                                                <option selected="" value="">Select
                                                                    Shipment
                                                                    Preferences
                                                                </option>
                                                                <option value="LTL">LTL (Less Than Truck Load)
                                                                </option>
                                                                <option value="FTL">FTL (Full Truck Load)</option>
                                                            </select>
                                                            <div class="invalid-feedback">Select Shipment Preferences
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label>Specify No. Unit/Pallet</label>
                                                        <div class="d-flex" style="margin-top: -23px;">
                                                            <input style="margin-top: 20px;" type="text"
                                                                class="form-control"
                                                                placeholder="Specify No. Unit/Pallet" value=""
                                                                autocomplete="off">
                                                            <i data-toggle="modal" data-target="#showpallet"
                                                                class="fa-solid fa-circle-info"
                                                                style="margin-top: 29px; margin-left: 8px; color: #1e2d62; font-size: 18px; cursor: pointer;"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group form-check"
                                                            style="margin-top: 40px;">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="hazmat_Check" name="is_hazmat_Check[]"
                                                                value="1">
                                                            <label class="form-check-label"
                                                                for="hazmat_Check">Hazmat?</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="dry-vans"></div>
                                            <strong class="mb-2">Pickup Services</strong>
                                            <div class="row px-5">
                                                <div class="col-lg-4">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox"
                                                            class="form-check-input Pickup_Service"
                                                            id="construction_utility" name="Pickup_Service[]"
                                                            value="Construction / Utility">
                                                        <label class="form-check-label"
                                                            for="construction_utility">Construction / Utility</label>
                                                    </div>
                                                    <div class="form-group form-check">
                                                        <input type="checkbox"
                                                            class="form-check-input Pickup_Service"
                                                            id="container_station" name="Pickup_Service[]"
                                                            value="Container Station">
                                                        <label class="form-check-label"
                                                            for="container_station">Container Station</label>
                                                    </div>
                                                    <div class="form-group form-check">
                                                        <input type="checkbox"
                                                            class="form-check-input Pickup_Service" id="exhibition"
                                                            name="Pickup_Service[]" value="Exhibition">
                                                        <label class="form-check-label"
                                                            for="exhibition">Exhibition</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox"
                                                            class="form-check-input Pickup_Service"
                                                            id="inside_pickup" name="Pickup_Service[]"
                                                            value="Inside Pickup">
                                                        <label class="form-check-label" for="inside_pickup">Inside
                                                            Pickup</label>
                                                    </div>
                                                    <div class="form-group form-check">
                                                        <input type="checkbox"
                                                            class="form-check-input Pickup_Service"
                                                            id="lift_gate_service" name="Pickup_Service[]"
                                                            value="Lift Gate Service">
                                                        <label class="form-check-label" for="lift_gate_service">Lift
                                                            Gate Service</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox"
                                                            class="form-check-input Pickup_Service" id="residential"
                                                            name="Pickup_Service[]" value="Residential">
                                                        <label class="form-check-label"
                                                            for="residential">Residential</label>
                                                    </div>
                                                    <div class="form-group form-check">
                                                        <input type="checkbox"
                                                            class="form-check-input Pickup_Service"
                                                            id="single_shipment" name="Pickup_Service[]"
                                                            value="Single Shipment">
                                                        <label class="form-check-label" for="single_shipment">Single
                                                            Shipment</label>
                                                    </div>
                                                    <div class="form-group form-check">
                                                        <input type="checkbox"
                                                            class="form-check-input Pickup_Service"
                                                            id="sorting_segregation" name="Pickup_Service[]"
                                                            value="Sorting / Segregation">
                                                        <label class="form-check-label"
                                                            for="sorting_segregation">Sorting / Segregation</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <strong class="mb-2">Delivery Services</strong>
                                            <div class="row px-5">
                                                <div class="col-lg-4">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox"
                                                            class="form-check-input Delivery_Service"
                                                            id="business_hours_delivery" name="Delivery_Service[]"
                                                            value="After Business Hours Delivery">
                                                        <label class="form-check-label"
                                                            for="business_hours_delivery">After Business Hours
                                                            Delivery</label>
                                                    </div>
                                                    <div class="form-group form-check">
                                                        <input type="checkbox"
                                                            class="form-check-input Delivery_Service"
                                                            id="del_construction_utility" name="Delivery_Service[]"
                                                            value="Construction / Utility">
                                                        <label class="form-check-label"
                                                            for="del_construction_utility">Construction /
                                                            Utility</label>
                                                    </div>
                                                    <div class="form-group form-check">
                                                        <input type="checkbox"
                                                            class="form-check-input Delivery_Service"
                                                            id="appointment" name="Delivery_Service[]"
                                                            value="Appointment">
                                                        <label class="form-check-label"
                                                            for="appointment">Appointment</label>
                                                    </div>
                                                    <div class="form-group form-check">
                                                        <input type="checkbox"
                                                            class="form-check-input Delivery_Service"
                                                            id="del_container_station" name="Delivery_Service[]"
                                                            value="Container Station">
                                                        <label class="form-check-label"
                                                            for="del_container_station">Container Station</label>
                                                    </div>
                                                    <div class="form-group form-check">
                                                        <input type="checkbox"
                                                            class="form-check-input Delivery_Service"
                                                            id="del_exhibition" name="Delivery_Service[]"
                                                            value="Exhibition">
                                                        <label class="form-check-label"
                                                            for="del_exhibition">Exhibition</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox"
                                                            class="form-check-input Delivery_Service"
                                                            id="inbond_freight" name="Delivery_Service[]"
                                                            value="In Bond Freight">
                                                        <label class="form-check-label" for="inbond_freight">In Bond
                                                            Freight</label>
                                                    </div>
                                                    <div class="form-group form-check">
                                                        <input type="checkbox"
                                                            class="form-check-input Delivery_Service"
                                                            id="inbond_TIR_Carnet" name="Delivery_Service[]"
                                                            value="In Bond TIR Caret">
                                                        <label class="form-check-label" for="inbond_TIR_Carnet">In
                                                            Bond
                                                            TIR Caret</label>
                                                    </div>
                                                    <div class="form-group form-check">
                                                        <input type="checkbox"
                                                            class="form-check-input Delivery_Service"
                                                            id="inside_same_level_as" name="Delivery_Service[]"
                                                            value="Inside - Same Level as Delivery Vehicle">
                                                        <label class="form-check-label"
                                                            for="inside_same_level_as">Inside - Same Level as Delivery
                                                            Vehicle</label>
                                                    </div>
                                                    <div class="form-group form-check">
                                                        <input type="checkbox"
                                                            class="form-check-input Delivery_Service"
                                                            id="del_lift_gate_service" name="Delivery_Service[]"
                                                            value="Lift Gate Service">
                                                        <label class="form-check-label"
                                                            for="del_lift_gate_service">Lift
                                                            Gate Service</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox"
                                                            class="form-check-input Delivery_Service"
                                                            id="del_residential" name="Delivery_Service[]"
                                                            value="Residential">
                                                        <label class="form-check-label"
                                                            for="del_residential">Residential</label>
                                                    </div>
                                                    <div class="form-group form-check">
                                                        <input type="checkbox"
                                                            class="form-check-input Delivery_Service"
                                                            id="Mine_Govt_Airport" name="Delivery_Service[]"
                                                            value="Mine / Govt / Airport">
                                                        <label class="form-check-label" for="Mine_Govt_Airport">Mine
                                                            /
                                                            Govt / Airport</label>
                                                    </div>
                                                    <div class="form-group form-check">
                                                        <input type="checkbox"
                                                            class="form-check-input Delivery_Service"
                                                            id="Notification_segregation" name="Delivery_Service[]"
                                                            value="Notification Prior Delivery">
                                                        <label class="form-check-label"
                                                            for="Notification_segregation">Notification Prior
                                                            Delivery</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Additional Vehicle Information</label>
                                                        <textarea cols="30" rows="5" name="Vehcile_Desc" placeholder="Write something..."
                                                            class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row DateParent">
                                        <div class="col-lg-12 shadow-sm p-3">
                                            <h4 class="text-white py-2 d-flex justify-content-center"
                                                style="background: #113771;">
                                                <i class="bi bi-hash mr-2"></i>VEHICLE PICKUP INFORMATION
                                            </h4>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Pickup Date</label>
                                                        <input type="date" class="form-control pick-date myDate"
                                                            placeholder="Pickup Date" name="Pickup_Date"
                                                            value="{{ date('Y-m-d') }}" required>
                                                        <div class="invalid-feedback">
                                                            Enter Pickup Date.
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-2">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input "
                                                                    id="dry_customControlValidation777"
                                                                    name="PickUp_mode" value="Before" checked>
                                                                <label class="custom-control-label"
                                                                    for="dry_customControlValidation777">Before</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="custom-control custom-radio mb-3">
                                                                <input type="radio" class="custom-control-input"
                                                                    id="dry_customControlValidation888"
                                                                    name="PickUp_mode" value="After">
                                                                <label class="custom-control-label"
                                                                    for="dry_customControlValidation888">After</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input"
                                                                    id="dry_customControlValidation7777"
                                                                    name="PickUp_mode" value="On">
                                                                <label class="custom-control-label"
                                                                    for="dry_customControlValidation7777">On</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="custom-control custom-radio mb-3">
                                                                <input type="radio" class="custom-control-input"
                                                                    id="dry_customControlValidation8888"
                                                                    name="PickUp_mode" value="ASAP">
                                                                <label class="custom-control-label"
                                                                    for="dry_customControlValidation8888">ASAP</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Delivery Date</label>
                                                        <input type="date"
                                                            class="form-control deliver-date seconddate"
                                                            placeholder="Delivery Date" name="Delivery_Date">
                                                        <div class="invalid-feedback">
                                                            Enter Delivery Date.
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-2">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input"
                                                                    id="dry_customControlValidation77777"
                                                                    name="Delivery_mode" value="Before">
                                                                <label class="custom-control-label"
                                                                    for="dry_customControlValidation77777">Before</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="custom-control custom-radio mb-3">
                                                                <input type="radio" class="custom-control-input"
                                                                    id="dry_customControlValidation88888"
                                                                    name="Delivery_mode" value="After">
                                                                <label class="custom-control-label"
                                                                    for="dry_customControlValidation88888">After</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input"
                                                                    id="dry_customControlValidation77787"
                                                                    name="Delivery_mode" value="On">
                                                                <label class="custom-control-label"
                                                                    for="dry_customControlValidation77787">On</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="custom-control custom-radio mb-3">
                                                                <input type="radio" class="custom-control-input"
                                                                    id="dry_customControlValidation88788"
                                                                    name="Delivery_mode" value="ASAP" checked>
                                                                <label class="custom-control-label"
                                                                    for="dry_customControlValidation88788">ASAP</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Pickup Date</label>
                                                        <input type="time" class="form-control pick-date"
                                                            placeholder="Pickup Time" name="Pickup_Time"
                                                            value="{{ date('Y-m-d') }}">
                                                        <div class="invalid-feedback">
                                                            Enter Pickup Time.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Pickup Date</label>
                                                        <input type="time" class="form-control pick-date"
                                                            placeholder="Pickup Time" name="Pickup_Time"
                                                            value="{{ date('Y-m-d') }}">
                                                        <div class="invalid-feedback">
                                                            Enter Pickup Time.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Delivery Time</label>
                                                        <input type="time" class="form-control deliver-time"
                                                            placeholder="Delivery Time" name="Delivery_Time">
                                                        <div class="invalid-feedback">
                                                            Enter Delivery Time.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Delivery Time</label>
                                                        <input type="time" class="form-control deliver-time"
                                                            placeholder="Delivery Time" name="Delivery_Time">
                                                        <div class="invalid-feedback">
                                                            Enter Delivery Time.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-lg-2">
                                                    <button type="button" class="btn btn-danger compare-listing"
                                                        data-toggle="modal" data-target="#CompareListing">
                                                        <input hidden class="Listed-Type" value="3">
                                                        Previous Record
                                                    </button>
                                                </div>
                                                <div class="col-lg-2">
                                                    <a href="https://www.weather.gov/" target="_blank"
                                                        class="btn btn-success"> View Weather</a>
                                                </div>
                                                <div class="col-lg-2">
                                                    <a href="https://gasprices.aaa.com/" target="_blank"
                                                        class="btn btn-primary">
                                                        Fuel
                                                        Prices</a>
                                                </div>
                                            </div>
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
                                                        <label>Order Pricing</label>
                                                        <input type="number" class="form-control"
                                                            placeholder="Order Pricing" name="Booking_Price"
                                                            value="">
                                                        <div class="invalid-feedback">
                                                            Enter Booking Price.
                                                        </div>
                                                    </div>

                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="dry_deposite_Check">
                                                        <label class="form-check-label"
                                                            for="dry_deposite_Check">Deposit
                                                            Amount?</label>
                                                    </div>

                                                </div>
                                                <div class="col-lg-3 deposite-box">
                                                    <div class="form-group">
                                                        <label>Deposit Amount *</label>
                                                        <input type="number" class="form-control"
                                                            placeholder="Deposite Amount" name="Deposite_Amount"
                                                            value="">
                                                        <div class="invalid-feedback">
                                                            Enter Deposit Amount.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Pay To Carrier</label>
                                                        <input type="number" class="form-control Price-Pay"
                                                            placeholder="Pay To Carrier" name="Price_Pay"
                                                            value="" required>
                                                        <div class="invalid-feedback">
                                                            Enter Price Pay Amount.
                                                        </div>
                                                    </div>
                                                    {{-- <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input"
                                                                    id="dry_customControlValidation77"
                                                                    name="Payment_Mode" value="COD" checked>
                                                                <label class="custom-control-label"
                                                                    for="dry_customControlValidation77">COD</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="custom-control custom-radio mb-3">
                                                                <input type="radio" class="custom-control-input"
                                                                    id="dry_customControlValidation88"
                                                                    name="Payment_Mode" value="Quick Pay">
                                                                <label class="custom-control-label"
                                                                    for="dry_customControlValidation88">Quick
                                                                    Pay</label>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>COD/COP Amount</label>
                                                        <input type="number" class="form-control COD_Amount"
                                                            placeholder="COD / COP Amount" name="COD_Amount"
                                                            value="" required>
                                                        <div class="invalid-feedback">
                                                            Enter COD/COP Amount.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Balance Amount</label>
                                                        <input readonly type="number"
                                                            class="form-control Balance-Amount"
                                                            placeholder="Balanced Amount" name="Bal_Amount"
                                                            value="" required>
                                                        <div class="invalid-feedback">
                                                            Enter Balance Amount.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 cod-inputs">
                                                    <div class="form-group">
                                                        <label>COD/COP Payment Method *</label>
                                                        <select class="custom-select COD_Payment_Mode"
                                                            name="COD_Payment_Mode">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="Cash">Cash</option>
                                                            <option value="Company Check">Company Check</option>
                                                            <option value="Certified Funds">Certified Funds</option>
                                                            <option value="Comcheck">Comcheck</option>
                                                            <option value="TCH">TCH</option>
                                                        </select>
                                                        <div class="invalid-feedback">Select AnyOne</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 cod-inputs">
                                                    <div class="form-group">
                                                        <label>COD/COP Location *</label>
                                                        <select class="custom-select Location_Mode"
                                                            name="Location_Mode">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="PickUp">PickUp</option>
                                                            <option value="Delivery">Delivery</option>
                                                        </select>
                                                        <div class="invalid-feedback">Select AnyOne</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 balance-inputs">
                                                    <div class="form-group">
                                                        <label>Balance Payment Method *</label>
                                                        <select class="custom-select Balance_Payment_Mode"
                                                            name="Balance_Payment_Mode">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="Cash">Cash</option>
                                                            <option value="Company Check">Company Check</option>
                                                            <option value="Certified Funds">Certified Funds</option>
                                                            <option value="Comcheck">Comcheck</option>
                                                            <option value="TCH">TCH</option>
                                                        </select>
                                                        <div class="invalid-feedback">Select AnyOne</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 balance-inputs">
                                                    <div class="form-group">
                                                        <label>Balance Payment Time *</label>
                                                        <select class="custom-select Bal_Payment_Time"
                                                            name="Bal_Payment_Time">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="Immediately">Immediately</option>
                                                            <option value="2 Business Days (Quick Pay)">2 Business
                                                                Days
                                                                (Quick
                                                                Pay)
                                                            </option>
                                                            <option value="5 Business Days">5 Business Days</option>
                                                            <option value="10 Business Days">10 Business Days</option>
                                                            <option value="15 Business Days">15 Business Days</option>
                                                            <option value="30 Business Days">30 Business Days</option>
                                                        </select>
                                                        <div class="invalid-feedback">Select AnyOne</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 balance-inputs">
                                                    <div class="form-group">
                                                        <label>Balance Payment Terms Begin On *</label>
                                                        <select class="custom-select" name="Payment_Terms">
                                                            <option value="">Select AnyOne</option>
                                                            <option value="PickUp">PickUp</option>
                                                            <option value="Delivery">Delivery</option>
                                                            <option value="Receiving a Sign Bill Of Lading">Receiving
                                                                a
                                                                Sign
                                                                Bill Of Lading
                                                            </option>
                                                        </select>
                                                        <div class="invalid-feedback">Select AnyOne</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Additional Vehicle Information</label>
                                                        <textarea cols="30" rows="5" name="Desc_For_Vehcile" placeholder="Write something..."
                                                            class="form-control"></textarea>
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
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 shadow-sm p-3">
                                            <h4 class="text-white py-2 d-flex justify-content-center"
                                                style="background: #113771;">
                                                <i class="bi bi-hash mr-2"></i>Additional Information
                                            </h4>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Order ID</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Dispatch ID" name="Ref_ID"
                                                            value="" required>
                                                        <div class="invalid-feedback">
                                                            Enter Order ID.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label>Upload Any Vehicle Images</label>
                                                    <div class="input-group mb-3">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                name="Vehcile_Images[]" id="image-upload-third"
                                                                accept="image/*" multiple>
                                                            <label class="custom-file-label">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div id="image-preview-third" class="displayimages row"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Additional Terms</label>
                                                        <textarea cols="30" rows="5" name="Additional_Terms" placeholder="Enter Additional Terms"
                                                            class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            {{-- </div>
                                            <div class="row"> --}}
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Special Instructions</label>
                                                        <textarea cols="30" rows="5" name="Special_Terms"
                                                            placeholder="Enter Any Special Instructions Regarding this Shipment" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            {{-- </div>
                                            <div class="row"> --}}
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Notes From Customer</label>
                                                        <textarea cols="30" rows="5" name="Special_Notes"
                                                            placeholder="Enter Any Notes From Customer or Detail Regarding this Shipment" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="row">
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
                                                                    <input type="hidden"
                                                                        value='{{ $row->My_Contract }}' />
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-box text-center">
                                        <button type="submit" class="submit-btn w-100"><i class='bx bx-save'></i>
                                            Assign Listing
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                {{-- @endif --}}
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="CompareListing" data-backdrop="true" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Previous Records</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body user-settings-box">
                <div class="table-responsive" id="all-fetch-comparison">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="showpallet" data-backdrop="true" role="dialog" aria-modal="true"
    style="display: none; margin-top: 130px;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Specify No. Unit/Pallet</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div id="requested">
                <div class="row">
                    <div class="col-md-12">
                        <img src="https://daydispatch.com/backend/img/DayDispatch%20Pallet.jpg" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Script For Post Vehicle => Dynamic or Styling Code --}}
<script>
    $(document).ready(function() {
        $('#date-dropdown').on('change', function() {
            var value = $(this).val();
            if (value.length > 4) {
                value = value.slice(0, 4);
                alert("Year cannot exceed 4 digits. Value truncated.");
                $(this).addClass('error-border');
            } else if (value < 1900) {
                value = "";
                alert("Year must be greater than or equal to 1900. Value set to 1900.");
                $(this).addClass('error-border');
            } else if (value > 2025) {
                value = "";
                alert("Year must be less than or equal to 2025. Value set to 2025.");
                $(this).addClass('error-border');
            } else {

                $(this).removeClass('error-border');
            }
            $(this).val(value);
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#vehicle .orig-basic').show();
        $('#vehicle .orig-auction').hide();
        $('#vehicle .orig-dealership').hide();
        $('#vehicle .orig-location').hide();
        $('#vehicle .orig-port').hide();
        $('#vehicle .orig-auction-input-field').hide();
        $('#vehicle .Orig').change(function() {
            const Orig = $(this).val();
            if (Orig !== null) {
                $('#vehicle .orig-basic').show();
            } else {
                $('#vehicle .orig-basic').hide();
            }
            if (Orig === 'Location') {
                $('#vehicle .orig-location').show();
            } else {
                $('#vehicle .orig-location').hide();
            }
            if (Orig === 'Dealership') {
                $('#vehicle .orig-dealership').show();
            } else {
                $('#vehicle .orig-dealership').hide();
            }
            if (Orig === 'Auction') {
                $('#vehicle .orig-auction').show();
                $('#vehicle .orig-auction select').change(function() {
                    const $auctionVal = $(this).val();
                    if ($auctionVal === 'Other') {
                        $('#vehicle .orig-auction-input-field').show();
                        $('#vehicle .orig-auction select').removeAttr('name');
                    } else {
                        $('#vehicle .orig-auction-input-field').hide();
                        $('#vehicle .orig-auction select').attr('name', 'Auction_Method');
                    }
                });
            } else {
                $('#vehicle .orig-auction').hide();
            }
            if (Orig === 'Port') {
                $('#vehicle .orig-port').show();
            } else {
                $('#vehicle .orig-port').hide();
            }
        });
        $('#vehicle .dest-basic').show();
        $('#vehicle .dest-auction').hide();
        $('#vehicle .dest-dealership').hide();
        $('#vehicle .dest-location').hide();
        $('#vehicle .dest-port').hide();
        $('#vehicle .dest-auction-input-field').hide();
        $('#vehicle .Dest').change(function() {
            const Dest = $(this).val();
            if (Dest !== null) {
                $('#vehicle .dest-basic').show();
            } else {
                $('#vehicle .dest-basic').hide();
            }
            if (Dest === 'Location') {
                $('#vehicle .dest-location').show();
            } else {
                $('#vehicle .dest-location').hide();
            }
            if (Dest === 'Dealership') {
                $('#vehicle .dest-dealership').show();
            } else {
                $('#vehicle .dest-dealership').hide();
            }
            if (Dest === 'Auction') {
                $('#vehicle .dest-auction').show();
                $('#vehicle .dest-auction select').change(function() {
                    const $auctionVal = $(this).val();
                    if ($auctionVal === 'Other') {
                        $('#vehicle .dest-auction-input-field').show();
                        $('#vehicle .dest-auction select').removeAttr('name');
                    } else {
                        $('#vehicle .dest-auction-input-field').hide();
                        $('#vehicle .dest-auction select').attr('name', 'Dest_Auction_Method');
                    }
                });
            } else {
                $('#vehicle .dest-auction').hide();
            }
            if (Dest === 'Port') {
                $('#vehicle .dest-port').show();
            } else {
                $('#vehicle .dest-port').hide();
            }
        });
        $('#vehicle .vin-boxes').hide();
        $('#vehicle .vehcile-information .vehcile-information-container-vin').hide();
        $('#vehicle .custom-control-input', this).change(function() {
            const mod = $(this).val();
            if (mod === 'VIN') {
                $('#vehicle .vehcile-information .vin-boxes').show();
                $('#vehicle .vehcile-information .vehcile-information-container-vin').show();
                $('#vehicle .vehcile-information .vehcile-information-container-ymm').hide();
                $('#vehicle .vehcile-information .vehcile-information-container-vin input').prop(
                    'disabled', false);
                $('#vehicle .vehcile-information .vehcile-information-container-ymm input').prop(
                    'disabled', true);
                $("#vehicle .vin-boxes input").prop('required', true);
                $("#vehicle .basic-vehcile-info input").attr("readonly", true);
                $("#vehicle .basic-vehcile-info input").prop('required', false);
                $('#vehicle .vin-boxes input').on('keyup', function() {
                    const Vin_Number = $(this).val();
                    $.ajax({
                        url: '{{ route('Get.Vin.Number') }}',
                        type: 'GET',
                        data: {
                            'Vin_Number': Vin_Number
                        },
                        success: function(data) {
                            $('#vehicle .vehcile-information .basic-vehcile-info input.make')
                                .val(data['Make']);
                            $('#vehicle .vehcile-information .basic-vehcile-info input.year')
                                .val(data['Year']);
                            $('#vehicle .vehcile-information .basic-vehcile-info input.model')
                                .val(data['Model']);
                        }
                    });
                });
            }
            if (mod === 'YMM') {
                $('#vehicle .vehcile-information .vehcile-information-container-vin').hide()
                $('#vehicle .vehcile-information .vehcile-information-container-vin input').prop(
                    'disabled', true);
                $('#vehicle .vehcile-information .vehcile-information-container-ymm input').prop(
                    'disabled', false);
                $('#vehicle .vehcile-information .vehcile-information-container-ymm').show();
                $("#vehicle .basic-vehcile-info input").prop('required', true);
                $("#vehicle .basic-vehcile-info input").attr("readonly", false);
                $("#vehicle .vin-boxes input").prop('required', false);
                $('#vehicle .vehcile-information .vin-boxes').hide();
            }
        });
        $('#vehicle .deposite-box').hide();
        $('#vehicle #vehicle_deposite_Check').change(function() {
            checkBox = document.getElementById('vehicle_deposite_Check');
            if (checkBox.checked) {
                $('#vehicle .deposite-box').show();
                $("#vehicle .deposite-box input").prop('required', true);
            } else {
                $('#vehicle .deposite-box').hide();
                $("#vehicle .deposite-box input").prop('required', false);
            }
        });
        $('#vehicle .Custom-Date').hide();
        $('#vehicle #custom_Check').change(function() {
            checkBox = document.getElementById('custom_Check');
            if (checkBox.checked) {
                $('#vehicle .Custom-Date').show();
                $("#vehicle .Custom-Date input").prop('required', true);
            } else {
                $('#vehicle .Custom-Date').hide();
                $("#vehicle .Custom-Date input").prop('required', false);
            }
        });
        $('#vehicle .Dest_ZipCode.typeahead').typeahead({
            source: function(query, process) {
                return $.get(path, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            },
            updater: function(item) {
                var addressComponents = item.split(',');
                var city = addressComponents[0].trim();
                var state = '';
                var zipCode = '';
                if (addressComponents.length >= 3) {
                    state = addressComponents[1].trim();
                    zipCode = addressComponents[2].trim();
                }
                $('.Dest_City').val(city);
                $('.Dest_State').val(state);
                $('.Dest_ZipCode2').val(zipCode);
                return item;
            }
        });
        $('#vehicle .Origin_ZipCode.typeahead').typeahead({
            source: function(query, process) {
                return $.get(path, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            },
            updater: function(item) {
                var addressComponents = item.split(',');
                var city = addressComponents[0].trim();
                var state = '';
                var zipCode = '';
                if (addressComponents.length >= 3) {
                    state = addressComponents[1].trim();
                    zipCode = addressComponents[2].trim();
                }
                $('.Orig_City').val(city);
                $('.Orig_State').val(state);
                $('.Orig_ZipCode2').val(zipCode);

                return item;
            }
        });
        const GetVehicleMake = '{{ route('Get.Vehcile.Make') }}';
        const GetVehicleModel = '{{ route('Get.Vehcile.Model') }}';
        $('#vehicle input.make.typeahead').typeahead({
            source: function(query, process) {
                return $.get(GetVehicleMake, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });
        $('#vehicle input.makes.typeahead').typeahead({
            source: function(query, process) {
                return $.get(GetVehicleMake, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });
        $('#vehicle input.model.typeahead').typeahead({
            source: function(query, process) {
                return $.get(GetVehicleModel, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });
        $('#vehicle input.models.typeahead').typeahead({
            source: function(query, process) {
                return $.get(GetVehicleModel, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });
        $('#vehicle .balance-inputs').hide();
        $('#vehicle .Balance-Amount').on('change', function() {
            var balance = $(this).val();
            if (balance === "") {
                $('#vehicle .balance-inputs').hide();
                $("#vehicle .balance-inputs select").prop('required', false);
            } else {
                $('#vehicle .balance-inputs').show();
                $("#vehicle .balance-inputs select").prop('required', true);
            }
        });
        $('#vehicle .cod-inputs').hide();
        $('#vehicle .COD_Amount').on('change', function() {
            var PricPay = $('#vehicle .Price-Pay').val();
            var cod = $(this).val();
            var BalanceAmount = PricPay - cod;
            var htmlContent;
            console.log('yesyesyes');
            var CodAmount = $('#vehicle .COD_Amount').val();
            if (CodAmount > 0) {
                if (cod === "") {
                    $('#vehicle .cod-inputs').hide();
                    $("#vehicle .cod-inputs select").prop('required', false);
                } else {
                    $('#vehicle .cod-inputs').show();
                    $("#vehicle .cod-inputs select").prop('required', true);
                }
            } else {
                $('#vehicle .cod-inputs').hide();
                $("#vehicle .cod-inputs select").prop('required', false);

            }
        });
        $("#vehicle .Price-Pay, #vehicle .COD_Amount").on("keydown keyup", function() {
            var PricPay = $('#vehicle .Price-Pay').val();
            var CodAmount = $('#vehicle .COD_Amount').val();
            var PaymentVia = $('#vehicle .COD_Payment_Mode').val();
            var LocationMode = $('#vehicle .Location_Mode').val();
            var BalancePaymentVia = $('#vehicle .Balance_Payment_Mode').val();
            var BalancePaymentTime = $('#vehicle .Bal_Payment_Time').val();
            var BalanceAmount = PricPay - CodAmount;
            $('#vehicle .Balance-Amount').val(Math.abs(BalanceAmount));
            if (BalanceAmount !== 0) {
                $('#vehicle .balance-inputs').show();
                $("#vehicle .balance-inputs select").prop('required', true);
            } else {
                $('#vehicle .balance-inputs').hide();
                $("#vehicle .balance-inputs select").prop('required', false);
            }
        });
        $('#vehicle .COD_Payment_Mode').change(function() {
            var PricPay = $('#vehicle .Price-Pay').val();
            var CodAmount = $('#vehicle .COD_Amount').val();
            var PaymentVia = $('#vehicle .COD_Payment_Mode').val();
            var LocationMode = $('#vehicle .Location_Mode').val();
            var BalancePaymentVia = $('#vehicle .Balance_Payment_Mode').val();
            var BalancePaymentTime = $('#vehicle .Bal_Payment_Time').val();
            var BalanceAmount = PricPay - CodAmount;
        })
        $('#vehicle .Location_Mode').change(function() {
            var PricPay = $('#vehicle .Price-Pay').val();
            var CodAmount = $('#vehicle .COD_Amount').val();
            var PaymentVia = $('#vehicle .COD_Payment_Mode').val();
            var LocationMode = $('#vehicle .Location_Mode').val();
            var BalancePaymentVia = $('#vehicle .Balance_Payment_Mode').val();
            var BalancePaymentTime = $('#vehicle .Bal_Payment_Time').val();
            var BalanceAmount = PricPay - CodAmount;
        })
        $('#vehicle .Balance_Payment_Mode').change(function() {
            var PricPay = $('#vehicle .Price-Pay').val();
            var CodAmount = $('#vehicle .COD_Amount').val();
            var PaymentVia = $('#vehicle .COD_Payment_Mode').val();
            var LocationMode = $('#vehicle .Location_Mode').val();
            var BalancePaymentVia = $('#vehicle .Balance_Payment_Mode').val();
            var BalancePaymentTime = $('#vehicle .Bal_Payment_Time').val();
            var BalanceAmount = PricPay - CodAmount;
        })
        $('#vehicle .Bal_Payment_Time').change(function() {
            var PricPay = $('#vehicle .Price-Pay').val();
            var CodAmount = $('#vehicle .COD_Amount').val();
            var PaymentVia = $('#vehicle .COD_Payment_Mode').val();
            var LocationMode = $('#vehicle .Location_Mode').val();
            var BalancePaymentVia = $('#vehicle .Balance_Payment_Mode').val();
            var BalancePaymentTime = $('#vehicle .Bal_Payment_Time').val();
            var BalanceAmount = PricPay - CodAmount;
        })
        $('#vehicle .Payment_Terms').change(function() {
            var PricPay = $('#vehicle .Price-Pay').val();
            var CodAmount = $('#vehicle .COD_Amount').val();
            var PaymentVia = $('#vehicle .COD_Payment_Mode').val();
            var LocationMode = $('#vehicle .Location_Mode').val();
            var BalancePaymentVia = $('#vehicle .Balance_Payment_Mode').val();
            var BalancePaymentTime = $('#vehicle .Bal_Payment_Time').val();
            var PaymentTerms = $('#vehicle .Payment_Terms').val();
            var BalanceAmount = PricPay - CodAmount;
            var htmlContent;
        })
        $('#vehicle .COD_Amount').change(function() {
            var PricPay = parseFloat($('#vehicle .Price-Pay').val());
            var CodAmount = parseFloat($('#vehicle .COD_Amount').val());
            var PaymentVia = $('#vehicle .COD_Payment_Mode').val();
            var LocationMode = $('#vehicle .Location_Mode').val();
            var BalancePaymentVia = $('#vehicle .Balance_Payment_Mode').val();
            var BalancePaymentTime = $('#vehicle .Bal_Payment_Time').val();
            var BalanceAmount = PricPay - CodAmount;
        });
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
        $("#vehciles").on('click', '.remove-vehcile', function() {
            $(this).closest('.vehcile-information').remove();
            min_vehcile--;
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#heavy .orig-basic').hide();
        $('#heavy .orig-auction').hide();
        $('#heavy .orig-dealership').hide();
        $('#heavy .orig-location').hide();
        $('#heavy .orig-port').hide();
        $('#heavy .orig-auction-input-field').hide();
        $('#heavy .Orig').change(function() {
            const Orig = $(this).val();
            if (Orig !== null) {
                $('#heavy .orig-basic').show();
            } else {
                $('#heavy .orig-basic').hide();
            }
            if (Orig === 'Location') {
                $('#heavy .orig-location').show();
            } else {
                $('#heavy .orig-location').hide();
            }
            if (Orig === 'Dealership') {
                $('#heavy .orig-dealership').show();
            } else {
                $('#heavy .orig-dealership').hide();
            }
            if (Orig === 'Auction') {
                $('#heavy .orig-auction').show();
                $('#heavy .orig-auction select').change(function() {
                    const $auctionVal = $(this).val();
                    if ($auctionVal === 'Other') {
                        $('#heavy .orig-auction-input-field').show();
                        $('#heavy .orig-auction select').removeAttr('name');
                    } else {
                        $('#heavy .orig-auction-input-field').hide();
                        $('#heavy .orig-auction select').attr('name', 'Auction_Method');
                    }
                });
            } else {
                $('#heavy .orig-auction').hide();
            }
            if (Orig === 'Port') {
                $('#heavy .orig-port').show();
            } else {
                $('#heavy .orig-port').hide();
            }
        });
        $('#heavy .dest-basic').hide();
        $('#heavy .dest-auction').hide();
        $('#heavy .dest-dealership').hide();
        $('#heavy .dest-location').hide();
        $('#heavy .dest-port').hide();
        $('#heavy .dest-auction-input-field').hide();
        $('#heavy .Dest').change(function() {
            const Dest = $(this).val();
            if (Dest !== null) {
                $('#heavy .dest-basic').show();
            } else {
                $('#heavy .dest-basic').hide();
            }
            if (Dest === 'Location') {
                $('#heavy .dest-location').show();
            } else {
                $('#heavy .dest-location').hide();
            }
            if (Dest === 'Dealership') {
                $('#heavy .dest-dealership').show();
            } else {
                $('#heavy .dest-dealership').hide();
            }
            if (Dest === 'Auction') {
                $('#heavy .dest-auction').show();
                $('#heavy .dest-auction select').change(function() {
                    const $auctionVal = $(this).val();
                    if ($auctionVal === 'Other') {
                        $('#heavy .dest-auction-input-field').show();
                        $('#heavy .dest-auction select').removeAttr('name');
                    } else {
                        $('#heavy .dest-auction-input-field').hide();
                        $('#heavy .dest-auction select').attr('name', 'Auction_Method');
                    }
                });
            } else {
                $('#heavy .dest-auction').hide();
            }
            if (Dest === 'Port') {
                $('#heavy .dest-port').show();
            } else {
                $('#heavy .dest-port').hide();
            }
        });
        $('.orig-location-business').hide();
        $('.dest-location-business').hide();
        $('.orig-business-location').change(function() {
            const Dest = $(this).val();
            if (Dest === 'Business') {
                $('.orig-location-business').show();
            } else {
                $('.orig-location-business').hide();
            }
        });
        $('.dest-business-location').change(function() {
            const Dest = $(this).val();
            if (Dest === 'Business') {
                $('.dest-location-business').show();
            } else {
                $('.dest-location-business').hide();
            }
        });
        $('#heavy .pick-date', this).change(function() {
            var GivenDate = $(this).val();
            var CurrentDate = new Date();
            GivenDate = new Date(GivenDate);

            if (GivenDate < CurrentDate) {
                alert('Please Select Valid Date.');
                $(this).val(CurrentDate);
            }
        });
        $('#heavy .deliver-date', this).change(function() {
            var GivenDate = $(this).val();
            var CurrentDate = new Date();
            GivenDate = new Date(GivenDate);

            if (GivenDate < CurrentDate) {
                alert('Please Select Valid Date.');
                $(this).val(CurrentDate);
            }
        });
        $('#heavy .deposite-box').hide();
        $('#heavy #heavy_deposite_Check').change(function() {
            checkBox = document.getElementById('heavy_deposite_Check');
            if (checkBox.checked) {
                $('#heavy .deposite-box').show();
                $("#heavy .deposite-box input").prop('required', true);
            } else {
                $('#heavy .deposite-box').hide();
                $("#heavy .deposite-box input").prop('required', false);
            }
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
        $('#heavy .balance-inputs').hide();
        $('#heavy .Balance-Amount').on('change', function() {
            var balance = $(this).val();
            if (balance === "") {
                $('#heavy .balance-inputs').hide();
                $("#heavy .balance-inputs select").prop('required', false);
            } else {
                $('#heavy .balance-inputs').show();
                $("#heavy .balance-inputs select").prop('required', true);
            }
        });
        $('#heavy .cod-inputs').hide();
        $('#heavy .COD_Amount').on('change', function() {
            var cod = $(this).val();
            if (cod === "") {
                $('#heavy .cod-inputs').hide();
                $("#heavy .cod-inputs select").prop('required', false);
            } else {
                $('#heavy .cod-inputs').show();
                $("#heavy .cod-inputs select").prop('required', true);
            }

        });
        $("#heavy .Price-Pay, #heavy .COD_Amount").on("keydown keyup", function() {
            var PricPay = $('#heavy .Price-Pay').val();
            var CodAmount = $('#heavy .COD_Amount').val();
            var BalanceAmount = PricPay - CodAmount;
            $('#heavy .Balance-Amount').val(Math.abs(BalanceAmount));
            if (BalanceAmount !== 0) {
                $('#heavy .balance-inputs').show();
                $("#heavy .balance-inputs select").prop('required', true);
            } else {
                $('#heavy .balance-inputs').hide();
                $("#heavy .balance-inputs select").prop('required', false);
            }
        });
        $('#heavy .COD_Payment_Mode').change(function() {
            var PricPay = $('#heavy .Price-Pay').val();
            var CodAmount = $('#heavy .COD_Amount').val();
            var PaymentVia = $('#heavy .COD_Payment_Mode').val();
            var LocationMode = $('#heavy .Location_Mode').val();
            var BalancePaymentVia = $('#heavy .Balance_Payment_Mode').val();
            var BalancePaymentTime = $('#heavy .Bal_Payment_Time').val();
            var BalanceAmount = PricPay - CodAmount;
        })
        $('#heavy .Location_Mode').change(function() {
            var PricPay = $('#heavy .Price-Pay').val();
            var CodAmount = $('#heavy .COD_Amount').val();
            var PaymentVia = $('#heavy .COD_Payment_Mode').val();
            var LocationMode = $('#heavy .Location_Mode').val();
            var BalancePaymentVia = $('#heavy .Balance_Payment_Mode').val();
            var BalancePaymentTime = $('#heavy .Bal_Payment_Time').val();
            var BalanceAmount = PricPay - CodAmount;
        })
        $('#heavy .Balance_Payment_Mode').change(function() {
            var PricPay = $('#heavy .Price-Pay').val();
            var CodAmount = $('#heavy .COD_Amount').val();
            var PaymentVia = $('#heavy .COD_Payment_Mode').val();
            var LocationMode = $('#heavy .Location_Mode').val();
            var BalancePaymentVia = $('#heavy .Balance_Payment_Mode').val();
            var BalancePaymentTime = $('#heavy .Bal_Payment_Time').val();
            var BalanceAmount = PricPay - CodAmount;
        })
        $('#heavy .Bal_Payment_Time').change(function() {
            var PricPay = $('#heavy .Price-Pay').val();
            var CodAmount = $('#heavy .COD_Amount').val();
            var PaymentVia = $('#heavy .COD_Payment_Mode').val();
            var LocationMode = $('#heavy .Location_Mode').val();
            var BalancePaymentVia = $('#heavy .Balance_Payment_Mode').val();
            var BalancePaymentTime = $('#heavy .Bal_Payment_Time').val();
            var BalanceAmount = PricPay - CodAmount;
        })
        $('.heavy_Dest_ZipCode.typeahead').typeahead({
            source: function(query, process) {
                return $.get(path, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });
        $('.heavy_Origin_ZipCode.typeahead').typeahead({
            source: function(query, process) {
                return $.get(path, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });
        var min_heavy_vehcile = 1;
        var max_heavy_vehcile = 25;
        var new_heavy_vehciles =
            '<div id="reform"><div class="heavy-vehcile-information"><div class="row"><div class="col-lg-4"></div><div class="col-lg-4"></div><div class="col-lg-4 justify-content-end"><div class="btn-box text-right"><button type="button" id="remove-heavy-vehicle" class="btn btn-danger"><i class="bx bx-trash"></i>Remove Heavy Vehicle</button></div></div></div><div class="row"><div class="col-lg-4 basic-vehcile-info"><div class="form-group"><label>Year *</label><input type="text" class="form-control" placeholder="Ex: 2022" name="Vehcile_Year[]" value="" required><div class="invalid-feedback">Entered Year.</div></div></div><div class="col-lg-4 basic-vehcile-info"><div class="form-group"><label>Make *</label><input type="text" class="form-control" placeholder="Enter Make" name="Vehcile_Make[]" value="" required><div class="invalid-feedback">Entered Make.</div></div></div><div class="col-lg-4 basic-vehcile-info"><div class="form-group"><label>Model *</label><input type="text" class="form-control" placeholder="Enter Model" name="Vehcile_Model[]" value="" required><div class="invalid-feedback">Entered Model.</div></div></div></div><div class="row"><div class="col-lg-3"><div class="form-group"><label>Length *</label><input type="number" class="form-control" placeholder="Enter Length" min="0" name="Vehcile_Length[]" value="" required><div class="invalid-feedback">Entered Length.</div></div></div><div class="col-lg-3"><div class="form-group"><label>Width *</label><input type="number" class="form-control" placeholder="Enter Width" min="0" name="Vehcile_Width[]" value="" required><div class="invalid-feedback">Entered Width.</div></div></div><div class="col-lg-3"><div class="form-group"><label>Height *</label><input type="number" class="form-control" placeholder="Enter Height" min="0" name="Vehcile_Height[]" value="" required><div class="invalid-feedback">Entered Height.</div></div></div><div class="col-lg-3"><div class="form-group"><label>Weight *</label><input type="number" class="form-control" placeholder="Enter Weight" min="0" name="Vehcile_Weight[]" value="" required><div class="invalid-feedback">Entered Weight.</div></div></div></div><div class="row"><div class="col-lg-3"><div class="form-group"><label>Equipment Condition</label><select class="custom-select" name="Equipment_Condition[]" required><option selected="" value="Running">Running</option><option value="Not Running">Not Running</option></select><div class="invalid-feedback">Select Equipment Condition</div></div></div><div class="col-lg-3"><div class="form-group"><label>Trailer Type</label><select class="custom-select" name="Trailer_Type[]" required><option selected="" value="Flatbed Trailer">Flatbed Trailer</option><option value="Removable Goose-neck Trailer">Removable Goose-neck Trailer</option><option value="Lowboy Trailer">Lowboy Trailer</option><option value="Step Deck Trailer">Step Deck Trailer</option><option value="Extendable Flatbed Trailer">Extendable Flatbed Trailer</option><option value="Stretch Single Drop Deck Trailer">Stretch Single Drop Deck Trailer</option><option value="Tow Away">Tow Away</option><option value="Drive Away">Drive Away</option><option value="Other">Other</option></select><div class="invalid-feedback">Select Any Trailer Type</div></div></div><div class="col-lg-3"><div class="form-group"><label>Shipment Preferences</label><select class="custom-select" name="Shipment_Preferences[]" required><option selected="" value="">Select Shipment Preferences</option><option value="LTL">LTL (Less Than Truck Load)</option><option value="FTL">FTL (Full Truck Load)</option></select><div class="invalid-feedback">Select Shipment Preferences</div></div></div></div></div></div>';
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
    $('#dry .orig-basic').hide();
    $('#dry .orig-auction').hide();
    $('#dry .orig-dealership').hide();
    $('#dry .orig-location').hide();
    $('#dry .orig-port').hide();
    $('#dry .orig-auction-input-field').hide();
    $('#dry .Orig').change(function() {
        const Orig = $(this).val();
        if (Orig !== null) {
            $('#dry .orig-basic').show();
        } else {
            $('#dry .orig-basic').hide();
        }
        if (Orig === 'Location') {
            $('#dry .orig-location').show();
        } else {
            $('#dry .orig-location').hide();
        }
        if (Orig === 'Dealership') {
            $('#dry .orig-dealership').show();
        } else {
            $('#dry .orig-dealership').hide();
        }
        if (Orig === 'Auction') {
            $('#dry .orig-auction').show();
            $('#dry .orig-auction select').change(function() {
                const $auctionVal = $(this).val();
                if ($auctionVal === 'Other') {
                    $('#dry .orig-auction-input-field').show();
                    $('#dry .orig-auction select').removeAttr('name');
                } else {
                    $('#dry .orig-auction-input-field').hide();
                    $('#dry .orig-auction select').attr('name', 'Auction_Method');
                }
            });
        } else {
            $('#dry .orig-auction').hide();
        }
        if (Orig === 'Port') {
            $('#dry .orig-port').show();
        } else {
            $('#dry .orig-port').hide();
        }
    });
    $('#dry .dest-basic').hide();
    $('#dry .dest-auction').hide();
    $('#dry .dest-dealership').hide();
    $('#dry .dest-location').hide();
    $('#dry .dest-port').hide();
    $('#dry .dest-auction-input-field').hide();
    $('#dry .Dest').change(function() {
        const Dest = $(this).val();
        if (Dest !== null) {
            $('#dry .dest-basic').show();
        } else {
            $('#dry .dest-basic').hide();
        }
        if (Dest === 'Location') {
            $('#dry .dest-location').show();
        } else {
            $('#dry .dest-location').hide();
        }
        if (Dest === 'Dealership') {
            $('#dry .dest-dealership').show();
        } else {
            $('#dry .dest-dealership').hide();
        }
        if (Dest === 'Auction') {
            $('#dry .dest-auction').show();
            $('#dry .dest-auction select').change(function() {
                const $auctionVal = $(this).val();
                if ($auctionVal === 'Other') {
                    $('#dry .dest-auction-input-field').show();
                    $('#dry .dest-auction select').removeAttr('name');
                } else {
                    $('#dry .dest-auction-input-field').hide();
                    $('#dry .dest-auction select').attr('name', 'Auction_Method');
                }
            });
        } else {
            $('#dry .dest-auction').hide();
        }
        if (Dest === 'Port') {
            $('#dry .dest-port').show();
        } else {
            $('#dry .dest-port').hide();
        }
    });
    $('#dry .pick-date', this).change(function() {
        var GivenDate = $(this).val();
        var CurrentDate = new Date();
        GivenDate = new Date(GivenDate);
        if (GivenDate < CurrentDate) {
            alert('Please Select Valid Date.');
            $(this).val(CurrentDate);
        }
    });
    $('#dry .deliver-date', this).change(function() {
        var GivenDate = $(this).val();
        var CurrentDate = new Date();
        GivenDate = new Date(GivenDate);
        if (GivenDate < CurrentDate) {
            alert('Please Select Valid Date.');
            $(this).val(CurrentDate);
        }
    });
    $('#dry .deposite-box').hide();
    $('#dry #dry_deposite_Check').change(function() {
        checkBox = document.getElementById('dry_deposite_Check');
        if (checkBox.checked) {
            $('#dry .deposite-box').show();
            $("#dry .deposite-box input").prop('required', true);
        } else {
            $('#dry .deposite-box').hide();
            $("#dry .deposite-box input").prop('required', false);
        }
    });
    $('#dry .Custom-Date').hide();
    $('#dry #custom_Check').change(function() {
        checkBox = document.getElementById('custom_Check');
        if (checkBox.checked) {
            $('#dry .Custom-Date').show();
            $("#dry .Custom-Date input").prop('required', true);
        } else {
            $('#dry .Custom-Date').hide();
            $("#dry .Custom-Date input").prop('required', false);
        }
    });
    $('#dry .balance-inputs').hide();
    $('#dry .Balance-Amount').on('change', function() {
        var balance = $(this).val();
        if (balance === "") {
            $('#dry .balance-inputs').hide();
            $("#dry .balance-inputs select").prop('required', false);
        } else {
            $('#dry .balance-inputs').show();
            $("#dry .balance-inputs select").prop('required', true);
        }
    });
    $('#dry .cod-inputs').hide();
    $('#dry .COD_Amount').on('change', function() {
        var cod = $(this).val();
        if (cod === "") {
            $('#dry .cod-inputs').hide();
            $("#dry .cod-inputs select").prop('required', false);
        } else {
            $('#dry .cod-inputs').show();
            $("#dry .cod-inputs select").prop('required', true);
        }
    });
    $("#dry .Price-Pay, #dry .COD_Amount").on("keydown keyup", function() {
        var PricPay = $('#dry .Price-Pay').val();
        var CodAmount = $('#dry .COD_Amount').val();
        var BalanceAmount = PricPay - CodAmount;
        $('#dry .Balance-Amount').val(Math.abs(BalanceAmount));
        if (BalanceAmount !== 0) {
            $('#dry .balance-inputs').show();
            $("#dry .balance-inputs select").prop('required', true);
        } else {
            $('#dry .balance-inputs').hide();
            $("#dry .balance-inputs select").prop('required', false);

        }
    });
    $('#dry .COD_Payment_Mode').change(function() {
        var PricPay = $('#dry .Price-Pay').val();
        var CodAmount = $('#dry .COD_Amount').val();
        var PaymentVia = $('#dry .COD_Payment_Mode').val();
        var LocationMode = $('#dry .Location_Mode').val();
        var BalancePaymentVia = $('#dry .Balance_Payment_Mode').val();
        var BalancePaymentTime = $('#dry .Bal_Payment_Time').val();
        var BalanceAmount = PricPay - CodAmount;
    })
    $('#dry .Location_Mode').change(function() {
        var PricPay = $('#dry .Price-Pay').val();
        var CodAmount = $('#dry .COD_Amount').val();
        var PaymentVia = $('#dry .COD_Payment_Mode').val();
        var LocationMode = $('#dry .Location_Mode').val();
        var BalancePaymentVia = $('#dry .Balance_Payment_Mode').val();
        var BalancePaymentTime = $('#dry .Bal_Payment_Time').val();
        var BalanceAmount = PricPay - CodAmount;
    })
    $('#dry .Balance_Payment_Mode').change(function() {
        var PricPay = $('#dry .Price-Pay').val();
        var CodAmount = $('#dry .COD_Amount').val();
        var PaymentVia = $('#dry .COD_Payment_Mode').val();
        var LocationMode = $('#dry .Location_Mode').val();
        var BalancePaymentVia = $('#dry .Balance_Payment_Mode').val();
        var BalancePaymentTime = $('#dry .Bal_Payment_Time').val();
        var BalanceAmount = PricPay - CodAmount;
    })
    $('#dry .Bal_Payment_Time').change(function() {
        var PricPay = $('#dry .Price-Pay').val();
        var CodAmount = $('#dry .COD_Amount').val();
        var PaymentVia = $('#dry .COD_Payment_Mode').val();
        var LocationMode = $('#dry .Location_Mode').val();
        var BalancePaymentVia = $('#dry .Balance_Payment_Mode').val();
        var BalancePaymentTime = $('#dry .Bal_Payment_Time').val();
        var BalanceAmount = PricPay - CodAmount;
    })
    $('.dry_Dest_ZipCode.typeahead').typeahead({
        source: function(query, process) {
            return $.get(path, {
                query: query
            }, function(data) {
                return process(data);
            });
        }
    });
    $('.dry_Origin_ZipCode.typeahead').typeahead({
        source: function(query, process) {
            return $.get(path, {
                query: query
            }, function(data) {
                return process(data);
            });
        }
    });
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
    $('.compare-listing').on('click', function() {
        var Origin_ZipCode = $('.Origin_ZipCode ').val();
        var Dest_ZipCode = $('.Dest_ZipCode ').val();
        var getListedType = $(this).find('.Listed-Type').val();
        $.ajax({
            url: '{{ route('Get.All.Previous.Listing') }}',
            type: 'GET',
            data: {
                'Origin_ZipCode': Origin_ZipCode,
                'Dest_ZipCode': Dest_ZipCode,
                'Listed_Type': getListedType
            },
            success: function(data) {
                $('#all-fetch-comparison').html(data);
            },
            error: function(data) {
                alert(data.responseJSON);
            }
        });
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
    imagePreview1.addEventListener('click', (event) => {
        if (event.target.classList.contains('delete-icon')) {
            const colDiv = event.target.closest('.col-md-3');
            colDiv.remove();
        }
    });
    const imageInput2 = document.getElementById('image-upload-second');
    const imagePreview2 = document.getElementById('image-preview-second');
    imageInput2.addEventListener('change', () => {
        const files = imageInput2.files;
        if (files.length === 0) {
            alert('Please select at least one image.');
            return;
        }
        imagePreview2.innerHTML = '';
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const colDiv = document.createElement('div');
            colDiv.classList.add('col-md-3');
            const img = document.createElement('img');
            img.classList.add('preview-image');
            img.src = URL.createObjectURL(file);
            img.alt = file.name;
            colDiv.appendChild(img);
            imagePreview2.appendChild(colDiv);
        }
    });
    const imageInput3 = document.getElementById('image-upload-third');
    const imagePreview3 = document.getElementById('image-preview-third');
    imageInput3.addEventListener('change', () => {
        const files = imageInput3.files;
        if (files.length === 0) {
            alert('Please select at least one image.');
            return;
        }
        imagePreview3.innerHTML = '';
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const colDiv = document.createElement('div');
            colDiv.classList.add('col-md-3');
            const img = document.createElement('img');
            img.classList.add('preview-image');
            img.src = URL.createObjectURL(file);
            img.alt = file.name;
            colDiv.appendChild(img);
            imagePreview3.appendChild(colDiv);
        }
    });
</script>
<script>
    function updateTextareaAndLabel() {
        let contractDropdown = document.getElementById('contractDropdown');
        let selectedContractValue = contractDropdown.value;
        let selectedContractName = contractDropdown.options[contractDropdown.selectedIndex].getAttribute(
            'data-contract-name');
        document.querySelector('.showcontent').value = selectedContractValue;
        document.getElementById('textareaLabel').innerText = 'Contract: ' + selectedContractName;
    }

    function updateTextareaAndLabelEquipment() {
        let contractDropdown = document.querySelector('.showmycontract12');
        let selectedContractValue = contractDropdown.value;
        let selectedContractName = contractDropdown.options[contractDropdown.selectedIndex].getAttribute(
            'data-contract-name');
        document.querySelector('.showcontent12').value = selectedContractValue;
        document.querySelector('.textareaLabel').innerText = 'Contract: ' + selectedContractName;
    }

    function updateTextareaAndLabelFreight() {
        let contractDropdown = document.querySelector('.showmycontract123');
        let selectedContractValue = contractDropdown.value;
        let selectedContractName = contractDropdown.options[contractDropdown.selectedIndex].getAttribute(
            'data-contract-name');
        document.querySelector('.showcontent123').value = selectedContractValue;
        document.querySelector('.textareaLabel123').innerText = 'Contract: ' + selectedContractName;
    }
    $('.myDate').change(function() {
        console.log('testing')
        $(this).closest('.DateParent').find('.seconddate').first().val('');
        $(this).closest('.DateParent').find('.seconddate').first().attr('min', this.value)
    })
    jQuery(function() {
        jQuery('.multiSelect').each(function(e) {
            var self = jQuery(this);
            var field = $(this).find('');
            var fieldOption = $(this).find('option');
            var placeholder = field.attr('data-placeholder');
            field.hide().after(`<div class="multiSelect_dropdown"></div>
                            <span class="multiSelect_placeholder">` + placeholder + `</span>
                            <ul class="multiSelect_list"></ul>
                            <span class="multiSelect_arrow"></span>`);
            fieldOption.each(function(e) {
                jQuery(self).find('.multiSelect_list').append(
                    `<li class="multiSelect_option" data-value="` + jQuery(this).val() + `">
                                                <a class="multiSelect_text">` + jQuery(this).text() + `</a>
                                            </li>`);
            });
            var dropdown = self.find('.multiSelect_dropdown');
            var list = self.find('.multiSelect_list');
            var option = self.find('.multiSelect_option');
            var optionText = self.find('.multiSelect_text');
            dropdown.attr('data-multiple', 'true');
            list.css('top', dropdown.height() + 5);
            option.click(function(e) {
                var self = jQuery(this);
                e.stopPropagation();
                self.addClass('-selected');
                field.find('option:contains(' + self.children().text() + ')').prop('selected',
                    true);
                dropdown.append(function(e) {
                    return jQuery('<span class="multiSelect_choice">' + self.children()
                        .text() + '  ×</span>').click(function(e) {
                        var self = jQuery(this);
                        e.stopPropagation();
                        self.remove();
                        list.find('.multiSelect_option:contains(' + self
                            .text() + ')').removeClass('-selected');
                        list.css('top', dropdown.height() + 5).find(
                            '.multiSelect_noselections').remove();
                        field.find('option:contains(' + self.text() + ')').prop(
                            'selected', false);
                        if (dropdown.children(':visible').length === 0) {
                            dropdown.removeClass('-hasValue');
                        }
                    });
                }).addClass('-hasValue');
                list.css('top', dropdown.height() + 5);
                if (!option.not('.-selected').length) {
                    list.append('<h5 class="multiSelect_noselections">No Selections</h5>');
                }
            });
            dropdown.click(function(e) {
                e.stopPropagation();
                e.preventDefault();
                dropdown.toggleClass('-open');
                list.toggleClass('-open').scrollTop(0).css('top', dropdown.height() + 5);
            });
            jQuery(document).on('click touch', function(e) {
                if (dropdown.hasClass('-open')) {
                    dropdown.toggleClass('-open');
                    list.removeClass('-open');
                }
            });
        });
    });
</script>
<script>
    function question() {
        $('.showalternativecode').toggle('slow');
    }
</script>
<script>
    window.onload = function() {
        var today = new Date();
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
            var GivenDate = $(this).val();
            var CurrentDate = new Date();
            var njCurrentDate = new Date(CurrentDate.toLocaleString("en-US", {
                timeZone: "America/New_York"
            }));
            GivenDate = new Date(GivenDate);
            if (GivenDate >= njCurrentDate) {
                console.log('Selected date is valid.');
            } else {
                $(this).val(todayString);
            }
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
    });
    $(document).on('input', 'input[name^="Vehcile_Year"]', function() {
        const yearInput = $(this);
        const year = yearInput.val();
        if (year.length > 4) {
            yearInput.val(year.slice(0, 4));
        } else if (year.length === 4) {
            const yearInt = parseInt(year);
            if (yearInt < 1900 || yearInt > 2025) {
                yearInput.val('');
                alert('Please enter a year between 1900 and 2024.');
            }
        }
    });
</script>
<script>
   $(document).ready(function() {
        // Add new Local Phone field
        let phoneCounter = 2; // Start with 2 for the second phone number

    $('#phone-container').on('click', '.add-phone', function () {
        var newField = `
            <div class="col-lg-6 d-flex justify-content-between">
                <input type="text" class="form-control phone-number" 
                    placeholder="Phone Number ${phoneCounter}" 
                    name="Local_Phone[]" value="">
                <span class="invalid-feedback">Entered Local Phone ${phoneCounter}.</span>
                <span class="btn btn-sm btn-danger remove-phone">-</span>
            </div>`;
        phoneCounter++; // Increment counter for the next input
        $('#phone-container').append(newField);
    });

    $(document).on('click', '.remove-phone', function () {
        $(this).closest('.col-lg-6').remove(); // Remove the corresponding col-6
    });

        // Add new Dest Local Phone field
        $('#dest-phone-container').on('click', '.add-dest-phone', function() {
            var newDestField = $('.dest-basic input').eq(2).clone();
            newDestField.find('input').val(''); // Clear input value
            newDestField.find('.add-dest-phone').remove(); // Remove plus button
            var removeDestBtn = $('<button type="button" class="btn btn-sm btn-danger remove-dest-phone">-</button>');
            newDestField.find('label').append(removeDestBtn); // Add minus button
            $('#dest-phone-container').append(newDestField);
        });

        // Remove Dest Local Phone field
        $(document).on('click', '.remove-dest-phone', function() {
            $(this).closest('.col-lg-6').remove();
        });
    });
</script>
<script>
    $(document).ready(function() {
        // var sel = $('select.custom-multi-select'); 
        // sel.each(function() {
        //     let select = $(this);
        //     var options = $(this).find('option');
        //     var div = $('<div />').addClass('selectMultiple');
        //     var active = $('<div />').addClass('single-input-field');
        //     var list = $('<ul />');
        //     var searchInput = $(
        //         '<input type="text" class="searchInput" placeholder="Search..." style=" width: 100%; border: 1px solid red; padding: 8px;border-radius: 10px;">'
        //     ); 
        //     var placeholder = $(this).data('placeholder');
        //     var span = $('<span />').text(placeholder).appendTo(active);
        //     list.append(searchInput); 
        //     options.each(function() {
        //         var text = $(this).text();
        //         if ($(this).is(':selected')) {
        //             active.append($('<a />').html('<em>' + text + '</em><i></i>'));
        //             span.addClass('hide');
        //         } else {
        //             list.append($('<li />').html(text));
        //         }
        //     });
        //     active.append($('<div />').addClass('arrow'));
        //     div.append(active).append(list);
        //     select.wrap(div);
        // });
        // $(document).on('keyup', '.searchInput', function(e) {
        //     var filter = $(this).val().toLowerCase();
        //     $(this).siblings('li').each(function() {
        //         var text = $(this).text().toLowerCase();
        //         $(this).toggle(text.indexOf(filter) > -1);
        //     });
        // });
        // $(document).on('click', '.selectMultiple ul li', function(e) {
        //     var select = $(this).parent().parent();
        //     var li = $(this);
        //     if (!select.hasClass('clicked')) {
        //         select.addClass('clicked');
        //         li.prev().addClass('beforeRemove');
        //         li.next().addClass('afterRemove');
        //         li.addClass('remove');
        //         var a = $('<a />').addClass('notShown').html('<em>' + li.text() + '</em><i></i>').hide()
        //             .appendTo(select.children('div'));
        //         a.slideDown(400, function() {
        //             setTimeout(function() {
        //                 a.addClass('shown');
        //                 select.children('div').children('span').addClass('hide');
        //                 select.find('option:contains(' + li.text() + ')').prop(
        //                     'selected', true);
        //             }, 500);
        //         });
        //         setTimeout(function() {
        //             if (li.prev().is(':last-child')) {
        //                 li.prev().removeClass('beforeRemove');
        //             }
        //             if (li.next().is(':first-child')) {
        //                 li.next().removeClass('afterRemove');
        //             }
        //             setTimeout(function() {
        //                 li.prev().removeClass('beforeRemove');
        //                 li.next().removeClass('afterRemove');
        //             }, 200);

        //             li.slideUp(400, function() {
        //                 li.remove();
        //                 select.removeClass('clicked');
        //             });
        //             var anotherSelect = select.siblings('select[multiple]');
        //             anotherSelect.show();
        //         }, 600);
        //     }
        // });
        // $(document).on('click', '.selectMultiple > div a', function(e) {
        //     var select = $(this).parent().parent();
        //     var self = $(this);
        //     self.removeClass().addClass('remove');
        //     select.addClass('open');
        //     setTimeout(function() {
        //         self.addClass('disappear');
        //         setTimeout(function() {
        //             self.animate({
        //                 width: 0,
        //                 height: 0,
        //                 padding: 0,
        //                 margin: 0
        //             }, 300, function() {
        //                 var li = $('<li />').text(self.children('em').text())
        //                     .addClass('notShown').appendTo(select.find('ul'));
        //                 li.slideDown(400, function() {
        //                     li.addClass('show');
        //                     setTimeout(function() {
        //                         select.find('option:contains(' +
        //                             self.children('em')
        //                             .text() + ')').prop(
        //                             'selected', false);
        //                         if (!select.find(
        //                                 'option:selected')
        //                             .length) {
        //                             select.children('div')
        //                                 .children('span')
        //                                 .removeClass('hide');
        //                         }
        //                         li.removeClass();
        //                     }, 400);
        //                 });
        //                 self.remove();
        //             })
        //         }, 300);
        //     }, 400);
        // });
        // $(document).on('click', '.selectMultiple > div .arrow, .selectMultiple > div span', function(e) {
        //     $(this).parent().parent().toggleClass('open');
        // });
        // $(document).on('click', 'body', function(e) {
        //     const selectMultipleElements = $(e.target).closest('.selectMultiple');
        //     if (selectMultipleElements.length === 0) {
        //         $(".selectMultiple").removeClass('open');
        //     }
        // });
        const fields =
            '#vehicle .Price-Pay, #vehicle .COD_Amount, #vehicle .Balance-Amount, #vehicle .COD_Payment_Mode, #vehicle .Location_Mode, #vehicle .Balance_Payment_Mode, #vehicle .Bal_Payment_Time, #vehicle .Payment_Terms';
        $(document).on('change', fields, function(e) {
            var PricPay = parseFloat($('#vehicle .Price-Pay').val()) || 0;
            var CodAmount = parseFloat($('#vehicle .COD_Amount').val()) || 0;
            var BalanceAmount = PricPay - CodAmount;
            var PaymentVia = $('#vehicle .COD_Payment_Mode').val() || 'N/A';
            var LocationMode = $('#vehicle .Location_Mode').val() || 'N/A';
            var BalancePaymentVia = $('#vehicle .Balance_Payment_Mode').val() || 'N/A';
            var BalancePaymentTime = $('#vehicle .Bal_Payment_Time').val() || 'N/A';
            var PaymentTerms = $('#vehicle .Payment_Terms').val() || 'N/A';
            if (BalanceAmount < 0) {
                BalanceAmount = Math.abs(BalanceAmount);
                var isCarrierPaying = true;
            } else {
                var isCarrierPaying = false;
            }
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
            var htmlBalContent =
                "<p class='alert alert-danger balancePayor'><span class='balancePayorText'>";
            if (isCarrierPaying) {
                htmlBalContent += "Carrier will pay you <b>$" + BalanceAmount.toFixed(2) + "</b>";
            } else {
                htmlBalContent += "You will pay the carrier <b>$" + BalanceAmount.toFixed(2) + "</b>";
            }
            if (BalancePaymentVia !== 'N/A' && $('#vehicle .Balance_Payment_Mode').is(':visible')) {
                htmlBalContent += " via <b>" + BalancePaymentVia + "</b>";
            }
            if (BalancePaymentTime !== 'N/A' && $('#vehicle .balance-inputs').is(':visible')) {
                if (BalancePaymentTime == "Immediately") {
                    htmlBalContent += " <b>" + BalancePaymentTime + "</b>";
                } else {
                    htmlBalContent += " within <b>" + BalancePaymentTime + "</b>";
                }
            }
            if (PaymentTerms !== 'N/A' && $('#vehicle .Payment_Terms').is(':visible')) {
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
        $('.Booking_Price, .Deposite_Amount, .Price-Pay').on('input', function() {
            var value = parseFloat($(this).val());
            if (value <= 0 || isNaN(value)) {
                $(this).val('');
                alert('Please enter a value greater than 0.');
            }
        });
    });
</script>
{{-- <script>
    document.getElementById('add-local-phone-number').addEventListener('click', function () {
        var phoneNumberInput = document.getElementById('local-phone-input');
        var phoneNumberValue = phoneNumberInput.value.trim();
        if (phoneNumberValue !== "") {
            var phoneNumbersContainer = document.getElementById('local-phone-numbers-toast-container');
            var toast = document.createElement('div');
            toast.classList.add('toast', 'show');
            toast.style.display = 'block';
            toast.innerHTML = `
                <div class="toast-body d-flex justify-content-between align-items-center">
                    <span class="phone-number">${phoneNumberValue}</span>
                    <button type="button" class="btn-close remove-phone-number"></button>
                </div>
            `;
            phoneNumbersContainer.appendChild(toast);
            phoneNumberInput.value = "";
            toast.querySelector('.remove-phone-number').addEventListener('click', function () {
                toast.remove();
            });
        } else {
            document.getElementById('invalid-phone-message').style.display = 'block';
        }
    });
</script>
<script>
    document.getElementById('add-phone-number').addEventListener('click', function () {
        var phoneNumberInput = document.getElementById('phone-number-input');
        var phoneNumberValue = phoneNumberInput.value.trim();
        if (phoneNumberValue !== "") {
            var phoneNumbersContainer = document.getElementById('phone-numbers-toast-container');
            var toast = document.createElement('div');
            toast.classList.add('toast', 'show');
            toast.style.display = 'block';
            toast.innerHTML = `
                <div class="toast-body d-flex justify-content-between align-items-center">
                    <span class="phone-number">${phoneNumberValue}</span>
                    <button type="button" class="btn-close remove-phone-number"></button>
                </div>
            `;
            phoneNumbersContainer.appendChild(toast);
            phoneNumberInput.value = "";
            toast.querySelector('.remove-phone-number').addEventListener('click', function () {
                toast.remove();
            });
        } else {
            document.getElementById('invalid-phone-message').style.display = 'block';
        }
    });
</script>  --}}
<script>
    // function addPhoneNumber(buttonId, inputId, containerId, messageId) {
    //     document.getElementById(buttonId).addEventListener('click', function () {
    //         var phoneNumberInput = document.getElementById(inputId);
    //         var phoneNumberValue = phoneNumberInput.value.trim();
    //         if (phoneNumberValue !== "") {
    //             var phoneNumbersContainer = document.getElementById(containerId);
    //             var toast = document.createElement('div');
    //             toast.classList.add('toast', 'show');
    //             toast.innerHTML = `
    //                 <div class="toast-body d-flex justify-content-between align-items-center">
    //                     <span class="phone-number">${phoneNumberValue}</span>
    //                     <button type="button" class="btn-close remove-phone-number"></button>
    //                 </div>
    //             `;
    //             phoneNumbersContainer.appendChild(toast);
    //             phoneNumberInput.value = "";
    //             toast.querySelector('.remove-phone-number').addEventListener('click', function () {
    //                 toast.remove();
    //             });
    //         } else {
    //             document.getElementById(messageId).style.display = 'block';
    //         }
    //     });
    // }

    // addPhoneNumber('add-local-phone-number', 'local-phone-input', 'local-phone-numbers-toast-container', 'invalid-phone-message');
    // addPhoneNumber('add-phone-number', 'phone-number-input', 'phone-numbers-toast-container', 'invalid-phone-message');
   
    // function addPhoneNumber(buttonId, inputId, containerId, messageId) {
    //     var addButton = document.getElementById(buttonId);
    //     var phoneNumberInput = document.getElementById(inputId);
    //     addButton.addEventListener('click', function () {
    //         var phoneNumberValue = phoneNumberInput.value.trim();
    //         var phoneNumbersContainer = document.getElementById(containerId);

    //         if (phoneNumberValue !== "") {
    //             var toast = document.createElement('div');
    //             toast.classList.add('toast', 'show');
    //             toast.innerHTML = `
    //                 <div class="toast-body d-flex justify-content-between align-items-center">
    //                     <span class="phone-number">${phoneNumberValue}</span>
    //                     <button type="button" class="btn-close remove-phone-number"></button>
    //                 </div>
    //             `;
    //             phoneNumbersContainer.appendChild(toast);
    //             phoneNumberInput.value = "";

    //             // Check if the maximum limit is reached immediately after adding
    //             if (phoneNumbersContainer.children.length >= 4) {
    //                 phoneNumberInput.setAttribute('readonly', true); // Make input readonly
    //                 addButton.setAttribute('disabled', true); // Disable the button
    //             }

    //             // Add event listener to remove button
    //             toast.querySelector('.remove-phone-number').addEventListener('click', function () {
    //                 toast.remove();

    //                 // Enable input and button if total phone numbers are less than 4
    //                 if (phoneNumbersContainer.children.length < 4) {
    //                     phoneNumberInput.removeAttribute('readonly');
    //                     addButton.removeAttribute('disabled');
    //                 }
    //             });
    //         } else {
    //             document.getElementById(messageId).style.display = 'block';
    //         }
    //     });
    // };
    // addPhoneNumber('add-local-phone-number', 'local-phone-input', 'local-phone-numbers-toast-container', 'invalid-phone-message');
    // addPhoneNumber('add-phone-number', 'phone-number-input', 'phone-numbers-toast-container', 'invalid-phone-message');
    function addPhoneNumber(buttonId, inputId, containerId, messageId, phoneType) {
    var addButton = document.getElementById(buttonId);
    var phoneNumberInput = document.getElementById(inputId);
    addButton.addEventListener('click', function () {
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
            toast.querySelector('.remove-phone-number').addEventListener('click', function () {
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
    addPhoneNumber('add-local-phone-number', 'local-phone-input', 'local-phone-numbers-toast-container', 'invalid-phone-message', 'Local_Phone');
    addPhoneNumber('add-phone-number', 'phone-number-input', 'phone-numbers-toast-container', 'invalid-phone-message-2', 'Dest_Local_Phone');

    $('.Dispatch-Company-Name').on('keyup', function () {
        var query = $(this).val();

        $.ajax({
            url: '{{ route('Find.Network') }}',
            type: 'GET',
            data: {
                'name': query
            },
            success: function (data) {
                $('.CMP_list').html(data);
            }
        })
    });

    function getFullCompanyData(value) {
        $.ajax({
            url: '{{ route('Get.Dispatch.Company') }}',
            type: 'GET',
            data: {
                'name': value
            },
            dataType: 'json',
            success: function (data) {
                $('.Dispatch_Company_ID').val(data.id);
                $('.Dispatch-Mc_Number').val(data.Mc_Number);
                $('.Dispatch-Contact_Phone').val(data.Contact_Phone);
                $('.Dispatch-Company_State').val(data.Company_State);
                $('.Dispatch-Company_City').val(data.Company_City);
                $('.Dispatch-Address').val(data.Address);
                $('.Dispatch-Local_Phone').val(data.Local_Phone);
                $('.Dispatch-Toll_Free').val(data.Toll_Free);
                $('.Dispatch-Dispatch_Phone').val(data.Dispatch_Phone);
                $('.Dispatch-Fax_Phone').val(data.Fax_Phone);
            }
        });
    }

    $(document).on('click', '.CMP_list li', function () {
        var value = $(this).text();
        $('.Dispatch-Company-Name').val(value);
        getFullCompanyData(value);
        $('.CMP_list').html("");
    });
</script>