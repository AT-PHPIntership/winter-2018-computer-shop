<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Services\OrderService;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Carbon;
use App\Models\UserCode;

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

    /**
     * Create oder
     *
     * @param OrderRequest $request Request from form
     *
     * @return void
     */
    public function create(OrderRequest $request)
    {
        // delete code applyed
        if (isset($request->codeId)) {
            $codeId = $request->codeId;
            $userId = $request->userId;
            $codeUser = UserCode::where('user_id', $userId)->Where('code_id', $codeId)->first();
            $codeUserID = $codeUser->id;
            $codeUser->delete();

            // create oder
            $dataOrder = [
                'user_id' => $request->userId,
                'code_user_id' => $codeUserID,
                'phone' => $request->phone,
                'address' => $request->address,
                'note' => $request->note,
                'status' => 2,
                'date_order' => Carbon::now()->toDateString(),
            ];
            $order = Order::create($dataOrder);
        } else {
            // create oder
            $dataOrder = [
                'user_id' => $request->userId,
                'phone' => $request->phone,
                'address' => $request->address,
                'note' => $request->note,
                'status' => 2,
                'date_order' => Carbon::now()->toDateString(),
            ];
            $order = Order::create($dataOrder);
        }
        // ceate oder-detail
        foreach ($request->productId as $key => $productId) {
            $dataProduct = [
                'product_id' => $productId,
                'quantity' => $request->quantity[$key],
                'price' => $request->subprice[$key],
                'order_id' => $order->id
            ];
            OrderDetail::create($dataProduct);

            // update quantity, total-sold Product
            $product = Product::find($productId);
            $quantityProduct = [
                'quantity' => ($product->quantity - $request->quantity[$key]),
                'total_sold' => ($product->total_sold + $request->quantity[$key])
            ];

            $product->update($quantityProduct);
        }
        return redirect()->route('public.home')->with('message', 'Order successful');
    }

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
