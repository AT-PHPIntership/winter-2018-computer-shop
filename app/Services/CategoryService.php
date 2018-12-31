<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    /**
     * Handle add category to data
     *
     * @param object $request request from form add category
     *
     * @return void
     */
    public function create($request)
    {
        return Category::create($request->all());
    }
}
