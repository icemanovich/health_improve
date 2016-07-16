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

        var_dump(strtotime(date('d-m-Y-H')));
        var_dump(date('d-m-Y H', 1468699200));
        var_dump(time());

//        $this->visit('/')
//             ->see('Laravel 5');
    }
}
