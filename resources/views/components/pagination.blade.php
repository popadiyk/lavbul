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