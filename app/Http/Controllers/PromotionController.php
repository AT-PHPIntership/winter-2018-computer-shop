<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Services\PromotionService;
use App\Http\Requests\PromotionRequest;
use App\Http\Requests\PromotionSearchRequest;
use Illuminate\Support\Facades\Lang;
use App\Models\Product;

class PromotionController extends Controller
{


    private $promotionService;
    /**
     * Constructer Promotions
     *
     * @param PromotionService $promotionService Constructer
     */
    public function __construct(PromotionService $promotionService)
    {
        $this->promotionService = $promotionService;
    }

    /**
     * The function return promotion index of admin page
     *
     * @return void
     */
    public function index()
    {
        $promotions = $this->promotionService->index();
        return view('admin.promotions.index', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.promotions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request sdf
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PromotionRequest $request)
    {
        // dd($request);
        // dd($request->get('productsPromotion'));
        app(PromotionService::class)->create($request);
        return redirect()->route('promotions.index')->with('message', Lang::get('master.content.message.create', [
            'attribute' => 'promotion']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request sdf
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // $totalSold = $request->get('totalSold');
        // $categoryId = $request->get('categoryId');
        // $priceProduct = $request->get('priceProduct');
        // $response = Product::where([['total_sold', '<', $totalSold],
        //                 ['unit_price', '<', $priceProduct],
        //                 ['category_id', $categoryId]])->get();
        // return response()->json($response);

        $validator = \Validator::make($request->all(), [
            'totalSold' => 'required|integer|min:1|max:30',
            'categoryId' => 'required|integer',
            'priceProduct' => 'required|integer|min:10000000|max:30000000'
        ]);


        if ($validator->passes()) {
            $totalSold = $request->get('totalSold');
            $categoryId = $request->get('categoryId');
            $priceProduct = $request->get('priceProduct');
            $response = Product::where([['total_sold', '<', $totalSold],
                            ['unit_price', '<', $priceProduct],
                            ['category_id', $categoryId]])->get();
            return response()->json($response);
        }


        return response()->json(['error'=>$validator->errors()->all()]);
    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Edit promotion
     *
     * @param int $id Id promotion
     *
     * @return void
     */
    public function edit($id)
    {
        $promotion = $this->promotionService->edit($id);
        return view('admin.promotions.update', compact('promotion'));
    }

    /**
     * Update promotion
     *
     * @param int              $id      id promotion
     * @param PromotionRequest $request Request from form
     *
     * @return void
     */
    public function update($id, PromotionRequest $request)
    {
        $message = $this->promotionService->update($id, $request);
        if ($message === 1) {
            return redirect()->route('promotions.index')->with('message', Lang::get('master.content.message.update', [
                'attribute' => 'promotion']));
        } else {
            return redirect()->route('promotions.index')->with('message', Lang::get('master.content.message.error'));
        }
    }

    /**
     * Delete promotion
     *
     * @param [int] $id [Id promotion]
     *
     * @return void
     */
    public function destroy($id)
    {
        $message = $this->promotionService->delete($id);
        if ($message === 1) {
            return redirect()->route('promotions.index')->with('message', Lang::get('master.content.message.delete', [
            'attribute' => 'promotion']));
        } else {
            return redirect()->route('promotions.index')->with('message', Lang::get('master.content.message.error'));
        }
    }
}
