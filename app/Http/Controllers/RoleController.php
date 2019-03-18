<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Services\RoleService;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    private $roleService;

    /**
     * Contructer RoleService
     *
     * @param RoleService $roleService [roleservice]
     */
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * The function return role index of admin page
     *
     * @return void
     */
    public function index()
    {
        return view('admin.roles.index');
    }

    /**
     * The function return role create of admin page
     *
     * @return void
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Add model rolle
     *
     * @param RoleRequest $request [description]
     *
     * @return redirect role.index page
     */
    public function store(RoleRequest $request)
    {
        $this->roleService->create($request);
        return redirect()->route('roles.index')->with('message', Lang::get('master.content.message.create', ['attribute' => trans('master.content.attribute.role')]));
    }

    /**
     * Show the form for editing the specified resource
     *
     * @param [int] $id [id role]
     *
     * @return [view]     [update page]
     */
    public function edit($id)
    {
        $role = $this->roleService->edit($id);
        return view('admin.roles.update', compact('role'));
    }

    /**
     * Update the specified resource in storage
     *
     * @param [int]         $id      [id role
     * @param [RoleRequest] $request [object]
     *
     * @return [view]               [role index page]
     */
    public function update($id, RoleRequest $request)
    {
        $message = $this->roleService->update($id, $request);
        if ($message === 1) {
            return redirect()->route('roles.index')->with('message', Lang::get('master.content.message.update', ['attribute' => trans('master.content.attribute.role')]));
        } else {
            return redirect()->route('roles.index')->with('message', Lang::get('master.content.message.error'));
        }
    }

    /**
     * Delete Role
     *
     * @param int $id Id Role
     *
     * @return void     Delete Role
     */
    public function destroy($id)
    {
        $this->roleService->delete($id);
        return redirect()->route('roles.index');
    }
}
