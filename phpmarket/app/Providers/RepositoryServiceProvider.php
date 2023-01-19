<?php

namespace App\Providers;

use App\Repositories\eloquent\EloquentOrderProductRepository;
use App\Repositories\eloquent\EloquentOrderRepository;
use App\Repositories\eloquent\EloquentProductRepository;
use App\Repositories\eloquent\EloquentStoreRepository;
use App\Repositories\eloquent\EloquentUserRepository;
use App\Repositories\OrderProductRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\StoreRepository;
use App\Repositories\UserRepository;
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
        $this->app->bind(StoreRepository::class, EloquentStoreRepository::class);
        $this->app->bind(UserRepository::class, EloquentUserRepository::class);
        $this->app->bind(ProductRepository::class, EloquentProductRepository::class);
        $this->app->bind(OrderRepository::class, EloquentOrderRepository::class);
        $this->app->bind(OrderProductRepository::class, EloquentOrderProductRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
