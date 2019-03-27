<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SlideRequest;
use App\Services\SlideService;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.slides.index');
    }

    /**
     * Display a form to create new slide
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slides.create');
    }

    /**
     * Handle store slide to database
     *
     * @param object $request [request to create a new slie]
     *
     * @return json
     */
    public function store(SlideRequest $request)
    {
        app(SlideService::class)->store($request->all());
        return response()->json(['message' => 'Uploaded image successfully!', 'result' => 200]);
    }

    /**
     * Handle delete slide to database
     *
     * @param object $request [request to create a new slie]
     *
     * @return json
     */
    public function deleteImage(Request $request)
    {
        $response = ['data' => app(SlideService::class)->deleteImage($request->image),'message' => 'success!', 'result' => 200];
        return response()->json($response);
    }

    /**
     * Set Flag for banner
     *
     * @param object $request [request to create a new slie]
     *
     * @return json
     */
    public function setFlag(Request $request)
    {
        $response = ['data' => app(SlideService::class)->setFlag($request->imageId, $request->flag),'message' => 'success!', 'result' => 200];
        return response()->json($response);
    }
}
