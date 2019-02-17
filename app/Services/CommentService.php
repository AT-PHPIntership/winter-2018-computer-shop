<?php

namespace App\Services;

use App\Models\Comment;

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
    public function comment($userId, $productId, $content)
    {
        return Comment::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'content' => $content,
        ]);
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
        return  Comment::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'content' => $content,
            'parent_id' => $parentComment,
        ]);
    }
}
