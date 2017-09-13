<div class="row sort-block">
	<div class="col-md-6 dropdown">
		<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" class="sort_by">Сортувати за
		<span class="caret"></span></button>
		<ul class="dropdown-menu sorting">
			<li><a href="#" sortBy="new">Даті: спочатку нові товари</a></li>
			<li><a href="#" sortBy="price_up">Ціною: від меншої, до більшої</a></li>
			<li><a href="#" sortBy="price_down">Ційною: від більшої, до меншої</a></li>
			<li><a href="#" sortBy="name_up">Назвою: А-Я</a></li>
			<li><a href="#" sortBy="name_down">Назвою: Я-А</a></li>
		</ul>
	</div>
	<div class="col-md-6">
		<span style="float: right;">Показано {{$products->firstItem()}}-{{$products->lastItem()}} із {{$products->total()}} товарів</span>
	</div>
</div>
@foreach ($products as $product)
@if((($loop->iteration)-1)%3 == 0)
    </div>
</div>
@endif
@if ($loop->first || (($loop->iteration)-1)%3 == 0)
<div class="mid-popular">
  	<div class="row">
@endif
	<div class="col-12 col-sm-4 col-md-4 item-grid {{($loop->iteration > 3) ? 'mrgTop' : ''}}">
		<div class="mid-pop">
			<div class="pro-img">
				<img src="{{ $product->main_photo }}" class="img-responsive" alt="">
				<div class="zoom-icon ">
					<a class="picture" href="{{ $product->main_photo }}" rel="title" class="b-link-stripe b-animate-go  thickbox" title="{{ $product->title }}" data-toggle="modal" data-target="#productImageModal{{$product->id}}"><i class="glyphicon glyphicon-search icon "></i></a>
					<a href="{{ url('/product/'.$product->id ) }}"><i class="glyphicon glyphicon-menu-right icon"></i></a>
				</div>
			</div>
			<div class="mid-1">
				<div class="women">
					<div class="women-top d-flex mx-auto my-auto">
						<p class="align-self-center"><a href="{{ url('/product/'.$product->id ) }}">{{$product->title}}</a></p>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="mid-2">
					<p style="width: 100%;" class="d-flex justify-content-around">
						{{-- Label for discount price --}}
						{{-- <label>{{($product->price)+50}} грн.</label> --}}
						<em class="item_price align-self-center">{{number_format($product->price, 2)}} грн.</em>
						{{-- Input for quantity product --}}
						{{-- {{ Form::number('quantity', 1, array('min'=>'1', 'max'=>$product->quantity, 'style'=>'width: 35px; padding:0; height:36px;', "class"=>"align-self-center")) }} --}}

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
@if($loop->last)
    </div>
</div>
@endif
@include('products.showImage', ['product' => $product])
@endforeach
@foreach ($products_id as $element)
	<input type="hidden" class="products_id" value="{{$element}}">
@endforeach
<div class="row" style="padding-top: 20px;">
	<div class="col-md-12">
		<nav>
			@include('components.pagination')
		</nav>
	</div>
</div>
<script>
$('button.to-cart').on('click', function(){
    var id = $(this).attr('data-id');
    var data = {};
    $(this).siblings('input').each(function(index){
        data[this.name] = this.value;
    });
    $.ajax({
        type: "POST",
        url: '{{ url("add_to_cart") }}',
        data: data,
        success: function(data){
            if(data.success == true) {
                $('#total-count-cart').text(((Number(data.total.replace(',',''))) * data.discount).toFixed(2));
                $('#total-count-cart-modal').text((Number(data.total.replace(',','')) * data.discount).toFixed(2));
                $('button[data-id=' + id +']')
                    .removeClass('btn-success')
                    .addClass('btn-info')
                    .attr("disabled", "disabled");
            }
        }
    });
});
</script>