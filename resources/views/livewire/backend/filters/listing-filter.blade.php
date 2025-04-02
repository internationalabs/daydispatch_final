@section('Filter', 'mm-active')
@php
    use Illuminate\Support\Facades\Auth;
    $currentUser = Auth::guard('Authorized')->user();
@endphp
@php
    use Illuminate\Support\Str;
@endphp
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
<link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Roboto:wght@300;400;700&display=swap"
    rel="stylesheet">

<div class="breadcrumb-area">
    <h1>{{ Auth::guard('Authorized')->user()->usr_type }} Filters Data</h1>
    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>
        <li class="item">Filters</li>
    </ol>
</div>
<style>
    .multi-select-container {
        width: 100%;
        max-width: 500px;
        position: relative;
        margin: 20px 0;
    }

    .input-wrapper {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff;
    }

    .selected-cities-input {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        margin-right: 10px;
    }

    .ajax_city {
        flex-grow: 1;
        border: none;
        padding: 8px;
        outline: none;
    }

    .selected-city {
        display: inline-flex;
        align-items: center;
        background-color: #e3f2fd;
        border: 1px solid #90caf9;
        border-radius: 15px;
        padding: 5px 10px;
        font-size: 14px;
        color: #1976d2;
    }

    .selected-city button {
        background: none;
        border: none;
        font-size: 14px;
        color: #d32f2f;
        margin-left: 5px;
        cursor: pointer;
    }

    .selected-city button:hover {
        color: #b71c1c;
    }

    #ajax_city_list {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background-color: #fff;
        max-height: 150px;
        overflow-y: auto;
        z-index: 999;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    #ajax_city_list li {
        padding: 10px;
        cursor: pointer;
    }

    #ajax_city_list li:hover {
        background-color: #e3f2fd;
    }

    .selectMultiple+.nice-select {
        display: none;
    }

    .selectMultiple {
        width: 100%;
        position: relative;
    }

    .selectMultiple select {
        display: none;
    }

    .selectMultiple>div {
        position: relative;
        z-index: 2;
        border-radius: 6px;
        border: 1px solid #ced4da;
        min-height: 56px;
        box-shadow: none;
        transition: box-shadow 0.3s ease;
    }

    .selectMultiple>div:hover {
        box-shadow: 0 4px 24px -1px rgba(22, 42, 90, .16);
    }

    .selectMultiple>div .arrow {
        right: 1px;
        top: 0;
        bottom: 0;
        cursor: pointer;
        width: 28px;
        position: absolute;
        padding-bottom: 10px;
    }

    .selectMultiple>div .arrow:before,
    .selectMultiple>div .arrow:after {
        content: '';
        position: absolute;
        display: block;
        width: 2px;
        height: 8px;
        border-bottom: 8px solid #99a3ba;
        top: 43%;
        transition: all 0.3s ease;
    }

    .selectMultiple>div .arrow:before {
        right: 12px;
        transform: rotate(-130deg);
    }

    .selectMultiple>div .arrow:after {
        left: 9px;
        transform: rotate(130deg);
    }

    .selectMultiple>div span {
        color: #99a3ba;
        display: block;
        position: absolute;
        left: 19px;
        cursor: pointer;
        top: 16px;
        line-height: 28px;
        transition: all 0.3s ease;
    }

    .selectMultiple>div span.hide {
        opacity: 0;
        visibility: hidden;
        transform: translate(-4px, 0);
    }

    .selectMultiple>div a {
        position: relative;
        padding: 0 24px 6px 8px;
        line-height: 28px;
        color: #bc101c;
        display: inline-block;
        vertical-align: top;
        margin: 0 6px 0 0;
    }

    .selectMultiple>div a em {
        font-style: normal;
        display: block;
        white-space: nowrap;
    }

    .selectMultiple>div a:before {
        content: '';
        left: 0;
        top: 0;
        bottom: 6px;
        width: 100%;
        position: absolute;
        display: block;
        background: rgb(188 16 28 / 7%);
        z-index: -1;
        border-radius: 4px;
    }

    .selectMultiple>div a i {
        cursor: pointer;
        position: absolute;
        top: 0px;
        right: 0;
        width: 24px;
        height: 28px;
        display: block;
    }

    .selectMultiple>div a i:before,
    .selectMultiple>div a i:after {
        content: '';
        display: block;
        width: 2px;
        height: 10px;
        position: absolute;
        left: 50%;
        top: 50%;
        background: #bc101c;
        border-radius: 1px;
    }

    .selectMultiple>div a i:before {
        transform: translate(-50%, -50%) rotate(45deg);
    }

    .selectMultiple>div a i:after {
        transform: translate(-50%, -50%) rotate(-45deg);
    }

    .selectMultiple>div a.notShown {
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .selectMultiple>div a.notShown:before {
        width: 28px;
        transition: width 0.45s cubic-bezier(0.87, -0.41, 0.19, 1.44) 0.2s;
    }

    .selectMultiple>div a.notShown i {
        opacity: 0;
        transition: all 0.3s ease 0.3s;
    }

    .selectMultiple>div a.notShown em {
        opacity: 0;
        transform: translate(-6px, 0);
        transition: all 0.4s ease 0.3s;
    }

    .selectMultiple>div a.notShown.shown {
        opacity: 1;
        margin-top: 7px;
        margin-left: 9px;
        margin-bottom: -6px;
    }

    .selectMultiple>div a.notShown.shown:before {
        width: 100%;
    }

    .selectMultiple>div a.notShown.shown i {
        opacity: 1;
    }

    .selectMultiple>div a.notShown.shown em {
        opacity: 1;
        transform: translate(0, 0);
    }

    .selectMultiple>div a.remove:before {
        width: 28px;
        transition: width 0.4s cubic-bezier(0.87, -0.41, 0.19, 1.44) 0s;
    }

    .selectMultiple>div a.remove i {
        opacity: 0;
        transition: all 0.3s ease 0s;
    }

    .selectMultiple>div a.remove em {
        opacity: 0;
        transform: translate(-12px, 0);
        transition: all 0.4s ease 0s;
    }

    .selectMultiple>div a.remove.disappear {
        opacity: 0;
        transition: opacity 0.5s ease 0s;
    }

    .selectMultiple>ul {
        margin: 0;
        padding: 0;
        list-style: none;
        font-size: 16px;
        z-index: 1;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        visibility: hidden;
        opacity: 0;
        border-radius: 8px;
        transform: translate(0, 20px) scale(0.8);
        transform-origin: 0 0;
        filter: drop-shadow(0 12px 20px rgba(22, 42, 90, .08));
        transition: all 0.4s ease, transform 0.4s cubic-bezier(0.87, -0.41, 0.19, 1.44), filter 0.3s ease 0.2s;
    }

    .selectMultiple>ul li {
        color: #1e2330;
        background: #fff;
        padding: 12px 16px;
        cursor: pointer;
        overflow: hidden;
        position: relative;
        transition: background 0.3s ease, color 0.3s ease, transform 0.3s ease 0.3s, opacity 0.5s ease 0.3s, border-radius 0.3s ease 0.3s;
    }

    .selectMultiple>ul li:first-child {
        border-radius: 8px 8px 0 0;
    }

    .selectMultiple>ul li:first-child:last-child {
        border-radius: 8px;
    }

    .selectMultiple>ul li:last-child {
        border-radius: 0 0 8px 8px;
    }

    .selectMultiple>ul li:last-child:first-child {
        border-radius: 8px;
    }

    .selectMultiple>ul li:hover {
        background: #bc101c;
        color: #fff;
    }

    .selectMultiple>ul li:after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 6px;
        height: 6px;
        background: rgba(0, 0, 0, .4);
        opacity: 0;
        border-radius: 100%;
        transform: scale(1, 1) translate(-50%, -50%);
        transform-origin: 50% 50%;
    }

    .selectMultiple>ul li.beforeRemove {
        border-radius: 0 0 8px 8px;
    }

    .selectMultiple>ul li.beforeRemove:first-child {
        border-radius: 8px;
    }

    .selectMultiple>ul li.afterRemove {
        border-radius: 8px 8px 0 0;
    }

    .selectMultiple>ul li.afterRemove:last-child {
        border-radius: 8px;
    }

    .selectMultiple>ul li.remove {
        transform: scale(0);
        opacity: 0;
    }

    .selectMultiple>ul li.remove:after {
        animation: ripple 0.4s ease-out;
    }

    .selectMultiple>ul li.notShown {
        display: none;
        transform: scale(0);
        opacity: 0;
        transition: transform 0.35s ease, opacity 0.4s ease;
    }

    .selectMultiple>ul li.notShown.show {
        transform: scale(1);
        opacity: 1;
    }

    .selectMultiple.open>div {
        box-shadow: 0 4px 20px -1px rgba(22, 42, 90, .12);
    }

    .selectMultiple.open>div .arrow:before {
        transform: rotate(-50deg);
    }

    .selectMultiple.open>div .arrow:after {
        transform: rotate(50deg);
    }

    .selectMultiple.open>ul {
        transform: translate(0, 12px) scale(1);
        opacity: 1;
        visibility: visible;
        filter: drop-shadow(0 16px 24px rgba(22, 42, 90, .16));
        max-height: 150px;
        overflow-y: scroll;
    }

    .selectMultiple>ul::-webkit-scrollbar {
        width: 5px;
    }

    .selectMultiple>ul::-webkit-scrollbar-track {
        background: transparent;
    }

    .selectMultiple>ul::-webkit-scrollbar-thumb {
        background: #db1c29;
    }

    @keyframes ripple {
        0% {
            transform: scale(0, 0);
            opacity: 1;
        }

        25% {
            transform: scale(30, 30);
            opacity: 1;
        }

        100% {
            opacity: 0;
            transform: scale(50, 50);
        }
    }

    #modalbody {
        display: none;
    }

    .text-primary.font-weight-bold {
        color: #1e2d62;
    }

    @media only screen and (max-width: 1200px) {
        .margin-media-query {
            margin-bottom: 35px;
        }
    }

    .fs-30 {
        font-size: 20px;
        font-size: 20px;
        margin-block: 7px;
        vertical-align: inherit;
    }

    .new-tag {
        background-color: #ff0000;
        color: #ffffff;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .dropdown-menu {
        max-height: 200px;
        overflow-y: auto;
    }

    input[type=range] {
        width: 100%;
        display: block;
    }

    .indicator {
        padding: 5px;
        background-color: black;
        color: white;
        position: absolute;
        right: 0;
        border-radius: 5px;
    }

    .dropdown {
        position: relative;
        width: 100%;
    }

    .dropdown-toggle {
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.25rem;
    }

    .dropdown-menu.year-dropdown {
        width: 90%;
        max-height: 200px;
        overflow-y: auto;
        padding: 0;
        margin: 0;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .dropdown-item {
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        color: #212529;
        text-decoration: none;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #16181b;
    }

    @media (max-width: 576px) {
        .dropdown-menu.year-dropdown {
            position: true;
        }

        .dropdown-toggle {
            margin-bottom: 10px;
        }
    }

    .dropdown-menu {
        flex-direction: column;
        position: absolute;
        top: 90%;
        left: 14px;
        margin: 0;
        padding: 0;
        background-color: #fff;
        border: 1px solid #ccc;
        max-height: 300px;
        overflow-y: auto;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
        width: auto;
    }

    .dropdown-item {
        padding: 10px 15px;
        font-size: 14px;
        color: #333;
        text-decoration: none;
        display: block;
        border-bottom: 1px solid #eee;
    }

    .dropdown-item:hover {
        background-color: #f1f1f1;
    }

    @media (max-width: 768px) {
        .dropdown-menu {
            width: 100%;
            position: relative;
            max-height: 400px;
        }

        .dropdown-item {
            padding: 12px 20px;
            font-size: 16px;
            text-align: center;
        }
    }

    @media (max-width: 480px) {
        .dropdown-item {
            font-size: 18px;
            padding: 15px 20px;
        }
    }

    .ribbon-box .ribbon-two {
        overflow: hidden;
        width: 100px;
        text-align: right;
        left: -11px;
        display: block;
    }

    button.ribbon-box {
        border: none;
    }

    .ribbon-box .ribbon-two span {
        font-size: 13px;
        color: #fff;
        text-align: center;
        line-height: 20px;
        width: 100px;
        display: block;
        font-weight: 500;
    }

    .ribbon-box .ribbon-two-danger span {
        background: #078528;
    }

    form#searchForm {
        position: relative;
    }

    .ribbon-box.right.ribbon-box .ribbon-two span {
        left: auto;
        right: -21px;
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>
<form action="{{ route('Save.Filtered.Records') }}" method="post" class="faq-accordion" id="filterForm">
    @csrf
    <ul class="accordion">
        <div class="d-flex justify-content-start">
            <button class="btn " style="background-color: #1e2d62; color: #fff;" type="button"
                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                Save Filter List
            </button>
        </div><br>
        <li class="accordion-item">
            <a class="accordion-title active" id="accordian_title" href="javascript:void(0)">
                <i class="bx bx-plus"></i>
                Advanced Searching Options
            </a>
            <div class="accordion-content" id="accordian_content">
                <!-- <h6 class="my-3 text-bold">Origin Location</h6> -->
                <div class="row mb-4">
                    <div class="col-lg-6">
                        <h5 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">Origin
                            Information</h5>
                        <div class="row">
                            <!-- <div class="col-lg-3">
                                   <div class="form-group">
                                       <label>Origin Address</label>
                                       <input type="text" class="form-control Origin_ZipCode typeahead"
                                           placeholder="Enter ZipCode, City, State" name="Origin_Address" id="Origin_Address" value="">
                                       <div id="Origin_ZipCode_list"></div>
                                   </div>
                               </div> -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="d-block">Regions specific Loads</label>
                                    <select class="custom-select custom-multi-select" multiple name="option[]"
                                            id="Origin_Address">
                                        <!-- <option value="">Select</option> -->
                                        <option value="NorthEast">NorthEast (CT, DE, MA, ME, NH, NJ, NY, PA, RI, VT )
                                        </option>
                                        <option value="SouthEast">SouthEast (AL, DC, FL, GA, KY, MD, NC, SC, TN, VA,
                                            WV)
                                        </option>
                                        <option value="MiddleWest Plains">MiddleWest Plains (IA, IL, IN, KS, MI, MN,
                                            MO,
                                            ND, NE, OH, SD, WI)</option>
                                        <option value="South">South (AR, LA, MS, OK, TX)</option>
                                        <option value="NorthWest">NorthWest (ID, MT, OR, WA, WY)</option>
                                        <option value="SouthWest">SouthWest (AZ, CA, CO, NM, NV, UT, PA, RI, VT)
                                        </option>
                                        <option value="Pacific">Pacific (AK, HI)</option>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-sm-6">
                                   <div class="form-group">
                                       <label>City</label>
                                       <input readonly type="text" class="form-control origin_city" placeholder="City"
                                           name="Origin_City" value="">
                                   </div>
                               </div> -->
                            <div class="col-sm-6">
                                <label>City</label>
                                <div class="input-wrapper">
                                    <div id="selected_cities_input" class="selected-cities-input"></div>
                                    <input type="text"
                                           value="{{ is_array($originCity) ? $originCity[0] : $originCity }}"
                                           class="ajax_city" placeholder="Type to search cities..." id="Origin_City">
                                </div>
                                <ul id="ajax_city_list" class="dropdown-list"></ul>
                                <input type="hidden" class="Origin_City" name="Origin_City" id="Origin_City">
                                <input type="hidden" class="origin_state" name="origin_state">
                            </div>
                            <!-- {{-- <div class="form-group">
                                        <label>City</label>
                                        <input type="text" class="form-control origin_city ajax_city typeahead"
                                            placeholder="Enter City" name="Origin_City" value="" id="Origin_City">
                                        <div id="ajax_city_list"></div>
                                    </div> --}} -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label> State</label>
                                    <input type="text"
                                           value="{{ is_array($Origin_State) ? $Origin_State[0] : $Origin_State }}"
                                           class="form-control origin_state ajax_state typeahead"
                                           placeholder="Enter State" name="Origin_State" id="Origin_State" value="">
                                    <div id="ajax_state_list"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label> ZipCode</label>
                                    <input type="text" class="form-control origin_zipcode" placeholder="ZipCode"
                                           name="Origin_ZipCode_single" value="" id="Origin_ZipCode_single">
                                    <div id="origin_zipcode_list"></div>
                                </div>
                            </div>
                            <!-- <div class="col-lg-2">
                                   <div class="form-group">
                                       <label>State</label>
                                       <input readonly type="text" class="form-control origin_state" placeholder="State"
                                           name="Origin_State" value="">
                                   </div>
                               </div> -->
                            {{-- <div class="col-sm-6">
                               <div class="form-group">
                                   <label>Radius</label>
                                   <input type="text" class="form-control origin_radius"
                                       placeholder="Enter Radius" name="Origin_Radius" value="">
                               </div>
                           </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h5 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                            Destination Information</h5>
                        <!-- <h6 class="my-3 text-bold">Destination Location</h6> -->
                        <div class="row">
                            <!-- <div class="col-sm-6">
                                   <div class="form-group">
                                       <label>Destination Address</label>
                                       <input type="text" class="form-control Dest_ZipCode typeahead"
                                           placeholder="Enter ZipCode, City, State" name="Destination_Address" id="Destination_Address" value="">
                                   </div>
                                   <div id="Dest_ZipCode_list"></div>
                               </div> -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Regions specific Loads</label>
                                    <select class="custom-select custom-multi-select" multiple
                                            name="Destination_Address[]" id="Destination_Address">
                                        <!-- <option value="">Select</option> -->
                                        <option value="NorthEast">NorthEast (CT, DE, MA, ME, NH, NJ, NY, PA, RI, VT )
                                        </option>
                                        <option value="SouthEast">SouthEast (AL, DC, FL, GA, KY, MD, NC, SC, TN, VA,
                                            WV)</option>
                                        <option value="MiddleWest Plains">MiddleWest Plains (IA, IL, IN, KS, MI, MN,
                                            MO, ND, NE, OH, SD, WI)</option>
                                        <option value="South">South (AR, LA, MS, OK, TX)</option>
                                        <option value="NorthWest">NorthWest (ID, MT, OR, WA, WY)</option>
                                        <option value="SouthWest">SouthWest (AZ, CA, CO, NM, NV, UT, PA, RI, VT)
                                        </option>
                                        <option value="Pacific">Pacific (AK, HI)</option>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-sm-6">
                                   <div class="form-group">
                                       <label>City</label>
                                       <input readonly type="text" class="form-control dest_city" placeholder="City"
                                           name="Destination_City" value="">
                                   </div>
                               </div> -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text"
                                           value="{{ is_array($destCity) ? $destCity[0] : $destCity }}"
                                           class="form-control dest_city dest_ajax_city typeahead"
                                           placeholder="Enter City" name="Dest_City" value="" id="Dest_City">
                                    <div id="dest_ajax_city_list"></div>
                                </div>
                            </div>
                            <!-- <div class="col-lg-2">
                                   <div class="form-group">
                                       <label>State</label>
                                       <input readonly type="text" class="form-control dest_state" placeholder="State"
                                           name="Destination_State" value="">
                                   </div>
                               </div> -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label> State</label>
                                    <input type="text"
                                           value="{{ is_array($Destination_State) ? $Destination_State[0] : $Destination_State }}"
                                           class="form-control dest_state dest_ajax_state typeahead"
                                           placeholder="Enter State" name="Destination_State" id="Destination_State"
                                           value="">
                                    <div id="dest_ajax_state_list"></div>
                                </div>
                            </div>
                            <!-- <div class="col-sm-6">
                                   <div class="form-group">
                                       <label>ZipCode</label>
                                       <input readonly type="text" class="form-control dest_zipcode" placeholder="ZipCode"
                                           name="Destination_ZipCode" value="">
                                   </div>
                               </div> -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label> ZipCode</label>
                                    <input type="text" class="form-control dest_zipcode" placeholder="ZipCode"
                                           name="Destination_ZipCode_single" value=""
                                           id="Destination_ZipCode_single">
                                    <div id="dest_zipcode_list"></div>
                                </div>
                            </div>
                            {{-- <div class="col-sm-6">
                               <div class="form-group">
                                   <label>Radius</label>
                                   <input type="text" class="form-control dest_radius" placeholder="Enter Radius"
                                       name="Destination_Radius" value="">
                               </div>
                           </div> --}}
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-6">
                        <h5 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                            Shipper
                            Preferrence</h5>
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="customControlValidation2"
                                           name="Shipper_Preferences" value="0" checked>
                                    <label class="custom-control-label" for="customControlValidation2">Only
                                        Preferred Shippers</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="custom-control custom-radio mb-3">
                                    <input type="radio" class="custom-control-input" id="customControlValidation3"
                                           name="Shipper_Preferences" value="1">
                                    <label class="custom-control-label" for="customControlValidation3">Include
                                        Blocked Shippers</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Rating</label>
                                    <!-- <input type="text" class="form-control typeahead"
                                           placeholder="Enter Rating" name="Rating" id="Rating" value=""> -->
                                    <select name="Rating[]" id="Rating" class="custom-select custom-multi-select"
                                            multiple>
                                        <option value="">Select</option>
                                        <option value="5" style="font-size: x-large;color: #ebb000;">5 ★★★★★
                                        </option>
                                        <option value="4" style="font-size: x-large;color: #ebb000;">4 ★★★★
                                        </option>
                                        <option value="3" style="font-size: x-large;color: #ebb000;">3 ★★★
                                        </option>
                                        <option value="2" style="font-size: x-large;color: #ebb000;">2 ★★
                                        </option>
                                        <option value="1" style="font-size: x-large;color: #ebb000;">1 ★
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="custom-control custom-radio mb-3">
                                    <input type="radio" class="custom-control-input" id="customControlValidation4"
                                           name="Shipper_Preferences" value="Select Shipper">
                                    <label class="custom-control-label" for="customControlValidation4">Select
                                        Shippers</label>
                                </div>
                                <div class="form-group" id="inputContainer-1" style="display: none;">
                                    {{-- <label>Show All Active Listings of Company</label> --}}
                                    <input type="text" class="form-control" id="textInput"
                                           placeholder="Enter Company" value="" name="compActive">
                                    <ul class="dropdown-menu year-dropdown" id="searchResults"></ul>
                                </div>
                            </div>
                            {{-- <div class="col-lg-6">
                                   <div class="form-group" id="inputContainer" style="display: none;">
                                       <label>Show All Active Listings of Company</label>
                                       <input type="text" class="form-control" id="textInput" placeholder="Enter Company"
                                           value="" name="compActive">
                                       <ul class="dropdown-menu year-dropdown" id="searchResults"></ul>
                                   </div>
                               </div> --}}

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h5 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                            Dispatch Details</h5>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>*Ready to Ship Within</label>
                                    <select class="custom-select" name="Ship_Ready" id="Ship_Ready">
                                        <option value="">Select Vehicle</option>
                                        <option value="1">Today</option>
                                        <option value="2">2 Days</option>
                                        <option value="3">3 Days</option>
                                        <option value="4">4 Days</option>
                                        <option value="5">5 Days</option>
                                        <option value="6">6 Days</option>
                                        <option value="7">1 Week</option>
                                        <option value="15">15 Days</option>
                                        <option value="30">1 Month</option>
                                        <option value="60">60 Days</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Desired Delivery Date</label>
                                    <input type="date" class="form-control"
                                           placeholder="Enter ZipCode, City, State" name="Prop_Date" value="">
                                </div>
                            </div>
                            {{-- <div class="col-sm-6">
                                   <div class="form-group">
                                       <label>Listing Display:</label><br>
                                       <label>Posted Within (hours)</label>
                                       <input type="range" name="Posted_Hrs" class="form-control-range"
                                           min="0" value="0" max="12" step="1" id="mySlider">
                                       <div class="indicator">
                                           1 Hour
                                       </div>
                                   </div>
                               </div> --}}
                        </div>
                    </div>
                </div>
                <div class="advanced-filter">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h5 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                                Cargo
                                Details</h5>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Vehicle Type</label>
                                        <select class="custom-select custom-multi-select"
                                                data-placeholder="Vehicle Type" multiple name="Vehcile_Type[]"
                                                id="Vehcile_Type">
                                            {{-- <option selected="" value="">Select Vehicle Type</option> --}}
                                            <option value="Car">Car</option>
                                            <option value="SUV">SUV</option>
                                            <option value="Pickup">Pickup</option>
                                            <option value="Van">Van</option>
                                            {{-- <option disabled="">â€”â€”â€”â€”â€”â€”â€”â€”â€”â€”â€”â€”</option> --}}
                                            <option value="motorcycle">Motorcycle</option>
                                            <option value="atv">ATV</option>
                                            {{-- <option disabled="">â€”â€”â€”â€”â€”â€”â€”â€”â€”â€”â€”â€”</option> --}}
                                            <option value="Mini Van">Mini Van</option>
                                            <option value="Cargo Van">Cargo Van</option>
                                            <option value="Passenger Van">Passenger Van</option>
                                            {{-- <option disabled="">â€”â€”â€”â€”â€”â€”â€”â€”â€”â€”â€”â€”</option> --}}
                                            <option value="Boat">Boat</option>
                                            <option value="Large Yacht">Large Yacht</option>
                                            <option value="RVs">RVs</option>
                                            <option value="Travel Trailer">Travel Trailer</option>
                                            {{-- <option disabled="">â€”â€”â€”â€”â€”â€”â€”â€”â€”â€”â€”â€”</option> --}}
                                            <option value="other_vehicle">Other Vehicle</option>
                                            <option value="other_motorcycle">Other Motorcycle</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="col-sm-6">
                               <div class="form-group">
                                   <label>Vehicle Condition</label>
                                   <select data-placeholder="Select Vehicle Condition"
                                       class="custom-select custom-multi-select" multiple name="Vehcile_Condition[]"
                                       id="Vehcile_Condition">
                                       <option value="Running">Running</option>
                                       <option value="Not Running">Not Running</option>
                                   </select>
                               </div>
                           </div> --}}
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Vehicle Condition</label>
                                        <div class="custom-checkbox-group d-flex mt-2">
                                            <div class="form-check fs-5">
                                                <input class="form-check-input" type="checkbox"
                                                       name="Vehcile_Condition[]" id="conditionRunning"
                                                       value="Running">
                                                <label class="form-check-label" for="conditionRunning">
                                                    Running
                                                </label>
                                            </div>
                                            <div class="form-check ms-3 fs-5">
                                                <input class="form-check-input" type="checkbox"
                                                       name="Vehcile_Condition[]" id="conditionNotRunning"
                                                       value="Not Running">
                                                <label class="form-check-label" for="conditionNotRunning">
                                                    Not Running
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Trailer Type</label>
                                        <select data-placeholder="Select Trailer"
                                                class="custom-select custom-multi-select" multiple name="Trailer_Type[]"
                                                id="Trailer_Type">
                                            <option value="Open">Open</option>
                                            <option value="Enclosed">Enclosed</option>
                                            <option value="Drive Away">Drive Away</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Min# Vehicle</label>
                                        <input type="number" class="form-control" placeholder="0"
                                               name="Min_Vehicle" value="" max="10" min="0"
                                               step="1" id="Min_Vehicle">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Max# Vehicle</label>
                                        <input type="number" class="form-control" placeholder="0"
                                               name="Max_Vehicle" value="" max="10" min="0"
                                               step="1" id="Max_Vehicle">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h5 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                                Payment
                                Details</h5>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Payment Type</label>
                                        <select data-placeholder="Select Payment Mode"
                                                class="custom-select custom-multi-select" multiple name="Payment_Type[]"
                                                id="Payment_Type">
                                            <option value="COD">COD / COP</option>
                                            <option value="Quick Pay">Quick Pay / ComCheck</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Min Pay</label>
                                        <input type="number" class="form-control" placeholder="$0"
                                               name="Min_Total_Pay" value="" id="Min_Total_Pay">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Pay Per Mile</label>
                                        <input type="number" class="form-control" placeholder="$0"
                                               name="Min_Rate_Pay" value="" id="Min_Rate_Pay">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h5 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                                Post Heavy Load Equipment Details</h5>
                            {{-- <h6 class="my-3 text-bold">Post Heavy Vehicle Equipment Details</h6> --}}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Shipment Type</label>
                                        <select data-placeholder="Select Shipment Type"
                                                class="custom-select custom-multi-select" multiple
                                                name="Equipment_Type[]" id="Equipment_Type">
                                            <!-- <option value="">Select Shipment Type</option> -->
                                            <option value="VAN">VAN</option>
                                            <option value="REEFER  ">REEFER </option>
                                            <option value="Flatbed Trailer">FLATBED</option>
                                            <option value="STEP OR DROP DECK ">STEP OR DROP DECK </option>
                                            <option value="REMOVABLE GOOSENECK (RGN) ">REMOVABLE GOOSENECK (RGN)
                                            </option>
                                            <option value="CONESTOGA ">CONESTOGA </option>
                                            <option value="CONTAINER / DRAYAGE ">CONTAINER / DRAYAGE </option>
                                            <option value="STRAIGHT TRUCK / BOX TRUCK /SPRINTER ">STRAIGHT TRUCK / BOX
                                                TRUCK /SPRINTER </option>
                                            <option value="HAZMAT ">HAZMAT </option>
                                            <option value="POWER ONLY ">POWER ONLY </option>
                                            <option value="HOT SHOT ">HOT SHOT </option>
                                            <option value="LOWBOY ">LOWBOY </option>
                                            <option value="ENDUMP">ENDUMP</option>
                                            <option value="LANDOLL ">LANDOLL </option>
                                            <option value="PARTIAL ">PARTIAL </option>
                                            <option value="20ft container">20ft container</option>
                                            <option value="48ft container">48ft container</option>
                                            <option value="53ft container">53ft container</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Shipment Prefrences</label>
                                        <select data-placeholder="Select Shipment Preferences"
                                                class="custom-select custom-multi-select" multiple
                                                name="Shipment_Prefrences[]" id="Shipment_Prefrences">
                                            <!-- <option value="">Select Shipment Preferences</option> -->
                                            <option value="LTL">LTL</option>
                                            <option value="FTL">FTL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Trailer Specification</label>
                                        <select data-placeholder="Select Trailer Specification"
                                                class="custom-select custom-multi-select" multiple
                                                name="Trailer_Specification[]" id="Trailer_Specification">
                                            <!-- <option value="">Select Trailer Specification</option> -->
                                            <option value="LTL (Less Than Truck Load)">LTL (Less Than Truck Load)
                                            </option>
                                            <option value="FTL (Full Truck Load)">FTL (Full Truck Load)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Min Length</label>
                                        <input type="number" class="form-control" placeholder="1.00"
                                               name="Min_Length" value="" id="Min_Length">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Max Length</label>
                                        <input type="number" class="form-control" placeholder="0.00"
                                               name="Max_Length" value="" id="Max_Length">
                                    </div>
                                </div>
                                {{-- <span class="text-bold"><h6>|</h6></span> --}}

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Min Width</label>
                                        <input type="number" class="form-control" placeholder="1.00"
                                               name="Min_Width" value="" id="Min_Width">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Max Width</label>
                                        <input type="number" class="form-control" placeholder="0.00"
                                               name="Max_Width" value="" id="Max_Width">
                                    </div>
                                </div>
                                {{-- <span class="text-bold"><h6>|</h6></span> --}}

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Min Height</label>
                                        <input type="number" class="form-control" placeholder="1.00"
                                               name="Min_Height" value="" id="Min_Height">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Max Height</label>
                                        <input type="number" class="form-control" placeholder="0.00"
                                               name="Max_Height" value="" id="Max_Height">
                                    </div>
                                </div>
                                {{-- <span><h6 class="text-bold">|</h6></span> --}}

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Min Weight</label>
                                        <input type="number" class="form-control" placeholder="1.00"
                                               name="Min_Weight" value="" id="Min_Weight">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Max Weight</label>
                                        <input type="number" class="form-control" placeholder="0.00"
                                               name="Max_Weight" value="" id="Max_Weight">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h5 class="text-white py-2 d-flex justify-content-center" style="background: #113771;">
                                Post Fright Load Equipment Details</h5>
                            {{-- <h6 class="my-3 text-bold">Post Fright Load Equipment Details</h6> --}}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Fright Shipment Type</label>
                                        <select data-placeholder="Select Shipment Type"
                                                class="custom-select custom-multi-select" multiple
                                                name="Fright_Equipment_Type[]" id="Fright_Equipment_Type">
                                            <!-- <option value="">Select Shipment Type</option> -->
                                            <option value="VAN">VAN</option>
                                            <option value="REEFER  ">REEFER </option>
                                            <option value="Flatbed Trailer">FLATBED</option>
                                            <option value="STEP OR DROP DECK ">STEP OR DROP DECK </option>
                                            <option value="REMOVABLE GOOSENECK (RGN) ">REMOVABLE GOOSENECK (RGN)
                                            </option>
                                            <option value="CONESTOGA ">CONESTOGA </option>
                                            <option value="CONTAINER / DRAYAGE ">CONTAINER / DRAYAGE </option>
                                            <option value="STRAIGHT TRUCK / BOX TRUCK /SPRINTER ">STRAIGHT TRUCK / BOX
                                                TRUCK /SPRINTER </option>
                                            <option value="HAZMAT ">HAZMAT </option>
                                            <option value="POWER ONLY ">POWER ONLY </option>
                                            <option value="HOT SHOT ">HOT SHOT </option>
                                            <option value="LOWBOY ">LOWBOY </option>
                                            <option value="ENDUMP">ENDUMP</option>
                                            <option value="LANDOLL ">LANDOLL </option>
                                            <option value="PARTIAL ">PARTIAL </option>
                                            <option value="20ft container">20ft container</option>
                                            <option value="48ft container">48ft container</option>
                                            <option value="53ft container">53ft container</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Fright Shipment Prefrences</label>
                                        <select data-placeholder="Select Shipment Preferences"
                                                class="custom-select custom-multi-select" multiple
                                                name="Fright_Shipment_Prefrences[]" id="Fright_Shipment_Prefrences">
                                            <!-- <option value="">Select Shipment Preferences</option> -->
                                            <option value="LTL">LTL</option>
                                            <option value="FTL">FTL</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Fright Trailer Specification</label>
                                        <select data-placeholder="Select Trailer Specification"
                                                class="custom-select custom-multi-select" multiple
                                                name="Fright_Trailer_Specification[]" id="Fright_Trailer_Specification">
                                            <!-- <option value="">Select Trailer Specification</option> -->
                                            <option value="LTL (Less Than Truck Load)">LTL (Less Than Truck Load)
                                            </option>
                                            <option value="FTL (Full Truck Load)">FTL (Full Truck Load)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Freight Class</label>
                                        <select data-placeholder="Select Freight Class"
                                                class="custom-select custom-multi-select" multiple name="Freight_Class[]"
                                                id="Freight_Class">
                                            <!-- <option value="">Select Freight Class</option> -->
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
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Min Freight Weight</label>
                                        <input type="number" class="form-control" placeholder="1.00"
                                               name="Min_Freight_Weight" value="" id="Min_Freight_Weight">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Max Freight Weight</label>
                                        <input type="number" class="form-control" placeholder="0.00"
                                               name="Max_Freight_Weight" value="" id="Max_Freight_Weight">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="row justify-content-center">
                    <div class="col-sm-2">
                        <button class="btn btn-warning btn-block toggle-filter" type="button">Show Advanced
                            Filter</button>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-primary btn-block search_btn" id="search_btn"
                                type="button">Search</button>
                    </div>
                    <div class="col-sm-2">
                        {{-- <button class="btn btn-danger btn-block reset_btn" type="reset">Reset</button> --}}
                        <a class="btn btn-danger btn-block reset_btn" href="{{ route('Filterd.Listing') }}"
                           type="reset">Reset</a>
                    </div>
                </div>
            </div>
        </li>
    </ul>
    <input type="hidden" id="filter_id" name="filter_id" value="0">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: red;">Saved Filter Lists</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInput" class="form-label">Enter Filter Name</label>
                        <input type="text" class="form-control" id="filter_name" name="name"
                               placeholder="Enter Filter Name" required="">
                    </div>
                    <div class="text-center mb-3">
                        <button type="button" id="Close" class="btn btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                        <button type="button" data-value="update" class="btn btn-primary save_as" disabled
                                id="update-btn">Save</button>
                        <button type="button" data-value="save_new" class="btn btn-primary save_as">Save as
                            new</button>
                    </div>
                    <!-- Scrollable table area -->
                    <div style="max-height: 250px; overflow-y: auto;"> <!-- Adjust max-height as needed -->
                        <div class="table-responsive">
                            <table
                                class="table-1 dataTable advance-6e datatable-range text-center table-bordered table-cards">
                                <thead class="table-header">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Filter Name</th>
                                    <th scope="col">Origin</th>
                                    <th scope="col">Destination</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($SaveFilter as $key => $save)
                                    <tr class="card-row" data-status="active">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $save->name }}</td>
                                        <td>{{ $save->origin_address ?? '-' }}</td>
                                        <td>{{ $save->destination_address ?? '-' }}</td>
                                        <td>
                                            <a href="#" class="edit-filter"
                                               data-filter-id="{{ $save->id }}"
                                               style="text-decoration: none;">
                                                Edit
                                            </a><br>
                                            <a href="#" id="Select" class="edit-filter"
                                               data-filter-id="{{ $save->id }}"
                                               style="text-decoration: none;">
                                                Select
                                            </a><br>
                                            <a href="{{ route('delete.filter.record', $save->id) }}"
                                               style="text-decoration: none;">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No Any Save Filter</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- End of scrollable area -->
                </div>
            </div>
        </div>
    </div>
