<div class="breadcrumb-area">
    <h1>Dashboard</h1>
    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>
        <li class="item">Dispatch Listing (<strong>Order ID: {{ $Listed_ID }}</strong>)</li>
    </ol>
</div>
<div class="card user-settings-box mb-30">
    <div class="card-body">
        <form class="was-validated" method="POST" action="{{ route('User.Dispatch.Listing.Post') }}"
            enctype="multipart/form-data">
            @csrf
            <input hidden type="text" name="List_ID" value="{{ $Listed_ID }}">
            <h3><i class='bx bx-file'></i> Dispatch Listing</h3>
            <h5><b>Refrence ID:</b> #{{ $Listed_ID }}</h5>

            <div class="row">
                <div class="col-lg-6 shadow-sm border rounded p-3">
                    {{-- <h5 class="text-center"><b>Dispatching Company</b></h5> --}}
                    <h4 class="text-white py-2 d-flex justify-content-center"
                        style="background: #113771;">
                        <i class="bi bi-hash mr-2"></i>Dispatching Company
                    </h4>
                    <div class="row">
                        <input hidden type="text" value="{{ !is_null($req_user) ? $req_user->id : '' }}" class="Dispatch_Company_ID" name="Dispatch_Company_ID">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" class="form-control Dispatch-Company-Name typeahead"
                                    name="Company_Name" value="{{ !is_null($req_user) ? $req_user->Company_Name : '' }}"
                                    required>
                                <div class="CMP_list"></div>
                                <div class="invalid-feedback">
                                    Enter Assign Order Company Name.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>#MC Number</label>
                                <input type="text" class="form-control Dispatch-Mc_Number" readonly name="Mc_Number"
                                    value="{{ !is_null($req_user) ? $req_user->Mc_Number : '' }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Contact Phone</label>
                                <input type="text" class="form-control Dispatch-Contact_Phone" readonly
                                    name="Contact_Phone"
                                    value="{{ !is_null($req_user) ? $req_user->Contact_Phone : '' }}"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Company State</label>
                                <input type="text" class="form-control Dispatch-Company_State" readonly
                                    name="Company_State"
                                    value="{{ !is_null($req_user) ? $req_user->Company_State : '' }}"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Company City</label>
                                <input type="text" class="form-control Dispatch-Company_City" readonly
                                    name="Company_City" value="{{ !is_null($req_user) ? $req_user->Company_City : '' }}"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Company Address</label>
                                <input type="text" class="form-control Dispatch-Address" readonly name="Address"
                                    value="{{ !is_null($req_user) ? $req_user->Address : '' }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Local Phone</label>
                                <input type="text" class="form-control Dispatch-Local_Phone" readonly
                                    name="Local_Phone" value="{{ !is_null($req_user) ? $req_user->Local_Phone : '' }}"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Toll Free Phone</label>
                                <input type="text" class="form-control Dispatch-Toll_Free" readonly name="Toll_Free"
                                    value="{{ !is_null($req_user) ? $req_user->Toll_Free : '' }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Dispatch Phone</label>
                                <input type="text" class="form-control Dispatch-Dispatch_Phone" readonly
                                    name="Dispatch_Phone"
                                    value="{{ !is_null($req_user) ? $req_user->Dispatch_Phone : '' }}"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Fax Number</label>
                                <input type="text" class="form-control Dispatch-Fax_Phone" readonly name="Fax_Phone"
                                    value="{{ !is_null($req_user) ? $req_user->Fax_Phone : '' }}" autocomplete="off">
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
                                <input type="email" class="form-control" name="Driver_Email"
                                    placeholder="Driver Email">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Driver Phone</label>
                                <input type="text" class="form-control phone-number" name="Driver_Phone"
                                    placeholder="Driver Phone">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 shadow-sm border rounded p-3">
                    {{-- <h5 class="text-center"><b>Your Company Information</b></h5> --}}
                    <h4 class="text-white py-2 d-flex justify-content-center"
                        style="background: #113771;">
                        <i class="bi bi-hash mr-2"></i>Your Company Information
                    </h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Company Name</label>
                                <input readonly type="text" class="form-control" name="Company_Name"
                                    value="{{ !is_null($Lisiting->authorized_user) ? $Lisiting->authorized_user->Company_Name : '' }}"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>#MC Number</label>
                                <input readonly type="text" class="form-control" name="Mc_Number"
                                    value="{{ !is_null($Lisiting->authorized_user) ? $Lisiting->authorized_user->Mc_Number : '' }}"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Contact Phone</label>
                                <input readonly type="text" class="form-control" name="Contact_Phone"
                                    value="{{ !is_null($Lisiting->authorized_user) ? $Lisiting->authorized_user->Contact_Phone : '' }}"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Company State</label>
                                <input readonly type="text" class="form-control" name="Company_State"
                                    value="{{ !is_null($Lisiting->authorized_user) ? $Lisiting->authorized_user->Company_State : '' }}"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Company City</label>
                                <input readonly type="text" class="form-control" name="Company_City"
                                    value="{{ !is_null($Lisiting->authorized_user) ? $Lisiting->authorized_user->Company_City : '' }}"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Company Address</label>
                                <input readonly type="text" class="form-control" name="Address"
                                    value="{{ !is_null($Lisiting->authorized_user) ? $Lisiting->authorized_user->Address : '' }}"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Local Phone</label>
                                <input readonly type="text" class="form-control" name="Local_Phone"
                                    value="{{ !is_null($Lisiting->authorized_user) ? $Lisiting->authorized_user->Local_Phone : '' }}"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Toll Free Phone</label>
                                <input readonly type="text" class="form-control" name="Toll_Free"
                                    value="{{ !is_null($Lisiting->authorized_user) ? $Lisiting->authorized_user->Toll_Free : '' }}"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Dispatch Phone</label>
                                <input readonly type="text" class="form-control" name="Dispatch_Phone"
                                    value="{{ !is_null($Lisiting->authorized_user) ? $Lisiting->authorized_user->Dispatch_Phone : '' }}"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Fax Number</label>
                                <input readonly type="text" class="form-control" name="Fax_Phone"
                                    value="{{ !is_null($Lisiting->authorized_user) ? $Lisiting->authorized_user->Fax_Phone : '' }}"
                                    autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('partials.edit-dispatch-form')
            <div class="btn-box text-center">
                <button type="submit" class="submit-btn w-100"><i class='bx bx-save'></i>
                    Assign Listing
                </button>
            </div>
        </form>
    </div>
