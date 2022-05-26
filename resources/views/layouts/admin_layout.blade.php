<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <!-- jQuery -->
    <script src="{{asset('dist/adminLTE/jquery.min.js')}}"></script>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('dist/adminLTE/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/adminLTE/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/AppAdmin.css') }}">

    {{--ckeditor--}}
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
    {{--    alert--}}
    <div id="alert_admin" class="alert position-fixed text-truncate" style="max-width: 250px" role="alert">

    </div>
    {{--    modal--}}
    @include("blocks.modal_admin")
    {{--    navbar--}}
    @include("blocks.nav_admin")

    {{--    Main Sidebar Container--}}
    @include("blocks.sidebar_admin")

    {{--     Content--}}
    @include("pages.dashboard_admin")

    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.1.0
        </div>
    </footer>
</div>

<!-- REQUIRED SCRIPTS -->

<!-- Bootstrap -->
<script src="{{ asset('dist/adminLTE/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE -->
<script src="{{ asset('dist/adminLTE/adminlte.js') }}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('dist/adminLTE/Chart.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/adminLTE/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/adminLTE/dashboard3.js') }}"></script>


<script src="{{asset('js/admin/AppAdmin.js')}}"></script>
</body>
</html>
