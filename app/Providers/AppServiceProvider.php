<?php

namespace App\Providers;

use App\Mail\usercreated;
use App\Model\Product;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        User::created(function ($user)
        {
            Mail::to($user)->send(new usercreated($user));
        });

        Product::updated(function ($product)
        {
            if ($product->quantity==0&&$product->isAvailable()) {
                $product->status=Product::UNAVAILABLE_PRODUCT;
                $product->save();     
            }
        });
    }

    public function register()
    {
        //
    }
}
