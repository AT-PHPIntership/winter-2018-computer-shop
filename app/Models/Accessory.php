<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Kalnoy\Nestedset\NodeTrait;

class Accessory extends Model
{
    use NodeTrait;
    
    protected $table = 'accessories';
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    
     /**
     * The function display relationship between product and accessory
     *
     * @return \App\Models\Product
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withTimestamps();
    }
    
    /**
     * The function to take all parent accessory
     *
     * @param Builder $builder help take all parent category
     *
     * @return \App\Models\Accessory
     */
    public function scopeParents(Builder $builder)
    {
        $builder->whereNull('parent_id');
    }
    
    /**
     * The function to take all parent accessory
     *
     * @return \App\Models\Accessory
     */
    public function childrens()
    {
        return $this->hasMany(Accessory::class, 'parent_id', 'id');
    }

     /**
     * The function to take all parent accessory
     *
     * @return \App\Models\Accessory
     */
    public function parent()
    {
        return $this->belongsTo(Accessory::class);
    }
}
