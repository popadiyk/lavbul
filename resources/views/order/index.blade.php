@extends('layouts.main')
	<style type="text/css">
		@media(max-width:480px){
			.btn-danger{
				padding: 3px 5px !important;
			}
			thead {
				font-size: 12px;
			}

			tbody {
				font-size: 12px;
			}
		}

		@media(max-width:375px){
			#btn1 {
				padding: 3px;
			}
			thead {
				font-size: 10px;
			}

			tbody {
				font-size: 10px;
			}
		}
		@media (max-width: 767px) {
			.order_container .maxWidth {
		    	max-width: none !important;
		    }
		}
		@media (max-width: 568px) {
		    .order_container .btns-block {
		       	flex-direction: column;
		    	align-items: center;
		    }
		}
	</style>

@section('content')
<div class="container-fluid text-center classes_header_container">
	<div class="container-fluid text-center black_header_container hidden-xs" style="padding: 0;">
	</div>
</div>

<div class="container-fluid order_container" style="padding-top: 30px; padding-bottom: 30px;">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 text-center">
				<h3><strong>Оформлення замовлення</strong></h3>
			</div>
			<div class="col-xs-12">
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
					  <thead style="background-color:#f1e4d3;">
					    <tr>
					      <td style="width: 20px; text-align: center;"></td>
					      <td class="hidden-xs"></td>
					      <td style="text-align: center;">Назва</td>
					      <td class="hidden-xs" style="text-align: center;">Ціна</td>
					      <td class="hidden-xs" style="text-align: center;">Знижка</td>
					      <td style="text-align: center;">Ціна зі знижкою</td>
					      <td style="text-align: center;">Кількість</td>
					      <td style="text-align: center;">Сумма</td>
					    </tr>
					  </thead>
					  <tbody>
					  @foreach(Cart::content() as $item)
					    <tr>
					      <td id="btn1">
							<form action="{{ url('cart', [$item->rowId]) }}" method="POST" class="side-by-side">
								{!! csrf_field() !!}
								<input type="hidden" name="_method" value="DELETE">
								<button type="submit" class="btn btn-danger btn-sm text-uppercase waves-effect waves-light">X</button>
							</form>
						  </td>
					      <td class="hidden-xs" style="width: 70px; text-align: center;"><img src="{{ App\Product::find($item->id)->main_photo }}" width="100%"></td>
					      <td style="width: 200px; padding-top: 25px; text-align: center; color: #00acee;">{{ $item->name }}</td>
					      <td class="hidden-xs" style="padding-top: 25px; text-align: center;">{{ number_format(floatval($item->subtotal) / floatval($item->qty) , 2) }}</td>
					      <td class="hidden-xs" style="padding-top: 25px; text-align: center;">@if (Auth::user()) {{ 100 - floatval(Auth::user()->getDiscount())*100 }}% @endif</td>
					      <td style="padding-top: 25px; text-align: center;">@if (Auth::user()) {{ number_format(floatval($item->subtotal) / floatval($item->qty) * floatval(Auth::user()->getDiscount()), 2) }} @else{{ number_format(floatval($item->subtotal) / floatval($item->qty), 2).'грн.' }}@endif</td>
						  <td style="padding-top: 25px; text-align: center;"> <p>{{ $item->qty }}</p></td>
					      <td style="padding-top: 25px; text-align: center;">@if (Auth::user()) {{ number_format(floatval($item->subtotal) * floatval(Auth::user()->getDiscount()), 2) }} @else {{ number_format(floatval($item->subtotal), 2) }} @endif</td>
					    </tr>
					  @endforeach
					  <tr style="font-size: 12px;">
						  <td colspan="3" class="hidden-xs" style="padding-top: 2px; background-color: #e0e0e0; text-align: right;"></td>
						  <td colspan="4" style="background-color: #e0e0e0; text-align: right; padding: 2px 8px;">Разом:</td>
						  <td style="background-color: #e0e0e0; padding: 2px 8px; text-align: center;">{{ Cart::total() }} грн.</td>
					  </tr>
					  <tr style="font-size: 12px;">
						  <td colspan="3" class="hidden-xs" style="padding-top: 2px; background-color: #e0e0e0; text-align: right;"></td>
						  <td colspan="4" style="background-color: #e0e0e0; padding: 2px 8px; text-align: right;">Знижка:</td>
						  <td style="padding: 2px 8px; background-color: #e0e0e0; text-align: center; color: green;">@if (Auth::user()) {{ 100 - Auth::user()->getDiscount()*100 }}% @else 0%@endif</td>
					  </tr>
					  <tr>
						  <td colspan="3" class="hidden-xs" style="padding-top: 2px; background-color: #e0e0e0; text-align: right;"></td>
						  <td colspan="4" style="padding-top: 2px; background-color: #e0e0e0; text-align: right;">Разом зі знижкою:</td>
						  <td colspan="5" style="padding-top: 2px; background-color: #e0e0e0; text-align: center; color: red;">@if (Auth::user()) {{number_format(floatval(Cart::total()) * floatval(Auth::user()->getDiscount()), 2)}} @else {{ number_format(Cart::total(), 2) }} @endif грн.</td>
					  </tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<!-- personal data -->
			<div class="col-12 text-center">
				<h3 class="text-center"><strong>Доставка і оплата</strong></h3>
			</div>
			{!! Form::open(['route' =>'order.store', 'id'=>'make_order', 'style'=>'width:100%']) !!}
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input name="_check" type="hidden" value="{{ time() }}">
				<div class="maxWidth col-sm-5 col-md-5">
					<div class="md-form form-sm">
                        {{ $errors->has('email') ? ' has-error' : '' }}
                        <i class="fa fa-envelope prefix"></i>
                        @if(Auth::user()) {{ Form::email('email', Auth::user()->email, ['class' => 'form-control', 'required']) }} @else {{ Form::email('email', null, ['class' => 'form-control', 'required']) }} @endif
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        <label for="email">Ваш email</label>
                    </div>
                    <div class="md-form form-sm">
                        <i class="fa fa-user prefix"></i>
                        @if (Auth::user()) {{ Form::text('name', Auth::user()->name, array('class' => 'form-control')) }} @else{{ Form::text('name', null, array('class' => 'form-control' , 'required')) }}@endif
                        <label for="name">Ваше ім'я</label>
                    </div>
					<div class="md-form form-sm">
						<i class="fa fa-phone prefix"></i>
							@if (Auth::user()) {{ Form::text('phone', Auth::user()->phone, array('class' => 'form-control')) }} @else{{ Form::text('phone', null, array('class' => 'form-control', 'required')) }}@endif
						<label for="name">Телефон</label>
					</div>

				</div>
				<!-- personal data -->
				<div class="maxWidth col-sm-7 col-md-7">
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
				<div class="col-sm-12 col-md-12">
					<div class="md-form form-sm">
					    <i class="fa fa-pencil prefix"></i>
					    <textarea type="text" id="address" name="address" class="md-textarea">@if (Auth::user()){{Auth::user()->address}}@endif</textarea>
					    <label for="form8">Адресса</label>
					</div>
				</div>
				{!! Form::hidden('cart', Cart::content()) !!}
				{!! Form::token() !!}
				<div class="btns-block d-flex col-12" style="justify-content: space-around;">
					<div>
						<a href="{{ url('/products') }}" class="btn btn-success waves-effect waves-light">
							<i class="fa fa-angle-left" aria-hidden="true" style="padding-right: 5px;"></i><span>Продовжити покупки</span>
						</a> &nbsp;
					</div>
					<div>
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