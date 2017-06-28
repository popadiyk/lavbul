
<script src={{ asset('js/jquery-3.2.1.min.js')}}></script>
<script src={{ asset('js/tether.min.js') }}></script>
<script src={{ asset('js/bootstrap.min.js') }}></script>
<script src={{ asset('js/mdb.min.js') }}></script>
<script src={{ asset('js/datepicker.js') }}></script>
<script src={{ asset('js/swiper.jquery.min.js')}}></script>
<script src={{ asset('js/wow.js')}}></script>

<script>

$(document).ready(function(){

$('.navbar-toggler').on('click', function(){
  if($('#navbarsExampleCenteredNav').hasClass('show')){
    $('.navigation').removeClass('open');
  } else{
    $('.navigation').addClass('open');
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
        // autoplay: 2500,
        autoplayDisableOnInteraction: false
    });
// navigation menu
  $(function() {
      var header = $(".navigation");
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
//--------------------------- for cart ---------------------------------------//
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.quantity').on('change', function() {
        var id = $(this).attr('data-id')
       /* var error_field = $(this).siblings('span.error_qty');*/
       var error_tooltip = null;

        $.ajax({
            type: "PATCH",
            url: '{{ url("/cart") }}' + '/' + id,
            data: {
                'quantity': this.value,
            },
            success: function(data) {

                if(data.success == false) {
                    // changing color of the select and add tooltip
                    error_tooltip = 'Доступно ' + data.allowable_qty + 'шт';
                    $('[data-id="'  + id + '"]')
                        .addClass('error_qty')
                        .prop('title', error_tooltip)
                        .tooltip('show');

                    // disable button for checking order
                    $('#cart_btn_check_order').addClass('disabled');

                } else {
                    $('[data-id="'  + id + '"]')
                        .removeClass('error_qty')
                        .tooltip('destroy');

                    $('#cart_btn_check_order').removeClass('disabled');
                }
                //rewrite price for product
                $('#' + id).text(data.item.price * data.item.qty + ' грн');
                //get and set new total info for the cart
                $.get('js_cart/get_info_total', function(data, status) {
                    $('#info_basket').text(
                        'У кошику ' + data.total_qty + ' товарів на сумму ' + data.summ_total + 'грн'
                    );
                });
            },
            error: function(data) {

            }
        });
    });

    $(document).on('click', '.dropdown-menu', function(e) {
      if ($(this).hasClass('keep-open-on-click')) {
        e.stopPropagation();
      }
    });

});

</script>