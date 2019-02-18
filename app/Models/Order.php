<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderDetail;

class Order extends Model
{
    protected $table = 'orders';
    
    //Constant status order
    const PENDING_STATUS = 'Pending';
    const APPROVE_STATUS = 'Approve';
    const CANCEL_STATUS = 'Cancel';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'date_order', 'status', 'note', 'user_id', 'address', 'phone'
    ];

    /**
     * Get OrderDestail of Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    /**
     * Get User Object
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the order's status
     *
     * @return string
     */
    public function getCurrentStatusAttribute()
    {
        switch ($this->status) {
            case config('constants.order.status.pending'):
                return self::PENDING_STATUS;
            case config('constants.order.status.approve'):
                return self::APPROVE_STATUS;
            case config('constants.order.status.cancel'):
                return self::CANCEL_STATUS;
            default:
        }
    }
}
