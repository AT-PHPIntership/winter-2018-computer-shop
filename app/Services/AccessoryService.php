<?php

namespace App\Services;

use App\Models\Accessory;

class AccessoryService
{
    /**
     * Index access
     *
     * @return void
     */
    public function index()
    {
        $accessories = Accessory::where('parent_id', null)->paginate(config('constants.accessory.number_paginate'));
        return $accessories;
    }

    /**
     * Get accessories has parent_id = null
     *
     * @return void
     */
    public function getList()
    {
        $accessories = Accessory::where('parent_id', null)->get();
        return $accessories;
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
            Accessory::create([
                'name' => $request->name,
            ]);
        } else {
            $name = ['name' => $request->name];
            $parent = Accessory::find($request->parent_id);
            Accessory::create(
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
        $accessory = Accessory::where('id', $id)->first();
        return $accessory;
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
                $message = Accessory::where('id', $id)->update([
                    'name' => $request->name,
                ]);
            } else {
                $message = Accessory::where('id', $id)->update([
                    'name' => $request->name,
                    'parent_id' => $request->parent_id
                ]);
            }
            return $message;
        } catch (\Exception $e) {
            return $message = $e->getMessage();
        }
    }

    /**
     * Delete accessory
     *
     * @param [int] $id [Id accessory]
     *
     * @return void
     */
    public function delete($id)
    {
        try {
            $message = Accessory::where('id', $id)->delete();
            return $message;
        } catch (\Exception $e) {
            return $message = $e->getMessage();
        }
        
    }
}
