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
}
