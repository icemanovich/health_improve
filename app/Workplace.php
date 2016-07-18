<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Workplace
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $subway
 * @property string $site
 * @method static \Illuminate\Database\Query\Builder|\App\Workplace whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Workplace whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Workplace whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Workplace whereSubway($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Workplace whereSite($value)
 * @mixin \Eloquent
 */
class Workplace extends Model
{
    protected $table = 'workplaces';

    /**
     * WARNING
     * In real life may be more than one addresses. Should keep them in separate table!!
     * */
    protected $fillable = ['name', 'address', 'subway', 'site'];

    public $timestamps = false;
}
