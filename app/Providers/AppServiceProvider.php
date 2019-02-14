<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use JavaScript;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('extentions', function ($attribute, $value) {
            if (!is_null($attribute)) {
                $extention = strtolower($value->getClientOriginalExtension());
                if (in_array($extention, ['csv','xlsx','xls','odt'])) {
                    return true;
                }
                    return false;
            }
        });
        
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
            'trans'  => __('js.user'),
            'message'  => __('js.compare'),
            'filter'  => __('js.filter'),
            'order'  => __('js.order'),
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
