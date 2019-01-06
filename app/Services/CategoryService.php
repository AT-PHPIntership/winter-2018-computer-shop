<?php

namespace App\Services;

use App\Models\Category;
use Yajra\Datatables\Datatables;

class CategoryService
{
    /**
     * Get data for category datatable
     *
     * @return object [object]
     */
    public function dataTable()
    {
        $categories = Category::parents()->select(['id', 'name'])->get();
        return Datatables::of($categories)
                ->addColumn('action', function ($data) {
                    return view('admin.categories.action', ['id' => $data->id]);
                })
                ->make(true);
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
}
