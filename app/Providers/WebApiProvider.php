<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\WebApiService;

class WebApiProvider extends ServiceProvider
{
    // wether defer to load provider
    protected $defer = true;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('WebApiService', function ($app) {
            return new WebApiService();    
        });

        $this->app->bind('App\Services\WebApiService', function () {
            return new WebApiService();    
        });
    }
}
