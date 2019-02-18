<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Services\OrderService;
use Illuminate\Support\Facades\Lang;

class OrderController extends Controller
{
    protected $orderService;

    /**
     * Constructer
     *
     * @param OrderService $orderService [Orderserviece]
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->orderService->index();
        return view('admin.orders.index', compact('orders'));
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param Model $order Model
     *
     * @return void
     */
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Eit order page
     *
     * @param Order $order [Object order
     *
     * @return void
     */
    public function edit(Order $order)
    {
        return view('admin.orders.update', compact('order'));
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Delete order
     *
     * @param [Int] $id [Id order]
     *
     * @return void
     */
    public function destroy($id)
    {
        $message = $this->orderService->delete($id);
        dd($message);
        if ($message === 1) {
            return redirect()->route('orders.index')->with('message', Lang::get('master.content.message.delete', ['attribute' => 'Order']));
        } else {
            return redirect()->route('orders.index')->with('message', Lang::get('master.content.message.error'));
        }
    }
}