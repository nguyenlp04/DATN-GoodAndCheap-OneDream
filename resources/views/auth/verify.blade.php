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
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Register Basic - Pages | OneDream Dashboard</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset("/../admin/assets/img/favicon/favicon.ico") }}" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="{{ asset("/../admin/assets/vendor/fonts/boxicons.css") }}" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset("/../admin/assets/vendor/css/core.css") }}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{ asset("/../admin/assets/vendor/css/theme-default.css") }}" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{ asset("/../admin/assets/css/demo.css") }}" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{ asset("/../admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css") }}" />

  <!-- Page CSS -->
  <!-- Page -->
  <link rel="stylesheet" href="{{ asset("/../admin/assets/vendor/css/pages/page-auth.css") }}" />
  <!-- Helpers -->
  <script src="{{ asset("/../admin/assets/vendor/js/helpers.js") }}"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="{{ asset("/../admin/assets/js/config.js") }}"></script>
</head>

<body>


  <!-- ?PROD Only: Google Tag Manager (noscript) (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DDHKGP" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <!-- Content -->

  <div class="authentication-wrapper authentication-basic px-4">
    <div class="authentication-inner">
      <!--  Two Steps Verification -->
      <div class="card px-sm-6 px-0">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <a href="{{ url("/") }}" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">
                <img src="{{ asset('assets/images/demos/demo-4/logo.png') }}" alt="Molla Logo" width="150">
              </span>
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-1">Two Step Verification 💬</h4>
          <p class="text-start mb-2">
            We sent a verification code to your mobile. Enter the code from the mobile in the field below.
            <span class=" d-block fw-bold text-heading">{{ session('email') }}</span>
          </p>
          @if(session('error'))
          <p style="color:red">{{ session('error') }}</p>
          @endif
          <p class="mb-0">Type your 6 digit security code</p>
          <form action="{{ route('verification.verify') }}" method="POST">
            @csrf
            <div class="mb-6">
              <div class="auth-input-wrapper numeral-mask-wrapper">
                <input type="hidden" name="email" value="{{ session('email') }}">
                <div class="form-group">
                  <input type="text" class="form-control mt-2" name="code" required>
                </div>
              </div>
              <!-- Create a hidden field which is combined by 3 fields above -->
              <input type="hidden" name="otp" />
            </div>
            <button type="submit" class="btn btn-primary d-grid w-100 mb-6">
              Verify my account
            </button>
            <!-- <div class="text-center">Didn't get the code?
              <a href="javascript:void(0);">
                Resend
              </a>
            </div> -->
          </form>
        </div>
      </div>
      <!-- / Two Steps Verification -->
    </div>
  </div>
  <!-- / Content -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->

  <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/jquery/jquery.js"></script>
  <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/popper/popper.js"></script>
  <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/js/bootstrap.js"></script>
  <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/hammer/hammer.js"></script>
  <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/i18n/i18n.js"></script>
  <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/typeahead-js/typeahead.js"></script>
  <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/js/menu.js"></script>

  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/cleavejs/cleave.js"></script>
  <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/@form-validation/popular.js"></script>
  <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/@form-validation/bootstrap5.js"></script>
  <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/@form-validation/auto-focus.js"></script>

  <!-- Main JS -->
  <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/js/main.js"></script>


  <!-- Page JS -->
  <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/js/pages-auth.js"></script>
  <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/js/pages-auth-two-steps.js"></script>

</body>

</html>

<!-- beautify ignore:end -->