@extends('layouts.main')
@section('content')
@include('products.header')
<div class="container" style="padding-top: 40px; padding-bottom: 40px; max-width: 900px;">
	<div class="col-md-6">		
		<div class="flexslider">
			<ul class="slides">
				<li data-thumb="{{ $product->main_photo}}">
					<div class="thumb-image"> 
						<img src="{{ $product->main_photo}}" class="img-responsive">
					</div>
				</li>
				<li data-thumb="{{ $product->main_photo}}">
				 	<div class="thumb-image">
				 		<img src="{{ $product->main_photo}}" class="img-responsive">
				 	</div>
				</li>
				<li data-thumb="{{ $product->main_photo}}">
					<div class="thumb-image">
						<img src="{{ $product->main_photo}}" class="img-responsive">
					</div>
				</li> 
			</ul>
		</div>
	</div>
	<style>
		.product_info { padding: 1rem 0; float: right; width: 100%; }
		.product_info .title_, .product_info .title { font-weight: 200; }
		.product_info .currency { margin-bottom: 2.4rem; }
		.product_info .currency span { font: 400 2.5rem Roboto; color: #1e1e1e; }
		.product_info .pp { margin-bottom: 1.2rem; font: 300 1.6rem; color: #4b4b4b; }
		.product_info .social { color: #9c9c9c; }
		.product_info .btn { width: 100%; min-width: 0; max-width: 31.5rem; margin: 2.5rem 0 3rem; border-width: 2px; }
	    .swiper-container-recomend {
	        width: 100%;
	        height: 100%;
	        overflow: hidden;
	    }
	    .swiper-container-recomend .swiper-slide {
	        text-align: center;
	        font-size: 18px;
	        background: #fff;
	        
	        /* Center slide text vertically */
	        display: -webkit-box;
	        display: -ms-flexbox;
	        display: -webkit-flex;
	        display: flex;
	        -webkit-box-pack: center;
	        -ms-flex-pack: center;
	        -webkit-justify-content: center;
	        justify-content: center;
	        -webkit-box-align: center;
	        -ms-flex-align: center;
	        -webkit-align-items: center;
	        align-items: center;
	    }
	    .swiper-pagination-bullet {
		    width: 18px;
		    height: 18px;
		    background-size: cover;
		}
		.swiper-container-horizontal > .swiper-pagination-bullets {
		    bottom: 0px;
		}


	</style>
	<div class="col-md-6">
		<div class="product_info">
			<h1 class="title_">{{ $product->title}}</h1>
			<div class="currency">
				<div><span>{{ $product->price}} грн</span></div>
			</div>
			<p class="pp">Рейпольский А.Д.</p>
			<p class="pp">{{ $product->description}}</p>
			<p class="pp">Артикул: {{ $product->marking}}</p>
			<p class="pp">Розмір: 25 х 25</p>
			<p class="pp">Матеріал: якісь тряпочки</p>
			<p class="pp">Термін виготовлення: в наявності</p>
			<button type="button" class="btn btn-success waves-effect waves-light"><span class="add">Додати в кошик</span></button>
		</div>
	</div>
	<div class="col-md-12" style="margin-bottom: 40px;">
		<h2 class="text-center">РЕКОМЕНДУЄМО</h2>
	</div>
	<div class="col-md-12">
		<!-- Swiper -->
		<div class="swiper-container-recomend">
		    <div class="swiper-wrapper">
		    @foreach ($products as $product)
		    	<div class="swiper-slide">
					<div class="mid-pop" style="height: ">
						<div class="pro-img">
							<img src="{{ $product->main_photo }}" class="img-responsive" alt="">
							<div class="zoom-icon ">
								<a class="picture" href="{{ $product->main_photo }}" rel="title" class="b-link-stripe b-animate-go  thickbox" title="{{ $product->title }}" data-toggle="modal" data-target="#productImageModal"><i class="glyphicon glyphicon-search icon "></i></a>
								<a href="{{ url('/product/'.$product->id ) }}"><i class="glyphicon glyphicon-menu-right icon"></i></a>
							</div>
						</div>
						<div class="mid-1">
							<div class="women">
								<div class="women-top">
									<p style="margin: 0; height: 3em;"><a href="{{ url('/product/'.$product->id ) }}">{{$product->title}}</a></p>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="mid-2" style="padding: 0;">
								<p style="width: 100%;"><label>{{($product->price)+50}} грн.</label><em class="item_price">{{$product->price}} грн.</em>
								{{ Form::hidden('id', $product->id ) }}
								{{ Form::hidden('name', $product->title ) }}
								{{ Form::hidden('price',  $product->price) }}
								{{ Form::hidden('marking', $product->marking) }}
								{{ Form::hidden('quantity', 1) }}
								@if(in_array($product->id, $products_id_in_cart))
									<button class="btn btn-sm btn-info pull-right to-cart" data-id="{{ $product->id }}" disabled><i class="fa fa-cart-plus" aria-hidden="true"></i> </button>
								@else
									<button class="btn btn-sm btn-success pull-right to-cart" data-id="{{ $product->id }}"><i class="fa fa-cart-plus" aria-hidden="true"></i> </button>
								@endif
								</p>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
		        </div>
		    @endforeach
		    </div>
		    <!-- Add Pagination -->
		    <div class="swiper-pagination"></div>
		</div>
	</div>
</div>
<div class="modal fade" id="productImageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 80px;">
    <div class="modal-dialog modal-md text-center" role="document">
        <!-- The Close Button -->
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <!-- Modal Content (The Image) -->
        <img class="modal-content" id="productImage" style="width: 90%; margin: 0 auto;">
        <!-- Modal Caption (Image Text) -->
        <div id="caption"></div>
    </div>
</div>




{{-- This part temporary is hidden --}}
{{-- <div class="container-fluid">
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
</div> --}}
@endsection	