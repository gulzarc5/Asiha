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
});


//========= index =========//
// Route::get('/', function () {
//     return view('web.index');
// })->name('web.index');

//========= login =========//
Route::get('/Login', function () {
    return view('web.login');
})->name('web.login');

//========= register =========//
Route::get('/Register', function () {
    return view('web.register');
})->name('web.register');

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
Route::get('/Cart', function () {
    return view('web.cart.cart');
})->name('web.cart.cart');

//========= checkout =========//
Route::get('/Checkout', function () {
    return view('web.checkout.checkout');
})->name('web.checkout.checkout');

//========= checkout-address =========//
Route::get('/Checkout/edit', function () {
    return view('web.checkout.checkout-edit-address');
})->name('web.checkout.checkout-edit-address');

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
Route::get('/Wishlist', function () {
    return view('web.wishlist.wishlist');
})->name('web.wishlist.wishlist');

//========= address =========//
Route::get('/Address', function () {
    return view('web.address.address');
})->name('web.address.address');

//========= edit-address =========//
Route::get('/Address/Edit', function () {
    return view('web.address.edit-address');
})->name('web.address.edit-address');

//========= profile =========//
Route::get('/Profile', function () {
    return view('web.profile.profile');
})->name('web.profile.profile');

//========= dashboard =========//
Route::get('/Dashboard', function () {
    return view('web.profile.dashboard');
})->name('web.profile.dashboard');

