<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public array $solarSystemPlanets = [
        "Mercury" => [
            "radius" => 2439.7, // in kilometers
            "mass" => 3.3011e23, // in kilograms
            "distance_from_sun" => 57.91e6, // in kilometers
            "day_length" => 58.646, // in Earth days
            "year_length" => 88, // in Earth days
            "atmospheric_composition" => [
                "oxygen" => 42.0,
                "sodium" => 29.0,
                "hydrogen" => 22.0,
                "helium" => 6.0
            ],
            'avg_temperature' => 167 // in Celsius
        ],
        "Venus" => [
            "radius" => 6051.8, // in kilometers
            "mass" => 4.8675e24, // in kilograms
            "distance_from_sun" => 108.2e6, // in kilometers
            "day_length" => 243, // in Earth days
            "year_length" => 224.7, // in Earth days
            "atmospheric_composition" => [
                "carbon_dioxide" => 96.5,
                "nitrogen" => 3.5
            ],
            'avg_temperature' => 464 // in Celsius
        ],
        "Earth" => [
            "radius" => 6371, // in kilometers
            "mass" => 5.97237e24, // in kilograms
            "distance_from_sun" => 149.6e6, // in kilometers
            "day_length" => 1, // in Earth days
            "year_length" => 365.25, // in Earth days
            "atmospheric_composition" => [
                "nitrogen" => 78.09,
                "oxygen" => 20.95,
                "argon" => 0.93,
                "carbon_dioxide" => 0.04
            ],
            'avg_temperature' => 15 // in Celsius
        ],
        "Mars" => [
            "radius" => 3389.5, // in kilometers
            "mass" => 6.4171e23, // in kilograms
            "distance_from_sun" => 227.9e6, // in kilometers
            "day_length" => 1.025, // in Earth days
            "year_length" => 687, // in Earth days
            "atmospheric_composition" => [
                "carbon_dioxide" => 95.32,
                "nitrogen" => 2.7,
                "argon" => 1.6
            ],
            'avg_temperature' => -65 // in Celsius
        ],
        "Jupiter" => [
            "radius" => 69911, // in kilometers
            "mass" => 1.8982e27, // in kilograms
            "distance_from_sun" => 778.5e6, // in kilometers
            "day_length" => 0.413, // in Earth days (about 10 hours)
            "year_length" => 4333, // in Earth days
            "atmospheric_composition" => [
                "hydrogen" => 89.8,
                "helium" => 10.2
            ],
            'avg_temperature' => -110 // in Celsius
        ],
        "Saturn" => [
            "radius" => 58232, // in kilometers
            "mass" => 5.6834e26, // in kilograms
            "distance_from_sun" => 1.434e9, // in kilometers
            "day_length" => 0.444, // in Earth days (about 10.5 hours)
            "year_length" => 10759, // in Earth days
            "atmospheric_composition" => [
                "hydrogen" => 96.3,
                "helium" => 3.25
            ],
            'avg_temperature' => -140 // in Celsius
        ],
        "Uranus" => [
            "radius" => 25362, // in kilometers
            "mass" => 8.6810e25, // in kilograms
            "distance_from_sun" => 2.871e9, // in kilometers
            "day_length" => 0.718, // in Earth days (about 17.2 hours)
            "year_length" => 30687, // in Earth days
            "atmospheric_composition" => [
                "hydrogen" => 82.5,
                "helium" => 15.2,
                "methane" => 2.3
            ],
            'avg_temperature' => -195 // in Celsius
        ],
        "Neptune" => [
            "radius" => 24622, // in kilometers
            "mass" => 1.02413e26, // in kilograms
            "distance_from_sun" => 4.495e9, // in kilometers
            "day_length" => 0.671, // in Earth days (about 16 hours)
            "year_length" => 60190, // in Earth days
            "atmospheric_composition" => [
                "hydrogen" => 80,
                "helium" => 19,
                "methane" => 1.5
            ],
            'avg_temperature' => -200 // in Celsius
        ],
        "Pluto" => [
            "radius" => 1188.3, // in kilometers
            "mass" => 1.303e22, // in kilograms
            "distance_from_sun" => 5.906e9, // in kilometers
            "day_length" => 6.387, // in Earth days
            "year_length" => 90560, // in Earth days
            "atmospheric_composition" => [
                "nitrogen" => 98,
                "methane" => 1.5,
                "carbon_monoxide" => 0.5
            ],
            'avg_temperature' => -225 // in Celsius
        ]
    ];


    public function run(): void
    {
        foreach ($this->solarSystemPlanets as $planet => $data) {
            \App\Models\Planet::create([
                'name' => $planet,
                'radius' => $data['radius'],
                'mass' => $data['mass'],
                'distance_from_sun' => $data['distance_from_sun'],
                'day_length' => $data['day_length'],
                'year_length' => $data['year_length'],
                'atmospheric_composition' => json_encode($data['atmospheric_composition']),
                'avg_temperature' => $data['avg_temperature']
            ]);
        }
    }
}
