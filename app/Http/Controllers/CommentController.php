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

    /**
     * Delete comment
     *
     * @param [int] $id [Id comment]
     *
     * @return void
     */
    public function destroy($id)
    {
        $message = $this->commentService->delete($id);
        if ($message !== 0) {
            return redirect()->route('comments.index')->with('message', Lang::get('master.content.message.delete', ['attribute' => trans('master.content.attribute.comment')]));
        } else {
            return redirect()->route('comments.index')->with('message', Lang::get('master.content.message.error'));
        }
    }
}
