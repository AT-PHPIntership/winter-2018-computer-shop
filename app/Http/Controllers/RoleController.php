<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RoleService;
use App\Http\Requests\RoleRequest;
use App\Models\Role;

class RoleController extends Controller
{
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
        app(RoleService::class)->store($request->all());
        return redirect()->route('roles.index');
    }

    /**
     * Show the form for editing the specified resource
     *
     * @param collection $role [route model binding]
     *
     * @return [view]     [update page]
     */
    public function edit(Role $role)
    {
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
    public function update(RoleRequest $request, Role $role)
    {
        app(RoleService::class)->update($role, $request->all());
        return redirect()->route('roles.index');
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
        app(RoleService::class)->delete($id);
        return redirect()->route('roles.index');
    }
}
