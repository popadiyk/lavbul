@extends('layouts.main')
@section('content')
@php($text = 'Оплата і доставка')
@include('payments.header')

<div class="container-fluid">
	<div class="container">
		<div class="row paddingTop">
			<div class="col-md-12">
				<div class="col-md-4">
					<div class="new_post">
						<figure  class="post">
							<img src="img/new_post.png">
						</figure>
					</div>
				</div>
				<div class="col-md-8">
					<h3 class="shipping_head"><strong>Доставка</strong></h3>
					<div class="new_post">
						<p>Доставка транспортною компанією "Нова Пошта".
							Доставка на відділенні Нової Пошти виконується за рахунок одержувача
						</p>
						<p>
							Термін доставки  замовлення 1-2 дня
						</p>
						<p>
							Термін зберігання Вашої посилки на відділенні - 5 днів, після чого посилка повертається відправнику
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="row paddingTop">
			<div class="col-md-12">
				<div class="col-md-4">
					<div class="new_post">
						<figure class="export">
							<img src="img/export.png">
						</figure>
					</div>
				</div>
				<div class="col-md-8">
					<h3 class="payments"><strong>Оплата</strong></h3>
					<div class="C.O.D.">
						<h4><strong>Накладеним платежем</strong></h4>
						<p>Ви оплачуєте вартість виробу при отриманні, з урахуванням комісійного збору курʼєрської служби (фіксований платіж 25 грн. + 2-3% від вартості замовлення.</p>
						<p>При отриманні Ви називаєте номер декларації (повдомляється Вам одразу після відправки) і надаєте документ, що засвідчує особу.
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="row paddingTop">
			<div class="col-md-12">
				<div class="col-md-4">
					<div class="new_post">
						<figure class="privart_bank">
							<img src="img/privat.png">
						</figure>
					</div>
				</div>
				<div class="col-md-8">
					<div class="privat">
						<h4><strong>Передоплата на карту ПриватБанк</strong></h4>
						<p>Ви оплачуєте вартість виробу на карту ПриватБанку. Додатково оплачується 1% від сумми замовлення.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>