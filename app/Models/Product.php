<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'name', 'description', 'quantity', 'unit_price', 'category_id'
    ];

    /**
     * The function display relationship between category and product
     *
     * @return \App\Models\Role
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
