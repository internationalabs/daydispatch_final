<!-- auth page content -->
<div class="auth-page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mt-sm-5 mb-4 text-white-50">
                    <div>
                        <a href="{{ route('Frontend.index') }}" class="d-inline-block auth-logo">
                            <img src="{{ asset('frontend/img/logo/logo.png') }}" alt="" height="20">
                        </a>
                    </div>
                    <p class="mt-3 fs-15 fw-medium">Day Dispatch | Admin Registration</p>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card mt-4">

                    <div class="card-body p-4">
                        <div class="text-center mt-2">
                            <h5 class="text-primary">Create New Account</h5>
                            <p class="text-muted">Get your free Day Dispatch account now</p>
                        </div>
                        <div class="p-2 mt-4">
                            <form action="{{ route('Auth.Reg.Admin') }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                <div class="mb-3">
                                    <label for="useremail" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="useremail" name="Admin_Email" maxlength="70" placeholder="Enter email address" required>
                                    <div class="invalid-feedback">
                                        Please enter email
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="username" onkeypress="return /^[a-zA-Z\s]*$/g.test(event.key)" name="Admin_Name" maxlength="50" placeholder="Enter Full Name" required>
                                    <div class="invalid-feedback">
                                        Please enter username
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                                    <select class="form-control" id="role" name="role" required>
                                        <option value="">Select Role</option>
                                        <option value="1">Admin</option>
                                        <option value="2">General Manager</option>
                                        <option value="3">Manager</option>
                                        <option value="4">Supervisor</option>
                                        <option value="5">QA</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a role
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="password-input">Password</label>
                                    <div class="position-relative auth-pass-inputgroup">
                                        {{-- pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"--}}
                                        <input type="password" class="form-control pe-5 password-input" name="Admin_Password" onpaste="return false" placeholder="Enter password" id="password-input" aria-describedby="passwordInput" required>
                                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                        <div class="invalid-feedback">
                                            Please enter password
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <p class="mb-0 fs-12 text-muted fst-italic">By registering you agree to the Admin <a href="JavaScript:void(0);" class="text-primary text-decoration-underline fst-normal fw-medium">Terms of Use</a></p>
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
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="mt-4 text-center">
                    <p class="mb-0">Already have an account ? <a href="{{ route('Auth.Admin.Forms') }}" class="fw-semibold text-primary text-decoration-underline"> Signin </a> </p>
                </div>

            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end auth page content -->
