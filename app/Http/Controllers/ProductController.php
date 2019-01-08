<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use App\Models\Product;

class ProductController extends Controller
{
    private $productService;

   /**
    * Contructer ProductService
    *
    * @param ProductService $productService [productService]
    */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

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
        return $this->productService->dataTable();
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
        $this->productService->store($request);
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
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }
}
