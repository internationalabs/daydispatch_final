@php
    $checkAccess = Auth::guard('Admin')->user();
    $checkAccess = App\Models\Auth\AuthorizedAdmin::with('role')
        ->where('id', $checkAccess->id)
        ->first();

    $AdminPermission = explode(',', $checkAccess->permission);
@endphp
<!-- start page title -->
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
        <h5 class="card-title mb-0">All Admins List</h5>
    </div>
    <div class="card-body">
        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
            style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($All_Users as $User)
                    <tr>
                        <td>{{ $User->name }}<br>
                            @if ($User->email)
                                {{ $User->email }}<br>
                            @else
                                <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Email Not Verified!">{{ $User->email }}</span><br>
                            @endif
                        </td>
                        <td>
                            <strong>Created At: </strong>{{ $User->created_at }}<br>
                        </td>
                        <td>
                            <strong>Created At: </strong>{{ $User->created_at }}<br>
                            <strong>Updated At: </strong>{{ $User->updated_at }}<br>
                        </td>
                        <td>
                            <div class="dropdown d-inline-block">
                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false"> Actions
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a href="#RolesPermissions" class="dropdown-item btn-click"
                                            data-bs-toggle="modal"><i
                                                class="ri-eye-fill align-bottom me-2 text-muted"></i> View Profile
                                            <input hidden type="text" class="user_id" value="{{ $User->id }}">
                                        </a>
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

<!--{{-- Manage Roles Permissions --}}-->
<div class="modal fade" id="RolesPermissions" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0" style="max-width: 100%">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <div class="card">
                <div class="card-header border-0">
                    <div class="text-center mt-2">
                        <h5 class="text-primary">Manage Permissions</h5>
                        <!--<p class="text-muted">Get your free Day Dispatch account now</p>-->
                    </div>
                </div>
                <div class="card-body">
                    @php
                        $permissions = App\Models\AdminPermissions::get();
                        $chunks = $permissions->chunk(ceil($permissions->count() / 3));
                    @endphp
                    <!-- Tab panes -->
                    <form method="POST" action="{{ route('Store.Admin.Permission') }}" enctype="multipart/form-data"
                        class="needs-validation" novalidate>
                        @csrf
                        <div class="tab-content text-muted">
                            <div class="tab-pane active" id="AdminTab" role="tabpanel">
                                <div class="form-check">
                                    <input type="checkbox" id="selectAllCheckbox" class="form-check-input">
                                    <label class="form-check-label" for="selectAllCheckbox">Select All</label>
                                </div><br>
                                <div class="row">
                                    <input type="hidden" name="User_ID" class="User_ID" value="{{ $User->id }}">
                                    @foreach ($chunks as $chunk)
                                        <div class="col-md-4">
                                            @foreach ($chunk as $permission)
                                                <div class="form-check">
                                                    <input type="checkbox" name="AdminPermission[]"
                                                        class="form-check-input" value="{{ $permission->id }}"
                                                        id="permission{{ $permission->id }}"
                                                        @if (in_array($permission->id, $AdminPermission)) {{ 'checked' }} @endif />
                                                    <label class="form-check-label"
                                                        for="permission{{ $permission->id }}">{{ $permission->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                                <!--end row-->
                            </div>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <div class="hstack gap-2 justify-content-center">
                                <button type="submit" class="btn btn-block btn-primary w-100">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
    </div>
</div>

<script>
    $(".btn-click").click(function() {
        var User_ID = $(this).find('.user_id').val();
        $(".User_ID").val(User_ID);

        // Uncheck all checkboxes before AJAX
        $('input[name="AdminPermission[]"]').prop('checked', false);

        $.ajax({
            url: '{{ route('Get.Admin.Permission') }}',
            type: 'GET',
            data: {
                'User_ID': User_ID
            },
            success: function(data) {
                console.log('datasss', data);
                result = data.split(',');
                $.each(result, function(index, val) {
                    console.log('permission' + val);
                    var checkbox = $('#permission' + val);
                    if (checkbox.length > 0) {
                        checkbox.prop('checked', true);
                    } else {
                        // If val doesn't exist, uncheck the checkbox
                        checkbox.prop('checked', false);
                    }
                });
                html = "";
            },
            error: function(data) {
                console.log(data);
            }

        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllCheckbox = document.getElementById('selectAllCheckbox');
        const permissionCheckboxes = document.querySelectorAll('input[name="AdminPermission[]"]');

        // Check if all permission checkboxes are checked initially
        let allChecked = true;
        permissionCheckboxes.forEach(function(checkbox) {
            if (!checkbox.checked) {
                allChecked = false;
            }
        });
        selectAllCheckbox.checked = allChecked;

        selectAllCheckbox.addEventListener('change', function() {
            permissionCheckboxes.forEach(function(checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });

        permissionCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                // If any checkbox is unchecked, uncheck the "Select All" checkbox
                if (!checkbox.checked) {
                    selectAllCheckbox.checked = false;
                } else {
                    // Check if all permission checkboxes are checked after the change
                    let allChecked = true;
                    permissionCheckboxes.forEach(function(checkbox) {
                        if (!checkbox.checked) {
                            allChecked = false;
                        }
                    });
                    selectAllCheckbox.checked = allChecked;
                }
            });
        });
    });
</script>