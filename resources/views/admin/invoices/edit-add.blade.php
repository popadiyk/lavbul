@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 9999; /* Sit on top */
            padding-top: 200px; /* Location of the box */
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
@stop

@section('page_header')
    <div class="col-xs-9">
        <h1 class="page-title">
            <i class="{{ $dataType->icon }}"></i> @if(isset($dataTypeContent->id)){{ 'Змінюємо' }}@else{{ 'Створюємо' }}@endif {{ $dataType->display_name_singular }} на {{$newInvoice->type}}
            @if (Voyager::can('add_'.$dataType->name))
                <button id="create_invoice" style="left: 0px;;" class="btn btn-success">
                    <i class="voyager-plus"></i> Cтворити накладну
                </button>
            @endif
        </h1>
    </div>
    @if ($newInvoice->type == "sales")
        <div class="col-xs-3" style="padding-top: 18px;">
            <label style="font-size: 12px; font-weight: bold;">Клієнт:</label>
            <select id="clients" name="clients" >
                <option></option>
                @foreach($clients as $client)
                    @if ($client->id == 1)
                        <option value="{{$client->id}}&{{$client->discount}}" selected="selected">{{$client->card}} - {{$client->name}} - {{$client->discount}}%</option>
                    @else
                        <option value="{{$client->id}}&{{$client->discount}}">{{$client->card}} - {{$client->name}} - {{$client->discount}}%</option>
                    @endif
                @endforeach
            </select>
        </div>
    @endif
@stop

