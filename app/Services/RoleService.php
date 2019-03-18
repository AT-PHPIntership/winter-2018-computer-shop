<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use League\Flysystem\Exception;

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
    public function create($request)
    {
        Role::create(
            $request->all()
        );
    }

    /**
     * Get role have id = $id form roles table return role update page
     *
     * @param [int] $id [id role]
     *
     * @return [object]     [description]
     */
    public function edit($id)
    {
        $role = Role::where('id', $id)->first();
        return $role;
    }

    /**
     * Update role.
     *
     * @param int    $id      id role
     * @param object $request request from form update page
     *
     * @return void
     */
    public function update($id, $request)
    {
        try {
            $message = Role::where('id', $id)->update(['name' => $request->name]);
            return $message;
        } catch (Exception $e) {
            return $message = $e->getMessage();
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
