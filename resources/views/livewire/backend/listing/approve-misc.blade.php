<main>
    <div class="row">
        <div class="col-md-12">
                <section>
                        <h2>
                            Misc. Payments
                        </h2>
                        <p>
                            To search for a company, enter their full or partial name below. Click the company's name to rate them or veiw their profile
                        </p>
                        <hr />
                </section>
                <section>
                    <table class="display dataTable advance-6 text-center w-100 no-footer">
                        <thead>
                            <tr>
                                <th>Company</th>
                                <th>Item Name</th>
                                <th>Order ID</th> {{-- List's ref id --}}
                                <th>Item Price</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Listing as $List)
                                <tr>
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
                                    <td>
                                        <a href="{{ route('Update.Misc.Status', [$List->id, 1]) }}" class="btn btn-success">Approve</a>
                                        <a href="{{ route('Update.Misc.Status', [$List->id, 2]) }}" class="btn btn-danger">Reject</a>
                                        {{-- <a href="JavaScript:void(0);" class="btn btn-success" onclick="miscStatus({{ $List->id }}, 1)">Approve</a>
                                        <a href="JavaScript:void(0);" class="btn btn-danger" onclick="miscStatus({{ $List->id }}, 2)">Reject</a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
        </div>
    </div>
</main>