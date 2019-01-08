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
        view()->composer(['admin.users.create', 'admin.users.edit'], 'App\Http\ViewComposers\RoleComposer');
        view()->composer(['admin.categories.create', 'admin.categories.edit', 'admin.products.create'], 'App\Http\ViewComposers\CategoryComposer');
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
