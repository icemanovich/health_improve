<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
