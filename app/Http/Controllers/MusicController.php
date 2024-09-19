<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MusicController extends Controller
{
    public function ambiant(Request $request)
    {
        $planet = $request->get('planet', 'Earth');
        $earth = \App\Models\Planet::where('name', 'Earth')->first();

        if ($planet === 'Earth') {
            return $this->getEarthData($request);
        }

        $planet = \App\Models\Planet::where('name', $planet)->first();

        if (!$planet) {
            return response()->json([
                'error' => 'Planet not found'
            ], 404);
        }

        $rotationMultiplier = $planet->day_length / $earth->day_length;
        $massMultiplier = $planet->mass / $earth->mass;

        return [
            'temperature' => $planet->avg_temperature,
            'rotation' => $rotationMultiplier,
            'mass' => $massMultiplier
        ];
    }

    public function getEarthData(Request $request)
    {
        $data = [];
        $country = $request->get('country', 'GB');
        $city = $request->get('city', 'London');
        $city = \Nnjeim\World\Models\City::where('name', $city)->where('country_code', $country)->get()->first();

        if (!$city) {
            return response()->json([
                'error' => 'City not found'
            ], 404);
        }

        $weather = \App\Helpers\Weather::getWeather($city->latitude, $city->longitude);

        $data['temperature'] = $weather->getTemperature();
        $data['pressure'] = $weather->getPressure();
        $data['humidity'] = $weather->getHumidity();
        $data['wind_speed'] = $weather->getWindSpeed();
        $data['cloudiness'] = $weather->getCloudiness();

        return $data;
    }
}
