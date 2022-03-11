<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Trip;
use App\Models\City;
use Carbon\Carbon;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Trip::factory(10)->create();

        foreach (Trip::all() as $trip) {
            $start_date = Carbon::now()->addDays(rand(1, 100))->addMinutes(rand(0, 200));

            $cities = City::inRandomOrder()->take(rand(2, 10))->pluck('id');
            foreach ($cities as $index => $city) {
                $trip->stops()->attach($city, [
                    'stop_order' => $index,
                    'arrival_time' => $start_date->toDateTimeString(),
                    'departure_time' => $start_date->addMinutes(10)->toDateTimeString(),
                ]);

                $start_date->addMinutes(rand(20, 40));
            }
        }
    }
}
