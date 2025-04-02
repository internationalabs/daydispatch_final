<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">My Rewards</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('Agent.Dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Rewards History</li>
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
                    Current Month Revenue
                </a>
            </li>
            <li class="nav-item waves-effect waves-light" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#pill-justified-profile-1" role="tab"
                   aria-selected="false" tabindex="-1">
                    Overall Revenue
                </a>
            </li>
{{--            <li class="nav-item waves-effect waves-light" role="presentation">--}}
{{--                <a class="nav-link" data-bs-toggle="tab" href="#pill-justified-profile-2" role="tab"--}}
{{--                   aria-selected="false" tabindex="-1">--}}
{{--                    Filtered Revenue--}}
{{--                </a>--}}
{{--            </li>--}}
        </ul>
        <!-- Tab panes -->
        <div class="tab-content text-muted">
            <div class="tab-pane active" id="pill-justified-home-1" role="tabpanel">
                <table id="example"
                       class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
                       style="width:100%">
                    <thead>
                    <tr>
                        <th>Revenue</th>
                        <th>Order Info</th>
                        <th>Assigned By</th>
                        <th>Assigned To</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($currentMonth as $Lead)
                        <tr>
                            <td>
                                <strong>Revenue: </strong><br> $ {{ $Lead->Agent_Reward }}<br>
                                <strong>Created At: </strong><br> {{ $Lead->created_at }}<br>
                            </td>
                            <td>
                                <strong>Order ID:</strong> {{ $Lead->all_listing->Ref_ID }}<br>
                                <strong>Status:</strong> {{ $Lead->all_listing->Listing_Status }}<br>
                                <strong>Delivered At:</strong> {{ $Lead->all_listing->deliver->created_at }}
                            </td>
                            <td>
                                <strong>Name:</strong> {{ $Lead->all_listing->authorized_user->Company_Name }}<br>
                                <strong>Phone:</strong> {{ $Lead->all_listing->authorized_user->Contact_Phone }}<br>
                                <strong>Email:</strong> {{ $Lead->all_listing->authorized_user->email }}
                            </td>
                            <td>
                                <strong>Name:</strong> {{ $Lead->all_listing->deliver->delivered_user->Company_Name }}
                                <br>
                                <strong>Phone:</strong> {{ $Lead->all_listing->deliver->delivered_user->Contact_Phone }}
                                <br>
                                <strong>Email:</strong> {{ $Lead->all_listing->deliver->delivered_user->email }}
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
                        <th>Revenue</th>
                        <th>Order Info</th>
                        <th>Assigned By</th>
                        <th>Assigned To</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($overallRevenue as $Lead)
                        <tr>
                            <td>
                                <strong>Revenue: </strong><br> $ {{ $Lead->Agent_Reward }}<br>
                                <strong>Created At: </strong><br> {{ $Lead->created_at }}<br>
                            </td>
                            <td>
                                <strong>Order ID:</strong> {{ $Lead->all_listing->Ref_ID }}<br>
                                <strong>Status:</strong> {{ $Lead->all_listing->Listing_Status }}<br>
                                <strong>Delivered At:</strong> {{ $Lead->all_listing->deliver->created_at }}
                            </td>
                            <td>
                                <strong>Name:</strong> {{ $Lead->all_listing->authorized_user->Company_Name }}<br>
                                <strong>Phone:</strong> {{ $Lead->all_listing->authorized_user->Contact_Phone }}<br>
                                <strong>Email:</strong> {{ $Lead->all_listing->authorized_user->email }}
                            </td>
                            <td>
                                <strong>Name:</strong> {{ $Lead->all_listing->deliver->delivered_user->Company_Name }}
                                <br>
                                <strong>Phone:</strong> {{ $Lead->all_listing->deliver->delivered_user->Contact_Phone }}
                                <br>
                                <strong>Email:</strong> {{ $Lead->all_listing->deliver->delivered_user->email }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
{{--            <div class="tab-pane" id="pill-justified-profile-2" role="tabpanel">--}}
{{--                <table id="example1"--}}
{{--                       class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"--}}
{{--                       style="width:100%">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th>Order ID</th>--}}
{{--                        <th>Description</th>--}}
{{--                        <th>Created At</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
        </div>
    </div><!-- end card-body -->
</div>
