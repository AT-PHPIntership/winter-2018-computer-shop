<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderDetail;

class Order extends Model
{
    protected $table = 'orders';
    const PENDING_STATUS = 1;
    const APPROVE_STATUS = 2;
    const CANCEL_STATUS = 0;

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
            case self::PENDING_STATUS:
                return config('constants.order.status.pending');
            case self::APPROVE_STATUS:
                return config('constants.order.status.approve');
            case self::CANCEL_STATUS:
                return config('constants.order.status.cancel');
            default:
        }
    }
}
