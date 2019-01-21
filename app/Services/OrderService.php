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
     * Delete order
     *
     * @param [Int] $id [Id order]
     *
     * @return void
     */
    public function delete($id)
    {
        try {
            $message = Order::where('id', $id)->delete();
            return $message;
        } catch (\Exception $e) {
            return $message = $e->getMessage();
        }
    }
}
