@extends('layouts.main')

@section('Header')
    @include('/components/header/main_page_header')
@endsection

@section('Content')
    @include('/components/content/one_product_content')
@endsection

@section('Footer')
    @include('/components/footer/footer')
@endsection