 <!-- jQuery -->
 <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

 <!-- Moment.js -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

 <!-- DateRangePicker -->
 <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css" />
 <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>
 
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($All_Users as $User)
                    <tr>
                        <td>{{ $User->Company_Name }}<br>
                            @if ($User->is_email_verified)
                                {{ $User->email }}<br>
                            @else
                                <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Email Not Verified!">{{ $User->email }}</span><br>
                            @endif
                            <a href="http://" target="_blank">View MC #{{ $User->Mc_Number }}</a><br>
                            <strong>{{ $User->usr_type }}</strong>
                        </td>
                        <td>
                            <strong>Address: </strong>{{ $User->Address }}<br>
                            <strong>City: </strong>{{ $User->Company_City }}<br>
                            <strong>State: </strong>{{ $User->Company_State }}<br>
                            <span
                                class="badge {{ $User->admin_suspended ? 'bg-danger' : '' }}">{{ $User->admin_suspended ? 'Suspended' : '' }}</span>
                            <span
                                class="badge {{ $User->admin_verify ?: 'bg-danger' }}">{{ $User->admin_verify ?: 'Not Verified!' }}</span>
                            <span
                                class="badge {{ $User->is_email_verified ?: 'bg-danger' }}">{{ $User->is_email_verified ?: 'Email Not Verified!' }}</span>
                        </td>
                        <td>
                            @if (!empty($User->Contact_Phone))
                                <strong>Phone: </strong>{{ $User->Contact_Phone }}<br>
                            @endif
                            @if (!empty($User->Local_Phone))
                                <strong>Local: </strong>{{ $User->Local_Phone }}<br>
                            @endif
                            @if (!empty($User->Toll_Free))
                                <strong>Toll: </strong>{{ $User->Toll_Free }}<br>
                            @endif
                            @if (!empty($User->Fax_Phone))
                                <strong>Fax: </strong>{{ $User->Fax_Phone }}<br>
                            @endif
                            @if (!empty($User->Dispatch_Phone))
                                <strong>Dispatch: </strong>{{ $User->Dispatch_Phone }}
                            @endif
                        </td>
                        <td>
                            @if (!empty($User->insurance->Agent_Name))
                                <strong>Bonding Agent: </strong>{{ $User->insurance->Agent_Name }}<br>
                            @else
                                <strong class="text-danger">Agent Name?</strong><br>
                            @endif
                            @if (!empty($User->insurance->Agent_Phone))
                                <strong>Phone: </strong>{{ $User->insurance->Agent_Phone }}<br>
                            @else
                                <strong class="text-danger">Agent Phone?</strong><br>
                            @endif
                            @if (!empty($User->insurance->Cargo_Limit))
                                <strong>Cargo Limit: </strong>{{ $User->insurance->Cargo_Limit }}<br>
                            @else
                                <strong class="text-danger">Cargo Ins Limit?</strong><br>
                            @endif
                            @if (!empty($User->insurance->Deductable))
                                <strong>Deductible: </strong>{{ $User->insurance->Deductable }}
                            @else
                                <strong class="text-danger">Cargo Deductible?</strong><br>
                            @endif
                        </td>
                        <td>
                            <strong>Created At: </strong>{{ $User->created_at }}<br>
                            <strong>Updated At: </strong>{{ $User->updated_at }}<br>

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
                                    {{-- @if (!$User->admin_verify)
                                        <li><a href="{{ route('Verify.User', ['User_ID' => $User->id]) }}"
                                                class="dropdown-item edit-item-btn"><i
                                                    class="ri-pencil-fill align-bottom me-2 text-muted"></i> Mark
                                                Verify</a>
                                        </li>
                                    @else
                                        <li><a href="{{ route('Un.Verify.User', ['User_ID' => $User->id]) }}"
                                                class="dropdown-item edit-item-btn"><i
                                                    class="ri-pencil-fill align-bottom me-2 text-muted"></i> Mark
                                                Un-Verify</a></li>
                                    @endif --}}
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
                                    <li>
                                        <button class="btn get-history" data-bs-toggle="modal" data-bs-target="#showModal">
                                            <i class="ri-mail-line align-bottom me-2 text-muted"></i> Authorization Form 
                                            <input type="hidden" class="user_email" name="user_email" value="{{ $User->email }}"></button>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3">
            {{ $All_Users->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
</div>
<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header bg-soft-info p-3">
                <h5 class="modal-title" id="exampleModalLabel">Send Authorization Form <span class="compName"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <div class="modal-body">
                <div class="message-feed media">
                    <div class="media-body">
                        <div class="card-body">

                            <div class="panel panel-primary">
                                <div class="panel-body tabs-menu-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active " id="tab4">
                                            <form method="post" action="{{ route('authorization.form.email') }}">
                                                @csrf
                                                <div class="row">
                                                    <input type="hidden" class="form-control" name="id"
                                                        id='authorization-orderId' placeholder="" readonly>
                                                    <input type="hidden" class="form-control" name="status"
                                                        id='authorization-status' placeholder="" readonly>
                                                    <input type="hidden" class="form-control" name="cname"
                                                        id='authorization-cname' placeholder="" readonly>
                                                    <input type="hidden" class="form-control" name="cphone"
                                                        id='authorization-cphone' placeholder="" readonly>
                                                    <input type="hidden" class="form-control" name="origin"
                                                        id='authorization-origin' placeholder="" readonly>
                                                    <input type="hidden" class="form-control" name="destination"
                                                        id='authorization-destination' placeholder="" readonly>
                                                    <input type="hidden" class="form-control" name="vehicle"
                                                        id='authorization-vehicle' placeholder="" readonly>
                                                    <br>
                                                    <div class="col-sm-12 col-md-12" id="msgReply">
                                                        <div class="form-group">
                                                            <label class="form-label">Enter Inv. Amount</label>
                                                            <input type="number" value="" name="invoiceAmount"
                                                                class="form-control" id="authorizationAmount"
                                                                placeholder="Enter Amount" required />
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-label">Enter Email</label>
                                                            <input type="email" value="" name="email"
                                                                class="form-control userEmail" id="authorizationEmail"
                                                                placeholder="Enter Email" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary"
                                                    id="authorizationForm">Send</button>
                                            </form>
                                        </div>
                                        <div class="tab-pane" id="tab5">
                                            <div class="chat-body-style ChatBody viewMessageCall"
                                                style="overflow:scroll; height:300px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="hstack gap-2 justify-content-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<script>

    $(document).ready(function() {
        $("#example").on("click", ".get-history", function() {
            var UserEmail = $(this).find('.user_email').val();
            console.log(UserEmail);
            $(".userEmail").val(UserEmail);
        });
    });
</script>

