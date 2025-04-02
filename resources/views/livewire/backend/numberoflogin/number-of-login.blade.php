@extends('layouts.authorized')

@section('content')
    <div class="container-flude mt-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="global-search-area mx-5 mb-3 z-0">
                    <div class="d-table">
                        <div class="d-table-cell">
                            <div class="search-form">
                                <h2>Number Of Login</h2>
                                <form id="payment-form" action="{{ route('store.number.of.login') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>User Name</label>
                                                <input type="text" class="form-control" value="{{ Auth::guard('Authorized')->user()->Company_Name }}" id="full_name" name="full_name" required>
                                            </div>
                                            {{-- <div class="form-group">
                                                <label for="full_name">Full Name</label>
                                                <input type="text" class="form-control" id="full_name" name="full_name" required>
                                            </div> --}}
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="number_of_login">Number of Login</label>
                                                <input type="number" class="form-control" id="number_of_login" name="number_of_login" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="amount">Amount</label>
                                                <input type="text" class="form-control" id="amount" name="amount" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="card-element">Card Details</label>
                                                <div id="card-element" class="form-control"></div>
                                                <div id="card-errors" role="alert"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="Select_Role">Select Role</label>
                                                <select id="Roles" class="form-control" name="User_Type" data-live-search="true"
                                                        title="Select Role" required>
                                                    @forelse($User_Roles as $role)
                                                        <option value="{{ $role->User_Roles }}">{{ $role->User_Roles }}</option>
                                                    @empty
                                                        <option value="">Select AnyOne</option>
                                                    @endforelse
                                                </select>
                                                {{-- <span class="label-title"><i class='bx bx-building'></i></span> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="Company_Name">Company Name</label>
                                                <input type="text" class="form-control" name="Company_Name" maxlength="40"
                                                    placeholder="Company Name" autocomplete="off"
                                                    onkeypress="return /^[a-zA-Z\s]*$/g.test(event.key)" required>
                                                {{-- <span class="label-title"><i class='bx bx-building'></i></span> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="USDOT_Number">USDOT Number</label>
                                                <input type="text" id="Company_USDot" class="form-control" name="Company_USDot"
                                                    maxlength="8"
                                                    placeholder="USDOT Number" autocomplete="off" required>
                                                {{-- <span class="label-title"><i class='bx bx-file'></i></span> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="MC_Number">MC Number</label>
                                                <input type="text" id="Mc_Number" class="form-control" name="Mc_Number" maxlength="8"
                                                    placeholder="MC Number" autocomplete="off" required>
                                                {{-- <span class="label-title"><i class='bx bx-file'></i></span> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="Login_Email">Login Email</label>
                                                <input type="email" class="form-control" name="Company_Email" maxlength="50"
                                                    placeholder="Login Email" autocomplete="off" required>
                                                {{-- <span class="label-title"><i class='bx bx-envelope'></i></span> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="Password"><span class="label-title"><i class='bx bx-lock'></i></span> Password</label>
                                                <input type="password" class="form-control" name="Company_Password"
                                                    placeholder="Password"  required>
                                                {{-- <span class="label-title"><i class='bx bx-lock'></i></span> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="Confirm_Password">Confirm Password</label>
                                                <input id="user_password2" type="password" class="form-control"
                                                    name="password_confirmation" placeholder="Confirm Password"
                                                        required>
                                                {{-- <span class="label-title"><i class='bx bx-lock'></i></span> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="Select_Country">Select Country</label>
                                                <select class="form-control" name="Company_Country" data-live-search="true"
                                                        title="Select Country" required>
                                                    <option value="United State America (USA)">United State America (USA)</option>
                                                    <option value="Mexico">Mexico</option>
                                                    <option value="Canada">Canada</option>
                                                </select>
                                                {{-- <span class="label-title"><i class='bx bx-building'></i></span> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="Select_State">Select State</label>
                                                <select class="form-control" name="Company_State" data-live-search="true"
                                                        title="Select State" required>
                                                    <option selected="" disabled="" value="default">State</option>
                                                    <option value="AL">Alabama</option>
                                                    <option value="AK">Alaska</option>
                                                    <option value="AZ">Arizona</option>
                                                    <option value="AR">Arkansas</option>
                                                    <option value="CA">California</option>
                                                    <option value="CO">Colorado</option>
                                                    <option value="CT">Connecticut</option>
                                                    <option value="DE">Delaware</option>
                                                    <option value="FL">Florida</option>
                                                    <option value="GA">Georgia</option>
                                                    <option value="HI">Hawaii</option>
                                                    <option value="ID">Idaho</option>
                                                    <option value="IL">Illinois</option>
                                                    <option value="IN">Indiana</option>
                                                    <option value="IA">Iowa</option>
                                                    <option value="KS">Kansas</option>
                                                    <option value="KY">Kentucky</option>
                                                    <option value="LA">Louisiana</option>
                                                    <option value="ME">Maine</option>
                                                    <option value="MD">Maryland</option>
                                                    <option value="MA">Massachusetts
                                                    </option>
                                                    <option value="MI">Michigan</option>
                                                    <option value="MN">Minnesota</option>
                                                    <option value="MS">Mississippi</option>
                                                    <option value="MO">Missouri</option>
                                                    <option value="MT">Montana</option>
                                                    <option value="NE">Nebraska</option>
                                                    <option value="NV">Nevada</option>
                                                    <option value="NH">New Hampshire
                                                    </option>
                                                    <option value="NJ">New Jersey</option>
                                                    <option value="NM">New Mexico</option>
                                                    <option value="NY">New York</option>
                                                    <option value="NC">North Carolina
                                                    </option>
                                                    <option value="ND">North Dakota</option>
                                                    <option value="OH">Ohio</option>
                                                    <option value="OK">Oklahoma</option>
                                                    <option value="OR">Oregon</option>
                                                    <option value="PA">Pennsylvania</option>
                                                    <option value="RI">Rhode Island</option>
                                                    <option value="SC">South Carolina
                                                    </option>
                                                    <option value="SD">South Dakota</option>
                                                    <option value="TN">Tennessee</option>
                                                    <option value="TX">Texas</option>
                                                    <option value="UT">Utah</option>
                                                    <option value="VT">Vermont</option>
                                                    <option value="VA">Virginia</option>
                                                    <option value="WA">Washington</option>
                                                    <option value="DC">Washington DC
                                                    </option>
                                                    <option value="WV">West Virginia
                                                    </option>
                                                    <option value="WI">Wisconsin</option>
                                                    <option value="WY">Wyoming</option>
                                                </select>
                                                {{-- <span class="label-title"><i class='bx bx-building'></i></span> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="City_Name">City Name</label>
                                                <input type="text" class="form-control" name="Company_City" maxlength="40"
                                                    placeholder="City Name" autocomplete="off"
                                                    onkeypress="return /^[a-zA-Z\s]*$/g.test(event.key)" required>
                                                {{-- <span class="label-title"><i class='bx bxs-city'></i></span> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="Contact_Phone">Phone Number</label>
                                                <input type="text" class="form-control phone-number" name="Contact_Phone"
                                                    maxlength="14" placeholder="Phone Number" autocomplete="off"
                                                    required>
                                                {{-- <span class="label-title"><i class='bx bx-phone'></i></span> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="Business_Licence">Business Licence</label>
                                                <input id="Business_Licence" type="text" class="form-control" name="Business_Licence"
                                                    maxlength="8"
                                                    placeholder="Business Licence" autocomplete="off">
                                                {{-- <span class="label-title"><i class='bx bx-file'></i></span> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="ref_code">Agent/Dispatcher Referral Code (Optional)</label>
                                                <input type="text" class="form-control" name="ref_code" maxlength="15"
                                                    placeholder="Agent/Dispatcher Referral Code (Optional)" autocomplete="off">
                                                {{-- <span class="label-title"><i class='bx bx-git-repo-forked'></i></span> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="Company_Address">Complete Address</label>
                                                <input type="text" class="form-control" name="Company_Address" maxlength="100"
                                                    placeholder="Complete Address" autocomplete="off" required>
                                                {{-- <span class="label-title"><i class='bx bx-home'></i></span> --}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="terms-conditions">
                                                <label class="checkbox-box">I accept <a href="#">Terms and Conditions</a>
                                                    <input type="checkbox" required>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        {{-- <button type="submit" class="register-btn">Sign Up</button> --}}
                                    </div>
                                    <button type="submit" class="search-btn">Pay Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var stripe = Stripe('pk_test_51MxvIfLXi5O85KsLry5H2N2Y4Iucz3tYL9kpQyfzZKq94dTb5weVlEjZQ403DSnPVMUm8015rapLGQLQgJjcCFnF00HqSlMZEX'); // Replace with your publishable key
            var elements = stripe.elements();
            var card = elements.create('card');
            card.mount('#card-element');

            card.addEventListener('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        var hiddenInput = document.createElement('input');
                        hiddenInput.setAttribute('type', 'hidden');
                        hiddenInput.setAttribute('name', 'stripeToken');
                        hiddenInput.setAttribute('value', result.token.id);
                        form.appendChild(hiddenInput);
                        form.submit();
                    }
                });
            });

            

            // var multiplier = parseFloat(Payment_Switches) || 0; // Default to 0 if the value is invalid or null
            var multiplier = parseFloat("{{ $Payment_Switches->Payment }}");
            
            $('#number_of_login').on('input', function() {
                var numberOfLogin = $(this).val();
                var amount = numberOfLogin * multiplier;
                $('#amount').val(amount);
            });

            // $('#number_of_login').on('input', function() {
            //     var numberOfLogin = $(this).val();
            //     var amount = numberOfLogin * 5;
            //     $('#amount').val(amount);
            // });
        });
    </script>
@endsection
