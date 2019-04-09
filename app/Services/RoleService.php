<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use League\Flysystem\Exception;
use DB;
class RoleService
{
    /**
     * Get list roles
     *
     * @return void
     */
    public function getAll()
    {
        $roles = Role::paginate(config('constants.role.number_paginate'));
        return $roles;
    }
    /**
     * Handle add role to data
     *
     * @param object $request request from form Add role
     *
     * @return void
     */
    public function store($request)
    {   
        DB::beginTransaction();
        try {
            $role = Role::create(['name' => $request['name']]);
            $permissions = Permission::all();
            foreach ($permissions->pluck('id') as $permission) {
                if (isset($request['permission-' .  $permission])) {
                    $sync[$permission] = ['action_pivot' => $request['permission-' .  $permission]];
                }
            }
            $role->permissions()->sync($sync);
            DB::commit();
            session()->flash('message', __('master.content.message.create', ['attribute' => trans('master.content.attribute.role')]));
        } catch (Exception $ex) {
            DB::rollback();
            session()->flash('warning', __('master.content.message.error', ['attribute' => $ex->getMessage()]));
            return redirect()->back();
        }
    }

    /**
     * Update role.
     *
     * @param int    $id      id role
     * @param object $request request from form update page
     *
     * @return void
     */
    public function update($role, $request)
    {
        DB::beginTransaction();
        try {
            $role->update(['name' => $request['name']]);
            $permissions = Permission::all();
            $sync = [];
            foreach ($permissions->pluck('id') as $permission) {
                if (isset($request['permission-' .  $permission])) {
                    $sync[$permission] = ['action_pivot' => $request['permission-' .  $permission]];
                }
            }
            $role->permissions()->sync($sync);
            DB::commit();
            session()->flash('message', __('master.content.message.update', ['attribute' => trans('master.content.attribute.role')]));
        } catch (Exception $ex) {
            DB::rollback();
            session()->flash('warning', __('master.content.message.error', ['attribute' => $ex->getMessage()]));
            return redirect()->back();
        }
    }

    /**
     * Delete Role
     *
     * @param int $id id role
     *
     * @return void     Delete Role
     */
    public function delete($id)
    {
        try {
            $users =  User::where('role_id', $id)->get();
            if ($users->count() > 0) {
                session()->flash('warning', __('master.content.message.user'));
            } else {
                Role::where('id', $id)->delete();
                session()->flash('message', __('master.content.message.delete', ['attribute' => trans('master.content.attribute.role')]));
            }
        } catch (Exception $ex) {
            session()->flash('warning', __('master.content.message.error', ['attribute' => $ex->getMessage()]));
        }
    }
}
