<script>
    function fetchData() {
        var category_id_filter = $("#category_id").val();
        var page = $("#page").val();
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

        console.log(price_range);
        console.log(brand);
        console.log(colors);
        console.log(sizes);
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
                'page':page,
            },
            beforeSend:function() {
                $('#myModal').modal('show');
                $("#myModal").removeClass("mfp-hide");
            },
            complete:function() {
                $('#myModal').modal('hide');
                $("#myModal").addClass("mfp-hide");
            },
            success:function(data){
                $("#pagination_data").html(data);
            }
        });
    }
</script>
