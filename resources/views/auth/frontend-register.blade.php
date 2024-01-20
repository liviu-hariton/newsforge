@extends('layouts.frontend')

@section('content')
    <div class="login-signup">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-5">
                    <h3>Unlock a world of exclusive benefits and personalized updates by creating your own user account!</h3>

                    <p class="lead mb-5 mt-3">Signing up is quick, easy, and absolutely free! Don't just follow the news—immerse yourself in it. Seize this opportunity to enhance your news experience and be part of a community that shares your passion for staying informed.</p>

                    <h4>Why miss out on the perks?</h4>

                    <ul class="info-list mt-3">
                        <li>Personalized News Feed: Tailor your feed to match your interests and stay ahead of the curve.</li>
                        <li>Exclusive Content: Gain access to premium articles, in-depth analyses, and thought-provoking features.</li>
                        <li>Customized Alerts: Be the first to know with personalized notifications on breaking news and topics that matter to you. </li>
                        <li>Create your account now and embark on a journey where news meets personalization!</li>
                    </ul>
                </div>
                <div class="col-lg-7">
                    <div class="signup">
                        <h3 class="mt-4">Elevate Your News Experience!</h3>
                        <hr>
                        <p class="mb-5">Join our vibrant community of informed enthusiasts who enjoy a tailored news journey.</p>

                        <form method="POST" action="{{ route('register') }}" class="signup-form row">
                            @csrf

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="f-name">Your Name</label>
                                    <input type="text" class="form-control" id="f-name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter your name here">

                                    @error('name')
                                    <div class="validation-invalid-label">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email-address">Your Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" id="email-address" placeholder="Enter your email address">

                                    @error('email')
                                    <div class="validation-invalid-label">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password-s">Your Password</label>
                                    <input type="password" class="form-control" id="password-s" name="password" required autocomplete="new-password" placeholder="Your strong password">

                                    @error('password')
                                    <div class="validation-invalid-label">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Repeat Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" placeholder="Repeat your strong password">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-primary" type="submit">Sign Up</button>
                                <p class="mt-5 mb-0">Already a member? <a href="{{ route('login') }}">Log in</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
