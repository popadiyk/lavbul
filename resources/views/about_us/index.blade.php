@extends('layouts.main')
@section('content')
@php($text = 'Декілька слів про нас')
@include('about_us.header')
<style>
	.col-md-4 figure > img {
		box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
border-radius: 50%;

	}
</style>

<div class="container-fluid">
	<div class="container" style="padding-bottom: 40px;">
		<div class="row" style="padding-top: 30px; padding-bottom: 30px;">
			<div class="col-md-12">
				<div class="col-md-4">
					<figure class="text-center">
						<img src="img/success_work.png">
					</figure>
					<figcaption>
						<p class="more_than_years">Більше трьох років успішної роботи</p>
					</figcaption>
				</div>
				<div class="col-md-4">
					<figure class="text-center">
						<img src="img/clients.png">
					</figure>
					<figcaption>
						<p class="more_than_clients">Більше 3000 задоволених клієнтів<p>
					</figcaption>
				</div>
				<div class="col-md-4">
					<figure class="text-center">
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
				<div class="col-md-6 align-self-center">
					<figure>
						<img src="img/goal.png" width="100%">
					</figure>
				</div>
				<div class="col-md-6">
					<h3 style="text-align: center;"><strong>Наша мета</strong></h3>
					<p>"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
				</div>
			</div>
		</div>

		<div class="row" style="padding-top: 30px; padding-bottom: 30px;">
			<div class="col-md-12">
				<div class="col-md-6">
				<h3 style="text-align: center;"><strong>Наша ціль</strong></h3>
					<p>"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
				</div>
				<div class="col-md-6 align-self-center">
					<figure>
						<img src="img/goal_2.png" width="100%">
					</figure>
				</div>
			</div>
		</div>
		@include('products.recomend')
	</div>
</div>

@endsection