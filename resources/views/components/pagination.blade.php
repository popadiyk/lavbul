<style>

	.newstyle {
		border-radius: 50%;
		background-color: rgba(235, 235, 235, 0.28) !important;
		width: 69px;
		height: 68px;
		border: 2px solid #f6d2c7 !important;
		/* font-family: 'Montserrat'; */
		color: #666666 !important;
		font-size: 18px;
		font-weight: bolder;
		/* line-height: 60px; */
		text-align: center;
		padding: 19px 10px !important;
		margin-left: 11px !important;
	}

</style>

<ul class="pagination list-inline justify-content-center">
	<li class="page-item {{($products->currentPage() == 1)?"disabled":""}}">
		<a class="page-link first" prevPage="{{$products->currentPage()-1}}" href="#" aria-label="Previous">
			<span aria-hidden="true">&laquo;</span>
		</a>
	</li>
	@for ($i = 1; $i <= $products->lastPage(); $i++)

		@if($products->lastPage() > 4)
			@if($i==1)
			<li class="page-item {{($i == $products->currentPage())?"active":""}}"><a class="page-link" href="#">{{$i}}</a></li>
			@endif

			@if ($i==2)
				@if ($i==$products->currentPage())
					<li class="page-item {{($i == $products->currentPage())?"active":""}}"><a class="page-link" href="#">{{$i}}</a></li>
				@else
					<li class="page-item newstyle">...</li>
				@endif
			@endif


				@if($i!=1 && $i!=2 && $i==$products->currentPage() && $i!=$products->lastPage()-1 && $i != $products->lastPage())
					<li class="page-item {{($i == $products->currentPage())?"active":""}}"><a class="page-link" href="#">{{$i}}</a></li>
				@endif


				@if ($i==$products->lastPage()-1)
					@if ($i==$products->currentPage())
						<li class="page-item {{($i == $products->currentPage())?"active":""}}"><a class="page-link" href="#">{{$i}}</a></li>
					@else
						<li class="page-item newstyle">...</li>
					@endif
				@endif

			@if($i == $products->lastPage())
				<li class="page-item {{($i == $products->currentPage())?"active":""}}"><a class="page-link" href="#">{{$i}}</a></li>
			@endif
			@else
			<li class="page-item {{($i == $products->currentPage())?"active":""}}"><a class="page-link" href="#">{{$i}}</a></li>
		@endif

	@endfor
	<li class="page-item  {{($products->currentPage() == $products->lastPage())?"disabled":""}}">
		<a class="page-link last" nextPage="{{$products->currentPage()+1}}" href="#" aria-label="Next">
			<span aria-hidden="true">&raquo;</span>
		</a>
	</li>
</ul>
<script>
// BEGIN pagination buttons AJAX
$(document).on('click', '.pagination a', function (event) {
	
    $('.pagination li').removeClass('active');
    $(this).parent().addClass('active');
    if($(this).hasClass('first')){
    	var page = $(this).attr('prevPage');
    }else if($(this).hasClass('last')){
    	var page = $(this).attr('nextPage');
    }else{
    	var page = $(this).text();
    }
    // getProducts(page);
	event.preventDefault();
    goToByScroll("header_text");
});

function goToByScroll(id){
	setTimeout(function () {
		var body = $("html, body");
		body.stop().animate({scrollTop:0}, 1000, 'swing', function() {
		});
	}, 500);

//    $(window).animate({scrollTop: $("."+id).top - 30},'slow');
}
</script>