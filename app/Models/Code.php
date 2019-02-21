<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Code extends Model
{
    protected $table = 'codes';
    const NO_USER = '0';
    const ALL_USER = '1';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'amount', 'start_at', 'end_at', 'order_month', 'all_user'
    ];

    /**
     * Relationship user - code
     *
     * @return void
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'code_user')->withTimestamps();
    }
}
