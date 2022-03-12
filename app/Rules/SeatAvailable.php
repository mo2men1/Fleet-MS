<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Support\Facades\DB;

class SeatAvailable implements Rule, DataAwareRule
{
    /**
     * All of the data under validation.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Set the data under validation.
     *
     * @param  array  $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;
 
        return $this;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $src_stop = $this->data['from'];
        $dest_stop = $this->data['to'];

        $count = DB::table('reservations as r')
                        ->where('seat_id', $value)
                        ->join('bus_stops as from_stop', 'from_stop.id', 'r.from_stop')
                        ->join('bus_stops as to_stop', 'to_stop.id', 'r.to_stop')
                        ->join('bus_stops as source_stop', 'source_stop.id', DB::raw($src_stop))
                        ->join('bus_stops as dest_stop', 'dest_stop.id', DB::raw($dest_stop))
                        ->where(function ($query) {
                            $query->where('from_stop.stop_order', '<', DB::raw('dest_stop.stop_order'))
                                  ->where('to_stop.stop_order', '>', DB::raw('source_stop.stop_order'));
                        })
                        ->count();

        return $count < 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The requested :attribute is already reserved.';
    }
}
