@extends('layouts.main')

@section('Header')
    @include('/components/header/main_page_header')
@endsection

@section('Left_Sidebar')
    @include('/components/left_sidebar/contacts_page_left_sidebar')
@endsection

@section('Content')
    @include('/components/content/contacts_page_content')
@endsection

@section('Footer')
    @include('/components/footer/footer')
@endsection