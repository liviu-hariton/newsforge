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

    <link href="{{ asset('backend/plugins/material/css/materialdesignicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/simplebar/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/nprogress/nprogress.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/quill/quill.snow.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/toaster/toastr.min.css') }}" rel="stylesheet" />

    <link id="main-css-href" rel="stylesheet" href="{{ asset('backend/css/style.css') }}" />
    <link id="main-css-href" rel="stylesheet" href="{{ asset('backend/css/custom.css') }}" />

    @include('frontend.components.favicon')

    {{--HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries--}}
    {{--WARNING: Respond.js doesn't work if you view the page via file://--}}
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="{{ asset('backend/plugins/nprogress/nprogress.js') }}"></script>

    <script>(function(w,d,u){w.readyQ=[];w.bindReadyQ=[];function p(x,y){if(x=="ready"){w.bindReadyQ.push(y);}else{w.readyQ.push(x);}};var a={ready:p,bind:p};w.$=w.jQuery=function(f){if(f===d||f===u){return a}else{p(f)}}})(window,document)</script>
</head>

<body class="navbar-fixed sidebar-fixed" id="body">

<div id="toaster"></div>
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

<!-- Card Offcanvas -->
<div class="card card-offcanvas" id="contact-off" >
    <div class="card-header">
        <h2>Contacts</h2>
        <a href="#" class="btn btn-primary btn-pill px-4">Add New</a>
    </div>
    <div class="card-body">

        <div class="mb-4">
            <input type="text" class="form-control form-control-lg form-control-secondary rounded-0" placeholder="Search contacts...">
        </div>

        <div class="media media-sm">
            <div class="media-sm-wrapper">
                <a href="user-profile.html">
                    <img src="{{ asset('backend/images/user/user-sm-01.jpg') }}" alt="User Image">
                    <span class="active bg-primary"></span>
                </a>
            </div>
            <div class="media-body">
                <a href="user-profile.html">
                    <span class="title">Selena Wagner</span>
                    <span class="discribe">Designer</span>
                </a>
            </div>
        </div>

        <div class="media media-sm">
            <div class="media-sm-wrapper">
                <a href="user-profile.html">
                    <img src="{{ asset('backend/images/user/user-sm-02.jpg') }}" alt="User Image">
                    <span class="active bg-primary"></span>
                </a>
            </div>
            <div class="media-body">
                <a href="user-profile.html">
                    <span class="title">Walter Reuter</span>
                    <span>Developer</span>
                </a>
            </div>
        </div>

        <div class="media media-sm">
            <div class="media-sm-wrapper">
                <a href="user-profile.html">
                    <img src="{{ asset('backend/images/user/user-sm-03.jpg') }}" alt="User Image">
                </a>
            </div>
            <div class="media-body">
                <a href="user-profile.html">
                    <span class="title">Larissa Gebhardt</span>
                    <span>Cyber Punk</span>
                </a>
            </div>
        </div>

        <div class="media media-sm">
            <div class="media-sm-wrapper">
                <a href="user-profile.html">
                    <img src="{{ asset('backend/images/user/user-sm-04.jpg') }}" alt="User Image">
                </a>

            </div>
            <div class="media-body">
                <a href="user-profile.html">
                    <span class="title">Albrecht Straub</span>
                    <span>Photographer</span>
                </a>
            </div>
        </div>

        <div class="media media-sm">
            <div class="media-sm-wrapper">
                <a href="user-profile.html">
                    <img src="{{ asset('backend/images/user/user-sm-05.jpg') }}" alt="User Image">
                    <span class="active bg-danger"></span>
                </a>
            </div>
            <div class="media-body">
                <a href="user-profile.html">
                    <span class="title">Leopold Ebert</span>
                    <span>Fashion Designer</span>
                </a>
            </div>
        </div>

        <div class="media media-sm">
            <div class="media-sm-wrapper">
                <a href="user-profile.html">
                    <img src="{{ asset('backend/images/user/user-sm-06.jpg') }}" alt="User Image">
                    <span class="active bg-primary"></span>
                </a>
            </div>
            <div class="media-body">
                <a href="user-profile.html">
                    <span class="title">Selena Wagner</span>
                    <span>Photographer</span>
                </a>
            </div>
        </div>

    </div>
</div>

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
<script>
    jQuery(document).ready(function() {
        jQuery('input[name="dateRange"]').daterangepicker({
            autoUpdateInput: false,
            singleDatePicker: true,
            locale: {
                cancelLabel: 'Clear'
            }
        });
        jQuery('input[name="dateRange"]').on('apply.daterangepicker', function (ev, picker) {
            jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
        });
        jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function (ev, picker) {
            jQuery(this).val('');
        });
    });
</script>

<script src="{{ asset('backend/plugins/quill/quill.min.js') }}"></script>

<script src="{{ asset('backend/plugins/toaster/toastr.min.js') }}"></script>

<script src="{{ asset('backend/js/mono.js') }}"></script>
<script src="{{ asset('backend/js/chart.js') }}"></script>
<script src="{{ asset('backend/js/map.js') }}"></script>
<script src="{{ asset('backend/js/custom.js') }}"></script>

</body>
</html>
