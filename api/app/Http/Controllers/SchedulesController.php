<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedules;
use Illuminate\Database\QueryException;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Schedules::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            return Schedules::create(
                [
                    'name' => $request->name, 
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'birth_date' => $request->birth_date,
                    'address' => $request->address
                ]);
        } catch (QueryException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedules  $schedules
     */
    public function show(Schedules $schedule)
    {
        return $schedule;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedules  $schedules
     * @return \Illuminate\Http\Response
     * rota /schedule/2/edit
     */
    public function edit(Schedules $schedule)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedules  $schedules
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedules $schedule)
    {
        $schedule->update($request->input());
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedules  $schedules
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedules $schedule)
    {
        $schedule->delete();
        return 1;
    }
}
