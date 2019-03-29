<?php

namespace App\Services;

use App\Models\Permission;

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
            Permission::create($request);
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
            $permission->update($request);
            session()->flash('message', __('master.content.message.update', ['attribute' => trans('master.content.attribute.permission')]));
        } catch (Exception $ex) {
            session()->flash('warning', __('master.content.message.error', ['attribute' => $ex->getMessage()]));
            return redirect()->back();
        }
    }
}
