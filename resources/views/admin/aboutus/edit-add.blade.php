@extends('voyager::master')

@section('page_title','All '.$dataType->display_name_plural)

@section('page_header')
    <h1 class="page-title" xmlns="http://www.w3.org/1999/html">
        <i class="voyager-news"></i> {{ $dataType->display_name_plural }}
        @if (Voyager::can('edit_'.$dataType->name))
            <button type="submit" form="about-us-form" class="btn btn-success">
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
                    <form action="{{ route('voyager.'.$dataType->slug.'.store') }}" name="aboutusform" id="about-us-form" method="POST" enctype="multipart/form-data" class="panel-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="name">Назва магазину:</label>
                            <input type="text" name="name" class="form-control" value="{{ $aboutus[0]['name'] }}" id="name">
                        </div>
                            <div class="form-group">
                                <label for="max_logo">Велике лого (400 на 400 пікселів):</label>
                                <input type="file" name="max_logo">
                            </div>
                            <div class="form-group">
                                <label for="min-logo">Маленьке лого (200 на 200 пікселів):</label>
                                <input type="file" name="min_logo">
                            </div>
                        <div class="form-group">
                            <label for="description">Короткий опис:</label>
                            <textarea name="description" class="form-control" rows="3" id="description" style="resize: none;">{{ $aboutus[0]['description'] }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="full_description">Про нас:</label>
                            <textarea name="full_description" class="form-control" rows="5" id="full_description" style="resize: none;">{{ $aboutus[0]['full_description'] }}</textarea>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop

@section('javascript')
    {{-- DataTables --}}
    @include('admin.cash_widget')

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