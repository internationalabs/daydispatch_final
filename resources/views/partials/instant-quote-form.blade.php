    <style>
        .selectMultiple + .nice-select{
            display: none;
        }
        .selectMultiple {
         width: 100%;
         position: relative;
        }
        .selectMultiple select {
            display: none;
        }
        .selectMultiple > div {
            position: relative;
            z-index: 2;
            min-height: 56px;
            box-shadow: none;
            transition: box-shadow 0.3s ease;
        }
        .selectMultiple > div:hover {
            box-shadow: 0 4px 24px -1px rgba(22, 42, 90, .16);
        }
        .selectMultiple > div .arrow {
            right: 1px;
            top: 0;
            bottom: 0;
            cursor: pointer;
            width: 28px;
            position: absolute;
            padding-bottom: 10px;
        }
        .selectMultiple > div .arrow:before, .selectMultiple > div .arrow:after {
            content: '';
            position: absolute;
            display: block;
            width: 2px;
            height: 8px;
            border-bottom: 8px solid #99a3ba;
            top: 43%;
            transition: all 0.3s ease;
        }
        .selectMultiple > div .arrow:before {
            right: 12px;
            transform: rotate(-130deg);
        }
        .selectMultiple > div .arrow:after {
            left: 9px;
            transform: rotate(130deg);
        }
        .selectMultiple > div span {
            color: #99a3ba;
            display: block;
            position: absolute;
            left: 19px;
            cursor: pointer;
            top: 16px;
            line-height: 28px;
            transition: all 0.3s ease;
        }
        .selectMultiple > div span.hide {
            opacity: 0;
            visibility: hidden;
            transform: translate(-4px, 0);
        }
        .selectMultiple > div a {
            position: relative;
            padding: 0 24px 6px 8px;
            line-height: 28px;
            color: #bc101c;
            display: inline-block;
            vertical-align: top;
            margin: 0 6px 0 0;
        }
        .selectMultiple > div a em {
            font-style: normal;
            display: block;
            white-space: nowrap;
        }
        .selectMultiple > div a:before {
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
        .selectMultiple > div a i {
            cursor: pointer;
            position: absolute;
            top: 14px;
            right: 0;
            width: 24px;
            height: 28px;
            display: block;
        }
        .selectMultiple > div a i:before, .selectMultiple > div a i:after {
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
        .selectMultiple > div a i:before {
            transform: translate(-50%, -50%) rotate(45deg);
        }
        .selectMultiple > div a i:after {
            transform: translate(-50%, -50%) rotate(-45deg);
        }
        .selectMultiple > div a.notShown {
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .selectMultiple > div a.notShown:before {
            width: 28px;
            transition: width 0.45s cubic-bezier(0.87, -0.41, 0.19, 1.44) 0.2s;
        }
        .selectMultiple > div a.notShown i {
            opacity: 0;
            transition: all 0.3s ease 0.3s;
        }
        .selectMultiple > div a.notShown em {
            opacity: 0;
            transform: translate(-6px, 0);
            transition: all 0.4s ease 0.3s;
        }
        .selectMultiple > div a.notShown.shown {
            opacity: 1;
            margin-top: 7px;
            margin-left: 9px;
            margin-bottom: -6px;
        }
        .selectMultiple > div a.notShown.shown:before {
            width: 100%;
        }
        .selectMultiple > div a.notShown.shown i {
            opacity: 1;
        }
        .selectMultiple > div a.notShown.shown em {
            opacity: 1;
            transform: translate(0, 0);
        }
        .selectMultiple > div a.remove:before {
            width: 28px;
            transition: width 0.4s cubic-bezier(0.87, -0.41, 0.19, 1.44) 0s;
        }
        .selectMultiple > div a.remove i {
            opacity: 0;
            transition: all 0.3s ease 0s;
        }
        .selectMultiple > div a.remove em {
            opacity: 0;
            transform: translate(-12px, 0);
            transition: all 0.4s ease 0s;
        }
        .selectMultiple > div a.remove.disappear {
            opacity: 0;
            transition: opacity 0.5s ease 0s;
        }
        .selectMultiple > ul {
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
        .selectMultiple > ul li {
            color: #1e2330;
            background: #fff;
            padding: 12px 16px;
            cursor: pointer;
            overflow: hidden;
            position: relative;
            transition: background 0.3s ease, color 0.3s ease, transform 0.3s ease 0.3s, opacity 0.5s ease 0.3s, border-radius 0.3s ease 0.3s;
        }
        .selectMultiple > ul li:first-child {
            border-radius: 8px 8px 0 0;
        }
        .selectMultiple > ul li:first-child:last-child {
            border-radius: 8px;
        }
        .selectMultiple > ul li:last-child {
            border-radius: 0 0 8px 8px;
        }
        .selectMultiple > ul li:last-child:first-child {
            border-radius: 8px;
        }
        .selectMultiple > ul li:hover {
            background: #bc101c;
            color: #fff;
        }
        .selectMultiple > ul li:after {
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
        .selectMultiple > ul li.beforeRemove {
            border-radius: 0 0 8px 8px;
        }
        .selectMultiple > ul li.beforeRemove:first-child {
            border-radius: 8px;
        }
        .selectMultiple > ul li.afterRemove {
            border-radius: 8px 8px 0 0;
        }
        .selectMultiple > ul li.afterRemove:last-child {
            border-radius: 8px;
        }
        .selectMultiple > ul li.remove {
            transform: scale(0);
            opacity: 0;
        }
        .selectMultiple > ul li.remove:after {
            animation: ripple 0.4s ease-out;
        }
        .selectMultiple > ul li.notShown {
            display: none;
            transform: scale(0);
            opacity: 0;
            transition: transform 0.35s ease, opacity 0.4s ease;
        }
        .selectMultiple > ul li.notShown.show {
            transform: scale(1);
            opacity: 1;
        }
        .selectMultiple.open > div {
            box-shadow: 0 4px 20px -1px rgba(22, 42, 90, .12);
        }
        .selectMultiple.open > div .arrow:before {
            transform: rotate(-50deg);
        }
        .selectMultiple.open > div .arrow:after {
            transform: rotate(50deg);
        }
        .selectMultiple.open > ul {
            transform: translate(0, 12px) scale(1);
            opacity: 1;
            visibility: visible;
            filter: drop-shadow(0 16px 24px rgba(22, 42, 90, .16)); 
            max-height: 150px;
            overflow-y: scroll;
        }
        .selectMultiple > ul::-webkit-scrollbar {
        width: 5px;
        }
    
        /* Track */
        .selectMultiple > ul::-webkit-scrollbar-track {
        background: transparent; 
        }
        
        /* Handle */
        .selectMultiple > ul::-webkit-scrollbar-thumb {
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
        /*.nice-select{*/
        /*}*/
    
     
    </style>
<form class="was-validated" action="{{ route('Post.Instant.Quote') }}" method="POST" id="Instant-Quote-Form">
    @csrf
    <div class="row route_quote_info">
        <div class="col-xl-12 col-lg-12">
            <h6>Moving From</h6>
            <label>Where Are You Moving From?</label>
            <div class="single-input-field">
                <input class="Origin_ZipCode typeahead" type="text" id="F_ZipCode"
                       placeholder="Enter City or ZipCode"
                       name="From_ZipCode" required>
                <i class="fas fa-map-marked-alt"></i>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <h6>Moving To</h6>
            <label>Where Are You Moving To?</label>
            <div class="single-input-field">
                <input class="Dest_ZipCode typeahead" type="text" id="T_ZipCode"
                       placeholder="Enter City or ZipCode"
                       name="To_ZipCode" required>
                <i class="fas fa-map-marked-alt"></i>
            </div>
        </div>
    </div>
    <div class="row route_quote_info">
        <div class="col-xl-12">
            <div class="price__cta-btn">
                <a href="JavaScript:void(0);" id="step_2"
                   class="fill-btn clip-sm-btn d-block">Next</a>
            </div>
        </div>
    </div>
    <div class="row vehicle_quote_info ">
        <h4 class="text-center" id="vehicleinfo">Vehicle Information</h4>
        <div class="col-xl-12 col-lg-12 vehicle_type">
            <label>Select Vehicle</label>
            <div class="single-input-field">
                <select name="Select_Vehicle" id="select_vehicle" required>
                    <option selected value="">Select Type</option>
                    <option value="Car">Car</option>
                    <option value="MotorCycle">MotorCycle</option>
                    <option value="Heavy Equipment">Heavy Equipment</option>
                    <option value="Dryvan">Freight shipping</option>
                </select>
            </div>
        </div>
        {{-- if Vehicle Type Equal To Car --}}
        <div class="col-xl-12 col-lg-12 vehicle_make">
            <label>Select Vehicle Year</label>
            <div class="single-input-field">
                <div class="single-input-field">
                    <input type="text" name="Car_Year"
                           placeholder="Enter Year" class="year typeahead">
                    <i class="fad fa-car"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 vehicle_make">
            <label>Select Vehicle Make</label>
            <div class="single-input-field">
                <div class="single-input-field">
                    <input type="text" name="Car_Make"
                           placeholder="Enter Any Car Make" class="make typeahead">
                    <i class="fad fa-car"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 vehicle_model">
            <label>Select Vehicle Model</label>
            <div class="single-input-field">
                <div class="single-input-field">
                    <input type="text" name="Car_Model" class="model typeahead"
                           placeholder="Enter Any Model">
                    <i class="fad fa-car-alt"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 vehicle_heading ">
            <label>Year, Make, Model</label>
            <div class="single-input-field">
                <input type="text" name="Year_Make_Model"
                       placeholder="Enter Year, Make, Model">
                <i class="fad fa-receipt"></i>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 vehicle_dimension ">
            <h5>Vehicle Dimension</h5>
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="single-input-field">
                        <input name="Vehicle_Length" type="text"
                               placeholder="Length (20ft 7in)">
                        <i class="fad fa-weight"></i>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="single-input-field">
                        <input name="Vehicle_Width" type="text"
                               placeholder="Width (20ft 7in)">
                        <i class="fas fa-cube"></i>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="single-input-field">
                        <input name="Vehicle_Height" type="text"
                               placeholder="Height (20ft 7in)">
                        <i class="fad fa-weight"></i>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="single-input-field">
                        <input name="Vehicle_Weight" type="text"
                               placeholder="Weight (150 lbs)">
                        <i class="fas fa-cube"></i>
                    </div>
                </div>
                
                 <div class="col-xl-12 col-lg-12">
                    <div class="single-input-field">
                        <select name="Shipping_Mode" >
                            <option>Select Shipping Mode</option>
                            <option>FTL (Full Truck Load)</option>
                            <option>LTL (Less Than Truck Load)</option>
                        </select>
                    </div>
                </div>
                
                  <div class="col-xl-6 col-lg-6">
                    <div>
                      <!--<select name="Equipment_Type" >-->
                      <!--      <option selected="" value="">Select Equipment Type</option>-->
                      <!--      <option>VAN (V)</option>-->
                      <!--      <option>REEFER (RE) </option>-->
                      <!--      <option>FLATBED (F)</option>-->
                      <!--      <option>Step Deck Trailer</option>-->
                      <!--      <option>REMOVABLE GOOSENECK (RGN) </option>-->
                      <!--      <option>CONESTOGA (CS)</option>-->
                      <!--      <option>TRUCK (T)</option>-->
                      <!--      <option>HAZMAT (hazardous materials)</option>-->
                      <!--      <option>POWER ONLY (PO)</option>-->
                      <!--      <option>HOT SHOT (HS)</option>-->
                      <!--      <option>LOWBOY (LB)</option>-->
                      <!--      <option>ENDUMP (ED)</option>-->
                      <!--      <option>LANDOLL (LD)</option>-->
                      <!--      <option>PARTIAL (PT)</option>-->
                      <!--      <option>20ft container</option>-->
                      <!--      <option>40ft container</option>-->
                      <!--      <option>48ft container</option>-->
                      <!--      <option>53ft container</option>-->
                      <!--  </select>-->
                        
                        <!--<label>Select Equipment Type</label>-->
                           <select multiple data-placeholder="Select Shipping Mode" name="Equipment_Type[]"> 
                                <!--<option selected="" value="">Select Equipment Type</option>-->
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
                            
                            
                    </div>
                </div>
                  <div class="col-xl-6 col-lg-6">
                    <div>
                       <!--<select name="Trailer" >-->
                       <!--     <option selected="" value="">Select Trailer</option>-->
                       <!--     <option>Air Ride(A)</option>-->
                       <!--     <option>Blanket Wrap (B)</option>-->
                       <!--     <option>B-Train (BT)</option>-->
                       <!--     <option>Chain(CH)</option>-->
                       <!--     <option>Chassis (CS)</option>-->
                       <!--     <option>Conestoga(CO)</option>-->
                       <!--     <option>Curtain(C)</option>-->
                       <!--     <option>Double(2)</option>-->
                       <!--     <option>Extendable (E)</option>-->
                       <!--     <option>E-Track (ET)</option>-->
                       <!--     <option>Hazmat (Z)</option>-->
                       <!--     <option>Hot Shot (HS)</option>-->
                       <!--     <option>Insulated (N)</option>-->
                       <!--     <option>Lift Gate (LG)</option>-->
                       <!--     <option>Load Out (LO)</option>-->
                       <!--     <option>Load Ramp (LR)</option>-->
                       <!--     <option>Moving (MV)</option>-->
                       <!--     <option>Open Top (OT)</option>-->
                       <!--     <option>Oversized (O)</option>-->
                       <!--     <option>Pallet Exchange (X)</option>-->
                       <!--     <option>Side Kit (S)</option>-->
                       <!--     <option>Tarp(T)</option>-->
                       <!--     <option>Team Driver(M)</option>-->
                       <!--     <option>Temp Control (TC)</option>-->
                       <!--     <option>Triple (3)</option>-->
                       <!--     <option>Vented (V)</option>-->
                       <!--     <option>Walking Floor (WF)</option>-->
                       <!-- </select>-->
                       
                        <!--<label>Select Trailer</label>-->
                           <select multiple data-placeholder="Select Trailer" name="Trailer[]"> 
                                  <!--<option selected="" value="">Select Trailer</option>-->
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
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 vehicle_additional ">
            <label>Additional Instruction</label>
            <div class="single-input-field">
                <input type="text" name="Additional_Instruction"
                       placeholder="Additional Instruction  ">
                <i class="fad fa-receipt"></i>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 vehicle_carrier">
            <label>Select Carrier</label>
            <div class="single-input-field">
                <select name="Carrier_Type">
                    <option selected>Select Type</option>
                    <option value="Open">Open</option>
                    <option value="Enclosed">Enclosed</option>
                    <option value="Drive Away">Drive Away</option>
                </select>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 vehicle_condition">
            <label>Select Condition</label>
            <div class="single-input-field">
                <select name="Carrier_Condition">
                    <option selected>Select Condition</option>
                    <option value="Running">Running</option>
                    <option value="Not Running">Not Running</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row vehicle_quote_info " style="display: none;">
        <div class="col-xl-6 col-lg-6">
            <div class="price__cta-btn">
                <a href="JavaScript:void(0);" class="step_1  fill-btn clip-sm-btn d-block" >Previous</a>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6" id="nextstepof"> 
            <div class="price__cta-btn"  id="first">
                <a href="JavaScript:void(0);" class="step_3 fill-btn clip-sm-btn d-block">Next</a>
            </div>
            <div class="price__cta-btn"  id="second" style="display: none;">
                <a href="JavaScript:void(0);" id="showdryvan" 
                   class="fill-btn clip-sm-btn d-block">Next</a>
            </div>
        </div>
    </div>
    <div class="row vehicle_quote_info_Freight">
        <div class="col-lg-6">
            
        <h4>Freight Details</h4>
        </div>
        <div class="col-lg-6">
            <h5>
                <u>
                    <span data-bs-toggle="modal" href="#exampleModalToggle" role="button">Calculate Freight Class</span>
                    
                </u>
            </h5>
        </div>
        <div class="col-xl-12 col-lg-12 Freight">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="single-input-field">
                          <!--<select name="Shipping_Mode" required="" style="display: none;">-->
                          <!--  <option>Select Shipping Mode</option>-->
                          <!--  <option>FTL (Full Truck Load)</option>-->
                          <!--  <option>LTL (Less Than Truck Load)</option>-->
                        <!--</select><div class="nice-select" tabindex="0"><span class="current">Select Shipping Mode</span><ul class="list"><li data-value="Select Shipping Mode" class="option selected">Select Shipping Mode</li><li data-value="FTL (Full Truck Load)" class="option">FTL (Full Truck Load)</li><li data-value="LTL (Less Than Truck Load)" class="option">LTL (Less Than Truck Load)</li></ul></div>-->
                    <!--FREIGHT DETAILS-->
                    <select name="frieght_class" id="frieght_class" class="frieght_class" aria-required="true">
                        <option value="">Select</option>
                        <option value="50">50</option>
                        <option value="55">55</option>
                        <option value="60">60</option>
                        <option value="65">65</option>
                        <option value="70">70</option>
                        <option value="77.5">77.5</option>
                        <option value="85">85</option>
                        <option value="92.5">92.5</option>
                        <option value="100">100</option>
                        <option value="110">110</option>
                        <option value="125">125</option>
                        <option value="150">150</option>
                        <option value="175">175</option>
                        <option value="200">200</option>
                        <option value="250">250</option>
                        <option value="300">300</option>
                        <option value="400">400</option>
                        <option value="500">500</option>
                    </select>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="single-input-field">
                        <input name="Freight_Weight" type="number" placeholder="Freight Weight">
                        <i class="fas fa-cube"></i>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12">
                    <div class="single-input-field">
                        <input name="Shipment_Preferences" type="text" placeholder="Commodity Details">
                        <i class="fad fa-weight"></i>
                    </div>
                </div>
                
                 <div class="col-xl-6 col-lg-6">
                    <div class="single-input-field">
                        <input name="Pickup_Date" type="date">
                        <i class="fad fa-weight"></i>
                    </div>
                </div>
                 <div class="col-xl-6 col-lg-6">
                    <div class="single-input-field">
                        <input name="Delivery_Date" type="date">
                        <i class="fad fa-weight"></i>
                    </div>
                </div>
                   <div class="col-xl-6 col-lg-6">
                    <div class="single-input-field">
                        <input name="Pickup_Time" type="time">
                        <i class="fad fa-weight"></i>
                    </div>
                </div>
                 <div class="col-xl-6 col-lg-6">
                    <div class="single-input-field">
                        <input name="Delivery_Time" type="time">
                        <i class="fad fa-weight"></i>
                    </div>
                </div>
                
                
                
                
                <div class="col-xl-6 col-lg-6">
                    <div>
                            <!--  <select name="Shipping_Mode" required="" style="display: none;">-->
                            <!--    <option>Select Shipping Mode</option>-->
                            <!--    <option>Construction / Utility</option>-->
                            <!--    <option>Inside Pickup</option>-->
                            <!--    <option>Residential</option>-->
                            <!--    <option>Container Station</option>-->
                            <!--    <option>Lift Gate Service</option>--> 
                            <!--    <option>Single Shipment</option>--> 
                            <!--    <option>Exhibition</option>-->
                            <!--    <option>Sorting / Segregation</option>-->
                            <!--</select>-->
                            
                              <select multiple data-placeholder="Select Shipping Mode" name="Pickup_Services[]"> 
                                <!--<option>Pickup Services</option>-->
                                <option>Construction / Utility</option>
                                <option>Inside Pickup</option>
                                <option>Residential</option>
                                <option>Container Station</option>
                                <option>Lift Gate Service</option>
                                <option>Single Shipment</option>
                                <option>Exhibition</option>
                                <option>Sorting / Segregation</option>
                            </select>

                        </div>
                    </div>
                    
                    
                      <div class="col-xl-6 col-lg-6">
                    <div>
                        <select multiple data-placeholder="Select Shipping Mode" name="Delivery_Services[]"> 
                        <!--<option>Delivery Services</option>-->
                            <option>After Business Hours Delivery</option>
                            <option>In Bond Freight</option>
                            <option>Residential</option>
                            <option>Construction / Utility</option>
                            <option>In Bond TIR Caret</option>
                            <option>Mine / Govt / Airport</option>
                            <option>Appointment</option>
                            <option>Inside - Same Level as Delivery Vehicle</option>
                            <option>Notification Prior Delivery</option>
                            <option>Container Station</option>
                            <option>Lift Gate Service</option>
                            <option>Exhibition</option>
                        </select>
                            <!--  <select name="Shipping_Mode" required="" style="display: none;">-->
                            <!--    <option>After Business Hours Delivery</option>-->
                            <!--    <option>In Bond Freight</option>-->
                            <!--    <option>Residential</option>-->
                            <!--    <option>Construction / Utility</option>-->
                            <!--    <option>In Bond TIR Caret</option>-->
                            <!--    <option>Mine / Govt / Airport</option>-->
                            <!--    <option>Appointment</option>-->
                            <!--    <option>Inside - Same Level as Delivery Vehicle</option>-->
                            <!--    <option>Notification Prior Delivery</option>-->
                            <!--    <option>Container Station</option>-->
                            <!--    <option>Lift Gate Service</option>-->
                            <!--    <option>Exhibition</option>-->
                            <!--</select>-->
                        </div>
                    </div>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row vehicle_quote_info_Freight">
        <div class="col-xl-6 col-lg-6">
            <div class="price__cta-btn">
                <a href="JavaScript:void(0);" class="step_1_goback fill-btn clip-sm-btn d-block"
                   >Previous</a>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="price__cta-btn">
                <a href="JavaScript:void(0);" class="step_3_show fill-btn clip-sm-btn d-block">Next</a>
            </div>
        </div>
    </div>
    <div class="row basic_quote_info">
        <h4 class="text-center">Customer Information</h4>
        <div class="col-xl-12 col-lg-12">
            <div class="single-input-field">
                <input name="Custo_Name" type="text" placeholder="Customer Name">
                <i class="fas fa-user"></i>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="single-input-field">
                <input name="Custo_Phone" type="number" class="phone-number"
                       placeholder="Customer Phone">
                <i class="fas fa-phone"></i>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="single-input-field">
                <input name="Custo_Email" type="email" placeholder="Email address">
                <i class="fas fa-envelope"></i>
            </div>
        </div>
    </div>
    <div class="col-lx-12 basic_quote_info">
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="price__cta-btn">
                    <a href="JavaScript:void(0);" id="prev_step_2"
                       class="fill-btn clip-sm-btn d-block">Previous</a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="price__cta-btn">
                    <button type="submit" id="submit_instant_code"
                            class="fill-btn clip-sm-btn d-block">Submit Now
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<p class="instant-quote-form-messages"></p>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    var sel = $('select[multiple]');
    sel.each(function(){
        let select = $(this);
        var options = $(this).find('option');

        var div = $('<div />').addClass('selectMultiple');
        var active = $('<div />').addClass('single-input-field');
        var list = $('<ul />');
        var placeholder = $(this).data('placeholder');
        
        var span = $('<span />').text(placeholder).appendTo(active);

        options.each(function() {
            var text = $(this).text();
            if($(this).is(':selected')) {
                active.append($('<a />').html('<em>' + text + '</em><i></i>'));
                span.addClass('hide');
            } else {
                list.append($('<li />').html(text));
            }
        });

        active.append($('<div />').addClass('arrow'));
        div.append(active).append(list);
        // div.append(`<strong>${placeholder}</strong>`);
        select.wrap(div);
    });
    $(document).on('click', '.selectMultiple ul li', function(e) {
        var select = $(this).parent().parent();
        var li = $(this);
        if (!select.hasClass('clicked')) {
            select.addClass('clicked');
            li.prev().addClass('beforeRemove');
            li.next().addClass('afterRemove');
            li.addClass('remove');
            var a = $('<a />').addClass('notShown').html('<em>' + li.text() + '</em><i></i>').hide().appendTo(select.children('div'));
            a.slideDown(400, function() {
                setTimeout(function() {
                    a.addClass('shown');
                    select.children('div').children('span').addClass('hide');
                    select.find('option:contains(' + li.text() + ')').prop('selected', true);
                }, 500);
            });
            setTimeout(function() {
                if (li.prev().is(':last-child')) {
                    li.prev().removeClass('beforeRemove');
                    
                }
                if (li.next().is(':first-child')) {
                    li.next().removeClass('afterRemove');
                }
                setTimeout(function() {
                    li.prev().removeClass('beforeRemove');
                    li.next().removeClass('afterRemove');
                }, 200);

                li.slideUp(400, function() {
                    li.remove();
                    select.removeClass('clicked');
                });

                // Show another select
                var anotherSelect = select.siblings('select[multiple]');
                anotherSelect.show();
            }, 600);
        }
    });
    $(document).on('click', '.selectMultiple > div a', function(e) {
        var select = $(this).parent().parent();
        var self = $(this);
        self.removeClass().addClass('remove');
        select.addClass('open');
        setTimeout(function() {
            self.addClass('disappear');
            setTimeout(function() {
                self.animate({
                    width: 0,
                    height: 0,
                    padding: 0,
                    margin: 0
                }, 300, function() {
                    var li = $('<li />').text(self.children('em').text()).addClass('notShown').appendTo(select.find('ul'));
                    li.slideDown(400, function() {
                        li.addClass('show');
                        setTimeout(function() {
                            select.find('option:contains(' + self.children('em').text() + ')').prop('selected', false);
                            if (!select.find('option:selected').length) {
                                // select.children('div').children('span').removeClass('hide');

                            }
                            li.removeClass();
                        }, 400);
                    });
                    self.remove();
                })
            }, 300);
        }, 400);
    });
    $(document).on('click', '.selectMultiple > div .arrow, .selectMultiple > div span', function(e) {
        $(this).parent().parent().toggleClass('open');
    });
    $(document).on('click', 'body', function(e) { 
        // Check if the clicked element or its ancestors have the class "selectMultiple"
        const selectMultipleElements = $(e.target).closest('.selectMultiple');
        
        // Remove the "open" class from all elements with the class "selectMultiple" 
        console.log(selectMultipleElements.length)
        if(selectMultipleElements.length == '1'){
        }
        else{
        $(".selectMultiple").removeClass('open');
        }
        
    });
    });
    function calculateFreight(){
        console.log('test')
    }
</script>