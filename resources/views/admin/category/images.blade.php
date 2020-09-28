@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
  <div class="row">
    <div class="x_panel">
      <div class="x_title">
        @if(isset($category) && isset($category_images) && !empty($category) && !empty($category_images))
          <h3>Category Images</h3>
        @elseif(isset($sub_category) && isset($sub_category_images) && !empty($sub_category) && !empty($sub_category_images))
          <h3>Sub Category Images</h3>
        @else
        <h3>Third Category Images</h3>
        @endif
        <div class="clearfix"></div>
          <div>
             @if (Session::has('message'))
                <div class="alert alert-success" >{{ Session::get('message') }}</div>
             @endif
             @if (Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
             @endif
          </div>
      </div>
      <div class="x_content">
        @if(isset($category) && isset($category_images) && !empty($category) && !empty($category_images))
          @foreach($category_images as $image)
            <div class="col-md-4">
              <div class="thumbnail" style="height: 300px; width: 300px;" >
                <div class="image view view-first" style="height: 300px; width: 300px;">
                  <img style="width: 100%; display: block;" src="{{ asset('images/category/category/thumb/'.$image->image.'')}}" />
                </div>
              </div>
            <div>
              @if($category->image == $image->image)
                <a href="" class="btn btn-sm btn-primary">Thumb Image</a>
              @else 
                  <a href="{{ route('admin.category_make_cover_image',['category_id'=>$category->id,'image_id' =>$image->id ])}}" class="btn btn-sm btn-success">Set As Main Image</a>

                <a href="{{ route('admin.category_delete_image',['image_id' =>$image->id])}}" class="btn btn-sm btn-danger" >Delete</a>
              @endif
            </div>
            </div>
          @endforeach
        @elseif(isset($sub_category) && isset($sub_category_images) && !empty($sub_category) && !empty($sub_category_images))
          @foreach($sub_category_images as $image)
            <div class="col-md-4">
              <div class="thumbnail" style="height: 300px; width: 300px;" >
                <div class="image view view-first" style="height: 300px; width: 300px;">
                  <img style="width: 100%; display: block;" src="{{ asset('images/category/sub_category/thumb/'.$image->image.'')}}" />
                </div>
              </div>
              <div>
                @if($sub_category->image == $image->image)
                  <a href="" class="btn btn-sm btn-primary">Thumb Image</a>
                @else 
                    <a href="{{ route('admin.sub_category_make_cover_image',['sub_category_id'=>$sub_category->id,'image_id' =>$image->id ])}}" class="btn btn-sm btn-success">Set As Main Image</a>
                    <a href="{{ route('admin.sub_cat_delete_image',['image_id' =>$image->id])}}" class="btn btn-sm btn-danger" >Delete</a>
                @endif
              </div>
            </div>
          @endforeach
        @else 
          @if(isset($third_level_category) && isset($third_level_images) && !empty($third_level_category) && !empty($third_level_images))
            @foreach($third_level_images as $image)
              <div class="col-md-4">
                <div class="thumbnail" style="height: 300px; width: 300px;" >
                  <div class="image view view-first" style="height: 300px; width: 300px;">
                    <img style="width: 100%; display: block;" src="{{ asset('images/category/third_category/thumb/'.$image->image.'')}}" />
                  </div>
                </div>
                <div>
                  @if($third_level_category->image == $image->image)
                  
                    <a href="" class="btn btn-sm btn-primary">Thumb Image</a>
                  @else 
                      <a href="{{route('admin.third_category_make_cover_image',['third_category_id'=>$third_level_category->id,'image_id' =>$image->id ])}}" class="btn btn-sm btn-success">Set As Main Image</a>
                      <a href="{{ route('admin.third_cat_delete_image',['image_id' =>$image->id])}}" class="btn btn-sm btn-danger" >Delete</a>
                  @endif
                </div>
              </div>
            @endforeach
          @endif
        @endif
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <div class="x_panel">
        <div class="x_title">
            <h2>Add More Images</h2>
            <div class="clearfix"></div>
        </div>
        <div>
            <div class="x_content">
              @if(isset($category) && isset($category_images) && !empty($category) && !empty($category_images))
                {{ Form::open(['method' => 'post','route'=>'admin.category_add_new_images' , 'enctype'=>'multipart/form-data']) }}
                  <input type="hidden" name="category_id" value="{{ $category->id}}">
              @elseif(isset($sub_category) && isset($sub_category_images) && !empty($sub_category) && !empty($sub_category_images))
                {{ Form::open(['method' => 'post','route'=>'admin.sub_cat_add_new_images' , 'enctype'=>'multipart/form-data']) }}
                  <input type="hidden" name="sub_category_id" value="{{ $sub_category->id}}">
              @else
                {{ Form::open(['method' => 'post','route'=>'admin.third_cat_add_new_images' , 'enctype'=>'multipart/form-data']) }}
                  <input type="hidden" name="sub_category_id" value="{{ $third_level_category->id}}">
              @endif
               <div class="well" style="overflow: auto" id="image_div">
                  <div class="form-row mb-10">
                      <div class="col-md-8 col-sm-12 col-xs-12 mb-3">
                          <label for="size">Image</label>
                          <input type="file" name="image[]" class="form-control" multiple>
                      </div>
                      <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                          <a class="btn btn-sm btn-primary" style="margin-top: 25px;" onclick="add_more_image()">Add More</a>                                 
                      </div>  
                  </div>
                  @if($errors->has('image'))
                    <span class="invalid-feedback" role="alert" style="color:red">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                  @enderror

                 </div>
              <div class="form-group">
                {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}
              </div>
              {{ Form::close() }}
            </div>
        </div>
      </div>
    </div>
    <div class="col-md-2"></div>
  </div>
</div>


 @endsection

@section('script')
     
<script type="text/javascript">
  var more_image_count = 1;

function add_more_image(){
    var more_image_html = ' <div class="form-row mb-10" id="img_id'+more_image_count+'">'+
    '<div class="col-md-4 col-sm-12 col-xs-12 mb-3">'+
        '<label for="size">Image</label>'+
        '<input type="file" name="image[]" class="form-control">'+
    '</div>'+
    
    '<div class="col-md-4 col-sm-12 col-xs-12 mb-3">'+
        
    '</div>'+
    '<div class="col-md-4 col-sm-12 col-xs-12 mb-3">'+
       '<a class="btn btn-sm btn-danger" style="margin-top: 25px;" onclick="remove_more_image('+more_image_count+')">Remove</a>'+
    '</div>'+
'</div>';
    $("#image_div").append(more_image_html);
    more_image_count++;

}

function remove_more_image(id) {
    $("#img_id"+id).remove();
}
</script>
    
 @endsection