<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Trip;
use App\Models\Reservation;
use App\Rules\SeatAvailable;

class TripController extends Controller
{
    public function index()
    {
        return Trip::get_all();
    }

    public function get($trip_id)
    {
        return Trip::find_by_ids($trip_id);
    }

    public function search(Request $request)
    {
        $from = $request->query('from');
        $to = $request->query('to');

        $trip_ids = Trip::find_trip_ids_by_route($from, $to);
        return Trip::find_by_ids($trip_ids);
    }

    public function reserve($trip_id, Request $request)
    {
        $validator = Validator::make($request->all(), [
                'from' => [
                    'required',
                    Rule::exists('bus_stops', 'id')->where('trip_id', $trip_id),
                ],
                'to' => [
                    'required',
                    Rule::exists('bus_stops', 'id')->where('trip_id', $trip_id),
                ],
                'seat' => [
                    'required',
                    Rule::exists('seats', 'id')->where('trip_id', $trip_id),
                    new SeatAvailable
                ],
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        return Reservation::create([
            "from_stop" => $request->all()['from'],
            "to_stop" => $request->all()['to'],
            "seat_id" => $request->all()['seat'],
            "user_id" => $request->user()->id,
        ]);
    }
}
