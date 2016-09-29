<?php
/**
 * Created by PhpStorm.
 * User: alixez
 * Date: 16-9-29
 * Time: 下午2:38
 */

namespace Pikachu\LaravelJPush;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use JPush\Client;

class JPushServiceProvider extends ServiceProvider
{
    public function boot()
    {

        if(function_exists('config_path')) {
            $publishPath = config_path('laravel-jpush.php');
        } else {
            $publishPath = $this->app->basePath().'/config/laravel-jpush.php';
        }

        $this->publishes([
            __DIR__.'/../config/laravel-jpush.php', $publishPath,
        ], 'config');
    }

    public function register()
    {
        $configPath = __DIR__.'/../config/laravel-jpush.php';
        $this->mergeConfigFrom($configPath, 'laravel-jpush');

        $this->app->singleton('jpush', function () {
            return new Client(Config::get('laravel-jpush.app_key'), Config::get('laravel-jpush.master_secret'));
        });
    }
}
