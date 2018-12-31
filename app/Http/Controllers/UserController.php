<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Services\UserService;
use App\Http\Requests\UserRequest;
use App\Models\User;

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
     * Handle delete user to database
     *
     * @param object $user [request to delete the user]
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->userService->destroy($user);
        return redirect()->route('users.index')->with('message', Lang::get('master.content.message.delete', ['attribute' => 'user']));
    }
}
