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
        $codes = Code::paginate(3);
        return $codes;
    }

    /**
     * Create code
     *
     * @param [object] $request Request from form
     *
     * @return void
     */
    public function create($request)
    {
        Code::create([
            'name' => $request->name,
            'amount' => $request->amount,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at
        ]);
    }
}
