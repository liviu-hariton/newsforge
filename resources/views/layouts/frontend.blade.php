<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>The Newsroom</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="theme-name" content="thenewsroom"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('frontend.components.favicon')

    @vite(['resources/css/frontend.css'])
</head>
<body>

<div class="trending-bar-dark hidden-xs">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                @include('frontend.components.top_trending')
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12 top-nav-social-lists text-lg-right col-lg-4 ml-lg-auto">
                @include('frontend.components.top_links')
            </div>

        </div>
    </div>
</div>

<header class="header-navigation d-none d-lg-block">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-xs-12 col-sm-3 col-md-3">
                @include('frontend.components.logo')
            </div>
            <div class="col-xs-12 col-sm-9 col-md-9">
                @include('frontend.components.top_ad_banner')
            </div>
        </div>
    </div>
</header>

@include('frontend.components.main_menu')

@yield('breadcrumbs')

@yield('content')

@include('frontend.components.footer')

@vite(['resources/js/frontend.js'])
</body>
</html>
