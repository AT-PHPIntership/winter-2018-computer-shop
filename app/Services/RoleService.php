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
}
