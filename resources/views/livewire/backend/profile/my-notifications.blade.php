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
<div class="breadcrumb-area mb-0">
    <h1>Notifications</h1>

    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>

        <li class="item">My Notifications</li>
    </ol>
</div>
<div class="card">
    <div class="card-header">
        <h3>Notification Settings</h3>
    </div>
    <div class="card-body">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
            <label class="custom-control-label" for="customSwitch1">Enable Email Notification</label>
        </div>
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="customSwitch2" checked>
            <label class="custom-control-label" for="customSwitch2">Enable Custom Notification</label>
        </div>
    </div>
</div>
<!-- End Breadcrumb Area -->
<div class="card">
    <div class="card-header">
        <h3>Notification List</h3>
        <p>All The Notification Show For 20 Days, After 20 The Notifications Will Be Automatically Removed.</p>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="display dataTable advance-6 text-center w-100">
                <thead>
                <tr>
                    <th>Sr.#</th>
                    <th>Date</th>
                    <th>Notification</th>
                    <th>ACTIONS</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($msg as $Notify)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ date('M d, Y H:i:s', strtotime($Notify->created_at)) }}
                        </td>
                        <td>{{ $Notify->notification }}</td>
                        <td class="action-column">
                            <a href="{{ route('chat.read', $Notify->chat_id) }}"
                               class="btn btn-sm btn-success">Mark Read</a>
                            {{-- @if(!empty($Notify->order_id))
                                <a href="{{ route('View.Agreement', ['List_ID' => $Notify->order_id]) }}"
                                   class="btn btn-sm btn-warning" target="_blank">View</a>
                            @endif --}}
                            <a href="{{ route('Delete.Notification', ['notify_id' => $Notify->id]) }}"
                                    class="btn btn-sm btn-danger"><i class="bx bx-trash-alt"></i> Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
                @foreach ($Notifications as $Notify)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ date('M d, Y H:i:s', strtotime($Notify->created_at)) }}
                        </td>
                        <td>{{ $Notify->Notification }}</td>
                        <td class="action-column">
                            <a href="{{ route('Mark.Notification', ['notify_id' => $Notify->id]) }}"
                               class="btn btn-sm btn-success">Mark Read</a>
                            {{-- @if(!empty($Notify->order_id))
                                <a href="{{ route('View.Agreement', ['List_ID' => $Notify->order_id]) }}"
                                   class="btn btn-sm btn-warning" target="_blank">View</a>
                            @endif --}}
                            <a href="{{ route('Delete.Notification', ['notify_id' => $Notify->id]) }}"
                                    class="btn btn-sm btn-danger"><i class="bx bx-trash-alt"></i> Delete
                            </a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
