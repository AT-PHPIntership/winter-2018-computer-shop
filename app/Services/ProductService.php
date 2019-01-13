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
            $request['unit_price'] = (int) str_replace(',', '', $request['unit_price']);
            $product = Product::create($request);
            // dd($request);
            if (array_key_exists('images', $request)) {
                foreach ($request['images'] as $images) {
                    $imageName = time() . '_' . $images->getClientOriginalName();
                    $images->move('storage/product', $imageName);
                    $product->images()->create([
                        'name' => $imageName
                    ]);
                }
            }
            if (array_key_exists('accessory_id', $request)) {
                $product->accessories()->attach($request['accessory_id']);
            }
            DB::commit();
            session()->flash('message', __('master.content.message.create', ['attribute' => trans('master.content.attribute.product')]));
        } catch (Exception $ex) {
            DB::rollback();
             session()->flash('warning', __('master.content.message.error', ['attribute' => $ex->getMessage()]));
            return redirect()->back();
        }
    }
}
