<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Lang ;

class UserController extends Controller
{
    private $userService;

   /**
    * Contructer UserService
    *
    * @param UserService $userService [userService]
    */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index', ['users' => $this->userService->getAllData()]);
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
    public function store(UserRequest $request)
    {
        $this->userService->create($request);
        return redirect()->route('users.index')->with('message', Lang::get('master.content.message.create', ['attribute' => 'user']));
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
        $this->userService->update($request, $user);
        return redirect()->route('users.index');
    }
}
