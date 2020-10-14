<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Ashia 2020 – Wear The Strom</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('web/images/favicon.png')}}">

    <!-- CSS
	============================================ -->

    <!-- Vendor CSS (Bootstrap & Icon Font) -->
    <!-- <link rel="stylesheet" href="web/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="web/css/vendor/font-awesome-pro.min.css">
    <link rel="stylesheet" href="web/css/vendor/themify-icons.css">
    <link rel="stylesheet" href="web/css/vendor/customFonts.css"> -->

    <!-- Plugins CSS (All Plugins Files) -->
    <!-- <link rel="stylesheet" href="web/css/plugins/select2.min.css">
    <link rel="stylesheet" href="web/css/plugins/perfect-scrollbar.css">
    <link rel="stylesheet" href="web/css/plugins/swiper.min.css">
    <link rel="stylesheet" href="web/css/plugins/nice-select.css">
    <link rel="stylesheet" href="web/css/plugins/ion.rangeSlider.min.css">
    <link rel="stylesheet" href="web/css/plugins/photoswipe.css">
    <link rel="stylesheet" href="web/css/plugins/photoswipe-default-skin.css">
    <link rel="stylesheet" href="web/css/plugins/magnific-popup.css">
    <link rel="stylesheet" href="web/css/plugins/slick.css"> -->

    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="{{asset('web/css/custom.css')}}">
    @yield('head')
    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <link rel="stylesheet" href="{{asset('web/css/vendor/vendor.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/plugins/plugins.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/style.min.css')}}">

</head>

