<script>
    function fetchData() {
        var category_id_filter = $("#category_id").val();
        var type_filter = $("#type_filter").val(); //type 1 = main cat, 2 = sub cat, 3 = third cat

        var sort = $("#product_sort").val();

        // var filter_color = $("input[name='color']:checked").map(function(){return $(this).val();}).get();

        var brand = new Array();
        $("input:checkbox[name=brand]:checked").each(function(){
            brand.push($(this).val());
        });

        var colors = new Array();
        $("input:checkbox[name=color]:checked").each(function(){
            colors.push($(this).val());
        });

        var sizes = new Array();
        $("input:checkbox[name=size]:checked").each(function(){
            sizes.push($(this).val());
        });

        var price_range = new Array();
        $("input:checkbox[name=price_range]:checked").each(function(){
            price_range.push($(this).val());
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:"POST",
            url:"{{ route('web.product_list_filter')}}",
            data:{
                "_token": "{{ csrf_token() }}",
                category:category_id_filter,
                type:type_filter,
                price_range:price_range,
                colors:colors,
                brand:brand,
                sizes:sizes,
                sort:sort,
            },
            // beforeSend:function() {
            //     $('#myModal').modal('show');
            //     $("#myModal").removeClass("mfp-hide");
            // },
            // complete:function() {
            //     $('#myModal').modal('hide');
            //     $("#myModal").addClass("mfp-hide");
            // },
            success:function(data){
                $("#pagination_data").html(data);
            }
        });
    }

    function pageData() {
        var page = parseInt($("#page").val());
        page = page+1;
        $("#page").val(page);
        getPaginationData(page);
    }

    function getPaginationData(page){
        var category_id_filter = $("#category_id").val();
        var type_filter = $("#type_filter").val(); //type 1 = main cat, 2 = sub cat, 3 = third cat

        var sort = $("#product_sort").val();

        // var filter_color = $("input[name='color']:checked").map(function(){return $(this).val();}).get();

        var brand = new Array();
        $("input:checkbox[name=brand]:checked").each(function(){
            brand.push($(this).val());
        });

        var colors = new Array();
        $("input:checkbox[name=color]:checked").each(function(){
            colors.push($(this).val());
        });

        var sizes = new Array();
        $("input:checkbox[name=size]:checked").each(function(){
            sizes.push($(this).val());
        });

        var price_range = new Array();
        $("input:checkbox[name=price_range]:checked").each(function(){
            price_range.push($(this).val());
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:"POST",
            url:"{{ route('web.product_list_filter')}}",
            data:{
                "_token": "{{ csrf_token() }}",
                category:category_id_filter,
                type:type_filter,
                price_range:price_range,
                colors:colors,
                brand:brand,
                sizes:sizes,
                sort:sort,
                page:page,
            },
            success:function(data){
               if (data.total_page == data.page) {
                $("#more_div").hide();
               }
               productsHtml(data.products);
            },
        });
    }

    function productsHtml(products) {
        var product_html = '';
        if (products.length > 0) {
            $.each(products, function(key,products){
                var product_route = '{{route('web.product_detail',['slug' =>':slug','product_id' =>':id'])}}';
                product_route = product_route.replace(':id', products.id);
                product_route = product_route.replace(':slug', products.slug);

                product_html+=`<div class="col">
                <div class="product">
                    <div class="product-thumb">
                        <a href="${product_route}" class="image">
                            <img src="{{asset('images/products/thumb/${products.main_image}')}}" alt="Product Image">
                        </a>
                    </div>
                    <div class="product-info">
                        <h6 class="title"><a href="${product_route}">${products.name}</a></h6>
                        <span class="price">
                            <span class="old">${products.mrp}</span>
                        <span class="new">${products.min_price}</span>
                        </span>
                        <div class="product-buttons">
                            <a href="#" class="product-button hintT-top" data-hint="Add to wishlist"><i class="far fa-heart"></i></a>
                            <a href="#" class="product-button hintT-top" data-hint="Add to Cart"><i class="fal fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
            </div>`;
            });
            $("#product_data").append(product_html);
        }
    }
</script>
