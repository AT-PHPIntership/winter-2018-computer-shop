<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

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
     * The function display relationship between role and user
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
