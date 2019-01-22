<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Access extends Model
{
    use NodeTrait;
    // protected $table = 'accesses';

    // protected $fillable = [
    //     'name', 'parent_id'
    // ];
    protected $guarded = ['id'];

    // public function getLftName()
    // {
    //     return 'left';
    // }

    // public function getRgtName()
    // {
    //     return 'right';
    // }

    // public function getParentIdName()
    // {
    //     return 'parent';
    // }

    // // Specify parent id attribute mutator
    // public function setParentAttribute($value)
    // {
    //     $this->setParentIdAttribute($value);
    // }
}
