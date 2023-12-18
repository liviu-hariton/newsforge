<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>The Newsroom - Admin</title>

    <meta name="theme-name" content="thenewsroom" />

    @vite(['resources/css/backend.css'])

    @include('frontend.components.favicon')

    {{--HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries--}}
    {{--WARNING: Respond.js doesn't work if you view the page via file://--}}
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>
</head>

<body class="navbar-fixed sidebar-fixed" id="body">

<script>
    NProgress.configure({ showSpinner: false });
    NProgress.start();
</script>

<div id="toaster"></div>

<div class="wrapper">
    @include('backend.components.menu')

    <div class="page-wrapper">
        @include('backend.components.header')

        <div class="content-wrapper">
            @yield('main-content')
        </div>

        @include('backend.components.footer')
    </div>
</div>

@vite(['resources/js/backend.js'])

</body>
</html>
