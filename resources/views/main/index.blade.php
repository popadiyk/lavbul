@extends('layouts.main')
@section('pageTitle', 'Перший магазин hand-made подарунків та товарів для рукоділля!')
@section('metaTitle', '')
@section('metaKeyword', 'Купити hand-made ! подарунки в Україні ! Купить товары для рукоделия ! Товари для рукоділля ! купить подарок на День Рождения ! купить подарок на День Рождения ! подарки для родных ! покарки для детей ! скрапбукинг ! кукла-тильда ! скрап ! валяння ! валяние ! фоамиран ! фом ! бисер')
@section('content')
    <!-- Swiper -->
    @include('components.swiper')
    <!-- BEGIN CONTENT -->
    <div class="container-fluid advertise-block">
        <div class="row" style="margin: 0;">
            <div class="col-xs-12 hidden-lg hidden-md" style="padding-top: 50px; margin-bottom: -30px; text-align: center;">
                <img src="img/max_logo.png" height="300" width="300">
            </div>
        </div>
        <div class="container">
            <!-- LIST OF PRODUCTS -->
            @include('main.products')
            <!-- LIST OF PRODUCTS -->
        </div>
    </div>
    <!-- part for partners -->
    <div class="container-fluid hidden-xs partners-block">
        <div class="container">
            @include('main.partners')
        </div>
    </div>
    <!-- end of part for partners -->

@endsection