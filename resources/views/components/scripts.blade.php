{{--<script src="{{ asset('js/bootstrap.js') }}"></script>--}}
<script src={{ asset('js/jquery-3.2.1.min.js')}}></script>
<script src={{ asset('js/swiper.jquery.min.js')}}></script>
<script src={{ asset('js/wow.js')}}></script>

<script>

$(document).ready(function(){
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
  

</script>