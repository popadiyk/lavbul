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

  {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
  <link href="{{ asset('css/jumbotron-narrow.css') }}" rel="stylesheet">
  <link href="{{ asset('css/header.css') }}" rel="stylesheet">
  <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
  <link href="{{ asset('css/feedback.css')}}" rel="stylesheet">
  <link href="{{ asset('css/contacts.css')}}" rel="stylesheet">
  <link href="{{ asset('css/swiper.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
  <link href="{{ asset('css/animation.css') }}" rel="stylesheet">
  <link href="{{ asset('css/main_page_content.css')}}" rel="stylesheet">
   <link href="{{ asset('css/order.css')}}" rel="stylesheet">
  {{--<script src="{{ asset('js/bootstrap.js') }}"></script>--}}
   

</head>