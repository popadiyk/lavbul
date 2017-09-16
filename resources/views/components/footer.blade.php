<style>
#myTop {
     display: none;
      position: fixed;
      bottom: 20px;
      right: 30px;
      z-index: 99;
      border: none;
      color: #e9967c;
}

#myTop a:hover {
  background-color: #555;
}
</style>


<!-- FOOTER -->
<div class="container-fluid footer-block">
    <div class="container">
        <div class="row hidden-xs">
            <div class="col-sm-4 col-md-4">
                <div class="contacts">
                    <ul>
                        <li><h3>Контакти</h3></li>
                        <hr>
                        <li class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;"><i class="fa fa-phone-square fa-2x" style="margin-right: 15px;" aria-hidden="true"></i>+38-095-485-43-96</li>
                        <li class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;"><i class="fa fa-envelope fa-2x" style="margin-right: 15px;" aria-hidden="true"></i>admin.lavbul@gmail.com</li>
                       <li class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;"><i class="fa fa-skype fa-2x" style="margin-right: 15px;" aria-hidden="true"></i>popadiyk</li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="about_us_footer">
                    <ul style="padding-left: 0px;">
                        <li><h3>Про нас</h3></li>
                        <hr>
                        <li class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;"><a href="/">Головна</a></li>
                        <li class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;"><a href="{{ url('products') }}">Продукція</a></li>
                        <li class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;"><a href="{{ url('master_classes') }}">Майстер-класи</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="info_footer">
                    <ul style="padding-left: 0px;">
                        <li><h3>Інформація</h3></li>
                        <hr>
                        <li class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;"><a href="{{ url('payments') }}">Оплата і Доставка</a></li>
                        <li class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;"><a href="{{ url('contacts') }}">Контакти</a></li>
                        <li class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;"><a href="{{ url('news') }}">Новини</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="social">
                   <h5><strong>Ми в соцмережах:</strong></h5>
                   <ul>
                       <li><a href=""><i class="fa fa-twitter-square fa-3x" aria-hidden="true"></i></a></li>
                       <li><a href=""><i class="fa fa-instagram fa-3x" aria-hidden="true"></i></a></li>
                      <!--  <li><i class="fa fa-google-plus-square fa-3x" aria-hidden="true"></i></li> -->
                       <li><a href=""><i class="fa fa-facebook-square fa-3x" aria-hidden="true"></i></a></li>
                       <li><a href=""><i class="fa fa-vk fa-3x" aria-hidden="true"></i></a></li>
                      <!--  <li><i class="fa fa-linkedin-square fa-3x" aria-hidden="true"></i></li> -->
                   </ul>
                </div>
            </div>
        </div>
        <div class="row hidden-sm hidden-md hidden-lg">
            <button class="accordion accordion_footer">Про нас</button>
            <div class="panel">
                <div class="about_us_footer">
                    <ul style="padding-left: 0px;">
                        <hr>
                        <li class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;"><a href="/">Головна</a></li>
                        <li class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;"><a href="{{ url('products') }}">Продукція</a></li>
                        <li class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;"><a href="{{ url('master_classes') }}">Майстер-класи</a></li>
                    </ul>
                </div>
            </div>
            <button class="accordion accordion_footer">Інформація</button>
            <div class="panel">
                <div class="info_footer">
                    <ul style="padding-left: 0px;">
                        <hr>
                        <li class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;"><a href="{{ url('payments') }}">Оплата і Доставка</a></li>
                        <li class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;"><a href="{{ url('contacts') }}">Контакти</a></li>
                        <li class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;"><a href="{{ url('news') }}">Новини</a></li>
                    </ul>
                </div>
            </div>
            <button class="accordion accordion_footer text-center">Контакти</button>
            <div class="panel">
                <div class="contacts">
                    <ul style="text-align: left;">
                        <hr>
                        <li class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;"><i class="fa fa-phone-square fa-2x" style="margin-right: 15px;" aria-hidden="true"></i>+38-095-485-43-96</li>
                        <li class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;"><i class="fa fa-envelope fa-2x" style="margin-right: 15px;" aria-hidden="true"></i>admin.lavbul@gmail.com</li>
                        <li class="animated fadeInUp wow animated" style="visibility: visible; animation-name: fadeInUp;"><i class="fa fa-skype fa-2x" style="margin-right: 15px;" aria-hidden="true"></i>popadiyk</li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="social">
                   <h4>Ми в соцмережах:</h4>
                   <ul>
                       <li><i class="fa fa-twitter-square fa-3x" aria-hidden="true"></i></li>
                       <li><i class="fa fa-instagram fa-3x" aria-hidden="true"></i></li>
                       <!-- <li><i class="fa fa-google-plus-square fa-3x" aria-hidden="true"></i></li> -->
                       <li><i class="fa fa-facebook-square fa-3x" aria-hidden="true"></i></li>
                       <!-- <li><i class="fa fa-linkedin-square fa-3x" aria-hidden="true"></i></li> -->
                   </ul>
                </div>
            </div>
        </div>    
    </div>
</div>
<div class="to_top">
    <a href="#" onclick="topFunction()" id="myTop" title="To top"><i class="fa fa-chevron-up fa-2x" aria-hidden="true"></i></a>
</div>


<!-- END FOOTER -->
@include('components.scripts')
</body>
</html>