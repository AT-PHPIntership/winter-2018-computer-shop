<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Services\SlideService;

class SlideComposer
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
        $view->with(['slides' => app(SlideService::class)->allSlide(), 'banners' => app(SlideService::class)->homePage()]);
    }
}
