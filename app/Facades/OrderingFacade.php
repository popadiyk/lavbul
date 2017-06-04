<?php
/**
 * Created by PhpStorm.
 * User: shesser
 * Date: 02.06.17
 * Time: 0:17
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class OrderingFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ordering';
    }
}