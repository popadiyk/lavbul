@extends('layouts.main')
@section('content')
@include('products.header')
<style>
.accordion dl,
.accordion-list {
   border:1px solid #ddd;
   &:after {
       content: "";
       display:block;
       height:1em;
       width:100%;
       background-color:darken(#38cc70, 10%);
     }
}
.accordion dd,
.accordion__panel {
   background-color:#eee;
   font-size:1em;
   line-height:1.5em; 
}
.accordion p {
  padding:1em 2em 1em 2em;
}

.accordion {
    position:relative;
    background-color:#eee;
}
.accordionTitle,
.accordion__Heading {
 background-color:#38cc70; 
   text-align:center;
     font-weight:700; 
          padding: 5px;
          display:block;
          text-decoration:none;
          color:#fff;
          transition:background-color 0.5s ease-in-out;
  border-bottom:1px solid darken(#38cc70, 5%);
  &:before {
   content: "+";
   font-size:1.5em;
   line-height:0.5em;
   float:left; 
   transition: transform 0.3s ease-in-out;
  }
  &:hover {
    background-color:darken(#38cc70, 10%);
  }
}
.accordionTitleActive, 
.accordionTitle.is-expanded {
   background-color:darken(#38cc70, 10%);
    &:before {
     
      transform:rotate(-225deg);
    }
}
.accordionItem {
    height:auto;
    overflow:hidden; 
    //SHAME: magic number to allow the accordion to animate
    
     max-height:50em;
    transition:max-height 1s;   
 
    
    @media screen and (min-width:48em) {
         max-height:15em;
        transition:max-height 0.5s
        
    }
    
   
}
 
.accordionItem.is-collapsed {
    max-height:0;
}
.no-js .accordionItem.is-collapsed {
  max-height: auto;
}
.animateIn {
     animation: accordionIn 0.45s normal ease-in-out both 1; 
}
.animateOut {
     animation: accordionOut 0.45s alternate ease-in-out both 1;
}
@keyframes accordionIn {
  0% {
    opacity: 0;
    transform:scale(0.9) rotateX(-60deg);
    transform-origin: 50% 0;
  }
  100% {
    opacity:1;
    transform:scale(1);
  }
}

@keyframes accordionOut {
    0% {
       opacity: 1;
       transform:scale(1);
     }
     100% {
          opacity:0;
           transform:scale(0.9) rotateX(-60deg);
       }
}
</style>
<div class="container-fluid">
	<div class="container">
		<div class="row" style="margin-top: 20px; margin-bottom: 20px;">
			<div class="col-md-3">
				 <div class="accordion">
		            <dl>
		              <dt>
		                <a href="#accordion1" aria-expanded="false" aria-controls="accordion1" class="accordion-title accordionTitle js-accordionTrigger">Accordion</a>
		              </dt>
		              <dd class="accordion-content accordionItem is-collapsed" id="accordion1" aria-hidden="true">
		              	<dl>
			              <dt>
			                <a href="#accordion1" aria-expanded="false" aria-controls="accordion1" class="accordion-title accordionTitle js-accordionTrigger">First heading</a>
			              </dt>
			              <dd class="accordion-content accordionItem is-collapsed" id="accordion1" aria-hidden="true">
			               test
			              </dd>
			              <dt>
			                <a href="#accordion1" aria-expanded="false" aria-controls="accordion1" class="accordion-title accordionTitle js-accordionTrigger">First Accordion heading</a>
			              </dt>
			              <dd class="accordion-content accordionItem is-collapsed" id="accordion1" aria-hidden="true">
			              test
			              </dd>
			            </dl>
		                
		              </dd>
		              <dt>
		                <a href="#accordion2" aria-expanded="false" aria-controls="accordion2" class="accordion-title accordionTitle js-accordionTrigger">
		                  Second heading</a>
		              </dt>
		              <dd class="accordion-content accordionItem is-collapsed" id="accordion2" aria-hidden="true">
		                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eu interdum diam. Donec interdum porttitor risus non bibendum. Maecenas sollicitudin eros in quam imperdiet placerat. Cras justo purus, rhoncus nec lobortis ut, iaculis vel ipsum. Donec dignissim arcu nec elit faucibus condimentum. Donec facilisis consectetur enim sit amet varius. Pellentesque justo dui, sodales quis luctus a, iaculis eget mauris. </p>
		                <p>Aliquam dapibus, ante quis fringilla feugiat, mauris risus condimentum massa, at elementum libero quam ac ligula. Pellentesque at rhoncus dolor. Duis porttitor nibh ut lobortis aliquam. Nullam eu dolor venenatis mauris placerat tristique eget id dolor. Quisque blandit adipiscing erat vitae dapibus. Nulla aliquam magna nec elementum tincidunt.</p>
		              </dd>
		              <dt>
		                <a href="#accordion3" aria-expanded="false" aria-controls="accordion3" class="accordion-title accordionTitle js-accordionTrigger">
		                  Third Accordion heading
		                </a>
		              </dt>
		              <dd class="accordion-content accordionItem is-collapsed" id="accordion3" aria-hidden="true">
		                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eu interdum diam. Donec interdum porttitor risus non bibendum. Maecenas sollicitudin eros in quam imperdiet placerat. Cras justo purus, rhoncus nec lobortis ut, iaculis vel ipsum. Donec dignissim arcu nec elit faucibus condimentum. Donec facilisis consectetur enim sit amet varius. Pellentesque justo dui, sodales quis luctus a, iaculis eget mauris. </p>
		                <p>Aliquam dapibus, ante quis fringilla feugiat, mauris risus condimentum massa, at elementum libero quam ac ligula. Pellentesque at rhoncus dolor. Duis porttitor nibh ut lobortis aliquam. Nullam eu dolor venenatis mauris placerat tristique eget id dolor. Quisque blandit adipiscing erat vitae dapibus. Nulla aliquam magna nec elementum tincidunt.</p>
		              </dd>
		            </dl>
		          </div>
{{-- 				<div class="category_all">
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
				</div> --}}
				
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
{{-- 				<div class="row text-center">
				    <div class="col-xs-12" style="padding-bottom: 20px;">
				        <span class="recommend">Рекомендуємо</span>
				    </div>
				</div> --}}
				<div class="row">
				    <!--Service-->
				    <section>
				        <div class="service_wrapper products"> 
							@foreach ($products as $product)
							@if((($loop->iteration)-1)%3 == 0)
				                </div>
			                </div>
				            @endif
							@if ($loop->first || (($loop->iteration)-1)%3 == 0)
							<div class="mid-popular">
							  	<div class="row">
							@endif

								<div class="col-md-4 item-grid {{($loop->iteration > 3) ? 'mrgTop' : ''}}">
									<div class=" mid-pop">
										<div class="pro-img">
											<img src="{{ $product->main_photo }}" class="img-responsive" alt="">
											<div class="zoom-icon ">
												<a class="picture" href="{{ $product->main_photo }}" rel="title" class="b-link-stripe b-animate-go  thickbox"><i class="glyphicon glyphicon-search icon "></i></a>
												<a href="{{ url('/product/'.$product->id ) }}"><i class="glyphicon glyphicon-menu-right icon"></i></a>
											</div>
										</div>
										<div class="mid-1">
											<div class="women">
												<div class="women-top">
													{{-- <span>Men</span> --}}
													<h6><a href="{{ url('/product/'.$product->id ) }}">{{$product->title}}</a></h6>
												</div>
		{{-- 										<div class="img item_add">
													
													<a href="#"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
												</div> --}}
												<div class="clearfix"></div>
											</div>
											<div class="mid-2">
												<p style="width: 100%;"><label>{{($product->price)+50}} грн.</label><em class="item_price">{{$product->price}} грн.</em>
												{{-- {{ Form::number('quantity', 1, array('min'=>'1', 'max'=>$product->quantity, 'style'=>'width: 35px; padding:0; height:36px;')) }} --}}

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
							@if($loop->last)
				                </div>
			                </div>
				            @endif
							@endforeach
							<div class="row" style="padding-top: 20px;">
								<div class="col-md-12">
									<nav>
										<ul class="pagination list-inline justify-content-center">
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

				    </section>
				    <!--Service-->

				</div>
				
			</div>
		</div>
	</div>
</div>
@endsection


