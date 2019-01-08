<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{

    /**
     * Get list comments
     *
     * @return comments
     */
    public function index()
    {
        $comments = Comment::where('parent_id', null)->paginate(config('constants.comment.number_paginate'));
        return $comments;
    }
}
