<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Ticket List</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tickets</a></li>
                    <li class="breadcrumb-item active">Ticket List</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <table id="example"
                       class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
                       style="width:100%">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Subject</th>
                        <th>Assigned To</th>
                        <th>Assigned By</th>
                        <th>Status</th>
                        <th>Created By</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($Tickets as $Ticket)
                        <tr>
                            <td class="id"><a href="{{ route('Admin.Ticket.Details', ['Ticket_ID' => $Ticket->id]) }}"
                                              class="fw-medium link-primary"
                                              target="_blank">{{ $Ticket->all_listing->Ref_ID }}</a></td>

                            <td>{{ $Ticket->Order_Subject }}</td>
                            <td class="client_name">{{ $Ticket->authorized_user->Company_Name }}</td>
                            <td class="assignedto">{{ $Ticket->assigned_user->Company_Name }}</td>
                            <td class="status"><span
                                    class="badge badge-soft-secondary text-uppercase">{{ $Ticket->status }}</span></td>
                            <td class="due_date">
                                <strong>Created At: </strong>{{ $Ticket->created_at }}<br>
                                <strong>Created By: </strong>{{ $Ticket->ticket_by->Company_Name }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
    </div>
    <!--end col-->
</div>
