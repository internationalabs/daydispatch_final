@php
    $checkAccess = Auth::guard('Admin')->user();
    $checkAccess = App\Models\Auth\AuthorizedAdmin::with('role')
        ->where('id', $checkAccess->id)
        ->first();

    // Check if the user has a role and if the role relationship is loaded
    if ($checkAccess->role) {
        // Access the permission attribute from the role relationship
        $checkPermissions = explode(',', $checkAccess->role->permission);
    }

    $AdminPermission = explode(',', $checkAccess->permission);
@endphp
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">System Settings</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('Admin.Dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">System Settings</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="card">
    <div class="card-header border-0">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <div class="d-flex flex-wrap gap-2">
                    @if (in_array('37', $checkPermissions) || in_array('37', $AdminPermission))
                        <a class="btn btn-success add-btn btn-block btn-sm" data-bs-toggle="modal"
                            href="#AddMiscItems"><i class="ri-add-line align-bottom me-1"></i> Miscellaneous Items
                        </a>
                    @endif
                    @if (in_array('38', $checkPermissions) || in_array('38', $AdminPermission))
                        <a class="btn btn-success add-btn btn-block btn-sm" data-bs-toggle="modal"
                            href="#AddUserRoles"><i class="ri-add-line align-bottom me-1"></i> User Roles
                        </a>
                    @endif
                    @if (in_array('39', $checkPermissions) || in_array('39', $AdminPermission))
                        <a class="btn btn-success add-btn btn-block btn-sm" data-bs-toggle="modal" href="#AddNewUser"><i
                                class="ri-add-line align-bottom me-1"></i> New Admin User
                        </a>
                    @endif
                    @if (in_array('40', $checkPermissions) || in_array('40', $AdminPermission))
                        <a class="btn btn-success add-btn btn-block btn-sm" data-bs-toggle="modal"
                            href="#RolesPermissions">Manage Permissions
                        </a>
                    @endif
                    <a class="btn btn-success add-btn btn-block btn-sm" data-bs-toggle="modal"
                        href="#AdNewPermission"><i class="ri-add-line align-bottom me-1"></i> Add New Permission
                    </a>
                    @if (in_array('43', $checkPermissions) || in_array('43', $AdminPermission))
                        <a class="btn btn-success add-btn btn-block btn-sm" data-bs-toggle="modal" href="#AdNewIP"><i
                                class="ri-add-line align-bottom me-1"></i> Add New IP
                        </a>
                    @endif
                    {{-- @if (in_array('43', $checkPermissions) || in_array('43', $AdminPermission)) --}}
                    <a class="btn btn-success add-btn btn-block btn-sm" data-bs-toggle="modal" href="#AdNewWebUser"><i
                            class="ri-add-line align-bottom me-1"></i> New User
                    </a>
                    {{-- @endif --}}
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <p class="text-muted">
            You Can Add Some Records To Day Dispatch Like Some Misc Items Or User
            Roles
        </p>
        <!-- Nav tabs -->
        <ul class="nav nav-pills nav-justified mb-3" role="tablist">
            <li class="nav-item waves-effect waves-light" role="presentation">
                <a class="nav-link active" data-bs-toggle="tab" href="#pill-justified-home-1" role="tab"
                    aria-selected="true">
                    Misc. Items
                </a>
            </li>
            <li class="nav-item waves-effect waves-light" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#pill-justified-profile-1" role="tab"
                    aria-selected="false" tabindex="-1">
                    Users Roles
                </a>
            </li>
            <li class="nav-item waves-effect waves-light" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#all-permissions" role="tab" aria-selected="false"
                    tabindex="-1">
                    Permissions
                </a>
            </li>
            @if (in_array('42', $checkPermissions) || in_array('42', $AdminPermission))
                <li class="nav-item waves-effect waves-light" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#all-ips" role="tab" aria-selected="false"
                        tabindex="-1">
                        IPs
                    </a>
                </li>
            @endif
        </ul>
        <!-- Tab panes -->
        <div class="tab-content text-muted">
            <div class="tab-pane active" id="pill-justified-home-1" role="tabpanel">
                <table id="example"
                    class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
                    style="width: 100%">
                    <thead>
                        <tr>
                            <th>Miscellaneous Items</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Miscellaneous as $Misc)
                            <tr>
                                <td>{{ $Misc->Misc_Items }}</td>
                                <td class="due_date">{{ $Misc->created_at }}</td>
                                <td>
                                    <a href="{{ route('Delete.Misc.Items', ['Misc_ID' => $Misc->id]) }}"
                                        class="btn btn-danger btn-block">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="pill-justified-profile-1" role="tabpanel">
                <table id="example1"
                    class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
                    style="width: 100%">
                    <thead>
                        <tr>
                            <th>User Roles</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($User_Roles as $Role)
                            <tr>
                                <td>{{ $Role->User_Roles }}</td>
                                <td class="due_date">{{ $Role->created_at }}</td>
                                <td>
                                    <a href="{{ route('Delete.User.Role', ['Role_ID' => $Role->id]) }}"
                                        class="btn btn-danger btn-block">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="all-permissions" role="tabpanel">
                <table id="example2"
                    class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
                    style="width: 100%">
                    <thead>
                        <tr>
                            <th>Permission</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allPermission as $row)
                            <tr>
                                <td>{{ $row->name }}</td>
                                <td>
                                    @if ($row->status == 1)
                                        Active
                                    @else
                                        Not Active
                                    @endif
                                </td>
                                <td class="due_date">{{ $row->created_at }}</td>
                                <td>
                                    <a href="{{ route('Delete.Admin.Permission', $row->id) }}"
                                        onclick="return confirm('Are you sure you want to delete this item?');"
                                        class="btn btn-danger btn-block">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="all-ips" role="tabpanel">
                <table id="example4"
                    class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
                    style="width: 100%">
                    <thead>
                        <tr>
                            <th>IP Address</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ips as $row)
                            <tr>
                                <td>{{ $row->ip_address }}</td>
                                <td>
                                    @if ($row->status == 1)
                                        Active
                                    @else
                                        Not Active
                                    @endif
                                </td>
                                <td class="due_date">{{ $row->created_at }}</td>
                                <td>
                                    <a href="{{ route('Delete.Admin.Ip', $row->id) }}"
                                        onclick="return confirm('Are you sure you want to delete this item?');"
                                        class="btn btn-danger btn-block">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end card-body -->
