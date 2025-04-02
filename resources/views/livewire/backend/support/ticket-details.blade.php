<style>
    * {
        margin: 0px;
        padding: 0px;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="card mt-n4 mx-n4 mb-n5">
            <div class="bg-soft-warning">
                <div class="card-body pb-4 mb-5">
                    <div class="row">
                        <div class="col-md">
                            <div class="row align-items-center">
                                <div class="col-md-auto">
                                    <div class="avatar-md mb-md-0 mb-4">
                                        <div class="avatar-title bg-white rounded-circle">
                                            <img src="{{ asset('frontend/img/logo/logo.png') }}" alt=""
                                                 class="avatar-sm"/>
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md">
                                    <h4 class="fw-semibold" id="ticket-title">
                                        <strong>#{{ $Ticket->all_listing->Ref_ID }}</strong>
                                        - {{ $Ticket->Order_Subject }}</h4>
                                    <div class="hstack gap-3 flex-wrap">
                                        <div class="text-muted"><i class="ri-building-line align-bottom me-1"></i><span
                                                id="ticket-client">Day Dispatch</span></div>
                                        <div class="vr"></div>
                                        <div class="text-muted">Create Date : <span class="fw-medium "
                                                                                    id="create-date">{{ $Ticket->created_at }}</span>
                                        </div>
                                        <div class="vr"></div>
                                        <div class="text-muted">Created By : <span class="fw-medium"
                                                                                   id="due-date"><strong>{{ $Ticket->ticket_by->Company_Name }}</strong></span>
                                        </div>
                                        <div class="vr"></div>
                                        <div class="badge rounded-pill bg-info fs-12"
                                             id="ticket-status">{{ $Ticket->status }}</div>
                                        <div class="badge rounded-pill bg-danger fs-12" id="ticket-priority">High</div>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div><!-- end card body -->
            </div>
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->
<div class="row">
    <div class="col-xxl-9">
        <div class="card">
            <div class="card-body p-4">
                <h6 class="text-uppercase mb-3">Ticket Dissipation</h6>
                <p class="text-muted">{{ $Ticket->Order_Desc }}</p>
                <h6 class="text-uppercase mb-3">Some Important Points Regarding Refund & 3-Way Support Tickets:</h6>
                <ul class="text-muted vstack gap-2 mb-4">
                    <li>Pick a Dashboard Type</li>
                    <li>Categorize information when needed</li>
                    <li>Provide Context</li>
                    <li>On using colors</li>
                    <li>On using the right graphs</li>
                </ul>
            </div>
            <!--end card-body-->
            <div class="card-body p-4">
                @if(count($Ticket->comments) > 0)
                    <h5 class="card-title mb-4">Comments</h5>
                    <div data-simplebar class="px-3 mx-n3">
                        @foreach($Ticket->comments as $Tick)
                            @if(!empty($Tick->user_id))
                                <div class="d-flex mb-4">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset($Tick->authorized_user->profile_photo_path) }}" alt=""
                                             class="avatar-xs rounded-circle"/>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="fs-13">{{ $Tick->authorized_user->Company_Name }} <small
                                                class="text-muted">{{ $Tick->created_at }}</small></h5>
                                        <p class="text-muted">{{ $Tick->Comments }}</p>
                                        @if(!empty(Auth::guard('Admin')->user()) && empty($Tick->Comments_Replied))
                                            <a href="javascript: void(0);" data-bs-toggle="modal"
                                               data-bs-target="#myModal"
                                               class="badge text-muted bg-light Comment-Replied"><i
                                                    class="mdi mdi-reply"></i>
                                                <input type="hidden" class="Comment_ID" value="{{ $Tick->id }}">
                                                Reply</a>
                                        @endif
                                        @if(!empty($Tick->Comments_Replied))
                                            <div class="d-flex mt-4">
                                                <div class="flex-grow-1 ms-3">
                                                    <h5 class="fs-13">Admin Posted <small
                                                            class="text-muted">{{ $Tick->updated_at }}</small>
                                                    </h5>
                                                    <p class="text-muted">{{ $Tick->Comments_Replied }}</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @if(empty($Tick->user_id))
                                <div class="d-flex mb-4">
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="fs-13">Admin Posted <small
                                                class="text-muted">{{ $Tick->created_at }}</small></h5>
                                        <p class="text-muted">{{ $Tick->Comments }}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
                <form action="{{ route('Post.Comments') }}" method="POST" class="mt-1">
                    @csrf
                    <div class="row g-3">
                        <input hidden type="text" name="ticket_id" value="{{ $Ticket->id }}">
                        <div class="col-lg-12">
                            <label for="exampleFormControlTextarea1" class="form-label">Leave a Comments</label>
                            <textarea class="form-control bg-light border-light" id="exampleFormControlTextarea1"
                                      rows="3" placeholder="Enter comments" name="Comments" required></textarea>
                        </div>
                        <div class="col-lg-12 text-end">
                            <button type="submit" class="btn btn-success">Post Comments</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end card body -->
        </div>
        <!--end card-->
    </div>
    <!--end col-->
    <div class="col-xxl-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Ticket Details</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table table-borderless align-middle mb-0">
                        <tbody>
                        <tr>
                            <td class="fw-medium">Ticket</td>
                            <td>#<span id="t-no">{{ $Ticket->all_listing->Ref_ID }}</span></td>
                        </tr>
                        <tr>
                            <td class="fw-medium">Broker</td>
                            <td id="t-client">{{ $Ticket->authorized_user->Company_Name }}</td>
                        </tr>
                        <tr>
                            <td class="fw-medium">Assigned To:</td>
                            <td>{{ $Ticket->assigned_user->Company_Name }}</td>
                        </tr>
                        <tr>
                            <td class="fw-medium">Create Date</td>
                            <td id="c-date">{{ $Ticket->created_at }}</td>
                        </tr>
                        <tr>
                            <td class="fw-medium">Due Date</td>
                            <td id="d-date">{{ $Ticket->ticket_by->Company_Name }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-danger w-100 attach-files" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">Upload Any Attachments
                </button>
            </div>
            <div class="card-body">
                @foreach($Ticket->attachments as $attachment)
                    <div class="d-flex align-items-center border border-dashed p-2 rounded">
                        <div class="flex-shrink-0 avatar-sm">
                            <div class="avatar-title bg-light rounded">
                                <i class="ri-file-zip-line fs-20 text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1"><a href="{{ asset($attachment->profile_photo_path) }}" target="_blank"
                                                class="text-body">{{ $attachment->Doc_Name }}</a></h6>
                            <small class="text-muted">{{ $attachment->created_at }}</small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--end col-->
</div>
<!--end row-->

<!-- Attachment Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Comment Replied</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Ticket.Attachment') }}" method="POST" class="mt-1"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <input hidden type="text" name="ticket_id" value="{{ $Ticket->id }}">
                        <div class="col-lg-12">
                            <label for="exampleFormControl1" class="form-label">Attachment Type</label>
                            <input type="text" class="form-control" id="exampleFormControl1"
                                   placeholder="Enter comments" name="Attachments_Type" required>
                        </div>
                        <div class="col-lg-12">
                            <label for="exampleFormControl" class="form-label">Upload Any Documents</label>
                            <input type="file" class="form-control" id="exampleFormControl"
                                   placeholder="Enter comments" name="Attachments" required>
                        </div>
                        <div class="col-lg-12 text-end">
                            <button type="submit" class="btn btn-success">Attached Documents</button>
                        </div>
                    </div>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(".Comment-Replied").click(function () {
        var getCommentID = $(this).find('.Comment_ID').val();
        $(".get_Comment_ID").val(getCommentID);
    });
</script>
