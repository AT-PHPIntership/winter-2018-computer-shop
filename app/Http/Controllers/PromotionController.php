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
    // public function store(PromotionRequest $request)
    // {
    //     $this->promotionService->create($request);
    //     return redirect()->route('promotions.index')->with('message', Lang::get('master.content.message.create', [
    //         'attribute' => 'promotion']));
    // }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Edit promotion
     *
     * @param int $id Id promotion
     *
     * @return void
     */
    public function edit($id)
    {
        $promotion = $this->promotionService->edit($id);
        return view('admin.promotions.update', compact('promotion'));
    }

    /**
     * Update promotion
     *
     * @param int              $id      id promotion
     * @param PromotionRequest $request Request from form
     *
     * @return void
     */
    public function update($id, PromotionRequest $request)
    {
        $this->promotionService->update($id, $request);
        return redirect()->route('promotions.index')->with('message', Lang::get('master.content.message.update', [
            'attribute' => 'promotion']));
    }

    /**
     * Delete promotion
     *
     * @param [int] $id [Id promotion]
     *
     * @return void
     */
    public function destroy($id)
    {
        $this->promotionService->delete($id);
        return redirect()->route('promotions.index')->with('message', Lang::get('master.content.message.delete', [
            'attribute' => 'promotion']));
    }
}
