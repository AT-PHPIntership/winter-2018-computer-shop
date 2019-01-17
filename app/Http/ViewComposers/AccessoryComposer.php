<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Services\AccessoryService;

class AccessoryComposer
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
        $view->with('accessories', app(AccessoryService::class)->getChildren());
    }
}