</form>
<div class="container-flude">
    <div class="card card-new m-4">
        <div class="card-body" id="listing_data">
            @include('partials.filter.fetch-filtered-records')

        </div>
    </div>
</div>
<div class="modal fade" id="requestCarrier" data-backdrop="true" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Request Carrier For Order ID: <span class="get_Order_ID"></span></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body user-settings-box">
                <form action="{{ route('User.Request.Carrier') }}" method="POST" class="was-validated">
                    @csrf
                    <input hidden type="text" name="get_Listed_ID" class="get_Listed_ID" value="">
                    <input hidden type="text" name="get_Ref_ID" class="get_Ref_ID" value="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" class="form-control" value="" name="Requested_Email"
                                       required>
                                <div class="invalid-feedback">
                                    Email Required.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Message</label>
                                <textarea rows="3" class="form-control" name="Requested_Comments" required>
                                        We Like to offer you the load, with the listed price given below, for further detail Click the Proceed Button Below!
                                    </textarea>
                                <div class="invalid-feedback">
                                    Message Required.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="btn-box text-center">
                                <button type="submit" class="submit-btn w-100"><i class='bx bx-save'></i>
                                    Submit Request
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- Carrier Request Load --}}
<div class="modal fade" id="CarrierRequestLoad" data-backdrop="true" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Request Load For Order ID: <span class="get_Order_ID"></span></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body user-settings-box" id="modalbody">
                <form action="{{ route('User.Request.Broker') }}" method="POST" class="was-validated"
                      id="request_load_clear">
                    @csrf
                    <input hidden type="text" name="get_Listed_ID" class="get_Listed_ID" value="">
                    <input hidden type="text" name="get_Ref_ID" class="get_Ref_ID" value="">
                    <input hidden type="text" name="type" class="check_type">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Current Price (Order Price)</label>
                                <input readonly type="text" class="form-control" id="get_Listed_Price"
                                       value="" name="Current_Price" required>
                            </div>
                            <!--<div class="form-group form-check" id="offer">-->
                            <!--    <input type="checkbox" class="form-check-input" id="offer_Check">-->
                            <!--    <label class="form-check-label" for="offer_Check">If You have any Offer?</label>-->
                            <!--</div>-->
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group offer-price">
                                <label>My Bid (Order Price)</label>
                                <div class="bidoffer">

                                </div>
                                <div class="invalid-feedback offer-required">
                                    Bid Price is Required.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group offer-price" id="offer-Bid">
                                <label>Bid Comment</label>
                                <input type="text" class="form-control" placeholder="Enter Your Bid Comment"
                                       value="" name="Bid_Comment">
                                <!--<div class="invalid-feedback offer-required">-->
                                <!--    Offer Price is Required.-->
                                <!--</div>-->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Date to Pickup *</label>
                                <select class="custom-select" name="Date_Pickup_Mode" required>
                                    <option value="">Select AnyOne</option>
                                    <option value="Estimated">Estimated</option>
                                    <option value="Exactly">Exactly</option>
                                    <option value="No Earlier Than">No Earlier Than</option>
                                    <option value="No Later Than">No Later Than</option>
                                </select>
                                <div class="invalid-feedback">Select AnyOne</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Pickup Date</label>
                                <input type="date" class="form-control pickup-date" placeholder="Pickup Date"
                                       name="Pickup_Date" required>
                                <div class="invalid-feedback">
                                    Entered Pickup Date.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Date to Delivery *</label>
                                <select class="custom-select" name="Date_Delivery_Mode" required>
                                    <option value="">Select AnyOne</option>
                                    <option value="Estimated">Estimated</option>
                                    <option value="Exactly">Exactly</option>
                                    <option value="No Earlier Than">No Earlier Than</option>
                                    <option value="No Later Than">No Later Than</option>
                                </select>
                                <div class="invalid-feedback">Select AnyOne</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Delivery Date</label>
                                <input type="date" class="form-control deliver-date" placeholder="Delivery Date"
                                       name="Delivery_Date" required>
                                <div class="invalid-feedback">
                                    Entered Delivery Date.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="acknoledgement" required>
                                <label class="form-check-label" for="acknoledgement">I acknowledge and agree that
                                    once
                                    the I has accepted the request, I will be entered into a legal contract with Day
                                    Dispatch for the transportation of vehicle(s).<br> I further acknowledge and agree
                                    i
                                    have no obligation or liability whatsoever arising out of such contract. I consent
                                    to Day Dispatch adding a provision to this effect in my dispatch sheets. I also
                                    understand that any changes that I make to the dispatch sheet after I has accepted
                                    the request, unless I has approved the change, and may not be binding on the
                                    customer or company.</label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="btn-box text-center">
                                <button type="submit" class="submit-btn w-100 margin-media-query"><i
                                        class='bx bx-save'></i>
                                    Submit Request
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div id="requested">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card" onclick="requestforform('1')">
                            <span class="icon"><i class="bx bx-git-pull-request"></i></span>
                            <p>
                                Request for Load
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card" onclick="requestforform('2')">
                            <span class="icon"><i class="bx bx-git-pull-request"></i></span>
                            <p>
                                Bid for load
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="CarrierRequests" data-backdrop="true" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Request Load For Order ID: <span class="get_Order_ID"></span></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body user-settings-box">
                <input hidden type="text" name="get_Listed_ID" class="get_Listed_ID" value="">
                <div class="table-responsive" id="all-fetch-requests">
                </div>
            </div>

            {{-- @foreach ($Lisiting as $item)
                   <div class="modal-body user-settings-box">
                       <input hidden type="text" name="get_Listed_ID" class="get_Listed_ID" value="">
                       <div class="table-responsive" id="all-fetch-requests">
                       </div>
                   </div>
               @endforeach --}}
        </div>
    </div>
