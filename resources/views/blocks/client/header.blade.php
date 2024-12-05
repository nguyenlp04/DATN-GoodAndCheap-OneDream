<style>
   .text-ellipsis {
      display: -webkit-box;
      -webkit-line-clamp: 2;
      /* Số lượng hàng hiển thị */
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-overflow: ellipsis;


      line-height: 1.5em;
      /* Chiều cao dòng */
   }


   .main-nav {
      width: 90%;
      white-space: nowrap;
      overflow: hidden;
      box-sizing: border-box;
   }

   .main-nav span {
      display: inline-block;
      padding-left: 100%;
      animation: marquee 10s linear infinite;
   }

   @keyframes marquee {
      from {
         transform: translate(0, 0);

      }

      to {
         transform: translate(-100%, 0);
      }
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
               <a href="{{ route('home') }}" class="logo">
                  <img src="{{ $setting->logo ? asset($setting->logo) : asset('assets/images/demos/demo-4/logo.png') }}" alt="Molla Logo" class="d-none d-sm-block" width="150" height="30">
                  <img src="{{ $setting->logo ? asset($setting->logo) : asset('assets/images/demos/demo-4/logo.png') }}" alt="Molla Logo Mobile" class="d-block d-sm-none" width="100" height="35">
               </a>
            </div>
            <!-- End .header-left -->
            <div class="header-center">
               <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
                  <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>

                  {{-- <form action="{{ route('products.search') }}" method="GET">
                  <div class="input-group">
                     <input type="text" name="keyword" placeholder="Search products..." class="form-control" autofocus>
                     <button type="submit" class="btn btn-primary">Search</button>
                  </div>
                  </form> --}}
                  <form action="{{ route('search') }}" method="GET">
                     <div class="header-search-wrapper search-wrapper-wide">
                        <label for="q" class="sr-only">Search</label>
                        <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                        <input type="search" class="form-control" name="keyword" id="keyword" value="{{ request()->get('keyword') }}"
                           placeholder="Search product ..." autofocus>
                        <!-- Hidden inputs to retain filter values -->
                        <input type="hidden" name="address" value="{{ request()->get('address') }}">
                        <input type="hidden" name="category" value="{{ request()->get('category') }}">
                     </div>
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
            <span>Welcome to Good & Cheap website wish you a great career</span>
         </nav>
         <!-- End .main-nav -->
      </div>
      <div class="header-right">
         <div class="row">
            @guest
            <ul class="menu sf-arrows">
               <li class="megamenu-container active">
                  <a href="{{ route("home")}}" class=""><i class="fa-solid fa-house"></i>Home</a>
               </li>



               <li>
                  <a href="{{route('blogs.listting')}}" class=""><i class="fa-solid fa-pen-nib"></i>Blog</a>
               </li>
               <li>

                  <a href="{{route('contact')}}" class=""><i class="fa-solid fa-star"></i>Contact</a>
               </li>  
            
                   


            </ul>
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
               <li class="megamenu-container active">
                  <a href="{{ route("home") }}" class=""><i class="fa-solid fa-house"></i>Home</a>
               </li>

               <li>
                  <a href="{{route('blogs.listting')}}" class=""><i class="fa-solid fa-pen-nib"></i>Blog</a>
               </li>
               
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
                           <li>
                              <a href="{{ route('sl.index') }}">
                                 {{ __('Salenews Status') }}
                              </a>
                           </li>
                           <li>
                              <a href="{{ route('user.transaction_history') }}">
                                 {{ __('Transaction History') }}
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