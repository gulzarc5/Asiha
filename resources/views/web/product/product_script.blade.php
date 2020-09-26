<script>
    function fetchData(page) {

        var category_id_filter = $("#category_id").val();
        var type_filter = $("#type_filter").val(); //type 1 = main cat, 2 = sub cat, 3 = third cat

        var sort = $("#product_sort").val();

        var filter_color = $("input[name='color']:checked").map(function(){return $(this).val();}).get();

        var filter_designers = new Array();
        $("input:checkbox[name=designer]:checked").each(function(){
            filter_designers.push($(this).val());
        });

        var filter_sizes = new Array();
        $("input:checkbox[name=size]:checked").each(function(){
            filter_sizes.push($(this).val());
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:"POST",
            url:"{{ route('api.product_filter')}}",
            data:{
                "_token": "{{ csrf_token() }}",
                category:category_id_filter,
                prices:prices,
                colors:filter_color,
                designers:filter_designers,
                sizes:filter_sizes,
                sort:sort,
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


                var response = data;
                // console.log(data);
                if (response.products) {
                product_Html(response.products);
                }
            }
        });
    }
</script>
