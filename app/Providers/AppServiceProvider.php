<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use App\Models\Cart;
use App\Models\WishList;
use Auth;
use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['web.include.header','web.include.footer'], function($view){
            $header_data ="";
           $category = Category::where('status',1)->get();
           if( Auth::guard('user')->user() && !empty(Auth::guard('user')->user()->id)){
            $user_data = Auth::guard('user')->user();
            $wishlist_cnt = WishList::where('user_id',Auth::guard('user')->user()->id)->count();
            $cart_cnt = Cart::where('user_id',Auth::guard('user')->user()->id)->count();
            $header_data = ['user_data'=>$user_data,'category'=>$category,'wishlist_cnt'=>$wishlist_cnt,'cart_cnt'=>$cart_cnt];
           }
           else{
            $header_data =['category'=>$category];
           }
           $view->with('header_data',$header_data);
        });
    }
}
