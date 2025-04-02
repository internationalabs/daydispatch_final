<style>
    .custom {
        padding: 15px;
    }

    .btn.container.custom .btn-toggle {
        padding: 10px;
        border: none;
        filter: drop-shadow(0px 0px 2px grey);
        background: #ffffff;
        color: #1e2d62;
        border-radius: 5px;
        font-weight: 700;
    }

    .btn.container.custom .btn-toggle.active {
        background: #1e2d62;
        color: white;
    }
</style>

<div class="profile-header">
    <div class="user-profile-nav ps-2">
        <ul class="nav nav-tabs justify-content-center" role="tablist">
            <li class="nav-item fs-3">
                <a class="nav-link active" id="requested-tab" data-bs-toggle="tab" href="#requestedTable" role="tab"
                    aria-controls="requestedTable" aria-selected="true" onclick="toggleTable('requestedTable')">Show
                    Requested</a>
            </li>
            <li class="nav-item fs-3">
                <a class="nav-link" id="bid-tab" data-bs-toggle="tab" href="#bidTable" role="tab"
                    aria-controls="bidTable" aria-selected="false" onclick="toggleTable('bidTable')">Show Bid</a>
            </li>
        </ul>
    </div>
</div>
<table id="requestedTable" role="tabpanel"
    class="table-hover table-sm display carrier-all-request dataTable advance-6 text-center table-1 table-bordered table-cards">
    <thead class="table-header">
        <tr>
            <th>Assign</th>
            <th>Company Name</th>
            <th>Company Details</th>
            <th>Contact Info</th>
            <th>Cargo</th>
            <th>Ask / Price</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data->request_broker_all as $row)
            @if ($row->type == 'request')
                <tr class="card-row" data-status="active">
                    <td class="view-action-column">
                        <form action="{{ route('User.Dispatch.Listing', ['List_ID' => $row->order_id]) }}"
                            class="mb-3">
                            <input type="hidden" name="req_user" value="{{ $row->requested_user->id }}">
                            <button type="submit" class="btn btn-success btn-block">Assign</button>
                        </form>
                        <button class="btn btn-danger btn-block mb-2" data-bs-toggle="collapse"
                            data-bs-target="#visible-form{{ $row->id }}" aria-expanded="false"
                            aria-controls="visible-form{{ $row->id }}">
                            Decline
                        </button>
                        <div class="collapse" id="visible-form{{ $row->id }}">
                            <div class="card card-body">
                                <form action="{{ route('User.Request.Listing.Delete') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="req_id" value="{{ $row->id }}">
                                    <div class="mb-3">
                                        <label for="reason{{ $row->id }}" class="form-label">Reason for
                                            Decline</label>
                                        <input type="text" id="reason{{ $row->id }}" placeholder="Enter reason"
                                            name="reason" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-danger btn-block">Submit Decline</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td>
                        <strong>Type: </strong>{{ $row->requested_user->usr_type }}<br>
                        <a target="_blank" href="{{ route('View.Profile', $row->requested_user->id) }}">
                            {{ $row->requested_user->Company_Name }}
                        </a><br>
                        {{ $row->requested_user->email }}
                    </td>
                    <td>
                        <strong>Address: </strong>{{ $row->requested_user->Address }}<br>
                        <strong>City, State: </strong>{{ $row->requested_user->Company_City }},
                        {{ $row->requested_user->Company_State }}<br>
                        <a href="#" class="text-danger mb-2">View MC
                            #{{ $row->requested_user->Mc_Number }}</a><br>
                        <a href="#" class="text-danger mb-2">View DOT
                            #{{ $row->requested_user->Company_USDot }}</a><br>
                    </td>
                    <td>
                        {{ $row->requested_user->Contact_Phone }}<br>
                        {{ $row->requested_user->Local_Phone }}<br>
                        {{ $row->requested_user->Toll_Free }}<br>
                        {{ $row->requested_user->Fax_Phone }}
                    </td>
                    <td>
                        <strong>Name: </strong>{{ $row->requested_user->insurance->Agent_Name }}<br>
                        <strong>Phone: </strong>{{ $row->requested_user->insurance->Agent_Phone }}<br>
                        <strong>Limit: </strong>{{ $row->requested_user->insurance->Cargo_Limit }}<br>
                        <strong>Deductible: </strong>{{ $row->requested_user->insurance->Deductable }}
                    </td>
                    <td>
                        <strong>Bid Price: </strong>$ {{ $row->Offer_Price }}<br>
                        <strong>Pick Date: </strong>{{ $row->Pickup_Date }}
                        ({{ $row->Date_Pickup_Mode }})
                        <br>
                        <strong>Deliver Date: </strong>{{ $row->Delivery_Date }}
                        ({{ $row->Date_Delivery_Mode }})
                    </td>
                </tr>
            @endif
        @empty
            <tr class="card-row" data-status="active">
                <td colspan="7">No Data Found</td>
            </tr>
        @endforelse
    </tbody>
