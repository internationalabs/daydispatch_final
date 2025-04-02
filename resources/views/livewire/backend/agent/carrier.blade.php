<style>
    .tab-pane.active {
        display:block;
    }
    .tab-pane {
        display:none;
    }
    .btn-success.active {
        display:block;
    }
    .btn-success {
        dispaly:none
    }

.mf-content.w-100 {
    background: #8080802e;
    padding: 20px;
}
div#tab2 {
    overflow-y: scroll;
}
.modal-dialog.modal-dialog-centered {
    max-width: 50%;
}
.modal-backdrop.fade.show {
    width: 100%;
    height: 100%;
}
</style>




<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">User Profiles</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('Agent.Dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">User Profiles</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">All Carriers List</h5>
    </div>
    <div class="card-body">
        <table id="" class="table table-striped align-middle text-center"
               style="width:100%">
            <thead>
            <tr>
                <th>Company Name</th>
                <th>Address</th>
                <th>Main Number</th>
                <th>Local Number</th>
                <th>Truck</th>
                <th>Equipment</th>
                <th>Other Detail</th>
                <th>Route Description</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($carrier as $List)
                    <tr>
                        <td>{{ $List->company_name }}</td>
                        <td>{{ $List->address }}</td>
                        <td>
                            <button class="btn btn-primary call-count" onclick="document.location.href = 'tel:{{ $List->main_number }}'">
                                <input type="hidden" name="company_id" class="company_id"value="{{ $List->id }}">
                                {{ Str::mask($List->main_number, '*', 0, 12) }}
                                <input type="hidden" name="num" class="num" value="Main Number">
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-primary call-count" onclick="document.location.href = 'tel:{{ $List->local_number }}'">
                                <input type="hidden" name="company_id" class="company_id"value="{{ $List->id }}">
                                {{ Str::mask($List->local_number, '*', 0, 12) }}
                                <input type="hidden" name="num" class="num" value="Local Number">
                            </button>
                        </td>
                        <td>{{ $List->truck }}</td>
                        <td>{{ $List->equipment }}</td>
                        <td>{{ $List->other_details }}</td>
                        <td>{{ $List->route_description }}</td>
                        <td>
                            <div class="dropdown d-inline-block">
                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false"> Actions
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item add-history" data-bs-toggle="modal" data-bs-target="#addHistory"><i
                                            class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                            <input hidden type="text" class="History-ID" value="{{ $List->id }}">
                                            Add History</a>
                                        {{-- <a class="dropdown-item"><i
                                            class="ri-eye-fill align-bottom me-2 text-muted"></i> View History</a> --}}
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3">
            @if (!empty($carrier))
                {{ $carrier->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
            @endif

        </div>
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="addHistory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header bg-soft-info p-3">
                <h5 class="modal-title" id="exampleModalLabel">Add History For: <span class="permission_id"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form id="addHistoryForm" action="{{ route('Agent.carriers.History.Store') }}" method="POST" class="needs-validation" novalidate class="tablelist-form" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="permission" value=""class="permission_val">
                    <div class="row g-3">
                        <div class="row">

                            <!--=============new===============-->
                                   <div class=" tab-menu-heading p-0 bg-light">
                <div class="tabs-menu1 ">
                    <!-- Tabs -->
                    <ul class="nav panel-tabs  gap-2">
                        <li class=""><a href="#tab1" class="active btn btn-success" data-toggle="tab">HISTORY/STATUS</a>
                        </li>
                        <li><a href="#tab2" data-toggle="tab" class="btn btn-success">VIEW HISTORY</a></li>
                        <li></li>
                        <li class="position-relative">
                        </li>
                    </ul>
                </div>
            </div>
             </div>

                           <div class="tab-pane active" id="tab1">
                                <div class="row">

                                          <div class="col-lg-4">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="connected"
                                           name="connectStatus" value="Connected" checked>
                                    <label class="custom-control-label form-label" for="connected">Connected</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="custom-control custom-radio mb-3">
                                    <input type="radio" class="custom-control-input" id="notConnected"
                                           name="connectStatus" value="Not Connected">
                                    <label class="custom-control-label form-label" for="notConnected">Not Connected</label>
                                </div>
                            </div>

                                    <div/>
                        <div class="col-lg-12">
                            <div>
                                <label for="label-field" class="form-label">Add Comments</label>
                                <textarea rows="3" name="comment" id="comment"
                                    placeholder="Enter Comments" class="form-control"></textarea>
                            </div>
                        </div>
                          </div>
                    </div>
                      <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="add-btn close">Save</button>
                    </div>
                </div>
                </div>
            </form>


                    <div class="tab-pane" id="tab2">
                        <div class="chat-body-style ChatBody" id="calhistory" style=" height:300px;">

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
                    </div>


                        <script>
                            $("#close").on('submit', function () {
                                $(this).children('button[type="submit"]').attr([disabled, true]);
                            })
                        </script>
        </div>
    </div>
</div>
</div>
</div>

<script>


    // ======================modal js==============================

    document.addEventListener('DOMContentLoaded', function () {
        var tabLinks = document.querySelectorAll('.panel-tabs a');

        // Activate the default tab
        var defaultTab = document.querySelector('.panel-tabs .active');
        document.querySelector(defaultTab.getAttribute('href')).classList.add('active');

        tabLinks.forEach(function (tabLink) {
            tabLink.addEventListener('click', function (event) {
                event.preventDefault();

                // Deactivate all tabs
                tabLinks.forEach(function (link) {
                    link.classList.remove('active');
                });

                var tabs = document.querySelectorAll('.tab-pane');
                tabs.forEach(function (tab) {
                    tab.classList.remove('active');
                });

                // Activate the clicked tab
                this.classList.add('active');
                document.querySelector(this.getAttribute('href')).classList.add('active');
            });
        });
    });
    // ======================modal js==============================


    // Get Profile Info Functionality For History
    $(document).ready(function () {

        $(".add-history").click(function () {
            var HistoryID = $(this).find('.History-ID').val();
            $(".permission_id").html(HistoryID);
            $(".permission_val").val(HistoryID);
            // console.log(HistoryID);

            $.ajax({
                url: '{{ route('Agent.carriers.Retrieve.History') }}',
                type: 'GET',
                data: {
                    'HistoryID': HistoryID
                },
                success: function (data) {
                    console.log('datas', data);
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

        // OnClick Main Number add count
        $(".call-count").click(function () {
            var Num = $(this).find('.num').val();
            var company = $(this).find('.company_id').val();
            console.log('call-count', Num);

            $.ajax({
                url: '{{ route('Agent.carriers.Call.Count') }}',
                type: 'GET',
                data: {
                    'Num': Num,
                    'company': company
                },
                success: function (data) {
                    console.log('Count Added');
                },
                error: function (data) {
                    console.log(data);
                }

            });
        });

        // Add history with ajax
        $("#addHistoryForm").submit(function (e) {
            e.preventDefault(); // Prevent the default form submission

            // Serialize the form data
            var formData = $(this).serialize();

            // Perform AJAX submission
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                success: function (data) {
                    // Handle the success response
                    console.log('Form submitted successfully');
                    //showing history
                    $(".history-content").html('');
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
                    // resetting form
                    $('#addHistoryForm')[0].reset();
                },
                error: function (error) {
                    // Handle the error response
                    console.error('Error submitting the form:', error);
                    // Optionally, you can display an error message or take other actions
                }
            });
        });
    });
</script>



