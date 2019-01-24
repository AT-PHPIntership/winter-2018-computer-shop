<?php

namespace App\Services;

use App\Models\Access;

class AccessService
{
    /**
     * Index access
     *
     * @return void
     */
    public function index()
    {
        $access = Access::where('parent_id', null)->paginate(config('constants.accessory.number_paginate'));
        return $access;
    }

    /**
     * Get accessories has parent_id = null
     *
     * @return void
     */
    public function getList()
    {
        $access = Access::where('parent_id', null)->get();
        return $access;
    }
    /**
     * Create accessory
     *
     * @param [object] $request [Request from form]
     *
     * @return void
     */
    public function create($request)
    {
        if ($request->parent_id === null) {
            Access::create([
                'name' => $request->name,
            ]);
        } else {
            $name = ['name' => $request->name];
            $parent = Access::find($request->parent_id);
            Access::create(
                $name,
                $parent
            );
        }
    }

    /**
     * Edit accessory
     *
     * @param [int] $id [Id accessory]
     *
     * @return void
     */
    public function edit($id)
    {
        $acces = Access::where('id', $id)->first();
        return $acces;
    }

    /**
     * Update accessory
     *
     * @param [int]    $id      [Id accessory]
     * @param [object] $request [Request from form]
     *
     * @return void
     */
    public function update($id, $request)
    {
        try {
            if ($request->parent_id === null) {
                $message = Access::where('id', $id)->update([
                    'name' => $request->name,
                ]);
            } else {
                $message = Access::where('id', $id)->update([
                    'name' => $request->name,
                    'parent_id' => $request->parent_id
                ]);
            }
            return $message;
        } catch (\Exception $e) {
            return $message = $e->getMessage();
        }
    }
}
