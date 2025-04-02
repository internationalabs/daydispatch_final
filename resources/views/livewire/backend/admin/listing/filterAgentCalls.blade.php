    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!-- DateRangePicker -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>

    <style>
        .status-all-option {
    width: 171px !important;
    height: 40px;
    position: absolute;
    left: 19%!important;
    top: 37%!important;
    margin: -20px 0 0 -20px;
}
div#reportrange {
    width: max-content; */
     height: 95%; 
}
    </style>
    
<div class="container mt-5">
    <h2>Filterable Table</h2>
    <p>Type something in the input field to search the table for first names, last names, or emails:</p>
    <div class="row mb-3">
      <div class="col-sm-2">
        <select class="form-select updateOnChangeEvent" id="type" name="type">
          <option value="Carrier">Carrier</option>
          <option value="Logistic Broker">Logistic Broker</option>
          <option value="Logistic Carrier">Logistic Carrier</option>
          <option value="Logistic Shipper">Logistic Shipper</option>
        </select>
      </div>
      <div class="col-sm-2">
        <select class="form-select selectStatus status-all-option" id="status" name="status">
            <option value="All">All</option>
            <option value="Connected">Connected</option>
            <option value="Not Connected">Not Connected</option>
        </select>
    </div>
    <div class="col-sm-2">
        <select class="form-select updateOnChangeEvent" id="agent" name="agent">
            <option value="" selected disabled>Select Agent</option>
            @foreach ($agent as $row)
                <option value="{{ $row->id }}">{{ $row->name }}</option>
            @endforeach
        </select>
      </div>

      <div class="col-sm-2">
        <input class="form-control" id="search" type="text" placeholder="Search C-NAME">
      </div>
            <div class="col-sm-2">
     <!--=========================================================new one==============================================-->
        <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; ">
            <i class="fa fa-calendar"></i>&nbsp;
            <span></span> <i class="fa fa-caret-down"></i>
            <input type="hidden" name="start" id="start" value="start">
            <input type="hidden" name="end" id="end" value="end">
        </div>
<!--=========================================================new one==============================================-->

      </div>
    </div>
  
    <table class="table table-bordered table-striped">
    <!-- <table id="example" class="table table-bordered table-striped"> -->
      <thead>
        <tr>
          <th>DATE</th>
          <th>C-NAME</th>
          <th>C-EMAIL</th>
          <th>USER NAME</th>
          <th>TOTAL CLICK</th>
          <th>CLICK STATUS</th>
          <th>HISTORY UPDATED</th>
        </tr>
      </thead>
      <tbody id="myTable">
      </tbody>
    </table>
  
  </div>

<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header bg-soft-info p-3">
                <h5 class="modal-title" id="exampleModalLabel">Call History of <span class="compName"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
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
  
<!--</script>--> 
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
        
        var start = moment().subtract(29, 'days');
        var end = moment();
        
        $('#start').val(start);
        $('#end').val(end);

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

            var url = "{{ route('Filter.Agents.Calls.Results') }}";
            // var newValue = $(this).val();
            var type = $('#type').val();
            var agent = $('#agent').val();
            // var date = $('#date').val();
            var search = $('#search').val();
            var status = $('#status').val();

            $.ajax({
                type: "GET",
                url: url,
                data: {
                    'start': start.format('YYYY-MM-DD'),
                    'end': end.format('YYYY-MM-DD'),
                    'type': type,
                    'agent': agent,
                    'search': search,
                    'status': status
                },
                dataType: "json",
                success: function (data) {
                    $("#myTable").html("");
                    var html = "";

                    $.each(data, function (index, val) {
                        if (val['agent'] !== null) {
                            html += "<tr>";
                            var date = new Date(val['created_at']);
                            var formattedDate = date.toLocaleString('en-US', { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit', second: '2-digit' });

                            html += "<td>" + formattedDate + "</td>";
                            html += "<td>" + val['company_name'] + "</td>";
                            html += "<td>" + val['company_name'] + "</td>";
                            html += "<td><span class='btn btn-secondary'>" + val['agent']['name'] + "</span></td>";
                            html += "<td>" + val['call_count'].length + "</td>";
                            html += "<td>";
                            var lastStatusArray = val['last_status'];
                            if (lastStatusArray && lastStatusArray.length > 0) {
                                var connectStatus = lastStatusArray[0]['connectStatus'];
                                if (connectStatus !== null && connectStatus !== undefined) {
                                    if (connectStatus === 'Connected') {
                                        html += "<span class='badge bg-success'>" + connectStatus + "</span>";
                                    } else {
                                        html += "<span class='badge bg-danger'>" + connectStatus + "</span>";
                                    }
                                } else {
                                    html += "<span class='badge bg-warning'>No Connect Status</span>";
                                }
                            } else {
                                html += "N/A";
                            }
                            html += "</td>";
                            html += "<td>";
                                if (lastStatusArray && lastStatusArray.length > 0) {
                                    html += "<button class='btn btn-info get-history' data-bs-toggle='modal' data-bs-target='#showModal' id=''>" +
                                    "View History" +
                                    "<input type='hidden' class='company_name' name='company_name' value='" + val['company_name'] + "'>" +
                                    "<input type='hidden' class='company_id' name='company_id' value='" + val['id'] + "'>" +
                                    "</button>"
                                } else {
                                    html += "N/A";
                                }
                            html += "</td>";
                            html += "</tr>";
                            html += "<tr>";
                        }
                    });

                    $("#myTable").html(html);
                },
                error: function (error) {
                    console.error("Error:", error);
                }
            });
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);
    });
