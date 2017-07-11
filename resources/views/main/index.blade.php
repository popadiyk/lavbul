@extends('layouts.main')
@section('content')
    <!-- Swiper -->
    @include('components.swiper')
    <!-- BEGIN CONTENT -->
    <div class="container-fluid advertise-block">
        <div class="container">
            <!-- begin advertise --> 
            @include('main.advertise')
            <!-- advertise --> 
            <!-- LIST OF PRODUCTS -->    
            @include('main.products')
            <!-- LIST OF PRODUCTS -->
        </div>
    </div>
    <!-- part for partners -->
    <div class="container-fluid hidden-xs hidden-sm partners-block">
        <div class="container">
            @include('main.partners')
        </div>
    </div>
    <!-- end of part for partners -->
@endsection