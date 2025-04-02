<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Dashboard</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xl-12">
        <div class="d-flex flex-column h-100">
            <div class="row">
                <div class="col-xl-4 col-md-4">
                    <div class="card card-animate overflow-hidden">
                        <div class="position-absolute start-0" style="z-index: 0;">
                            <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
                                <style>
                                    .s0 {
                                        opacity: .05;
                                        fill: var(--vz-secondary)
                                    }
                                </style>
                                <path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z" />
                            </svg>
                        </div>
                        <div class="card-body" style="z-index:1 ;">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3"> Current Reward</p>
                                    <h4 class="fs-22 fw-bold ff-secondary mb-0"><span class="counter-value" data-target="{{ $Agent_Revenue }}">{{ $Agent_Revenue }}</span></h4>
                                </div>
                                <div class="flex-shrink-0">
                                    <div id="total_jobs" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!--end col-->
                <div class="col-xl-4 col-md-4">
                    <div class="card card-animate overflow-hidden">
                        <div class="position-absolute start-0" style="z-index: 0;">
                            <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
                                <style>
                                    .s0 {
                                        opacity: .05;
                                        fill: var(--vz-secondary)
                                    }
                                </style>
                                <path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z" />
                            </svg>
                        </div>
                        <div class="card-body" style="z-index:1 ;">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3"> Total Users</p>
                                    <h4 class="fs-22 fw-bold ff-secondary mb-0"><span class="counter-value" data-target="{{ $Agent_Count['User_Count'] }}">0</span></h4>
                                </div>
                                <div class="flex-shrink-0">
                                    <div id="total_jobs" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!--end col-->
                <div class="col-xl-4 col-md-4">
                    <!-- card -->
                    <div class="card card-animate overflow-hidden">
                        <div class="position-absolute start-0" style="z-index: 0;">
                            <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
                                <style>
                                    .s0 {
                                        opacity: .05;
                                        fill: var(--vz-secondary)
                                    }
                                </style>
                                <path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z" />
                            </svg>
                        </div>
                        <div class="card-body" style="z-index:1 ;">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3"> Listed Orders</p>
                                    <h4 class="fs-22 fw-bold ff-secondary mb-0"><span class="counter-value" data-target="{{ $Agent_Count['Listed'] }}">0</span></h4>
                                </div>
                                <div class="flex-shrink-0">
                                    <div id="apply_jobs" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-4 col-md-4">
                    <!-- card -->
                    <div class="card card-animate overflow-hidden">
                        <div class="position-absolute start-0" style="z-index: 0;">
                            <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
                                <style>
                                    .s0 {
                                        opacity: .05;
                                        fill: var(--vz-secondary)
                                    }
                                </style>
                                <path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z" />
                            </svg>
                        </div>
                        <div class="card-body" style="z-index:1 ;">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Waiting's For Approval</p>
                                    <h4 class="fs-22 fw-bold ff-secondary mb-0"><span class="counter-value" data-target="{{ $Agent_Count['Waiting_Approval'] }}">0</span></h4>
                                </div>
                                <div class="flex-shrink-0">
                                    <div id="new_jobs_chart" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-4 col-md-4">
                    <!-- card -->
                    <div class="card card-animate overflow-hidden">
                        <div class="position-absolute start-0" style="z-index: 0;">
                            <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
                                <style>
                                    .s0 {
                                        opacity: .05;
                                        fill: var(--vz-secondary)
                                    }
                                </style>
                                <path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z" />
                            </svg>
                        </div>
                        <div class="card-body" style="z-index:1 ;">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3"> Dispatch</p>
                                    <h4 class="fs-22 fw-bold ff-secondary mb-0"><span class="counter-value" data-target="{{ $Agent_Count['Dispatch'] }}">0</span></h4>
                                </div>
                                <div class="flex-shrink-0">
                                    <div id="interview_chart" data-colors='["--vz-danger"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-4 col-md-4">
                    <div class="card card-animate overflow-hidden">
                        <div class="position-absolute start-0" style="z-index: 0;">
                            <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
                                <style>
                                    .s0 {
                                        opacity: .05;
                                        fill: var(--vz-secondary)
                                    }
                                </style>
                                <path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z" />
                            </svg>
                        </div>
                        <div class="card-body" style="z-index:1 ;">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3"> PickUp Approval</p>
                                    <h4 class="fs-22 fw-bold ff-secondary mb-0"><span class="counter-value" data-target="{{ $Agent_Count['PickUp_Approval'] }}">0</span></h4>
                                </div>
                                <div class="flex-shrink-0">
                                    <div id="hired_chart" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!--end col-->
                <div class="col-xl-4 col-md-4">
                    <!-- card -->
                    <div class="card card-animate overflow-hidden">
                        <div class="position-absolute start-0" style="z-index: 0;">
                            <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
                                <style>
                                    .s0 {
                                        opacity: .05;
                                        fill: var(--vz-secondary)
                                    }
                                </style>
                                <path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z" />
                            </svg>
                        </div>
                        <div class="card-body" style="z-index:1 ;">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">PickUp</p>
                                    <h4 class="fs-22 fw-bold ff-secondary mb-0"><span class="counter-value" data-target="{{ $Agent_Count['PickUp'] }}">0</span></h4>
                                </div>
                                <div class="flex-shrink-0">
                                    <div id="rejected_chart" data-colors='["--vz-danger"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-4 col-md-4">
                    <!-- card -->
                    <div class="card card-animate overflow-hidden">
                        <div class="position-absolute start-0" style="z-index: 0;">
                            <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
                                <style>
                                    .s0 {
                                        opacity: .05;
                                        fill: var(--vz-secondary)
                                    }
                                </style>
                                <path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z" />
                            </svg>
                        </div>
                        <div class="card-body" style="z-index:1 ;">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Deliver Approval</p>
                                    <h4 class="fs-22 fw-bold ff-secondary mb-0"><span class="counter-value" data-target="{{ $Agent_Count['Deliver_Approval'] }}">0</span></h4>
                                </div>
                                <div class="flex-shrink-0">
                                    <div id="rejected_chart" data-colors='["--vz-danger"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-4 col-md-4">
                    <!-- card -->
                    <div class="card card-animate overflow-hidden">
                        <div class="position-absolute start-0" style="z-index: 0;">
                            <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
                                <style>
                                    .s0 {
                                        opacity: .05;
                                        fill: var(--vz-secondary)
                                    }
                                </style>
                                <path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z" />
                            </svg>
                        </div>
                        <div class="card-body" style="z-index:1 ;">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Delivered</p>
                                    <h4 class="fs-22 fw-bold ff-secondary mb-0"><span class="counter-value" data-target="{{ $Agent_Count['Delivered'] }}">0</span></h4>
                                </div>
                                <div class="flex-shrink-0">
                                    <div id="rejected_chart" data-colors='["--vz-danger"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-4 col-md-4">
                    <!-- card -->
                    <div class="card card-animate overflow-hidden">
                        <div class="position-absolute start-0" style="z-index: 0;">
                            <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
                                <style>
                                    .s0 {
                                        opacity: .05;
                                        fill: var(--vz-secondary)
                                    }
                                </style>
                                <path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z" />
                            </svg>
                        </div>
                        <div class="card-body" style="z-index:1 ;">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Completed</p>
                                    <h4 class="fs-22 fw-bold ff-secondary mb-0"><span class="counter-value" data-target="{{ $Agent_Count['Completed'] }}">0</span></h4>
                                </div>
                                <div class="flex-shrink-0">
                                    <div id="rejected_chart" data-colors='["--vz-danger"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!--end row-->
        </div>
    </div><!--end col-->
</div><!--end row-->
