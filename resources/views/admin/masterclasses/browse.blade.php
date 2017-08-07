@extends('voyager::master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ voyager_asset('css/nestable.css') }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i>Постачальники
        @if (Voyager::can('add_'.$dataType->name))
            <a href="{{ route('voyager.'.$dataType->slug.'.create') }}" class="btn btn-success">
                <i class="voyager-plus"></i> Створити Майстер Класс
            </a>
        @endif    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                            <tr>
                                <th style="text-align: center;">Номер</th>
                                <th style="text-align: center;">Назва</th>
                                <th style="text-align: center;">Майстер</th>
                                <th style="text-align: center;">Ціна</th>
                                <th style="text-align: center;">Заповненість</th>
                                <th style="text-align: center;">Дата проведення:</th>
                                <th style="text-align: center;">Статус</th>
                                <th style="text-align: center;" class="actions"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dataTypeContent as $data)
                                <tr>
                                    <td style="text-align: center;">{{$data->id}}</td>
                                    <td style="text-align: center;">{{ucwords($data->title)}}</td>
                                    <td style="text-align: center;">{{$data->master}}</td>
                                    <td style="text-align: center;">{{ number_format($data->price, 2) }} грн.</td>
                                    <td style="text-align: center;">({{ $data->paidUser() }} / {{$data->max_seats}})</td>
                                    <td style="text-align: center;">{{ \Carbon\Carbon::parse($data->date_time)->format('d.m.Y | H:i')}}</td>
                                    <td style="text-align: center;">@if ($data->status == 'active') <p style="color:green; margin: 0px;">ТРИВАЄ НАБІР</p> @elseif ($data->status == 'full') <p style="color:blue; margin: 0px;">ГРУПА СФОРМОВАНА</p> @else <p style="color:red; margin: 0px;">ЗАКРИТИЙ</p> @endif</td>
                                    <td class="no-sort no-click" style="text-align: center;">
                                        @if (Voyager::can('delete_'.$dataType->name))
                                            <div class="btn-sm btn-danger pull-right delete" data-id="{{ $data->id }}" id="delete-{{ $data->id }}" title="Видалити">
                                                <i class="voyager-trash"></i>
                                            </div>
                                        @endif
                                        @if (Voyager::can('edit_'.$dataType->name))
                                            <a href="{{ route('voyager.'.$dataType->slug.'.edit', $data->id) }}" class="btn-sm btn-primary pull-right edit" title="Редагувати">
                                                <i class="voyager-edit"></i>
                                            </a>
                                        @endif
                                        @if (Voyager::can('read_'.$dataType->name))
                                            <a href="{{ route('voyager.'.$dataType->slug.'.show', $data->id) }}" class="btn-sm btn-success pull-right" title="Переглянути хто записався">
                                                <i class="voyager-eye"></i> @if($data->newUser() != 0)({{$data->newUser()}}) @endif
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if (isset($dataType->server_side) && $dataType->server_side)
                            <div class="pull-left">
                                <div role="status" class="show-res" aria-live="polite">Showing {{ $dataTypeContent->firstItem() }} to {{ $dataTypeContent->lastItem() }} of {{ $dataTypeContent->total() }} entries</div>
                            </div>
                            <div class="pull-right">
                                {{ $dataTypeContent->links() }}
                            </div>
                        @endif



                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> Are you sure you want to delete
                        this {{ $dataType->display_name_singular }}?</h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('voyager.'.$dataType->slug.'.index') }}" id="delete_form" method="POST">
                        {{ method_field("DELETE") }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="Yes, Delete This {{ $dataType->display_name_singular }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@stop

@section('javascript')
    @include('admin.cash_widget')

    <script>
        @if (!$dataType->server_side)
            $(document).ready(function () {
            $('#dataTable').DataTable({ "order": [] });
        });
        @endif

        $('.delete').on('click', function (e) {
            id = $(this).attr('data-id');
            $('#delete_form')[0].action += '/' + id;
            $('#delete_modal').modal('show');
        });
    </script>
@stop
