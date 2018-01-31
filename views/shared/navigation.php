<header id="header" class="navbar-fixed-top navbar-inverse video-menu" role="banner">
    <div class="container">
      <!-- <div class="row"> -->
                 <div class="navbar-header ">
                     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">
                                <img src="/images/logo.png" alt="" class="img-responsive">
                        </a>
                 </div><!--Navbar header End-->
                  <nav class="collapse navbar-collapse navigation" id="navbar-collapse" role="navigation">
                        <ul class="nav navbar-nav navbar-right ">
                            <li><a href="/" >Home</a></li>
                            
                            <li><a href="#" id="megacatalog">Catalog</a> </li>
                            <li><a href="/about" >About Us </a> </li>
                            <li><a href="/blog" >Blog</a> </li>
                            <li><a href="/guestbook" >Guestbook</a> </li>
                            <li><a href="/contact" >Contact Us</a> </li>
                            <li class="nav-icons" id="navicons">
                            <a href="#"><label for="search-toggle"><i class="fa fa-search button-search" aria-hidden="true"></i></label></a>
                            <a href="#"><label for="modal-basket-toggle" id="cart-trigger"><i class="fa fa-shopping-cart shopping-cart" aria-hidden="true"></i></label></a>
                            <a href="#"><label for="modal-login-toggle" class="animate"><i class="fa fa-user" aria-hidden="true"></i></label></a>
                            <dropdown>
                                <input id="modal-login-toggle" type="checkbox">
                                <ul class="animate">
                                <?php if(User::isGuest()):?>
                                    <li class="animate"><a href="/register">SignUp<i class="fa fa-user-plus float-right"></i></a></li>
                                    <li class="animate"><a href="/login">LogIn<i class="fa fa-sign-in float-right"></i></a></li>
                                <?php else:?>
                                    <li class="animate"><a href="/logout">LogOut<i class="fa fa-sign-out float-right"></i></a></li>
                                <?php endif;?>
                                </ul>
                            </dropdown>
                        </li>
                            
                        
                        </ul>

                     </nav>
    </div><!-- /.container-fluid -->
  </header>