<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Product extends Model
{
    protected $guarded = [];

    /**
     * Relationship with product
     *
     * @return void
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
