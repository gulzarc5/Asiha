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
                            @if (isset($sub_cat))
                            <a href="#">{{$sub_cat->name}}</a>
                            <p> - {{$sub_cat->productCount->count()}} items</p>
                            @endif

                            @if (isset($third_cat) && !empty($third_cat))
                                <a href="#">{{$third_cat->name}}</a>
                                <p><b>{{$third_cat->subCategory->name}}</b> - {{$third_cat->productCount->count()}} items</p>
                            @endif

                        </div>
                    </div>
                    <!-- Isotop Filter End -->

                    <div class="col-md-auto col-12 ashia-mb-20">
                        <ul class="shop-toolbar-controls">

                            <li>
                                <div class="product-sorting">
                                    <select class="nice-select" name="sort" id="product_sort" onchange="fetchData()">
                                        <option value="title_asc">Sort by Title : A-z</option>
                                        <option value="title_desc">Sort by Title : Z-A</option>
                                        <option value="latest" selected>Default Sort by latest First</option>
                                        <option value="price_low">Sort by price: Low to High</option>
                                        <option value="price_high">Sort by price: High to Low</option>
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

                    <div class="col-lg-9 col-12 ashia-mb-50 order-lg-2" id="pagination_data">
                        <!-- Products Start -->
                        @include('web.product.product_pagination_list_page')
                    </div>

                    <div class="col-lg-3 col-12 ashia-mb-10 order-lg-1">
                        <input type="hidden" id="category_id" value="{{$category_id}}">
                        <input type="hidden" id="type_filter" value="{{$type}}">
                        <!-- Categories Start -->
                        @if (isset($category) && !empty($category) && (count($category) > 0))
                        <div class="single-widget border-right-dashed ashia-pb-20 ashia-pt-20">
                            <h3 class="widget-title product-filter-widget-title">Categories</h3>
                            <ul class="widget-list">
                                @foreach ($category as $item)
                                    @if ($type == 1)
                                        <li><a href="{{route('web.product_list',['cat_slug'=>"$item->slug",'category_id'=>$item->id,'type' => 1])}}">{{$item->name}}</a> <span class="count">{{$item->productCount->count()}}</span></li>
                                    @elseif($type == 2)
                                        <li><a href="{{route('web.product_list',['cat_slug'=>"$item->slug",'category_id'=>$item->id,'type' => 2])}}">{{$item->name}}</a> <span class="count">{{$item->productCount->count()}}</span></li>
                                    @else
                                        <li><a href="{{route('web.product_list',['cat_slug'=>"$item->slug",'category_id'=>$item->id,'type' => 3])}}">{{$item->name}}</a> <span class="count">{{$item->productCount()->count()}}</span></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <!-- Categories End -->

                        <!-- Price Range Start -->

                        <div class="single-widget border-top-dashed border-right-dashed ashia-pb-20 ashia-pt-20">
                            <h3 class="widget-title product-filter-widget-title">Price</h3>
                            <ul class="widget-list">
                                <li><a><input type="checkbox" name="price_range" value="1" onclick="fetchData()">₹0 - ₹500</a> <span class="count">{{$price_0_500}}</span></li>
                                <li><a><input type="checkbox" name="price_range" value="2" onclick="fetchData()">₹501 - ₹1000</a>  <span class="count">{{$price_0_1000}}</span></li>
                                <li><a><input type="checkbox" name="price_range" value="3" onclick="fetchData()">₹1001 - ₹1500</a> <span class="count">{{$price_0_1500}}</span></li>
                                <li><a><input type="checkbox" name="price_range" value="4" onclick="fetchData()">₹1501 - Above</a>  <span class="count">{{$price_0_1500}}</span></li>
                            </ul>
                        </div>
                        <!-- Price Range End -->

                        <!-- Brands Start -->
                        @if (isset($brands) && !empty($brands) && (count($brands) > 0))
                        <div class="single-widget border-top-dashed border-right-dashed ashia-pb-20 ashia-pt-20">
                            <h3 class="widget-title product-filter-widget-title">Brand</h3>
                            <ul class="widget-list">
                                @foreach ($brands as $item)
                                    <li><a><input type="checkbox" name="brand" value="{{$item->id}}" onclick="fetchData()">{{$item->name}}</a> <span class="count">{{$item->count}}</span></li>
                                 @endforeach
                            </ul>
                        </div>
                        @endif
                        <!-- Brands End -->

                        <!-- Sizes Start -->
                        @if (isset($sizes) && !empty($sizes) && (count($sizes) > 0))
                         <div class="single-widget border-top-dashed border-right-dashed ashia-pb-20 ashia-pt-20">
                            <h3 class="widget-title product-filter-widget-title">Sizes</h3>
                            <ul class="widget-list">
                                @foreach ($sizes as $item)
                                <li><a><input type="checkbox" name="size" value="{{$item->size_id}}" onclick="fetchData()">{{$item->size_name}}</a> <span class="count">{{$item->product_count}}</span></li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <!-- Sizes End -->

                        <!-- Colors Start -->
                        @if (isset($colors) && !empty($colors) && (count($colors) > 0))
                         <div class="single-widget border-top-dashed border-right-dashed ashia-pb-20 ashia-pt-20">
                            <h3 class="widget-title product-filter-widget-title">Colors</h3>
                            <ul class="widget-list">
                                @foreach ($colors as $item)
                                <li><a><input type="checkbox" name="color" value="{{$item->color_id}}" onclick="fetchData()">{{$item->color_name}}</a> <span class="count">{{$item->product_count}}</span></li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <!-- Colors End -->
                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- Shop Products Section End -->
@endsection

@section('script')
    @include('web.product.product_script');
@endsection
