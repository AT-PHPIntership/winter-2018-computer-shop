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
        view()->composer(['admin.categories.create', 'admin.categories.edit', 'admin.products.create', 'admin.products.edit', 'public.layout.header'], 'App\Http\ViewComposers\CategoryComposer');
        view()->composer(['admin.accessories.update','admin.accessories.create', 'admin.products.create', 'admin.products.edit', 'public.partials.filter'], 'App\Http\ViewComposers\AccessoryComposer');
        view()->composer(['admin.users.create', 'admin.users.edit','admin.roles.index'], 'App\Http\ViewComposers\RoleComposer');
        view()->composer(['admin.slides.index', 'public.partials.slide', 'public.partials.breadcrumb'], 'App\Http\ViewComposers\SlideComposer');
        view()->composer(['public.partials.slide', 'public.page.homepage'], 'App\Http\ViewComposers\ProductComposer');
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
