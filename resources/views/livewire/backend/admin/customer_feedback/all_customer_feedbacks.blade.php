@extends('layouts.authorized-admin')

@section('content')
    <style>
        .tab-pane.active {
            display: block;
        }

        .tab-pane {
            display: none;
        }

        .btn-success.active {
            display: block;
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

    <!-- Start Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Customer Feedbacks</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('Agent.Dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Customer Feedbacks</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Title -->

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h5 class="card-title mb-0">All Customer Feedbacks</h5>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="mb-4">
                <div class="row">
                    <!-- Type Filter -->
                    <div class="col-md-4">
                        <label for="filterType">User Type</label>
                        <select id="filterType" class="form-control">
                            <option value="">All User Types</option>
                            <option value="Broker">Broker</option>
                            <option value="Carrier">Carrier</option>
                            <option value="Shipper">Shipper</option>
                        </select>
                    </div>

                    <!-- User Name Filter -->
                    <div class="col-md-4">
                        <label for="filterName">User Name</label>
                        <input type="text" id="filterName" class="form-control" placeholder="Search Name">
                    </div>

                    <!-- Company Filter -->
                    <div class="col-md-4">
                        <label for="filterCompany">Company Name</label>
                        <input type="text" id="filterCompany" class="form-control" placeholder="Search Company">
                    </div>
                </div>
            </div>
            <table class="table table-striped align-middle text-center" id="customerFeedbacksTable">
                <thead>
                    <tr>
                        <th>User Type</th>
                        <th>User Name</th>
                        <th>Company Name</th>
                        <th>Feedback</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($AllFeedBacks as $feedback)
                        <tr>
                            <td>{{ $feedback->authorized_user->usr_type }}</td>
                            <td>{{ $feedback->authorized_user->name }}</td>
                            <td>{{ $feedback->authorized_user->Company_Name }}</td>
                            <td>{{ $feedback->feedback }}</td>
                            <td>{{ $feedback->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    
    <script>
        $(document).ready(function() {
            // Initialize DataTables
            var table = $('#customerFeedbacksTable').DataTable();

            // Apply filters when values are changed
            $('#filterType').on('change', function() {
                table.column(0).search(this.value).draw();
            });

            $('#filterName').on('keyup', function() {
                table.column(1).search(this.value).draw();
            });

            $('#filterCompany').on('keyup', function() {
                table.column(2).search(this.value).draw();
            });
        });
    </script>
@endsection
