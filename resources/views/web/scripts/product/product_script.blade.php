<script>
     $(function(){
        $(document).on('click','.pagination a',function(event){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetchProduct(page);
        });
     });

    function getProduct(){
        var sort = $("#sort").val();
        if (!sort) {
            sort = "na";
        }    
        var brand = $("input[name='brand']:checked").map(function(){return $(this).val();}).get();
        getProducts(sort,brand);
    } 

     function fetchProduct(page){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:"GET",
            url:"{{asset('product/list/ajax?page=')}}"+page,
            success:function(data){
                $("#pagination_data").html(data);
            }
        });
     }

    function getProducts(sort,brand){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:"GET",
            url:"{{asset('product/list/ajax/')}}",
            data:{
                "_token": "{{ csrf_token() }}",
                brand:brand,
                sort:sort,
                chanel:1,
            },
            success:function(data){
                $("#pagination_data").html(data);
            }
        });
    }
</script>