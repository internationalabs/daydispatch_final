<!-- Breadcrumb Area -->
<div class="breadcrumb-area">
    <h1>{{ Auth::guard('Authorized')->user()->usr_type }} Payment Invoices</h1>

    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>

        <li class="item">Invoices</li>
    </ol>

</div>
<!-- End Breadcrumb Area -->
<div class="card">
    <div class="card-header">
        <h3>Dispatch Order Invoices List</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="display dataTable advance-6 datatable-range text-center w-100">
                <thead>
                <tr>
                    <th>Order Info</th>
                    <th>Payment Info</th>
                    <th>Assigned To</th>
                    <th>Assigned By</th>
                </tr>
                </thead>
                <tbody>
                @if(Auth::guard('Authorized')->user()->usr_type === 'Carrier')
                    @foreach($Dispatches_Invoices as $Inv)
                        <tr>
                            <td>
                                <strong>Status:</strong> {{ $Inv->all_listing->Listing_Status }}<br>
                                <strong>Order ID:</strong> {{ $Inv->all_listing->Ref_ID }}<br>
                                <strong>Created At:</strong> {{ $Inv->all_listing->created_at }}
                            </td>
                            <td>
                                <strong>Amount:</strong> ${{ $Inv->Payment }}<br>
                                <strong>Payment ID:</strong> {{ Str::limit($Inv->Payment_ID, 20) }}<br>
                                <strong>Paid At:</strong> {{ $Inv->created_at }} Using <b>{{ $Inv->Method }}</b>
                            </td>
                            <td>
                                <strong>Company Name:</strong> {{ $Inv->authorized_user->Company_Name }}<br>
                                <strong>Contact:</strong> {{ $Inv->authorized_user->Contact_Phone }}
                            </td>
                            <td>
                                <strong>Company Name:</strong> {{ $Inv->all_listing->authorized_user->Company_Name }}<br>
                                <strong>Contact:</strong> {{ $Inv->all_listing->authorized_user->Contact_Phone }}
                            </td>
                        </tr>
                    @endforeach
                @else
                    @foreach($Dispatches_Invoices as $Inv)
                        <tr>
                            <td>
                                <strong>Status:</strong> {{ $Inv->Listing_Status }}<br>
                                <strong>Order ID:</strong> {{ $Inv->Ref_ID }}<br>
                                <strong>Created At:</strong> {{ $Inv->created_at }}
                            </td>
                            <td>
                                <strong>Amount:</strong> ${{ $Inv->dispatch_fee->Payment }}<br>
                                <strong>Payment ID:</strong> {{ Str::limit($Inv->dispatch_fee->Payment_ID, 20) }}<br>
                                <strong>Paid At:</strong> {{ $Inv->dispatch_fee->created_at }} Using <b>{{ $Inv->dispatch_fee->Method }}</b>
                            </td>
                            <td>
                                <strong>Company Name:</strong> {{ $Inv->dispatch_fee->authorized_user->Company_Name }}<br>
                                <strong>Contact:</strong> {{ $Inv->dispatch_fee->authorized_user->Contact_Phone }}
                            </td>
                            <td>
                                <strong>Company Name:</strong> {{ $Inv->authorized_user->Company_Name }}<br>
                                <strong>Contact:</strong> {{ $Inv->authorized_user->Contact_Phone }}
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    // $('.advance-6').DataTable({
    //     "deferRender": true,
    // });
</script>
