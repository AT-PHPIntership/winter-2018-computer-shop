<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
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
}
