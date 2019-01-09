<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display the index page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.index');
    }

    /**
     * Get data for product datatable
     *
     * @return \Illuminate\Http\Response
     */
    public function getData()
    {
        return app(ProductService::class)->dataTable();
    }

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
        app(ProductService::class)->store($request);
        return redirect()->route('products.index');
    }

    /**
     * Show the detail for a resource.
     *
     * @param object $product [binding product model]
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing a resource.
     *
     * @param object $product [binding product model]
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update a created resource in storage.
     *
     * @param object $request [request to update product]
     * @param object $product [binding product model]
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        app(ProductService::class)->update($request->all(), $product);
        return redirect()->route('products.index');
    }
}
