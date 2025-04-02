<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">All Payment Invoices</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('Admin.Dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Payment Invoices</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="card">
    <div class="card-body">
        <!-- Nav tabs -->
        <ul class="nav nav-pills nav-justified mb-3" role="tablist">
            <li class="nav-item waves-effect waves-light" role="presentation">
                <a class="nav-link active" data-bs-toggle="tab" href="#pill-justified-home-1" role="tab"
                   aria-selected="true">
                    Dispatching Invoices
                </a>
            </li>
            <li class="nav-item waves-effect waves-light" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#pill-justified-profile-1" role="tab"
                   aria-selected="false" tabindex="-1">
                    Registration Invoices
                </a>
            </li>
            <li class="nav-item waves-effect waves-light" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#pill-justified-profile-2" role="tab"
                   aria-selected="false" tabindex="-1">
                    Subscription Invoices
                </a>
            </li>

            <li class="nav-item waves-effect waves-light" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#pill-justified-profile-3" role="tab"
                   aria-selected="false" tabindex="-1">
                    Broker Invoices
                </a>
            </li>

            <li class="nav-item waves-effect waves-light" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#pill-justified-profile-4" role="tab" aria-selected="false">
                    Number Of Seats Invoices
                </a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content text-muted">
            <div class="tab-pane active" id="pill-justified-home-1" role="tabpanel">
                <table id="example"
                       class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
                       style="width:100%">
                    <thead>
                    <tr>
                        <th>Order Info</th>
                        <th>Payment Info</th>
                        <th>Assigned To</th>
                        <th>Assigned By</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($Dispatches_Invoices as $Inv)
                        <tr>
                            <td>
                                <strong>Status:</strong> {{ $Inv->Listing_Status }}<br>
                                <strong>Order ID:</strong> {{ $Inv->Ref_ID }}<br>
                                <strong>Created At:</strong> {{ $Inv->created_at }}
                            </td>
                            <td>
                                <strong>Amount:</strong> ${{ $Inv->dispatch_fee->Payment }}<br>
                                <strong>Payment ID:</strong> {{ Str::limit($Inv->dispatch_fee->Payment_ID, 20) }}<br>
                                <strong>Paid At:</strong> {{ $Inv->dispatch_fee->created_at }} Using
                                <b>{{ $Inv->dispatch_fee->Method }}</b>
                            </td>
                            <td>
                                <strong>Company Name:</strong> {{ $Inv->dispatch_fee->authorized_user->Company_Name }}
                                <br>
                                <strong>Contact:</strong> {{ $Inv->dispatch_fee->authorized_user->Contact_Phone }}
                            </td>
                            <td>
                                <strong>Company Name:</strong> {{ $Inv->authorized_user->Company_Name }}<br>
                                <strong>Contact:</strong> {{ $Inv->authorized_user->Contact_Phone }}
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
                        <th>Payment Type</th>
                        <th>Transaction ID</th>
                        <th>Amount</th>
                        <th>Payment Method</th>
                        <th>Paid By</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($Reg_Invoices as $Inv)
                        <tr>
                            <td> ${{ $Inv->Payment }}</td>
                            <td> {{ Str::limit($Inv->Payment_ID, 20) }}</td>
                            <td> {{ $Inv->created_at }}</td>
                            <td>{{ $Inv->Method }}</td>
                            <td>
                                <strong>Company Name:</strong> {{ $Inv->authorized_user->Company_Name }}<br>
                                <strong>Contact:</strong> {{ $Inv->authorized_user->Contact_Phone }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="pill-justified-profile-2" role="tabpanel">
                <table id="example1"
                       class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
                       style="width:100%">
                    <thead>
                    <tr>
                        <th>Package Info</th>
                        <th>Payment Info</th>
                        <th>Paid By</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($Sub_Invoices as $Inv)
                        <tr>
                            <td>
                                <strong>Name:</strong>{{ $Inv->Package_Name }}
                                <strong>Status:</strong>{{ $Inv->status }}
                            </td>
                            <td>
                                <strong>Amount:</strong> ${{ $Inv->Payment }}<br>
                                <strong>Payment ID:</strong> {{ Str::limit($Inv->Payment_ID, 20) }}<br>
                                <strong>Paid At:</strong> {{ $Inv->created_at }} Using
                                <b>{{ $Inv->Method }}</b>
                            </td>
                            <td>
                                <strong>Company Name:</strong> {{ $Inv->authorized_user->Company_Name }}<br>
                                <strong>Contact:</strong> {{ $Inv->authorized_user->Contact_Phone }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="pill-justified-profile-3" role="tabpanel">
                <table id="example"
                       class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
                       style="width:100%">
                    <thead>
                    <tr>
                        <th>Order Info</th>
                        <th>Payment Info</th>
                        <th>Broker Info</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($Broker_Invoices as $Inv)
                        @if($Inv->dispatch_fee != null)
                            <tr>
                                <td>
                                    <strong>Status:</strong> {{ $Inv->Listing_Status }}<br>
                                    <strong>Order ID:</strong> {{ $Inv->Ref_ID }}<br>
                                    <strong>Created At:</strong> {{ $Inv->created_at }}
                                </td>
                                <td>
                                    <strong>Amount:</strong> ${{ $Inv->dispatch_fee->Payment }}<br>
                                    <strong>Payment ID:</strong> {{ Str::limit($Inv->dispatch_fee->Payment_ID, 20) }}<br>
                                    <strong>Paid At:</strong> {{ $Inv->dispatch_fee->created_at }} Using
                                    <b>{{ $Inv->dispatch_fee->Method }}</b>
                                </td>
                                <td>
                                    <strong>Company Name:</strong> {{ $Inv->completed->authorized_user->Company_Name }}<br>
                                    <strong>Contact:</strong> {{ $Inv->completed->authorized_user->Contact_Phone }}
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>


            <div class="tab-pane" id="pill-justified-profile-4" role="tabpanel">
                <table id="example"
                       class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
                       style="width:100%">
                    <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Number Of Seats</th>
                        <th>Transaction ID</th>
                        <th>Payment Type</th>
                        <th>User Name</th>
                        <th>Amount</th>
                        <th>Payment Time</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($seats as $item)
                            <tr>
                                <td>{{ $item->full_name }}</td>
                                <td>{{ $item->number_of_login }}</td>
                                <td>{{ $item->transaction_id }}</td>
                                <td>{{ $item->payment_type }}</td>
                                <td>{{ $item->authorized_user_name->Company_Name }}</td>
                                <td>{{ $item->amount }}</td>
                                <td>{{ $item->created_at }}</td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- end card-body -->
</div>
