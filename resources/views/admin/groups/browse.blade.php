@extends('voyager::master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ voyager_asset('css/nestable.css') }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i>Дерево груп
        @if (Voyager::can('add_'.$dataType->name))
            <a href="{{ route('voyager.'.$dataType->slug.'.create') }}" class="btn btn-success">
                <i class="voyager-plus"></i> Створити категорію товарів
            </a>
        @endif    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="container-fluid">
        <div class="alert alert-info">
            <strong>Що це?</strong>
            <p> Тут можна переглянути як будується дерево груп нашого магазину. А також змінювати його, якщо у вас є відповідний рівень доступу.</p>
        </div>
    </div>
    <div class="page-content container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">

                            @foreach($rootCategories as $rootCategory)
                                <li style="list-style-type: none;" class="dd-handle">{{ $rootCategory->title }}

                                    <td class="no-sort no-click">
                                        @if (Voyager::can('delete_'.$dataType->name))
                                            <div style="margin-top: -5px;" class="btn-sm btn-danger pull-right delete" data-id="{{ $rootCategory->id }}" id="delete-{{ $rootCategory->id }}">
                                                <i class="voyager-trash"></i> Delete
                                            </div>
                                        @endif
                                        @if (Voyager::can('edit_'.$dataType->name))
                                            <a href="{{ route('voyager.'.$dataType->slug.'.edit', $rootCategory->id) }}" style="margin-top: -5px;" class="btn-sm btn-primary pull-right edit">
                                                <i class="voyager-edit"></i> Edit
                                            </a>
                                        @endif
                                    </td>

                                </li>
                                @if($rootCategory->ProductCategory->count() > 0)
                                    @include('admin.groups.partials.treeChildMenu', ['categories' => $rootCategory->ProductCategory])
                                @endif
                            @endforeach
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
            id = $(e.target).data('id');
            console.log(1);
            $('#delete_form')[0].action += '/' + id;

            $('#delete_modal').modal('show');
        });
    </script>
@stop
