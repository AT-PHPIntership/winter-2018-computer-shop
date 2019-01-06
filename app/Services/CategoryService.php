<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    /**
     * Get parent category
     *
     * @return parent category
     */
    public function parent()
    {
        return Category::parents()->get();
    }

    /**
     * Handle add category to data
     *
     * @param object $request request from form add category
     *
     * @return void
     */
    public function store($request)
    {
        return Category::create($request->all());
        session()->flash('message', __('master.content.message.create', ['attribute' => trans('master.content.attribute.category')]));
    }
}