</table>
<table id="bidTable" role="tabpanel"
    class="table-hover table-sm carrier-all-request display dataTable advance-6 text-center table-1 table-bordered table-cards"
    style="display:none;">
    <thead class="table-header">
        <tr>
            <th>Assign</th>
            <th>Company Name</th>
            <th>Company Details</th>
            <th class="text-nowrap">Contact Info</th>
            <th>Cargo</th>
            <th>Ask/Price</th>
        </tr>
    </thead>
   
    <tbody>
        @forelse ($data->request_broker_all as $row)
            @if ($row->type == 'bid')
                <tr class="card-row" data-status="active">
                    <td class="view-action-column">
                        <form action="{{ route('User.Dispatch.Listing', ['List_ID' => $row->order_id]) }}"
                            class="mb-3">
                            <input type="hidden" name="req_user" value="{{ $row->requested_user->id }}">
                            <button type="submit" class="btn btn-success btn-block">Assign</button>
                        </form>
                        <button class="btn btn-danger btn-block mb-2" data-bs-toggle="collapse"
                            data-bs-target="#visible-form{{ $row->id }}" aria-expanded="false"
                            aria-controls="visible-form{{ $row->id }}">
                            Decline
                        </button>
                        <div class="collapse" id="visible-form{{ $row->id }}">
                            <div class="card card-body">
                                <form action="{{ route('User.Request.Listing.Delete') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="req_id" value="{{ $row->id }}">
                                    <div class="mb-3">
                                        <label for="reason{{ $row->id }}" class="form-label">Reason for
                                            Decline</label>
                                        <input type="text" id="reason{{ $row->id }}" placeholder="Enter reason"
                                            name="reason" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-danger btn-block">Submit Decline</button>
                                </form>
                            </div>
                        </div>
                    </td>

                    <td>
                        <strong>Type:</strong> {{ $row->requested_user->usr_type }}<br>
                        <a target="_blank" href="{{ route('View.Profile', $row->requested_user->id) }}">
                            {{ $row->requested_user->Company_Name }}
                        </a><br>
                        <span>Email:</span> {{ $row->requested_user->email }}
                    </td>
                    <td>
                        <strong>Address:</strong> {{ $row->requested_user->Address }}<br>
                        <strong>City, State:</strong> {{ $row->requested_user->Company_City }},
                        {{ $row->requested_user->Company_State }}<br>
                        <a href="#" class="text-danger">View MC #{{ $row->requested_user->Mc_Number }}</a><br>
                        <a href="#" class="text-danger">View DOT #{{ $row->requested_user->Company_USDot }}</a>
                    </td>
                    <td>
                        <strong>Contact Phone:</strong> {{ $row->requested_user->Contact_Phone }}<br>
                        <strong>Local Phone:</strong> {{ $row->requested_user->Local_Phone }}<br>
                        <strong>Toll Free:</strong> {{ $row->requested_user->Toll_Free }}<br>
                        <strong>Fax:</strong> {{ $row->requested_user->Fax_Phone }}
                    </td>
                    <td>
                        <strong>Agent Name:</strong> {{ $row->requested_user->insurance->Agent_Name }}<br>
                        <strong>Agent Phone:</strong> {{ $row->requested_user->insurance->Agent_Phone }}<br>
                        <strong>Cargo Limit:</strong> {{ $row->requested_user->insurance->Cargo_Limit }}<br>
                        <strong>Deductible:</strong> {{ $row->requested_user->insurance->Deductable }}
                    </td>
                    <td>
                        <strong>Bid Price:</strong> ${{ $row->Offer_Price }}<br>
                        <strong>Pick Date:</strong> {{ $row->Pickup_Date }} ({{ $row->Date_Pickup_Mode }})<br>
                        <strong>Delivery Date:</strong> {{ $row->Delivery_Date }} ({{ $row->Date_Delivery_Mode }})<br>
                        <a href="{{ route('chat', $row->requested_user->id) }}?msg={{ $row->id }}"
                            class="btn btn-primary mt-2">Message</a>
                    </td>
                </tr>
            @endif
        @empty
            <tr class="card-row" data-status="active">
                <td colspan="7" class="text-center text-muted">No Data Found</td>
            </tr>
        @endforelse
    </tbody>
</table>
<script>
    function toggleTable(tableId) {
        console.log(tableId);
        if (tableId === "bidTable") {
            $("#bidTable").show();
            $("#requestedTable").hide();
            console.log("done");
        } else {
            $("#bidTable").hide();
            $("#requestedTable").show();
            console.log("not done");
        }
    }
    $(document).ready(function() {
        $('.btn.container.custom .btn-toggle').click(function() {
            $('.btn.container.custom .btn-toggle').removeClass('active');
            $(this).addClass('active');
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.visible-form').hide();
        $(document).on('click', '.decline-btn', function(event) {
            event.preventDefault();
            var $targetForm = $($(this).data('target'));
            $targetForm.show();
            $targetForm.find('input[type="text"]').prop('disabled', false);
            $targetForm.find('button[type="submit"]').prop('disabled', false);
            $(this).hide();
        });
    });
</script>
