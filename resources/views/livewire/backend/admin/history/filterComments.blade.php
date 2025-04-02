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
            left: 19% !important;
            top: 37% !important;
            margin: -20px 0 0 -20px;
        }

        div#reportrange {
            width: max-content;
            */ height: 95%;
        }
    </style>

    <div class="container mt-5">
        <h2>QA History Comments</h2>
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
                <select class="form-select selectStatus status-all-option updateOnChangeEvent" id="status"
                    name="status">
                    <option value="">All</option>
                    <option value="Positive">Positive</option>
                    <option value="Negative">Negative</option>
                </select>
            </div>

            <div class="col-sm-2">
                <input class="form-control" id="search" type="text" placeholder="Search Comment">
            </div>
            <div class="col-sm-2">
                <!--=========================================================new one==============================================-->
                <div id="reportrange"
                    style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; ">
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
                    <th>CommentBy</th>
                    <th>History</th>
                    <th>Comment</th>
                    <th>Status</th>
                    <th>CreatedAt</th>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <div class="modal-body">
                    <div class="message-feed media">
                        <div class="media-body">
                            <div class="mf-content w-100 history-content">
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

                var url = "{{ route('Filter.Comment.History.Results') }}";
                // var newValue = $(this).val();
                var type = $('#type').val();
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
                        'search': search,
                        'status': status
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log('data1', data);
                        $("#myTable").html("");
                        html = "";

                        $.each(data, function(index, val) {
                            html += "<tr>";
                            var latestCallCountDate = val['created_at'];
                            var formattedDate = new Date(latestCallCountDate)
                                .toLocaleString('en-US', {
                                    day: 'numeric',
                                    month: 'numeric',
                                    year: 'numeric',
                                    hour: 'numeric',
                                    minute: 'numeric'
                                });
                            html += "<td>" + val['user']['name'] + "</td>";
                            html += "<td>" +
                                "<button class='btn btn-info get-history' data-bs-toggle='modal' data-bs-target='#showModal'>" +
                                "View History" +
                                "<input type='hidden' class='company_id' name='company_id' value='" +
                                val['id'] + "'>" +
                                "</button>" +
                                "</td>";
                            html += "<td>" + val['comment'] + "</td>";
                            html += "<td>" + val['status'] + "</td>";
                            html += "<td>" + formattedDate + "</td>";
                        });
                        $("#myTable").html(html);
                    },
                    error: function(error) {
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
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, cb);

            cb(start, end);
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
            });

            $(".updateOnChangeEvent").on("change", function() {
                // Get the new value of the changed input
                var newValue = $(this).val();
                var type = $('#type').val();
                var search = $('#search').val();
                var start = $('#start').val();
                var end = $('#end').val();
                var status = $('#status').val();

                // Determine which input triggered the change event
                var inputId = $(this).attr("id");

                var url = "{{ route('Filter.Comment.History.Results') }}";

                $.ajax({
                    type: "GET",
                    url: url,
                    data: {
                        'newValue': newValue,
                        'type': type,
                        'inputId': inputId,
                        'search': search,
                        'start': start,
                        'end': end,
                        'status': status
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log('data2', data);
                        // Handle the successful data here
                        $("#myTable").html("");
                        html = "";

                        $.each(data, function(index, val) {
                            html += "<tr>";
                            var latestCallCountDate = val['created_at'];
                            var formattedDate = new Date(latestCallCountDate)
                                .toLocaleString('en-US', {
                                    day: 'numeric',
                                    month: 'numeric',
                                    year: 'numeric',
                                    hour: 'numeric',
                                    minute: 'numeric'
                                });
                            html += "<td>" + val['user']['name'] + "</td>";
                            html += "<td>" +
                                "<button class='btn btn-info get-history' data-bs-toggle='modal' data-bs-target='#showModal'>" +
                                "View History" +
                                "<input type='hidden' class='company_id' name='company_id' value='" +
                                val['id'] + "'>" +
                                "</button>" +
                                "</td>";
                            html += "<td>" + val['comment'] + "</td>";
                            html += "<td>" + val['status'] + "</td>";
                            html += "<td>" + formattedDate + "</td>";
                        });
                        $("#myTable").html(html);


                    },
                    error: function(error) {
                        // Handle errors here
                        console.error("Error:", error);
                    }
                });

            });

            $("#myTable").on("click", ".get-history", function() {
                console.log('Yesyes');
                var CompanyName = $(this).find('.company_name').val();
                var historyId = $(this).find('.company_id').val();
                $(".compName").html(CompanyName);

                if ($('#type').val() == 'Carrier') {
                    url = `{{ route('get.single.CarrierHistory') }}`;
                } else if ($('#type').val() == 'Logistic Broker') {
                    url = `{{ route('get.single.LogBrokerHistory') }}`;
                } else if ($('#type').val() == 'Logistic Carrier') {
                    url = `{{ route('get.single.LogCarrierHistory') }}`;
                } else if ($('#type').val() == 'Logistic Shipper') {
                    url = `{{ route('get.single.LogShipperHistory') }}`;
                }

                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        'historyId': historyId
                    },
                    success: function(data) {
                        console.log('data3', data);
                        html = "";
                        // $.each(data, function(index, val) {
                            // Assuming val['created_at'] is a string representation of the date
                            var createdAt = new Date(data['created_at']);

                            // Format the date
                            var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                                "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                            ];
                            var formattedDate = monthNames[createdAt.getMonth()] + "," +
                                ("0" + createdAt.getDate()).slice(-2) + " " +
                                createdAt.getFullYear() + " " +
                                ("0" + createdAt.getHours()).slice(-2) + ":" +
                                ("0" + createdAt.getMinutes()).slice(-2) +
                                (createdAt.getHours() >= 12 ? " PM" : " AM");

                            // Append formatted date to HTML
                            html += "<h6>" + data['user']['name'] + "</h6>";
                            html += "<h6>" + data['connectStatus'] + "</h6>";
                            html += "<h6>" + data['comment'] + ".</h6>";
                            html +=
                                "<strong class='mf-date'><i class='fa fa-clock-o'></i>" +
                                formattedDate + "</strong> <hr>";
                        // });
                        $(".history-content").html(html);
                    },
                    error: function(data) {
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
                var search = $('#search').val();
                var start = $('#start').val();
                var end = $('#end').val();
                var status = $('#status').val();

                var url = "{{ route('Filter.Comment.History.Results') }}";

                $.ajax({
                    type: "GET",
                    url: url,
                    data: {
                        'type': type,
                        'search': search,
                        'start': start,
                        'end': end,
                        'status': status,
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log('data4', data);
                        // Handle the successful data here
                        $("#myTable").html("");
                        html = "";

                        $.each(data, function(index, val) {
                            html += "<tr>";
                            var latestCallCountDate = val['created_at'];
                            var formattedDate = new Date(latestCallCountDate)
                                .toLocaleString('en-US', {
                                    day: 'numeric',
                                    month: 'numeric',
                                    year: 'numeric',
                                    hour: 'numeric',
                                    minute: 'numeric'
                                });
                            html += "<td>" + val['user']['name'] + "</td>";
                            html += "<td>" +
                                "<button class='btn btn-info get-history' data-bs-toggle='modal' data-bs-target='#showModal'>" +
                                "View History" +
                                "<input type='hidden' class='company_id' name='company_id' value='" +
                                val['id'] + "'>" +
                                "</button>" +
                                "</td>";
                            html += "<td>" + val['comment'] + "</td>";
                            html += "<td>" + val['status'] + "</td>";
                            html += "<td>" + formattedDate + "</td>";
                        });
                        $("#myTable").html(html);


                    },
                    error: function(error) {
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
