@php
    use Illuminate\Support\Facades\Auth;
    $currentUser = Auth::guard('Authorized')->user();
@endphp
<main>
    <div class="row">
        <div class="col-md-12">
            <section>
                <h2>
                    Misc. Payments
                </h2>
                <p>
                    To search for a company, enter their full or partial name below. Click the company's name to rate
                    them or veiw their profile
                </p>
                <hr />
            </section>
            <section>
                <table class="display dataTable advance-6 table-1 text-center table-bordered table-cards">
                    <thead class="table-header">
                        <tr>
                            <th>Company</th>
                            <th>Item Name</th>
                            <th>Order ID</th>
                            <th>Item Price</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $List)
                            <tr class="card-row" data-status="active">
                                <td>
                                    {{ $List->authorized_user->Company_Name }}<br>
                                    <strong>
                                        <a href="{{ route('View.Agreement', ['List_ID' => $List->all_listing->id]) }}"
                                            target="_blank">View Contract</a>
                                    </strong>
                                </td>
                                <td>{{ $List->Item_Name }}</td>
                                <td>{{ $List->all_listing->Ref_ID }}</td>
                                <td>{{ $List->Item_Price }}</td>
                                <td>{{ $List->created_at }}</td>
                                {{-- <td>
                                    @if ($List->status == 0)
                                        <a href="{{ route('Update.Misc.Status', [$List->id, 1]) }}"
                                            class="btn btn-success">Approve</a>
                                        <a href="{{ route('Update.Misc.Status', [$List->id, 2]) }}"
                                            class="btn btn-danger">Reject</a>
                                    @elseif ($List->status == 1)
                                        <span class="text-success" disabled>Accepted</span>
                                    @elseif ($List->status == 2)
                                        <span class="text-danger" disabled>Rejected</span>
                                    @endif
                                </td> --}}
                                <td>
                                    @if ($List->status == 0)
                                        @if ($currentUser->usr_type === 'Carrier')
                                            <span class="text-secondary" title="This item is pending approval">
                                                <i class="fas fa-clock"></i> Pending
                                            </span>
                                        @else
                                            <a href="{{ route('Update.Misc.Status', [$List->id, 1]) }}"
                                                class="btn btn-success" title="Approve">
                                                <i class="fas fa-check"></i>
                                            </a>
                                            <a href="{{ route('Update.Misc.Status', [$List->id, 2]) }}"
                                                class="btn btn-danger" title="Reject">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        @endif
                                    @elseif ($List->status == 1)
                                        <span class="text-success">
                                            <i class="fas fa-check-circle"></i> Accepted
                                        </span>
                                    @elseif ($List->status == 2)
                                        <span class="text-danger">
                                            <i class="fas fa-times-circle"></i> Rejected
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</main>

<script>
    // function miscStatus(list, status) {

    //     console.log(list, status);
    //     console.log(url);
    //     // $.ajax({
    //     //     url: url,
    //     //     type: 'GET',
    //     //     data: {
    //     //         'Listed_ID': getListedID,
    //     //         'Listed_Type': getListedType,
    //     //         'Listed_Miles': getListedMiles
    //     //     },
    //     //     success: function (data) {
    //     //         $('#all-fetch-comparison').html(data);
    //     //         // $('.carrier-all-request').DataTable();
    //     //     },
    //     //     error: function (data) {
    //     //         alert(data.responseJSON);
    //     //     }

    //     // });

    // };
</script>
