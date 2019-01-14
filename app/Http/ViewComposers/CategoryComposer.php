<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Services\CategoryService;

class CategoryComposer
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
        $view->with('categories', app(CategoryService::class)->parent());
    }
}
