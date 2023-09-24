<?php

/*
 * This file is part of the FunTicket.
 *
 * (c) WishMobile
 */

namespace App\Modules\Memder\Providers;


use Illuminate\Support\ServiceProvider;

class MemberServiceProvider extends ServiceProvider
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
        $this->mergeConfigFrom(__DIR__.'/../Config/member.php', 'member');
    }
}
