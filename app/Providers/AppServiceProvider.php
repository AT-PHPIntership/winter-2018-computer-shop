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
                if (in_array($extention, ['csv', 'xlsx', 'xls', 'odt'])) {
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
            'element' => __('js.delete'),
            'message' => __('js.compare'),
            'filter' => __('js.filter'),
            'search' => __('js.search'),
            'order' => __('js.order'),
            'comment' => __('js.comment'),
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
