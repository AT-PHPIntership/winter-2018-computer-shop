<?php

namespace App\Http\Controllers;

use App\Models\Code;
use Illuminate\Http\Request;
use App\Services\CodeService;
use App\Http\Requests\CodeRequest;
use Illuminate\Support\Facades\Lang;

class CodeController extends Controller
{
    private $codeService;

    /**
     * Constructer CodeService
     *
     * @param CodeService $codeService param
     */
    public function __construct(CodeService $codeService)
    {
        $this->codeService = $codeService;
    }

    /**
     * Index page
     *
     * @return view
     */
    public function index()
    {
        $codes = $this->codeService->index();
        return view('admin.codes.index', compact('codes'));
    }

    /**
     * Return view code create
     *
     * @return View
     */
    public function create()
    {
        return view('admin.codes.create');
    }

    /**
     * Create code
     *
     * @param CodeRequest $request Request from form
     *
     * @return view
     */
    public function store(CodeRequest $request)
    {
        $this->codeService->create($request);
        return redirect()->route('codes.index')->with('message', Lang::get('master.content.message.create', ['attribute' => Lang::get('master.content.attribute.code')]));
    }

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
    //  * @param  \App\Models\Code  $code
    //  * @return \Illuminate\Http\Response
     
    // public function edit(Code $code)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Code  $code
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Code $code)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Code  $code
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Code $code)
    // {
    //     //
    // }
}