</div>

<!--{{-- Add Miscellanous Items To DB --}}-->
<div class="modal fade" id="AddMiscItems" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form action="{{ route('Add.Misc.Items') }}" method="POST" class="tablelist-form" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div id="modal-id">
                            <label for="orderId" class="form-label">Misc Items</label>
                            <input type="text" class="form-control" placeholder="Enter Any Misc Item Name"
                                name="Misc_Items" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-success" id="add-btn">
                            Add Item
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!--{{-- Add User Roles To DB --}}-->
<div class="modal fade" id="AddUserRoles" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form action="{{ route('Add.User.Role') }}" method="POST" class="tablelist-form" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div id="modal-id">
                            <label for="orderId" class="form-label">User Role</label>
                            <input type="text" class="form-control" placeholder="Enter User Role Name"
                                name="User_Roles" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-success" id="add-btn">
                            Add User Role
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!--{{-- Add New Permission --}}-->
<div class="modal fade" id="AdNewPermission" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form action="{{ route('Add.New.Permission') }}" method="POST" class="tablelist-form"
                autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div id="modal-id">
                            <label for="orderId" class="form-label">New Permission</label>
                            <input type="text" class="form-control" placeholder="Enter User Role Name"
                                name="name" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-success" id="add-btn-ip">
                            Add User Role
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!--{{-- Add New IP --}}-->
<div class="modal fade" id="AdNewIP" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form action="{{ route('Add.Admin.Ip') }}" method="POST" class="tablelist-form" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div id="modal-id">
                            <label for="orderId" class="form-label">New IP</label>
                            <input type="text" class="form-control" placeholder="Enter User Role Name"
                                name="ip_address" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-success" id="add-btn-ip">
                            Add User Role
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!--{{-- Add New User Admin --}}-->
<div class="modal fade" id="AddNewUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <div class="card mt-4">
                <div class="card-body p-4">
                    <div class="text-center mt-2">
                        <h5 class="text-primary">Create New User Account</h5>
                        <!--<p class="text-muted">Get your free Day Dispatch account now</p>-->
                    </div>
                    <div class="p-2 mt-4">
                        <form action="{{ route('Add.New.User') }}" method="POST" class="needs-validation"
                            novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="useremail" class="form-label">Email <span
                                        class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="useremail" name="Admin_Email"
                                    maxlength="70" placeholder="Enter email address" required />
                                <div class="invalid-feedback">Please enter email</div>
                            </div>

                            <div class="mb-3">
                                <label for="username" class="form-label">Username <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="username"
                                    onkeypress="return /^[a-zA-Z\s]*$/g.test(event.key)" name="Admin_Name"
                                    maxlength="50" placeholder="Enter Full Name" required autocomplete="off" />
                                <div class="invalid-feedback">Please enter username</div>
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-label">Role <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" id="role" name="role" required>
                                    <option value="">Select Role</option>
                                    <option value="1">Admin</option>
                                    <option value="2">General Manager</option>
                                    <option value="3">Manager</option>
                                    <option value="4">Supervisor</option>
                                    <option value="5">QA</option>
                                </select>
                                <div class="invalid-feedback">Please select a role</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="password-input">Password</label>
                                <div class="position-relative auth-pass-inputgroup">
                                    <input type="password" class="form-control pe-5 password-input"
                                        name="Admin_Password" onpaste="return false" placeholder="Enter password"
                                        id="password-input" aria-describedby="passwordInput" required
                                        autocomplete="off" />
                                    <button
                                        class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                        type="button" id="password-addon">
                                        <i class="ri-eye-fill align-middle"></i>
                                    </button>
                                    <div class="invalid-feedback">Please enter password</div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <p class="mb-0 fs-12 text-muted fst-italic">
                                    By registering you agree to the Admin
                                    <a href="JavaScript:void(0);"
                                        class="text-primary text-decoration-underline fst-normal fw-medium">Terms of
                                        Use</a>
                                </p>
                            </div>

                            <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                                <h5 class="fs-13">Password must contain:</h5>
                                <p id="pass-length" class="invalid fs-12 mb-2">
                                    Minimum <b>8 characters</b>
                                </p>
                                <p id="pass-lower" class="invalid fs-12 mb-2">
                                    At <b>lowercase</b> letter (a-z)
                                </p>
                                <p id="pass-upper" class="invalid fs-12 mb-2">
                                    At least <b>uppercase</b> letter (A-Z)
                                </p>
                                <p id="pass-number" class="invalid fs-12 mb-0">
                                    A least <b>number</b> (0-9)
                                </p>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-success w-100" type="submit">
                                    Sign Up
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
</div>

