<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ImportRequest;
use App\Services\ProductService;
use App\Services\ImageService;
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
     * Show the form for import a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
        return view('admin.products.import');
    }

    /**
     * Handle the import a new resource.
     *
     * @param object $request [request to save data from import file]
     *
     * @return \Illuminate\Http\Response
     */
    public function handleImport(ImportRequest $request)
    {
        try {
            app(ProductService::class)->importFile($request);
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            return redirect()->back();
        }
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
        app(ProductService::class)->store($request->all());
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
        $products = app(ProductService::class)->show($product);
        return view('admin.products.show', compact('products'));
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
        $products = app(ProductService::class)->edit($product);
        return view('admin.products.edit', compact('products'));
    }

    /**
     * Show the form for editing a resource.
     *
     * @param object $request [request delete image of a product]
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteImage(Request $request)
    {
        $response = ['data' => app(ImageService::class)->deleteImage($request->image), 'message' => 'success!', 'result' => 200];
        return response()->json($response);
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

    /**
     * Delete a created resource in storage.
     *
     * @param object $product [binding product model]
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        app(ProductService::class)->delete($product);
        return redirect()->route('products.index');
    }
}
