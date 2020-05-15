<?php

namespace App\Customs;

use Illuminate\Support\Facades\Http;
use Exception;

class WeatherService
{
   //private $client;
    private $apiKey;

    public function __construct($apiKey="ff8725ace619978b45bf4c93f01eb247")
    {
        //$this->client = Http::create();
        $this->apiKey = $apiKey;
    }

    /**
     * @return array
     */
    public function getWeather($name)
    {
        try{
            $response = Http::get('http://api.openweathermap.org/data/2.5/weather?q='.$name.'&appid=' . $this->apiKey);

            $content = json_decode($response);

            return ['temperature' => round($content->main->temp - 273.15), // en °C
            'temp_min' => round($content->main->temp_min - 273.15),
            'temp_max' => round($content->main->temp_max - 273.15),
            'precipitations' => $content->clouds->all,
            'humidite' => round($content->main->humidity),
            'vent' => round($content->wind->speed * pow(10, -3) * 3600), // en km/H
            'pression' => round($content->main->pressure),
            'name' => $content->name,
            'country' => $content->sys->country
        ];
            //return null;
        }catch(Exception $e){
            return $e;
        }
    }

    /**
     * @return array
     */
    public function getWeatherByCoordinates($lat, $lon)
    {
        try{
            $response = Http::get('https://api.openweathermap.org/data/2.5/weather?lat='.$lat.'&lon='.$lon.'&appid=' . $this->apiKey);

            $content = json_decode($response);

            return $content->name;

        }catch(Exception $e){
            return $e;
        }
    }
}