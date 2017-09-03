<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url:'/admin/cash_balance',
        success: function (data) {
            $('.navbar-header').first().after('<div id = "cash" style="display: inline-block; float:right; padding: 10px 10px 10px 30px;"> <strong>Готівка: <strong class="label label-success">'+data[0]+' грн.</strong> <br>Картка: <strong class="label label-success">'+data[1]+'  грн.</strong></strong> </div>');
        }
    });
</script>
