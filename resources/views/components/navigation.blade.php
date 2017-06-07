<div class="container">
    <div class="navigation">
        <ul id="nav-menu">
            <li><img src="img/min_logo.png" width="88px"></li>
            <li class="active nav-text"><a href="{{ url('/') }}">ГОЛОВНА</a></li>
            <li class="nav-text"><a href="{{ url('/products') }}">ПРОДУКЦІЯ</a></li>
            <li class="nav-text"><a href="{{ url('/master_classes') }}">МАЙСТЕР-КЛАСИ</a></li>
            <li class="nav-text"><a href="{{ url('/news') }}">НОВИНИ</a></li>
            <li class="nav-text"><a href="{{ url('/contacts') }}">КОНТАКТИ</a></li>
            <li><a href="#" role="button" class="btn" data-toggle="modal"><i class="fa fa-search fa-2x" aria-hidden="true"></i></a></li>
            <li><a href="#basket_modal" data-toggle="modal"><i class="fa fa-cart-arrow-down fa-2x" aria-hidden="true"></i>
                <!-- Basket_Modal -->
                <div class="modal fade" id="basket_modal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <div class="modal-body">
                          <p id="info_basket">У кошику 8 товарів на сумму 15 675</p>
                          <button type="button" class="btn btn-default btn-lg" id="send_order"><span id="order">Оформити замовлення</span></button>
                        </div>
                        <div class="modal-footer" id="return_into_basket">
                         <a href="#"><span id="return">Перейти до кошика</span></a>
                        </div>
                      </div>
                    </div>
                </div>
                <script>
                $('document').ready(function(){
                    $('#basket_modal').modal();
                });
                </script>
                <!-- End of Basket_Modal -->
            </li>
           <li><a href="#user_modal" data-toggle="modal"><i class="fa fa-user-secret fa-2x" aria-hidden="true"></i>
                <!--  User_Modal -->
                <div class="modal fade" id="user_modal" role="dialog">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                   <div class="modal-dialog modal-sm">
                      <!--  Modal content -->
                       <div class="modal-content">  
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                           <div class="modal-body">
                                <span id="head">Реєстрація</span>
                                <form class="form-horizontal">
                                    <div class="control-group" style="padding-bottom: 10px; padding-top: 20px;">
                                        <div class="controls">
                                            <input type="text" class="input-large" id="inputEmail" placeholder="Email">
                                        </div>
                                    </div>
                                      <div class="control-group" style="padding-bottom: 10px;">
                                        <div class="controls">
                                          <input type="password" id="inputPassword" placeholder="Password">
                                        </div>
                                      </div>
                                      <div class="control-group" style="padding-bottom: 10px;">
                                      <span id="pass"></span>
                                        <div class="controls">
                                          <button type="submit" class="btn" id="register"><span id="to_reg">Зареєструватись</span></button>
                                        </div>
                                      </div>
                                </form>
                               <div class="modal-footer" id="return_into_basket">
                                    <span id="if">Якщо Ви зареєстровані на сайті, Вам потрібно <a href="#" id="enter">Увійти</a></span>
                               </div>
                            </div>
                        </div>
                    </div>
               </div>
               <!-- End of User_Modal -->
           </li>
        </ul>
    </div>
</div>

