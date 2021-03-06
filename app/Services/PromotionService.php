<?php

namespace App\Services;

use App\Models\Promotion;
use League\Flysystem\Exception;
use App\Models\Product;

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
     * Create Promotion and Product_promotion
     *
     * @param object $request Request from form
     *
     * @return void
     */
    public function create($request)
    {
        $promotion = Promotion::create($request->all());
        $totalSold = $request->total_sold;
        $productIds = Product::where('total_sold', '<', $totalSold)->pluck('id');
        $promotion->products()->sync($productIds);
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
     * Update table promotion and product_promotion
     *
     * @param [int]    $id      [Id promotion]
     * @param [object] $request [Request from form]
     *
     * @return [type]          [description]
     */
    public function update($id, $request)
    {
        try {
            $message = Promotion::where('id', $id)->update([
                            'name' => $request->name,
                            'percent' => $request->percent,
                            'start_at' => $request->start_at,
                            'end_at' => $request->end_at,
                            'total_sold' => $request->total_sold
                        ]);

            // update table product_promotion
            $totalSold = $request->total_sold;
            $productIds = Product::where('total_sold', '<', $totalSold)->pluck('id');
            Promotion::find($id)->products()->sync($productIds);

            return $message;
        } catch (Exception $e) {
            return $message = $e->getMessage();
        }
    }

    /**
     * Delete table promotion and product_promotion
     *
     * @param [int] $id Id Promotion
     *
     * @return void
     */
    public function delete($id)
    {
        try {
            Promotion::find($id)->products()->detach();
            $message = Promotion::where('id', $id)->delete();
            return $message;
        } catch (Exception $e) {
            return $message = $e->getMessage();
        }
    }
}
