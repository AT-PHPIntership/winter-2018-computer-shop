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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index');
    }

    /**
     * Get data for category datatable
     *
     * @return \Illuminate\Http\Response
     */
    public function getData()
    {
        return app(CategoryService::class)->dataTable();
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
     * @param object $request [request store new category]
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        app(CategoryService::class)->store($request->all());
        return redirect()->route('categories.index');
    }

    /**
     * Get children category from ajax request
     *
     * @param object $request [request to get children category]
     *
     * @return json()
     */
    public function getChildren(Request $request)
    {
        $response = app(CategoryService::class)->getSubCategory($request->get('id'));
        return response()->json($response);
    }
}
