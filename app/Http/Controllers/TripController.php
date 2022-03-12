<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;

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
}
