@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" id="printable">
              <?php
                  // if (isset($_GET['msg'])) {
                  //   showMessage($_GET['msg']);
                  // }
              ?>
                <div class="x_title" style="border-bottom: white;">

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        {{--///////////////////// Company Address ///////////////////////--}}
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            {{-- <img src="uploads/logo.png" height="150" style="height: 38px;margin-bottom: 18px; margin-right: -9px;"> --}}
                            <b style="font-size: 35px;color: #0194ea;">Ash</b>
                            <b style="font-size: 35px;color: #262161;">ia</b>
                            <table>
                                <tr>
                                <th>Address : </th>
                                    <td>{{$invoice_setting->address}}</td>
                                </tr>

                                <tr>
                                <th>Phone : </th>
                                    <td>{{$invoice_setting->phone}}</td>
                                </tr>
                                @if (!empty($invoice_setting->gst))
                                    <tr>
                                        <th>GST No : </th>
                                        <td>{{$invoice_setting->gst}}</td>
                                    </tr>
                                @endif
                                <tr>
                                <th>Email Id : </th>
                                    <td>{{$invoice_setting->email}}</td>
                                </tr>
                            </table>
                        </div>

                        {{--///////////////// Invoice Details ////////////////////--}}
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <span style="font-size: 38px;color: black;font-weight: bold;">INVOICE</span>
                            <table>
                                <tr>
                                    <th>Invoice No : </th>
                                    <td>{{$order->id}}</td>
                                </tr>
                                <tr>
                                    <th>Invoice Date : </th>
                                    <td>{{$order->created_at}}</td>
                                </tr>
                                <tr>
                                    <th>Invoice Amount : </th>
                                    <td> Rs.{{ number_format($order->total_amount,2,".",'') }}</td>
                                </tr>

                            </table>
                        </div>
                    </div>

                    {{--//////////////////// Shipping Details And Billing Details ///////////////////--}}
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-md-12 col-xs-12 col-sm-12" style="padding-top: 16px;">
                            <table class="table">
                            <thead>
                                <tr style="background-color: #0089ff;color:white ">
                                <th style="min-width: 125px;">Billing Info</th>
                                <th>Shipping Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td>
                                    <table>
                                        <tr>
                                            <th>Name :</th>
                                            <td>{{$order->user->name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Email :</th>
                                            <td>{{$order->user->email}}</td>
                                        </tr>
                                        <tr>
                                            <th>Mobile :</th>
                                            <td>{{$order->user->mobile}}</td>
                                        </tr>
                                        <tr>
                                            <th>State :</th>
                                            <td>{{$order->user->state}}</td>
                                        </tr>
                                        <tr>
                                            <th>City :</th>
                                            <td>{{$order->user->city}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address :</th>
                                            <td>{{$order->user->address}}</td>
                                        </tr>
                                    </table>
                                </td>

                                <td>

                                    <table>
                                        <tr>
                                            <th>Name : </th>
                                            <td>{{$order->shippingAddress->name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Email : </th>
                                            <td>{{$order->shippingAddress->email}}</td>
                                        </tr>
                                        <tr>
                                            <th>Mobile : </th>
                                            <td>{{$order->shippingAddress->mobile}}</td>
                                        </tr>
                                        <tr>
                                            <th>State : </th>
                                            <td>{{$order->shippingAddress->state}}</td>
                                        </tr>

                                        <tr>
                                            <th>City : </th>
                                            <td>{{$order->shippingAddress->city}}</td>
                                        </tr>
                                        <tr>
                                            <th>Pin : </th>
                                            <td>{{$order->shippingAddress->pin}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address : </th>
                                            <td>{{$order->shippingAddress->address}}</td>
                                        </tr>

                                    </table>
                                </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                {{-- ////////////////// Order Details /////////////////////////////--}}
                <div class="x_content table-responsive">
                    <div class="col-md-12 col-xs-12 col-sm-12" style="padding-top: 16px;">
                        <table class="table">
                            <thead>
                                <tr style="background-color: #0089ff;color:white ">
                                <th style="min-width: 125px;">Name</th>
                                <th>Size</th>
                                <th>Qty</th>
                                <th>Rate</th>
                                <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>

                                    @php
                                        $order_items = $order->orderDetails;
                                        $cancellation_amount = 0;
                                    @endphp
                                    @if (!empty($order_items) && (count($order_items) > 0))
                                        @foreach ($order_items as $item)

                                        <tr>
                                            <td>
                                                {{$item->product->name}}
                                                @if ($item->order_status == '5')
                                                    <button disabled type="button" class="btn btn-sm btn-danger"> Cancelled </button>
                                                    @php
                                                        $discount_item = (($item->quantity*$item->price)*$item->discount)/100;
                                                        $cancellation_amount += ($item->quantity*$item->price) - $discount_item;
                                                    @endphp
                                                @endif
                                            </td>
                                            <td>{{$item->size}}</td>
                                            <td>{{$item->quantity}}</td>
                                            <td>{{$item->price}}</td>
                                            <td>{{$item->quantity*$item->price}}</td>
                                        </tr>
                                        @endforeach
                                    @endif


                                <tr>
                                    <td colspan='4' align='right'>Sub Total : </td>
                                    <td>{{ number_format($order->amount,2,".",'') }}</td>
                                </tr>
                                @if ($order->discount > 0)
                                    <tr>
                                        <td colspan='4' align='right'>Discount : (-) </td>
                                        <td>{{ number_format($order->discount,2,".",'') }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td colspan='4' align='right'>Shipping & Handling: (+) </td>
                                    @if ($order->shipping_charge > 0)
                                        <td>{{ number_format($order->shipping_charge,2,".",'') }}</td>
                                    @else
                                        <td>Free</td>
                                    @endif
                                </tr>
                                @if ($cancellation_amount > 0)
                                <tr>
                                    <td colspan='4' align='right' >Cancellation Amount : (-)</td>
                                    <td>{{ number_format($cancellation_amount,2,".",'') }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td colspan='4' align='right' >Net Payable Amount : </td>
                                    <td>{{ number_format(($order->total_amount - $cancellation_amount),2,".",'') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <div class="col-md-5 col-xs-5 col-sm-5">
                        <table class="table">
                            <thead>
                            <tr style="background-color: #0089ff;color:white ">
                                <td>Notes</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td> * {{$invoice_setting->note1}}</td>
                            </tr>
                            <tr>
                                <td> * {{$invoice_setting->note2}}</td>
                            </tr>
                            <tr>
                                <td> * {{$invoice_setting->note3}} </td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                        <div class="col-md-7 col-xs-7 col-sm-7">
                        <table class="table">
                            <thead>
                            <tr>
                                <td style=" text-align: center;">
                                <b style="color: #00adff;font-size: 25px;">Thanks</b><br>
                                <b>for shopping with us</b>
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td> <img src="{{asset('images/'.$invoice_setting->image.'')}}" style="height: 169px;width: 543px;"></td>
                            </tr>

                            </tbody>
                        </table>
                        </div>

                        <div class="col-md-12 col-xs-12 col-sm-12">
                        <button class="btn btn-info" id="print-btn" onclick="printDiv()">Print</button>
                            <a class="btn btn-danger" onclick="window.close()" id="backprint">Close</a>
                        </div>
                    </div>
                    <div id="thanks_msg"></div>
            </div>
          </div>
        </div>
      </div>
</div>


 @endsection

@section('script')

<script type="text/javascript">
    function printDiv() {
       var printContents = document.getElementById("printable").innerHTML;
       var originalContents = document.body.innerHTML;

       document.body.innerHTML = printContents;
       // document.getElementById("thanks_msg").innerHTML = "Thanks For Shopping With Us";

       //document.getElementById("backprint").hide();
       element = document.getElementById('backprint');
       element.style.display = "none";

        element = document.getElementById('print-btn');
       element.style.display = "none";

       window.print();

       element.style.display = "";
       document.getElementById("thanks_msg").innerHTML ="";
       document.body.innerHTML = originalContents;
    }
  </script>

 @endsection