<!--{{-- Add New User --}}-->
<div class="modal fade" id="AdNewWebUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <div class="card mt-4">
                <div class="card-body p-4">
                    <div class="text-center mt-2">
                        <h5 class="text-primary">Create New User Account</h5>
                        <!--<p class="text-muted">Get your free Day Dispatch account now</p>-->
                    </div>
                    <div class="p-2 mt-4">
                        <form action="{{ route('Add.New.WebUser') }}" method="POST" class="">
                            @csrf
                            <div class="row">

                                <div class="mb-3">
                                    <div class="form-group">
                                        <select id="Roles" class="form-control" name="User_Type"
                                            data-live-search="true" title="Select Role" required>
                                            @forelse($User_Roles as $role)
                                                <option value="{{ $role->User_Roles }}">{{ $role->User_Roles }}
                                                </option>
                                            @empty
                                                <option value="">Select AnyOne</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="Company_Name"
                                            maxlength="40" placeholder="Company Name" autocomplete="off"
                                            onkeypress="return /^[a-zA-Z\s]*$/g.test(event.key)" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <input type="text" id="Company_USDot" class="form-control"
                                            name="Company_USDot" maxlength="8" placeholder="USDOT Number"
                                            autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <input type="text" id="Mc_Number" class="form-control" name="Mc_Number"
                                            maxlength="8" placeholder="MC Number" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="Company_Email"
                                            maxlength="50" placeholder="Login Email" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <input id="user_password" type="password" class="form-control"
                                            name="Company_Password" placeholder="Password" onkeyup="match_password()"
                                            required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <input id="user_password2" type="password" class="form-control"
                                            name="password_confirmation" placeholder="Confirm Password"
                                            onkeyup="match_password()" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <select class="form-control" name="Company_Country" data-live-search="true"
                                            title="Select Country" required>
                                            <option value="United State America (USA)">United State America (USA)
                                            </option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Canada">Canada</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <select class="form-control" name="Company_State" data-live-search="true"
                                            title="Select State" required>
                                            <option selected="" disabled="" value="default">State</option>
                                            <option value="AL">Alabama</option>
                                            <option value="AK">Alaska</option>
                                            <option value="AZ">Arizona</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="CA">California</option>
                                            <option value="CO">Colorado</option>
                                            <option value="CT">Connecticut</option>
                                            <option value="DE">Delaware</option>
                                            <option value="FL">Florida</option>
                                            <option value="GA">Georgia</option>
                                            <option value="HI">Hawaii</option>
                                            <option value="ID">Idaho</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IN">Indiana</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="ME">Maine</option>
                                            <option value="MD">Maryland</option>
                                            <option value="MA">Massachusetts
                                            </option>
                                            <option value="MI">Michigan</option>
                                            <option value="MN">Minnesota</option>
                                            <option value="MS">Mississippi</option>
                                            <option value="MO">Missouri</option>
                                            <option value="MT">Montana</option>
                                            <option value="NE">Nebraska</option>
                                            <option value="NV">Nevada</option>
                                            <option value="NH">New Hampshire
                                            </option>
                                            <option value="NJ">New Jersey</option>
                                            <option value="NM">New Mexico</option>
                                            <option value="NY">New York</option>
                                            <option value="NC">North Carolina
                                            </option>
                                            <option value="ND">North Dakota</option>
                                            <option value="OH">Ohio</option>
                                            <option value="OK">Oklahoma</option>
                                            <option value="OR">Oregon</option>
                                            <option value="PA">Pennsylvania</option>
                                            <option value="RI">Rhode Island</option>
                                            <option value="SC">South Carolina
                                            </option>
                                            <option value="SD">South Dakota</option>
                                            <option value="TN">Tennessee</option>
                                            <option value="TX">Texas</option>
                                            <option value="UT">Utah</option>
                                            <option value="VT">Vermont</option>
                                            <option value="VA">Virginia</option>
                                            <option value="WA">Washington</option>
                                            <option value="DC">Washington DC
                                            </option>
                                            <option value="WV">West Virginia
                                            </option>
                                            <option value="WI">Wisconsin</option>
                                            <option value="WY">Wyoming</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="Company_City"
                                            maxlength="40" placeholder="City Name" autocomplete="off"
                                            onkeypress="return /^[a-zA-Z\s]*$/g.test(event.key)" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control phone-number" name="Contact_Phone"
                                            maxlength="14" placeholder="Phone Number" autocomplete="off"
                                            onkeypress="return onlyNumberKey(evnt)" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <input id="Business_Licence" type="text" class="form-control"
                                            name="Business_Licence" maxlength="8" placeholder="Business Licence"
                                            autocomplete="off">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="ref_code" maxlength="15"
                                            placeholder="Agent/Dispatcher Referral Code (Optional)"
                                            autocomplete="off">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="Company_Address"
                                            maxlength="100" placeholder="Complete Address" autocomplete="off"
                                            required>
                                    </div>
                                </div>

                                <button type="submit" class="register-btn">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
