<!-- Breadcrumb Area -->
<div class="breadcrumb-area">
    <h1>Dashboard</h1>

    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>

        <li class="item">Edit Listing (<strong>Order ID: {{ $Listed_ID }}</strong>)</li>
    </ol>
</div>
<!-- End Breadcrumb Area -->

<div class="card user-settings-box mb-30">
    <div class="card-body">
        <form class="was-validated" method="POST" action="{{ route('User.New.Listing.Submit') }}"
            enctype="multipart/form-data">
            @csrf
            <h3><i class='bx bx-file'></i> Edit Quote</h3>
            <h5><b>Refrence ID:</b> #{{ $Listed_ID }}</h5>

            @if ($Lisiting->Listing_Status == 'Dispatch')
                <div class="row">
                    <div class="col-lg-6 shadow-sm p-3">
                        <h5 class="text-center"><b>Dispatching Company</b></h5>
                        <div class="row">
                            <input hidden type="text" class="Dispatch_Company_ID" name="Dispatch_Company_ID">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Company Name</label>
                                    <input readonly type="text" class="form-control Dispatch-Company-Name typeahead"
                                        name="Company_Name"
                                        value="{{ !is_null($Lisiting->dispatch_listing) ? $Lisiting->dispatch_listing->dispatch_user->Company_Name : '' }}"
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
                                    <input readonly type="text" class="form-control Dispatch-Mc_Number"
                                        name="Mc_Number"
                                        value="{{ !is_null($Lisiting->dispatch_listing) ? $Lisiting->dispatch_listing->dispatch_user->Mc_Number : '' }}"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Contact Phone</label>
                                    <input readonly type="text" class="form-control Dispatch-Contact_Phone"
                                        name="Contact_Phone"
                                        value="{{ !is_null($Lisiting->dispatch_listing) ? $Lisiting->dispatch_listing->dispatch_user->Contact_Phone : '' }}"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Company State</label>
                                    <input readonly type="text" class="form-control Dispatch-Company_State"
                                        name="Company_State"
                                        value="{{ !is_null($Lisiting->dispatch_listing) ? $Lisiting->dispatch_listing->dispatch_user->Company_State : '' }}"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Company City</label>
                                    <input readonly type="text" class="form-control Dispatch-Company_City"
                                        name="Company_City"
                                        value="{{ !is_null($Lisiting->dispatch_listing) ? $Lisiting->dispatch_listing->dispatch_user->Company_City : '' }}"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Company Address</label>
                                    <input readonly type="text" class="form-control Dispatch-Address" name="Address"
                                        value="{{ !is_null($Lisiting->dispatch_listing) ? $Lisiting->dispatch_listing->dispatch_user->Address : '' }}"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Local Phone</label>
                                    <input readonly type="text" class="form-control Dispatch-Local_Phone"
                                        name="Local_Phone"
                                        value="{{ !is_null($Lisiting->dispatch_listing) ? $Lisiting->dispatch_listing->dispatch_user->Local_Phone : '' }}"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Toll Free Phone</label>
                                    <input readonly type="text" class="form-control Dispatch-Toll_Free"
                                        name="Toll_Free"
                                        value="{{ !is_null($Lisiting->dispatch_listing) ? $Lisiting->dispatch_listing->dispatch_user->Toll_Free : '' }}"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Dispatch Phone</label>
                                    <input readonly type="text" class="form-control Dispatch-Dispatch_Phone"
                                        name="Dispatch_Phone"
                                        value="{{ !is_null($Lisiting->dispatch_listing) ? $Lisiting->dispatch_listing->dispatch_user->Dispatch_Phone : '' }}"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Fax Number</label>
                                    <input readonly type="text" class="form-control Dispatch-Fax_Phone"
                                        name="Fax_Phone"
                                        value="{{ !is_null($Lisiting->dispatch_listing) ? $Lisiting->dispatch_listing->dispatch_user->Fax_Phone : '' }}"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <h5 class="text-center"><b>Driver Information</b></h5>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Driver Name</label>
                                    <input type="text" class="form-control" name="Driver_Name"
                                        value="{{ !is_null($Lisiting->driver) ? $Lisiting->driver->Driver_Name : '' }}"
                                        placeholder="Driver Name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Driver Email</label>
                                    <input type="email" class="form-control"
                                        value="{{ !is_null($Lisiting->driver) ? $Lisiting->driver->Driver_Email : '' }}"
                                        name="Driver_Email" placeholder="Driver Email">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Driver Phone</label>
                                    <input type="text" class="form-control phone-number" name="Driver_Phone"
                                        placeholder="Driver Phone"
                                        value="{{ !is_null($Lisiting->driver) ? $Lisiting->driver->Driver_Phone : '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 shadow-sm p-3">
                        <h5 class="text-center"><b>Your Company Information</b></h5>
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
            @endif

            @include('partials.edit-dispatch-form', [$currentRouteMatchesPattern])

            <div class="btn-box text-center">
                <button type="submit" class="submit-btn w-100"><i class='bx bx-save'></i>
                    Update Listing
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script For Post Vehicle => Dynamic or Styling Code --}}
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
                        1]; // Extract the vehicle ID from the radio button name

                    // Define the selector for the specific vehicle section
                    const reformSelector = `#reform${min_vehcile_id}`;

                    // Show/hide sections based on the selected radio button
                    if ($(this).val() === 'YMM') {
                        $(`${reformSelector} .vin-box-dynimic`)
                            .hide(); // Hide VIN input section
                        $(`${reformSelector} .new-basic-info`)
                            .show(); // Show Year, Make, Model input sections

                        // Show and enable YMM input fields, hide and disable VIN input fields within the specific vehicle section
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
                            .show(); // Show VIN input section

                        // Show and enable VIN input fields, hide and disable YMM input fields within the specific vehicle section
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
        // $("#vehciles").on('click', '.remove-vehcile', function() {
        $(document).on('click', '.remove-vehcile', function() {
            const getVehicleID = $(this).find('.Vehicle-ID').val();
            const getListID = '{{ $Listed_ID }}';
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
{{-- Script For Heavy Equpment Vehicle => Dynamic or Styling Code --}}
<script type="text/javascript">
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
            $(this).closest('#reform').remove();
            min_heavy_vehcile--;
        });

    });
