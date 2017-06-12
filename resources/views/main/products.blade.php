<div class="row text-center">
    <div class="col-xs-12" style="padding-bottom: 20px;">
        <span class="recommend">Рекомендуємо</span>
    </div>
</div>
<style>
    .service_block{
        padding: 5px;
        border-radius: 10px;
        border-width: 1px;
        border-color: #d7d7d7;
        border-style: solid;
        max-height: 370px; 
        overflow: hidden;
    }
    .service_block:hover{
        background-color: white;
        z-index: 10;
        max-height: 800px;
        position: absolute;
        -webkit-transform: scale(1.2,1.2);
        -webkit-transition-timing-function: ease-out;
        -webkit-transition-duration: 550ms;
        -moz-transform: scale(1.2,1.2);
        -moz-transition-timing-function: ease-out;
        -moz-transition-duration: 550ms;
    }
    .service_block h3 {
        font-family: 'Raleway', sans-serif;
        font-weight: 600;
        font-size: 18px;
        color: #111111;
        margin: 20px 0 18px;
    }
</style>
<div class="row">
    <!--Service-->
    <section>
        <div class="service_wrapper"> 
          @foreach ($products as $k => $product)
              @if ($k == 0 || $k%3 == 0)
                  <div class="row">
              @endif
                    <div class="col-lg-4 {{($k > 2) ? 'mrgTop' : ''}}">
                      <div class="service_block">
                        <div class="delay-03s animated wow  zoomIn">
                          <span><a href="{{ url('/product/'.$product->id ) }}"><img src="{{ $product->main_photo }}" class="width-100"></a></span>
                        </div>
                        <h3 class="animated fadeInUp wow">{{$product->title}}</h3>
                        <button type="button" class="btn btn-success col-xs-12" style="margin-bottom: 15px;"><span>Додати в кошик</span></button>
                        <p class="animated fadeInDown wow">{!! str_limit($product->description , 50, '...') !!} <span style="font-size: 10px"><a href="{{ url('/product') }}" style="text-decoration: none;">детальніше</a></span></p>   
                      </div>
                    </div>
              @if(($k+1)%3 == 0)
                  </div>
              @endif
            {{-- expr --}}
          @endforeach
        </div>
    </section>
    <!--Service-->
</div>
