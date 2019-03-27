<?php

namespace App\Services;

use App\Models\Slide;
use App\Services\ImageService;
use League\Flysystem\Exception;
use DB;

class SlideService
{
    /**
    * Get all slide out of database
    *
    * @return void
    */
    public function allSlide()
    {
        return Slide::all();
    }

    /**
    * Get all slide out of database
    *
    * @return void
    */
    public function homePage()
    {
        return Slide::where('flag', 1)->get();
    }

   /**
    * Handle add user to database
    *
    * @param object $request request from form Add role
    *
    * @return void
    */
    public function store($request)
    {
        try {
            $request = app(ImageService::class)->handleUploadedImage($request['file'], trans('master.content.attribute.slide'));
            Slide::create([
                'name' => $request
            ]);
        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage(), 'result' => 500]);
        }
    }

     /**
    * Handle delete one slide
    *
    * @param object $imageId [the id of image]
    *
    * @return imageId
    */
    public function deleteImage($imageId)
    {
        $imageId = Slide::findOrFail(intval($imageId));
        $images = Slide::where('id', $imageId->id)->get();
        foreach ($images as $image) {
            if ($imageId->id == $image->id) {
                unlink('storage/slide/' . $image->name);
                $image->delete();
                return $imageId;
            }
        }
    }

    /**
    * Set flag to display banner
    *
    * @return collection
    */
    public function setFlag($imageId, $flag)
    {
        $imageId = Slide::findOrFail(intval($imageId));
        $imageId->update(['flag' => intval($flag)]);
        return intval($flag);
    }
}
