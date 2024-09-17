<?php

namespace App\Helpers;

use App\ResponseWrappers\WeatherResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Weather
{
    static string $url = 'https://api.openweathermap.org/data/2.5/weather';

    public static function getWeather(string $lat, string $long): WeatherResponse|bool
    {
        $key = config('app.open_weather.key');

        $url = self::$url . '?lat=' . $lat . '&lon=' . $long . '&appid=' . $key . '&units=metric';

        $response = new WeatherResponse(Http::get($url));

        return $response->ok() ? $response : false;
    }


}
