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
        <h5 class="card-title mb-0">All Registered Users List</h5>
    </div>
    <div class="card-body">
        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
               style="width:100%">
            <thead>
            <tr>
                <th>Company Name</th>
                <th>Company Detail</th>
                <th>Contacts</th>
                <th>Cargo Detail</th>
                <th>ManagedBy</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($All_Users as $User)
                <tr>
                    <td>{{ $User->user->Company_Name }}<br>
                        @if ($User->user->is_email_verified)
                            {{ $User->user->email }}<br>
                        @else
                            <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                  title="Email Not Verified!">{{ $User->user->email }}</span><br>
                        @endif
                        <a href="http://" target="_blank">View MC #{{ $User->user->Mc_Number }}</a><br>
                        <strong>{{ $User->user->usr_type }}</strong>
                    </td>
                    <td>
                        <strong>Address: </strong>{{ $User->user->Address }}<br>
                        <strong>City: </strong>{{ $User->user->Company_City }}<br>
                        <strong>State: </strong>{{ $User->user->Company_State }}<br>
                        <span
                            class="badge {{ ($User->admin_suspended)? 'bg-danger' : '' }}">{{ ($User->user->admin_suspended)? 'Suspended' : '' }}</span>
                        <span
                            class="badge {{ ($User->admin_verify)? : 'bg-danger' }}">{{ ($User->user->admin_verify)? : 'Not Verified!' }}</span>
                        <span
                            class="badge {{ ($User->is_email_verified)? : 'bg-danger' }}">{{ ($User->user->is_email_verified)? : 'Email Not Verified!'}}</span>
                    </td>
                    <td>
                        @if (!empty($User->user->Contact_Phone))
                            <strong>Phone: </strong>{{ $User->Contact_Phone }}<br>
                        @endif
                        @if (!empty($User->user->Local_Phone))
                            <strong>Local: </strong>{{ $User->Local_Phone }}<br>
                        @endif
                        @if (!empty($User->user->Toll_Free))
                            <strong>Toll: </strong>{{ $User->Toll_Free }}<br>
                        @endif
                        @if (!empty($User->user->Fax_Phone))
                            <strong>Fax: </strong>{{ $User->Fax_Phone }}<br>
                        @endif
                        @if (!empty($User->user->Dispatch_Phone))
                            <strong>Dispatch: </strong>{{ $User->Dispatch_Phone }}
                        @endif
                    </td>
                    <td>
                        @if (!empty($User->user->insurance->Agent_Name))
                            <strong>Bonding Agent: </strong>{{ $User->user->insurance->Agent_Name }}<br>
                        @else
                            <strong class="text-danger">Agent Name?</strong><br>
                        @endif
                        @if (!empty($User->user->insurance->Agent_Phone))
                            <strong>Phone: </strong>{{ $User->user->insurance->Agent_Phone }}<br>
                        @else
                            <strong class="text-danger">Agent Phone?</strong><br>
                        @endif
                        @if (!empty($User->user->insurance->Cargo_Limit))
                            <strong>Cargo Limit: </strong>{{ $User->user->insurance->Cargo_Limit }}<br>
                        @else
                            <strong class="text-danger">Cargo Ins Limit?</strong><br>
                        @endif
                        @if (!empty($User->user->insurance->Deductable))
                            <strong>Deductible: </strong>{{ $User->user->insurance->Deductable }}
                        @else
                            <strong class="text-danger">Cargo Deductible?</strong><br>
                        @endif
                    </td>
                    <td>
                        {{ $User->dispatcher->Company_Name }}
                    </td>
                    <td>
                        <strong>Created At: </strong>{{ $User->user->created_at }}<br>
                        <strong>Updated At: </strong>{{ $User->user->updated_at }}<br>

                        <div class="dropdown d-inline-block">
                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false"> Actions
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a href="{{ route('Admin.View.Profile', ['User_ID' => $User->id, 'USR_TYPE' => 'User']) }}"
                                       class="dropdown-item"><i
                                            class="ri-eye-fill align-bottom me-2 text-muted"></i> View Profile</a>
                                </li>
                                @if (!$User->user->admin_verify)
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
                                @if ($User->user->admin_suspended)
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

