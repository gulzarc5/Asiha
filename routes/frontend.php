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
            
            //-- Checkout Section --//
            Route::get('show/checkout/form','CheckoutController@showCheckoutForm')->name('web.show_checkout_form');
        });

        // -- Cart Section --//
        Route::get('view/cart','CartController@viewCart')->name('web.view_cart');
        Route::get('remove/cart/{id}','CartController@removeCart')->name('web.remove_cart');
        Route::get('update/cart/{id}/{cart_id}/{qtty}','CartController@updateCart')->name('web.update_cart');
        Route::get('update/session/cart/{id}/{qtty}','CartController@updateSessionCart')->name('web.update_session_cart');
        Route::match(['get', 'post'], 'add/cart/{product_id}', 'CartController@addDirectCart')->name('web.add_direct_cart');

       

    });
});


//========= index =========//
// Route::get('/', function () {
//     return view('web.index');
// })->name('web.index');

//========= login =========//
// Route::get('/Login', function () {
//     return view('web.login');
// })->name('web.login');

// //========= register =========//
// Route::get('/Register', function () {
//     return view('web.register');
// })->name('web.register');

//========= password =========//
Route::get('/Forgot_Password', function () {
    return view('web.password.forgot-password');
})->name('web.password.forgot-password');

//========= password =========//
Route::get('/New_Password', function () {
    return view('web.password.change-password');
})->name('web.password.change-password');

// //========= product-list =========//
// Route::get('/Roadster', function () {
//     return view('web.product.product-list');
// })->name('web.product.product-list');

//========= product-detail =========//
Route::get('/Roadster/Men-Olive-Green-Solid-Bomber-Jacket', function () {
    return view('web.product.product-detail');
})->name('web.product.product-detail');

//========= cart =========//
// Route::get('/Cart', function () {
//     return view('web.cart.cart');
// })->name('web.cart.cart');

//========= checkout =========//
// Route::get('/Checkout', function () {
//     return view('web.checkout.checkout');
// })->name('web.checkout.checkout');

//========= checkout-address =========//
// Route::get('/Checkout/edit', function () {
//     return view('web.checkout.checkout-edit-address');
// })->name('web.checkout.checkout-edit-address');

//========= confirm-order =========//
Route::get('/Confitm-Thanks', function () {
    return view('web.checkout.confirm-order');
})->name('web.checkout.confirm-order');

//========= order =========//
Route::get('/Order', function () {
    return view('web.order.order');
})->name('web.order.order');

//========= order-detail =========//
Route::get('/Order-Detail', function () {
    return view('web.order.order-detail');
})->name('web.order.order-detail');

//========= wishlist =========//
// Route::get('/Wishlist', function () {
//     return view('web.wishlist.wishlist');
// })->name('web.wishlist.wishlist');

//========= address =========//
// Route::get('/Address', function () {
//     return view('web.address.address');
// })->name('web.address.address');

//========= edit-address =========//
// Route::get('/Address/Edit', function () {
//     return view('web.address.edit-address');
// })->name('web.address.edit-address');

//========= profile =========//
// Route::get('/Profile', function () {
//     return view('web.profile.profile');
// })->name('web.profile.profile');

//========= dashboard =========//
// Route::get('/Dashboard', function () {
//     return view('web.profile.dashboard');
// })->name('web.profile.dashboard');

