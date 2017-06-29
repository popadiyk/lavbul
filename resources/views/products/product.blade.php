@extends('layouts.main')
@section('content')
@include('products.header')
<div class="container-fluid" style="background: #E9EAEA; padding-top: 40px; padding-bottom: 40px;">
	<div class="container">
		<div class="col-md-6">
			<div class="col-md-12" style="margin-bottom: 20px;">
				<figure>
					<img src="{{ $product->main_photo}}" width="100%">
				</figure>
			</div>
			<div class="col-md-12">
				<figure>
					<div class="col-md-4">
						<img src="{{ $product->main_photo}}" width="100%">
					</div>
					<div class="col-md-4">
						<img src="{{ $product->main_photo}}" width="100%">
					</div>
					<div class="col-md-4">
						<img src="{{ $product->main_photo}}" width="100%">
					</div>
				</figure>
			</div>
		</div>
		<div class="col-md-6">
			<h3>{{ $product->title}}</h3>
			<h3>{{ $product->price}}грн</h3>
			<p>{{ $product->description}}</p>
			<h6>Артикул: {{ $product->marking}}</h6>
			<h6>Розмір: 25 х 25</h6>
			<h6>Матеріал: якісь тряпочки</h6>
			<h6>Термін виготовлення: в наявності</h6>
			<span>
				<button type="button" class="basket"><span class="add">Додати в кошик</span></button>
			</span>
		</div>
	</div>
</div>

<!-- This part temporary is hidden -->
<!-- <div class="container-fluid">
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
								<img src="/img/vlada.png">
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
								<img src="/img/vlada.png">
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
								<img src="/img/vlada.png">
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
</div> -->
<div class="container-fluid">
	<div class="container">
		<div class="row text-center" style="height: 428px; background-color: #E9EAEA; margin-top: 30px;">
		    <div class="col-xs-12" style="padding-bottom: 20px;">
		        <span class="recommend">Рекомендуємо</span>
		    </div>

		  	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		    	<!-- Wrapper for slides -->
				<div class="col-md-2">
				</div>
				<div class="col-md-8">
					<div class="carousel-inner">
					    <div class="item active">
				        	<div class="col-md-4">
					    		<figure>
					    			<img src="{{ $product->main_photo}}" width="80%" height="40%">
					    		</figure>
					    		<figcaption>
					    			<p>{{ $product->title}}</p>
					    			<p>{{ $product->price}}грн</p>
					    		</figcaption>
					    	</div>
					    	 <div class="col-md-4">
					    		<figure>
					    			<img src="{{ $product->main_photo}}" width="80%" height="40%">
					    		</figure>
					    		<figcaption>
					    			<p>{{ $product->title}}</p>
					    			<p>{{ $product->price}}грн</p>
					    		</figcaption>
					    	</div>
					    	<div class="col-md-4">
					    		<figure>
					    			<img src="{{ $product->main_photo}}" width="80%" height="40%">
					    		</figure>
					    		<figcaption>
					    			<p>{{ $product->title}}</p>
					    			<p>{{ $product->price}}грн</p>
					    		</figcaption>
					    	</div>
					    </div>
					    <div class="item">
				            <div class="col-md-4">
					    		<figure>
					    			<img src="{{ $product->main_photo}}" width="80%" height="40%">
					    		</figure>
					    		<figcaption>
					    			<p>{{ $product->title}}</p>
					    			<p>{{ $product->price}}грн</p>
					    		</figcaption>
					    	</div>
					    	 <div class="col-md-4">
					    		<figure>
					    			<img src="{{ $product->main_photo}}" width="80%" height="40%">
					    		</figure>
					    		<figcaption>
					    			<p>{{ $product->title}}</p>
					    			<p>{{ $product->price}}грн</p>
					    		</figcaption>
					    	</div>
					    	<div class="col-md-4">
					    		<figure>
					    			<img src="{{ $product->main_photo}}" width="80%" height="40%">
					    		</figure>
					    		<figcaption>
					    			<p>{{ $product->title}}</p>
					    			<p>{{ $product->price}}грн</p>
					    		</figcaption>
					    	</div>
					    </div>
					</div>
				    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
					     <span class="glyphicon glyphicon-chevron-left"></span>
					     <span class="sr-only">Previous</span>
				    </a>
				    <a class="right carousel-control" href="#myCarousel" data-slide="next">
					     <span class="glyphicon glyphicon-chevron-right"></span>
					     <span class="sr-only">Next</span>
				    </a>

			        <ol class="carousel-indicators">
				       <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				       <li data-target="#myCarousel" data-slide-to="1"></li>
				       <li data-target="#myCarousel" data-slide-to="2"></li>
				    </ol>
			    </div>
				<div class="col-md-2">
				</div>
		  	</div>
		</div>
	</div>
</div>
					