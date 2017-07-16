@extends('voyager::master')

@section('page_header')
    <h1 class="page-title">
        Майстер клас №{{$myMasterClass->id}} {{$myMasterClass->title}}
    </h1>
    <div class="title" style="padding: 28px 0px 20px 75px; margin-top: -100px;">
        <br>
        Майстер: {{$myMasterClass->master}}
        <br>
        Дата: {{\Carbon\Carbon::parse($myMasterClass->date_time)->format('d.m.Y | H:i')}}
    </div>
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered" style="padding-bottom:5px;">

                    <table id="dataTable" class="table table-hover">
                        <thead>
                        <tr>
                            <th style="text-align: center;">ФІО</th>
                            <th style="text-align: center;">Телефон</th>
                            <th style="text-align: center;">Дата запису</th>
                            <th style="text-align: center; width: 250px;">Статус</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dataTypeContent as $data)
                            <tr>

                                <td style="text-align: center; vertical-align: middle;">{{$data->name}}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$data->phone}}</td>
                                <td style="text-align: center; vertical-align: middle;">{{\Carbon\Carbon::parse($data->created_at)->format('d.m.Y | H:i')}}</td>
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



                </div>
            </div>
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
