<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Auth;
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
        try {
            if (!Order::isOrderTimeMatch($input['date'])){
                return self::showError('Invalid order time. Must be bigger than ' .
                    Order::$MIN_ORDER_REGISTER_TIME . " hours");
            }

            if (Order::where([
                'user_id' => $input['user_id'],
                'target_id' => $input['target_id'],
                'date' => $input['date']
            ])->first()){
                return self::showError('Duplicate order found');
            }

            $order = new Order($input);
            $order->save();

            return self::showSuccess('Order successfully created');

        } catch (Exception $e){
            return self::showError('Error on order creation: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::whereId($id)->with(['doctor'])->first();

        if (!$order){
            return view('orders.show')->withErrors(['msg', 'The Message']);
        }

        return view('orders.show')->with(compact('order'));
    }

    /**
     * Cancel order from schedule
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // TODO :: check for user auth
        // check for needed order by user

        try {
            $order = Order::whereId($id)->first();

            if (!$order){
                return self::showError('No orders found by passed Id');
            }

            if (!Order::isCancelTimeMatch($order->date)){
                return self::showError('Invalid order cancel time. Must be lower than ' .
                    Order::$MIN_ORDER_CANCEL_TIME . " hours");
            }

            $order->delete();

            return self::showSuccess('Order successfully removed');

        } catch (Exception $e){
            return self::showError('Error on order remove: ' . $e->getMessage());
        }
    }


    public function ordersByDate($date)
    {
        return 'ordersByDate';
    }

}
