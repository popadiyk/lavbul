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
        width: 100px;
    }
    .cart_marking{
        margin-top:40px
    }
    .error_qty{
        color: red;
    }
</style>
<div class="modal fade" id="basket_modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <div class="row">
                    <p id="info_basket">У кошику {{ sizeof(Cart::content()) }} товари на сумму {{Cart::total()}} грн</p>
                </div>
                {{--<div class="row">
                    @if (session()->has('success_message'))
                        <div class="alert alert-success">
                            {{ session()->get('success_message') }}
                        </div>
                    @endif

                    @if (session()->has('error_message'))
                        <div class="alert alert-danger">
                            {{ session()->get('error_message') }}
                        </div>
                    @endif
                </div>--}}

                @foreach(Cart::content() as $item)
                    <div class="row">
                        <div class="col-md-2 cart_image">
                            <img src="img/mini_plate.png">
                        </div>
                        <div class="col-md-5 cart_title">
                            <a href="{{ url('shop', [$item->model->slug]) }}">Арт.{{ $item->options->marking.". ".$item->name }}</a>
                        </div>
                        <div class="col-md-2 cart_qty">
                            <select class="quantity" data-id="{{ $item->rowId }}">
                                <option {{ $item->qty == 1 ? 'selected' : '' }}>1</option>
                                <option {{ $item->qty == 2 ? 'selected' : '' }}>2</option>
                                <option {{ $item->qty == 3 ? 'selected' : '' }}>3</option>
                                <option {{ $item->qty == 4 ? 'selected' : '' }}>4</option>
                                <option {{ $item->qty == 5 ? 'selected' : '' }}>5</option>
                            </select>
                            <span class="error_qty"></span>
                        </div>
                        <div class="col-md-2 cart_price">
                            <div class="price">
                                <span>{{ number_format($item->subtotal, 2).'грн.' }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
                    <div class="row">
                        <div class="col-md-6 pull-left">
                            <a href="{{ url('/') }}" class="btn btn-info btn-lg">Продовжити вибір товарів</a>
                        </div>
                        <div class="col-md-6 pull-right">
                            <a href="{{ route('order.create') }}" class="btn btn-success btn-lg">Оформити замовлення</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Basket_Modal -->