</div>
<div class="modal fade" id="processingModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <p>Processing your request. Please wait...</p>
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    // document.getElementById('search_btn').addEventListener('click', function() {
    //     var cardNewDiv = document.querySelector('.card-new');
    //     cardNewDiv.style.display = 'none';
    // });

    // $(document).on('change', '#perPage', function() {
    //        $('#search_btn').click();
    // });
    // $(document).on('click', '.pagination a', function (e) {
    //     e.preventDefault();
    //     var page = $(this).attr('href').split('page=')[1];
    //     $('#currentPage').val(page);
    //     $('#search_btn').click();
    // });
</script>
<script>
    $(document).on('click', '.accordion-title', function() {
        const $accordionItem = $(this).closest('.accordion-item');
        const $accordionContent = $accordionItem.find('.accordion-content');
        $accordionItem.toggleClass('active');
        $accordionContent.slideToggle(300);
        $('.accordion-item').not($accordionItem).removeClass('active');
        $('.accordion-content').not($accordionContent).slideUp(300);
    });
</script>
<script>
    document.getElementById('Min_Vehicle').addEventListener('input', function() {
        var value = parseFloat(this.value);
        if (value > 10) {
            this.value = 10;
        }
    });
</script>
<script>
    document.getElementById('Max_Vehicle').addEventListener('input', function() {
        var value = parseFloat(this.value);
        if (value > 10) {
            this.value = 10;
        }
    });
