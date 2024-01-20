<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - Admin</title>

    <meta name="theme-name" content="newsforge" />

    <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">

    <link href="{{ asset('backend/plugins/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/plugins/bootstrap-icons/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/plugins/material/css/materialdesignicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/simplebar/simplebar.css') }}" rel="stylesheet" />

    <link id="main-css-href" rel="stylesheet" href="{{ asset('backend/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/css/components.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/css/colors.css') }}" />

    @include('frontend.components.favicon')

        <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>(function(w,d,u){w.readyQ=[];w.bindReadyQ=[];function p(x,y){if(x=="ready"){w.bindReadyQ.push(y);}else{w.readyQ.push(x);}};var a={ready:p,bind:p};w.$=w.jQuery=function(f){if(f===d||f===u){return a}else{p(f)}}})(window,document)</script>

    <script>
        const _locale = '{{ str_replace('_', '-', app()->getLocale()) }}';
    </script>
</head>
<body class="bg-light-gray" id="body">
    <div class="container d-flex align-items-center justify-content-center">
        <div class="d-flex flex-column justify-content-between">
            <div class="backend-login">
                <div class="row justify-content-center">
                    <div class="col-md-8">

                        @include('backend.components.header-alerts')

                        <div class="card card-default mb-0">
                            <div class="card-header pb-0">
                                <div class="app-brand w-100 d-flex justify-content-center border-bottom-0">
                                    <a class="w-auto pl-0" href="{{ route('admin.login') }}">
                                        <img src="{{ asset('frontend/images/logos/logo.png') }}" alt="{{ config('app.name') }}">
                                    </a>
                                </div>
                            </div>

                            <div class="card-body px-5 pb-5 pt-0">

                                <h4 class="text-dark mb-6 text-center">Admin area</h4>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="row">
                                        <div class="form-group col-md-12 mb-4">
                                            <input type="email" class="form-control input-lg" id="login-email" name="email" value="{{ old('email') }}" placeholder="Enter your email address" required autocomplete="email" autofocus>

                                            @error('email')
                                            <div class="validation-invalid-label">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12 ">
                                            <input type="password" class="form-control input-lg" id="login-password" name="password" placeholder="Enter your Password" required autocomplete="current-password">

                                            @error('password')
                                            <div class="validation-invalid-label">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-pill mb-4">Sign In</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <p class="mt-5 text-center"><a class="text-blue" href="{{ route('home') }}"><i class="fas fa-long-arrow-alt-left"></i> Go back to {{ config('app.name') }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>

    <script>(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)</script>
</body>
</html>
