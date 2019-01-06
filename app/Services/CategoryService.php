<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    /**
     * Get data form users table return user index page
     *
     * @return object [object]
     */
    public function getAllData()
    {
        $category = Category::parents()->orderBy('id', \Config::get('define.user.order_by_desc'))->paginate(\Config::get('define.user.limit_rows'));
        return $category;
    }
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
    /**
     * Get data form users table return user index page
     *
     * @param object $category [request get children category]
     *
     * @return object [object]
     */
    public function getChildren($category)
    {
         return $category = Category::where('parent_id', $category->id)->latest()->paginate(\Config::get('define.user.limit_rows'));
    }
}
