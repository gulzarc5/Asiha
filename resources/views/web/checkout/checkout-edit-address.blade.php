@extends('web.templet.master')

@section('head')
    <meta name="description" content="description">
@endsection

@section('content')
        <!-- My Account Section Start -->
        <div class="section section-padding bg-white border-bottom-dashed">
            <div class="container">
                <div class="row ashia-mb-n30">
    
                    <!-- My Account Tab Content Start -->
                    <div class="col-lg-10 col-12 ashia-mb-30 mx-auto">
                        <div class="accordion" id="faq-accordion">
                            <div class="card active">
                                <div class="card-header">
                                    <button class="btn btn-link">Shipping Address</button>
                                </div>
                                <div id="faq-accordion-1" class="collapse show" data-parent="#faq-accordion">
                                    <div class="card-body pattern-bg">
                                        <div class="myaccount-content address">
                                            <h3>Edit Address</h3>
                                            <form>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputName4">Nane</label>
                                                        <input type="text" class="form-control" value="Vishal Nag">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="inputEmail4">Email</label>
                                                        <input type="email" class="form-control" value="imvishal@rediffmail.com">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="inputPhone4">Phone</label>
                                                        <input type="text" class="form-control" value="9436592140">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputAddress">Address</label>
                                                    <textarea value="">51st street, D block, marven town</textarea>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputCity">City</label>
                                                        <input type="text" class="form-control" value="Broklyn">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">State</label>
                                                        <input type="text" class="form-control" value="New York">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="inputPincode">Pincode</label>
                                                        <input type="text" class="form-control" value="784125">
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <a href="checkout.php" class="btn btn-sm btn-outline-dark mr-3">Back to checkout</a>
                                                    <a class="btn btn-sm btn-primary text-white">Save</a>  
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- My Account Tab Content End -->
                </div>
            </div>
        </div>
        <!-- My Account Section End -->
@endsection

@section('script')
@endsection
