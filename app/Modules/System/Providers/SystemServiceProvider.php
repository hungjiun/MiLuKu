<?php

/*
 * This file is part of the FunTicket.
 *
 * (c) WishMobile
 */

namespace App\Modules\System\Providers;


use Illuminate\Support\ServiceProvider;

class SystemServiceProvider extends ServiceProvider
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
    }
}
