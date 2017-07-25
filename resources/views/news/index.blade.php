@extends('layouts.main')
@section('content')
@php($text = "Дізнайтесь про всі новини першими!")
@include('news.header', ['text' => $text ])
<div class="container-fluid">
	<div class="container">
	{{-- TO DO SORTING --}}
{{-- 		<div class="row" style="padding-top: 40px; padding-bottom: 40px;">
			<div class="col-md-4">
	            <input class="pull-left" style="width:80%" data-toggle="datepicker" placeholder="Дата">
				<div data-toggle="datepicker"></div>
			</div>
			<div class="col-md-4 text-center">
				{{ Form::select('theme', ['1' => 'декупаж', '2' => 'вязание'], null, ['placeholder' => 'Оберіть тему...', 'style' => 'width:80%']) }}
			</div>
			<div class="col-md-4">
			    {{ Form::select('tag', ['1' => 'салфетки', '2' => 'метелики', '3' => 'ляльки мотанки'], null, ['placeholder' => 'Теги...', 'style' => 'width:80%', 'class' => 'pull-right']) }}
			</div>		
		</div> --}}
		@foreach ($news as $item)
			<div class="row" style="padding-top: 40px; padding-bottom: 40px;">
				<div class="col-md-4">
					<img src="{{$item->main_photo}}" width="100%" alt="" style="border-radius: 10px; box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
				</div>
				<div class="col-md-8">
					<h3 class="text-center" style="width:100%; margin-top: 0px; font-weight: bolder; text-shadow: 2px 2px 4px #000000;">{{$item->title}}<br>
						<small class="pull-right">{{$item->created_at}}</small>
					</h3>
					
					<hr>
					<p style="text-align: justify;">{{$item->description}}</p>
					<a href="{{ url('/news/'.$item->id ) }}" class="btn btn-default waves-effect waves-light btn-lg text-uppercase" style="text-decoration: none;">Читати далі</a>
				</div>
			</div>
		@endforeach
		<div class="row" style="padding-bottom: 20px;">
			<div class="col-md-12">
				<nav">
				{{-- TO DO AJAX PAGINATION --}}
					{{-- @include('components.pagination',['products'=>$news]) --}}
				</nav>
			</div>
		</div>
	</div>
</div>
@endsection