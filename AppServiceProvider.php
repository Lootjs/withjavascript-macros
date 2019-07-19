<?php

namespace App\Providers;

use Illuminate\Support\{Facades\Cache,ServiceProvider};
use Illuminate\View\View;
use Closure;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::macro('withJavascript', function ($vars) {
            $script = '<script>';

            foreach ($vars as $name => $value) {
                switch (gettype($value)) {
                    case 'boolean':
                        $value = $value ? 'true' : 'false';
                        break;

                    case 'string':
                        $value = '"'.$value.'"';
                        break;

                    case 'array':
                        $value = json_encode($value);
                        break;

                    case 'object':
                        //$value = json_encode($value);
                        if ($value instanceof Jsonable) {
                            $value = $value->toJson();
                        } elseif (method_exists($value, 'toArray')) {
                            $value = $value->toArray();
                        }
                        break;

                    case 'NULL':
                        $value = '""';
                        break;
                }

                $script .= sprintf('window.%s = %s;', $name, $value);
            }

            $script .= '</script></head>';

            $rendered = str_replace('</head>', $script, $this->render());

            return $rendered;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    public function provides()
    {
        return ['filesystem'];
    }
}
