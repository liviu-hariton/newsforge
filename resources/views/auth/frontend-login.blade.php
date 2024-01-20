@extends('layouts.frontend')

@section('content')
    <div class="login-signup">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-7">
                    <div class="login">
                        <h3 class="mt-4">Your account</h3>
                        <p class="mb-5">Enter your valid email & password to login</p>

                        <form method="POST" action="{{ route('login') }}">
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
                                    <div class="form-group">
                                        <label for="login-password">Password</label>

                                        @if(Route::has('password.request'))
                                            <a class="text-danger d-inline-block float-right" href="{{ route('password.request') }}"><small>forgot your password?</small></a>
                                        @endif
                                        <input type="password" id="login-password" name="password" class="form-control" placeholder="Enter your Password" required autocomplete="current-password">

                                        @error('password')
                                        <div class="validation-invalid-label">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">remember me</label>
                                    </div>
                                </div>
                                <div class="col-md-4 text-right">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </div>
                        </form>

                        <p class="mt-5 mb-0">Not a member yet? <a href="{{ route('register') }}">Register Here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
