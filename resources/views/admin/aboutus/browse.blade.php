@extends('voyager::master')

@section('page_title','All '.$dataType->display_name_plural)

@section('page_header')
    <h1 class="page-title" xmlns="http://www.w3.org/1999/html">
        <i class="voyager-news"></i> {{ $dataType->display_name_plural }}
        @if (Voyager::can('edit_'.$dataType->name))
            <a href="{{ route('voyager.'.$dataType->slug.'.edit', 1) }}" class="btn btn-warning">
                <i class="voyager-edit"></i> Редагувати данні
            </a>
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
                        <div class="form-group">
                            <label for="name">Назва магазину:</label>
                            <input type="text" class="form-control" value="{{ $aboutus[0]['name'] }}" id="name" disabled>
                        </div>

                        <div class="row">
                            <div class="form-group col-xs-12 col-md-6" style="text-align: center;">
                                <label for="max_logo">Велике лого (400 на 400 пікселів):</label>
                                {{--<img src = "/img/logo.png">--}}
                                <div class="panel-body" style="background: #eee; border-radius: 10px;">
                                    <img src = "{{$aboutus[0]['max_log']}}">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 col-md-6" style="text-align: center;">
                                <label for="full_description">Маленьке лого (200 на 200 пікселів):</label>
                                <div class="panel-body" style="background: #eee; border-radius: 10px;">
                                    <img src = "{{$aboutus[0]['min_logo']}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Короткий опис:</label>
                            <textarea class="form-control" rows="3" id="description" disabled style="resize: none;">{{ $aboutus[0]['description'] }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="full_description">Про нас:</label>
                            <textarea class="form-control" rows="5" id="full_description" disabled style="resize: none;">{{ $aboutus[0]['full_description'] }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop

@section('javascript')
    {{-- DataTables --}}
    <script>
        $(document).ready(function () {
            @if (!$dataType->server_side)
                $('#dataTable').DataTable({ "order": [] });
            @endif
            @if ($isModelTranslatable)
                $('.side-body').multilingual();
            @endif
        });

        $('td').on('click', '.delete', function(e) {
            $('#delete_form')[0].action = $('#delete_form')[0].action.replace('__id', $(e.target).data('id'));
            $('#delete_modal').modal('show');
        });
    </script>
    @if($isModelTranslatable)
        <script src="{{ voyager_asset('js/multilingual.js') }}"></script>
    @endif
@stop