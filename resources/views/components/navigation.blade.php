<div class="container">
    <div class="navigation">
        <ul id="nav-menu">
            <li><img src="img/min_logo.png" width="88px"></li>
            <li class="active nav-text"><a href="{{ url('/') }}">ГОЛОВНА</a></li>
            <li class="nav-text"><a href="{{ url('/products') }}">ПРОДУКЦІЯ</a></li>
            <li class="nav-text"><a href="{{ url('/master_classes') }}">МАЙСТЕР-КЛАСИ</a></li>
            <li class="nav-text"><a href="{{ url('/news') }}">НОВИНИ</a></li>
            <li><div class="dropdown">
                    <a href="#" id="info">ІНФО</a>
                    <div class="dropdown-content">
                    <a href="{{ url('/about') }}">ПРО НАС</a>
                    <a href="#">ОПЛАТА І ДОСТАВКА</a>
                    <a href="{{ url('/contacts') }}">КОНТАКТИ</a>
                  </div>
                </div>
            </li>
           <!--  <li class="nav-text"><a href="{{ url('/contacts') }}">КОНТАКТИ</a></li> -->
            <li><a href="#" role="button" class="btn" data-toggle="modal"><i class="fa fa-search fa-2x" aria-hidden="true"></i></a></li>
            <li><a href="#basket_modal" data-toggle="modal"><i class="fa fa-cart-arrow-down fa-2x" aria-hidden="true"></i></a></li>
            <li><a href="#user_modal" data-toggle="modal"><i class="fa fa-user-secret fa-2x" aria-hidden="true"></i></a>
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
        @include('cart.index')
    </div>
</div>