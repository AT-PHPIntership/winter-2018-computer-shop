<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Services\UserService;
use App\Http\Requests\UserRequest;

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
    public function store(UserRequest $request)
    {
        $this->userService->create($request);
        return redirect()->route('users.index')->with('message', Lang::get('master.content.message.create', ['attribute' => 'user']));
    }
}
