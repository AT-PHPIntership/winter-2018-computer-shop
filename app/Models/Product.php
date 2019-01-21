<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;

class Product extends Model
{
    protected $fillable = [
        'name', 'quantity', 'unit_price'
    ];

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
