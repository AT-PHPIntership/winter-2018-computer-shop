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

    /**
     * Edit code
     *
     * @param [int] $id [Id code]
     *
     * @return object
     */
    public function edit($id)
    {
        $code = Code::where('id', $id)->first();
        return $code;
    }

    /**
     * Update code
     *
     * @param [int]  $id      [Id code]
     * @param [type] $request [Request from form
     *
     * @return void
     */
    public function update($id, $request)
    {
        Code::where('id', $id)->update([
            'name' => $request->name,
            'amount' => $request->amount,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at
        ]);
    }

    /**
     * Delete code
     *
     * @param [int] $id [Id code]
     *
     * @return void
     */
    public function delete($id)
    {
        try {
            $message = Code::where('id', $id)->delete();
            return $message;
        } catch (\Exception $e) {
            return $message = $e->getMessage();
        }
    }
}
