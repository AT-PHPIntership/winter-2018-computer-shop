<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{
    /**
    * Save comment of a product
    *
    * @return void
    */
    public function comment($userId, $productId, $content)
    {
        return Comment::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'content' => $content,
        ]);
    }

     /**
    * Save comment of a product
    *
    * @return void
    */
    public function reply($userId, $productId, $content, $parentComment)
    {
        return  Comment::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'content' => $content,
            'parent_id' => $parentComment,
        ]);
    }
}
