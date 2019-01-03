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
        $promotions = Promotion::paginate(config('constants.number_paginate'));
        return $promotions;
    }
}
