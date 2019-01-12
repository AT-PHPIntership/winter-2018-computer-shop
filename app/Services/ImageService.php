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
            if (!is_null($component->profile)) {
                $images = realpath("storage/$storage/" . $component->profile->avatar);
                if (!is_null($component->profile->avatar) && file_exists($images)) {
                    unlink($images);
                }
            } else {
                $images = realpath("storage/$storage/" . $component->image);
                if (!is_null($component->image) && file_exists($images)) {
                    unlink($images);
                }
            }
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move("storage/$storage", $imageName);
            return $imageName;
        }
    }
}
