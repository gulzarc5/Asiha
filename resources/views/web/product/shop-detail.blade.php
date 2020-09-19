@extends('web.templet.master')

  {{-- @include('web.include.seo') --}}

  @section('seo')
    <meta name="description" content="Assambigmart">
  @endsection

  @section('content')
        <!-- site__header / end -->
        <!-- site__body -->
        <div class="site__body">
            @if (isset($product) && !empty($product))
            @php
                $product_size = $product->minSize;
               
            @endphp
            <div class="block-header block-header--has-breadcrumb">
                <div class="container-fluid">
                    <div class="block-header__body">
                        <nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
                            <ol class="breadcrumb__list">
                                <li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
                                <li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{route('web.index')}}" class="breadcrumb__item-link">Home</a></li>
                                <li class="breadcrumb__item breadcrumb__item--parent"><a href="#" class="breadcrumb__item-link">Packing Meterial</a></li>
                                <li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">Brandix Brake Kit BDX-750Z370-S</span></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="block-split">
                <div class="container-fluid">
                    <div class="block-split__row row no-gutters">
                        <div class="block-split__item block-split__item-content col-auto">
                            <div class="product product--layout--full">
                                <div class="product__body">
                                    <div class="product__card product__card--one"></div>
                                    <div class="product__card product__card--two"></div>
                                    <div class="product-gallery product-gallery--layout--product-full product__gallery" data-layout="product-full">
                                        <div class="product-gallery__featured">
                                            <button type="button" class="product-gallery__zoom">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                                                    <path d="M15,18c-2,0-3.8-0.6-5.2-1.7c-1,1.3-2.1,2.8-3.5,4.6c-2.2,2.8-3.4,1.9-3.4,1.9s-0.6-0.3-1.1-0.7
													c-0.4-0.4-0.7-1-0.7-1s-0.9-1.2,1.9-3.3c1.8-1.4,3.3-2.5,4.6-3.5C6.6,12.8,6,11,6,9c0-5,4-9,9-9s9,4,9,9S20,18,15,18z M15,2
													c-3.9,0-7,3.1-7,7s3.1,7,7,7s7-3.1,7-7S18.9,2,15,2z M16,13h-2v-3h-3V8h3V5h2v3h3v2h-3V13z" />
                                                </svg>
                                            </button>
                                            <div class="owl-carousel">
                                                <a href="{{asset('images/products/'.$product->main_image.'')}}" target="_blank"><img src="{{asset('images/products/thumb/'.$product->main_image.'')}}" alt=""> </a>
                                                @foreach ($product->images as $image)    
                                                    @if ($product->main_image != $image->image)                                          
                                                        <a href="{{asset('images/products/'.$image->image.'')}}" target="_blank"><img src="{{asset('images/products/'.$image->image.'')}}" alt=""> </a>
                                                    @endif
                                                @endforeach
                                                {{-- <a href="{{asset('web/images/products/3a.jpg')}}" target="_blank"><img src="{{asset('web/images/products/3a.jpg')}}" alt=""> </a>
                                                <a href="{{asset('web/images/products/4a.jpg')}}" target="_blank"><img src="{{asset('web/images/products/4a.jpg')}}" alt=""></a> --}}
                                            </div>
                                        </div>
                                        <div class="product-gallery__thumbnails">
                                            <div class="owl-carousel">
                                                <a href="{{asset('images/products/thumb/'.$product->main_image.'')}}" class="product-gallery__thumbnails-item" target="_blank"><img src="{{asset('images/products/thumb/'.$product->main_image.'')}}" alt=""> </a>

                                                @foreach ($product->images as $image)    
                                                    @if ($product->main_image != $image->image) 
                                                        <a href="{{asset('images/products/'.$image->image.'')}}" class="product-gallery__thumbnails-item" target="_blank"><img src="{{asset('images/products/'.$image->image.'')}}" alt=""> </a>
                                                    @endif
                                                @endforeach
                                                {{-- <a href="{{asset('web/images/products/3b.jpg')}}" class="product-gallery__thumbnails-item" target="_blank"><img src="{{asset('web/images/products/3b.jpg')}}" alt=""> </a>
                                                <a href="{{asset('web/images/products/4b.jpg')}}" class="product-gallery__thumbnails-item" target="_blank"><img src="{{asset('web/images/products/4b.jpg')}}" alt=""></a> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product__header">
                                        <h1 class="product__title">{{$product->name}}</h1>
                                        <div class="product__tittle__info">
                                             {{-- <h5><strong>SKU : </strong>201902-0057</h5>  --}}
                                             @if (isset($product->brand) && !empty($product->brand))
                                         	    <h5><strong>Brand : </strong>{{$product->brand->name}}</h5> 
                                             @endif
                                         </div> 
                                        <div class="stock__status">
                                            @if (isset($product_size[0]) && !empty($product_size[0])) 
                                                @if ($product_size[0]->stock > 0)
                                                    <div class="status-badge status-badge--style--success product__stock status-badge--has-text">
                                                        <div class="status-badge__body">
                                                            <div class="status-badge__text">In Stock</div>
                                                            <div class="status-badge__tooltip" tabindex="0" data-toggle="tooltip" title="In&#x20;Stock"></div>
                                                        </div>
                                                    </div>
                                                @else
                                                <div class="status-badge status-badge--style--failure status-badge--has-text">
                                                    <div class="status-badge__body">
                                                        <div class="status-badge__text">Out of Stock</div>
                                                        <div class="status-badge__tooltip" tabindex="0" data-toggle="tooltip" title="" data-original-title="Out of Stock"></div>
                                                    </div>
                                                </div> 
                                                @endif
                                            @endif
                                           
	                                        
                                        </div>   
                                    </div>
                                    <div class="product__main">
                                        <div class="product__excerpt">
                                            {{$product->short_description}}
                                        </div>
                                        @if (isset($product->specifications) && !empty($product->specifications))                                           
                                            <div class="product__features">
                                                <div class="product__features-title">Key Features:</div>
                                                <ul>
                                                    @foreach ($product->specifications as $specification)
                                                        <li>{{$specification->name}}: <span>{{$specification->value}}</span></li>
                                                    @endforeach
                                                    {{-- <li>Power Source: <span>Cordless-Electric</span></li>
                                                    <li>Battery Cell Type: <span>Lithium</span></li>
                                                    <li>Voltage: <span>20 Volts</span></li>
                                                    <li>Battery Capacity: <span>2 Ah</span></li> --}}
                                                </ul>
                                                <div class="product__features-link"><a href="#">See Full Specification</a></div>
                                            </div>
                                        @endif
                                        
                                    </div>
                                    <div class="product__info">
                                        <form class="product__info-card" action="{{route('web.add_to_cart')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <div class="product__info-body">
                                                <div class="product__prices-stock">
                                                    <div class="product__prices" id="price_div">
                                                        @if (isset($product_size[0]))
                                                            <div class="product-card__price product-card__price--old">{{$product_size[0]->mrp}}</div>
                                                            <div class="product__price product__price--current">{{$product_size[0]->customer_price}}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-form product__form">
                                                <div class="product-form__body">
                                                    <div class="product-form__row">
                                                        <div class="product-form__title">Quantity</div>
                                                        <div class="product-form__control">                                                            
			                                                <div class="product__actions-item product__actions-item--quantity">
			                                                    <div class="input-number">
			                                                        <input class="input-number__input form-control form-control-lg" type="number" name="p_quantity" min="1" value="1" required>
			                                                        <div class="input-number__add"></div>
			                                                        <div class="input-number__sub"></div>
			                                                    </div>
			                                                </div>
                                                        </div>
                                                        <div class="product-form__title">Select Size</div>
                                                        <div class="product-form__control">                                                            
			                                                <div class="product__actions-item product__actions-item--quantity">
			                                                    <div class="input-number">
			                                                        <select name="size_id" class="form-control" onchange="getSize(this.value)" required>
                                                                        <option value="">Please Select Size</option>
                                                                        @if (isset($product->sizes))
                                                                            @foreach ($product->sizes as $size)
                                                                                @if (isset($product_size[0]) && $product_size[0]->customer_price == $size->customer_price)
                                                                                <option value="{{$size->id}}" selected>{{$size->name}}</option>
                                                                                @else 
                                                                                <option value="{{$size->id}}">{{$size->name}}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
			                                                    </div>
			                                                </div>
                                                        </div>
                                                        <div class="product-form__title deliv-avil">Availablity</div>
                                                        <div class="product-form__control">
			                                                <div class="product__actions-item product__actions-item--availabity">
			                                                    <div class="input-number">
			                                                        <input class="input-number__input form-control" type="number" placeholder="Enter Pincode">
			                                                        <button class="btn btn-warning" type="button">Check</button>
			                                                        <span class="checkdelivery-cod-avail">Enter Pincode to check Delivery Availability.</span>
			                                                        <span class="delivery-cod-avail">Cash on Delivery Available for this Location.</span>
			                                                        <span class="nodelivery-cod-avail">No Delivery Available for this Location.</span>
			                                                    </div>
			                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product__actions">
                                                <div class="product__actions-item product__actions-item--addtocart" style="margin-right: 5px">
                                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Add To Cart</button>
                                                </div>
                                                {{-- <div class="product__actions-item product__actions-item--addtocart">
                                                    <button class="btn btn-warning btn-lg btn-block">Buy Now</button>
                                                </div> --}}
                                                {{-- <div class="product__actions-divider"> <hr></div>
                                                <button class="product__actions-item product__actions-item--wishlist" type="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                                                        <path d="M13.9,8.4l-5.4,5.4c-0.3,0.3-0.7,0.3-1,0L2.1,8.4c-1.5-1.5-1.5-3.8,0-5.3C2.8,2.4,3.8,2,4.8,2s1.9,0.4,2.6,1.1L8,3.7
														l0.6-0.6C9.3,2.4,10.3,2,11.3,2c1,0,1.9,0.4,2.6,1.1C15.4,4.6,15.4,6.9,13.9,8.4z" />
                                                    </svg> <span>Add to wishlist</span>
                                                </button> --}}
                                            </div>
                                        </form>                                        
                                    </div>
                                    <div class="product__tabs product-tabs product-tabs--layout--full">
                                        <ul class="product-tabs__list">
                                            <li class="product-tabs__item product-tabs__item--active"><a href="#product-tab-description">Description</a></li>
                                        </ul>
                                        <div class="product-tabs__content">
                                            <div class="product-tabs__pane product-tabs__pane--active" id="product-tab-description">
                                                <div class="typography">
                                                    <p>{!!$product->long_description!!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block-space block-space--layout--divider-nl"></div>                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="block block-sale">
                <div class="block-sale__content">
                    <div class="block-sale__header">
                        <div class="block-sale__title">Related items</div>
                        <div class="block-sale__subtitle">Items you may like</div><br>
                        <div class="block-sale__controls">
                            <div class="arrow block-sale__arrow block-sale__arrow--prev arrow--prev">
                                <button class="arrow__button" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="7" height="11">
                                        <path d="M6.7,0.3L6.7,0.3c-0.4-0.4-0.9-0.4-1.3,0L0,5.5l5.4,5.2c0.4,0.4,0.9,0.3,1.3,0l0,0c0.4-0.4,0.4-1,0-1.3l-4-3.9l4-3.9C7.1,1.2,7.1,0.6,6.7,0.3z" />
                                    </svg>
                                </button>
                            </div>
                            <div class="arrow block-sale__arrow block-sale__arrow--next arrow--next">
                                <button class="arrow__button" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="7" height="11">
                                        <path d="M0.3,10.7L0.3,10.7c0.4,0.4,0.9,0.4,1.3,0L7,5.5L1.6,0.3C1.2-0.1,0.7,0,0.3,0.3l0,0c-0.4,0.4-0.4,1,0,1.3l4,3.9l-4,3.9
										C-0.1,9.8-0.1,10.4,0.3,10.7z" />
                                    </svg>
                                </button>
                            </div>
                            <div class="decor block-sale__header-decor decor--type--center">
                                <div class="decor__body">
                                    <div class="decor__start"></div>
                                    <div class="decor__end"></div>
                                    <div class="decor__center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-sale__body">
                        <div class="decor block-sale__body-decor decor--type--bottom">
                            <div class="decor__body">
                                <div class="decor__start"></div>
                                <div class="decor__end"></div>
                                <div class="decor__center"></div>
                            </div>
                        </div>
                        <div class="block-sale__image" style="background-image: url('{{asset('web/images/sale-1903x640.jpg')}}');"></div>
                        <div class="container-fluid">
                            <div class="block-sale__carousel">
                                <div class="owl-carousel">
                                    @if (isset($related_product) && !empty($related_product))
                                        @foreach ($related_product as $item)
                                            <div class="block-sale__item">
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
                                                        <a href="{{route('web.productDetail',['slug'=>$item->slug,'id'=>$item->id])}}"><img src="{{asset('images/products/'.$item->main_image.'')}}" alt=""></a>
                                                    </div>
                                                    <div class="product-card__info">
                                                        <div class="product-card__meta"><span class="product-card__meta-title">SKU:</span> 140-10440-B</div>
                                                        <div class="product-card__name">
                                                            <div>
                                                                <a href="{{route('web.productDetail',['slug'=>$item->slug,'id'=>$item->id])}}">{{$item->name}}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-card__footer">
                                                        <div class="product-card__prices">
                                                            @if (isset($item->minSize) && isset($item->minSize[0]))
                                                                <div class="product-card__price product-card__price--old">{{$item->minSize[0]->mrp}}</div>
                                                                <div class="product-card__price product-card__price--current">{{$item->minSize[0]->customer_price}}</div>
                                                            @endif
                                                        </div>
                                                        <a class="product-card__addtocart-icon" aria-label="Add to cart" href="{{route('web.productDetail',['slug'=>$item->slug,'id'=>$item->id])}}">
                                                            <i class="fa fa-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    {{-- <div class="block-sale__item">
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
                                                <a href="shop-detail.php"><img src="{{asset('web/images/products/2b.jpg')}}" alt=""></a>
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
                                    <div class="block-sale__item">
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
                                                <a href="shop-detail.php"><img src="{{asset('web/images/products/3c.jpg')}}" alt=""></a>
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
                                    <div class="block-sale__item">
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
                                                <a href="shop-detail.php"><img src="{{asset('web/images/products/4d.jpg')}}" alt=""></a>
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
                                    <div class="block-sale__item">
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
                                                <a href="shop-detail.php"><img src="{{asset('web/images/products/1b.jpg')}}" alt=""></a>
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
                                    <div class="block-sale__item">
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
                                                <a href="shop-detail.php"><img src="{{asset('web/images/products/2c.jpg')}}" alt=""></a>
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
                                    <div class="block-sale__item">
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
                                                <a href="shop-detail.php"><img src="{{asset('web/images/products/3d.jpg')}}" alt=""></a>
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
                                    <div class="block-sale__item">
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
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                
            @endif
        </div>
        <!-- site__body / end -->
        <!-- site__footer -->
	@endsection
	
    @section('script')
        <script>
            function getSize(id) {
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:"GET",
                    url:"{{url('product/size/')}}/"+id+"",
                    // beforeSend: function() {
                    //     $('#delivery_info').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');    
                    // },
                    success:function(data){    
                                        
                        $("#price_div").html(data);  
                    }
                })
            }
            
        </script>
	@endsection
    