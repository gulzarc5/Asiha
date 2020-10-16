@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Popular Products List</h2>
    	            <div class="clearfix"></div>
              </div>
    	        <div>
    	            <div class="x_content">
                        <table id="size_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              
                              <th>Product Id</th>
                              <th>Product Name</th>
                              <th>action</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach($product_list as $list)
                              <tr>
                                  <td>{{$list->id}}</td>
                                  <td>{{$list->name}}</td>
                                  <td><a href="{{route('admin.make_product_popular',['product_id'=>$list->id])}}" class="btn btn-danger btn-sm">Remove</a></td>
                              </tr>
                               
                             
                              @endforeach                      
                          </tbody>
                        </table>
    	            </div>
    	        </div>
    	    </div>
    	</div>
    </div>
	</div>


 @endsection

