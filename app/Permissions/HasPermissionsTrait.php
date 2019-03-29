<?php
namespace App\Permissions;

use App\Models\Permission;

trait HasPermissionsTrait {

    public function permissions() {
        return $this->belongsToMany(Permission::class, 'user_permissions');
    }
}