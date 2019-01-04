<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Services\UserService;
use App\Http\Requests\CreateUserRequest;

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
        return view('admin.users.index');
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
        $this->userService->store($request);
        return redirect()->route('users.index');
    }
}
