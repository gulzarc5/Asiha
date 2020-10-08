@extends('web.templet.master')
@section('head')
<meta name="description" content="description">
@endsection
@section('content')
@if (isset($product) && !empty($product))

<!-- Single Products Section Start -->
<div class="section section-fluid section-padding border-top-dashed bg-white">
   <div class="container">
      <div class="row ashia-mb-n40">

         <!-- Product Images Start -->
         <div class="col-lg-6 col-12 ashia-mb-40">
            <div class="product-images vertical">
               <div>
                    <button class="product-gallery-popup hintT-left" data-hint="Click to enlarge"
                    data-images='[
                    @foreach ($product->images as $key => $item)
                        @if ($key+1 == $product->images->count())
                            {"src": "{{asset('images/products/thumb/'.$item->image.'')}}", "w": 810, "h": 1080}
                        @else
                            {"src": "{{asset('images/products/thumb/'.$item->image.'')}}", "w": 810, "h": 1080},
                        @endif
                    @endforeach
                    ]'><i class="far fa-expand"></i>
                    </button>
               </div>
                <div class="product-gallery-slider">
                    @foreach ($product->images as $item)
                    <div class="product-zoom" data-image="{{asset('images/products/'.$item->image.'')}}">
                        <img src="{{asset('images/products/'.$item->image.'')}}" alt="">
                    </div>
                    @endforeach
                </div>
                <div class="product-thumb-slider-vertical">
                    @foreach ($product->images as $item)
                        <div class="item">
                            <img src="{{asset('images/products/thumb/'.$item->image.'')}}" alt="">
                        </div>
                    @endforeach
                </div>
            </div>
         </div>
         <!-- Product Images End -->

         <!-- Product Summery Start -->
         @php
            $min_size = $min_size[0];
         @endphp
         <div class="col-lg-6 col-12 ashia-mb-40">
            <form id="cart-form" action="{{route('web.add_direct_cart',['product_id'=>$product->id])}}" method="POST" >
               @csrf
                <div class="product-summery">
                    <h3 class="product-title">{{$product->name}}</h3>
                    <div class="product-price"><span class="old">₹{{number_format($min_size->mrp,2,".",'')}}</span>₹{{number_format($min_size->price,2,".",'')}} </div>
                    <div class="product-description">
                        <p>{{$product->short_description}}</p>
                    </div>
                    <div class="product-variations">
                        <table>
                            <tbody>
                                @if (isset($product_color) && !empty($product_color) && (count($product_color) > 0))
                                <tr>
                                    <td class="label"><span>Color</span></td>
                                    <td class="value">
                                        <div class="product-colors">

                                            @php
                                            $color_count = true;
                                            @endphp
                                            @foreach ($product_color as $item)
                                                @if ($color_count)
                                                <label class="clr-container">
                                                    <input type="radio" checked="checked" name="color" value="{{$item->color_id}}">
                                                    <span class="clr-checkmark" style="background-color:{{$item->color->color}}"></span>
                                                </label>
                                                @php
                                                    $color_count = false;
                                                @endphp
                                                @else
                                                <label class="clr-container">
                                                    <input type="radio"  name="color" value="{{$item->color_id}}">
                                                    <span class="clr-checkmark" style="background-color:{{$item->color->color}}"></span>
                                                </label>
                                                @endif
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                @if (isset($product_sizes) && !empty($product_sizes) && (count($product_sizes) > 0))
                                <tr>
                                    <td class="label"><span>Size</span></td>
                                    <td class="value">
                                        <div class="product-sizes">
                                        @php
                                            $size_count = true;
                                        @endphp
                                            @foreach ($product_sizes as $item)
                                                @if ($size_count)
                                                <label class="size-container">
                                                    <input type="radio"  value="{{$item->size_id}}" name="size_id" checked>
                                                    <span class="size-checkmark">{{$item->size->name}}</span>
                                                </label>
                                                @php
                                                    $size_count = false;
                                                @endphp
                                                @else
                                                <label class="size-container">
                                                    <input type="radio"   value="{{$item->size_id}}" name="size_id">
                                                    <span class="size-checkmark">{{$item->size->name}}</span>
                                                </label>
                                                @endif
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="label"><span>Quantity</span></td>
                                    <td class="value">
                                        <div class="product-quantity">
                                            <span class="qty-btn minus"><i class="ti-minus"></i></span>
                                            <input type="text" name="quantity" class="input-qty" value="1">
                                            <span class="qty-btn plus"><i class="ti-plus"></i></span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="product-buttons">
                        <a href="{{route('web.add_wish_list',['product_id'=>$product->id])}}" class="btn btn-icon btn-outline-body btn-hover-dark hintT-top" data-hint="Add to Wishlist"><i class="fal fa-heart"></i></a>
                        <button class="btn btn-dark btn-outline-hover-dark"><i class="fal fa-shopping-cart"></i> Add to Cart</button>
                    </div>
                    <b class="size-chart">see size chart</b>
                    <div class="szi-cht table-responsive ashia-pt-20">
                        <img src="{{asset('images/products/'.$product->size_chart.'')}}" alt="">
                    </div>
                </div>
            </form>
         </div>
         <!-- Product Summery End -->
      </div>
   </div>
