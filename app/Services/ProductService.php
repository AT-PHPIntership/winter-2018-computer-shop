<?php

namespace App\Services;

use App\Models\Product;
use DB;
use League\Flysystem\Exception;

class ProductService
{
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
}
