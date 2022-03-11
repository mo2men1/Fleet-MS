<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
                        ->withPivot('arrival_time', 'departure_time', 'stop_order')
                        ->orderBy('stop_order');
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}
