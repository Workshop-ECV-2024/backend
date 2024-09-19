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

Route::prefix('music')->group(function () {
    Route::get('/ambiant', [\App\Http\Controllers\MusicController::class, 'ambiant']);
});


Route::get('/planet', function(Request $request) {
    $planet = $request->get('name', 'Earth');

    return \App\Models\Planet::where("name", $planet)->first();
});

Route::get('/weather', function (Request $request) {
    $latitude = $request->get('latitude', 48.8566);
    $longitude = $request->get('longitude', 2.3522);

    $weather = \App\Helpers\Weather::getWeather($latitude, $longitude);

    return [
        'temperature' => $weather->getTemperature(),
        'pressure' => $weather->getPressure(),
        'humidity' => $weather->getHumidity(),
        'wind_speed' => $weather->getWindSpeed(),
        'cloudiness' => $weather->getCloudiness()
    ];
});
