<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">

    <!-- bootstrap -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <script src="{{ asset('js/bootstrap.js') }}"></script>

</head>
<body>
        @yield('Header')

        @yield('Left_Sidebar')

        @yield('Content')

        @yield('Right_Sidebar')

        @yield('Footer')
</body>
</html>