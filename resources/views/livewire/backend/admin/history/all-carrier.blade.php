<style>
    .tab-pane.active {
        display: block;
    }

    .tab-pane {
        display: none;
    }

    .btn-success.active {
        display: block;
    }

    .btn-success {
        dispaly: none
    }

    .mf-content.w-100 {
        background: #8080802e;
        padding: 20px;
    }

    div#tab2 {
        overflow-y: scroll;
    }

    .modal-dialog.modal-dialog-centered {
        max-width: 50%;
    }

    .modal-backdrop.fade.show {
        width: 100%;
        height: 100%;
    }
</style>




<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">User Profiles</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('Agent.Dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">User Profiles</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">All Carriers History</h5>
    </div>
    <div class="card-body">
        <table id="" class="table table-striped align-middle text-center" style="width:100%">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Status</th>
                    <th>Comments</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Lisiting as $List)
                    <tr>
                        <td>{{ $List->user->name }}</td>
                        <td>{{ $List->connectStatus }}</td>
                        <td>{{ $List->comment }}</td>
                        <td>{{ $List->created_at }}</td>
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
                                            <input hidden type="text" class="history_id" value="{{ $List->id }}">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!--{{-- Manage Roles Permissions --}}-->
<div class="modal fade" id="RolesPermissions" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0" style="max-width: 75%">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <div class="card">
                <div class="card-header border-0">
                    <div class="text-center mt-2">
                        <h5 class="text-primary">QA Comments / History</h5>
                        <!--<p class="text-muted">Get your free Day Dispatch account now</p>-->
                    </div>
                </div>
                <div class="card-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills nav-justified mb-3" role="tablist">
                        <li class="nav-item waves-effect waves-light" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#AdminTab" role="tab"
                                aria-selected="true">
                                Add Comment
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#GMTab" role="tab" aria-selected="false"
                                tabindex="-1">
                                Comment History
                            </a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content text-muted">
                        <div class="tab-pane active" id="AdminTab" role="tabpanel">
                            <form method="POST" action="{{ route('Admin.carriers.Comment') }}" id="commentForm"
                                enctype="multipart/form-data" class="needs-validation" novalidate>
                                @csrf
                                <input hidden type="text" name="historyId" class="get_History_ID" value="">
                                <div class="row m-3">
                                    <!-- Description (Textarea) -->
                                    <div class="col-lg-12 mt-3">
                                        <label for="comment" class="form-label">Comment</label>
                                        <textarea class="form-control" id="comment" name="comment" rows="4" required></textarea>
                                        <div class="invalid-feedback">
                                            Please provide a description.
                                        </div>
                                    </div>

                                    <!-- Status (Checkbox) -->
                                    <label class="form-check-label mt-3">Status</label><br>
                                    <div class="col-lg-12 mt-3 row">
                                        <div class="form-check col">
                                            <input class="form-check-input" type="radio" name="status" id="positive"
                                                value="positive">
                                            <label class="form-check-label" for="positive">Positive</label>
                                        </div>
                                        <div class="form-check col">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="negative" value="negative">
                                            <label class="form-check-label" for="negative">Negative</label>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-lg-12 mt-3 m-auto">
                                        <div class="hstack gap-2 justify-content-center">
                                            <button type="submit" class="btn btn-block btn-primary w-100">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="tab-pane" id="GMTab" role="tabpanel">
                            <div class="row history-content p-5">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
    </div>
</div>

<script>
    $(".btn-click").click(function() {
        var HistoryID = $(this).find('.history_id').val();
        $(".get_History_ID").val(HistoryID);

        $.ajax({
                url: `{{ route('Admin.carriers.Comment.Get') }}`,
                type: 'GET',
                data: {
                    'HistoryID': HistoryID
                },
                success: function (data) {
                    console.log('datas', data);
                    html = "";
                    $.each(data, function(index, val) { 
                        // Assuming val['created_at'] is a string representation of the date
                        var createdAt = new Date(val['created_at']);
                        
                        // Format the date
                        var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                        var formattedDate = monthNames[createdAt.getMonth()] + "," +
                                            ("0" + createdAt.getDate()).slice(-2) + " " +
                                            createdAt.getFullYear() + " " +
                                            ("0" + createdAt.getHours()).slice(-2) + ":" +
                                            ("0" + createdAt.getMinutes()).slice(-2) +
                                            (createdAt.getHours() >= 12 ? " PM" : " AM");

                        // Append formatted date to HTML
                        html += "<h6>" + val['user']['name'] + "</h6>";
                        html += "<h6>" + val['status'] + "</h6>";
                        html += "<h6>" + val['comment'] + ".</h6>";
                        html += "<strong class='mf-date'><i class='fa fa-clock-o'></i>" + formattedDate + "</strong> <hr>";
                    });
                    $(".history-content").html(html);
                },
                error: function (data) {
                    console.log(data);
                }

            });
    });
</script>
