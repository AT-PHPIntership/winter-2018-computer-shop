<?php

namespace App\Services;

use App\Models\Category;
use Yajra\Datatables\Datatables;
use App\Services\ImageService;
use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryService
{
    /**
     * Get data for category datatable
     *
     * @return object [object]
     */
    public function dataTable()
    {
        $categories = Category::parents()->select(['id', 'name', 'image'])->get();
        return Datatables::of($categories)
                ->addColumn('image', function (Category $category) {
                    return view('admin.categories.image', ['image' => $category->image]);
                })
                ->addColumn('action', function ($data) {
                    return view('admin.categories.action', ['id' => $data->id]);
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
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
     * @param object $request [request from form add category]
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
