<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\Trip;
use \App\Models\Seat;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Trip $trip) {
            echo "Creating seats ";
            $trip->seats()->saveMany([
                new Seat(['name' => '1A']),
                new Seat(['name' => '2A']),
                new Seat(['name' => '1B']),
                new Seat(['name' => '2B']),
                new Seat(['name' => '1C']),
                new Seat(['name' => '2C']),
                new Seat(['name' => '1D']),
                new Seat(['name' => '2D']),
                new Seat(['name' => '1E']),
                new Seat(['name' => '2E']),
                new Seat(['name' => '1F']),
                new Seat(['name' => '2F']),
            ]);
        });
    }
}
