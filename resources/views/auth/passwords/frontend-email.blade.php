@extends('layouts.frontend')

@section('content')
    <div class="login-signup">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-7">
                    <div class="login">
                        <h3 class="mt-4">Password reset request</h3>
                        <p class="mb-5">Enter your email address and we'll send you a link to reset your password</p>

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="login-email">Email address</label>
                                        <input type="email" id="login-email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter your email address" required autocomplete="email" autofocus>

                                        @error('email')
                                        <div class="validation-invalid-label">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
                                </div>
                            </div>
                        </form>

                        <p class="mt-5 mb-0 text-center">
                            Remembered your password? <a href="{{ route('login') }}">Login Here</a><br />
                            Not a member yet? <a href="{{ route('register') }}">Register Here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
