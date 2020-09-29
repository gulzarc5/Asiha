@if (isset($products) && !empty($products) && count($products) > 0)
<div class="products row row-cols-xl-4 row-cols-md-3 row-cols-sm-2 row-cols-1">
    @foreach ($products as $product)
    <div class="col">
        <div class="product">
            <div class="product-thumb">
                <a href="{{route('web.product.product-detail')}}" class="image">
                    <img src="{{asset('images/products/thumb/'.$product->main_image.'')}}" alt="Product Image">
                </a>
            </div>
            <div class="product-info">
                <h6 class="title"><a href="{{route('web.product.product-detail')}}">{{$product->name}}</a></h6>
                <span class="price">
                    <span class="old">{{$product->mrp}}</span>
                <span class="new">{{$product->min_price}}</span>
                </span>
                <div class="product-buttons">
                    <a href="#" class="product-button hintT-top" data-hint="Add to wishlist"><i class="far fa-heart"></i></a>
                    <a href="#" class="product-button hintT-top" data-hint="Add to Cart"><i class="fal fa-shopping-cart"></i></a>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>
<!-- Products End -->
<div class="text-center ashia-mt-70">
    <input type="hidden" name="page" value="1" id="page">
    <a href="#" class="btn btn-dark btn-outline-hover-dark"><i class="ti-plus"></i> More</a>
</div>
@endif
