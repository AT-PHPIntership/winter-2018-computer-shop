<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCode extends Model
{
    use SoftDeletes;

    protected $table = 'code_user';

    protected $fillable = [
        'id', 'code_id', 'user_id'
    ];

    protected $dates = ['deleted_at'];
}
