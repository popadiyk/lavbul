<!-- The Modal -->
<div class="modal fade" id="productImageModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 80px;">
	<div class="modal-dialog modal-md text-center" role="document">
	    <!-- The Close Button -->
	   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
	    <!-- Modal Content (The Image) -->
	    <img src="{{$product->main_photo}}" class="modal-content" style="width: 90%; margin: 0 auto;">
	    <!-- Modal Caption (Image Text) -->
	    <div>{{$product->title}}</div>
	</div>
</div>