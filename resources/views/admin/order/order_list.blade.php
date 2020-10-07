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
                    <div class="col-md-8">

                        <h2>New Orders</h2>
                    </div>
                    <div class="col-md-4">
                        <form action="">
                            <div class="col-md-10">
                                <input type="text" name="search_key" id="" class="form-control" placeholder="Search By Order Id">
                            </div>
                            <div class="col-md-2" style="margin: 0;padding: 0;">
                                <button type="submit" class="btn btn-sm btn-success" style="padding: 6px !important;">Search</button>
                            </div>
                        </form>
                    </div>
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
                                <th class="column-title">Order Status</th>
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
                                        <td><b>{{ number_format($order->total_amount,2,".",'') }}</b></td>
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

                                        <td>
                                            @if ($order->order_status == 1)
                                                <button class="btn btn-sm btn-warning">New Order</button>
                                            @elseif($order->order_status == 2)
                                                <button class="btn btn-sm btn-info">Packed</button>
                                            @elseif($order->order_status == 3)
                                                <button class="btn btn-sm btn-primary">Shipped</button>
                                            @elseif($order->order_status == 4)
                                                <button class="btn btn-sm btn-success">Delivered</button>
                                            @elseif($order->order_status == 5)
                                                <button class="btn btn-sm btn-danger">cancelled</button>
                                            @elseif($order->order_status == 6)
                                                <button class="btn btn-sm btn-warning">Return request</button>
                                            @else
                                                <button class="btn btn-sm btn-success">Refunded</button>
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
                                                        <td>{{ ($item->quantity * $item->price) - ((($item->quantity * $item->price) * $item->discount)/100) }}</td>
                                                        <td id="status{{$order->id}}{{$item->id}}">
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
                                                                <button class="btn btn-sm btn-success">Returned</button>
                                                            @endif
                                                        </td>
                                                        <td id="action{{$order->id}}{{$item->id}}">
                                                            @if ($order->payment_type == 2 && $order->payment_status == '3' && $order->order_status != '5')
                                                                <button class="btn btn-sm btn-danger" onclick="openModal({{$item->id}},'5',{{$order->id}}{{$item->id}},'Are You Sure To Cancel ? ')">Cancel</button>
                                                            @else
                                                                @if ($item->order_status == 1)
                                                                    <button class="btn btn-sm btn-info" onclick="openModal({{$item->id}},'2',{{$order->id}}{{$item->id}},'Are You Sure To Packed ? ')">Packed</button>
                                                                    @if ($order->payment_type == 2 && $order->payment_status == '2')
                                                                        <a class="btn btn-sm btn-danger" href="{{route('admin.order_refund_info_form',['order_item_id'=>$item->id])}}">Cancel</a>
                                                                    @else
                                                                        <button class="btn btn-sm btn-danger" onclick="openModal({{$item->id}},'5',{{$order->id}}{{$item->id}},'Are You Sure To Cancel ? ')">Cancel</button>
                                                                    @endif
                                                                @elseif($item->order_status == 2)
                                                                    <button class="btn btn-sm btn-primary" onclick="openModal({{$item->id}},'3',{{$order->id}}{{$item->id}},'Are You Sure To Shipped ? ')">Shipped</button>
                                                                    @if ($order->payment_type == 2 && $order->payment_status == '2')
                                                                        <a class="btn btn-sm btn-danger" href="{{route('admin.order_refund_info_form',['order_item_id'=>$item->id])}}">Cancel</a>
                                                                    @else
                                                                        <button class="btn btn-sm btn-danger" onclick="openModal({{$item->id}},'5',{{$order->id}}{{$item->id}},'Are You Sure To Cancel ? ')">Cancel</button>
                                                                    @endif
                                                                @elseif($item->order_status == 3)
                                                                    <button class="btn btn-sm btn-success" onclick="openModal({{$item->id}},'4',{{$order->id}}{{$item->id}},'Are You Sure To Delivered ? ')">Delivered</button>
                                                                    @if ($order->payment_type == 2 && $order->payment_status == '2')
                                                                        <a class="btn btn-sm btn-danger" href="{{route('admin.order_refund_info_form',['order_item_id'=>$item->id])}}">Cancel</a>
                                                                    @else
                                                                        <button class="btn btn-sm btn-danger" onclick="openModal({{$item->id}},'5',{{$order->id}}{{$item->id}},'Are You Sure To Cancel ? ')">Cancel</button>
                                                                    @endif
                                                                @elseif($item->order_status == 4)
                                                                    ------
                                                                @elseif($item->order_status == 5)
                                                                    ------
                                                                @elseif($item->order_status == 6)
                                                                    ------
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
					        $("#status"+action_id).html('<i class="fa fa-spinner fa-spin"></i>');
					        $("#action"+action_id).html('<i class="fa fa-spinner fa-spin"></i>');
					    },
						success:function(data){
                            if (status == '2') {
                                $("#status"+action_id).html('<button class="btn btn-sm btn-info">Packed</button>');
                                $("#action"+action_id).html(`<button class="btn btn-sm btn-primary" onclick="openModal(${order_item_id},'3',${action_id},'Are You Sure To Shipped ?')">Shipped</button>`);
                            } else if (status == '3') {
                                $("#status"+action_id).html('<button class="btn btn-sm btn-primary">Shipped</button>');
                                $("#action"+action_id).html(`<button class="btn btn-sm btn-success" onclick="openModal(${order_item_id},'3',${action_id},'Are You Sure To Delivered ? ')">Delivered</button>`);
                            }else if(status == '4'){
                                $("#status"+action_id).html('<button class="btn btn-sm btn-success">Delivered</button>');
                                $("#action"+action_id).html('---');
                            }else{
                                $("#status"+action_id).html('<button class="btn btn-sm btn-danger">cancelled</button>');
                                $("#action"+action_id).html('----');
                            }

						}
					});
                }
            } catch(err) {
            console.log(err);
            }

        }
     </script>

 @endsection
