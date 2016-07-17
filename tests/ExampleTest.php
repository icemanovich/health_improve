<?php

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

        $date = date('Y-m-d H:00:00');
        var_dump($date, strtotime($date));
        var_dump(date('Y-m-d H:00:00'));
        var_dump(date('H'));

//        $this->visit('/')
//             ->see('Laravel 5');
    }
}
