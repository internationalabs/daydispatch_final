<style>
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 25px;
        margin-left: 15px;
    }

    .card .card-body {
        background-color: transparent;
    }

    a {
        text-decoration: none !important;
    }

    @media screen and (max-width: 767px) {
        .card-body .table-responsive .table tbody tr td span {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 100px;
        }

        .card-body .table-responsive .progress-content tbody tr td span {
            text-overflow: ellipsis;
            white-space: normal;
            max-width: 50px;
        }

        .card-body .table-responsive .checkbox-td-width tbody tr td,
        .card-body .table-responsive .radio-first-col-width tbody tr td {
            min-width: 200px !important;
        }
    }

    @media screen and (max-width: 575px) {
        div.table-responsive > div.dataTables_wrapper > div.row > div[class^="col-"]:last-child {
            padding-left: 0 !important;
        }

        div.table-responsive > div.dataTables_wrapper > div.row > div[class^="col-"]:first-child {
            padding-right: 0 !important;
        }
    }
</style>

<!-- Breadcrumb Area -->
<div class="breadcrumb-area">
    <h1>{{ Auth::guard('Authorized')->user()->usr_type }} Tickets </h1>

    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>

        <li class="item">Generated Tickets</li>
    </ol>

</div>
<!-- End Breadcrumb Area -->

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="display carrier dataTable advance-6 datatable-range text-center w-100">
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
                @foreach ($Tickets as $Ticket)
                    <tr>
                        <td>
                            <a href="{{ route('Ticket.Details', ['Ticket_ID' => $Ticket->id]) }}" target="_blank">{{ $Ticket->all_listing->Ref_ID }}</a>
                        </td>
                        <td>{{ $Ticket->Order_Subject }}</td>
                        <td>{{ $Ticket->assigned_user->Company_Name }}</td>
                        <td>{{ $Ticket->authorized_user->Company_Name }}</td>
                        <td>{{ $Ticket->status }}</td>
                        <td>
                            <strong>Created At: </strong>{{ $Ticket->created_at }}<br>
                            <strong>Created By: </strong>{{ $Ticket->ticket_by->Company_Name }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // $('.advance-6').DataTable({
    //     "deferRender": true,
    // });
</script>
