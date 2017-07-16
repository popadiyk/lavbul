@extends('layouts.main')
@section('content')
<div class="container-fluid text-center classes_header_container">
	<h1 class="header_text"><span></span></h1>
</div>

<div class="container-fluid" style="padding-top: 30px; padding-bottom: 30px;">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<h3><strong>Ваша корзина</strong></h3>
			</div>
			<div class="col-md-12">
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
				<table class="table table-striped">
					  <thead style="background-color:#f1e4d3 ">
					    <tr>
					      <td style="width: 20px;"></td>
					      <td></td>
					      <td>Назва</td>
					      <td>Ціна</td>
					      <td>Знижка</td>
					      <td>Ціна зі знижкою</td>
					      <td>Кількість</td>
					      <td>Сумма</td>
					    </tr>
					  </thead>
					  <tbody>
					  @foreach(Cart::content() as $item)
					    <tr>
					      <td>
							<form action="{{ url('cart', [$item->rowId]) }}" method="POST" class="side-by-side">
								{!! csrf_field() !!}
								<input type="hidden" name="_method" value="DELETE">
								<button type="submit" class="btn btn-warning btn-sm text-uppercase waves-effect waves-light">Видалити</button>
							</form>
						  </td>
					      <td style="width: 70px;"><img src="{{ App\Product::find($item->id)->main_photo }}" width="100%"></td>
					      <td style="width: 200px; padding-top: 25px;"> <a href="{{ url('shop', [$item->model->slug]) }}">{{ $item->name }}</td>
					      <td style="padding-top: 25px;">{{ number_format($item->subtotal / $item->qty , 2).'грн.' }}</td>
					      <td style="padding-top: 25px;">0%</td>
					      <td style="padding-top: 25px;">{{ number_format($item->subtotal / $item->qty , 2).'грн.' }}</td>
						  <td style="padding-top: 25px;"> <p>{{ $item->qty }}</p></td>
					      <td style="padding-top: 25px;">{{ number_format($item->subtotal, 2) }}</td>
					    </tr>
					  @endforeach
					  <tr>
						  <td colspan="7" style="background-color: #e0e0e0; text-align: right;">Доставка:</td>
						  <td style="background-color: #e0e0e0;">0 грн</td>
					  </tr>
					  <tr>
						  <td colspan="7" style="background-color: #e0e0e0; text-align: right;">Ітого:</td>
						  <td colspan="8" style="background-color: #e0e0e0;">{{ Cart::total() }}</td>
					  </tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<!-- personal data -->
			<div class="col-md-12 text-center">
				<h3 class="text-center"><strong>Доставка і оплата</strong></h3>
			</div>
			{!! Form::open(['route' =>'order.store', 'id'=>'make_order']) !!}
				<div class="col-md-5">
					<div class="md-form form-sm">
                        {{ $errors->has('email') ? ' has-error' : '' }}
                        <i class="fa fa-envelope prefix"></i>
                        {{ Form::email('email', null, ['class' => 'form-control', 'required']) }}
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        <label for="email">Ваш email</label>
                    </div>
                    <div class="md-form form-sm">
                        <i class="fa fa-user prefix"></i>
                        {{ Form::text('name', null, array('class' => 'form-control')) }}
                        <label for="name">Ваше ім'я</label>
                    </div>
					{{-- <div class="col-md-12">
						<div class="form-group wow fadeInUp">
							{!! Form::label('name', 'Імʼя', ['class'=>"sr-only"]) !!}
							{!! Form::text('name', null , [
								'class' => 'form-control',
								'required' => 'required',
								'placeholder'=>"Ваше ім'я",
								'style'=>"font-style: italic;"
								]) !!}
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group wow fadeInUp" data-wow-delay=".1s">
							{!! Form::label('email', 'email', ['class' => 'sr-only']) !!}
							{!! Form::email('email', null, [
								'class' => 'form-control',
								'placeholder' => "E-mail",
								 'style' => "font-style: italic;",
								 'required' => 'required'
								 ]) !!}
						</div>
					</div> --}}
				</div>
				<!-- personal data -->
				<div class="col-md-7">
					<div class="col-md-12 d-flex justify-content-around" style="height: 50px; margin-bottom: 10px;">
						<div class="col-md-5 d-flex align-items-end justify-content-end">
							{!! Form::label('delivery_id', "Спосіб доставки", ['style' => "font-size: 14px; color: #757575;", 'class'=>' align-self-end']) !!}
						</div>
						<div class="col-md-7 d-flex align-items-end" style="height: 100%;">
							{!! Form::select('delivery_id', $deliveries->pluck('title', 'id'), null, ['class' => 'browser-default align-self-end', 'style'=>'width:100%']) !!}
						</div>
					</div>
					<div class="col-md-12 d-flex justify-content-around" style="height: 50px;">
						<div class="col-md-5 d-flex align-items-end justify-content-end">
							{!! Form::label('payment_id', "Спосіб оплати", ['style' => "font-size: 14px; color: #757575;", 'class'=>' align-self-end']) !!}
						</div>
						<div class="col-md-7 d-flex align-items-end" style="height: 100%;">
							{!! Form::select('payment_id', $payments->pluck('title', 'id'), null , ['class'=>'browser-default align-self-end', 'style'=>'width:100%']) !!}
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="md-form form-sm">
					    <i class="fa fa-pencil prefix"></i>
					    <textarea type="text" id="address" name="address" class="md-textarea"></textarea>
					    <label for="form8">Адресса</label>
					</div>
				</div>
				{!! Form::hidden('cart', Cart::content()) !!}
				{!! Form::token() !!}
				<div class="col-md-12">
					<div class="col-md-offset-1 col-md-5">
						<a href="{{ url('/products') }}" class="btn btn-success waves-effect waves-light">
							<i class="fa fa-angle-left" aria-hidden="true" style="padding-right: 5px;"></i><span>Продовжити покупки</span>
						</a> &nbsp;
					</div>
					<div class="col-md-5">
						<button type="submit" form="make_order" class="btn btn-success waves-effect waves-light" style="font-weight: normal;">
							<span>Сформувати замовлення<i class="fa fa-angle-right" aria-hidden="true" style="padding-left: 5px;"></i></span>
						</button>
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection