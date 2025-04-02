<div data-simplebar style="max-height: 300px;" class="pe-2">
    @foreach ($data as $row)
        <div class="text-reset notification-item d-block dropdown-item position-relative">
            <div class="d-flex">
                <div class="avatar-xs me-3">
                    <span class="avatar-title bg-soft-info text-info rounded-circle fs-16">
                        <i class="bx bx-badge-check"></i>
                    </span>
                </div>
                <div class="flex-1">
                    <a href="JavaScript:void(0);" class="stretched-link">
                        <h6 class="mt-0 mb-2 lh-base">{{ $row->Notification }}</h6>
                    </a>
                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                        <span><i class="mdi mdi-clock-outline"></i>{{ date("H:i:s", strtotime($row->created_at)) }}</span>
                    </p>
                </div>
            </div>
        </div>
    @endforeach

    <div class="my-3 text-center">
        <button type="button" class="btn btn-soft-success waves-effect waves-light">
            View All Notifications <i class="ri-arrow-right-line align-middle"></i>
        </button>
    </div>
</div>
