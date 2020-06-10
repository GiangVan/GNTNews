<?php
namespace App\Helpers;

use Carbon\Carbon;

class TimeConvert{
    public static function getDiff($time){
        Carbon::setLocale("vi");
        $ComparisonTime = new Carbon($time);
        return $ComparisonTime->diffForHumans(Carbon::now());
    }
}
