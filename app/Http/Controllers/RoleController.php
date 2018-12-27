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

        // return redirect()->route('role.index')->with('message', Lang::get('master.content.message.create', ['attribute' => 'role']));
    }
}
