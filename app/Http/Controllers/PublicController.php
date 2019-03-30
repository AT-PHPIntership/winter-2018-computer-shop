<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use App\Services\CommentService;

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
     * Get product from keyword in search field
     *
     *@param request $request [request to get product]
     *
     * @return compare view
     */
    public function productSearch(Request $request)
    {
        if ($request->ajax()) {
            $response = app(ProductService::class)->ajaxProductSearch($request->get('query'));
            return response()->json($response);
        } else {
            $query = $request->get('query');
            $search = app(ProductService::class)->productSearch($query);
            return view('public.page.search', compact('search', 'query'));
        }
    }

    /**
     * Get product from keyword in filter field
     *
     *@param request $request [request to get product]
     *
     * @return mix view
     */
    public function productFilter(Request $request)
    {
        $value = $request->get('val');
        $products = app(ProductService::class)->productFilter($request->get('query'), $request->get('parentId'), $value);
        return view('public.page.filter', compact('products', 'value'));
    }

     /**
     * Get product from keyword in filter field
     *
     *@param request $request [request to get product]
     *
     * @return mix view
     */
    public function productSort(Request $request)
    {
        $products = app(ProductService::class)->productSort($request->get('query'), $request->get('val'));
        return view('public.page.filter', compact('products'));
    }

    /**
     * Comment of user about a product
     *
     *@param request $request [request to get product]
     *
     * @return mix view
     */
    public function productComment(Request $request)
    {
        $response = app(CommentService::class)->comment($request->get('userId'), $request->get('productId'), $request->get('content'));
        return response()->json($response);
    }

    /**
     * Reply a comment
     *
     *@param request $request [request to get product]
     *
     * @return mix view
     */
    public function productReply(Request $request)
    {
        $response = app(CommentService::class)->reply($request->get('userId'), $request->get('productId'), $request->get('content'), $request->get('parentComment'));
        return response()->json($response);
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

    /**
     * Display page checkout
     *
     * @return void
     */
    public function inforOder()
    {
        return view('public.page.ordered');
    }
}
