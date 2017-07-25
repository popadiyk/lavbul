@extends('layouts.main')
@section('content')
@php($text = $news->title)
@include('news.header', ['text' => $text ])
<div class="container-fluid">
	<div class="container">
		<div class="row" style="padding-top: 40px; padding-bottom: 40px;">
			<div class="col-md-12 text-center">
				{{-- <h3 style="font-weight: bolder; text-shadow: 2px 2px 4px #000000;">{{$news->title}}</h3> --}}
				<img src="{{$news->main_photo}}" width="60%" alt="" style="border-radius: 10px; box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); margin-top: 20px; margin-bottom: 20px;">
				<p style="text-align: justify;">{{$news->description}}</p>
			</div>
		</div>
	</div>
</div>
@endsection