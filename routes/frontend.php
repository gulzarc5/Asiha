<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['namespace'=>'Web'],function(){
    Route::get('/','HomePageController@index')->name('web.index');

    Route::group(['prefix'=>'product'],function(){
        Route::get('list/{cat_slug}/{category_id}/{type}','ProductController@productlist')->name('web.product_list');
        Route::post('filter/list','ProductController@productListWithFilter')->name('web.product_list_filter');
        Route::get('/detail/{slug}/{product_id}', 'ProductController@productDetails')->name('web.product_detail');
        Route::get('/fetch/size/{product_size_id}', 'ProductController@fetchSizePrice')->name('web.fetch_product_size_price');
    });
    Route::group(['prefix'=>'user'],function(){
        Route::get('register/form','UserController@registerForm')->name('web.register_form');
        Route::get('login/form','UserController@loginForm')->name('web.login_form');
        Route::post('register','UserController@register')->name('web.register');
        Route::post('login','UserController@login')->name('web.login');
        Route::group(['middleware'=>'auth:user'],function(){
            Route::post('logout', 'UserController@logout')->name('web.logout');
            Route::get('dashboard','UserController@dashboard')->name('web.dashboard');
            Route::get('profile','UserController@profile')->name('web.profile');
            Route::post('profile/update','UserController@updateProfile')->name('web.update_profile');
            Route::get('address','UserController@address')->name('web.address');
            Route::post('add/new/address','UserController@addNewAddress')->name('web.add_new_address');
            Route::get('edit/address/{id}/{status}','UserController@editAddress')->name('web.edit_address');
            Route::post('update/address/{id}','UserController@updateAddress')->name('web.update_address');
            Route::get('delete/address/{address_id}','UserController@deleteAddress')->name('web.delete_address');
            Route::get('wishlist','UserController@wishList')->name('web.wishlist');
            Route::get('add/wishlist/{product_id}','UserController@addWishlist')->name('web.add_wish_list');
            Route::get('remove/{product_id}','UserController@removeWishList')->name('web.remove_wishlist');

             //--Order Section --//
             Route::get('order/history','UserController@myOrderHistory')->name('web.order_history');
             Route::get('order/details/{id}','UserController@orderDetails')->name('web.order_details');
             Route::get('order/cancel/{id}','UserController@orderCancel')->name('web.order_cancel');
             Route::get('order/cancel/refund/form/{order_id}/{form_type?}','UserController@orderCancelRefundForm')->name('web.order_refund_form');
             Route::post('order/cancel/refund/{order_id}','UserController@orderCancelRefund')->name('web.order_refund');

             //-- Checkout Section --//
            Route::get('show/checkout/form','CheckoutController@showCheckoutForm')->name('web.show_checkout_form');
            Route::post('add/checkout/address','CheckoutController@addCheckoutAddress')->name('web.add_checkout_address');
            Route::post('order/place','CheckoutController@orderPlace')->name('web.order_place');
            Route::post('coupon/apply','CheckoutController@couponApply')->name('web.coupon_apply');
            Route::post('rpay/success','CheckoutController@paySuccess')->name('web.pay_success');


        });

        Route::get('view/cart','CartController@viewCart')->name('web.view_cart');
        Route::get('remove/cart/{id}','CartController@removeCart')->name('web.remove_cart');
        Route::get('update/cart/{id}/{cart_id}/{qtty}','CartController@updateCart')->name('web.update_cart');
        Route::get('update/session/cart/{id}/{qtty}','CartController@updateSessionCart')->name('web.update_session_cart');
        Route::match(['get', 'post'], 'add/cart/{product_id}', 'CartController@addDirectCart')->name('web.add_direct_cart');



    });
});

Route::get('/Confitm-Thanks/{status?}', function () {
    return view('web.checkout.confirm-order');
})->name('web.checkout.confirm-order');

//========= password =========//
Route::get('/Forgot_Password', function () {
    return view('web.password.forgot-password');
})->name('web.password.forgot-password');

//========= password =========//
Route::get('/New_Password', function () {
    return view('web.password.change-password');
})->name('web.password.change-password');


