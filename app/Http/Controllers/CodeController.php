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
        return redirect()->route('codes.index')->with('message', Lang::get('master.content.message.create', ['attribute' => 'code']));
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

    /**
     * Code edit view
     *
     * @param [int] $id [Id code]
     *
     * @return view
     */
    public function edit($id)
    {
        $code = $this->codeService->edit($id);
        return view('admin.codes.update', compact('code'));
    }

    /**
     * Update code
     *
     * @param [imnt]      $id      [Id code]
     * @param CodeRequest $request [Request from form]
     *
     * @return void
     */
    public function update($id, CodeRequest $request)
    {
        $this->codeService->update($id, $request);
        return redirect()->route('codes.index')->with('message', Lang::get('master.content.message.update', [
            'attribute' => 'code']));
    }

    /**
     * Delete code
     *
     * @param [int] $id [Id code]
     *
     * @return void
     */
    public function destroy($id)
    {
        $message = $this->codeService->delete($id);
        if($message === 1) {
            return redirect()->route('codes.index')->with('message', Lang::get('master.content.message.delete', [
            'attribute' => 'code']));
        } else {
            return redirect()->route('codes.index')->with('message', Lang::get('master.content.message.error', [
                'attribute' => Lang::get('master.content.attribute.code')]));
        }
    }
}
