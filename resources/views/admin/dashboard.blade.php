@extends('admin.template.admin_master')

@section('content')
<link href="{{asset('admin/vendors/morris.js/morris.css')}}" rel="stylesheet">
<div class="right_col" role="main">
     <!-- top tiles -->
    <div class="row tile_count">
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="text-align: center">
            <span class="count_top"><i class="fa fa-user"></i> Total Customers</span>
            <div class="count green">{{$user_count}}</div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"  style="text-align: center">
            <span class="count_top"><i class="fa fa-user"></i> Total Products</span>
            <div class="count green">{{$products_count}}</div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"  style="text-align: center">
            <span class="count_top"><i class="fa fa-user"></i> New Orders</span>
            <div class="count green">{{$new_order_count}}</div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"  style="text-align: center">
            <span class="count_top"><i class="fa fa-user"></i> Packed Orders</span>
            <div class="count green">{{$packed_order_count}}</div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"  style="text-align: center">
            <span class="count_top"><i class="fa fa-user"></i> Shipped</span>
            <div class="count green">{{$shipped_order_count}}</div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"  style="text-align: center">
            <span class="count_top"><i class="fa fa-clock-o"></i> Return Request</span>
            <div class="count green">{{$return_request_count}}</div>
        </div>
    </div>
    <!-- /top tiles -->

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <div id="order_graph"></div>
            </div>
            <div class="col-md-6">
                <div id="order_graph2"></div>
            </div>
        </div>
        <div class="col-md-12">

            <div class="x_panel">
                  <h2>Orders</h2>
                  <div class="clearfix"></div>
              <div>
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
                          <th class="column-title">Order Status</th>
                          <th class="column-title">Date</th>
                      </tr>
                    </thead>
                    <tbody class="form-text-element">
                      @if(isset($orders) && !empty($orders) && count($orders) > 0)
                      @php
                          $count = 1;
                      @endphp

                      @foreach($orders as $order)
                      <tr class="even pointer">
                          <td class=" ">{{ $count++ }}</td>
                          <td class=" ">{{ $order->id }}</td>
                          <td>{{ $order->user->name }}</td>
                          <td>{{ $order->total_amount }}</td>
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


                          <td id="status{{$count}}">
                                @if($order->order_status == '1')
                                    <button class='btn btn-sm btn-warning' disabled>New Order</button>
                                @elseif($order->order_status == '2')
                                    <button class='btn btn-sm btn-primary' disabled>Packed</button>
                                @elseif($order->order_status == '3')
                                    <button class='btn btn-sm btn-info' disabled>Shipped</button>
                                @elseif($order->order_status == '4')
                                    <button class='btn btn-sm btn-success' disabled>Delivered</button>
                                @elseif($order->order_status == '5')
                                    <button class='btn btn-sm btn-danger' disabled>canceled</button>
                                @elseif($order->order_status == '6')
                                    <button class='btn btn-sm btn-warning' disabled>Return Request</button>
                                @else
                                    <button class='btn btn-sm btn-info' disabled>Returned</button>
                              @endif
                          </td>
                          <td>{{ $order->created_at }}</td>
                      </tr>
                      @endforeach
                      <tr>
                          <td colspan="11">
                              <a href="{{route('admin.order_list')}}" class="btn btn-sm btn-warning">View More</a>
                          </td>
                      </tr>
                      @else
                          <tr>
                              <td colspan="12" style="text-align: center">Sorry No Data Found</td>
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
</div>
 @endsection

@section('script')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
    <script src="{{asset('admin/vendors/morris.js/morris.js')}}"></script>

    <script>
        $(function () {
            Morris.Donut({
                element: 'order_graph',
                data: [
                {value: {{$pie['returned_order_pie']}}, label: 'Returned orders'},
                {value: {{$pie['cancelled_order_pie']}}, label: 'Cancelled Orders'},
                {value: {{$pie['delivered_order_pie']}}, label: 'Delivered Orders'}
                ],
                backgroundColor: '#ccc',
                labelColor: '#060',
                colors: [
                '#FF5733',
                '#FF0000',
                '#008000'
                ],
                formatter: function (x) { return x + "%"}
            });
        });


        var data = [
            @for($i = 0; $i < 11; $i++)
                @if($i==10)
                    { y:"{{$chart[$i]['level']}}", a: {{$chart[$i]['delivered']}}, b: {{$chart[$i]['cancel']}}}
                @else
                    { y: "{{$chart[$i]['level']}}", a: {{$chart[$i]['delivered']}}, b: {{$chart[$i]['cancel']}}},
                @endif
            @endFor
        ],
        formatY = function (y) {
            return '$'+y;
        },
        formatX = function (x) {
            return x.src.y;
        },
        config = {
            xLabels: 'month',
            data: data,
            xkey: 'y',
            ykeys: ['a', 'b'],
            labels: ['Total Delivered', 'Total Cancelled'],
            fillOpacity: 0.6,
            stacked: true,
            hideHover: 'auto',
            behaveLikeLine: true,
            resize: true,
            pointFillColors:['#ffffff'],
            pointStrokeColors: ['black'],
            lineColors:['gray','red']
        };

        config.element = 'order_graph2';
        Morris.Area(config);
    </script>
@endsection
