
<div class="products-view__list products-list products-list--grid--4" data-layout="grid" data-with-features="false">
    <div class="products-list__head">
        <div class="products-list__column products-list__column--image">Image</div>
        <div class="products-list__column products-list__column--meta">SKU</div>
        <div class="products-list__column products-list__column--product">Product</div>
        <div class="products-list__column products-list__column--price">Price</div>
    </div>
    <div class="products-list__content">
        @if (isset($products) && !empty($products) && count($products) > 0)
            @foreach ($products as $product)
                <div class="products-list__item">
                    <div class="product-card">
                        <div class="product-card__actions-list">
                            <button class="product-card__action product-card__action--quickview" type="button" aria-label="Add to wish list">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                                    <path d="M13.9,8.4l-5.4,5.4c-0.3,0.3-0.7,0.3-1,0L2.1,8.4c-1.5-1.5-1.5-3.8,0-5.3C2.8,2.4,3.8,2,4.8,2s1.9,0.4,2.6,1.1L8,3.7
                                    l0.6-0.6C9.3,2.4,10.3,2,11.3,2c1,0,1.9,0.4,2.6,1.1C15.4,4.6,15.4,6.9,13.9,8.4z" />
                                </svg>
                            </button>
                        </div>
                        <div class="product-card__image">
                            <a href="{{route('web.productDetail',['slug'=>$product->slug,'id'=>$product->id])}}"><img src="{{asset('images/products/thumb/'.$product->main_image.'')}}" alt=""></a>
                        </div>
                        <div class="product-card__info">
                            <div class="product-card__meta"><span class="product-card__meta-title">SKU:</span> 140-10440-B</div>
                            <div class="product-card__name">
                                <div>
                                    <a href="{{route('web.productDetail',['slug'=>$product->slug,'id'=>$product->id])}}">{{$product->name}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="product-card__footer">
                            <div class="product-card__prices">
                                @if (isset($product->minSize) && !empty($product->minSize))
                                    <div class="product-card__price product-card__price--old">
                                        @if (isset($product->minSize[0]->mrp))
                                        {{$product->minSize[0]->mrp}}
                                        @endif
                                    </div>
                                    @role('retailer')
                                        <div class="product-card__price product-card__price--current">
                                            @if (isset($product->minSize[0]->retailer_price))
                                                {{$product->minSize[0]->retailer_price}}
                                            @endif
                                        </div>
                                    @else
                                        <div class="product-card__price product-card__price--current">
                                            @if (isset($product->minSize[0]->customer_price))
                                                {{$product->minSize[0]->customer_price}}
                                            @endif
                                        </div>
                                    @endrole
                                @endif
                            </div>
                            <a class="product-card__addtocart-icon" aria-label="Add to cart" href="{{route('web.productDetail',['slug'=>$product->slug,'id'=>$product->id])}}">
                                <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            
        @else
            No Products Found
        @endif
        {{-- <div class="products-list__item">
            <div class="product-card">
                <div class="product-card__actions-list">
                    <button class="product-card__action product-card__action--quickview" type="button" aria-label="Add to wish list">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                            <path d="M13.9,8.4l-5.4,5.4c-0.3,0.3-0.7,0.3-1,0L2.1,8.4c-1.5-1.5-1.5-3.8,0-5.3C2.8,2.4,3.8,2,4.8,2s1.9,0.4,2.6,1.1L8,3.7
                            l0.6-0.6C9.3,2.4,10.3,2,11.3,2c1,0,1.9,0.4,2.6,1.1C15.4,4.6,15.4,6.9,13.9,8.4z" />
                        </svg>
                    </button>
                </div>
                <div class="product-card__image">
                    <a href="{{route('web.product.shop-detail')}}"><img src="{{asset('web/images/products/2a.jpg')}}" alt=""></a>
                </div>
                <div class="product-card__info">
                    <div class="product-card__meta"><span class="product-card__meta-title">SKU:</span> 140-10440-B</div>
                    <div class="product-card__name">
                        <div>
                            <a href="{{route('web.product.shop-detail')}}">Brandix Spark Plug Kit ASR-400111</a>
                        </div>
                    </div>
                </div>
                <div class="product-card__footer">
                    <div class="product-card__prices">
                        <div class="product-card__price product-card__price--old">$21.00</div>
                        <div class="product-card__price product-card__price--current">$19.00</div>
                    </div>
                    <a class="product-card__addtocart-icon" aria-label="Add to cart" href="{{route('web.product.shop-detail')}}">
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="products-list__item">
            <div class="product-card">
                <div class="product-card__actions-list">
                    <button class="product-card__action product-card__action--quickview" type="button" aria-label="Add to wish list">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                            <path d="M13.9,8.4l-5.4,5.4c-0.3,0.3-0.7,0.3-1,0L2.1,8.4c-1.5-1.5-1.5-3.8,0-5.3C2.8,2.4,3.8,2,4.8,2s1.9,0.4,2.6,1.1L8,3.7
                            l0.6-0.6C9.3,2.4,10.3,2,11.3,2c1,0,1.9,0.4,2.6,1.1C15.4,4.6,15.4,6.9,13.9,8.4z" />
                        </svg>
                    </button>
                </div>
                <div class="product-card__image">
                    <a href="{{route('web.product.shop-detail')}}"><img src="{{asset('web/images/products/3a.jpg')}}" alt=""></a>
                </div>
                <div class="product-card__info">
                    <div class="product-card__meta"><span class="product-card__meta-title">SKU:</span> 140-10440-B</div>
                    <div class="product-card__name">
                        <div>
                            <a href="{{route('web.product.shop-detail')}}">Brandix Spark Plug Kit ASR-400111</a>
                        </div>
                    </div>
                </div>
                <div class="product-card__footer">
                    <div class="product-card__prices">
                        <div class="product-card__price product-card__price--old">$21.00</div>
                        <div class="product-card__price product-card__price--current">$19.00</div>
                    </div>
                    <a class="product-card__addtocart-icon" aria-label="Add to cart" href="{{route('web.product.shop-detail')}}">
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="products-list__item">
            <div class="product-card">
                <div class="product-card__actions-list">
                    <button class="product-card__action product-card__action--quickview" type="button" aria-label="Add to wish list">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                            <path d="M13.9,8.4l-5.4,5.4c-0.3,0.3-0.7,0.3-1,0L2.1,8.4c-1.5-1.5-1.5-3.8,0-5.3C2.8,2.4,3.8,2,4.8,2s1.9,0.4,2.6,1.1L8,3.7
                            l0.6-0.6C9.3,2.4,10.3,2,11.3,2c1,0,1.9,0.4,2.6,1.1C15.4,4.6,15.4,6.9,13.9,8.4z" />
                        </svg>
                    </button>
                </div>
                <div class="product-card__image">
                    <a href="{{route('web.product.shop-detail')}}"><img src="{{asset('web/images/products/4a.jpg')}}" alt=""></a>
                </div>
                <div class="product-card__info">
                    <div class="product-card__meta"><span class="product-card__meta-title">SKU:</span> 140-10440-B</div>
                    <div class="product-card__name">
                        <div>
                            <a href="{{route('web.product.shop-detail')}}">Brandix Spark Plug Kit ASR-400111</a>
                        </div>
                    </div>
                </div>
                <div class="product-card__footer">
                    <div class="product-card__prices">
                        <div class="product-card__price product-card__price--old">$21.00</div>
                        <div class="product-card__price product-card__price--current">$19.00</div>
                    </div>
                    <a class="product-card__addtocart-icon" aria-label="Add to cart" href="{{route('web.product.shop-detail')}}">
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="products-list__item">
            <div class="product-card">
                <div class="product-card__actions-list">
                    <button class="product-card__action product-card__action--quickview" type="button" aria-label="Add to wish list">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                            <path d="M13.9,8.4l-5.4,5.4c-0.3,0.3-0.7,0.3-1,0L2.1,8.4c-1.5-1.5-1.5-3.8,0-5.3C2.8,2.4,3.8,2,4.8,2s1.9,0.4,2.6,1.1L8,3.7
                            l0.6-0.6C9.3,2.4,10.3,2,11.3,2c1,0,1.9,0.4,2.6,1.1C15.4,4.6,15.4,6.9,13.9,8.4z" />
                        </svg>
                    </button>
                </div>
                <div class="product-card__image">
                    <a href="{{route('web.product.shop-detail')}}"><img src="{{asset('web/images/products/1c.jpg')}}" alt=""></a>
                </div>
                <div class="product-card__info">
                    <div class="product-card__meta"><span class="product-card__meta-title">SKU:</span> 140-10440-B</div>
                    <div class="product-card__name">
                        <div>
                            <a href="{{route('web.product.shop-detail')}}">Brandix Spark Plug Kit ASR-400111</a>
                        </div>
                    </div>
                </div>
                <div class="product-card__footer">
                    <div class="product-card__prices">
                        <div class="product-card__price product-card__price--old">$21.00</div>
                        <div class="product-card__price product-card__price--current">$19.00</div>
                    </div>
                    <a class="product-card__addtocart-icon" aria-label="Add to cart" href="{{route('web.product.shop-detail')}}">
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@if (isset($products) && !empty($products) && count($products) > 0)
    <div class="products-view__pagination">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                {!! $products->onEachSide(2)->links() !!}
            </ul>
        </nav>
    </div>
@endif