</div>
{{-- Fetch ZipCodes --}}
<script type="text/javascript">
    // Company Searching From Dispatch
    $('.Dispatch-Company-Name').on('keyup', function() {
        var query = $(this).val();

        $.ajax({
            url: '{{ route('Find.Network') }}',
            type: 'GET',
            data: {
                'name': query
            },
            success: function(data) {
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
            success: function(data) {
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

    $(document).on('click', '.CMP_list li', function() {
        var value = $(this).text();
        $('.Dispatch-Company-Name').val(value);
        getFullCompanyData(value);
        $('.CMP_list').html("");
    });

    $(document).ready(function() {
        // Multiples Vehciles Add
        var min_vehcile = 1;
        var max_vehcile = 25;

        // $("#add-vehcile").click(function () {
        //     if (min_vehcile <= max_vehcile) {
        //         var new_vehcile =
        //             '<div id="reform' + min_vehcile + '">' +
        //             '<div class="vehcile-information">' +
        //             '<div class="row">' +
        //             '<div class="col-lg-4">' +
        //             '<div class="custom-control custom-radio">' +
        //             '<input type="radio" class="custom-control-input" id="customControlValidation5_' +
        //             min_vehcile +
        //             '" name="radio_stacked[' +
        //             min_vehcile +
        //             ']" value="YMM" checked>' +
        //             '<label class="custom-control-label" for="customControlValidation5_' +
        //             min_vehcile +
        //             '">Year, Make, and Model</label>' +
        //             '</div>' +
        //             '</div>' +
        //             '<div class="col-lg-4">' +
        //             '<div class="custom-control custom-radio mb-3">' +
        //             '<input type="radio" class="custom-control-input vin-input" id="customControlValidation4_' +
        //             min_vehcile +
        //             '" name="radio_stacked[' +
        //             min_vehcile +
        //             ']" value="VIN">' +
        //             '<label class="custom-control-label" for="customControlValidation4_' +
        //             min_vehcile +
        //             '">Vin Number</label>' +
        //             '</div>' +
        //             '</div>' +
        //             '<div class="col-lg-4 justify-content-end">' +
        //             '<div class="btn-box text-right">' +
        //             '<button type="button" id="" class="remove-vehcile btn btn-danger"><i class="bx bx-trash"></i>Remove Vehcile</button>' +
        //             '</div>' +
        //             '</div>' +
        //             '</div>' +
        //             '<div class="row vin-box">' +
        //             '<div class="col-lg-12">' +
        //             '<div class="form-group">' +
        //             '<label>Vin Number</label>' +
        //             '<input type="text" class="form-control vin-input" placeholder="Ex: WBSWL93558P331570" name="Vin_Number[]" value="">' +
        //             '<div class="invalid-feedback">Entered Vin Number.</div>' +
        //             '</div>' +
        //             '</div>' +
        //             '</div>' +
        //             '<div class="row">' +
        //             '<div class="col-lg-4 basic-vehcile-info">' +
        //             '<div class="form-group">' +
        //             '<label>Year *</label>' +
        //             '<input type="text" class="form-control" placeholder="Ex: 2022" name="Vehcile_Year[]" value="">' +
        //             '<div class="invalid-feedback">Entered Year.</div>' +
        //             '</div>' +
        //             '</div>' +
        //             '<div class="col-lg-4 basic-vehcile-info">' +
        //             '<div class="form-group">' +
        //             '<label>Make *</label>' +
        //             '<input type="text" class="form-control make typeahead" placeholder="Enter Make" name="Vehcile_Make[]" value="">' +
        //             '<div class="invalid-feedback">Entered Make.</div>' +
        //             '</div>' +
        //             '</div>' +
        //             '<div class="col-lg-4 basic-vehcile-info">' +
        //             '<div class="form-group">' +
        //             '<label>Model *</label>' +
        //             '<input type="text" class="form-control model typeahead" placeholder="Enter Model" name="Vehcile_Model[]" value="">' +
        //             '<div class="invalid-feedback">Entered Model.</div>' +
        //             '</div>' +
        //             '</div>' +
        //             '</div>' +
        //             '<div class="row">' +
        //             '<div class="col-lg-3">' +
        //             '<div class="form-group">' +
        //             '<label>Color</label>' +
        //             '<input type="text" class="form-control" placeholder="Enter Color" name="Vehcile_Color[]" value="">' +
        //             '<div class="invalid-feedback">Entered Color.</div>' +
        //             '</div>' +
        //             '</div>' +
        //             '<div class="col-lg-3">' +
        //             '<div class="form-group">' +
        //             '<label>Vehcile Type</label>' +
        //             '<select class="custom-select" name="Vehcile_Type[]" required>' +
        //             '<option selected="" value="">Select Vehcile Type</option>' +
        //             '<option value="Car">Car</option>' +
        //             '<option value="SUV">SUV</option>' +
        //             '<option value="Pickup">Pickup</option>' +
        //             '<option value="Van">Van</option>' +
        //             '<option disabled="">————————————</option>' +
        //             '<option value="motorcycle">Motorcycle</option>' +
        //             '<option value="atv">ATV</option>' +
        //             '<option disabled="">————————————</option>' +
        //             '<option value="Mini Van">Mini Van</option>' +
        //             '<option value="Cargo Van">Cargo Van</option>' +
        //             '<option value="Passenger Van">Passenger Van</option>' +
        //             '<option disabled="">————————————</option>' +
        //             '<option value="Boat">Boat</option>' +
        //             '<option value="Large Yacht">Large Yacht</option>' +
        //             '<option value="RVs">RVs</option>' +
        //             '<option value="Travel Trailer">Travel Trailer</option>' +
        //             '<option disabled="">————————————</option>' +
        //             '<option value="other_vehicle">Other Vehicle</option>' +
        //             '<option value="other_motorcycle">Other Motorcycle</option>' +
        //             '</select>' +
        //             '<div class="invalid-feedback">Select Vehcile Type</div>' +
        //             '</div>' +
        //             '</div>' +
        //             '<div class="col-lg-3">' +
        //             '<div class="form-group">' +
        //             '<label>Vehcile Condition</label>' +
        //             '<select class="custom-select" name="Vehcile_Condition[]" required>' +
        //             '<option value="Running">Running</option>' +
        //             '<option value="Not Running">Not Running</option>' +
        //             '</select>' +
        //             '<div class="invalid-feedback">Select Vehcile Condition</div>' +
        //             '</div>' +
        //             '</div>' +
        //             '<div class="col-lg-3">' +
        //             '<div class="form-group">' +
        //             '<label>Trailer Type</label>' +
        //             '<select class="custom-select" name="Trailer_Type[]" required>' +
        //             '<option value="Open">Open</option>' +
        //             '<option value="Enclosed">Enclosed</option>' +
        //             '<option value="Drive Away">Drive Away</option>' +
        //             '</select>' +
        //             '<div class="invalid-feedback">Select Any Trailer Type</div>' +
        //             '</div>' +
        //             '</div>' +
        //             '</div>' +
        //             '</div>' +
        //             '</div>';

        //         $("#vehciles").append(new_vehcile);

        //         min_vehcile++;

        //         // Delegate the event handling to a static parent element
        //         $('#vehciles').on('keyup', '#reform' + (min_vehcile - 1) + ' .vin-box input', function () {
        //             const Vin_Number = $(this).val();
        //             console.log(Vin_Number);

        //             $.ajax({
        //                 url: '{{ route('Get.Vin.Number') }}',
        //                 type: 'GET',
        //                 data: {
        //                     'Vin_Number': Vin_Number
        //                 },
        //                 success: function (data) {
        //                     console.log('Response:', data);
        //                     $('#reform' + (min_vehcile - 1) + ' .vehcile-information .basic-vehcile-info input[name="Vehcile_Make[]"]').val(data['Make']);
        //                     $('#reform' + (min_vehcile - 1) + ' .vehcile-information .basic-vehcile-info input[name="Vehcile_Year[]"]').val(data['Year']);
        //                     $('#reform' + (min_vehcile - 1) + ' .vehcile-information .basic-vehcile-info input[name="Vehcile_Model[]"]').val(data['Model']);
        //                 }
        //             });
        //         });
        //     }
        // });

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
                    '<div class="row vin-box">' +
                    '<div class="col-lg-12">' +
                    '<div class="form-group">' +
                    '<label>Vin Number</label>' +
                    '<input type="text" class="form-control vin-input" placeholder="Ex: WBSWL93558P331570" name="Vin_Number[]" value="">' +
                    '<div class="invalid-feedback">Entered Vin Number.</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-lg-4 basic-vehcile-info">' +
                    '<div class="form-group">' +
                    '<label>Year *</label>' +
                    '<input type="text" class="form-control" placeholder="Ex: 2022" name="Vehcile_Year[]" value="">' +
                    '<div class="invalid-feedback">Entered Year.</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-4 basic-vehcile-info">' +
                    '<div class="form-group">' +
                    '<label>Make *</label>' +
                    '<input type="text" class="form-control make typeahead" placeholder="Enter Make" name="Vehcile_Make[]" value="">' +
                    '<div class="invalid-feedback">Entered Make.</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-4 basic-vehcile-info">' +
                    '<div class="form-group">' +
                    '<label>Model *</label>' +
                    '<input type="text" class="form-control model typeahead" placeholder="Enter Model" name="Vehcile_Model[]" value="">' +
                    '<div class="invalid-feedback">Entered Model.</div>' +
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

                // Delegate the event handling to a static parent element
                $('#vehciles').on('keyup', '#reform' + (min_vehcile - 1) + ' .vin-box input',
            function() {
                    const Vin_Number = $(this).val();
                    const currentVinInput = $(
                    this); // Store the reference to the current VIN input

                    $.ajax({
                        url: '{{ route('Get.Vin.Number') }}',
                        type: 'GET',
                        data: {
                            'Vin_Number': Vin_Number
                        },
                        success: function(data) {
                            console.log('Response:', data);
                            // Use the reference to the current VIN input to update the corresponding fields
                            currentVinInput.closest('.vehcile-information').find(
                                '.basic-vehcile-info input[name="Vehcile_Make[]"]'
                                ).val(data['Make']);
                            currentVinInput.closest('.vehcile-information').find(
                                '.basic-vehcile-info input[name="Vehcile_Year[]"]'
                                ).val(data['Year']);
                            currentVinInput.closest('.vehcile-information').find(
                                '.basic-vehcile-info input[name="Vehcile_Model[]"]'
                                ).val(data['Model']);
                        }
                    });
                });
            }
        });

        $("#vehciles").on('click', '.remove-vehcile', function() {
            $(this).closest('.vehcile-information').remove();
            min_vehcile--;
        });
    });

    // $(document).ready(function () {
    //     // Multiples Heavy Equipment Add
    //     var min_heavy_vehcile = 1;
    //     var max_heavy_vehcile = 25;

    //     var new_heavy_vehciles =
    //         '<div id="reform"><div class="heavy-vehcile-information"><div class="row"><div class="col-lg-4"></div><div class="col-lg-4"></div><div class="col-lg-4 justify-content-end"><div class="btn-box text-right"><button type="button" id="remove-heavy-vehicle" class="btn btn-danger"><i class="bx bx-trash"></i>Remove Heavy Vehicle</button></div></div></div><div class="row"><div class="col-lg-4 basic-vehcile-info"><div class="form-group"><label>Year *</label><input type="text" class="form-control" placeholder="Ex: 2022" name="Equipment_Year[]" value="" required><div class="invalid-feedback">Entered Year.</div></div></div><div class="col-lg-4 basic-vehcile-info"><div class="form-group"><label>Make *</label><input type="text" class="form-control" placeholder="Enter Make" name="Equipment_Make[]" value="" required><div class="invalid-feedback">Entered Make.</div></div></div><div class="col-lg-4 basic-vehcile-info"><div class="form-group"><label>Model *</label><input type="text" class="form-control" placeholder="Enter Model" name="Equipment_Model[]" value="" required><div class="invalid-feedback">Entered Model.</div></div></div></div><div class="row"><div class="col-lg-3"><div class="form-group"><label>Length *</label><input type="number" class="form-control" placeholder="Enter Length" min="0" name="Equip_Length[]" value="" required><div class="invalid-feedback">Entered Length.</div></div></div><div class="col-lg-3"><div class="form-group"><label>Width *</label><input type="number" class="form-control" placeholder="Enter Width" min="0" name="Equip_Width[]" value="" required><div class="invalid-feedback">Entered Width.</div></div></div><div class="col-lg-3"><div class="form-group"><label>Height *</label><input type="number" class="form-control" placeholder="Enter Height" min="0" name="Equip_Height[]" value="" required><div class="invalid-feedback">Entered Height.</div></div></div><div class="col-lg-3"><div class="form-group"><label>Weight *</label><input type="number" class="form-control" placeholder="Enter Weight" min="0" name="Equip_Weight[]" value="" required><div class="invalid-feedback">Entered Weight.</div></div></div></div><div class="row"><div class="col-lg-3"><div class="form-group"><label>Equipment Condition</label><select class="custom-select" name="Equipment_Condition[]" required><option selected="" value="">Select Equipment Condition</option><option value="Running">Running</option><option value="Not Running">Not Running</option></select><div class="invalid-feedback">Select Equipment Condition</div></div></div><div class="col-lg-3"><div class="form-group"><label>Trailer Type</label><select class="custom-select" name="Trailer_Type[]" required><option selected="" value="">Select Trailer</option><option value="Flatbed Trailer">Flatbed Trailer</option><option value="Removable Gooseneck Trailer">Removable Gooseneck Trailer</option><option value="Lowboy Trailer">Lowboy Trailer</option><option value="Step Deck Trailer">Step Deck Trailer</option><option value="Extendable Flatbed Trailer">Extendable Flatbed Trailer</option><option value="Stretch Single Drop Deck Trailer">Stretch Single Drop Deck Trailer</option><option value="Tow Away">Tow Away</option><option value="Drive Away">Drive Away</option><option value="Other">Other</option></select><div class="invalid-feedback">Select Any Trailer Type</div></div></div><div class="col-lg-3"><div class="form-group"><label>Shipment Preferences</label><select class="custom-select" name="Shipment_Preferences[]" required><option selected="" value="">Select Shipment Preferences</option><option value="LTL">LTL (Less Than Truck Load)</option><option value="FTL">FTL (Full Truck Load)</option></select><div class="invalid-feedback">Select Shipment Preferences</div></div></div></div></div></div>';

    //     $("#add-heavy-vehicle").click(function () {
    //         if (min_heavy_vehcile <= max_heavy_vehcile) {
    //             $("#heavy-vehciles").append(new_heavy_vehciles);
    //             min_heavy_vehcile++;
    //         }
    //     });
    //     $("#heavy-vehciles").on('click', '#remove-heavy-vehicle', function () {
    //         $(this).closest('#reform').remove();
    //         min_heavy_vehcile--;
    //     });

    // });

    $(document).ready(function() {
        // Multiples Heavy Equipment Add
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
            $(this).closest('.heavy-vehcile-information').remove();
            min_heavy_vehcile--;
        });
    });
</script>
{{-- Script For Heavy Equpment Vehicle => Dynamic or Styling Code --}}
{{-- <script type="text/javascript">
    $(document).ready(function () {
        $('#heavy .orig-basic').hide();
        $('#heavy .orig-auction').hide();
        $('#heavy .orig-dealership').hide();
        $('#heavy .orig-location').hide();
        $('#heavy .orig-port').hide();
        $('#heavy .orig-auction-input-field').hide();

        $('#heavy .Orig').change(function () {
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
                $('#heavy .orig-auction select').change(function () {
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

        $('#heavy .Dest').change(function () {
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
                $('#heavy .dest-auction select').change(function () {
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
        $('.orig-business-location').change(function () {
            const Dest = $(this).val();
            if (Dest === 'Business') {
                $('.orig-location-business').show();
            } else {
                $('.orig-location-business').hide();
            }
        });
        $('.dest-business-location').change(function () {
            const Dest = $(this).val();
            if (Dest === 'Business') {
                $('.dest-location-business').show();
            } else {
                $('.dest-location-business').hide();
            }
        });
        // Date Validations
        $('#heavy .pick-date', this).change(function () {
            var GivenDate = $(this).val();
            var CurrentDate = new Date();
            GivenDate = new Date(GivenDate);

            if (GivenDate < CurrentDate) {
                alert('Plz Select Valid Date.');
                $(this).val(CurrentDate);
            }
        });

        $('#heavy .deliver-date', this).change(function () {
            var GivenDate = $(this).val();
            var CurrentDate = new Date();
            GivenDate = new Date(GivenDate);

            if (GivenDate < CurrentDate) {
                alert('Plz Select Valid Date.');
                $(this).val(CurrentDate);
            }
        });

        // Deposit Amount
        $('#heavy .deposite-box').hide();
        $('#heavy #heavy_deposite_Check').change(function () {
            checkBox = document.getElementById('heavy_deposite_Check');
            if (checkBox.checked) {
                $('#heavy .deposite-box').show();
                $("#heavy .deposite-box input").prop('required', true);
            } else {
                $('#heavy .deposite-box').hide();
                $("#heavy .deposite-box input").prop('required', false);
            }
        });

        // Custom Listing
        $('#heavy .Custom-Date').hide();
        $('#heavy #custom_Check').change(function () {
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
        $('#heavy .Balance-Amount').on('change', function () {
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
        $('#heavy .COD_Amount').on('change', function () {
            var cod = $(this).val();
            if (cod === "") {
                $('#heavy .cod-inputs').hide();
                $("#heavy .cod-inputs select").prop('required', false);
            } else {
                $('#heavy .cod-inputs').show();
                $("#heavy .cod-inputs select").prop('required', true);
            }

        });

        $("#heavy .Price-Pay, #heavy .COD_Amount").on("keydown keyup", function () {
            var PricPay = $('#heavy .Price-Pay').val();
            var CodAmount = $('#heavy .COD_Amount').val();

            var BalanceAmount = Math.max(0, PricPay - CodAmount);
            $('#heavy .Balance-Amount').val(Math.abs(BalanceAmount));
            if (BalanceAmount !== 0) {
                $('#heavy .balance-inputs').show();
                $("#heavy .balance-inputs select").prop('required', true);
            } else {
                $('#heavy .balance-inputs').hide();
                $("#heavy .balance-inputs select").prop('required', false);
            }

            // Heavy Vehicle Payment Info
            $('.PaymentInfo').html("<p class='alert alert-danger codPayor'><span class='codPayorText'>The carrier will receive <b>$" + CodAmount + "</b></span></p>");
        });


        $('#heavy .COD_Payment_Mode').change(function(){
            var PricPay = $('#heavy .Price-Pay').val();
            var CodAmount = $('#heavy .COD_Amount').val();
            var PaymentVia = $('#heavy .COD_Payment_Mode').val();
            var LocationMode = $('#heavy .Location_Mode').val();
            var BalancePaymentVia = $('#heavy .Balance_Payment_Mode').val();
            var BalancePaymentTime = $('#heavy .Bal_Payment_Time').val();

            var BalanceAmount = Math.max(0, PricPay - CodAmount);

            var htmlContent = "<p class='alert alert-danger codPayor'><span class='codPayorText'>The carrier will receive <b>$" + CodAmount + "</b> via <b>" + PaymentVia + "</b></span></p>";
            $('.PaymentInfo').empty().append(htmlContent);
        })

        $('#heavy .Location_Mode').change(function(){
            var PricPay = $('#heavy .Price-Pay').val();
            var CodAmount = $('#heavy .COD_Amount').val();
            var PaymentVia = $('#heavy .COD_Payment_Mode').val();
            var LocationMode = $('#heavy .Location_Mode').val();
            var BalancePaymentVia = $('#heavy .Balance_Payment_Mode').val();
            var BalancePaymentTime = $('#heavy .Bal_Payment_Time').val();

            var BalanceAmount = Math.max(0, PricPay - CodAmount);

            var htmlContent = "<p class='alert alert-danger codPayor'><span class='codPayorText'>The carrier will receive <b>$" + CodAmount + "</b> via <b>" + PaymentVia + "</b> at <b>" + LocationMode + "</b></span></p>";
            $('.PaymentInfo').empty().append(htmlContent);
        })

        $('#heavy .Balance_Payment_Mode').change(function(){
            var PricPay = $('#heavy .Price-Pay').val();
            var CodAmount = $('#heavy .COD_Amount').val();
            var PaymentVia = $('#heavy .COD_Payment_Mode').val();
            var LocationMode = $('#heavy .Location_Mode').val();
            var BalancePaymentVia = $('#heavy .Balance_Payment_Mode').val();
            var BalancePaymentTime = $('#heavy .Bal_Payment_Time').val();

            var BalanceAmount = Math.max(0, PricPay - CodAmount);

            var htmlContent = "<p class='alert alert-danger balancePayor'><span class='balancePayorText'>You will pay the carrier <b>$" + BalanceAmount + "</b> via " + BalancePaymentVia + "</span></p>";
            $('.BalPaymentInfo').html(htmlContent);
        })

        $('#heavy .Bal_Payment_Time').change(function(){
            var PricPay = $('#heavy .Price-Pay').val();
            var CodAmount = $('#heavy .COD_Amount').val();
            var PaymentVia = $('#heavy .COD_Payment_Mode').val();
            var LocationMode = $('#heavy .Location_Mode').val();
            var BalancePaymentVia = $('#heavy .Balance_Payment_Mode').val();
            var BalancePaymentTime = $('#heavy .Bal_Payment_Time').val();

            var BalanceAmount = Math.max(0, PricPay - CodAmount);

            if ($('#heavy .Bal_Payment_Time').val() === "Immediately") {
                var htmlContent = "<p class='alert alert-danger balancePayor'><span class='balancePayorText'>You will pay the carrier <b>$" + BalanceAmount + "</b> via <b>" + BalancePaymentVia + "</b> " + BalancePaymentTime + "</span></p>";
            }
            else {
                var htmlContent = "<p class='alert alert-danger balancePayor'><span class='balancePayorText'>You will pay the carrier <b>$" + BalanceAmount + "</b> via <b>" + BalancePaymentVia + "</b> within " + BalancePaymentTime + "</span></p>";
            }
            $('.BalPaymentInfo').empty().append(htmlContent);
        })
        // End Heavy Vehicle Payment Info
        $('.heavy_Dest_ZipCode.typeahead').typeahead({
            source: function (query, process) {
                return $.get(path, {query: query}, function (data) {
                    return process(data);
                });
            }
        });
        $('.heavy_Origin_ZipCode.typeahead').typeahead({
            source: function (query, process) {
                return $.get(path, {query: query}, function (data) {
                    return process(data);
                });
            }
        });

        // Multiples Heavy Equipment Add
        var min_heavy_vehcile = 1;
        var max_heavy_vehcile = 25;

        var new_heavy_vehciles =
            '<div id="reform"><div class="heavy-vehcile-information"><div class="row"><div class="col-lg-4"></div><div class="col-lg-4"></div><div class="col-lg-4 justify-content-end"><div class="btn-box text-right"><button type="button" id="remove-heavy-vehicle" class="btn btn-danger"><i class="bx bx-trash"></i>Remove Heavy Vehicle</button></div></div></div><div class="row"><div class="col-lg-4 basic-vehcile-info"><div class="form-group"><label>Year *</label><input type="text" class="form-control" placeholder="Ex: 2022" name="Vehcile_Year[]" value="" required><div class="invalid-feedback">Entered Year.</div></div></div><div class="col-lg-4 basic-vehcile-info"><div class="form-group"><label>Make *</label><input type="text" class="form-control" placeholder="Enter Make" name="Vehcile_Make[]" value="" required><div class="invalid-feedback">Entered Make.</div></div></div><div class="col-lg-4 basic-vehcile-info"><div class="form-group"><label>Model *</label><input type="text" class="form-control" placeholder="Enter Model" name="Vehcile_Model[]" value="" required><div class="invalid-feedback">Entered Model.</div></div></div></div><div class="row"><div class="col-lg-3"><div class="form-group"><label>Length *</label><input type="number" class="form-control" placeholder="Enter Length" min="0" name="Vehcile_Length[]" value="" required><div class="invalid-feedback">Entered Length.</div></div></div><div class="col-lg-3"><div class="form-group"><label>Width *</label><input type="number" class="form-control" placeholder="Enter Width" min="0" name="Vehcile_Width[]" value="" required><div class="invalid-feedback">Entered Width.</div></div></div><div class="col-lg-3"><div class="form-group"><label>Height *</label><input type="number" class="form-control" placeholder="Enter Height" min="0" name="Vehcile_Height[]" value="" required><div class="invalid-feedback">Entered Height.</div></div></div><div class="col-lg-3"><div class="form-group"><label>Weight *</label><input type="number" class="form-control" placeholder="Enter Weight" min="0" name="Vehcile_Weight[]" value="" required><div class="invalid-feedback">Entered Weight.</div></div></div></div><div class="row"><div class="col-lg-3"><div class="form-group"><label>Equipment Condition</label><select class="custom-select" name="Equipment_Condition[]" required><option selected="" value="Running">Running</option><option value="Not Running">Not Running</option></select><div class="invalid-feedback">Select Equipment Condition</div></div></div><div class="col-lg-3"><div class="form-group"><label>Trailer Type</label><select class="custom-select" name="Trailer_Type[]" required><option selected="" value="Flatbed Trailer">Flatbed Trailer</option><option value="Removable Goose-neck Trailer">Removable Goose-neck Trailer</option><option value="Lowboy Trailer">Lowboy Trailer</option><option value="Step Deck Trailer">Step Deck Trailer</option><option value="Extendable Flatbed Trailer">Extendable Flatbed Trailer</option><option value="Stretch Single Drop Deck Trailer">Stretch Single Drop Deck Trailer</option><option value="Tow Away">Tow Away</option><option value="Drive Away">Drive Away</option><option value="Other">Other</option></select><div class="invalid-feedback">Select Any Trailer Type</div></div></div><div class="col-lg-3"><div class="form-group"><label>Shipment Preferences</label><select class="custom-select" name="Shipment_Preferences[]" required><option selected="" value="">Select Shipment Preferences</option><option value="LTL">LTL (Less Than Truck Load)</option><option value="FTL">FTL (Full Truck Load)</option></select><div class="invalid-feedback">Select Shipment Preferences</div></div></div></div></div></div>';

        $("#add-heavy-vehicle").click(function () {
            if (min_heavy_vehcile <= max_heavy_vehcile) {
                $("#heavy-vehciles").append(new_heavy_vehciles);
                min_heavy_vehcile++;
            }
        });
        $("#heavy-vehciles").on('click', '#remove-heavy-vehicle', function () {
            $(this).closest('#reform').remove();
            min_heavy_vehcile--;
        });

    });
</script> --}}
{{-- Script For Dry Van => Dynamic or Styling Code --}}
{{-- <script type="text/javascript">
    $('#dry .orig-basic').hide();
    $('#dry .orig-auction').hide();
    $('#dry .orig-dealership').hide();
    $('#dry .orig-location').hide();
    $('#dry .orig-port').hide();
    $('#dry .orig-auction-input-field').hide();

    $('#dry .Orig').change(function () {
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
            $('#dry .orig-auction select').change(function () {
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

    $('#dry .Dest').change(function () {
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
            $('#dry .dest-auction select').change(function () {
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
    // Date Validations
    $('#dry .pick-date', this).change(function () {
        var GivenDate = $(this).val();
        var CurrentDate = new Date();
        GivenDate = new Date(GivenDate);

        if (GivenDate < CurrentDate) {
            alert('Plz Select Valid Date.');
            $(this).val(CurrentDate);
        }
    });

    $('#dry .deliver-date', this).change(function () {
        var GivenDate = $(this).val();
        var CurrentDate = new Date();
        GivenDate = new Date(GivenDate);

        if (GivenDate < CurrentDate) {
            alert('Plz Select Valid Date.');
            $(this).val(CurrentDate);
        }
    });

    // Deposite Amount
    $('#dry .deposite-box').hide();
    $('#dry #dry_deposite_Check').change(function () {
        checkBox = document.getElementById('dry_deposite_Check');
        if (checkBox.checked) {
            $('#dry .deposite-box').show();
            $("#dry .deposite-box input").prop('required', true);
        } else {
            $('#dry .deposite-box').hide();
            $("#dry .deposite-box input").prop('required', false);
        }
    });

    // Custom Listing
    $('#dry .Custom-Date').hide();
    $('#dry #custom_Check').change(function () {
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
    $('#dry .Balance-Amount').on('change', function () {
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
    $('#dry .COD_Amount').on('change', function () {
        var cod = $(this).val();
        if (cod === "") {
            $('#dry .cod-inputs').hide();
            $("#dry .cod-inputs select").prop('required', false);
        } else {
            $('#dry .cod-inputs').show();
            $("#dry .cod-inputs select").prop('required', true);
        }
    });

    $("#dry .Price-Pay, #dry .COD_Amount").on("keydown keyup", function () {
        var PricPay = $('#dry .Price-Pay').val();
        var CodAmount = $('#dry .COD_Amount').val();

        var BalanceAmount = Math.max(0, PricPay - CodAmount);
        $('#dry .Balance-Amount').val(Math.abs(BalanceAmount));
        if (BalanceAmount !== 0) {
            $('#dry .balance-inputs').show();
            $("#dry .balance-inputs select").prop('required', true);
        } else {
            $('#dry .balance-inputs').hide();
            $("#dry .balance-inputs select").prop('required', false);

        }// DryVan Payment Info
        $('.PaymentInfo').html("<p class='alert alert-danger codPayor'><span class='codPayorText'>The carrier will receive <b>$" + CodAmount + "</b></span></p>");
        });


        $('#dry .COD_Payment_Mode').change(function(){
            var PricPay = $('#dry .Price-Pay').val();
            var CodAmount = $('#dry .COD_Amount').val();
            var PaymentVia = $('#dry .COD_Payment_Mode').val();
            var LocationMode = $('#dry .Location_Mode').val();
            var BalancePaymentVia = $('#dry .Balance_Payment_Mode').val();
            var BalancePaymentTime = $('#dry .Bal_Payment_Time').val();

            var BalanceAmount = Math.max(0, PricPay - CodAmount);

            var htmlContent = "<p class='alert alert-danger codPayor'><span class='codPayorText'>The carrier will receive <b>$" + CodAmount + "</b> via <b>" + PaymentVia + "</b></span></p>";
            $('.PaymentInfo').empty().append(htmlContent);
        })

        $('#dry .Location_Mode').change(function(){
            var PricPay = $('#dry .Price-Pay').val();
            var CodAmount = $('#dry .COD_Amount').val();
            var PaymentVia = $('#dry .COD_Payment_Mode').val();
            var LocationMode = $('#dry .Location_Mode').val();
            var BalancePaymentVia = $('#dry .Balance_Payment_Mode').val();
            var BalancePaymentTime = $('#dry .Bal_Payment_Time').val();

            var BalanceAmount = Math.max(0, PricPay - CodAmount);

            var htmlContent = "<p class='alert alert-danger codPayor'><span class='codPayorText'>The carrier will receive <b>$" + CodAmount + "</b> via <b>" + PaymentVia + "</b> at <b>" + LocationMode + "</b></span></p>";
            $('.PaymentInfo').empty().append(htmlContent);
        })

        $('#dry .Balance_Payment_Mode').change(function(){
            var PricPay = $('#dry .Price-Pay').val();
            var CodAmount = $('#dry .COD_Amount').val();
            var PaymentVia = $('#dry .COD_Payment_Mode').val();
            var LocationMode = $('#dry .Location_Mode').val();
            var BalancePaymentVia = $('#dry .Balance_Payment_Mode').val();
            var BalancePaymentTime = $('#dry .Bal_Payment_Time').val();

            var BalanceAmount = Math.max(0, PricPay - CodAmount);

            var htmlContent = "<p class='alert alert-danger balancePayor'><span class='balancePayorText'>You will pay the carrier <b>$" + BalanceAmount + "</b> via " + BalancePaymentVia + "</span></p>";
            $('.BalPaymentInfo').html(htmlContent);
        })

        $('#dry .Bal_Payment_Time').change(function(){
            var PricPay = $('#dry .Price-Pay').val();
            var CodAmount = $('#dry .COD_Amount').val();
            var PaymentVia = $('#dry .COD_Payment_Mode').val();
            var LocationMode = $('#dry .Location_Mode').val();
            var BalancePaymentVia = $('#dry .Balance_Payment_Mode').val();
            var BalancePaymentTime = $('#dry .Bal_Payment_Time').val();

            var BalanceAmount = Math.max(0, PricPay - CodAmount);

            if ($('#dry .Bal_Payment_Time').val() === "Immediately") {
                var htmlContent = "<p class='alert alert-danger balancePayor'><span class='balancePayorText'>You will pay the carrier <b>$" + BalanceAmount + "</b> via <b>" + BalancePaymentVia + "</b> " + BalancePaymentTime + "</span></p>";
            }
            else {
                var htmlContent = "<p class='alert alert-danger balancePayor'><span class='balancePayorText'>You will pay the carrier <b>$" + BalanceAmount + "</b> via <b>" + BalancePaymentVia + "</b> within " + BalancePaymentTime + "</span></p>";
            }
            $('.BalPaymentInfo').empty().append(htmlContent);
        })
        // End DryVan Vehicle Payment Info

    $('.dry_Dest_ZipCode.typeahead').typeahead({
        source: function (query, process) {
            return $.get(path, {query: query}, function (data) {
                return process(data);
            });
        }
    });

    $('.dry_Origin_ZipCode.typeahead').typeahead({
        source: function (query, process) {
            return $.get(path, {query: query}, function (data) {
                return process(data);
            });
        }
    });

    // Multiples Dry Vans
    var min_dry_van = 1;
    var max_dry_van = 25;

    var new_dry_van =
        '<div id="reform"><div class="dry-van-information"><div class="row"><div class="col-lg-4"></div><div class="col-lg-4"></div><div class="col-lg-4 justify-content-end"><div class="btn-box text-right"><button type="button" id="remove-dry-van" class="btn btn-danger"><i class="bx bx-trash"></i>Remove Current Shipment</button></div></div></div><div class="row"><div class="col-lg-3"><div class="form-group"><label>Freight Class *</label><select class="custom-select" name="Freight_Class[]" required><option selected="" value="">Select Class</option><option value="500">500</option><option value="400">400</option><option value="300">300</option><option value="250">250</option><option value="200">200</option><option value="175">175</option><option value="150">150</option><option value="125">125</option><option value="110">110</option><option value="100">100</option><option value="92.5">92.5</option><option value="85">85</option><option value="77.5">77.5</option><option value="70">70</option><option value="65">65</option><option value="60">60</option><option value="55">55</option><option value="50">50</option></select><div class="invalid-feedback">Select Any Class</div></div></div><div class="col-lg-3"><div class="form-group"><label>Freight Weight *</label><input type="number" class="form-control" placeholder="Enter Weight" min="0" name="Freight_Weight[]" value="" required><div class="invalid-feedback">Entered Weight.</div></div><div class="form-group form-check"><input type="checkbox" class="form-check-input" id="hazmat_Check" name="is_hazmat_Check[]"><label class="form-check-label" for="hazmat_Check">Hazmat?</label></div></div><div class="col-lg-3"><div class="form-group"><label>Shipment Preferences</label><select class="custom-select" name="Shipment_Preferences[]"><option selected="" value="">Select Shipment Preferences</option><option value="LTL">LTL (Less Than Truck Load)</option><option value="FTL">FTL (Full Truck Load)</option></select><div class="invalid-feedback">Select Shipment Preferences</div></div></div></div></div></div>';

    $("#add-dry-van").click(function () {
        if (min_dry_van <= max_dry_van) {
            $("#dry-vans").append(new_dry_van);
            min_dry_van++;
        }
    });
    $("#dry-vans").on('click', '#remove-dry-van', function () {
        $(this).closest('#reform').remove();
        min_dry_van--;
    });
</script> --}}
<script>
    window.onload = function() {
        // Get today's date in New Jersey timezone
        var today = new Date();
        var njDate = new Date(today.toLocaleString("en-US", {
            timeZone: "America/New_York"
        }));

        // Format today's date in 'YYYY-MM-DD' format
        var todayString = njDate.toISOString().split('T')[0];

        // Set the minimum date for all date fields to today's date
        var dateFields = document.querySelectorAll('input[type="date"]');
        dateFields.forEach(function(field) {
            field.setAttribute("min", todayString);
        });

        // Date validation on all date fields
        document.addEventListener('change', function(event) {
            var element = event.target;
            if (element.type === 'date') {
                var GivenDate = element.value;
                var CurrentDate = new Date(); // Current date in user's timezone

                // Convert CurrentDate to New Jersey timezone
                var njCurrentDate = new Date(CurrentDate.toLocaleString("en-US", {
                    timeZone: "America/New_York"
                }));

                GivenDate = new Date(GivenDate);

                if (GivenDate < njCurrentDate) {
                    alert('Please select a valid date.');
                    element.value = todayString; // Reset to today's date
                }
            }
        });
    };
</script>
