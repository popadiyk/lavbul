<style>
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
	.women-top p, .women-top p a {
		width: 100%;
	}
	.swiper-pagination{
		bottom: -35px !important;
	}
</style>
@php
	$products_id_in_cart = array();
    foreach(\Cart::content() as $item) {
        array_push($products_id_in_cart, $item->id);
    }
    $items = App\MainProducts::all();
    $products = collect();
    foreach ($items as $key => $value) {
        $products->push(App\Product::where('marking', $value->marking)->first());
    }
@endphp
<div class="col-md-12" style="margin-bottom: 40px; margin-top: 40px;">
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
							<div class="women-top d-flex mx-auto my-auto">
								<p class="align-self-center" style="margin: 0; height: 5em;"><a href="{{ url('/product/'.$product->id ) }}">{{$product->title}}</a></p>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="mid-2" style="padding: 0;">
							<p class="d-flex justify-content-around" style="width: 100%;">
								{{-- <label>{{($product->price)+50}} грн.</label> --}}
								<em class="item_price align-self-center">{{$product->price}} грн.</em>
								{{ Form::hidden('id', $product->id ) }}
								{{ Form::hidden('name', $product->title ) }}
								{{ Form::hidden('price',  $product->price) }}
								{{ Form::hidden('marking', $product->marking) }}
								{{ Form::hidden('quantity', 1) }}
								@if ($product->quantity > 0)
									@if(in_array($product->id, $products_id_in_cart))
										<button class="btn btn-sm btn-info pull-right to-cart" data-id="{{ $product->id }}" disabled><i class="fa fa-cart-plus" aria-hidden="true"></i> </button>
									@else
										<button class="btn btn-sm btn-success pull-right to-cart" data-id="{{ $product->id }}"><i class="fa fa-cart-plus" aria-hidden="true"></i> </button>
									@endif
								@else
									<button class="btn btn-sm btn-success pull-right to-cart" style="background-color: gray !important;" disabled data-id="{{ $product->id }}"><i class="fa fa-cart-plus" aria-hidden="true"></i> </button>
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