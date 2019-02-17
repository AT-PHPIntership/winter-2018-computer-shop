<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotions';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'percent', 'start_at', 'end_at', 'total_sold'
    ];

    /**
     * Display relationship between promotion and product
     *
     * @return void
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }
}
