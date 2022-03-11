<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Trip;
use App\Models\BusStop;

class City extends Model
{
    use HasFactory;

    /**
     * The trips that to/from this city.
     */
    public function trips()
    {
        return $this->belongsToMany(Trip::class)->using(BusStop::class);
    }
}
