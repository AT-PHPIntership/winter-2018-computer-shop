<?php

namespace App\Services;

use App\Models\User;
use App\Models\Role;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Lang;

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
            $image->move('upload/avatar', $imageName);
            return $imageName;
        }
        return null;
    }
    /**
    * Handle update user to database
    *
    * @param object $request [request update user]
    * @param object $user    [binding user model]
    *
    * @return void
    */
    public function update($request, $user)
    {
        try {
            \DB::transaction(function () use ($request, $user) {
                $user->profiles->update([
                'address' => request('address'),
                'phone' => request('phone'),
                'avatar' => $this->handleUploadedImage($request->file('avatar'))
                ]);
                $user = $user->update($request->all());
            });
        } catch (\Exception $ex) {
            \DB::rollback();
            return redirect()->back()->with('warning', Lang::get('master.content.message.error', ['attribute' => $ex]));
        }
    }
}
