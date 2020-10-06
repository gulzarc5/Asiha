@extends('admin.template.admin_master')

@section('content')
<style>
    .btn{
        padding:2px !important;
    }
</style>
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
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings" style="font-size: 10.5px;">
                                    <th class="column-title">Sl No. </th>
                                    <th class="column-title">Order ID</th>
                                    <th class="column-title">Order By</th>
                                    <th class="column-title">Amount</th>
                                    <th class="column-title">Payment Type</th>
                                    <th class="column-title">Payment Status</th>
                                    <th class="column-title">Date</th>
                                    <th class="column-title" style="min-width: 168px;">Action</th>
                            </thead>

                            <tbody>

                            	@if(isset($orders) && !empty($orders) && count($orders) > 0)
                            	@php
                            		$count = 1;
                            	@endphp

                            	@foreach($orders as $order)
                                <tr class="even pointer">
                                    <td class=" ">{{ $count++ }}</td>
                                    <td class=" ">{{ $order->id }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ number_format($order->amount,2,".",'') }}</td>
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
                                        <a href="#" class="btn btn-sm btn-primary" onclick="return confirm('Are You Sure To Delivered ? ')">delivered</a>
                                        <a href="#" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure To Cancel ? ')">Cancel</a>
                                        <a href="#" class="btn btn-sm btn-warning">view</a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                	<tr>
	                                    <td colspan="8" style="text-align: center">Sorry No Data Found</td>
                                	</tr>
                                @endif
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
            var table = $('#category').DataTable();
        });
     </script>

 @endsection
