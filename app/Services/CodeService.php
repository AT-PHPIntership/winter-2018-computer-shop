<?php

namespace App\Services;

use App\Models\Code;
use App\Models\User;

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
        if ($request->all_user) {
            $code = Code::create($request->all());
            $users = User::all();
            $arrayIdUser = [];
            foreach ($users as $value) {
                array_push($arrayIdUser, $value->id);
            }
            Code::find($code->id)->users()->sync($arrayIdUser);
        } else {
            $code = Code::create($request->all());
            $month = $request->order_month;
            $users = User::whereHas('orders', function ($query) use ($month) {
                $query->whereMonth('date_order', $month);
            })->get();
            $arrayIdUser = [];
            foreach ($users as $value) {
                array_push($arrayIdUser, $value->id);
            }
            Code::find($code->id)->users()->sync($arrayIdUser);
        }
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
     * @param [type] $request [Request from form
     * @param [int]  $id      [Id code]
     *
     * @return void
     */
    public function update($request, $id)
    {
        try {
            $message = Code::where('id', $id)->update([
                            'name' => $request->name,
                            'amount' => $request->amount,
                            'start_at' => $request->start_at,
                            'end_at' => $request->end_at
                        ]);
            return $message;
        } catch (\Exception $e) {
            return $message = $e->getMessage();
        }
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
