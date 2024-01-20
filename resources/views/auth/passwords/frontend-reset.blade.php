@extends('layouts.frontend')

@section('content')
    <div class="login-signup">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-7">
                    <div class="login">
                        <h3 class="mt-4">Password reset</h3>
                        <p class="mb-5">Enter your email address and your new password</p>

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="login-email">Email address</label>
                                        <input type="email" id="login-email" name="email" class="form-control" value="{{ $email ?? old('email') }}" placeholder="Enter your email address" required autocomplete="email">

                                        @error('email')
                                        <div class="validation-invalid-label">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password-s">New Password</label>
                                        <input type="password" class="form-control" id="password-s" name="password" required autocomplete="new-password" placeholder="Your strong new password" autofocus>

                                        @error('password')
                                        <div class="validation-invalid-label">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation">Repeat the new Password</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" placeholder="Repeat your strong new password">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Update password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
