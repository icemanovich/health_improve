<?php
/**
 * User: ignat
 * Date: 13.07.16 22:38
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

date_default_timezone_set('Europe/Moscow');

/**
 * App\Order
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $target_id
 * @property string $date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereTargetId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order today($timeLeftOnly = false)
 * @method static \Illuminate\Database\Query\Builder|\App\Order week($weekNumber = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Order betweenDates($from = null, $to = null)
 * @mixin \Eloquent
 */
class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['user_id', 'target_id', 'period'];

    static $ORDER_FORMAT_DAY  = 'Y-m-d';
    static $ORDER_FORMAT_HOUR = 'H';

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param bool $timeLeftOnly
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeToday($query, $timeLeftOnly = false)
    {
        return $query->whereBetween('date', [
            self::getDate($timeLeftOnly ? date('H') : '00'),
            self::getDate('23')
        ]);
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
        return $query->whereBetween('date', [
            self::getDate('00'),
            self::getDate('23')
        ]);
    }

    public function calcWeek($week, $year)
    {
        $dto = new \DateTime();
        $ret['week_start'] = $dto->setISODate($year, $week)->format('Y-m-d');
        $ret['week_end'] = $dto->modify('+6 days')->format('Y-m-d');
        return $ret;
    }


    /**
     * Get all orders filtered bu passed week number
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param null $from
     * @param null $to
     * @return \Illuminate\Database\Eloquent\Builder
     * @internal param null $weekNumber
     */
    public function scopeBetweenDates($query, $from = null, $to = null)
    {
        return $query->whereBetween('date', [$from, $to]);
    }

    /**
     * @param null|string $time - only hour number in 24 type format
     * @param null|string $date in format YYYY-MM-DD
     * @return bool|string
     */
    public static function getDate($time = '', $date = '')
    {
        date_default_timezone_set('Europe/Moscow');

        if (!empty($time)){
            $time = "$time:00:00";
        } elseif ($time == '0'){
            $time = '00:00:00';
        } else {
            $time = 'H:00:00';
        }

        $date = $date ? $date : self::$ORDER_FORMAT_DAY;

        return date("$date $time");
    }
}