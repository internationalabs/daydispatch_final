<div class="col-lg-6">
    <div class="p-lg-5 p-4">
        <div>
            <h5 class="text-primary">Register Account</h5>
            <p class="text-muted">Get your Free Day Dispatch account now.</p>
        </div>

        <div class="mt-4">
            <form action="{{ route('Auth.Reg.Agent') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Full Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="username"
                           onkeypress="return /^[a-zA-Z\s]*$/g.test(event.key)" name="Agent_Name" maxlength="50"
                           placeholder="Enter Full Name" required>
                    <div class="invalid-feedback">
                        Please enter username
                    </div>
                </div>
                <div class="mb-3">
                    <label for="useremail" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="useremail" name="Agent_Email" maxlength="70"
                           placeholder="Enter Email Address" required>
                    <div class="invalid-feedback">
                        Please enter email
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password-input">Password</label>
                    <div class="position-relative auth-pass-inputgroup">
                        <input type="password" class="form-control pe-5 password-input" onpaste="return false"
                               placeholder="Enter password" id="password-input" name="Agent_Password"
                               aria-describedby="passwordInput"
                               required>
                        {{--                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"--}}
                        <button
                            class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                            type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                        <div class="invalid-feedback">
                            Please enter password
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Phone Number <span class="text-danger">*</span></label>
                    <input type="text" class="form-control phone-number" name="Agent_Phone"
                           placeholder="Enter Phone Number" required>
                    <div class="invalid-feedback">
                        Please enter Phone Number
                    </div>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Full Address <span class="text-danger">*</span></label>
                    <textarea name="Agent_Address" class="form-control" placeholder="Enter Complete Address"
                              required></textarea>
                    <div class="invalid-feedback">
                        Please enter Address
                    </div>
                </div>

                <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                    <h5 class="fs-13">Password must contain:</h5>
                    <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8 characters</b></p>
                    <p id="pass-lower" class="invalid fs-12 mb-2">At <b>lowercase</b> letter (a-z)</p>
                    <p id="pass-upper" class="invalid fs-12 mb-2">At least <b>uppercase</b> letter (A-Z)</p>
                    <p id="pass-number" class="invalid fs-12 mb-0">A least <b>number</b> (0-9)</p>
                </div>

                <div class="mt-4">
                    <button class="btn btn-success w-100" type="submit">Sign Up</button>
                </div>
            </form>
        </div>

        <div class="mt-5 text-center">
            <p class="mb-0">Already have an account ? <a href="{{ route('Auth.Agent.Forms') }}"
                                                         class="fw-semibold text-primary text-decoration-underline">
                    Signin</a></p>
        </div>
    </div>
</div>
