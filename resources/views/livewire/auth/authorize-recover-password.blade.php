<div class="reset-password-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="reset-password-content">
                <div class="row m-0">
                    <div class="col-lg-5 p-0">
                        <div class="image">
                            <img src="{{ asset('backend/img/computer.png') }}" alt="image">
                        </div>
                    </div>

                    <div class="col-lg-7 p-0">
                        <div class="reset-password-form">
                            <h2>Reset Your Password</h2>

                            <form method="POST" action="{{ route('Post.Reset.Password') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="Enter a new password">
                                    <span class="label-title"><i class="bx bx-lock"></i></span>
                                </div>

                                <div class="form-group">
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm your new password">
                                    <span class="label-title"><i class="bx bx-lock-alt"></i></span>
                                </div>

                                <button type="submit" class="reset-password-btn">Reset my Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
