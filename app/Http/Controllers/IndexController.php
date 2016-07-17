<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;

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
        $doctors = User::doctor()->limit(5)->get()->all();
        $orders  = Order::today()->limit(10)->get()->all();
        return view('main')->with(compact('doctors', 'orders'));
    }

}
