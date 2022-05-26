<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>


    <!-- Styles -->
    @include("blocks.linkcss")

    <!-- Scripts -->
    @include("blocks.linkjs")

</head>
<body>
<div id="" class="">
    <div id="alert_admin" class="alert position-fixed text-truncate" style="max-width: 250px" role="alert">

    </div>
    <header class="">
        @include('blocks.header_user')
        @include('blocks.menu_user')
    </header>
    <main class="">
        @yield('content')
    </main>

    <footer>
        @include('blocks.footer')
    </footer>
</div>
</body>
</html>
