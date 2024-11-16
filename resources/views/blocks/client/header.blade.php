<div class="page-wrapper">
    <header class="header header-intro-clearance header-4">
        <div class="header-middle">
            <div class="container">
                <div class="header-left">
                    <button class="mobile-menu-toggler">
                        <span class="sr-only">Toggle mobile menu</span>
                        <i class="icon-bars"></i>
                    </button>

                    <a href="#" class="logo">
                        <img src="{{ asset('assets/images/demos/demo-4/logo.png') }}" alt="Molla Logo" width="150" height="3">
                    </a>
                </div><!-- End .header-left -->

                <div class="header-center">
                    <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
                        <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                        <form action="#" method="get">
                            <div class="header-search-wrapper search-wrapper-wide">
                                <label for="q" class="sr-only">Search</label>
                                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                                <input type="search" class="form-control" name="q" id="q"
                                    placeholder="Search product ..." required>
                            </div><!-- End .header-search-wrapper -->
                        </form>
                    </div><!-- End .header-search -->
                </div>

                <div class="header-right">
                    <div class="dropdown compare-dropdown">
                        <a href="chat.html" class="dropdown-toggle" role="button" aria-haspopup="true">
                            <div class="icon">
                                <i class="fas fa-comments"></i> <!-- Thay đổi icon ở đây -->
                            </div>
                            <p>Chat</p>
                        </a>



                    </div><!-- End .compare-dropdown -->

                    <div class="wishlist">
                        <a href="wishlist.html" title="Wishlist">
                            <div class="icon">
                                <i class="icon-heart-o"></i>
                                <span class="wishlist-count badge">3</span>
                            </div>
                            <p>Wishlist</p>
                        </a>
                    </div><!-- End .compare-dropdown -->

                    <div class="dropdown cart-dropdown">
                        <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" data-display="static">
                            <div class="icon">
                                <i class="icon-shopping-cart"></i>
                                <span class="cart-count">2</span>
                            </div>
                            <p>Cart</p>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-cart-products">
                                <div class="product">
                                    <div class="product-cart-details">
                                        <h4 class="product-title">
                                            <a href="product.html">Beige knitted elastic runner shoes</a>
                                        </h4>

                                        <span class="cart-product-info">
                                            <span class="cart-product-qty">1</span>
                                            x $84.00
                                        </span>
                                    </div><!-- End .product-cart-details -->

                                    <figure class="product-image-container">
                                        <a href="product.html" class="product-image">
                                            <img src="assets/images/products/cart/product-1.jpg" alt="product">
                                        </a>
                                    </figure>
                                    <a href="#" class="btn-remove" title="Remove Product"><i
                                            class="icon-close"></i></a>
                                </div><!-- End .product -->

                                <div class="product">
                                    <div class="product-cart-details">
                                        <h4 class="product-title">
                                            <a href="product.html">Blue utility pinafore denim dress</a>
                                        </h4>

                                        <span class="cart-product-info">
                                            <span class="cart-product-qty">1</span>
                                            x $76.00
                                        </span>
                                    </div><!-- End .product-cart-details -->

                                    <figure class="product-image-container">
                                        <a href="product.html" class="product-image">
                                            <img src="assets/images/products/cart/product-2.jpg" alt="product">
                                        </a>
                                    </figure>
                                    <a href="#" class="btn-remove" title="Remove Product"><i
                                            class="icon-close"></i></a>
                                </div><!-- End .product -->
                            </div><!-- End .cart-product -->

                            <div class="dropdown-cart-total">
                                <span>Total</span>

                                <span class="cart-total-price">$160.00</span>
                            </div><!-- End .dropdown-cart-total -->

                            <div class="dropdown-cart-action">
                                <a href="cart.html" class="btn btn-primary">View Cart</a>
                                <a href="checkout.html" class="btn btn-outline-primary-2"><span>Checkout</span><i
                                        class="icon-long-arrow-right"></i></a>
                            </div><!-- End .dropdown-cart-total -->
                        </div><!-- End .dropdown-menu -->
                    </div><!-- End .cart-dropdown -->
                </div><!-- End .header-right -->
            </div><!-- End .container -->
        </div><!-- End .header-middle -->

        <div class="header-bottom sticky-header">
            <div class="container">
                <div class="header-left">
                    <div class="dropdown category-dropdown">
                        <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" data-display="static"
                            title="Browse Categories">
                            Browse Categories <i class="icon-angle-down"></i>
                        </a>

                        <div class="dropdown-menu">
                            <nav class="side-nav">
                                <ul class="menu-vertical sf-arrows">
                                    <li class="item-lead"><a href="#">Daily offers</a></li>
                                    <li class="item-lead"><a href="#">Gift Ideas</a></li>
                                    <li><a href="#">Beds</a></li>
                                    <li><a href="#">Lighting</a></li>
                                    <li><a href="#">Sofas & Sleeper sofas</a></li>
                                    <li><a href="#">Storage</a></li>
                                    <li><a href="#">Armchairs & Chaises</a></li>
                                    <li><a href="#">Decoration </a></li>
                                    <li><a href="#">Kitchen Cabinets</a></li>
                                    <li><a href="#">Coffee & Tables</a></li>
                                    <li><a href="#">Outdoor Furniture </a></li>
                                </ul><!-- End .menu-vertical -->
                            </nav><!-- End .side-nav -->
                        </div><!-- End .dropdown-menu -->
                    </div><!-- End .category-dropdown -->
                </div><!-- End .header-left -->

                <div class="header-center">
                    <nav class="main-nav">
                        <ul class="menu sf-arrows">
                            <li class="megamenu-container active">
                                <a href="index.html" class="sf-with-ul">Home</a>
                            </li>
                            <li>
                                <a href="#" class="sf-with-ul">Shop</a>

                                <ul>
                                    <li>
                                        <a href="about.html" class="sf-with-ul">Sale new</a>

                                        <ul>
                                            <li><a href="about.html">s1</a></li>
                                            <li><a href="about-2.html">s2</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="product.html">Product</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="sf-with-ul">Product</a>

                                <ul>
                                    <li>
                                        <a href="about.html" class="sf-with-ul">New Product </a>
                                        <a href="about.html" class="sf-with-ul">Products </a>

                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="blog.html" class="sf-with-ul">Blog</a>

                                <ul>
                                    <li><a href="blog.html">Classic</a></li>
                            </li>
                        </ul>
                        </li>

                        <li>
                            <a href="#" class="sf-with-ul">Contact</a>
                            <ul>
                                <li><a href="404.html">Error 404</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="sf-with-ul">About us</a>
                            <ul>
                                <li><a href="404.html">Error 404</a></li>
                            </ul>
                        </li>

                        </ul>
                        <!-- End .menu -->
                    </nav>
                    <!-- End .main-nav -->
                </div>
                <div class="header-right">
                    <div class="row">
                        @guest
                        <!-- Nếu chưa đăng nhập -->
                        <div class="col-md-5">
                            <a href="{{ route('login') }}">
                                <p><span class="highlight">Login</span></p>
                            </a>
                        </div>
                        <div class="col-md-5">
                            <a href="{{ route('register') }}">
                                <p><span class="highlight">Signin</span></p>
                            </a>
                        </div>
                        @endguest

                        @auth
                        <!-- Nếu đã đăng nhập -->
                        <div class="col-md-5">
                            <div class="header-dropdown" style="display: flex; align-items: center;">
                                <a href="#" style="display: flex; align-items: center;">
                                    <div style="width: 40px; height: 40px; overflow: hidden; border-radius: 50%; margin-right: 10px;">
                                        <img src="{{ asset( Auth::user()->image_user) }}" alt="User Avatar"
                                            style="width: 100%; height: auto;">
                                    </div>
                                    <span class="highlight" style="white-space: nowrap;">{{ Auth::user()->full_name }}</span> <!-- Hiển thị tên người dùng đã đăng nhập -->
                                </a>
                                <div class="header-menu" style="margin-left: 10px;">
                                    <ul>
                                        <li>
                                            <a href="{{ route('account') }}">
                                                {{ __('Profile') }}
                                            </a>
                                        </li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                                    {{ __('Log Out') }}
                                                </a>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                        @endauth
                    </div>

                </div> <!-- End .header-center -->

                <!-- End .container -->
            </div><!-- End .header-bottom -->
    </header><!-- End .header -->