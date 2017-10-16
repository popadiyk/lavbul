@extends('layouts.main')
@section('pageTitle', $product->title)
@section('metaTitle', $product->meta_title)
@section('metaKeyword', $product->meta_keyword)
@section('og_image', 'http://bulavka.org'.$product->main_photo)
@section('og_title', 'Магазин Лавка-Булавка - '. $product->title .' - найкраща ціна')
@section('content')
@include('products.header')

<div id="fb-root"></div>
<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.10";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

<div class="container" style="padding-top: 20px; padding-bottom: 40px; max-width: 900px;">
	<p class="bread_crumbs" style="padding-left: 20px;">
		<a href="/products">Продукція</a> <span style="font-size: 10px; padding: 0px 7px 0px 7px;">>></span>
		<a href="/products/catalogs/{{$group->id}}">{{$group->title}}</a>
	</p>
	<div class="col-sm-6 col-md-6">
		<div class="flexslider">
			<ul class="slides">
				<li data-thumb="{{ $product->main_photo}}">
					<div class="thumb-image"> 
						<img src="{{ $product->main_photo}}" class="img-responsive">
					</div>
				</li>
				@foreach ($photos as $element)
					<li data-thumb="{{ $element->path}}">
					 	<div class="thumb-image">
					 		<img src="{{ $element->path}}" class="img-responsive">
					 	</div>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
	<style>
		/*nav {*/
			/*background-color: rgba(107,107,107,0.66);*/
		/*}*/
		.product_info { padding: 1rem 0; float: right; width: 100%; }
		.product_info .title_, .product_info .title { font-weight: 200; }
		/* .product_info .currency { margin-bottom: 2.4rem; } */
		/* .product_info .currency span { font: 400 2.5rem; color: #1e1e1e; } */
		.product_info .pp { margin-bottom: 1.2rem; font: 300 1.6rem; color: #4b4b4b; }
		.product_info .social { color: #9c9c9c; }
		.product_info .btn { width: 100%; min-width: 0; max-width: 31.5rem; margin: 2.5rem 0 3rem; border-width: 2px; }
	</style>
	<div class="col-sm-6 col-md-6">
		<div class="product_info">
			<h4 class="title_">{{ $product->title}}</h4>
			<div class="currency">
				<div><h4>{{ $product->price}} грн</h4></div>
			</div>
			<p class="pp">{{ $product->description}}</p>
			<p class="pp">Артикул: {{ $product->marking}}</p>
			<p class="pp" {{($product->quantity > 0)?'':'style=color:red'}}>Наявність товару: {{($product->quantity > 0)?'є на складі':'відсутній на складі'}}.</p>
			{{ Form::hidden('id', $product->id ) }}
			{{ Form::hidden('name', $product->title ) }}
			{{ Form::hidden('price',  $product->price) }}
			{{ Form::hidden('marking', $product->marking) }}
			{{ Form::hidden('quantity', 1) }}
			@if ($product->quantity > 0)
				@if(in_array($product->id, $products_id_in_cart))
					<button type="button" class="btn btn-info waves-effect waves-light to-cart" data-id="{{ $product->id }}" disabled>Додати в кошик</button>
				@else
					<button type="button" class="btn btn-success waves-effect waves-light to-cart" data-id="{{ $product->id }}">Додати в кошик</button>
				@endif
			@else
				<button type="button" class="btn btn-info waves-effect waves-light to-cart" style="background-color: gray !important;" data-id="{{ $product->id }}" disabled>Додати в кошик</button>
			@endif
			<div class="row" style="padding: 15px;">
				{{--VK button--}}
					<a style="background: rgb(98, 135, 174); margin-top: 3px; padding: 5px; font-family: Helvetica, Arial, sans-serif; font-size: 11px; vertical-align: middle;" class="label label-success" href="https://vk.com/share.php?url={{URL::current()}}" target="_blank"><i class="fa fa-vk fa-1x" style="padding-right: 5px;" aria-hidden="true"></i>Поделиться ВКонтакте</a>

				{{--<script type="text/javascript">--}}
					{{--document.write(VK.Share.button(false, {type: "round", text: "Зберегти"}));--}}
				{{--</script>--}}
				{{--FB button--}}
				<div style="margin-left: 15px;" class="fb-share-button" data-href="" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"></a></div>
			</div>
			@foreach($meta_keywords as $meta_keyword)
				<p style="margin-bottom: 5px; display: inline-block; font-size: 11px; font-family: 'Helvetica Neue', Helvetica, Arial, Roboto, courier" class="label label-info">{{$meta_keyword}}</p>
			@endforeach

		</div>
	</div>
	@include('products.recomend')
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