<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use App\Models\Category;
use Illuminate\Support\Facades\Lang;

class CategoryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = app(CategoryService::class)->getAllData();
        return view('admin.categories.index', compact('categories'));
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
     * @param object $category [get children category]
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $categories = app(CategoryService::class)->getChildren($category);
        return view('admin.categories.show', compact('categories'));
    }
}
