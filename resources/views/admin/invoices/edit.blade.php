@extends('voyager::master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ voyager_asset('css/nestable.css') }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i>Змітини накладну
        @if (Voyager::can('add_'.$dataType->name))
            <button type="submit" form="form-group" class="btn btn-success">
                <i class="voyager-medal-rank-star"></i> Зберегти данні
            </button>
        @endif
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <div class="row">
                        <div class="col-xs-6" >
                            <div class="row" style="height: 400px; overflow-y: scroll; margin: 0px;">
                                <table id="invoiceTable" class="table table-hover" style="font-size: 11px; border: #EAEAEA solid 1px;">
                                    <thead>
                                    <tr>
                                        <th>Код</th>
                                        <th style="width: 250px;">Назва</th>
                                        <th style="text-align: center;">Кількість</th>
                                        <th style="text-align: center;">Ціна</th>
                                        <th style="text-align: center;">Сумма</th>
                                        <th style="text-align: center;">Дія</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                            <tr style="background: @if ($loop->iteration%2 == 0) palegreen @else mediumspringgreen @endif;">
                                                <td>{{$product[0]}}</td>
                                                <td>{{$product[1]}}</td>
                                                <td style="text-align: center;">{{$product[2]}}</td>
                                                <td style="text-align: center;">{{$product[3]}}</td>
                                                <td class="summ" style="text-align: center;">{{$product[4]}}</td>
                                                <td style="text-align: center;"> <i class="voyager-wallet" style="color:green; cursor: pointer;"></i></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row" style="padding: 8px; padding-right: 20px; text-align: right; background: #EAEAEA; height: 100px; width: 100%; margin: 0px;">
                                <div class="row" style="margin: 0px;">
                                    <label>Сумма:</label>
                                    <input type="text" name="total-sum" id="total-sum" style="width: 20%;  text-align: center; border:none; border:solid 1px #ccc; border-radius: 5px;" disabled>
                                </div>
                                <div class="row" style="margin: 0px;">
                                    <label>Знижка:</label>
                                    <input type="text" name="discount" @if ($invoice->client->discount) value="{{$invoice->client->discount}} %" @else value="-" @endif id="discount" style="width: 20%; text-align: center; border:none; border:solid 1px #ccc; border-radius: 5px;" disabled>
                                </div>
                                <div class="row" style="margin: 0px;">
                                    <label>Сумма зі знижкою:</label>
                                    <input type="text" name="total-sum-discount" value="{{number_format($invoice->total_account, 2, '.', '')}}" id="total-sum-discount" style="color:orangered; font-weight: bold; width: 20%;  text-align: center; border:none; border:solid 1px #ccc; border-radius: 5px;" disabled>
                                </div>
                            </div>
                        </div>

                        <div id="invoice_info" class="col-xs-6" style="width: 48%; padding: 0px; height: 460px; overflow-y: scroll;">
                            <form action="{{ route('voyager.'.$dataType->slug.'.update', $invoice->id) }}"
                                  name="invoiceform" id="form-group" method="POST" enctype="multipart/form-data" class="panel-body">
                                <!-- PUT Method if we are editing -->
                                    {{ method_field("PUT") }}
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label style="background: yellow; padding: 3px 8px; border-radius: 4px;" for="name"> Накладна <strong>
                                            @if($invoice->type == 'sales')
                                                на продаж
                                            @elseif($invoice->type == 'purchase')
                                                на закупівлю
                                            @elseif($invoice->type == 'writeOf')
                                                на списання
                                            @elseif($invoice->type == 'realisation')
                                                на реалізацію
                                            @endif</strong>
                                            номер: <strong>#{{$invoice->id}}</strong> від <strong>{{$invoice->created_at->format('d.m.Yр. | H:i')}} </strong>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label for="name">Контрагент: <strong>
                                            @if ($invoice->type == 'realisation' || $invoice->type == 'purchase')
                                                {{$invoice->client->title}}
                                            @else
                                                {{$invoice->client->name}}
                                            @endif</strong></label>
                                </div>

                                <div class="form-group">
                                    <label for="name">Поточний статус:
                                            @if ($invoice->status == 'closed')
                                            <strong style="color: limegreen;">УСПІШНА</strong>
                                            @elseif ($invoice->status == 'confirmed')
                                            <strong style="color: blue;">СТВОРЕНА</strong>
                                            @elseif ($invoice->status == 'failed')
                                            <strong style="color: red;">ВІДМІНЕНА</strong>
                                            @endif</label>
                                </div>

                                <div class="form-group">
                                    <label for="name">Змінити статус накладної:</label>
                                    <select size="4" id="group-select" name="status" required >
                                        <option value="closed">УСПІШНА</option>
                                        <option value="confirmed">СТВОРЕНА</option>
                                        <option value="failed">ВІДМІНЕНА</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        {{--<div class="row">--}}
            {{--<div class="col-md-12">--}}
                {{--<div class="panel panel-bordered">--}}
                    {{--<div class="panel-body">--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        @stop

        @section('javascript')
            @include('admin.cash_widget')

            <script>
                $(function(){
                    $("#group-select").select2({
                        placeholder: "",
                        width: "100%"
                    });

                })
            </script>
@stop
