@extends('voyager::master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ voyager_asset('css/nestable.css') }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i> Перегляд товару
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="container-fluid">
    </div>
    <div class="page-content container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-md-6 col-xs-12">
                                    <label for="marking">Код товару:</label>
                                    <input type="text" name="marking" class="form-control" value="{{ $dataTypeContent->marking }}" id="marking" disabled>
                                </div>
                                <div class="form-group col-md-6 col-xs-12">
                                    <label for="title">Назва товару:</label>
                                    <input type="text" name="title" class="form-control" value="{{ $dataTypeContent->title }}" id="title" disabled>
                                </div>
                                <div class="form-group col-md-6 col-xs-12">
                                    <label for="group_id">Группа товару:</label>
                                    <select size="4" id="group-select" name="group_id" required disabled>
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
                                    <select size="4" id="manufacture-select" name="manufacture_id" required disabled>
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
                                    <input type="text" name="purchase_price" class="form-control" value="{{ $dataTypeContent->purchase_price }}" id="purchase_price" disabled>
                                </div>


                                <div class="form-group col-md-4 col-xs-12">
                                    <label for="price">Ціна продажу:</label>
                                    <input type="text" name="price" class="form-control" value="{{ $dataTypeContent->price }}" id="price" disabled>
                                </div>

                                <div class="form-group col-md-4 col-xs-12">
                                    <label for="quantity">Кількість:</label>
                                    <input type="text" name="quantity" class="form-control" value="{{ $dataTypeContent->quantity }}" id="quantity" disabled>
                                </div>

                                <div class="form-group col-xs-12">
                                    <label for="main_photo">Фото:</label>
                                    @if(isset($dataTypeContent->id))
                                        <img src="{{ $dataTypeContent->main_photo }}" style="width: 200px;">
                                    @endif
                                </div>

                                <div class="form-group col-xs-12">
                                    <label for="description">Короткий опис:</label>
                                    <textarea rows="3" type="text" name="description" class="form-control" id="description" style="resize: none;" disabled>{{ $dataTypeContent->description }}</textarea>
                                </div>

                                <div class="form-group" style="text-align: right; margin: 15px;">
                                    <a href="{{ route('voyager.'.$dataType->slug.'.index', 1) }}" class="btn btn-success">
                                        <i class="voyager-edit"></i> Повернутись назад
                                    </a>
                                </div>

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
