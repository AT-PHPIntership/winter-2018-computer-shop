<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Models\User;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

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
        app(UserService::class)->store($request->except(['_token']));
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
     * Display a form to edit new user
     *
     * @param object $user [binding user]
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }
    
    /**
     * Handle update user to database
     *
     * @param object $request [request to create a new user]
     * @param object $user    [binding user model alongside id]
     *
     * @return user
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        app(UserService::class)->update($request->except(['_token']), $user);
        return redirect()->route('users.index');
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
