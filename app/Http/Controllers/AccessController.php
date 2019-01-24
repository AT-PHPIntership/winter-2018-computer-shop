<?php

namespace App\Http\Controllers;

use App\Models\Access;
use Illuminate\Http\Request;
use App\Services\AccessService;
use App\Http\Requests\AccessRequest;
use Illuminate\Support\Facades\Lang;

class AccessController extends Controller
{


    protected $accessService;

    /**
     * Function constructer
     *
     * @param AccsessService $accessService ClassAccess
     */
    public function __construct(AccessService $accessService)
    {
        $this->accessService = $accessService;
    }
    /**
     * Return view index access
     *
     * @return view
     */
    public function index()
    {
        $access = $this->accessService->index();
        return view('admin.access.index', compact('access'));
    }

    /**
     * Show page create
     *
     * @return void
     */
    public function create()
    {
        return view('admin.access.create');
    }

    /**
     * Create accessory
     *
     * @param AccessRequest $request [Request from form]
     *
     * @return void
     */
    public function store(AccessRequest $request)
    {
        $this->accessService->create($request);
        return redirect()->route('access.index')->with('message', Lang::get('master.content.message.create', ['attribute' => 'Accessory']));
    }

    /**
     * Show Accessory
     *
     * @param Access $access [Object]
     *
     * @return void
     */
    public function show(Access $access)
    {
        return view('admin.access.show', compact('access'));
    }

    /**
     * Show view edit
     *
     * @param [integer] $id [Id access]
     *
     * @return void
     */
    public function edit($id)
    {
        $acces = $this->accessService->edit($id);
        return view('admin.access.update', compact('acces'));
    }

    /**
     * Update accessory
     *
     * @param [int]         $id      [Id accessory]
     * @param AccessRequest $request [Request from form]
     *
     * @return void
     */
    public function update($id, AccessRequest $request)
    {

        $this->accessService->update($id, $request);
        return redirect()->route('access.index')->with('message', Lang::get('master.content.message.update', ['attribute' => 'Accessory']));
    }

    /**
     * Delete accessory
     *
     * @param [int] $id [Id accessory]
     *
     * @return void
     */
    public function destroy($id)
    {
        $this->accessService->delete($id);
        return redirect()->route('access.index')->with('message', Lang::get('master.content.message.delete', ['attribute' => 'Accessory']));
    }
}
