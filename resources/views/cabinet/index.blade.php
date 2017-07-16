@extends('layouts.main')
@section('content')
@include('cabinet.header')

<div class="container" style="margin-top: 30px; max-width: 960px;">
  <div class="row">
      <div class="col-md-12">
        <!--   <nav class="nav flex-column" class="nav nav-tabs" role="tablist" style="margin-bottom: 35px;">
          <ul>
            <li class="nav-item">
             <a href="#mainInfo" data-toggle="tab" role="tab" class="btn btn-default btn-sm" role="button" style="width: 250px !important; margin: 6px! important; padding: 5px !important; font-size: 0.8rem !important;">Особиста інформація</a>
             </li>
             <li class="nav-item">
             <a href="#mainInfo2"  data-toggle="tab" role="tab"  class="btn btn-default btn-sm" role="button" style="width: 250px; margin: 6px; padding: 5px; font-size: 0.8rem;">Мої замовлення</a>
             </li>
             <li class="nav-item">
             <a href="#" data-toggle="tab" href="#profile" role="tab" class="btn btn-default btn-sm" role="button" style="width: 250px; margin: 6px; padding: 5px; font-size: 0.8rem;">Корзина</a>
             </li>
          </ul>
        </nav> -->
        <!-- Nav tabs -->
        <div class="col-md-4 col-sm-4">
<ul role="tablist" class="nav flex-column">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#mainInfo" role="tab">Особиста інформація</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#messages" role="tab">Messages</a>
  </li>
</ul>
</div>

  
      <!--   <div class="col-md-8" class="tab-pane active" id="mainInfo" role="tabpanel" class="tab-pane fade show active">
          <h5>Контактні дані</h5>
          <div class="col-md-5" style="padding: 0">
          <p>Ім'я:</p>
          <p>Електрона пошта:</p>
          <p>Телефон:</p>
          <p>Пароль:</p>
          <p>Картка:</p>
          <p>Знижка:</p>
      </div>
      <div class="col-md-6">
        <p>yours name <i class="fa fa-pencil" aria-hidden="true"></i></p>
        <p>yours e-mail <i class="fa fa-pencil" aria-hidden="true"></i></p>
        <p>phone number <i class="fa fa-pencil" aria-hidden="true"></i></p>
        <p>password <i class="fa fa-pencil" aria-hidden="true"></i></p>
        <p>aviable</p>
        <p>0 or percent</p>
      </div>
      </div> -->
      <div class="col-md-8 col-sm-8">
      <div class="tab-content">
        <div class="tab-pane active" id="mainInfo" role="tabpanel">
               <h3>Контактні дані:</h3>
               <p>fdsfsd</p>
               <p>sfsg</p>
               <p>fsdfsdgfs</p>
               <p>sdfsdg</p>
          </div>
        <div class="tab-pane" id="profile" role="tabpanel">fdsg</div>
        <div class="tab-pane" id="messages" role="tabpanel">..dsfsd.</div>
      </div>
      </div>
     </div>


      <!-- <div class="tab-content">
        <div class="col-md-8" class="tab-pane active" id="mainInfo2" role="tabpanel">
            <h5>Контактні дані</h5>
            <div class="col-md-5" style="padding: 0">
            <p>Ім'я:</p>
            <p>Електрона пошта:</p>
            <p>Телефон:</p>
            <p>Пароль:</p>
            <p>Картка:</p>
            <p>Знижка:</p>
        </div>
        <div class="col-md-6">
          <p>yours name <i class="fa fa-pencil" aria-hidden="true"></i></p>
          <p>yours e-mail <i class="fa fa-pencil" aria-hidden="true"></i></p>
          <p>phone number <i class="fa fa-pencil" aria-hidden="true"></i></p>
          <p>password <i class="fa fa-pencil" aria-hidden="true"></i></p>
          <p>aviable</p>
          <p>0 or percent</p>
        </div>
        </div>
      </div> -->
  </div>
</div>

 <script type="text/javascript">
$('#mainInfo a[href="#profile"]').tab('show');
 </script>


 @endsection

