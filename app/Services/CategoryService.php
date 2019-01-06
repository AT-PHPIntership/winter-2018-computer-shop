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
     * @param object $request [request from form add category]
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
     * @param object $category [the id of the parent category]
     *
     * @return object
     */
    public function getEachCategory($category)
    {
         return $category = Category::where('parent_id', $category->id)->orderBy('id', \Config::get('define.user.order_by_desc'))->paginate(\Config::get('define.user.limit_rows'));
    }

    /**
     * Handle update category to data
     *
     * @param object $request  [request from form add category]
     * @param object $category [model category]
     *
     * @return void
     */
    public function update($request, $category)
    {
        return $category->update($request->all());
    }

    /**
     * Handle get sub category when choose parent category
     *
     * @param object $id [id of parent category]
     *
     * @return collection
     */
    public function getSubCategory($id)
    {
        return Category::where('parent_id', $id)->select('id', 'name')->get();
    }
}
