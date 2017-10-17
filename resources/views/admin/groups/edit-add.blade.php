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
                                <label for="meta_title">Назва категорії:</label>
                                <input type="text" name="meta_title" class="form-control" value="{{ $dataTypeContent->meta_title }}" id="meta_title">
                            </div>
                            <div class="form-group">
                                <label for="meta_keyword">Назва категорії:</label>
                                <input type="text" name="meta_keyword" class="form-control" value="{{ $dataTypeContent->meta_keyword }}" id="meta_keyword">
                            </div>

                        </form>
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
                minimumInputLength: 2,
                placeholder: "Оберіть категорію, якщо потрібно...",
                language: {noResults: function(){return "Співпадінь, не знайдено";},
                            inputTooShort: function () { return 'Введіть більше 2-ух символів'; }},
                width: "100%"
            });

        })
    </script>
@stop
