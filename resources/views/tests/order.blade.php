@extends('tests.master')

@section('content')

    <div class="container">
        <p><a href="{{ url('shop') }}">Home</a> / Cart</p>
        <h1>Maker Order</h1>

        <hr>
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
        <h3>Your order</h3>
        <div class="col-sm-offset-2 col-sm-10">
        @if (sizeof(Cart::content()) > 0)
            <table class="table">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach (Cart::content() as $item)
                    <tr>
                        <td><a href="{{ url('shop', [$item->model->slug]) }}">{{ $item->name }}</a></td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->subtotal }}</td>
                        <td class=""></td>
                    </tr>
                @endforeach
                <tr>
                    <td class="table-image"></td>

                    <td class="small-caps table-bg" style="text-align: right">Subtotal</td>
                    <td>{{ Cart::instance('default')->subtotal() }}</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="table-image"></td>
                    <td class="small-caps table-bg" style="text-align: right">Cost delivery</td>
                    <td>{{ Cart::instance('default')->tax() }}</td>
                    <td></td>
                    <td></td>
                </tr>

                <tr class="border-bottom">
                    <td class="table-image"></td>
                    <td class="small-caps table-bg" style="text-align: right">Your Total</td>
                    <td class="table-bg">{{ Cart::total() }}</td>
                    <td class="column-spacer"></td>
                    <td></td>
                </tr>

                </tbody>
            </table>
        @endif
        </div>
        {!! Form::open(['route' =>'order.store', 'class'=>"form-horizontal"]) !!}
        <h3>Personal date</h3>
        <div class="form-group">
            {!! Form::label('name', 'Your name', ['class'=>"control-label col-sm-2"]) !!}
            <div class="col-sm-10">
                {!! Form::text('name', null , ['class' => 'form-control', 'required' => 'required']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('address', 'Your adress', ['class' => 'control-label col-sm-2' ]) !!}
            <div class="col-sm-10">
                 {!! Form::textarea('address', null , ['class' => 'form-control','required' => 'required' ]) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('delivery_id', "Delivery services", ['class' => 'control-label col-sm-2']) !!}
            <div class="col-sm-10">
                {!! Form::select('delivery_id', $deliveries->pluck('title', 'id'), null) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('payment_id', "Payment services", ['class' => 'control-label col-sm-2']) !!}
            <div class="col-sm-10">
                {!! Form::select('payment_id', $payments->pluck('title', 'id'), null) !!}
            </div>
        </div>
        {!! Form::hidden('cart', Cart::content()) !!}
        {!! Form::token() !!}

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!! Form::submit('Make order',['class' => 'btn btn-success']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection