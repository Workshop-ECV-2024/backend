<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class Nasa
{
    public static string $apodUrl = 'https://api.nasa.gov/planetary/apod';
    public static string $epicUrl = 'https://api.nasa.gov/EPIC/api/natural/images';
    public static array $planetCodes = [
        'Mercury' => '199',
        'Venus' => '299',
        'Earth' => '399',
        'Mars' => '499',
        'Jupiter' => '599',
        'Saturn' => '699',
        'Uranus' => '799',
        'Neptune' => '899',
        'Pluto' => '999',
        'Sun' => '10'
    ];

    public static function getApod(Carbon $date = null): string|bool
    {
        $date = $date ?? Carbon::now();
        $url = self::$apodUrl . '?api_key=' . config('app.nasa.key') . '&date=' . $date->format('Y-m-d');

        $response = Http::get($url)->json();

        return $response['url'] ?? false;
    }
    public static function getEpic(): array
    {
        $url = self::$epicUrl . '?api_key=' . config('app.nasa.key');

        return Http::get($url)->json();
    }


}
