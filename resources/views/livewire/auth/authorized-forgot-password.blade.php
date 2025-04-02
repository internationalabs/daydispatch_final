<div class="forgot-password-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="forgot-password-content">
                <div class="row m-0">
                    <div class="col-lg-5 p-0">
                        <div class="image">
                            <img src="{{ asset('backend/img/computer.png') }}" alt="image">
                        </div>
                    </div>

                    <div class="col-lg-7 p-0">
                        <div class="forgot-password-form">
                            <h2>Recover your password</h2>
                            <p class="mb-0">Please provide the email address that you used when you signed up for your Day Dispatch account.</p>

                            <form action="{{ route('Post.Forget.Password') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email address">
                                    <span class="label-title"><i class="bx bx-envelope"></i></span>
                                </div>

                                <button type="submit" class="forgot-password-btn">Send Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
