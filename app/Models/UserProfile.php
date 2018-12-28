<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profiles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address', 'phone', 'avatar', 'user_id'
    ];
    /**
     * The function display relationship between userprofile and user
     *
     * @var array
     *
     * @return \App\Models\User
     */
    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }
}
