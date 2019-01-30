<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Services\ProductService;

class ProductComposer
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
        $view->with(['saleOff' => app(ProductService::class)->saleOff(), 'feature' => app(ProductService::class)->feature(), 'bestSeller' => app(ProductService::class)->bestSeller(), 'newArrival' => app(ProductService::class)->newArrival()]);
    }
}