</script>
  <script>
    $(document).ready(function () {
        $("#search").on("keyup", function () {
            var value = $(this).val().toLowerCase();
        });

        $(".updateOnChangeEvent").on("change", function () {
            // Get the new value of the changed input
            var newValue = $(this).val();
            var type = $('#type').val();
            var agent = $('#agent').val();
            var search = $('#search').val();
            var start = $('#start').val();
            var end = $('#end').val();
            var status = $('#status').val();
            
            // Determine which input triggered the change event
            var inputId = $(this).attr("id");
            
            var url = "{{ route('Filter.Agents.Calls.Results') }}";
            
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    'newValue': newValue,
                    'type': type,
                    'inputId': inputId,
                    'agent': agent,
                    'search': search,
                    'start': start,
                    'end': end,
                    'status': status
                },
                dataType: "json",
                success: function (data) {
                    // Handle the successful data here
                    $("#myTable").html("");
                    html = "";
                    
                    $.each(data, function (index, val) {
                        if (val['agent'] !== null) {
                            html += "<tr>";
                            // Display the date of the latest call_count record
                            var latestCallCountDate = getLatestCallCountDate(val['call_count']);
                            // Format the date using toLocaleString
                            var formattedDate = new Date(latestCallCountDate).toLocaleString('en-US', {
                                day: 'numeric',
                                month: 'numeric',
                                year: 'numeric',
                                hour: 'numeric',
                                minute: 'numeric'
                            });
                            html += "<td>" + formattedDate + "</td>";
                            html += "<td>" + val['company_name'] + "</td>";
                            html += "<td>" + val['company_name'] + "</td>";
                            html += "<td><span class='btn btn-secondary'>" + val['agent']['name'] + "</span></td>";
                            html += "<td>" + val['call_count'].length + "</td>";
                            html += "<td>";
                            var lastStatusArray = val['last_status'];
                            if (lastStatusArray && lastStatusArray.length > 0) {
                                var connectStatus = lastStatusArray[0]['connectStatus'];
                                if (connectStatus !== null && connectStatus !== undefined) {
                                    if (connectStatus === 'Connected') {
                                        html += "<span class='badge bg-success'>" + connectStatus + "</span>";
                                    } else {
                                        html += "<span class='badge bg-danger'>" + connectStatus + "</span>";
                                    }
                                } else {
                                    html += "<span class='badge bg-warning'>No Connect Status</span>";
                                }
                            } else {
                                html += "N/A";
                            }
                            html += "</td>";
                            html += "<td>";
                                if (lastStatusArray && lastStatusArray.length > 0) {
                                    html += "<button class='btn btn-info get-history' data-bs-toggle='modal' data-bs-target='#showModal' id=''>" +
                                    "View History" +
                                    "<input type='hidden' class='company_name' name='company_name' value='" + val['company_name'] + "'>" +
                                    "<input type='hidden' class='company_id' name='company_id' value='" + val['id'] + "'>" +
                                    "</button>"
                                } else {
                                    html += "N/A";
                                }
                            html += "</td>";
                            html += "</tr>";
                            html += "<tr>";
                        }
                });
                    $("#myTable").html(html);


                },
                error: function (error) {
                // Handle errors here
                console.error("Error:", error);
                }
            });
            
        });

        $("#myTable").on("click", ".get-history", function () {
            var CompanyName = $(this).find('.company_name').val();
            var CompanyID = $(this).find('.company_id').val();
            $(".compName").html(CompanyName);

            $.ajax({
                url: '{{ route('Admin.History.Carrier') }}',
                type: 'GET',
                data: {
                    'CompanyID': CompanyID
                },
                success: function (data) {
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
                        html += "<h6>" + val['connectStatus'] + "</h6>";
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

        // Function to get the date of the latest call_count record
        function getLatestCallCountDate(callCountArray) {
            var latestDate = null;

            // Check if callCountArray is an array and has at least one item
            if (Array.isArray(callCountArray) && callCountArray.length > 0) {
                // Sort the array by created_at in descending order
                callCountArray.sort(function(a, b) {
                    return new Date(b['created_at']) - new Date(a['created_at']);
                });

                // Get the created_at value of the first item (latest date)
                latestDate = callCountArray[0]['created_at'];
            }

            return latestDate;
        }

        $('#search').keyup(function(event) {
            
            var type = $('#type').val();
            var agent = $('#agent').val();
            var search = $('#search').val();
            var start = $('#start').val();
            var end = $('#end').val();
            var status = $('#status').val();
            
            var url = "{{ route('Filter.Agents.Calls.Results') }}";
            
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    'type': type,
                    'agent': agent,
                    'search': search,
                    'start': start,
                    'end': end,
                    'status': status,
                },
                dataType: "json",
                success: function (data) {
                    // Handle the successful data here
                    $("#myTable").html("");
                    html = "";

                    $.each(data, function (index, val) {
                    if (val['agent'] !== null) {
                        html += "<tr>";
                        // Display the date of the latest call_count record
                        var latestCallCountDate = getLatestCallCountDate(val['call_count']);
                        // Format the date using toLocaleString
                        var formattedDate = new Date(latestCallCountDate).toLocaleString('en-US', {
                            day: 'numeric',
                            month: 'numeric',
                            year: 'numeric',
                            hour: 'numeric',
                            minute: 'numeric'
                        });
                        html += "<td>" + formattedDate + "</td>";
                        html += "<td>" + val['company_name'] + "</td>";
                        html += "<td>" + val['company_name'] + "</td>";
                        html += "<td><span class='btn btn-secondary'>" + val['agent']['name'] + "</span></td>";
                        html += "<td>" + val['call_count'].length + "</td>";
                        html += "<td>";
                        var lastStatusArray = val['last_status'];
                        if (lastStatusArray && lastStatusArray.length > 0) {
                            var connectStatus = lastStatusArray[0]['connectStatus'];
                            if (connectStatus !== null && connectStatus !== undefined) {
                                if (connectStatus === 'Connected') {
                                    html += "<span class='badge bg-success'>" + connectStatus + "</span>";
                                } else {
                                    html += "<span class='badge bg-danger'>" + connectStatus + "</span>";
                                }
                            } else {
                                html += "<span class='badge bg-warning'>No Connect Status</span>";
                            }
                        } else {
                            html += "N/A";
                        }
                        html += "</td>";
                        html += "<td>";
                            if (lastStatusArray && lastStatusArray.length > 0) {
                                html += "<button class='btn btn-info get-history' data-bs-toggle='modal' data-bs-target='#showModal' id=''>" +
                                "View History" +
                                "<input type='hidden' class='company_name' name='company_name' value='" + val['company_name'] + "'>" +
                                "<input type='hidden' class='company_id' name='company_id' value='" + val['id'] + "'>" +
                                "</button>"
                            } else {
                                html += "N/A";
                            }
                        html += "</td>";
                        html += "</tr>";
                        html += "<tr>";
                    }
                });
                    $("#myTable").html(html);


                },
                error: function (error) {
                // Handle errors here
                console.error("Error:", error);
                }
            });
            
        });

        $('.selectStatus').on('change', function() {
            var selectedStatus = $(this).val();

            // Show all rows initially
            $('#myTable tr').show();

            // If a specific status is selected, hide rows that don't match the selected status
            if (selectedStatus !== 'All') {
                $('#myTable tr').filter(function() {
                    return $(this).find('td:eq(5)').text() !== selectedStatus;
                }).hide();
            }
        });
    });

  </script>
  

 