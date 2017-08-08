<!--Modal: Login with Avatar Form-->
<div class="modal fade" id="modalMC{{$element->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal modal-avatar modal-md" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header text-center">
                <img src="{{$element->main_photo}}" class="rounded-circle img-responsive" style="margin: 0 auto; border-radius: 50%; width: 230px !important;" >
            </div>
            <!--Body-->
            <div class="modal-body text-center mb-1">
                <h5 class="mt-1 mb-2">{{$element->title}}</h5>
                <div class="md-form ml-0 mr-0">
                    <input type="text" id="name{{$element->id}}" class="form-control ml-0">
                    <label for="name" class="ml-0">Введіть ваше ім'я</label>
                </div>
                <div class="md-form ml-0 mr-0">
                    <input type="text" id="phone{{$element->id}}" class="form-control ml-0">
                    <label for="phone" class="ml-0">Введіть ваш телефон</label>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-default mt-1 submitMC" mc_id="{{$element->id}}">Записатись <i class="fa fa-sign-in ml-1"></i></button>
                </div>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: Login with Avatar Form-->