<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Services\PromotionService;
use App\Http\Requests\PromotionRequest;
use Illuminate\Support\Facades\Lang;

class PromotionController extends Controller
{


    private $promotionService;
    /**
     * Constructer Promotions
     *
     * @param PromotionService $promotionService Constructer
     */
    public function __construct(PromotionService $promotionService)
    {
        $this->promotionService = $promotionService;
    }

    /**
     * The function return promotion index of admin page
     *
     * @return void
     */
    public function index()
    {
        $promotions = $this->promotionService->index();
        return view('admin.promotions.index', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.promotions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request sdf
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PromotionRequest $request)
    {
        $this->promotionService->create($request);
        return redirect()->route('promotions.index')->with('message', Lang::get('master.content.message.create', [
            'attribute' => 'promotion']));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    // public function edit(Promotion $promotion)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request   sdf
     * @param \App\Models\Promotion    $promotion sdf
     *
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Promotion $promotion)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Promotion $promotion asdf
     *
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Promotion $promotion)
    // {
    //     //
    // }
}
