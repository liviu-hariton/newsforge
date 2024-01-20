@extends('layouts.frontend')

@section('content')
    <div class="login-signup">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-7">
                    <div class="login">
                        <h3 class="mt-4">Verify Your Email for a Seamless Experience!</h3>

                        <p class="mb-2">To ensure the security and smooth functioning of your account, we kindly ask you to verify your email address.</p>

                        <p>If you did not receive the verification email</p>

                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">Click here to request another</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
