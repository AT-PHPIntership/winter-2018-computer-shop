<?php

namespace App\Services;

use App\Models\Product;
use DB;
use League\Flysystem\Exception;
use Yajra\Datatables\Datatables;

class ProductService
{
    /**
     * Get data for datatable
     *
     * @return object [object]
     */
    public function dataTable()
    {
        $products = Product::select(['id', 'name', 'quantity', 'unit_price', 'category_id']);
        return Datatables::of($products)
                ->addColumn('category', function (Product $product) {
                    return $product->category->name;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.products.action', ['id' => $data->id]);
                })
                ->make(true);
    }

   /**
    * Handle store a product to database
    *
    * @param object $request [request from add new product form]
    *
    * @return void
    */
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $input['unit_price'] = (int) str_replace(',', '', $request->unit_price);
            Product::create($input);
            DB::commit();
            session()->flash('message', __('master.content.message.create', ['attribute' => trans('master.content.attribute.product')]));
        } catch (Exception $ex) {
            DB::rollback();
             session()->flash('warning', __('master.content.message.error', ['attribute' => $ex->getMessage()]));
            return redirect()->back();
        }
    }

     /**
    * Handle update a product to database
    *
    * @param object $request [request update a product]
    * @param object $product [binding product model]
    *
    * @return void
    */
    public function update($request, $product)
    {
        DB::beginTransaction();
        try {
            $request['unit_price'] = (int) str_replace(',', '', request('unit_price'));
            $product->update($request);
            DB::commit();
            session()->flash('message', __('master.content.message.update', ['attribute' => trans('master.content.attribute.product')]));
        } catch (Exception $ex) {
            DB::rollback();
             session()->flash('warning', __('master.content.message.error', ['attribute' => $ex->getMessage()]));
            return redirect()->back();
        }
    }
}
