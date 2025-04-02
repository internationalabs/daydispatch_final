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
        <div class="d-flex align-items-center flex-wrap gap-2">
            <div class="flex-grow-1">
                <button class="btn btn-info add-btn" data-bs-toggle="modal" data-bs-target="#showModal"><i class="ri-add-fill me-1 align-bottom"></i> Add New Agent</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
               style="width:100%">
            <thead>
            <tr>
                <th>Agent Name</th>
                <th>Email Address</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Ref_Code</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($All_Users as $User)
                <tr>
                    <td>{{ $User->name }}</td>
                    <td>{{ $User->email }}</td>
                    <td>{{ $User->Phone_Number }}</td>
                    <td>{{ $User->Address }}</td>
                    <td>{{ $User->ref_code }}</td>
                    <td>
                        <strong>Created At: </strong>{{ $User->created_at }}<br>
                        <strong>Updated At: </strong>{{ $User->updated_at }}<br>

                        <div class="dropdown d-inline-block">
                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false"> Actions
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a href="{{ route('Admin.View.Profile', ['User_ID' => $User->id, 'USR_TYPE' => 'Agent']) }}"
                                       class="dropdown-item"><i
                                            class="ri-eye-fill align-bottom me-2 text-muted"></i> View Profile</a>
                                </li>
                                @if ($User->admin_verify)
                                    <li><a href="{{ route('Verify.User', ['User_ID' => $User->id]) }}"
                                           class="dropdown-item edit-item-btn"><i
                                                class="ri-pencil-fill align-bottom me-2 text-muted"></i> Mark Verify</a>
                                    </li>
                                @else
                                    <li><a href="{{ route('Un.Verify.User', ['User_ID' => $User->id]) }}"
                                           class="dropdown-item edit-item-btn"><i
                                                class="ri-pencil-fill align-bottom me-2 text-muted"></i> Mark
                                            Un-Verify</a></li>
                                @endif
                                @if ($User->admin_suspended)
                                    <li>
                                        <a href="{{ route('Un.Suspend.User', ['User_ID' => $User->id]) }}"
                                           class="dropdown-item remove-item-btn">
                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Mark
                                            Un-Suspend
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ route('Suspend.User', ['User_ID' => $User->id]) }}"
                                           class="dropdown-item remove-item-btn">
                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Mark
                                            Suspend
                                        </a>
                                    </li>
                                @endif
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
                <h5 class="modal-title" id="exampleModalLabel">Add New Agent To Database</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form action="{{ route('Auth.Reg.Agent') }}" method="POST" class="needs-validation" novalidate class="tablelist-form" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div>
                                <label for="company_name-field" class="form-label">Full Name</label>
                                <input type="text" id="company_name-field" class="form-control" placeholder="Enter User Name"
                                       onkeypress="return /^[a-zA-Z\s]*$/g.test(event.key)" name="Agent_Name" maxlength="50" required />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label for="email_id-field" class="form-label">Email Address</label>
                                <input type="email" id="email_id-field" class="form-control" name="Agent_Email" maxlength="70"
                                       placeholder="Enter Email Address" required />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label for="pass_id-field" class="form-label">Password</label>
                                <input type="password" id="pass_id-field" class="form-control" name="Agent_Password"
                                       placeholder="Enter Password" required />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label for="phone-field" class="form-label">Phone</label>
                                <input type="text" id="phone-field" class="form-control phone-number" name="Agent_Phone"
                                       placeholder="Enter Phone Number" required />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label for="username" class="form-label">Full Address <span class="text-danger">*</span></label>
                            <textarea name="Agent_Address" class="form-control" placeholder="Enter Complete Address"
                                      required></textarea>
                            <div class="invalid-feedback">
                                Please enter Address
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="add-btn">Add New Agent</button>
                        <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end add modal-->
