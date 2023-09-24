<?php

/*
 * This file is part of the FunTicket.
 *
 * (c) Hungjiun
 */

namespace App\Modules\Product\Providers;


use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
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
        $source = realpath(__DIR__.'/../Database/migrations/');
        $this->loadMigrationsFrom($source);
        $this->mergeConfigFrom(__DIR__.'/../Config/product.php', 'product');
    }
}
