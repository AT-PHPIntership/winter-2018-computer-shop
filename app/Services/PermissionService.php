<?php

namespace App\Services;

use App\Models\Permission;
use DB;

class PermissionService
{
    /**
     * Get all permission
     *
     * @return void
     */
    public function getAll()
    {
        return Permission::paginate(config('constants.role.number_paginate'));
    }

    /**
     * Handle add category to data
     *
     * @param object $request [request from form add category]
     *
     * @return void
     */
    public function store($request)
    {
        try {
            $action = json_encode($request['permission_action']);
            $permission = Permission::create([
                'name' => $request['name'],
                'display_name' => $request['display_name'],
                'actions' => $action
                ]);
            session()->flash('message', __('master.content.message.create', ['attribute' => trans('master.content.attribute.permission')]));
        } catch (Exception $ex) {
            session()->flash('warning', __('master.content.message.error', ['attribute' => $ex->getMessage()]));
            return redirect()->back();
        }
    }

    /**
     * Handle update category to data
     *
     * @param object $request  [request from form add category]
     * @param object $category [model category]
     *
     * @return void
     */
    public function update($request, $permission)
    {
        try {
            $action = json_encode($request['permission_action']);
            $permission->update([
                'name' => $request['name'],
                'display_name' => $request['display_name'],
                'actions' => $action
                ]);
            session()->flash('message', __('master.content.message.update', ['attribute' => trans('master.content.attribute.permission')]));
        } catch (Exception $ex) {
            session()->flash('warning', __('master.content.message.error', ['attribute' => $ex->getMessage()]));
            return redirect()->back();
        }
    }

    /**
     * Delete a permission
     *
     * @param object $permission [model permission]
     *
     * @return void
     */
    public function delete($permission)
    {
        try {
            if ($permission->roles->count() > 0) {
                session()->flash('warning', __('master.content.message.permission'));
            } else {
                $permission->delete();
                session()->flash('message', __('master.content.message.delete', ['attribute' => trans('master.content.attribute.permission')]));
            }
        } catch (Exception $ex) {
            session()->flash('warning', __('master.content.message.error', ['attribute' => $ex->getMessage()]));
        }
    }

}
