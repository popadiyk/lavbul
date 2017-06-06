@extends('layouts.main')
@section('content')
	@include('products.header')

<div class="container-fluid" style="background: #d7d7d7; padding-top: 40px; padding-bottom: 40px;">
	<div class="container">
		<div class="col-md-6">
			<div class="col-md-12" style="margin-bottom: 20px;">
				<figure>
					<img src="img/plate.png" width="100%">
				</figure>
			</div>
			<div class="col-md-12">
				<figure>
					<div class="col-md-4">
						<img src="img/mini_plate.png" width="100%">
					</div>
					<div class="col-md-4">
						<img src="img/mini_plate.png" width="100%">
					</div>
					<div class="col-md-4">
						<img src="img/mini_plate.png" width="100%">
					</div>
				</figure>
			</div>
		</div>
		<div class="col-md-6">
			<h3>Тарілка скляна (декоративна) в стилі прованс Трави</h3>
			<h3>180 грн</h3>
			<p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris</p>
			<h6>Артикул: 356776</h6>
			<h6>Розмір: 25 х 25</h6>
			<h6>Матеріал: кераміка</h6>
			<h6>Термін виготовлення: в наявності</h6>
			<span>
				<button type="button" class="basket"><span class="add">Додати в кошик</span></button>
			</span>
		</div>

	</div>
</div>
<div class="container-fluid">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h3>ЗАЛИШИТИ ВІДГУК</h3>
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
					<button type="submit" class="btn btn-lg btn-block" style="background-color: #b9f8a8;"><span class="send">НАДІСЛАТИ</span></button>
				</form>
			</div>
			<div class="col-md-6">
				<div class="list_of_feedbacks">
					<h3>Відгуки</h3>
					<div class="row" style="padding-bottom: 10px;">
						<div class="col-md-4">
							<figure>
								<img src="img/vlada.png">
							</figure>
						</div>
						<div class="col-md-8">
							<div class="text_of_feedback">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-4">
							<figure>
								<img src="img/vlada.png">
							</figure>
						</div>
						<div class="col-md-8">
							<div class="text_of_feedback">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-4">
							<figure>
								<img src="img/vlada.png">
							</figure>
						</div>
						<div class="col-md-8">
							<div class="text_of_feedback">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-4">
							<div class="to_all_feedbacks">
								<span style="float: right;">До всіх коментарів<i class="fa fa-long-arrow-right" aria-hidden="true" style="padding-left: 5px;"></i></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div  style="padding-bottom: 20px;">
					<div class="row">
						<div class="col-md-12 text-center" style="padding-bottom: 20px;">
							<span class="recommend">Рекомендуємо</span>
						</div>
					</div>
					<div class="row"><!-- LIST OF PRODUCTS -->
						<div class="col-md-12">
							<div class="col-md-3">
								<figure>
									<img src="img/hearts.jpg" style="width: 170px; height: 170px;">
								</figure>
								<div class="products">
									<span class="product_name">Product name</span><br>
									<span class="before_price" "><del>150 грн.</del></span><span class="after_price">100 грн.</span>
								</div>
							</div>
							<div class="col-md-3">
								<figure>
									<img src="img/boxes.jpg" style="width: 170px; height: 170px;">
								</figure>
								<div class="products">
									<span class="product_name">Product name</span><br>
									<span class="after_price">180 грн.</span>
								</div>
							</div>
							<div class="col-md-3">
								<figure>
									<img src="img/earings.jpg" style="width: 170px; height: 170px;">
								</figure>
								<div class="products" style="text-align: center;">
									<span class="product_name">Product name</span><br>
									<span class="after_price">150 грн.</span>
								</div>
							</div>
							<div class="col-md-3">
								<figure>
									<img src="img/tolda.jpg" style="width: 170px; height: 170px;">
								</figure>
								<div class="products" style="text-align: center;">
									<span class="product_name">Product name</span><br>
									<span class="after_price">150 грн.</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
					