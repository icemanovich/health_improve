<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = User::doctor()->get()->all();
        return view('doctors.index')->with(compact('doctors'));
    }

    /**
     * Display the specified resource.
     *
     * @param string $email
     * @return \Illuminate\Http\Response
     */
    public function show($email)
    {
        // Show doctor info
        $doctor = User::doctor()->where(['email' => $email])->first();
        return view('doctors.show')->with(compact('doctor'));
    }
}
