<script src={{ asset('js/jquery-1.11.0.min.js')}}></script>
{{-- <script src={{asset('js/jquery.js')}}></script> --}}
<script src={{ asset('js/swiper.jquery.min.js')}}></script>
<script src={{ asset('js/wow.js')}}></script>

<script>
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
  wow = new WOW({
    animateClass: 'animated',
    offset: 100
  });
  wow.init();
</script>