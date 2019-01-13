<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param object $request [request to store product]
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        app(ProductService::class)->store($request->all());
        return redirect()->route('products.index');
    }
}
