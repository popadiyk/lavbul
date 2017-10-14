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
	<div class="container about_us_block" style="padding-bottom: 40px;">
		<div class="row bullets-block" style="padding-top: 30px; padding-bottom: 30px;">
			<div class="col-xs-12">
				<div class="col-md-4 col-xs-12">
					<figure class="text-center">
						<img src="img/success_work.png">
					</figure>
					<figcaption>
						<p class="more_than_years">32 майстри вже співпрацюють з нами</p>
					</figcaption>
				</div>
				<div class="col-md-4 col-xs-12">
					<figure class="text-center">
						<img src="img/clients.png">
					</figure>
					<figcaption>
						<p class="more_than_clients">Більше 3000 задоволених клієнтів<p>
					</figcaption>
				</div>
				<div class="col-md-4 col-xs-12">
					<figure class="text-center">
						<img src="img/collegs.png">
					</figure>
					<figcaption>
						<p class="creative">Креативний та веселий колектив</p>
					</figcaption>
				</div>
			</div>
		</div>

		<div class="row text-block">
			<div class="col-md-6 align-self-center">
				<figure>
					<img src="img/info1-min.jpg" width="100%" style="border-radius: 10px;">
				</figure>
			</div>
			<div class="col-md-6">
				<h3 style="text-align: center;"><strong>Цікаві відомості:</strong></h3>
				<p>Магазин &quot;Лавка-Булавка&quot;  відкрився 1 лютого 2016р. у
					м.Вінниця, в ТЦ &quot;ПетроЦентр&quot;.
					<br><br>
					Якщо Ви просто у захваті від рукоділля? Ваші руки створенні для народження
					справжньої краси? Магазин «Лавка Булавка» пропонує великий асортимент товарів для
					шиття та ручної роботи, а також ексклюзивні вироби ручної роботи від найкращіх
					майстрів України.
					<br><br>
					Зокрема, магазин «Лавка Булавка», проводить майстер-класи з творчої роботи.</p>
			</div>
		</div>

		<div class="row text-block" style="padding-top: 30px; padding-bottom: 30px;">
			<div class="col-md-6">
			<h3 style="text-align: center;"><strong>Наша мета:</strong></h3>
				<p>Внести яскраві фарби у життя кожної людини, адже ти особливий! Також ми мріємо розвинути та
					збільшити товарообіг українського виробника зібравши найкращих майстрів України в одному місці!
					<br><br>Якщо Ви новачок в сфері рукоділля, професійний майстер сувенірів, подарунків, любитель авторських,
					ексклюзивних виробів або просто хочете зробити близькій людині самий незвичайний
					подарунок, магазин Лавка-булавка саме для Вас!</p>
			</div>
			<div class="col-md-6 align-self-center">
				<figure>
					<img src="img/info2-min.jpg" width="100%" style="border-radius: 10px;">
				</figure>
			</div>
		</div>
		@include('products.recomend')
	</div>
</div>

@endsection