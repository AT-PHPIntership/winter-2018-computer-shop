<?php

namespace App\Http\Controllers;

use App\Models\Code;
use Illuminate\Http\Request;
use App\Services\CodeService;
use App\Http\Requests\CodeRequest;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;
use App\Models\UserCode;

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
     * @param CodeRequest $request [Request from form]
     * @param [int]       $id      [Id code]
     *
     * @return void
     */
    public function update(CodeRequest $request, $id)
    {
        $message = $this->codeService->update($request, $id);
        if ($message === 1) {
            return redirect()->route('codes.index')->with('message', Lang::get('master.content.message.update', [
            'attribute' => 'code']));
        } else {
            return Redirect::back()->with('message', Lang::get('master.content.message.error', [
            'attribute' => Lang::get('master.content.attribute.code')]));
        }
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
        if ($message === 1) {
            return redirect()->route('codes.index')->with('message', Lang::get('master.content.message.delete', [
            'attribute' => 'code']));
        } else {
            return redirect()->route('codes.index')->with('message', Lang::get('master.content.message.error', [
                'attribute' => Lang::get('master.content.attribute.code')]));
        }
    }

    /**
     * Apply code
     *
     * @param Request $request Request from form
     *
     * @return void
     */
    public function applyCode(Request $request)
    {
        $userId = $request->userId;
        $nameCode = $request->nameCode;
        $dateOrder = Carbon::now()->toDateString();
        // dd($userId, $nameCode);
        $checkName = Code::where('name', $nameCode)->count();
        // $dateCode = Code
        // dd($checkName);
        if ($checkName === 0) {
            return redirect()->back()->with('message', 'Code not have');
        } else {
            $codeDetail = Code::where('name', $nameCode)->first();
            // dd($codeDetail);
            $startAt = $codeDetail->start_at;
            $endAt = $codeDetail->end_at;
            $codeId = $codeDetail->id;
            $amount = $codeDetail->amount;
            // dd($codeId);
            // dd($start_at, $end_at, $dateOrder);
            if ($dateOrder <= $endAt && $dateOrder >= $startAt) {
                $userCode = UserCode::where('user_id', $userId)->Where('code_id', $codeId)->first();
                // dd($userCode->re);
                if ($userCode === null) {
                    return redirect()->back()->with('message', 'Code used');
                } else {
                    // $arrCode = array(
                    //     'codeId' => $codeId,
                    //     'amount' =>  $amount
                    // );
                    $message = 'Code applyed';
                    // $userCode->delete();
                    // return view('public.page.checkout', compact('arrCode', 'message'));
                    // return redirect()->route('public.checkout', [$message]);
                    // return redirect()->route('public.checkout')->with('message', $arrCode);
                    return redirect()->route('public.checkout', ['amount' => $amount, 'codeId' => $codeId])->with('message', $message);
                }
                // dd($userCode->delete());
            } else {
                return redirect()->back()->with('message', 'Code Expires');
            }
        }
    }
}
