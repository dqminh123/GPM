<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;
use App\Helper\giohang;
use App\Models\sanpham;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        view()->composer('*',function($view){
            $view->with([
                
                'giohang'=>new giohang(),
                
               
            ]);

        });
    }
}
