<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Comment;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Relationship with product
     *
     * @return void
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    /**
     * The function display relationship between role and user
     *
     * @return \App\Models\Role
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    /**
     * The function display relationship between userprofile and user
     *
     * @return \App\Models\UserProfile
     */
    public function profile()
    {
        return $this->hasOne('App\Models\UserProfile');
    }
    
    /**
     * The function help encrypt the password when user enter into
     *
     * @param string $password [input password to hash]
     *
     * @return \Illuminate\Support\Facades\Hash;
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
