<?php

namespace App\Services;

use App\Models\User;
use App\Models\Role;
use App\Models\UserProfile;
use Yajra\Datatables\Datatables;

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
    public function create($request)
    {
        // dd($request);
        try {
             \DB::transaction(function () use ($request) {
                $user = User::create($request);
                UserProfile::create([
                     'address' => request('address'),
                     'phone' => request('phone'),
                     'avatar' => $this->handleUploadedImage(request('avatar')),
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
            $imageName = $image->getClientOriginalName();
            $image->move('upload/avatar', $imageName);
            return $imageName;
        }
        return null;
    }
}
