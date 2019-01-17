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
        view()->composer(['admin.categories.create', 'admin.categories.edit', 'admin.products.create', 'admin.products.edit'], 'App\Http\ViewComposers\CategoryComposer');
        view()->composer(['admin.users.create', 'admin.users.edit','admin.roles.index'], 'App\Http\ViewComposers\RoleComposer');
        view()->composer(['admin.products.edit'], 'App\Http\ViewComposers\AccessoryComposer');
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
