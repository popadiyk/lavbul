<link rel="stylesheet" href="/css/croppie.css" />
<script src="/js/croppie.js"></script>

@extends('voyager::master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ voyager_asset('css/nestable.css') }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i>Форма новин
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
                              name="aboutusform" id="form-group" method="POST" enctype="multipart/form-data" class="panel-body">
                            <!-- PUT Method if we are editing -->
                            @if(isset($dataTypeContent->id))
                                {{ method_field("PUT") }}
                            @endif
                    <div class="row">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group col-md-12 col-xs-12">
                                <label for="title">Назва новини:</label>
                                <input type="text" name="title" class="form-control" value="{{ $dataTypeContent->title }}" id="title" required>
                            </div>
                            <div class="form-group col-md-12 col-xs-12">
                                <label for="keyword">Слова для СЕО:</label>
                                <input type="text" name="keyword" class="form-control" value="{{ $dataTypeContent->keyword }}" id="keyword" required>
                            </div>


                    </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <p style="padding: 10px; margin: 0px;">Текст новини:</p>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <textarea rows="9" type="text" name="description" class="form-control" id="email" style="margin-top:15px; resize: none;">{{ $dataTypeContent->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin: 0px;">
                                    <div class="panel panel-success">
                                        <div class="panel-heading" style="padding: 10px;">
                                            Головне фото:
                                        </div>
                                        <div class="panel-content" style="min-height: 180px; text-align: center; padding: 10px;">
                                            <div id="result_main_image">
                                                @if(isset($dataTypeContent->id))
                                                    <img src="{{ $dataTypeContent->main_photo }}" style="width: 180px;">
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

        @stop

        @section('javascript')
            @include('admin.cash_widget')

            <script src="/js/datepickerUA.js"></script>
            <script>
                var vanillaResult = document.querySelector('.vanilla-result'),
                        vanillaSave = document.querySelector('.vanilla-save');
                var inputAddMain = document.getElementById('main_image_footer');
                var main_image = 0;
                var current_image = -1;

                function saveVanilla(result) {
                    var demoResult = document.getElementById('result_main_image');
                    demoResult.innerHTML = '';
                    demoResult.innerHTML = '<a id="save" href="' + result + '" download="result"><img width="200px" src="' + result + '" /><br></a>';

                    inputAddMain.innerHTML = 'Зображення додане!<input type="hidden" name="main_photo" id="main_image" value="'+ result + '">';
                }
                function readFile(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (event) {
                            var vanilla = new Croppie(document.getElementById('vanilla-demo'), {
                                viewport: {
                                    width: 400,
                                    height: 300
                                },
                                boundary: {
                                    width: 402,
                                    height: 302
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


                $(function(){
                $("#group-select").select2({
                    placeholder: "",
                    language: {noResults: function(){return "Співпадінь, не знайдено";}},
                    width: "100%"
                });

                    $( "#date" )
                            .datepicker({
                                changeMonth: true,
                                numberOfMonths: 1,
                                minDate: 0
                            })
                            .datepicker();
//                $(document).ready(function() {
//                    $('#time').mask('00:00');
//                });

            });
        </script>
@stop
