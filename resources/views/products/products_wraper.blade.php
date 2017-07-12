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
			@include('products.products_list')

			<div class="row" style="padding-top: 20px;">
				<div class="col-md-12">
					<nav>
						{{ $products->links() }}
						{{-- <ul class="pagination list-inline justify-content-center">
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
						</ul> --}}
					</nav>
				</div>
			</div>
		</div>

    </section>
    <!--Service-->

</div>