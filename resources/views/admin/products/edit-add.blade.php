<link rel="stylesheet" href="/css/croppie.css" />
<script src="/js/croppie.js"></script>

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
    @if (count($errors) > 0)
        <div class="container-fluid">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
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
                                    <input type="text" name="marking" class="form-control" value="{{ $dataTypeContent->marking }}" id="marking" required>
                                </div>
                                <div class="form-group col-md-6 col-xs-12">
                                    <label for="title">Назва товару:</label>
                                    <input type="text" name="title" class="form-control" value="{{ $dataTypeContent->title }}" id="title" required>
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
                                    <input type="text" name="purchase_price" class="form-control" value="@if(isset($dataTypeContent->purchase_price)){{ $dataTypeContent->purchase_price }}@endif" id="purchase_price" required>
                                </div>


                                <div class="form-group col-md-4 col-xs-12">
                                    <label for="price">Ціна продажу:</label>
                                    <input type="text" name="price" class="form-control" value="@if(isset($dataTypeContent->price)){{ $dataTypeContent->price }}@endif" id="price" required>
                                </div>

                                <div class="form-group col-md-4 col-xs-12">
                                    <label for="quantity">Кількість:</label>
                                    <input type="text" name="quantity" class="form-control" value="@if(isset($dataTypeContent->id)){{ $dataTypeContent->quantity }}@endif" id="quantity" required>
                                </div>

                                <div class="form-group col-md-12 col-xs-12">
                                    <label for="quantity">SEO (title) мета-назва сторінки:</label>
                                    <input type="text" name="meta_title" class="form-control" value="@if(isset($dataTypeContent->meta_title)){{ $dataTypeContent->meta_title }}@endif" id="meta_title">
                                </div>

                                <div class="form-group col-md-12 col-xs-12">
                                    <label for="quantity">SEO (keyword) мета-слова:</label>
                                    <input type="text" name="meta_keyword" class="form-control" value="@if(isset($dataTypeContent->meta_keyword)){{ $dataTypeContent->meta_keyword }}@endif" id="meta_keyword">
                                </div>

                                <div class="form-group col-xs-12">
                                    <div class="col-md-4">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" style="padding: 10px;">
                                                Головне фото:
                                            </div>
                                            <div class="panel-content" style="min-height: 220px; text-align: center; padding: 10px;">
                                                <div id="result_main_image">
                                                    @if(isset($dataTypeContent->id))
                                                        <img src="{{ $dataTypeContent->main_photo }}" style="width: 200px;">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="panel-footer">
                                                <input type="file" id="main_image">
                                                <div class="" style="color: red;" id="main_image_footer">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" style="padding: 10px;">
                                                Додаткове фото(1):
                                            </div>
                                            <div class="panel-content" style="min-height: 220px; text-align: center; padding: 10px;">
                                                <div id="result_sup_image_1">
                                                    @if(isset($supPhotos[0]->id))
                                                        <img src="{{ $supPhotos[0]->path }}" style="width: 200px;">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="panel-footer">
                                                <input type="file" id="sup_image_1">
                                                <div class="" style="color: red;" id="sup_image_footer_1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" style="padding: 10px;">
                                                Додаткове фото(2):
                                            </div>
                                            <div class="panel-content" style="min-height: 220px; text-align: center; padding: 10px;">
                                                <div id="result_sup_image_2">
                                                    @if(isset($supPhotos[1]->id))
                                                        <img src="{{ $supPhotos[1]->path }}" style="width: 200px;">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="panel-footer">
                                                <input type="file" id="sup_image_2">
                                                <div class="" style="color: red;" id="sup_image_footer_2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--!! crop--}}
                                    {{--!!--}}
                                </div>

                                <div class="form-group col-xs-12">
                                    <label for="description">Короткий опис:</label>
                                    <textarea rows="10" type="text" name="description" class="form-control" id="description" style="resize: none;">{{ $dataTypeContent->description }}</textarea>
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

                        {{--MODAL to photo--}}
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="row" style="text-align: center;">
                                                <div id="vanilla-demo" style="margin: 20px; height: auto; width: auto;"></div>
                                                <div class="row">
                                                    <button class="vanilla-save btn btn-success" data-dismiss="modal">Подтвердить.</button>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="col-xs-offset-2 col-xs-4" id="result"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @stop

        @section('javascript')
            @include('admin.cash_widget')

            <script>
                {{--!! crop--}}
                // croppie for news creating/updating



                var vanillaResult = document.querySelector('.vanilla-result'),
                        vanillaSave = document.querySelector('.vanilla-save');
                var inputAddMain = document.getElementById('main_image_footer');
                var inputAddSup1 = document.getElementById('sup_image_footer_1');
                var inputAddSup2 = document.getElementById('sup_image_footer_2');
                var main_image = 0, sup_image_1 = 1, sup_image_2 = 2;
                var current_image = -1;

