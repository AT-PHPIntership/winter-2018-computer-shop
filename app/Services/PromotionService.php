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
}
