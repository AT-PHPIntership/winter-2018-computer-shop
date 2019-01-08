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
            $profile = $request;
            $profile['user_id'] = $user->id;
            $profile['avatar'] = $this->handleUploadedImage(request('avatar'));
            UserProfile::create($profile);
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
}
