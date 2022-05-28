<?php

namespace App\Providers;

use App\Repositories\Admin\Blog\BlogRepository;
use App\Repositories\Admin\Blog\BlogRepositoryInterface;
use App\Repositories\Admin\Product\ProductRepository;
use App\Repositories\Admin\Product\ProductRepositoryInterface;
use App\Repositories\RepositoriesInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(BlogRepositoryInterface::class , BlogRepository::class);
        $this->app->bind(ProductRepositoryInterface::class , ProductRepository::class);
    }
}
