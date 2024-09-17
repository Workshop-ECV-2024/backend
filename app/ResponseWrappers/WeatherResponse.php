<?php

namespace App\ResponseWrappers;

use Illuminate\Http\Client\Response;

class WeatherResponse
{
    public Response $response;
    public array $data;

    public function __construct(Response $response)
    {
        $this->response = $response;
        $this->data = $response->json();
    }

    public function getTemperature()
    {
        return $this->getMain()['temp'] ?? null;
    }

    public function getPressure()
    {
        return $this->getMain()['pressure'] ?? null;
    }

    public function getHumidity()
    {
        return $this->getMain()['humidity'] ?? null;
    }

    public function getTempMin()
    {
        return $this->getMain()['temp_min'] ?? null;
    }

    public function getTempMax()
    {
        return $this->getMain()['temp_max'] ?? null;
    }

    public function getWindSpeed()
    {
        return $this->getWind()['speed'] ?? null;
    }

    public function getCloudiness()
    {
        return $this->getClouds()['all'] ?? null;
    }

    public function ok(): bool
    {
        return $this->response->ok();
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getMain()
    {
        return $this->data['main'];
    }

    public function getWind()
    {
        return $this->data['wind'];
    }

    public function getWeather()
    {
        return $this->data['weather'];
    }

    public function getClouds()
    {
        return $this->data['clouds'];
    }

    public function getSys()
    {
        return $this->data['sys'];
    }



}
