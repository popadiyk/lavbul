<style type="text/css">
	#firstSlide {
		background-image: url('img/foSl-min.jpg');
		 -webkit-background-size: cover;
	     background-size: cover;
	     background-position: center;
}

	#secondSlide {
		background-image: url('img/fb4.jpg');
	 	-webkit-background-size: cover;
     	background-size: cover;
    	background-position: center;
	}

	#thirdSlide {
		background-image: url('img/fb2.jpg');
		 -webkit-background-size: cover;
     	background-size: cover;
     	background-position: center;
	}

	#fouthSlide {
		background-image: url('img/fb3.jpg');
		 	-webkit-background-size: cover;
     		background-size: cover;
     		background-position: center;
	}
</style>


<div class="hidden-xs container-fluid header-block">
	<div class="swiper-container">
		@include('main.header')
		<div class="swiper-wrapper">
			<div class="swiper-slide" id="firstSlide">
				 <div class="title" data-swiper-parallax="-100">
				 	<h1 class="header_text"><span>Фантазуйте разом з нами</span><br><span>і отримуйте масу задоволення!</span></h1>
				 </div>
			</div>
			<div class="swiper-slide" id="secondSlide">
				 <div class="title" data-swiper-parallax="-100">
				 	<h1 class="header_text"><span>Створюйте свій</span><br><span>настрій та атмосферу!</span></h1>
				 </div>
			</div>
			<div class="swiper-slide" id="thirdSlide">
				<div class="title" data-swiper-parallax="-100">
				 	<h1 class="header_text"><span>Оточуйте себе</span><br><span>унікальними та оригінальними речами!</span></h1>
				 </div>
			</div>
			<div class="swiper-slide" id="fouthSlide">
				<div class="title" data-swiper-parallax="-100">
				 	<h1 class="header_text"><span>Дивуйте своїх рідних</span><br><span>авторськими подарунками!</span></h1>
				 </div>
			</div>
		</div>
		<!-- Add Pagination -->
		<div class="swiper-pagination"></div>
		<!-- Add Arrows -->
		<div class="hidden-xs swiper-button-next"></div>
		<div class="hidden-xs swiper-button-prev"></div>
	</div>
</div>
</body>