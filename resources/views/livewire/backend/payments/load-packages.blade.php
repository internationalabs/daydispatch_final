<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

<style>
.fa.fa-check {
    color: #23bd23;
    font-size: 25px;
}

.fa.fa-times {
    color: red;
    font-size: 25px;
}

.align-center {
    text-align: center !important;
}
.align-self-center {
    vertical-align: middle;
}
</style>

<div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="text-center mb-4 pb-2">
            <h4 class="fs-22">Choose the plan that's right for you</h4>
            <p class="text-muted mb-4 fs-15">Simple pricing. No hidden fees. Advanced features for
                you business.</p>
        </div>
    </div>
    <div class="container mt-4">
        <label for="dropdown">Select Account Type:</label>
        <select class="form-control" id="dropdown" name="dropdown">
             <!--<option disabled selected class="text-muted">Select Account Type</option>-->
            <option value="Brokers">Brokers</option>
            <option value="Carriers">Carriers</option>
            <option value="Dispatch">Dispatch</option>
            <option value="Shipper">Shipper</option>
        </select>
    </div>
    <!--end col-->
</div>
<div class="row justify-content-center overflow-auto">
    <div class="col-xl-11">
        <div class="row">



            <table id="table-1" class="table border">
                <thead>
                    <tr>
                        <th scope="col" class="border text-lg h4 align-self-center">Payment Plan Brokers</th>
                        <th scope="col" class="border">
                            <div class="">
                                <div class="card pricing-box">
                                    <div class="card-body p-4 m-2">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1">Basic Plan</h5>
                                                <p class="text-muted mb-0">For Startup</p>
                                            </div>
                                            <div class="avatar-sm">
                                                <div class="avatar-title bg-light rounded-circle text-primary">
                                                    <i class="ri-book-mark-line fs-20"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pt-4">
                                            <h2><sup><small>$</small></sup>0 <span
                                                    class="fs-13 text-muted">/Yearly</span></h2>
                                        </div>
                                        <hr class="my-4 text-muted">
                                        <div>
                                            <ul class="list-unstyled text-muted vstack gap-3">
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            Primary Vehicles
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-danger me-1">
                                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <b>Heavy Equipment</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-danger me-1">
                                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <b>Dry Van</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="mt-4">
                                                <button href="javascript:void(0);" disabled
                                                    class="btn btn-soft-success w-100 waves-effect waves-light">Already
                                                    Subscribed
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </th>
                        <th align-center scope="col" class="border">
                            <!--end col-->
                            <div class="">
                                <div class="card pricing-box ribbon-box right">
                                    <div class="card-body p-4 m-2">
                                        <div class="ribbon-two ribbon-two-danger"><span>Popular</span></div>
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-1">Pro Business</h5>
                                                    <p class="text-muted mb-0">Professional plans</p>
                                                </div>
                                                <div class="avatar-sm">
                                                    <div class="avatar-title bg-light rounded-circle text-primary">
                                                        <i class="ri-medal-line fs-20"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pt-4">
                                                <h2><sup><small>$</small></sup> {{ $Pacakges->Heavy_Load_Amount }}<span
                                                        class="fs-13 text-muted">/Yearly</span></h2>
                                            </div>
                                        </div>
                                        <hr class="my-4 text-muted">
                                        <div>
                                            <ul class="list-unstyled vstack gap-3 text-muted">
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            Primary Vehicles
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <b>Heavy Equipment</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-danger me-1">
                                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <b>Dry Van</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            @if(!$auth_user->is_heavy_subscribe)
                                            <form action="{{ route('Subscribe.Package') }}" method="POST" class="mt-4">
                                                @csrf
                                                <!-- Base Radios -->
                                                <div class="d-flex inline-block mb-3">
                                                    <div class="form-check" style="margin-right: 9px;">
                                                        <input class="form-check-input" type="radio"
                                                            name="Payment_Method" id="flexRadioDefault1" value="0">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Stripe Payment 123
                                                        </label>
                                                    </div>

                                                    <div class="form-check" style="margin-left: 9px;">
                                                        <input class="form-check-input" type="radio"
                                                            name="Payment_Method" id="flexRadioDefault2" value="1"
                                                            required>
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                            PayPal Payment
                                                        </label>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="Amount"
                                                    value="{{ $Pacakges->Heavy_Load_Amount }}">
                                                <input type="hidden" name="Package_ID" value="2">
                                                <input type="hidden" name="Name" value="{{ $auth_user->Company_Name }}">
                                                <input type="hidden" name="Email" value="{{ $auth_user->email }}">
                                                <input type="hidden" name="ID" value="{{ $auth_user->id }}">
                                                <button type="submit"
                                                    class="btn btn-success w-100 waves-effect waves-light">Subscribe Now
                                                </button>
                                            </form>
                                            @else
                                            <div class="mt-4">
                                                <button type="button" disabled
                                                    class="btn btn-success w-100 waves-effect waves-light">Already
                                                    Subscribed
                                                </button>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                        </th>
                        <th align-center scope="col" class="border">
                            <!--start 3 col-->
                            <div class="">
                                <div class="card pricing-box">
                                    <div class="card-body p-4 m-2">
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-1">Platinum Plan</h5>
                                                    <p class="text-muted mb-0">Enterprise Businesses</p>
                                                </div>
                                                <div class="avatar-sm">
                                                    <div class="avatar-title bg-light rounded-circle text-primary">
                                                        <i class="ri-stack-line fs-20"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pt-4">
                                                <h2><sup><small>$</small></sup>
                                                    {{ $Pacakges->Dry_Van_Load_Amount }}<span
                                                        class="fs-13 text-muted">/Yearly</span></h2>
                                            </div>
                                        </div>
                                        <hr class="my-4 text-muted">
                                        <div>
                                            <ul class="list-unstyled vstack gap-3 text-muted">
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            Primary Vehicles
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <b>Heavy Equipment</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <b>Dry Van</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            @if(!$auth_user->is_dry_van_subscribe)
                                            <form action="{{ route('Subscribe.Package') }}" method="POST" class="mt-4">
                                                @csrf
                                                <!-- Base Radios -->
                                                <div class="d-flex inline-block mb-3">
                                                    <div class="form-check" style="margin-right: 9px;">
                                                        <input class="form-check-input" type="radio"
                                                            name="Payment_Method" value="1" id="flexRadioDefault3">
                                                        <label class="form-check-label" for="flexRadioDefault3">
                                                            Stripe Payment
                                                        </label>
                                                    </div>

                                                    <div class="form-check" style="margin-left: 9px;">
                                                        <input class="form-check-input" type="radio"
                                                            name="Payment_Method" value="2" id="flexRadioDefault4"
                                                            required>
                                                        <label class="form-check-label" for="flexRadioDefault4">
                                                            PayPal Payment
                                                        </label>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="Amount"
                                                    value="{{ $Pacakges->Dry_Van_Load_Amount }}">
                                                <input type="hidden" name="Name" value="{{ $auth_user->Company_Name }}">
                                                <input type="hidden" name="Package_ID" value="3">
                                                <input type="hidden" name="Email" value="{{ $auth_user->email }}">
                                                <input type="hidden" name="ID" value="{{ $auth_user->id }}">
                                                <button type="submit"
                                                    class="btn btn-success w-100 waves-effect waves-light">Subscribe Now
                                                </button>
                                            </form>
                                            @else
                                            <div class="mt-4">
                                                <button type="button" disabled
                                                    class="btn btn-success w-100 waves-effect waves-light">Already
                                                    Subscribed
                                                </button>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end 3col-->

                        </th>
                        </ align-centertr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border">Primary Vehicle</td>
                        <td class="border align-center"><i class="fa fa-check "></i></td>
                        <td class="border align-center"><i class="fa fa-check "></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Heavy Equipment Load</td>
                        <td class="border align-center"><i class="fa fa-times "></i></td>
                        <td class="border align-center"><i class="fa fa-check "></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Dry Van Load</td>
                        <td class="border align-center"><i class="fa fa-times"></i></td>
                        <td class="border align-center"><i class="fa fa-times"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Unlimited Load Posting</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Matching Trucks Route</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Request On Load</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Automated Reporting</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>

                    <tr>
                        <td class="border">Real Time Tracking</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Compare Route Pricing</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Rating System</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Chat For Easy Communication</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                </tbody>
            </table>
            
            
            
            
              <table id="table-2" class="table border">
                <thead>
                    <tr>
                        <th scope="col" class="border text-lg h4 align-self-center">Payment Plan Carriers</th>
                        <th scope="col" class="border">
                            <div class="">
                                <div class="card pricing-box">
                                    <div class="card-body p-4 m-2">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1">Basic Plan</h5>
                                                <p class="text-muted mb-0">For Startup</p>
                                            </div>
                                            <div class="avatar-sm">
                                                <div class="avatar-title bg-light rounded-circle text-primary">
                                                    <i class="ri-book-mark-line fs-20"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pt-4">
                                            <h2><sup><small>$</small></sup>0 <span
                                                    class="fs-13 text-muted">/Yearly</span></h2>
                                        </div>
                                        <hr class="my-4 text-muted">
                                        <div>
                                            <ul class="list-unstyled text-muted vstack gap-3">
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            Primary Vehicles 
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-danger me-1">
                                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <b>Heavy Equipment</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-danger me-1">
                                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <b>Dry Van</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="mt-4">
                                                <button href="javascript:void(0);" disabled
                                                    class="btn btn-soft-success w-100 waves-effect waves-light">Already
                                                    Subscribed
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </th>
                        <th align-center scope="col" class="border">
                            <!--end col-->
                            <div class="">
                                <div class="card pricing-box ribbon-box right">
                                    <div class="card-body p-4 m-2">
                                        <div class="ribbon-two ribbon-two-danger"><span>Popular</span></div>
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-1">Pro Business</h5>
                                                    <p class="text-muted mb-0">Professional plans</p>
                                                </div>
                                                <div class="avatar-sm">
                                                    <div class="avatar-title bg-light rounded-circle text-primary">
                                                        <i class="ri-medal-line fs-20"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pt-4">
                                                <h2><sup><small>$</small></sup> {{ $Pacakges->Heavy_Load_Amount }}<span
                                                        class="fs-13 text-muted">/Yearly</span></h2>
                                            </div>
                                        </div>
                                        <hr class="my-4 text-muted">
                                        <div>
                                            <ul class="list-unstyled vstack gap-3 text-muted">
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            Primary Vehicles
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <b>Heavy Equipment</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-danger me-1">
                                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <b>Dry Van</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            @if(!$auth_user->is_heavy_subscribe)
                                            <form action="{{ route('Subscribe.Package') }}" method="POST" class="mt-4">
                                                @csrf
                                                <!-- Base Radios -->
                                                <div class="d-flex inline-block mb-3">
                                                    <div class="form-check" style="margin-right: 9px;">
                                                        <input class="form-check-input" type="radio"
                                                            name="Payment_Method" id="flexRadioDefault1" value="0">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Stripe Payment
                                                        </label>
                                                    </div>

                                                    <div class="form-check" style="margin-left: 9px;">
                                                        <input class="form-check-input" type="radio"
                                                            name="Payment_Method" id="flexRadioDefault2" value="1"
                                                            required>
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                            PayPal Payment
                                                        </label>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="Amount"
                                                    value="{{ $Pacakges->Heavy_Load_Amount }}">
                                                <input type="hidden" name="Package_ID" value="2">
                                                <input type="hidden" name="Name" value="{{ $auth_user->Company_Name }}">
                                                <input type="hidden" name="Email" value="{{ $auth_user->email }}">
                                                <input type="hidden" name="ID" value="{{ $auth_user->id }}">
                                                <button type="submit"
                                                    class="btn btn-success w-100 waves-effect waves-light">Subscribe Now
                                                </button>
                                            </form>
                                            @else
                                            <div class="mt-4">
                                                <button type="button" disabled
                                                    class="btn btn-success w-100 waves-effect waves-light">Already
                                                    Subscribed
                                                </button>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                        </th>
                        <th align-center scope="col" class="border">
                            <!--start 3 col-->
                            <div class="">
                                <div class="card pricing-box">
                                    <div class="card-body p-4 m-2">
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-1">Platinum Plan</h5>
                                                    <p class="text-muted mb-0">Enterprise Businesses</p>
                                                </div>
                                                <div class="avatar-sm">
                                                    <div class="avatar-title bg-light rounded-circle text-primary">
                                                        <i class="ri-stack-line fs-20"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pt-4">
                                                <h2><sup><small>$</small></sup>
                                                    {{ $Pacakges->Dry_Van_Load_Amount }}<span
                                                        class="fs-13 text-muted">/Yearly</span></h2>
                                            </div>
                                        </div>
                                        <hr class="my-4 text-muted">
                                        <div>
                                            <ul class="list-unstyled vstack gap-3 text-muted">
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            Primary Vehicles
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <b>Heavy Equipment</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <b>Dry Van</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            @if(!$auth_user->is_dry_van_subscribe)
                                            <form action="{{ route('Subscribe.Package') }}" method="POST" class="mt-4">
                                                @csrf
                                                <!-- Base Radios -->
                                                <div class="d-flex inline-block mb-3">
                                                    <div class="form-check" style="margin-right: 9px;">
                                                        <input class="form-check-input" type="radio"
                                                            name="Payment_Method" value="1" id="flexRadioDefault3">
                                                        <label class="form-check-label" for="flexRadioDefault3">
                                                            Stripe Payment
                                                        </label>
                                                    </div>

                                                    <div class="form-check" style="margin-left: 9px;">
                                                        <input class="form-check-input" type="radio"
                                                            name="Payment_Method" value="2" id="flexRadioDefault4"
                                                            required>
                                                        <label class="form-check-label" for="flexRadioDefault4">
                                                            PayPal Payment
                                                        </label>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="Amount"
                                                    value="{{ $Pacakges->Dry_Van_Load_Amount }}">
                                                <input type="hidden" name="Name" value="{{ $auth_user->Company_Name }}">
                                                <input type="hidden" name="Package_ID" value="3">
                                                <input type="hidden" name="Email" value="{{ $auth_user->email }}">
                                                <input type="hidden" name="ID" value="{{ $auth_user->id }}">
                                                <button type="submit"
                                                    class="btn btn-success w-100 waves-effect waves-light">Subscribe Now
                                                </button>
                                            </form>
                                            @else
                                            <div class="mt-4">
                                                <button type="button" disabled
                                                    class="btn btn-success w-100 waves-effect waves-light">Already
                                                    Subscribed
                                                </button>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end 3col-->

                        </th>
                        </ align-centertr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border">Load Alert</td>
                        <td class="border align-center"><i class="fa fa-check "></i></td>
                        <td class="border align-center"><i class="fa fa-check "></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Primary Vehicle</td>
                        <td class="border align-center"><i class="fa fa-check "></i></td>
                        <td class="border align-center"><i class="fa fa-check "></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Heavy Equipment Load</td>
                        <td class="border align-center"><i class="fa fa-times "></i></td>
                        <td class="border align-center"><i class="fa fa-check "></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Dry Van Load</td>
                        <td class="border align-center"><i class="fa fa-times"></i></td>
                        <td class="border align-center"><i class="fa fa-times"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>

                    <tr>
                        <td class="border">Matching Loads </td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Request On Load</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Automated Reporting</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>

                    <tr>
                        <td class="border">Real Time Tracking</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Compare Route Pricing</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Rating System</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Chat For Easy Communication</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                </tbody>
            </table>






              <table id="table-3" class="table border">
                <thead>
                    <tr>
                        <th scope="col" class="border text-lg h4 align-self-center">Payment Plan Dispatch</th>
                        <th scope="col" class="border">
                            <div class="">
                                <div class="card pricing-box">
                                    <div class="card-body p-4 m-2">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1">Basic Plan</h5>
                                                <p class="text-muted mb-0">For Startup</p>
                                            </div>
                                            <div class="avatar-sm">
                                                <div class="avatar-title bg-light rounded-circle text-primary">
                                                    <i class="ri-book-mark-line fs-20"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pt-4">
                                            <h2><sup><small>$</small></sup>0 <span
                                                    class="fs-13 text-muted">/Yearly</span></h2>
                                        </div>
                                        <hr class="my-4 text-muted">
                                        <div>
                                            <ul class="list-unstyled text-muted vstack gap-3">
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            Primary Vehicles
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-danger me-1">
                                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <b>Heavy Equipment</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-danger me-1">
                                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <b>Dry Van</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="mt-4">
                                                <button href="javascript:void(0);" disabled
                                                    class="btn btn-soft-success w-100 waves-effect waves-light">Already
                                                    Subscribed
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </th>
                        <th align-center scope="col" class="border">
                            <!--end col-->
                            <div class="">
                                <div class="card pricing-box ribbon-box right">
                                    <div class="card-body p-4 m-2">
                                        <div class="ribbon-two ribbon-two-danger"><span>Popular</span></div>
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-1">Pro Business</h5>
                                                    <p class="text-muted mb-0">Professional plans</p>
                                                </div>
                                                <div class="avatar-sm">
                                                    <div class="avatar-title bg-light rounded-circle text-primary">
                                                        <i class="ri-medal-line fs-20"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pt-4">
                                                <h2><sup><small>$</small></sup> {{ $Pacakges->Heavy_Load_Amount }}<span
                                                        class="fs-13 text-muted">/Yearly</span></h2>
                                            </div>
                                        </div>
                                        <hr class="my-4 text-muted">
                                        <div>
                                            <ul class="list-unstyled vstack gap-3 text-muted">
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            Primary Vehicles
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <b>Heavy Equipment</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-danger me-1">
                                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <b>Dry Van</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            @if(!$auth_user->is_heavy_subscribe)
                                            <form action="{{ route('Subscribe.Package') }}" method="POST" class="mt-4">
                                                @csrf
                                                <!-- Base Radios -->
                                                <div class="d-flex inline-block mb-3">
                                                    <div class="form-check" style="margin-right: 9px;">
                                                        <input class="form-check-input" type="radio"
                                                            name="Payment_Method" id="flexRadioDefault1" value="0">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Stripe Payment
                                                        </label>
                                                    </div>

                                                    <div class="form-check" style="margin-left: 9px;">
                                                        <input class="form-check-input" type="radio"
                                                            name="Payment_Method" id="flexRadioDefault2" value="1"
                                                            required>
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                            PayPal Payment
                                                        </label>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="Amount"
                                                    value="{{ $Pacakges->Heavy_Load_Amount }}">
                                                <input type="hidden" name="Package_ID" value="2">
                                                <input type="hidden" name="Name" value="{{ $auth_user->Company_Name }}">
                                                <input type="hidden" name="Email" value="{{ $auth_user->email }}">
                                                <input type="hidden" name="ID" value="{{ $auth_user->id }}">
                                                <button type="submit"
                                                    class="btn btn-success w-100 waves-effect waves-light">Subscribe Now
                                                </button>
                                            </form>
                                            @else
                                            <div class="mt-4">
                                                <button type="button" disabled
                                                    class="btn btn-success w-100 waves-effect waves-light">Already
                                                    Subscribed
                                                </button>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                        </th>
                        <th align-center scope="col" class="border">
                            <!--start 3 col-->
                            <div class="">
                                <div class="card pricing-box">
                                    <div class="card-body p-4 m-2">
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-1">Platinum Plan</h5>
                                                    <p class="text-muted mb-0">Enterprise Businesses</p>
                                                </div>
                                                <div class="avatar-sm">
                                                    <div class="avatar-title bg-light rounded-circle text-primary">
                                                        <i class="ri-stack-line fs-20"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pt-4">
                                                <h2><sup><small>$</small></sup>
                                                    {{ $Pacakges->Dry_Van_Load_Amount }}<span
                                                        class="fs-13 text-muted">/Yearly</span></h2>
                                            </div>
                                        </div>
                                        <hr class="my-4 text-muted">
                                        <div>
                                            <ul class="list-unstyled vstack gap-3 text-muted">
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            Primary Vehicles
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <b>Heavy Equipment</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <b>Dry Van</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            @if(!$auth_user->is_dry_van_subscribe)
                                            <form action="{{ route('Subscribe.Package') }}" method="POST" class="mt-4">
                                                @csrf
                                                <!-- Base Radios -->
                                                <div class="d-flex inline-block mb-3">
                                                    <div class="form-check" style="margin-right: 9px;">
                                                        <input class="form-check-input" type="radio"
                                                            name="Payment_Method" value="1" id="flexRadioDefault3">
                                                        <label class="form-check-label" for="flexRadioDefault3">
                                                            Stripe Payment
                                                        </label>
                                                    </div>

                                                    <div class="form-check" style="margin-left: 9px;">
                                                        <input class="form-check-input" type="radio"
                                                            name="Payment_Method" value="2" id="flexRadioDefault4"
                                                            required>
                                                        <label class="form-check-label" for="flexRadioDefault4">
                                                            PayPal Payment
                                                        </label>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="Amount"
                                                    value="{{ $Pacakges->Dry_Van_Load_Amount }}">
                                                <input type="hidden" name="Name" value="{{ $auth_user->Company_Name }}">
                                                <input type="hidden" name="Package_ID" value="3">
                                                <input type="hidden" name="Email" value="{{ $auth_user->email }}">
                                                <input type="hidden" name="ID" value="{{ $auth_user->id }}">
                                                <button type="submit"
                                                    class="btn btn-success w-100 waves-effect waves-light">Subscribe Now
                                                </button>
                                            </form>
                                            @else
                                            <div class="mt-4">
                                                <button type="button" disabled
                                                    class="btn btn-success w-100 waves-effect waves-light">Already
                                                    Subscribed
                                                </button>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end 3col-->

                        </th>
                        </ align-centertr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border">Primary Vehicle</td>
                        <td class="border align-center"><i class="fa fa-check "></i></td>
                        <td class="border align-center"><i class="fa fa-check "></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Heavy Equipment Load</td>
                        <td class="border align-center"><i class="fa fa-times "></i></td>
                        <td class="border align-center"><i class="fa fa-check "></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Dry Van Load</td>
                        <td class="border align-center"><i class="fa fa-times"></i></td>
                        <td class="border align-center"><i class="fa fa-times"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Unlimited Load Posting</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Matching Trucks Route</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Request On Load</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Automated Reporting</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>

                    <tr>
                        <td class="border">Real Time Tracking</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Compare Route Pricing</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Rating System</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Chat For Easy Communication</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                </tbody>
                 
                
                
                
                
            </table>
                        <table id="table-4" class="table border">
                <thead>
                    <tr>
                        <th scope="col" class="border text-lg h4 align-self-center">Payment Plan Shipper</th>
                        <th scope="col" class="border">
                            <div class="">
                                <div class="card pricing-box">
                                    <div class="card-body p-4 m-2">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1">Basic Plan</h5>
                                                <p class="text-muted mb-0">For Startup</p>
                                            </div>
                                            <div class="avatar-sm">
                                                <div class="avatar-title bg-light rounded-circle text-primary">
                                                    <i class="ri-book-mark-line fs-20"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pt-4">
                                            <h2><sup><small>$</small></sup>0 <span
                                                    class="fs-13 text-muted">/Yearly</span></h2>
                                        </div>
                                        <hr class="my-4 text-muted">
                                        <div>
                                            <ul class="list-unstyled text-muted vstack gap-3">
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            Primary Vehicles
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-danger me-1">
                                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <b>Heavy Equipment</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-danger me-1">
                                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <b>Dry Van</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="mt-4">
                                                <button href="javascript:void(0);" disabled
                                                    class="btn btn-soft-success w-100 waves-effect waves-light">Already
                                                    Subscribed
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </th>
                        <th align-center scope="col" class="border">
                            <!--end col-->
                            <div class="">
                                <div class="card pricing-box ribbon-box right">
                                    <div class="card-body p-4 m-2">
                                        <div class="ribbon-two ribbon-two-danger"><span>Popular</span></div>
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-1">Pro Business</h5>
                                                    <p class="text-muted mb-0">Professional plans</p>
                                                </div>
                                                <div class="avatar-sm">
                                                    <div class="avatar-title bg-light rounded-circle text-primary">
                                                        <i class="ri-medal-line fs-20"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pt-4">
                                                <h2><sup><small>$</small></sup> {{ $Pacakges->Heavy_Load_Amount }}<span
                                                        class="fs-13 text-muted">/Yearly</span></h2>
                                            </div>
                                        </div>
                                        <hr class="my-4 text-muted">
                                        <div>
                                            <ul class="list-unstyled vstack gap-3 text-muted">
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            Primary Vehicles
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <b>Heavy Equipment</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-danger me-1">
                                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <b>Dry Van</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            @if(!$auth_user->is_heavy_subscribe)
                                            <form action="{{ route('Subscribe.Package') }}" method="POST" class="mt-4">
                                                @csrf
                                                <!-- Base Radios -->
                                                <div class="d-flex inline-block mb-3">
                                                    <div class="form-check" style="margin-right: 9px;">
                                                        <input class="form-check-input" type="radio"
                                                            name="Payment_Method" id="flexRadioDefault1" value="0">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Stripe Payment
                                                        </label>
                                                    </div>

                                                    <div class="form-check" style="margin-left: 9px;">
                                                        <input class="form-check-input" type="radio"
                                                            name="Payment_Method" id="flexRadioDefault2" value="1"
                                                            required>
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                            PayPal Payment
                                                        </label>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="Amount"
                                                    value="{{ $Pacakges->Heavy_Load_Amount }}">
                                                <input type="hidden" name="Package_ID" value="2">
                                                <input type="hidden" name="Name" value="{{ $auth_user->Company_Name }}">
                                                <input type="hidden" name="Email" value="{{ $auth_user->email }}">
                                                <input type="hidden" name="ID" value="{{ $auth_user->id }}">
                                                <button type="submit"
                                                    class="btn btn-success w-100 waves-effect waves-light">Subscribe Now
                                                </button>
                                            </form>
                                            @else
                                            <div class="mt-4">
                                                <button type="button" disabled
                                                    class="btn btn-success w-100 waves-effect waves-light">Already
                                                    Subscribed
                                                </button>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                        </th>
                        <th align-center scope="col" class="border">
                            <!--start 3 col-->
                            <div class="">
                                <div class="card pricing-box">
                                    <div class="card-body p-4 m-2">
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-1">Platinum Plan</h5>
                                                    <p class="text-muted mb-0">Enterprise Businesses</p>
                                                </div>
                                                <div class="avatar-sm">
                                                    <div class="avatar-title bg-light rounded-circle text-primary">
                                                        <i class="ri-stack-line fs-20"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pt-4">
                                                <h2><sup><small>$</small></sup>
                                                    {{ $Pacakges->Dry_Van_Load_Amount }}<span
                                                        class="fs-13 text-muted">/Yearly</span></h2>
                                            </div>
                                        </div>
                                        <hr class="my-4 text-muted">
                                        <div>
                                            <ul class="list-unstyled vstack gap-3 text-muted">
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            Primary Vehicles
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <b>Heavy Equipment</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 text-success me-1">
                                                            <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <b>Dry Van</b> Load
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            @if(!$auth_user->is_dry_van_subscribe)
                                            <form action="{{ route('Subscribe.Package') }}" method="POST" class="mt-4">
                                                @csrf
                                                <!-- Base Radios -->
                                                <div class="d-flex inline-block mb-3">
                                                    <div class="form-check" style="margin-right: 9px;">
                                                        <input class="form-check-input" type="radio"
                                                            name="Payment_Method" value="1" id="flexRadioDefault3">
                                                        <label class="form-check-label" for="flexRadioDefault3">
                                                            Stripe Payment
                                                        </label>
                                                    </div>

                                                    <div class="form-check" style="margin-left: 9px;">
                                                        <input class="form-check-input" type="radio"
                                                            name="Payment_Method" value="2" id="flexRadioDefault4"
                                                            required>
                                                        <label class="form-check-label" for="flexRadioDefault4">
                                                            PayPal Payment
                                                        </label>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="Amount"
                                                    value="{{ $Pacakges->Dry_Van_Load_Amount }}">
                                                <input type="hidden" name="Name" value="{{ $auth_user->Company_Name }}">
                                                <input type="hidden" name="Package_ID" value="3">
                                                <input type="hidden" name="Email" value="{{ $auth_user->email }}">
                                                <input type="hidden" name="ID" value="{{ $auth_user->id }}">
                                                <button type="submit"
                                                    class="btn btn-success w-100 waves-effect waves-light">Subscribe Now
                                                </button>
                                            </form>
                                            @else
                                            <div class="mt-4">
                                                <button type="button" disabled
                                                    class="btn btn-success w-100 waves-effect waves-light">Already
                                                    Subscribed
                                                </button>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end 3col-->

                        </th>
                        </ align-centertr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border">Primary Vehicle</td>
                        <td class="border align-center"><i class="fa fa-check "></i></td>
                        <td class="border align-center"><i class="fa fa-check "></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Heavy Equipment Load</td>
                        <td class="border align-center"><i class="fa fa-times "></i></td>
                        <td class="border align-center"><i class="fa fa-check "></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Dry Van Load</td>
                        <td class="border align-center"><i class="fa fa-times"></i></td>
                        <td class="border align-center"><i class="fa fa-times"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Unlimited Load Posting</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Matching Trucks Route</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Request On Load</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Automated Reporting</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>

                    <tr>
                        <td class="border">Real Time Tracking</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Compare Route Pricing</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Rating System</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="border">Chat For Easy Communication</td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                        <td class="border align-center"><i class="fa fa-check"></i></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!--end row-->
    </div>
    <!--end col-->
</div>


<script>
  $(document).ready(function() {
      
           $("#table-1").show();
           $("#table-2").hide(); 
           $("#table-3").hide(); 
           $("#table-4").hide(); 
           
    $("#dropdown").on('change', function() {
      let selectedValue = $(this).val();
        
      if (selectedValue === "Brokers") {
          
        $("#table-1").show();
        $("#table-2").hide();
        $("#table-3").hide(); 
        $("#table-4").hide(); 
      }
      else if (selectedValue === "Carriers") {
          
        $("#table-1").hide();
        $("#table-2").show();
        $("#table-3").hide(); 
        $("#table-4").hide(); 
      }
      else if (selectedValue === "Dispatch") {
          
        $("#table-1").hide();
        $("#table-2").hide();
        $("#table-3").show(); 
        $("#table-4").hide(); 
      }
      else if (selectedValue === "Shipper") {
          
        $("#table-1").hide();
        $("#table-2").hide();
        $("#table-3").hide(); 
        $("#table-4").show(); 
      }
      else {
       
        $("#table-1").show();
        $("#table-2").hide();
        
      }
      console.log(selectedValue);
    });
  });
</script>
