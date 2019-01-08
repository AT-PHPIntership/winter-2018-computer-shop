<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Services\CategoryService;


class CategoryComposer
{
    private $categoryService;
    /**
     * Contructer CategoryService
     *
     * @param CategoryService $categoryService [categoryService]
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;

    }

    /**
    * Bind data to the view.
    *
    * @param View $view [view]
    *
    * @return void
    */
    public function compose(View $view)
    {
        $view->with('categories', $this->categoryService->getAllData());
    }
}
