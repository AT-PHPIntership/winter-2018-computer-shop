<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    const ROLE_ADMIN = 'Admin';
    const ROLE_NORMAL = 'Normal';
    const ROLE_VIP = 'VIP';

    protected $table = 'roles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Has many users
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
