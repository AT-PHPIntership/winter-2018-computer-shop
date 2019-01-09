<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Services\CommentService;
use Illuminate\Support\Facades\Lang;

class CommentController extends Controller
{
    protected $commentService;

    /**
     * Constructer
     *
     * @param CommentService $commentService [Constructer]
     */
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = $this->commentService->index();
        return view('admin.comments.index', compact('comments'));
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
     * Show comment detail
     *
     * @param Comment $comment [Object]
     *
     * @return void
     */
    public function show(Comment $comment)
    {
        return view('admin.comments.show', compact('comment'));
    }

    // *
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\Comment  $comment
    //  * @return \Illuminate\Http\Response
     
    // public function edit(Comment $comment)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Comment  $comment
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Comment $comment)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = $this->commentService->delete($id);
        if($message !== 0) {
            return redirect()->route('comments.index')->with('message', Lang::get('master.content.message.delete', ['attribute' => trans('master.content.attribute.comment')]));
        } else {
            return redirect()->route('comments.index')->with('message', Lang::get('master.content.message.error'));
        }
    }
}
