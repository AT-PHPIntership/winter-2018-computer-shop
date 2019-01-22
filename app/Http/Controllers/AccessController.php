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

    // *
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\Access  $access
    //  * @return \Illuminate\Http\Response
     
    // public function edit(Access $access)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Access  $access
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Access $access)
    // {
    //     //
    // }

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
