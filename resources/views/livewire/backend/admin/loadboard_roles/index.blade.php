@extends('layouts.authorized-admin')

@section('content')
    <style>
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
                <h4 class="mb-sm-0">Loadboard Roles</h4>
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
                    <h5 class="card-title mb-0">All Loadboard Roles</h5>
                </div>
                <div class="col-6 text-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoleModal">Add New</button>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-striped align-middle text-center">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->type }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->status ? 'Active' : 'Inactive' }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm edit-role-btn" data-id="{{ $role->id }}"
                                    data-type="{{ $role->type }}" data-name="{{ $role->name }}"
                                    data-status="{{ $role->status }}" data-bs-toggle="modal"
                                    data-bs-target="#editRoleModal">
                                    Edit
                                </button>
                                <a href="{{ route('loadboard.roles.destroy', $role->id) }}" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Role Modal -->
    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addRoleForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <select name="type" class="form-control type">
                                <option value="Broker" selected>Broker</option>
                                <option value="Carrier">Carrier</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <h6 class="">Permissions</h6>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-check">
                                    <input type="checkbox" name="account_info" class="form-check-input" value="1"
                                        id="account_info">
                                    <label class="form-check-label" for="account_info">Account Info</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input type="checkbox" name="profile_edit" class="form-check-input" value="1"
                                        id="profile_edit">
                                    <label class="form-check-label" for="profile_edit">Profile Edit</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input type="checkbox" name="payment_access" class="form-check-input" value="1"
                                        id="payment_access">
                                    <label class="form-check-label" for="payment_access">Payment Access</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input type="checkbox" name="load_posting" class="form-check-input" value="1"
                                        id="load_posting">
                                    <label class="form-check-label" for="load_posting">Load Posting</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input type="checkbox" name="assign_loads" class="form-check-input" value="1"
                                        id="assign_loads">
                                    <label class="form-check-label" for="assign_loads">Assign Loads</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input type="checkbox" name="carrier_communication" class="form-check-input"
                                        value="1" id="carrier_communication">
                                    <label class="form-check-label" for="carrier_communication">Carrier
                                        Communication</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input type="checkbox" name="shipper_communication" class="form-check-input"
                                        value="1" id="shipper_communication">
                                    <label class="form-check-label" for="shipper_communication">Shipper
                                        Communication</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input type="checkbox" name="rate_carrier" class="form-check-input" value="1"
                                        id="rate_carrier">
                                    <label class="form-check-label" for="rate_carrier">Rate Carrier</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input type="checkbox" name="update_status" class="form-check-input" value="1"
                                        id="update_status">
                                    <label class="form-check-label" for="update_status">Update Status</label>
                                </div>
                            </div>
                            <div class="col-6 carrier-role">
                                <div class="form-check">
                                    <input type="checkbox" name="search_load" class="form-check-input carrier"
                                        value="1" id="search_load">
                                    <label class="form-check-label" for="search_load">Search Load</label>
                                </div>
                            </div>
                            <div class="col-6 carrier-role">
                                <div class="form-check">
                                    <input type="checkbox" name="bid_loads" class="form-check-input carrier"
                                        value="1" id="bid_loads">
                                    <label class="form-check-label" for="bid_loads">Bid Loads</label>
                                </div>
                            </div>
                            <div class="col-6 carrier-role">
                                <div class="form-check">
                                    <input type="checkbox" name="broker_communication" class="form-check-input carrier"
                                        value="1" id="broker_communication">
                                    <label class="form-check-label" for="broker_communication">Broker
                                        Communication</label>
                                </div>
                            </div>
                            <div class="col-6 carrier-role">
                                <div class="form-check">
                                    <input type="checkbox" name="rate_broker" class="form-check-input carrier"
                                        value="1" id="rate_broker">
                                    <label class="form-check-label" for="rate_broker">Rate Broker</label>
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

    <!-- Edit Role Modal -->
    <div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editRoleForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="editRoleId">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <select name="type" id="editRoleType" class="form-control type">
                                <option value="Broker">Broker</option>
                                <option value="Carrier">Carrier</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" id="editRoleName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" id="editRoleStatus" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <h6 class="">Permissions</h6>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-check">
                                    <input type="checkbox" name="account_info" class="form-check-input" value="1"
                                        id="account_info">
                                    <label class="form-check-label" for="account_info">Account Info</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input type="checkbox" name="profile_edit" class="form-check-input" value="1"
                                        id="profile_edit">
                                    <label class="form-check-label" for="profile_edit">Profile Edit</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input type="checkbox" name="payment_access" class="form-check-input" value="1"
                                        id="payment_access">
                                    <label class="form-check-label" for="payment_access">Payment Access</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input type="checkbox" name="load_posting" class="form-check-input" value="1"
                                        id="load_posting">
                                    <label class="form-check-label" for="load_posting">Load Posting</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input type="checkbox" name="assign_loads" class="form-check-input" value="1"
                                        id="assign_loads">
                                    <label class="form-check-label" for="assign_loads">Assign Loads</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input type="checkbox" name="carrier_communication" class="form-check-input"
                                        value="1" id="carrier_communication">
                                    <label class="form-check-label" for="carrier_communication">Carrier
                                        Communication</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input type="checkbox" name="shipper_communication" class="form-check-input"
                                        value="1" id="shipper_communication">
                                    <label class="form-check-label" for="shipper_communication">Shipper
                                        Communication</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input type="checkbox" name="rate_carrier" class="form-check-input" value="1"
                                        id="rate_carrier">
                                    <label class="form-check-label" for="rate_carrier">Rate Carrier</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input type="checkbox" name="update_status" class="form-check-input" value="1"
                                        id="update_status">
                                    <label class="form-check-label" for="update_status">Update Status</label>
                                </div>
                            </div>
                            <div class="col-6 carrier-role">
                                <div class="form-check">
                                    <input type="checkbox" name="search_load" class="form-check-input carrier"
                                        value="1" id="search_load">
                                    <label class="form-check-label" for="search_load">Search Load</label>
                                </div>
                            </div>
                            <div class="col-6 carrier-role">
                                <div class="form-check">
                                    <input type="checkbox" name="bid_loads" class="form-check-input carrier"
                                        value="1" id="bid_loads">
                                    <label class="form-check-label" for="bid_loads">Bid Loads</label>
                                </div>
                            </div>
                            <div class="col-6 carrier-role">
                                <div class="form-check">
                                    <input type="checkbox" name="broker_communication" class="form-check-input carrier"
                                        value="1" id="broker_communication">
                                    <label class="form-check-label" for="broker_communication">Broker
                                        Communication</label>
                                </div>
                            </div>
                            <div class="col-6 carrier-role">
                                <div class="form-check">
                                    <input type="checkbox" name="rate_broker" class="form-check-input carrier"
                                        value="1" id="rate_broker">
                                    <label class="form-check-label" for="rate_broker">Rate Broker</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript for Modal Handling -->
    <script>
        $(document).ready(function() {
            // Populate edit modal with role data
            $(".edit-role-btn").on("click", function() {
                $("#editRoleId").val($(this).data("id"));
                $("#editRoleType").val($(this).data("type"));
                $("#editRoleName").val($(this).data("name"));
                $("#editRoleStatus").val($(this).data("status"));

                // Loop through each permission and check if it's 1
                let permissions = [
                    "account_info", "profile_edit", "payment_access", "load_posting",
                    "assign_loads", "carrier_communication", "shipper_communication",
                    "rate_carrier", "update_status", "search_load", "bid_loads",
                    "broker_communication", "rate_broker"
                ];

                permissions.forEach(function(permission) {
                    if ($(this).data(permission) == 1) {
                        $("#" + permission).prop("checked", true);
                    } else {
                        $("#" + permission).prop("checked", false);
                    }
                }.bind(this)); // Bind 'this' to use data attributes correctly
            });

            // AJAX for adding new role
            $("#addRoleForm").on("submit", function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('loadboard.roles.store') }}",
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

            $("#editRoleForm").on("submit", function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let id = $("#editRoleId").val();

                $.ajax({
                    url: "{{ url('Admin/load-board/update') }}/" + id,
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

            $('.carrier-role').hide();
            $('.type').change(function() {
                const type = $(this).val();
                if (type === 'Carrier') {
                    $('.carrier-role').show();
                } else {
                    $('.carrier-role').hide();
                }
            });
        });
    </script>
@endsection
