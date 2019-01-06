<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    protected $table = 'categories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'parent_id'
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
    public function children()
    {
        return $this->hasMany('App\Models\Category', 'parent_id', 'id');
    }
}
