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
                <li class="navi d"><i class="ti-check"></i>Login</li>
                <li>></li>
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
                            <div class="card active">
                                <div class="card-header">
                                    <button class="btn btn-link">Shipping Address</button>
                                </div>
                                <div id="faq-accordion-1" class="collapse show" data-parent="#faq-accordion">
                                    <div class="card-body pattern-bg">
                                        <div class="myaccount-content address" id="selt-add">
                                            <h3>Select Address</h3>
                                            <div class="row ashia-mb-n30">
                                                <div class="col-md-4 col-12 ashia-mb-30">
                                                    <address>                                                        
                                                        <p><input type="radio" name="select-address" checked> <strong>Alex Tuntuni</strong></p>
                                                        <p>1355 Market St, Suite 900 <br>
                                                            San Francisco, CA 94103</p>
                                                        <p class="mb-0">Mobile: (123) 456-7890</p>
                                                        <a href="{{route('web.checkout.checkout-edit-address')}}" class="edit-link">edit this address</a>
                                                    </address>
                                                </div>
                                                <div class="col-md-4 col-12 ashia-mb-30">
                                                    <address>                                                        
                                                        <p><input type="radio" name="select-address"><strong>Alex Tuntuni</strong></p>
                                                        <p>1355 Market St, Suite 900 <br>
                                                            San Francisco, CA 94103</p>
                                                        <p class="mb-0">Mobile: (123) 456-7890</p>
                                                        <a href="{{route('web.checkout.checkout-edit-address')}}" class="edit-link">edit this address</a>
                                                    </address>
                                                </div>
                                                <div class="col-md-4 col-12 ashia-mb-30">
                                                    <address>
                                                        <p><input type="radio" name="select-address"><strong>Alex Tuntuni</strong></p>
                                                        <p>1355 Market St, Suite 900 <br>
                                                            San Francisco, CA 94103</p>
                                                        <p class="mb-0">Mobile: (123) 456-7890</p>
                                                        <a href="{{route('web.checkout.checkout-edit-address')}}" class="edit-link">edit this address</a>
                                                    </address>
                                                </div>
                                                <div class="col-12 mb-4">                                                         
                                                    <button class="btn btn-sm btn-primary text-white" data-toggle="collapse" data-target="#faq-accordion-2">Proceed</button> &nbsp; &nbsp; 
                                                    <p class="add-address" style="display: inline;cursor:pointer">Or, <span style="color: #ff6c62;">Add New Address<span></p>   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="myaccount-content address" id="add-addr" style="display:none">
                                            <h3>Add New Address</h3>
                                            <form>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputName4">Nane</label>
                                                        <input type="text" class="form-control" id="inputName4" placeholder="Name">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="inputEmail4">Email</label>
                                                        <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="inputPhone4">Phone</label>
                                                        <input type="text" class="form-control" id="inputPhone4" placeholder="Phone">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputAddress">Address</label>
                                                    <textarea id="inputAddress" placeholder="1234 Main St"></textarea>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputCity">City</label>
                                                        <input type="text" class="form-control" id="inputCity">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">State</label>
                                                        <input type="text" class="form-control" id="inputState">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="inputPincode">Pincode</label>
                                                        <input type="text" class="form-control" id="inputPincode">
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <a class="btn btn-sm btn-outline-dark mr-3 bck-selt">Cancel</a>
                                                    <a class="btn btn-sm btn-primary text-white">Save</a>  
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <button class="btn btn-link collapsed">Payment</button>
                                </div>
                                <div id="faq-accordion-2" class="collapse" data-parent="#faq-accordion">
                                    <div class="card-body pattern-bg">
                                        <div class="row ashia-mb-n30">
                                            <div class="col-lg-6 order-lg-1">
                                                <div class="order-review">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td class="name" style="border-top: 0;">Subtotal</td>
                                                                <td class="total" style="border-top: 0;"><span>₹242.00</span></td>
                                                            </tr>
                                                            <tr style="border-bottom: 1px solid #fe6c62;">
                                                                <td class="name">Shipping</td>
                                                                <td class="total"><span>₹50.00</span></td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr class="total">
                                                                <td style="text-align: left;"><span>Grand Total</span></td>
                                                                <td><strong><span>₹242.00</span></strong></td>
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
                                                <button class="btn btn-sm btn-outline-dark" data-toggle="collapse" data-target="#faq-accordion-1">< Back</button> &nbsp; &nbsp; 
                                                <a href="{{route('web.checkout.confirm-order')}}" class="btn btn-sm btn-primary">Place Order</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

@endsection
