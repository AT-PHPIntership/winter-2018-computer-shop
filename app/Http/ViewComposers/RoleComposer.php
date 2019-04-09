<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Role;
use App\Services\RoleService;

class RoleComposer
{
    private $roleService;

    /**
     * Contructer RoleService
     *
     * @param RoleService $roleService [roleservice]
     */
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
    * Bind data to the view.
    *
    * @param View $view [view]
    *
    * @return void
    */
    public function compose(View $view)
    {
        $view->with(['roles' => $this->roleService->getAll(), 'normalRole' => \App\Models\Role::where('name', \App\Models\Role::ROLE_NORMAL)->select('id')->pluck('id')->first()]);
    }
}
