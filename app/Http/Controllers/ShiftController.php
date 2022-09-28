<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;
use App\Http\Requests\ShiftStoreRequest;
use Carbon\CarbonPeriod;

class ShiftController extends Controller
{
    public function index() {
  
        return view('shifts');
    }


    public function create()
    {

        $data = Shift::all();
        return view('create', compact('data'));
    }

    public function store(ShiftStoreRequest $request) {

        $shift = Shift::create([
            'shift_start' =>$request->shift_start,
            'shift_end' =>$request->shift_end

        ]);

        return view('index');
    }

    public function timeslots($shift_start, $shift_end)
    {
        $shift_start_date = date("Y-m-d H:i:s", strtotime($shift_start));
        $shift_end_date =  date("Y-m-d H:i:s", strtotime($shift_end));
        $shift_date = date("Y-m-d", strtotime($shift_end));

        $slots = [];
       
        $period = new CarbonPeriod( $shift_start_date, '15 minutes', $shift_end_date); 
        foreach($period as $item){
            array_push($slots,$item->format("h:i A"));
        }
    //    dd($slots);
        return view('slots',[
            'start_time' => $shift_start_date,
            'end_time' => $shift_end_date,
            'date' => $shift_date,
            'slots' => $slots,
        ]);


    }
}
