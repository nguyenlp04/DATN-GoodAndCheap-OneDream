<footer class="footer">
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="widget widget-about">
                        @if(!empty($setting->logo))
                        <img src="{{ asset($setting->logo) }}" class="footer-logo" alt="Footer Logo" width="105"
                            height="25">
                        @else
                        <img src="assets/images/logo.png" class="footer-logo" alt="Footer Logo" width="105" height="25">
                        @endif
                        <p>We provide an easy-to-use platform where you can easily list your
                            used items for sale or search for items that suit your needs. </p>
                        <div class="social-icons">
                            <!-- <a href="#" class="social-icon" target="_blank" title="Facebook">login</a> -->
                            @if($setting->facebook_link)
                            <a href="{{ $setting->facebook_link }}" class="social-icon" target="_blank" title="Facebook">
                                <i class="icon-facebook"></i>
                            </a>
                            @endif

                            @if($setting->instagram_link)
                            <a href="{{ $setting->instagram_link }}" class="social-icon" target="_blank" title="Instagram">
                                <i class="icon-instagram"></i>
                            </a>
                            @endif

                            @if($setting->twitter_link)
                            <a href="{{ $setting->twitter_link }}" class="social-icon" target="_blank" title="Twitter">
                                <i class="icon-twitter"></i>
                            </a>
                            @endif

                            @if($setting->youtube_link)
                            <a href="{{ $setting->youtube_link }}" class="social-icon" target="_blank" title="YouTube">
                                <i class="icon-youtube"></i>
                            </a>
                            @endif

                        </div><!-- End .soial-icons -->
                    </div><!-- End .widget about-widget -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">Useful Links</h4><!-- End .widget-title -->

                        <ul class="widget-list">
                            <li><a href="about.html">About</a></li>
                            <!-- <li><a href="#">How to shop on Molla</a></li> -->
                            <li><a href="#">FAQ</a></li>
                            <li><a href="contact.html">Contact us</a></li>
                            <li><a href="login.html">Log in</a></li>
                        </ul><!-- End .widget-list -->
                    </div><!-- End .widget -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">Customer Service</h4><!-- End .widget-title -->

                        <ul class="widget-list">
                            <li><a href="#">Payment Methods</a></li>
                            <li><a href="#">Return Policy</a></li>
                            <li><a href="#">Terms and Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Buying and Selling Guide</a></li>
                        </ul><!-- End .widget-list -->

                    </div><!-- End .widget -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">My Account</h4><!-- End .widget-title -->

                        <ul class="widget-list">
                            <li><a href="#">Sign In</a></li>
                            <li><a href="cart.html">Home</a></li>
                            <li><a href="#">My Wishlist</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul><!-- End .widget-list -->
                    </div><!-- End .widget -->
                </div><!-- End .col-sm-6 col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .footer-middle -->

    <div class="footer-bottom">
        <div class="container">
            <p class="footer-copyright">Copyright © 2024 One Dream Store. All Rights Reserved.</p>
            <!-- End .footer-copyright -->
            <figure class="footer-payments">
                <img src="assets/images/payments.png" alt="Payment methods" width="272" height="20">
            </figure><!-- End .footer-payments -->
        </div><!-- End .container -->
    </div><!-- End .footer-bottom -->
</footer><!-- End .footer -->
</div><!-- End .page-wrapper -->
<button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

<!-- Mobile Menu -->
<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

