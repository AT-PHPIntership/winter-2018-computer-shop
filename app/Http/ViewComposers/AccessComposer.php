<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Access;
use App\Services\AccessService;

class AccessComposer
{
    protected $accessService;

    /**
     * Function constructer
     *
     * @param AccsessService $accessService ClassAccess
     */
    public function __construct(AccessService $accessService)
    {
        $this->accessService = $accessService;
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
        $view->with('access', $this->accessService->getList());
    }
}
