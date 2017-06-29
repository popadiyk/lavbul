<style>
  /* Show it is fixed to the top */
/* body {
  min-height: 75rem;
  padding-top: 4.5rem;
} */

</style>
{{-- <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">Fixed navbar</a>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form class="form-inline mt-2 mt-md-0">
      <input class="form-control mr-sm-2" placeholder="Search" type="text">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
 --}}
<nav class="navigation navbar navbar-inverse bg-inverse navbar-toggleable-md fixed-top">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleCenteredNav" aria-controls="navbarsExampleCenteredNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-collapse justify-content-md-center collapse" id="navbarsExampleCenteredNav" aria-expanded="false" style="">
    <ul class="navbar-nav">
      <li class="hidden-xs hidden-sm"><img src="/img/min_logo.png" width="88px"></li>
      <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">ГОЛОВНА</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ url('/products') }}">ПРОДУКЦІЯ</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ url('/master_classes') }}">МАЙСТЕР-КЛАСИ</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ url('/news') }}">НОВИНИ</a></li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ІНФО</a>
        <div class="dropdown-menu" aria-labelledby="dropdown03">
          <a class="dropdown-item" href="{{ url('/about') }}">Про нас</a>
          <a class="dropdown-item" href="{{ url('/payments') }}">Оплата і доставка</a>
          <a class="dropdown-item" href="{{ url('/contacts') }}">Контакти</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-search fa-2x" aria-hidden="true"></i></a>
        <div class="dropdown-menu" aria-labelledby="dropdown04" style="min-width: 20rem;">
          <input class="dropdown-item" type="text" name="search" value="" placeholder="введите текст">
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#basket_modal" data-toggle="modal"><i class="fa fa-cart-arrow-down fa-2x" aria-hidden="true"></i><span class="cart_counter">{{ Cart::count() }}</span></a>
      </li>
      <li class="nav-item dropdown">
        @if (Auth::user())
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle-o fa-2x" aria-hidden="true" title="{{ Auth::user()->name }}"></i></a>
            <div class="dropdown-menu" aria-labelledby="dropdown05">
              <a class="dropdown-item" href="#">Профіль</a>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Вийти</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
            </div>
        @else
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown06" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-plus fa-2x" aria-hidden="true"></i></a>
            <div class="dropdown-menu" aria-labelledby="dropdown06" style="max-width: 40rem;">
              <a class="dropdown-item" href="{{ url('/about') }}">Про нас</a>
              <a class="dropdown-item" href="{{ url('/payments') }}">Оплата і доставка</a>
              <a class="dropdown-item" href="{{ url('/contacts') }}">Контакти</a>
            </div>

            <ul class="col-md-4 dropdown-menu keep-open-on-click" style="position: absolute;">
                <ul class="nav nav-tabs">
                  <li class="active col-md-6 text-center" style="padding: 0; font-weight: bolder; text-transform: uppercase; width: 50%;"><a data-toggle="tab" href="#home" style="text-decoration: none; color: #424141; text-shadow: 2px 2px 4px #fce0d7;">Вхід</a></li>
                  <li class="col-md-6 text-center" style="padding: 0; font-weight: bolder; text-transform: uppercase; width: 50%;"><a data-toggle="tab" href="#menu1" style="text-decoration: none; color: #424141; text-shadow: 2px 2px 4px #fce0d7;">Реєстрація</a></li>
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
  </div>
</nav>