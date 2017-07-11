@extends('layouts.main')
@section('content')
@include('products.header')
<style>
.accordion dl,
.accordion-list {
	margin-top: .5rem;
   /* border:1px solid #ddd; */
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
   /* background-color:#eee; */
   font-size:1em;
   line-height:1.5em; 
}
.accordion p {
  padding:1em 2em 1em 2em;
}

.accordion {
    position:relative;
    /* background-color:#eee; */
}
.inner-item{
	width: 90%;
}
.inner-item2{
	width: 90%;
}
.inner-item > dt > a:focus, .inner-item > dt > a:hover {
	font-weight: bolder !important;
	box-shadow: 0 5px 11px 0 rgba(0, 0, 0, 0.18), 0 4px 15px 0 rgba(0, 0, 0, 0.15) !important;
}
.inner-item2 > dt > a:focus, .inner-item > dt > a:hover {
	font-weight: bolder !important;
	box-shadow: 0 5px 11px 0 rgba(0, 0, 0, 0.18), 0 4px 15px 0 rgba(0, 0, 0, 0.15) !important;
}
.accordionTitle.active{
	background: #33b5e5 !important;
}
.accordionTitle,
.accordion__Heading {
 /* background-color:#38cc70;  */
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
					@php($elements = $groups->groupBy('group_id'))
	                {{-- пробегаем по родительским групам --}}
	                @foreach ($elements as $k => $subGroups)
	                    @if ($k !== 0)
	                      @break
	                    @endif
	                    <dl>
	                    @include('main.groups', ['items' => $subGroups])
	                    </dl>
	                @endforeach
		        </div>	
			</div>
			<div class="col-md-9">
				<div class="row">
					<div class="col-md-6 dropdown">
						<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" class="sort_by">Сортувати за
						<span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="#">Ціною: від меншої, до більшої</a></li>
							<li><a href="#">Ціною: від більшої, до меншої</a></li>
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
												<a class="picture" href="{{ $product->main_photo }}" rel="title" class="b-link-stripe b-animate-go  thickbox" title="{{ $product->title }}" data-toggle="modal" data-target="#productImageModal"><i class="glyphicon glyphicon-search icon "></i></a>
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
<!-- The Modal -->
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
@endsection


