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
                    <style>.myaccount-tab-list a:nth-child(5) {background: #ff6c62!important;color: #fff;}</style>
                </div>
                <!-- My Account Tab List End -->

                <!-- My Account Tab Content Start -->
                <div class="col-lg-10 col-12 ashia-mb-30">
                    <div class="accordion" id="faq-accordion">
                        <div class="card active">
                            <div class="card-header">
                                <button class="btn btn-link">Profile</button>
                            </div>
                            <div id="faq-accordion-1" class="collapse show" data-parent="#faq-accordion">
                                <div class="card-body pattern-bg">
                                    <div class="myaccount-content address" id="selt-add">
                                        <div class="row ashia-mb-n30">
                                            <div class="col-md-4 col-12 ashia-mb-30">
                                                <label for="inputName4">Name</label>
                                                <p>Vishal Nag</p>
                                            </div>
                                            <div class="col-md-4 col-12 ashia-mb-30">
                                                <label for="inputName4">Email</label>
                                                <p>improgramger@get.in</p>
                                            </div>
                                            <div class="col-md-4 col-12 ashia-mb-30">
                                                <label for="inputName4">Phone</label>
                                                <p>+91 94578 12340</p>
                                            </div>
                                            <div class="col-12 mb-4">
                                                <p class="add-address" style="display: inline;cursor:pointer"><span style="color: #ff6c62;">Edit Profile<span></p>   
                                            </div>
                                        </div>
                                    </div>
                                    <div class="myaccount-content address" id="add-addr" style="display:none">
                                        <h3>Edit Profile</h3>
                                        <form>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputName4">Name</label>
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
