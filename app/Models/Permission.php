<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'description', 'parent_id', 'actions'];

    /**
     * The function display relationship between permissions and roles
     *
     * @return \App\Models\Role
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role')->withPivot('action_pivot')->withTimestamps();
    }

     /**
     * The function to take all parent category
     *
     * @param Builder $builder help take all parent category
     *
     * @return \App\Models\User
     */
    public function scopeParents(Builder $builder)
    {
        $builder->whereNull('parent_id');
    }
    
    /**
     * The function display relationship between parent category
     *
     * @var array
     *
     * @return \App\Models\User
     */
    public function childrens()
    {
        return $this->hasMany('App\Models\Permission', 'parent_id', 'id');
    }
}
