<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use JavaScript;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         $this->putPHPToJavaScript();
    }

    /**
     * Define putPHPToJavaScript
     *
     * @return void
     */
    protected function putPHPToJavaScript()
    {
        JavaScript::put([
            'define' => config('define'),
            'trans'  => __('js'),
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
