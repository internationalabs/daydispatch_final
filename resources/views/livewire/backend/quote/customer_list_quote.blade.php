@section('Listing', 'mm-active')
@php
    use Illuminate\Support\Facades\Auth;
    $currentUser = Auth::guard('Authorized')->user();
@endphp
@php
    use Illuminate\Support\Str;
@endphp
<div class="breadcrumb-area">
    <h1>{{ $currentUser->usr_type }} Customer </h1>
    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>
        <li class="item">List</li>
    </ol>
</div>
<style>
    .custom-nav {
        background-color: #f9f9f9;
        border-radius: 10px;
        padding: 10px 0;
        width: 100%;
        margin: 20px auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .custom-tab {
        text-align: center;
        padding: 12px 20px;
        margin: 5px;
        background-color: #fff;
        border: 2px solid #e01f26;
        color: #e01f26;
        border-radius: 5px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .custom-tab:hover {
        background-color: #e01f26;
        color: #fff;
    }

    .active-tab {
        background-color: #e01f26;
        color: #fff;
        border: 2px solid #e01f26;
    }

    @media (max-width: 768px) {
        .custom-nav {
            width: 90%;
        }

        .custom-tab {
            font-size: 14px;
            padding: 10px;
        }
    }

    .status-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 16px;
        text-align: left;
    }

    .status-table thead tr {
        background-color: #e01f26;
        color: white;
        text-align: left;
    }

    .status-table th,
    .status-table td {
        padding: 12px 15px;
        border: 1px solid #ddd;
        text-align: center;
    }

    .status-table tbody tr:nth-of-type(odd) {
        background-color: #f3f3f3;
    }

    .status-table tbody tr:hover {
        background-color: #f1f1f1;
    }

    .status-text {
        font-weight: bold;
        color: #333;
    }

    .date-text {
        color: #333;
    }

    .description-text {
        color: #333;
    }

    @media screen and (max-width: 600px) {
        .status-table {
            font-size: 14px;
        }
    }

    #modalbody {
        display: none;
    }

    .text-primary.font-weight-bold {
        color: #1e2d62;
    }

    @media only screen and (max-width: 1200px) {
        .margin-media-query {
            margin-bottom: 35px;
        }
    }

    .fs-30 {
        font-size: 20px;
        font-size: 20px;
        margin-block: 7px;
        vertical-align: inherit;
    }

    .new-tag {
        background-color: #ff0000;
        color: #ffffff;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .ribbon-box .ribbon-two {
        position: absolute;
        top: -8px;
        z-index: 1;
        overflow: hidden;
        width: 65px;
        height: 67px;
        text-align: right;
        left: -11px;
        clip-path: polygon(13% 0, 116% 0, 0 103%, 0 103%);
        display: block;
    }

    button.ribbon-box {
        border: none;
    }

    .ribbon-box .ribbon-two span {
        font-size: 13px;
        color: #fff;
        text-align: center;
        line-height: 20px;
        -webkit-transform: rotate(-45deg);
        transform: rotate(-45deg);
        width: 100px;
        display: block;
        -webkit-box-shadow: 0 0 8px 0 rgba(0, 0, 0, .06), 0 1px 0 0 rgba(0, 0, 0, .02);
        box-shadow: 0 0 8px 0 rgba(0, 0, 0, .06), 0 1px 0 0 rgba(0, 0, 0, .02);
        position: absolute;
        top: 19px;
        left: -21px;
        font-weight: 500;
    }

    .ribbon-box .ribbon-two-danger span {
        background: #078528;
    }

    form#searchForm {
        position: relative;
    }

    .ribbon-box.right.ribbon-box .ribbon-two span {
        left: auto;
        right: -21px;
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>
<!-- End Breadcrumb Area -->
@include('partials.quote-global-search')
<div class="card">
    <div class="card-body">
        <br>
        <div class="table-responsive dataTables_wrapper me-0 d-flex">
        </div>
        <div class="table-responsive">
            <form method="GET" action="{{ request()->url() }}" class="d-flex align-items-center mb-3">
                <label class="me-2">Show</label>
                <select name="per_page" class="form-select w-auto" onchange="this.form.submit()">
                    @foreach ([10, 25, 50, 100] as $size)
                        <option value="{{ $size }}" {{ request('per_page', 10) == $size ? 'selected' : '' }}>
                            {{ $size }}
                        </option>
                    @endforeach
                </select>
                <label class="ms-2">entries</label>
            </form>

            <table class="display carrier dataTable text-center table-1 table-bordered table-cards">
                <thead class="table-header">
                    <tr>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Number of Quote</th>
                        <th>Customer Since</th>
                        <th>Last Shipment</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Customer_List as $Customer)
                        @php
                            $details = $shipmentDetails[$Customer->Customer_Phone] ?? null;
                        @endphp
                        <tr class="card-row" data-status="active">
                            {{-- <td>
                                <a class="text-primary text-decoration-none fw-bold load-history d-flex align-items-center gap-2"
                                    href="javascript:void(0)"
                                    onclick="loadCustomerHistory({{ $Customer->id }}, '{{ $Customer->Customer_Phone }}')">
                                    <i class="fas fa-user-circle"></i> <!-- FontAwesome Icon -->
                                    <span>{{ $Customer->Customer_Name }}</span>
                                </a>
                            </td> --}}
                            <td>
                                <a class="text-decoration-none fw-bold load-history d-flex align-items-center gap-2" style="color: #001d4d"
                                    href="javascript:void(0)">
                                    <input hidden type="text" class="Listed-ID"
                                        value="{{ $Customer->id }}">
                                    <input hidden type="text" class="Listed-Phone"
                                        value="{{ $Customer->Customer_Phone }}">
                                    <i class="fas fa-user-circle"></i>
                                    <span>{{ $Customer->Customer_Name }}</span>
                                </a>
                            </td>
                            <td><a href="mailto:{{ $Customer->Customer_Email }}">{{ $Customer->Customer_Email }}</a></td>
                            <td><a href="tel:{{ $Customer->Customer_Phone }}">{{ $Customer->Customer_Phone }}</a></td>
                            <td>{{ $details ? $details->shipment_count : 0 }}</td>
                            <td>{{ \Carbon\Carbon::parse($Customer->first_shipment_date)->diffForHumans() }}</td>
                            <td>{{ $details ? \Carbon\Carbon::parse($details->last_shipment_date)->format('d M, Y') : 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">
                {{ $Customer_List->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
