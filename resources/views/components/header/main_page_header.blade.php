<header>
   <!--  <div class="parallax-1">
       <div class="parallax-2">
           <div class="parallax-3">
               <div class="logo"></div>
           </div>
       </div>
   </div> -->
   <div class="row">
        <div class="col-md-12">
            <div id="main_header" style="height: 150px; width: 100%; background-color: #ffe6cc;">
                <div class="col-md-4" >
                    <div class="col-md-12">
                      <form class="navbar-form" role="search" style="padding-left: 0">
                        <div class="input-group add-on">
                          <input class="form-control" placeholder="Search" name="srch-term" id="srch-term" type="text">
                          <div class="input-group-btn">
                            <button class="btn btn-default" type="submit" style="background-color: #5bc0de;"><i class="glyphicon glyphicon-search"></i></button>
                          </div>
                        </div>
                      </form>
                    </div>

                    <div class="col-md-12">
                        <div class="schedule" style="font-size: 16px; font-family: 'ABeeZee'">
                            <span> Пн-Сб: 10:00-19:00</span><br>
                            <span> Неділя - вихідний</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" id="logo">
                   <div><img src="img/logo.png" style="width: 436px; height: 150px;"></div>
               </div>

                <div class="col-md-4">
                    <div class="col-md-12">
                        <div class="login">
                            <a href="#">Вхід</a> |
                            <a href="#">Реєстрація</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="basket">
                            <a href="#"><img src="img/cart32.png" style="width: 32px; height: 28px; padding-right: 5px">11550.15 грн</a>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
   </div>


  <!--   <div class="soc-network">
      <div class="vk"><img src="img/vk.png" height="50px" width="50px"></div>
      <div class="fb"><img src="img/fb.png" height="50px" width="50px"></div>
      <div class="insta"><img src="img/insta.png" height="48px" width="48px"></div>
  </div> -->

</header>

<div class="row menu">
    <a href="/" type="button" class="col-xs-12 col-sm-4 col-md-2 mybtn btn btn-default">
        Головна
    </a>
    <a href="#" type="button" class="col-xs-12 col-sm-4 col-md-2 mybtn btn btn-default">
        Магазин
    </a>
    <a href="#" type="button" class="col-xs-12 col-sm-4 col-md-2 mybtn btn btn-default">
        Новини
    </a>
    <a href="#" type="button" class="col-xs-12 col-sm-4 col-md-2 mybtn btn btn-default">
        Майстер-класи
    </a>
    <a href="{{ url('/contacts') }}" type="button" class="col-xs-12 col-sm-4 col-md-2 mybtn btn btn-default">
        Контакти
    </a>
    <a href="{{ url('/feedbacks') }}" type="button" class="col-xs-12 col-sm-4 col-md-2 mybtn btn btn-default">
        Відгуки
    </a>

</div>