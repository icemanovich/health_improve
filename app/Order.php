<?php
/**
 * User: ignat
 * Date: 13.07.16 22:38
 */

namespace App;


class Order
{
    protected $table = 'orders';

    protected $fillable = ['user_id', 'target_id', 'period'];

    static $ORDER_FORMAT_DAY  = 'Y.m.d';
    static $ORDER_FORMAT_HOUR = 'H';

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeToday($query)
    {
        // TODO ::  find by Y.m.d H timestamp
        return $query->where('date', self::$ORDER_FORMAT_DAY)->where('date', self::$ORDER_FORMAT_HOUR);
    }

    /**
     * Get all orders filtered bu passed week number
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param null $weekNumber
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWeek($query, $weekNumber = null)
    {
        if (!$weekNumber){
            $weekNumber = date("W", strtotime( date(self::$ORDER_FORMAT_DAY) ));
        }
        // TODO :: find by passed week number
        return $query->whereBetween('date', [$weekNumber-1, $weekNumber]);
    }
}