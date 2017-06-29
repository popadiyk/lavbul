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
						<div class="col-md-6 dropdown">
							<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" class="sort_by">Сортувати за
							<span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="#">Normal</a></li>
								<li class="disabled"><a href="#">Disabled</a></li>
								<li class="active"><a href="#">Active</a></li>
								<li><a href="#">Normal</a></li>
							</ul>
						</div>
						<div class="col-md-6">
							<span style="float: right;">Показано 1-12 із 100 товарів</span>
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
					        <div class="service_wrapper products"> 
					          @foreach ($products as $k => $product)
					              @if ($k == 0 || $k%3 == 0)
					                  <div class="row">
					              @endif
					                    <div class="col-lg-4 {{($k > 2) ? 'mrgTop' : ''}}">
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
					                            {{ Form::number('count', 0, array('class'=>'col-xs-3', 'min'=>'1', 'max'=>$product->quantity, 'style'=>'padding:0; height:36px;')) }}
					                            {{ Html::link('http://test.com', 'в корзину', array('class'=>'btn btn-success', 'style' => 'margin-bottom: 15px;'))}}
					                            <!-- <p class="animated fadeInDown wow">{!! str_limit($product->description , 50, '...') !!} 
					                                <span style="font-size: 10px">
					                                    <a href="{{ url('/product/'.$product->id ) }}" style="text-decoration: none;">детальніше</a>
					                                </span>
					                            </p>    -->
					                        </div>
					                    </div>
					              @if(($k+1)%3 == 0)
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
								<ul class="pagination">
									<li class="page-item">
										<a class="page-link" href="#" aria-label="Previous">
											<span aria-hidden="true">&laquo;</span>
											<span class="sr-only">Previous</span>
										</a>
									</li>
									<li class="page-item"><a class="page-link" href="#">1</a></li>
									<li class="page-item">
										<a class="page-link active" href="#">2 <span class="sr-only">(current)</span></a>
									</li>
									<li class="page-item"><a class="page-link" href="#">3</a></li>
									<li class="page-item">
										<a class="page-link" href="#" aria-label="Next">
											<span aria-hidden="true">&raquo;</span>
											<span class="sr-only">Next</span>
										</a>
									</li>
								</ul>
							</nav>
						</div>
					</div>
				</div>

		</div>
	</div>
</div>
@endsection


