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
                         <i class="fa fa-shopping-cart" aria-hidden="true" style="font-size: 24px; color: #aba8a8 !important; padding-right: 6px;"></i><a href="#"><span id="return">Перейти до кошика</span></a>
                        </div>
                      </div>
                    </div>
                </div>
                <!-- End of Basket_Modal -->
            </li>
           <li><a href="#user_modal" data-toggle="modal"><i class="fa fa-user-secret fa-2x" aria-hidden="true"></i>
                <!--  User_Modal -->
                <div class="modal fade" id="user_modal" role="dialog">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <div class="modal-dialog">
                      <!--  Modal content -->
                        <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-body">
                                <span id="head">Реєстрація</span>
                                <form id="contact-form" role="form" style="padding-top: 20px;">
                                    <div class="form-group wow fadeInUp">
                                        <label class="sr-only" for="c_email">E-mail</label>
                                        <input type="email" id="c_email" class="form-control" placeholder="E-mail" style="font-style: italic;">
                                    </div>
                                    <div class="form-group wow fadeInUp" data-wow-delay=".1s">
                                        <label class="sr-only" for="c_email">Password</label>
                                        <input type="password" id="c_password" class="form-control" placeholder="Password" style="font-style: italic;">
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-lg btn-block" id="register"><span  id="to_reg">Зареєструватись</span></button>
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