@extends('layouts.authorized-admin')

@section('content')
    <style>
        table.dataTable {
            width: 100% !important;
        }

        .tab-pane.active {
            display: block;
        }

        .tab-pane {
            display: none;
        }

        .btn-success.active {
            display: block;
        }

        .mf-content.w-100 {
            background: #8080802e;
            padding: 20px;
        }

        div#tab2 {
            overflow-y: scroll;
        }

        .modal-dialog.modal-dialog-centered {
            max-width: 50%;
        }

        .modal-backdrop.fade.show {
            width: 100%;
            height: 100%;
        }
    </style>

    <!-- Start Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">User Sheets</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('Agent.Dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">User Profiles</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Title -->

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h5 class="card-title mb-0">Carrier || Shipper || Broker Data</h5>
                </div>
                <div class="col-6 text-end">
                    <button class="btn btn-primary addUserBtn" data-bs-toggle="modal" data-bs-target="#addUserSheetModal">Add
                        New</button>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <label for="filterType">Type</label>
                        <select id="filterType" class="form-control">
                            <option value="">All Types</option>
                            @foreach($permission as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="filterName">Name</label>
                        <input type="text" id="filterName" class="form-control" placeholder="Search Name">
                    </div>
                    <div class="col-md-3">
                        <label for="filterPhone">Phone One</label>
                        <input type="text" id="filterPhone" class="form-control" placeholder="Search Phone">
                    </div>
                    <div class="col-md-3">
                        <label for="filterState">State</label>
                        <input type="text" id="filterState" class="form-control" placeholder="Search State">
                    </div>
                </div>
            </div>

            <table class="table table-striped align-middle text-center" id="carriersCompanyTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Company Name</th>
                    <th>State</th>
                    <th>Address</th>
                    <th>Main Number</th>
                    <th>Local Number</th>
                    <th>Truck</th>
                    <th>Other Details</th>
                    <th>Equipment</th>
                    <th>Route Description</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
            </table>
        </div>

    </div>

    <!-- Add UserSheet Modal -->
    <div class="modal fade" id="addUserSheetModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalTitle">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addUserSheetForm">
                    @csrf
                        <input type="hidden" name="id" id="id"> <!-- Hidden field for edit -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Type</label>
                                <select name="type" id="type" class="form-control" required>
                                    <option value="">Select Type</option>
                                    @foreach($permission as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Company Name</label>
                                <input type="text" name="company_name" id="company_name" class="form-control" required maxlength="80">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">State</label>
                                <select name="state" id="state" class="form-control" required>
                                    <option value="">Select State</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state->state }}">{{ $state->state }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" id="address" class="form-control" required maxlength="200"></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Main Number</label>
                                <input type="text" name="main_number" id="main_number" class="form-control" required maxlength="60">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Local Number</label>
                                <input type="text" name="local_number" id="local_number" class="form-control" maxlength="60">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Truck</label>
                                <input type="text" name="truck" id="truck" class="form-control" maxlength="100">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Other Details</label>
                                <input type="text" name="other_details" id="other_details" class="form-control" maxlength="100">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Equipment</label>
                                <textarea name="equipment" id="equipment" class="form-control" maxlength="300"></textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Route Description</label>
                                <textarea name="route_description" id="route_description" class="form-control" maxlength="300"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#main_number, #local_number').inputmask('(999) 999-9999'); // US format
        });
    </script>


    <script>
        $(document).ready(function () {
            function loadDataTable() {
                $('#carriersCompanyTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('userSheet') }}",
                        data: function (d) {
                            d.type = $('#filterType').val();
                            d.name = $('#filterName').val();
                            d.phone = $('#filterPhone').val();
                            d.state = $('#filterState').val();
                        }
                    },
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'type_1', name: 'type_1' },
                        { data: 'company_name', name: 'company_name' },
                        { data: 'state', name: 'state' },
                        { data: 'address', name: 'address' },
                        { data: 'main_number', name: 'main_number' },
                        { data: 'local_number', name: 'local_number' },
                        { data: 'truck', name: 'truck' },
                        { data: 'other_details', name: 'other_details' },
                        { data: 'equipment', name: 'equipment' },
                        { data: 'route_description', name: 'route_description' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'actions', name: 'actions', orderable: false, searchable: false },
                    ],
                    destroy: true
                });
            }

            // Load DataTable
            loadDataTable();

            // Filter Event Handlers
            $('#filterType, #filterName, #filterPhone, #filterState').on('keyup change', function () {
                $('#carriersCompanyTable').DataTable().draw();
            });
        });
    </script>

    <script>

        $(document).on("click", ".addUserBtn", function () {
            $("#userModalTitle").text("Add New User");
            $("#user_id").val(""); // Clear user ID field
            $("#addUserSheetForm")[0].reset(); // Reset all fields
            $("#addUserSheetModal").modal("show");
        });

        // Handle Edit User Button Click
        $(document).on("click", ".editUserBtn", function () {
            let user = $(this).data("details"); // Retrieve user data

            // Ensure user data is parsed correctly if needed
            if (typeof user === "string") {
                user = JSON.parse(user);
            }

            $("#userModalTitle").text("Edit User");
            $("#id").val(user.id);
            $("#type").val(user.type);
            $("#company_name").val(user.company_name);
            $("#state").val(user.state);
            $("#address").val(user.address);
            $("#main_number").val(user.main_number);
            $("#local_number").val(user.local_number);
            $("#truck").val(user.truck);
            $("#other_details").val(user.other_details);
            $("#equipment").val(user.equipment);
            $("#route_description").val(user.route_description);

            $("#addUserSheetModal").modal("show");
        });


    </script>

    <!-- JavaScript for Modal Handling -->
    <script>
        $(document).ready(function() {

            $("#addUserSheetForm").on("submit", function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('userSheet.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            });

            // AJAX for editing user sheet
            $("#editUserSheetForm").on("submit", function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let id = $("#editUserSheetId").val(); // Ensure this ID is correct

                $.ajax({
                    url: "{{ url('Admin/user-sheet/update') }}/" + id,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>

@endsection
