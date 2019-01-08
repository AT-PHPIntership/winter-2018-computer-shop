<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use App\Models\User;
use App\Models\Product;

class Comment extends Model
{
    use NodeTrait;
    
    protected $guarded = [];

    /**
     * Relationship with product
     *
     * @return void
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relationship with user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
