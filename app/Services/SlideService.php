<?php

namespace App\Services;

use App\Models\Slide;
use App\Services\ImageService;
use League\Flysystem\Exception;
use DB;

class SlideService
{
   /**
    * Handle add user to database
    *
    * @param object $request request from form Add role
    *
    * @return void
    */
    public function store($request)
    {
        // dd($request);
        try {
            $request = app(ImageService::class)->handleUploadedImage($request['file'], trans('master.content.attribute.slide'));
            Slide::create([
                'name' => $request
            ]);
        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage(), 'result' => 500]);
        }
    }
}
