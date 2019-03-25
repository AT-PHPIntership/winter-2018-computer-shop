<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Comment extends Model
{
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'user_id', 'content', 'parent_id', 'star'
    ];

    /**
     * The function to take all parent category
     *
     * @param Builder $builder help take all parent category
     *
     * @return \App\Models\User
     */
    public function scopeParents(Builder $builder)
    {
        $builder->whereNull('parent_id');
    }

    /**
     * The function display relationship between parent category
     *
     * @var array
     *
     * @return \App\Models\User
     */
    public function childrens()
    {
        return $this->hasMany('App\Models\Comment', 'parent_id', 'id');
    }

    /**
     * The function display relationship between product and comment
     *
     * @var array
     *
     * @return \App\Models\Product
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    /**
     * The function display relationship between user and category
     *
     * @var array
     *
     * @return \App\Models\Product
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