@section('content')
    <div class="page-content container-fluid" type = "{{$newInvoice->type}}" manufacture = "{{$manufacture}}">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <div class="row">
                        <div class="col-xs-6" >
                            <div class="row" style="height: 400px; overflow-y: scroll; margin: 0px;">
                                <table id="invoiceTable" class="table table-hover" style="font-size: 11px; border: #EAEAEA solid 1px;">
                                    <thead>
                                    <tr>
                                        <th>Код</th>
                                        <th style="width: 250px;">Назва</th>
                                        <th style="text-align: center;">Кількість</th>
                                        <th style="text-align: center;">Ціна</th>
                                        <th style="text-align: center;">Сумма</th>
                                        <th style="text-align: center;">Дія</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if ($newInvoice->type == 'realisation')
                                            @foreach($productRealizations as $productRealization)
                                                <tr marking ="{{$productRealization[0]}}" title = "{{$productRealization[1]}}">
                                                    <td>{{$productRealization[0]}}</td>
                                                    <td>{{$productRealization[1]}}</td>
                                                    <td style="text-align: center;" class = "wanted-qty">{{$productRealization[2]}}</td>
                                                    <td style="text-align: center;">{{$productRealization[3]}}</td>
                                                    <td class="summ" style="text-align: center;">{{$productRealization[4]}}</td>
                                                    <td style="text-align: center;"> <i class="voyager-wallet" style="color:green; cursor: pointer;"></i></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="row" style="padding: 8px; padding-right: 20px; text-align: right; background: #EAEAEA; height: 100px; width: 100%; margin: 0px;">
                                    <div class="row" style="margin: 0px;">
                                        <label>Сумма:</label>
                                        <input type="text" name="total-sum" id="total-sum" style="width: 20%;  text-align: center; border:none; border:solid 1px #ccc; border-radius: 5px;" disabled>
                                    </div>
                                    <div class="row" style="margin: 0px;">
                                        <label>Знижка:</label>
                                        <input type="text" name="discount" id="discount" style="width: 20%; text-align: center; border:none; border:solid 1px #ccc; border-radius: 5px;" disabled>
                                    </div>
                                    <div class="row" style="margin: 0px;">
                                        <label>Сумма зі знижкою:</label>
                                        <input type="text" name="total-sum-discount" id="total-sum-discount" style="color:orangered; font-weight: bold; width: 20%;  text-align: center; border:none; border:solid 1px #ccc; border-radius: 5px;" disabled>
                                    </div>
                            </div>
                        </div>
                        <div class="col-xs-6" style="padding: 0px; margin: 0px; padding-right: 20px;">
                            <form method="get" name="search" action="javascript:void(0)">
                                <input id ="input-search" type="text" class="form-control" style="margin: 5px 0px; width: 73%; display: inline-block;">
                                <button id="search" type="submit" class="btn btn-info" style="width:25%;">
                                    <i class="voyager-search"></i> Знайти
                                </button>
                            </form>
                        </div>
                        <div id="products-table" class="col-xs-6" style="width: 48%; padding: 0px; height: 460px; overflow-y: scroll;">
                            @if ($newInvoice->type != 'realisation')
                                @include('admin.invoices.data-edit-add');
                            @else
                                <ul style="padding-top: 20px;">
                                    @foreach($invoceRealizations as $invoceRealization)
                                        <li>{{$invoceRealization}}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal">
        <!-- The Close Button -->
        <span class="close voyager-close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
        <!-- Modal Content-->
        <div class="modal-content" style="width: 300px; padding: 10px;">
            <form action="javascript:void(0)" onsubmit="checkQty()">
                <label for="qty"> Введіть кількість:</label>
                <input type="number" id="qty" class="form-control" min="1">
                <div class="row" style="text-align: center;">
                    <button type="submit" id="add-edit-btn" class="btn btn-success">
                        <i class="voyager-plus"></i> Ок
                    </button>
                    <button type="reset" class="btn btn-warning" onclick="document.getElementById('myModal').style.display='none'">
                        <i class="voyager-plus"></i> Відміна
                    </button>
                </div>
            </form>
        </div>
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
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#create_invoice').click(function () {
            if (type == 'sales'){
                var discount = (100 - $('#clients').val().split('&')[1])/100;
                var client = $('#clients').val().split('&')[0];
            }
            var goods = [];
            //$('#voyager-loader').css("display","block");
            $('#invoiceTable tbody tr').each (function() {
                var myProduct = {
                    marking: $(this).attr('marking'),
                    title: $(this).attr('title'),
                    qty: $(this).find('.wanted-qty').html()
                };
                goods.push(myProduct);
            });

            $.ajax({
                url: '/admin/invoices',
                type: "post",
                data: { type : type ,
                        manufacture : manufacture,
                        client : client,
                        discount : discount,
                        goods : goods,
                        invoiceSumm : $('#total-sum-discount').val()
                    }
            }).done(function (data) {
                //loader.style.left = (sidebar.clientWidth/2)+'px';
//                window.location.href = '/admin/invoices';
                console.log(data);
            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                alert("No response from server");
            });
        });

        $(function() {
            $("#clients").select2({
                placeholder: "Оберіть клієнта",
                language: {
                    noResults: function () {
                        return "Співпадінь, не знайдено";
                    },
                },
                width: "100%"

            });
        });

        calculateSumm();

        $('#clients').change(function () {
            console.log('value:' + $('#clients').val());

            if ($('#clients').val().split('&')[1] == 0){
                $("#discount").val("");
            } else {
                $("#discount").val($('#clients').val().split('&')[1]);
            }
            calculateSumm();
//            if ($("#discousnt").val() == "" || $("#discount").val() == "-"){
//                $("#discount").val("-");
//                $("#total-sum-discount").val(totalSumm.toFixed(2));
//            }
        });

        function checkQty() {
            if (parseInt($('#qty').val()) > parseInt($('#qty').attr('max')) && type != "purchase") return false;

                modal.style.display = "none";
                checkIfExist(Product);

                $('#invoiceTable tbody').append('<tr>');
                var myTr = $('#invoiceTable tbody tr').last();
                myTr.attr('marking', Product.marking);
                myTr.attr('title', Product.title);
                myTr.attr('maxqty', Product.maxqty);
                myTr.attr('price', Product.price);
                myTr.attr('purchase_price', Product.purchase_price);

                if (type != "purchase"){
                    myTr.append('<td>' + Product.marking + '</td>');
                    myTr.append('<td>' + Product.title + '</td>');
                    myTr.append('<td style="text-align: center;" class = "wanted-qty">' + $('#qty').val() + '</td>');
                    myTr.append('<td style="text-align: center;">' + Product.price + '</td>');
                    myTr.append('<td class="summ" style="text-align: center;">' + $('#qty').val() * Product.price + '</td>');
                    myTr.append('<td style="text-align: center;"> <i class="voyager-pen" marking="'+Product.marking+'" style="color:orange; cursor: pointer;"></i> <i class="voyager-trash" marking="'+Product.marking+'" style="color:red; margin-left: 15px; cursor: pointer;"></i> </td>');
                } else {
                    myTr.append('<td>' + Product.marking + '</td>');
                    myTr.append('<td>' + Product.title + '</td>');
                    myTr.append('<td style="text-align: center;" class = "wanted-qty">' + $('#qty').val() + '</td>');
                    myTr.append('<td style="text-align: center;">' + Product.purchase_price + '</td>');
                    myTr.append('<td class="summ" style="text-align: center;">' + $('#qty').val() * Product.purchase_price + '</td>');
                    myTr.append('<td style="text-align: center;"> <i class="voyager-pen" marking="'+Product.marking+'" style="color:orange; cursor: pointer;"></i> <i class="voyager-trash" marking="'+Product.marking+'" style="color:red; margin-left: 15px; cursor: pointer;"></i> </td>');

                }
                console.log(Product);
                calculateSumm();
                removeProductEvent();
                editProductEvent();
            return true;
        }

        // перевірка чи вже є такий продукт в інвойс листі
        function checkIfExist(product) {
            $("#invoiceTable tbody tr").each(function () {
               if ($(this).attr('marking') == product.marking) {
                   $(this).remove();
               }
            });
        }

        // функція навішує евент на треш-іконку для видалення елементів з інвойс листа після створення продукту
        function removeProductEvent() {
            $(".voyager-trash").click(function () {
                var trashMarking = $(this).attr('marking');
                $("#invoiceTable tbody tr").each(function () {
                    if ($(this).attr('marking') == trashMarking) {
                        $(this).remove();
                        calculateSumm();
                    }
                });
            });
        }

        // функція навішує евент на едіт-іконку для редагування кількості елементів з інвойс листа після створення продукту
        function editProductEvent() {
            $(".voyager-pen").click(function () {
                var editMarking = $(this).attr('marking');

                $("#invoiceTable tbody tr").each(function () {
                    if ($(this).attr('marking') == editMarking) {
                        Product = {
                            marking: $(this).attr('marking'),
                            title: $(this).attr('title'),
                            maxqty: $(this).attr('maxqty'),
                            price: $(this).attr('price'),
                            purchase_price: $(this).attr('purchaseprice')
                        };
                    }
                });


                modal.style.display = "block";
                if (type != "purchase")
                $('#qty').val("").focus().attr('max', $(this).attr('maxqty'));
                else {
                    $('#qty').val("").focus();
                }

            });
        }


        $(document).ready(function () {
            getProduct();
        });


        //перерахунок загальної ціни
        function calculateSumm() {
            var totalSumm = 0;
            $(".summ").each(function () {
               totalSumm += parseFloat($(this).html());
            });

            $("#total-sum").val(totalSumm.toFixed(2));

            if ($("#discount").val() == "" || $("#discount").val() == "-"){
                $("#discount").val("-");
                $("#total-sum-discount").val(totalSumm.toFixed(2));
            } else {
                $("#total-sum-discount").val((totalSumm * (1 - $("#discount").val()/100)).toFixed(2));
            }
            var type = $(".page-content").attr('type');
            if (type == "writeOf") {
                totalSumm = 0;
                $("#total-sum").val(totalSumm.toFixed(2));
                $("#total-sum-discount").val(totalSumm.toFixed(2));
            }

            console.log(totalSumm);
        }

        var Product;

        // МОДАЛКА
        var modal = document.getElementById('myModal');

        // Івент для даблкліку на продукти розвішується завжди
        function getProduct() {
            $("tr").dblclick(function () {
                modal.style.display = "block";

                if (type != "purchase")
                    $('#qty').val("").focus().attr('max', $(this).attr('maxqty'));
                else {
                    $('#qty').val("").focus();
                }
                Product = {
                    marking: $(this).attr('marking'),
                    title: $(this).attr('title'),
                    maxqty: $(this).attr('maxqty'),
                    price: $(this).attr('price'),
                    purchase_price: $(this).attr('purchaseprice')
                };
            });
        }


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
                $(document).off('click', '.pagination li a');
                if ($("#input-search").val() == "") {
                    manufacture = $(".page-content").attr('manufacture');
                    console.log(manufacture);
                    if (manufacture == "") {
                        getData(1);
                    }
                    else {
                        getDataMan(1);
                    }
                    $(document).on('click', '.pagination li a', function (event) {
                            $('li').removeClass('active');
                            $(this).parent('li').addClass('active');
                            event.preventDefault();
                            var page = $(this).attr('href').split('page=')[1];
                            manufacture = $(".page-content").attr('manufacture');
                            console.log(manufacture);
                            if (manufacture == "") {
                                getData(page);
                            }
                            else {
                                getDataMan(page);
                            }

                            var body = $('#products-table');
                            var top = body.scrollTop();

                            if (top != 0) {
                                body.animate({scrollTop: 0}, '2000');
                            }
                    });
                    return false;
                }
                myurl = starturl + '&search=' + $("#input-search").val();
                getDataSearch(myurl, 1);
                $(document).on('click', '.pagination li a', function (event) {
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
                        manufacture = $(".page-content").attr('manufacture');
                        console.log(manufacture);
                        if (manufacture == "") {
                            getData(page);
                        }
                        else {
                            getDataMan(page);
                        }

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

        $(document).ready(function () {
            type = $(".page-content").attr('type');
            manufacture = $(".page-content").attr('manufacture');
        });

        function getDataSearch(url, page) {
            console.log("getDataSearch");
            $.ajax({
                url: url + '&page=' + page,
                type: "get"
            }).done(function (data) {
                $("#products-table").empty().html(data);
                location.hash = page;
                getProduct();
            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                alert("No response from server");
            });
        }

        function getData(page) {
            console.log("getData");
            $.ajax({
                url: '/admin/invoices/create?type='+type+'&page=' + page,
                type: "get"
            }).done(function (data) {
                $("#products-table").empty().html(data);
                location.hash = page;
                getProduct();
            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                alert("No response from server");
            });
        }

        function getDataMan(page) {
            console.log("getDataMan");
            $.ajax({
                url: '/admin/invoices/create?type='+type+'&manufacture='+manufacture+'&page=' + page,
                type: "get"
            }).done(function (data) {
                $("#products-table").empty().html(data);
                location.hash = page;
                getProduct();
            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                alert("No response from server");
            });
        }



        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();
        });


    </script>
    <script src="{{ voyager_asset('lib/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ voyager_asset('js/voyager_tinymce.js') }}"></script>
@stop
