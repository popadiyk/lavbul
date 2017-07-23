
<script>
//--------------------------- for cart ---------------------------------------//
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).on('click', '.dropdown-menu', function(event) {
      if ($(this).hasClass('keep-open-on-click')) {
        event.stopPropagation();
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
    // масив ID продуктів в корзині яких вибрана кількість більша ніж є на складі
    var checkQty = [];

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
                }, checkQty)
            });
            $(".incr-btn").on("click", function (event) {
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
                updateQty(id, newVal, checkQty);
                changeProductCost(id, newVal);
                event.preventDefault();
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
function deleteFromCart(id,resolve, checkQty) {
    var index = checkQty.indexOf(id);
    if(index > -1 ) {
        checkQty.splice(index, 1);
    }
    $.post('/delete_product/' + id, function(data){
        resolve();
    });
    if(checkQty.length > 0 ) {
        $('#cart_btn_check_order').addClass('disabled');
    } else {
        $('#cart_btn_check_order').removeClass('disabled');
        updateTotalTitle();
    }
}
function updateQty(id, qty, checkQty){
    $.ajax({
        type: "PATCH",
        url: '{{ url("/cart") }}' + '/' + id,
        data: {
            'quantity': qty,
        },
        success: function (data) {
            if (data.success == false) {
                var index1 = checkQty.indexOf(id);

                if(index1 == -1) {
                    checkQty.push(id);
                }
                $('span[data-id="' + id + '"].control-qty').removeClass('hidden');
            } else {
                var index = checkQty.indexOf(id);
                if(index > -1 ) {
                    checkQty.splice(index, 1);
                }
                $('span[data-id="' + id + '"].control-qty').addClass('hidden');
            }
            if(checkQty.length > 0 ) {
                $('#cart_btn_check_order').addClass('disabled');
            } else {
                $('#cart_btn_check_order').removeClass('disabled');
                updateTotalTitle();
            }
        }

    });
    console.log('qty in warnig + ' + checkQty.length);

}
function updateTotalTitle() {
    $.get('js_cart/get_info_total', function(data, status){
        $('span.total_counter_product').text(data.total_products);
        $('#footer-total-sum').text(data.summ_total + " грн.");
    });
}

$(document).ready(function(){

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

        skipClickDelay = function(event){
            event.preventDefault();
            event.target.click();
        };
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
        switchAccordion = function(event) {
            console.log("triggered");
            event.preventDefault();
            var thisAnswer = event.target.parentNode.nextElementSibling;
            var thisQuestion = event.target;
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
    // var acc = document.getElementsByClassName("accordion");
    // var i;
    // for (i = 0; i < acc.length; i++) {
    //     acc[i].onclick = function() {
    //         this.classList.toggle("active");
    //         var panel = this.nextElementSibling;
    //         if (panel.style.maxHeight){
    //             panel.style.maxHeight = null;
    //         } else {
    //             panel.style.maxHeight = panel.scrollHeight + "px";
    //         } 
    //     }
    // }

    //BEGIN sorting
    $(document).on('click', 'a.accordion-title', function (event) {
        var group_id = $(this).attr('groupId');
        //send AJAX request
        getProductsGroup(group_id);
        event.preventDefault();
    });

    //AJAX for sorting
    function getProductsGroup(group_id) {
        $.ajax({
            url : '/products/group',
            method: 'POST',
            data: {
                group_id: group_id,
            },
        }).done(function (data) {
            $('#products_list').innerHTML = "";
            $('#products_list').html(data);
            location.hash = 'group='+group_id;
        }).fail(function () {
            $('#products_list').html('<h1>Products could not be loaded.</h1>');
        });
    };
    //END sorting
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

</script>