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
        // dd($request['permission_action']);
        try {
            $action = json_encode($request['permission_action']);
            $permission = Permission::create([
                'name' => $request['name'],
                'display_name' => $request['display_name'],
                'actions' => $action
                ]);
            // foreach ($request['permission_action'] as $value) {
            //     $permission->childrens()->create([
            //         'name' => $permission->name . '_' .$value,
            //         'display_name' => $permission->display_name . ' ' . ucfirst($value)
            //     ]);
            // }
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

    // /**
    //  * Save Permission For Role
    //  *
    //  * @param object $request  [request from form add category]
    //  * @param object $category [model category]
    //  *
    //  * @return void
    //  */
    // public function savePermissionForRole($permission)
    // {
    //     DB::beginTransaction();
    //     foreach ($permission as $key => $value) {
    //         $permission = Permission::findOrFail(intval($value['id']));
    //         $conditionSync = [];
    //          foreach ($value['actions'] as $key => $action) {
    //             $conditionSync[$value['role'][$key]] = ['actions' => json_encode($action)];
    //          }
    //          $permission->roles()->sync($conditionSync);
    //     }
    //     DB::commit();
    //     return true;
    // }
}
