<?php

namespace App\Services;

use App\Models\Category;
use App\Services\ImageService;

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
        try {
            if (array_key_exists('image', $request)) {
                $request['image'] = app(ImageService::class)->handleUploadedImage($request['image'], trans('master.content.attribute.category'));
            }
            Category::create($request);
            session()->flash('message', __('master.content.message.create', ['attribute' => trans('master.content.attribute.category')]));
        } catch (Exception $ex) {
            session()->flash('warning', __('master.content.message.error', ['attribute' => $ex->getMessage()]));
            return redirect()->back();
        }
    }

    /**
     * Get data form users table return user index page
     *
     * @param object $category [binding category model]
     *
     * @return object [object]
     */
    public function getEachCategory($category)
    {
         return $category = Category::where('parent_id', $category->id)->orderBy('id', \Config::get('define.user.order_by_desc'))->paginate(\Config::get('define.user.limit_rows'));
    }

     /**
     * Handle delete category out of data
     *
     * @param object $category [binding category model]
     *
     * @return void
     */
    public function delete($category)
    {
        $subCategory = Category::where('parent_id', $category->id)->get();
        if ($subCategory->count() > 0) {
            session()->flash('warning', __('master.content.message.warning'));
        } else {
            try {
                $categoryImage = realpath('storage/category/' . $category->image);
                if (!is_null($category->image) && file_exists($categoryImage)) {
                    unlink($categoryImage);
                }
                $category->delete();
                session()->flash('message', __('master.content.message.delete', ['attribute' => trans('master.content.attribute.category')]));
            } catch (Exception $ex) {
                session()->flash('warning', __('master.content.message.error', ['attribute' => $ex->getMessage()]));
            }
        }
    }
}
