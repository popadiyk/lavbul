
<script src={{ asset('js/jquery-3.2.1.min.js')}}></script>
<script src={{ asset('js/tether.min.js') }}></script>
<script src={{ asset('js/bootstrap.min.js') }}></script>
<script src={{ asset('js/mdb.min.js') }}></script>
<script src={{ asset('js/datepicker.js') }}></script>
<script src={{ asset('js/swiper.jquery.min.js')}}></script>
<script src={{ asset('js/wow.js')}}></script>

<script>

$(document).ready(function(){

$('.pagination').addClass('list-inline justify-content-center');
$('.pagination li').addClass('page-item');
$('.pagination li:first').html("<a class=\"page-link waves-effect waves-effect\" aria-label=\"Previous\" href=\"javascript:;\"><span aria-hidden=\"true\">«</span><span class=\"sr-only\">Previous</span></a>");
$('.pagination li:last-child').html("<a class=\"page-link waves-effect waves-effect\" href=\"javascript:;\" aria-label=\"Next\><span aria-hidden=\"true\">»</span><span class=\"sr-only\">Next</span></a>");
var currentPage = $('.pagination li.active span').text();
$('.pagination li.active').html("<a href=\"javascript:;\">"+currentPage+"</a>");


$('.accordion-title').click(function(event){
    event.preventDefault();

    if ($(this).hasClass('last')) {
        $('.accordion-title').each(function() {
            $(this).removeClass('active');
        });
        $(this).addClass('active');
    }
});

// Get the modal
var productImageModal = document.getElementById('productImageModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var productImage = document.getElementById("productImage");
var captionText = document.getElementById("caption");
$('a.picture').click(function(event){
    event.preventDefault();
    // productImageModal.style.display = "block";
    productImage.src = this.href;
    captionText.innerHTML = this.title;
});

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// accordion
//uses classList, setAttribute, and querySelectorAll
//if you want this to work in IE8/9 youll need to polyfill these
(function(){
    var d = document,
    accordionToggles = d.querySelectorAll('.js-accordionTrigger'),
    setAria,
    setAccordionAria,
    switchAccordion,
  touchSupported = ('ontouchstart' in window),
  pointerSupported = ('pointerdown' in window);
  
  skipClickDelay = function(e){
    e.preventDefault();
    e.target.click();
  }

        setAriaAttr = function(el, ariaType, newProperty){
        el.setAttribute(ariaType, newProperty);
    };
    setAccordionAria = function(el1, el2, expanded){
        switch(expanded) {
      case "true":
        setAriaAttr(el1, 'aria-expanded', 'true');
        setAriaAttr(el2, 'aria-hidden', 'false');
        break;
      case "false":
        setAriaAttr(el1, 'aria-expanded', 'false');
        setAriaAttr(el2, 'aria-hidden', 'true');
        break;
      default:
                break;
        }
    };
//function
switchAccordion = function(e) {
  console.log("triggered");
    e.preventDefault();
    var thisAnswer = e.target.parentNode.nextElementSibling;
    var thisQuestion = e.target;
    if(thisAnswer.classList.contains('is-collapsed')) {
        setAccordionAria(thisQuestion, thisAnswer, 'true');
    } else {
        setAccordionAria(thisQuestion, thisAnswer, 'false');
    }
    thisQuestion.classList.toggle('is-collapsed');
    thisQuestion.classList.toggle('is-expanded');
        thisAnswer.classList.toggle('is-collapsed');
        thisAnswer.classList.toggle('is-expanded');
    
    thisAnswer.classList.toggle('animateIn');
    };
    for (var i=0,len=accordionToggles.length; i<len; i++) {
        if(touchSupported) {
      accordionToggles[i].addEventListener('touchstart', skipClickDelay, false);
    }
    if(pointerSupported){
      accordionToggles[i].addEventListener('pointerdown', skipClickDelay, false);
    }
    accordionToggles[i].addEventListener('click', switchAccordion, false);
  }
})();

// 

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
        autoplay: 3500,
        autoplayDisableOnInteraction: false,
        loop: true
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

// to_top button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myTop").style.display = "block";
    } else {
        document.getElementById("myTop").style.display = "none";
    }
}


function topFunction() {
    document.body.scrollTop = 0; 
    document.documentElement.scrollTop = 0;
}




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
                        .prop('title', error_tooltip);
                        // .tooltip('show');

                    // disable button for checking order
                    $('#cart_btn_check_order').addClass('disabled');

                } else {
                    $('[data-id="'  + id + '"]')
                        .removeClass('error_qty');
                        // .tooltip('destroy');

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

//------------------scripts for cart ---------------------------------------//
$(document).ready(function(){
    // $(document).on('click', '.dropdown-menu', function(e) {
    //   if ($(this).hasClass('keep-open-on-click')) {
    //     e.stopPropagation();
    //   }
    // });
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
            $('#fullHeightModalRight').html(html).modal();
            updateTotalTitle();
            $('a.delete-product').click( function(event){
                event.preventDefault();
                var id = $(this).attr('data-id');
                var that = this;
                deleteFromCart(id, function(){
                    $(that).parents('li.list-group-item').remove();
                    updateTotalTitle();
                })
            });
            $(".incr-btn").on("click", function (e) {
                var $button = $(this);
                var id = $button.parent().attr('data-id');
                var oldValue = $button.parent().find('input').val();

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
                    .prop('title', error_tooltip);
                    // .tooltip('show');
                // disable button for checking order
                $('#cart_btn_check_order').addClass('disabled');
            } else {
                console.log('ajax true' + data.data);
                $('[data-id="' + id + '"]')
                    .removeClass('error_qty');
                    // .tooltip('destroy');
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