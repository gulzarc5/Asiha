@if (isset($products) && !empty($products) && count($products) > 0)
<div class="products row row-cols-xl-4 row-cols-md-3 row-cols-sm-2 row-cols-1" id="product_data">
    @foreach ($products as $product)
    <div class="col">
        <div class="product">
            <div class="product-thumb">
                <a href="{{route('web.product_detail',['slug'=>$product->slug,'product_id'=>$product->id])}}" class="image">
                    <img src="{{asset('images/products/thumb/'.$product->main_image.'')}}" alt="Product Image">
                </a>
            </div>
            <div class="product-info">
                <h6 class="title"><a href="{{route('web.product_detail',['slug'=>$product->slug,'product_id'=>$product->id])}}">{{$product->name}}</a></h6>
                <span class="price">
                    <span class="old">{{$product->mrp}}</span>
                <span class="new">{{$product->min_price}}</span>
                </span>
                <div class="product-buttons">
                    <a href="{{ route('web.add_wish_list',['product_id'=>$product->id]) }}" class="product-button hintT-top" data-hint="Add to wishlist"><i class="far fa-heart"></i></a>
                    <a href="{{route('web.add_direct_cart',['product_id'=>$product->id])}}" class="product-button hintT-top" data-hint="Add to Cart"><i class="fal fa-shopping-cart"></i></a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!-- Products End -->
<div class="text-center ashia-mt-70" id="loader_pagination"></div>
@if (isset($total_page) && ($total_page > 1))
<div class="text-center ashia-mt-70" id="more_div">
    <input type="hidden" name="page" value="1" id="page">
    <button class="btn btn-dark btn-outline-hover-dark"  onclick="pageData()"><i class="ti-plus"></i> More</button>
</div>
@endif

@endif
