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


    /*
     * Work period Monday-Friday from 9am till 3pm
     * */
    public $workDays = [1, 2, 3, 4, 5];
    public $workHours = [9, 10, 11, 12, 13, 14, 15];

}