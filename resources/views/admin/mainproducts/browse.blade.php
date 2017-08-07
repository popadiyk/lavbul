@extends('voyager::master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ voyager_asset('css/nestable.css') }}">
    <style>
        /* Style the Image Used to Trigger the Modal */
        td img {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        td img:hover {opacity: 0.7;}

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1000000; /* Sit on top */
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

        /* Caption of Modal Image (Image Text) - Same Width as the Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
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
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i>Продукти на головній
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
                        <table id="dataTable" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Код</th>
                                <th>Назва</th>
                                <th>Група</th>
                                <th>Постачальник</th>
                                <th>Ціна</th>
                                <th>Фото</th>
                                <th class="actions"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dataTypeContent as $data)
                                <tr>
                                    <td>{{$data->product->marking}}</td>
                                    <td style="text-align: left; width: 300px;">{{$data->product->title}}</td>
                                    <td>{{$data->product->group->title}}</td>
                                    <td>{{$data->product->manufacture->title}}</td>
                                    <td>{{$data->product->price}}</td>
                                    <td>
                                        <img src="{{$data->product->main_photo}}" alt="{{$data->product->title}}" style="width:100px">
                                    </td>
                                    <td class="no-sort no-click">
                                        @if (Voyager::can('delete_'.$dataType->name))
                                            <div class="btn-sm btn-danger pull-right delete" data-id="{{ $data->id }}" id="delete-{{ $data->id }}">
                                                <i class="voyager-trash"></i> Delete
                                            </div>
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
                    <h4 class="modal-title"><i class="voyager-trash"></i> Ви впевнені, що бажаєте забрати цей продукт з головної?</h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('voyager.'.$dataType->slug.'.index') }}" id="delete_form" method="POST">
                        {{ method_field("DELETE") }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="Так, видалити цього {{ $dataType->display_name_singular }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Ні</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- The Close Button -->
        <span class="close voyager-close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>

        <!-- Modal Content (The Image) -->
        <img class="modal-content" id="img01" style="width: 500px">

        <!-- Modal Caption (Image Text) -->
        <div id="caption"></div>
    </div>

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
    </script>
@stop
