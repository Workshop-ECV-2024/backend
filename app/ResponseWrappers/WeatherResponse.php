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
        return $this->data['main']['temp'] ?? null;
    }

    public function ok(): bool
    {
        return $this->response->ok();
    }



}
