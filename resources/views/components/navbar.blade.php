<style>
    .navbar {
        height: 88px;
        font-weight: bolder;
        box-shadow: none;
    }
    .navbar.open{
        height: 70vh !important;
    }
    .navbar-toggler-icon{
        color: #fce0d7;
    }
    .nav-link{
        color: #fce0d7;
        font-size: 17px;
        text-decoration: none;
        text-transform: uppercase;
        /* font-family: Corbel; */
        font-weight: bolder;
        line-height: 60px;
        /* text-indent: -15px; */
        /* text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black; */
        text-shadow: 2px 2px 4px #000000;
    }
    .nav-link:hover {
      font-size: 17px;
      text-decoration: none;
      color: #fce0d7;
      text-shadow: 4px 4px 6px #000000;
      background-color: transparent;
    }
    .nav-link:focus {
      font-size: 17px;
      text-decoration: none;
      color: #fce0d7;
      text-shadow: 4px 4px 6px #000000;
      background-color: transparent;
    }
    .nav-link {
        position: relative;
        display: block;
        padding: 10px 0px;
    }
    .nav-link > i {
      color: #fce0d7;
      text-shadow: 2px 2px 4px #000000;
    }
    .panel{
        width: 100%;
    }
    .btn-primary {
        background: #ffdace;
    }
    button.btn-primary:hover {
        background-color: #fce0d7;
    }
    button.btn-primary:focus {
        background-color: #fce0d7;
    }
    .btn{
        font-weight: bolder;
    }
    .white{
        background-color: white;
    }
    .modal-c-tabs .nav-tabs > a{
        background-color: white !important;
        text-shadow: none;
        font-weight: bolder !important;
        margin-top: 5px !important;
    }
    .modal-c-tabs .nav-tabs a.active{
        color:  white !important;
        background-color: #33b5e5 !important;
        border: 2px solid white !important;
        text-shadow: none;
        font-weight: bolder !important;
        cursor: pointer !important;
        /* height: 100% !important; */
        margin-top: 0px !important;
    }
    .modal-c-tabs .nav-tabs .btn-outline-info {
        border: 2px solid #33b5e5 !important; 
            border-top-color: rgb(51, 181, 229);
            border-right-color: rgb(51, 181, 229);
            border-bottom-color: rgb(51, 181, 229);
            border-left-color: rgb(51, 181, 229);
        color: #33b5e5 !important;
        background-color: white !important;
        text-shadow: none;
        font-weight: bolder !important;
        margin-top: 5px !important;
    }

    .modal-c-tabs .nav-pills > li > a {
        color: #33b5e5 !important;
        text-shadow: none;
        font-weight: bolder !important;
        margin-top: 5px !important;
    }

    @media(max-width: 768px) {
        #navbarsExampleCenteredNav ul.navbar-nav {
            margin: 0;
        }
        .modal-c-tabs .tab-content .modal-footer {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .modal-c-tabs .tab-content .modal-footer button {
            margin: 0 auto;
        }
        .modal-c-tabs .nav-tabs {
            flex-direction: column;
        }
    }

</style>
<nav class="navigation navbar navbar-toggleable-md navbar-toggleable-sm navbar-toggleable-xs fixed-top">
  <button class="navbar-toggler" style="margin-left: -10px; padding-left: 0px;" type="button" data-toggle="collapse" data-target="#navbarsExampleCenteredNav" aria-controls="navbarsExampleCenteredNav" aria-expanded="false" aria-label="Toggle navigation">
    <i class="fa fa-bars navbar-toggler-icon" aria-hidden="true" style="font-size: 1.8rem;"></i>
  </button>
  <a class="nav-link waves-effect waves-light hidden-md hidden-lg" href="javascript:;" id="mobileModalBasket" data-target="#fullHeightModalRight"><i class="fa fa-cart-arrow-down fa-2x" aria-hidden="true"></i><span id='total-count-cart-modal' class="cart_counter total_counter_product">@if(Auth::user()){{ number_format(Auth::user()->getDiscount()*str_replace(',', '', Cart::total()), 2) }} @else{{ number_format(str_replace(',', '', Cart::total()), 2) }}@endif</span></a>
  
  <div class="navbar-collapse justify-content-md-center collapse" id="navbarsExampleCenteredNav" aria-expanded="false">
    <ul class="navbar-nav d-flex justify-content-around" style="width: 100%; max-width: 960px;">
      <li class="nav-item align-self-center hidden-xs hidden-sm"><img src="/img/min_logo.png" height="88px"></li>
      <li class="nav-item align-self-center"><a class="nav-link" href="{{ url('/') }}">ГОЛОВНА</a></li>
      <li class="nav-item align-self-center"><a class="nav-link" href="{{ url('/products') }}">ПРОДУКЦІЯ</a></li>
      <li class="nav-item align-self-center"><a class="nav-link" href="{{ url('/master_classes') }}">МАЙСТЕР-КЛАСИ</a></li>
      <li class="nav-item align-self-center"><a class="nav-link" href="{{ url('/news') }}">НОВИНИ</a></li>

      <li class="nav-item align-self-center dropdown">
        <a class="nav-link dropdown-toggle" href="javascript:;" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ІНФО</a>
        <div class="dropdown-menu" aria-labelledby="dropdown03">
          <a class="dropdown-item" href="{{ url('/about') }}">Про нас</a>
          <a class="dropdown-item" href="{{ url('/payments') }}">Оплата і доставка</a>
          <a class="dropdown-item" href="{{ url('/contacts') }}">Контакти</a>
        </div>
      </li>
      <li class="nav-item align-self-center dropdown">
        <!-- <a class="nav-link waves-effect waves-light" data-toggle="modal" data-target="#sideModalTR"><i class="fa fa-search fa-2x" aria-hidden="true"></i></a> -->
      </li>
      <li class="nav-item align-self-center hidden-xs">
        <a class="nav-link waves-effect waves-light" href="javascript:;" id="testModalBasket" data-target="#fullHeightModalRight"><i class="fa fa-cart-arrow-down fa-2x" aria-hidden="true"></i><span id='total-count-cart' class="cart_counter total_counter_product">@if(Auth::user()){{ number_format(Auth::user()->getDiscount()*str_replace(',', '', Cart::total()), 2) }} @else{{ number_format(str_replace(',', '', Cart::total()), 2) }}@endif</span></a>
      </li>
      <li class="nav-item align-self-center dropdown">
        @if (Auth::user())
            <a class="nav-link dropdown-toggle" href="javascript:;" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle-o fa-2x" aria-hidden="true" title="{{ Auth::user()->name }}"></i></a>
            <div class="dropdown-menu" aria-labelledby="dropdown05">
              <a class="dropdown-item" href="{{ url('/cabinet') }}">Кабінет</a>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Вийти</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </div>
        @else
            <a class="nav-link" data-toggle="modal" data-target="#modalLRForm"><i class="fa fa-user-plus fa-2x" aria-hidden="true"></i></a>
        @endif
      </li>
    </ul>
  </div>