</div>
<!-- Single Products Section End -->

<!-- Single Products Infomation Section Start -->
<div class="section section-fluid section-padding border-top-dashed pattern-bg" style="background-attachment: fixed;">
   <div class="container">
      <ul class="nav product-info-tab-list">
         <div class="section-title ashia-mb-10">
            <h3 class="sub-title">Description</h3>
         </div>
      </ul>
      <div class="tab-content product-infor-tab-content">
         <div class="tab-pane fade show active" id="tab-description">
            <div class="row">
               <div class="col-12 mx-auto">
                  <p>{{$product->description}}</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Single Products Infomation Section End -->

<!-- Shop By top product Start -->

<div class="section section-fluid section-padding bg-white border-top-dashed border-bottom-dashed">
   <div class="container">
      <!-- Section Title Start -->
      <div class="section-title text-center">
         <h2 class="title title-icon-both">Related items</h2>
      </div>
      <!-- Section Title End -->
      <!-- Products Start -->
      <div class="product-carousel popular-item">
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
         {{-- <div class="col">
            <div class="product">
               <div class="product-thumb">
                  <a href="{{route('web.product.product-detail')}}" class="image">
                  <img src="{{asset('web/images/product/s328/more.jpg')}}" alt="Product Image">
                  </a>
               </div>
            </div>
         </div> --}}
      </div>
      <!-- Products End -->
   </div>
</div>
<!-- Shop By top product End -->
<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
   <!-- Background of PhotoSwipe.
      It's a separate element as animating opacity is faster than rgba(). -->
   <div class="pswp__bg" style="background-color:#fff"></div>
   <!-- Slides wrapper with overflow:hidden. -->
   <div class="pswp__scroll-wrap">
      <!-- Container that holds slides.
         PhotoSwipe keeps only 3 of them in the DOM to save memory.
         Don't modify these 3 pswp__item elements, data is added later on. -->
      <div class="pswp__container">
         <div class="pswp__item"></div>
         <div class="pswp__item"></div>
         <div class="pswp__item"></div>
      </div>
      <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
      <div class="pswp__ui pswp__ui--hidden">
         <div class="pswp__top-bar">
            <!--  Controls are self-explanatory. Order can be changed. -->
            <div class="pswp__counter"></div>
            <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
            <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
            <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
            <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
            <!-- element will get class pswp__preloader--active when preloader is running -->
            <div class="pswp__preloader">
               <div class="pswp__preloader__icn">
                  <div class="pswp__preloader__cut">
                     <div class="pswp__preloader__donut"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
            <div class="pswp__share-tooltip"></div>
         </div>
         <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
         </button>
         <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
         </button>
         <div class="pswp__caption">
            <div class="pswp__caption__center"></div>
         </div>
      </div>
   </div>
</div>
@endif
@endsection
@section('script')
@endsection
