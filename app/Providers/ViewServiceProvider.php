<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('admin.roles.index', 'App\Http\ViewComposers\RoleComposer');
        view()->composer(['admin.access.update','admin.access.create'], 'App\Http\ViewComposers\AccessComposer');
        view()->composer('admin.users.create', 'App\Http\ViewComposers\RoleComposer');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
