@extends('web.templet.master')

@section('head')
    <meta name="description" content="description">
@endsection

@section('content')

<!-- Shopping Checkout Section Start -->
<div class="section section-padding bg-white border-top-dashed border-bottom-dashed">
    <div class="container">
        <div class="order-nav mb-3">
            <ul>
                <li class="navi d"><i class="ti-check"></i>Cart</li>
                <li>></li>
                @auth('user')
                @else
                    <li class="navi d"><i class="ti-check"></i>Login</li>
                    <li>></li>
                @endauth
                <li class="navi current">Checkout</li>
                <li>></li>
                <li class="navi">Order Placed</li>
            </ul>
        </div>
        <div class="row ashia-mb-n40">
            <div class="col ashia-mb-40">
                <div class="row">
                    <div class="col">
                        <div class="accordion" id="faq-accordion">
                            {{ Form::open(['method' => 'post','route'=>'web.order_place']) }}
                            <div class="card active">
                                <div class="card-header">
                                    <button type="button" class="btn btn-link">Shipping Address</button>
                                </div>
                                <div id="faq-accordion-1" class="collapse show" data-parent="#faq-accordion">
                                    <div class="card-body pattern-bg">
                                        <div class="myaccount-content address" id="selt-add">
                                            <h3>Select Address</h3>
                                            <div class="row" id="address_div">
                                                @foreach($shipping_address as $address)
                                                    <div class="col-md-4 col-12 ashia-mb-30">
                                                        <address>
                                                            <p><input type="radio" name="address_id" value="{{$address->id}}" checked> <strong>{{$address->name}}</strong></p>
                                                            <p>{{$address->address}}</p>
                                                            <p class="mb-0">Mobile: {{$address->mobile}}</p>
                                                            <a href="{{route('web.edit_address',['id'=>$address->id,'status'=>1])}}" class="edit-link">edit this address</a>
                                                        </address>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button type="button" class="btn btn-sm btn-primary text-white" data-toggle="collapse" data-target="#faq-accordion-2">Proceed</button> &nbsp; &nbsp;
                                                    <p class="add-address" style="display: inline;cursor:pointer">Or, <span style="color: #ff6c62;">Add New Address<span></p>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="myaccount-content address" id="add-addr" style="display:none">

                                            <h3>Add New Address</h3>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="name">Name</label>
                                                        <input type="text" name="name" class="form-control" id="inputName4" >
                                                        <span id="name_error"></span>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="email">Email</label>
                                                        <input type="email" name="email" class="form-control" id="inputEmail4" >
                                                        <span id="email_error"></span>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="mobile">Phone</label>
                                                        <input type="text" name="mobile" class="form-control" id="inputPhone4" >
                                                        <span id="mobile_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <textarea id="inputAddress" name="address" ></textarea>
                                                    <span id="address_error"></span>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="city">City</label>
                                                        <input type="text" name="city" class="form-control" id="inputCity">
                                                        <span id="city_error"></span>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="state">State</label>
                                                        <input type="text" name="state" class="form-control" id="inputState">
                                                        <span id="state_error"></span>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="pin">Pincode</label>
                                                        <input type="text" name="pin" class="form-control" id="inputPincode">
                                                        <span id="pin_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <a class="btn btn-sm btn-outline-dark mr-3 bck-selt">Cancel</a>
                                                    <button type="button" onclick="address_save()" class="btn btn-sm btn-primary text-white">Save</button>
                                                </div>
                                            {{-- </form> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <button type="button" class="btn btn-link collapsed">Payment</button>
                                </div>
                                <div id="faq-accordion-2" class="collapse" data-parent="#faq-accordion">
                                    <div class="card-body pattern-bg">
                                        <div class="row ashia-mb-n30">
                                            <div class="col-lg-6 order-lg-1">
                                                <div class="order-review">
                                                    <div class="coupan">
                                                        <input type="text" name="coupon_code" class="" id="coupon_code">
                                                        <input type="hidden" name="coupon_id" class="" id="coupon_id">
                                                        <button type="button" onclick="couponApply()" id="coupon_apply_btn">apply</button>
                                                        <small class="response" id="coupon_err"></small>
                                                    </div>
                                                    <table class="table">
                                                        <tbody id="grand_body">
                                                            <tr>
                                                                <td class="name" style="border-top: 0;">Subtotal</td>
                                                                <td class="total" style="border-top: 0;"><span>{{$cart_total}}</span></td>
                                                            </tr>
                                                            <tr style="border-bottom: 1px solid #fe6c62;">
                                                                <td class="name">Shipping</td>
                                                                <td class="total"><span>{{$shipping_charge}}</span></td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr class="total">
                                                                <td style="text-align: left;"><span>Grand Total</span></td>
                                                                <td>
                                                                    <strong>
                                                                        <span id="grand_total_show">
                                                                            {{$cart_total + $shipping_charge}}
                                                                        </span>
                                                                    </strong>
                                                                    <input type="hidden" name="grand_total" id="grand_total" value="{{$cart_total}}">
                                                                    <input type="hidden" name="shipping_charge" id="shipping_charge" value="{{$shipping_charge}}">
                                                            </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 order-lg-2">
                                                <div class="order-payment">
                                                    <div class="payment-method">
                                                        <div class="accordion" id="paymentMethod">
                                                            <div class="card active">
                                                                <div class="card-header">
                                                                    <input type="radio" name="payment_type" value="1" id="" checked>
                                                                    <button data-toggle="collapse" data-target="#cashkPayments">Cash on delivery </button>
                                                                </div>
                                                                <div id="cashkPayments" class="collapse show" data-parent="#paymentMethod">
                                                                    <div class="card-body">
                                                                        <p>Pay with cash upon delivery.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <input type="radio" name="payment_type" value="2" id="">
                                                                    <button data-toggle="collapse" data-target="#payPalPayments">instamojo <img src="assets/images/others/pay.png" alt=""></button>
                                                                </div>
                                                                <div id="payPalPayments" class="collapse" data-parent="#paymentMethod">
                                                                    <div class="card-body">
                                                                        <p>Pay via instamojo; you can pay with your credit / debit card.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 order-lg-2 mb-4">
                                                <button type="button" class="btn btn-sm btn-outline-dark" data-toggle="collapse" data-target="#faq-accordion-1">< Back</button> &nbsp; &nbsp;
                                                <button type="submit" class="btn btn-sm btn-primary">Place Order</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shopping Checkout Section End -->
@endsection

@section('script')
    <script>
        function address_save(){
            var name = $("input[name=name]").val();
            var email = $("input[name=email]").val();
            var mobile = $("input[name=mobile]").val();
            var address = $("textarea[name=address]").val();
            var city = $("input[name=city]").val();
            var state = $("input[name=state]").val();
            var pin = $("input[name=pin]").val();
            var validation = true;
            $("#name_error").html('');
            $("#email_error").html('');
            $("#mobile_error").html('');
            $("#address_error").html('');
            $("#city_error").html('');
            $("#state_error").html('');
            $("#pin_error").html('');

            if (validation) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type:"POST",
                    url:"{{ route('web.add_checkout_address')}}",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        name:name,
                        address:address,
                        state:state,
                        city:city,
                        email:email,
                        mobile:mobile,
                        pin:pin,
                    },
                    // beforeSend:function() {
                    //     $('#myModal').modal('show');
                    //     $("#myModal").removeClass("mfp-hide");
                    // },
                    // complete:function() {
                    //     $('#myModal').modal('hide');
                    //     $("#myModal").addClass("mfp-hide");
                    // },
                    success:function(response){
                        if (response.status == false) {
                            var error = response.error_message;
                            $.each(error, function (key, val) {
                                console.log(key + "   = "+val);
                                $("#"+key+"_error").html(`<p style="color:red">${val}</p>`);
                            });
                            console.log(error);
                        } else {
                            var address_data = response.data;
                            $("#address_div").html("");
                            $.each(address_data, function (key, val) {
                                var edit_route = '{{route('web.edit_address',['id' =>':id','status' =>'1'])}}';
                                edit_route = edit_route.replace(':id', val.id);
                                $("#address_div").append(`
                                <div class="col-md-4 col-12 ashia-mb-30">
                                    <address>
                                        <p><input type="radio" name="select-address" checked> <strong>${val.name}</strong></p>
                                        <p>${val.address},${val.city},${val.state}</p>
                                        <p class="mb-0">Mobile: ${val.email}</p>
                                        <p class="mb-0">Mobile: ${val.mobile}</p>
                                        <a href="${edit_route}" class="edit-link">edit this address</a>
                                    </address>
                                </div>
                                `);
                            });
                            $("#selt-add").show();
                            $("#add-addr").hide();
                        }
                        // console.log(response);
                    }
                });
            }
        }

        function couponApply(){
            var coupon = $("#coupon_code").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                    type:"POST",
                    url:"{{ route('web.coupon_apply')}}",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        coupon:coupon,
                    },
                    // beforeSend:function() {
                    //     $('#myModal').modal('show');
                    //     $("#myModal").removeClass("mfp-hide");
                    // },
                    // complete:function() {
                    //     $('#myModal').modal('hide');
                    //     $("#myModal").addClass("mfp-hide");
                    // },
                    success:function(response){
                        if (response.status) {
                            var data = response.data;
                            console.log(data);
                            $("#coupon_apply_btn").prop('disabled', true);
                            $("#coupon_code").prop('disabled', true);
                            $("#coupon_apply_btn").html('Coupon Applied');
                            $("#coupon_apply_btn").css({"background-color": "#007780","color": "white"});
                            $("#coupon_id").val(data.id);
                            var grand_total = parseFloat($("#grand_total").val());
                            var ship_charge = parseFloat($("#shipping_charge").val());

                            $("#grand_total_show").html((grand_total+ship_charge)-((grand_total*parseFloat(data.discount))/100));
                            $("#grand_body").append(`<tr style="border-bottom: 1px solid #fe6c62;">
                                <td class="name">Discount</td>
                                <td class="total"><span>${(grand_total*parseFloat(data.discount))/100}</span></td>
                            </tr>`);
                        } else {
                           $("#coupon_err").html('<p style="color:red">Sorry The Coupon is Invalid</p>')
                        }
                    }
                });
        }
    </script>
@endsection
