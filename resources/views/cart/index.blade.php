<style>
    .cart_qty{
        margin-top:40px
    }
    .cart_title{
        margin-top:40px
    }
    .cart_price{
        margin-top:40px
    }
    .cart_image img{
        width: 80px;
        height: 70px;
    }
    .cart_marking{
        margin-top:40px
    }
    .error_qty{
        color: red;
        border-color: red;
    }
    .cart_action{
        margin-top:30px;
    }
    .cart-footer{
        margin-top: 30px;
    }
</style>

    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <div class="row">
                    <p id="info_basket">У кошику {{ Cart::count() }} товари на сумму {{Cart::total()}} грн</p>
                </div>
                @foreach(Cart::content() as $item)
                    <div class="row" data-id = '{{ $item->rowId }}' >
                        <div class="col-md-1 cart_action">
                            <button class="delete-product" data-id = '{{  $item->rowId }}'>X</button>
                        </div>
                        <div class="col-md-2 cart_image">
                            <img class="img-circle"  src="{{ App\Product::find($item->id)->main_photo }}">
                        </div>
                        <div class="col-md-6 cart_title">
                            <a href="{{ url('shop', [$item->model->slug]) }}">Арт.{{ $item->options->marking.". ".$item->name }}</a>
                        </div>
                        <div class="col-md-1 cart_qty">
                            <select class="quantity" data-id="{{ $item->rowId }}" data-toggle="tooltip" title="">
                                <option {{ $item->qty == 1 ? 'selected' : '' }}>1</option>
                                <option {{ $item->qty == 2 ? 'selected' : '' }}>2</option>
                                <option {{ $item->qty == 3 ? 'selected' : '' }}>3</option>
                                <option {{ $item->qty == 4 ? 'selected' : '' }}>4</option>
                                <option {{ $item->qty == 5 ? 'selected' : '' }}>5</option>
                            </select>
                        </div>
                        <div class="col-md-2 cart_price">
                            <div class="price">
                                <span id="{{ $item->rowId }}">{{ number_format($item->subtotal, 2) }} грн</span>
                            </div>
                        </div>

                    </div>
                @endforeach
                    <div class="row cart-footer">
                        <div class="col-md-4 text-center">
                            <a href="{{ url('/') }}" class="btn btn-info">Продовжити вибір</a>
                        </div>
                        <div class="col-md-3 text-center">
                            <form action="{{ url('/emptyCart') }}" method="POST">
                                {!! csrf_field() !!}
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" class="btn btn-danger" value="Очистити">
                            </form>
                        </div>
                        <div class="col-md-5 text-center">
                            <a href="{{ route('order.create') }}" id="cart_btn_check_order" class="btn btn-success">Оформити замовлення</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>

<!-- End of Basket_Modal -->