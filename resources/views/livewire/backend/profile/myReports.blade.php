<!-- Include Required Prerequisites -->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<style>
  .my-report span {
    font-size: 11px;
    color: #fff;
    background: green;
  }

  .rounded {
    margin-left: 10px;
    font-size: 12px;
  }

  .showQuotes {
    display: flex;
    flex-direction: columns;
    font-size: 14px;
  }

  .txt {
    width: 100%;
    padding: 6px 10px;
    border-radius: 4px;
    border: 1px solid gray;
    box-shadow: 0 0 10px 0 whitesmoke;
    margin-bottom: 20px;
  }

  .card .card-header {
    padding: 13px;
    border-radius: 2px;
  }

  .ranges li.active,
  .ranges li:hover {
    background-color: #e01f26;
    border: 1px solid #e01f26;
  }

  .daterangepicker td.active,
  .daterangepicker td.active:hover {
    background: #e01f26;
    border-radius: 50% !important;
    padding: 5px 8px;
  }

  .ranges li {
    color: black;
  }

  .sidemenu-area .sidemenu-body .sidemenu-nav .nav-item .nav-link .badge {
    background: var(--greencolor) !important;
    border-color: var(--greencolor) !important;
  }

  .my-report {
    margin-top: 20px;
  }

  .btn-success {
    background: var(--greencolor) !important;
    border-color: var(--greencolor) !important;
  }

  .daterangepicker_input .fa-calendar {
    position: absolute;
    left: 10px;
    top: 5px;
  }
</style>
@php
    use Illuminate\Support\Facades\Auth;
    $currentUser = Auth::guard('Authorized')->user();
@endphp
<div class="container py-5 w">
  <div class="row">
    <div class="col-md-12">
      <label>Daterange</label>
      <!--<input type="text" class="form-control" placeholder="Daterange" style="margin-bottom: 20px;" />-->
      <div class="row">
        <div class="col s4 l10">
          <div  class="pull-left"  id="reportrange" style="
              background: #fff;
              cursor: pointer;
              padding: 5px 10px;
              border: 1px solid #ccc;
              width: 100%;
            ">
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
            <span></span> <b class="caret"></b>
          </div>
        </div>
      </div>
    </div>
    <div class="card body w-100 my-report">
      <div class="row">
        <input type="hidden" name="start_Date" id="start_DateVal" value="">
        <input type="hidden" name="end_Date" id="end_DateVal" value="">
        <div class="col-md-4 checkType">
          <div class="card-header d-flex justify-content-center text-capitalize bg-light showQuotes bg-dark text-light"
            data-value="0">
            Listing
            <span class="rounded badge badge-success ml-2"><span id="Listed">{{ $orderCount['Listed'] }}</span>
            </span>
          </div>
        </div>

        <div class="col-md-4 checkType">
          <div class="card-header d-flex justify-content-center text-capitalize bg-light showQuotes bg-dark text-light"
            data-value="0">
            Requested
            <span class="rounded badge badge-success ml-2"><span id="Requested">{{ $orderCount['Requested'] }}</span>
            </span>
          </div>
        </div>

        <div class="col-md-4 checkType">
          <div class="card-header d-flex justify-content-center text-capitalize bg-light showQuotes bg-dark text-light"
            data-value="0">
            Waiting Approval
            <span class="rounded badge badge-success ml-2"><span id="Waiting_Approval">{{ $orderCount['Waiting_Approval'] }}</span>
            </span>
          </div>
        </div>
        <div class="col-md-4 checkType">
          <div class="card-header d-flex justify-content-center text-capitalize bg-light showQuotes bg-dark text-light"
            data-value="0">
            Dispatch
            <span class="rounded badge badge-success ml-2"><span id="Dispatch">{{ $orderCount['Dispatch'] }}</span>
            </span>
          </div>
        </div>
        <div class="col-md-4 checkType">
          <div class="card-header d-flex justify-content-center text-capitalize bg-light showQuotes bg-dark text-light"
            data-value="0">
            Pickup Approval
            <span class="rounded badge badge-success ml-2"><span id="PickUp_Approval">{{ $orderCount['PickUp_Approval'] }}</span>
            </span>
          </div>
        </div>
        <div class="col-md-4 checkType">
          <div class="card-header d-flex justify-content-center text-capitalize bg-light showQuotes bg-dark text-light"
            data-value="0">
            Pickup
            <span class="rounded badge badge-success ml-2"><span id="PickUp">{{ $orderCount['PickUp'] }}</span>
            </span>
          </div>
        </div>

        <div class="col-md-4 checkType">
          <div class="card-header d-flex justify-content-center text-capitalize bg-light showQuotes bg-dark text-light"
            data-value="0">
            Deliver Approval
            <span class="rounded badge badge-success ml-2"><span id="Deliver_Approval">{{ $orderCount['Deliver_Approval'] }}</span>
            </span>
          </div>
        </div>
        <div class="col-md-4 checkType">
          <div class="card-header d-flex justify-content-center text-capitalize bg-light showQuotes bg-dark text-light"
            data-value="0">
            Delivered
            <span class="rounded badge badge-success ml-2"><span id="Delivered">{{ $orderCount['Delivered'] }}</span>
            </span>
          </div>
        </div>
        <div class="col-md-4 checkType">
          <div class="card-header d-flex justify-content-center text-capitalize bg-light showQuotes bg-dark text-light"
            data-value="0">
            Completed
            <span class="rounded badge badge-success ml-2"><span id="Completed">{{ $orderCount['Completed'] }}</span>
            </span>
          </div>
        </div>
        <div class="col-md-4 checkType">
          <div class="card-header d-flex justify-content-center text-capitalize bg-light showQuotes bg-dark text-light"
            data-value="0">
            Cancelled
            <span class="rounded badge badge-success ml-2"><span id="Cancelled">{{ $orderCount['Cancelled'] }}</span>
            </span>
          </div>
        </div>

        <div class="col-md-4 checkType">
          <div class="card-header d-flex justify-content-center text-capitalize bg-light showQuotes bg-dark text-light"
            data-value="0">
            Archived
            <span class="rounded badge badge-success ml-2"><span id="Archived">{{ $orderCount['Archived'] }}</span>
            </span>
          </div>
        </div>
        <div class="col-md-4 checkType">
          <div class="card-header d-flex justify-content-center text-capitalize bg-light showQuotes bg-dark text-light"
            data-value="0">
            My Watchlist
            <span class="rounded badge badge-success ml-2"><span id="WatchList">{{ $orderCount['WatchList'] }}</span>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div id="getData">

    </div>
  </div>
