<?php
/**
 * User: ignat
 * Date: 13.07.16 22:38
 */

namespace App;


class Order
{
    protected $table = 'orders';

    protected $fillable = ['description', 'user_id', 'period'];

}