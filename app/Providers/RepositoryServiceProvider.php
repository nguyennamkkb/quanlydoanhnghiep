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
        'category' => [
            \App\Repositories\Category\CategoryRepositoryInterface::class,
            \App\Repositories\Category\CategoryRepositoryEloquent::class,
        ],
        'customer' => [ 
            \App\Repositories\Customer\CustomerRepositoryInterface::class,
            \App\Repositories\Customer\CustomerRepositoryEloquent::class,
        ],
        'customertype' => [ 
            \App\Repositories\CustomerType\CustomerTypeRepositoryInterface::class,
            \App\Repositories\CustomerType\CustomerTypeRepositoryEloquent::class,
        ],
        'categorychild' => [ 
            \App\Repositories\CategoryChild\CategoryChildRepositoryInterface::class,
            \App\Repositories\CategoryChild\CategoryChildRepositoryEloquent::class,
        ],
    ];
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
        foreach (static::$repositories as $repository) {
            $this->app->bind(
                $repository[0],
                $repository[1]
            );
        }
        
    }

}