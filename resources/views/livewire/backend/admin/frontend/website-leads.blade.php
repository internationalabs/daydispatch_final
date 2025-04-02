<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Custom Leads</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('Admin.Dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Website Leads</li>
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
                    Instant Quotes
                </a>
            </li>
            <li class="nav-item waves-effect waves-light" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#pill-justified-profile-1" role="tab"
                   aria-selected="false" tabindex="-1">
                    Contact Us
                </a>
            </li>
            <!--<li class="nav-item waves-effect waves-light" role="presentation">-->
            <!--    <a class="nav-link" data-bs-toggle="tab" href="#pill-justified-profile-2" role="tab"-->
            <!--       aria-selected="false" tabindex="-1">-->
            <!--        Custom Orders Tracking-->
            <!--    </a>-->
            <!--</li>-->
        </ul>
        <!-- Tab panes -->
        <div class="tab-content text-muted">
            <div class="tab-pane active" id="pill-justified-home-1" role="tabpanel">
                <table id="example"
                       class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
                       style="width:100%">
                    <thead>
                    <tr>
                        <th>Routes</th>
                        <th>Load Details</th>
                        <th>Dimensions</th>
                        <th>Carrier Type</th>
                        <th>User Details</th>
                        <th>Freight Weight</th>
                        <th>Shipment Preferences</th>
                        <th>Pickup Date</th>
                        <th>Delivery Date</th>
                        <th>Pickup Time</th>
                        <th>Delivery Time</th>
                        <th>Created At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($Instant_Leads as $Lead)
                        <tr>
                            <td>
                                <strong>PickUp:</strong><br> {{ $Lead->From_ZipCode }}<br>
                                <strong>Delivery:</strong><br> {{ $Lead->To_ZipCode }}<br>
                            </td>
                            <td>
                                <strong>Selected:</strong> {{ $Lead->Select_Vehicle }}<br>
                                <strong>Car Make Model:</strong><br> {{ $Lead->Car_Make }} {{ $Lead->Car_Model }} {{ $Lead->Year_Make_Model }}<br>
                                <strong>Dimensions:</strong> {{ $Lead->Additional_Instruction }}
                            </td>
                            <td>
                                <b>L</b>{{ $Lead->Vehicle_Length }} x <b>W</b> {{ $Lead->Vehicle_Width }} x <b>H</b> {{ $Lead->Vehicle_Height }} x  {{ $Lead->Vehicle_Weight }} <b>LBS</b>
                            </td>
                            <td>
                                <strong>Carrier Type:</strong> {{ $Lead->Carrier_Type }}<br>
                                <strong>Carrier Condition:</strong> {{ $Lead->Carrier_Condition }}
                            </td>
                            <td>
                                <strong>Name:</strong> {{ $Lead->Custo_Name }}<br>
                                <strong>Email:</strong> {{ $Lead->Custo_Email }}<br>
                                <strong>Contact:</strong> {{ $Lead->Custo_Phone }}
                            </td>
                            <td>{{ $Lead->Freight_Weight }}</td>
                            <td>{{ $Lead->Shipment_Preferences }}</td>
                            <td>{{ $Lead->Pickup_Date }}</td>
                            <td>{{ $Lead->Delivery_Date }}</td>
                            <td>{{ $Lead->Pickup_Time }}</td>
                            <td>{{ $Lead->Delivery_Time }}</td>
                            <td>{{ $Lead->created_at }}</td>
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
                        <th>Full Name</th>
                        <th>Email Address</th>
                        <th>Phone Number</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Created At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($Contact_Leads as $Lead)
                        <tr>
                            <td> {{ $Lead->Lead_Name }}</td>
                            <td> {{ $Lead->Lead_Email }}</td>
                            <td> {{ $Lead->Lead_Phone }}</td>
                            <td>{{ $Lead->Lead_Subject }}</td>
                            <td>{{ $Lead->Lead_Message }} </td>
                            <td>{{ $Lead->created_at }}</td>
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
                        <th>Order ID</th>
                        <th>Description</th>
                        <th>Created At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($Orders_Tracking as $Order)
                        <tr>
                            <td>{{ $Order->Order_ID }}</td>
                            <td>{{ $Order->Order_Desc }}</td>
                            <td>{{ $Order->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- end card-body -->
</div>
