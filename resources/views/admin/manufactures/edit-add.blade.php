@extends('voyager::master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ voyager_asset('css/nestable.css') }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i>Форма постачальників магазину
        @if (Voyager::can('add_'.$dataType->name))
            <button type="submit" form="form-group" class="btn btn-success">
                <i class="voyager-medal-rank-star"></i> Зберегти данні
            </button>
        @endif
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="container-fluid">
        <div class="alert alert-info">
            <strong>Що це?</strong>
            <p> Данна форма дозволяє редагувати, або створювати нових постачальників нашого магазину</p>
            <p> Поля з зірочками обовязкові до заповнення!</p>
        </div>
    </div>
    <div class="page-content container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <form action="@if (!isset($dataTypeContent->id)) {{ route('voyager.'.$dataType->slug.'.store') }} @else {{ route('voyager.'.$dataType->slug.'.update', $dataTypeContent->id) }} @endif"
                              name="aboutusform" id="form-group" method="POST" enctype="multipart/form-data" class="panel-body">
                            <!-- PUT Method if we are editing -->
                            @if(isset($dataTypeContent->id))
                                {{ method_field("PUT") }}
                            @endif
                    <div class="row">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group col-md-6 col-xs-12">
                                <label for="name">Назва постачальника або ФІО:</label>
                                <input type="text" name="title" class="form-control" value="{{ $dataTypeContent->title }}" id="title">
                            </div>
                            <div class="form-group col-md-6 col-xs-12">
                                <label for="phone">Телефон:</label>
                                <input type="text" name="phone" class="form-control" value="{{ $dataTypeContent->phone }}" id="phone">
                            </div>
                            <div class="form-group col-md-6 col-xs-12">
                                <label for="name">E-mail:</label>
                                <input type="email" name="email" class="form-control" value="{{ $dataTypeContent->email }}" id="email">
                            </div>

                            <div class="form-group col-md-6 col-xs-12">
                                <label for="type_id">Тип постачальника:</label>
                                <select size="4" id="group-select" name="type_id" required >
                                    <option></option>
                                    @foreach($manTypes as $manType)
                                        <option value="{{$manType->id}}">{{$manType->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-xs-12">
                                <label for="web_site">Сайт постачальника:</label>
                                <input type="text" name="web_site" class="form-control" value="{{ $dataTypeContent->web_site }}" id="web_site">
                            </div>
                    </div>

                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <p style="padding: 10px; margin: 0px;">Банківські реквізити</p>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group col-md-6 col-xs-12" style="margin: 0px;">
                                        <label for="web_site" style="padding-top: 5px;">ІНН:</label>
                                        <input type="text" name="inn" class="form-control" value="{{ $dataTypeContent->inn }}" id="inn">
                                    </div>
                                    <div class="form-group col-md-6 col-xs-12" style="margin: 0px;">
                                        <label for="ederpou" style="padding-top: 5px;">ЄДРПОУ:</label>
                                        <input type="text" name="ederpou" class="form-control" value="{{ $dataTypeContent->ederpou }}" id="ederpou">
                                    </div>
                                    <div class="form-group col-md-6 col-xs-12" style="margin: 0px;">
                                        <label for="mfo" style="padding-top: 5px;">МФО:</label>
                                        <input type="text" name="mfo" class="form-control" value="{{ $dataTypeContent->mfo }}" id="mfo">
                                    </div>
                                    <div class="form-group col-md-6 col-xs-12" style="margin: 0px;">
                                        <label for="rr" style="padding-top: 5px;">Розрахунковий рахунок:</label>
                                        <input type="text" name="rr" class="form-control" value="{{ $dataTypeContent->rr }}" id="rr">
                                    </div>
                                    <div class="form-group col-md-6 col-xs-12" style="margin: 0px;">
                                        <label for="bank" style="padding-top: 5px;">Банк:</label>
                                        <input type="text" name="bank" class="form-control" value="{{ $dataTypeContent->bank }}" id="bank">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Короткий опис:</label>
                                <textarea rows="3" type="text" name="description" class="form-control" id="email" style="resize: none;">{{ $dataTypeContent->description }}</textarea>
                            </div>
                        </form>
                        <div class="col-xs-12" style="text-align: right;">
                            @if (Voyager::can('add_'.$dataType->name))
                                <button type="submit" form="form-group" class="btn btn-success">
                                    <i class="voyager-medal-rank-star"></i> Зберегти данні
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @stop

        @section('javascript')
            @include('admin.cash_widget')

            <script>
            $(function(){
                $("#group-select").select2({
                    placeholder: "Оберіть тип постачальника",
                    language: {noResults: function(){return "Співпадінь, не знайдено";}},
                    width: "100%"
                });

            });
        </script>
@stop
