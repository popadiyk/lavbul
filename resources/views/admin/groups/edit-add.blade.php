<link rel="stylesheet" href="/css/croppie.css" />
<script src="/js/croppie.js"></script>

@extends('voyager::master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ voyager_asset('css/nestable.css') }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i>Форма для створення/редагування категорій товару
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
            <p> Данна форма дозволяє редагувати, або створювати нові категорії товарів.</p>
            <p> Якщо поле "Назва батьківської категорії" залишити пустим, категорія буде почтаковою.</p>
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
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="name">Назва категорії:</label>
                                <input type="text" name="title" class="form-control" value="{{ $dataTypeContent->title }}" id="title">
                            </div>
                            <div class="form-group">
                                <label for="name">Назва батьківської категорії:</label>
                                {{--{{dd($dataTypeContent->group_id)}}--}}
                                <select size="4" id="group-select" name="parent_id" required >
                                    <option></option>
                                    <option value="0">ПОЧАТКОВА КАТЕГОРІЯ</option>
                                    @foreach($groups as $group)
                                        @if ($dataTypeContent->title == $group->title)
                                            @continue
                                        @endif
                                        @if ($group->id == $dataTypeContent->group_id)
                                            <option value="{{$group->id}}" selected="selected">{{$group->title}}</option>
                                        @else
                                        <option value="{{$group->id}}">{{$group->title}}</option>
                                        @endif
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="meta_title">SEO мета - назва сторінки:</label>
                                <input type="text" name="meta_title" class="form-control" value="{{ $dataTypeContent->meta_title }}" id="meta_title">
                            </div>
                            <div class="form-group">
                                <label for="meta_keyword">SEO мета - слова сторінки:</label>
                                <input type="text" name="meta_keyword" class="form-control" value="{{ $dataTypeContent->meta_keyword }}" id="meta_keyword">
                            </div>

                            <div class="form-group col-xs-12">
                                <div class="col-md-offset-3 col-md-6 ">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" style="padding: 10px;">
                                            Фото для соц. мереж:
                                        </div>
                                        <div class="panel-content" style="min-height: 220px; text-align: center; padding: 10px;">
                                            <div id="result_main_image">
                                                @if(isset($dataTypeContent->id))
                                                    <img src="/group_photo/{{$dataTypeContent->id}}.jpg" style="width: 350px; border: #EAEAEA solid 1px;">
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
    <script>

        var vanillaResult = document.querySelector('.vanilla-result'),
                vanillaSave = document.querySelector('.vanilla-save');
        var inputAddMain = document.getElementById('main_image_footer');
        var main_image = 0;
        var current_image = -1;

        function saveVanilla(result) {
            var demoResult = document.getElementById('result_main_image');
                    demoResult.innerHTML = '';
                    demoResult.innerHTML = '<a id="save" href="' + result + '" download="result"><img width="350px" src="' + result + '" /><br></a>';

                    inputAddMain.innerHTML = 'Зображення додане!<input type="hidden" name="main_photo" id="main_image" value="'+ result + '">';
        }

        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (event) {
                    var vanilla = new Croppie(document.getElementById('vanilla-demo'), {
                        viewport: {
                            width: 600,
                            height: 325
                        },
                        boundary: {
                            width: 602,
                            height: 327
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
                minimumInputLength: 2,
                placeholder: "Оберіть категорію, якщо потрібно...",
                language: {noResults: function(){return "Співпадінь, не знайдено";},
                            inputTooShort: function () { return 'Введіть більше 2-ух символів'; }},
                width: "100%"
            });

        })
    </script>
@stop