//                function resultVanilla(result) {
//                    var demoResult = document.getElementById('result');
//                    demoResult.innerHTML = '<img style="border: 1px solid red;" width="300px"src="' + result + '" />';
//                }

                function saveVanilla(result) {
                    switch (current_image){
                        case 0 :
                            var demoResult = document.getElementById('result_main_image');
                            demoResult.innerHTML = '';
                            demoResult.innerHTML = '<a id="save" href="' + result + '" download="result"><img width="200px" src="' + result + '" /><br></a>';

                            inputAddMain.innerHTML = 'Зображення додане!<input type="hidden" name="main_photo" id="main_image" value="'+ result + '">';
                            break;
                        case 1:
                            var demoResult = document.getElementById('result_sup_image_1');
                            demoResult.innerHTML = '';
                            demoResult.innerHTML = '<a id="save" href="' + result + '" download="result"><img width="200px" src="' + result + '" /><br></a>';

                            inputAddSup1.innerHTML = 'Зображення додане!<input type="hidden" name="sup_photo_1" id="sup_image_1" value="'+ result + '">';

                            break;
                        case 2:
                            var demoResult = document.getElementById('result_sup_image_2');
                            demoResult.innerHTML = '';
                            demoResult.innerHTML = '<a id="save" href="' + result + '" download="result"><img width="200px" src="' + result + '" /><br></a>';

                            inputAddSup2.innerHTML = 'Зображення додане!<input type="hidden" name="sup_photo_2" id="sup_image_2 " value="'+ result + '">';
                            break;
                    }
                }

                function readFile(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (event) {
                            var vanilla = new Croppie(document.getElementById('vanilla-demo'), {
                                viewport: {
                                    width: 500,
                                    height: 500
                                },
                                boundary: {
                                    width: 502,
                                    height: 502
                                },
//                                mouseWheelZoom: false,
                                enforceBoundary: false,
                                enableOrientation: true,
                            });
                            vanilla.bind({
                                url: event.target.result,
                                orientation: 1
                              });
                            vanilla.result({
                                size: 'viewport'
                            });
//                            vanillaResult.addEventListener('click', function() {
//                                vanilla.result('canvas').then(resultVanilla);
//                            });
                            vanillaSave.addEventListener('click', function() {
                                vanilla.result('canvas').then(saveVanilla);
                            });

                        };

                        reader.readAsDataURL(input.files[0]);
                    } else {
                        alert('Sorry - you\'re browser doesn\'t support the FileReader API');
                    }
                }

                $('#main_image').on('change', function() {
                    current_image = main_image;
                    $('#myModal').modal('show');
                    var preview = document.getElementById('vanilla-demo');
                    preview.innerHTML = '';
                    readFile(this);
                });
                $('#sup_image_1').on('change', function() {
                    current_image = sup_image_1;
                    $('#myModal').modal('show');
                    var preview = document.getElementById('vanilla-demo');
                    preview.innerHTML = '';
                    readFile(this);
                });
                $('#sup_image_2').on('change', function() {
                    current_image = sup_image_2;
                    $('#myModal').modal('show');
                    var preview = document.getElementById('vanilla-demo');
                    preview.innerHTML = '';
                    readFile(this);
                });
                {{--!!--}}

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
