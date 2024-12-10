<!DOCTYPE html>

<!-- =========================================================
* OneDream Dashboard | v1.0.0
==============================================================

* Product Page: https://OneDream.com/products/sneat-bootstrap-html-admin-template/
* Created by: OneDream
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright OneDream (https://OneDream.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />

  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ $title ?? $setting->site_name ?? 'Good & Cheap' }} Dashboard</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ $setting->favicon ? asset($setting->favicon) : 'assets/images/web/favicon.png' }}" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

  <script src="https://kit.fontawesome.com/aa64dc9752.js" crossorigin="anonymous"></script>


  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="{{ asset('/../admin/assets/vendor/fonts/boxicons.css') }}" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('/../admin/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{ asset('/../admin/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{ asset('/../admin/assets/css/demo.css') }}" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{ asset('/../admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="{{ asset('/../admin/assets/vendor/js/helpers.js') }}"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="{{ asset('/../admin/assets/js/config.js') }}"></script>
</head>

<body>
  <?php

  use App\Models\SaleNews;

  $count = SaleNews::where('approved', 0)->count(); // Đếm số lượng bản ghi thay vì lấy Collection
  ?>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="{{ url('dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
              <img src="{{ asset($setting->logo) }}" alt="" style="width: 150px; height: auto;">
            </span>
            <!-- <span class="app-brand-text demo menu-text fw-bolder ms-2">{{$setting->site_name}}</span> -->

          </a>

          <a href="{{ url('javascript:void(0);') }}" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
          <!-- Dashboard -->
          <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="{{ url('dashboard') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div data-i18n="Analytics">Dashboard</div>
            </a>
          </li>

          <!-- Sale News Management -->
          {{-- <li class="menu-item {{ Request::is('sale-news/*') || Request::is('sale-news') ? 'active open' : '' }}">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-layout"></i>
            <div data-i18n="sale-news Management">Sale News Management</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item {{ Request::is('sale-news') ? 'active' : '' }}">
              <a href="{{ url('sale-news/') }}" class="menu-link">
                <div data-i18n="Hide sale-news">Sale News</div>
              </a>
            </li>
            {{-- <li class="menu-item {{ Request::is('sale-news/add') ? 'active' : '' }}">
            <a href="{{ url('sale-news/add') }}" class="menu-link">
              <div data-i18n="Add sale-news">Add Sale News</div>
            </a>
            </li> --}}
            <!-- <li class="menu-item {{ Request::is('category') ? 'active' : '' }}">
                        <a href="{{ url('category') }}" class="menu-link">
                            <div data-i18n="Add Category">Add Category</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::is('sale-news/approve') ? 'active' : '' }}">
                        <a href="{{ url('sale-news/approve') }}" class="menu-link">
                            <div data-i18n="Approve sale-news">Approve Sale News (affiliate)</div>
                        </a>
                    </li>
                </ul>
            </li> --}}


            <!-- Category Management -->
            <li class="menu-item {{ Request::is('category/*') || Request::is('category') ? 'active open' : '' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Product Management">Category Management</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item {{ Request::is('category') ? 'active' : '' }}">
                  <a href="{{ url('category/') }}" class="menu-link">
                    <div data-i18n="Hide Product">Category</div>
                  </a>
                </li>
                <li class="menu-item {{ Request::is('category/add') ? 'active' : '' }}">
                  <a href="{{ url('category/add') }}" class="menu-link">
                    <div data-i18n="Add Product">Add Category</div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item {{ Request::is('channel/*') || Request::is('channel') ? 'active open' : '' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-store"></i>
                <div data-i18n="Product Management">Channel Management</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item {{ Request::is('channel') ? 'active' : '' }}">
                  <a href="{{ url('channel') }}" class="menu-link">
                    <div data-i18n="Hide Product">List Channel</div>
                  </a>
                </li>
              </ul>
            </li>



            <!-- Account Management -->
            <li class="menu-item {{ Request::is('account/*') ? 'active open' : '' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-user-account"></i>
                <div data-i18n="Account Management">Account</div>
              </a>
              <ul class="menu-sub">
                @if (Auth::guard('staff')->user()->role == 'admin')
                <li class="menu-item {{ Request::is('account/employee-management/*') || Request::is('account/employee-management') ? 'active' : '' }}">
                  <a href="{{ url('account/employee-management') }}" class="menu-link">
                    <div data-i18n="Add Affiliate Account">Staff Management</div>
                  </a>
                </li>
                @endif
                <li class="menu-item {{ Request::is('account/user-account-management') ? 'active' : '' }}">
                  <a href="{{ url('account/user-account-management') }}" class="menu-link">
                    <div data-i18n="Confirm Partner">User Management</div>
                  </a>
                </li>

              </ul>
            </li>

            <!-- Blogs -->
            <li class="menu-item {{ Request::is('blogs/*') || Request::is('blogs') ? 'active open' : '' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxl-blogger"></i>
                <div data-i18n="Analytics">Blog </div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item {{ Request::is('blogs') ? 'active' : '' }}">
                  <a href="{{ url('/blogs') }}" class="menu-link">
                    <div data-i18n="Blogs">Blogs List</div>
                  </a>
                </li>
                <li class="menu-item {{ Request::is('blogs/add') ? 'active' : '' }}">
                  <a href="{{ url('/blogs/add') }}" class="menu-link">
                    <div data-i18n="Add blogs">Add Blogs</div>
                  </a>
                </li>

              </ul>


            </li>
            {{-- <li class="menu-item {{ Request::is('sale_news') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bxl-blogger"></i>
              <div data-i18n="Analytics">Sale new </div>
              @if ($count > 0)
              <!-- Chỉ hiển thị nếu không ở trang con -->
              <div class="position-absolute top-50 start-50 translate-middle text-center bg-danger d-inline-block rounded-circle"
                style="width: 17px; height: 17px; margin-left: 50px;">
                <span class="text-white d-flex justify-content-center align-items-center"
                  style="line-height: 17px; font-size: 10px;">!</span>
              </div>
              @endif
            </a>
            <ul class="menu-sub">
              <li class="menu-item {{ Request::is('/sale_news') ? 'active' : '' }}">
                <a href="{{ url('/sale_news') }}" class="menu-link">
                  <div data-i18n="Blogs">Sale News </div>
                  @if ($count > 0)
                  <!-- Hiển thị trong trang con nếu có -->
                  <div class="position-absolute top-50 start-50 translate-middle text-center bg-danger d-inline-block rounded-circle"
                    style="width: 17px; height: 17px; margin-left: 50px;">
                    <span class="text-white d-flex justify-content-center align-items-center"
                      style="line-height: 17px; font-size: 10px;">!</span>
                  </div>
                  @endif
                </a>
              </li>
            </ul>
            </li> --}}



            <li class="menu-item {{ Request::is('sale_news') ? 'active' : '' }}">
              <a href="{{ url('sale_news') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div data-i18n="Blogs">Sale News </div>
                @if ($count > 0)
                <!-- Hiển thị trong trang con nếu có -->
                <div class="position-absolute top-50 start-50 translate-middle text-center bg-danger d-inline-block rounded-circle"
                  style="width: 17px; height: 17px; margin-left: 50px;">
                  <span class="text-white d-flex justify-content-center align-items-center"
                    style="line-height: 17px; font-size: 10px;">!</span>
                </div>
                @endif
              </a>
            </li>



            <!-- Notification -->
            <li class="menu-item {{ Request::is('notifications/*') || Request::is('notifications') ? 'active open' : '' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-bell"></i>
                <div data-i18n="Analytics">Notification</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item {{ Request::is('notifications') ? 'active' : '' }}">
                  <a href="{{ url('notifications') }}" class="menu-link">
                    <div data-i18n="Notifications">Notifications List</div>
                  </a>
                </li>
                <li class="menu-item {{ Request::is('notifications/create') ? 'active' : '' }}">
                  <a href="{{ url('notifications/create') }}" class="menu-link">
                    <div data-i18n="Add notifications">Add notifications</div>
                  </a>
                </li>

                {{-- <li class="menu-item {{ Request::is ('notifications/trashed') ? 'active' : '' }}">
                <a href="{{ url('/notifications/trashed') }}" class="menu-link">
                  <div data-i18n="Trash notifications">Trash notifications</div>
                </a>
            </li> --}}
          </ul>
          </li>



          <!-- Payment -->

          <li class="menu-item {{ Request::is('payment/transactions') ? 'active' : '' }}">
            <a href="{{ url('payment/transactions') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bxl-paypal"></i>
              <div data-i18n="Analytics">Transactions</div>
            </a>
          </li>

          <li class="menu-item {{ Request::is('vip-packages') ? 'active' : '' }}">
            <a href="{{ url('vip-packages') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-crown"></i>
              <div data-i18n="Analytics">Vip Package</div>
            </a>
          </li>




          <!-- Trash -->
           @if (Auth::guard('staff')->user()->role == 'admin')
          <li class="menu-item {{ Request::is('trash/*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-trash"></i>
              <div data-i18n="Trash">Trash</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item {{ Request::is('trash/trash-sale-news') ? 'active' : '' }}">
                <a href="{{ route('trash.salenews') }}" class="menu-link">
                  <div data-i18n="Trash Sale News">Sale News</div>
                </a>
              </li>
              {{-- <li class="menu-item {{ Request::is('trash/channel') ? 'active' : '' }}">
                <a href="{{ url('trash/channel') }}" class="menu-link">
                  <div data-i18n="Trash Channel">Channel</div>
                </a>
              </li> --}}
              <li class="menu-item {{ Request::is('trash/trash-categories') ? 'active' : '' }}">
                <a href="{{ route('trash.category') }}" class="menu-link">
                  <div data-i18n="Trash Category">Category</div>
                </a>
              </li>
              <li class="menu-item {{ Request::is('trash/trash-blog') ? 'active' : '' }}">
                <a href="{{ route('trash.blog') }}" class="menu-link">
                  <div data-i18n="Trash Blog">Blog</div>
                </a>
              </li>
              @endif

            </ul>
          </li>


          @if (Auth::guard('staff')->user()->role == 'admin')
          <!-- Config -->
          <li class="menu-item {{ Request::is('config/*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              {{-- <i class="menu-icon tf-icons bx bx-trash"></i> --}}
              <i class="menu-icon fa-solid fa-gears"></i>
              <div data-i18n="Config">Config</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item {{ Request::is('config/telegram') ? 'active' : '' }}">
                <a href="{{ url('config/telegram') }}" class="menu-link">
                  <div data-i18n="Config Bot Telegram">Telegram</div>
                </a>
              </li>
              <li class="menu-item {{ Request::is('config/vnpay') ? 'active' : '' }}">
                <a href="{{ url('config/vnpay') }}" class="menu-link">
                  <div data-i18n="Config VNPAY">VNPAY</div>
                </a>
              </li>
              <li class="menu-item {{ Request::is('config/seo') ? 'active' : '' }}">
                <a href="{{ url('config/seo') }}" class="menu-link">
                  <div data-i18n="Config SEO">SEO</div>
                </a>
              </li>
              <li class="menu-item {{ Request::is('config/mail') ? 'active' : '' }}">
                <a href="{{ url('config/mail') }}" class="menu-link">
                  <div data-i18n="Config Category">Mail</div>
                </a>
              </li>
            </ul>
          </li>

          <li class="menu-header small text-uppercase"><span class="menu-header-text"></span></li>
          @endif



        </ul>
      </aside>
      <!-- / Menu -->

      <div class="layout-page">
        <!-- Navbar -->

        <nav
          class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
          id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="{{ url('javascript:void(0)') }}">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
              <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input
                  type="text"
                  class="form-control border-0 shadow-none"
                  placeholder="Search..."
                  aria-label="Search..." />
              </div>
            </div>
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <!-- Place this tag where you want the button to render. -->


              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="{{ url('javascript:void(0);') }}" data-bs-toggle="dropdown">
                  <div class="avatar avatar-online">
                    <img src="{{ Auth::guard('staff')->user()->avata ? asset(Auth::guard('staff')->user()->avata) : asset('/admin/assets/img/avatars/1.png') }}"
                      alt class=" w-px-40 h-px-40 rounded-circle" style="object-fit: cover;" />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="{{ url('#') }}">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar avatar-online">
                            <img src="{{ Auth::guard('staff')->user()->avata ? asset(Auth::guard('staff')->user()->avata) : asset('/admin/assets/img/avatars/1.png') }}"
                              alt class="w-px-40 h-px-40 rounded-circle" style="object-fit: cover;" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <span class="fw-semibold d-block">{{ Auth::guard('staff')->user()->full_name }}</span>
                          <small class="text-muted">{{ Auth::guard('staff')->user()->role }}</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ url('manage-profile') }}">
                      <i class="bx bx-user me-2"></i>
                      <span class="align-middle">My Profile</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ url('setting') }}">
                      <i class="bx bx-cog me-2"></i>
                      <span class="align-middle">Settings</span>
                    </a>
                  </li>

                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <form action="{{ route('staff.logout') }}" method="POST" style="display: inline;">
                      @csrf
                      <button type="submit" class="dropdown-item">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </button>
                    </form>
                  </li>

                </ul>
              </li>
              <!--/ User -->
            </ul>
          </div>
        </nav>
        <!-- Layout container -->
        @yield('content')
        @yield('script-link-css')

        <!-- / Layout page -->
        <!-- Footer -->
        <footer class="content-footer footer bg-footer-theme">
          <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
            <div class="mb-2 mb-md-0">
              ©
              <script>
                document.write(new Date().getFullYear());
              </script>
              , made with ❤️ by
              <a href="https://OneDream.com" target="_blank" class="footer-link fw-bolder">OneDream</a>
            </div>

          </div>
           
        </footer>
        <!-- / Footer -->
      </div>
    </div>

    <!-- Overlay -->
    @include('layouts.script-admin')
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <!-- / Layout wrapper -->



  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="{{ asset('/../admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('/../admin/assets/vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('/../admin/assets/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('/../admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <!-- <script src="{{ asset('admin/assets/js/ckeditor.js') }}"></script> -->

  <script src="{{ asset('/../admin/assets/vendor/js/menu.js') }}"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->

  <!-- Main JS -->


  <script src="{{ asset('/../admin/assets/js/main.js') }}"></script>


  <!-- Page JS -->

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
