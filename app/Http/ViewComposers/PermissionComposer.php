<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Services\PermissionService;

class PermissionComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view [view]
     *
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('permissions', app(PermissionService::class)->getAll());
    }
}
