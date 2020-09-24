@extends('web.templet.master')

@section('head')
    <meta name="description" content="description">
@endsection

@section('content')
    <!-- My Account Section Start -->
    <div class="section section-padding bg-white border-bottom-dashed">
        <div class="container">
            <div class="row ashia-mb-n30">

                <!-- My Account Tab List Start -->
                <div class="col-lg-2 col-12 ashia-mb-30">
                    @include('web.include.acount-sidepanel')
                    <style>.myaccount-tab-list a:nth-child(4) {background: #ff6c62!important;color: #fff;}</style>
                </div>
                <!-- My Account Tab List End -->

                <!-- My Account Tab Content Start -->
                <div class="col-lg-10 col-12 ashia-mb-30">
                    <div class="accordion" id="faq-accordion">
                        <div class="card active">
                            <div class="card-header">
                                <button class="btn btn-link">Shipping Address</button>
                            </div>
                            <div id="faq-accordion-1" class="collapse show" data-parent="#faq-accordion">
                                <div class="card-body pattern-bg">
                                    <div class="myaccount-content address" id="selt-add">
                                        <div class="row ashia-mb-n30">
                                            <div class="col-md-4 col-12 ashia-mb-30">
                                                <address>                                                        
                                                    <p><strong>Alex Tuntuni</strong></p>
                                                    <p>1355 Market St, Suite 900 <br>
                                                        San Francisco, CA 94103</p>
                                                    <p class="mb-0">Mobile: (123) 456-7890</p>
                                                    <a href="edit-address.php" class="edit-link">edit this address</a>
                                                </address>
                                            </div>
                                            <div class="col-md-4 col-12 ashia-mb-30">
                                                <address>                                                        
                                                    <p><strong>Alex Tuntuni</strong></p>
                                                    <p>1355 Market St, Suite 900 <br>
                                                        San Francisco, CA 94103</p>
                                                    <p class="mb-0">Mobile: (123) 456-7890</p>
                                                    <a href="edit-address.php" class="edit-link">edit this address</a>
                                                </address>
                                            </div>
                                            <div class="col-md-4 col-12 ashia-mb-30">
                                                <address>
                                                    <p><strong>Alex Tuntuni</strong></p>
                                                    <p>1355 Market St, Suite 900 <br>
                                                        San Francisco, CA 94103</p>
                                                    <p class="mb-0">Mobile: (123) 456-7890</p>
                                                    <a href="edit-address.php" class="edit-link">edit this address</a>
                                                </address>
                                            </div>
                                            <div class="col-12 mb-4">
                                                <p class="add-address" style="display: inline;cursor:pointer"><span style="color: #ff6c62;">Add New Address<span></p>   
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
                    </div>
                </div> <!-- My Account Tab Content End -->
            </div>
        </div>
    </div>
    <!-- My Account Section End -->
@endsection

@section('script')

@endsection
