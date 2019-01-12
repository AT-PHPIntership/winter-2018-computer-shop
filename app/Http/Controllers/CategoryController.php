<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index', ['categories' => app(CategoryService::class)->getAllData()]);
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
     * @param object $request [request create a new category]
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
     * @param object $category [binding category model]
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', ['categories' => app(CategoryService::class)->getEachCategory($category)]);
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
