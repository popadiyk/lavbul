@extends('layouts.main')
@section('content')
@include('products.header')
<div class="container-fluid">
	<div class="container">
		<div class="row" style="margin-top: 20px; margin-bottom: 20px;">

				<div class="col-md-4">
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
				<div class="col-md-8">
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
					@include('main.products')
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