</div>
<!-- Processing Modal -->
<div class="modal fade" id="processingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h5 id="modalMessage">Processing...</h5>
        <div class="spinner-border text-primary" role="status" id="loadingSpinner">
          <span class="visually-hidden">Loading...</span>
        </div>
        <div id="errorMessage" class="text-danger mt-2" style="display: none;"></div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
<script>
  function cb(start, end, first) {
    $("#reportrange span").html(
      start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
    );
    let getval = moment();
    if (first != 'first')
    {
      if (start.format("MMMM D, YYYY") == end.format("MMMM D, YYYY")) {
        var start_Date = start.format("MMMM D, YYYY");
        var end_Date = end.add(1, "days").format("MMMM D, YYYY");
        // console.log('asdasd',start_Date ,end_Date);
      } else {
        var start_Date = start.format("MMMM D, YYYY");
        var end_Date = end.format("MMMM D, YYYY");
      }

      $('#start_DateVal').val(start_Date);
      $('#end_DateVal').val(end_Date);
        // console.log('sets', start_Date , end_Date);
        var url = "{{ route('View.MyReports.GetCount') }}";
        console.log($('#start_DateVal').val(), 'ssssss');
        $.ajax({
                url: url,
                type: 'GET',
                data: {
                    'start_Date': start_Date,
                    'end_Date': end_Date
                },
                success: function (data) {
                    data = JSON.parse(data);

                    $('#Listed').html(data.Listed.length);
                    $('#Requested').html(data.Requested.length);
                    $('#Waiting_Approval').html(data.Waiting_Approval.length);
                    $('#Dispatch').html(data.Dispatch.length);
                    $('#PickUp_Approval').html(data.PickUp_Approval.length);
                    $('#PickUp').html(data.PickUp.length);
                    $('#Deliver_Approval').html(data.Deliver_Approval.length);
                    $('#Delivered').html(data.Delivered.length);
                    $('#Completed').html(data.Completed.length);
                    $('#Cancelled').html(data.Cancelled.length);
                    $('#Archived').html(data.Archived.length);
                    $('#WatchList').html(data.WatchList.length);

                    console.log('datasss', data);
                },
                error: function (data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                }
    
            });
    }



  }
  cb(moment().subtract(29, "days"), moment(),"first");
   
  $("#reportrange").daterangepicker(
    {
      ranges: {
        Today: [moment(), moment()],
        Yesterday: [moment().subtract(1, "days"), moment()],
        "Last 7 Days": [moment().subtract(6, "days"), moment()],
        "Last 30 Days": [moment().subtract(29, "days"), moment()],
        "This Month": [moment().startOf("month"), moment().endOf("month")],
        "Last Month": [
          moment().subtract(1, "month").startOf("month"),
          moment().subtract(1, "month").endOf("month"),
        ],
      },
    },
    cb
    );

    $(document).ready(function() {
    $('.checkType').on('click', function () {
        var typeCheck = $(this).find('span[id]').attr('id');
        var start_Date = $('#start_DateVal').val();
        var end_Date = $('#end_DateVal').val();

         // Show the modal
          $('#processingModal').modal('show');
          $('#modalMessage').text('Processing...');
          $('#loadingSpinner').show();
          $('#errorMessage').hide().text('');
          
        $.ajax({
            url: '{{ route("get.list.data") }}',
            type: 'GET',
            data: {
                'typeCheck': typeCheck,
                'start_Date': start_Date,
                'end_Date': end_Date
            },
            success: function (data) {
                console.log('HTML content:', data);
                $('#getData').html(data);
                $('#getData').html(data);

                // Hide the modal when request is successful
                $('#processingModal').modal('hide');
            },
            error: function (data) {
                var errors = data.responseJSON;
                console.log('errors', errors);
                $('#modalMessage').text('An error occurred!');
                $('#loadingSpinner').hide();
                $('#errorMessage').show().text(xhr.responseText);

                // Hide modal after 3 seconds
                setTimeout(function () {
                    $('#processingModal').modal('hide');
                }, 3000);
            }
        });
    });
});
</script>