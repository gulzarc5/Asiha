@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
                    <h2>Coupon List</h2>
                    {{-- <a class="btn btn-sm btn-info" style="float: right" href="{{route('admin.coupon_add_form')}}">Add New Coupon</a> --}}
    	            <div class="clearfix"></div>
    	        </div>
    	        <div>
    	            <div class="x_content">
                        <table id="category" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Sl</th>
                              <th>Code</th>
                              <th>User Type</th>
                              <th>Discount Percentage</th>
                              <th>Description</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if (isset($coupons) && !empty($coupons))
                            @php
                              $count=1;
                            @endphp
                                @foreach ($coupons as $item)
                                    <tr>
                                        <td>{{$count++}}</td>
                                        <td>{{$item->code}}</td>
                                        <td>
                                            @if ($item->usertype== '1')
                                            New
                                            @else
                                            Old
                                            @endif
                                        </td>
                                        <td>{{$item->discount}}</td>
                                        <td>{{$item->description}}</td>

                                        <td>
                                            @if ($item->status == '1')
                                            <a  class="btn btn-sm btn-primary" aria-disabled="true">Enabled</a>
                                            @else
                                            <a  class="btn btn-sm btn-danger" aria-disabled="true">Disabled</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.coupon_edit',['id'=>encrypt($item->id)])}}" class="btn btn-sm btn-warning">Edit</a>
                                            @if ($item->status == '1')
                                            <a href="{{route('admin.coupon_status',['id'=>encrypt($item->id),'status'=>2])}}" class="btn btn-sm btn-danger">Disable</a>
                                            @else
                                            <a href="{{route('admin.coupon_status',['id'=>encrypt($item->id),'status'=>1])}}" class="btn btn-sm btn-primary">Enable</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                              <tr>
                                <td colspan="6" style="text-align: center">No Sub Category Found</td>
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