</script>
<script>
    // $('.advance-6e').DataTable({
    //     "deferRender": true,
    //     "searching": false,
    //     "info": false,
    //     "lengthMenu": [
    //         [50, 100, 150, 200, 250],
    //         [50, 100, 150, 200, 250]
    //     ],
    //     "paging": true,
    //     // "order": [
    //     //     [0, 'asc']
    //     // ],
    //     "processing": true,
    //     "language": {
    //         "emptyTable": "No data available",
    //         "lengthMenu": "Show _MENU_ entries",
    //         "zeroRecords": "No matching records found",
    //         "infoEmpty": "No entries available"
    //     },
    //     "columnDefs": [{
    //         "targets": -1,
    //         "orderable": false,
    //     }],
    //     "createdRow": function(row, data, dataIndex) {
    //         $(row).hide().fadeIn(1000);
    //     },
    //     "drawCallback": function(settings) {
    //         var api = this.api();
    //         api.rows().every(function() {
    //             var row = this.node();
    //             $(row).hide().fadeIn(1000);
    //         });
    //     },
    //     "initComplete": function(settings, json) {
    //         var table = $(this);
    //         table.find('tbody').fadeIn(1000);
    //     }
    // });

    $(document).ready(function() {
        $('.reset_btn').on('click', function() {
            $('#filterForm').reset();
            $('#search_btn').trigger('click');
        });
    });
    var preferredShippersRadio = document.getElementById('customControlValidation2');
    preferredShippersRadio.addEventListener('click', function() {
        var textInput = document.getElementById('textInput');
        textInput.value = ""; // Clear the value of the input field
    });
    var preferredShippersRadio = document.getElementById('customControlValidation3');
    preferredShippersRadio.addEventListener('click', function() {
        var textInput = document.getElementById('textInput');
        textInput.value = ""; // Clear the value of the input field
    });

    $(document).on('click', '.search_btn', function() {
        // Show the processing modal
        $('#processingModal').modal('show');
        // Hide accordion sections
        $("#accordian_title").removeClass("active");
        $("#accordian_content").removeClass("show");
       var data_post =  $('#filterForm').serialize();
       var per_page = $('#perPage').val();
       var currentPage = $('#currentPage').val();
       var ajaxx = 1;
       data_post+=`&per_page=${per_page}`
       data_post+=`&ajaxx=${ajaxx}`
       data_post+=`&page=${currentPage}`
        $.ajax({
            url: '{{ route('Get.Filtered.Records') }}',
            type: 'GET',
            data: data_post,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                if (data.html.trim() !== '') {
                    // $('.card').removeClass('d-none'); // Show the card if hidden
                    $('#listing_data').html(data.html); // Update content
                } else {
                    $('#listing_data').html(
                        '<p>No results found.</p>'); // Fallback message
                }
                setTimeout(function() {
                    $('#processingModal').modal('hide');
                }, 500); // 3000 milliseconds (3 seconds)

            },
            error: function(xhr, status, error) {
                $('#listing_data').html('<p>Error loading data.</p>'); // Error fallback
                console.error('AJAX error:', status, error);
            },
            complete: function() {
                // Hide the processing modal once the request is complete
                $('#processingModal').modal('hide');
            }
        });
    });
    // Get Origin Location For Filter
    $('.Origin_ZipCode').on('keyup', function() {
        const query = $(this).val();
        $.ajax({
            url: '{{ route('Get.Origin.Location') }}',
            type: 'GET',
            data: {
                'name': query
            },
            success: function(data) {
                $('#Origin_ZipCode_list').html(data);
            }
        })
    });
    $(document).on('click', '#Origin_ZipCode_list li', function() {
        const value = $(this).text();
        $('.Origin_ZipCode').val(value);
        const city_name = $('#Origin_ZipCode_list li input.city_name').val();
        const state_name = $('#Origin_ZipCode_list li input.state_name').val();
        const zipcode = $('#Origin_ZipCode_list li input.zipcode').val();
        $('input.origin_city').val(city_name);
        $('input.origin_state').val(state_name);
        $('input.origin_zipcode').val(zipcode);
        $('#Origin_ZipCode_list').html("");
    });
    // Get state For Filter
    $('.dest_ajax_state').on('keyup', function() {
        const query = $(this).val();
        $.ajax({
            url: '{{ route('Get.state') }}',
            type: 'GET',
            data: {
                'name': query
            },
            success: function(data) {
                $('#dest_ajax_state_list').html(data);
            }
        })
    });
    $(document).on('click', '#dest_ajax_state_list li', function() {
        const value = $(this).text();
        $('.dest_ajax_state').val(value);

        $('#dest_ajax_state_list').html("");
    });
    // Get state For Filter
    $('.ajax_state').on('keyup', function() {
        const query = $(this).val();
        $.ajax({
            url: '{{ route('Get.state') }}',
            type: 'GET',
            data: {
                'name': query
            },
            success: function(data) {
                $('#ajax_state_list').html(data);
            }
        })
    });
    $(document).on('click', '#ajax_state_list li', function() {
        const value = $(this).text();
        $('.ajax_state').val(value);

        $('#ajax_state_list').html("");
    });
    // Get Zipcode For Filter
    $('.origin_zipcode').on('keyup', function() {
        const query = $(this).val();
        $.ajax({
            url: '{{ route('Get.Zipcode') }}',
            type: 'GET',
            data: {
                'name': query
            },
            success: function(data) {
                $('#origin_zipcode_list').html(data);
            }
        })
    });
    $(document).on('click', '#origin_zipcode_list li', function() {
        const value = $(this).text();
        $('.origin_zipcode').val(value);
        $('#origin_zipcode_list').html("");
    });
    // Get dest Zipcode For Filter
    $('.dest_zipcode').on('keyup', function() {
        const query = $(this).val();
        $.ajax({
            url: '{{ route('Get.Zipcode') }}',
            type: 'GET',
            data: {
                'name': query
            },
            success: function(data) {
                $('#dest_zipcode_list').html(data);
            }
        })
    });
    $(document).on('click', '#dest_zipcode_list li', function() {
        const value = $(this).text();
        $('.dest_zipcode').val(value);
        $('#dest_zipcode_list').html("");
    });
    // Array to store selected cities
    let selectedCities = [];
    // Event listener for typing in the city input
    $('.ajax_city').on('keyup', function() {
        const query = $(this).val();
        if (query.length > 2) {
            $.ajax({
                url: '{{ route('Get.city') }}',
                type: 'GET',
                data: {
                    'name': query
                },
                success: function(data) {
                    $('#ajax_city_list').html(data);
                }
            });
        }
        if (query === '') {
            $('input.origin_state').prop('readonly', false);
        }
    });
    // Handle city selection from the dropdown list
    $(document).on('click', '#ajax_city_list li', function() {
        const cityWithState = $(this).text();
        const stateValue = $(this).find('input.state_name').val();
        if (!selectedCities.some(item => item.city === cityWithState)) {
            selectedCities.push({
                city: cityWithState,
                state: stateValue
            });
            renderSelectedCities();
        }
        $('#ajax_city_list').html("");
        $('.ajax_city').val('');
    });
    // Function to render selected cities in the input container
    function renderSelectedCities() {
        const inputContainer = $('#selected_cities_input');
        inputContainer.html('');
        selectedCities.forEach((item, index) => {
            inputContainer.append(
                `<span class="selected-city">
                        ${item.city}
                        <button class="remove-city" data-index="${index}">&times;</button>
                    </span>`
            );
        });
        $('input.Origin_City').val(selectedCities.map(item => item.city).join(','));
        $('input.origin_state').val(selectedCities.map(item => item.state).join(','));
    }
    // Handle removal of a selected city
    $(document).on('click', '.remove-city', function() {
        const cityIndex = $(this).data('index');
        selectedCities.splice(cityIndex, 1);
        renderSelectedCities();
        if (selectedCities.length === 0) {
            $('input.origin_state').prop('disabled', false);
            $('input.origin_zipcode').prop('disabled', false);
        }
    });
    // Get Dest City For Filter
    $('.dest_ajax_city').on('keyup', function() {
        const query = $(this).val();
        $.ajax({
            url: '{{ route('Get.city') }}',
            type: 'GET',
            data: {
                'name': query
            },
            success: function(data) {
                $('#dest_ajax_city_list').html(data);
            }
        });
    });
    $(document).on('click', '#dest_ajax_city_list li', function() {
        const cityWithState = $(this).text();
        const stateValue = $(this).find('input.state_name').val();
        $('.dest_ajax_city').val(cityWithState);
        $('input.dest_state').val(stateValue);
        $('#dest_ajax_city_list').html("");
    });
    // Get Destination Location For Filter
    $('.Dest_ZipCode').on('keyup', function() {
        const query = $(this).val();
        $.ajax({
            url: '{{ route('Get.Origin.Location') }}',
            type: 'GET',
            data: {
                'name': query
            },
            success: function(data) {
                $('#Dest_ZipCode_list').html(data);
            }
        })
    });
    $(document).on('click', '#Dest_ZipCode_list li', function() {
        const value = $(this).text();
        $('.Dest_ZipCode').val(value);
        const city_name = $('#Dest_ZipCode_list li input.city_name').val();
        const state_name = $('#Dest_ZipCode_list li input.state_name').val();
        const zipcode = $('#Dest_ZipCode_list li input.zipcode').val();
        $('input.dest_city').val(city_name);
        $('input.dest_state').val(state_name);
        $('input.dest_zipcode').val(zipcode);
        $('#Dest_ZipCode_list').html("");
    });
    $('.advanced-filter').hide();
    $('.toggle-filter').click(function() {
        $('.advanced-filter').slideToggle('slow');
    });
    let debounceTimeout;
    $('body').on('click', 'input[name="Shipper_Preferences"]', function() {
        if ($(this).prop('id') === 'customControlValidation4' && $(this).is(':checked')) {
            $('#inputContainer-1').show();
        } else {
            $('#inputContainer-1').hide();
        }
    });
    $('#textInput').keyup(function(e) {
        const inputText = $(this).val().trim();
        // Clear any pending debounce timeout
        clearTimeout(debounceTimeout);
        // Debounce function to limit AJAX calls
        debounceTimeout = setTimeout(() => {
            if (inputText.length < 2) {
                $('#searchResults').hide().empty();
                return;
            }
            // Show loader while fetching results
            $('#searchResults').html('<li class="dropdown-item text-center">Loading...</li>').show();
            $.ajax({
                url: '{{ route('Filter.All.Company') }}',
                method: 'GET',
                data: {
                    input: inputText
                },
                success: function(response) {
                    $('#searchResults').empty();
                    if (response.length === 0) {
                        $('#searchResults').html(
                            '<li class="dropdown-item text-center">No results found</li>'
                        );
                        return;
                    }
                    // Append each company as a dropdown item
                    $.each(response, function(index, company) {
                        const listItem = $('<li class="dropdown-item"></li>')
                            .text(
                                `${company.Company_Name} (${company.Company_City}, ${company.Company_State})`
                            )
                            .data('company',
                                company); // Store company data in the item
                        $('#searchResults').append(listItem);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    $('#searchResults').html(
                        '<li class="dropdown-item text-center text-danger">Error fetching results</li>'
                    );
                }
            });
        }, 300);
    });
    // Handle item selection
    $('#searchResults').on('click', '.dropdown-item', function() {
        const company = $(this).data('company');
        $('#textInput').val(company.Company_Name);
        $('#searchResults').hide();
    });
    // Hide dropdown when clicking outside
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#textInput, #searchResults').length) {
            $('#searchResults').hide();
        }
    });
    // Add keyboard navigation
    $('#textInput').on('keydown', function(e) {
        const dropdownItems = $('#searchResults .dropdown-item');
        const activeItem = dropdownItems.filter('.active');
        let nextItem;
        switch (e.key) {
            case 'ArrowDown':
                e.preventDefault();
                nextItem = activeItem.length ? activeItem.next() : dropdownItems.first();
                activeItem.removeClass('active');
                nextItem.addClass('active');
                break;
            case 'ArrowUp':
                e.preventDefault();
                nextItem = activeItem.length ? activeItem.prev() : dropdownItems.last();
                activeItem.removeClass('active');
                nextItem.addClass('active');
                break;
            case 'Enter':
                e.preventDefault();
                if (activeItem.length) {
                    activeItem.click();
                }
                break;
            case 'Escape':
                $('#searchResults').hide();
                break;
        }
    });
    $('#searchResults').on('click', '.dropdown-item', function() {
        $('#textInput').val($(this).text());
        $('#searchResults').hide();
    });
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#textInput, #searchResults').length) {
            $('#searchResults').hide();
        }
    });
    // Click event handler for search results list items
    $('#searchResults').on('click', 'li', function() {
        var selectedCompany = $(this).text();
        $('#textInput').val(selectedCompany);
        $('#searchResults').hide();
    });
    $('.origin_radius').prop('disabled', true);
    $('input[name="Destination_Radius"]').prop('disabled', true).val('');
    // Listen for changes in the Origin_ZipCode field
    $('.Origin_ZipCode').on('input', function() {
        if ($(this).val().trim() !== '') {
            $('.origin_radius').prop('disabled', false);
        } else {
            $('.origin_radius').prop('disabled', true);
        }
    });
    $('.Dest_ZipCode').on('input', function() {
        var destZipCodeValue = $(this).val().trim();
        if (destZipCodeValue) {
            $('input[name="Destination_Radius"]').prop('disabled', false);
        } else {
            $('input[name="Destination_Radius"]').prop('disabled', true).val('');
        }
    });
