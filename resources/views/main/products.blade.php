<style>
@media(max-width:568px){
    .item-grid .women-top{
        justify-content: center;
    }
}
.item-grid button[disabled].btn, .item-grid button[disabled].btn:hover, .item-grid button[disabled].btn:focus {
    box-shadow: initial;
}
</style>
<div class="row text-center">
    <div class="col-xs-12" style="padding-top: 20px;">
        <span class="recommend">Рекомендуємо</span>
    </div>
</div>
<div>
    <div class="row">
        <!--Service-->
        <section>
            <div class="service_wrapper products"> 
                @foreach ($products as $product)
                @if((($loop->iteration)-1)%4 == 0)
                    </div>
                </div>
                @endif
                @if ($loop->first || (($loop->iteration)-1)%4 == 0)
                <div class="mid-popular">
                    <div class="row" style="margin: 0px;">
                @endif
                    <div class="col-12 col-md-3 item-grid {{($loop->iteration > 4) ? 'mrgTop' : ''}}">
                        <div class="mid-pop">
                            <div class="pro-img">
                                <img src="{{ 'products_photo/'.$product->marking.'sm200.jpg' }}" class="hidden-xs img-responsive" alt="{{ $product->title }}">
                                <img src="{{ $product->main_photo }}" class="hidden-lg hidden-md hidden-sm img-responsive" alt="{{ $product->title }}">
                                <div class="zoom-icon ">
                                    <a class="picture" href="{{ $product->main_photo }}" rel="title" class="b-link-stripe b-animate-go  thickbox" alt="{{ $product->title }}" title="{{ $product->title }}" data-toggle="modal" data-target="#productImageModal{{$product->id}}"><i class="glyphicon glyphicon-search icon "></i></a>
                                    <a href="{{ url('/product/'.$product->id ) }}"><i class="glyphicon glyphicon-menu-right icon"></i></a>
                                </div>
                            </div>
                            <div class="mid-1">
                                <div class="women">
                                    <div class="women-top d-flex mx-auto my-auto">
                                        <p class="align-self-center"><a href="{{ url('/product/'.$product->id ) }}">{{$product->title}}</a></p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="mid-2">
                                    <p style="width: 100%;" class="d-flex justify-content-around">
                                        {{-- Label for discount price --}}
                                        {{-- <label>{{($product->price)+50}} грн.</label> --}}
                                        <em class="item_price align-self-center">{{number_format($product->price, 2)}} грн.</em>
                                        {{-- Input for quantity product --}}
                                        {{-- {{ Form::number('quantity', 1, array('min'=>'1', 'max'=>$product->quantity, 'style'=>'width: 35px; padding:0; height:36px;', "class"=>"align-self-center")) }} --}}

                                        {{ Form::hidden('id', $product->id ) }}
                                        {{ Form::hidden('name', $product->title ) }}
                                        {{ Form::hidden('price',  $product->price) }}
                                        {{ Form::hidden('marking', $product->marking) }}
                                        {{ Form::hidden('quantity', 1) }}
                                        @if ($product->quantity > 0)
                                            @if(in_array($product->id, $products_id_in_cart))
                                                <button class="btn btn-sm btn-info pull-right to-cart" data-id="{{ $product->id }}" disabled><i class="fa fa-cart-plus" aria-hidden="true"></i> </button>
                                            @else
                                                <button class="btn btn-sm btn-success pull-right to-cart" data-id="{{ $product->id }}"><i class="fa fa-cart-plus" aria-hidden="true"></i> </button>
                                            @endif
                                        @else
                                            <button class="btn btn-sm btn-success pull-right to-cart" style="background-color: gray !important;" disabled data-id="{{ $product->id }}"><i class="fa fa-cart-plus" aria-hidden="true"></i> </button>
                                        @endif
                                        
                                    </p>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                @if($loop->last)
                    </div>
                </div>
                @endif
                @include('products.showImage', ['product' => $product])
                @endforeach
            </div>

        </section>
        <!--Service-->

    </div>

</div>
<!-- The Modal -->
<div class="modal fade" id="productImageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 80px;">
    <div class="modal-dialog modal-md text-center" role="document">
        <!-- The Close Button -->
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <!-- Modal Content (The Image) -->
        <img class="modal-content" id="productImage" style="width: 90%; margin: 0 auto;">
        <!-- Modal Caption (Image Text) -->
        <div id="caption"></div>
    </div>
</div>