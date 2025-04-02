<!-- Start Register Area -->
<div class="register-area bg-image">
    <div class="d-table">
        <div class="container my-5">
            <div class="register-form">
                <div class="logo">
                    <a href="{{ route('User.Dashboard') }}"><img src="{{ asset('frontend/img/logo/logo.png') }}"
                                                                 alt="image"></a>
                </div>
                <h2>SIGN UP NOW</h2>
                <p>Day Dispatch users may post or take any types of loads for free. It is simple, secure, and completely
                    free for both brokers, and carriers. To publish or accept a load, you must first sign in. All fields
                    must be filled out.

                </p>

                <form action="{{ route('Auth.Reg.User') }}" method="POST" class="">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12"></div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <select id="Roles" class="form-control" name="User_Type" data-live-search="true"
                                        title="Select Role" required>
                                    @forelse($User_Roles as $role)
                                        <option value="{{ $role->User_Roles }}">{{ $role->User_Roles }}</option>
                                    @empty
                                        <option value="">Select AnyOne</option>
                                    @endforelse
                                </select>
                                <span class="label-title"><i class='bx bx-building'></i></span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12"></div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="Company_Name" maxlength="40"
                                       placeholder="Company Name" autocomplete="off"
                                       onkeypress="return /^[a-zA-Z\s]*$/g.test(event.key)" required>
                                <span class="label-title"><i class='bx bx-building'></i></span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <input type="text" id="Company_USDot" class="form-control" name="Company_USDot"
                                       maxlength="8"
                                       placeholder="USDOT Number" autocomplete="off" required>
                                <span class="label-title"><i class='bx bx-file'></i></span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <input type="text" id="Mc_Number" class="form-control" name="Mc_Number" maxlength="8"
                                       placeholder="MC Number" autocomplete="off" required>
                                <span class="label-title"><i class='bx bx-file'></i></span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <input type="email" class="form-control" name="Company_Email" maxlength="50"
                                       placeholder="Login Email" autocomplete="off" required>
                                <span class="label-title"><i class='bx bx-envelope'></i></span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <input id="user_password" type="password" class="form-control" name="Company_Password"
                                       placeholder="Password" onkeyup="match_password()" required>
                                <span class="label-title"><i class='bx bx-lock'></i></span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <input id="user_password2" type="password" class="form-control"
                                       name="password_confirmation" placeholder="Confirm Password"
                                       onkeyup="match_password()" required>
                                <span class="label-title"><i class='bx bx-lock'></i></span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <select class="form-control" name="Company_Country" data-live-search="true"
                                        title="Select Country" required>
                                    <option value="United State America (USA)">United State America (USA)</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Canada">Canada</option>
                                </select>
                                <span class="label-title"><i class='bx bx-building'></i></span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
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
                                <span class="label-title"><i class='bx bx-building'></i></span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="Company_City" maxlength="40"
                                       placeholder="City Name" autocomplete="off"
                                       onkeypress="return /^[a-zA-Z\s]*$/g.test(event.key)" required>
                                <span class="label-title"><i class='bx bxs-city'></i></span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control phone-number" name="Contact_Phone"
                                       maxlength="14" placeholder="Phone Number" autocomplete="off"
                                       onkeypress="return onlyNumberKey(evnt)" required>
                                <span class="label-title"><i class='bx bx-phone'></i></span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <input id="Business_Licence" type="text" class="form-control" name="Business_Licence"
                                       maxlength="8"
                                       placeholder="Business Licence" autocomplete="off">
                                <span class="label-title"><i class='bx bx-file'></i></span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="ref_code" maxlength="15"
                                       placeholder="Agent/Dispatcher Referral Code (Optional)" autocomplete="off">
                                <span class="label-title"><i class='bx bx-git-repo-forked'></i></span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="Company_Address" maxlength="100"
                                       placeholder="Complete Address" autocomplete="off" required>
                                <span class="label-title"><i class='bx bx-home'></i></span>
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

                        <button type="submit" class="register-btn">Sign Up</button>
                    </div>

                    <p class="mb-0">Already have account? <a href="{{ route('Auth.Forms') }}">Sign In</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Register Area -->

<script>
    $('.check_password2').click(function () {
        {
            var upas = $('#user_password').val();
            var upas2 = $('#user_password2').val();

            var count_upas = upas.length;
            var count_upa2 = upas2.length;
            var five = 5;
            var check = true;


            if (count_upa2 < five) {
                check = false;
            }

            if (count_upas < five) {
                check = false;
            }

            if (upas !== upas2) {
                check = false;
            }


            if (check !== false) {
                $('#form').submit();
            } else {
                $(".alert").show();
                $("input").focus();
                window.scrollTo(0, 0);
            }
        }
    });

    function match_password() {

        var upas = $('#user_password').val();
        var upas2 = $('#user_password2').val();


        var count_upas = upas.length;
        var count_upa2 = upas2.length;
        var five = 5;
        var check = true;


        if (count_upa2 < five) {
            check = false;
        }
        if (count_upas < five) {
            check = false;
        }
        if (upas !== upas2) {
            check = false;
        }

        if (check !== false) {
            $('#user_password2').css("border", "2px solid #00ffad");
            $('#user_password').css("border", "2px solid #00ffad");
        } else {
            $('#user_password2').css("border", "2px solid red");
            $('#user_password').css("border", "2px solid red");
        }
    }

    $('#Roles').change(function () {
        var role = $(this).val();
        if (role === 'Carrier' || role === 'Broker') {
            $('#Mc_Number').attr('required', true);
            $('#Company_USDot').attr('required', true);
            $('#Business_Licence').attr('required', false);
        } else {
            $('#Mc_Number').attr('required', false);
            $('#Company_USDot').attr('required', false);
            $('#Business_Licence').attr('required', true);
        }
    });
</script>