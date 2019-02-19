<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index');
    }

    /**
     * Get data for category datatable
     *
     * @return \Illuminate\Http\Response
     */
    public function getData()
    {
        return app(CategoryService::class)->dataTable();
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param object $request [request store new category]
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        app(CategoryService::class)->store($request->all());
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param object $category [binding model category]
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $categories = app(CategoryService::class)->getChildren($category);
        return view('admin.categories.show', compact('categories'));
    }

    /**
     * Display a form to edit category
     *
     * @param object $category [binding category]
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }
    
    /**
     * Handle update category to database
     *
     * @param object $request  [request to update the category]
     * @param object $category [binding model category]
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        app(CategoryService::class)->update($request->all(), $category);
        return redirect()->route('categories.index');
    }

    /**
     * Get children category from ajax request
     *
     * @param object $request [request to get children category]
     *
     * @return json()
     */
    public function getChildren(Request $request)
    {
        $response = app(CategoryService::class)->getSubCategory($request->get('id'));
        return response()->json($response);
    }
    
    /**
     * Delete the specified resource.
     *
     * @param object $category [binding category model]
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        app(CategoryService::class)->delete($category);
        return redirect()->route('categories.index');
    }
}
