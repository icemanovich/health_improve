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
        $doctors = User::doctor()->with(['speciality', 'workplace'])->get()->all();
        return view('doctors.index')->with(compact('doctors'));
    }

    /**
     * Display info about doctor by their email
     *
     * @param string $email
     * @return \Illuminate\Http\Response
     */
    public function show($email)
    {
        $doctor = User::doctor()->where(['email' => $email])->with('speciality', 'workplace')->first();
        return view('doctors.show')->with(compact('doctor'));
    }
}
