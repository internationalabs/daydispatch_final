
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
                <button class="btn btn-info add-btn" data-bs-toggle="modal" data-bs-target="#permissionModal">
                    <i class="ri-add-fill me-1 align-bottom"></i> Add New Permission
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
               style="width:100%">
            <thead>
            <tr>
                <th>Permission Name</th>
                <th>Label</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($permission as $row)
                <tr>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->label }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm editPermissionBtn"
                                data-id="{{ $row->id }}"
                                data-name="{{ $row->name }}"
                                data-label="{{ $row->label }}"
                                data-bs-toggle="modal" data-bs-target="#permissionModal">
                            Edit
                        </button>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3">No permissions found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add/Edit Modal -->
    <div class="modal fade" id="permissionModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header bg-soft-info p-3">
                    <h5 class="modal-title" id="modalTitle">Add New Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('Admin.Permissions.Store') }}" method="POST" class="needs-validation" novalidate autocomplete="off">
                    @csrf
                    <input type="hidden" id="permission_id" name="id"> <!-- Hidden ID field for editing -->

                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-lg-12">
                                <div>
                                    <label for="name-field" class="form-label">Permission Name</label>
                                    <input type="text" id="name-field" class="form-control"
                                           placeholder="Enter Permission Name"
                                           onkeypress="return /^[a-zA-Z\s]*$/g.test(event.key)"
                                           name="name" maxlength="50" required />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <label for="label-field" class="form-label">Permission Label</label>
                                    <input type="text" id="label-field" class="form-control"
                                           placeholder="Enter Permission Label"
                                           onkeypress="return /^[a-zA-Z\s]*$/g.test(event.key)"
                                           name="label" maxlength="50" required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="save-btn">Add New Permission</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Handle Add Permission Button Click
        $(".add-btn").on("click", function () {
            $("#modalTitle").text("Add New Permission");
            $("#save-btn").text("Add New Permission");
            $("#permission_id").val(""); // Clear ID field
            $("#name-field").val(""); // Clear name field
            $("#label-field").val(""); // Clear label field
        });

        // Handle Edit Permission Button Click
        $(".editPermissionBtn").on("click", function () {
            let permissionId = $(this).data("id");
            let permissionName = $(this).data("name");
            let permissionLabel = $(this).data("label");

            $("#modalTitle").text("Edit Permission");
            $("#save-btn").text("Update Permission");
            $("#permission_id").val(permissionId);
            $("#name-field").val(permissionName);
            $("#label-field").val(permissionLabel);
        });
    });

</script>


<!--end add modal-->
