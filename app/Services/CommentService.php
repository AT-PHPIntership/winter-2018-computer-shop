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

    /**
     * Delete comment
     *
     * @param [int] $id [Id commetn]
     *
     * @return void
     */
    public function delete($id)
    {
        try {
            $parent = Comment::find($id);
            if ($parent->parent === null) {
                $message = Comment::where('id', $id)
                                    ->orWhere('parent_id', $id)->delete();
            } else {
                $message = Comment::where('id', $id)->delete();
            }
            return $message;
        } catch (\Exception $e) {
            return $message = $e->getMessage();
        }
    }
}
