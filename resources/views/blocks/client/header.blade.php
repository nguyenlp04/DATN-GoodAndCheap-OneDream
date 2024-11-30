<style>
   
   .hover-item-notification:hover{
      background-color: #eee6e4;
      color: #f3ecec;
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
            <img src="{{ $setting->logo ? asset($setting->logo) : asset('assets/images/demos/demo-4/logo.png') }}" alt="Molla Logo" class="d-none d-sm-block" width="150" height="30">
            <img src="{{ $setting->logo ? asset($setting->logo) : asset('assets/images/demos/demo-4/logo.png') }}" alt="Molla Logo Mobile" class="d-block d-sm-none" width="100" height="35">
            </a>
         </div>
         <!-- End .header-left -->
         <div class="header-center">
            <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
               <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
               <form action="#" method="get">
                  <div class="header-search-wrapper search-wrapper-wide">
                     <label for="q" class="sr-only">Search</label>
                     <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                     <input type="search" class="form-control" name="q" id="q"
                        placeholder="Search product ..." required>
                  </div>
                  <!-- End .header-search-wrapper -->
               </form>
            </div>
            <!-- End .header-search -->
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
            </div>
            <!-- End .compare-dropdown -->
            <div class="dropdown compare-dropdown">
               <a href="{{ route('message.conversations') }} " class="dropdown-toggle" role="button"
                  aria-haspopup="true">
                  <div class="icon">
                     <i class="fa-regular fa-comments"></i> <!-- Thay đổi icon ở đây -->
                  </div>
                  <p>Chat</p>
               </a>
            </div>
            <!-- End .compare-dropdown -->
            <div class="dropdown cart-dropdown">
               <a href="{{ route('wishlist') }}" class="dropdown-toggle" data-display="static">
                  <div class="icon">
                     <i class="icon-heart-o"></i>
                     <!-- <span class="cart-count">0</span> Số lượng sẽ được cập nhật qua AJAX -->
                  </div>
                  <p>Wishlist</p>
               </a>
            </div>
            <!-- End .cart-dropdown -->
            <div class="dropdown cart-dropdown">
               <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
                  aria-expanded="false" data-display="static">
                   <div class="icon">
                       <i class="fa-regular fa-bell fa-sm"></i>
                   </div>
                   <p>notifications</p>
               </a>
               <div class="dropdown-menu dropdown-menu-right dropdown-item dropdown-notifications-item">
                   @if (!empty($notifications))
                       @for ($i = 0; $i < min(10, count($notifications)); $i++) 
                           <div class="border-bottom mb-1 hover-item-notification">
                               <a href="{{ route('notifications.detail', ['notification' => $notifications[$i]['notification_id']]) }}" class="notification-link">
                                   <div>
                                       <i class="fa-regular fa-bell fa-sm pr-3"></i>
                                       @php
                                           $createdAt = new DateTime($notifications[$i]['created_at']);
                                       @endphp
                                       <span class="dropdown-notifications-item-content-details">{{ $createdAt->format('d/m/Y H:i') }}</span>
                                       <div class="h6 mt-1">{{ Str::limit($notifications[$i]['title_notification'], 27) }}</div>
                                   </div>
                               </a>
                           </div>
                       @endfor
                   @else
                       <p class="text-center">No notifications available.</p>
                   @endif
                   <div class="dropdown-cart-action mt-2 flex justify-content-center">
                       <a href="{{ route('notifications.show') }}" class="dropdown-item text-center">View all</a>
                   </div>
               </div>
           </div>
            @else
            <div class="wishlist">
               <a href="{{ route('login') }}" style="font-size: 1.8rem">
                  <div class="icon d-flex align-items-center">
                     <i class="icon-user"></i>
                     Login
                  </div>
               </a>
            </div>
            <div class="wishlist">
               <a href="{{ route('register') }}" style="font-size: 1.8rem">
                  <div class="icon d-flex align-items-center">
                     {{-- <i class="icon-user"></i> --}}
                     Sign Up
                  </div>
               </a>
            </div>
            @endif
         </div>
         <!-- End .header-right -->
      </div>
      <!-- End .container -->
   </div>
   <!-- End .header-middle -->
   <div class="header-bottom sticky-header">
   <div class="container">
      <div class="header-left">
         <div class="dropdown category-dropdown">
            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false" data-display="static" title="Browse Categories">
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
                  </ul>
                  <!-- End .menu-vertical -->
               </nav>
               <!-- End .side-nav -->
            </div>
            <!-- End .dropdown-menu -->
         </div>
         <!-- End .category-dropdown -->
      </div>
      <!-- End .header-left -->
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
                  <a href="{{route('blogs.listting')}}" class="">Blog</a>
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
            <ul class="menu sf-arrows">
               <div class="col-md-5">
                  <div class="header-dropdown" style="display: flex; align-items: center;">
                     <div style="display: flex; align-items: center;   cursor: pointer;">
                        <div
                           style="width: 40px; height: 40px; overflow: hidden; border-radius: 50%; margin-right: 10px;">
                           <img src="{{ Auth::user()->image_user ? asset(Auth::user()->image_user) : 'https://i.pinimg.com/originals/c6/e5/65/c6e56503cfdd87da299f72dc416023d4.jpg' }}"
                              alt="User Avatar" style="width: 100%; height: auto;">
                        </div>
                        <span class="highlight"
                           style="white-space: nowrap;">{{ Auth::user()->full_name }}</span>
                        <!-- Hiển thị tên người dùng đã đăng nhập -->
                     </div>
                     <div class="header-menu" style="margin-left: 10px;">
                        <ul>
                           <li>
                              <a href="{{ route('user.manage') }}">
                              {{ __('Profile') }}
                              </a>
                           </li>
                           @if(!auth()->user()->channel || auth()->user()->channel->status === null)
                           <li>
                              <a href="{{ url('channels/create') }}">
                              {{ __('Upgrage Account') }}
                              </a>
                           </li>
                           @endif
                           @if(auth()->user()->channel && auth()->user()->channel->status !== null)
                           <li>
                              <a href="{{ route('channels.index') }}">
                              {{ __('My Channel') }}
                              </a>
                           </li>
                           <li>
                              <a href="{{ url('partners/profile') }}">
                              {{ __('Channel Manager') }}
                              </a>
                           </li>
                           @endif
                           <li>
                              <form class="from_logout" method="POST" action="{{ route('logout') }}">
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
            </ul>
            @endauth
         </div>
      </div>
      <!-- End .header-center -->
      <!-- End .container -->
   </div>
   <!-- End .header-bottom -->
</header>
<!-- End .header -->