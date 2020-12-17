<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Util\CalendarUtil;

class Calendar extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CalendarUtil::class;
    }
}
