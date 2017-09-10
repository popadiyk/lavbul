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

<div class="container" style="margin-top: 30px; max-width: 960px; min-height: 100vh;">
  <div class="row">
      <div class="col-md-12">
        <div class="col-md-4 col-sm-4">
          <ul role="tablist" class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" id="anotherLink" data-toggle="tab" href="#mainInfo" role="tab" class="btn btn-default waves-effect waves-light ">Особиста інформація</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="anotherLink" data-toggle="tab" href="#orderInfo" role="tab">Інформація для замовлення</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="anotherLink" data-toggle="tab" href="#discountInfo" role="tab">Інформація про знижку</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="anotherLink" data-toggle="tab" href="#ordersHistory" role="tab">Moї замовлення</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="anotherLink" data-toggle="tab" href="#editInfo" role="tab">Зміна даних</a>
            </li>        
          </ul>
        </div>
        <div class="col-md-8 col-sm-8">
            <div class="tab-content">
                <div class="tab-pane active" id="mainInfo" role="tabpanel">
                    <h4 class="text-center" style="margin-left: 12px;">Особиста інформація</h4>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>Ім'я:</td>
                                <td>{{Auth::user()->name}}</td>
                            </tr>
                            <tr>
                                <td>Телефон:</td>
                                <td>{{Auth::user()->phone}}</td>
                            </tr>
                            <tr>
                                <td>E-mail:</td>
                                <td>{{Auth::user()->email}}</td>
                            </tr>
                            <tr>
                                <td>Адреса:</td>
                                <td>{{Auth::user()->address}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="orderInfo" role="tabpanel">
                    Замовлення
                </div>
                <div class="tab-pane" id="discountInfo" role="tabpanel">
                    <h4 class="text-center" style="margin-left: 12px;">Інформація про вашу знижку</h4>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>Картка оформлена на ім'я:</td>
                                <td>{{Auth::user()->getDiscountInfo()->name}}</td>
                            </tr>
                            <tr>
                                <td>Картка №:</td>
                                <td>{{Auth::user()->getDiscountInfo()->card}}</td>
                            </tr>
                            <tr>
                                <td>Телефон:</td>
                                <td>{{Auth::user()->getDiscountInfo()->phone}}</td>
                            </tr>
                            <tr>
                                <td>E-mail:</td>
                                <td>{{Auth::user()->getDiscountInfo()->email}}</td>
                            </tr>
                            <tr>
                                <td style="text-align: right;">Ваша знижка:</td>
                                <td style="font-weight: bolder;">{{Auth::user()->getDiscountInfo()->discount}}%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="ordersHistory" role="tabpanel">
                    <h4 class="text-center" style="margin-left: 12px;">Мої замовлення:</h4>
                    <table class="table table-striped">
                        <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{$invoice->created_at}}</td>
                                    <td>Накладна №{{$invoice->id}}</td>
                                    <td><a target="_blank" href="/invoices/generatePdf/{{$invoice->id}}">Переглянути рахунок</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="tab-pane" id="editInfo" role="tabpanel">
                    <h4 class="text-center" style="margin-left: 12px;">Зміна даних</h4>
                    <form role="form" method="post" action="{{ url('/user/edit/'.Auth::user()->id) }}" enctype="multipart/form-data">
                        {{ method_field("POST") }}
                        {{ csrf_field() }}
                        <div class="md-form form-sm">
                          <i class="fa fa-user prefix"></i>
                          {{ Form::text('name', Auth::user()->name, array('class' => 'form-control')) }}
                          <label for="name">Ваше ім'я:</label>
                        </div>
                        <div class="md-form form-sm">
                          <i class="fa fa-phone prefix"></i>
                          {{ Form::tel('phone', Auth::user()->phone, array('class' => 'form-control', 'required')) }}
                          <label for="phone">Ваш телефон:</label>
                        </div>
                        <div class="md-form form-sm">
                            <i class="fa fa-address-card-o prefix"></i>
                                {{ Form::text('address', Auth::user()->address, ['class' => 'form-control']) }}
                            <label for="address">Адреса доставки:</label>
                        </div>
                        <div class="md-form form-sm">
                          <i class="fa fa-envelope prefix"></i>
                          {{ Form::email('email', Auth::user()->email, ['class' => 'form-control', 'required']) }}
                          <label for="email">Ваш email:</label>
                        </div>
                        <div class="md-form form-sm">
                          <i class="fa fa-lock prefix"></i>
                          {{ Form::password('password', array('class' => 'form-control')) }}
                          <label for="password">Новий пароль:</label>
                        </div>
                        <div class="text-center form-sm mt-2">
                          <button class="btn btn-info" type="submit">Змінити! <i class="fa fa-check" aria-hidden="true"></i> </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>



 @endsection

