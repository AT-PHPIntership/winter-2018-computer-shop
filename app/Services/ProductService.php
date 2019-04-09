<?php

namespace App\Services;

use App\Models\Product;
use DB;
use League\Flysystem\Exception;
use Yajra\Datatables\Datatables;
use App\Models\Comment;
use App\Models\Accessory;
use App\Models\Category;
use App\Models\Promotion;
use App\Services\ImageService;
use Excel;
use App\Models\OrderDetail;
use Carbon\Carbon;
class ProductService
{
    /**
     * Get data for datatable
     *
     * @return object [object]
     */
    public function dataTable()
    {
        $products = Product::select(['id', 'name', 'total_sold', 'unit_price', 'category_id']);
        return Datatables::of($products)
            ->addColumn('category', function (Product $product) {
                return $product->category->name;
            })
            ->addColumn('unit_price', function (Product $product) {
                return number_format($product->unit_price,0,",",".");
            })
            ->addColumn('discount', function (Product $product) {
                $validatePromotion = $product->promotions->filter(function ($value, $key) {
                                        if (strpos(Carbon::parse($value->end_at)->diffForHumans(), 'ago') == false ) {
                                            return $value;
                                        }
                                    });
                $percentPromotion = $validatePromotion->pluck('percent')->first();
                $unit_price = $product->unit_price;
                if ($validatePromotion->count() > 0) {
                    return number_format($unit_price - (($unit_price * $percentPromotion)/100),0,",",".") . ' ' . '(' . $percentPromotion . '%' . ')' ;
                }
                return number_format($unit_price,0,",",".");
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
            $request['unit_price'] = (int) str_replace(',', '', $request['unit_price']);
            $product = Product::create($request);
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

    /**
     * Handle store a product to database
     *
     * @param object $product [request show details a product]
     *
     * @return void
     */
    public function show($product)
    {
        return $product->load('accessories', 'accessories.parent');
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
        return $product->load('accessories', 'accessories.parent');
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
            if (!is_null($request['deleteImage'])) {
                app(ImageService::class)->deleteImage($request['deleteImage']);
            }
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
            $filterData = $this->filterProduct($data);
            //Save product include category id
            $categories = Category::where('parent_id', '!=', null)->get();
            $categoryId = [];
            foreach ($categories as $category) {
                foreach ($filterData as $key => $categories) {
                    if ($category->name == $categories['category']) {
                        $categoryId[$key] = $category->id;
                    }
                }
            }
            $importProduct = [];
            foreach ($filterData as $key => $value) {
                $importProduct[] = ['name' => $value->name, 'quantity' => $value->quantity, 'unit_price' => $value->unit_price, 'description' => $value->description, 'category_id' => $categoryId[$key]];
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
            if ($filterData->count() > 0) {
                return session()->flash('message', __('master.content.message.import', ['attribute' => $filterData->count()]));
            }
            session()->flash('warning', __('master.content.message.noProductImport'));
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
        $fileData = collect($data->pluck('name'))->map(function ($value) {
            return trim($value);
        })->filter();
        $productName = Product::pluck('name')->map(function ($value) {
            return trim($value);
        })->filter();
        $compare = $fileData->diff($productName);
        return $data->filter(function ($value) use ($compare) {
            return $compare->contains(trim($value->name));
        });
    }

    /**
     * Handle update a product to database
     *
     * @param object $product [binding product model]
     *
     * @return void
     */
    public function delete($product)
    {
        try {
            $orderDetail = OrderDetail::where('product_id', $product->id)->get();
            $order = $orderDetail->filter(function ($value, $key) {
                if ($value->order->status != config('constants.order.cancel')) {
                    return $value;
                }
            });
            $comments = Comment::where('product_id', $product->id)->get();
            if ($order->count() != 0) {
                session()->flash('warning', __('master.content.message.orderDetail'));
            } elseif ($comments->count() > 0) {
                session()->flash('warning', __('master.content.message.commentProduct'));
            } else {
                foreach ($product->images as $image) {
                    $productImage = realpath('storage/product/' . $image->name);
                    if (!is_null($image->name) && file_exists($productImage)) {
                        unlink($productImage);
                    }
                }
                $product->images()->delete();
                $product->accessories()->detach();
                $product->delete();
                session()->flash('message', __('master.content.message.delete', ['attribute' => trans('master.content.attribute.product')]));
            }
        } catch (Exception $ex) {
            session()->flash('warning', __('master.content.message.error', ['attribute' => $ex->getMessage()]));
            return redirect()->back();
        }
    }

    /*************************Function use for Public Page***********************************/

    /**
     * Function help get product has sale off
     *
     * @return collection
     **/
    public function saleOff()
    {
        return Promotion::with('products.images')->orderBy('percent', 'desc')->first();
    }

    /**
     * Function help get product
     *
     * @return Product
     **/
    public function feature()
    {
        return Product::with(['promotions' => function ($query) {
                            $query->where('start_at', '<=', Carbon::now())
                                ->where('end_at', '>=', Carbon::now());
                        }])
                        ->take(config('constants.product.feature'))
                        ->get();
    }

    /**
     * Function help get bestseller
     *
     * @return Product
     **/
    public function bestSeller()
    {
        return Product::with(['promotions' => function ($query) {
                                $query->where('start_at', '<=', Carbon::now())
                                    ->where('end_at', '>=', Carbon::now());
                                }])->orderBy('total_sold', 'desc')
                                    ->groupBy('total_sold')
                                    ->take(config('constants.product.bestSeller'))
                                    ->get();
    }

    /**
     * Function help get new Arrival product
     *
     * @return Product
     **/
    public function newArrival()
    {
        return Product::with(['promotions' => function ($query) {
                        $query->where('start_at', '<=', Carbon::now())
                            ->where('end_at', '>=', Carbon::now());
        }])->latest()->take(config('constants.product.newArrival'))->get();
    }

    /**
     * Get category based on id
     *
     * @return collection
     */
    public function allCategory()
    {
        return Product::with(['promotions' => function ($query) {
                            $query->where('start_at', '<=', Carbon::now())
                                ->where('end_at', '>=', Carbon::now());
                        }])
                        ->paginate(config('constants.category.all'));
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
        return Product::with(['promotions' => function ($query) {
                            $query->where('start_at', '<=', Carbon::now())
                                ->where('end_at', '>=', Carbon::now());
                        }])
                        ->join('categories', 'products.category_id', '=', 'categories.id')
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
        return $product->load(['promotions' => function ($query) {
                                $query->where('start_at', '<=', Carbon::now())
                                    ->where('end_at', '>=', Carbon::now());
                            }], 'accessories', 'comments', 'comments.childrens');
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
        return Product::with(['images', 'promotions' => function ($query) {
                                $query->where('start_at', '<=', Carbon::now())
                                    ->where('end_at', '>=', Carbon::now());
                            }])
                            ->join('categories', 'products.category_id', '=', 'categories.id')
                            ->select('products.name', 'products.id', 'products.unit_price', 'products.quantity', 'categories.parent_id', 'categories.id as categoryId', 'categories.name as categoryName')
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

    /**
     * Get product based on query
     *
     * @param object $query [query get product]
     *
     * @return collection
     */
    public function ajaxProductSearch($query)
    {
        return DB::table('products')
            ->select('id', 'name')
            ->where('name', 'LIKE', "%{$query}%")
            ->take(config('constants.search.quantity'))->get();
    }

    /**
     * Get product based on query
     *
     * @param object $query [query get product]
     *
     * @return collection
     */
    public function productSearch($query)
    {
        return Product::where('name', 'LIKE', "%{$query}%")->paginate(config('constants.category.all'))->appends(['query' => $query]);
    }

    /**
     * Get product based on filter field
     *
     * @param object $query    [query get product]
     * @param object $parentId [parent id of accessory]
     * @param object $value    [filter value]
     *
     * @return collection
     */
    public function productFilter($data)
    {
        $accessories = collect();
        $price = collect();
        $sort = collect();
        collect($data)->map(function($element) use($accessories,$price, $sort ) {
            if ($element['type'] == 'Price') {
                $price[] = $element['query'];
            } else if ($element['type'] == 'Sort') {
                $sort[] = $element['query'];
            } else {
                $accessories[] = intval($element['query']);
            }
        });
        $products = Product::with(['images', 'promotions' => function ($query) {
                                $query->where('start_at', '<=', Carbon::now())
                                    ->where('end_at', '>=', Carbon::now());
                            }])
                            ->select('products.id', 'products.name', 'products.quantity', 'products.unit_price', DB::raw('COUNT(*) as count'), 'categories.id as category_id', 'categories.name as category_name')
                            ->join('accessory_product', 'accessory_product.product_id', '=', 'products.id')
                            ->join('accessories', 'accessory_product.accessory_id', '=', 'accessories.id')
                            ->join('categories', 'categories.id', '=', 'products.category_id');
                    
        if ($accessories->isNotEmpty()) {
            $count = $accessories->count();
            $products->whereIn('accessories.id',  ($accessories->toArray()))->groupBy('products.id')->having('count', '>', ($count - 1));
        }
        
        if($price->isNotEmpty()) {
            $smallCompare = $price->first();
            $biggerCompare = intval($smallCompare) + 1;
            if (is_null(config("constants.price." . $biggerCompare))) {
                $products->where('products.unit_price', '>', config("constants.price." . $smallCompare))->groupBy('products.id');
            } else {
                $products->where([
                    ['products.unit_price', '<=', config("constants.price.{$biggerCompare}")],
                    ['products.unit_price', '>=', config("constants.price.{$smallCompare}")]])->groupBy('products.id');
            }
        }
        if($sort->isNotEmpty()) {
            if (($sort->first()) == 'latest') {
                $products->orderBy('products.updated_at', 'desc')->groupBy('products.id'); 
            } elseif (($sort->first()) == 'asc') {
                $products->orderBy('products.unit_price', 'asc')->groupBy('products.id');
            } else {
                $products->orderBy('products.unit_price', 'desc')->groupBy('products.id');
            }
        }
        $result = [];
        $items = [];
        foreach (($products->get()) as $key => $product) {
            $items[$key]['id'] = $product->id;
            $items[$key]['name'] = $product->name;
            $items[$key]['unit_price'] = $product->unit_price;
            $items[$key]['quantity'] = $product->quantity;
            $items[$key]['image'] =  $product->images->first();
            $items[$key]['promotion'] =  $product->promotions;
            $items[$key]['category_id'] =  $product->category_id;
            $items[$key]['category_name'] =  $product->category_name;
        }
        $result['products'] = $items;
        return $result;
    }
}
