<?php

namespace App\Services;

use App\Models\Accessory;

class AccessoryService
{
    /**
    * Get child accessoris
    *
    * @return void
    */
    public function getChildren()
    {
        return Accessory::with('childrens')->get();
    }

    /**
    * Get parent accessoris
    *
    * @return void
    */
    public function getParent()
    {
        return Accessory::parents()->get();
    }

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
                    'parent_id' => null
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
