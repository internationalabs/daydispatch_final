<div class="profile-foreground position-relative mx-n4 mt-n4">
    <div class="profile-wid-bg">
        <img src="{{ asset('admin-backend/images/profile-bg.jpg') }}" alt="" class="profile-wid-img"/>
    </div>
</div>
<div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
    <div class="row g-4">
        <div class="col-auto">
            <div class="avatar-lg">
                <img
                    src="{{ $User_Info->profile_photo_path ? url($User_Info->profile_photo_path) : asset('backend/img/user1.jpg') }}"
                    alt="user-img" class="img-thumbnail rounded-circle"/>
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
                                                <td class="text-muted">{{ $User_Info->name ?  : '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="ps-0" scope="row">Mobile :</th>
                                                <td class="text-muted">{{ $User_Info->Local_Phone ?  : '' }}</td>
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
                                    <p>{{ $User_Info->Company_Desc ?  : 'N/A' }}</p>
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

                            @if(count($Completed) > 0)
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
                                                @if($User_Info->usr_type === 'Carrier')
                                                    @foreach($Completed as $List)
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
                                                                            <p class="text-muted text-truncate mb-0">
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
                                                    @foreach($Completed as $List)
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
                                                                            <p class="text-muted text-truncate mb-0">
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

                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <!--end tab-pane-->
                <div class="tab-pane fade" id="projects" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @if($User_Info->usr_type === 'Carrier')
                                    @if(count($Completed) > 0)
                                        @foreach($Completed as $List)
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
                                    @if(count($Completed) > 0)
                                        @foreach($Completed as $List)
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
                                    {{--                                    <input class="form-control d-none" type="file" id="formFile">--}}
                                    {{--                                    <label for="formFile" class="btn btn-danger"><i--}}
                                    {{--                                            class="ri-upload-2-fill me-1 align-bottom"></i> Upload--}}
                                    {{--                                        File</label>--}}
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
                                                            <h6 class="fs-14 mb-0"><a
                                                                    href="{{ asset($User_Info->certificates->Insurance_Certificate) }}"
                                                                    class="text-body">Insurance Certificates</a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ date('M d, Y', strtotime($User_Info->certificates->created_at)) }}
                                                </td>
                                                <td>
                                                    <a class="btn btn-block btn-primary w-70"
                                                       href="{{ asset($User_Info->certificates->Insurance_Certificate) }}"><i
                                                            class="ri-eye-fill me-2 align-middle"></i>View</a>
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
                                                            <h6 class="fs-14 mb-0"><a
                                                                    href="{{ asset($User_Info->certificates->W_Nine) }}"
                                                                    class="text-body">W9 Certificates</a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ date('M d, Y', strtotime($User_Info->certificates->created_at)) }}
                                                </td>
                                                <td>
                                                    <a class="btn btn-block btn-primary w-70"
                                                       href="{{ asset($User_Info->certificates->W_Nine) }}"><i
                                                            class="ri-eye-fill me-2 align-middle"></i>View</a>
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
                                                            <h6 class="fs-14 mb-0"><a
                                                                    href="{{ asset($User_Info->certificates->USDOT_Certificate) }}"
                                                                    class="text-body">US-DOT Certificates</a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ date('M d, Y', strtotime($User_Info->certificates->created_at)) }}
                                                </td>
                                                <td>
                                                    <a class="btn btn-block btn-primary w-70"
                                                       href="{{ asset($User_Info->certificates->USDOT_Certificate) }}"><i
                                                            class="ri-eye-fill me-2 align-middle"></i>View</a>
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
                                                            <h6 class="fs-14 mb-0"><a
                                                                    href="{{ asset($User_Info->certificates->Business_License) }}"
                                                                    class="text-body">Business Licence</a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ date('M d, Y', strtotime($User_Info->certificates->created_at)) }}
                                                </td>
                                                <td>
                                                    <a class="btn btn-block btn-primary w-70"
                                                       href="{{ asset($User_Info->certificates->Business_License) }}"><i
                                                            class="ri-eye-fill me-2 align-middle"></i>View</a>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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

