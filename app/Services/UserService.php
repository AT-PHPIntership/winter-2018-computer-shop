<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserProfile;
use League\Flysystem\Exception;
use Yajra\Datatables\Datatables;
use DB;

class UserService
{
    /**
     * Get data for datatable
     *
     * @return object [object]
     */
    public function dataTable()
    {
        $users = User::select(['id', 'name', 'email', 'role_id']);
        return Datatables::of($users)
                ->addColumn('role', function (User $user) {
                    return $user->role->name;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.users.action', ['id' => $data->id]);
                })
                ->make(true);
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
        DB::beginTransaction();
        try {
            $user = User::create($request);
            if (array_key_exists('avatar', $request)) {
                $request['avatar'] = $this->handleUploadedImage($request['avatar']);
            }
            $user->profile()->create($request);
            DB::commit();
            session()->flash('message', __('master.content.message.create', ['attribute' => trans('master.content.attribute.user')]));
        } catch (Exception $ex) {
            DB::rollback();
            session()->flash('warning', __('master.content.message.error', ['attribute' => $ex->getMessage()]));
            return redirect()->back();
        }
    }

   /**
    * Handle add image to database
    *
    * @param object $image [request from image section]
    *
    * @return imageName|null
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
            if (isset($request['avatar'])) {
                $request['avatar'] = $this->handleChangedImage($request['avatar'], $user);
            }
            $user->profile->update($request);
            $user = $user->update($request);
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
            $userImage = realpath('storage/avatar/' . $user->profile->avatar);
            if (!is_null($user->profile->avatar) && file_exists($userImage)) {
                unlink($userImage);
            }
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move('storage/avatar/', $imageName);
            return $imageName;
        }
    }

    /**
    * Handle delete user out of database
    *
    * @param object $user [request delete a user]
    *
    * @return object [object]
    */
    public function delete($user)
    {
        try {
            $userImage = realpath('storage/avatar/' . $user->profile->avatar);
            if (!is_null($user->profile->avatar) && file_exists($userImage)) {
                unlink($userImage);
            }
            $user->delete();
            session()->flash('message', __('master.content.message.delete', ['attribute' => trans('master.content.attribute.user')]));
        } catch (Exception $ex) {
            session()->flash('warning', __('master.content.message.error', ['attribute' => $ex->getMessage()]));
        }
    }
}
