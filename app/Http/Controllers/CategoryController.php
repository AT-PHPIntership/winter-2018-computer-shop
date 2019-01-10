<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;

class CategoryController extends Controller
{
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
     * @param object $request [request store category]
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        app(CategoryService::class)->store($request->all());
        return redirect()->route('categories.index');
    }
}
