<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en">
<head>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>The Newsroom - Admin</title>

        <meta name="theme-name" content="thenewsroom" />

        <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">

        <link href="{{ asset('backend/plugins/material/css/materialdesignicons.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('backend/plugins/simplebar/simplebar.css') }}" rel="stylesheet" />

        <link id="main-css-href" rel="stylesheet" href="{{ asset('backend/css/style.css') }}" />
        <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}" />

        @include('frontend.components.favicon')

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
</head>
<body class="bg-light-gray" id="body">
    <div class="container d-flex align-items-center justify-content-center">
        <div class="d-flex flex-column justify-content-between">
            <div class="backend-login">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-10">
                        <div class="card card-default mb-0">
                            <div class="card-header pb-0">
                                <div class="app-brand w-100 d-flex justify-content-center border-bottom-0">
                                    <a class="w-auto pl-0" href="{{ route('admin.login') }}">
                                        <img src="{{ asset('frontend/images/logos/logo.png') }}" alt="The Newsroom">
                                    </a>
                                </div>
                            </div>

                            <div class="card-body px-5 pb-5 pt-0">

                                <h4 class="text-dark mb-6 text-center">Admin area</h4>

                                <form action="/index.html">
                                    <div class="row">
                                        <div class="form-group col-md-12 mb-4">
                                            <input type="email" class="form-control input-lg" id="email" aria-describedby="emailHelp"
                                                   placeholder="email">
                                        </div>
                                        <div class="form-group col-md-12 ">
                                            <input type="password" class="form-control input-lg" id="password" placeholder="Password">
                                        </div>
                                        <div class="col-md-12">

                                            <div class="d-flex justify-content-between mb-3">

                                                <div class="custom-control custom-checkbox mr-3 mb-3">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                    <label class="custom-control-label" for="customCheck2">Remember me</label>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-pill mb-4">Sign In</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
