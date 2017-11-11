<style type="text/css">
    .main_header_container {
        width: 100%;
        height: 150px;
        background: url('../img/products_header-min.png') 100% 100% no-repeat;
        background-size: cover;
    }

    .ny {
        height: 5px;
        width: 100%;
        background-color: rgb(245, 207, 195);;
    }

    .blue-cont {
        border-radius: 10px;
        margin: 10px;
        background: #F0FFF0;
        height: 120px;
        line-height: 100px;
        text-align: center;
        border: 2px dashed #f69c55;
    }

    .count {
        font-size: 40px;
    }

    .middle {
        display: inline-block;
        vertical-align: middle;
        line-height: normal;
    }
</style>

<div class="hidden-xs container-fluid header-block main_header_container">
    <div class="container-fluid text-center black_header_container hidden-xs" style="padding: 0;">
    </div>
</div>

<div class="hidden-xs container-fluid ny">

</div>

<div class="container hidden-xs">
    <div class="col-sm-12 col-md-4">
        <div class="col-xs-12 blue-cont">
            <span class="middle">
                <div>
                    <span class="count" id="productCount"></span> товара,
                </div>
                вже на нашому сайті
            </span>
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="col-xs-12 blue-cont">
            <span class="middle">
                <div>
                    <span class="count" id="mastersCount"></span> майстри,
                </div>
                співпрацюють з нами
            </span>
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="col-xs-12 blue-cont">
            <span class="middle">
                <div>
                    <span class="count" id="salesCount"></span> покупок,
                </div>
                здійснили наші клієнти
            </span>
        </div>
    </div>
</div>

<div class="hidden-xs container-fluid ny">

</div>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: 'get_main_count',
        type: "get"
    }).done(function (data) {
        var salesCount = data['salesCount'],
            productCount = data['productCount'],
            mastersCount = data['mastersCount'];

        $('#salesCount').html(salesCount);
        $('#productCount').html(productCount);
        $('#mastersCount').html(mastersCount);

        $('.count').each(function () {
            var $this = $(this);
            jQuery({ Counter: 0 }).animate({ Counter: $this.text() }, {
                duration: 2000,
                step: function () {
                    $this.text(Math.ceil(this.Counter));
                }
            });
        });

    }).fail(function (jqXHR, ajaxOptions, thrownError) {
        console.log('fail');
    });

</script>
