<style type="text/css" media="screen">
@media(max-width:568px){
    #fullHeightModalRight .modal-dialog {
        width: 100%;
    }
    #fullHeightModalRight .modal-body {
        max-height: 392px;
    }
}
</style>

<!--Modal: Cart-->
    <div class="modal-dialog modal-full-height modal-right" role="document">
        <!--Content-->
        <div class="modal-content" >
            <!--Header-->
            <div class="modal-header">
                {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> --}}
                <p id="info_basket"><h4 class="modal-title w-100 text-center" id="myModalLabel">Корзина (<span class="total_counter_product"></span> товарів )</h4></p>
            </div>
            <!--Body-->
            <div class="modal-body" style="overflow: scroll; overflow-x: hidden;">
                <ul class="list-group z-depth-0">
                    
{{--                         <div class="col-md-3"><img src="https://mdbootstrap.com/img/Photos/Avatars/img%20%281%29.jpg" class="rounded-circle rounded mx-auto d-block" width="50px;"></div>
                        <div class="col-md-3"><input type="number" name="" value="" placeholder=""></div>
                        <div class="col-md-3"><span class="badge badge-primary badge-pill">14</span></div> --}}
                    
                    @foreach(Cart::content() as $item)
                    <li class="list-group-item justify-content-around">
                        <div class="row product_row" data-id = '{{ $item->rowId }}' style="font-size: 14px;">
                            <div class="col-xs-1 cart_action my-auto text-center" style="padding: 0;">
                                <a href="#" class="delete-product" data-id="{{$item->rowId}}" product-id="{{$item->id}}" title="видалити з корзини" style="color: red; font-weight: bolder;">×</a>
                            </div>
                           {{--  <div class="col-md-2 cart_image my-auto">
                                <img class="img-circle" width="100%;" src="{{ App\Product::find($item->id)->main_photo }}">
                            </div> --}}
                            <div class="col-xs-4 cart_title my-auto text-center" style="padding: 0;">
                                <a href="{{ url('/product/'.$item->id ) }}"><span style="font-size: 10px;">Арт.{{ $item->options->marking }}</span><br>{{ $item->name }}</a>
                            </div>
                            <div class="col-xs-1 cart_price my-auto text-center" style="padding: 0;">
                                <div class="price">
                                    <span id="{{ $item->rowId }}">{{  App\Product::find($item->id)->price }} грн</span>
                                </div>
                            </div>
                            <style>
                                .cart_qty input[type=number]::-webkit-inner-spin-button, 
                                .cart_qty input[type=number]::-webkit-outer-spin-button { 
                                    -webkit-appearance: none;
                                    appearance: none;
                                    margin: 0; 
                                }
                                .cart_qty input[type=number]::-webkit-outer-spin-button,
                                .cart_qty input[type=number]::-webkit-inner-spin-button {
                                    -webkit-appearance: none;
                                    margin: 0;
                                }

                                .cart_qty input[type=number] {
                                    -moz-appearance:textfield;
                                }
                            </style>
                            <div class="col-xs-3 cart_qty my-auto text-center">
                                <div class="number quantity count-input space-bottom" data-id="{{ $item->rowId }}" data-toggle="tooltip" title="">
                                    <a class="incr-btn" data-action="decrease" href="#">–</a>
                                    
                                    <input class="quantity" style="text-align: center; font-size: 14px; line-height: normal;" type="number" max="{{App\Product::find($item->id)->quantity}}" name="quantity" data-id="{{ $item->rowId }}" value="{{ $item->qty }}">
                                    <a class="incr-btn" data-action="increase" href="#">&plus;</a>
                                </div>
                            </div>
                            <div class="col-xs-3 product_total_price my-auto text-center" style="padding: 0;">
                                <div class="price total_one">
                                    <span data-id = "{{ $item->rowId }}" price-one="{{ App\Product::find($item->id)->price }}">{{ number_format($item->subtotal, 2) }} грн</span>
                                </div>
                            </div>

                        </div>
                    </li>
                    @endforeach

                </ul>
            </div>
            <div class="row">
                <div class="col-xs-12 justify-content-around" style="border-top: 1px solid rgba(0, 0, 0, 0.125); font-weight: bolder; text-align: right; padding-right: 50px; margin-left: 15px;">
                    @if (Auth::user())
                        <span style="font-size: 10px;">Разом: </span><span style="font-size: 10px;" id="footer-total-sum">{{number_format(str_replace(',', '', Cart::total()), 2)}} грн.</span>
                        <span style="font-size: 10px;">Знижка: </span><span style="font-size: 10px; color: green;" id="discount" disc="{{ Auth::user()->getDiscount()}}">{{ 100 -Auth::user()->getDiscount()*100 }} %</span>
                        <br>
                        <span style="background: white; padding-left: 5px;">Разом зі знижкою: </span><span id="footer-total-discount" style="background: white; padding-right: 5px;">{{ number_format(Auth::user()->getDiscount()*str_replace(',', '', Cart::total()), 2) }} грн.</span>
                    @else
                        <span>Разом: </span><span id="footer-total-sum">{{number_format(str_replace(',', '', Cart::total()), 2)}} грн.</span>
                    @endif
                </div>
            </div>
            <!--Footer-->
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-secondary waves-effect waves-light"  style="padding: 8px;" data-dismiss="modal" aria-label="Close">Продовжити вибір</a>
                <a href="{{ route('order.create') }}" id="cart_btn_check_order" class="btn btn-success waves-effect waves-light" style="padding: 8px;">Оформити замовлення</a>
            </div>
        </div>
        <!--/.Content-->
    </div>
<script>
$('a.delete-product').click( function(event){
    event.preventDefault();
    var id = $(this).attr('product-id');
    console.log('stop');
    $('.to-cart').each(function(){
        console.log($(this));
        if ($(this).attr('data-id') == id) {
            $(this).removeClass('btn-info').removeAttr('disabled').addClass('btn-success');
        }
    });
});

</script>