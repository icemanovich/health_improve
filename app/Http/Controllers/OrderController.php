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

        $orders = Order::betweenDates($week[0], $week[1])->with(['doctor', 'user'])->get()->all();

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
            return self::showError('Вы не авторизованы. Войдите в свою учётную запись и повторите попытку.');
        }

        $input = $request->all();
        try {
            if (!Order::isOrderTimeMatch($input['date'])){
                return self::showError('Ошибка создания заявки. Минимальный интервал более ' .
                    Order::$MIN_ORDER_REGISTER_TIME . " часов");
            }

            if (Order::where([
                'user_id' => $input['user_id'],
                'target_id' => $input['target_id'],
                'date' => $input['date']
            ])->first()){
                return self::showError('Такая заявка уже существует');
            }

            $order = new Order($input);
            $order->save();

            return self::showSuccess('Заявка успешно создана');

        } catch (Exception $e){
            return self::showError('Ошибка при создании заявки: ' . $e->getMessage());
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
            return self::showError('Вы не авторизованы. Войдите в свою учётную запись и повторите попытку.');
        }

        try {
            $order = Order::whereId($id)->first();

            if (!$order){
                return self::showError('Похожих записаей не найдено');
            }

            if (Auth::user()->id != $order->user_id){
                return self::showError('Вы не можете удалять чужие записи.');
            }

            if (!Order::isCancelTimeMatch($order->date)){
                return self::showError('Ошибка времени удаления заявки. Минимальный интервал ' .
                    Order::$MIN_ORDER_CANCEL_TIME . " часа");
            }

            $order->delete();

            return self::showSuccess('Заявка успешно удалена');

        } catch (Exception $e){
            return self::showError('Ошибка при удалении заявки: ' . $e->getMessage());
        }
    }


    public function ordersByDate($date)
    {
        return 'ordersByDate';
    }

}
