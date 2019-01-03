<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Lang;

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
        \DB::beginTransaction();
        try {
            $input = $request->all();
            $input['unit_price'] = (int) str_replace(',', '', $request->unit_price);
            Product::create($input);
            \DB::commit();
        } catch (\Exception $ex) {
            \DB::rollback();
            return back()->with('warning', Lang::get('master.content.message.error', ['attribute' => $ex]));
        }
    }
}
