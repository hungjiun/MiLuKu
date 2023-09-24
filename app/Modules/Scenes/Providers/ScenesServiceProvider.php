<?php

/*
 * This file is part of the FunTicket.
 *
 * (c) Hungjiun
 */

namespace App\Modules\Scenes\Providers;


use Illuminate\Support\ServiceProvider;

class ScenesServiceProvider extends ServiceProvider
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
        $this->mergeConfigFrom(__DIR__.'/../Config/scenes.php', 'scenes');
    }
}