</script>
{{-- Script For Dry Van => Dynamic or Styling Code --}}
<script type="text/javascript">
    // Multiples Dry Vans
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
        // Get today's date in New Jersey timezone
        var today = new Date();
        var njDate = new Date(today.toLocaleString("en-US", {
            timeZone: "America/New_York"
        }));

        // Get tomorrow's date
        var tomorrow = new Date(njDate);
        tomorrow.setDate(tomorrow.getDate() + 1);

        // Format tomorrow's date in 'YYYY-MM-DD' format
        var tomorrowString = tomorrow.toISOString().split('T')[0];

        // Format today's date in 'YYYY-MM-DD' format
        var todayString = njDate.toISOString().split('T')[0];

        // Set the minimum date for the pickup date field to today's date
        document.getElementById("pdatate1").setAttribute("min", todayString);

        // Set the minimum date for the delivery date field to today's date
        document.querySelector('.deliver-date').setAttribute("min", todayString);

        // jQuery code for date validation on both pickup date and delivery date fields
        $('#pdatate1, .deliver-date').change(function() {
            var GivenDate = $(this).val();
            var CurrentDate = new Date(); // Current date in user's timezone

            // Convert CurrentDate to New Jersey timezone
            var njCurrentDate = new Date(CurrentDate.toLocaleString("en-US", {
                timeZone: "America/New_York"
            }));

            GivenDate = new Date(GivenDate);

            if (GivenDate >= njCurrentDate) {
                console.log('Selected date is valid.');
            } else {
                $(this).val(todayString); // Reset to today's date
            }
        });

        // Code to handle radio button clicks for Pickup mode
        $('input[name="PickUp_mode"]').click(function() {
            if ($(this).val() === 'Before') {
                // Set min attribute to allow selection of dates starting from tomorrow
                $('#pdatate1').attr('min', tomorrowString);
            } else {
                // Reset min attribute to today's date
                $('#pdatate1').attr('min', todayString);
            }
        });

        // Code to handle radio button clicks for Delivery mode
        $('input[name="Delivery_mode"]').click(function() {
            if ($(this).val() === 'Before') {
                // Set min attribute to allow selection of dates starting from tomorrow
                $('.deliver-date').attr('min', tomorrowString);
            } else {
                // Reset min attribute to today's date
                $('.deliver-date').attr('min', todayString);
            }
        });
    };
</script>

<script>
    $(document).ready(function() {
        // Add change event listener to Pickup End Time input
        $('input[name="Pickup_End_Time"]').on('change', function() {
            // Get values of Pickup Start Time and Pickup End Time
            var pickupStartTime = $('input[name="Pickup_Start_Time"]').val();
            var pickupEndTime = $(this).val();

            // Convert string time to Date objects for comparison
            var startTime = new Date('1970-01-01 ' + pickupStartTime);
            var endTime = new Date('1970-01-01 ' + pickupEndTime);

            // Compare Pickup End Time with Pickup Start Time
            if (endTime < startTime) {
                // If Pickup End Time is earlier than Pickup Start Time, reset Pickup End Time to Pickup Start Time
                $(this).val(pickupStartTime);
                alert('Pickup End Time cannot be earlier than Pickup Start Time.');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Add change event listener to Delivery End Time input
        $('input[name="Delivery_End_Time"]').on('change', function() {
            // Get values of Delivery Start Time and Delivery End Time
            var deliveryStartTime = $('input[name="Delivery_Start_Time"]').val();
            var deliveryEndTime = $(this).val();

            // Convert string time to Date objects for comparison
            var startTime = new Date('1970-01-01 ' + deliveryStartTime);
            var endTime = new Date('1970-01-01 ' + deliveryEndTime);

            // Compare Delivery End Time with Delivery Start Time
            if (endTime < startTime) {
                // If Delivery End Time is earlier than Delivery Start Time, reset Delivery End Time to Delivery Start Time
                $(this).val(deliveryStartTime);
                alert('Delivery End Time cannot be earlier than Delivery Start Time.');
            }
        });

        // Delegate the event handling to a static parent element
        $(document).on('input', 'input[name^="Vehcile_Year"]', function() {
            const yearInput = $(this);
            const year = yearInput.val();

            // Check if the input contains more than 4 characters
            if (year.length > 4) {
                // If more than 4 characters, truncate the input to 4 characters
                yearInput.val(year.slice(0, 4));
            } else if (year.length === 4) {
                // If the input has exactly 4 characters, check if it's within the allowed range
                const yearInt = parseInt(year);
                if (yearInt < 1990 || yearInt > 2024) {
                    // If the year is outside the range, clear the input value and show an error message
                    yearInput.val('');
                    alert('Please enter a year between 1990 and 2024.');
                }
            }
        });
    });
</script>
