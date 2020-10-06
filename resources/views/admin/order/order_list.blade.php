@extends('admin.template.admin_master')

@section('content')
<style>
    .btn{
        padding:2px !important;
    }
</style>

<link rel="stylesheet" href="{{asset('admin/dialog_master/simple-modal.css')}}">

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>New Orders</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="table-responsive">

                        <table class="table table-striped jambo_table bulk_action table-hover">
                            <thead>
                              <tr>
                                <th class="column-title">Sl No. </th>
                                <th class="column-title">Order ID</th>
                                <th class="column-title">Order By</th>
                                <th class="column-title">Amount</th>
                                <th class="column-title">Payment Type</th>
                                <th class="column-title">Payment Status</th>
                                <th class="column-title">Date</th>
                                <th class="column-title" style="min-width: 168px;">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @if(isset($orders) && !empty($orders) && count($orders) > 0)
                            	@php
                            		$count = 1;
                            	@endphp
                                    @foreach($orders as $order)
                                    <tr data-toggle="collapse" id="table{{$count}}" data-target=".table{{$count}}">
                                        <td class=" ">{{ $count }}</td>
                                        <td class=" ">{{ $order->id }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td><b>{{ number_format($order->amount,2,".",'') }}</b></td>
                                        <td class=" ">
                                            @if($order->payment_type == '1')
                                                <button class='btn btn-sm btn-primary'>COD</button>
                                            @else
                                                <button class='btn btn-sm btn-success'>Online</button>
                                            @endif
                                        </td>
                                        <td class=" ">
                                            @if($order->payment_status == '1')
                                            <a href="#" class="btn btn-sm btn-primary">COD</a>
                                            @elseif($order->payment_status == '2')
                                                <a href="#" class="btn btn-sm btn-success">Paid</a>
                                            @else
                                                <a href="#" class="btn btn-sm btn-danger">Failed</a>
                                            @endif
                                        </td>

                                        <td>{{ $order->created_at }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary">View More</button>
                                            <a href="{{route('admin.order_details',['order_id'=>$order->id])}}" class="btn btn-sm btn-warning" target="_blank">Print Invoice</a>
                                        </td>
                                    </tr>

                                    <tr class="collapse table{{$count}}">
                                        <td colspan="999">
                                          <div>
                                            <table class="table table-hover" style="color: black;background: white;">
                                              <thead style="background: white;color: black;">
                                                <tr>
                                                  <th>Item Order Id</th>
                                                  <th>Product Name</th>
                                                  <th>Size</th>
                                                  <th>Quantity</th>
                                                  <th>Discount</th>
                                                  <th>Total Amount</th>
                                                  <th>Order Status</th>
                                                  <th>Action</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                  @foreach ($order->orderDetails as $item)
                                                    <tr>
                                                        <td>{{$order->id}}-A-{{$item->id}}</td>
                                                        <td>{{$item->product->name}}</td>
                                                        <td>{{$item->size}}</td>
                                                        <td>{{$item->quantity}}</td>
                                                        <td>
                                                            @if ($item->discount > 0)
                                                               {{((($item->quantity * $item->price) * $item->discount)/100) }}
                                                            @else
                                                                0.00
                                                            @endif
                                                        </td>
                                                        <td>{{ $item->quantity * $item->price }}</td>
                                                        <td>
                                                            @if ($item->order_status == 1)
                                                                <button class="btn btn-sm btn-warning">New Order</button>
                                                            @elseif($item->order_status == 2)
                                                                <button class="btn btn-sm btn-info">Packed</button>
                                                            @elseif($item->order_status == 3)
                                                                <button class="btn btn-sm btn-primary">Shipped</button>
                                                            @elseif($item->order_status == 4)
                                                                <button class="btn btn-sm btn-success">Delivered</button>
                                                            @elseif($item->order_status == 5)
                                                                <button class="btn btn-sm btn-danger">cancelled</button>
                                                            @elseif($item->order_status == 6)
                                                                <button class="btn btn-sm btn-warning">Return request</button>
                                                            @else
                                                                <button class="btn btn-sm btn-success">Refunded</button>
                                                            @endif
                                                        </td>
                                                        <td id="a{{$order->id}}{{$item->id}}">
                                                            @if ($order->payment_type == 2 && $order->payment_status == '3')
                                                                <button class="btn btn-sm btn-danger" onclick="openModal({{$item->id}},'4',{{$order->id}}{{$item->id}},'Are You Sure To Cancel ? ')">Cancel</button>
                                                            @else
                                                                @if ($item->order_status == 1)
                                                                    <button class="btn btn-sm btn-info" onclick="return confirm('Are You Sure To Packed ? ')">Packed</button>
                                                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure To Cancel ? ')">Cancel</button>
                                                                @elseif($item->order_status == 2)
                                                                    <button class="btn btn-sm btn-primary" onclick="return confirm('Are You Sure To Shipped ? ')">Shipped</button>
                                                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure To Cancel ? ')">Cancel</button>
                                                                @elseif($item->order_status == 3)
                                                                    <button class="btn btn-sm btn-success" onclick="return confirm('Are You Sure To Delivered ? ')">Delivered</button>
                                                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure To Cancel ? ')">Cancel</button>
                                                                @elseif($item->order_status == 4)
                                                                    <button class="btn btn-sm btn-success" onclick="return confirm('Are You Sure To Return item ? ')">Return Item</button>
                                                                @elseif($item->order_status == 5)
                                                                    ------
                                                                @elseif($item->order_status == 6)
                                                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure To Refund Completed ? ')">Refunded</button>
                                                                @else
                                                                    -------
                                                                @endif
                                                            @endif
                                                        </td>
                                                    </tr>

                                                  @endforeach

                                              </tbody>
                                            </table>
                                          </div>
                                        </td>
                                      </tr>
                                      @php
                                          $count++
                                      @endphp
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        {!! $orders->onEachSide(2)->links() !!}
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
            var table = $('#category').DataTable();
        });
     </script>


    <script src="{{asset('admin/dialog_master/simple-modal.js')}}"></script>
     <script>
        //  function orderUpdate(order_list_id,status) {
        //     alert(order_list_id+" ---  "+status);
        //  }

         async function openModal(order_item_id,status,action_id,msg) {
            this.myModal = new SimpleModal("Attention!", msg);

            try {
                const modalResponse = await myModal.question();
                if (modalResponse) {
                    $.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
					$.ajax({
						type:"GET",
						url:"{{url('admin/order/update/status')}}"+"/"+order_item_id+"/"+status,

						beforeSend: function() {
					        // setting a timeout
					        $("#a"+action_id).html('<i class="fa fa-spinner fa-spin"></i>');
					    },
						success:function(data){
					        $("#a"+action_id).html('<button class="btn btn-sm btn-success" disabled>Updated</button>');
						}
					});
                }
            } catch(err) {
            console.log(err);
            }

        }
     </script>

 @endsection
