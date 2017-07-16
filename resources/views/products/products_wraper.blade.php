<div class="row">
    <!--Service-->
    <section id="products_list">
		<div class="row">
			<div class="col-md-6 dropdown">
				<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" class="sort_by">Сортувати за
				<span class="caret"></span></button>
				<ul class="dropdown-menu sorting">
					<li><a href="#" sortBy="new">Датою: спочатку нові товари</a></li>
					<li><a href="#" sortBy="price_up">Ціною: від меншої, до більшої</a></li>
					<li><a href="#" sortBy="price_down">Ціною: від більшої, до меншої</a></li>
					<li><a href="#" sortBy="name_up">Назвою: від А до Я</a></li>
					<li><a href="#" sortBy="name_down">Назвою: від Я до А</a></li>
				</ul>
			</div>
			<div class="col-md-6">
				<span style="float: right;">Показано {{$products->firstItem()}}-{{$products->lastItem()}} із {{$products->total()}} товарів</span>
			</div>
		</div>
		<div class="mid-popular">
		  	<div class="row">
				@foreach ($products as $product)
					<div class="col-md-4 item-grid {{($loop->iteration > 3) ? 'mrgTop' : ''}}">
						<div class="mid-pop">
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
										<h6 class="align-self-center"><a href="{{ url('/product/'.$product->id ) }}">{{$product->title}}</a></h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="mid-2">
									<p style="width: 100%;" class="d-flex justify-content-around">
										{{-- <label>{{($product->price)+50}} грн.</label> --}}
										<em class="item_price align-self-center">{{$product->price}} грн.</em>
										{{-- {{ Form::number('quantity', 1, array('min'=>'1', 'max'=>$product->quantity, 'style'=>'width: 35px; padding:0; height:36px;')) }} --}}

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
				@foreach ($products_id as $element)
					<input type="hidden" class="products_id" value="{{$element}}">
				@endforeach
			</div>
		</div>
		<div class="row" style="padding-top: 20px;">
			<div class="col-md-12">
				<nav">
					@include('components.pagination')
				</nav>
			</div>
		</div>
    </section>
    <!--Service-->
</div>
<script>
$(document).ready(function(){
//BEGIN sorting
$(document).on('click', '.sorting li a', function (event) {
	//create array for visible products
	var products = [];
	//get objects of visible products
	//push id of products into array
	$('.products_id').each(function(){
		products.push($(this).val());
	});
	//get sorting filter value
	var sort_by = $(this).attr('sortBy');
	//send AJAX request
	getProductsSorted(sort_by, products);
    event.preventDefault();
});

//AJAX for sorting
function getProductsSorted(sort_by, products) {
    $.ajax({
        url : '/products/sorting',
        method: 'POST',
        data: {
        	sort_by: sort_by,
        	products_id: products
        },
    }).done(function (data) {
    	$('#products_list').innerHTML = "";
        $('#products_list').html(data);
        location.hash = 'sorted_by='+sort_by;
    }).fail(function () {
    	$('.category_items').html('<h1>Products could not be loaded.</h1>');
    });
};
//END sorting

// BEGIN pagination buttons AJAX
$(document).on('click', '.pagination a', function (event) {
	
    $('.pagination li').removeClass('active');
    $(this).parent().addClass('active');
    if($(this).hasClass('first')){
    	var page = $(this).attr('prevPage');
    }else if($(this).hasClass('last')){
    	var page = $(this).attr('nextPage');
    }else{
    	var page = $(this).text();
    }
    getProducts(page);
    event.preventDefault();
});
function getProducts(page) {
    // $.ajax({
    //     url : '?page=' + page,
    //     dataType: 'json',
    var products_id = [];
	$('.products_id').each(function(){
		products_id.push($(this).val());
	});
    $.ajax({
        url : '/products/pagination',
        method: 'POST',
        data: { page: page,
        		products_id: products_id,
        		 },
    }).done(function (data) {
    	$('#products_list').innerHTML = "";
        $('#products_list').html(data);
        location.hash = page;
    }).fail(function () {
        alert('Products could not be loaded.');
    });
}
// END pagination buttons AJAX

//accordion styles
$('.accordion-title').click(function(event){
    event.preventDefault();

    // if ($(this).hasClass('last')) {
        $('.accordion-title').each(function() {
            $(this).removeClass('active');
        });
        $(this).addClass('active');
    // }
});
//end accordion styles

});
</script>