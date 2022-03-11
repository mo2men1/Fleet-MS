<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;

class TripController extends Controller
{
    public function index()
    {
        return Trip::with('stops:id,name')
                    ->select('id')
                    ->get();
    }
}
