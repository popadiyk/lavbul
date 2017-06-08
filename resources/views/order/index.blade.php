@extends('layouts.main')
@section('content')
<div class="container-fluid text-center classes_header_container">
	<h1 class="header_text"><span></span></h1>
</div>

<div class="container-fluid" style="padding-top: 30px; padding-bottom: 30px;">
	<div class="container" style="background-color: #F2F2F2;">
			<div class="col-md-12">
				<h3><strong>Ваша корзина</strong></h3>
			</div>
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-12">
					<table class="table table-striped">
						  <thead style="background-color:#f1e4d3 ">
						    <tr>
						      <td style="width: 20px;"></td>
						      <td></td>
						      <td>Назва</td>
						      <td>Ціна</td>
						      <td>Знижка</td>
						      <td>Ціна зі знижкою</td>
						      <td>Кількість</td>
						      <td>Сумма</td>
						    </tr>
						  </thead>
						  <tbody>
						    <tr>
						      <td  style="padding-top: 35px;"><button type="button" class="close" aria-hidden="true">×</button></td>
						      <td style="width: 70px;"><img src="img/for_order.png"></td>
						      <td style="width: 200px; padding-top: 25px;"> <p>Тарілка скляна (декоративна) в стилі Прованс</p></td>
						      <td style="padding-top: 25px;">230 грн</td>
						      <td style="padding-top: 25px;">0%</td>
						      <td style="padding-top: 25px;">230 грн</td>
						      <td style="padding-top: 25px;"> <input type="number" step="1" min="1" max="10" id="num_count" name="quantity" value="1" title="Qty"></td>
						      <td style="padding-top: 25px;">230 грн</td>
						      <tr><td colspan="8" style="background-color: #e0e0e0; text-align: right;">В підсумку: 230 грн</td></tr>
						    </tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<!-- personal data -->
		<div class="col-md-12">
			<h3><strong>Доставка і оплата</strong></h3>
		</div>
		<div class="row">
			<div class="col-md-8">
				<form id="contact-form" role="form" style="padding-top: 20px;">
					<div class="col-md-3">Імʼя</div>
					<div class="col-md-7">
						<div class="form-group wow fadeInUp">
							<label class="sr-only" for="c_name">Імʼя</label>
							<input type="text" id="c_name" class="form-control" placeholder="Ваше ім'я" style="font-style: italic;">
						</div>
					</div>
					<br>
					<div class="col-md-3">E-mail</div>
					<div class="col-md-7">
					<div class="form-group wow fadeInUp" data-wow-delay=".1s">
						<label class="sr-only" for="c_email">Email</label>
						<input type="email" id="c_email" class="form-control" placeholder="E-mail" style="font-style: italic;">
					</div>
					</div>
				</form>
			</div>
		</div>
		<!-- personal data -->

		<div class="row">
			<div class="col-md-8">
				<form>
					 <div class="col-md-3">
						<p style="font-size: 14px; padding-top: 20px;"><strong>Спосіб доставки</strong></p>
					</div>
					<div class="col-md-7">
					    <div class="form-group">
					      	<label for="sel1"></label>
					      	<select class="form-control">
					        <option>Магазин</option>
					        <option>Укр Пошта</option>
					        <option>Нова пошта </option>
					        <option>Кур'єр</option>
					      </select>
					    </div>
					</div>
				</form>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8">
				 <form>
					 <div class="col-md-3">
						<p style="font-size: 14px; padding-top: 20px;"><strong>Спосіб оплати</strong></p>
					</div>
					<div class="col-md-7">
					    <div class="form-group">
					      <label for="sel1"></label>
					      <select class="form-control">
					        <option>Безготівковий</option>
					        <option>Готівковий</option>
					      </select>
					    </div>
				    </div>
				 </form>
			</div>
		</div>

		<div class="row" style="padding-bottom: 30px;">
			<div class="col-md-7 col-md-offset-2" style="padding: 0">
				<div class="col-md-4">
					<button type="button" class="btn btn-small" id="make_order" style="background-color: #b9f8a8;"><i class="fa fa-angle-left" aria-hidden="true" style="padding-right: 5px;"></i><span>Продовжити покупки</span></button>
				</div>
				<div class="col-md-4">
					<button type="button" class="btn btn-small"  id="make_order" style="background-color: #b9f8a8;"><span>Сформувати замовлення<i class="fa fa-angle-right" aria-hidden="true" style="padding-left: 5px;"></i></span></button>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection