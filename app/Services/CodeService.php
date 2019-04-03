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
        $codes = Code::orderBy('id', 'desc')->paginate(config('constants.code.number_paginate'));
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
            // $users = User::all()->pluck('id');
            $arrayIdUsers = User::all()->pluck('id');
            // dd($arrayIdUsers);
            // $arrayIdUser = [];
            // foreach ($users as $value) {
            //     array_push($arrayIdUser, $value->id);
            // }
            Code::find($code->id)->users()->sync($arrayIdUsers);
        } else {
            $code = Code::create($request->all());
            $month = $request->order_month;
            $userIds = User::whereHas('orders', function ($query) use ($month) {
                $query->whereMonth('date_order', $month);
            })->get()->pluck('id');
            // dd($users);
            // $arrayIdUser = [];
            // foreach ($users as $value) {
            //     array_push($arrayIdUser, $value->id);
            // }
            Code::find($code->id)->users()->sync($userIds);
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
            if ($request->all_user) {
                $message = Code::where('id', $id)->update([
                                'name' => $request->name,
                                'amount' => $request->amount,
                                'start_at' => $request->start_at,
                                'end_at' => $request->end_at,
                                'order_month' => $request->order_month,
                                'all_user' => $request->all_user
                            ]);
                $users = User::all();
                $arrayIdUser = [];
                foreach ($users as $value) {
                    array_push($arrayIdUser, $value->id);
                }
                Code::find($id)->users()->sync($arrayIdUser);
            } else {
                $message = Code::where('id', $id)->update([
                                'name' => $request->name,
                                'amount' => $request->amount,
                                'start_at' => $request->start_at,
                                'end_at' => $request->end_at,
                                'order_month' => $request->order_month,
                                'all_user' => $request->all_user
                            ]);
                $month = $request->order_month;
                $users = User::whereHas('orders', function ($query) use ($month) {
                    $query->whereMonth('date_order', $month);
                })->get();
                $arrayIdUser = [];
                foreach ($users as $value) {
                    array_push($arrayIdUser, $value->id);
                }
                Code::find($id)->users()->sync($arrayIdUser);
            }
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
            Code::find($id)->users()->detach();
            $message = Code::where('id', $id)->delete();
            return $message;
        } catch (\Exception $e) {
            return $message = $e->getMessage();
        }
    }
}
