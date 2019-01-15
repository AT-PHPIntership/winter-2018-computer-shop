<?php

namespace App\Services;

class ImageService
{
    /**
    * Handle add new image to database
    *
    * @param object $image   [request from image section]
    * @param object $storage [place to save image]
    *
    * @return imageName|null
    */
    public function handleUploadedImage($image, $storage)
    {
        if (!is_null($image)) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move("storage/$storage", $imageName);
            return $imageName;
        }
        return null;
    }

    /**
    * Handle change previous image
    *
    * @param object $image     [request conduct change image]
    * @param object $component [help check previous image exists]
    * @param object $storage   [place to save image]
    *
    * @return imageName
    */
    public function handleChangedImage($image, $component, $storage)
    {
        if (!is_null($image)) {
            if (!is_null($component->profile->avatar)) {
                $images = realpath("storage/$storage/" . $component->profile->avatar);
                if (file_exists($images)) {
                    unlink($images);
                }
            }
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move("storage/$storage", $imageName);
            return $imageName;
        }
    }

    /**
    * Handle change previous image
    *
    * @param object $request [request add multiple image]
    * @param object $product [save image for product]
    *
    * @return imageName
    */
    public function addMultipleImage($request, $product)
    {
        if (array_key_exists('images', $request)) {
            foreach ($request['images'] as $images) {
                $imageName = time() . '_' . $images->getClientOriginalName();
                $images->move('storage/product', $imageName);
                $product->images()->create([
                'name' => $imageName
                ]);
            }
        }
    }
}
