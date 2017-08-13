@extends('voyager::master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ voyager_asset('css/nestable.css') }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i>Форма користувачів магазину
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
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <form action="@if (!isset($dataTypeContent->id)) {{ route('voyager.'.$dataType->slug.'.store') }} @else {{ route('voyager.'.$dataType->slug.'.update', $dataTypeContent->id) }} @endif"
                              name="userform" id="form-group" method="POST" enctype="multipart/form-data" class="panel-body">
                            <!-- PUT Method if we are editing -->
                            @if(isset($dataTypeContent->id))
                                {{ method_field("PUT") }}
                            @endif
                            <div class="row">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group col-xs-12">
                                    <label for="name">ФІО користувача:</label>
                                    <input type="text" name="name" class="form-control" value="{{ $dataTypeContent->name }}" id="title">
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
                                    <label for="role_id">Права доступу:</label>
                                    <select size="4" id="group-select" name="role_id" required >
                                        @foreach($roles as $role)
                                            <option value={{$role->id}} @if ($dataTypeContent->role_id == $role->id) selected @endif>{{$role->display_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-xs-12">
                                    <label for="client_id">Клієнт:</label>
                                    <select size="4" id="client-select" name="client_id" required >
                                        @foreach($clients as $client)
                                            <option value={{$client->id}} @if ($dataTypeContent->getClient()->first()->id == $client->id) selected @endif>Картка: {{$client->card}} - {{$client->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-12 col-xs-12">
                                    <label for="address">Адресса доставки:</label>
                                    <input type="text" name="address" class="form-control" id="card" value="{{ $dataTypeContent->card }}">
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
            @include('admin.cash_widget')
            <script>
                $(function(){
                    $("#group-select").select2({
                        placeholder: "Оберіть права доступу",
                        maximumSelectionLength: 3,
                        language: {noResults: function(){return "Співпадінь, не знайдено";}},
                        width: "100%"
                    });
                });

                $(function(){
                    $("#client-select").select2({
                        placeholder: "Клієнт",
                        maximumSelectionLength: 3,
                        language: {noResults: function(){return "Співпадінь, не знайдено";}},
                        width: "100%"
                    });
                });

            </script>
        @stop
