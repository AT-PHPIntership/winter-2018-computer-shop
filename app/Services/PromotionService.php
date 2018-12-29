<?php

namespace App\Services;

use App\Models\Promotion;

class PromotionService
{
    /**
     * Index get list promotions
     *
     * @return void
     */
    public function index()
    {
        $promotions = Promotion::all();
        return $promotions;
    }

    /**
     * Create Promotion
     *
     * @param object $request Request from form
     *
     * @return void
     */
    public function create($request)
    {
        Promotion::create([
            'name' => $request->name,
            'percent' => $request->percent,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at
        ]);
    }

    /**
     * Show edit page promotion
     *
     * @param [int] $id Id promotion
     *
     * @return void
     */
    public function edit($id)
    {
        $promotion = Promotion::where('id', $id)->first();
        return $promotion;
    }

    /**
     * Update promotion
     *
     * @param [int]    $id      [Id promotion]
     * @param [object] $request [Request from form]
     *
     * @return [type]          [description]
     */
    public function update($id, $request)
    {
        Promotion::where('id', $id)->update([
            'name' => $request->name,
            'percent' => $request->percent,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at
        ]);
    }
}