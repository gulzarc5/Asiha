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
            // Route::get('list/with/category/{category_id}', 'CategoryController@thirdCategoryListWithCategory')->name('admin.third_category_list_with_category');
            Route::get('status/{id}/{status}', 'CategoryController@thirdCategoryStatus')->name('admin.third_category_status');
        });

        Route::group(['prefix'=>'brands'],function(){        
            Route::get('list','BrandController@brandList')->name('admin.brand_list');
            Route::get('add/form', 'BrandController@brandAddForm')->name('admin.brand_add_form');        
            Route::post('insert/form', 'BrandController@brandInsertForm')->name('admin.brand_insert_form');    
            Route::get('edit/{id}', 'BrandController@brandEdit')->name('admin.brand_edit');
            Route::put('update/{id}', 'BrandController@brandUpdate')->name('admin.brand_update');
            // // Route::get('list/with/category/{category_id}', 'CategoryController@brandListWithCategory')->name('admin.brand_list_with_category');
            Route::get('status/{id}/{status}', 'BrandController@brandStatus')->name('admin.brand_status');
        });
        Route::group(['prefix'=>'product'],function(){
            Route::get('add/form','ProductController@AddProductForm')->name('admin.product_add_form');
            Route::get('list','ProductController@ListProducts')->name('admin.list_product');
        });
        Route::group(['prefix'=>'color'],function(){
           Route::get('list','ColorController@colorList')->name('admin.color_list');
           Route::get('add/form','ColorController@addColor')->name('admin.color_add_form');
        });
        // Route::group(['prefix'=>'product'],function(){       
        //     Route::get('add/form','ProductController@AddForm')->name('admin.product_add_form');
        //     Route::post('insert','ProductController@insertProduct')->name('admin.product_insert');
        //     Route::get('list','ProductController@productList')->name('admin.product_list');
        //     Route::get('list/ajax','ProductController@productListAjax')->name('admin.product_list_ajax');
        //     Route::get('view/{id}','ProductController@productView')->name('admin.product_view');
        //     Route::get('edit/{id}','ProductController@productEdit')->name('admin.product_edit');
        //     Route::post('update','ProductController@productUpdate')->name('admin.product_update');
        //     Route::get('status/update/{id}/{status}','ProductController@productStatusUpdate')->name('admin.product_status_update');

        //     Route::get('edit/sizes/{product_id}','ProductController@editSizes')->name('admin.product_edit_sizes');
        //     Route::post('add/new/sizes/','ProductController@addNewSize')->name('admin.product_add_new_sizes');
        //     Route::post('update/sizes/','ProductController@updateSize')->name('admin.product_update_sizes');
            
        //     Route::get('edit/specifications/{product_id}','ProductController@editSpecifications')->name('admin.product_edit_specifications');
        //     Route::post('add/new/specofication/','ProductController@addNewSpecification')->name('admin.product_add_new_specofication');
        //     Route::post('update/specofication/','ProductController@updateSpecification')->name('admin.product_update_specofication');
        //     Route::get('delete/specofication/{sp_id}','ProductController@deleteSpecification')->name('admin.product_delete_specofication');

        //     Route::get('edit/images/{product_id}','ProductController@editImages')->name('admin.product_edit_images');
        //     Route::post('add/new/images/','ProductController@addNewImages')->name('admin.product_add_new_images');            
        //     Route::get('make/cover/image/{image_id}','ProductController@makeCoverImage')->name('admin.product_make_cover_image');            
        //     Route::get('delete/image/{image_id}','ProductController@deleteImage')->name('admin.product_delete_image');
        // });

        // Route::group(['prefix'=>'user'],function(){
        //     Route::get('customer/list','UsersController@customerList')->name('admin.customer_list');            
        //     Route::get('retailer/list','UsersController@retailerList')->name('admin.retailer_list');
        // });

        // Route::group(['prefix'=>'order'],function(){
        //     Route::get('/list','OrderController@orderList')->name('admin.order_list');            
        //     Route::get('/list/ajax','OrderController@orderListAjax')->name('admin.order_list_ajax');
        // });
        
    });
});
