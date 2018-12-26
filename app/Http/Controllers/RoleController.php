<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
