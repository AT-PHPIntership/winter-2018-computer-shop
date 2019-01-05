<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserProfile;
use DB;
use League\Flysystem\Exception;

class UserService
{
    /**
     * Get data form users table return user index page
     *
     * @return object [object]
     */
    public function getAllData()
    {
        $users = User::orderBy('id', \Config::get('define.user.order_by_desc'))->paginate(\Config::get('define.user.limit_rows'));
        return $users;
    }
    
   /**
    * Handle add user to database
    *
    * @param object $request request from form Add role
    *
    * @return void
    */
    public function create($request)
    {
        try {
             \DB::transaction(function () use ($request) {
                $user = User::create($request->all());
                UserProfile::create([
                     'address' => request('address'),
                     'phone' => request('phone'),
                     'avatar' => $this->handleUploadedImage($request->file('avatar')),
                     'user_id' => $user->id
                     ]);
             });
        } catch (\Exception $ex) {
            \DB::rollback();
            return redirect()->back()->with('warning', Lang::get('master.content.message.error', ['attribute' => $ex]));
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
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move('storage/avatar', $imageName);
            return $imageName;
        }
        return null;
    }

    /**
    * Handle update user to database
    *
    * @param object $request [request update user]
    * @param object $user    [binding user model alongside id]
    *
    * @return void
    */
    public function update($request, $user)
    {
        DB::beginTransaction();
        try {
            $profile = $request->only('address', 'phone', 'avatar');
            if ($request->has('avatar')) {
                $profile['avatar'] = $this->handleChangedImage($request->file('avatar'), $user);
            }
            $user->profiles->update($profile);
            $user = $user->update($request->all());
            DB::commit();
            session()->flash('message', __('master.content.message.update', ['attribute' => trans('master.content.attribute.user')]));
        } catch (Exception $ex) {
            DB::rollback();
            session()->flash('warning', __('master.content.message.error', ['attribute' => $ex->getMessage()]));
            return redirect()->back();
        }
    }

    /**
    * Handle change previous image of a user
    *
    * @param object $image [request conduct change image]
    * @param object $user  [help check previous image exists]
    *
    * @return imageName
    */
    public function handleChangedImage($image, $user)
    {
        if (!is_null($image)) {
            $userImage = realpath('storage/avatar/' . $user->profiles->avatar);
            if (file_exists($userImage)) {
                unlink($userImage);
            }
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move('storage/avatar/', $imageName);
            return $imageName;
        }
    }
}
