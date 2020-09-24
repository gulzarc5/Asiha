@extends('web.templet.master')

@section('head')
    <meta name="description" content="description">
@endsection

@section('content')
    <!-- Shop Products Section Start -->
    <div class="section section-padding shop-list bg-white pt-0">

        <!-- Shop Toolbar Start -->
        <div class="shop-toolbar section-fluid border-top-dashed border-bottom-dashed">
            <div class="container">
                <div class="row ashia-mb-n20">

                    <!-- Isotop Filter Start -->
                    <div class="col-md col-12 align-self-center ashia-mb-20">
                        <div class="widget-tags product-list-nav">
                            <a href="#">Mens</a>
                            <p><b>Men T-Shirts</b> - 50320 items</p>
                        </div>
                    </div>
                    <!-- Isotop Filter End -->

                    <div class="col-md-auto col-12 ashia-mb-20">
                        <ul class="shop-toolbar-controls">

                            <li>
                                <div class="product-sorting">
                                    <select class="nice-select">
                                        <option value="menu_order" selected="selected">Default sorting</option>
                                        <option value="popularity">Sort by popularity</option>
                                        <option value="rating">Sort by average rating</option>
                                        <option value="date">Sort by latest</option>
                                        <option value="price">Sort by price: low to high</option>
                                        <option value="price-desc">Sort by price: high to low</option>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="product-column-toggle d-none d-xl-flex">
                                    <button class="toggle hintT-top" data-hint="5 Column" data-column="5"><i class="ti-layout-grid4-alt"></i></button>
                                    <button class="toggle active hintT-top" data-hint="4 Column" data-column="4"><i class="ti-layout-grid4-alt"></i></button>
                                    <button class="toggle hintT-top" data-hint="3 Column" data-column="3"><i class="ti-layout-grid3-alt"></i></button>
                                </div>
                            </li>
                            <li class="d-lg-none">
                                <a class="product-filter-toggle" href="#product-filter">Filters</a>
                            </li>

                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <!-- Shop Toolbar End -->

        <!-- Product Filter Start -->
        <div id="product-filter" class="product-filter section-fluid bg-light">
            <div class="container-fluid">
                <div class="row row-cols-lg-5 row-cols-md-3 row-cols-sm-2 row-cols-1 ashia-mb-n30">

                    <!-- Sort by Start -->
                    <div class="col ashia-mb-30">
                        <h3 class="widget-title product-filter-widget-title">Sort by</h3>
                        <ul class="widget-list product-filter-widget customScroll">
                            <li><a href="#">Popularity</a></li>
                            <li><a href="#">Average rating</a></li>
                            <li><a href="#">Newness</a></li>
                            <li><a href="#">Price: low to high</a></li>
                            <li><a href="#">Price: high to low</a></li>
                        </ul>
                    </div>
                    <!-- Sort by End -->

                    <!-- Price filter Start -->
                    <div class="col ashia-mb-30">
                        <h3 class="widget-title product-filter-widget-title">Price filter</h3>
                        <ul class="widget-list product-filter-widget customScroll">
                            <li> <a href="#">All</a></li>
                            <li> <a href="#"><span class="amount"><span class="cur-symbol">£</span>0.00</span> - <span class="amount"><span class="cur-symbol">£</span>80.00</span></a></li>
                            <li> <a href="#"><span class="amount"><span class="cur-symbol">£</span>80.00</span> - <span class="amount"><span class="cur-symbol">£</span>160.00</span></a></li>
                            <li> <a href="#"><span class="amount"><span class="cur-symbol">£</span>160.00</span> - <span class="amount"><span class="cur-symbol">£</span>240.00</span></a></li>
                            <li> <a href="#"><span class="amount"><span class="cur-symbol">£</span>240.00</span> - <span class="amount"><span class="cur-symbol">£</span>320.00</span></a></li>
                            <li> <a href="#"><span class="amount"><span class="cur-symbol">£</span>320.00</span> +</a></li>
                        </ul>
                    </div>
                    <!-- Price filter End -->

                    <!-- Categories Start -->
                    <div class="col ashia-mb-30">
                        <h3 class="widget-title product-filter-widget-title">Categories</h3>
                        <ul class="widget-list product-filter-widget customScroll">
                            <li><a href="#">Gift ideas</a> <span class="count">16</span></li>
                            <li><a href="#">Home Decor</a> <span class="count">16</span></li>
                            <li><a href="#">Kids &amp; Babies</a> <span class="count">6</span></li>
                            <li><a href="#">Kitchen</a> <span class="count">15</span></li>
                            <li><a href="#">Kniting &amp; Sewing</a> <span class="count">4</span></li>
                            <li><a href="#">Pots</a> <span class="count">4</span></li>
                            <li><a href="#">Toys</a> <span class="count">6</span></li>
                        </ul>
                    </div>
                    <!-- Categories End -->

                    <!-- Filters by colors Start -->
                    <div class="col ashia-mb-30">
                        <h3 class="widget-title product-filter-widget-title">Filters by colors</h3>
                        <ul class="widget-colors product-filter-widget customScroll">
                            <li><a href="#" class="hintT-top" data-hint="Black"><span data-bg-color="#000000">Black</span></a></li>
                            <li><a href="#" class="hintT-top" data-hint="White"><span data-bg-color="#FFFFFF">White</span></a></li>
                            <li><a href="#" class="hintT-top" data-hint="Dark Red"><span data-bg-color="#b2483c">Dark Red</span></a></li>
                            <li><a href="#" class="hintT-top" data-hint="Flaxen"><span data-bg-color="#d5b85a">Flaxen</span></a></li>
                            <li><a href="#" class="hintT-top" data-hint="Pine"><span data-bg-color="#01796f">Pine</span></a></li>
                            <li><a href="#" class="hintT-top" data-hint="Tortilla"><span data-bg-color="#997950">Tortilla</span></a></li>
                        </ul>
                    </div>
                    <!-- Filters by colors End -->

                    <!-- Brands Start -->
                    <div class="col ashia-mb-30">
                        <h3 class="widget-title product-filter-widget-title">Brands</h3>
                        <ul class="widget-list product-filter-widget customScroll">
                            <li><a href="#">Alexander</a> <span class="count">(2)</span></li>
                            <li><a href="#">Carmella</a> <span class="count">(4)</span></li>
                            <li><a href="#">Danielle</a> <span class="count">(7)</span></li>
                            <li><a href="#">Diana Day</a> <span class="count">(13)</span></li>
                            <li><a href="#">Emilia</a> <span class="count">(2)</span></li>
                            <li><a href="#">Gasmine</a> <span class="count">(15)</span></li>
                            <li><a href="#">Jack &amp; Ella</a> <span class="count">(7)</span></li>
                            <li><a href="#">Juliette</a> <span class="count">(11)</span></li>
                        </ul>
                    </div>
                    <!-- Brands End -->

                </div>
            </div>
        </div>
        <!-- Product Filter End -->

        <div class="section section-fluid ashia-mt-30">
            <div class="container">
                <div class="row ashia-mb-n50">

                    <div class="col-lg-9 col-12 ashia-mb-50 order-lg-2">
                        <!-- Products Start -->
                        <div class="products row row-cols-xl-4 row-cols-md-3 row-cols-sm-2 row-cols-1">

                            <div class="col">
                                <div class="product">
                                    <div class="product-thumb">
                                        <a href="{{route('web.product.product-detail')}}" class="image">
                                            <img src="{{asset('web/images/product/s328/product-11.jpg')}}" alt="Product Image">
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h6 class="title"><a href="{{route('web.product.product-detail')}}">Boho Beard Mug</a></h6>
                                        <span class="price">
                                            <span class="old">$45.00</span>
                                        <span class="new">$39.00</span>
                                        </span>
                                        <div class="product-buttons">
                                            <a href="#" class="product-button hintT-top" data-hint="Add to wishlist"><i class="far fa-heart"></i></a>
                                            <a href="#" class="product-button hintT-top" data-hint="Add to Cart"><i class="fal fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="product">
                                    <div class="product-thumb">
                                        <a href="{{route('web.product.product-detail')}}" class="image">
                                            <img src="{{asset('web/images/product/s328/product-4.jpg')}}" alt="Product Image">
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h6 class="title"><a href="{{route('web.product.product-detail')}}">Boho Beard Mug</a></h6>
                                        <span class="price">
                                            <span class="old">$45.00</span>
                                        <span class="new">$39.00</span>
                                        </span>
                                        <div class="product-buttons">
                                            <a href="#" class="product-button hintT-top" data-hint="Add to wishlist"><i class="far fa-heart"></i></a>
                                            <a href="#" class="product-button hintT-top" data-hint="Add to Cart"><i class="fal fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="product">
                                    <div class="product-thumb">
                                        <a href="{{route('web.product.product-detail')}}" class="image">
                                            <img src="{{asset('web/images/product/s328/product-8.jpg')}}" alt="Product Image">
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h6 class="title"><a href="{{route('web.product.product-detail')}}">Boho Beard Mug</a></h6>
                                        <span class="price">
                                            <span class="old">$45.00</span>
                                        <span class="new">$39.00</span>
                                        </span>
                                        <div class="product-buttons">
                                            <a href="#" class="product-button hintT-top" data-hint="Add to wishlist"><i class="far fa-heart"></i></a>
                                            <a href="#" class="product-button hintT-top" data-hint="Add to Cart"><i class="fal fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="product">
                                    <div class="product-thumb">
                                        <a href="{{route('web.product.product-detail')}}" class="image">
                                            <img src="{{asset('web/images/product/s328/product-16.jpg')}}" alt="Product Image">
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h6 class="title"><a href="{{route('web.product.product-detail')}}">Boho Beard Mug</a></h6>
                                        <span class="price">
                                            <span class="old">$45.00</span>
                                        <span class="new">$39.00</span>
                                        </span>
                                        <div class="product-buttons">
                                            <a href="#" class="product-button hintT-top" data-hint="Add to wishlist"><i class="far fa-heart"></i></a>
                                            <a href="#" class="product-button hintT-top" data-hint="Add to Cart"><i class="fal fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="product">
                                    <div class="product-thumb">
                                        <a href="{{route('web.product.product-detail')}}" class="image">
                                            <img src="{{asset('web/images/product/s328/product-15.jpg')}}" alt="Product Image">
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h6 class="title"><a href="{{route('web.product.product-detail')}}">Boho Beard Mug</a></h6>
                                        <span class="price">
                                            <span class="old">$45.00</span>
                                        <span class="new">$39.00</span>
                                        </span>
                                        <div class="product-buttons">
                                            <a href="#" class="product-button hintT-top" data-hint="Add to wishlist"><i class="far fa-heart"></i></a>
                                            <a href="#" class="product-button hintT-top" data-hint="Add to Cart"><i class="fal fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="product">
                                    <div class="product-thumb">
                                        <a href="{{route('web.product.product-detail')}}" class="image">
                                            <img src="{{asset('web/images/product/s328/product-13.jpg')}}" alt="Product Image">
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h6 class="title"><a href="{{route('web.product.product-detail')}}">Boho Beard Mug</a></h6>
                                        <span class="price">
                                            <span class="old">$45.00</span>
                                        <span class="new">$39.00</span>
                                        </span>
                                        <div class="product-buttons">
                                            <a href="#" class="product-button hintT-top" data-hint="Add to wishlist"><i class="far fa-heart"></i></a>
                                            <a href="#" class="product-button hintT-top" data-hint="Add to Cart"><i class="fal fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="product">
                                    <div class="product-thumb">
                                        <a href="{{route('web.product.product-detail')}}" class="image">
                                            <img src="{{asset('web/images/product/s328/product-7.jpg')}}" alt="Product Image">
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h6 class="title"><a href="{{route('web.product.product-detail')}}">Boho Beard Mug</a></h6>
                                        <span class="price">
                                            <span class="old">$45.00</span>
                                        <span class="new">$39.00</span>
                                        </span>
                                        <div class="product-buttons">
                                            <a href="#" class="product-button hintT-top" data-hint="Add to wishlist"><i class="far fa-heart"></i></a>
                                            <a href="#" class="product-button hintT-top" data-hint="Add to Cart"><i class="fal fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="product">
                                    <div class="product-thumb">
                                        <a href="{{route('web.product.product-detail')}}" class="image">
                                            <img src="{{asset('web/images/product/s328/product-5.jpg')}}" alt="Product Image">
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h6 class="title"><a href="{{route('web.product.product-detail')}}">Boho Beard Mug</a></h6>
                                        <span class="price">
                                            <span class="old">$45.00</span>
                                        <span class="new">$39.00</span>
                                        </span>
                                        <div class="product-buttons">
                                            <a href="#" class="product-button hintT-top" data-hint="Add to wishlist"><i class="far fa-heart"></i></a>
                                            <a href="#" class="product-button hintT-top" data-hint="Add to Cart"><i class="fal fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="product">
                                    <div class="product-thumb">
                                        <a href="{{route('web.product.product-detail')}}" class="image">
                                            <img src="{{asset('web/images/product/s328/product-14.jpg')}}" alt="Product Image">
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h6 class="title"><a href="{{route('web.product.product-detail')}}">Boho Beard Mug</a></h6>
                                        <span class="price">
                                            <span class="old">$45.00</span>
                                        <span class="new">$39.00</span>
                                        </span>
                                        <div class="product-buttons">
                                            <a href="#" class="product-button hintT-top" data-hint="Add to wishlist"><i class="far fa-heart"></i></a>
                                            <a href="#" class="product-button hintT-top" data-hint="Add to Cart"><i class="fal fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="product">
                                    <div class="product-thumb">
                                        <a href="{{route('web.product.product-detail')}}" class="image">
                                            <img src="{{asset('web/images/product/s328/product-12.jpg')}}" alt="Product Image">
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h6 class="title"><a href="{{route('web.product.product-detail')}}">Boho Beard Mug</a></h6>
                                        <span class="price">
                                            <span class="old">$45.00</span>
                                        <span class="new">$39.00</span>
                                        </span>
                                        <div class="product-buttons">
                                            <a href="#" class="product-button hintT-top" data-hint="Add to wishlist"><i class="far fa-heart"></i></a>
                                            <a href="#" class="product-button hintT-top" data-hint="Add to Cart"><i class="fal fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="product">
                                    <div class="product-thumb">
                                        <a href="{{route('web.product.product-detail')}}" class="image">
                                            <img src="{{asset('web/images/product/s328/product-6.jpg')}}" alt="Product Image">
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h6 class="title"><a href="{{route('web.product.product-detail')}}">Boho Beard Mug</a></h6>
                                        <span class="price">
                                            <span class="old">$45.00</span>
                                        <span class="new">$39.00</span>
                                        </span>
                                        <div class="product-buttons">
                                            <a href="#" class="product-button hintT-top" data-hint="Add to wishlist"><i class="far fa-heart"></i></a>
                                            <a href="#" class="product-button hintT-top" data-hint="Add to Cart"><i class="fal fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Products End -->
                        <div class="text-center ashia-mt-70">
                            <a href="#" class="btn btn-dark btn-outline-hover-dark"><i class="ti-plus"></i> More</a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-12 ashia-mb-10 order-lg-1">

                        <!-- Categories Start -->
                        <div class="single-widget border-right-dashed ashia-pb-20 ashia-pt-20">
                            <h3 class="widget-title product-filter-widget-title">Categories</h3>
                            <ul class="widget-list">
                                <li><a><input type="checkbox">Gift ideas</a> <span class="count">16</span></li>
                                <li><a><input type="checkbox">Home Decor</a> <span class="count">16</span></li>
                                <li><a><input type="checkbox">Kids &amp; Babies</a> <span class="count">6</span></li>
                                <li><a><input type="checkbox">Kitchen</a> <span class="count">15</span></li>
                                <li><a><input type="checkbox">Kniting &amp; Sewing</a> <span class="count">4</span></li>
                                <li><a><input type="checkbox">Pots</a> <span class="count">4</span></li>
                                <li><a><input type="checkbox">Toys</a> <span class="count">6</span></li>
                            </ul>
                        </div>
                        <!-- Categories End -->

                        <!-- Price Range Start -->
                        <div class="single-widget border-top-dashed border-right-dashed ashia-pb-20 ashia-pt-20">
                            <h3 class="widget-title product-filter-widget-title">Price</h3>
                            <ul class="widget-list">
                                <li><a><input type="checkbox">₹0 - ₹500</a> <span class="count">16</span></li>
                                <li><a><input type="checkbox">₹501 - ₹1000</a>  <span class="count">6</span></li>
                                <li><a><input type="checkbox">₹1001 - ₹1500</a> <span class="count">15</span></li>
                                <li><a><input type="checkbox">₹1501 - ₹2000</a>  <span class="count">4</span></li>
                            </ul>
                        </div>
                        <!-- Price Range End -->

                        <!-- Categories Start -->
                        <div class="single-widget border-top-dashed border-right-dashed ashia-pb-20 ashia-pt-20">
                            <h3 class="widget-title product-filter-widget-title">Brand</h3>
                            <ul class="widget-list">
                                <li><a><input type="checkbox">Roadster</a> <span class="count">16</span></li>
                                <li><a><input type="checkbox">Wrogn</a> <span class="count">16</span></li>
                                <li><a><input type="checkbox">Adidas</a> <span class="count">6</span></li>
                                <li><a><input type="checkbox">Pepe Jeans</a> <span class="count">15</span></li>
                                <li><a><input type="checkbox">Spykar &amp; Sewing</a> <span class="count">4</span></li>
                                <li><a><input type="checkbox">HRX</a> <span class="count">4</span></li>
                                <li><a><input type="checkbox">Levi</a> <span class="count">6</span></li>
                                <li><a><input type="checkbox">Biba</a> <span class="count">16</span></li>
                            </ul>
                        </div>
                        <!-- Categories End -->

                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- Shop Products Section End -->
@endsection

@section('script')

@endsection
