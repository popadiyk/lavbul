@extends('layouts.main')
@section('content')
@include('products.header')
<div class="container-fluid">
	<div class="container">
		<div class="row" style="margin-top: 20px; margin-bottom: 20px;">

				<div class="col-md-3">
					<div class="category_all">
						<ul class="nav nav-pills nav-stacked" id="list_of_products">
							<li><a href="" id="category">КАТЕГОРІЇ</a></li>
						</ul>
						<button class="accordion">Одяг</button>
						<div class="panel">
							<button class="accordion">Для жінок</button>
							<div class="panel">
								<p>Lorem</p>
							</div>
						</div>

						<button class="accordion">Взуття</button>
						<div class="panel">
							<p>Lorem ipsum</p>
						</div>

						<button class="accordion">Сумки</button>
						<div class="panel">
							<p>Lorem ipsum dolor sit amet</p>
						</div>

						<button class="accordion">Прикраси</button>
						<div class="panel">
							<p>Lorem ipsu</p>
						</div>

						<button class="accordion">Аксесуари</button>
						<div class="panel">
							<p>Lorem</p>
						</div>

						<button class="accordion">Подарунки</button>
						<div class="panel">
							<p>Lorem</p>
						</div>

						<button class="accordion">Різне</button>
						<div class="panel">
							<p>Lorem i</p>
						</div>
					</div>
				</div>
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-4 dropdown">
							<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" class="sort_by">Сортувати за
							<span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#">Normal</a></li>
								<li class="disabled"><a href="#">Disabled</a></li>
								<li class="active"><a href="#">Active</a></li>
								<li><a href="#">Normal</a></li>
							</ul>
						</div>
						<div class="col-md-5">
							<span>Показано 1-12 із 100 товарів</span>
						</div>
						<div class="col-md-3" style="text-align: right;">
							<i class="fa fa-th-large" aria-hidden="true" style="padding-right: 5px;"></i><i class="fa fa-th-list" aria-hidden="true"></i>	 
						</div>
					</div>
					<div class="row text-center">
					    <div class="col-xs-12" style="padding-bottom: 20px;">
					        <span class="recommend">Рекомендуємо</span>
					    </div>
					</div>
					<div class="row">
					    <!--Service-->
					    <section>
					        <div class="service_wrapper"> 
					          @foreach ($products as $product)
					              @if ($loop->first || $loop->iteration - 1  % 3 == 0)
					                  <div class="row">
					              @endif
					                    <div class="col-lg-4 {{($loop->iteration > 3) ? 'mrgTop' : ''}}">
					                        <div class="row service_block" style="margin: 0;">
					                            <div class="delay-03s animated wow  zoomIn">
					                                <span>
					                                    <a href="{{ url('/product/'.$product->id ) }}">
					                                        <img src="{{ $product->main_photo }}" class="width-100">
					                                    </a>
					                                </span>
					                            </div>
					                            <h3 class="animated fadeInUp wow">{{$product->title}}</h3>
					                            <p class="col-xs-3">{{$product->price}} грн.</p>
					                            {{ Form::number('quantity', 1, array('class'=>'col-xs-3', 'min'=>'1', 'max'=>$product->quantity, 'style'=>'padding:0; height:36px;')) }}

												{{ Form::hidden('id', $product->id ) }}
												{{ Form::hidden('name', $product->title ) }}
												{{ Form::hidden('price',  $product->price) }}
												{{ Form::hidden('marking', $product->marking) }}

												@if(in_array($product->id, $products_id_in_cart))
													<button class="btn  btn-info to-cart" data-id="{{ $product->id }}" disabled style='margin-bottom:15px;'> додано</button>
												@else
													<button class="btn  btn-success to-cart" data-id="{{ $product->id }}" style='margin-bottom:15px;'>в кошик</button>
												@endif




					                               <p class="animated fadeInDown wow">{!! str_limit($product->description , 50, '...') !!}
					                                <span style="font-size: 10px">
					                                    <a href="{{ url('/product/'.$product->id ) }}" style="text-decoration: none;">детальніше</a>
					                                </span>
					                            </p>   
					                        </div>
					                    </div>
					              @if($loop->iteration % 3 == 0)
					                  </div>
					              @endif
					            {{-- expr --}}
					          @endforeach
					        </div>
					    </section>
					    <!--Service-->
					</div>
					<div class="row" style="padding-top: 20px;">
						<div class="col-md-12 text-center">
							<nav aria-label="Page navigation example">
								{{ $products->links() }}
							</nav>
						</div>
					</div>
				</div>

		</div>
	</div>
</div>
@endsection


