<?php

use Illuminate\Http\Request;

Route::group(['namespace' => 'Admin'],function(){
    Route::get('/admin/login','LoginController@index')->name('admin.login_form');    
    Route::post('login', 'LoginController@adminLogin');

 
    Route::group(['middleware'=>'auth:admin','prefix'=>'admin'],function(){
        Route::get('/dashboard', 'DashboardController@dashboardView')->name('admin.deshboard');        
        Route::post('logout', 'LoginController@logout')->name('admin.logout');
        Route::get('/change/password/form', 'DashboardController@changePasswordForm')->name('admin.change_password_form');
        Route::post('/change/password', 'DashboardController@changePassword')->name('admin.change_password');

        Route::group(['prefix'=>'category'],function(){
            Route::get('list','CategoryController@categoryList')->name('admin.category_list');
            Route::get('add/form', 'CategoryController@categoryAddForm')->name('admin.category_add_form');        
            Route::post('insert/form', 'CategoryController@categoryInsertForm')->name('admin.category_insert_form');
            Route::get('status/{id}/{status}', 'CategoryController@categoryStatus')->name('admin.category_status');
            Route::get('edit/{id}', 'CategoryController@categoryEdit')->name('admin.category_edit');
            Route::put('update/{id}', 'CategoryController@categoryUpdate')->name('admin.category_update');
        });

        Route::group(['prefix'=>'sub/category'],function(){        
            Route::get('list','CategoryController@subCategoryList')->name('admin.sub_category_list');
            Route::get('add/form', 'CategoryController@subCategoryAddForm')->name('admin.sub_category_add_form');        
            Route::post('insert/form', 'CategoryController@subCategoryInsertForm')->name('admin.sub_category_insert_form');    
            Route::get('edit/{id}', 'CategoryController@subCategoryEdit')->name('admin.sub_category_edit');
            Route::put('update/{id}', 'CategoryController@subCategoryUpdate')->name('admin.sub_category_update');
            Route::get('list/with/category/{category_id}', 'CategoryController@subCategoryListWithCategory')->name('admin.sub_category_list_with_category');
            Route::get('status/{id}/{status}', 'CategoryController@subCategoryStatus')->name('admin.sub_category_status');
        });

        Route::group(['prefix'=>'third/category'],function(){        
            Route::get('list','CategoryController@thirdCategoryList')->name('admin.third_category_list');
            Route::get('add/form', 'CategoryController@thirdCategoryAddForm')->name('admin.third_category_add_form');        
            Route::post('insert/form', 'CategoryController@thirdCategoryInsertForm')->name('admin.third_category_insert_form');    
            Route::get('edit/{id}', 'CategoryController@thirdCategoryEdit')->name('admin.third_category_edit');
            Route::put('update/{id}', 'CategoryController@thirdCategoryUpdate')->name('admin.third_category_update');
            Route::get('list/with/category/{sub_category_id}', 'CategoryController@thirdCategoryListWithSubCategory')->name('admin.third_category_list_with_sub_category');
            Route::get('status/{id}/{status}', 'CategoryController@thirdCategoryStatus')->name('admin.third_category_status');
        });

        Route::group(['prefix'=>'brands'],function(){        
            Route::get('list','BrandController@brandList')->name('admin.brand_list');
            Route::get('add/form', 'BrandController@brandAddForm')->name('admin.brand_add_form');        
            Route::post('insert/form', 'BrandController@brandInsertForm')->name('admin.brand_insert_form');    
            Route::get('edit/{id}', 'BrandController@brandEdit')->name('admin.brand_edit');
            Route::put('update/{id}', 'BrandController@brandUpdate')->name('admin.brand_update');
            Route::get('list/with/category/{sub_category_id}', 'BrandController@brandListWithSubCategory')->name('admin.brand_list_with_sub_category');
            Route::get('status/{id}/{status}', 'BrandController@brandStatus')->name('admin.brand_status');
        });

        Route::group(['prefix'=>'color'],function(){
           Route::get('list','ColorController@colorList')->name('admin.color_list');
           Route::get('add/form','ColorController@addColor')->name('admin.color_add_form');
           Route::post('insert/form', 'ColorController@colorInsertForm')->name('admin.color_insert_form');
           Route::get('edit/{id}', 'ColorController@colorEdit')->name('admin.color_edit');
           Route::put('update/{id}', 'ColorController@colorUpdate')->name('admin.color_update');
           Route::get('status/{id}/{status}', 'ColorController@colorStatus')->name('admin.color_status');
           Route::get('list/with/category/{sub_category_id}', 'ColorController@colorListWithSubCategory')->name('admin.color_list_with_sub_category');

        });
        Route::group(['prefix'=>'coupon'],function(){
            Route::get('list','CouponController@couponList')->name('admin.coupon_list');
            Route::get('add/form','CouponController@addCoupon')->name('admin.coupon_add_form');
            Route::post('insert/form', 'CouponController@couponInsertForm')->name('admin.coupon_insert_form');
            Route::get('edit/{id}', 'CouponController@couponEdit')->name('admin.coupon_edit');
            Route::put('update/{id}', 'CouponController@couponUpdate')->name('admin.coupon_update');
            Route::get('status/{id}/{status}', 'CouponController@couponStatus')->name('admin.coupon_status');
        });

        Route::group(['prefix'=>'size'],function(){        
            Route::get('list','ConfigurationController@sizeList')->name('admin.size_list');
            Route::get('add/form', 'ConfigurationController@sizeAddForm')->name('admin.size_add_form');        
            Route::post('insert/form', 'ConfigurationController@sizeInsert')->name('admin.size_insert');    
            Route::get('edit/{id}', 'ConfigurationController@sizeEdit')->name('admin.size_edit');
            Route::put('update/{id}', 'ConfigurationController@sizeUpdate')->name('admin.size_update');
            Route::get('list/with/category/{sub_category_id}', 'ConfigurationController@sizeListWithSubCategory')->name('admin.size_list_with_sub_category');
            Route::get('status/{id}/{status}', 'ConfigurationController@sizeStatus')->name('admin.size_status');
        });

        Route::group(['prefix'=>'charges'],function(){ 
            Route::get('list','ChargesController@chargesList')->name('admin.charges_list');
            Route::get('edit/{id}', 'ChargesController@chargesEdit')->name('admin.charges_edit');
            Route::put('update/{id}', 'ChargesController@chargesUpdate')->name('admin.charges_update');
            Route::get('status/{id}/{status}', 'ChargesController@chargesStatus')->name('admin.charges_status');

        });

        Route::group(['prefix'=>'slider'],function(){
            Route::get('app/list','SliderController@appSliderList')->name('admin.app_slider_list');
            Route::get('web/list','SliderController@webSliderList')->name('admin.web_slider_list');
            Route::get('app/add/form', 'SliderController@appSliderAddForm')->name('admin.app_slider_add_form');
            Route::get('web/add/form', 'SliderController@webSliderAddForm')->name('admin.web_slider_add_form');
            Route::post('web/insert/form', 'SliderController@insertWebSlider')->name('admin.insert_web_slider');
            Route::post('app/insert/form', 'SliderController@insertAppSlider')->name('admin.insert_app_slider');
            Route::get('delete/{id}', 'SliderController@SliderDelete')->name('admin.slider_delete');
            Route::get('status/{id}/{status}', 'SliderController@SliderStatus')->name('admin.slider_status');
            Route::get('edit/{id}', 'SliderController@bannerEdit')->name('admin.banner_edit');
            Route::put('update/{id}', 'SliderController@bannerUpdate')->name('admin.banner_update');
        }); 

        Route::group(['prefix'=>'product'],function(){       
            Route::get('add/form','ProductController@AddProductForm')->name('admin.product_add_form');
            Route::get('list','ProductController@ListProducts')->name('admin.list_product');
            Route::post('insert','ProductController@insertProduct')->name('admin.product_insert');
            Route::get('list/ajax','ProductController@productListAjax')->name('admin.product_list_ajax');
            Route::get('view/{id}','ProductController@productView')->name('admin.product_view');
            Route::get('edit/{id}','ProductController@productEdit')->name('admin.product_edit');
            Route::put('update/{id}','ProductController@productUpdate')->name('admin.product_update');
            Route::get('status/update/{id}/{status}','ProductController@productStatusUpdate')->name('admin.product_status_update');

            Route::get('edit/sizes/{product_id}','ProductController@editSizes')->name('admin.product_edit_sizes');
            Route::post('add/new/sizes/','ProductController@addNewSize')->name('admin.product_add_new_sizes');
            Route::put('update/sizes/{product_id}','ProductController@updateSize')->name('admin.product_update_sizes');
            Route::get('edit/color/{id}','ProductController@productEditColors')->name('admin.product_edit_colors');
            Route::put('update/color/{product_id}','ProductController@updateColor')->name('admin.product_update_color');
            Route::post('add/new/colors/{product_id}','ProductController@addNewColor')->name('admin.product_add_new_colors');
            Route::get('delete/color/{product_color_id}','ProductController@productDeleteColor')->name('admin.delete_product_color');
            // Route::get('edit/sizes/{product_id}','ProductController@editSizes')->name('admin.product_edit_sizes');
            // Route::post('add/new/sizes/','ProductController@addNewSize')->name('admin.product_add_new_sizes');
            // Route::post('update/sizes/','ProductController@updateSize')->name('admin.product_update_sizes');
            
            // Route::get('edit/specifications/{product_id}','ProductController@editSpecifications')->name('admin.product_edit_specifications');
            // Route::post('add/new/specofication/','ProductController@addNewSpecification')->name('admin.product_add_new_specofication');
            // Route::post('update/specofication/','ProductController@updateSpecification')->name('admin.product_update_specofication');
            // Route::get('delete/specofication/{sp_id}','ProductController@deleteSpecification')->name('admin.product_delete_specofication');

            Route::get('edit/images/{product_id}','ProductController@editImages')->name('admin.product_edit_images');
            Route::post('add/new/images/','ProductController@addNewImages')->name('admin.product_add_new_images');            
            Route::get('make/cover/image/{product_id}/{image_id}','ProductController@makeCoverImage')->name('admin.product_make_cover_image');            
            Route::get('delete/image/{image_id}','ProductController@deleteImage')->name('admin.product_delete_image');
        });

        Route::group(['prefix'=>'user'],function(){
            Route::get('list','UserController@userList')->name('admin.user_list');            
            Route::get('list/ajax','UserController@userListAjax')->name('admin.user_list_ajax');
        });

        // Route::group(['prefix'=>'order'],function(){
        //     Route::get('/list','OrderController@orderList')->name('admin.order_list');            
        //     Route::get('/list/ajax','OrderController@orderListAjax')->name('admin.order_list_ajax');
        // });
        
    });
});
