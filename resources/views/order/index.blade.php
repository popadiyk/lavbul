@extends('layouts.main')
@section('content')
<div class="container-fluid text-center classes_header_container">
	<h1 class="header_text"><span></span></h1>
</div>

<div class="container-fluid" style="padding-top: 30px; padding-bottom: 30px;">
	<div class="container" style="background-color: #F2F2F2;">
			<div class="col-md-12">
				<h3><strong>Ваша корзина</strong></h3>
			</div>
		<div class="row">
			<div class="col-md-12">
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
									<input type="submit" class="btn btn-danger btn-sm" value="Видалити">
								</form>
							  </td>
						      <td style="width: 70px;"><img src="img/for_order.png"></td>
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
							  <td colspan="8" style="background-color: #e0e0e0;">{{ number_format(Cart::total(), 2) }}</td>
						  </tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<!-- personal data -->
		<div class="col-md-12">
			<h3><strong>Доставка і оплата</strong></h3>
		</div>
		{{---------------- the begin of the form -------------------}}
		{!! Form::open(['route' =>'order.store', 'id'=>'make_order']) !!}
			<div class="row">
				<div class="col-md-8">
					<div class="col-md-3">Імʼя</div>
					<div class="col-md-7">
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
					<br>
					<div class="col-md-3">E-mail</div>
					<div class="col-md-7">
						<div class="form-group wow fadeInUp" data-wow-delay=".1s">
							{{--<label class="sr-only" for="c_email">Email</label>--}}
							{!! Form::label('email', 'E-mail', ['class' => 'sr-only']) !!}
							{!! Form::email('email', null, [
								'class' => 'form-control',
								'placeholder' => "E-mail",
								 'style' => "font-style: italic;",
								 'required' => 'required'
								 ]) !!}
						</div>
					</div>
				</div>
			</div>
			<!-- personal data -->
			<div class="row">
				<div class="col-md-8">
					<div class="col-md-3">
						{!! Form::label('delivery_id', "Спосіб доставки", ['style' => "font-size: 14px; padding-top: 20px;"]) !!}
					</div>
					<div class="col-md-7">
						<div class="form-group">
							<label for="sel1"></label>
							{!! Form::select('delivery_id', $deliveries->pluck('title', 'id'), null, ['class' => 'form-control']) !!}
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
					<div class="col-md-3">
						{{--<p style="font-size: 14px; padding-top: 20px;"><strong>Спосіб оплати</strong></p>--}}
						 {!! Form::label('payment_id', "Спосіб оплати", ['style' => "font-size: 14px; padding-top: 20px;"]) !!}
					</div>
					<div class="col-md-7">
						<div class="form-group">
							<label for="sel1"></label>
							{!! Form::select('payment_id', $payments->pluck('title', 'id'), null , ['class'=>'form-control']) !!}
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
					<div class="col-md-3">
						{!! Form::label('address', 'Адресса', ['style' => "font-size: 14px; padding-top: 20px;"]) !!}
					</div>
					<div class="col-md-7">
						<div class="form-group">
							<label for="sel1"></label>
							{!! Form::textarea('address', null , ['class' => 'form-control','required' => 'required' ]) !!}
						</div>
					</div>
				</div>
			</div>
			{!! Form::hidden('cart', Cart::content()) !!}
			{!! Form::token() !!}
			{{-------------- the buttons block --------------}}
			<div class="row" style="padding-bottom: 30px;">
				<div class="col-md-7 col-md-offset-2" style="padding: 0">
					<div class="col-md-4">
						{{--<button type="button" class="btn btn-small" id="make_order" style="background-color: #b9f8a8;">
							<i class="fa fa-angle-left" aria-hidden="true" style="padding-right: 5px;"></i><span>Продовжити покупки</span>
						</button>--}}

						<a href="{{ url('/') }}" class="btn btn-primary btn-smal" style="background-color: #b9f8a8; border: 0px solid; color:black;">
							<i class="fa fa-angle-left" aria-hidden="true" style="padding-right: 5px;"></i><span>Продовжити покупки</span>
						</a> &nbsp;
					</div>
					<div class="col-md-4">
						<button type="submit" form="make_order" class="btn btn-small" style="background-color: #b9f8a8;">
							<span>Сформувати замовлення<i class="fa fa-angle-right" aria-hidden="true" style="padding-left: 5px;"></i></span>
						</button>
					</div>
				</div>
			</div>
			{{-------------- the ens buttons block-----------}}
		{!! Form::close() !!}
		{{---------------- the begin of the form -------------------}}
	</div>
</div>
@endsection