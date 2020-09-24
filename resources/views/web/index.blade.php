@extends('web.templet.master')

@section('head')
    <meta name="description" content="description">
@endsection

@section('content')
        <!-- Slider main container Start -->
        <div class="home1-slider swiper-container">
            <div class="swiper-wrapper">
                <a href="#" class="home1-slide-item swiper-slide" data-swiper-autoplay="5000" data-bg-image="{{asset('web/images/slider/slider1.jpg')}}"></a>
                <a href="#" class="home1-slide-item swiper-slide" data-swiper-autoplay="5000" data-bg-image="{{asset('web/images/slider/slider2.jpg')}}"></a>
                <a href="#" class="home1-slide-item swiper-slide" data-swiper-autoplay="5000" data-bg-image="{{asset('web/images/slider/slider3.jpg')}}"></a>
                <a href="#" class="home1-slide-item swiper-slide" data-swiper-autoplay="5000" data-bg-image="{{asset('web/images/slider/slider4.jpg')}}"></a>
                <a href="#" class="home1-slide-item swiper-slide" data-swiper-autoplay="5000" data-bg-image="{{asset('web/images/slider/slider5.jpg')}}"></a>
            </div>
            <div class="home1-slider-prev swiper-button-prev"><i class="ti-angle-left"></i></div>
            <div class="home1-slider-next swiper-button-next"><i class="ti-angle-right"></i></div>
        </div>
        <!-- Slider main container End -->
    
        <!-- Product Section Start -->
        <div class="section section-fluid section-padding bg-white">
            <div class="container">
                <div class="section-title text-center">
                    <h3 class="sub-title">Shop by categories</h3>
                </div>
                <!-- Product Tab Start -->
                <div class="row">
                    <div class="col-12">
                        <div class="prodyct-tab-content1 tab-content catagory">
                            <!-- Men Products Start -->
                            <div class="section-title text-center">
                                <h2 class="title title-icon-both">Men</h2>
                            </div>
                            <div class="products row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1">
    
                                <div class="col">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="{{route('web.product.product-list')}}" class="image">
                                                <img src="{{asset('web/images/product/s328/product-1.jpg')}}" alt="Product Image">
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="title"><a href="{{route('web.product.product-list')}}">Boho Beard Mug</a></h6>
                                            <span class="number">16 Items</span>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="{{route('web.product.product-list')}}" class="image">
                                                <img src="{{asset('web/images/product/s328/product-2.jpg')}}" alt="Product Image">
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="title"><a href="{{route('web.product.product-list')}}">Formal Wear</a></h6>
                                            <span class="number">16 Items</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="{{route('web.product.product-list')}}" class="image">
                                                <img src="{{asset('web/images/product/s328/product-3.jpg')}}" alt="Product Image">
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="title"><a href="{{route('web.product.product-list')}}">Casual Shoes</a></h6>
                                            <span class="number">16 Items</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="{{route('web.product.product-list')}}" class="image">
                                                <img src="{{asset('web/images/product/s328/product-4.jpg')}}" alt="Product Image">
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="title"><a href="{{route('web.product.product-list')}}">Casual Shirts</a></h6>
                                            <span class="number">16 Items</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="{{route('web.product.product-list')}}" class="image">
                                                <img src="{{asset('web/images/product/s328/product-5.jpg')}}" alt="Product Image">
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="title"><a href="{{route('web.product.product-list')}}">T-Shirts</a></h6>
                                            <span class="number">16 Items</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="{{route('web.product.product-list')}}" class="image">
                                                <img src="{{asset('web/images/product/s328/product-6.jpg')}}" alt="Product Image">
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="title"><a href="{{route('web.product.product-list')}}">Traditional Blasers</a></h6>
                                            <span class="number">16 Items</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="{{route('web.product.product-list')}}" class="image">
                                                <img src="{{asset('web/images/product/s328/product-7.jpg')}}" alt="Product Image">
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="title"><a href="{{route('web.product.product-list')}}">Nehru Jacket</a></h6>
                                            <span class="number">16 Items</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="{{route('web.product.product-list')}}" class="image">
                                                <img src="{{asset('web/images/product/s328/product-8.jpg')}}" alt="Product Image">
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="title"><a href="{{route('web.product.product-list')}}">Sherwani</a></h6>
                                            <span class="number">16 Items</span>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="{{route('web.product.product-list')}}" class="image">
                                                <img src="{{asset('web/images/product/s328/more.jpg')}}" alt="Product Image">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Men Products End --> 
                            
                            <!-- Women Products Start -->
                            <div class="section-title text-center">
                                <h2 class="title title-icon-both">Women</h2>
                            </div>
                            <div class="products row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1">
    
                                <div class="col">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="{{route('web.product.product-list')}}" class="image">
                                                <img src="{{asset('web/images/product/s328/product-9.jpg')}}" alt="Product Image">
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="title"><a href="{{route('web.product.product-list')}}">Boho Beard Mug</a></h6>
                                            <span class="number">16 Items</span>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="{{route('web.product.product-list')}}" class="image">
                                                <img src="{{asset('web/images/product/s328/product-16.jpg')}}" alt="Product Image">
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="title"><a href="{{route('web.product.product-list')}}">Formal Wear</a></h6>
                                            <span class="number">16 Items</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="{{route('web.product.product-list')}}" class="image">
                                                <img src="{{asset('web/images/product/s328/product-10.jpg')}}" alt="Product Image">
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="title"><a href="{{route('web.product.product-list')}}">Casual Shoes</a></h6>
                                            <span class="number">16 Items</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="{{route('web.product.product-list')}}" class="image">
                                                <img src="{{asset('web/images/product/s328/product-11.jpg')}}" alt="Product Image">
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="title"><a href="{{route('web.product.product-list')}}">Casual Shirts</a></h6>
                                            <span class="number">16 Items</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="{{route('web.product.product-list')}}" class="image">
                                                <img src="{{asset('web/images/product/s328/product-12.jpg')}}" alt="Product Image">
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="title"><a href="{{route('web.product.product-list')}}">T-Shirts</a></h6>
                                            <span class="number">16 Items</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="{{route('web.product.product-list')}}" class="image">
                                                <img src="{{asset('web/images/product/s328/product-13.jpg')}}" alt="Product Image">
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="title"><a href="{{route('web.product.product-list')}}">Traditional Blasers</a></h6>
                                            <span class="number">16 Items</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="{{route('web.product.product-list')}}" class="image">
                                                <img src="{{asset('web/images/product/s328/product-14.jpg')}}" alt="Product Image">
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="title"><a href="{{route('web.product.product-list')}}">Nehru Jacket</a></h6>
                                            <span class="number">16 Items</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="{{route('web.product.product-list')}}" class="image">
                                                <img src="{{asset('web/images/product/s328/product-15.jpg')}}" alt="Product Image">
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="title"><a href="{{route('web.product.product-list')}}">Sherwani</a></h6>
                                            <span class="number">16 Items</span>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="{{route('web.product.product-list')}}" class="image">
                                                <img src="{{asset('web/images/product/s328/more.jpg')}}" alt="Product Image">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Women Products End -->
                        </div>
                    </div>
                </div>
                <!-- Product Tab End -->
    
            </div>
        </div>
        <!-- Product Section End -->
    
        <!-- Brands Section Start -->
        <div class="section section-padding">
            <div class="container">
    
                <div class="section-title text-md-left text-center row justify-content-between align-items-center">
                    <div class="col-md-auto col-12">
                        <!-- Section Title Start -->
                        <h2 class="sub-title title-icon-right">Shop by brands</h2>
                        <!-- Section Title End -->
                    </div>
                    <div class="col-md-auto d-none d-md-block mt-4 mt-md-0">
                        <a href="#" class="btn btn-primary btn-hover-black">view all</a>
                    </div>
                </div>
    
                <div class="row align-items-center row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 ashia-mb-n50">
    
                    <div class="col ashia-mb-50">
                        <div class="brand-item">
                            <a href="#"><img src="{{asset('web/images/brands/brand-1.png')}}" alt="Brands Image"></a>
                        </div>
                    </div>
    
                    <div class="col ashia-mb-50">
                        <div class="brand-item">
                            <a href="#"><img src="{{asset('web/images/brands/brand-2.png')}}" alt="Brands Image"></a>
                        </div>
                    </div>
    
                    <div class="col ashia-mb-50">
                        <div class="brand-item">
                            <a href="#"><img src="{{asset('web/images/brands/brand-3.png')}}" alt="Brands Image"></a>
                        </div>
                    </div>
    
                    <div class="col ashia-mb-50">
                        <div class="brand-item">
                            <a href="#"><img src="{{asset('web/images/brands/brand-5.png')}}" alt="Brands Image"></a>
                        </div>
                    </div>
    
                    <div class="col ashia-mb-50">
                        <div class="brand-item">
                            <a href="#"><img src="{{asset('web/images/brands/brand-4.png')}}" alt="Brands Image"></a>
                        </div>
                    </div>
    
                    <div class="col ashia-mb-50">
                        <div class="brand-item">
                            <a href="#"><img src="{{asset('web/images/brands/brand-6.png')}}" alt="Brands Image"></a>
                        </div>
                    </div>
    
                    <div class="col ashia-mb-50">
                        <div class="brand-item">
                            <a href="#"><img src="{{asset('web/images/brands/brand-7.png')}}" alt="Brands Image"></a>
                        </div>
                    </div>
    
                    <div class="col ashia-mb-50">
                        <div class="brand-item">
                            <a href="#"><img src="{{asset('web/images/brands/brand-8.png')}}" alt="Brands Image"></a>
                        </div>
                    </div>
    
                </div>
    
                <div class="row d-md-none ashia-mt-50">
                    <div class="col text-center">
                        <a href="#" class="btn btn-light btn-hover-black">view all</a>
                    </div>
                </div>
    
            </div>
        </div>
        <!-- Brands Section End -->
    
        <!-- Shop By top product Start -->
        <div class="section section-fluid section-padding bg-white border-top-dashed border-bottom-dashed">
            <div class="container">
    
                <!-- Section Title Start -->
                <div class="section-title text-center">
                    <h2 class="title title-icon-both">Popular items</h2>
                </div>
                <!-- Section Title End -->  
    
                <!-- Products Start -->
                <div class="product-carousel popular-item">
    
                    <div class="col">
                        <div class="product">
                            <div class="product-thumb">
                                <a href="{{route('web.product.product-list')}}" class="image">
                                    <img src="{{asset('web/images/product/s328/product-11.jpg')}}" alt="Product Image">
                                </a>
                            </div>
                            <div class="product-info">
                                <h6 class="title"><a href="{{route('web.product.product-list')}}">Boho Beard Mug</a></h6>
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
                                <a href="{{route('web.product.product-list')}}" class="image">
                                    <img src="{{asset('web/images/product/s328/product-4.jpg')}}" alt="Product Image">
                                </a>
                            </div>
                            <div class="product-info">
                                <h6 class="title"><a href="{{route('web.product.product-list')}}">Boho Beard Mug</a></h6>
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
                                <a href="{{route('web.product.product-list')}}" class="image">
                                    <img src="{{asset('web/images/product/s328/product-8.jpg')}}" alt="Product Image">
                                </a>
                            </div>
                            <div class="product-info">
                                <h6 class="title"><a href="{{route('web.product.product-list')}}">Boho Beard Mug</a></h6>
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
                                <a href="{{route('web.product.product-list')}}" class="image">
                                    <img src="{{asset('web/images/product/s328/product-2.jpg')}}" alt="Product Image">
                                </a>
                            </div>
                            <div class="product-info">
                                <h6 class="title"><a href="{{route('web.product.product-list')}}">Boho Beard Mug</a></h6>
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
                                <a href="{{route('web.product.product-list')}}" class="image">
                                    <img src="{{asset('web/images/product/s328/product-15.jpg')}}" alt="Product Image">
                                </a>
                            </div>
                            <div class="product-info">
                                <h6 class="title"><a href="{{route('web.product.product-list')}}">Boho Beard Mug</a></h6>
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
                                <a href="{{route('web.product.product-list')}}" class="image">
                                    <img src="{{asset('web/images/product/s328/product-13.jpg')}}" alt="Product Image">
                                </a>
                            </div>
                            <div class="product-info">
                                <h6 class="title"><a href="{{route('web.product.product-list')}}">Boho Beard Mug</a></h6>
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
                                <a href="{{route('web.product.product-list')}}" class="image">
                                    <img src="{{asset('web/images/product/s328/product-7.jpg')}}" alt="Product Image">
                                </a>
                            </div>
                            <div class="product-info">
                                <h6 class="title"><a href="{{route('web.product.product-list')}}">Boho Beard Mug</a></h6>
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
                                <a href="{{route('web.product.product-list')}}" class="image">
                                    <img src="{{asset('web/images/product/s328/product-5.jpg')}}" alt="Product Image">
                                </a>
                            </div>
                            <div class="product-info">
                                <h6 class="title"><a href="{{route('web.product.product-list')}}">Boho Beard Mug</a></h6>
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
                                <a href="{{route('web.product.product-list')}}" class="image">
                                    <img src="{{asset('web/images/product/s328/more.jpg')}}" alt="Product Image">
                                </a>
                            </div>
                        </div>
                    </div>
    
                </div>
                <!-- Products End -->
    
            </div>
        </div>
        <!-- Shop By top product End -->
@endsection

@section('script')

@endsection
