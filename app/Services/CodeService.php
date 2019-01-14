<?php

namespace App\Services;

use App\Models\Code;

class CodeService
{
    /**
     * Code index
     *
     * @return void
     */
    public function index()
    {
        $codes = Code::paginate(config('constants.code.number_paginate'));
        return $codes;
    }
}
