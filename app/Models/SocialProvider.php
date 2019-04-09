<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialProvider extends Model
{
    protected $table = 'social_providers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provider_id', 'provider'
    ];

    /**
     * The function display relationship between social provider and user
     *
     * @return \App\Models\User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