<div class="mobile-menu-container mobile-menu-light">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-close"></i></span>

        <form action="{{ route('search') }}" method="GET" class="mobile-search">
            <label for="mobile-search" class="sr-only">Search</label>
            <input type="search" class="form-control" name="keyword" id="mobile-search" placeholder="Search in..." value="{{ request()->get('keyword') }}" >
            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
            <input type="hidden" name="address" value="{{ request()->get('address') }}">
            <input type="hidden" name="category" value="{{ request()->get('category') }}">
            <input type="hidden" name="minPrice" value="{{ request()->get('minPrice') }}">
            <input type="hidden" name="maxPrice" value="{{ request()->get('maxPrice') }}">
        </form>
        {{-- <div class="pb-2 bg-body-tertiary d-flex justify-content-start" style="padding: 0.8rem 1.5rem"> --}}

        @auth
        <ul class="list-group list-group-flush px-2">
            <li class="list-group-item d-flex  rounded-3 p-2">
                <img src="{{ Auth::user()->image_user ? asset(Auth::user()->image_user) : 'https://i.pinimg.com/originals/c6/e5/65/c6e56503cfdd87da299f72dc416023d4.jpg' }}" class="rounded-circle" width="40px" style="height:40px ;object-fit: cover;" alt="">
                <div class="px-3">
                    <h6 style="font-size: 1.3rem;margin-bottom: 0.4rem;">{{ Auth::user()->full_name}}</h6>
                    <p class="small text-muted pt-0">
                        <i class="fa-regular fa-face-smile" style="color: #74C0FC;"></i> Congratulations on having a great experience
                    </p>
                </div>
            </li>
        </ul>
        @endauth

        <ul class="nav nav-pills-mobile nav-border-anim" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab" role="tab" aria-controls="mobile-menu-tab" aria-selected="true">Menu</a>
            </li>
            @auth

            <li class="nav-item">
                <a class="nav-link" id="mobile-cats-link" data-toggle="tab" href="#mobile-cats-tab" role="tab" aria-controls="mobile-cats-tab" aria-selected="false">Profile</a>
            </li>
            @endauth
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade active show" id="mobile-menu-tab" role="tabpanel" aria-labelledby="mobile-menu-link">
                <nav class="mobile-nav">
                    <ul class="mobile-menu">
                        <li class="active">
                            <a href="{{ route("home") }}">Home<span></span></a>
                        </li>
                        <li class="active">
                            <a href="{{route('blogs.listting')}}">Blog<span></span></a>
                        </li>
                        <li class="active">
                            <a href="{{route('blogs.listting')}}">Contact<span></span></a>
                        </li>

                    </ul>
                </nav><!-- End .mobile-nav -->
            </div><!-- .End .tab-pane -->
            @auth
            <div class="tab-pane fade" id="mobile-cats-tab" role="tabpanel" aria-labelledby="mobile-cats-link">
                <nav class="mobile-cats-nav">
                    <ul class="mobile-cats-menu">

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
                        @auth
                        @if (!optional(auth()->user()->channel) || optional(auth()->user()->channel)->status === null)
                        <li>
                            <a class="mobile-cats-lead" href="{{ url('channels/create') }}">
                                {{ __('Upgrade Account') }}
                            </a>
                        </li>
                        @endif

                        @if (optional(auth()->user()->channel)->status !== null)
                        <li>
                            <a class="mobile-cats-lead" href="{{ route('channels.index') }}">
                                {{ __('My Channel') }}
                            </a>
                        </li>
                        <li>
                            <a class="mobile-cats-lead" href="{{ url('partners/profile') }}">
                                {{ __('Channel Manager') }}
                            </a>
                        </li>
                        <li>
                            <a class="mobile-cats-lead" href="{{ url('/salenews-status') }}">
                                {{ __('Sale News') }}
                            </a>
                        </li>
                        @endif
                        @endauth

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a style="color: #666; font-weight: normal;" class="mobile-cats-lead" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </li>
                        {{-- <li><a class="mobile-cats-lead" href="#"></a></li>
                            <li><a class="mobile-cats-lead" href="#">Gift Ideas</a></li> --}}

                    </ul><!-- End .mobile-cats-menu -->
                </nav><!-- End .mobile-cats-nav -->
            </div><!-- .End .tab-pane -->
            @endauth
        </div><!-- End .tab-content -->

        <div class="social-icons">
            <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
        </div><!-- End .social-icons -->
    </div><!-- End .mobile-menu-wrapper -->
</div>
<!-- Sign in / Register Modal -->
<div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-close"></i></span>
                </button>

                <div class="form-box">
                    <div class="form-tab">
                        <ul class="nav nav-pills nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin"
                                    role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab"
                                    aria-controls="register" aria-selected="false">Register</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="tab-content-5">
                            <div class="tab-pane fade show active" id="signin" role="tabpanel"
                                aria-labelledby="signin-tab">
                                <form action="#">
                                    <div class="form-group">
                                        <label for="singin-email">Username or email address *</label>
                                        <input type="text" class="form-control" id="singin-email"
                                            name="singin-email" required>
                                    </div><!-- End .form-group -->

                                    <div class="form-group">
                                        <label for="singin-password">Password *</label>
                                        <input type="password" class="form-control" id="singin-password"
                                            name="singin-password" required>
                                    </div><!-- End .form-group -->

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>LOG IN</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                id="signin-remember">
                                            <label class="custom-control-label" for="signin-remember">Remember
                                                Me</label>
                                        </div><!-- End .custom-checkbox -->

                                        <a href="#" class="forgot-link">Forgot Your Password?</a>
                                    </div><!-- End .form-footer -->
                                </form>
                                <div class="form-choice">
                                    <p class="text-center">or sign in with</p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-login btn-g">
                                                <i class="icon-google"></i>
                                                Login With Google
                                            </a>
                                        </div><!-- End .col-6 -->
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-login btn-f">
                                                <i class="icon-facebook-f"></i>
                                                Login With Facebook
                                            </a>
                                        </div><!-- End .col-6 -->
                                    </div><!-- End .row -->
                                </div><!-- End .form-choice -->
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                <form action="#">
                                    <div class="form-group">
                                        <label for="register-email">Your email address *</label>
                                        <input type="email" class="form-control" id="register-email"
                                            name="register-email" required>
                                    </div><!-- End .form-group -->

                                    <div class="form-group">
                                        <label for="register-password">Password *</label>
                                        <input type="password" class="form-control" id="register-password"
                                            name="register-password" required>
                                    </div><!-- End .form-group -->

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>SIGN UP</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="register-policy"
                                                required>
                                            <label class="custom-control-label" for="register-policy">I agree to the
                                                <a href="#">privacy policy</a> *</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .form-footer -->
                                </form>
                                <div class="form-choice">
                                    <p class="text-center">or sign in with</p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-login btn-g">
                                                <i class="icon-google"></i>
                                                Login With Google
                                            </a>
                                        </div><!-- End .col-6 -->
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-login  btn-f">
                                                <i class="icon-facebook-f"></i>
                                                Login With Facebook
                                            </a>
                                        </div><!-- End .col-6 -->
                                    </div><!-- End .row -->
                                </div><!-- End .form-choice -->
                            </div><!-- .End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div><!-- End .form-tab -->
                </div><!-- End .form-box -->
            </div><!-- End .modal-body -->
        </div><!-- End .modal-content -->
    </div><!-- End .modal-dialog -->
</div><!-- End .modal -->