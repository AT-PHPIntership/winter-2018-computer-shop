<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use App\Models\Category;
use Illuminate\Support\Facades\Lang;

class CategoryController extends Controller
{
    private $categoryService;

   /**
    * Contructer CategoryService
    *
    * @param UserService $categoryService [categoryService]
    */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index', ['categories' => $this->categoryService->getAllData()]);
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
        $this->categoryService->create($request);
        return redirect()->route('categories.index')->with('message', Lang::get('master.content.message.create', ['attribute' => 'category']));
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
        $categories = $this->categoryService->getChildren($category);
        return view('admin.categories.show', compact('categories'));
    }
}
