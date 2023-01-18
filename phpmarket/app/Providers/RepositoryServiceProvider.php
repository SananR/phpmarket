<?php

namespace App\Providers;

use App\Interfaces\OrderProductRepository;
use App\Interfaces\OrderRepository;
use App\Interfaces\StoreRepository;
use App\Interfaces\UserRepository;
use App\Interfaces\ProductRepository;
use App\Repositories\EloquentOrderProductRepository;
use App\Repositories\EloquentOrderRepository;
use App\Repositories\EloquentStoreRepository;
use App\Repositories\EloquentUserRepository;
use App\Repositories\EloquentProductRepository;
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
