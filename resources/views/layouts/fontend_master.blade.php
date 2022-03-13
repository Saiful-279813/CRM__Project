{{-- pphp --}}
  @php
    $category = App\Models\Category::with('product')->orderBy('id','DESC')->limit(5)->get();
    $setting = App\Models\Setting::where('id',1)->first();
  @endphp
{{-- php --}}
<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Sowaq Ecommerce</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset($setting->fav_icon) }}">

        <!-- Template CSS -->
        <link rel="stylesheet" href="{{ asset('contents/fontend') }}/assets/css/plugins/animate.min.css">
        <link rel="stylesheet" href="{{ asset('contents/fontend') }}/assets/css/plugins/slider-range.css">
        <link href="{{asset('contents/admin')}}/assets/css/all.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('contents/fontend') }}/assets/css/main.css?v=4.1">
        <link rel="stylesheet" href="{{asset('contents/common')}}/css/toastr.min.css">
        <link rel="stylesheet" href="{{ asset('contents/fontend') }}/assets/css/custom.css">
        @yield('styles')
        @yield('parsley-css')
        {{-- sytle --}}
        <style media="screen">
          a.active{
            color: #3BB77E !important;
            font-weight: 700;
          }
        </style>
    </head>
    <body>
        <!-- Quick view -->
        <div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body">
                        <div class="row" id="productQuickViewInModal"></div>
                    </div>
                </div>
            </div>
        </div>

        <header class="header-area header-style-1 header-height-2">
            <div class="mobile-promotion">
                <span>Grand opening, <strong>up to 15%</strong> off all items. Only <strong>3 days</strong> left</span>
            </div>
            {{-- header top --}}
            <div class="header-top header-top-ptb-1 d-none d-lg-block">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6">
                            <div class="header-info">
                                <ul>
                                    <li><a href="{{ route('about') }}">About Us</a></li>
                                    <li><a href="{{ route('wishlist') }}">Wishlist</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="header-info header-info-right">
                                <ul>
                                    <li>Need help? Call Us: <strong class="text-brand"> {{ $setting->phone }}</strong></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- header middle --}}
            <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
                <div class="container">
                    <div class="header-wrap">
                        <div class="logo logo-width-1">
                            <a href="{{ url('/') }}"><img src="{{ asset($setting->logo) }}" alt="logo"></a>
                        </div>
                        <div class="header-right">
                            <div class="search-style-2">
                                <form action="{{ route('search.product') }}" method="GET">
                                    <input type="text" placeholder="Search for items..." name="search" id="search" onfocus="showSearchResult()" onblur="hideSearchResult()">
                                    <button type="submit" name="button" class="main_search_button">
                                      <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                </form>
                                <div id="suggestProduct"></div>
                            </div>
                            <div class="header-action-right">
                                <div class="header-action-2">

                                    <div class="header-action-icon-2">
                                        <a href="{{ route('wishlist') }}">
                                            <img class="svgInject" alt="Nest" src="{{ asset('contents/fontend') }}/assets/imgs/theme/icons/icon-heart.svg">
                                            <span class="pro-count blue" id="wishQty"></span>
                                        </a>
                                        <a href="{{ route('wishlist') }}"><span class="lable">Wishlist</span></a>
                                    </div>

                                    <div class="header-action-icon-2">
                                        <a class="mini-cart-icon" href="{{ route('cart') }}">
                                            <img alt="Nest" src="{{ asset('contents/fontend') }}/assets/imgs/theme/icons/icon-cart.svg">
                                            <span class="pro-count blue" id="cartQty"></span>
                                        </a>
                                        <a href="{{ route('cart') }}"><span class="lable">Cart</span></a>
                                        <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                            <ul id="miniCartProductView"></ul>

                                            <div class="shopping-cart-footer">
                                                <div class="shopping-cart-total">
                                                    <h4>Total <span id="cartSubTotal"></span></h4>
                                                </div>
                                                <div class="shopping-cart-button">
                                                    <a href="{{ route('cart') }}" class="outline">View cart</a>
                                                    <a href="{{ route('checkout') }}">Checkout</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="header-action-icon-2">
                                        <a href="{{ route('user.dashboard') }}">
                                            <img class="svgInject" alt="Nest" src="{{ asset('contents/fontend') }}/assets/imgs/theme/icons/icon-user.svg">
                                        </a>
                                        @auth
                                          <a href="{{ route('user.dashboard') }}"><span class="lable ml-0">Account</span></a>
                                          <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                              <ul>
                                                  <li>
                                                      <a href="{{ route('user.dashboard') }}"><i class="fi fi-rs-user mr-10"></i>My Account</a>
                                                  </li>
                                                  <li>
                                                      <a href="{{ route('getWishList') }}"><i class="fi fi-rs-heart mr-10"></i>My Wishlist</a>
                                                  </li>
                                                  <li>
                                                      <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fi fi-rs-sign-out mr-10"></i>Sign out</a>
                                                  </li>
                                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                      @csrf
                                                  </form>
                                              </ul>
                                          </div>
                                        @else
                                          <a href="{{ route('login') }}"><span class="lable ml-0">Login</span></a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- header bottom --}}
            <div class="header-bottom header-bottom-bg-color sticky-bar">
                <div class="container">
                    <div class="header-wrap header-space-between position-relative">
                        <div class="logo logo-width-1 d-block d-lg-none">
                            <a href="{{ url('/') }}"><img src="{{ asset($setting->logo) }}" alt="logo"></a>
                        </div>
                        <div class="header-nav d-none d-lg-flex">
                            <div class="main-categori-wrap d-none d-lg-block">
                                <a class="categories-button-active" href="#">
                                    <span class="fi-rs-apps"></span> All Categories
                                    <i class="fi-rs-angle-down"></i>
                                </a>
                                {{-- category part --}}
                                <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                                    <div class="d-flex categori-dropdown-inner">
                                      <div class="row">
                                        @foreach ($category as $catg)
                                          <div class="col-md-6">
                                            <ul>
                                                <li>
                                                    <a href="{{ route('category-wise.product',[$catg->id,$catg->category_slug]) }}"> <img src="{{ asset($catg->category_image) }}" alt="">{{ Str::limit($catg->category_name,10) }}</a>
                                                </li>
                                            </ul>
                                          </div>
                                        @endforeach
                                      </div>



                                    </div>


                                </div>
                                {{-- category part --}}
                            </div>
                            {{-- main menu --}}
                            <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                                <nav>
                                    <ul>
                                        <li class="hot-deals"><img src="{{ asset('contents/fontend') }}/assets/imgs/theme/icons/icon-hot.svg" alt="hot deals"><a class="@yield('hot-deals')" href="{{ route('hot-deals') }}">Hot Deals</a></li>
                                        <li>
                                            <a class="@yield('home')" href="{{ url('/') }}">Home</a>
                                        </li>
                                        <li>
                                            <a class="@yield('brand')" href="{{ route('brand') }}">Brand</a>
                                        </li>
                                        <li>
                                            <a class="@yield('about')" href="{{ route('about') }}">About</a>
                                        </li>
                                        <li>
                                            <a class="@yield('shop')" href="{{ route('shop') }}">Shop</a>
                                        </li>
                                        <li>
                                            <a class="@yield('contact')" href="{{ route('contact') }}">Contact</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            {{-- main menu --}}
                        </div>
                        <div class="header-action-icon-2 d-block d-lg-none">
                            <div class="burger-icon burger-icon-white">
                                <span class="burger-icon-top"></span>
                                <span class="burger-icon-mid"></span>
                                <span class="burger-icon-bottom"></span>
                            </div>
                        </div>
                        <div class="header-action-right d-block d-lg-none">
                            <div class="header-action-2">
                                <div class="header-action-icon-2">
                                    <a href="{{ route('wishlist') }}">
                                        <img alt="Nest" src="{{ asset('contents/fontend') }}/assets/imgs/theme/icons/icon-heart.svg">
                                        <span class="pro-count white" id="wishQty2"></span>
                                    </a>
                                </div>
                                <div class="header-action-icon-2">
                                    <a class="mini-cart-icon" href="{{ route('cart') }}">
                                        <img alt="Nest" src="{{ asset('contents/fontend') }}/assets/imgs/theme/icons/icon-cart.svg">
                                        <span class="pro-count white" id="cartQty2"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="mobile-header-active mobile-header-wrapper-style">
            <div class="mobile-header-wrapper-inner">
                <div class="mobile-header-top">
                    <div class="mobile-header-logo">
                        <a href="{{ url('/') }}"><img src="{{ asset($setting->logo) }}" alt="logo"></a>
                    </div>
                    <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                        <button class="close-style search-close">
                            <i class="icon-top"></i>
                            <i class="icon-bottom"></i>
                        </button>
                    </div>
                </div>
                <div class="mobile-header-content-area">
                    <div class="mobile-search search-style-3 mobile-header-border">
                        <form action="{{ route('search.product') }}" method="GET">
                            <input type="text" placeholder="Search for items..." name="search" id="search" onfocus="showSearchResult()" onblur="hideSearchResult()">
                            <button type="submit"><i class="fi-rs-search"></i></button>
                        </form>
                        <div id="suggestProduct"></div>
                    </div>
                    <div class="mobile-menu-wrap mobile-header-border">
                        <!-- mobile menu start -->
                        <nav>
                            <ul class="mobile-menu font-heading">

                                <li class="menu-item-has-children">
                                    <a class"@yield('hot-deals')" href="{{ route('hot-deals') }}">Hot Deals</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a class="@yield('home')" href="{{ url('/') }}">Home</a>
                                </li>
                                <li>
                                    <a class="@yield('brand')" href="{{ route('brand') }}">Brand</a>
                                </li>
                                <li>
                                    <a class="@yield('about')" href="{{ route('about') }}">About</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a class="@yield('shop')" href="{{ route('shop') }}">shop</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a class="@yield('contact')" href="{{ route('contact') }}">Contact</a>
                                </li>
                            </ul>
                        </nav>
                        <!-- mobile menu end -->
                    </div>
                    <div class="mobile-header-info-wrap">
                        <div class="single-mobile-header-info">
                            <a href="{{ route('contact') }}"><i class="fi-rs-marker"></i> Our location </a>
                        </div>
                        <div class="single-mobile-header-info">
                            <a href="{{ route('login') }}"><i class="fi-rs-user"></i>Log In / Sign Up </a>
                        </div>
                        <div class="single-mobile-header-info">
                            <a href="#"><i class="fi-rs-headphones"></i>(+01) - 2345 - 6789 </a>
                        </div>
                    </div>
                    <div class="mobile-social-icon mb-50">
                        <h6 class="mb-15">Follow Us</h6>
                        <a href="#"><img src="{{ asset('contents/fontend') }}/assets/imgs/theme/icons/icon-facebook-white.svg" alt=""></a>
                        <a href="#"><img src="{{ asset('contents/fontend') }}/assets/imgs/theme/icons/icon-twitter-white.svg" alt=""></a>
                        <a href="#"><img src="{{ asset('contents/fontend') }}/assets/imgs/theme/icons/icon-instagram-white.svg" alt=""></a>
                        <a href="#"><img src="{{ asset('contents/fontend') }}/assets/imgs/theme/icons/icon-pinterest-white.svg" alt=""></a>
                        <a href="#"><img src="{{ asset('contents/fontend') }}/assets/imgs/theme/icons/icon-youtube-white.svg" alt=""></a>
                    </div>
                    <div class="site-copyright">Copyright 2021 © Nest. All rights reserved. Powered by AliThemes.</div>
                </div>
            </div>
        </div>


        <!--End header-->
        @yield('content')


        <footer class="main">
            @yield('footer_content')
            <section class="section-padding footer-mid">
                <div class="container pt-15 pb-20">
                    <div class="row">
                        <div class="col">
                            <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                                <div class="logo mb-30">
                                    <a href="{{ url('/') }}" class="mb-15"><img src="{{ asset($setting->logo) }}" alt="logo"></a>
                                    <p class="font-lg text-heading">{{ $setting->site_name }}</p>
                                </div>
                                <ul class="contact-infor">
                                    <li><img src="{{ asset('contents/fontend') }}/assets/imgs/theme/icons/icon-location.svg" alt=""><strong>Address: </strong> <span>{{ $setting->address  }}</span></li>

                                    <li><img src="{{ asset('contents/fontend') }}/assets/imgs/theme/icons/icon-contact.svg" alt=""><strong>Phone 01:</strong><span>{{ $setting->phone }}</span></li>
                                    <li><img src="{{ asset('contents/fontend') }}/assets/imgs/theme/icons/icon-contact.svg" alt=""><strong>Phone 02:</strong><span>{{ $setting->phone2 }}</span></li>

                                    <li><img src="{{ asset('contents/fontend') }}/assets/imgs/theme/icons/icon-email-2.svg" alt=""><strong>Email:</strong><span><a href="{{ $setting->email }}">{{ $setting->email }}</a></span></li>

                                    <li><img src="{{ asset('contents/fontend') }}/assets/imgs/theme/icons/icon-clock.svg" alt=""><strong>Hours:</strong><span>10:00 - 18:00, Mon - Sat</span></li>
                                </ul>
                            </div>
                        </div>

                        <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                            <h4 class="widget-title">Company</h4>
                            <ul class="footer-list mb-sm-5 mb-md-0">
                              <li><a href="{{ route('about') }}">About Us</a></li>
                              <li><a href="#">Delivery Information</a></li>
                              <li><a href="#">Privacy Policy</a></li>
                              <li><a href="#">Terms &amp; Conditions</a></li>
                              <li><a href="{{ route('contact') }}">Contact Us</a></li>
                              <li><a href="#">Support Center</a></li>
                              <li><a href="#">Careers</a></li>
                            </ul>
                        </div>
                        {{-- account --}}
                        <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                            <h4 class="widget-title">Account</h4>
                            <ul class="footer-list mb-sm-5 mb-md-0">
                                <li><a href="{{ route('register') }}">Sign Up</a></li>
                                <li><a href="{{ route('login') }}">Sign In</a></li>
                                <li><a href="{{ route('cart') }}">View Cart</a></li>
                                <li><a href="{{ route('wishlist') }}">My Wishlist</a></li>
                            </ul>
                        </div>
                        {{-- Corporate --}}
                        <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                            <h4 class="widget-title">Popular</h4>
                            <ul class="footer-list mb-sm-5 mb-md-0">
                              @php
                                $brand = App\Models\Brand::orderBy('id','DESC')->limit(6)->get();
                              @endphp
                              @foreach ($brand as $data)
                                <li><a href="{{ route('brand-wise.product',[$data->id,$data->brand_slug]) }}">{{ Str::limit($data->brand_name,17) }}</a></li>
                              @endforeach
                            </ul>
                        </div>
                </div>
            </div>
          </section>
            {{-- copywrite --}}
            <div class="container pb-30 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                <div class="row align-items-center">
                    <div class="col-12 mb-30">
                        <div class="footer-bottom"></div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 text-center">
                        <p class="font-sm mb-0">&copy; 2021, <strong class="text-brand"> Sowaq  </strong> All rights reserved. Website Design & Development Company by <strong class="text-brand"> <a href="https://softitcare.com/">Soft It Care</a> </strong> </p>
                    </div>
                </div>
            </div>
        </footer>



        <!-- Vendor JS-->
        <script src="{{ asset('contents/fontend') }}/assets/js/vendor/modernizr-3.6.0.min.js"></script>
        <script src="{{ asset('contents/fontend') }}/assets/js/vendor/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('contents/fontend') }}/assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
        <script src="{{ asset('contents/fontend') }}/assets/js/vendor/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('contents/fontend') }}/assets/js/plugins/slick.js"></script>
        <script src="{{ asset('contents/fontend') }}/assets/js/plugins/jquery.syotimer.min.js"></script>
        <script src="{{ asset('contents/fontend') }}/assets/js/plugins/waypoints.js"></script>
        <script src="{{ asset('contents/fontend') }}/assets/js/plugins/wow.js"></script>
        <script src="{{ asset('contents/fontend') }}/assets/js/plugins/slider-range.js"></script>
        <script src="{{ asset('contents/fontend') }}/assets/js/plugins/perfect-scrollbar.js"></script>
        <script src="{{ asset('contents/fontend') }}/assets/js/plugins/magnific-popup.js"></script>
        <script src="{{ asset('contents/fontend') }}/assets/js/plugins/select2.min.js"></script>
        <script src="{{ asset('contents/fontend') }}/assets/js/plugins/counterup.js"></script>
        <script src="{{ asset('contents/fontend') }}/assets/js/plugins/jquery.countdown.min.js"></script>
        <script src="{{ asset('contents/fontend') }}/assets/js/plugins/images-loaded.js"></script>
        <script src="{{ asset('contents/fontend') }}/assets/js/plugins/isotope.js"></script>
        <script src="{{ asset('contents/fontend') }}/assets/js/plugins/scrollup.js"></script>
        <script src="{{ asset('contents/fontend') }}/assets/js/plugins/jquery.vticker-min.js"></script>
        <script src="{{ asset('contents/fontend') }}/assets/js/plugins/jquery.theia.sticky.js"></script>
        <script src="{{ asset('contents/fontend') }}/assets/js/plugins/jquery.elevatezoom.js"></script>
        <script src="{{ asset('contents/fontend') }}/assets/js/sweet2.min.js"></script>
        @yield('persley_script')
        <!-- Template  JS -->
        <script src="{{ asset('contents/fontend') }}/assets/js/main.js?v=4.1"></script>
        <script src="{{ asset('contents/fontend') }}/assets/js/shop.js?v=4.1"></script>
        <script src="{{asset('contents/admin')}}/assets/js/custom.js"></script>
        {{-- toaster massage --}}
        <script src="{{asset('contents/common')}}/js/toastr.min.js"></script>
        <script>
            @if (Session::has('message'))
                var type ="{{ Session::get('alert-type', 'info') }}"
                switch(type){
                case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;

                case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;

                case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;

                case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break;
                }
            @endif

        </script>
        @yield('filtering')
        @yield('newslatter')
        {{-- toaster massage --}}
        <script type="text/javascript">
          // ajax header
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
          // ajax header
        </script>

        {{-- add to cart --}}
        <script type="text/javascript">
          /*
          =================================
          product view
          =================================
          */
          function productView(id){
            // do work
            $.ajax({
                type: 'POST',
                url: "{{ route('productQuickView') }}",
                data: { id:id },
                dataType: 'json',
                success: function(data) {
                  // ============== Do Work ====================
                  $('#productQuickViewInModal').html(`


                    <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                        <div class="detail-gallery">
                            <div class="product-image-slider">
                                <figure class="border-radius-10">
                                    <img src="${data.product_thambnail}" alt="product image">
                                </figure>
                            </div>
                        </div>
                        <!-- End Gallery -->
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="detail-info pr-30 pl-30">
                            ${data.product_qty > 0
                              ? `<span class="stock-status out-stock">Available</span>`
                              : `<span class="stock-status out-stock">Stock Out</span>`
                            }
                            <h3 class="title-detail" style="font-size:18px"><a class="text-heading">${data.product_name}</a></h3>
                            <div class="product-detail-rating">
                                <div class="product-rate-cover text-end">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                </div>
                            </div>
                            <div class="clearfix product-price-cover">
                                <div class="product-price primary-color float-left">
                                    ${data.discount_price > 0
                                      ? `<span class="current-price text-brand">৳${data.selling_price - data.discount_price}</span>
                                      <span>
                                          <span class="old-price font-md ml-15">৳${data.selling_price}</span>
                                      </span>`
                                      : `<span class="current-price text-brand">৳${data.selling_price}</span>`
                                    }

                                </div>

                            </div>
                            <div class="detail-extralink mb-30">
                                <div class="detail-qty border radius">
                                    <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                    <span class="qty-val">1</span>
                                    <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                </div>
                                <div class="product-extra-link2">
                                    <button type="submit" class="button button-add-to-cart"><i class="fi-rs-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                            <div class="font-xs">
                                <ul>
                                    <li class="mb-5">Brand: <span class="text-brand">${data.brand.brand_name}</span></li>

                                </ul>
                            </div>
                        </div>
                        <!-- Detail Info -->
                    </div>



                  `)
                  // ============== Do Work ====================
                }
            })
            // do work
          }

          /*
          =================================
          product in cart
          =================================
          */
          function addToCart(id) {
            $.ajax({
              type: "POST",
              dataType: 'json',
              data:{ id:id },
              url: "{{ route('addToCart') }}",
              success: function(data) {
                  miniCartView();
                  //  start message
                  const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000
                  })

                  if ($.isEmptyObject(data.error)) {
                      Toast.fire({
                          type: 'success',
                          title: data.success
                      })
                  } else {
                      Toast.fire({
                          type: 'error',
                          title: data.error
                      })
                  }
                  //  end message
              }
            })
          }
          // minicart product view
          function miniCartView() {
            $.ajax({
                type: 'GET',
                url: '{{ route('productViewInMiniCart') }}',
                dataType: 'json',
                success: function(response) {
                    $('span[id="cartSubTotal"]').text(response.cartTotal);
                    $('#cartQty').text(response.cartQty);

                    var miniCart = ""
                    $.each(response.carts, function(key, value) {
                        miniCart += `
                         <li>
                            <div class="shopping-cart-img">
                                <a><img alt="Nest" src="/${value.options.image}"></a>
                            </div>
                            <div class="shopping-cart-title">
                                <h4><a>${value.name}</a></h4>
                                <h4><span>${value.qty} × </span> ${value.price} </h4>
                            </div>
                            <div class="shopping-cart-delete">
                                <a id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fi-rs-cross-small"></i></a>
                            </div>
                        </li>
                        `
                    });

                    $('#miniCartProductView').html(miniCart);

                }
             })
           }
           miniCartView();
          // minicart product view

          /// mini cart remove start
          function miniCartRemove(rowId) {
            $.ajax({
                type: 'GET',
                url: '/minicart/product-remove/' + rowId,
                dataType: 'json',
                success: function(data) {
                    miniCartView();
                    //  start message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    //  end message
                }
            });
        }
        // mini cart remove end

        // main cart product view
        function mainCartView(){
          // do work
          $.ajax({
              type: 'GET',
              url: '{{ route('productViewInMainCart') }}',
              dataType: 'json',
              success: function(response) {
                  // $('span[id="cartSubTotal"]').text(response.cartTotal);
                  $('#cartQty').text(response.cartQty);
                  $('#cartQty2').text(response.cartQty);

                  var mainCart = ""
                  $.each(response.carts, function(key, value) {
                      mainCart += `
                      <tr>
                          <td class="custome-checkbox pl-30">
                              <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox2" value="">
                              <label class="form-check-label" for="exampleCheckbox2"></label>
                          </td>
                          <td class="image product-thumbnail"><img src="/${value.options.image}" alt="#"></td>
                          <td class="product-des product-name" style="width:300px">
                              <h6 class="mb-5" style="margin-right:10px"><a class="product-name mb-10 text-heading">${value.name}</a></h6>
                              <div class="product-rate-cover">
                                  <div class="product-rate d-inline-block">
                                      <div class="product-rating" style="width:90%">
                                      </div>
                                  </div>
                                  <span class="font-small ml-5 text-muted"> (4.0)</span>
                                  <p>৳${value.price}</p>
                              </div>
                          </td>
                          <td class="text-center detail-info" data-title="Stock">
                              <div class="detail-extralink mr-15">
                                  <div class="detail-qty border radius">
                                      ${value.qty > 1
                                        ? ` <a id="${value.rowId}" onclick="cartDecrement(this.id)" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>`
                                        : ` <a class="qty-down" disable><i class="fi-rs-angle-small-down"></i></a>`
                                      }
                                      <span class="qty-val">${value.qty}</span>
                                      <a id="${value.rowId}" onclick="cartIncrement(this.id)" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                  </div>
                              </div>
                          </td>
                          <td class="price" data-title="Price">
                              <h4 class="text-brand">৳${value.subtotal}</h4>
                          </td>
                          <td class="action text-center" data-title="Remove"><a id="${value.rowId}" onclick="mainCartRemove(this.id)" class="text-body"><i class="fi-rs-trash"></i></a></td>
                      </tr>
                      `
                  });

                  $('#mainCartView').html(mainCart);

              }
           })
          // do work
        }
        mainCartView();
        // Cart To Increment -------------------------------------
        function cartIncrement(rowId){
           $.ajax({
                type: 'GET',
                url: '/cart-increment/' + rowId,
                dataType: 'json',
                success: function(data) {
                    couponCalculation();
                    mainCartView();
                    miniCartView();
                }
            });
        }

        // Cart To Decrement -------------------------------------
        function cartDecrement(rowId){
            $.ajax({
                type: 'GET',
                url: '/cart-decrement/' + rowId,
                dataType: 'json',
                success: function(data) {
                    couponCalculation();
                    mainCartView();
                    miniCartView();
                }
            });
        }

        /// Main cart remove start
        function mainCartRemove(rowId) {
          $.ajax({
              type: 'GET',
              url: "{{ url('/cart-remove/') }}/" + rowId,
              dataType: 'json',
              success: function(data) {
                  miniCartView();
                  mainCartView();
                  couponCalculation();
                  //  start message
                  const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000
                  })

                  if ($.isEmptyObject(data.error)) {
                      Toast.fire({
                          type: 'success',
                          title: data.success
                      })
                  } else {
                      Toast.fire({
                          type: 'error',
                          title: data.error
                      })
                  }
                  //  end message
              }
          });
        }

        //------------------------------------- Coupon apply -------------------------------------
        function applyCoupon() {
            var coupon_name = $('#coupon_name').val();
            // ==================== @@@@@@@@@@@@@@@ ==================
            if(coupon_name !="" ){
              $("#error_massage_in_coupon").text('');
              // do work
              $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {
                    coupon_name: coupon_name
                },
                url: "{{ route('coupon-apply') }}",
                success: function(data) {
                    couponCalculation();
                    if (data.validity == true) {
                        $('#couponField').hide();
                    }
                    //  start message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        $('#coupon_name').val('');
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    //  end message
                 }
              });
              // do work
            }else{
              $("#error_massage_in_coupon").text('Enter Your Coupon Name!');
            }

        }
        //------------------------------------- Coupon Calculation -------------------------------------
        function couponCalculation(){
          // do work
          $.ajax({
                type: 'GET',
                url: "{{ url('/coupon-calculation') }}",
                dataType: 'json',
                success: function(data) {
                    if (data.total) {
                        $('#couponCalField').html(`

                          <tr>
                              <td class="cart_total_label">
                                  <h6 class="text-muted">Subtotal</h6>
                              </td>
                              <td class="cart_total_amount">
                                  <h4 class="text-brand text-end">৳${data.total}</h4>
                              </td>
                          </tr>
                          <tr>
                              <td class="cart_total_label">
                                  <h6 class="text-muted">Total</h6>
                              </td>
                              <td class="cart_total_amount">
                                  <h4 class="text-brand text-end">৳${data.total}</h4>
                              </td>
                          </tr>

                        `)
                    } else {
                        $('#couponCalField').html(`

                          <tr>
                              <td class="cart_total_label">
                                  <h6 class="text-muted">Subtotal</h6>
                              </td>
                              <td class="cart_total_amount">
                                  <h4 class="text-brand text-end">${data.subtotal}</h4>
                              </td>
                          </tr>

                          <tr>
                              <td class="cart_total_label">
                                  <h6 class="text-muted">Coupon</h6>
                              </td>
                              <td class="cart_total_amount">
                                  <div class="d-flex justify-content-between align-items-center">
                                      <h4 style="margin-left:110px" class="text-brand text-end">${data.coupon_name}</h4>
                                      <a onclick="couponRemove()" class="text-body"><i class="fi-rs-trash"></i></a>
                                  </div>
                              </td>
                          </tr>

                          <tr>
                              <td class="cart_total_label">
                                  <h6 class="text-muted">Discount</h6>
                              </td>
                              <td class="cart_total_amount">
                                  <h4 class="text-brand text-end">৳${data.discount_amount}</h4>
                              </td>
                          </tr>

                          <tr>
                              <td class="cart_total_label">
                                  <h6 class="text-muted">Grand Total</h6>
                              </td>
                              <td class="cart_total_amount">
                                  <h4 class="text-brand text-end">৳${data.total_amount}</h4>
                              </td>
                          </tr>

                        `)
                    }
                }
          });
          // do work
        }
        couponCalculation();

        // add to wishlist -------------------------------------
        function addToWishlist(product_id){
          // do work
          $.ajax({
                type: "POST",
                dataType: 'json',
                url: "{{ route('addToWishlist') }}",
                data: { product_id:product_id },
                success: function(data) {
                    getWishList();
                    //  start message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    //  end message
                }
            })
          // do work
        }

        function couponRemove(){
          // ++++++++++++++ do work ++++++++++++++
          $.ajax({
              type: 'GET',
              url: "{{ url('/coupon-remove') }}",
              dataType: 'json',
              success: function(data) {
                  couponCalculation();
                  $('#couponField').show();
                    // $('#couponField').css("display","");
                  $('#coupon_name').val('');
                    //  start message
                  const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000
                  })

                  if ($.isEmptyObject(data.error)) {
                      Toast.fire({
                          type: 'success',
                            title: data.success
                      })
                  } else {
                      Toast.fire({
                          type: 'error',
                            title: data.error
                      })
                  }
                  //  end message
                }
          });
          // ++++++++++++++ do work ++++++++++++++
        }

        // ----------------------------- get To wishlist -----------------------------
        function getWishList(){
          // do work
          $.ajax({
              type: 'GET',
              url: "{{ route('getWishList') }}",
              dataType: 'json',
              success: function(response) {
                  $('#wishQty').text(response.count);
                  $('#wishQty2').text(response.count);

                  var rows = ""
                  $.each(response.data, function(key, value) {
                      rows += `
                        <tr class="pt-30">
                            <td class="custome-checkbox pl-30">
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                <label class="form-check-label" for="exampleCheckbox1"></label>
                            </td>
                            <td class="image product-thumbnail pt-40">
                              <img src="/${value.product.product_thambnail}" alt="#">
                            </td>
                            <td class="product-des product-name" >
                                <h6 style="width:200px"><a class="product-name mb-10">${value.product.product_name}</a></h6>
                            </td>
                            <td class="price" data-title="Price">
                                <h3 class="text-brand">৳${value.product.selling_price}</h3>
                                <span class="text-brand">৳${value.product.discount_price}</span>
                            </td>
                            <td class="text-center detail-info" data-title="Stock">
                                <span class="stock-status in-stock mb-0"> ${value.product.product_qty > 0 ? `In Stock` : `Out Stock`}  </span>



                            </td>
                            <td class="text-right" data-title="Cart">
                                <button class="btn btn-sm" id="${value.product.id}" onclick="addToCart(this.id)">Add to cart</button>
                            </td>
                            <td class="action text-center" data-title="Remove">
                                <button type="submit" class="" id="${value.id}" onclick="wishlistRemove(this.id)" ><i class="fi-rs-trash"></i></button>
                            </td>
                        </tr>
                      `
                  });

                  $('#wishlistInWisePage').html(rows);

              }
          })
          // do work
        }
        getWishList();

        function wishlistRemove(id){
          // do work
          $.ajax({
                type: 'GET',
                url: "{{ url('/customer/wishlist-remove/') }}/" + id,
                dataType: 'json',
                success: function(data) {
                    getWishList();
                    //  start message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    //  end message
                }
          });
          // do work
        }


        </script>
        {{-- add to cart --}}

        {{-- auto search --}}
        <script type="text/javascript">
                $("body").on("keyup", "#search", function() {
                let searchData = $("#search").val();
                if (searchData.length > 0) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('/find-products') }}",
                        data: {
                            search: searchData
                        },
                        success: function(result) {
                            $('#suggestProduct').html(result)
                        }
                    });
                }

                if (searchData.length < 1) $('#suggestProduct').html("");
            })
        </script>
        {{-- auto search --}}
    </body>
</html>
