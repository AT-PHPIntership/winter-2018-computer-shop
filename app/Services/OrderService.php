<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderDetail;

class OrderService
{
    /**
     * Get list order
     *
     * @return void
     */
    public function index()
    {
        $orders = Order::with(['user', 'orderDetails.product'])->paginate(config('constants.order.number_paginate'));
        return $orders;
    }

    /**
     * Update order
     *
     * @param [Object] $request [Request from form]
     * @param [Int]    $id      [Idd order]
     *
     * @return void
     */
    public function update($request, $id)
    {
        try {
            $message = Order::where('id', $id)->update(['status' => $request->status]);
            return $message;
        } catch (\Exception $e) {
            return $message = $e->getMessage();
        }
    }
}
