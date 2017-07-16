<ul class="pagination list-inline justify-content-center">
	<li class="page-item {{($products->currentPage() == 1)?"disabled":""}}">
		<a class="page-link first" prevPage="{{$products->currentPage()-1}}" href="#" aria-label="Previous">
			<span aria-hidden="true">&laquo;</span>
		</a>
	</li>
	@for ($i = 1; $i <= $products->lastPage(); $i++)
		<li class="page-item {{($i == $products->currentPage())?"active":""}}"><a class="page-link" href="#">{{$i}}</a></li>
	@endfor
	<li class="page-item  {{($products->currentPage() == $products->lastPage())?"disabled":""}}">
		<a class="page-link last" nextPage="{{$products->currentPage()+1}}" href="#" aria-label="Next">
			<span aria-hidden="true">&raquo;</span>
		</a>
	</li>
</ul>
<script>
$('.pagination li a').click(function(){
    function goToByScroll(id){
	    $('html,body').animate({scrollTop: $("."+id).offset().top - 30},'slow');
	};
	goToByScroll("header_text");
});
</script>