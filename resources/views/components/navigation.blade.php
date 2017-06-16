<div class="container">
    <div class="hidden-xs hidden-sm navigation">
        <ul id="nav-menu">
            <li><img src="/img/min_logo.png" width="88px"></li>
            <li class="active nav-text"><a href="{{ url('/') }}">ГОЛОВНА</a></li>
            <li class="nav-text"><a href="{{ url('/products') }}">ПРОДУКЦІЯ</a></li>
            <li class="nav-text"><a href="{{ url('/master_classes') }}">МАЙСТЕР-КЛАСИ</a></li>
            <li class="nav-text"><a href="{{ url('/news') }}">НОВИНИ</a></li>
            <li>
               <div class="dropdown">
                  <a href="#" class="info">ІНФО</a>
                  <div class="dropdown-content">
                    <a href="{{ url('/about') }}">Про нас</a>
                    <a href="{{ url('/payments') }}">Оплата і доставка</a>
                    <a href="{{ url('/contacts') }}">Контакти</a>
                  </div>
              </div>
            </li>
            <li><a class="dropdown-toggle" data-toggle="dropdown" href="#menu"><i class="fa fa-search fa-2x" aria-hidden="true"></i></a></li>
            <li><a href="#basket_modal" data-toggle="modal"><i class="fa fa-cart-arrow-down fa-2x" aria-hidden="true"></i><span class="cart_counter">{{ Cart::count() }}</span></a></li>
            <li class="user" >
            @if (Auth::user())
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user-circle-o fa-2x" aria-hidden="true" title="{{ Auth::user()->name }}"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Профіль</a></li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Вийти</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            @else
                <a class="dropdown-toggle" data-toggle="dropdown" href="#menu">
                  <i class="fa fa-user-plus fa-2x" aria-hidden="true"></i></i>
                </a>
                <ul class="col-md-4 dropdown-menu keep-open-on-click" style="">
                    <ul class="nav nav-tabs">
                      <li class="active col-md-6 text-center" style="padding: 0; font-weight: bolder; text-transform: uppercase;"><a data-toggle="tab" href="#home" style="text-decoration: none; color: #424141; text-shadow: 2px 2px 4px #fce0d7;">Вхід</a></li>
                      <li class="col-md-6 text-center" style="padding: 0; font-weight: bolder; text-transform: uppercase;"><a data-toggle="tab" href="#menu1" style="text-decoration: none; color: #424141; text-shadow: 2px 2px 4px #fce0d7;">Реєстрація</a></li>
                    </ul>

                    <div class="tab-content">
                      <div id="home" class="tab-pane fade in active">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                          {{ csrf_field() }}
                          <br>
                          {{ $errors->has('email') ? ' has-error' : '' }}
                          {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'введіть ваш e-mail', 'required', 'autofocus']) }}
                          @if ($errors->has('email'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </span>
                          @endif
                          <br>
                          {{ $errors->has('password') ? ' has-error' : '' }}
                          {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'введіть ваш пароль', 'required')) }}
                          @if ($errors->has('password'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif

                          <a class="btn btn-link col-md-6" href="{{ route('password.request') }}">
                              Забули пароль?
                          </a>
                          <div class="text-right col-md-6">
                              <label>
                                  <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> запам'ятати мене
                              </label>
                          </div>
                          <br>
                          
                          <button class="btn btn-success col-md-6 text-right" type="submit">продовжити</button>
                        </form>
                      </div>
                      <div id="menu1" class="tab-pane fade">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                          {{ csrf_field() }}
                          <br>
                          {{ $errors->has('name') ? ' has-error' : '' }}
                          {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => "введіть ваше ім'я")) }}
                          @if ($errors->has('name'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('name') }}</strong>
                              </span>
                          @endif
                          <br>
                          {{ $errors->has('email') ? ' has-error' : '' }}
                          {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'введіть ваш e-mail', 'required']) }}
                          @if ($errors->has('email'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </span>
                          @endif
                          <br>
                          {{ $errors->has('password') ? ' has-error' : '' }}
                          {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'введіть ваш пароль', 'required')) }}
                          @if ($errors->has('password'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                          <br>
                          {{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'підтвердіть ваш пароль', 'required', 'id'=>'password-confirm')) }}
                          <br>
                          {{ Form::tel('phone', null, array('class' => 'form-control', 'placeholder' => "введіть ваш телефон", 'required')) }}
                          <br>
                          <button class="btn btn-success pull-right" type="submit">зареєструватись</button>
                        </form>
                      </div>
                    </div>
                </ul>
            @endif
            </li>
        </ul>
        @include('cart.index')
    </div>
    <nav class="navbar navbar-default navigation" style="height: 50px;">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <i class="fa fa-bars fa-2x" aria-hidden="true"></i>
          </button>
          <a class="navbar-brand" style="text-transform: uppercase; font-weight: bolder;" href="#">Лавка-Булавка</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px; background-color: white;">
          <ul class="nav navbar-nav">
            <li class="active nav-text"><a href="{{ url('/') }}">ГОЛОВНА</a></li>
            <li class="nav-text"><a href="{{ url('/products') }}">ПРОДУКЦІЯ</a></li>
            <li class="nav-text"><a href="{{ url('/master_classes') }}">МАЙСТЕР-КЛАСИ</a></li>
            <li class="nav-text"><a href="{{ url('/news') }}">НОВИНИ</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ІНФО <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{ url('/about') }}">Про нас</a></li>
                <li><a href="{{ url('/payments') }}">Оплата і доставка</a></li>
                <li><a href="{{ url('/contacts') }}">Контакти</a></li>
{{--                 <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li> --}}
              </ul>
            </li>
            <li>
              <a class="dropdown-toggle" data-toggle="dropdown" href="#menu"><i class="fa fa-search fa-2x" aria-hidden="true"></i></a>
              <ul class="dropdown-menu">
                <li>
                  <input type="text" name="search" value="" placeholder="введите текст">
                </li>
              </ul>
            </li>
            <li><a href="#basket_modal" data-toggle="modal"><i class="fa fa-cart-arrow-down fa-2x" aria-hidden="true"></i><span class="cart_counter">{{ Cart::count() }}</span></a></li>
            <li class="user" >
            @if (Auth::user())
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user-circle-o fa-2x" aria-hidden="true" title="{{ Auth::user()->name }}"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Профіль</a></li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Вийти</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul> 
            @else
                <a class="dropdown-toggle" data-toggle="dropdown" href="#menu">
                  <i class="fa fa-user-plus fa-2x" aria-hidden="true"></i></i>
                </a>           
            @endif
            </li>
          </ul>
        </div><!--/.nav-collapse -->
    </nav>
</div>