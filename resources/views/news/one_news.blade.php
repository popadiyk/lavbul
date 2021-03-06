@extends('layouts.main')
@section('pageTitle', 'Новини:')
@section('metaTitle', $news->title)
@section('metaKeyword', 'hand-made ! новини ')
@section('content')
@php($text = $news->title)
@include('news.header', ['text' => $text ])
<div class="container-fluid">
	<div class="container">
		<div class="row" style="padding-top: 40px; padding-bottom: 40px;">
			<div class="col-md-12">
				{{-- <h3 style="font-weight: bolder; text-shadow: 2px 2px 4px #000000;">{{$news->title}}</h3> --}}
				<p><img src="{{$news->main_photo}}" width="50%" alt="{{$news->title}}" style="float:left; border-radius: 10px; box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); margin: 10px 40px 20px 0px;">
				{!! $news->description !!}<br style="clear: both;" /></p>
			</div>
		</div>
	</div>
</div>
@endsection