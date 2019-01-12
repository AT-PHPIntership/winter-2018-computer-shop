<?php

namespace App\Services;

use App\Models\Category;
use Yajra\Datatables\Datatables;
use App\Services\ImageService;

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
}
