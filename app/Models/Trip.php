<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\City;
use App\Models\BusStop;
use App\Models\Seat;

class Trip extends Model
{
    use HasFactory;

    /**
     * The cities that belong to the trip.
     */
    public function stops()
    {
        return $this->belongsToMany(City::class, 'bus_stops')
                        ->using(BusStop::class)
                        ->as('stop_details')
                        ->withPivot('id', 'arrival_time', 'departure_time', 'stop_order')
                        ->orderBy('stop_order');
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    public static function get_all()
    {
        return self::with('stops:id,name')
                    ->select('id')
                    ->get();
    }

    public static function find_by_ids($id)
    {
        return self::with('seats')
                    ->with('stops:id,name')
                    ->find($id);
    }

    public static function find_trip_ids_by_route($from, $to)
    {
        $trips = DB::table('trips as t')
                    ->select(['t.id'])
                    ->join('bus_stops as s1', 's1.trip_id', '=', 't.id')
                    ->where('s1.city_id', $from)
                    ->whereExists(function ($query) use ($to) {
                        $query->select(DB::raw(1))
                              ->from('bus_stops as s2')
                              ->whereRaw(DB::raw('s2.trip_id = s1.trip_id'))
                              ->where('s2.city_id', $to)
                              ->whereRaw(DB::raw('s2.stop_order > s1.stop_order'));
                    })
                    ->get();

        $trip_ids = [];
        foreach ($trips as $trip) {
            $trip_ids[] = $trip->id;
        }

        return $trip_ids;
    }

}
