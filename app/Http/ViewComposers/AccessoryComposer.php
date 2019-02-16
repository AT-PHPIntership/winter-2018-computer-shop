<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Accessory;
use App\Services\AccessoryService;

class AccessoryComposer
{
    protected $accessoryService;

    /**
     * Function constructer
     *
     * @param AccsessoryService $accessoryService ClassAccess
     */
    public function __construct(AccessoryService $accessoryService)
    {
        $this->accessoryService = $accessoryService;
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
        $view->with(['accessories' => app(AccessoryService::class)->getChildren(), 'parentAccessories' => app(AccessoryService::class)->getParent()]);
        $view->with('accessories', $this->accessoryService->getList());
    }
}
