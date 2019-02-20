<?php

namespace App\Services;

use App\Models\User;
use App\Models\Order;
use App\Models\Comment;
use App\Services\ImageService;
use League\Flysystem\Exception;
use Yajra\Datatables\Datatables;
use DB;
use Mail;
use Auth;

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
     * @param object $request [request create a new user]
     *
     * @return void
     */
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $user = User::create($request);
            if (array_key_exists('avatar', $request)) {
                $request['avatar'] = app(ImageService::class)->handleUploadedImage($request['avatar'], trans('master.content.attribute.avatar'));
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
                $request['avatar'] = app(ImageService::class)->handleChangedImage($request['avatar'], $user, trans('master.content.attribute.avatar'));
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
     * Handle delete user out of database
     *
     * @param object $user [request delete a user]
     *
     * @return object [object]
     */
    public function delete($user)
    {
        try {
            $orders = Order::where('user_id', $user->id)->get();
            $comments = Comment::where('user_id', $user->id)->get();
            if ($orders->count() > 0) {
                session()->flash('warning', __('master.content.message.order'));
            } elseif ($comments->count() > 0) {
                session()->flash('warning', __('master.content.message.comment'));
            } else {
                $userImage = realpath('storage/avatar/' . $user->profile->avatar);
                if (!is_null($user->profile->avatar) && file_exists($userImage)) {
                    unlink($userImage);
                }
                $user->delete();
                session()->flash('message', __('master.content.message.delete', ['attribute' => trans('master.content.attribute.user')]));
            }
        } catch (Exception $ex) {
            session()->flash('warning', __('master.content.message.error', ['attribute' => $ex->getMessage()]));
        }
    }

    /*******************User Register***************************/

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data data
     *
     * @return \App\User
     */
    public function createUser(array $data)
    {
        try {
            return User::create($data);
        } catch (Exception $ex) {
            session()->flash('warning', __('master.content.message.error', ['attribute' => $ex->getMessage()]));
            return redirect()->back();
        }
    }

    /**
     * Delete a order
     *
     * @param array $order [delete a order]
     *
     * @return session
     */
    public function deleteOrder($order)
    {
        DB::beginTransaction();
        try {
            foreach ($order->orderDetails as $detail) {
                $detail->delete();
            }
            $user = [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'order' => $order->id
            ];
            Mail::send('emails.userDeleteOrder', ['user' => $user, 'data' => $order->orderDetails], function ($message) use ($user) {
                $message->to('phat.qatest.002@gmail.com');
                $message->subject('The user has email ' . $user['email'] . ' delete an order');
            });
            $order->delete();
            DB::commit();
            session()->flash('message', __('master.content.message.delete', ['attribute' => trans('public.profile.order')]));
        } catch (Exception $ex) {
            DB::rollback();
            session()->flash('warning', __('master.content.message.error', ['attribute' => $ex->getMessage()]));
            return redirect()->back();
        }
    }
}
