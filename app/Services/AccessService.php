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
        $access = Access::paginate(3);
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
}
