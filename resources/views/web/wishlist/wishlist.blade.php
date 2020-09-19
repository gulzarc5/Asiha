@extends('web.templet.master')

  {{-- @include('web.include.seo') --}}

  @section('seo')
    <meta name="description" content="Assambigmart">
  @endsection

  @section('content')
        <!-- site__body -->
        <div class="site__body">
            <div class="block-header block-header--has-breadcrumb block-header--has-title">
                <div class="container-fluid">
                    <div class="block-header__body">
                        <nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
                            <ol class="breadcrumb__list">
                                <li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
                                <li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{route('web.index')}}" class="breadcrumb__item-link">Home</a></li>
                                <li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">Wishlist</span></li>
                                <li class="breadcrumb__title-safe-area" role="presentation"></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="block-split block-split--has-sidebar">
                <div class="container-fluid">                    
                    <div class="block wishlist">
                        <div class="products-view">
                            <div class="products-view__list products-list products-list--grid--5" data-layout="grid" data-with-features="false">
                                <div class="products-list__content">
                                    <div class="products-list__item">
                                        <div class="product-card">
                                            <div class="product-card__actions-list">
                                                <button type="button" class="wishlist__remove btn btn-sm btn-muted btn-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"><path d="M10.8,10.8L10.8,10.8c-0.4,0.4-1,0.4-1.4,0L6,7.4l-3.4,3.4c-0.4,0.4-1,0.4-1.4,0l0,0c-0.4-0.4-0.4-1,0-1.4L4.6,6L1.2,2.6
                                                    c-0.4-0.4-0.4-1,0-1.4l0,0c0.4-0.4,1-0.4,1.4,0L6,4.6l3.4-3.4c0.4-0.4,1-0.4,1.4,0l0,0c0.4,0.4,0.4,1,0,1.4L7.4,6l3.4,3.4
                                                    C11.2,9.8,11.2,10.4,10.8,10.8z"></path></svg>
                                                </button>
                                            </div>
                                            <div class="product-card__image">
                                                <a href="shop-detail.php"><img src="{{asset('web/images/products/1a.jpg')}}" alt=""></a>
                                            </div>
                                            <div class="product-card__info">
                                                <div class="product-card__meta"><span class="product-card__meta-title">SKU:</span> 140-10440-B</div>
                                                <div class="product-card__name">
                                                    <div>
                                                        <a href="shop-detail.php">Brandix Spark Plug Kit ASR-400111</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-card__footer">
                                                <div class="product-card__prices">
                                                    <div class="product-card__price product-card__price--old">$21.00</div>
                                                    <div class="product-card__price product-card__price--current">$19.00</div>
                                                </div>
                                                <a class="product-card__addtocart-icon" aria-label="Add to cart" href="shop-detail.php">
                                                    <i class="fa fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="products-list__item">
                                        <div class="product-card">
                                            <div class="product-card__actions-list">
                                                <button type="button" class="wishlist__remove btn btn-sm btn-muted btn-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"><path d="M10.8,10.8L10.8,10.8c-0.4,0.4-1,0.4-1.4,0L6,7.4l-3.4,3.4c-0.4,0.4-1,0.4-1.4,0l0,0c-0.4-0.4-0.4-1,0-1.4L4.6,6L1.2,2.6
                                                    c-0.4-0.4-0.4-1,0-1.4l0,0c0.4-0.4,1-0.4,1.4,0L6,4.6l3.4-3.4c0.4-0.4,1-0.4,1.4,0l0,0c0.4,0.4,0.4,1,0,1.4L7.4,6l3.4,3.4
                                                    C11.2,9.8,11.2,10.4,10.8,10.8z"></path></svg>
                                                </button>
                                            </div>
                                            <div class="product-card__image">
                                                <a href="shop-detail.php"><img src="{{asset('web/images/products/2a.jpg')}}" alt=""></a>
                                            </div>
                                            <div class="product-card__info">
                                                <div class="product-card__meta"><span class="product-card__meta-title">SKU:</span> 140-10440-B</div>
                                                <div class="product-card__name">
                                                    <div>
                                                        <a href="shop-detail.php">Brandix Spark Plug Kit ASR-400111</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-card__footer">
                                                <div class="product-card__prices">
                                                    <div class="product-card__price product-card__price--old">$21.00</div>
                                                    <div class="product-card__price product-card__price--current">$19.00</div>
                                                </div>
                                                <a class="product-card__addtocart-icon" aria-label="Add to cart" href="shop-detail.php">
                                                    <i class="fa fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="products-list__item">
                                        <div class="product-card">
                                            <div class="product-card__actions-list">
                                                <button type="button" class="wishlist__remove btn btn-sm btn-muted btn-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"><path d="M10.8,10.8L10.8,10.8c-0.4,0.4-1,0.4-1.4,0L6,7.4l-3.4,3.4c-0.4,0.4-1,0.4-1.4,0l0,0c-0.4-0.4-0.4-1,0-1.4L4.6,6L1.2,2.6
                                                    c-0.4-0.4-0.4-1,0-1.4l0,0c0.4-0.4,1-0.4,1.4,0L6,4.6l3.4-3.4c0.4-0.4,1-0.4,1.4,0l0,0c0.4,0.4,0.4,1,0,1.4L7.4,6l3.4,3.4
                                                    C11.2,9.8,11.2,10.4,10.8,10.8z"></path></svg>
                                                </button>
                                            </div>
                                            <div class="product-card__image">
                                                <a href="shop-detail.php"><img src="{{asset('web/images/products/3a.jpg')}}" alt=""></a>
                                            </div>
                                            <div class="product-card__info">
                                                <div class="product-card__meta"><span class="product-card__meta-title">SKU:</span> 140-10440-B</div>
                                                <div class="product-card__name">
                                                    <div>
                                                        <a href="shop-detail.php">Brandix Spark Plug Kit ASR-400111</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-card__footer">
                                                <div class="product-card__prices">
                                                    <div class="product-card__price product-card__price--old">$21.00</div>
                                                    <div class="product-card__price product-card__price--current">$19.00</div>
                                                </div>
                                                <a class="product-card__addtocart-icon" aria-label="Add to cart" href="shop-detail.php">
                                                    <i class="fa fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="products-list__item">
                                        <div class="product-card">
                                            <div class="product-card__actions-list">
                                                <button type="button" class="wishlist__remove btn btn-sm btn-muted btn-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"><path d="M10.8,10.8L10.8,10.8c-0.4,0.4-1,0.4-1.4,0L6,7.4l-3.4,3.4c-0.4,0.4-1,0.4-1.4,0l0,0c-0.4-0.4-0.4-1,0-1.4L4.6,6L1.2,2.6
                                                    c-0.4-0.4-0.4-1,0-1.4l0,0c0.4-0.4,1-0.4,1.4,0L6,4.6l3.4-3.4c0.4-0.4,1-0.4,1.4,0l0,0c0.4,0.4,0.4,1,0,1.4L7.4,6l3.4,3.4
                                                    C11.2,9.8,11.2,10.4,10.8,10.8z"></path></svg>
                                                </button>
                                            </div>
                                            <div class="product-card__image">
                                                <a href="shop-detail.php"><img src="{{asset('web/images/products/4a.jpg')}}" alt=""></a>
                                            </div>
                                            <div class="product-card__info">
                                                <div class="product-card__meta"><span class="product-card__meta-title">SKU:</span> 140-10440-B</div>
                                                <div class="product-card__name">
                                                    <div>
                                                        <a href="shop-detail.php">Brandix Spark Plug Kit ASR-400111</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-card__footer">
                                                <div class="product-card__prices">
                                                    <div class="product-card__price product-card__price--old">$21.00</div>
                                                    <div class="product-card__price product-card__price--current">$19.00</div>
                                                </div>
                                                <a class="product-card__addtocart-icon" aria-label="Add to cart" href="shop-detail.php">
                                                    <i class="fa fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="products-list__item">
                                        <div class="product-card">
                                            <div class="product-card__actions-list">
                                                <button type="button" class="wishlist__remove btn btn-sm btn-muted btn-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"><path d="M10.8,10.8L10.8,10.8c-0.4,0.4-1,0.4-1.4,0L6,7.4l-3.4,3.4c-0.4,0.4-1,0.4-1.4,0l0,0c-0.4-0.4-0.4-1,0-1.4L4.6,6L1.2,2.6
                                                    c-0.4-0.4-0.4-1,0-1.4l0,0c0.4-0.4,1-0.4,1.4,0L6,4.6l3.4-3.4c0.4-0.4,1-0.4,1.4,0l0,0c0.4,0.4,0.4,1,0,1.4L7.4,6l3.4,3.4
                                                    C11.2,9.8,11.2,10.4,10.8,10.8z"></path></svg>
                                                </button>
                                            </div>
                                            <div class="product-card__image">
                                                <a href="shop-detail.php"><img src="{{asset('web/images/products/1c.jpg')}}" alt=""></a>
                                            </div>
                                            <div class="product-card__info">
                                                <div class="product-card__meta"><span class="product-card__meta-title">SKU:</span> 140-10440-B</div>
                                                <div class="product-card__name">
                                                    <div>
                                                        <a href="shop-detail.php">Brandix Spark Plug Kit ASR-400111</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-card__footer">
                                                <div class="product-card__prices">
                                                    <div class="product-card__price product-card__price--old">$21.00</div>
                                                    <div class="product-card__price product-card__price--current">$19.00</div>
                                                </div>
                                                <a class="product-card__addtocart-icon" aria-label="Add to cart" href="shop-detail.php">
                                                    <i class="fa fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-space block-space--layout--before-footer"></div>
                </div>
            </div>
        </div>
        <!-- site__body / end -->
	@endsection
	
	@section('script')
	@endsection