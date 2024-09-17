<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    $date = \Illuminate\Support\Carbon::parse($request->get('date', now()));
    $planet = $request->get('planet', 'Earth');
    $country = $request->get('country', 'FR');
    $city = $request->get('city', 'Paris');
    $city = \Nnjeim\World\Models\City::where('name', $city)->where('country_code', $country)->get()->first();

    $earth = \App\Models\Planet::where('name', 'Earth')->first();

    if (!$city) {
        return response()->json([
            'error' => 'City not found'
        ], 404);
    }

    $weather = \App\Helpers\Weather::getWeather($city->latitude, $city->longitude);
    $apod = \App\Helpers\Nasa::getApod();
    $epic = \App\Helpers\Nasa::getEpic();
    $planet = \App\Models\Planet::where('name', $planet)->first();

    $rotationMultiplier = $planet->day_length / $earth->day_length;

    return response()->json([
        'planet' => $planet,
        'temp' => $weather->getTemperature(),
        'rotation' => $rotationMultiplier
    ]);
});