</nav>
<!--Modal: Login / Register Form-->
<div class="modal fade" id="modalLRForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Modal cascading tabs-->
            <div class="modal-c-tabs">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-pills nav-fill tabs-2 justify-content-md-center " role="tablist">
                    <li class="nav-item waves-effect waves-light text-center">
                        <a class="nav-link active btn-outline-info" data-toggle="tab" href="#panel7" role="tab"><i class="fa fa-user mr-1"></i> Вхід</a>
                    </li>
                    <li class="nav-item waves-effect waves-light text-center">
                        <a class="nav-link btn-outline-info" data-toggle="tab" href="#panel8" role="tab"><i class="fa fa-user-plus mr-1"></i> Реєстрація</a>
                    </li>
                </ul>
                <!-- Tab panels -->
                <div class="tab-content">
                    <!--Panel 7-->
                    <div class="tab-pane fade in show active" id="panel7" role="tabpanel">
                        <form role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <!--Body-->
                        <div class="modal-body mb-1">
                            <div class="md-form form-sm">
                                
                                <i class="fa fa-envelope prefix"></i>
                                {{ Form::email('email', null, ['class' => 'form-control', 'required', 'autofocus']) }}
                                
                                <label for="email">Ваш email</label>
                                {{ $errors->has('email') ? ' has-error' : '' }}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif 
                            </div>
                            <div class="md-form form-sm">
                                
                                <i class="fa fa-lock prefix"></i>
                                {{ Form::password('password', array('class' => 'form-control', 'required')) }}
                               
                                <label for="password">Ваш пароль</label>
                                {{ $errors->has('password') ? ' has-error' : '' }}
                                 @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="text-center mt-2">
                                <button class="btn btn-info">Увійти <i class="fa fa-sign-in ml-1"></i></button>
                            </div>
                        </div>
                        <!--Footer-->
                        <div class="modal-footer display-footer">
                            <div class="options text-center text-md-right mt-1">
                                <!-- <p>Не зареєстровані? <a href="#" class="blue-text">Реєстрація</a></p> -->
                                <p>Забули <a href="{{ route('password.request') }}" class="blue-text">пароль?</a></p>
                            </div>
                            <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Закрити <i class="fa fa-times-circle ml-1"></i></button>
                        </div>
                        </form>
                    </div>
                    <!--/.Panel 7-->
                    <!--Panel 8-->
                    <div class="tab-pane fade" id="panel8" role="tabpanel">
                        <!--Body-->
                        <div class="modal-body">
                        <form role="form" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}
                            
                            <div class="md-form form-sm">
                                <i class="fa fa-user prefix"></i>
                                {{ Form::text('name', null, array('class' => 'form-control')) }}
                                <label for="name">Ваше ім'я</label>
                            </div>
                            <div class="md-form form-sm">
                                <i class="fa fa-phone prefix"></i>
                                {{ Form::tel('phone', null, array('class' => 'form-control', 'required')) }}
                                <label for="phone">Ваш телефон</label>
                            </div>
                            <div class="md-form form-sm">
                                
                                <i class="fa fa-envelope prefix"></i>
                                {{ Form::email('email', null, ['class' => 'form-control', 'required']) }}
                               
                                <label for="email">Ваш email</label>
                                {{ $errors->has('email') ? ' has-error' : '' }}
                                 @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="md-form form-sm">
                                
                                <i class="fa fa-lock prefix"></i>
                                {{ Form::password('password', array('class' => 'form-control', 'required')) }}
                                
                                <label for="password">Ваш пароль</label>
                                {{ $errors->has('password') ? ' has-error' : '' }}
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="md-form form-sm">
                                <i class="fa fa-lock prefix"></i>
                                {{ Form::password('password_confirmation', array('class' => 'form-control', 'required', 'id'=>'password-confirm')) }}
                                <label for="password_confirmation">Повторіть пароль</label>
                            </div>
                            <div class="text-center form-sm mt-2">
                                <button class="btn btn-info">Зареєструватись <i class="fa fa-sign-in ml-1"></i></button>
                            </div>

                            </div>
                        <!--Footer-->
                        <div class="modal-footer">
                            <div class="options text-right">
                            </div>
                            <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Закрити <i class="fa fa-times-circle ml-1"></i></button>
                        </div>
                        </form>
                    </div>
                    <!--/.Panel 8-->
                </div>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: Login / Register Form-->

<div class="modal fade right" id="fullHeightModalRight" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
</div>
