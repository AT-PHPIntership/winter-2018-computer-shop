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
        view()->composer(['admin.access.update','admin.access.create'], 'App\Http\ViewComposers\AccessComposer');
        view()->composer(['admin.categories.create'], 'App\Http\ViewComposers\CategoryComposer');
        view()->composer(['admin.users.create', 'admin.users.edit','admin.roles.index'], 'App\Http\ViewComposers\RoleComposer');
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
