@extends('voyager::master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ voyager_asset('css/nestable.css') }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i>Перегляд профілю клієнта
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
                        <form action="{{ route('voyager.'.$dataType->slug.'.index') }}"
                              name="aboutusform" id="form-group" enctype="multipart/form-data" class="panel-body">
                            <!-- PUT Method if we are editing -->
                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <label for="name">ФІО клієнта:</label>
                                    <input type="text" name="name" class="form-control" value="{{ $dataTypeContent->name }}" id="title" disabled>
                                </div>
                                <div class="form-group col-md-6 col-xs-12">
                                    <label for="phone">Телефон:</label>
                                    <input type="text" name="phone" class="form-control" value="{{ $dataTypeContent->phone }}" id="phone" disabled>
                                </div>
                                <div class="form-group col-md-6 col-xs-12">
                                    <label for="name">E-mail:</label>
                                    <input type="email" name="email" class="form-control" value="{{ $dataTypeContent->email }}" id="email" disabled>
                                </div>
                                <div class="form-group col-md-6 col-xs-12">
                                    <label for="discount">Знижка:</label>
                                    <input type="number" name="discount" min="0" max="20" class="form-control" value="{{ $dataTypeContent->discount }}" id="discount" disabled>
                                </div>
                                <div class="form-group col-md-6 col-xs-12">
                                    <label for="card">Картка:</label>
                                    <input type="number" min="1" max="9999" name="card" class="form-control" id="card" value="{{ $dataTypeContent->card }}" disabled>
                                </div>
                            </div>

                        </form>
                        <div class="col-xs-12" style="text-align: right;">
                                <button type="submit" form="form-group" class="btn btn-success">
                                    <i class="voyager-medal-rank-star"></i> Повернутись назад
                                </button>
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
