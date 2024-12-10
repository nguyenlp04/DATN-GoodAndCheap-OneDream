<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
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
  <title>@yield('title', 'Dashboard')</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  <meta name="description" content="" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('/../admin/assets/img/favicon/favicon.ico') }}" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />
  <script src="https://kit.fontawesome.com/aa64dc9752.js" crossorigin="anonymous"></script>


  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="{{ asset('/../admin/assets/vendor/fonts/boxicons.css') }}" />
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.0/dist/sweetalert2.min.css" rel="stylesheet">
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
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
            <a href="{{ route('home') }}" class="logo">
              <img src="{{ $setting->logo ? asset($setting->logo) : asset('assets/images/demos/demo-4/logo.png') }}"
                  alt="Molla Logo" class="d-none d-sm-block" width="150" height="40">
              <img src="{{ $setting->logo ? asset($setting->logo) : asset('assets/images/demos/demo-4/logo.png') }}"
                  alt="Molla Logo Mobile" class="d-block d-sm-none" width="130" height="40">
          </a>

          <a href="{{ url('javascript:void(0);') }}" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
          <!-- Dashboard -->
          <li class="menu-item {{ Request::is('partners/dashboard') ? 'active' : '' }}">
            <a href="{{ url('partners') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div data-i18n="Analytics">Dashboard</div>
            </a>
          </li>

          <!-- Product Management -->
          <li class="menu-item {{ Request::is('partners/sale-news/*') || Request::is('partners/sale-news') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-layout"></i>
              <div data-i18n="Product Management">Sale News Management</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item {{ Request::is('partners/sale-news') ? 'active' : '' }}">
                <a href="{{ url('partners/sale-news') }}" class="menu-link">
                  <div data-i18n="Hide Product">Sale News</div>
                </a>
              </li>
              <li class="menu-item {{ Request::is('partners/sale-news/add') ? 'active' : '' }}">
                <a href="{{ url('partners/sale-news/add') }}" class="menu-link">
                  <div data-i18n="Approve Product">Add Sale News</div>
                </a>
              </li>
            </ul>
          </li>

          <li class="menu-item {{ Request::is('Partners/*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx-user bx"></i>
              <div data-i18n="Payment Management">Infomation</div>
            </a>

            <ul class="menu-sub">
              <li class="menu-item {{ Request::is('Partners/infomation') ? 'active' : '' }}">
                <a href="{{ route('partners.infomation') }}" class="menu-link">
                  <div data-i18n="Payment Method">Channel Infomation</div>
                </a>
              </li>
              <li class="menu-item {{ Request::is('Partners/infomation') ? 'active' : '' }}">
                <a href="{{ url('partners/infomation/create') }}" class="menu-link">
                  <div data-i18n="Payment Method">Add Infomation</div>
                </a>
              </li>

            </ul>
          </li>
          
          <li class="menu-item {{ Request::is('notification/*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-bell"></i>
              <div data-i18n="Payment Management">Notification</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item {{ Request::is('notification/') ? 'active' : '' }}">
                <a href="{{ route('list_notification') }}" class="menu-link">
                  <div data-i18n="Payment Method">List Notification</div>
                </a>
              </li>
            </ul>
          </li>
         
        </ul>
      </aside>
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

                    <img src="{{ asset(auth()->user()->channel->image_channel) }}" alt class="w-px-40 h-40 rounded-circle" />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="{{ url('#') }}">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar avatar-online">
                            <img src="{{ asset(auth()->user()->channel->image_channel) }}" alt class="w-px-40 h-40 rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <span class="fw-semibold d-block">{{ auth()->user()->channel->name_channel }}</span>
                          <small class="text-muted">Partner</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ url('partners/profile') }}">
                      <i class="bx bx-user me-2"></i>
                      <span class="align-middle">My Profile</span>
                    </a>
                  </li>
                  
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                      @csrf
                      <button type="submit" class="dropdown-item" style="border: none; background: none; ">
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
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->



    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('/../admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/../admin/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('/../admin/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/../admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('/../admin/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('/../admin/assets/js/main.js') }}"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    @include('layouts.script-admin')

</body>

</html>
