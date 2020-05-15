<?php

namespace App\Http\Controllers;

//require '/App/Customs/WeatherService.php';

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Customs\WeatherService;
use Laracasts\Utilities\JavaScript\JavaScript;
use Redirect;
use Exception;

class WeatherController extends Controller
{
    private $weatherService;

    public function __construct(WeatherService $weather)
    {
        $this->weatherService = $weather;
    }

    public function index($name="Angers,FR")
    {
        $weather = $this->weatherService->getWeather($name);
        if($weather instanceof Exception){
            return view('error', ['exception' => $weather]);
        }else{
            return view('welcome', array(
                'weather' => $weather
            ));
        }
    }

    public function getByCoordinates($lat, $lon)
    {
        $weatherName = $this->weatherService->getWeatherByCoordinates($lat, $lon);
        if($weatherName instanceof Exception){
            return view('error', array(
                'exception' => $weatherName
            ));
        }else{
            return Redirect::route('index', array(
                'name' => $weatherName
            ));
        }
    }
}
