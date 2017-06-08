@extends('layouts.main')
@section('content')
<div class="container-fluid text-center classes_header_container">
	<h1 class="header_text"><span></span></h1>
</div>

<div class="container-fluid">
	<div class="container" style="background-color: #e8e8e8">
		<div class="row">
			<div class="col-md-12">
				<h3>Ваше замовлення</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-2">
				</div>
				<div class="col-md-10">
					 <div class="row">
                                        <div class="col-md-3">
                                            <img src="img/mini_plate.png">
                                        </div>
                                        <div class="col-md-4">
                                            <div class="description" style="padding-top: 40px;">
                                                <p>Тарілка скляна (декоративна) в стилі Прованс</p>
                                                <p>Артикул 0846930675</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group quantity_goods" style="padding-top: 60px;">
                                              <input type="number" step="1" min="1" max="10" id="num_count" name="quantity" value="1" title="Qty">
                                              <input type="button" value="-" id="button_minus">
                                              <input type="button" value="+" id="button_plus">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="price" style="padding-top: 60px;">
                                                <span>120 грн</span>
                                            </div>
                                        </div>
                                    </div>
				</div>
			</div>
		</div>










		<!-- personal data -->
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-2">
					<h4>Персональні дані</h4>
				</div>
				<div class="col-md-10">
					<form id="contact-form" role="form" style="padding-top: 20px;">
						<div class="form-group wow fadeInUp">
							<label class="sr-only" for="c_name">Імʼя</label>
							<input type="text" id="c_name" class="form-control" placeholder="Ваше ім'я" style="font-style: italic;">
						</div>
						<div class="form-group wow fadeInUp" data-wow-delay=".1s">
							<label class="sr-only" for="c_email">Email</label>
							<input type="email" id="c_email" class="form-control" placeholder="E-mail" style="font-style: italic;">
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- personal data -->

		
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-2">
					<p style="font-size: 16px;"><strong>Спосіб доставки</strong></p>
				</div>
				<div class="col-md-4">
				 <form>
				    <div class="form-group">
				      <label for="sel1"></label>
				      <select class="form-control">
				        <option>Магазин</option>
				        <option>Укр Пошта</option>
				        <option>Нова пошта </option>
				        <option>Кур'єр</option>
				      </select>
				    </div>
				  </form>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="col-md-2">
					<p style="font-size: 16px;"><strong>Спосіб оплати</strong></p>
				</div>
				<div class="col-md-4">
				 <form>
				    <div class="form-group">
				      <label for="sel1"></label>
				      <select class="form-control">
				        <option>Безготівковий</option>
				        <option>Готівковий</option>
				      </select>
				    </div>
				  </form>
				</div>
			</div>
		</div>

		<div class="row" style="padding-top: 20px;">
			<div class="col-md-12">
				<div class="col-md-2 col-md-offset-2">
					<button type="button" class="btn btn-success" id="make_order"><span>Сформувати замовлення</span></button>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection