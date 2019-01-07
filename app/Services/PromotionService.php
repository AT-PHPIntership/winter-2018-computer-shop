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
        $promotions = Promotion::paginate(config('constants.promotion.number_paginate'));
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
        Promotion::create($request->all());
    }
}
