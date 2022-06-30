<?php

namespace App\Providers;

use App\Repositories\Admin\Blog\BlogRepository;
use App\Repositories\Admin\Blog\BlogRepositoryInterface;
use App\Repositories\Admin\Category\CategoryRepository;
use App\Repositories\Admin\Category\CategoryRepositoryInterface;
use App\Repositories\Admin\Comment\CommentRepository;
use App\Repositories\Admin\Comment\CommentRepositoryInterface;
use App\Repositories\Admin\Coupon\CouponRepository;
use App\Repositories\Admin\Coupon\CouponRepositoryInterface;
use App\Repositories\Admin\Order\OrderRepository;
use App\Repositories\Admin\Order\OrderRepositoryInterface;
use App\Repositories\Admin\Product\ProductRepository;
use App\Repositories\Admin\Product\ProductRepositoryInterface;
use App\Repositories\Admin\User\UserRepository;
use App\Repositories\Admin\User\UserRepositoryInterface;
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
        $this->app->bind(CategoryRepositoryInterface::class , CategoryRepository::class);
        $this->app->bind(CommentRepositoryInterface::class , CommentRepository::class);
        $this->app->bind(OrderRepositoryInterface::class , OrderRepository::class);
        $this->app->bind(UserRepositoryInterface::class , UserRepository::class);
        $this->app->bind(CouponRepositoryInterface::class , CouponRepository::class);
    }
}