<body class="homepage-bg1 pattern-bg" style="background-attachment: fixed;">

    <!-- Topbar Section Start -->
    <div class="topbar-section section section-fluid">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-auto col-12">
                    <p class="text-center text-md-left my-2">Free shipping for orders over INR 1000</p>
                </div>
                <div class="col-auto d-none d-md-block">
                    <div class="topbar-menu d-flex flex-row-reverse">
                        <ul>
                            <li><a href="#"><i class="fa fa-phone" style="transform: rotate(90deg);"></i>(+91) 77045 10101</a></li>
                            <li><a target="_blank" href="https://goo.gl/maps/gW65xccpcVNx51N69"><i class="fa fa-map-marker-alt"></i>Google Map Location</a></li>
                            @auth('user')
                            <li><a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span class="menu-text"><i class="fal fa-user"></i> Logout</span></a>
                            </li>
                            <form id="logout-form" action="{{ route('web.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar Section End -->

    <!-- Header Section Start -->
    <div class="header-section section section-fluid bg-white d-none d-xl-block">
        <div class="container">
            <div class="row align-items-center">

                <!-- Header Logo Start -->
                <div class="col-auto">
                    <div class="header-logo">
                        <a href="{{route('web.index')}}"><img src="{{asset('web/images/logo/logo-2.png')}}" alt="ashia Logo"></a>
                    </div>
                </div>
                <!-- Header Logo End -->
                @php
                    $user_data= null;
                    $category = $header_data['category'];
                    $wishlist_cnt = 0;
                    $cart_cnt = 0;
                @endphp
                @auth('user')
                    @php
                        $user_data = $header_data['user_data'];
                        $wishlist_cnt = $header_data['wishlist_cnt'];
                        $cart_cnt = $header_data['cart_cnt'];
                    @endphp
                @endauth
                <!-- ====================================Main Header Menu Start  ========================== -->
                <div class="col-auto mr-auto">
                    <nav class="site-main-menu site-main-menu-left menu-height-100 justify-content-center">
                        <ul>

                            <li><a href="{{route('web.index')}}"><span class="menu-text">Home</span></a></li>
                            @foreach($category as $items)
                                @if($items->status==1)
                                    <li class="has-children"><a href="#"><span class="menu-text">{{$items->name}}</span></a>
                                        @if($items->is_sub_category==2)
                                            @php
                                                $sub_category = $items->subCategory;
                                            @endphp
                                            <ul class="sub-menu mega-menu">
                                                @if(!empty($sub_category))

                                                @foreach($sub_category as $sub_cat)
                                                    @if($sub_cat->status == 1)
                                                        <li>
                                                            @if($sub_cat->is_sub_category==2)
                                                                <a href="#" class="mega-menu-title"><span class="menu-text">{{$sub_cat->name}}</span></a>
                                                                @php
                                                                    $third_cat = $sub_cat->thirdCategory;
                                                                @endphp
                                                                <ul>
                                                                    @if(!empty($third_cat))
                                                                        @foreach($third_cat as $thirdlevel)
                                                                            @if($thirdlevel->status==1)
                                                                                <li><a href="{{route('web.product_list',['cat_slug'=>"$thirdlevel->slug",'category_id'=>$thirdlevel->id,'type' => 3])}}"><span class="menu-text">{{$thirdlevel->name}}</span></a></li>
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                </ul>
                                                            @else
                                                                <a href="{{route('web.product_list',['cat_slug'=>"$sub_cat->slug",'category_id'=>$sub_cat->id,'type' => 2])}}" class="mega-menu-title"><span class="menu-text">{{$sub_cat->name}}</span></a>
                                                            @endif
                                                        </li>
                                                    @endif
                                                @endforeach
                                                @endif
                                            </ul>
                                        @endif
                                    </li>
                                @endif
                            @endforeach


                            @auth('user')
                                <li><a href="{{route('web.dashboard')}}"><span class="menu-text"><i class="fa fa-user"></i> Hello, <b>{{$user_data->name}}</b></span></a> </li>
                            @else
                                <li class="has-children"><a href="#"><span class="menu-text"><i class="fal fa-user"></i> Login/Register</span></a>
                                    <ul class="sub-menu">
                                        <li><a href="{{route('web.login_form')}}"><span class="ti-unlock" style="padding-right: 10px;"></span><span class="menu-text">Login</span></a></li>
                                        <li><a href="{{route('web.register_form')}}"><span class="ti-user" style="padding-right: 10px;"></span><span class="menu-text">Register</span></a></li>
                                    </ul>
                                </li>
                            @endauth
                        </ul>
                    </nav>
                </div>
                <!-- ======================================- Main Header Menu End ================================== -->
                <!-- Header Tools Start -->
                @auth('user')
                <div class="col-auto">
                    <div class="header-tools justify-content-end">
                        <div class="header-search d-none d-sm-block">
                            <a href="#offcanvas-search" class="offcanvas-toggle"><i class="fal fa-search"></i></a>
                        </div>
                        <div class="header-wishlist">
                            <a href="{{route('web.wishlist')}}"><span class="wishlist-count">{{$wishlist_cnt}}</span><i class="fal fa-heart"></i></a>
                        </div>
                        <div class="header-cart">
                            <a href="{{route('web.view_cart')}}"><span class="cart-count">{{$cart_cnt}}</span><i class="fal fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
                @else
                    <div class="col-auto">
                        <div class="header-tools justify-content-end">
                            <div class="header-search d-none d-sm-block">
                                <a href="#offcanvas-search" class="offcanvas-toggle"><i class="fal fa-search"></i></a>
                            </div>
                            <div class="header-cart">
                                <a href="{{route('web.view_cart')}}"><span class="cart-count">{{$cart_cnt}}</span><i class="fal fa-shopping-cart"></i></a>
                            </div>
                        </div>
                    </div>
                @endauth
                <!-- Header Tools End -->

            </div>
        </div>

    </div>
    <!-- Header Section End -->

    <!-- Header Sticky Section Start -->
    <div class="sticky-header section bg-white section-fluid d-none d-xl-block">
        <div class="container">
            <div class="row align-items-center">

                <!-- Header Logo Start -->
                <div class="col-xl-auto col">
                    <div class="header-logo">
                        <a href="{{route('web.index')}}"><img src="{{asset('web/images/logo/logo-2.png')}}" alt="ashia Logo"></a>
                    </div>
                </div>
                <!-- Header Logo End -->

                <!-- =======================================Sticky top Menu Start============================================== -->
                <div class="col-auto mr-auto d-none d-xl-block">
                    <nav class="site-main-menu site-main-menu-left justify-content-center">
                        <ul>
                            <li><a href="{{route('web.index')}}"><span class="menu-text">Homess</span></a></li>
                            @foreach($category as $items)
                                @if($items->status==1)
                                    <li class="has-children"><a href="#"><span class="menu-text">{{$items->name}}</span></a>
                                        @if($items->is_sub_category==2)
                                        @php
                                            $sub_category = $items->subCategory;
                                        @endphp
                                            <ul class="sub-menu mega-menu">
                                                @if(!empty($sub_category))
                                                    @foreach($sub_category as $sub_cat)
                                                        @if($sub_cat->status == 1)
                                                            <li>
                                                                @if($sub_cat->is_sub_category==2)
                                                                <a href="#" class="mega-menu-title"><span class="menu-text">{{$sub_cat->name}}</span></a>
                                                                    @php
                                                                        $third_cat = $sub_cat->thirdCategory;
                                                                    @endphp
                                                                    <ul>
                                                                    @if(!empty($third_cat))
                                                                        @foreach($third_cat as $thirdlevel)
                                                                            @if($thirdlevel->status==1)
                                                                                <li><a href="{{route('web.product_list',['cat_slug'=>"$thirdlevel->slug",'category_id'=>$thirdlevel->id,'type' => 3])}}"><span class="menu-text">{{$thirdlevel->name}}</span></a></li>
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                    </ul>
                                                                @else
                                                                    <a href="{{route('web.product_list',['cat_slug'=>"$sub_cat->slug",'category_id'=>$sub_cat->id,'type' => 2])}}" class="mega-menu-title"><span class="menu-text">{{$sub_cat->name}}</span></a>
                                                                @endif
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </ul>
                                        @endif
                                    </li>
                                @endif
                            @endforeach

                            @auth('user')
                                <li><a href="{{route('web.dashboard')}}"><span class="menu-text"><i class="fa fa-user"></i> Hello, <b>{{$user_data->name}}</b></span></a> </li>
                            @else
                                <li class="has-children"><a href="#"><span class="menu-text"><i class="fal fa-user"></i> Login/Register</span></a>
                                    <ul class="sub-menu">
                                        <li><a href="{{route('web.login_form')}}"><span class="ti-unlock" style="padding-right: 10px;"></span><span class="menu-text">Login</span></a></li>
                                        <li><a href="{{route('web.register_form')}}"><span class="ti-user" style="padding-right: 10px;"></span><span class="menu-text">Register</span></a></li>
                                    </ul>
                                </li>
                            @endauth
                        </ul>
                    </nav>
                </div>
                <!-- ======================================Sticky top Menu End=============================================== -->

                <!-- Header Tools Start -->

                <div class="col-auto">
                    <div class="header-tools justify-content-end">
                        <div class="header-search d-none d-sm-block">
                            <a href="#offcanvas-search" class="offcanvas-toggle"><i class="fal fa-search"></i></a>
                        </div>
                        @auth('user')
                        <div class="header-wishlist d-none d-sm-block">
                            <a href="{{route('web.wishlist')}}" class="offcanvas-toggle"><span class="wishlist-count">{{$wishlist_cnt}}</span><i class="fal fa-heart"></i></a>
                        </div>
                        @endauth
                        <div class="header-cart">
                            <a href="{{route('web.view_cart')}}" class="offcanvas-toggle"><span class="cart-count">{{$cart_cnt}}</span><i class="fal fa-shopping-cart"></i></a>
                        </div>
                        <div class="mobile-menu-toggle d-xl-none">
                            <a href="#" class="offcanvas-toggle">
                                <svg viewBox="0 0 800 600">
                                    <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" id="top"></path>
                                    <path d="M300,320 L540,320" id="middle"></path>
                                    <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Header Tools End -->

            </div>
        </div>

    </div>
    <!-- Header Sticky Section End -->

    <!-- Mobile Header Section Start -->
    <div class="mobile-header bg-white section d-xl-none">
        <div class="container">
            <div class="row align-items-center">

                <!-- Header Logo Start -->
                <div class="col">
                    <div class="header-logo">
                        <a href="{{route('web.index')}}"><img src="{{asset('web/images/logo/logo-2.png')}}" alt="ashia Logo"></a>
                    </div>
                </div>
                <!-- Header Logo End -->

                <!-- Header Tools Start -->
                <div class="col-auto">
                    <div class="header-tools justify-content-end">
                        <div class="header-login d-none d-sm-block">
                            <a href="{{route('web.dashboard')}}"><i class="fal fa-user"></i></a>
                        </div>
                        <div class="header-search d-none d-sm-block">
                            <a href="#offcanvas-search" class="offcanvas-toggle"><i class="fal fa-search"></i></a>
                        </div>
                        <div class="header-wishlist d-none d-sm-block">
                            <a href="{{route('web.wishlist')}}"><span class="wishlist-count">3</span><i class="fal fa-heart"></i></a>
                        </div>
                        <div class="header-cart">
                            <a href="{{route('web.view_cart')}}"><span class="cart-count">3</span><i class="fal fa-shopping-cart"></i></a>
                        </div>
                        <div class="mobile-menu-toggle">
                            <a href="#offcanvas-mobile-menu" class="offcanvas-toggle">
                                <svg viewBox="0 0 800 600">
                                    <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" id="top"></path>
                                    <path d="M300,320 L540,320" id="middle"></path>
                                    <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Header Tools End -->

            </div>
        </div>
    </div>
    <!-- Mobile Header Section End -->

    <!-- Mobile Header Section Start -->
    <div class="mobile-header sticky-header bg-white section d-xl-none">
        <div class="container">
            <div class="row align-items-center">

                <!-- Header Logo Start -->
                <div class="col">
                    <div class="header-logo">
                        <a href="{{route('web.index')}}"><img src="{{asset('web/images/logo/logo-2.png')}}" alt="ashia Logo"></a>
                    </div>
                </div>
                <!-- Header Logo End -->

                <!-- Header Tools Start -->

                <div class="col-auto">
                    <div class="header-tools justify-content-end">
                        <div class="header-login d-none d-sm-block">
                            <a href="{{route('web.dashboard')}}"><i class="fal fa-user"></i></a>
                        </div>
                        <div class="header-search d-none d-sm-block">
                            <a href="#offcanvas-search" class="offcanvas-toggle"><i class="fal fa-search"></i></a>
                        </div>
                        @auth('user')
                            <div class="header-wishlist d-none d-sm-block">
                                <a href="{{route('web.wishlist')}}"><span class="wishlist-count">{{$wishlist_cnt}}</span><i class="fal fa-heart"></i></a>
                            </div>
                        @endauth
                        <div class="header-cart">
                            <a href="{{route('web.view_cart')}}"><span class="cart-count">{{$cart_cnt}}</span><i class="fal fa-shopping-cart"></i></a>
                        </div>
                        <div class="mobile-menu-toggle">
                            <a href="#offcanvas-mobile-menu" class="offcanvas-toggle">
                                <svg viewBox="0 0 800 600">
                                    <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" id="top"></path>
                                    <path d="M300,320 L540,320" id="middle"></path>
                                    <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Header Tools End -->

            </div>
        </div>
    </div>
    <!-- Mobile Header Section End -->

    <!-- OffCanvas Search Start -->
    <div id="offcanvas-search" class="offcanvas offcanvas-search">
        <div class="inner">
            <div class="offcanvas-search-form">
                <button class="offcanvas-close">×</button>
                <form action="#">
                    <div class="row mb-n3">
                        <div class="col-lg-8 col-12 mb-3"><input type="text" placeholder="Search Products..."></div>
                        <div class="col-lg-4 col-12 mb-3">
                            <select class="search-select select2-basic">
                                <option value="0">All Categories</option>
                                <option value="kids-babies">Kids &amp; Babies</option>
                                <option value="home-decor">Home Decor</option>
                                <option value="gift-ideas">Gift ideas</option>
                                <option value="kitchen">Kitchen</option>
                                <option value="toys">Toys</option>
                                <option value="kniting-sewing">Kniting &amp; Sewing</option>
                                <option value="pots">Pots</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <p class="search-description text-body-light mt-2"> <span># Type at least 1 character to search</span> <span># Hit enter to search or ESC to close</span></p>

        </div>
    </div>
    <!-- OffCanvas Search End -->

    <!-- Mobile Search Start -->
    <div id="offcanvas-mobile-menu" class="offcanvas offcanvas-mobile-menu">
        <div class="inner customScroll">
            <div class="offcanvas-menu-search-form">
                <form action="#">
                    <input type="text" placeholder="Search...">
                    <button><i class="fal fa-search"></i></button>
                </form>
            </div>
            <div class="offcanvas-menu">
                <ul>
                    <li><a href="{{route('web.index')}}"><span class="menu-text">Home</span></a></li>
                    @foreach($category as $items)
                        @if($items->status==1)
                            <li><a href="#"><span class="menu-text">{{$items->name}}</span></a>
                                @if($items->is_sub_category==2)
                                @php
                                    $sub_category = $items->subCategory;
                                @endphp

                                <ul class="sub-menu">
                                    @if(!empty($sub_category))
                                        @foreach($sub_category as $sub_cat)
                                            @if($sub_cat->status == 1)
                                            <li>
                                                @if($sub_cat->is_sub_category==2)
                                                <a href="#"><span class="menu-text">{{$sub_cat->name}}</span></a>
                                                @php
                                                    $third_cat = $sub_cat->thirdCategory;
                                                @endphp
                                                <ul class="sub-menu">
                                                    @if(!empty($third_cat))
                                                        @foreach($third_cat as $thirdlevel)
                                                            @if($thirdlevel->status==1)
                                                            <li><a href="{{route('web.product_list',['cat_slug'=>"$thirdlevel->slug",'category_id'=>$thirdlevel->id,'type' => 3])}}"><span class="menu-text">{{$thirdlevel->name}}</span></a></li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                                @else
                                                    <a href="{{route('web.product_list',['cat_slug'=>"$sub_cat->slug",'category_id'=>$sub_cat->id,'type' => 2])}}" class="mega-menu-title"><span class="menu-text">{{$sub_cat->name}}</span></a>
                                                @endif
                                            </li>
                                            @endif
                                        @endforeach
                                    @endif

                                </ul>
                                @endif
                            </li>
                        @endif
                    @endforeach
                    @auth('user')
                        <li><a href="{{route('web.dashboard')}}"><span class="menu-text"><i class="fa fa-user"></i> Hello, <b>{{$user_data->name}}</b></span></a> </li>
                        @auth('user')
                            <li><a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span class="menu-text"><i class="fal fa-user"></i> Logout</span></a>
                            </li>
                            <form id="logout-form" action="{{ route('web.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            @endauth
                    @else
                    <li><a href="#"><span class="menu-text"><i class="fal fa-user"></i> Login/Register</span></a>
                        <ul class="sub-menu">
                            <li><a href="{{route('web.login_form')}}"><span class="ti-unlock" style="padding-right: 10px;"></span><span class="menu-text">Login</span></a></li>
                            <li><a href="{{route('web.register_form')}}"><span class="ti-user" style="padding-right: 10px;"></span><span class="menu-text">Register</span></a></li>
                        </ul>
                    </li>
                    @endauth
                </ul>
            </div>
            @auth('user')
                <div class="offcanvas-buttons">
                    <div class="header-tools">
                        <div class="header-login">
                            <a href="{{route('web.dashboard')}}"><i class="fal fa-user"></i></a>
                        </div>
                        <div class="header-wishlist">
                            <a href="{{route('web.wishlist')}}"><span>{{$wishlist_cnt}}</span><i class="fal fa-heart"></i></a>
                        </div>
                        <div class="header-cart">
                            <a href="{{route('web.view_cart')}}"><span class="cart-count">{{$cart_cnt}}</span><i class="fal fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
            @endauth
            <div class="offcanvas-social">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
    <!-- OffCanvas Search End -->

    <div class="offcanvas-overlay"></div>
