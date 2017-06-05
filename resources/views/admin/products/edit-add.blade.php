@extends('voyager::master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ voyager_asset('css/nestable.css') }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i>Форма товару
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
            <p> Данна форма дозволяє редагувати, або створювати нові товари нашого магазину</p>
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
                                    <label for="marking">Код товару:</label>
                                    <input type="text" name="marking" class="form-control" value="{{ $dataTypeContent->marking }}" id="marking">
                                </div>
                                <div class="form-group col-md-6 col-xs-12">
                                    <label for="title">Назва товару:</label>
                                    <input type="text" name="title" class="form-control" value="{{ $dataTypeContent->title }}" id="title">
                                </div>
                                <div class="form-group col-md-6 col-xs-12">
                                    <label for="group_id">Группа товару:</label>
                                    <select size="4" id="group-select" name="group_id" required >
                                        @foreach($groups as $group)
                                            @if ($group->id == $dataTypeContent->group_id)
                                                <option value="{{$group->id}}" selected="selected">{{$group->title}}</option>
                                            @else
                                            <option value="{{$group->id}}">{{$group->title}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6 col-xs-12">
                                    <label for="manufacture_id">Постачальник:</label>
                                    <select size="4" id="manufacture-select" name="manufacture_id" required >
                                        <option></option>
                                        @foreach($manufactures as $manufacture)
                                            @if ($manufacture->id == $dataTypeContent->manufacture_id)
                                                <option value="{{$manufacture->id}}" selected="selected">{{$manufacture->title}}</option>
                                            @else
                                                <option value="{{$manufacture->id}}">{{$manufacture->title}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-4 col-xs-12">
                                    <label for="purchase_price">Ціна закупки:</label>
                                    <input type="text" name="purchase_price" class="form-control" value="{{ $dataTypeContent->purchase_price }}" id="purchase_price">
                                </div>


                                <div class="form-group col-md-4 col-xs-12">
                                    <label for="price">Ціна продажу:</label>
                                    <input type="text" name="price" class="form-control" value="{{ $dataTypeContent->price }}" id="price">
                                </div>

                                <div class="form-group col-md-4 col-xs-12">
                                    <label for="quantity">Кількість:</label>
                                    <input type="text" name="quantity" class="form-control" value="{{ $dataTypeContent->quantity }}" id="quantity">
                                </div>

                                <div class="form-group col-xs-12">
                                    <label for="main_photo">Фото:</label>
                                    @if(isset($dataTypeContent->id))
                                        <img src="{{ $dataTypeContent->main_photo }}" style="width: 200px;">
                                    @endif
                                    <input type="file" name="main_photo">
                                </div>

                                <div class="form-group col-xs-12">
                                    <label for="description">Короткий опис:</label>
                                    <textarea rows="3" type="text" name="description" class="form-control" id="description" style="resize: none;">{{ $dataTypeContent->description }}</textarea>
                                </div>

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
            <script>
                $(function(){
                    $("#group-select").select2({
                        placeholder: "Оберіть тип постачальника",
                        language: {noResults: function(){return "Співпадінь, не знайдено";}},
                        width: "100%"
                    });
                });

                $(function(){
                    $("#manufacture-select").select2({
                        placeholder: "Оберіть тип постачальника",
                        language: {noResults: function(){return "Співпадінь, не знайдено";}},
                        width: "100%"
                    });
                });
            </script>
@stop
