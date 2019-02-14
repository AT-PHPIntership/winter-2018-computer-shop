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
     * @return array
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * The function get unit price attribute
     *
     * @param object $unitPrice [pass attribute to fucntion]
     *
     * @return array
     */
    public function getUnitPriceAttribute($unitPrice)
    {
        return number_format($unitPrice, 0, ",", ",");
    }

    /**
     * The function display relationship between product and accessory
     *
     * @return \App\Models\Product
     */
    public function accessories()
    {
        return $this->belongsToMany('App\Models\Accessory')->withTimestamps();
    }

    /**
     * The function display relationship between product and accessory
     *
     * @return \App\Models\Product
     */
    public function images()
    {
        return $this->hasMany('App\Models\Image');
    }

    /**
     * The function display relationship between comment and product
     *
     * @return \App\Models\Role
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
