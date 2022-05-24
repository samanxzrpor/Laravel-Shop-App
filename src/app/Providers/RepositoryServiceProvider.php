<?php

namespace App\Providers;

use App\Repositories\Admin\ProductRepository;
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
        $this->app->bind(RepositoriesInterface::class , ProductRepository::class);
    }
}
