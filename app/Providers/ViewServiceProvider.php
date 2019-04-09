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
        view()->composer(['admin.categories.create', 'admin.categories.edit', 'admin.products.create', 'admin.products.edit', 'public.layout.header', 'admin.promotions.create', 'admin.promotions.update', 'admin.promotions.index'], 'App\Http\ViewComposers\CategoryComposer');
        view()->composer(['admin.accessories.update', 'admin.accessories.create', 'admin.products.create', 'admin.products.edit', 'public.partials.filter'], 'App\Http\ViewComposers\AccessoryComposer');
        view()->composer(['admin.users.create', 'admin.users.edit', 'admin.roles.index', 'public.auth.register', 'admin.permissions.index'], 'App\Http\ViewComposers\RoleComposer');
        view()->composer(['admin.slides.index', 'public.partials.slide', 'public.partials.breadcrumb'], 'App\Http\ViewComposers\SlideComposer');
        view()->composer(['public.partials.slide', 'public.page.homepage'], 'App\Http\ViewComposers\ProductComposer');
        view()->composer(['admin.permissions.index', 'admin.roles.create', 'admin.roles.update', 'admin.roles.index', 'admin.users.index',  'admin.partials.edit_button', 'admin.partials.delete_button', 'admin.categories.index', 'admin.products.index', 'admin.slides.index', 'admin.comments.index', 'admin.orders.index', 'admin.promotions.index', 'admin.codes.index', 'admin.accessories.index'], 'App\Http\ViewComposers\PermissionComposer');
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
