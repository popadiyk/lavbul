<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Лавка-Булавка') }}</title>
  <!-- Styles -->
  <link href="{{ asset('css/jumbotron-narrow.css') }}" rel="stylesheet">
  <link href="{{ asset('css/header.css') }}" rel="stylesheet">
  <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
  <link href="{{ asset('css/feedback.css')}}" rel="stylesheet">
  <link href="{{ asset('css/contacts.css')}}" rel="stylesheet">
  <link href="{{ asset('css/swiper.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ asset('css/mdb.css') }}" rel="stylesheet">
  <link href="{{ asset('css/datepicker.css') }}" rel="stylesheet">
  <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
  <link href="{{ asset('css/animation.css') }}" rel="stylesheet">
  <link href="{{ asset('css/main_page_content.css')}}" rel="stylesheet">
  <link href="{{ asset('css/products.css')}}" rel="stylesheet">
  <link href="{{ asset('css/one_product.css')}}" rel="stylesheet">
  <link href="{{ asset('css/payments.css')}}" rel="stylesheet">
  <link href="{{ asset('css/about_us.css')}}" rel="stylesheet">
  <link href="{{ asset('css/products-list.css')}}" rel="stylesheet">

  <script src={{ asset('js/jquery-3.2.1.min.js')}}></script>
  <script src={{ asset('js/tether.min.js') }}></script>
  <script src={{ asset('js/bootstrap.min.js') }}></script>
  <script src={{ asset('js/mdb.min.js') }}></script>
  <script src={{ asset('js/datepicker.js') }}></script>
  <script src={{ asset('js/swiper.jquery.min.js')}}></script>
  <script src={{ asset('js/wow.js')}}></script>


  <style>
      #our_location{
          border: 5px solid coral;
          border-radius: 6px;
      }
  </style>
  @php($store_name = "Лавка-Булавка!")

</head>
<body >
    
        