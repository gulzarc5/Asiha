@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>All Orders</h2>
    	            <div class="clearfix"></div>
              </div>
    	        <div>
    	            <div class="x_content">
                        <table id="size_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                                <th>Sl No. </th>
                                <th>Order ID</th>
                                <th>Order By</th>
                                <th>Amount</th>
                                <th>Order Status</th>
                                <th>Payment Type</th>
                                <th>Payment Status</th>
                                <th>Date</th>
                                <th style="min-width: 168px;">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
    	            </div>
    	        </div>
    	    </div>
    	</div>
    </div>
	</div>


 @endsection

@section('script')

  <script type="text/javascript">
      $(function () {

        var table = $('#size_list').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.order_list_ajax') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'id', name: 'id',searchable: true},
                {data: 'user_name', name: 'user_name',searchable: true},
                {data: 'amount_data', name: 'amount_data' ,searchable: true},
                {data: 'order_status', name: 'order_status', render:function(data, type, row){
                  if (row.order_status == '1') {
                    return "<button class='btn btn-sm btn-warning'>New Order</a>"
                  }else if (row.order_status == '2') {
                    return "<button class='btn btn-sm btn-primary'>Dispatched</a>"
                  }else if (row.order_status == '3') {
                    return "<button class='btn btn-sm btn-success'>Delivered</a>"
                  }else{
                    return "<button class='btn btn-sm btn-danger'>Cancelled</a>"
                  }
                }},
                {data: 'payment_type', name: 'payment_type', render:function(data, type, row){
                  if (row.payment_type == '1') {
                    return "<button class='btn btn-sm btn-primary'>COD</a>"
                  }else{
                    return "<button class='btn btn-sm btn-success'>Online</a>"
                  }
                }},
                {data: 'payment_status', name: 'payment_status', render:function(data, type, row){
                  if (row.payment_status == '1') {
                    return "<button class='btn btn-sm btn-primary'>COD</a>"
                  }else if (row.payment_status == '2') {
                    return "<button class='btn btn-sm btn-success'>Paid</a>"
                  }else{
                    return "<button class='btn btn-sm btn-danger'>Failed</a>"
                  }
                }},
                {data: 'created_at', name: 'created_at' ,searchable: true},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

    });
  </script>

{{-- <script>
  function export_excel(){
  window.location.href = "{{route('admin.product_list_excel')}}";
}
</script> --}}

 @endsection
