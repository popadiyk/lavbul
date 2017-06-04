@include('components.header.head')

<body >
<div class="container-fluid header-block">
    <div class="container">
        <!-- <navigation> -->
        @include('components.header.main_page.navigation')
        <!-- </navigation> -->
    </div>
    <!-- Swiper -->
    <div class="swiper-container">
        @include('components.header.main_page.swiper')
    </div>
</div>

<!-- BEGIN CONTENT -->
<div class="container-fluid advertise-block">
    <div class="container">
        <!-- begin advertise --> 
        @include('components.content.main_page.advertise')
        <!-- advertise --> 
        <!-- LIST OF PRODUCTS -->    
        @include('components.content.main_page.products')
        <!-- LIST OF PRODUCTS -->
    </div>
</div>

<!-- part for partners -->
<div class="container-fluid hidden-sm partners-block">
    <div class="container">
        @include('components.content.main_page.partners')
    </div>
</div>
<!-- end of part for partners -->

<!-- FOOTER -->
<div class="container-fluid footer-block">
    <div class="container">
        @include('components.footer.main_page.footer')
    </div>
</div>

<!-- END FOOTER -->
@include('components.footer.main_page.scripts')
</body>
</html>