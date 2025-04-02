<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Payment Settings</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('Admin.Dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Payment Settings</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<div class="card">
    <div class="card-body p-4">
        <div class="mb-3">
            <h5 class="card-title text-decoration-underline mb-3">Payments Switches For Users.</h5>
            <ul class="list-unstyled mb-0">
                <form class="row g-3 needs-validation" novalidate>
                    <p>Only the registration fee and the vehicle fee are worked as dollar amounts; the rest of the work
                        is done as a percentage.</p>
                    @forelse($Payment_Switches as $Payment)
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="Switch_{{ $Payment->id }}"
                                       class="form-label">{{ $Payment->Payment_Type }}</label>
                                <input readonly type="text" class="form-control" id="Switch_{{ $Payment->id }}"
                                       value="{{ $Payment->Payment_Type }}" required>
                                <div class="invalid-feedback">
                                    Please Enter Payment Type.
                                </div>
                            </div>
                            <div class="col-md-3 mb-3 Amount_{{ $Payment->id }}">
                                <label class="form-label">Amount ($ / %)</label>
                                <input type="number" class="form-control"
                                       value="{{ $Payment->Payment }}" min="0" required>
                                <div class="invalid-feedback">
                                    Please Enter Payment.
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="Switch_{{ $Payment->id }}" class="form-label">Status</label>
                                <select class="form-select" id="Switch_{{ $Payment->id }}" required>
                                    <option @selected($Payment->Payment_Switch === 0) value="0">Active</option>
                                    <option @selected($Payment->Payment_Switch === 1) value="1">In-Active</option>
                                </select>
                            </div>
                            <div class="col-md-3 mt-3">
                                <button class="btn btn-primary mt-3" type="button"
                                        onclick="updateSwitch({{ $Payment->id }}, {{ $Payment->Payment_Switch }})">
                                    Update
                                </button>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </form>

            </ul>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body p-4">
        <div class="mb-3">
            <h5 class="card-title text-decoration-underline mb-3">Subscription Packages</h5>
            <ul class="list-unstyled mb-0">
                <form class="row g-3 needs-validation" novalidate>
                    <p>Subscription Packages For Carrier Load Board</p>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="Heavy_Load"
                                   class="form-label">Heavy Load Amount</label>
                            <input type="number" class="form-control Heavy_Load_Amount numeric"
                                   value="{{ $Packages->Heavy_Load_Amount }}" min="0" required>
                            <div class="invalid-feedback">
                                Please Enter Amount.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="Heavy_Load"
                                   class="form-label">Dry Van Load Amount</label>
                            <input type="number" class="form-control D_Load_Amount numeric"
                                   value="{{ $Packages->Dry_Van_Load_Amount }}" min="0" required>
                            <div class="invalid-feedback">
                                Please Enter Amount.
                            </div>
                        </div>
                        <div class="col-md-3 mt-3">
                            <button class="btn btn-primary mt-3" type="button" onclick="updateSubscription()">Update
                            </button>
                        </div>
                    </div>
                </form>

            </ul>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body p-4">
        <div class="mb-3">
            <h5 class="card-title text-decoration-underline mb-3">Agents Target Reward</h5>
            <ul class="list-unstyled mb-0">
                <form class="row g-3 needs-validation" novalidate>
                    <p>Agents Targeted Reward</p>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="Heavy_Load"
                                   class="form-label">Agents Order Target</label>
                            <input type="number" class="form-control Order numeric"
                                   value="{{ $Targeted_Reward->Order_Target }}" min="0" required>
                            <div class="invalid-feedback">
                                Please Enter Order.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="Heavy_Load"
                                   class="form-label">Per Order Revenue</label>
                            <input type="number" class="form-control Revenue numeric"
                                   value="{{ $Targeted_Reward->Per_Order_Amount }}" min="0" required>
                            <div class="invalid-feedback">
                                Please Enter Revenue.
                            </div>
                        </div>
                        <div class="col-md-3 mt-3">
                            <button class="btn btn-primary mt-3" type="button" onclick="updateTarget()">Update
                            </button>
                        </div>
                    </div>
                </form>

            </ul>
        </div>
    </div>
</div>

<script>function updateTarget() {
        var Order = $('.Order').val();
        var Revenue = $('.Revenue').val();

        $.ajax({
            url: '{{ route('Target.Revenue.Update') }}',
            type: 'GET',
            data: {
                'Order': Order,
                'Revenue': Revenue
            },
            success: function (data) {
                alert(data);
            },
            error: function (data) {
                var errors = data.responseJSON;
            }
        });
    }

    function updateSubscription() {
        var H_Load_Amount = $('.Heavy_Load_Amount').val();
        var D_Load_Amount = $('.D_Load_Amount').val();

        $.ajax({
            url: '{{ route('Subscription.Update') }}',
            type: 'GET',
            data: {
                'H_Load_Amount': H_Load_Amount,
                'D_Load_Amount': D_Load_Amount
            },
            success: function (data) {
                alert(data);
            },
            error: function (data) {
                var errors = data.responseJSON;
            }
        });
    }

    function updateSwitch(Switch_ID, Switch_Value, e) {
        // e.preventDefault();
        var classDiv = '.Amount_' + Switch_ID;
        var getAmount = $(classDiv).find('input').val();

        $.ajax({
            url: '{{ route('Payment.Switch.Update') }}',
            type: 'GET',
            data: {
                'Switch_ID': Switch_ID,
                'Switch_Value': Switch_Value,
                'Switch_Amount': getAmount
            },
            success: function (data) {
                alert(data);
            },
            error: function (data) {
                var errors = data.responseJSON;
            }

        });
    }
</script>
