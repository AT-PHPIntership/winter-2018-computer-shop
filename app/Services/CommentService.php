<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Product;

class CommentService
{

    /**
    * Save comment of a product
    *
    * @param object $userId    [user comment product]
    * @param object $productId [product user comment]
    * @param object $content   [content of comment]
    *
    * @return comment
    */
    public function comment($userId, $productId, $content, $rate)
    {
        $contents = strip_tags($content);
        $comment = Comment::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'content' => $contents,
            'star' => $rate,
        ]);
        $avgRate = Product::findOrFail($productId)->comments->pluck('star')->avg();
        $numberEachStar = Product::findOrFail($productId)->comments->pluck('star');
        return ['comment' => $comment, 'avgRate' => $avgRate, 'numberEachStar' => $numberEachStar];
    }

    /**
    * Save reply of a cooment
    *
    * @param object $userId        [user comment product]
    * @param object $productId     [product user comment]
    * @param object $content       [content of comment]
    * @param object $parentComment [parent of a reply]
    *
    * @return comment
    */
    public function reply($userId, $productId, $content, $parentComment)
    {
        $contents = strip_tags($content);
        return  Comment::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'content' => $contents,
            'parent_id' => $parentComment,
        ]);
    }
    /**
     * Get list comments
     *
     * @return comments
     */
    public function index()
    {
        return Comment::where('parent_id', null)->paginate(config('constants.comment.number_paginate'));
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
            if ($parent->parent_id === null) {
                $message = Comment::where('id', $id)->orWhere('parent_id', $id)->delete();
            } else {
                $message = Comment::where('id', $id)->delete();
            }
            return $message;
        } catch (\Exception $e) {
            return $message = $e->getMessage();
        }
    }
}