</div>

<!--{{-- Manage Roles Permissions --}}-->
<div class="modal fade" id="RolesPermissions" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills nav-justified mb-3" role="tablist">
                        <li class="nav-item waves-effect waves-light" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#AdminTab" role="tab"
                                aria-selected="true">
                                Admin
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#GMTab" role="tab"
                                aria-selected="false" tabindex="-1">
                                General Manager
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#ManagerTab" role="tab"
                                aria-selected="false" tabindex="-1">
                                Manager
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#SupervisorTab" role="tab"
                                aria-selected="false" tabindex="-1">
                                Supervisor
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#QATab" role="tab"
                                aria-selected="false" tabindex="-1">
                                QA
                            </a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <form method="POST" action="{{ route('Add.Admin.Permissions') }}" enctype="multipart/form-data"
                        class="needs-validation" novalidate>
                        @csrf
                        <!--<h5>Sidebar Access</h5><br>-->
                        @php
                            $permissions = App\Models\Settings\AdminRolePermissions::get();

                            $AdminPermission = $permissions->firstWhere('role', 'Admin');
                            $AdminPermission = $AdminPermission ? explode(',', $AdminPermission->permission) : [];

                            $GMPermission = $permissions->firstWhere('role', 'GM');
                            $GMPermission = $GMPermission ? explode(',', $GMPermission->permission) : [];

                            $ManagerPermission = $permissions->firstWhere('role', 'Manager');
                            $ManagerPermission = $ManagerPermission ? explode(',', $ManagerPermission->permission) : [];

                            $SupervisorPermission = $permissions->firstWhere('role', 'Supervisor');
                            $SupervisorPermission = $SupervisorPermission
                                ? explode(',', $SupervisorPermission->permission)
                                : [];

                            $QAPermission = $permissions->firstWhere('role', 'QA');
                            $QAPermission = $QAPermission ? explode(',', $QAPermission->permission) : [];

                            $permissions = App\Models\AdminPermissions::get();
                            $chunks = $permissions->chunk(ceil($permissions->count() / 3));
                        @endphp

                        <div class="tab-content text-muted">
                            <div class="tab-pane active" id="AdminTab" role="tabpanel">
                                <div class="row">
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
                            <div class="tab-pane" id="GMTab" role="tabpanel">
                                <div class="row">
                                    @foreach ($chunks as $chunk)
                                        <div class="col-md-4">
                                            @foreach ($chunk as $permission)
                                                <div class="form-check">
                                                    <input type="checkbox" name="GMPermission[]"
                                                        class="form-check-input" value="{{ $permission->id }}"
                                                        id="permission{{ $permission->id }}"
                                                        @if (in_array($permission->id, $GMPermission)) {{ 'checked' }} @endif />
                                                    <label class="form-check-label"
                                                        for="permission{{ $permission->id }}">{{ $permission->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                                <!--end row-->
                            </div>
                            <div class="tab-pane" id="ManagerTab" role="tabpanel">
                                <div class="row">
                                    @foreach ($chunks as $chunk)
                                        <div class="col-md-4">
                                            @foreach ($chunk as $permission)
                                                <div class="form-check">
                                                    <input type="checkbox" name="ManagerPermission[]"
                                                        class="form-check-input" value="{{ $permission->id }}"
                                                        id="permission{{ $permission->id }}"
                                                        @if (in_array($permission->id, $ManagerPermission)) {{ 'checked' }} @endif />
                                                    <label class="form-check-label"
                                                        for="permission{{ $permission->id }}">{{ $permission->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                                <!--end row-->
                            </div>
                            <div class="tab-pane" id="SupervisorTab" role="tabpanel">
                                <div class="row">
                                    @foreach ($chunks as $chunk)
                                        <div class="col-md-4">
                                            @foreach ($chunk as $permission)
                                                <div class="form-check">
                                                    <input type="checkbox" name="SupervisorPermission[]"
                                                        class="form-check-input" value="{{ $permission->id }}"
                                                        id="permission{{ $permission->id }}"
                                                        @if (in_array($permission->id, $SupervisorPermission)) {{ 'checked' }} @endif />
                                                    <label class="form-check-label"
                                                        for="permission{{ $permission->id }}">{{ $permission->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                                <!--end row-->
                            </div>
                            <div class="tab-pane" id="QATab" role="tabpanel">
                                <div class="row">
                                    @foreach ($chunks as $chunk)
                                        <div class="col-md-4">
                                            @foreach ($chunk as $permission)
                                                <div class="form-check">
                                                    <input type="checkbox" name="QAPermission[]"
                                                        class="form-check-input" value="{{ $permission->id }}"
                                                        id="permission{{ $permission->id }}"
                                                        @if (in_array($permission->id, $QAPermission)) {{ 'checked' }} @endif />
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
    $(document).ready(function() {
        // Clear input fields
        $('input[type="text"]').val("");
        $('input[type="password"]').val("");
    });
</script>
