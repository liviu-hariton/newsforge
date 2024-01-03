<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>The Newsroom - Admin</title>

    <meta name="theme-name" content="thenewsroom" />

    <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">

    <link href="{{ asset('backend/plugins/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/plugins/bootstrap-icons/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/plugins/material/css/materialdesignicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/simplebar/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/nprogress/nprogress.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/quill/quill.snow.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/toaster/toastr.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/dragula/dragula.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/xeditable/css/bootstrap-editable.css') }}" rel="stylesheet" />

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

<body class="navbar-fixed sidebar-fixed" id="body">

<div class="wrapper">
    @include('backend.components.menu')

    <div class="page-wrapper">
        @include('backend.components.header')

        <div class="content-wrapper">
            <div class="content content-inner">
                @include('backend.components.header-alerts')

                @yield('main-content')
            </div>
        </div>

        @include('backend.components.footer')
    </div>
</div>

@yield('bulk-actions')

@if(isset($_tnrs->google_maps_api_key))
<script src="https://maps.googleapis.com/maps/api/js?key={{ $_tnrs->google_maps_api_key }}"></script>
@endif

<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>

<script>(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)</script>

<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/plugins/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('backend/plugins/apexcharts/apexcharts.js') }}"></script>
<script src="{{ asset('backend/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jvectormap/jquery-jvectormap-world-mill.js') }}"></script>
<script src="{{ asset('backend/plugins/jvectormap/jquery-jvectormap-us-aea.js') }}"></script>
<script src="{{ asset('backend/plugins/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('backend/plugins/hotkeys-js/hotkeys.min.js') }}"></script>
<script src="{{ asset('backend/plugins/quill/quill.min.js') }}"></script>
<script src="{{ asset('backend/plugins/toaster/toastr.min.js') }}"></script>
<script src="{{ asset('backend/plugins/blockui/blockui.min.js') }}"></script>
<script src="{{ asset('backend/plugins/bootbox/bootbox.all.min.js') }}"></script>
<script src="{{ asset('backend/plugins/select2/js/select2.full.js') }}"></script>
<script src="{{ asset('backend/plugins/select2/js/i18n/'.str_replace('_', '-', app()->getLocale()).'.js') }}"></script>
<script src="{{ asset('backend/plugins/dragula/dragula.min.js') }}"></script>
<script src="{{ asset('backend/plugins/xeditable/js/bootstrap-editable.js') }}"></script>
<script src="{{ asset('backend/plugins/ays/jquery.are-you-sure.js') }}"></script>
<script src="{{ asset('backend/plugins/ays/ays-beforeunload-shim.js') }}"></script>

<script src="{{ asset('backend/js/mono.js') }}"></script>
<script src="{{ asset('backend/js/_tnr.js') }}"></script>
<script src="{{ asset('backend/js/_tnr_xhr.js') }}"></script>

</body>
</html>
