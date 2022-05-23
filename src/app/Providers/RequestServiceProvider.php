<?php

namespace App\Providers;

use App\Http\Requests\API\Admin\Products\StoreProductRequest;
use App\Http\Requests\RequestInterface;
use Illuminate\Support\ServiceProvider;

class RequestServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(RequestInterface::class , StoreProductRequest::class);
    }
}
