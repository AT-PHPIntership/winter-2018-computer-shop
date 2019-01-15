<?php

namespace App\Services;

use App\Models\Product;
use DB;
use League\Flysystem\Exception;
use Yajra\Datatables\Datatables;
use App\Models\Image;
use App\Services\ImageService;

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
    * Show form edit a product
    *
    * @param object $product [binding product model]
    *
    * @return product with accessories
    */
    public function edit($product)
    {
         return Product::where('id', $product->id)->with('accessories', 'accessories.parent')->first();
    }

    /**
    * Show form edit a product
    *
    * @param object $imageId [the id of image]
    *
    * @return imageId
    */
    public function deleteImage($imageId)
    {
        $imageId = Image::find($imageId);
        $images = Image::where('product_id', $imageId->product->id)->get();
        foreach ($images as $image) {
            if ($imageId->id == $image->id) {
                unlink('storage/product/' . $image->name);
                $image->delete();
                return $imageId;
            }
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
            app(ImageService::class)->addMultipleImage($request, $product);
            $this->syncAccessory($request, $product);
            DB::commit();
            session()->flash('message', __('master.content.message.update', ['attribute' => trans('master.content.attribute.product')]));
        } catch (Exception $ex) {
            DB::rollback();
             session()->flash('warning', __('master.content.message.error', ['attribute' => $ex->getMessage()]));
            return redirect()->back();
        }
    }

    /**
    * Handle update accessories of a product
    *
    * @param object $request [request update accessories]
    * @param object $product [binding product model]
    *
    * @return void
    */
    public function syncAccessory($request, $product)
    {
        if (array_key_exists('accessory_id', $request)) {
            $product->accessories()->sync($request['accessory_id']);
        }
    }
}
