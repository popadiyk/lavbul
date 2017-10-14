@extends('layouts.main')
@section('content')
@php($text = 'Оплата і доставка')
@include('payments.header')

<div class="container-fluid">
	<div class="container">
		<div class="row delivery-bullets" style="margin: 30px 0px 15px 0px; background: rgba(252, 224, 215, 0.5); border-radius: 20px;">
				<div class="col-sm-4 col-xs-12">
					<div class="new_post">
						<figure  class="post">
							<img style="width: 100%;" src="img/new_post.png">
						</figure>
					</div>
				</div>
				<div class="col-sm-8 col-xs-12" style="padding-top: 15px;">
					<h3 class="shipping_head"><strong>Доставка</strong></h3>
					<div class="new_post">
						Доставка транспортною компанією "Нова Пошта" або "Укр Пошта".
						Доставка до 1000 грн. виконується за рахунок одержувача.
						<br>
						<br>
						Термін доставки  замовлення 1-2 дня.
						<br>
						<br>
					</div>
				</div>
			<div class="col-xs-12 col-md-8">
				Якщо Ваше замовлення склало більше 1000 грн., доставка для Вас безкоштовна та виконується за рахунок нашого магазину!
				<br>
				<br>
				Калькулятори розрахунку доствки:
				<ul>
					<li><a href="https://novaposhta.ua/ru/delivery" target="_blank"> - Нова Пошта</a></li>
					<li><a href="http://ukrposhta.ua/ru/kalkulyator-forma-rozraxunku" target="_blank"> - Укр Пошта</a></li>
				</ul>
			</div>
			<div class="col-xs-12 col-md-4">
				<img style="width: 100%; border-radius: 10px; margin-bottom: 15px;" src="img/ukrpost.png">
			</div>
		</div>
		<div class="row delivery-bullets" style="margin: 30px 0px 15px 0px; background: rgba(252, 224, 215, 0.5); border-radius: 20px;">
			<div class="col-md-4" style="padding-top: 15px;">
				<img src="img/korzinka2.png">
			</div>
			<div class="col-md-8" style="padding-top: 15px;">
				<div class="privat">
					<h3 class="shipping_head"><strong>Оплата на карту ПриватБанку</strong></h3>
					Ви оплачуєте вартість замовлення на карту ПриватБанку. Номер картки буде доступний у Вашому рахунку після оформлення замовлення!
					<h3 class="shipping_head" style="padding-top: 25px;"><strong>Оплата в магазині</strong></h3>
					Заберіть своє замовлення та розрахуйтесь за нього в нашому магазині, що знаходиться в м. Вінниця,
					просп. Коцюбинського 70, ТЦ "ПетроЦентр", 2-ий поверх, бутік 7. Чекаємо на Вас!
				</div>
			</div>
		</div>
	</div>
</div>