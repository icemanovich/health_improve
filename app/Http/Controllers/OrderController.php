<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Carbon\Carbon;
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
        $week = Carbon::now();
        $week = [$week->startOfWeek()->toDateString(), $week->endOfWeek()->toDateString()];

        $orders = Order::betweenDates($week[0], $week[1])->orderBy('date')->groupBy('date')->with(['doctor'])->get()->all();

        // TODO :: group and count orders per doctor and week day
//        echo '<pre>';
//        foreach($orders as $order){
//            print_r($order->toArray());
//        }

        return view('orders.index')->with(compact('orders', 'week'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::check()){
            return self::showError('User not authorized');
        }

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
        if (!Auth::check()){
            return self::showError('User not authorized');
        }

        try {
            $order = Order::whereId($id)->first();

            if (!$order){
                return self::showError('No orders found by passed Id');
            }

            if (Auth::user()->id != $order->user_id){
                return self::showError('You can not remove someone order. Manage you own!');
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
