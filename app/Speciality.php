<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Speciality
 *
 * @property integer $id
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\App\Speciality whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Speciality whereName($value)
 * @mixin \Eloquent
 */
class Speciality extends Model
{
    protected $table = 'specialities';

    protected $fillable = ['name'];

    public $timestamps = false;
}
