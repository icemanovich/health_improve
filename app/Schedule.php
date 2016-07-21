<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Schedule
 *
 * @property integer $id
 * @property string $week_day
 * @property string $date
 * @method static \Illuminate\Database\Query\Builder|\App\Schedule whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Schedule whereWeekDay($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Schedule whereDate($value)
 * @mixin \Eloquent
 */
class Schedule extends Model
{
    protected $table = 'schedules';

    /**
     * @param null $startOfWeek
     * @return array
     */
    public static function getWeekDates($startOfWeek = null)
    {
        if ($startOfWeek){
            $d = Carbon::now($startOfWeek);
        } else {
            $d = Carbon::now();
        }

        $week = [];
        for($i = 0; $i < 7;$i++){
            if (!isset($next)) {
                $next = $d->startOfWeek();
            } else {
                $next = $next->addDay(1);
            }
            $week[] = $next->toDateString();
        }
        return $week;
    }

}
