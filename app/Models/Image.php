<?php
 namespace App\Models;
 
 use Illuminate\Database\Eloquent\Model;
 
class Image extends Model
{
    protected $table = 'images';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'name', 'product_id'
    ];

    /**
     * Get all of the product that are assigned this image.
     *
     *@return App\Models\Product
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
