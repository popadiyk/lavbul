@extends('layouts.main')
@section('pageTitle', 'Записатись на майстер-класи у Вінниці')
@section('metaTitle', 'Записаться на мастер-классы в Виннице')
@section('metaKeyword', 'майстер-класи по скрапбукінгу, мастер-класс декупаж, скрапбукинг, кукла-тильда')
@section('content')
@php($text = "Навчайся тому, що приносить задоволення!")
@include('master_classes.header', ['text' => $text ])
<style>
	.modal-dialog.cascading-modal.modal-avatar {
	    margin-top: 12rem;
	}
</style>
<div class="container-fluid">
	<div class="container" style="padding-top: 40px;">
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
		@foreach ($masterclasses as $element)
			<div class="row" id="mkItem{{$element->id}}" style="background: rgba(252, 224, 215, 0.5); border-radius: 20px; padding-bottom: 40px;">
				<div class="col-md-4 imageMK" style="padding-bottom: 12px; padding-top: 12px;">
					<img src="{{ $element->main_photo }}" width="100%" style="border-radius: 10px; box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" alt="">
				</div>
				<div class="col-md-8 contentMK">
					Майстер-клас#{{$element->id}}
					<h3 style="margin-top: 0px;">{{ $element->title }}</h3>
					<h5><small>техніка:</small> {{ $element->technology }} / @if ($element->status == 'active') <span style="color:green; margin: 0px;">ТРИВАЄ НАБІР</span> @elseif ($element->status == 'full') <span style="color:blue; margin: 0px;">ГРУПА СФОРМОВАНА</span> @else <span style="color:red; margin: 0px;">ЗАКРИТИЙ</span> @endif <span>({{ $element->paidUser() }} / {{$element->max_seats}})</span></h5>
					<p style="margin-bottom: 60px; text-align:justify;">{{ $element->description }}</p>
					<div class="row" style="height: 46px;">
						<div class="col-md-8" style="height: 100%; display: flex;">
							<span style="align-self: flex-end;"><strong>Відбудеться {{$element->date_time}} <br> у {{$element->place}}</strong></span>
						</div>
						<div class="col-md-4 check-in">
						@php
							$regUsers = App\MasterClassUser::where('mc_id', $element->id)->get();
						@endphp
						@if ((count($regUsers)<30))
							<button class="btn btn-default waves-effect waves-light btn-lg text-uppercase pull-right" style="text-decoration: none; border-radius: 10px;" data-toggle="modal" data-target="#modalMC{{$element->id}}" {{(count($regUsers)<30)?"":"disabled"}}>Записатись</button>
						@endif
							
						</div>
					</div>
				</div>
			</div>
			<hr>
			@include('master_classes.formMC', ['mk' => $element])
		@endforeach
		<div class="row" style="padding-bottom: 20px;">
			<div class="col-md-12">
				<nav">
				{{-- TO DO AJAX PAGINATION --}}
					{{-- @include('components.pagination',['products'=>$masterclasses]) --}}
				</nav>
			</div>
		</div>
	</div>
</div>
<script>
	$('.submitMC').each(function(){
        $(this).on('click', function(){
            registerMC($(this).attr('mc_id'));
        });
    });
    function registerMC(id) {
        var phone = $('#phone'+id).val();
        var name = $('#name'+id).val();
        var mk_id = id;
        $.ajax({
            url : '/mc/register',
            method: 'POST',
            data: {
                phone: phone,
                name: name,
                id: id
            },
        }).done(function (data) {
            $('#modalMC'+id+' .modal-body').innerHTML = "";
            $('#modalMC'+id+' .modal-body').html(data);
        }).fail(function () {
            $('#modalMC'+id+' .modal-body').innerHTML = "";
            $('#modalMC'+id+' .modal-body').html(data);
        });
    };
</script>
@endsection