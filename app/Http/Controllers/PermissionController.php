<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PermissionRequest;
use App\Http\Requests\SavePermissionRequest;
use App\Services\PermissionService;
use App\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.permissions.index');
    }


    /**
     * Display a form to create new user
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Handle store user to database
     *
     * @param object $request [request to create a new user]
     *
     * @return user.index
     */
    public function store(Request $request)
    {
        app(PermissionService::class)->store($request->except(['_token']));
        return redirect()->route('permissions.index');
    }

    // /**
    //  * View detail the user
    //  *
    //  * @param object $user [binding user]
    //  *
    //  * @return View user show
    //  */
    // public function show(Permission $permission)
    // {
    //     return view('admin.users.show', compact('permission'));
    // }

    /**
     * Display a form to edit new user
     *
     * @param object $user [binding user]
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Handle update user to database
     *
     * @param object $request [request to create a new user]
     * @param object $user    [binding user model]
     *
     * @return user
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        app(PermissionService::class)->update($request->except(['_token']), $permission);
        return redirect()->route('permissions.index');
    }

    /**
     * Handle delete user out of  database
     *
     * @param object $user [request to delete the user]
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        app(PermissionService::class)->delete($permission);
        return redirect()->route('permissions.index');
    }

    /**
     * Save Permission For Role
     *
     * @param object $user [request to delete the user]
     *
     * @return \Illuminate\Http\Response
     */
    public function savePermissionForRole(SavePermissionRequest $request)
    {
        $response = app(PermissionService::class)->savePermissionForRole($request->permission);
        return response()->json($response);
    }
}
