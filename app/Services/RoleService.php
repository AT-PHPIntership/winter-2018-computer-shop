<?php

namespace App\Services;

use App\Models\Role;

class RoleService
{
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
        Role::where('id', $id)->update(['name' => $request->name]);
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
        Role::where('id', $id)->delete();
    }
}
