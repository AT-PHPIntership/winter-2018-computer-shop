<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;

class Product extends Model
{
    protected $table = 'products';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'quantity', 'unit_price', 'category_id', 'total_sold'
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
        return $this->hasMany('App\Models\Comment')->whereNull('parent_id');
    }

    /**
     * Desplay relationship between product and promotion
     *
     * @return void
     */
    public function promotions()
    {
        return $this->belongsToMany('App\Models\Promotion', 'product_promotion')->withTimestamps();
    }

    /**
     * [orderDetails description]
     *
     * @return [type] [description] Dsdf
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
