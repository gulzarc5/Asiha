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

