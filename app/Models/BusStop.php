<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\City;
use App\Models\Trip;

class BusStop extends Pivot
{
    use HasFactory;

    protected $hidden = array('city_id', 'trip_id');
    
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The city that this bus stop belongs to.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    
    /**
     * The trip that this bus stop belongs to.
     */
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
