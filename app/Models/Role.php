<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    const ROLE_ADMIN = 'Admin';
    const ROLE_NORMAL = 'Normal';
    const ROLE_SUB_ADMIN = 'Sub_Admin';

    protected $table = 'roles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Has many users
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * The function display relationship between permissions and roles
     *
     * @return \App\Models\Permission
     */
    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission')->withTimestamps();
    }
}
