@extends('voyager::master')

<style>

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
                <button id="create_invoice" style="left: 0px;;" class="btn btn-success">
                    <i class="voyager-plus"></i> Cтворити накладну
                </button>
            @endif
        </h1>

@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-4">
                                <select id="type-select" name="type" required >
                                    <option value="Всі">Всі накладні</option>
                                    <option value="Продаж">На продаж</option>
                                    <option value="Закупівля">На закупівлю</option>
                                    <option value="Списання">На списання</option>
                                    <option value="Реалізація">На реалізацію</option>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <input type="text" id="from" class="form-control date-pck" name="fromdate" form="first-form" required>
                            </div>
                            <div class="col-xs-4">
                                <input type="text" id="to" class="form-control date-pck" name="todate" form="first-form" required>
                            </div>
                        </div>
                        <table id="dataTable" class="table table-hover">
                            <thead>
                            <tr>
                                <th style="width: 120px;">Дата</th>
                                <th style="width: 100px;">Тип</th>
                                <th style="width: 50px;">Номер</th>
                                <th>Опис</th>
                                <th>Клієнт</th>
                                <th>Сумма</th>
                                <th>Статус</th>
                                <th class="actions"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dataTypeContent as $data)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d.m.Y | h:i') }}</td>
                                    <td> {{ $data->getType($data->type) }}</td>
                                    <td>{{$data->id}}</td>
                                    <td>{{$data->getDescription()}}</td>
                                    <td>{{$data->client->name}}</td>
                                    <td>{{number_format($data->total_account, 2)}}</td>
                                    <td>@if($data->status == 'confirmed')
                                        <p style="color: blue;">
                                            @elseif($data->status == 'unconfirmed')
                                                <p style="color: orange;">
                                                    @elseif($data->status == 'failed')
                                                        <p style="color: red;">
                                                            @else
                                                                <p style="color: forestgreen;">
                                    @endif
                                            {{$data->getStatus($data->status)}}</p>
                                    </td>
                                    <td class="no-sort no-click">
                                        @if (Voyager::can('delete_'.$dataType->name))
                                            <div class="btn-sm btn-danger pull-right delete" data-id="{{ $data->id }}" id="delete-{{ $data->id }}">
                                                <i class="voyager-trash"></i> Delete
                                            </div>
                                        @endif
                                        @if (Voyager::can('edit_'.$dataType->name))
                                            <a href="{{ route('voyager.'.$dataType->slug.'.edit', $data->id) }}" class="btn-sm btn-primary pull-right edit">
                                                <i class="voyager-edit"></i> Edit
                                            </a>
                                        @endif
                                        @if (Voyager::can('read_'.$dataType->name))
                                            <a href="{{ route('voyager.'.$dataType->slug.'.show', $data->id) }}" class="btn-sm btn-warning pull-right">
                                                <i class="voyager-eye"></i> View
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

    <div id="myModal" class="modal">
        <!-- The Close Button -->
        <span class="close voyager-close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
        <!-- Modal Content (The Image) -->
        <div class="modal-content" style="width: 500px; padding: 10px;">
            <form method="get" action="{{ route('voyager.'.$dataType->slug.'.create') }}">
            <select id="type-select-create" name="type" required >
                <option value="sales">На продаж</option>
                <option value="purchase">На закупівлю</option>
                <option value="writeOf">На списання</option>
                <option value="realisation">На реалізацію</option>
            </select>

            @if (Voyager::can('add_'.$dataType->name))
                <button type="submit" id="create_invoice" style="margin-left: 5px;" class="btn btn-success">
                    <i class="voyager-plus"></i> Cтворити накладну
                </button>
            @endif
                <select id="manufacture" name="manufacture">
                    <option></option>
                    @foreach($manufactures as $manufacture)
                        <option value="{{$manufacture->id}}">{{$manufacture->title}}</option>
                    @endforeach
                </select>
            </form>
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
    <!-- DataTables -->
    <script src="/js/datepickerUA.js"></script>
    <script>

        //MyModal
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        $('#create_invoice').click(function(){
            checkInvoiceType();
            modal.style.display = "block";
        });

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        $("#type-select-create").change(function () {
            checkInvoiceType();
        });

        function checkInvoiceType() {
            if ($("#type-select-create").val() == "purchase" || $("#type-select-create").val() == "realisation"){
                $("#manufacture").next().css("display", "block");
                $("#manufacture").prop('required', true);
                $("#manufacture").prop('disabled', false);
            } else {
                $("#manufacture").next().css("display", "none");
                $("#manufacture").prop('required', false);
                $("#manufacture").prop('disabled', true);
            }
        }

        $(function() {
            $("#type-select-create").select2({
                dropdownParent: $('#myModal'),
                language: {
                    noResults: function () {
                        return "Співпадінь, не знайдено";
                    },
                },
                width: "60%"

            });
        });

        $(function() {
            $("#manufacture").select2({
                dropdownParent: $('#myModal'),
                placeholder: "Оберіть постачальника",
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
                    var checkType = $('#type-select').val();
                    var myType = data[1]; // use data for the age column
                    var dateTo = new Date($.datepicker.parseDate("dd.mm.yy",$('#to').val()));
                    var dateFrom = new Date($.datepicker.parseDate("dd.mm.yy",$('#from').val()));
                    var myDate = new Date($.datepicker.parseDate("dd.mm.yy", data[0]));
                    //var dateTime = getDateFromFormat(data[0], "dd.MM.yyyy");
                    //myDate = date_parse_from_format("F.j.Y", data[0]);
//                    console.log(dateTo.valueOf());
//                    console.log(dateFrom.valueOf());
//                    console.log(myDate.valueOf());
                    if (myDate.valueOf() > dateTo.valueOf() || myDate.valueOf() < dateFrom.valueOf()) return false;
                    if (checkType == myType)
                    {
                        return true;
                    }
                    if (checkType == "Всі") return true;

                    return false;
                }
        );

//        $.ajaxSetup({
//            headers: {
//                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//            }
//        });
//
//        $("#type-select").change(function () {
//            $.ajax({
//                type: "POST",
//                url:'/admin/getinvoice',
//                data: {"val": $('#type-select').val()},
//                success: function (data) {
//                    console.log(data);
//
//                }
//            });
//        });

//        $("#from").change(function () {
//            console.log(2);
//        });
//        $("#to").change(function () {
//            console.log(3);
//        });


        $(function() {
            $("#type-select").select2({
                language: {
                    noResults: function () {
                        return "Співпадінь, не знайдено";
                    },
                },
                width: "100%"

            });
        });

        @if (!$dataType->server_side)
            $(document).ready(function () {
            var table = $('#dataTable').DataTable({ "order": [] });

            $("#type-select").change(function () {
                table.draw();
            });

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

        function parseActionUrl(action, id) {
            return action.match(/\/[0-9]+$/)
                    ? action.replace(/([0-9]+$)/, id)
                    : action + '/' + id;
        }
    </script>
@stop
