<?php

namespace App\Services;

use App\Models\Accessory;

class AccessoryService
{
    /**
    * Get child accessoris
    *
    * @return void
    */
    public function getChildren()
    {
        return Accessory::with('childrens')->get();
    }
}
