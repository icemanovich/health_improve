<?php

use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        date_default_timezone_set('Europe/Moscow');

//        $date = date('Y-m-d H:00:00');
//        var_dump($date, strtotime($date));
//        var_dump(date('Y-m-d H:00:00'));
//        var_dump(date('H'));

        $d1 = '2016-07-19 14';
        $d2 = '2016-07-19 10';

//        print_r($d1);
//        print_r(strtotime($d1));
//        echo "\n";
//        print_r($d1);

//        $d = Carbon::now(new DateTimeZone('Europe/Moscow'));

//        $d = Carbon::createFromFormat('Y-m-d H', $d1);
//        $d2 = Carbon::createFromFormat('Y-m-d H', $d2);
//        print_r($d);
//        $now = Carbon::now();
//        print_r($now->toDateTimeString());
//
//        var_dump($now->addHours(1)->lte($d));
//        var_dump($now->addHours(1)->lte($d2));

        $d = Carbon::now();
        print_r(Carbon::getWeekendDays());
        print_r($d->startOfWeek()->toDateString());
        print_r($d->endOfWeek()->toDateTimeString());



//        if ($now - $d){
//            echo "YES\n";
//        } else {
//            echo "NO\n";
//        }



//        $this->visit('/')
//             ->see('Laravel 5');

        $this->assertTrue(true);

    }
}
