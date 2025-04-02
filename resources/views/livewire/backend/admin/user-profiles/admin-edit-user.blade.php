<!-- Include Required Prerequisites -->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

<div class="profile-foreground position-relative mx-n4 mt-n4">
    <div class="profile-wid-bg">
        <img src="{{ asset('admin-backend/images/profile-bg.jpg') }}" alt="" class="profile-wid-img" />
    </div>
</div>
@if ($usr_type === 'User')
    <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
        <div class="row g-4">
            <div class="col-auto">
                <div class="avatar-lg">
                    <img src="{{ $User_Info->profile_photo_path ? url($User_Info->profile_photo_path) : asset('backend/img/user1.jpg') }}"
                        alt="user-img" class="img-thumbnail rounded-circle" />
                </div>
            </div>
            <!--end col-->
            <div class="col">
                <div class="p-2">
                    <h3 class="text-white mb-1">{{ $User_Info->Company_Name }}</h3>
                    <p class="text-white-75">{{ $User_Info->name }} ({{ $User_Info->usr_type }})</p>
                    <div class="hstack text-white-50 gap-1">
                        <div class="me-2"><i
                                class="ri-map-pin-user-line me-1 text-white-75 fs-16 align-middle"></i>{{ $User_Info->Company_City }}
                            ,
                            {{ $User_Info->Company_State }}
                        </div>
                        <div><i class="ri-building-line me-1 text-white-75 fs-16 align-middle"></i>Day Dispatch
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
            <div class="col-12 col-lg-auto order-last order-lg-0">
                <div class="row text text-white-50 text-center">
                    <div class="col-lg-6 col-4">
                        <div class="p-2">
                            <h4 class="text-white mb-1">{{ count($User_Info->all_listing) }}</h4>
                            <p class="fs-14 mb-0">Shipments</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-4">
                        <div class="p-2">
                            <h4 class="text-white mb-1">{{ count($Completed) }}</h4>
                            <p class="fs-14 mb-0">Completed</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->

        </div>
        <!--end row-->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div>
                <div class="d-flex">
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab">
                                <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span
                                    class="d-none d-md-inline-block">Overview</span>
                            </a>
                        </li>
                        @if (Auth::guard('Admin')->check() && $User_Info->usr_type == 'Dispatcher')
                            <li class="nav-item">
                                <a class="nav-link fs-14" data-bs-toggle="tab" href="#managed-tab" role="tab">
                                    <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span
                                        class="d-none d-md-inline-block">Managed Users</span>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#projects" role="tab">
                                <i class="ri-price-tag-line d-inline-block d-md-none"></i> <span
                                    class="d-none d-md-inline-block">Orders</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#documents" role="tab">
                                <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span
                                    class="d-none d-md-inline-block">Documents</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#report" role="tab">
                                <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span
                                    class="d-none d-md-inline-block">Report</span>
                            </a>
                        </li>
                        @if (Auth::guard('Admin')->check())
                            <li class="nav-item">
                                <a data-bs-toggle="tab" href="#edit-profile" role="tab" class="btn btn-success"><i
                                        class="ri-edit-box-line align-bottom"></i> Edit Profile</a>
                            </li>
                        @endif
                        @if (Auth::guard('Admin')->check())
                            <li class="nav-item">
                                <a class="nav-link fs-14" data-bs-toggle="tab" href="#access" role="tab">
                                    <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span
                                        class="d-none d-md-inline-block">Access</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <!-- Tab panes -->
                <div class="tab-content pt-4 text-muted">
                    <div class="tab-pane active" id="overview-tab" role="tabpanel">
                        <div class="row">
                            <div class="col-xxl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Basic Information</h5>
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Full Name :</th>
                                                        <td class="text-muted">{{ $User_Info->name ?: '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Mobile :</th>
                                                        <td class="text-muted">{{ $User_Info->Local_Phone ?: '' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Number Of Login :</th>
                                                        <td class="text-muted">
                                                            {{ $User_Info->number_of_login ?: 'ONLY SINGLE SEATS' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">E-mail :</th>
                                                        <td class="text-muted">{{ $User_Info->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Location :</th>
                                                        <td class="text-muted">{{ $User_Info->Company_City }}
                                                            , {{ $User_Info->Company_State }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">USDOT Number :</th>
                                                        <td class="text-muted">{{ $User_Info->Company_USDot }}
                                                            , {{ $User_Info->Company_USDot }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">MC Number :</th>
                                                        <td class="text-muted">{{ $User_Info->Mc_Number }}
                                                            , {{ $User_Info->Mc_Number }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Joining Date</th>
                                                        <td class="text-muted">{{ $User_Info->created_at }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div>
                            <!--end col-->
                            <div class="col-xxl-9">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Description</h5>
                                        <p>{{ $User_Info->Company_Desc ?: 'N/A' }}</p>
                                        <div class="row">
                                            <div class="col-6 col-md-4">
                                                <div class="d-flex mt-4">
                                                    <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                        <div
                                                            class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                            <i class="ri-user-2-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="mb-1">Role :</p>
                                                        <h6 class="text-truncate mb-0">{{ $User_Info->usr_type }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-6 col-md-4">
                                                <div class="d-flex mt-4">
                                                    <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                        <div
                                                            class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                            <i class="ri-global-line"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="mb-1">Website :</p>
                                                        <a href="{{ url('') }}"
                                                            class="fw-semibold">www.DayDispatch.com</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </div>
                                    <!--end card-body-->
                                </div><!-- end card -->

                                @if (count($Completed) > 0)
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Recent Orders Completed</h5>
                                            <!-- Swiper -->
                                            <div class="swiper project-swiper mt-n4">
                                                <div class="d-flex justify-content-end gap-2 mb-2">
                                                    <div class="slider-button-prev">
                                                        <div class="avatar-title fs-18 rounded px-1">
                                                            <i class="ri-arrow-left-s-line"></i>
                                                        </div>
                                                    </div>
                                                    <div class="slider-button-next">
                                                        <div class="avatar-title fs-18 rounded px-1">
                                                            <i class="ri-arrow-right-s-line"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="swiper-wrapper">
                                                    @if ($User_Info->usr_type === 'Carrier')
                                                        @foreach ($Completed as $List)
                                                            <div class="swiper-slide">
                                                                <div
                                                                    class="card profile-project-card shadow-none profile-project-success mb-0">
                                                                    <div class="card-body p-4">
                                                                        <div class="d-flex">
                                                                            <div
                                                                                class="flex-grow-1 text-muted overflow-hidden">
                                                                                <h5 class="fs-14 text-truncate mb-1">
                                                                                    <a href="{{ route('Admin.View.Profile', ['User_ID' => $List->all_listing->authorized_user->id, 'USR_TYPE' => 'User']) }}"
                                                                                        class="text-dark">{{ $List->all_listing->authorized_user->Company_Name }}</a>
                                                                                </h5>
                                                                                <p
                                                                                    class="text-muted text-truncate mb-0">
                                                                                    Order ID : <span
                                                                                        class="fw-semibold text-dark">{{ $List->all_listing->Ref_ID }}</span>
                                                                                </p>
                                                                            </div>
                                                                            <div class="flex-shrink-0 ms-2">
                                                                                <div
                                                                                    class="badge badge-soft-warning fs-10">
                                                                                    Completed
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- end card body -->
                                                                </div>
                                                                <!-- end card -->
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        @foreach ($Completed as $List)
                                                            <div class="swiper-slide">
                                                                <div
                                                                    class="card profile-project-card shadow-none profile-project-success mb-0">
                                                                    <div class="card-body p-4">
                                                                        <div class="d-flex">
                                                                            <div
                                                                                class="flex-grow-1 text-muted overflow-hidden">
                                                                                <h5 class="fs-14 text-truncate mb-1">
                                                                                    <a href="{{ route('Admin.View.Profile', ['User_ID' => $List->completed_user->id, 'USR_TYPE' => 'User']) }}"
                                                                                        class="text-dark">{{ $List->completed_user->Company_Name }}</a>
                                                                                </h5>
                                                                                <p
                                                                                    class="text-muted text-truncate mb-0">
                                                                                    Order ID : <span
                                                                                        class="fw-semibold text-dark">{{ $List->all_listing->Ref_ID }}</span>
                                                                                </p>
                                                                            </div>
                                                                            <div class="flex-shrink-0 ms-2">
                                                                                <div
                                                                                    class="badge badge-soft-warning fs-10">
                                                                                    Completed
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- end card body -->
                                                                </div>
                                                                <!-- end card -->
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                    <!-- end slide item -->
                                                </div>

                                            </div>

                                        </div>
                                        <!-- end card body -->
                                    </div><!-- end card -->
                                @endif
                                @if (!$User_Info->admin_verify)
                                <a href="{{ route('Verify.User', ['User_ID' => $User_Info->id]) }}" class="btn btn-primary"><i
                                    class="ri-edit-box-line align-bottom"></i> Mark Verify</a>
                                @else
                                <a href="{{ route('Un.Verify.User', ['User_ID' => $User_Info->id]) }}" class="btn btn-success"><i
                                    class="ri-edit-box-line align-bottom"></i> Mark Un-Verify</a>
                                @endif
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end tab-pane-->
                    @if (Auth::guard('Admin')->check() && $User_Info->usr_type == 'Dispatcher')
                        <div class="tab-pane fade" id="managed-tab" role="tabpanel">
                            <div class="card">
                                <div class="card-header">
                                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0"
                                        role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link text-body active" data-bs-toggle="tab"
                                                href="#personalDetails" role="tab">
                                                <i class="fas fa-home"></i>
                                                Assign User/Company
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body p-4">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                            <form method="POST"
                                                action="{{ route('Assign.Company.Dispatcher', ['User_ID' => $User_Info->id, 'USR_TYPE' => 'User']) }}"
                                                enctype="multipart/form-data" class="needs-validation" novalidate>
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label>User Name</label>
                                                            <select class="form-control" name="assignUser" required>
                                                                <option selected value="">Select</option>
                                                                @foreach ($assignUser as $row)
                                                                    <option value="{{ $row->id }}">
                                                                        {{ $row->Company_Name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="text-end">
                                                                <button type="submit" class="btn btn-success">
                                                                    Assign Company
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->
                                            </form>
                                            <table id="example"
                                                class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
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
                                                            <td>{{ $User->user->Company_Name }}<br>
                                                                @if ($User->user->is_email_verified)
                                                                    {{ $User->user->email }}<br>
                                                                @else
                                                                    <span class="text-danger" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top"
                                                                        title="Email Not Verified!">{{ $User->user->email }}</span><br>
                                                                @endif
                                                                <a href="http://" target="_blank">View MC
                                                                    #{{ $User->user->Mc_Number }}</a><br>
                                                                <strong>{{ $User->user->usr_type }}</strong>
                                                            </td>
                                                            <td>
                                                                <strong>Address:
                                                                </strong>{{ $User->user->Address }}<br>
                                                                <strong>City:
                                                                </strong>{{ $User->user->Company_City }}<br>
                                                                <strong>State:
                                                                </strong>{{ $User->user->Company_State }}<br>
                                                                <span
                                                                    class="badge {{ $User->admin_suspended ? 'bg-danger' : '' }}">{{ $User->user->admin_suspended ? 'Suspended' : '' }}</span>
                                                                <span
                                                                    class="badge {{ $User->admin_verify ?: 'bg-danger' }}">{{ $User->user->admin_verify ?: 'Not Verified!' }}</span>
                                                                <span
                                                                    class="badge {{ $User->is_email_verified ?: 'bg-danger' }}">{{ $User->user->is_email_verified ?: 'Email Not Verified!' }}</span>
                                                            </td>
                                                            <td>
                                                                @if (!empty($User->user->Contact_Phone))
                                                                    <strong>Phone:
                                                                    </strong>{{ $User->Contact_Phone }}<br>
                                                                @endif
                                                                @if (!empty($User->user->Local_Phone))
                                                                    <strong>Local:
                                                                    </strong>{{ $User->Local_Phone }}<br>
                                                                @endif
                                                                @if (!empty($User->user->Toll_Free))
                                                                    <strong>Toll: </strong>{{ $User->Toll_Free }}<br>
                                                                @endif
                                                                @if (!empty($User->user->Fax_Phone))
                                                                    <strong>Fax: </strong>{{ $User->Fax_Phone }}<br>
                                                                @endif
                                                                @if (!empty($User->user->Dispatch_Phone))
                                                                    <strong>Dispatch:
                                                                    </strong>{{ $User->Dispatch_Phone }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if (!empty($User->user->insurance->Agent_Name))
                                                                    <strong>Bonding Agent:
                                                                    </strong>{{ $User->user->insurance->Agent_Name }}<br>
                                                                @else
                                                                    <strong class="text-danger">Agent
                                                                        Name?</strong><br>
                                                                @endif
                                                                @if (!empty($User->user->insurance->Agent_Phone))
                                                                    <strong>Phone:
                                                                    </strong>{{ $User->user->insurance->Agent_Phone }}<br>
                                                                @else
                                                                    <strong class="text-danger">Agent
                                                                        Phone?</strong><br>
                                                                @endif
                                                                @if (!empty($User->user->insurance->Cargo_Limit))
                                                                    <strong>Cargo Limit:
                                                                    </strong>{{ $User->user->insurance->Cargo_Limit }}<br>
                                                                @else
                                                                    <strong class="text-danger">Cargo Ins
                                                                        Limit?</strong><br>
                                                                @endif
                                                                @if (!empty($User->user->insurance->Deductable))
                                                                    <strong>Deductible:
                                                                    </strong>{{ $User->user->insurance->Deductable }}
                                                                @else
                                                                    <strong class="text-danger">Cargo
                                                                        Deductible?</strong><br>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <strong>Created At:
                                                                </strong>{{ $User->user->created_at }}<br>
                                                                <strong>Updated At:
                                                                </strong>{{ $User->user->updated_at }}<br>

                                                                <div class="dropdown d-inline-block">
                                                                    <button
                                                                        class="btn btn-soft-secondary btn-sm dropdown"
                                                                        type="button" data-bs-toggle="dropdown"
                                                                        aria-expanded="false"> Actions
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                                        <li>
                                                                            <a href="#"
                                                                                onclick="confirmRemoveAccess({{ $User->user->id }})"
                                                                                class="dropdown-item">
                                                                                <i
                                                                                    class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                                                Remove Access
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="{{ route('Admin.View.Profile', ['User_ID' => $User->user->id, 'USR_TYPE' => 'User']) }}"
                                                                                class="dropdown-item"><i
                                                                                    class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                                                View Profile</a>
                                                                        </li>
                                                                        @if (!$User->user->admin_verify)
                                                                            <li><a href="{{ route('Verify.User', ['User_ID' => $User->user->id]) }}"
                                                                                    class="dropdown-item edit-item-btn"><i
                                                                                        class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                                    Mark Verify</a>
                                                                            </li>
                                                                        @else
                                                                            <li><a href="{{ route('Un.Verify.User', ['User_ID' => $User->user->id]) }}"
                                                                                    class="dropdown-item edit-item-btn"><i
                                                                                        class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                                    Mark
                                                                                    Un-Verify</a></li>
                                                                        @endif
                                                                        @if ($User->user->admin_suspended)
                                                                            <li>
                                                                                <a href="{{ route('Un.Suspend.User', ['User_ID' => $User->user->id]) }}"
                                                                                    class="dropdown-item remove-item-btn">
                                                                                    <i
                                                                                        class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                                    Mark
                                                                                    Un-Suspend
                                                                                </a>
                                                                            </li>
                                                                        @else
                                                                            <li>
                                                                                <a href="{{ route('Suspend.User', ['User_ID' => $User->user->id]) }}"
                                                                                    class="dropdown-item remove-item-btn">
                                                                                    <i
                                                                                        class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                                    Mark
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
                                        <!--end tab-pane-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end tab-pane-->
                    @endif
                    <div class="tab-pane fade" id="projects" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    @if ($User_Info->usr_type === 'Carrier')
                                        @if (count($Completed) > 0)
                                            @foreach ($Completed as $List)
                                                <div class="col-xxl-3 col-sm-6">
                                                    <div
                                                        class="card profile-project-card shadow-none profile-project-warning">
                                                        <div class="card-body p-4">
                                                            <div class="d-flex">
                                                                <div class="flex-grow-1 text-muted overflow-hidden">
                                                                    <h5 class="fs-14 text-truncate"><a
                                                                            href="JavaScript:void(0);"
                                                                            class="text-dark">{{ $List->all_listing->authorized_user->Company_Name }}</a>
                                                                    </h5>
                                                                    <p class="text-muted text-truncate mb-0">Last
                                                                        Update : <span
                                                                            class="fw-semibold text-dark">{{ $List->all_listing->updated_at }}</span>
                                                                    </p>
                                                                </div>
                                                                <div class="flex-shrink-0 ms-2">
                                                                    <div class="badge badge-soft-warning fs-10">
                                                                        Completed
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="d-flex mt-2">
                                                                <div class="flex-grow-1">
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <div>
                                                                            <h5 class="fs-12 text-muted mb-0">
                                                                                Order ID
                                                                                : {{ $List->all_listing->Ref_ID }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end card body -->
                                                    </div>
                                                    <!-- end card -->
                                                </div>
                                                <!--end col-->
                                            @endforeach
                                        @endif
                                    @else
                                        @if (count($Completed) > 0)
                                            @foreach ($Completed as $List)
                                                <div class="col-xxl-3 col-sm-6">
                                                    <div
                                                        class="card profile-project-card shadow-none profile-project-warning">
                                                        <div class="card-body p-4">
                                                            <div class="d-flex">
                                                                <div class="flex-grow-1 text-muted overflow-hidden">
                                                                    <h5 class="fs-14 text-truncate"><a
                                                                            href="JavaScript:void(0);"
                                                                            class="text-dark">{{ $List->completed_user->Company_Name }}</a>
                                                                    </h5>
                                                                    <p class="text-muted text-truncate mb-0">Last
                                                                        Update : <span
                                                                            class="fw-semibold text-dark">{{ $List->all_listing->updated_at }}</span>
                                                                    </p>
                                                                </div>
                                                                <div class="flex-shrink-0 ms-2">
                                                                    <div class="badge badge-soft-warning fs-10">
                                                                        Completed
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="d-flex mt-2">
                                                                <div class="flex-grow-1">
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <div>
                                                                            <h5 class="fs-12 text-muted mb-0">
                                                                                Order ID
                                                                                : {{ $List->all_listing->Ref_ID }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end card body -->
                                                    </div>
                                                    <!-- end card -->
                                                </div>
                                                <!--end col-->
                                            @endforeach
                                        @endif
                                    @endif

                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end tab-pane-->
                    <div class="tab-pane fade" id="documents" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <h5 class="card-title flex-grow-1 mb-0">Documents</h5>
                                    <div class="flex-shrink-0">
                                        {{--                                    <input class="form-control d-none" type="file" id="formFile"> --}}
                                        {{--                                    <label for="formFile" class="btn btn-danger"><i --}}
                                        {{--                                            class="ri-upload-2-fill me-1 align-bottom"></i> Upload --}}
                                        {{--                                        File</label> --}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-borderless align-middle mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col">File Name</th>
                                                        <th scope="col">Upload Date</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm">
                                                                    <div
                                                                        class="avatar-title bg-soft-primary text-primary rounded fs-20">
                                                                        <i class="ri-file-pdf-line"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="ms-3 flex-grow-1">
                                                                    @if (!is_null($User_Info->certificates->Insurance_Certificate))
                                                                        <h6 class="fs-14 mb-0"><a
                                                                                href="{{ asset($User_Info->certificates->Insurance_Certificate) }}"
                                                                                class="text-body">Insurance
                                                                                Certificates</a>
                                                                        </h6>
                                                                    @else
                                                                        <h6 class="fs-14 mb-0"><a
                                                                                href="javascript:void(0)"
                                                                                class="text-body">Insurance
                                                                                Certificates</a>
                                                                        </h6>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{ date('M d, Y', strtotime($User_Info->certificates->created_at)) }}
                                                        </td>
                                                        <td>
                                                            @if (!is_null($User_Info->certificates->Insurance_Certificate))
                                                                <a class="btn btn-block btn-primary w-70"
                                                                    href="{{ asset($User_Info->certificates->Insurance_Certificate) }}"><i
                                                                        class="ri-eye-fill me-2 align-middle"></i>View</a>
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm">
                                                                    <div
                                                                        class="avatar-title bg-soft-primary text-primary rounded fs-20">
                                                                        <i class="ri-file-pdf-line"></i>
                                                                    </div>
                                                                </div>
                                                                @if (!is_null($User_Info->certificates->W_Nine))
                                                                    <div class="ms-3 flex-grow-1">
                                                                        <h6 class="fs-14 mb-0"><a
                                                                                href="{{ asset($User_Info->certificates->W_Nine) }}"
                                                                                class="text-body">W9 Certificates</a>
                                                                        </h6>
                                                                    </div>
                                                                @else
                                                                    <div class="ms-3 flex-grow-1">
                                                                        <h6 class="fs-14 mb-0"><a
                                                                                href="javascript:void(0)"
                                                                                class="text-body">W9 Certificates</a>
                                                                        </h6>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{ date('M d, Y', strtotime($User_Info->certificates->created_at)) }}
                                                        </td>
                                                        <td>
                                                            @if (!is_null($User_Info->certificates->W_Nine))
                                                                <a class="btn btn-block btn-primary w-70"
                                                                    href="{{ asset($User_Info->certificates->W_Nine) }}"><i
                                                                        class="ri-eye-fill me-2 align-middle"></i>View</a>
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm">
                                                                    <div
                                                                        class="avatar-title bg-soft-primary text-primary rounded fs-20">
                                                                        <i class="ri-file-pdf-line"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="ms-3 flex-grow-1">
                                                                    @if (!is_null($User_Info->certificates->USDOT_Certificate))
                                                                        <h6 class="fs-14 mb-0"><a
                                                                                href="{{ asset($User_Info->certificates->USDOT_Certificate) }}"
                                                                                class="text-body">US-DOT
                                                                                Certificates</a>
                                                                        </h6>
                                                                    @else
                                                                        <h6 class="fs-14 mb-0"><a
                                                                                href="javascript:void(0)"
                                                                                class="text-body">US-DOT
                                                                                Certificates</a>
                                                                        </h6>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{ date('M d, Y', strtotime($User_Info->certificates->created_at)) }}
                                                        </td>
                                                        <td>
                                                            @if (!is_null($User_Info->certificates->USDOT_Certificate))
                                                                <a class="btn btn-block btn-primary w-70"
                                                                    href="{{ asset($User_Info->certificates->USDOT_Certificate) }}"><i
                                                                        class="ri-eye-fill me-2 align-middle"></i>View</a>
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm">
                                                                    <div
                                                                        class="avatar-title bg-soft-primary text-primary rounded fs-20">
                                                                        <i class="ri-file-pdf-line"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="ms-3 flex-grow-1">
                                                                    @if (!is_null($User_Info->certificates->Business_License))
                                                                        <h6 class="fs-14 mb-0"><a
                                                                                href="{{ asset($User_Info->certificates->Business_License) }}"
                                                                                class="text-body">Business Licence</a>
                                                                        </h6>
                                                                    @else
                                                                        <h6 class="fs-14 mb-0"><a
                                                                                href="javascript:void(0)"
                                                                                class="text-body">Business Licence</a>
                                                                        </h6>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{ date('M d, Y', strtotime($User_Info->certificates->created_at)) }}
                                                        </td>
                                                        <td>
                                                            @if (!is_null($User_Info->certificates->Business_License))
                                                                <a class="btn btn-block btn-primary w-70"
                                                                    href="{{ asset($User_Info->certificates->Business_License) }}"><i
                                                                        class="ri-eye-fill me-2 align-middle"></i>View</a>
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    {{-- {{ dd($User_Info->certificates->Insurance_Certificate, $User_Info->certificates->W_Nine, $User_Info->certificates->USDOT_Certificate, $User_Info->certificates->Business_License) }} --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end tab-pane-->
                    <div class="tab-pane fade" id="report" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <h5 class="card-title flex-grow-1 mb-0">Reports</h5>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="container py-5 w">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Daterange</label>
                                                    <!--<input type="text" class="form-control" placeholder="Daterange" style="margin-bottom: 20px;" />-->
                                                    <div class="row">
                                                        <div class="col s4 l10">
                                                            <div class="pull-left" id="reportrange"
                                                                style="
                                                      background: #fff;
                                                      cursor: pointer;
                                                      padding: 5px 10px;
                                                      border: 1px solid #ccc;
                                                      width: 100%;
                                                    ">
                                                                <i
                                                                    class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                                                <span></span> <b class="caret"></b>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card body w-100 my-report">
                                                    <div class="row">
                                                        <input type="hidden" name="start_Date" id="start_DateVal"
                                                            value="">
                                                        <input type="hidden" name="end_Date" id="end_DateVal"
                                                            value="">
                                                        <div class="col-md-4 checkType">
                                                            <div class="card-header d-flex justify-content-center text-capitalize bg-light showQuotes bg-dark text-light"
                                                                data-value="0">
                                                                Listing
                                                                <span class="rounded badge badge-success ml-2"><span
                                                                        id="Listed">{{ $orderCount['Listed'] }}</span>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 checkType">
                                                            <div class="card-header d-flex justify-content-center text-capitalize bg-light showQuotes bg-dark text-light"
                                                                data-value="0">
                                                                Requested
                                                                <span class="rounded badge badge-success ml-2"><span
                                                                        id="Requested">{{ $orderCount['Requested'] }}</span>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 checkType">
                                                            <div class="card-header d-flex justify-content-center text-capitalize bg-light showQuotes bg-dark text-light"
                                                                data-value="0">
                                                                Waiting Approval
                                                                <span class="rounded badge badge-success ml-2"><span
                                                                        id="Waiting_Approval">{{ $orderCount['Waiting_Approval'] }}</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 checkType">
                                                            <div class="card-header d-flex justify-content-center text-capitalize bg-light showQuotes bg-dark text-light"
                                                                data-value="0">
                                                                Dispatch
                                                                <span class="rounded badge badge-success ml-2"><span
                                                                        id="Dispatch">{{ $orderCount['Dispatch'] }}</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 checkType">
                                                            <div class="card-header d-flex justify-content-center text-capitalize bg-light showQuotes bg-dark text-light"
                                                                data-value="0">
                                                                Pickup Approval
                                                                <span class="rounded badge badge-success ml-2"><span
                                                                        id="PickUp_Approval">{{ $orderCount['PickUp_Approval'] }}</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 checkType">
                                                            <div class="card-header d-flex justify-content-center text-capitalize bg-light showQuotes bg-dark text-light"
                                                                data-value="0">
                                                                Pickup
                                                                <span class="rounded badge badge-success ml-2"><span
                                                                        id="PickUp">{{ $orderCount['PickUp'] }}</span>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 checkType">
                                                            <div class="card-header d-flex justify-content-center text-capitalize bg-light showQuotes bg-dark text-light"
                                                                data-value="0">
                                                                Deliver Approval
                                                                <span class="rounded badge badge-success ml-2"><span
                                                                        id="Deliver_Approval">{{ $orderCount['Deliver_Approval'] }}</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 checkType">
                                                            <div class="card-header d-flex justify-content-center text-capitalize bg-light showQuotes bg-dark text-light"
                                                                data-value="0">
                                                                Delivered
                                                                <span class="rounded badge badge-success ml-2"><span
                                                                        id="Delivered">{{ $orderCount['Delivered'] }}</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 checkType">
                                                            <div class="card-header d-flex justify-content-center text-capitalize bg-light showQuotes bg-dark text-light"
                                                                data-value="0">
                                                                Completed
                                                                <span class="rounded badge badge-success ml-2"><span
                                                                        id="Completed">{{ $orderCount['Completed'] }}</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 checkType">
                                                            <div class="card-header d-flex justify-content-center text-capitalize bg-light showQuotes bg-dark text-light"
                                                                data-value="0">
                                                                Cancelled
                                                                <span class="rounded badge badge-success ml-2"><span
                                                                        id="Cancelled">{{ $orderCount['Cancelled'] }}</span>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 checkType">
                                                            <div class="card-header d-flex justify-content-center text-capitalize bg-light showQuotes bg-dark text-light"
                                                                data-value="0">
                                                                Archived
                                                                <span class="rounded badge badge-success ml-2"><span
                                                                        id="Archived">{{ $orderCount['Archived'] }}</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 checkType">
                                                            <div class="card-header d-flex justify-content-center text-capitalize bg-light showQuotes bg-dark text-light"
                                                                data-value="0">
                                                                My Watchlist
                                                                <span class="rounded badge badge-success ml-2"><span
                                                                        id="WatchList">{{ $orderCount['WatchList'] }}</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="getData">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end tab-pane-->
                    @if (Auth::guard('Admin')->check())
                        <div class="tab-pane fade" id="edit-profile" role="tabpanel">
                            <div class="card">
                                <div class="card-header">
                                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0"
                                        role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link text-body active" data-bs-toggle="tab"
                                                href="#personalDetails" role="tab">
                                                <i class="fas fa-home"></i>
                                                Personal Details
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-body" data-bs-toggle="tab"
                                                href="#insuranceDetails" role="tab">
                                                <i class="far fa-user"></i>
                                                Insurance Details
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-body" data-bs-toggle="tab" href="#privacy"
                                                role="tab">
                                                <i class="far fa-envelope"></i>
                                                Other Settings
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-body" data-bs-toggle="tab"
                                                href="#change_password" role="tab">
                                                <i class="far fa-envelope"></i>
                                                Change Password
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body p-4">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                            <form method="POST"
                                                action="{{ route('Edit.User.Basic.Info', ['User_ID' => $User_Info->id, 'USR_TYPE' => 'User']) }}"
                                                enctype="multipart/form-data" class="needs-validation" novalidate>
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label>User Name</label>
                                                            <input type="text" class="form-control"
                                                                name="User_Name" placeholder="Enter User Name"
                                                                value="{{ $User_Info->name ?: '' }}" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label>Email Address</label>
                                                            <input readonly type="email" class="form-control"
                                                                value="{{ $User_Info->email }}" name="User_Email"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label>Local Phone</label>
                                                            <input type="text" class="form-control phone-number"
                                                                placeholder="Local Phone Number" name="Local_Phone"
                                                                value="{{ $User_Info->Local_Phone ?: '' }}" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <!--end col-->
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label>Number Of Seats</label>
                                                            <input type="text" class="form-control number_of_login"
                                                                placeholder="Number Of Login" name="number_of_login"
                                                                value="{{ $User_Info->number_of_login ?: '' }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label>Toll Free</label>
                                                            <input type="text" class="form-control phone-number"
                                                                placeholder="Toll Free Number" name="Toll_Free"
                                                                value="{{ $User_Info->Toll_Free ?: '' }}" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label>Fax Phone</label>
                                                            <input type="text" class="form-control phone-number"
                                                                placeholder="Fax Phone Number" name="Fax_Phone"
                                                                value="{{ $User_Info->Fax_Phone ?: '' }}" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label>Dispatch Phone</label>
                                                            <input type="text" class="form-control phone-number"
                                                                placeholder="Dispatch Phone Number"
                                                                value="{{ $User_Info->Dispatch_Phone ?: '' }}"
                                                                name="Dispatch_Phone" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label>Contact Preferred Method</label>
                                                            <select class="form-control" name="Contact_Method"
                                                                required>
                                                                <option @selected(is_null($User_Info->Contact_Method)) value="">
                                                                    Select AnyOne
                                                                </option>
                                                                <option @selected($User_Info->Contact_Method === 'Any') value="Any">
                                                                    Any
                                                                </option>
                                                                <option @selected($User_Info->Contact_Method === 'Phone') value="Phone">
                                                                    Phone
                                                                </option>
                                                                <option @selected($User_Info->Contact_Method === 'Fax') value="Fax">
                                                                    Fax
                                                                </option>
                                                                <option @selected($User_Info->Contact_Method === 'Email') value="Email">
                                                                    Email
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label>Website URL</label>
                                                            <input type="url" class="form-control"
                                                                placeholder="Website Url" name="Website_URL"
                                                                value="{{ $User_Info->Website_Url ?: '' }}" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label>Time Zone</label>
                                                            <select class="form-control" name="Time_Zone" required>
                                                                <option @selected(is_null($User_Info->Time_Zone)) value="">
                                                                    Select AnyOne
                                                                </option>
                                                                <option @selected($User_Info->Time_Zone === '(OTH)') value="(OTH)">
                                                                    OTH
                                                                </option>
                                                                <option @selected($User_Info->Time_Zone === '(PST)') value="(PST)">
                                                                    Pacific
                                                                    Standard Time (PST)
                                                                </option>
                                                                <option @selected($User_Info->Time_Zone === '(MST)') value="(MST)">
                                                                    Mountain
                                                                    Standard Time
                                                                    (MST)
                                                                </option>
                                                                <option @selected($User_Info->Time_Zone === '(CST)') value="(CST)">
                                                                    Central
                                                                    Standard Time (CST)
                                                                </option>
                                                                <option @selected($User_Info->Time_Zone === '(EST)') value="(EST)">
                                                                    Eastern
                                                                    Standard Time
                                                                    (EST)
                                                                </option>
                                                                <option @selected($User_Info->Time_Zone === '(AKST)') value="(AKST)">
                                                                    Alaska
                                                                    Standard Time
                                                                    (AKST)
                                                                </option>
                                                                <option @selected($User_Info->Time_Zone === '(HAST)') value="(HAST)">
                                                                    Hawaii-Aleutian
                                                                    Standard Time (HAST)
                                                                </option>
                                                                <option @selected($User_Info->Time_Zone === '(NST)') value="(NST)">
                                                                    Newfoundland
                                                                    Standard
                                                                    Time (NST)
                                                                </option>
                                                                <option @selected($User_Info->Time_Zone === 'Other') value="Other">
                                                                    Other
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label>Hours Of Operation</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Hours Of Operation"
                                                                name="Hours_Operations"
                                                                value="{{ $User_Info->Hours_Operations ?: '' }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label>Upload/Change Profile Picture</label>
                                                            <input type="file" class="form-control"
                                                                name="Profile_Image" accept="image/*" required>
                                                            <label class="custom-file-label">Choose file</label>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="hstack gap-2 justify-content-center">
                                                            <button type="submit"
                                                                class="btn btn-block btn-primary w-100">
                                                                Updates
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->
                                            </form>
                                        </div>
                                        <!--end tab-pane-->
                                        <div class="tab-pane" id="insuranceDetails" role="tabpanel">
                                            <form method="POST"
                                                action="{{ route('Edit.User.Insurance.Info', ['User_ID' => $User_Info->id, 'USR_TYPE' => 'User']) }}"
                                                class="needs-validation" novalidate>
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label>Insurance Certificate <i
                                                                    class='fa fa-eye'></i></label>
                                                            <input type="file" class="form-control"
                                                                name="Insurance_Certificate" accept="application/pdf"
                                                                required>
                                                            <div class="invalid-feedback">
                                                                Upload insurance Certificate.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label>Expiration Date</label>
                                                            <input type="date" class="form-control"
                                                                placeholder="Expiration Date" name="Expiration_Date"
                                                                value="{{ $User_Info->insurance->Expiration_Date ?: '' }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label>Cargo Limit: *</label>
                                                            <input type="number" class="form-control"
                                                                placeholder="Cargo Limit" name="Carg_Limit"
                                                                value="{{ $User_Info->insurance->Cargo_Limit ?: '' }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label>Deductible</label>
                                                            <input type="number" class="form-control"
                                                                placeholder="Deductible" name="Deductible"
                                                                value="{{ $User_Info->insurance->Deductable ?: '' }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label>Auto Policy Number: *</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Auto Policy Number" name="Policy_Number"
                                                                value="{{ $User_Info->insurance->Auto_Policy_Number ?: '' }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label>Cargo Policy Number: *</label>
                                                            <input type="number" class="form-control"
                                                                placeholder="Cargo Policy Number" name="Cargo_Number"
                                                                value="{{ $User_Info->insurance->Cargo_Policy_Number ?: '' }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label>Agent Name</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Bonding Agent" name="Agent_Name"
                                                                value="{{ $User_Info->insurance->Agent_Name ?: '' }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label>Agent Phone</label>
                                                            <input type="text" class="form-control phone-number"
                                                                placeholder="Agent Phone" name="Agent_Phone"
                                                                value="{{ $User_Info->insurance->Agent_Phone ?: '' }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="mt-4 mb-3 border-bottom pb-2">
                                                        <h5 class="card-title">W9, US-DOT & Business License:</h5>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label>W9 Certificate <i class='fa fa-eye'></i></label>
                                                            <input type="file" class="form-control"
                                                                name="WNine_Certificate" accept="application/pdf"
                                                                required>
                                                            <div class="invalid-feedback">
                                                                Upload W9 Certificate.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label>US-DOT Certificate <i class='fa fa-eye'></i></label>
                                                            <input type="file" class="form-control"
                                                                name="USDOT_Certificate" accept="application/pdf"
                                                                required>
                                                            <div class="invalid-feedback">
                                                                Upload US-DOT Certificate.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label>Business License <i class='fa fa-eye'></i></label>
                                                            <input type="file" class="form-control"
                                                                name="Business_License" accept="application/pdf"
                                                                required>
                                                            <div class="invalid-feedback">
                                                                Upload Business License.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="text-end">
                                                            <button type="submit" class="btn btn-success">Upload
                                                                Insurance
                                                                Info
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->
                                            </form>
                                        </div>
                                        <!--end tab-pane-->
                                        <div class="tab-pane" id="privacy" role="tabpanel">
                                            <div class="mb-3">
                                                <h5 class="card-title text-decoration-underline mb-3">Application
                                                    Notifications:</h5>
                                                <ul class="list-unstyled mb-0">
                                                    <li class="d-flex mt-2">
                                                        <div class="flex-grow-1">
                                                            <label class="form-check-label fs-14"
                                                                for="desktopNotification">
                                                                Show desktop notifications
                                                            </label>
                                                            <p class="text-muted">Choose the option you want as your
                                                                default setting. Block a site: Next to "Not allowed to
                                                                send notifications," click Add.</p>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    role="switch" onchange="customSwitch()"
                                                                    id="desktopNotification"
                                                                    value="{{ $User_Info->is_custom_notify }}"
                                                                    @checked($User_Info->is_custom_notify) />
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mt-2">
                                                        <div class="flex-grow-1">
                                                            <label class="form-check-label fs-14"
                                                                for="emailNotification">
                                                                Show email notifications
                                                            </label>
                                                            <p class="text-muted"> Under Settings, choose
                                                                Notifications.
                                                                Under Select an account, choose the account to enable
                                                                notifications for. </p>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    role="switch" onchange="emailSwitch()"
                                                                    id="emailNotification"
                                                                    value="{{ $User_Info->is_email_notify }}"
                                                                    @checked($User_Info->is_email_notify) />
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div>
                                                <h5 class="card-title text-decoration-underline mb-3">Delete This
                                                    Account:</h5>
                                                <p class="text-muted">Go to the Data & Privacy section of your profile
                                                    Account. Scroll to "Your data & privacy options." Delete your
                                                    Profile Account. Follow the instructions to delete your account :
                                                </p>
                                                <div>
                                                    <input type="password" class="form-control" id="passwordInput"
                                                        placeholder="Enter your password" value="make@321654987"
                                                        style="max-width: 265px;">
                                                </div>
                                                <div class="hstack gap-2 mt-3">
                                                    <a href="javascript:void(0);" class="btn btn-soft-danger">Close &
                                                        Delete This Account</a>
                                                    <a href="javascript:void(0);" class="btn btn-light">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end tab-pane-->
                                        <div class="tab-pane" id="change_password" role="tabpanel">
                                            <div class="mb-3">
                                                <h5 class="card-title text-decoration-underline mb-3">Change Password:
                                                </h5>
                                                <form id="changeUserPasswordForm" method="POST" action="{{ route('change.user.password') }}">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ $User_Info->id }}">
                                                    <!-- New Password -->
                                                    <div class="mb-3">
                                                        <label for="newPassword" class="form-label">New Password</label>
                                                        <input type="password" class="form-control" id="newUserPassword"
                                                            name="newPassword" placeholder="Enter new password"
                                                            required>
                                                    </div>
                                                    <!-- Confirm New Password -->
                                                    <div class="mb-3">
                                                        <label for="confirmNewPassword" class="form-label">Confirm New Password</label>
                                                        <input type="password" class="form-control"
                                                            id="confirmNewUserPassword" name="confirmNewPassword"
                                                            placeholder="Re-enter new password" required>
                                                    </div>
                                                    <!-- bTN -->
                                                    <div class="mb-3">
                                                        <button type="button" class="form-control btn btn-primary" onclick="submitUserChangePassword()">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!--end tab-pane-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end tab-pane-->
                    @endif
                    @if (Auth::guard('Admin')->check())
                        <div class="tab-pane fade" id="access" role="tabpanel">
                            <div class="card">
                                <div class="card-header">
                                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0"
                                        role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link text-body active" data-bs-toggle="tab" href="#sidebar"
                                                role="tab">
                                                <i class="fas fa-home"></i>
                                                Sidebar
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-body" data-bs-toggle="tab" href="#navbar"
                                                role="tab">
                                                <i class="far fa-user"></i>
                                                Navbar
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-body" data-bs-toggle="tab" href="#other"
                                                role="tab">
                                                <i class="far fa-envelope"></i>
                                                Others
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body p-4">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="sidebar" role="tabpanel">
                                            <form method="POST"
                                                action="{{ route('Edit.User.Access', ['User_ID' => $User_Info->id, 'USR_TYPE' => 'User']) }}"
                                                enctype="multipart/form-data" class="needs-validation" novalidate>
                                                @csrf
                                                <h5>Sidebar Access</h5><br>
                                                @php
                                                    $sidebar_access = explode(',', $User_Info->sidebar_access);
                                                @endphp
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="sidebar_access[]"
                                                                @if (in_array('1', $sidebar_access)) {{ 'checked' }} @endif
                                                                class="form-check-input" value="1"
                                                                id="sidebar_access1">
                                                            <label class="form-check-label"
                                                                for="dashboard">Dashboard</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="sidebar_access[]"
                                                                @if (in_array('2', $sidebar_access)) {{ 'checked' }} @endif
                                                                class="form-check-input" value="2"
                                                                id="sidebar_access2">
                                                            <label class="form-check-label" for="dashboard">New
                                                                Listing</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="sidebar_access[]"
                                                                @if (in_array('3', $sidebar_access)) {{ 'checked' }} @endif
                                                                class="form-check-input" value="3"
                                                                id="sidebar_access3">
                                                            <label class="form-check-label" for="dashboard">Time
                                                                Quote</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="sidebar_access[]"
                                                                @if (in_array('4', $sidebar_access)) {{ 'checked' }} @endif
                                                                class="form-check-input" value="4"
                                                                id="sidebar_access4">
                                                            <label class="form-check-label" for="dashboard">Approve
                                                                Misc Pay</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="sidebar_access[]"
                                                                @if (in_array('5', $sidebar_access)) {{ 'checked' }} @endif
                                                                class="form-check-input" value="5"
                                                                id="sidebar_access5">
                                                            <label class="form-check-label"
                                                                for="dashboard">Listing</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="sidebar_access[]"
                                                                @if (in_array('6', $sidebar_access)) {{ 'checked' }} @endif
                                                                class="form-check-input" value="6"
                                                                id="sidebar_access6">
                                                            <label class="form-check-label"
                                                                for="dashboard">Requested</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="sidebar_access[]"
                                                                @if (in_array('7', $sidebar_access)) {{ 'checked' }} @endif
                                                                class="form-check-input" value="7"
                                                                id="sidebar_access7">
                                                            <label class="form-check-label" for="requested">Waiting
                                                                Approval</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="sidebar_access[]"
                                                                @if (in_array('8', $sidebar_access)) {{ 'checked' }} @endif
                                                                class="form-check-input" value="8"
                                                                id="sidebar_access8">
                                                            <label class="form-check-label"
                                                                for="requested">Dispatch</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="sidebar_access[]"
                                                                @if (in_array('9', $sidebar_access)) {{ 'checked' }} @endif
                                                                class="form-check-input" value="9"
                                                                id="sidebar_access9">
                                                            <label class="form-check-label" for="requested">Pickup
                                                                Approval</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="sidebar_access[]"
                                                                @if (in_array('10', $sidebar_access)) {{ 'checked' }} @endif
                                                                class="form-check-input" value="10"
                                                                id="sidebar_access10">
                                                            <label class="form-check-label"
                                                                for="requested">Pickup</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="sidebar_access[]"
                                                                @if (in_array('11', $sidebar_access)) {{ 'checked' }} @endif
                                                                class="form-check-input" value="11"
                                                                id="sidebar_access11">
                                                            <label class="form-check-label" for="requested">Deliver
                                                                Approval</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="sidebar_access[]"
                                                                @if (in_array('12', $sidebar_access)) {{ 'checked' }} @endif
                                                                class="form-check-input" value="12"
                                                                id="sidebar_access12">
                                                            <label class="form-check-label"
                                                                for="requested">Delivered</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="sidebar_access[]"
                                                                @if (in_array('13', $sidebar_access)) {{ 'checked' }} @endif
                                                                class="form-check-input" value="13"
                                                                id="sidebar_access13">
                                                            <label class="form-check-label"
                                                                for="pickupApproval">Completed</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="sidebar_access[]"
                                                                @if (in_array('14', $sidebar_access)) {{ 'checked' }} @endif
                                                                class="form-check-input" value="14"
                                                                id="sidebar_access14">
                                                            <label class="form-check-label"
                                                                for="pickupApproval">Cancelled</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="sidebar_access[]"
                                                                @if (in_array('15', $sidebar_access)) {{ 'checked' }} @endif
                                                                class="form-check-input" value="15"
                                                                id="sidebar_access15">
                                                            <label class="form-check-label"
                                                                for="pickupApproval">Expired</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="sidebar_access[]"
                                                                @if (in_array('16', $sidebar_access)) {{ 'checked' }} @endif
                                                                class="form-check-input" value="16"
                                                                id="sidebar_access16">
                                                            <label class="form-check-label"
                                                                for="pickupApproval">Archived</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="sidebar_access[]"
                                                                @if (in_array('17', $sidebar_access)) {{ 'checked' }} @endif
                                                                class="form-check-input" value="17"
                                                                id="sidebar_access17">
                                                            <label class="form-check-label" for="pickupApproval">My
                                                                Watchlist</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="sidebar_access[]"
                                                                @if (in_array('18', $sidebar_access)) {{ 'checked' }} @endif
                                                                class="form-check-input" value="18"
                                                                id="sidebar_access18">
                                                            <label class="form-check-label"
                                                                for="pickupApproval">Filters</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 mt-3">
                                                        <div class="hstack gap-2 justify-content-center">
                                                            <button type="submit"
                                                                class="btn btn-block btn-primary w-100">
                                                                Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end row-->
                                            </form>
                                        </div>
                                        <!--end tab-pane-->
                                        <div class="tab-pane" id="navbar" role="tabpanel">
                                        </div>
                                        <!--end tab-pane-->
                                        <div class="tab-pane" id="other" role="tabpanel">
                                            <form method="POST"
                                                action="{{ route('Edit.User.Other', ['User_ID' => $User_Info->id, 'USR_TYPE' => 'User']) }}"
                                                enctype="multipart/form-data" class="needs-validation" novalidate>
                                                @csrf
                                                <h5>Other Access</h5><br>
                                                @php
                                                    $other_access = explode(',', $User_Info->other_access);
                                                @endphp
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <h5>Listing Type</h5>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="other_access[]"
                                                                @if (in_array('1', $other_access)) {{ 'checked' }} @endif
                                                                class="form-check-input" value="1"
                                                                id="other_access1">
                                                            <label class="form-check-label"
                                                                for="other_access1">Vehicle</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="other_access[]"
                                                                @if (in_array('2', $other_access)) {{ 'checked' }} @endif
                                                                class="form-check-input" value="2"
                                                                id="other_access2">
                                                            <label class="form-check-label" for="other_access2">Heavy
                                                                Equipment</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" name="other_access[]"
                                                                @if (in_array('3', $other_access)) {{ 'checked' }} @endif
                                                                class="form-check-input" value="3"
                                                                id="other_access3">
                                                            <label class="form-check-label" for="other_access3">Dry
                                                                Van</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 mt-3">
                                                        <div class="hstack gap-2 justify-content-center">
                                                            <button type="submit"
                                                                class="btn btn-block btn-primary w-100">
                                                                Save
                                                            </button>
                                                        </div>
                                                    </div>

                                                    {{-- <div class="col-md-4">
                                                        <h5>Listing</h5>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="requested">
                                                            <label class="form-check-label"
                                                                for="requested">Requested</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="waitingApproval">
                                                            <label class="form-check-label"
                                                                for="waitingApproval">Waiting Approval</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <h5>Dispatch</h5>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="pickupApproval">
                                                            <label class="form-check-label"
                                                                for="pickupApproval">Pickup Approval</label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="pickup">
                                                            <label class="form-check-label"
                                                                for="pickup">Pickup</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <h5>Deliver Approval</h5>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="delivered">
                                                            <label class="form-check-label"
                                                                for="delivered">Delivered</label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="completed">
                                                            <label class="form-check-label"
                                                                for="completed">Completed</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <h5>Cancelled</h5>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="cancelled">
                                                            <label class="form-check-label"
                                                                for="cancelled">Cancelled</label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="expired">
                                                            <label class="form-check-label"
                                                                for="expired">Expired</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <h5>Archived</h5>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="archived">
                                                            <label class="form-check-label"
                                                                for="archived">Archived</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <h5>My Watchlist</h5>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="myWatchlist">
                                                            <label class="form-check-label" for="myWatchlist">My
                                                                Watchlist</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <h5>Filters</h5>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="filters">
                                                            <label class="form-check-label"
                                                                for="filters">Filters</label>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                    <!--end row-->
                                            </form>
                                        </div>
                                        <!--end tab-pane-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end tab-pane-->
                    @endif
                </div>
                <!--end tab-content-->
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@else
    <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
        <div class="row g-4">
            <div class="col-auto">
                <div class="avatar-lg">
                    <img src="{{ $User_Info->profile_photo_path ? url($User_Info->profile_photo_path) : asset('backend/img/user1.jpg') }}"
                        alt="user-img" class="img-thumbnail rounded-circle" />
                </div>
            </div>
            <!--end col-->
            <div class="col">
                <div class="p-2">
                    <h3 class="text-white mb-1">{{ $User_Info->name }}</h3>
                    <p class="text-white-75">(Day Dispatch Agent)</p>
                    <div class="hstack text-white-50 gap-1">
                        <div class="me-2"><i
                                class="ri-map-pin-user-line me-1 text-white-75 fs-16 align-middle"></i>{{ $User_Info->Address }}
                        </div>
                        <div><i class="ri-building-line me-1 text-white-75 fs-16 align-middle"></i>Day Dispatch
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
            <div class="col-12 col-lg-auto order-last order-lg-0">
                <div class="row text text-white-50 text-center">
                    <div class="col-lg-6 col-4">
                        <div class="p-2">
                            <h4 class="text-white mb-1">{{ $Agent_Carrier_Count }}</h4>
                            <p class="fs-14 mb-0">Carriers</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-4">
                        <div class="p-2">
                            <h4 class="text-white mb-1">{{ $Agent_Broker_Count }}</h4>
                            <p class="fs-14 mb-0">Brokers & Other</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->

        </div>
        <!--end row-->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div>
                <div class="d-flex">
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab"
                                role="tab">
                                <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span
                                    class="d-none d-md-inline-block">Overview</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#documents" role="tab">
                                <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span
                                    class="d-none d-md-inline-block">Documents</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#revenue" role="tab">
                                <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span
                                    class="d-none d-md-inline-block">Revenues</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a data-bs-toggle="tab" href="#edit-profile" role="tab"
                                class="btn btn-success"><i class="ri-edit-box-line align-bottom"></i> Edit
                                Profile</a>
                        </li>
                    </ul>
                </div>
                <!-- Tab panes -->
                <div class="tab-content pt-4 text-muted">
                    <div class="tab-pane active" id="overview-tab" role="tabpanel">
                        <div class="row">
                            <div class="col-xxl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Basic Information</h5>
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Full Name :</th>
                                                        <td class="text-muted">{{ $User_Info->name ?: '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Mobile :</th>
                                                        <td class="text-muted">{{ $User_Info->Phone_Number ?: '' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">E-mail :</th>
                                                        <td class="text-muted">{{ $User_Info->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Location :</th>
                                                        <td class="text-muted">{{ $User_Info->Address }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Joining Date</th>
                                                        <td class="text-muted">{{ $User_Info->created_at }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm flex-shrink-0">
                                                <span
                                                    class="avatar-title bg-soft-primary text-primary rounded-2 fs-2">
                                                    <i data-feather="dollar-sign" class="text-primary"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden ms-3">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-3">
                                                    Current Month Revenue</p>
                                                <div class="d-flex align-items-center mb-3">
                                                    <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                                            data-target="{{ $Agent_Revenue }}">{{ $Agent_Revenue }}</span>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-9">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Description</h5>
                                        <p>{{ $User_Info->Company_Desc ?: 'N/A' }}</p>
                                        <div class="row">
                                            <div class="col-6 col-md-4">
                                                <div class="d-flex mt-4">
                                                    <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                        <div
                                                            class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                            <i class="ri-user-2-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="mb-1">Role :</p>
                                                        <h6 class="text-truncate mb-0">Day Dispatch Agent</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-6 col-md-4">
                                                <div class="d-flex mt-4">
                                                    <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                        <div
                                                            class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                            <i class="ri-global-line"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="mb-1">Website :</p>
                                                        <a href="{{ url('') }}"
                                                            class="fw-semibold">www.DayDispatch.com</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </div>
                                    <!--end card-body-->
                                </div><!-- end card -->

                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-4">
                                            <div class="flex-grow-1">
                                                <h5 class="card-title mb-0">My Agents List</h5>
                                            </div>
                                        </div>
                                        <div class="row row-cols-xxl-5 row-cols-lg-3 row-cols-1">
                                            @forelse($Agents as $Agent)
                                                <div class="col">
                                                    <div class="card card-body">
                                                        <div class="d-flex mb-4 align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <img src="{{ $Agent->profile_photo_path ? url($Agent->profile_photo_path) : asset('backend/img/user1.jpg') }}"
                                                                    alt="" class="avatar-sm rounded-circle">
                                                            </div>
                                                            <div class="flex-grow-1 ms-2">
                                                                <h5 class="card-title mb-1">
                                                                    {{ $Agent->Company_Name }}
                                                                </h5>
                                                                <p class="text-muted mb-0">{{ $Agent->usr_type }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <h6 class="mb-1">{{ $Agent->Contact_Phone }}</h6>
                                                        <p class="card-text text-muted">{{ $Agent->Company_State }}
                                                            , {{ $Agent->Company_City }}</p>
                                                        <a href="{{ route('Admin.View.Profile', ['User_ID' => $Agent->id, 'USR_TYPE' => 'User']) }}"
                                                            class="btn btn-primary btn-sm">See Details</a>
                                                    </div>
                                                </div><!-- end col -->
                                            @empty
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end tab-pane-->
                    <div class="tab-pane fade" id="documents" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <h5 class="card-title flex-grow-1 mb-0">Documents</h5>
                                    <div class="flex-shrink-0">
                                        <input class="form-control d-none" type="file" id="formFile">
                                        <label for="formFile" class="btn btn-danger"><i
                                                class="ri-upload-2-fill me-1 align-bottom"></i> Upload
                                            File</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-borderless align-middle mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col">File Name</th>
                                                        <th scope="col">Upload Date</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    {{--                                                <tr> --}}
                                                    {{--                                                    <td> --}}
                                                    {{--                                                        <div class="d-flex align-items-center"> --}}
                                                    {{--                                                            <div class="avatar-sm"> --}}
                                                    {{--                                                                <div --}}
                                                    {{--                                                                    class="avatar-title bg-soft-primary text-primary rounded fs-20"> --}}
                                                    {{--                                                                    <i class="ri-file-pdf-line"></i> --}}
                                                    {{--                                                                </div> --}}
                                                    {{--                                                            </div> --}}
                                                    {{--                                                            <div class="ms-3 flex-grow-1"> --}}
                                                    {{--                                                                <h6 class="fs-14 mb-0"><a --}}
                                                    {{--                                                                        href="{{ asset($User_Info->certificates->Insurance_Certificate) }}" --}}
                                                    {{--                                                                        class="text-body">Insurance Certificates</a> --}}
                                                    {{--                                                                </h6> --}}
                                                    {{--                                                            </div> --}}
                                                    {{--                                                        </div> --}}
                                                    {{--                                                    </td> --}}
                                                    {{--                                                    <td> --}}
                                                    {{--                                                        {{ date('M d, Y', strtotime($User_Info->certificates->created_at)) }} --}}
                                                    {{--                                                    </td> --}}
                                                    {{--                                                    <td> --}}
                                                    {{--                                                        <a class="btn btn-block btn-primary w-70" --}}
                                                    {{--                                                           href="{{ asset($User_Info->certificates->Insurance_Certificate) }}"><i --}}
                                                    {{--                                                                class="ri-eye-fill me-2 align-middle"></i>View</a> --}}
                                                    {{--                                                    </td> --}}
                                                    {{--                                                </tr> --}}

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="revenue" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-pills nav-justified mb-3" role="tablist">
                                    <li class="nav-item waves-effect waves-light" role="presentation">
                                        <a class="nav-link active" data-bs-toggle="tab"
                                            href="#pill-justified-home-1" role="tab" aria-selected="true">
                                            Current Month Revenue
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#pill-justified-profile-1"
                                            role="tab" aria-selected="false" tabindex="-1">
                                            Overall Revenue
                                        </a>
                                    </li>
                                    {{--            <li class="nav-item waves-effect waves-light" role="presentation"> --}}
                                    {{--                <a class="nav-link" data-bs-toggle="tab" href="#pill-justified-profile-2" role="tab" --}}
                                    {{--                   aria-selected="false" tabindex="-1"> --}}
                                    {{--                    Filtered Revenue --}}
                                    {{--                </a> --}}
                                    {{--            </li> --}}
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content text-muted">
                                    <div class="tab-pane active" id="pill-justified-home-1" role="tabpanel">
                                        <table id="example"
                                            class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Revenue</th>
                                                    <th>Order Info</th>
                                                    <th>Assigned By</th>
                                                    <th>Assigned To</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($currentMonth as $Lead)
                                                    <tr>
                                                        <td>
                                                            <strong>Revenue: </strong><br> $
                                                            {{ $Lead->Agent_Reward }}<br>
                                                            <strong>Created At: </strong><br>
                                                            {{ $Lead->created_at }}<br>
                                                        </td>
                                                        <td>
                                                            <strong>Order ID:</strong>
                                                            {{ $Lead->all_listing->Ref_ID }}<br>
                                                            <strong>Status:</strong>
                                                            {{ $Lead->all_listing->Listing_Status }}<br>
                                                            <strong>Delivered At:</strong>
                                                            {{ $Lead->all_listing->deliver->created_at }}
                                                        </td>
                                                        <td>
                                                            <strong>Name:</strong>
                                                            {{ $Lead->all_listing->authorized_user->Company_Name }}<br>
                                                            <strong>Phone:</strong>
                                                            {{ $Lead->all_listing->authorized_user->Contact_Phone }}<br>
                                                            <strong>Email:</strong>
                                                            {{ $Lead->all_listing->authorized_user->email }}
                                                        </td>
                                                        <td>
                                                            <strong>Name:</strong>
                                                            {{ $Lead->all_listing->deliver->delivered_user->Company_Name }}
                                                            <br>
                                                            <strong>Phone:</strong>
                                                            {{ $Lead->all_listing->deliver->delivered_user->Contact_Phone }}
                                                            <br>
                                                            <strong>Email:</strong>
                                                            {{ $Lead->all_listing->deliver->delivered_user->email }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="pill-justified-profile-1" role="tabpanel">
                                        <table id="example1"
                                            class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Revenue</th>
                                                    <th>Order Info</th>
                                                    <th>Assigned By</th>
                                                    <th>Assigned To</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($overallRevenue as $Lead)
                                                    <tr>
                                                        <td>
                                                            <strong>Revenue: </strong><br> $
                                                            {{ $Lead->Agent_Reward }}<br>
                                                            <strong>Created At: </strong><br>
                                                            {{ $Lead->created_at }}<br>
                                                        </td>
                                                        <td>
                                                            <strong>Order ID:</strong>
                                                            {{ $Lead->all_listing->Ref_ID }}<br>
                                                            <strong>Status:</strong>
                                                            {{ $Lead->all_listing->Listing_Status }}<br>
                                                            <strong>Delivered At:</strong>
                                                            {{ $Lead->all_listing->deliver->created_at }}
                                                        </td>
                                                        <td>
                                                            <strong>Name:</strong>
                                                            {{ $Lead->all_listing->authorized_user->Company_Name }}<br>
                                                            <strong>Phone:</strong>
                                                            {{ $Lead->all_listing->authorized_user->Contact_Phone }}<br>
                                                            <strong>Email:</strong>
                                                            {{ $Lead->all_listing->authorized_user->email }}
                                                        </td>
                                                        <td>
                                                            <strong>Name:</strong>
                                                            {{ $Lead->all_listing->deliver->delivered_user->Company_Name }}
                                                            <br>
                                                            <strong>Phone:</strong>
                                                            {{ $Lead->all_listing->deliver->delivered_user->Contact_Phone }}
                                                            <br>
                                                            <strong>Email:</strong>
                                                            {{ $Lead->all_listing->deliver->delivered_user->email }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{--            <div class="tab-pane" id="pill-justified-profile-2" role="tabpanel"> --}}
                                    {{--                <table id="example1" --}}
                                    {{--                       class="table table-bordered dt-responsive nowrap table-striped align-middle text-center" --}}
                                    {{--                       style="width:100%"> --}}
                                    {{--                    <thead> --}}
                                    {{--                    <tr> --}}
                                    {{--                        <th>Order ID</th> --}}
                                    {{--                        <th>Description</th> --}}
                                    {{--                        <th>Created At</th> --}}
                                    {{--                    </tr> --}}
                                    {{--                    </thead> --}}
                                    {{--                    <tbody> --}}
                                    {{--                    </tbody> --}}
                                    {{--                </table> --}}
                                    {{--            </div> --}}
                                </div>
                            </div><!-- end card-body -->
                        </div>
                    </div>
                    <!--end tab-pane-->
                    <div class="tab-pane fade" id="edit-profile" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0"
                                    role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link text-body active" data-bs-toggle="tab"
                                            href="#personalDetails" role="tab">
                                            <i class="fas fa-home"></i>
                                            Personal Details
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-body" data-bs-toggle="tab" href="#privacy"
                                            role="tab">
                                            <i class="far fa-envelope"></i>
                                            Other Settings
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body p-4">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                        <form method="POST"
                                            action="{{ route('Edit.Agent.Basic.Info', ['User_ID' => $User_Info->id, 'USR_TYPE' => 'Agent']) }}"
                                            enctype="multipart/form-data" class="needs-validation" novalidate>
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label>User Name</label>
                                                        <input type="text" class="form-control"
                                                            name="User_Name" placeholder="Enter User Name"
                                                            value="{{ $User_Info->name ?: '' }}" required>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label>Email Address</label>
                                                        <input readonly type="email" class="form-control"
                                                            value="{{ $User_Info->email }}" name="User_Email"
                                                            required>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label>Phone Number</label>
                                                        <input type="text" class="form-control phone-number"
                                                            placeholder="Local Phone Number" name="Phone_Number"
                                                            value="{{ $User_Info->Phone_Number ?: '' }}" required>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label>Upload/Change Profile Picture</label>
                                                        <input type="file" class="form-control"
                                                            name="Profile_Image" accept="image/*" required>
                                                        <label class="custom-file-label">Choose file</label>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label>Address</label>
                                                        <textarea type="text" class="form-control" placeholder="Enter Complete Address" name="Address" required>{{ $User_Info->Address ?: '' }}</textarea>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-12">
                                                    <div class="hstack gap-2 justify-content-center">
                                                        <button type="submit"
                                                            class="btn btn-block btn-primary w-100">
                                                            Updates
                                                        </button>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </form>
                                    </div>
                                    <!--end tab-pane-->
                                    <div class="tab-pane" id="privacy" role="tabpanel">
                                        <div class="mb-3">
                                            <h5 class="card-title text-decoration-underline mb-3">Application
                                                Notifications:</h5>
                                            <ul class="list-unstyled mb-0">
                                                <li class="d-flex mt-2">
                                                    <div class="flex-grow-1">
                                                        <label class="form-check-label fs-14"
                                                            for="desktopNotification">
                                                            Show desktop notifications
                                                        </label>
                                                        <p class="text-muted">Choose the option you want as your
                                                            default setting. Block a site: Next to "Not allowed to
                                                            send notifications," click Add.</p>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox"
                                                                role="switch" onchange="customSwitch()"
                                                                id="desktopNotification"
                                                                value="{{ $User_Info->is_custom_notify }}"
                                                                @checked($User_Info->is_custom_notify) />
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="d-flex mt-2">
                                                    <div class="flex-grow-1">
                                                        <label class="form-check-label fs-14"
                                                            for="emailNotification">
                                                            Show email notifications
                                                        </label>
                                                        <p class="text-muted"> Under Settings, choose Notifications.
                                                            Under Select an account, choose the account to enable
                                                            notifications for. </p>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox"
                                                                role="switch" onchange="emailSwitch()"
                                                                id="emailNotification"
                                                                value="{{ $User_Info->is_email_notify }}"
                                                                @checked($User_Info->is_email_notify) />
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div>
                                            <h5 class="card-title text-decoration-underline mb-3">Delete This
                                                Account:</h5>
                                            <p class="text-muted">Go to the Data & Privacy section of your profile
                                                Account. Scroll to "Your data & privacy options." Delete your
                                                Profile Account. Follow the instructions to delete your account :
                                            </p>
                                            <div>
                                                <input type="password" class="form-control" id="passwordInput"
                                                    placeholder="Enter your password" value="make@321654987"
                                                    style="max-width: 265px;">
                                            </div>
                                            <div class="hstack gap-2 mt-3">
                                                <a href="javascript:void(0);" class="btn btn-soft-danger">Close &
                                                    Delete This Account</a>
                                                <a href="javascript:void(0);" class="btn btn-light">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end tab-pane-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end tab-pane-->
                </div>
                <!--end tab-content-->
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
<script>
    function cb(start, end, first) {
        $("#reportrange span").html(
            start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
        );
        let getval = moment();
        if (first != 'first') {
            if (start.format("MMMM D, YYYY") == end.format("MMMM D, YYYY")) {
                var start_Date = start.format("MMMM D, YYYY");
                var end_Date = end.add(1, "days").format("MMMM D, YYYY");
                // console.log('asdasd',start_Date ,end_Date);
            } else {
                var start_Date = start.format("MMMM D, YYYY");
                var end_Date = end.format("MMMM D, YYYY");
            }

            var UserID = '{{ $User_Info->id }}';
            $('#start_DateVal').val(start_Date);
            $('#end_DateVal').val(end_Date);
            // console.log('sets', start_Date , end_Date);
            var url = "{{ route('View.MyReports.GetCount') }}";
            console.log($('#start_DateVal').val(), 'ssssss');
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    'start_Date': start_Date,
                    'end_Date': end_Date,
                    'UserID': UserID
                },
                success: function(data) {
                    data = JSON.parse(data);

                    $('#Listed').html(data.Listed.length);
                    $('#Requested').html(data.Requested.length);
                    $('#Waiting_Approval').html(data.Waiting_Approval.length);
                    $('#Dispatch').html(data.Dispatch.length);
                    $('#PickUp_Approval').html(data.PickUp_Approval.length);
                    $('#PickUp').html(data.PickUp.length);
                    $('#Deliver_Approval').html(data.Deliver_Approval.length);
                    $('#Delivered').html(data.Delivered.length);
                    $('#Completed').html(data.Completed.length);
                    $('#Cancelled').html(data.Cancelled.length);
                    $('#Archived').html(data.Archived.length);
                    $('#WatchList').html(data.WatchList.length);

                    console.log('datasss', data);
                },
                error: function(data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                }

            });
        }



    }
    cb(moment().subtract(29, "days"), moment(), "first");

    $("#reportrange").daterangepicker({
            ranges: {
                Today: [moment(), moment()],
                Yesterday: [moment().subtract(1, "days"), moment()],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [moment().startOf("month"), moment().endOf("month")],
                "Last Month": [
                    moment().subtract(1, "month").startOf("month"),
                    moment().subtract(1, "month").endOf("month"),
                ],
            },
        },
        cb
    );

    $(document).ready(function() {
        $('.checkType').on('click', function() {
            var typeCheck = $(this).find('span[id]').attr('id');
            var start_Date = $('#start_DateVal').val();
            var end_Date = $('#end_DateVal').val();
            var UserID = '{{ $User_Info->id }}';

            $.ajax({
                url: '{{ route('get.list.data') }}',
                type: 'GET',
                data: {
                    'typeCheck': typeCheck,
                    'start_Date': start_Date,
                    'end_Date': end_Date,
                    'UserID': UserID
                },
                success: function(data) {
                    console.log('HTML content:', data);
                    $('#getData').html(data);
                },
                error: function(data) {
                    var errors = data.responseJSON;
                    console.log('errors', errors);
                }
            });
        });
    });
</script>
<script>
    function customSwitch() {
        const Switch = $('#desktopNotification').val();
        $.ajax({
            url: '{{ route('User.Custom.Notification.Switch') }}',
            type: 'GET',
            data: {
                'User_ID': '{{ $User_Info->id }}',
                'Switch': Switch
            },
            success: function(data) {
                alert(data);
            },
            error: function(data) {
                var errors = data.responseJSON;
                console.log(errors);
            }

        });
    }

    function emailSwitch() {
        const Switch = $('#emailNotification').val();
        $.ajax({
            url: '{{ route('User.Email.Notification.Switch') }}',
            type: 'GET',
            data: {
                'User_ID': '{{ $User_Info->id }}',
                'Switch': Switch
            },
            success: function(data) {
                alert(data);
            },
            error: function(data) {
                var errors = data.responseJSON;
            }

        });
    }

    function confirmRemoveAccess(userId) {
        if (confirm("Are you sure you want to remove access?")) {
            window.location.href =
                "{{ route('Admin.Remove.Access', ['User_ID' => ':userId', 'USR_TYPE' => 'User']) }}".replace(
                    ':userId', userId);
        }
    }
</script>
