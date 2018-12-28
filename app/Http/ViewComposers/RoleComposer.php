<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Role;

class RoleComposer
{
    /**
    * Bind data to the view.
    *
    * @param View $view [view]
    *
    * @return void
    */
    public function compose(View $view)
    {
        $view->with('roles', Role::select('id', 'name')->paginate(5));
    }
}
