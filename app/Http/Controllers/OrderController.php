<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mockery\CountValidator\Exception;

date_default_timezone_set('Europe/Moscow');

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
         * TODO :: 1. Сделать просмотр всех приёмов по дням и неделям
         * TODO :: 2. Сделать запись на приём (ограничить двойное назначение и тд)
         *
         *
         *
         * */


//        $o = new Order();
//        $t = $o->calcWeek(28, 2016);
//        var_dump($t);
//        $orders = Order::today(true)->limit(10)->get()->all();
//        return view('order')->with(compact($orders));

        echo '<pre>';

//        $data = Order::today()->get()->all();
        $data = Order::today()->with(['user', 'doctor'])->get()->all();
        foreach($data as $item){
            print_r($item->toArray());
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        /**
         * TODO :: Test for MIN_ORDER_REGISTER TIME !!!!
         *
         * @example: (
         *  [user_id] => 1
         *  [target_id] => 5
         *  [date] => 2016-07-19 14
         *  [_url] => /order
         *  )
         */
        $order = new Order($input);
        $order->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = null;
        $error = null;
        try{
            $order = Order::whereId($id)->first();
        } catch (Exception $e){
            $error = $e;
        }

        /**
         * TODO :: Test errors in view
         */
        return view('orders.show')->with(compact('order', 'error'));
    }


    /**
     * Cancel order from schedule
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Cancel order
    }


}
