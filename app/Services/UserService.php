<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserProfile;
use DB;
use League\Flysystem\Exception;

class UserService
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
        DB::beginTransaction();
        try {
            $user = User::create($request->all());
            $profile = $request->only('address', 'phone', 'avatar');
            $profile['user_id'] = $user->id;
            $profile['avatar'] = $this->handleUploadedImage($request->file('avatar'));
            UserProfile::create($profile);
            DB::commit();
            session()->flash('message', __('master.content.message.create', ['attribute' => trans('master.content.attribute.user')]));
        } catch (Exception $ex) {
            DB::rollback();
            session()->flash('warning', __('master.content.message.error', ['attribute' => $ex->getMessage]));
            return redirect()->back();
        }
    }

   /**
    * Handle add image to database
    *
    * @param object $image [request from image section]
    *
    * @return imageName
    */
    public function handleUploadedImage($image)
    {
        if (!is_null($image)) {
            $imageName = $image->getClientOriginalName();
            $image->move('storage/avatar', $imageName);
            return $imageName;
        }
        return null;
    }
}
