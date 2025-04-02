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
        <h5 class="card-title mb-0">Logistic Brokers</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive dataTables_wrapper me-0 d-flex">
            <div class="col-lg-10 col-md-6 col-sm-12">
                <table>
                    <tbody class="dataTables_filter">
                        <tr>
                            <td><strong>Search For: </strong></td>

                            <form action="{{ route('Admin.Logistic.Broker') }}">
                                <td>
                                    <select class="form-control ml-1" id="Search_Criteria" name="Search_Criteria">
                                        <option value="company_name" @if ($Search_Criteria == 'company_name') selected @endif>
                                            Company Name</option>
                                        <option value="city" @if ($Search_Criteria == 'city') selected @endif>State /
                                            City</option>
                                        <option value="phone" @if ($Search_Criteria == 'phone') selected @endif>Phone
                                        </option>
                                        <option value="Mc_Number" @if ($Search_Criteria == 'Mc_Number') selected @endif>Mc
                                            Number</option>
                                        <option value="Company_USDot" @if ($Search_Criteria == 'Company_USDot') selected @endif>
                                            Company USDot</option>
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
                        class="ri-add-line align-bottom me-1"></i> Add New Logistic Broker
                </a>
            </div>
        </div>
        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
            style="width:100%">
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>State / City</th>
                    <th>Phone</th>
                    <th>Mc Number</th>
                    <th>Company USDot</th>
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
                            {{ $List->city }}
                        </td>
                        <td>
                            <button class="btn btn-primary"
                                onclick="document.location.href = 'tel:{{ $List->phone }}'">{{ Str::mask($List->phone, '*', 0, 12) }}</button>
                        </td>
                        <td>
                            {{ $List->Mc_Number }}
                        </td>
                        <td>
                            {{ $List->Company_USDot }}
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

<!--{{-- Add New Log Broker --}}-->
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
                        <h5 class="text-primary">Add New Logistic Broker</h5>
                        <!--<p class="text-muted">Get your free Day Dispatch account now</p>-->
                    </div>
                    <div class="p-2 mt-4">
                        <form action="{{ route('Admin.LogBroker.Store') }}" method="POST" class="needs-validation"
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
                                <label for="city" class="form-label">State / City
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="city" name="city"
                                    maxlength="500" placeholder="Enter State / City" required autocomplete="off" />
                                <div class="invalid-feedback">State / City</div>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    maxlength="500" placeholder="Enter Phone" required autocomplete="off" />
                                <div class="invalid-feedback">Phone</div>
                            </div>

                            <div class="mb-3">
                                <label for="Mc_Number" class="form-label">Mc Number
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="Mc_Number" name="Mc_Number"
                                    maxlength="500" placeholder="Enter Mc Number" required autocomplete="off" />
                                <div class="invalid-feedback">Mc Number</div>
                            </div>

                            <div class="mb-3">
                                <label for="Company_USDot" class="form-label">Company USDot
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="Company_USDot" name="Company_USDot"
                                    maxlength="500" placeholder="Enter Company USDot" required autocomplete="off" />
                                <div class="invalid-feedback">Company USDot</div>
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
            url: '{{ route('Admin.History.Logistic.Broker') }}',
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
