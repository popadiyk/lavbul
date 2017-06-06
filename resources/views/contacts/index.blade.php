@extends('layouts.main')
@section('content')
@php($text = 'Чекаємо на ВАС в магазинах')
@php($store_name = 'Лавка-Булавка!')
@include('contacts.header', [ 'text' => $text, 'store_name' => $store_name ])

<div class="container-fluid contacts_container">
	<div class="container">
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
		<div class="row" style="height: 400px;">
			<div class="col-md-4 contacts_form">
				<form id="contact-form" role="form" style="padding-top: 20px;">
					<div class="form-group wow fadeInUp">
						<label class="sr-only" for="c_name">Імʼя</label>
						<input type="text" id="c_name" class="form-control" placeholder="Ваше ім'я" style="font-style: italic;">
					</div>
					<div class="form-group wow fadeInUp" data-wow-delay=".1s">
						<label class="sr-only" for="c_email">Email</label>
						<input type="email" id="c_email" class="form-control" placeholder="E-mail" style="font-style: italic;">
					</div>
					<div class="form-group wow fadeInUp" data-wow-delay=".2s">
						<textarea class="form-control" id="c_message" name="c_message" rows="7" placeholder="Залиште відгук" style="font-style: italic;"></textarea>
					</div>
					<br>
					<button type="submit" class="btn btn-lg btn-block">НАДІСЛАТИ</button>
				</form>
			</div>
			<div class="col-md-8" style="height: 400px;">
				@include('contacts.map')
			</div>
		</div>
	</div>
</div>
@endsection


