<style>
    .dropdown-menu{
        top: 70% !important;
    }
    .header-intro-clearance .header-bottom .menu.sf-arrows > li > .sf-with-ul::after {
    right: 0rem;
}
</style>
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
                @if(isset(auth()->user()->user_id))
                    <div class="wishlist" style="white-space: nowrap">
                        <a href="{{ route('add.sale-news') }}" title="Wishlist">
                            <div class="icon">
                            <i class="fa-regular fa-newspaper"></i>
                            </div>
                            <p>News Sale</p>
                        </a>
                    </div><!-- End .compare-dropdown -->

                    <div class="dropdown compare-dropdown">
                        <a href="{{ route('message.conversations') }} " class="dropdown-toggle" role="button" aria-haspopup="true">
                            <div class="icon">
                            <i class="fa-regular fa-comments"></i> <!-- Thay đổi icon ở đây -->
                            </div>
                            <p>Chat</p>
                        </a>
                    </div><!-- End .compare-dropdown -->
                    <div class="wishlist">
                        <a href="{{route('wishlist')}}" title="Wishlist">
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
                                <i class="icon fas fa-bell icon"></i>
                                <span class="cart-count badge">2</span>
                            </div>
                            <p>Notification</p>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-menu dropdown-menu-end " style="width: 300px; max-height: 400px; overflow-y: auto; top:50%;">
                                @if($notifications->isNotEmpty())
    <ul class="list-group list-group-flush">
        @foreach($notifications as $notification)
            @php
                // Giải mã selected_users để kiểm tra user_id của người dùng hiện tại
                $selectedUsers = json_decode($notification->selected_users, true); // selected_users là mảng JSON
                $userId = Auth::id(); // Lấy ID của người dùng hiện tại
            @endphp

            @if(in_array($userId, $selectedUsers) || $notification->status == 'public') <!-- Kiểm tra nếu userId có trong selected_users hoặc là thông báo công khai -->
                <li class="list-group-item d-flex align-items-start">
                    <div class="me-3">
                        <i class="fas fa-info-circle text-primary"></i>
                    </div>
                    <div>
                        <strong>{{ $notification->title_notification }}</strong><br>
                        <span class="text-muted small">{!! Str::limit($notification->content_notification, 40) !!}</span><br>
                        <small class="text-muted">{{ $notification->created_at->format('d/m/Y H:i') }}</small>
                    </div>
                </li>
            @endif
        @endforeach
    </ul>
@else
    <p class="text-center text-muted">Không có thông báo nào.</p>
@endif

                                <div class="dropdown-footer d-flex justify-content-center">
                                    <a href="{{ route('notifications.index') }}" class="btn btn-link text-primary">View All</a>
                                </div>
                            </div>
                    </div><!-- End .cart-dropdown -->
                    @else
                    <div class="wishlist">
                    <a href="{{ route('login') }}">
                            <div class="icon">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i>
                            </div>
                        </a>
                    </div>
                    <div class="wishlist">
                    <a href="{{ route('register') }}">
                            <div class="icon">
                            <i class="fa-solid fa-user-plus"></i>
                            </div>
                        </a>
                    </div>
                @endif

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
                                <a href="{{route('blogs.listting')}}" class="sf-with-ul">Blog</a>

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
                        <!-- <div class="col-md-5">
                            <a href="{{ route('login') }}">
                                <p><span class="highlight">Login</span></p>
                            </a>
                        </div>
                        <div class="col-md-5">
                            <a href="{{ route('register') }}">
                                <p><span class="highlight">Signin</span></p>
                            </a>
                        </div> -->
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
                                            <a href="{{ route('channels.index') }}">
                                                {{ __('My Channel') }}
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
