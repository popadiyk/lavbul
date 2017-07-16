<style type="text/css">
  a#anotherLink.nav-link {
    background-color: #2BBBAD;
     text-align:center;
     font-weight:700; 
     line-height: 1.25;
     font-size: 0.8rem;
     margin: 6px;
          padding: 5px;
          display:block;
          text-decoration:none;
          color:#fff;
          transition:background-color 0.5s ease-in-out;
  border-bottom:1px solid darken(#38cc70, 5%);
  &:before {
   content: "+";
   font-size:1.5em;
   line-height:0.5em;
   float:left; 
   transition: transform 0.3s ease-in-out;
  }
  &:hover {
    background-color:darken(#38cc70, 10%);
  }
  }

  a#anotherLink.nav-link.active {
      background: #33b5e5 !important;
  }
</style>

@extends('layouts.main')
@section('content')
@include('cabinet.header')

<div class="container" style="margin-top: 30px; max-width: 960px;">
  <div class="row">
      <div class="col-md-12">
        <div class="col-md-4 col-sm-4">
          <ul role="tablist" class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" id="anotherLink" data-toggle="tab" href="#mainInfo" role="tab" class="btn btn-default waves-effect waves-light ">Особиста інформація</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="anotherLink" data-toggle="tab" href="#history" role="tab">Moї замовлення</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="anotherLink" data-toggle="tab" href="#basket" role="tab">Корзина</a>
            </li>
          </ul>
        </div>
        <div class="col-md-8 col-sm-8">
          <div class="tab-content">
            <div class="tab-pane active" id="mainInfo" role="tabpanel">
                <h4 style="margin-left: 12px;">Контактні дані</h4>
                <div class="col-md-5 col-sm-5">
                  <p></p>
                  <p><strong>Ім'я:</strong></p>
                  <p><strong>Електронна пошта:</strong></p>
                  <p><strong>Телефон:</strong></p>
                  <p><strong>Пароль:</strong></p>
                  <p><strong>Картка:</strong></p>
                  <p><strong>Знижка:</strong></p>
                </div>
                <div class="col-md-5 col-sm-5">
                  <p></p>
                   <p>yours name <i class="fa fa-pencil" aria-hidden="true"></i></p>
                  <p>yours e-mail <i class="fa fa-pencil" aria-hidden="true"></i></p>
                  <p>phone number <i class="fa fa-pencil" aria-hidden="true"></i></p>
                  <p>password <i class="fa fa-pencil" aria-hidden="true"></i></p>
                  <p>aviable</p>
                  <p>0 or percent</p>
                </div>
              </div>
              <div class="tab-pane" id="history" role="tabpanel">History of your orders is empty</div>
              <div class="tab-pane" id="basket" role="tabpanel">Your backet is empty</div>
          </div>
        </div>
    </div>
  </div>
</div>



 @endsection

