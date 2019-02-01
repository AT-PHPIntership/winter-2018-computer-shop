<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;

class PublicController extends Controller
{
    /**
     * Display a homepage of website.
     *
     * @return Homepage view
     */
    public function homepage()
    {
        return view('public.page.homepage');
    }

    /**
     * Display a category of website.
     *
     * @return Homepage view
     */
    public function allCategory()
    {
        $products = app(ProductService::class)->allCategory();
        return view('public.page.allproduct', compact('products'));
    }

    /**
     * Display a category of website.
     *
     *@param model $category [binding category model]
     *
     * @return Homepage view
     */
    public function category(Category $category)
    {
        $products = app(ProductService::class)->publicPage($category);
        return view('public.page.category', compact('products', 'category'));
    }

    /**
     * Display a category of website.
     *
     *@param model $product [binding product model]
     *
     * @return Homepage view
     */
    public function getProduct(Product $product)
    {
        $products = app(ProductService::class)->publicProduct($product);
        $relatedProduct = app(ProductService::class)->getRelated($product);
        return view('public.page.product', compact('products', 'relatedProduct'));
    }

    /**
     * Display a compare two product
     *
     *@param request $request [request to get product]
     *
     * @return compare view
     */
    public function compare(Request $request)
    {
        $firstProduct = app(ProductService::class)->compareProduct($request->first);
        $secondProduct = app(ProductService::class)->compareProduct($request->second);
        return view('public.page.compare', compact('firstProduct', 'secondProduct'));
    }

    /**
     * Display page cart
     *
     * @return void
     */
    public function cart()
    {
        return view('public.page.cart');
    }

    /**
     * Display page checkout
     *
     * @return void
     */
    public function checkout()
    {
        return view('public.page.checkout');
    }
}
