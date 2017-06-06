@extends('layouts.main')
@section('content')
@php($text = "Дізнайтесь про всі новини першими!")
@include('news.header', ['text' => $text ])
<div class="container-fluid">
	<div class="container">
		<div class="row" style="padding-top: 40px; padding-bottom: 40px;">
			<div class="col-md-4">
	            <input class="pull-left" style="width:80%" data-toggle="datepicker" placeholder="Дата">
				<div data-toggle="datepicker"></div>
			</div>
			<div class="col-md-4 text-center">
				{{ Form::select('theme', ['1' => 'декупаж', '2' => 'вязание'], null, ['placeholder' => 'Оберіть тему...', 'style' => 'width:80%']) }}
			</div>
			<div class="col-md-4">
			    {{ Form::select('tag', ['1' => 'салфетки', '2' => 'метелики', '3' => 'ляльки мотанки'], null, ['placeholder' => 'Теги...', 'style' => 'width:80%', 'class' => 'pull-right']) }}
			</div>		
		</div>
		<div class="row" style="padding-bottom: 40px;">
			<div class="col-md-4">
				<img src="img/tea.png" width="100%" alt="">
			</div>
			<div class="col-md-8">
				<h3 style="margin-top: 0px;">Відбувся майтер-класс по Декупажу</h3>
				<span>01.06.2017</span>
				<hr>
				<p>Lorem ipsum — классическая панграмма, условный, зачастую бессмысленный текст-заполнитель, вставляемый в макет страницы. Является искажённым отрывком из философского трактата Марка Туллия Цицерона «О пределах добра и зла», написанного в 45 году до н. э. на латинском языке.</p>
				<a href="#" class="btn btn-lg text-uppercase" style="background-color: #b9f8a8; text-decoration: none; color:black; ">email me</a>
			</div>
		</div>
		<div class="row" style="padding-bottom: 40px;">
			<div class="col-md-4">
				<img src="img/tea.png" width="100%" alt="">
			</div>
			<div class="col-md-8">
				<h3 style="margin-top: 0px;">Відбувся майтер-класс по Декупажу</h3>
				<span>01.06.2017</span>
				<hr>
				<p>Lorem ipsum — классическая панграмма, условный, зачастую бессмысленный текст-заполнитель, вставляемый в макет страницы. Является искажённым отрывком из философского трактата Марка Туллия Цицерона «О пределах добра и зла», написанного в 45 году до н. э. на латинском языке.</p>
				<a href="#" class="btn btn-lg text-uppercase" style="background-color: #b9f8a8; text-decoration: none; color:black; ">email me</a>
			</div>
		</div>
		<div class="row" style="padding-bottom: 40px;">
			<div class="col-md-4">
				<img src="img/tea.png" width="100%" alt="">
			</div>
			<div class="col-md-8">
				<h3 style="margin-top: 0px;">Відбувся майтер-класс по Декупажу</h3>
				<span>01.06.2017</span>
				<hr>
				<p>Lorem ipsum — классическая панграмма, условный, зачастую бессмысленный текст-заполнитель, вставляемый в макет страницы. Является искажённым отрывком из философского трактата Марка Туллия Цицерона «О пределах добра и зла», написанного в 45 году до н. э. на латинском языке.</p>
				<a href="#" class="btn btn-lg text-uppercase" style="background-color: #b9f8a8; text-decoration: none; color:black; ">email me</a>
			</div>
		</div>
		<div class="row" style="padding-bottom: 40px;">
			<div class="col-md-4">
				<img src="img/tea.png" width="100%" alt="">
			</div>
			<div class="col-md-8">
				<h3 style="margin-top: 0px;">Відбувся майтер-класс по Декупажу</h3>
				<span>01.06.2017</span>
				<hr>
				<p>Lorem ipsum — классическая панграмма, условный, зачастую бессмысленный текст-заполнитель, вставляемый в макет страницы. Является искажённым отрывком из философского трактата Марка Туллия Цицерона «О пределах добра и зла», написанного в 45 году до н. э. на латинском языке.</p>
				<a href="#" class="btn btn-lg text-uppercase" style="background-color: #b9f8a8; text-decoration: none; color:black; ">email me</a>
			</div>
		</div>
		<div class="row" style="padding-bottom: 40px;">
			<div class="col-md-4">
				<img src="img/tea.png" width="100%" alt="">
			</div>
			<div class="col-md-8">
				<h3 style="margin-top: 0px;">Відбувся майтер-класс по Декупажу</h3>
				<span>01.06.2017</span>
				<hr>
				<p>Lorem ipsum — классическая панграмма, условный, зачастую бессмысленный текст-заполнитель, вставляемый в макет страницы. Является искажённым отрывком из философского трактата Марка Туллия Цицерона «О пределах добра и зла», написанного в 45 году до н. э. на латинском языке.</p>
				<a href="#" class="btn btn-lg text-uppercase" style="background-color: #b9f8a8; text-decoration: none; color:black; ">email me</a>
			</div>
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
						<li class="page-item">
							<a class="page-link" href="#">1</a>
						</li>
						<li class="page-item">
							<a class="page-link active" href="#">2<span class="sr-only">(current)</span></a>
						</li>
						<li class="page-item">
							<a class="page-link" href="#">3</a>
						</li>
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
@endsection