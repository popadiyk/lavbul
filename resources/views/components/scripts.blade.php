
<script src={{ asset('js/jquery-3.2.1.min.js')}}></script>
<script src={{ asset('js/bootstrap.js') }}></script>
<script src={{ asset('js/datepicker.js') }}></script>
<script src={{ asset('js/swiper.jquery.min.js')}}></script>
<script src={{ asset('js/wow.js')}}></script>

<script>

$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('[data-toggle="datepicker"]').datepicker();

// slider
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        paginationClickable: true,
        spaceBetween: 0,
        centeredSlides: true,
        autoplay: 2500,
        autoplayDisableOnInteraction: false
    });
// navigation menu
    $(function() {
      var header = $("#nav-menu");
      $(window).scroll(function() {    
          var scroll = $(window).scrollTop();
          if (scroll >= 1) {
              header.removeClass('clearHeader').addClass("darkHeader");
          } else {
              header.removeClass("darkHeader").addClass('clearHeader');
          }
      });
  });
// animation effects
    wow = new WOW({
        animateClass: 'animated',
        offset: 100
      });
    wow.init();
// accordion
  var acc = document.getElementsByClassName("accordion");
  var i;
  for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function() {
      this.classList.toggle("active");
      var panel = this.nextElementSibling;
      if (panel.style.maxHeight){
        panel.style.maxHeight = null;
      } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
      } 
    }
  }
});

//------------------scripts for cart ---------------------------------------//
$(document).ready(function(){

    $(document).on('click', '.dropdown-menu', function(e) {
      if ($(this).hasClass('keep-open-on-click')) {
        e.stopPropagation();
      }
    });

    // add product to cart //
    $('button.to-cart').on('click', function(){
        var id = $(this).attr('data-id');
        var data = {};

        $(this).siblings('input').each(function(index){
            data[this.name] = this.value;
        });

        $.ajax({
            type: "POST",
            url: '{{ url("add_to_cart") }}',
            data: data,
            success: function(data){
                if(data.success == true) {
                    $('#total-count-cart').text(data.count_cart);
                    $('button[data-id=' + id +']')
                        .removeClass('btn-success')
                        .addClass('btn-info');
                }
            },
        });
    });

    // Open modal in AJAX callback
    $('#testModalBasket').click(function(event) {

        event.preventDefault();
        $.get('/get_cart', function(html) {
            $('#basket_modal').html(html).modal();

            updateTotalTitle();
            $('a.delete-product').click( function(event){
                event.preventDefault();
                var id = $(this).attr('data-id');
                var that = this;
                deleteFromCart(id, function(){
                    $(that).parents('.row').remove();
                })

            });

            $(".incr-btn").on("click", function (e) {
                var $button = $(this);
                var id = $button.parent().attr('data-id');

                var oldValue = $button.parent().find('input').val();
                console.log(oldValue);
                $button.parent().find('.incr-btn[data-action="decrease"]').removeClass('inactive');
                if ($button.data('action') == "increase") {
                    var newVal = parseFloat(oldValue) + 1;
                } else {
                    // Don't allow decrementing below 1
                    if (oldValue > 1) {
                        var newVal = parseFloat(oldValue) - 1;
                    } else {
                        newVal = 1;
                        $button.addClass('inactive');
                    }
                }
                $button.parent().find('input').val(newVal);

                updateQty(id, newVal);

                changeProductCost(id, newVal);
                e.preventDefault();
            });
        });
    });

    //-------------- for order ---------------------------------------------//
    $('select[name="delivery_id"]').change(function() {
        if(this.value != 1) {
            $('#address-block').removeClass('hide');
            $('textarea[name="address"]').attr('required', true);
        } else {
            $('#address-block').addClass('hide');
            $('textarea[name="address"]').attr('required', false);
        }
    });


});

//--------------function for cart ------------------------------------------//
function changeProductCost(id, newVal){
    var $price =  $('.price [data-id="' + id + '"]');
    var cost_one = $price.attr('price-one');

    var total_cost = (cost_one * newVal).toFixed(2);

    $price.text(total_cost + " грн");
}

function deleteFromCart(id,resolve) {

    $.post('/delete_product/' + id, function(data){
        resolve();
    })
}

function updateQty(id, qty){
    $.ajax({
        type: "PATCH",
        url: '{{ url("/cart") }}' + '/' + id,
        data: {
            'quantity': qty,
        },
        success: function (data) {

            if (data.success == false) {
                error_tooltip = 'Доступно ' + data.allowable_qty + 'шт';
                $('.quantity [data-id="' + id + '"]')
                    .addClass('error_qty')
                    .prop('title', error_tooltip)
                    .tooltip('show');
                // disable button for checking order
                $('#cart_btn_check_order').addClass('disabled');

            } else {
                console.log('ajax true' + data.data);
                $('[data-id="' + id + '"]')
                    .removeClass('error_qty')
                    .tooltip('destroy');

                $('#cart_btn_check_order').removeClass('disabled');

                updateTotalTitle();
            }
        }
    });
}

function updateTotalTitle() {
    $.get('js_cart/get_info_total', function(data, status){
        $('span.total_counter_product').text(data.total_products);
        $('#footer-total-sum').text(data.summ_total + " грн.");
    });
}

</script>