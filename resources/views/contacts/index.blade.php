@extends('layouts.main')
@section('content')
@php($text = 'Чекаємо на ВАС в магазинах')
@php($store_name = 'Лавка-Булавка!')
@include('contacts.header', [ 'text' => $text, 'store_name' => $store_name ])


<div class="container-fluid contacts_container">
	<div class="container">
		@if ($success_message)
			<div class="row">
				<div class="col-xs-12 alert alert-success">
					{{ $success_message }}
				</div>
			</div>
		@endif
		<div class="row borderTop">
			<div class="col-lg-4 mrgTop">
			  <div class="service_block">
			    <div class="service_icon delay-03s animated wow  zoomIn animated" style="visibility: visible; animation-name: zoomIn;"> <span><i class="fa fa-map-marker" aria-hidden="true"></i></span> </div>
			    <h3 class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;">Адреса</h3>
			    <p class="animated fadeInDown wow animated" style="visibility: visible; animation-name: fadeInDown;">м.Вінниця, <br>вул.Коцюбинського 70</p>
			  </div>
			</div>
			<div class="col-lg-4 borderLeft mrgTop">
			  <div class="service_block">
			    <div class="service_icon icon2  delay-03s animated wow zoomIn animated" style="visibility: visible; animation-name: zoomIn;"> <span><i class="fa fa-envelope" aria-hidden="true"></i></span> </div>
			    <h3 class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;">Контактні дані</h3>
			    <p class="animated fadeInDown wow animated" style="visibility: visible; animation-name: fadeInDown;">E-mail: gmail@gmail.com <br> +38 (063) 000 00 00</p>
			  </div>
			</div>
			<div class="col-lg-4 borderLeft mrgTop">
			  <div class="service_block">
			    <div class="service_icon icon3  delay-03s animated wow zoomIn animated" style="visibility: visible; animation-name: zoomIn;"> <span><i class="fa fa-home" aria-hidden="true"></i></span> </div>
			    <h3 class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;">Час роботи</h3>
			    <p class="animated fadeInDown wow animated" style="visibility: visible; animation-name: fadeInDown;">ПН-СБ 9:00 - 18:00 <br> НД вихідний</p>
			  </div>
			</div>
		</div>
		<div class="row" style="height: 450px;">
			<div class="col-md-4 contacts_form">
				<form id="contact-form" role="form" method="post" action="/send_feedback" style="padding-top: 20px;">
					<div class="md-form form-sm">
                        {{ $errors->has('email') ? ' has-error' : '' }}
                        <i class="fa fa-envelope prefix"></i>
                        {{ Form::email('email', null, ['class' => 'form-control', 'required']) }}
						{!! Form::token() !!}
					@if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        <label for="email">Ваш email</label>
                    </div>
                    <div class="md-form form-sm">
                        <i class="fa fa-user prefix"></i>
                        {{ Form::text('name', null, array('class' => 'form-control')) }}
                        <label for="name">Ваше ім'я</label>
                    </div>
					<div class="form-group wow fadeInUp" data-wow-delay=".2s">
						<textarea class="form-control" id="c_message" name="c_message" rows="7" placeholder="Залиште відгук" style="font-style: italic;"></textarea>
					</div>
					<br>
					<button type="submit" class="btn btn-default btn-lg waves-effect waves-light">НАДІСЛАТИ</button>
				</form>
			</div>
			<div class="col-md-8" style="height: 450px;">
				@include('contacts.map')
			</div>
		</div>
	</div>
</div>
@endsection


