<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SlideRequest;
use App\Services\SlideService;

class SlideController extends Controller
{
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
}
