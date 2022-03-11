<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            'Cairo',
            'Giza',
            'Alexandria',
            'Dakahlia',
            'Red Sea',
            'Beheira',
            'Fayoum',
            'Gharbiya',
            'Ismailia',
            'Menofia',
            'Minya',
            'Qaliubiya',
            'New Valley',
            'Suez',
            'Aswan',
            'Assiut',
            'Beni Suef',
            'Port Said',
            'Damietta',
            'Sharkia',
            'South Sinai',
            'Kafr Al sheikh',
            'Matrouh',
            'Luxor',
            'Qena',
            'North Sinai',
            'Sohag',
        ];

        foreach ($cities as $city) {
            City::create([
                'name' => $city
            ]);
        }
    }
}
