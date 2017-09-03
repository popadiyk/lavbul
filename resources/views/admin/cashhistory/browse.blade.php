@extends('voyager::master')

<style>

    .actions{
        width: 150px !important;
    }
    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
    }

    /* Modal Content (Image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }


    /* Add Animation - Zoom in the Modal */
    .modal-content, #caption {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {-webkit-transform:scale(0)}
        to {-webkit-transform:scale(1)}
    }

    @keyframes zoom {
        from {transform:scale(0)}
        to {transform:scale(1)}
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1 !important;
        font-size: 40px !important;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
        .modal-content {
            width: 100%;
        }
    }
</style>

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> {{ $dataType->display_name_plural }}
        @if (Voyager::can('add_'.$dataType->name))
            <span id="create_plus" style="margin: 10px;" class="btn btn-success">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </span>
            <span id="create_minus" style="margin: 9px 10px 10px 10px" class="btn btn-danger">
                <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
            </span>
        @endif
    </h1>

@stop

@section('content')
    @include('voyager::alerts')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <input type="text" id="from" class="form-control date-pck" name="fromdate" form="first-form" required>
                            </div>
                            <div class="col-xs-6">
                                <input type="text" id="to" class="form-control date-pck" name="todate" form="first-form" required>
                            </div>
                        </div>
                        <table id="dataTable" class="table table-hover">
                            <thead>
                            <tr>
                                <th style="text-align: center;">Дата</th>
                                <th style="text-align: center;">Тип</th>
                                <th style="text-align: center; width: 50px;">Причина</th>
                                <th style="text-align: center;">Номер</th>
                                <th style="text-align: center;">Сума</th>
                                <th style="text-align: center;">Баланс каси</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dataTypeContent as $data)
                                <tr @if(preg_match( '/\+/', $data->reason)) style="background: palegreen" @else style="background: #FFC7C7;" @endif>
                                    <td style="border-right: #eaeaea solid 1px; border-left: #eaeaea solid 1px; width: 150px; text-align: center; vertical-align: middle;">{{ \Carbon\Carbon::parse($data->created_at)->format('d.m.Y | H:i') }}</td>
                                    <td style="border-right: #eaeaea solid 1px; width: 70px; text-align: center; vertical-align: middle;">
                                        @if ($data->cash_type  == 'card')
                                            Картка
                                        @else
                                            Готівка
                                        @endif
                                    </td>
                                    <td style="border-right: #eaeaea solid 1px; text-align: center; vertical-align: middle;">{{$data->reason}}</td>
                                    <td style="border-right: #eaeaea solid 1px; text-align: center; vertical-align: middle;">{{$data->invoice_id}}</td>
                                    <td style="border-right: #eaeaea solid 1px; text-align: center; vertical-align: middle;">{{number_format($data->sum, 2)}}</td>
                                    <td style="border-right: #eaeaea solid 1px; text-align: center; vertical-align: middle;">{{number_format($data->cash_balance, 2)}}</td>
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

    <div id="myModal" class="modal">
        <!-- The Close Button -->
        <span class="close voyager-close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
        <!-- Modal Content (The Image) -->
        <div class="modal-content" style="width: 500px; padding: 10px;">
            <form method="get" action="{{ route('voyager.'.$dataType->slug.'.create') }}" style="margin-bottom: 0px;">
                <p class="modal-title"></p>
                <p id="p_cash_type" class="label label-info" style="border-radius: 0px 5px;">Причина:</p>
                <br>
                <input id ="pm" type="hidden" class="form-control" name="pm">
                <input type="text" class="form-control" name="reason" required>
                <p id="p_cash_type" class="label label-info" style="border-radius: 0px 5px;">Сума:</p>
                <br>
                <input type="nubmer" class="form-control" name="sum" required>
                <p id="p_cash_type" class="label label-info" style="border-radius: 0px 5px;">Спосіб оплати:</p>
                <br>
                <select id="cash_type" name="cash_type">
                    <option value="cash">ГОТІВКА</option>
                    <option value="card">НА КАРТКУ</option>
                </select>

                @if (Voyager::can('add_'.$dataType->name))
                    <button type="submit" id="create_invoice" style="margin-left: 5px;" class="btn btn-success">
                        <i class="voyager-plus"></i> Cтворити операцію
                    </button>
                @endif

            </form>
        </div>
    </div>

@stop

@section('javascript')
    @include('admin.cash_widget')

    <!-- DataTables -->
    <script src="/js/datepickerUA.js"></script>
    <script>

        //MyModal
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        };

        $('#create_plus').on("click", function(){
            modal.style.display = "block";
            $('.modal-content').css('background', 'palegreen');
            $('.modal-title').html('<center><strong>Прихід</strong></center>');
            $('#pm').val('+');
        });

        $('#create_minus').on("click", function(){
            modal.style.display = "block";
            $('.modal-content').css('background', '#FFC7C7');
            $('.modal-title').html('<center><strong>Витрата</strong></center>');
            $('#pm').val('-');
        });


        $(function() {
            $("#cash_type").select2({
                dropdownParent: $('#myModal'),
                language: {
                    noResults: function () {
                        return "Співпадінь, не знайдено";
                    },
                },
                width: "60%"

            });
        });

        //DATAPICKER
        //        $("#from").datepicker().;
        $( function() {
            var dateFormat = "dd.mm.yy",
                    from = $( "#from" )
                            .datepicker({
                                defaultDate: 0,
                                changeMonth: true,
                                numberOfMonths: 1,
                                maxDate: 0
                            })
                            .datepicker("setDate", new Date())
                            .on( "change", function() {
                                to.datepicker( "option", "minDate", getDate( this ) );
                            }),
                    to = $( "#to" )
                            .datepicker({
                                defaultDate: 0,
                                changeMonth: true,
                                numberOfMonths: 1,
                                maxDate: 0
                            })
                            .datepicker("setDate", new Date())
                            .on( "change", function() {
                                from.datepicker( "option", "maxDate", getDate( this ) );
                            });

            function getDate( element ) {
                var date;
                try {
                    date = $.datepicker.parseDate( dateFormat, element.value );
                } catch( error ) {
                    date = null;
                }
                return date;
            }
        } );

        $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                    var dateTo = new Date($.datepicker.parseDate("dd.mm.yy",$('#to').val()));
                    var dateFrom = new Date($.datepicker.parseDate("dd.mm.yy",$('#from').val()));
                    var myDate = new Date($.datepicker.parseDate("dd.mm.yy", data[0]));
                    if (myDate.valueOf() > dateTo.valueOf() || myDate.valueOf() < dateFrom.valueOf()) return false;
                    return true;
                }
        );


        @if (!$dataType->server_side)
        $(document).ready(function () {
            var table = $('#dataTable').DataTable({ "order": [] });

            $("#from").change(function () {
                table.draw();
            });

            $("#to").change(function () {
                table.draw();
            });
        });


        @endif



        $('td').on('click', '.delete', function (e) {
            var form = $('#delete_form')[0];

            form.action = parseActionUrl(form.action, $(this).data('id'));

            $('#delete_modal').modal('show');
        });
    </script>
@stop
