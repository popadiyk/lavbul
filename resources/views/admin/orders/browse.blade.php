@extends('voyager::master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ voyager_asset('css/nestable.css') }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i>Новини
        @if (Voyager::can('add_'.$dataType->name))
            <a href="{{ route('voyager.'.$dataType->slug.'.create') }}" class="btn btn-success">
                <i class="voyager-plus"></i> Створити Новину
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
                        <table id="dataTable" class="table table-hover" style="font-size: 12px;">
                            <thead>
                            <tr>
                                <th style="text-align: center;">Номер</th>
                                <th style="text-align: center;">Накладна</th>
                                <th style="text-align: center;">ФІО</th>
                                <th style="text-align: center;">Телефон</th>
                                <th style="text-align: center;">e-mail</th>
                                <th style="text-align: center;">Тип доставки:</th>
                                <th style="text-align: center;">Адреса:</th>
                                <th style="text-align: center;">Тип оплати:</th>
                                <th style="text-align: center;">Дата:</th>
                                <th style="text-align: center;" class="actions"></th>
                                <th style="text-align: center;">Статус</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dataTypeContent as $data)
                                <tr>
                                    <td style="text-align: center; vertical-align: middle;">{{$data->id}}</td>
                                    <td style="text-align: center; vertical-align: middle;"><a href="{{ route('voyager.invoices.show', $data->invoice_id) }}">№{{$data->invoice_id}}</a></td>
                                    <td style="text-align: center; vertical-align: middle;">{{$data->name}}</td>
                                    <td style="text-align: center; vertical-align: middle;">{{$data->phone}}</td>
                                    <td style="text-align: center; vertical-align: middle;">{{$data->email}}</td>
                                    <td style="text-align: center; vertical-align: middle;">@if($data->delivery_id == 1) З магазину @elseif($data->delivery_id == 2) Нова Почта @elseif($data->delivery_id == 3) УкрПочта @endif</td>
                                    <td style="text-align: center; vertical-align: middle;">{{$data->address}}</td>
                                    <td style="text-align: center; vertical-align: middle;">@if($data->payment_id == 1) На карту @else В магазині @endif</td>
                                    <td style="text-align: center; vertical-align: middle;">{{ \Carbon\Carbon::parse($data->created_at)->format('d.m.Y | H:i')}} </td>
                                    <td class="no-sort no-click" style="text-align: center;">
                                        @if (Voyager::can('edit_'.$dataType->name))
                                            <a href="{{ route('voyager.'.$dataType->slug.'.edit', $data->id) }}" class="btn-sm btn-primary pull-right edit" title="Редагувати">
                                                <i class="voyager-edit"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td style="text-align: center; padding: 8px; @if ($data->status == 'new')background: greenyellow; @elseif($data->status == 'want_to_pay' || $data->status == 'paid') background: deepskyblue; @else background: coral; @endif" >
                                        <select size="4" class="status-select" name="status" data-id = "{{$data->id}}" required >
                                            <option value="new" @if ($data->status == 'new') selected @endif>Новий</option>
                                            <option value="want_to_pay" @if ($data->status == 'want_to_pay') selected @endif>Чекаємо оплату</option>
                                            <option value="paid" @if ($data->status == 'paid') selected @endif>Записаний</option>
                                            <option value="failed" @if ($data->status == 'failed') selected @endif>Відмінений</option>
                                        </select>
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
            id = $(e.target).data('id');
            console.log(1);
            $('#delete_form')[0].action += '/' + id;

            $('#delete_modal').modal('show');
        });
        // Get the modal
        var modal = document.getElementById('myModal');

        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        $('td img').click(function(){
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        });

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        };

        $('.status-select').change(function () {
            console.log($(this).val());
            console.log($(this).attr('data-id'));
            if ($(this).val() == "new"){
                $(this).parent().css('background', 'greenyellow');
            } else if (($(this).val() == "want_to_pay") || ($(this).val() == "paid")) {
                $(this).parent().css('background', 'deepskyblue');
            } else {
                $(this).parent().css('background', 'coral');
            }

            $('#voyager-loader').css("display","block");

            $.ajax({
                url: 'change_mc_users_status',
                type: "post",
                data: {status : $(this).val(),
                    id: $(this).attr('data-id')}
            }).done(function (data) {
                $('#voyager-loader').css("display","none");
            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                alert("No response from server");
            });

        });

        $(function() {
            $(".status-select").select2({
                placeholder: "",
                language: {
                    noResults: function () {
                        return "Співпадінь, не знайдено";
                    }
                },
                width: "100%"
            });
        });
    </script>
@stop
