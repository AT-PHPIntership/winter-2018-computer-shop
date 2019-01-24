<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class StatisticService
{
    /**
     * Get data for view admin.home
     *
     * @return array
     */
    public function getData()
    {
        $totalUser = User::all()->count();
        $totalProduct = Product::all()->count();
        $totalOrder = Order::all()->count();
        $cancelOrder = Order::where('status', 0)->get()->count();
        $pendingOrder = Order::where('status', 1)->get()->count();
        $approveOrder = Order::where('status', 2)->get()->count();
        $arrayData = [
            'totalUser' => $totalUser,
            'totalProduct' => $totalProduct,
            'totalOrder' => $totalOrder,
            'cancelOrder' => $cancelOrder,
            'pendingOrder' => $pendingOrder,
            'approveOrder' => $approveOrder,
        ];
        return $arrayData;
    }
}
