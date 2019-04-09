<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderDetail;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class OrderService
{
    /**
     * Get list order
     *
     * @return void
     */
    public function index()
    {
        $orders = Order::with(['user', 'orderDetails.product'])->orderBy('id', 'desc')->paginate(config('constants.order.number_paginate'));
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
            OrderDetail::where('order_id', $id)->delete();
            $message = Order::where('id', $id)->delete();
            return $message;
        } catch (\Exception $e) {
            return $message = $e->getMessage();
        }
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

    /**
     * Export file collect order based on month
     *
     * @return file xlsx
     */
    public function orderExport()
    {
        $lastMonth = Carbon::now()->subMonth()->month;
        $month = Carbon::now()->month;
        $data = Order::whereMonth('date_order', '>=', $lastMonth)
                        ->get();
        Excel::create('month_' . $lastMonth . '_' . $month . '_order', function ($excel) use ($data) {
            $excel->sheet('order', function ($sheet) use ($data) {
                $sheet->loadView('admin.orders.export', compact('data'));
            });
        })->export('xlsx');
    }
}
