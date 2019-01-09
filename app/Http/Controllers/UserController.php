<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Models\User;
use App\Http\Requests\CreateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Get data for datatable
     *
     * @return \Illuminate\Http\Response
     */
    public function getData()
    {
        return app(UserService::class)->dataTable();
    }

    /**
     * Display a form to create new user
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Handle store user to database
     *
     * @param object $request [request to create a new user]
     *
     * @return user.index
     */
    public function store(CreateUserRequest $request)
    {
        app(UserService::class)->store($request->all());
        return redirect()->route('users.index');
    }

    /**
     * View detail the user
     *
     * @param object $user [binding user]
     *
     * @return View user show
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Handle delete user out of  database
     *
     * @param object $user [request to delete the user]
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        app(UserService::class)->delete($user);
        return redirect()->route('users.index');
    }
}
