
<style>
    .product_row{
        margin: 0px 10px 0px 0px;
        padding-bottom: 5px;
        border-bottom: 1px solid grey;
    }

    /*.cart_qty{
        margin-top:20px
    }*/
    .cart_title{
        margin-top:20px
    }
    .cart_price, .product_total_price{
        margin-top:20px
    }
    .cart_image img{
        width: 80px;
        height: 70px;
    }

    .cart_action{
        margin-top:20px;
    }
  /*  .cart-footer{
        margin-top: 30px;
    }*/


    .count-input {
        position: relative;
        width: 100%;
        max-width: 165px;
        margin: 10px 0;
    }
    .count-input input {
        width: 100%;
        height: 36.92307692px;
        /*border: 1px solid #000;*/
        border: 0px solid;
        border-radius: 2px;
        background: none;
        text-align: center;
    }
    .count-input input:focus {
        outline: none;
    }
    .count-input .incr-btn {
        display: block;
        position: absolute;
        width: 30px;
        height: 30px;
        font-size: 26px;
        font-weight: 300;
        text-align: center;
        line-height: 30px;
        top: 50%;
        right: 0;
        margin-top: -15px;
        text-decoration:none;
    }
    .count-input .incr-btn:first-child {
        right: auto;
        left: 0;
        top: 46%;
    }
    .count-input.count-input-sm input {
        height: 36px;
    }
    .count-input.count-input-lg input {
        height: 70px;
        border-radius: 3px;
    }

</style>


<div class="modal fade" id="basket_modal" role="dialog">

    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                <div class="row">
                    <p id="info_basket"><span>Ваша корзина</span> (<span class="total_counter_product"></span> товарів ) {{--товари на сумму {{Cart::total()}} грн--}}</p>
                </div>
                @foreach(Cart::content() as $item)
                    <div class="row product_row" data-id = '{{ $item->rowId }}' >
                        <div class="col-md-1 cart_action">
                            <a href="#" class="delete-product" data-id = '{{  $item->rowId }}'>X</a>
                        </div>
                        <div class="col-md-2 cart_image">
                            <img class="img-circle"  src="{{ App\Product::find($item->id)->main_photo }}">
                        </div>
                        <div class="col-md-3 cart_title">
                            <a href="{{ url('shop', [$item->model->slug]) }}">Арт.{{ $item->options->marking.". ".$item->name }}</a>
                        </div>
                        <div class="col-md-2 cart_price">
                            <div class="price">
                                <span id="{{ $item->rowId }}">{{  App\Product::find($item->id)->price }} грн</span>
                            </div>
                        </div>
                        <div class="col-md-2 cart_qty">
                            <div class="number quantity count-input space-bottom" data-id="{{ $item->rowId }}" data-toggle="tooltip" title="">
                                <a class="incr-btn" data-action="decrease" href="#">–</a>
                                <input class="quantity" type="text" name="quantity" data-id="{{ $item->rowId }}" value="{{ $item->qty }}">
                                <a class="incr-btn" data-action="increase" href="#">&plus;</a>
                            </div>
                        </div>
                        <div class="col-md-2 product_total_price">
                            <div class="price">
                                <span data-id = "{{ $item->rowId }}" price-one="{{ App\Product::find($item->id)->price }}">{{ number_format($item->subtotal, 2) }} грн</span>
                            </div>
                        </div>

                    </div>
                @endforeach


            </div>
            <div class="modal-footer cart-footer">
                <div class="row">
                    <div class="col-md-offset-8 col-md-2">
                        <span>Разом:</span>
                    </div>
                    <div class="col-md-2">
                        <span id="footer-total-sum">{{ Cart::total() }} грн.</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ url('/products') }}">< Продовжиити вибір товарів</a>
                    </div>
                    <div class="col-md-4 col-md-offset-2">
                        {{--<button type="button" class="btn btn-success">Оформити замовлення</button>--}}
                        <a href="{{ route('order.create') }}" id="cart_btn_check_order" class="btn btn-success">Оформити замовлення</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- End of Basket_Modal -->