<!DOCTYPE html>
<html onmousemove="parallax()" lang="{{ config('app.locale') }}">
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
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
    <link href="{{ asset('css/feedback.css')}}" rel="stylesheet">
    <link href="{{ asset('css/contacts.css')}}" rel="stylesheet">
    <link href="{{ asset('css/products.css')}}" rel="stylesheet">
     <link href="{{ asset('css/main_page_content.css')}}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Raleway|Roboto+Condensed" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=ABeeZee|Josefin+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- bootstrap -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    {{--<script src="{{ asset('js/bootstrap.js') }}"></script>--}}

    <!-- jQuery -->
    <script type="text/javascript" src={{asset('js/jquery.js')}}></script>


    <!-- Project Script -->
    <script type="text/javascript" src={{asset('js/header.js')}}></script>


</head>
<body>
       <!--  @yield('Header') -->

            @yield('Left_Sidebar')

            @yield('Content')

            @yield('Right_Sidebar')

        @yield('Footer')
</body>
</html>