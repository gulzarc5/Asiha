<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
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
           if( Auth::guard('web')->user() && !empty(Auth::guard('web')->user()->id)){
            $user_data = Auth::guard('web')->user();
           
           $header_data = ['user_data'=>$user_data,'category'=>$category];
           }
           else{
            $header_data =['category'=>$category];
           }
           $view->with('header_data',$header_data);
        });
    }
}