</script>
<script>
    $(document).on('click', '.edit-filter', function(e) {
        $('#update-btn').prop('disabled', false);
        event.preventDefault();
        var filterId = $(this).data('filter-id');
        $('#filter_id').val(filterId);
        console.log('filterId', filterId, $('#filter_id').val());
        $.ajax({
            url: '{{ route('Get.Filter.Data') }}',
            method: 'GET',
            data: {
                filter_id: filterId
            },
            success: function(response) {
                console.log('state response', response['origin_address']);
                $('#state').val(response['state']);
                $('#Origin_Address').val(response['origin_address']);
                $('#Origin_City').val(response['Origin_City']);
                $('#Origin_State').val(response['Origin_State']);
                $('#Destination_Address').val(response['destination_address']);
                $('#Dest_City').val(response['Dest_City']);
                $('#Destination_State').val(response['Destination_State']);
                $('#Rating').val(response['rating']);
                $('#mySlider').val(response['posted_hours']);
                $('#Ship_Ready').val(response['shipment_prefrences']);
                $('#Vehcile_Type').val(response['vehicle_type']);
                $('#Vehcile_Condition').val(response['vehicle_condition']);
                $('#Trailer_Type').val(response['trailer_type']);
                $('#Min_Vehicle').val(response['min_vehicle']);
                $('#Max_Vehicle').val(response['max_vehicle']);
                $('#Payment_Type').val(response['payment_type']);
                $('#Min_Total_Pay').val(response['min_total_pay']);
                $('#Min_Rate_Pay').val(response['min_rate_pay']);
                $('#Equipment_Type').val(response['equipment_type']);
                $('#Shipment_Prefrences').val(response['shipment_prefrences']);
                $('#Trailer_Specification').val(response['trailer_specification']);
                $('#Min_Length').val(response['min_length']);
                $('#Max_Length').val(response['max_length']);
                $('#Min_Width').val(response['min_width']);
                $('#Max_Width').val(response['max_width']);
                $('#Min_Height').val(response['min_height']);
                $('#Max_Height').val(response['max_height']);
                $('#Min_Weight').val(response['min_weight']);
                $('#Max_Weight').val(response['max_weight']);
                $('#Fright_Equipment_Type').val(response['freight_equipment_type']);
                $('#Fright_Shipment_Prefrences').val(response[
                    'freight_shipment_prefrences']);
                $('#Fright_Trailer_Specification').val(response[
                    'freight_trailer_specification']);
                $('#Freight_Class').val(response['freight_class']);
                $('#Min_Freight_Weight').val(response['min_freight_weight']);
                $('#Max_Freight_Weight').val(response['max_freight_weight']);
                $('#filter_name').val(response['name']);
                $('#textInput').val(response['comp_active']);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    // $(document).ready(function() {
    var savedFilterId = '{{ $savedFilterId }}';
    console.log('savedFilterId', savedFilterId);

    if (savedFilterId != null) {
        populateFilter();

        function populateFilter() {
            console.log('savedFilterId2', savedFilterId);
            $('#update-btn').prop('disabled', false);
            $('#filter_id').val(savedFilterId);
            console.log('filterId', savedFilterId, $('#filter_id').val());
            $.ajax({
                url: '{{ route('Get.Filter.Data') }}',
                method: 'GET',
                data: {
                    filter_id: savedFilterId
                },
                success: function(response) {
                    console.log('savedFilterId3', savedFilterId);
                    console.log('state response', response['origin_address']);
                    $('#state').val(response['state']);
                    $('#Origin_Address').val(response['origin_address']);
                    $('#Origin_City').val(response['Origin_City']);
                    $('#Origin_State').val(response['Origin_State']);
                    $('#Destination_Address').val(response['destination_address']);
                    $('#Dest_City').val(response['Dest_City']);
                    $('#Destination_State').val(response['Destination_State']);
                    $('#Rating').val(response['rating']);
                    $('#mySlider').val(response['posted_hours']);
                    $('#Ship_Ready').val(response['shipment_prefrences']);
                    $('#Vehcile_Type').val(response['vehicle_type']);
                    $('#Vehcile_Condition').val(response['vehicle_condition']);
                    $('#Trailer_Type').val(response['trailer_type']);
                    $('#Min_Vehicle').val(response['min_vehicle']);
                    $('#Max_Vehicle').val(response['max_vehicle']);
                    $('#Payment_Type').val(response['payment_type']);
                    $('#Min_Total_Pay').val(response['min_total_pay']);
                    $('#Min_Rate_Pay').val(response['min_rate_pay']);
                    $('#Equipment_Type').val(response['equipment_type']);
                    $('#Shipment_Prefrences').val(response['shipment_prefrences']);
                    $('#Trailer_Specification').val(response['trailer_specification']);
                    $('#Min_Length').val(response['min_length']);
                    $('#Max_Length').val(response['max_length']);
                    $('#Min_Width').val(response['min_width']);
                    $('#Max_Width').val(response['max_width']);
                    $('#Min_Height').val(response['min_height']);
                    $('#Max_Height').val(response['max_height']);
                    $('#Min_Weight').val(response['min_weight']);
                    $('#Max_Weight').val(response['max_weight']);
                    $('#Fright_Equipment_Type').val(response['freight_equipment_type']);
                    $('#Fright_Shipment_Prefrences').val(response[
                        'freight_shipment_prefrences']);
                    $('#Fright_Trailer_Specification').val(response[
                        'freight_trailer_specification']);
                    $('#Freight_Class').val(response['freight_class']);
                    $('#Min_Freight_Weight').val(response['min_freight_weight']);
                    $('#Max_Freight_Weight').val(response['max_freight_weight']);
                    $('#filter_name').val(response['name']);
                    $('#textInput').val(response['comp_active']);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    }
    // });
</script>
<script>
    // $(document).ready(function() {
    //     $('.save_as').on('click', function(event) {
    //         event.preventDefault();
    //         var val = $(this).data('value');
    //         if (val == 'save_new') {
    //             $('#filter_id').val(0);
    //         }
    //         $('#filterForm').submit();
    //     });
    // });
    $(document).on('click', '.save_as', function(e) {
        console.log('okok');
        event.preventDefault(); // Prevent default form submission
        var val = $(this).data('value');

        // Check if filter_name field is empty
        var filterName = $('#filter_name').val().trim(); // Get value and trim leading/trailing spaces
        if (filterName === '') {
            alert('Please enter a filter name before saving.');
            return; // Prevent form submission if field is empty
        }

        if (val == 'save_new') {
            $('#filter_id').val(0);
        }

        // Submit the form if filter_name is filled
        $('#filterForm').submit();
    });
</script>
<script>
    function getListedDate(getListedDate) {
        var ListedDate = new Date(getListedDate);
        var month = ListedDate.getMonth() + 1;
        var day = ListedDate.getDate();
        var year = ListedDate.getFullYear();
        if (month < 10) {
            month = '0' + month.toString();
        } else {
            month = month.toString();
        }
        if (day < 10) {
            day = '0' + day.toString();
        } else {
            day = day.toString();
        }
        return year + '-' + month + '-' + day;
    }
    $(document).on('click', '.request-carrier', function(e) {
        var getListedID = $(this).find('.Listed-ID').val();
        var getRefID = $(this).find('.Listed-Ref-ID').val();
        $(".get_Order_ID").html(getListedID);
        $(".get_Listed_ID").val(getListedID);
        $(".get_Ref_ID").val(getRefID);

    });
    // Offer Amount
    $('.offer-price').hide();
    $('#offer_Check').change(function() {
        checkBox = document.getElementById('offer_Check');
        if (checkBox.checked) {
            $('.offer-price').show();
            $(".offer-price input").prop('required', true);
        } else {
            $('.offer-price').hide();
            $(".offer-price input").prop('required', false);
        }
    });
    $("#Search_vehicleType").on("change", function() {
        console.log($(this).val());
        $('#Search_vehicleType_form').submit();
        console.log(url);
    });

    function request_load_click(value) {
        const getListedRefID = $(`#${value}`).find('.Listed-Ref-ID').val();
        const getListedID = $(`#${value}`).find('.Listed-ID').val();
        const getListedPrice = $(`#${value}`).find('.Listed-Price').val();
        const getPickupDate = $(`#${value}`).find('.Pickup-Date').val();
        const getDeliverDate = $(`#${value}`).find('.Deliver-Date').val();
        $(".get_Order_ID").html(getListedRefID);
        console.log(getListedRefID);
        $(".get_Listed_ID").val(getListedID);
        $('#get_Listed_Price').val(getListedPrice);
        const pickupDate = getListedDate(getPickupDate);
        $('.pickup-date').val(pickupDate);
        const deliverDate = getListedDate(getDeliverDate);
        $('.deliver-date').val(deliverDate);
    }

    $(document).on('click', '.close', function(e) {
        $("#request_load_clear").trigger("reset");
        console.log('close')
        document.getElementById('modalbody').style.display = 'none'
        document.getElementById('requested').style.display = 'block'
    });

    $(document).on('click', '.all-requests', function(e) {
        const getListedID = $(this).find('.Listed-ID').val();
        $(".get_Order_ID").html(getListedID);
        $(".get_Listed_ID").val(getListedID);
        $.ajax({
            url: '{{ route('Get.All.Carrier.Request') }}',
            type: 'GET',
            data: {
                'Listed_ID': getListedID
            },
            success: function(data) {
                $('#all-fetch-requests').html(data);
            },
            error: function(data) {
                console.log(data);
            }
        });
    });

    function requestforform(params) {
        console.log(params)
        document.getElementById('modalbody').style.display = 'block'
        document.getElementById('requested').style.display = 'none'
        console.log('show')
        if (params == 1) {
            $('.offer-price').hide();
            $('.bidoffer #bid').remove();
            var type = 'request';
            $('.check_type').val(type);
        } else {
            $('.bidoffer').html(`
                <input type="text" class="form-control" placeholder="Enter Your Bid Price" id="bid"
                value="" name="Offer_Price" required>
                `)
            var type = 'bid';
            $('.offer-price').show();
            $('.check_type').val(type);
        }
    }

    function myfunc(getparams) {
        if (getparams.target.value == '6') {
            console.log('company')
            $('.hiddenDiv').html('');
            $('.hiddenDivsecond').attr('action', 'https://daydispatch.com/Authorized/User-Search-Results');
        } else {
            console.log('test', getparams.target.value)
            $('.hiddenDiv').html(`<input type="text" class="form-control d-none" class="hiddenValueinput" required>`);
            $('.hiddenDivsecond').attr('action', '');
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
