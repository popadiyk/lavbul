@extends('layouts.main')

@section('Left_Sidebar')
    @include('/components/left_sidebar/main_page_left_sidebar')
@endsection

@section('Content')
    @include('/components/content/main_page_content')
@endsection

@section('Right_Sidebar')
    @include('/components/right_sidebar/main_page_right_sidebar')
@endsection

@section('Footer')
    @include('/components/footer/footer')
@endsection