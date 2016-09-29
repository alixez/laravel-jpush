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
            $publishPath = $this->app->basePath().'/config/laravel-jpush';
        }

        $this->publishes([
            __DIR__.'/../config/laravel-jpush.php', $publishPath,
        ], 'config');
    }

    public function register()
    {
        $configPath = __DIR__.'/../config/laravel-jpush.php';
        $this->mergeConfigFrom($configPath, 'laravel-jpush');
        $config = $this->app['config']->get('laravel-jpush');

        $this->app->singleton('\Pikachu\LaravelJPush\Facades\JPush', function () {
            return new Client($config['app_key'], $config['master_secret']);
        });
    }
}