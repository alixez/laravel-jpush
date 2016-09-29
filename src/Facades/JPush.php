<?php
/**
 * Created by PhpStorm.
 * User: alixez
 * Date: 16-9-29
 * Time: 下午3:08
 */

namespace Pikachu\LaravelJPush\Facades;


use Illuminate\Support\Facades\Facade;

class JPush extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'jpush';
    }
}