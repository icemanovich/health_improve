<?php
/**
 * User: ignat
 * Date: 13.07.16 22:38
 */

namespace App;


use Carbon\Carbon;
use DB;
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
 * @property-read \App\User $doctor
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Order doctorId($target_id)
 */
class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['user_id', 'target_id', 'date'];

    static $ORDER_FORMAT_DAY  = 'Y-m-d';
    static $ORDER_FORMAT_HOUR = 'H';

    /**
     * @var int in hours
     */
    static $MIN_ORDER_REGISTER_TIME = 1;
    static $MIN_ORDER_CANCEL_TIME   = 2;

    static $work_days  = [1,2,3,4,5];
    static $work_hours = [9,10,11,12,13,14,15];
    static $work_date  = [
        1 => [9,10,11,12,13,14,15],
        2 => [15,16,17],
        3 => [9,10,11,12,13,14,15],
        4 => [9,10,11,12,13,14,15],
        5 => [9,10,11,12,13,14,15],
    ];

    /**
     * Get orders only for today
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param bool $timeLeftOnly
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeToday($query, $timeLeftOnly = false)
    {
        $d1 = Carbon::now();
        $d2 = clone $d1;
        return $query->betweenDates(
            $timeLeftOnly ? $d1->toDateString() . ' '.$d1->hour : $d1->startOfDay(),
            $d2->endOfWeek()
        );
    }

    /**
     * Get all orders filtered bu passed week number
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param null $startOfWeekDate
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWeek($query, $startOfWeekDate = null)
    {
        if ($startOfWeekDate){
            $d1 = Carbon::now($startOfWeekDate);
        } else {
            $d1 = Carbon::now();
        }

        /**
         * Need to pass 2 different objects
         */
        $d2 = clone $d1;

        return $query->betweenDates($d1->startOfWeek(), $d2->endOfWeek());
    }

    /**
     * Get all orders filtered bu passed week number
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param $from
     * @param $to
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBetweenDates($query, $from, $to)
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

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $target_id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDoctorId($query, $target_id)
    {
        return $query->whereHas('users', function($doc_query) use ($target_id){
            $doc_query->target_id($target_id);
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function doctor()
    {
        return $this->hasOne('App\User', 'id', 'target_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    /**
     * @param string $orderDate in format (YYY-MM-DD HH[::i::s])
     * @return bool
     */
    public static function isCancelTimeMatch($orderDate)
    {
        $orderDate = Carbon::createFromFormat('Y-m-d H', $orderDate);
        $now = Carbon::now();
        return $orderDate->subHours(self::$MIN_ORDER_CANCEL_TIME)->gte($now);
    }

    /**
     * @param string $orderDate in format (YYY-MM-DD HH[::i::s])
     * @return bool
     */
    public static function isOrderTimeMatch($orderDate)
    {
        $orderDate = Carbon::createFromFormat('Y-m-d H', $orderDate);
        $now = Carbon::now();
        return $now->addHours(self::$MIN_ORDER_REGISTER_TIME)->lte($orderDate);
    }

}