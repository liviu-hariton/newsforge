@extends('layouts.frontend')

@section('content')
    <div class="login-signup">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-7">
                    <div class="login">
                        <h3 class="mt-4">Login Here</h3>
                        <p class="mb-5">Enter your valid mail & password</p>
                        <form action="#" class="login-form row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="loginemail">Email</label>
                                    <input type="text" id="loginemail" class="form-control" name="loginemail" placeholder="Enter mail" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="loginPassword">Password</label>
                                    <input type="password" id="loginPassword" class="form-control" name="loginPassword" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary" type="submit">Login</button>

                                <p class="mt-5 mb-0">Not a member yet? <a href="{{ route('register') }}">Register Here</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
