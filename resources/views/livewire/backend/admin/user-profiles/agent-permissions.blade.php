<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

<!-- Include Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<style>

    /* Fix Select2 selected option background */
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #007bff !important; /* Change to your theme color */
        color: #fff !important; /* Ensure text is readable */
        border: none !important;
    }

    .select2-container {
        z-index: 2000 !important; /* Ensure it appears above the modal */
    }

</style>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Dashboard</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('Admin.Dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Users List</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="card">
    <div class="card-header">
        <div class="d-flex align-items-center flex-wrap gap-2">
            <div class="flex-grow-1">
                <button class="btn btn-info add-btn" data-bs-toggle="modal" data-bs-target="#showModal"><i class="ri-add-fill me-1 align-bottom"></i> Add New Permission Set</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="" class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
               style="width:100%">
            <thead>
            <tr>
                <th>Agent</th>
                <th>Permission</th>
                <th>State</th>
                <th>Nos Allowed</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($permissionSet as $row)
                <tr>
                    <td>{{ $row->agent->name }}</td>
                    <td>{{ $row->permission->name }}</td>
                    <td>{{ $row->state }}</td>
                    <td>{{ $row->allow }}</td>
                    <td>
                        <div class="dropdown d-inline-block">
                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false"> Actions
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item edit-permission" data-bs-toggle="modal" data-bs-target="#showModal"><i
                                            class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                            <input type="hidden" class="agent_name" value="{{ $row->agent->name }}">
                                            <input type="hidden" class="agent_id" value="{{ $row->user_id }}">
                                            <input type="hidden" class="permission_name" value="{{ $row->permission->name }}">
                                            <input type="hidden" class="allow" value="{{ $row->allow }}">
                                            <input type="hidden" class="main_id" value="{{ $row->id }}">
                                            <input type="hidden" class="state" value="{{ json_encode($row->state) }}">
                                            <input type="hidden" class="permission" value="{{ $row->permission_name }}"> Edit</a>
                                </li>
                                <li><a class="dropdown-item delete-permission"><i
                                            class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                            <input type="hidden" class="agent_id_dlt" value="{{ $row->user_id }}">
                                            <input type="hidden" class="permission_dlt" value="{{ $row->permission_name }}"> Delete</a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @empty
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header bg-soft-info p-3">
                <h5 class="modal-title" id="exampleModalLabel">Add New Permission Set To Database</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form action="{{ route('Admin.AgentPermission.Store') }}" method="POST" class="needs-validation" novalidate class="tablelist-form" autocomplete="off">
                @csrf
                <input id="main_id" type="hidden">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div>
                                <label for="name-field" class="form-label">Permission Name</label>
                                <select name="permission" id="permissionID" class="form-select permission">
                                    <option value="" selected>Select Permission</option>
                                    @foreach ($permission as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label for="label-field" class="form-label">Permission Label</label>
                                <select name="agent" id="agent_id" class="form-select">
                                    <option value="" selected>Select Agent</option>
                                    @foreach ($agent as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label for="number-field" class="form-label">Enter Range to Allow</label>
                                <input type="number" min="0" max="6000" id="allow" class="form-control" placeholder="Enter Permission Label"
                                       name="allow" required />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label for="state-select" class="form-label">Select States to Allow</label>
                                <div class="state">
                                    <select name="state[]" multiple id="state-select" class="form-select state-select">
                                        <option value="" selected>Select States</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="add-btn">Add New Permission Set</button>
                        <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!--end add modal-->

<script>
    $(document).ready(function () {
        function initSelect2() {
            $(".state-select").select2({
                placeholder: "Select States",
                allowClear: true,
                dropdownParent: $("#state-select").parent() // Attach dropdown to correct parent
            });
        }

        initSelect2(); // Initialize Select2 on page load
        var states = null
        $('.permission').change(function () {
            const permission = $(this).val();

            $.ajax({
                url: '{{ route('Admin.Carrier.States') }}',
                type: 'GET',
                data: { 'permission': permission },
                dataType: 'json',
                success: function (data) {
                    let $select = $("#state-select");

                    if ($select.length === 0) {
                        $(".state").html('<select name="state[]" multiple id="state-select" class="form-select state-select"></select>');
                        $select = $("#state-select");
                    }

                    $select.select2('destroy').empty(); // Destroy existing Select2 before updating

                    $.each(data, function (index, val) {
                        $select.append(`<option value="${val.state}">${val.state} (${val.total})</option>`);
                    });

                    initSelect2();

                    if(states){
                        $(".state-select").val(states).trigger("change");
                    }
                },
                error: function (xhr, status, error) {
                    console.log("Error fetching data:", error);
                }
            });
        });

        $(".edit-permission").click(function () {
            var agentID = $(this).find('.agent_id').val();
            var permissionID = $(this).find('.permission').val();
            var allow = $(this).find('.allow').val();
            var main_id = $(this).find('.main_id').val();

            $("#agent_id").val(agentID);

            $("#allow").val(allow);
            $("#main_id").val(main_id);

            states = JSON.parse($(this).find('.state').val());
            if (typeof states === 'string') {
                states = states.split(','); // Convert to an array if it's a comma-separated string
            }
            $("#permissionID").val(permissionID).trigger('change');

        });
    });









    $(".delete-permission").click(function () {
        var userConfirmation = confirm("Are you sure you want to delete this record?");
        if (userConfirmation)
        {
            var agent = $(this).find('.agent_id_dlt').val();
            var permission = $(this).find('.permission_dlt').val();

            $.ajax({
                url: '{{ route("Admin.AgentPermission.Delete") }}',
                type: 'GET',
                data: {
                    'agent': agent,
                    'permission': permission
                },
                success: function (data) {
                    console.log('Deleted Successfully');
                    location.reload();
                }
            });
        }
    });
</script>
