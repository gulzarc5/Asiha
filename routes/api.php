<?php

use Illuminate\Http\Request;

Route::group(['namespace'=>'Api'], function(){

    Route::get('last/category/list/{sub_cat_id}','CategoryController@LastCategoryList');
    Route::get('sub/category/list/{cat_id}','CategoryController@SubCategoryList');

    Route::get('app/load/','CategoryController@appLoadApi');

    Route::get('product/list/{category_id}/{type}','ProductController@productList');
    Route::post('product/filter','ProductController@productListWithFilter')->name('api.product_filter');
    Route::get('product/single/view/{product_id}','ProductController@singleProductView');
    Route::get('charges/list','CartController@chargesList');

    // Route::get('product/search/{search_key}','ProductController@productSearch');

    Route::post('user/registration','UsersController@userRegistration');
    Route::post('user/login','UsersController@userLogin');


    // Route::get('send/otp/{mobile}','UsersController@sendOtp');
    // Route::get('verify/otp/{mobile}/{otp}','UsersController@varifyOtp');
    // Route::post('forgot/change/password/','UsersController@forgotChangePass');

    Route::group(['middleware'=>'auth:api'],function(){

        Route::group(['prefix' => 'user'], function () {
            Route::get('user/profile/{user_id}','UsersController@userProfile');
            Route::post('user/profile/update','UsersController@userProfileUpdate');
            Route::post('user/change/password','UsersController@userChangePassword');
            // Route::get('user/logout/{user_id}','UsersController@userLogout');

            Route::post('user/shipping/add','UsersController@userShippingAdd');
            Route::get('user/shipping/list/{user_id}','UsersController@userShippingList');
            Route::get('user/shipping/single/{user_id}/{address_id}','UsersController@userShippingSingleView');
            Route::post('user/shipping/update','UsersController@userShippingUpdate');
            Route::get('user/shipping/delete/{address_id}','UsersController@userShippingDelete');
        });

        Route::group(['prefix' => 'cart'], function () {
            Route::post('add','CartController@addToCart');
            Route::get('fetch/{user_id}','CartController@cartProduct');
            Route::post('update','CartController@cartUpdate');
            Route::get('remove/{cart_id}','CartController@cartRemove');
        });

        Route::group(['prefix'=>'wish/list',],function(){
            Route::get('add/{product_id}/{user_id}','CartController@addToWishList');
            Route::get('items/{user_id}','CartController@wishListProducts');
            // Route::get('wish/to/cart/{user_id}/{wish_list_id}','CartController@wishListToCart');
            Route::get('item/remove/{wish_list_id}','CartController@wishListItemRemove');
        });

        Route::group(['prefix'=>'order',],function(){
            Route::post('place','OrderController@placeOrder');
        });

        Route::get('checkout/coupons/{user_id}','OrderController@couponFetch');
        // Route::get('user/update/payment/request/id/{order_id}/{payment_rqst_id}','OrderController@updatePaymentRequestId');
        // Route::get('user/update/payment/id/{order_id}/{payment_rqst_id}/{payment_id}','OrderController@updatePaymentId');
        // Route::get('user/order/history/{user_id}','OrderController@orderHistory');

        // Route::get('user/order/cancel/{order_id}','OrderController@orderCancel');
    });
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
