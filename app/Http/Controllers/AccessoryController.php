<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use Illuminate\Http\Request;
use App\Services\AccessoryService;
use App\Http\Requests\AccessoryRequest;
use Illuminate\Support\Facades\Lang;

class AccessoryController extends Controller
{


    protected $accessoryService;

    /**
     * Function constructer
     *
     * @param AccsessoryService $accessoryService ClassAccess
     */
    public function __construct(AccessoryService $accessoryService)
    {
        $this->accessoryService = $accessoryService;
    }
    /**
     * Return view index access
     *
     * @return view
     */
    public function index()
    {
        $accessories = $this->accessoryService->index();
        return view('admin.accessories.index', compact('accessories'));
    }

    /**
     * Show page create
     *
     * @return void
     */
    public function create()
    {
        return view('admin.accessories.create');
    }

    /**
     * Create accessory
     *
     * @param AccessRequest $request [Request from form]
     *
     * @return void
     */
    public function store(AccessoryRequest $request)
    {
        $this->accessoryService->create($request);
        return redirect()->route('accessories.index')->with('message', Lang::get('master.content.message.create', ['attribute' => 'Accessory']));
    }

    /**
     * Show Accessory
     *
     * @param Accessory $accessory [Object]
     *
     * @return void
     */
    public function show(Accessory $accessory)
    {
        return view('admin.accessories.show', compact('accessory'));
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
        $accessory = $this->accessoryService->edit($id);
        return view('admin.accessories.update', compact('accessory'));
    }

    /**
     * Update accessory
     *
     * @param [int]         $id      [Id accessory]
     * @param AccessRequest $request [Request from form]
     *
     * @return void
     */
    public function update($id, AccessoryRequest $request)
    {

        $message = $this->accessoryService->update($id, $request);
        if ($message === 1) {
            return redirect()->route('accessories.index')->with('message', Lang::get('master.content.message.update', ['attribute' => Lang::get('master.content.attribute.accessory')]));
        } else {
            return redirect()->back()->with('message', Lang::get('master.content.message.error', ['attribute' => Lang::get('master.content.attribute.accessory')]));
        }
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Access  $access
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Access $access)
    // {
    //     //
    // }
}
