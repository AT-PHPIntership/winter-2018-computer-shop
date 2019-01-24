<?php

namespace App\Services;

use App\Models\Product;
use DB;
use League\Flysystem\Exception;
use Yajra\Datatables\Datatables;
use App\Models\Image;
use App\Models\Accessory;
use App\Models\Category;
use App\Services\ImageService;
use Excel;

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
    * Help sync accessories of a product
    *
    * @param collect $accessory [request update accessories]
    * @param object  $product   [binding product model]
    *
    * @return void
    */
    public function syncAccessory($accessory, $product)
    {
        if (array_key_exists('accessory_id', $accessory)) {
            $product->accessories()->sync($accessory['accessory_id']);
        }
    }

    /**
    * Handle import product from file
    *
    * @param object $request [request import product]
    *
    * @return void
    */
    public function importFile($request)
    {
        DB::beginTransaction();
        try {
            $path = $request->file('import_file')->getRealPath();
            $data = Excel::load($path)->get();
            //Check products is duplicate when import
            $data = $this->filterProduct($data);
            //Save product include category id
            $categories = Category::where('parent_id', '!=', null)->get();
                            $categoryId = [];
            foreach ($categories as $category) {
                foreach ($data as $key => $categories) {
                    if ($category->name == $categories['category']) {
                        $categoryId[$key] = $category->id;
                    }
                }
            }
            $importProduct = [];
            foreach ($data as $key => $value) {
                   $importProduct[]= ['name' => $value->name, 'quantity' => $value->quantity, 'unit_price' => $value->unit_price, 'description' => $value->description, 'category_id' => $categoryId[$key] ];
            }
            foreach ($importProduct as $value) {
                Product::insert($value);
            }
            //Sync between products and accessories
            $accessories = Accessory::where('parent_id', '!=', null)->get();
            $accesoryLists = $accessories->pluck('id', 'name');
            $this->accessory = collect();
            $data->map(function ($v) use ($accesoryLists) {
                $value['ram'] = $accesoryLists->get($v['ram']);
                $value['cpu'] = $accesoryLists->get($v['cpu']);
                $value['hdd'] = $accesoryLists->get($v['hdd']);
                $value['monitor'] = $accesoryLists->get($v['monitor']);
                $value['gpu'] = $accesoryLists->get($v['gpu']);
                $this->accessory->push(collect($value)->filter());
            });
            $products = Product::orderBy('id', 'desc')->take(count($importProduct))->get()->sortBy('id');
            foreach ($products->values() as $key => $product) {
                $accessory = $this->accessory[$key];
                $product->accessories()->sync($accessory);
            }
            DB::commit();
            session()->flash('message', __('master.content.message.import'));
        } catch (Exception $ex) {
            DB::rollback();
            session()->flash('warning', __('master.content.message.error', ['attribute' => $ex->getMessage()]));
            return redirect()->back();
        }
    }

    /**
     * Function help fillter product is duplicate or not
     *
     * @param array $data [data help compare with data in product table]
     *
     * @return $data
    **/
    public function filterProduct($data)
    {
        $fileData = collect($data->pluck('name'));
        $productName = Product::pluck('name');
        $compare = $fileData->diff($productName);
        return $data->whereIn('name', $compare);
    }

    /*************Function use for Public Page***********************************/

    /**
     * Function help get product has sale off
     *
     * @return Product
    **/
    public function saleOff()
    {
        return Product::take(config('constants.product.saleOff'))->get();
    }

    /**
     * Function help get product
     *
     * @return Product
    **/
    public function feature()
    {
        return Product::take(config('constants.product.feature'))->get();
    }

    /**
     * Function help get bestseller
     *
     * @return Product
    **/
    public function bestSeller()
    {
        return Product::orderBy('total_sold', 'desc')->groupBy('total_sold')->take(config('constants.product.bestSeller'))->get();
    }

    /**
     * Function help get new Arrival product
     *
     * @return Product
    **/
    public function newArrival()
    {
        return Product::latest()->take(config('constants.product.newArrival'))->get();
    }

    /**
     * Get category based on id
     *
     * @return collection
     */
    public function allCategory()
    {
        return Product::paginate(config('constants.category.all'));
    }

    /**
     * Get product based on category id
     *
     * @param object $category [binding category model]
     *
     * @return collection
     */
    public function publicPage($category)
    {
        $raw = $category->parent_id != null ? 'category_id = ?' : 'parent_id = ?';
        return Product::join('categories', 'products.category_id', '=', 'categories.id')
                        ->select('products.*', 'categories.parent_id', 'categories.name as categoryName')
                        ->whereRaw($raw, $category->id)
                        ->paginate(config('constants.category.all'));
    }

    /**
     * Get product based on category id
     *
     * @param object $product [binding product model]
     *
     * @return collection
     */
    public function publicProduct($product)
    {
        return $product->load('accessories');
    }

    /**
     * Get product based on category id
     *
     * @param object $product [binding product model]
     *
     * @return collection
     */
    public function getRelated($product)
    {
        return Product::with(['images'])
                        ->join('categories', 'products.category_id', '=', 'categories.id')
                        ->select('products.name', 'products.id', 'products.unit_price', 'categories.parent_id', 'categories.id as categoryId', 'categories.name as categoryName')
                        ->where('parent_id', $product->category->parent_id)
                        ->get();
    }

    /**
     * Get product based on id
     *
     * @param object $id [ product id]
     *
     * @return collection
     */
    public function compareProduct($id)
    {
        return Product::where('id', $id)->get();
    }
}
