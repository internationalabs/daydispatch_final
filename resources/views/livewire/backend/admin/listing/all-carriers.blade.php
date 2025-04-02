<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Moment.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<!-- DateRangePicker -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Dashboard</h4>

            {{-- <form action="{{ route('Admin.Carriers') }}">
                <input type="text" name="search" value="{{ $search }}" id="demo">
                <input type="submit" value="Search">
            </form> --}}
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('Admin.Dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('Admin.All-Companies') }}">All Companies</a></li>
                    <li class="breadcrumb-item">Carriers</li>
                </ol>
            </div>

        </div>
    </div>
</div>

<script></script>
<!-- end page title -->

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Auto Carriers</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive dataTables_wrapper me-0 d-flex">

            <div class="col-lg-10 col-md-6 col-sm-12">
                <table>
                    <tbody class="dataTables_filter">
                        <tr>
                            <td><strong>Search For: </strong></td>
                            <form action="{{ route('Admin.Carriers') }}">
                                <td>
                                    <select class="form-control ml-1" id="Search_Criteria" name="Search_Criteria">
                                        <option value="company_name" @if ($Search_Criteria == 'company_name') selected @endif>
                                            Company Name</option>
                                        <option value="address" @if ($Search_Criteria == 'address') selected @endif>
                                            Address</option>
                                        <option value="main_number" @if ($Search_Criteria == 'main_number') selected @endif>
                                            Main Number</option>
                                        <option value="local_number" @if ($Search_Criteria == 'local_number') selected @endif>
                                            Local Number</option>
                                        <option value="truck" @if ($Search_Criteria == 'truck') selected @endif>Truck
                                        </option>
                                        <option value="equipment" @if ($Search_Criteria == 'equipment') selected @endif>
                                            Equipment</option>
                                        <option value="route_description"
                                            @if ($Search_Criteria == 'route_description') selected @endif>Route Description</option>
                                    </select>
                                </td>
                                <td>
                                    <input class="form-control" id="Search_Value" placeholder="Enter Search Value"
                                        value="{{ $Search_Value }}" type="search" name="Search_Value">
                                </td>
                                <td>
                                    <div id="reportrange"
                                        style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; ">
                                        <i class="fa fa-calendar"></i>&nbsp;
                                        <span></span> <i class="fa fa-caret-down"></i>
                                        <input type="hidden" name="start" id="start" value="start">
                                        <input type="hidden" name="end" id="end" value="end">
                                    </div>
                                </td>
                                <td>
                                    <input type="submit" value="Search">
                                </td>
                            </form>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-12">
                <a class="btn btn-success add-btn btn-block btn-sm" data-bs-toggle="modal" href="#AdNewCarriers"><i
                        class="ri-add-line align-bottom me-1"></i> Add New Auto Carriers
                </a>
            </div>
        </div>
        <table id="example" class="table table-bordered dt-responsive table-striped align-middle text-center"
            style="width:100%">
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Address</th>
                    <th>Main Number</th>
                    <th>Local Number</th>
                    <th>Truck</th>
                    <th>Equipment</th>
                    <th>Route Description</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Lisiting as $List)
                    <tr>
                        <td>
                            {{ $List->company_name }}
                        </td>
                        <td>
                            {{ $List->address }}
                        </td>
                        <td>
                            <button class="btn btn-primary"
                                onclick="document.location.href = 'tel:{{ $List->main_number }}'">{{ Str::mask($List->main_number, '*', 0, 12) }}</button>
                        </td>
                        <td>
                            <button class="btn btn-primary"
                                onclick="document.location.href = 'tel:{{ $List->local_number }}'">{{ Str::mask($List->local_number, '*', 0, 12) }}</button>
                        </td>
                        <td>
                            {{ $List->truck }}
                        </td>
                        <td>
                            {{ $List->equipment }}
                        </td>
                        <td>
                            {{ $List->route_description }}
                        </td>
                        <td>
                            {{ $List->created_at }}
                        </td>
                        <td>
                            @if (count($List->history($List->id)) > 0)
                                <button class="btn btn-info get-history" data-bs-toggle="modal"
                                    data-bs-target="#showModal" id="">
                                    View History
                                    <input type="hidden" class="company_name" name="company_name"
                                        value="{{ $List->company_name }}">
                                    <input type="hidden" class="company_id" name="company_id"
                                        value="{{ $List->id }}">
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($Lisiting instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div id="">
                {{ $Lisiting->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>
</div>

<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header bg-soft-info p-3">
                <h5 class="modal-title" id="exampleModalLabel">Call History of <span class="compName"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <div class="modal-body">
                {{-- <div class="row g-3">
                    <div class="col-lg-12">
                        <div>
                            <label for="company_name-field" class="form-label">Full Name</label>
                            <input type="text" id="company_name-field" class="form-control" placeholder="Enter User Name"
                                    onkeypress="return /^[a-zA-Z\s]*$/g.test(event.key)" name="Agent_Name" maxlength="50" required />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div>
                            <label for="email_id-field" class="form-label">Email Address</label>
                            <input type="email" id="email_id-field" class="form-control" name="Agent_Email" maxlength="70"
                                    placeholder="Enter Email Address" required />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div>
                            <label for="pass_id-field" class="form-label">Password</label>
                            <input type="password" id="pass_id-field" class="form-control" name="Agent_Password"
                                    placeholder="Enter Password" required />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div>
                            <label for="phone-field" class="form-label">Phone</label>
                            <input type="text" id="phone-field" class="form-control phone-number" name="Agent_Phone"
                                    placeholder="Enter Phone Number" required />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label for="username" class="form-label">Full Address <span class="text-danger">*</span></label>
                        <textarea name="Agent_Address" class="form-control" placeholder="Enter Complete Address"
                                    required></textarea>
                        <div class="invalid-feedback">
                            Please enter Address
                        </div>
                    </div>
                </div> --}}
                <div class="message-feed media">
                    <div class="media-body">
                        <div class="mf-content w-100 history-content">
                            {{-- <h6>Agent: Michael</h6>
                            <h6>STATUS: TimeQuote</h6>
                            <h6>Remarks: She said she has to figure out when the vehicle will be ready. She
                                asked for a quote on our email so I sent her the booking form as well.</h6>
                            <strong class="mf-date"><i class="fa fa-clock-o"></i> Nov,10 2023 10:51
                                AM</strong> --}}
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="hstack gap-2 justify-content-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<!--{{-- Add New Carrier --}}-->
<div class="modal fade" id="AdNewCarriers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <div class="card mt-4">
                <div class="card-body p-4">
                    <div class="text-center mt-2">
                        <h5 class="text-primary">Add New Auto Carriers</h5>
                        <!--<p class="text-muted">Get your free Day Dispatch account now</p>-->
                    </div>
                    <div class="p-2 mt-4">
                        <form action="{{ route('Admin.Carriers.Store') }}" method="POST" class="needs-validation"
                            novalidate>
                            @csrf

                            <div class="mb-3">
                                <label for="company_name" class="form-label">Company Name
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="company_name" name="company_name"
                                    maxlength="500" placeholder="Enter Company Name" required autocomplete="off" />
                                <div class="invalid-feedback">Company Name</div>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="address" name="address"
                                    maxlength="500" placeholder="Enter Address" required autocomplete="off" />
                                <div class="invalid-feedback">Address</div>
                            </div>

                            <div class="mb-3">
                                <label for="main_number" class="form-label">Main Number
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="main_number" name="main_number"
                                    maxlength="500" placeholder="Enter Main Number" required autocomplete="off" />
                                <div class="invalid-feedback">Main Number</div>
                            </div>

                            <div class="mb-3">
                                <label for="local_number" class="form-label">Local Number
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="local_number" name="local_number"
                                    maxlength="500" placeholder="Enter Local Number" required autocomplete="off" />
                                <div class="invalid-feedback">Local Number</div>
                            </div>

                            <div class="mb-3">
                                <label for="truck" class="form-label">Truck
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="truck" name="truck"
                                    maxlength="500" placeholder="Enter Truck" required autocomplete="off" />
                                <div class="invalid-feedback">Truck</div>
                            </div>

                            <div class="mb-3">
                                <label for="equipment" class="form-label">Equipment
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="equipment" name="equipment"
                                    maxlength="500" placeholder="Enter Equipment" required autocomplete="off" />
                                <div class="invalid-feedback">Equipment</div>
                            </div>

                            <div class="mb-3">
                                <label for="route_description" class="form-label">Route Description
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="route_description"
                                    name="route_description" maxlength="500" placeholder="Enter Route Description"
                                    required autocomplete="off" />
                                <div class="invalid-feedback">Route Description</div>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-success w-100" type="submit">
                                    Create
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
</div>

<script>
    $(".get-history").click(function() {
        var CompanyName = $(this).find('.company_name').val();
        var CompanyID = $(this).find('.company_id').val();
        $(".compName").html(CompanyName);

        console.log(CompanyID, CompanyName);

        $.ajax({
            url: '{{ route('Admin.History.Carrier') }}',
            type: 'GET',
            data: {
                'CompanyID': CompanyID
            },
            success: function(data) {
                console.log('datas', data);
                html = "";
                $.each(data, function(index, val) {
                    // Assuming val['created_at'] is a string representation of the date
                    var createdAt = new Date(val['created_at']);

                    // Format the date
                    var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul",
                        "Aug", "Sep", "Oct", "Nov", "Dec"
                    ];
                    var formattedDate = monthNames[createdAt.getMonth()] + "," +
                        ("0" + createdAt.getDate()).slice(-2) + " " +
                        createdAt.getFullYear() + " " +
                        ("0" + createdAt.getHours()).slice(-2) + ":" +
                        ("0" + createdAt.getMinutes()).slice(-2) +
                        (createdAt.getHours() >= 12 ? " PM" : " AM");

                    // Append formatted date to HTML
                    html += "<h6>" + val['user']['name'] + "</h6>";
                    html += "<h6>" + val['connectStatus'] + "</h6>";
                    html += "<h6>" + val['comment'] + ".</h6>";
                    html += "<strong class='mf-date'><i class='fa fa-clock-o'></i>" +
                        formattedDate + "</strong> <hr>";
                });
                $(".history-content").html(html);
            },
            error: function(data) {
                console.log(data);
            }

        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();

        var start = moment().subtract(29, 'days');
        var end = moment();

        // Initialize the date range picker
        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')]
            }
        }, function(start, end, label) {
            // Update the start and end hidden input fields
            $('#start').val(start.format('YYYY-MM-DD'));
            $('#end').val(end.format('YYYY-MM-DD'));
        });
    });
</script>