<div class="col-12">
    <div class="card">
        <div class="card-body checkout-tab">

            <div class="step-arrow-nav mt-n3 mx-n3 mb-3">

                <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fs-15 p-3 active" id="pills-payment-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-payment" type="button" role="tab" aria-controls="pills-payment"
                                aria-selected="false"><i
                                class="ri-bank-card-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i>
                            Registration Fee Submit To Continue
                        </button>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="pills-payment" role="tabpanel"
                     aria-labelledby="pills-payment-tab">
                    <div>
                        <h5 class="mb-1">Payment Selection</h5>
                        <p class="text-muted mb-4">Please select and enter your billing
                            information</p>
                    </div>

                    <div class="row g-4">
                        <div class="col-lg-6 col-sm-6">
                            <div data-bs-toggle="collapse" data-bs-target="#paymentmethodCollapsePayPal.show"
                                 aria-expanded="true" aria-controls="paymentmethodCollapsePayPal">
                                <div class="form-check card-radio">
                                    <input id="paymentMethod01" name="paymentMethod" type="radio"
                                           class="form-check-input">
                                    <label class="form-check-label" for="paymentMethod01">
                                        <span class="fs-16 text-muted me-2"><i class="ri-paypal-fill align-bottom"></i></span>
                                        <span class="fs-14 text-wrap">Paypal</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div data-bs-toggle="collapse" data-bs-target="#paymentmethodCollapseStripe"
                                 aria-expanded="false"
                                 aria-controls="paymentmethodCollapseStripe">
                                <div class="form-check card-radio">
                                    <input id="paymentMethod02" name="paymentMethod" type="radio"
                                           class="form-check-input">
                                    <label class="form-check-label" for="paymentMethod02">
                                        <span class="fs-16 text-muted me-2"><i
                                                class="ri-bank-card-fill align-bottom"></i></span>
                                        <span class="fs-14 text-wrap">Credit / Debit
                                                                        Card</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="collapse" id="paymentmethodCollapseStripe">
                        <div class="card p-4 border shadow-none mb-0 mt-4">
                            <form class="needs-validation" action="{{ route("Stripe.Registration") }}"
                                  method="POST"
                                  novalidate>
                                @csrf
                                <div class="row gy-3">
                                    <div class="col-lg-6">
                                        <div class="card-title">
                                            Registration Fee Using Stripe
                                        </div>
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been the industry's standard dummy text ever since the
                                            1500s, when an unknown printer took a galley of type and scrambled it to
                                            make a type specimen book.
                                        </p>
                                        <p>It has survived not only five centuries, but also
                                            the leap into electronic typesetting, remaining essentially unchanged. It
                                            was popularised in the 1960s with the release of enetreset sheets containing
                                            Lorem Ipsum passages, and more recently with desktop publishing software
                                            like Aldus PageMaker including versions of Lorem Ipsum.
                                        </p>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="cc-name" class="form-label">Company Name</label>
                                                <input readonly type="text" class="form-control" name="Card_Name"
                                                       value="{{ $User_Info->Company_Name }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="cc-name" class="form-label">Email Address</label>
                                                <input readonly type="text" class="form-control" name="Card_Name"
                                                       value="{{ $User_Info->email }}">
                                            </div>
                                        </div>
                                        <input hidden type="text" class="form-control Reg_Fee" name="Reg_Fee"
                                               value="{{ $Payment_Info->Payment }}">
                                        <input hidden type="text" class="form-control User_ID" name="User_ID"
                                               value="{{ $User_Info->id }}">
                                        <div class="col-lg-12">
                                            <button type="submit" id="StripeSubmit"
                                                    class="btn btn-primary w-100 btn-label right ms-auto nexttab"
                                                    data-nexttab="pills-finish-tab"><i
                                                    class="ri-shopping-basket-line label-icon align-middle fs-16 ms-2"></i>Registration
                                                Fee ($ {{ number_format($Payment_Info->Payment) }})
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="text-muted mt-2 fst-italic">
                            <i data-feather="lock" class="text-muted icon-xs bx bx-lock-alt"></i> Your
                            transaction is secured with SSL encryption
                        </div>
                    </div>
                    <div class="collapse" id="paymentmethodCollapsePayPal">
                        <div class="card p-4 border shadow-none mb-0 mt-4">
                            <form class="needs-validation" method="POST"
                                  action="{{ route('make.payment') }}"
                                  novalidate>
                                @csrf
                                <div class="row gy-3">
                                    <div class="col-lg-6">
                                        <div class="card-title">
                                            Registration Fee Using Stripe
                                        </div>
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been the industry's standard dummy text ever since the
                                            1500s, when an unknown printer took a galley of type and scrambled it to
                                            make a type specimen book.
                                        </p>
                                        <p>It has survived not only five centuries, but also
                                            the leap into electronic typesetting, remaining essentially unchanged. It
                                            was popularised in the 1960s with the release of enetreset sheets containing
                                            Lorem Ipsum passages, and more recently with desktop publishing software
                                            like Aldus PageMaker including versions of Lorem Ipsum.
                                        </p>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="cc-name" class="form-label">Company Name</label>
                                                <input readonly type="text" class="form-control" name="Card_Name"
                                                       value="{{ $User_Info->Company_Name }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="cc-name" class="form-label">Email Address</label>
                                                <input readonly type="text" class="form-control" name="Card_Name"
                                                       value="{{ $User_Info->email }}">
                                            </div>
                                        </div>
                                        <input hidden type="text" class="form-control Reg_Fee" name="Reg_Fee"
                                               value="{{ $Payment_Info->Payment }}">
                                        <input hidden type="text" class="form-control User_ID" name="User_ID"
                                               value="{{ $User_Info->id }}">
                                        <div class="col-lg-12">
                                            <button type="submit" id="StripeSubmit"
                                                    class="btn btn-primary w-100 btn-label right ms-auto nexttab"
                                                    data-nexttab="pills-finish-tab"><i
                                                    class="ri-shopping-basket-line label-icon align-middle fs-16 ms-2"></i>Registration
                                                Fee ($ {{ number_format($Payment_Info->Payment) }})
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="text-muted mt-2 fst-italic">
                            <i data-feather="lock" class="text-muted icon-xs bx bx-lock-alt"></i> Your
                            transaction is secured with SSL encryption
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3 mt-4">
                        <a href="{{ route('User.Reg.Log.Back') }}" class="btn btn-light btn-label previestab"
                           data-previous="pills-bill-address-tab"><i
                                class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Log Out</a>
                    </div>
                </div>
                <!-- end tab pane -->
            </div>
            <!-- end tab content -->
        </div>
        <!-- end card body -->
    </div>
    <!-- end card -->
</div>

<script type="text/javascript">
    $('#paymentMethod01').click(function () {
        $('#paymentmethodCollapsePayPal').addClass('show');
        $('#paymentmethodCollapseStripe').removeClass('show');
    });
    $('#paymentMethod02').click(function () {
        $('#paymentmethodCollapsePayPal').removeClass('show');
        $('#paymentmethodCollapseStripe').addClass('show');
    });
</script>
