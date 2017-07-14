@extends('voyager::master')

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

@section('page_header')
    <h1 class="page-title" style="margin: 0px;">
        <i class="{{ $dataType->icon }}"></i> {{ $dataType->display_name_plural }}
        @if (Voyager::can('add_'.$dataType->name))
            <a href="{{ route('voyager.'.$dataType->slug.'.create') }}" class="btn btn-success">
                <i class="voyager-plus"></i> Додати товар
            </a>
        @endif
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="col-xs-12" style="padding: 0px; margin: 0px; padding-left: 20px;">
                    <form method="get" name="search" action="javascript:void(0)">
                        <input id ="input-search" type="text" class="form-control" style="margin: 5px 0px; width: 73%; display: inline-block;">
                        <button id="search" type="submit" class="btn btn-info" style="width:25%;">
                            <i class="voyager-search"></i> Знайти
                        </button>
                    </form>
                </div>
                <div id="products-table" class="col-xs-12" style="height: 460px; overflow-y: scroll;">
                        @include('admin.products.data-edit-add');
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

    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- The Close Button -->
        <span class="close voyager-close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>

        <!-- Modal Content (The Image) -->
        <img class="modal-content" id="img01" style="width: 500px">

        <!-- Modal Caption (Image Text) -->
        <div id="caption"></div>
    </div>

    <div id="voyager-loader" style="display: none;">
        <?php $admin_loader_img = Voyager::setting('admin_loader', ''); ?>
        @if($admin_loader_img == '')
            <img src="{{ voyager_asset('images/logo-icon.png') }}" alt="Voyager Loader">
        @else
            <img src="{{ Voyager::image($admin_loader_img) }}" alt="Voyager Loader">
        @endif
    </div>
@stop

@section('javascript')
    <!-- DataTables -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        function gotomain (element) {
            $('#voyager-loader').css("display","block");
            $.ajax({
                url: 'gotomain',
                type: "post",
                data: {id : $(element).attr('dataid'),
                        act : $(element).attr('act')}
            }).done(function (data) {
                if (!data){
                    $('#voyager-loader').css("display","none");
                    alert("Додавати на головну можна тільки 8 товарів, потрібно щось забрати з головної!");
                } else {
                    var curPage = window.location.href;
                    var page = curPage.split('#')[1];
                    if (page == undefined){
                        page = 1;
                    }
                        getData(page);
                }
            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                alert("No response from server");
            });

        }

        {{--@if (!$dataType->server_side)--}}
            {{--$(document).ready(function () {--}}
            {{--$('#dataTable').DataTable({ "order": [] });--}}
        {{--});--}}
        {{--@endif--}}

        $('td').on('click', '.delete', function (e) {
            var form = $('#delete_form')[0];

            form.action = parseActionUrl(form.action, $(this).data('id'));

            $('#delete_modal').modal('show');
        });


//        function parseActionUrl(action, id) {
//            return action.match(/\/[0-9]+$/)
//                    ? action.replace(/([0-9]+$)/, id)
//                    : action + '/' + id;
//        }

        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the image and insert it inside the modal - use its "alt" text as a caption



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
        }

        // Робота пошуку (івенти)
        var myurl;
        var starturl = window.location.href;
        $(document).ready(function () {
            $(document).on('click', '#search', function (event) {
                console.log(1);
                $(document).off('click', '.pagination li a');
                if ($("#input-search").val() == "") {
                    getData(1);
                    $(document).on('click', '.pagination li a', function (event) {
                        console.log(11111111);

                        $('li').removeClass('active');
                        $(this).parent('li').addClass('active');
                        event.preventDefault();
                        var page = $(this).attr('href').split('page=')[1];
                        var url = $(this).attr('href');
                        getData(page);
                        var body = $('#products-table');
                        var top = body.scrollTop();

                        if (top != 0) {
                            body.animate({scrollTop: 0}, '2000');
                        }
                    });
                    return false;
                }
                myurl = starturl + '?search=' + $("#input-search").val();
                getDataSearch(myurl, 1);
                $(document).on('click', '.pagination li a', function (event) {
                    console.log(22222222222);
                    $(this).unbind('click');
                    $('li').removeClass('active');
                    $(this).parent('li').addClass('active');
                    event.preventDefault();
                    var page = $(this).attr('href').split('page=')[1];
                    getDataSearch(myurl, page);
                    var body = $('#products-table');
                    var top = body.scrollTop();

                    if (top != 0){
                        body.animate({scrollTop:0}, '2000');
                    }

                });

            });
        });

        // івенти на паганацію сторінок для АДЖАКСА

        $(document).ready(function () {
            $(document).on('click', '.pagination li a', function (event) {
                if ($("#input-search").val() == ""){
                    $('li').removeClass('active');
                    $(this).parent('li').addClass('active');
                    event.preventDefault();
                    var page = $(this).attr('href').split('page=')[1];
                    getData(page);
                    var body = $('#products-table');
                    var top = body.scrollTop();

                    if (top != 0) {
                        body.animate({scrollTop: 0}, '2000');
                    }
                }
            });
        });

        // Функції АДЖАКСА (на пошук, з постачальником, без постачальника)

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function getDataSearch(url, page) {
            console.log("getDataSearch");
            $.ajax({
                url: url + '&page=' + page,
                type: "get"
            }).done(function (data) {
                $("#products-table").empty().html(data);
                location.hash = page;
            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                alert("No response from server");
            });
        }

        function getData(page) {
            console.log("getData");
            $.ajax({
                url: '/admin/products?page=' + page,
                type: "get"
            }).done(function (data) {
                $("#products-table").empty().html(data);
                location.hash = page;
                $('#voyager-loader').css("display","none");
            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                alert("No response from server");
            });
        }

        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();
        });

    </script>
@stop
