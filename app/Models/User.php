<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Order;
use App\Models\Role;
use App\Models\Code;

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
         'name', 'email', 'password', 'role_id', 'is_actived',
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
     * Get User Object
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Belongs to role
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
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

     /**
     * The function display relationship between user and social provider
     *
     * @return \App\Models\SocialProvider
     */
    public function socialProviders()
    {
        return $this->hasMany('App\Models\SocialProvider');
    }

    /**
     * The function display relationship between comment and user
     *
     * @return \App\Models\Role
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
    
    /**
     * Relationship user - code
     *
     * @return void
     */
    public function codes()
    {
        return $this->belongsToMany(Code::class);
    }
}
