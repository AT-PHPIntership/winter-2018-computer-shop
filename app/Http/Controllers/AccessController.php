<?php

namespace App\Http\Controllers;

use App\Models\Access;
use Illuminate\Http\Request;
use App\Services\AccessService;

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

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
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
