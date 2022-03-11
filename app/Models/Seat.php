<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Trip;

class Seat extends Model
{
    use HasFactory;

    protected $hidden = array('created_at', 'updated_at');


    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
