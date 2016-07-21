<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = User::doctor()->limit(5)->with(['speciality', 'workplace'])->get()->all();
        $orders  = Order::today()->limit(10)->with(['doctor'])->get()->all();

//        echo '<pre>';
//        foreach($doctors as $order){
//            print_r($order->toArray());
//        }

        return view('main')->with(compact('doctors', 'orders'));
    }

}
