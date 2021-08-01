<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected static $repositories = [
        'code' => [
            \App\Repositories\Code\CodeRepositoryInterface::class,
            \App\Repositories\Code\CodeRepositoryEloquent::class,
        ],
        'user' => [
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepositoryEloquent::class,
        ],
        'supplier' => [
            \App\Repositories\Supplier\SupplierRepositoryInterface::class,
            \App\Repositories\Supplier\SupplierRepositoryEloquent::class,
        ],
    ];
    public function register()
    {
        foreach (static::$repositories as $repository) {
            $this->app->bind(
                $repository[0],
                $repository[1]
            );
        }
    }
}