@extends('layouts.main')
@section('content')
@php($text = 'Декілька слів про нас')
@include('about_us.header')


<div class="container-fluid">
	<div class="container">
		<div class="row" style="padding-top: 30px; padding-bottom: 30px;">
			<div class="col-md-11 col-md-offset-2">
				<div class="col-md-3">
					<figure>
						<img src="img/success_work.png">
					</figure>
					<figcaption>
						<p class="more_than_years">Більше трьох років успішної роботи</p>
					</figcaption>
				</div>
				<div class="col-md-3">
					<figure>
						<img src="img/clients.png">
					</figure>
					<figcaption>
						<p class="more_than_clients">Більше 3000 задоволених клієнтів<p>
					</figcaption>
				</div>
				<div class="col-md-3">
					<figure>
						<img src="img/collegs.png">
					</figure>
					<figcaption>
						<p class="creative">Креативний та веселий колектив</p>
					</figcaption>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="col-md-8">
					<figure>
						<img src="img/goal.png">
					</figure>
				</div>
				<div class="col-md-4">
					<h3 style="text-align: center;"><strong>Наша мета</strong></h3>
					<p>"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
				</div>
			</div>
		</div>

		<div class="row" style="padding-top: 30px; padding-bottom: 30px;">
			<div class="col-md-12">
				<div class="col-md-4">
				<h3 style="text-align: center;"><strong>Наша ціль</strong></h3>
					<p>"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
				</div>
				<div class="col-md-8">
					<figure>
						<img src="img/goal_2.png">
					</figure>
				</div>
			</div>
		</div>
	</div>

	<div class="row text-center" style="height: 428px; background-color: #f4f4f4;">
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
				    			<img src="img/for_about_1.png">
				    		</figure>
				    		<figcaption>
				    			<p>Product Name</p>
				    			<p>150 грн</p>
				    		</figcaption>
				    	</div>
				    	 <div class="col-md-4">
				    		<figure>
				    			<img src="img/for_about_1.png">
				    		</figure>
				    		<figcaption>
				    			<p>Product Name</p>
				    			<p>150 грн</p>
				    		</figcaption>
				    	</div>
				    	<div class="col-md-4">
				    		<figure>
				    			<img src="img/for_about_1.png">
				    		</figure>
				    		<figcaption>
				    			<p>Product Name</p>
				    			<p>150 грн</p>
				    		</figcaption>
				    	</div>
				    </div>
				    <div class="item">
			            <div class="col-md-4">
				    		<figure>
				    			<img src="img/for_about_1.png">
				    		</figure>
				    		<figcaption>
				    			<p>Product Name</p>
				    			<p>150 грн</p>
				    		</figcaption>
				    	</div>
				    	 <div class="col-md-4">
				    		<figure>
				    			<img src="img/for_about_1.png">
				    		</figure>
				    		<figcaption>
				    			<p>Product Name</p>
				    			<p>150 грн</p>
				    		</figcaption>
				    	</div>
				    	<div class="col-md-4">
				    		<figure>
				    			<img src="img/for_about_1.png">
				    		</figure>
				    		<figcaption>
				    			<p>Product Name</p>
				    			<p>150 грн</p>
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

@endsection