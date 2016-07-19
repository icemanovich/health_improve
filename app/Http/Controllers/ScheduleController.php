<?php

namespace App\Http\Controllers;

use App\Order;
use App\Schedule;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = User::doctor()->orderBy('speciality')->get()->all();
        foreach($doctors as $doc){
            $doc->work_date = Order::$work_date;
        }

        $week = Carbon::now();
        $week = [$week->startOfWeek()->toDateString(), $week->endOfWeek()->toDateString()];

        return view('schedule.index')->with(compact('doctors', 'week'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id - doctor_id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor = User::doctor()->whereId($id)->first();
        $doctor->work_date = Order::$work_date;

        $week = Schedule::getWeekDates();

        // TODO :: add orders to week days to display in View
//        $orders = Order::week();

        return view('schedule.show')->with(compact('doctor', 'week', 'today'));
    }

    public function showByWeek($weekNumber = null)
    {
//        if (!$weekNumber){
//            $$weekNumber = date('W');
//        }
    }

}
